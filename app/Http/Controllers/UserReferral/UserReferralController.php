<?php

namespace App\Http\Controllers\UserReferral;

use App\Models\DataClients;
use App\Models\DataSetting;
use App\Models\DataPaket;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DataClientsProspect;
use App\Http\Controllers\Controller;

class UserReferralController extends Controller
{
    // Tampilkan semua data referral milik client yang sedang login
    public function index()
    {
        $clientId = session('client_auth_id');
        $client = DataClients::findOrFail($clientId);
        $setting = DataSetting::first(); // ambil baris pertama (asumsi 1 data saja)
        $point = $setting ? $setting->point : 0;

        $referrals = DataClientsProspect::where('client_id', $clientId)
            ->latest() // urutkan berdasarkan created_at desc
            ->take(10) // ambil maksimal 10
            ->get();

        return view('client.referral.index', compact('client', 'referrals', 'point'));
    }

    // Tampilkan form tambah referral
    public function create()
    {
        $clientId = session('client_auth_id');
        $client = DataClients::findOrFail($clientId);

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

        $paketList = DataPaket::where('active', 1)
            ->where('tayang', 1)
            ->orderBy('nama_paket')
            ->get(['id', 'nama_paket', 'harga']);

        return view('client.referral.tambah', compact(
            'client',
            'paketList',
            'provinsiRaw',
            'kabupatenRaw',
            'kecamatanRaw',
        ));
    }

    // Simpan data referral baru
    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'no_hp'     => [
                'required',
                'string',
                'max:20',
                function ($attribute, $value, $fail) {
                    $existsClient = DB::table('data_clients')->where('no_hp', $value)->exists();
                    $existsProspect = DB::table('data_clients_prospect')->where('no_hp', $value)->exists();

                    if ($existsClient || $existsProspect) {
                        $fail('Nomor HP sudah terdaftar di sistem.');
                    }
                },
            ],
            'nik'     => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    $existsClient = DB::table('data_clients')->where('nik', $value)->exists();
                    $existsProspect = DB::table('data_clients_prospect')->where('nik', $value)->exists();

                    if ($existsClient || $existsProspect) {
                        $fail('NIK sudah terdaftar di sistem.');
                    }
                },
            ],
            'alamat'    => 'nullable|string',
            'kecamatan' => 'nullable|string|max:100',
            'kabupaten' => 'nullable|string|max:100',
            'provinsi'  => 'nullable|string|max:100',
            'paket_id'   => 'required|uuid|exists:data_paket,id',
        ]);

        $clientId = session('client_auth_id');

        DataClientsProspect::create([
            'id'                => Str::uuid(),
            'paket_id'   => $request['paket_id'],
            'client_id'         => $clientId,
            'nama'              => $request->nama,
            'nik'              => $request->nik,
            'no_hp'             => $request->no_hp,
            'alamat'            => $request->alamat,
            'kecamatan'         => $request->kecamatan,
            'kabupaten'         => $request->kabupaten,
            'provinsi'          => $request->provinsi,
            'point'             => 0,
            'status'            => 'pending',
            'client_prospect_id' => Str::uuid(),
        ]);

        return redirect()->route('client.referral.index')->with('success', 'Data referral berhasil ditambahkan.');
    }
}
