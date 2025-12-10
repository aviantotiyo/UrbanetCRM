<?php

namespace App\Http\Controllers\Komisi;

use App\Http\Controllers\Controller;
use App\Models\DataClientsPartner;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PartnerKomisiController extends Controller
{
    public function index()
    {
        $data = DataClientsPartner::with(['partner', 'paket'])
            ->where('status', 'active')
            ->where('fee_paid', 0)
            ->latest()
            ->paginate(20);

        return view('finance.komisi_partner.index', compact('data'));
    }

    public function paidList()
    {
        $data = DataClientsPartner::with(['partner', 'paket'])
            ->where('status', 'active')
            ->where('fee_paid', 1)
            ->latest()
            ->paginate(20);

        return view('finance.komisi_partner.paid', compact('data'));
    }

    public function markAsPaidMultiple(Request $request)
    {
        $request->validate([
            'selected_ids' => 'required|array',
        ]);

        DataClientsPartner::whereIn('id', $request->selected_ids)
            ->update([
                'fee_paid' => 1,
                'fee_date_paid' => Carbon::now(),
            ]);

        return redirect()->route('admin.komisi_mitra.paidList')->with('success', 'Komisi mitra berhasil ditandai sebagai sudah dibayar.');
    }
}
