<?php

namespace App\Http\Controllers\Partner;

use App\Models\DataBilling;
use App\Models\DataClients;
use App\Models\DataPartner;
use Illuminate\Http\Request;
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

        $merchantRefs = $billings->pluck('merchant_ref')->toArray();
        $billingItems = DataBillingItem::whereIn('merchant_ref_id', $merchantRefs)->get();

        // Ambil partner dari session
        $partner = DataPartner::find(Session::get('partner_auth_id'));

        return view('partner.tagihan', compact('client', 'billings', 'billingItems', 'partner'));
    }
}
