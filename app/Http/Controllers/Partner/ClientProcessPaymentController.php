<?php

namespace App\Http\Controllers\Partner;

use Carbon\Carbon;
use App\Models\DataBilling;
use App\Models\DataClients;
use App\Models\DataPartner;
use App\Models\DataSetting;
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
        $today = now()->format('Y-m-d');

        // Ambil data billing
        $billing = DataBilling::where('merchant_ref', $merchant_ref)->firstOrFail();

        // 🔹 Hitung nilai pajak dan nilai setelah pajak
        $taxPercent = DataSetting::value('tax') ?? 11;

        $amountReceived = $request->total;
        $tax = ($amountReceived * ($taxPercent / 100));
        $afterTax = $amountReceived - $tax;

        // 🔹 Generate kode unik antara 11–99 dan pastikan tidak duplikat di hari yang sama
        do {
            $kodeUnik = random_int(11, 99);

            $exists = DataBilling::whereDate('exp_tx_bank', $today)
                ->where('status', 'UNPAID')
                ->where(function ($q) {
                    $q->whereNull('bank_check')
                        ->orWhere('bank_check', 1);
                })
                ->where('kode_unik', $kodeUnik)
                ->exists();
        } while ($exists);

        // 🔹 Update DataBilling
        $billing->update([
            'payment_method'   => 'MITRA',
            'payment_name'     => 'MITRA',
            'bank_name_manual' => $request->bank,
            'exp_tx_bank'      => now()->addHour(),
            'partner_id'       => $partnerId,
            'status'           => 'UNPAID',
            'kode_unik'        => $kodeUnik,
            'total_amount'     => $amountReceived + $kodeUnik,
            'amount_received'  => $amountReceived,
            'tax'              => $tax,
            'after_tax'        => $afterTax,
        ]);

        // 🔹 Kurangi poin pelanggan
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
        $partnerId = session('partner_auth_id');

        // Tolak jika tagihan sudah diklaim partner lain
        if (!is_null($billing->partner_id) && $billing->partner_id !== $partnerId) {
            abort(403, 'Akses tidak sah. Tagihan telah diklaim oleh mitra lain.');
        }

        // Jika belum diklaim, assign partner saat ini
        if (is_null($billing->partner_id)) {
            $billing->update(['partner_id' => $partnerId]);
        }

        // Cek dan isi kode_unik jika belum ada
        if (is_null($billing->kode_unik)) {
            $today = \Carbon\Carbon::parse($billing->exp_tx_bank)->startOfDay(); // Pastikan gunakan tanggal exp_tx_bank

            do {
                $kodeUnik = random_int(11, 99);

                $exists = DataBilling::whereDate('exp_tx_bank', $today)
                    ->where('status', 'UNPAID')
                    ->where(function ($q) {
                        $q->whereNull('bank_check')
                            ->orWhere('bank_check', 1);
                    })
                    ->where('kode_unik', $kodeUnik)
                    ->exists();
            } while ($exists);

            $billing->update([
                'kode_unik'   => $kodeUnik,
                'exp_tx_bank' => \Carbon\Carbon::now()->addHour(),
            ]);
        }

        if (is_null($billing->bank_name_manual)) {
            $client = $billing->client;
            return redirect()->route('partner.user.billing', ['no_hp' => $client->no_hp])
                ->with('success', 'Silakan pilih metode pembayaran terlebih dahulu. Mungkin invoice telah expired');
        }


        $partner = DataPartner::findOrFail($partnerId);
        $client = $billing->client;

        $billings = DataBilling::where('client_id', $client->id)
            ->where('status', 'UNPAID')
            ->get();

        $merchantRefs = $billings->pluck('merchant_ref')->toArray();
        $billingItems = \App\Models\DataBillingItem::whereIn('merchant_ref_id', $merchantRefs)->get();

        $fee_merchant_billing = \App\Models\DataSetting::value('fee_merchant_billing');

        return view('partner.detail', compact(
            'billing',
            'partner',
            'client',
            'billings',
            'billingItems',
            'fee_merchant_billing'
        ));
    }



    public function confirmTransfer(Request $request, $merchant_ref)
    {
        // Ambil data billing berdasarkan merchant_ref
        $billing = DataBilling::where('merchant_ref', $merchant_ref)->firstOrFail();

        $partnerId = Session::get('partner_auth_id');

        // Cek jika tagihan tidak terkait dengan partner saat ini atau belum diproses (partner_id null)
        if ($billing->partner_id === null || $billing->partner_id !== $partnerId) {
            return redirect()->back()
                ->withErrors(['error' => 'Konfirmasi ditolak! Mungkin invoice kadaluarsa atau sudah diproses agen lain.']);
        }


        $fee_merchant = DataSetting::value('fee_merchant_billing') ?? 3500;

        // Update status bank_check jadi 1 (menandakan sudah transfer)
        $billing->update([
            'bank_check' => 1,
            'fee_merchant' => $fee_merchant,
        ]);


        // return redirect()->route('partner.payment.detail', ['merchant_ref' => $merchant_ref])
        return redirect()->route('partner.transaksi')
            ->with('success', 'Konfirmasi transfer berhasil dikirim. Tagihan akan segera diverifikasi.');
    }
}
