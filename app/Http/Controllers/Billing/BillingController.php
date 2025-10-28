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
        $billings = DataBilling::with(['client', 'items'])->latest()->get();

        return view('finance.billing.index', compact('billings'));
    }
}
