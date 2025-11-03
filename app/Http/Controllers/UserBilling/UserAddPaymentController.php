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
        $billing = DataBilling::with('items')->where('merchant_ref', $id)->firstOrFail();
        $client = DataClients::findOrFail($billing->client_id);

        // Hitung total tagihan
        $amountTotal = 0;
        foreach ($billing->items as $item) {
            $amountTotal += $item->amount + $item->denda - $item->discount;
        }

        // Ambil poin yang dipakai dari form
        $pointUsed = min((int) request('point_used'), $client->point, $amountTotal);

        // Kurangi dari total tagihan
        $amountTotal -= $pointUsed;

        // Ambil biaya admin dari form
        $flat = (float) request('flat');
        $percent = (float) request('percent');
        $fee = ceil($flat + ($amountTotal * ($percent / 100)));

        // Hitung final total
        $finalTotal = $amountTotal + $fee;

        // Validasi minimum pembayaran final (Tripay mensyaratkan minimal Rp10.000)
        if ($finalTotal < 10000) {
            return back()->withErrors(['msg' => 'Total pembayaran harus minimal Rp10.000 agar bisa diproses.']);
        }

        // Siapkan data Tripay
        $apiKey       = env('TRIPAY_API_KEY');
        $privateKey   = env('TRIPAY_PRIVATE_KEY');
        $merchantCode = env('TRIPAY_MERCHANT_CODE');
        $merchantRef  = $billing->merchant_ref;
        $method       = request('method');

        // Susun detail item
        $items = [];
        foreach ($billing->items as $item) {
            $items[] = [
                'sku' => $item->sku,
                'name' => $item->name,
                'price' => $item->amount,
                'quantity' => 1,
            ];

            if ($item->denda > 0) {
                $items[] = [
                    'sku' => 'denda-' . $item->sku,
                    'name' => 'Denda ' . $item->name,
                    'price' => $item->denda,
                    'quantity' => 1,
                ];
            }

            if ($item->discount > 0) {
                $items[] = [
                    'sku' => 'discount-' . $item->sku,
                    'name' => 'Diskon ' . $item->name,
                    'price' => -1 * $item->discount,
                    'quantity' => 1,
                ];
            }
        }

        // Tambahkan potongan loyalti point jika digunakan
        if ($pointUsed > 0) {
            $items[] = [
                'sku' => 'point',
                'name' => 'Potongan Loyalti Point',
                'price' => -1 * $pointUsed,
                'quantity' => 1,
            ];
        }

        // Tambahkan biaya admin
        $items[] = [
            'sku' => 'admin-fee',
            'name' => 'Biaya Admin Bank',
            'price' => $fee,
            'quantity' => 1,
        ];

        $data = [
            'method'         => $method,
            'merchant_ref'   => $merchantRef,
            'amount'         => $finalTotal,
            'customer_name'  => $client->nama,
            'customer_email' => $client->email,
            'customer_phone' => $client->no_hp,
            'order_items'    => $items,
            'return_url'     => route('client.dashboard'),
            'expired_time'   => time() + (24 * 60 * 60), // 24 jam
            'signature'      => hash_hmac('sha256', $merchantCode . $merchantRef . $finalTotal, $privateKey),
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
        ])->asForm()->post(env('TRIPAY_BASE_URL') . '/transaction/create', $data);

        $responseData = $response->json();

        // Jika sukses, update billing dan kurangi point client
        if (!empty($responseData['success']) && $responseData['success'] === true) {
            $billing->updateFromTripayResponse($responseData['data']);

            $client->point = max(0, $client->point - $pointUsed);
            $client->save();

            return redirect()->route('client.transaksi.show', ['id' => $merchantRef]);
        }

        return back()->withErrors(['msg' => 'Gagal memproses pembayaran.']);
    }
}
