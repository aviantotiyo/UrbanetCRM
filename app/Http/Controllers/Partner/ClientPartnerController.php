<?php

namespace App\Http\Controllers\Partner;

use App\Models\DataPartner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ClientPartnerController extends Controller
{
    public function showLoginForm()
    {
        return view('partner.auth');
    }

    public function login(Request $request)
    {
        $request->validate([
            'no_hp' => 'required|string',
            'password' => 'required|string',
        ]);

        $partner = DataPartner::where('no_hp', $request->no_hp)->first();

        if (!$partner || !Hash::check($request->password, $partner->password)) {
            return back()->withErrors(['no_hp' => 'No HP atau password salah'])->withInput();
        }

        if ($partner->status !== 'active') {
            return back()->withErrors(['no_hp' => 'Akun belum aktif'])->withInput();
        }

        Session::put('partner_auth_id', $partner->id);
        Session::put('partner_role', 'mitra');

        return redirect()->route('partner.dashboard');
    }

    public function loginWithToken($secret_token)
    {
        $partner = DataPartner::where('secret_token', $secret_token)->first();

        if (!$partner || $partner->status !== 'active') {
            return redirect()->route('partner.login')->withErrors(['no_hp' => 'Token tidak valid atau akun tidak aktif.']);
        }

        Session::put('partner_auth_id', $partner->id);
        Session::put('partner_role', 'mitra');

        return redirect()->route('partner.dashboard');
    }


    public function dashboard()
    {
        $partner = DataPartner::findOrFail(session('partner_auth_id'));
        return view('partner.dashboard', compact('partner'));
    }

    public function logout()
    {
        Session::forget(['partner_auth_id', 'partner_role']);
        return redirect('/mitra');
    }
}
