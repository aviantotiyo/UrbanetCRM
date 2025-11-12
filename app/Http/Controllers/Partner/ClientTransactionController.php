<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\DataPartner;
use App\Models\DataBilling;

class ClientTransactionController extends Controller
{
    public function index()
    {
        // Validasi session partner
        $partnerId = Session::get('partner_auth_id');
        $partner = DataPartner::findOrFail($partnerId);

        // Ambil transaksi terbaru milik partner ini dengan pagination
        $billings = DataBilling::with('client')
            ->where('partner_id', $partnerId)
            ->orderBy('created_at', 'desc')
            ->paginate(15); // Ganti 10 sesuai kebutuhan

        return view('partner.transaksi', compact('partner', 'billings'));
    }
}
