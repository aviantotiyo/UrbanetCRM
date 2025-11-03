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

        // Hitung total amount
        $amountTotal = 0;
        foreach ($billing->items as $item) {
            $amountTotal += $item->amount + $item->denda - $item->discount;
        }
        $amountTotal -= $client->point;

        // Ambil metode pembayaran dari query (sementara)
        $method = request('method'); // fallback method

        // Ambil flat & percent dari query
        $flat = request('flat');
        $percent = request('percent');

        $fee = ceil($flat + ($amountTotal * ($percent / 100)));
        $finalTotal = $amountTotal + $fee;

        // --- Siapkan data Tripay
        $apiKey       = env('TRIPAY_API_KEY');
        $privateKey   = env('TRIPAY_PRIVATE_KEY');
        $merchantCode = env('TRIPAY_MERCHANT_CODE');
        $merchantRef  = $billing->merchant_ref;

        $items = [];

        foreach ($billing->items as $item) {
            // Item utama
            $items[] = [
                'sku'         => $item->sku,
                'name'        => $item->name,
                'price'       => $item->amount,
                'quantity'    => 1,
            ];

            // Tambahkan denda jika ada
            if ($item->denda > 0) {
                $items[] = [
                    'sku'         => 'denda-' . $item->sku,
                    'name'        => 'Denda ' . $item->name,
                    'price'       => $item->denda,
                    'quantity'    => 1,
                ];
            }

            // Tambahkan diskon jika ada → gunakan harga negatif
            if ($item->discount > 0) {
                $items[] = [
                    'sku'         => 'discount-' . $item->sku,
                    'name'        => 'Diskon ' . $item->name,
                    'price'       => -1 * $item->discount,
                    'quantity'    => 1,
                ];
            }
        }

        // Tambahkan loyalti point jika ada → juga sebagai potongan (negatif)
        if ($client->point > 0) {
            $items[] = [
                'sku'         => 'point',
                'name'        => 'Potongan Loyalti Point',
                'price'       => -1 * $client->point,
                'quantity'    => 1,
            ];
        }

        // Tambahkan admin fee (positif)
        $items[] = [
            'sku'         => 'admin-fee',
            'name'        => 'Biaya Admin Bank',
            'price'       => $fee,
            'quantity'    => 1,
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
            'expired_time'   => time() + (24 * 60 * 60),
            'signature'      => hash_hmac('sha256', $merchantCode . $merchantRef . $finalTotal, $privateKey)
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
        ])->asForm()->post(env('TRIPAY_BASE_URL') . '/transaction/create', $data);



        $responseData = $response->json();

        if (isset($responseData['success']) && $responseData['success']) {
            $billing->updateFromTripayResponse($responseData['data']);
        }

        // return view('client.dashboard.paymentdebug', [
        //     'response' => $response->json(),
        //     'data' => $data,
        //     'fee' => $fee,
        //     'finalTotal' => $finalTotal
        // ]);

        // Jika Tripay respon success, arahkan ke halaman transaksi detail
        if (!empty($responseData['success']) && $responseData['success'] === true) {
            return redirect()->route('client.transaksi.show', ['id' => $merchantRef]);
        }

        // return back()->withErrors(['tripay' => $responseData['message'] ?? 'Gagal membuat transaksi di Tripay.']);
    }
}
