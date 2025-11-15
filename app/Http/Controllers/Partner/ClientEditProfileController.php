<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataPartner;
use Illuminate\Support\Facades\Session;

class ClientEditProfileController extends Controller
{
    public function edit()
    {
        $partner = DataPartner::findOrFail(session('partner_auth_id'));

        return view('partner.account', compact('partner'));
    }

    public function deactivate(Request $request)
    {
        $partner = DataPartner::findOrFail(session('partner_auth_id'));
        $partner->status = 'inactive';
        $partner->save();

        // Hapus session dan redirect
        Session::forget(['partner_auth_id', 'partner_role']);
        return redirect('/mitra')->with('error', 'Saat ini akun telah tidak aktif. Dan hak akses di tutup.');
    }
}
