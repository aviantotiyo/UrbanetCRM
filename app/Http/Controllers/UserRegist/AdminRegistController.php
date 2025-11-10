<?php

namespace App\Http\Controllers\UserRegist;

use App\Models\DataPaket;
use App\Models\DataClients;
use Illuminate\Http\Request;
use App\Models\DataClientsRegist;
use App\Http\Controllers\Controller;

class AdminRegistController extends Controller
{
    public function index()
    {
        $data = DataClientsRegist::with('paket')->latest()->get();
        return view('admin.user_regist.index', compact('data'));
    }

    public function edit($id)
    {
        $regist = DataClientsRegist::findOrFail($id);
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


        return view('admin.user_regist.edit', compact(
            'regist',
            'provinsiRaw',
            'kabupatenRaw',
            'kecamatanRaw',
            'paketList'
        ));
    }

    // 

    public function update(Request $request, $id)
    {
        $regist = DataClientsRegist::findOrFail($id);

        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'nik'       => 'required|string|max:50',
            'email'     => 'nullable|email',
            'no_hp'     => 'required|string|max:20',
            'alamat'    => 'required|string',
            'kecamatan' => 'required|string',
            'kabupaten' => 'required|string',
            'provinsi'  => 'required|string',
            'paket_id'  => 'required|exists:data_paket,id',
            'status'    => 'required|in:pending,process,reject',
        ]);

        // Jika bukan 'process', cukup update lalu redirect ke index
        if ($validated['status'] !== 'process') {
            $regist->update($validated);

            return redirect()
                ->route('admin.userregist.index')
                ->with('success', 'Data berhasil diperbarui.');
        }

        // Update dulu, lalu lanjutkan insert jika status == 'process'
        $regist->update($validated);

        // Cek apakah sudah pernah masuk ke DataClients
        $exists = DataClients::where('id', $regist->id)->exists();
        if (!$exists) {
            $paket = DataPaket::find($validated['paket_id']);

            // Generate user/pass
            $random8 = str_pad(random_int(0, 99999999), 8, '0', STR_PAD_LEFT);
            $random6 = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

            $nopel = 'ID' . strtoupper(substr(str_replace('-', '', $regist->id), 0, 8));
            $userPppoe = $nopel;
            $passPppoe = $random6;

            // Simpan ke DataClients
            DataClients::create([
                'id'            => $regist->id,
                'nama'          => $regist->nama,
                'nik'           => $regist->nik,
                'email'         => $regist->email,
                'no_hp'         => $regist->no_hp,
                'alamat'        => $regist->alamat,
                'kecamatan'     => $regist->kecamatan,
                'kabupaten'     => $regist->kabupaten,
                'provinsi'      => $regist->provinsi,
                'paket'         => $paket->nama_paket ?? null,
                'tagihan'       => $paket->harga ?? 0,
                'nopel'         => $nopel,
                'user_pppoe'    => $userPppoe,
                'pass_pppoe'    => $passPppoe,
                'name_profile'  => $paket->name_profile ?? null,
                'limit_radius'  => $paket->limit_radius ?? null,
                'status'        => 'booking',
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }

        // Redirect ke halaman edit pelanggan
        return redirect()
            ->route('admin.pelanggan.edit', ['id' => $regist->id])
            ->with('success', 'Data berhasil diproses. Silakan lengkapi data pelanggan.
            <ul>
            <li>Tambahkan link lokasi gmap</li>
            <li>Tambahkan foto depan rumah</li>
            </ul>');
    }
}
