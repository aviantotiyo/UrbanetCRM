<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataClientsPartner;

class AdminProspectPartnerController extends Controller
{
    public function index()
    {
        $data = DataClientsPartner::with('partner')
            ->latest()
            ->paginate(20);
        return view('admin.user_partner.index', compact('data'));
    }

    public function edit($id)
    {
        $client = DataClientsPartner::findOrFail($id);
        return view('admin.user_partner.edit', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string',
            'no_hp' => 'required|string',
            'email' => 'nullable|email',
            'status' => 'required|in:active,inactive',
        ]);

        $client = DataClientsPartner::findOrFail($id);
        $client->update([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.user_partner.index')->with('success', 'Data berhasil diperbarui.');
    }
}
