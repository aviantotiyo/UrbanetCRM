<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use App\Models\DataBilling;
use App\Models\DataBillingItem;
use App\Models\DataBillingLog;
use App\Models\DataSetting;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ManualPayController extends Controller
{
    /**
     * Menandai tagihan sebagai telah dibayar secara manual.
     */
    public function pay(string $id)
    {
        $billing = DataBilling::findOrFail($id);

        $items = DataBillingItem::where('merchant_ref_id', $billing->merchant_ref)->get();

        $totalAmount = $items->sum(function ($item) {
            $discount = $item->discount ?? 0;
            return $item->amount - $discount;
        });

        // Ambil nilai tax dari setting
        $setting = DataSetting::first();
        $taxPercent = $setting?->tax ?? 11;

        // Hitung pajak berdasarkan tax %
        $afterTax = round($totalAmount * ($taxPercent / 100));
        $amountReceived = $totalAmount - $afterTax;

        $billing->update([
            'status'          => 'PAID',
            'payment_method'  => 'Bayar Manual',
            'payment_name'    => 'Bayar Manual',
            'billing_paid'    => now(),
            'fee_merchant'    => 0,
            'fee_customer'    => 0,
            'total_amount'    => $totalAmount,
            'amount_received' => $totalAmount,
            'after_tax'       => $amountReceived,
            'tax'             => $afterTax,
        ]);

        DataBillingLog::create([
            'user_id'         => Auth::id(),
            'client_id'       => $billing->client_id,
            'merchant_ref_id' => $billing->merchant_ref,
            'status'          => 'Pembayaran manual berhasil dilakukan oleh ' . Auth::user()->name .
                ' untuk tagihan ' . $billing->merchant_ref,
        ]);

        return redirect()
            ->route('admin.billing.index')
            ->with('success', 'Tagihan telah ditandai sebagai dibayar secara manual.');
    }
}
