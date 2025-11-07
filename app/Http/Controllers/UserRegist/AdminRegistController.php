<?php

namespace App\Http\Controllers\UserRegist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataClientsRegist;
use App\Models\DataPaket;

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
        return view('admin.user_regist.edit', compact('regist', 'paketList'));
    }

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
            'status'    => 'required|in:pending,process,rejected',
        ]);

        $regist->update($validated);

        return redirect()->route('admin.userregist.index')->with('success', 'Data berhasil diperbarui');
    }
}
