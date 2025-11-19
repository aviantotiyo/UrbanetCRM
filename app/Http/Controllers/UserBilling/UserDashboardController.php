<?php

namespace App\Http\Controllers\UserBilling;

use App\Models\DataBilling;
use App\Models\DataClients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class UserDashboardController extends Controller
{
    public function index(Request $request)
    {
        $clientId = session('client_auth_id');
        $client = DataClients::findOrFail($clientId);

        // Ambil tagihan dengan status UNPAID
        $unpaidBillings = DataBilling::with('items') // relasi ke DataBillingItem
            ->where('client_id', $clientId)
            ->where('status', 'UNPAID')
            ->get();

        return view('client.dashboard.index', compact('client', 'unpaidBillings'));
    }

    public function selectPayment(Request $request)
    {
        $clientId = session('client_auth_id');
        $client = DataClients::findOrFail($clientId);

        if (is_null($client->email)) {
            return redirect('/pelanggan/daftar-email');
        }

        // Ambil daftar tagihan UNPAID
        $unpaidBillings = DataBilling::with('items')
            ->where('client_id', $clientId)
            ->where('status', 'UNPAID')
            ->get();

        if ($unpaidBillings->isEmpty()) {
            return redirect()->route('client.dashboard');
        }

        // Hitung total nilai tagihan
        $totalAmount = 0;
        foreach ($unpaidBillings as $billing) {
            foreach ($billing->items as $item) {
                $totalAmount += ($item->amount + $item->denda - $item->discount);
            }
        }

        if ($client->point >= $totalAmount) {
            return redirect('/pelanggan/paywithpoint');
        }

        // === Caching API Tripay ===
        $channels = Cache::remember('tripay_payment_channels', now()->addDay(), function () {
            $apiKey = config('services.tripay.api_key');
            $baseUrl = config('services.tripay.base_url');
            $endpoint = $baseUrl . '/merchant/payment-channel';

            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_FRESH_CONNECT  => true,
                CURLOPT_URL            => $endpoint,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER         => false,
                CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
                CURLOPT_FAILONERROR    => false,
                CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
            ]);

            $response = curl_exec($curl);
            $error = curl_error($curl);
            curl_close($curl);

            if (!empty($error)) return [];

            $result = json_decode($response, true);
            if (!empty($result['success']) && !empty($result['data'])) {
                return collect($result['data'])->where('active', true)->values()->toArray();
            }

            return [];
        });

        return view('client.dashboard.selectpayment', compact('client', 'unpaidBillings', 'channels'));
        // return view('client.dashboard.selectpaymentdebug', [
        //     'client' => $client,
        //     'unpaidBillings' => $unpaidBillings,
        //     'channels' => $channels,
        //     'response' => $response,
        //     'result' => $result ?? null
        // ]);

    }
}
