<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataBilling;
use App\Models\DataClients;
use App\Models\DataPartner;
use Illuminate\Support\Facades\Session;

class ClientProcessPointController extends Controller
{
    public function store(Request $request, $merchant_ref_id)
    {
        $request->validate([
            'sisa_poin' => 'required|numeric',
            'sisa_tagihan' => 'required|numeric',
            'poin_digunakan' => 'required|numeric',
            'partner_auth_id' => 'required|exists:data_partner,id',
        ]);

        $billing = DataBilling::where('merchant_ref', $merchant_ref_id)->firstOrFail();
        $client = DataClients::findOrFail($billing->client_id);
        $partner = DataPartner::findOrFail($request->partner_auth_id);

        // Update billing
        $billing->update([
            'payment_method' => 'MITRA',
            'payment_name' => 'MITRA',
            'total_amount' => $request->sisa_tagihan,
            'point' => $request->poin_digunakan,
            'fee_merchant' => null,
            'fee_customer' => null,
            'amount_received' => $request->sisa_tagihan,
            'tax' => null,
            'after_tax' => null,
            'status' => 'PAID',
            'partner_id' => $partner->id,
            'bank_name_manual' => 'POINT',
            'billing_paid' => now(),
            'kode_unik' => null,
            'exp_tx_bank' => null,
        ]);

        // Update poin client
        $client->update([
            'point' => $request->sisa_poin
        ]);

        return redirect()->route('partner.transaksi')
            ->with('success', 'Pembayaran dengan poin berhasil diproses.');
    }
}
