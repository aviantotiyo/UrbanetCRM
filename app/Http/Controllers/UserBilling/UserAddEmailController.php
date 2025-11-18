<?php

namespace App\Http\Controllers\UserBilling;

use App\Models\DataClients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class UserAddEmailController extends Controller
{
    public function showForm()
    {
        $clientId = session('client_auth_id');
        $client = DataClients::findOrFail($clientId);

        // Cek jika email sudah ada → redirect ke dashboard
        if (!is_null($client->email)) {
            return redirect()->route('client.dashboard');
        }

        return view('client.auth.add_email',  compact('client'));
    }

    public function storeEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $email = trim($request->email);
        $apiKey = config('services.debounce.api_key');

        try {
            // === 🔍 Panggil API Debounce ===
            $response = Http::get('https://api.debounce.io/v1/', [
                'api' => $apiKey,
                'email' => $email
            ]);

            if ($response->failed()) {
                return back()->withErrors(['email' => 'Gagal memverifikasi email. Coba lagi nanti.']);
            }

            $result = $response->json();

            // === 🧠 Validasi hasil ===
            $code = $result['debounce']['code'] ?? null;
            $status = $result['debounce']['result'] ?? 'Unknown';

            // Code 5 berarti valid
            if ($code !== "5") {
                return back()->withErrors([
                    'email' => "Email tidak valid atau tidak dapat diverifikasi."
                ])->withInput();
            }

            // === ✅ Simpan ke database ===
            $clientId = session('client_auth_id');
            $client = DataClients::findOrFail($clientId);
            $client->email = $email;
            $client->save();

            return redirect()
                ->route('client.dashboard')
                ->with('success', 'Email berhasil diverifikasi dan disimpan. Silakan lanjutkan pembayaran.');
        } catch (\Throwable $e) {
            Log::error('Email validation error: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Terjadi kesalahan saat memverifikasi email.'])->withInput();
        }
    }
}
