<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\DataClients;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;


class PelangganController extends Controller
{
    /**
     * Tampilkan 20 data pelanggan terbaru.
     */
    public function index()
    {
        // ambil 20 data paling baru
        $clients = DataClients::orderByDesc('created_at')
            ->limit(20)
            ->get();

        // jika kamu belum punya view, sementara bisa return JSON:
        // return response()->json($clients);

        // pakai view (disarankan)
        return view('admin.pelanggan.index', compact('clients'));
    }


    public function create()
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

        return view('admin.pelanggan.tambah', compact('provinsiRaw', 'kabupatenRaw', 'kecamatanRaw'));
    }

    public function store(Request $request)
    {
        // Validasi input utama
        $validated = $request->validate([
            'nama'         => ['required', 'string', 'max:255'],
            'no_hp'        => ['nullable', 'string', 'max:50', Rule::unique('data_clients', 'no_hp')],
            'email'        => ['nullable', 'email', 'max:255'],
            'nik'          => ['nullable', 'string', 'max:32', Rule::unique('data_clients', 'nik')],
            'alamat'       => ['nullable', 'string', 'max:255'],
            'kecamatan'    => ['nullable', 'string', 'max:100'],
            'kabupaten'    => ['nullable', 'string', 'max:100'],
            'provinsi'     => ['nullable', 'string', 'max:100'],
            'loc_client'   => ['nullable', 'string', 'max:255'],
            'paket'        => ['nullable', 'string', 'max:255'],
            'tagihan'      => ['nullable', 'string', 'max:64'],

            // user_pppoe TIDAK diambil dari request — akan diisi = nopel
            // 'user_pppoe' => otomatis dari $nopel
            // 'pass_pppoe' => random 6 digit

            'name_profile' => ['nullable', 'string', 'max:255'],
            'limit_radius' => ['nullable', 'string', 'max:255'],
            'odp_id'       => ['nullable', 'string', 'max:255'],
            'odp_port_id'  => ['nullable', 'string', 'max:255'],
            'tag'          => ['nullable', 'string', 'max:255'],
            'active_user'  => ['nullable', 'date'],
            'status'       => ['required', Rule::in(['active', 'isolir', 'suspend', 'inactive', 'booking'])],
            'note'         => ['nullable', 'string'],
            'foto_depan'   => ['nullable', 'string', 'max:255'],
        ]);

        // Generate NOPel unik: AAA-12345678
        $nopel = $this->generateUniqueNopel();

        // user_pppoe harus sama dengan nopel
        $userPppoe = $nopel;

        // pass_pppoe = angka acak 6 digit
        $passPppoe = (string) random_int(100000, 999999);

        // Simpan
        $client = DataClients::create([
            'nopel'         => $nopel,
            'nama'          => $validated['nama'],
            'no_hp'         => $validated['no_hp'] ?? null,
            'email'         => $validated['email'] ?? null,
            'nik'           => $validated['nik'] ?? null,
            'alamat'        => $validated['alamat'] ?? null,
            'kecamatan'     => $validated['kecamatan'] ?? null,
            'kabupaten'     => $validated['kabupaten'] ?? null,
            'provinsi'      => $validated['provinsi'] ?? null,
            'loc_client'    => $validated['loc_client'] ?? null,
            'paket'         => $validated['paket'] ?? null,
            'tagihan'       => $validated['tagihan'] ?? null,
            'user_pppoe'    => $userPppoe,
            'pass_pppoe'    => $passPppoe,
            'name_profile'  => $validated['name_profile'] ?? null,
            'limit_radius'  => $validated['limit_radius'] ?? null,
            'odp_id'        => $validated['odp_id'] ?? null,
            'odp_port_id'   => $validated['odp_port_id'] ?? null,
            'tag'           => $validated['tag'] ?? null,
            'active_user'   => $validated['active_user'] ?? null,
            'status'        => $validated['status'],
            'note'          => $validated['note'] ?? null,
            'foto_depan'    => $validated['foto_depan'] ?? null,
        ]);

        return redirect()
            ->route('admin.pelanggan.index')
            ->with('success', 'Pelanggan berhasil ditambahkan. NoPel: ' . $client->nopel . ' (PPPoE: ' . $userPppoe . ')');
    }

    /**
     * Generate NoPel unik: ID12345678
     */
    private function generateUniqueNopel(): string
    {
        do {
            // 8 digit (boleh leading zero), lebih aman pakai str_pad
            $number = str_pad((string) random_int(0, 99999999), 8, '0', STR_PAD_LEFT);
            $code   = 'ID' . $number;
        } while (\App\Models\DataClients::where('nopel', $code)->exists());

        return $code;
    }


    public function show(string $id)
    {
        $client = DataClients::find($id);

        if (!$client) {
            abort(404, 'Data pelanggan tidak ditemukan.');
        }

        return view('admin.pelanggan.detail', compact('client'));
    }
}
