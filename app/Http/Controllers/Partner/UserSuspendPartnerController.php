<?php

namespace App\Http\Controllers\Partner;

use App\Models\DataBilling;
use App\Models\DataClients;
use App\Models\DataPartner;
use Illuminate\Http\Request;
use App\Models\DataBillingItem;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;

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
        return redirect('mitra/user-tagihan/{$client->no_hp}');
    }
}
