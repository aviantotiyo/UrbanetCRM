<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\DataBillingLog;
use App\Models\DataBilling;
use Illuminate\Http\Request;
use App\Exports\BillingExport;
use Maatwebsite\Excel\Facades\Excel;

class BillingController extends Controller
{

    public function index(Request $request)
    {
        $query = DataBilling::with(['client', 'items']);

        // Keyword: nama, nopel, no_hp
        if ($request->filled('q')) {
            $search = $request->q;
            $query->whereHas('client', function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                    ->orWhere('nopel', 'like', "%$search%")
                    ->orWhere('no_hp', 'like', "%$search%");
            });
        }

        // Status billing
        if ($request->filled('billing_status')) {
            $query->where('status', $request->billing_status);
        }

        // Status client
        if ($request->filled('client_status')) {
            $query->whereHas('client', function ($q) use ($request) {
                $q->where('status', $request->client_status);
            });
        }

        if ($request->filled('billing_range')) {
            $dates = explode(' to ', $request->billing_range);

            if (count($dates) === 2) {
                $start = $dates[0];
                $end = $dates[1];

                $query->whereHas('items', function ($q) use ($start, $end) {
                    $q->whereDate('billing_cycle', '>=', $start)
                        ->whereDate('billing_cycle', '<=', $end);
                });
            }
        }



        $billings = $query->latest()->paginate(10)->withQueryString();

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

    public function exportExcel(Request $request)
    {
        return Excel::download(new BillingExport($request), 'billing-export.xlsx');
    }
}
