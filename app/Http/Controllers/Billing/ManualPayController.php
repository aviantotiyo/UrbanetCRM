<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use App\Models\DataBilling;
use App\Models\DataBillingItem;
use Illuminate\Support\Carbon;

class ManualPayController extends Controller
{
    /**
     * Menandai tagihan sebagai telah dibayar secara manual.
     */
    public function pay(string $id)
    {
        $billing = DataBilling::findOrFail($id);

        // Ambil semua item yang berkaitan
        $items = DataBillingItem::where('merchant_ref_id', $billing->merchant_ref)->get();

        // Hitung total amount setelah diskon
        $totalAmount = $items->sum(function ($item) {
            $discount = $item->discount ?? 0;
            return $item->amount - $discount;
        });

        // Hitung pajak 11% dan potong dari total
        $afterTax = round($totalAmount * 0.11);
        $amountReceived = $totalAmount - $afterTax;

        // Update tagihan
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

        return redirect()
            ->route('admin.billing.index')
            ->with('success', 'Tagihan telah ditandai sebagai dibayar secara manual.');
    }
}
