<?php

namespace App\Http\Controllers\Paket;

use App\Models\DataPaket;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class PaketController extends Controller
{
    /**
     * Tampilkan semua paket (paginate 20).
     */
    public function index()
    {
        $pakets = DataPaket::orderByDesc('created_at')->paginate(20);
        return view('admin.paket.index', compact('pakets'));
    }

    /**
     * Form tambah paket.
     */
    public function create()
    {
        return view('admin.paket.tambah');
    }

    /**
     * Simpan paket baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_paket'   => ['required', 'string', 'max:191'],
            'deskripsi'    => ['nullable', 'string', 'max:255'],
            'harga'        => ['required', 'string', 'max:64'], // kamu minta varchar
            'name_profile' => ['nullable', 'string', 'max:191'],
            'limit_radius' => ['nullable', 'string', 'max:191'],
            'active'       => ['required', Rule::in(['0', '1'])],
            'tayang'       => ['required', Rule::in(['0', '1'])],
        ]);

        // Normalisasi ke boolean/int kecil (0/1)
        $validated['active'] = (int) $validated['active'];
        $validated['tayang'] = (int) $validated['tayang'];

        DataPaket::create($validated);

        return redirect()
            ->route('admin.paket.index')
            ->with('success', 'Paket berhasil ditambahkan.');
    }

    /**
     * Form edit paket.
     */
    public function edit(string $id)
    {
        $paket = DataPaket::find($id);
        if (!$paket) {
            abort(404, 'Data paket tidak ditemukan.');
        }
        return view('admin.paket.edit', compact('paket'));
    }

    /**
     * Update paket.
     */
    public function update(Request $request, string $id)
    {
        $paket = DataPaket::find($id);
        if (!$paket) {
            abort(404, 'Data paket tidak ditemukan.');
        }

        $validated = $request->validate([
            'nama_paket'   => ['required', 'string', 'max:191'],
            'deskripsi'    => ['nullable', 'string', 'max:255'],
            'harga'        => ['required', 'string', 'max:64'],
            'name_profile' => ['nullable', 'string', 'max:191'],
            'limit_radius' => ['nullable', 'string', 'max:191'],
            'active'       => ['required', Rule::in(['0', '1'])],
            'tayang'       => ['required', Rule::in(['0', '1'])],
        ]);


        $validated['active'] = (int) $validated['active'];
        $validated['tayang'] = (int) $validated['tayang'];

        $paket->update($validated);

        return redirect()
            ->route('admin.paket.index')
            ->with('success', 'Paket berhasil diperbarui.');
    }
}
