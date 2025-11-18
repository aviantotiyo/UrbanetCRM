<?php

namespace App\Http\Controllers\UserRegist;

use App\Models\DataPaket;
use App\Models\DataClients;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DataClientsSales;
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

        // Path file JSON (di public/assets/json/...)
        $provPath = public_path('assets/json/provinsi.json');
        $kabPath  = public_path('assets/json/kabupaten.json');
        $kecPath  = public_path('assets/json/kecamatan.json');

        $readJson = function (string $path): array {
            if (!is_file($path)) return [];
            $raw = file_get_contents($path);
            $data = json_decode($raw, true);
            return is_array($data) ? $data : [];
        };

        $provinsiRaw  = $readJson($provPath);   // [ {id, name, ...}, ... ]
        $kabupatenRaw = $readJson($kabPath);    // [ {id, province_id, name, ...}, ... ]
        $kecamatanRaw = $readJson($kecPath);    // [ {id, regency_id,  name, ...}, ... ]

        // urutkan A-Z
        usort($provinsiRaw,  fn($a, $b) => strcmp($a['name'] ?? '', $b['name'] ?? ''));
        usort($kabupatenRaw, fn($a, $b) => strcmp($a['name'] ?? '', $b['name'] ?? ''));
        usort($kecamatanRaw, fn($a, $b) => strcmp($a['name'] ?? '', $b['name'] ?? ''));

        // Ambil paket aktif dan tayang
        $paketList = DataPaket::where('active', 1)
            ->where('tayang', 1)
            ->orderBy('nama_paket')
            ->get(['id', 'nama_paket', 'harga']);

        return view('client.regist.index', compact(
            'paketList',
            'provinsiRaw',
            'kabupatenRaw',
            'kecamatanRaw',
        ));
    }

    /**
     * Simpan data registrasi ke DataClientsProspect
     */

    public function store(Request $request)
    {
        // Validasi awal
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

        // Cek duplikasi
        $existsInClients = DataClients::where('no_hp', $validated['no_hp'])
            ->orWhere('nik', $validated['nik'])->exists();
        $existsInRegist = DataClientsRegist::where('no_hp', $validated['no_hp'])
            ->orWhere('nik', $validated['nik'])->exists();
        $existsInProspect = DataClientsProspect::where('no_hp', $validated['no_hp'])
            ->orWhere('nik', $validated['nik'])->exists();
        $existsInSales = DataClientsSales::where('no_hp', $validated['no_hp'])
            ->orWhere('nik', $validated['nik'])->exists();

        if ($existsInClients || $existsInRegist || $existsInProspect || $existsInSales) {
            return back()
                ->with('error', 'Nomor HP atau NIK sudah terdaftar.')
                ->withInput();
        }

        // Validasi Google reCAPTCHA
        try {

            $recaptchaResponse = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => config('services.recaptcha.secret_key'),
                'response' => $validated['g-recaptcha-response'],
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

        // Validasi email (opsional)
        if (!empty($validated['email'])) {
            $apiKey = config('services.debounce.api_key');

            try {
                $response = Http::get('https://api.debounce.io/v1/', [
                    'api' => $apiKey,
                    'email' => $validated['email']
                ]);

                if ($response->failed()) {
                    return back()->withErrors(['email' => 'Gagal memverifikasi email.'])->withInput();
                }

                $result = $response->json();
                $code = $result['debounce']['code'] ?? null;

                if ($code !== "5") {
                    return back()->withErrors(['email' => 'Email tidak valid atau tidak dapat diverifikasi.'])->withInput();
                }
            } catch (\Exception $e) {
                return back()->withErrors(['email' => 'Terjadi kesalahan saat verifikasi email.'])->withInput();
            }
        }

        // Simpan data
        DataClientsRegist::create([
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
