<?php

namespace App\Http\Controllers\UserBilling;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataClients;
use App\Models\DataBilling;
use App\Models\DataBillingItem;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserSuspendController extends Controller
{
    public function suspend($id)
    {
        // Ambil data client
        $client = DataClients::findOrFail($id);

        // Validasi: hanya jika status suspend
        if ($client->status !== 'suspend') {
            return redirect()->route('client.dashboard')
                ->with('error', 'Akses tidak sah. Pelanggan tidak dalam status suspend.');
        }

        $now = Carbon::now();
        $daysInMonth = $now->daysInMonth;
        $remainingDays = $daysInMonth - $now->day + 1;

        // Hitung tagihan prorata
        $proratedAmount = ceil(($client->tagihan / $daysInMonth) * $remainingDays);

        // Ambil billing UNPAID milik client
        $billing = DataBilling::where('client_id', $client->id)
            ->where('status', 'UNPAID')
            ->orderBy('billing_create', 'desc')
            ->first();

        if (!$billing) {
            return redirect()->route('client.dashboard')
                ->with('error', 'Tidak ditemukan tagihan UNPAID untuk pelanggan ini.');
        }

        // Cek apakah item billing untuk bulan & tahun ini sudah ada
        $item = DataBillingItem::where('merchant_ref_id', $billing->merchant_ref)
            ->whereMonth('billing_cycle', $now->month)
            ->whereYear('billing_cycle', $now->year)
            ->first();

        if ($item) {
            // Jika SUDAH ADA, hanya update amount-nya jika perlu
            if ((int) $item->amount !== $proratedAmount) {
                $item->update([
                    'amount' => $proratedAmount,
                ]);
            }

            return redirect()->route('client.paywithpoint');
        }

        // Jika BELUM ADA → Tambahkan item tagihan baru
        DataBillingItem::create([
            'merchant_ref_id' => $billing->merchant_ref,
            'sku'             => $client->name_profile,
            'name'            => $client->paket,
            'amount'          => $proratedAmount,
            'billing_cycle'   => $now,
        ]);

        return redirect()->route('client.paywithpoint');
    }
}
