<?php

namespace App\Http\Controllers\UserBilling;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\DataClients;

class UserAuthController extends Controller
{
    public function showStep1()
    {
        return view('client.auth.index');
    }

    public function processStep1(Request $request)
    {
        $request->validate([
            'no_hp' => 'required|string'
        ]);

        $client = DataClients::where('no_hp', $request->no_hp)->first();

        if (!$client) {
            return back()->withErrors(['no_hp' => 'Nomor HP tidak ditemukan'])->withInput();
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
            'nama_akhir' => 'required|string'
        ]);

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
