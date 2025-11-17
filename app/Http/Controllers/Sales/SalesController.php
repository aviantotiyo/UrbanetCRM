<?php

namespace App\Http\Controllers\Sales;

use App\Models\DataPaket;
use App\Models\DataClients;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DataClientsSales;
use App\Models\DataClientsRegist;
use App\Models\DataClientsProspect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    public function index()
    {
        $query = DataClientsSales::with('paket', 'user')->latest();

        // Jika user yang login adalah Sales → tampilkan data miliknya sendiri saja
        if (Auth::user()->role === ['Sales', 'Installer']) {
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
        $request->validate([
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


        DataClientsSales::create([
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
        ]);

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
        $request->validate([
            'email'     => 'nullable|email|max:255',
            'alamat'    => 'required|string|max:255',
            'kecamatan' => 'required|string|max:100',
            'kabupaten' => 'required|string|max:100',
            'provinsi'  => 'required|string|max:100',
            'status'    => 'required|in:pending,process,reject',
            'paket_id'  => 'required|exists:data_paket,id',
        ]);

        $prospect = DataClientsSales::findOrFail($id);

        $prospect->update([
            'email'     => $request->email,
            'alamat'    => $request->alamat,
            'kecamatan' => $request->kecamatan,
            'kabupaten' => $request->kabupaten,
            'provinsi'  => $request->provinsi,
            'status'    => $request->status,
            'paket_id'  => $request->paket_id,
        ]);

        return redirect()->route('admin.sales.index')->with('success', 'Data berhasil diperbarui.');
    }
}
