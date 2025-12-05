<?php

namespace App\Http\Controllers\PelangganCsr;

use App\Models\DataCsr;
use App\Models\DataOdp;
use App\Models\DataPaket;
use App\Models\DataOdpPort;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DataOdpLogs;
use App\Jobs\UploadClientCsrPhotoToS3;
use App\Jobs\UploadClientEditCsrPhotoToS3;
use Aws\S3\S3Client;
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;

class CsrController extends Controller
{
    public function index()
    {
        $data = DataCsr::latest()->paginate(15);
        return view('admin.pelanggan_csr.index', compact('data'));
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

        $odps = DataOdp::all();
        $odp_ports = DataOdpPort::where('status', 'available')
            ->select('id', 'port_numb', 'odp_id')
            ->get();


        $pakets = DataPaket::query()
            ->where('active', 1)
            ->orderBy('nama_paket')
            ->get(['id', 'nama_paket', 'harga', 'name_profile', 'limit_radius']);

        // Siapkan data ringan untuk JS (hindari map arrow di Blade)
        $paketsForJs = $pakets->map(function ($x) {
            return [
                'nama_paket'   => $x->nama_paket,
                'harga'        => $x->harga,
                'name_profile' => $x->name_profile,
                'limit_radius' => $x->limit_radius,
            ];
        })->values(); // values() supaya index rapi dari 0

        return view('admin.pelanggan_csr.tambah', compact(
            'odps',
            'odp_ports',
            'provinsiRaw',
            'kabupatenRaw',
            'kecamatanRaw',
            'pakets',
            'paketsForJs'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'          => ['required', 'string', 'max:255'],
            'detail_pic'    => ['nullable', 'string'],
            'alamat'        => ['nullable', 'string', 'max:255'],
            'kecamatan'     => ['required', 'string', 'max:100'],
            'kabupaten'     => ['required', 'string', 'max:100'],
            'provinsi'      => ['required', 'string', 'max:100'],
            'loc_client'    => ['nullable', 'string', 'max:255'],
            'lat'           => ['nullable', 'string', 'max:255'],
            'long'          => ['nullable', 'string', 'max:255'],
            'paket'         => ['required', Rule::exists('data_paket', 'nama_paket')],
            'foto_depan' => ['nullable', 'image', 'max:2048'],
            'name_profile'  => ['required', 'string', 'max:255'],
            'limit_radius'  => ['required', 'string', 'max:255'],
            'odp_id'        => ['required', 'uuid', Rule::exists('data_odp', 'id')],
            'odp_port_id'   => ['required', 'uuid', Rule::exists('data_odp_port', 'id')],
            'status'        => ['required', Rule::in(['active', 'isolir', 'suspend', 'inactive', 'booking'])],
        ]);

        // Generate CSR ID prefix
        $randomDigits = str_pad(mt_rand(0, 99999999), 8, '0', STR_PAD_LEFT);
        $generatedId = 'CSR-' . $randomDigits;

        $validated['id'] = Str::uuid();
        $validated['nopel'] = $generatedId;
        $validated['user_pppoe'] = $generatedId;
        $validated['pass_pppoe'] = (string) mt_rand(100000, 999999);

        // Simpan CSR
        $dataCsr = DataCsr::create($validated);

        // Ambil actor (user yang melakukan tindakan)
        $user = Auth::user();
        $actorId = $user?->id;
        $actorName = $user?->name ?? 'Unknown User';

        // Format waktu
        $timestamp = Carbon::now()->format('Y-m-d H:i:s');

        // Hanya update port & log jika status = 'active'
        if ($validated['status'] === 'active') {

            // Update Port
            DataOdpPort::where('id', $validated['odp_port_id'])
                ->where('odp_id', $validated['odp_id'])
                ->update([
                    'client_csr_id' => $dataCsr->id,
                    'status'        => DataOdpPort::STATUS_RESERVED
                ]);

            // Log aktivitas ODP
            DataOdpLogs::create([
                'users_id'     => $actorId,
                'odp_id'      => $validated['odp_id'],
                'odp_port' => $validated['odp_port_id'],
                'status'      => "User CSR '{$validated['nama']}' ditambahkan oleh {$actorName} pada {$timestamp}",
            ]);
        }

        // Cek & jalankan upload foto jika ada file
        if ($request->hasFile('foto_depan')) {
            $file = $request->file('foto_depan');
            $ext = $file->getClientOriginalExtension();
            $tempPath = storage_path('app/temp_csr_' . Str::uuid() . '.' . $ext);
            $file->move(dirname($tempPath), basename($tempPath));

            // Dispatch Job upload ke S3
            UploadClientCsrPhotoToS3::dispatch($dataCsr->id, $tempPath);
        }


        return redirect()->route('admin.pelanggan_csr.index')
            ->with('success', 'Data berhasil ditambahkan');
    }


