<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\DataClientsPartner;
use App\Models\DataPartner;

class ClientDetailController extends Controller
{
    public function show($id)
    {
        $partnerId = Session::get('partner_auth_id');
        $partner = DataPartner::find($partnerId);

        if (!$partner) {
            return redirect()->route('partner.login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Ambil client milik partner ini
        $client = DataClientsPartner::where('id', $id)
            ->where('partner_id', $partner->id)
            ->first();

        if (!$client) {
            return redirect()->back()->with('error', 'Data tidak ditemukan atau bukan milik Anda.');
        }

        return view('partner.add_client.detail', compact('client', 'partner'));
    }
}
