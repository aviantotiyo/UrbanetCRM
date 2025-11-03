<?php

namespace App\Http\Controllers\UserBilling;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataClients;
use App\Models\DataBilling;

class UserTransactionController extends Controller
{
    // Tampilkan semua transaksi milik pelanggan yang sedang login
    public function index()
    {
        $clientId = session('client_auth_id');
        $client = DataClients::findOrFail($clientId);

        $billings = DataBilling::with('items') // Tambahkan relasi ke items
            ->where('client_id', $clientId)
            ->whereNotNull('payment_method')
            ->orderByDesc('billing_create')
            ->take(6)
            ->get();

        return view('client.dashboard.transaksi', compact('client', 'billings'));
    }

    // Tampilkan detail transaksi berdasarkan merchant_ref
    public function show($id)
    {
        $clientId = session('client_auth_id');
        $client = DataClients::findOrFail($clientId);
        $billing = DataBilling::with('items')
            ->where('client_id', $clientId)
            ->where('merchant_ref', $id)
            ->firstOrFail();

        $unpaidBillings = DataBilling::with('items')
            ->where('client_id', $clientId)
            // ->where('status', 'UNPAID')
            ->get();


        return view('client.dashboard.detail_transaksi', compact('client', 'billing', 'unpaidBillings'));
    }
}
