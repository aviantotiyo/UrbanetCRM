<?php

namespace App\Http\Controllers\Partner;

use App\Models\DataPaket;
use Illuminate\Http\Request;
use App\Models\DataClientsPartner;
use App\Http\Controllers\Controller;

class AdminProspectPartnerController extends Controller
{
    public function index()
    {
        $data = DataClientsPartner::with('partner', 'paket')
            ->latest()
            ->paginate(20);
        return view('admin.user_partner.index', compact('data'));
    }

    public function edit($id)
    {
        $prospect = DataClientsPartner::findOrFail($id);
        $paketList = DataPaket::all();

        // JSON wilayah
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


        return view('admin.user_partner.edit', compact(
            'prospect',
            'provinsiRaw',
            'kabupatenRaw',
            'kecamatanRaw',
            'paketList',
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'nullable|string|max:50',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|string',
            'alamat' => 'nullable|string',
            'kecamatan' => 'nullable|string',
            'kabupaten' => 'nullable|string',
            'provinsi' => 'nullable|string',
            'status' => 'nullable|string',
            'paket_id' => 'required|exists:data_paket,id',
        ]);

        $client = DataClientsPartner::findOrFail($id);
        $client->update([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'kecamatan' => $request->kecamatan,
            'kabupaten' => $request->kabupaten,
            'provinsi' => $request->provinsi,
            'email' => $request->email,
            'status' => $request->status,
            'paket_id' => $request->paket_id,
        ]);

        return redirect()->route('admin.list-prospek-mitra.user_partner.index')->with('success', 'Data berhasil diperbarui.');
    }
}
