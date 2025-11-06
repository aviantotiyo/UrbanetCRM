<?php

namespace App\Http\Controllers\UserRegist;

use App\Models\DataPaket;
use App\Models\DataClients;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DataClientsRegist;
use App\Models\DataClientsProspect;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class UserRegistController extends Controller
{
    /**
     * Tampilkan form registrasi
     */
    public function index()
    {
        // Ambil paket aktif dan tayang
        $paketList = DataPaket::where('active', 1)
            ->where('tayang', 1)
            ->orderBy('nama_paket')
            ->get(['id', 'nama_paket', 'harga']);

        return view('client.regist.index', compact('paketList'));
    }

    /**
     * Simpan data registrasi ke DataClientsProspect
     */

    public function store(Request $request)
    {
        Log::debug('📥 Form submitted', [
            'ip' => $request->ip(),
            'input' => $request->all(),
        ]);

        try {
            // ✅ Validasi awal
            $validated = $request->validate([
                'nama'       => 'required|string|max:255',
                'no_hp'      => 'required|string|max:20',
                'nik'        => 'required|string|max:20',
                'email'      => 'nullable|email|max:255',
                'alamat'     => 'nullable|string|max:255',
                'provinsi'   => 'required|string|max:100',
                'kabupaten'  => 'required|string|max:100',
                'kecamatan'  => 'required|string|max:100',
                'paket_id'   => 'required|uuid|exists:data_paket,id',
                'g-recaptcha-response' => 'required|string',
            ]);
            Log::debug('✅ Validasi form sukses', $validated);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('❌ Validasi form gagal', [
                'errors' => $e->errors(),
            ]);
            throw $e;
        }

        // 🔄 Validasi no_hp & nik
        $existsInClients = DataClients::where('no_hp', $validated['no_hp'])
            ->orWhere('nik', $validated['nik'])->exists();
        $existsInRegist = DataClientsRegist::where('no_hp', $validated['no_hp'])
            ->orWhere('nik', $validated['nik'])->exists();
        $existsInProspect = DataClientsProspect::where('no_hp', $validated['no_hp'])
            ->orWhere('nik', $validated['nik'])->exists();

        if ($existsInClients || $existsInRegist || $existsInProspect) {
            Log::warning('❌ Duplikasi ditemukan', [
                'no_hp' => $validated['no_hp'],
                'nik'   => $validated['nik'],
            ]);
            return back()
                ->withErrors(['no_hp' => 'Nomor HP atau NIK sudah terdaftar.'])
                ->withInput();
        }

        // 🔐 Validasi Google reCAPTCHA
        try {
            $recaptchaSecret = env('RECAPTCHA_SECRET_KEY');

            $recaptchaResponse = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret'   => $recaptchaSecret,
                'response' => $validated['g-recaptcha-response'],
                'remoteip' => $request->ip(),
            ]);

            $recaptcha = $recaptchaResponse->json();

            Log::debug('🔐 Hasil reCAPTCHA', $recaptcha);

            if (!($recaptcha['success'] ?? false) || ($recaptcha['score'] ?? 0) < 0.5) {
                Log::warning('❌ Verifikasi reCAPTCHA gagal');
                return back()
                    ->withErrors(['email' => 'Verifikasi reCAPTCHA gagal. Silakan coba lagi.'])
                    ->withInput();
            }
        } catch (\Exception $e) {
            Log::error('❌ Exception saat verifikasi reCAPTCHA', ['error' => $e->getMessage()]);
            return back()
                ->withErrors(['email' => 'Gagal memverifikasi reCAPTCHA.'])
                ->withInput();
        }

        // 📧 Validasi email (opsional)
        if (!empty($validated['email'])) {
            $apiKey = env('KEY_DEBOUNCE');

            try {
                $response = Http::get('https://api.debounce.io/v1/', [
                    'api' => $apiKey,
                    'email' => $validated['email']
                ]);

                if ($response->failed()) {
                    Log::warning('❌ Debounce gagal merespons');
                    return back()->withErrors(['email' => 'Gagal memverifikasi email.'])->withInput();
                }

                $result = $response->json();
                $code = $result['debounce']['code'] ?? null;

                Log::debug('📧 Hasil Debounce', $result);

                if ($code !== "5") {
                    return back()->withErrors(['email' => 'Email tidak valid atau tidak dapat diverifikasi.'])->withInput();
                }
            } catch (\Exception $e) {
                Log::error('❌ Exception Debounce', ['error' => $e->getMessage()]);
                return back()->withErrors(['email' => 'Terjadi kesalahan saat verifikasi email.'])->withInput();
            }
        }

        // ✅ Simpan data
        $data = DataClientsRegist::create([
            'id'         => (string) Str::uuid(),
            'nama'       => $validated['nama'],
            'no_hp'      => $validated['no_hp'],
            'nik'        => $validated['nik'],
            'email'      => $validated['email'] ?? null,
            'alamat'     => $validated['alamat'] ?? null,
            'provinsi'   => $validated['provinsi'],
            'kabupaten'  => $validated['kabupaten'],
            'kecamatan'  => $validated['kecamatan'],
            'paket_id'   => $validated['paket_id'],
            'status'     => 'pending',
            'created_at' => now(),
        ]);

        Log::info('✅ Registrasi berhasil', ['id' => $data->id]);

        return redirect()->route('client.regist.success');
    }



    /**
     * Halaman sukses
     */
    public function success()
    {
        return view('client.regist.success');
    }
}
