<?php

namespace App\Http\Controllers\Odp;

use App\Http\Controllers\Controller;
use App\Models\DataOdp;
use App\Models\DataServer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OdpController extends Controller
{
    /**
     * List ODP (terbaru dulu), paginate 20.
     */
    // app/Http/Controllers/Odp/OdpController.php

    public function index()
    {
        $odps = \App\Models\DataOdp::withCount('ports')
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('admin.odp.index', compact('odps'));
    }


    /**
     * Tampilkan form tambah ODP.
     */

    public function create()
    {
        // Path file JSON (public/assets/json/...)
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
        $kecamatanRaw = $readJson($kecPath);    // [ {id, regency_id, name, ...}, ... ]

        // Kita kirim raw ke view (akan difilter di JS)
        // Optional: sort by name
        usort($provinsiRaw,  fn($a, $b) => strcmp($a['name'] ?? '', $b['name'] ?? ''));
        usort($kabupatenRaw, fn($a, $b) => strcmp($a['name'] ?? '', $b['name'] ?? ''));
        usort($kecamatanRaw, fn($a, $b) => strcmp($a['name'] ?? '', $b['name'] ?? ''));

        // ====== Tambahan: ambil daftar server untuk dropdown ======
        $servers = DataServer::orderBy('nama_pop')
            ->get(['id', 'nama_pop', 'ip_public', 'lokasi']);

        return view('admin.odp.tambah', [
            'provinsiRaw'  => $provinsiRaw,
            'kabupatenRaw' => $kabupatenRaw,
            'kecamatanRaw' => $kecamatanRaw,
            'servers'      => $servers,
        ]);
    }



    /**
     * Simpan ODP baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'server_id'    => ['nullable', 'uuid', Rule::exists('data_server', 'id')],
            'kode_odp'    => ['required', 'string', 'max:191', 'unique:data_odp,kode_odp'],
            'nama_odp'    => ['nullable', 'string', 'max:191'],
            'alamat'      => ['nullable', 'string', 'max:255'],
            'prov'        => ['nullable', 'string', 'max:100'],
            'kota'        => ['nullable', 'string', 'max:100'],
            'kec'         => ['nullable', 'string', 'max:100'],
            'desa'        => ['nullable', 'string', 'max:100'],
            'loc_odp'     => ['nullable', 'string', 'max:255'],   // mis: "-6.x,106.x" / deskripsi
            'port_cap'    => ['nullable', 'string', 'max:50'],    // varchar sesuai desain
            'port_install' => ['nullable', 'string', 'max:50'],
            'vlan' => ['nullable', 'string', 'max:50'],
            'warna_core'  => ['nullable', 'string', 'max:100'],
            'core_cable'  => ['nullable', 'string', 'max:100'],
            'note'        => ['nullable', 'string'],
        ]);

        DataOdp::create($validated);

        return redirect()
            ->route('admin.odp.index')
            ->with('success', 'ODP berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $odp = \App\Models\DataOdp::with('server')->find($id);
        if (!$odp) {
            abort(404, 'Data ODP tidak ditemukan.');
        }

        $ports = \App\Models\DataOdpPort::with('client')
            ->where('odp_id', $odp->id)
            ->orderBy('port_numb')
            ->get();

        return view('admin.odp.detail', compact('odp', 'ports'));
    }

    public function edit(string $id)
    {
        $odp = \App\Models\DataOdp::find($id);
        if (!$odp) {
            abort(404, 'Data ODP tidak ditemukan.');
        }

        // Load JSON data
        $provPath = public_path('assets/json/provinsi.json');
        $kabPath  = public_path('assets/json/kabupaten.json');
        $kecPath  = public_path('assets/json/kecamatan.json');

        $readJson = fn(string $path): array => is_file($path) ? json_decode(file_get_contents($path), true) ?? [] : [];

        $provinsiRaw  = $readJson($provPath);
        $kabupatenRaw = $readJson($kabPath);
        $kecamatanRaw = $readJson($kecPath);

        usort($provinsiRaw, fn($a, $b) => strcmp($a['name'] ?? '', $b['name'] ?? ''));
        usort($kabupatenRaw, fn($a, $b) => strcmp($a['name'] ?? '', $b['name'] ?? ''));
        usort($kecamatanRaw, fn($a, $b) => strcmp($a['name'] ?? '', $b['name'] ?? ''));

        $servers = \App\Models\DataServer::orderBy('nama_pop')->get(['id', 'nama_pop', 'ip_public', 'lokasi']);

        return view('admin.odp.edit', compact(
            'odp',
            'provinsiRaw',
            'kabupatenRaw',
            'kecamatanRaw',
            'servers'
        ));
    }

    public function update(Request $request, string $id)
    {
        $odp = \App\Models\DataOdp::find($id);
        if (!$odp) {
            abort(404, 'Data ODP tidak ditemukan.');
        }

        $validated = $request->validate([
            'server_id'     => ['nullable', 'uuid', Rule::exists('data_server', 'id')],
            'kode_odp'      => ['required', 'string', 'max:191', Rule::unique('data_odp', 'kode_odp')->ignore($odp->id)],
            'nama_odp'      => ['nullable', 'string', 'max:191'],
            'alamat'        => ['nullable', 'string', 'max:255'],
            'prov'          => ['nullable', 'string', 'max:100'],
            'kota'          => ['nullable', 'string', 'max:100'],
            'kec'           => ['nullable', 'string', 'max:100'],
            'desa'          => ['nullable', 'string', 'max:100'],
            'loc_odp'       => ['nullable', 'string', 'max:255'],
            'port_cap'      => ['nullable', 'string', 'max:50'],
            'port_install'  => ['nullable', 'string', 'max:50'],
            'vlan'          => ['nullable', 'string', 'max:50'],
            'warna_core'    => ['nullable', 'string', 'max:100'],
            'core_cable'    => ['nullable', 'string', 'max:100'],
            'note'          => ['nullable', 'string'],
        ]);

        $odp->update($validated);

        return redirect()
            ->route('admin.odp.show', $odp->id)
            ->with('success', 'Data ODP berhasil diperbarui.');
    }
}
