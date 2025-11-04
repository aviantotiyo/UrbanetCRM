<?php

namespace App\Http\Controllers\UserReferral;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataClientsProspect;
use App\Models\DataClients;

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
        return view('admin.referral.edit', compact('prospect'));
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
        $prospect->update($request->all());

        return redirect()->route('admin.team.referral.index')->with('success', 'Data berhasil diperbarui.');
    }
}
