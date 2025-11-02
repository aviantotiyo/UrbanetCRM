<?php

namespace App\Http\Controllers\UserBilling;

use App\Models\DataBilling;
use App\Models\DataClients;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

        // === Integrasi ke API Tripay ===
        $apiKey = env('TRIPAY_API_KEY'); // pastikan sudah ditambah di .env
        $baseUrl = env('TRIPAY_BASE_URL'); // dari .env
        $endpoint = $baseUrl . '/merchant/payment-channel';
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            =>  $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);

        $channels = [];

        if (empty($error)) {
            $result = json_decode($response, true);
            if (!empty($result['success']) && !empty($result['data'])) {
                // Filter hanya yang aktif
                $channels = collect($result['data'])->where('active', true)->values();
            }
        }

        return view('client.dashboard.selectpayment', compact('client', 'unpaidBillings', 'channels',  'response'));
    }
}
