<?php

namespace App\Http\Controllers\Odc;

use App\Http\Controllers\Controller;
use App\Models\DataOdc;
use App\Models\DataServer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OdcController extends Controller
{
    public function index()
    {
        $odcs = DataOdc::with('server')
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('admin.odc.index', compact('odcs'));
    }

    /**
     * Form tambah ODC
     */
    public function create()
    {
        $servers = DataServer::orderBy('nama_pop')->get(['id', 'nama_pop', 'ip_public']);

        // === Load JSON wilayah ===
        $provPath = public_path('assets/json/provinsi.json');
        $kabPath  = public_path('assets/json/kabupaten.json');
        $kecPath  = public_path('assets/json/kecamatan.json');

        $readJson = function (string $path): array {
            if (!is_file($path)) return [];
            $raw = file_get_contents($path);
            $data = json_decode($raw, true);
            return is_array($data) ? $data : [];
        };

        $provinsiRaw  = $readJson($provPath);   // [{id,name,...}]
        $kabupatenRaw = $readJson($kabPath);    // [{id,province_id,name,...}]
        $kecamatanRaw = $readJson($kecPath);    // [{id,regency_id,name,...}]

        // (opsional) urutkan by name
        usort($provinsiRaw,  fn($a, $b) => strcmp($a['name'] ?? '', $b['name'] ?? ''));
        usort($kabupatenRaw, fn($a, $b) => strcmp($a['name'] ?? '', $b['name'] ?? ''));
        usort($kecamatanRaw, fn($a, $b) => strcmp($a['name'] ?? '', $b['name'] ?? ''));

        return view('admin.odc.tambah', compact(
            'servers',
            'provinsiRaw',
            'kabupatenRaw',
            'kecamatanRaw'
        ));
    }

    /**
     * Simpan ODC baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'server_id'    => ['nullable', 'uuid', Rule::exists('data_server', 'id')],
            'kode_odc'     => ['required', 'string', 'max:191', 'unique:data_odc,kode_odc'],
            'nama_odc'     => ['nullable', 'string', 'max:191'],

            'alamat' => ['nullable', 'string', 'max:150'],
            'prov'   => ['nullable', 'string', 'max:150'],
            'kota'   => ['nullable', 'string', 'max:150'],
            'kec'    => ['nullable', 'string', 'max:150'],
            'desa'   => ['nullable', 'string', 'max:150'],
            'loc_odp' => ['nullable', 'string', 'max:150'],
            'lat'    => ['nullable', 'string', 'max:150'],
            'long'   => ['nullable', 'string', 'max:150'],

            'port_cap'     => ['nullable', 'string', 'max:50'],
            'port_install' => ['nullable', 'string', 'max:50'],
            'rasio'        => ['nullable', 'string', 'max:50'],
            'warna_core'   => ['nullable', 'string', 'max:100'],
            'core_cable'   => ['nullable', 'string', 'max:100'],
            'note'         => ['nullable', 'string'],
            'image'        => ['nullable', 'string', 'max:255'],
        ]);

        DataOdc::create($validated);

        return redirect()
            ->route('admin.odc.index')
            ->with('success', 'ODC berhasil ditambahkan.');
    }

    /**
     * Form edit ODC
     */
    public function edit(string $id)
    {
        $odc = DataOdc::find($id);
        if (!$odc) {
            abort(404, 'Data ODC tidak ditemukan.');
        }

        $servers = DataServer::orderBy('nama_pop')->get(['id', 'nama_pop', 'ip_public']);

        // === Load JSON wilayah (untuk Select2 filter) ===
        $provPath = public_path('assets/json/provinsi.json');
        $kabPath  = public_path('assets/json/kabupaten.json');
        $kecPath  = public_path('assets/json/kecamatan.json');

        $readJson = function (string $path): array {
            if (!is_file($path)) return [];
            $raw = file_get_contents($path);
            $data = json_decode($raw, true);
            return is_array($data) ? $data : [];
        };

        $provinsiRaw  = $readJson($provPath);
        $kabupatenRaw = $readJson($kabPath);
        $kecamatanRaw = $readJson($kecPath);

        usort($provinsiRaw,  fn($a, $b) => strcmp($a['name'] ?? '', $b['name'] ?? ''));
        usort($kabupatenRaw, fn($a, $b) => strcmp($a['name'] ?? '', $b['name'] ?? ''));
        usort($kecamatanRaw, fn($a, $b) => strcmp($a['name'] ?? '', $b['name'] ?? ''));

        return view('admin.odc.edit', compact(
            'odc',
            'servers',
            'provinsiRaw',
            'kabupatenRaw',
            'kecamatanRaw'
        ));
    }

    /**
     * Update ODC
     */
    public function update(Request $request, string $id)
    {
        $odc = DataOdc::find($id);
        if (!$odc) {
            abort(404, 'Data ODC tidak ditemukan.');
        }

        $validated = $request->validate([
            'server_id'    => ['nullable', 'uuid', Rule::exists('data_server', 'id')],
            'kode_odc'     => ['required', 'string', 'max:191', Rule::unique('data_odc', 'kode_odc')->ignore($odc->id)],
            'nama_odc'     => ['nullable', 'string', 'max:191'],

            'alamat' => ['nullable', 'string', 'max:150'],
            'prov'   => ['nullable', 'string', 'max:150'],
            'kota'   => ['nullable', 'string', 'max:150'],
            'kec'    => ['nullable', 'string', 'max:150'],
            'desa'   => ['nullable', 'string', 'max:150'],
            'loc_odp' => ['nullable', 'string', 'max:150'],
            'lat'    => ['nullable', 'string', 'max:150'],
            'long'   => ['nullable', 'string', 'max:150'],

            'port_cap'     => ['nullable', 'string', 'max:50'],
            'port_install' => ['nullable', 'string', 'max:50'],
            'rasio'        => ['nullable', 'string', 'max:50'],
            'warna_core'   => ['nullable', 'string', 'max:100'],
            'core_cable'   => ['nullable', 'string', 'max:100'],
            'note'         => ['nullable', 'string'],
            'image'        => ['nullable', 'string', 'max:255'],
        ]);

        $odc->update($validated);

        return redirect()
            ->route('admin.odc.index')
            ->with('success', 'ODC berhasil diperbarui.');
    }

    public function show(string $id)
    {
        $odc = \App\Models\DataOdc::with([
            'server',
            'ports' => fn($q) => $q->orderBy('port_numb'),
            'ports.odp',
        ])->find($id);

        if (!$odc) {
            abort(404, 'Data ODC tidak ditemukan.');
        }

        return view('admin.odc.detail', compact('odc'));
    }
}