    public function edit($id)
    {
        $item = DataCsr::findOrFail($id);
        $odps = DataOdp::all();
        $odp_ports = DataOdpPort::select('id', 'odp_id', 'port_numb', 'status')->get();


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

        $pakets = DataPaket::query()
            ->where('active', 1)
            ->orderBy('nama_paket')
            ->get(['id', 'nama_paket', 'harga', 'name_profile', 'limit_radius']);

        // Siapkan data ringan untuk JS (hindari map arrow di Blade)
        $paketsForJs = $pakets->map(function ($x) {
            return [
                'nama_paket'   => $x->nama_paket,
                'harga'        => $x->harga,
                'name_profile' => $x->name_profile,
                'limit_radius' => $x->limit_radius,
            ];
        })->values(); // values() supaya index rapi dari 0

        return view('admin.pelanggan_csr.edit', compact(
            'item',
            'odps',
            'odp_ports',
            'pakets',
            'paketsForJs',
            'provinsiRaw',
            'kabupatenRaw',
            'kecamatanRaw',
        ));
    }


    public function update(Request $request, $id)
    {
        $data = DataCsr::findOrFail($id);

        $request->validate([
            'nama'         => 'required|string|max:255',
            'alamat'       => 'nullable|string',
            'provinsi'     => 'nullable|string',
            'kabupaten'    => 'nullable|string',
            'kecamatan'    => 'nullable|string',
            'paket'        => ['required', Rule::exists('data_paket', 'nama_paket')],
            'odp_id'       => 'required|exists:data_odp,id',
            'odp_port_id'  => 'required|exists:data_odp_port,id',
            'status'       => ['required', Rule::in(['active', 'isolir', 'suspend', 'inactive', 'booking'])],
            'foto_depan'   => ['nullable', 'image', 'max:2048'],
        ]);

        $updateData = $request->except(['nopel', 'user_pppoe']);
        $updateData['nopel'] = $data->nopel;
        $updateData['user_pppoe'] = $data->user_pppoe;

        $data->update($updateData);

        // Jika status aktif, tandai ODP port sebagai reserved
        if ($request->status === 'active') {
            DataOdpPort::where('id', $request->odp_port_id)
                ->where('odp_id', $request->odp_id)
                ->update([
                    'client_csr_id' => $data->id,
                    'status'        => DataOdpPort::STATUS_RESERVED,
                ]);

            DataOdpLogs::create([
                'users_id' => Auth::id(),
                'odp_id'   => $request->odp_id,
                'odp_port' => $request->odp_port_id,
                'status'   => "User CSR '{$request->nama}' diubah oleh " . (Auth::user()?->name ?? 'Unknown User') . " pada " . now(),
            ]);
        }

        // Upload foto jika ada file baru
        if ($request->hasFile('foto_depan')) {
            $file = $request->file('foto_depan');
            $ext = $file->getClientOriginalExtension();
            $tempPath = storage_path('app/temp_csr_' . Str::uuid() . '.' . $ext);
            $file->move(dirname($tempPath), basename($tempPath));

            UploadClientCsrPhotoToS3::dispatch($data->id, $tempPath);
        }

        return redirect()->route('admin.pelanggan_csr.index')->with('success', 'Data berhasil diperbarui');
    }



    public function deleteImage(string $id)
    {
        $client = DataCsr::findOrFail($id);

        if ($client->foto_depan) {
            $oldPath = parse_url($client->foto_depan, PHP_URL_PATH);
            $bucketPrefix = '/' . trim(config('filesystems.disks.s3.bucket_prefix'), '/') . '/';
            $relativePath = ltrim(Str::after($oldPath, $bucketPrefix), '/');

            try {
                $s3 = new S3Client([
                    'version' => 'latest',
                    'region'  => config('filesystems.disks.s3.region'),
                    'endpoint' => config('filesystems.disks.s3.endpoint'),
                    'use_path_style_endpoint' => true,
                    'credentials' => [
                        'key'    => config('filesystems.disks.s3.key'),
                        'secret' => config('filesystems.disks.s3.secret'),
                    ],
                ]);

                $s3->deleteObject([
                    'Bucket' => config('filesystems.disks.s3.bucket'),
                    'Key'    => $relativePath,
                ]);

                $client->update(['foto_depan' => null]);

                return back()->with('success', 'Foto berhasil dihapus.');
            } catch (\Exception $e) {
                Log::error('Gagal hapus foto dari S3: ' . $e->getMessage());
                return back()->with('error', 'Gagal menghapus foto: ' . $e->getMessage());
            }
        }

        return back()->with('warning', 'Tidak ada foto untuk dihapus.');
    }
}
