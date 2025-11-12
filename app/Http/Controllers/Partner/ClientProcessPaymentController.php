<?php

namespace App\Http\Controllers\Partner;

use Carbon\Carbon;
use App\Models\DataBilling;
use App\Models\DataClients;
use App\Models\DataPartner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ClientProcessPaymentController extends Controller
{
    /**
     * Tampilkan halaman konfirmasi pembayaran
     */
    public function showForm($merchant_ref)
    {
        $billing = DataBilling::where('merchant_ref', $merchant_ref)->firstOrFail();
        $partnerId = Session::get('partner_auth_id');

        return view('partner.process', compact('billing', 'partnerId'));
    }

    /**
     * Proses form pembayaran
     */
    public function processPayment(Request $request, $merchant_ref)
    {
        $request->validate([
            'bank' => 'required|string',
            'total' => 'required|numeric|min:0',
            'client_point' => 'nullable|numeric|min:0',
        ]);

        $partnerId = Session::get('partner_auth_id');
        $kodeUnik = random_int(11, 99);

        // Ambil tagihan
        $billing = DataBilling::where('merchant_ref', $merchant_ref)->firstOrFail();

        // Update DataBilling
        $billing->update([
            'payment_method'   => 'MITRA',
            'payment_name'     => 'MITRA',
            'bank_name_manual' => $request->bank,
            'exp_tx_bank'      => Carbon::now()->addHour(),
            'partner_id'       => $partnerId,
            'status'           => 'UNPAID',
            'kode_unik'        => $kodeUnik,
            'total_amount'     => $request->total + $kodeUnik,
        ]);

        // Kurangi poin pelanggan
        $client = DataClients::find($billing->client_id);
        if ($client && $request->filled('client_point')) {
            $client->point = max(0, $client->point - $request->client_point);
            $client->save();
        }

        return redirect()->route('partner.payment.detail', ['merchant_ref' => $merchant_ref])
            ->with('success', 'Tagihan berhasil diproses untuk pembayaran.');
    }


    public function showDetail($merchant_ref)
    {
        $billing = DataBilling::with('client', 'partner')->where('merchant_ref', $merchant_ref)->firstOrFail();
        $partner = DataPartner::findOrFail(session('partner_auth_id'));

        if ($billing->partner_id !== session('partner_auth_id')) {
            abort(403, 'Akses tidak sah.');
        }

        // Ambil data client dari relasi
        $client = $billing->client;

        // Ambil semua tagihan UNPAID milik client
        $billings = DataBilling::where('client_id', $client->id)
            ->where('status', 'UNPAID')
            ->get();

        // Ambil semua billing item berdasarkan merchant_ref_id dari seluruh billings
        $merchantRefs = $billings->pluck('merchant_ref')->toArray();
        $billingItems = \App\Models\DataBillingItem::whereIn('merchant_ref_id', $merchantRefs)->get();

        // Ambil fee mitra dari tabel DataSetting (tanpa primary key)
        $fee_merchant_billing = \App\Models\DataSetting::value('fee_merchant_billing');

        return view('partner.detail', compact('billing', 'partner', 'client', 'billings', 'billingItems', 'fee_merchant_billing'));
    }
}
