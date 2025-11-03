<?php

namespace App\Http\Controllers\UserBilling;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataClients;
use App\Models\DataBilling;

class UserPayPointController extends Controller
{
    public function process(Request $request)
    {
        $clientId = session('client_auth_id');

        // Cek apakah session tersedia
        if (!$clientId) {
            return redirect('/pelanggan'); // fallback jika session kosong
        }

        // Ambil data client
        $client = DataClients::find($clientId);
        if (!$client) {
            return redirect()->route('client.dashboard');
        }

        // Ambil semua tagihan UNPAID
        $unpaidBillings = DataBilling::with('items')
            ->where('client_id', $clientId)
            ->where('status', 'UNPAID')
            ->get();

        if ($unpaidBillings->isEmpty()) {
            return redirect()->route('client.dashboard');
        }

        // Hitung total amount = (amount + denda) - discount
        $totalAmount = 0;
        foreach ($unpaidBillings as $billing) {
            foreach ($billing->items as $item) {
                $totalAmount += ($item->amount + $item->denda - $item->discount);
            }
        }

        // === LOGIKA PEMBAYARAN MENGGUNAKAN POINT + TRIPAY ===
        $minimumTripay = 10000;
        $clientPoint   = (int) $client->point;
        $sisa          = $totalAmount - $clientPoint;

        // default value
        $pointUsed      = 0;
        $payViaTripay   = 0;
        $remainingPoint = $clientPoint;

        if ($clientPoint >= $totalAmount) {
            // ✅ Full bayar pakai point
            $pointUsed      = $totalAmount;
            $payViaTripay   = 0;
            $remainingPoint = $clientPoint - $totalAmount;

            return view('client.dashboard.paywithpoint', compact(
                'client',
                'unpaidBillings',
                'totalAmount',
                'pointUsed',
                'payViaTripay',
                'remainingPoint'
            ));
        }

        // Jika sisa kurang dari minimum Tripay, kurangi pemakaian poin agar sisa minimal 10.000
        if ($sisa < $minimumTripay) {
            $pointUsed      = $totalAmount - $minimumTripay;
            $payViaTripay   = $minimumTripay;
            $remainingPoint = $clientPoint - $pointUsed;
        } else {
            // Normal case
            $pointUsed      = $clientPoint;
            $payViaTripay   = $sisa;
            $remainingPoint = 0;
        }

        // Jika masih ada sisa yang perlu dibayar via Tripay
        if ($payViaTripay > 0) {
            return redirect()->route('client.selectpayment');
        }

        // Tampilkan view jika 100% bayar dengan point
        return view('client.dashboard.paywithpoint', compact(
            'client',
            'unpaidBillings',
            'totalAmount',
            'pointUsed',
            'payViaTripay',
            'remainingPoint'
        ));
    }

    public function redeemPoint(Request $request)
    {
        $clientId = session('client_auth_id');

        // Cek session
        if (!$clientId) {
            return redirect('/pelanggan'); // fallback jika session kosong
        }

        // Validasi input form
        $request->validate([
            'totalPayment'   => 'required|numeric|min:0',
            'pointUsedLabel' => 'required|numeric|min:0',
            'sisaPointLabel' => 'required|numeric|min:0',
        ]);

        // Ambil data client
        $client = DataClients::findOrFail($clientId);

        $billing = DataBilling::where('client_id', $clientId)
            ->where('merchant_ref', $request->merchant_ref)
            ->firstOrFail();

        $billing->update([
            'payment_method'  => 'POINT',
            'payment_name'    => 'Redeem Point',
            'point'           => $request->input('pointUsedLabel'),
            'amount_received' => $request->input('totalPayment'),
            'status'          => 'PAID',
            'total_amount'    => 0,
            'fee_merchant'    => 0,
            'tax'             => 0,
            'after_tax'       => 0,
            'billing_paid'    => now(),
            'reference'       => null,
            'pay_code'        => null,
            'qr_url'          => null,
            'instructions'    => null,
            'expired_time'    => null,
        ]);

        // Update sisa poin client
        $client->update([
            'point' => $request->input('sisaPointLabel'),
        ]);

        return redirect()->route('client.transaksi.show', ['id' => $billing->merchant_ref])
            ->with('success', 'Pembayaran berhasil dengan poin.');
    }
}
