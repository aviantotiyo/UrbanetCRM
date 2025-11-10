<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataPartner;
use Illuminate\Support\Str;

class AdminPartnerController extends Controller
{
    public function index()
    {
        $partners = DataPartner::latest()->get();
        return view('admin.partner.index', compact('partners'));
    }

    public function create()
    {
        return view('admin.partner.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_partner' => 'required|string|max:255',
            'no_hp'        => 'required|string|max:20|unique:data_partner,no_hp',
            'alamat'       => 'nullable|string',
            'provinsi'     => 'nullable|string',
            'kabupaten'    => 'nullable|string',
            'kecamatan'    => 'nullable|string',
            'password'     => 'required|string|min:6',
        ]);

        DataPartner::create([
            'id'           => Str::uuid(),
            'nama_partner' => $request->nama_partner,
            'no_hp'        => $request->no_hp,
            'alamat'       => $request->alamat,
            'provinsi'     => $request->provinsi,
            'kabupaten'    => $request->kabupaten,
            'kecamatan'    => $request->kecamatan,
            'secret_token' => Str::random(32),
            'password'     => bcrypt($request->password),
            'status'       => 'active',
        ]);

        return redirect()->route('admin.partner.index')->with('success', 'Data mitra berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $partner = DataPartner::findOrFail($id);
        return view('admin.partner.edit', compact('partner'));
    }

    public function update(Request $request, $id)
    {
        $partner = DataPartner::findOrFail($id);

        $request->validate([
            'nama_partner' => 'required|string|max:255',
            'no_hp'        => 'required|string|max:20|unique:data_partner,no_hp,' . $partner->id,
            'alamat'       => 'nullable|string',
            'provinsi'     => 'nullable|string',
            'kabupaten'    => 'nullable|string',
            'kecamatan'    => 'nullable|string',
            'status'       => 'required|in:active,inactive',
        ]);

        $partner->update($request->only([
            'nama_partner',
            'no_hp',
            'alamat',
            'provinsi',
            'kabupaten',
            'kecamatan',
            'status'
        ]));

        return redirect()->route('admin.partner.index')->with('success', 'Data mitra berhasil diperbarui.');
    }
}
