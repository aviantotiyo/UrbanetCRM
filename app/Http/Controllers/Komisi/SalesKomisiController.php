<?php

namespace App\Http\Controllers\Komisi;

use App\Http\Controllers\Controller;
use App\Models\DataClientsSales;
use Illuminate\Http\Request;

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
}
