<?php

namespace App\Exports;

use App\Models\DataBilling;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BillingExport implements FromView
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $query = DataBilling::with(['client', 'items']);

        if ($this->request->filled('q')) {
            $search = $this->request->q;
            $query->whereHas('client', function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                    ->orWhere('nopel', 'like', "%$search%")
                    ->orWhere('no_hp', 'like', "%$search%");
            });
        }

        if ($this->request->filled('billing_status')) {
            $query->where('status', $this->request->billing_status);
        }

        if ($this->request->filled('client_status')) {
            $query->whereHas('client', function ($q) {
                $q->where('status', $this->request->client_status);
            });
        }

        if ($this->request->filled('billing_range')) {
            $dates = explode(' to ', $this->request->billing_range);
            if (count($dates) === 2) {
                $query->whereHas('items', function ($q) use ($dates) {
                    $q->whereDate('billing_cycle', '>=', $dates[0])
                        ->whereDate('billing_cycle', '<=', $dates[1]);
                });
            }
        }

        $billings = $query->latest()->get();

        return view('finance.billing.exports.billing_excel', compact('billings'));
    }
}
