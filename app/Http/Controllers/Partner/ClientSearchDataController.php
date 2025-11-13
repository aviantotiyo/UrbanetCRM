<?php

namespace App\Http\Controllers\Partner;

use App\Models\DataBilling;
use App\Models\DataClients;
use App\Models\DataPartner;
use Illuminate\Http\Request;
use App\Models\DataBankManual;
use App\Models\DataBillingItem;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ClientSearchDataController extends Controller
{

    public function showBilling($no_hp)
    {
        $client = DataClients::where('no_hp', $no_hp)->first();

        if (!$client) {
            return back()->withErrors(['no_hp' => 'Nomor HP tidak ditemukan'])->withInput();
        }

        $billings = DataBilling::where('client_id', $client->id)
            ->where('status', 'UNPAID')
            ->get();

        if ($billings->isEmpty()) {
            return back()->with('info', 'Tidak ada tagihan aktif untuk nomor ini.');
        }

        $merchantRefs = $billings->pluck('merchant_ref')->toArray();

        $billingItems = DataBillingItem::whereIn('merchant_ref_id', $merchantRefs)->get();

        // Hitung total amount tagihan (amount + denda - discount)
        $totalTagihan = $billingItems->sum(function ($item) {
            return $item->amount + $item->denda - $item->discount;
        });

        $partner = DataPartner::find(Session::get('partner_auth_id'));


        // Cek apakah point mencukupi
        if ($client->point >= $totalTagihan) {
            return view('partner.point-payment', compact('client', 'billingItems', 'partner'));
        }

        // Ambil partner dari session
        $partner = DataPartner::find(Session::get('partner_auth_id'));

        return view('partner.tagihan', compact('client', 'billings', 'billingItems', 'partner'));
    }

    public function showPointPayment(Request $request)
    {
        $no_hp = $request->query('no_hp');

        $client = DataClients::where('no_hp', $no_hp)->firstOrFail();

        // Ambil semua tagihan UNPAID dari client
        $billings = DataBilling::where('client_id', $client->id)
            ->where('status', 'UNPAID')
            ->get();

        // Ambil seluruh item dari semua tagihan terkait
        $merchantRefs = $billings->pluck('merchant_ref')->toArray();
        $billingItems = DataBillingItem::whereIn('merchant_ref_id', $merchantRefs)->get();

        // Ambil partner_id dari session dan pastikan data partner ditemukan
        $partnerId = session('partner_auth_id');
        $partner = DataPartner::findOrFail($partnerId);

        return view('partner.point-payment', compact('client', 'billingItems', 'partner'));
    }
}
