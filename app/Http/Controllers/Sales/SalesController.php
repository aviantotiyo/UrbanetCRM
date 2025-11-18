<?php

namespace App\Http\Controllers\Sales;

use Aws\S3\S3Client;
use App\Models\DataPaket;
use App\Models\DataClients;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DataClientsSales;
use App\Models\DataClientsRegist;
use App\Models\DataClientsProspect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;


class SalesController extends Controller
{
    public function index()
    {
        $query = DataClientsSales::with('paket', 'user')->latest();

        // Jika role adalah Sales atau Installer → filter by users_id
        if (in_array(Auth::user()->role, ['Sales', 'Installer'])) {
            $query->where('users_id', Auth::id());
        }

        $data = $query->paginate(20);

        return view('admin.sales.index', compact('data'));
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

        // Ambil paket aktif dan tayang
        $paketList = DataPaket::where('active', 1)
            ->where('tayang', 1)
            ->orderBy('nama_paket')
            ->get(['id', 'nama_paket', 'harga']);

        return view('admin.sales.tambah', compact(
            'paketList',
            'provinsiRaw',
            'kabupatenRaw',
            'kecamatanRaw',
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'paket_id' => 'required|exists:data_paket,id',
            'nama'     => 'required|string|max:255',
            'nik'      => 'nullable|string|max:50',
            'no_hp'    => 'nullable|string|max:20',
            'email'   => 'nullable|string',
            'alamat'   => 'nullable|string',
            'kecamatan' => 'nullable|string',
            'kabupaten' => 'nullable|string',
            'provinsi' => 'nullable|string',
            'loc_client' => 'nullable|string',
            'lat' => 'nullable|string',
            'long' => 'nullable|string',
            'foto_depan' => ['nullable', 'image', 'max:2048'],
        ]);

        // Cek duplikasi
        $existsInClients = DataClients::where('no_hp', $request['no_hp'])
            ->orWhere('nik', $request['nik'])->exists();
        $existsInRegist = DataClientsRegist::where('no_hp', $request['no_hp'])
            ->orWhere('nik', $request['nik'])->exists();
        $existsInProspect = DataClientsProspect::where('no_hp', $request['no_hp'])
            ->orWhere('nik', $request['nik'])->exists();
        $existsInSales = DataClientsSales::where('no_hp', $request['no_hp'])
            ->orWhere('nik', $request['nik'])->exists();


        if ($existsInClients || $existsInRegist || $existsInProspect || $existsInSales) {
            return back()
                ->with('error', 'Nomor HP atau NIK sudah terdaftar.')
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

        $sales = DataClientsSales::create([
            'users_id'          => Auth::id(),
            'paket_id'          => $request->paket_id,
            'nama'              => $request->nama,
            'nik'               => $request->nik,
            'no_hp'             => $request->no_hp,
            'email'             => $request->email,
            'alamat'            => $request->alamat,
            'kecamatan'         => $request->kecamatan,
            'kabupaten'         => $request->kabupaten,
            'provinsi'          => $request->provinsi,
            'loc_client'        => $request->loc_client,
            'lat'               => $request->lat,
            'long'              => $request->long,
            'client_prospect_id' =>  (string) Str::uuid(),
            'status'            => 'pending',
            'foto_depan'    => $request['foto_depan'] ?? null,
        ]);

        if ($request->hasFile('foto_depan')) {
            $file = $request->file('foto_depan');
            $filename = 'client_photos/foto_depan_' . Str::uuid() . '.' . $file->getClientOriginalExtension();

            $s3 = new S3Client([
                'version' => 'latest',
                'region'  => config('filesystems.disks.s3.region'),
                'endpoint' => config('filesystems.disks.s3.endpoint'),
                'credentials' => [
                    'key' => config('filesystems.disks.s3.key'),
                    'secret' => config('filesystems.disks.s3.secret'),
                ],
                'use_path_style_endpoint' => config('filesystems.disks.s3.use_path_style_endpoint'),
            ]);

            try {
                $result = $s3->putObject([
                    'Bucket' => config('filesystems.disks.s3.bucket'),
                    'Key'    => $filename,
                    'Body'   => fopen($file->getRealPath(), 'r'),
                    'ACL'    => 'public-read',
                    'ContentType' => $file->getMimeType(), // Contoh: 'image/jpeg'
                    'ContentDisposition' => 'inline', //
                ]);

                $url = $result['ObjectURL'];

                // Simpan ke database
                $sales->update(['foto_depan' => $url]);
            } catch (\Exception $e) {
                return back()->withErrors(['foto_depan' => 'Upload gagal: ' . $e->getMessage()]);
            }
        }

        return redirect()->route('admin.sales.index')->with('success', 'Data prospek berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $prospect = DataClientsSales::findOrFail($id);
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



        return view('admin.sales.edit', compact(
            'prospect',
            'paketList',
            'provinsiRaw',
            'kabupatenRaw',
            'kecamatanRaw',
        ));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama'       => 'required|string|max:255',
            'no_hp'      => 'required|string',
            'nik'        => 'required|string',
            'email'      => 'nullable|email|max:255',
            'alamat'     => 'required|string|max:255',
            'kecamatan'  => 'required|string|max:100',
            'kabupaten'  => 'required|string|max:100',
            'provinsi'   => 'required|string|max:100',
            'loc_client' => 'nullable|string',
            'lat'        => 'nullable|string',
            'long'       => 'nullable|string',
            'status'     => 'required|in:pending,process,reject',
            'paket_id'   => 'required|exists:data_paket,id',
        ]);

        $prospect = DataClientsSales::findOrFail($id);

        $prospect->update($validated);

        // Jika status adalah 'process', buat entri ke DataClients
        if ($validated['status'] === 'process') {
            // Hindari duplikasi: cek apakah client dengan ID ini sudah ada
            $existingClient = DataClients::where('id', $prospect->client_prospect_id)->first();
            if (!$existingClient) {
                $clientId = $prospect->client_prospect_id;
                $randomNopel = 'ID' . mt_rand(10000000, 99999999);
                $randomPassword = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
                $paket = DataPaket::find($validated['paket_id']);

                DataClients::create([
                    'id'         => $clientId,
                    'nama'       => $prospect->nama,
                    'nik'        => $prospect->nik,
                    'no_hp'      => $prospect->no_hp,
                    'email'      => $prospect->email,
                    'alamat'     => $prospect->alamat,
                    'kecamatan'  => $prospect->kecamatan,
                    'kabupaten'  => $prospect->kabupaten,
                    'provinsi'   => $prospect->provinsi,
                    'loc_client' => $prospect->loc_client,
                    'lat'        => $prospect->lat,
                    'long'       => $prospect->long,
                    'nopel'      => $randomNopel,
                    'user_pppoe' => $randomNopel,
                    'pass_pppoe' => $randomPassword,
                    'paket'      => $paket->nama_paket ?? null,
                    'tagihan'    => $paket->harga ?? 0,
                    'name_profile' => $paket->name_profile,
                    'limit_radius' => $paket->limit_radius,
                    'status'     => 'booking',
                    'foto_depan' => $prospect->foto_depan, // dari DataClientsSales
                ]);

                $prospect->status = 'process';
                $prospect->save();

                return redirect()->route('admin.pelanggan.edit', $clientId)
                    ->with('success', 'Data berhasil diproses dan dipindahkan ke Daftar Pelanggan. Tambahkan Data pendukung lainnya');
            }
        }

        return redirect()->route('admin.sales.index')->with('success', 'Data berhasil diperbarui.');
    }
}
