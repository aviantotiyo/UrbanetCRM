<?php

namespace App\Http\Controllers\UserReferral;

use App\Models\DataPaket;
use App\Models\DataClients;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DataClientsProspect;
use App\Http\Controllers\Controller;

class AdminReferralController extends Controller
{
    public function index()
    {
        $prospects = DataClientsProspect::with('client')
            ->latest()
            ->paginate(20);

        return view('admin.referral.index', compact('prospects'));
    }

    public function edit($id)
    {
        $prospect = DataClientsProspect::findOrFail($id);

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



        return view('admin.referral.edit', compact(
            'prospect',
            'provinsiRaw',
            'kabupatenRaw',
            'kecamatanRaw',
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'nullable|string|max:50',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'kecamatan' => 'nullable|string',
            'kabupaten' => 'nullable|string',
            'provinsi' => 'nullable|string',
            'point' => 'nullable|numeric',
            'status' => 'nullable|string',
        ]);

        $prospect = DataClientsProspect::findOrFail($id);

        if ($request->status === 'process') {
            // PENTING: Ambil client_prospect_id sebagai ID baru
            $clientId = $prospect->client_prospect_id;

            // Cek apakah ID ini sudah pernah dipakai di DataClients
            if (DataClients::find($prospect->client_prospect_id)) {
                return back()->withErrors(['status' => 'Data dengan ID ini sudah pernah diproses ke Daftar Pelanggan.']);
            }


            // Generate data tambahan
            $randomNopel = 'ID' . mt_rand(10000000, 99999999); // contoh: ID27336642
            $randomPassword = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT); // contoh: 092318

            // Simpan ke DataClients

            DataClients::create([
                'id'         => $prospect->client_prospect_id,
                'nama'       => $prospect->nama,
                'nik'        => $prospect->nik,
                'no_hp'      => $prospect->no_hp,
                'alamat'     => $prospect->alamat,
                'kecamatan'  => $prospect->kecamatan,
                'kabupaten'  => $prospect->kabupaten,
                'provinsi'   => $prospect->provinsi,
                'nopel'      =>  $randomNopel,
                'user_pppoe' =>  $randomNopel,
                'pass_pppoe' => $randomPassword,
                'status'     => 'booking',
            ]);


            // Simpan perubahan status ke prospect
            $prospect->status = 'process';
            $prospect->save();
            return redirect()->route('admin.pelanggan.edit', $clientId)->with('success', 'Data berhasil diproses dan dipindahkan ke Daftar Pelanggan. Tambahkan Data pendukung lainnya');
        } else {
            // Selain 'process', hanya update DataClientsProspect
            $prospect->update($request->all());
        }

        return redirect()->route('admin.referral.index')->with('success', 'Data berhasil diperbarui.');
    }
}
