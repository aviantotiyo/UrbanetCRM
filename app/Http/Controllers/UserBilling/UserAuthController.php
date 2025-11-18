<?php

namespace App\Http\Controllers\UserBilling;

use App\Models\DataClients;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class UserAuthController extends Controller
{
    public function showStep1()
    {
        return view('client.auth.index');
    }

    public function processStep1(Request $request)
    {
        $request->validate([
            'no_hp' => 'required|string',
            // 'g-recaptcha-response' => 'required',
        ]);

        // $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
        //     'secret'   => env('RECAPTCHA_SECRET_KEY'),
        //     'response' => $request->input('g-recaptcha-response'),
        //     'remoteip' => $request->ip(),
        // ]);

        // $result = $response->json();
        // if (!($result['success'] ?? false) || ($result['score'] ?? 0) < 0.5) {
        //     return back()->withErrors(['recaptcha' => 'Verifikasi reCAPTCHA gagal.'])->withInput();
        // }

        $input = $request->no_hp;

        // Coba cari berdasarkan no_hp atau nopel
        $client = DataClients::where('no_hp', $input)
            ->orWhere('nopel', $input)
            ->first();

        if (!$client) {
            return back()->withErrors([
                'no_hp' => 'Nomor HP atau No. Pelanggan tidak ditemukan'
            ])->withInput();
        }

        // Simpan session sementara
        session([
            'client_auth_id' => $client->id,
            'client_auth_step1' => true
        ]);

        return redirect()->route('client.auth.step2');
    }


    public function showStep2()
    {
        if (!session('client_auth_step1') || !session('client_auth_id')) {
            return redirect()->route('client.auth.step1');
        }

        return view('client.auth.verification');
    }

    public function processStep2(Request $request)
    {
        if (!session('client_auth_step1') || !session('client_auth_id')) {
            return redirect()->route('client.auth.step1');
        }

        $request->validate([
            'nama_akhir' => 'required|string',
            // 'g-recaptcha-response' => 'required',
        ]);


        // $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
        //     'secret'   => env('RECAPTCHA_SECRET_KEY'),
        //     'response' => $request->input('g-recaptcha-response'),
        //     'remoteip' => $request->ip(),
        // ]);

        // $result = $response->json();
        // if (!($result['success'] ?? false) || ($result['score'] ?? 0) < 0.5) {
        //     return back()->withErrors(['recaptcha' => 'Verifikasi reCAPTCHA gagal.'])->withInput();
        // }

        $client = DataClients::find(session('client_auth_id'));

        $namaParts = explode(' ', strtolower($client->nama));
        $namaAkhir = strtolower(trim($request->nama_akhir));

        if (end($namaParts) !== $namaAkhir) {
            return back()->withErrors(['nama_akhir' => 'Nama akhir tidak cocok'])->withInput();
        }

        // Autentikasi berhasil
        session(['client_authenticated' => true]);

        return redirect()->route('client.dashboard');
    }

    public function logout()
    {
        session()->forget([
            'client_auth_id',
            'client_auth_step1',
            'client_authenticated'
        ]);

        return redirect()->route('client.auth.step1');
    }
}
