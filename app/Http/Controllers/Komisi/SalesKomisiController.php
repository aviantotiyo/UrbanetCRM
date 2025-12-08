<?php

namespace App\Http\Controllers\Komisi;

use App\Http\Controllers\Controller;
use App\Models\DataClientsSales;
use Illuminate\Http\Request;
use App\Exports\KomisiSalesExport;
use Maatwebsite\Excel\Facades\Excel;

class SalesKomisiController extends Controller
{
    public function index()
    {
        $data = DataClientsSales::with(['user:id,name,role', 'paket:id,nama_paket,harga'])
            ->where('status', 'active')
            ->where('fee_paid', 0)
            ->paginate(10);

        return view('admin.komisi_sales.index', compact('data'));
    }

    public function paidList()
    {
        $data = DataClientsSales::with(['user:id,name,role', 'paket:id,nama_paket,harga'])
            ->where('status', 'active')
            ->where('fee_paid', 1)
            ->paginate(10);

        return view('admin.komisi_sales.paid', compact('data'));
    }

    public function markAsPaid($id)
    {
        $client = DataClientsSales::findOrFail($id);

        $client->update([
            'fee_paid' => 1,
            'fee_date_paid' => now(),
        ]);

        return redirect()->route('admin.komisi_sales.paidList')->with('success', 'Komisi berhasil ditandai sebagai sudah dibayar.');
    }

    public function markAsPaidMultiple(Request $request)
    {
        // dd($request->all());
        $ids = $request->input('selected_ids');

        if (!$ids || !is_array($ids)) {
            return redirect()->back()->with('error', 'Tidak ada data yang dipilih.');
        }

        DataClientsSales::whereIn('id', $ids)->update([
            'fee_paid' => 1,
            'fee_date_paid' => now(),
        ]);

        return redirect()->route('admin.komisi_sales.paidList')->with('success', 'Data berhasil ditandai sebagai dibayar.');
    }

    public function exportExcel()
    {
        return Excel::download(new KomisiSalesExport, 'komisi_sales_dibayar.xlsx');
    }
}
