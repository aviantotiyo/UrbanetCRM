<?php

namespace App\Http\Controllers\Komisi;

use App\Http\Controllers\Controller;
use App\Models\DataClientsPartner;
use Illuminate\Http\Request;

class PartnerKomisiController extends Controller
{
    public function index()
    {
        $data = DataClientsPartner::with(['partner', 'paket'])
            ->where('status', 'active')
            ->latest()
            ->paginate(20);

        return view('finance.komisi_partner.index', compact('data'));
    }
}
