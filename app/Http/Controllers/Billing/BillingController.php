<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use App\Models\DataBilling;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    /**
     * Menampilkan semua data billing.
     */
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
}
