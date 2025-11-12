<?php

namespace App\Http\Controllers\Partner;

use App\Models\DataBilling;
use App\Models\DataClients;
use App\Models\DataPartner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
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
            'g-recaptcha-response' => 'required|string',
        ]);

        try {
            $recaptchaSecret = env('RECAPTCHA_SECRET_KEY');

            $recaptchaResponse = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret'   => $recaptchaSecret,
                'response' => $request['g-recaptcha-response'],
                'remoteip' => $request->ip(),
            ]);

            $recaptcha = $recaptchaResponse->json();

            if (!($recaptcha['success'] ?? false) || ($recaptcha['score'] ?? 0) < 0.5) {
                return back()
                    ->withErrors(['email' => 'Verifikasi reCAPTCHA gagal. Silakan coba lagi.'])
                    ->withInput();
            }
        } catch (\Exception $e) {
            return back()
                ->withErrors(['email' => 'Gagal memverifikasi reCAPTCHA.'])
                ->withInput();
        }

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

    public function checkBillingByNoHP(Request $request)
    {
        $request->validate([
            'no_hp' => 'required|string'
        ]);

        $noHp = $request->no_hp;

        $partner = DataPartner::findOrFail(session('partner_auth_id'));
        $client = DataClients::where('no_hp', $noHp)->first();

        if (!$client) {
            return redirect()->back()->withErrors(['no_hp' => 'Nomor HP tidak ditemukan.'])->withInput();
        }

        // Cek apakah ada tagihan UNPAID yang sedang diproses agen lain (bank_check = 1)
        $inProcessBilling = DataBilling::where('client_id', $client->id)
            ->where('status', 'UNPAID')
            ->where('bank_check', 1)
            ->exists();

        if ($inProcessBilling) {
            return redirect()->back()->with('info', 'Tagihan sedang diproses agen lainnya.');
        }

        // Ambil semua tagihan UNPAID
        $billings = DataBilling::where('client_id', $client->id)
            ->where('status', 'UNPAID')
            ->get();

        if ($billings->isEmpty()) {
            return redirect()->back()->with('info', 'Tidak ada tagihan untuk nomor ini.');
        }

        return redirect()->route('partner.user.billing', ['no_hp' => $noHp]);
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
