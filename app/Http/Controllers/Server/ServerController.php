<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use App\Models\DataServer;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    /**
     * List semua server (terbaru dulu), paginate 20.
     */
    public function index()
    {
        $servers = DataServer::orderByDesc('created_at')->paginate(20);
        return view('admin.server.index', compact('servers'));
    }

    /**
     * Form tambah server.
     */
    public function create()
    {
        return view('admin.server.tambah');
    }

    /**
     * Simpan server baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pop'  => ['required', 'string', 'max:191'],
            'lokasi'    => ['nullable', 'string', 'max:255'],
            'ip_public' => ['nullable', 'ip'],   // jika ingin bebas, ganti ke string|max:191
            'ip_static' => ['nullable', 'ip'],
            'user'      => ['required', 'string', 'max:191'],
            'password'  => ['required', 'string', 'max:191'],
        ]);

        DataServer::create($validated);

        return redirect()
            ->route('admin.server.index')
            ->with('success', 'Server berhasil ditambahkan.');
    }

    /**
     * Form edit server.
     */
    public function edit(string $id)
    {
        $server = DataServer::find($id);
        if (!$server) {
            abort(404, 'Data server tidak ditemukan.');
        }
        return view('admin.server.edit', compact('server'));
    }

    /**
     * Update server.
     */
    public function update(Request $request, string $id)
    {
        $server = DataServer::find($id);
        if (!$server) {
            abort(404, 'Data server tidak ditemukan.');
        }

        $validated = $request->validate([
            'nama_pop'  => ['required', 'string', 'max:191'],
            'lokasi'    => ['nullable', 'string', 'max:255'],
            'ip_public' => ['nullable', 'ip'],
            'ip_static' => ['nullable', 'ip'],
            'user'      => ['required', 'string', 'max:191'],
            'password'  => ['required', 'string', 'max:191'],
        ]);

        $server->update($validated);

        return redirect()
            ->route('admin.server.index')
            ->with('success', 'Server berhasil diperbarui.');
    }
}
