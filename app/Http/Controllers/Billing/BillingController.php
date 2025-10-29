<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\DataBillingLog;
use App\Models\DataBilling;
use Illuminate\Http\Request;

class BillingController extends Controller
{

    public function index()
    {
        $billings = DataBilling::with(['client', 'items'])->latest()->paginate(10);

        return view('finance.billing.index', compact('billings'));
    }

    public function detail(string $id)
    {
        $billing = DataBilling::with(['client', 'items'])->findOrFail($id);

        return view('finance.billing.detail', compact('billing'));
    }

    public function softDelete(string $id)
    {
        $billing = DataBilling::findOrFail($id);

        // Soft delete tagihan
        $billing->delete();

        // Log histori penghapusan
        DataBillingLog::create([
            'user_id'         => Auth::id(),
            'client_id'       => $billing->client_id,
            'merchant_ref_id' => $billing->merchant_ref,
            'status'          => 'Tagihan ' . $billing->merchant_ref . ' dihapus oleh ' . Auth::user()->name,
        ]);

        return redirect()
            ->route('admin.billing.index')
            ->with('success', 'Tagihan telah dihapus.');
    }
}
