<?php

namespace App\Http\Controllers\Partner;

use App\Models\DataBilling;
use App\Models\DataClients;
use App\Models\DataPartner;
use App\Models\DataSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\DataBillingItem;
use App\Http\Controllers\Controller;

class UserSuspendPartnerController extends Controller
{
    public function show($id)
    {
        $partnerId = session('partner_auth_id');
        $partner = DataPartner::findOrFail($partnerId);

        $client = DataClients::findOrFail($id);

        // Jika status bukan suspend, kembalikan ke dashboard
        if ($client->status !== 'suspend') {
            return redirect()->route('partner.dashboard')
                ->with('info', 'Pelanggan tidak dalam status suspend.');
        }

        return view('partner.suspend-confirm', compact('client', 'partner'));
    }

    public function process($id)
    {
        $client = DataClients::findOrFail($id);

        if ($client->status !== 'suspend') {
            return redirect()->route('partner.dashboard')
                ->with('error', 'Status pelanggan bukan suspend.');
        }

        // Ambil data partner dari session
        $partnerId = session('partner_auth_id');
        $partner = DataPartner::findOrFail($partnerId);

        $now = Carbon::now();
        $daysInMonth = $now->daysInMonth;
        $remainingDays = $daysInMonth - $now->day + 1;
        $proratedAmount = ceil(($client->tagihan / $daysInMonth) * $remainingDays);

        // Ambil billing UNPAID terbaru
        $billing = DataBilling::where('client_id', $client->id)
            ->where('status', 'UNPAID')
            ->orderBy('billing_create', 'desc')
            ->first();

        if (!$billing) {
            return redirect()->route('partner.dashboard')
                ->with('error', 'Tagihan UNPAID tidak ditemukan untuk pelanggan ini.');
        }

        // Update partner_id jika belum diset
        if (is_null($billing->partner_id)) {
            $billing->update(['partner_id' => $partnerId]);
        }

        // Cek item bulan ini
        $item = DataBillingItem::where('merchant_ref_id', $billing->merchant_ref)
            ->whereMonth('billing_cycle', $now->month)
            ->whereYear('billing_cycle', $now->year)
            ->first();

        if ($item) {
            if ((int) $item->amount !== $proratedAmount) {
                $item->update(['amount' => $proratedAmount]);
            }
        } else {
            DataBillingItem::create([
                'merchant_ref_id' => $billing->merchant_ref,
                'sku'             => $client->name_profile,
                'name'            => $client->paket,
                'amount'          => $proratedAmount,
                'billing_cycle'   => $now,
            ]);
        }

        // Ambil ulang seluruh tagihan UNPAID
        $billings = DataBilling::where('client_id', $client->id)
            ->where('status', 'UNPAID')
            ->get();

        $merchantRefs = $billings->pluck('merchant_ref')->toArray();

        $billingItems = DataBillingItem::whereIn('merchant_ref_id', $merchantRefs)->get();

        // return view('partner.tagihan', compact('client', 'billings', 'billingItems', 'partner'));
        return redirect()->route('partner.user_suspend.select', ['id' => $billing->merchant_ref]);
    }

    public function selectpayment($merchant_ref)
    {
        // Ambil data partner dari session
        $partnerId = session('partner_auth_id');
        $partner = DataPartner::findOrFail($partnerId);

        // Ambil data billing berdasarkan merchant_ref
        $billing = DataBilling::where('merchant_ref', $merchant_ref)->firstOrFail();

        // Ambil client yang terkait
        $client = DataClients::findOrFail($billing->client_id);

        // Ambil semua billing item dengan merchant_ref_id yang sama
        $billingItems = DataBillingItem::where('merchant_ref_id', $merchant_ref)->get();

        return view('partner.suspend-payment', compact(
            'partner',
            'billing',
            'billingItems',
            'client'
        ));
    }

    public function paymentprocess(Request $request, $merchant_ref)
    {
        // Validasi request
        $request->validate([
            'bank'         => 'required|string',
            'total_amount' => 'required|numeric|min:0',
        ]);

        // Ambil sesi partner
        $partnerId = session('partner_auth_id');
        $partner = DataPartner::findOrFail($partnerId);

        // Ambil billing berdasarkan merchant_ref
        $billing = DataBilling::where('merchant_ref', $merchant_ref)
            ->where('status', 'UNPAID')
            ->firstOrFail();

        // Ambil client
        $client = DataClients::findOrFail($billing->client_id);

        // Pastikan client masih suspend
        if ($client->status !== 'suspend') {
            return redirect()->route('partner.dashboard')
                ->with('error', 'Status pelanggan bukan suspend.');
        }

        // Perhitungan pajak
        $taxPercent = DataSetting::value('tax') ?? 11;

        $amountReceived = (int)$request->total_amount;
        $tax = $amountReceived * ($taxPercent / 100);
        $afterTax = $amountReceived - $tax;

        // Ambil fee merchant
        $fee_merchant = DataSetting::value('fee_merchant_billing') ?? 3500;

        $today = now()->format('Y-m-d');

        // Generate kode unik anti duplikat pada hari yang sama
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

        // Update billing
        $billing->update([
            'new_member'   => 0,
            'reference'  => null,
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
            'fee_merchant'     => $fee_merchant,
        ]);

        // Redirect ke halaman detail pembayaran
        return redirect()->route('partner.payment.detail', ['merchant_ref' => $merchant_ref])
            ->with('success', 'Tagihan berhasil diproses untuk pembayaran.');
    }
}
