<?php

namespace App\Http\Controllers\UserBilling;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataBilling;
use App\Models\DataClients;
use Illuminate\Support\Facades\Http;

class UserAddPaymentController extends Controller

{
    public function process($id)
    {
        $billing = DataBilling::with('items')
            ->where('merchant_ref', $id)
            ->firstOrFail();

        $client = DataClients::findOrFail($billing->client_id);

        // Hitung total tagihan
        $amountTotal = 0;
        foreach ($billing->items as $item) {
            $amountTotal += $item->amount + $item->denda - $item->discount;
        }

        // Ambil poin dari form
        $pointUsed = min(
            (int) request('point_used'),
            $client->point,
            $amountTotal
        );

        // Kurangi dari total
        $amountTotal -= $pointUsed;

        // Ambil biaya admin dari form
        $flat = (float) request('flat');
        $percent = (float) request('percent');

        $fee = ceil($flat + ($amountTotal * ($percent / 100)));

        // Hitung total final
        $finalTotal = $amountTotal + $fee;

        // Tripay minimal 10.000
        if ($finalTotal < 10000) {
            return back()->withErrors(['msg' => 'Total pembayaran harus minimal Rp10.000 agar bisa diproses.']);
        }

        // --- Ambil dari CONFIG ---
        $apiKey       = config('services.tripay.api_key');
        $privateKey   = config('services.tripay.private_key');
        $merchantCode = config('services.tripay.merchant_code');
        $baseUrl      = rtrim(config('services.tripay.base_url'), '/');
        // --------------------------

        $merchantRef  = $billing->merchant_ref;
        $method       = request('method');

        // Susun item
        $items = [];
        foreach ($billing->items as $item) {

            $items[] = [
                'sku'      => $item->sku,
                'name'     => $item->name,
                'price'    => $item->amount,
                'quantity' => 1,
            ];

            if ($item->denda > 0) {
                $items[] = [
                    'sku'      => 'denda-' . $item->sku,
                    'name'     => 'Denda ' . $item->name,
                    'price'    => $item->denda,
                    'quantity' => 1,
                ];
            }

            if ($item->discount > 0) {
                $items[] = [
                    'sku'      => 'discount-' . $item->sku,
                    'name'     => 'Diskon ' . $item->name,
                    'price'    => -1 * $item->discount,
                    'quantity' => 1,
                ];
            }
        }

        // Tambah potongan poin
        if ($pointUsed > 0) {
            $items[] = [
                'sku'      => 'point',
                'name'     => 'Potongan Loyalti Point',
                'price'    => -1 * $pointUsed,
                'quantity' => 1,
            ];
        }

        // Tambah fee admin
        $items[] = [
            'sku'      => 'admin-fee',
            'name'     => 'Biaya Admin Bank',
            'price'    => $fee,
            'quantity' => 1,
        ];

        // Data request ke Tripay
        $data = [
            'method'         => $method,
            'merchant_ref'   => $merchantRef,
            'amount'         => $finalTotal,
            'customer_name'  => $client->nama,
            'customer_email' => $client->email,
            'customer_phone' => $client->no_hp,
            'order_items'    => $items,
            'return_url'     => route('client.dashboard'),
            'expired_time'   => time() + (24 * 60 * 60),
            'signature'      => hash_hmac(
                'sha256',
                $merchantCode . $merchantRef . $finalTotal,
                $privateKey
            ),
        ];

        // Panggil Tripay API
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
        ])
            ->asForm()
            ->post($baseUrl . '/transaction/create', $data);

        $responseData = $response->json();

        // Jika sukses
        if (!empty($responseData['success']) && $responseData['success'] === true) {

            // Update billing
            $billing->updateFromTripayResponse($responseData['data']);

            // Simpan poin yang dipakai
            $billing->point = $pointUsed;
            $billing->save();

            // Kurangi poin client
            $client->point = max(0, $client->point - $pointUsed);
            $client->save();

            return redirect()->route('client.transaksi.show', [
                'id' => $merchantRef
            ]);
        }

        return back()->withErrors(['msg' => 'Gagal memproses pembayaran.']);
    }
}
