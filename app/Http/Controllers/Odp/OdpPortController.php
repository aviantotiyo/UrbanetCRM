<?php

namespace App\Http\Controllers\Odp;

use App\Http\Controllers\Controller;
use App\Models\DataOdp;
use App\Models\DataOdpPort;
use App\Models\DataClients;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OdpPortController extends Controller
{
    /**
     * Tampilkan form tambah port untuk ODP tertentu.
     * @param string $odpId UUID dari DataOdp
     */
    public function create(string $odpId)
    {
        // Pastikan ODP ada
        $odp = DataOdp::find($odpId);
        if (!$odp) {
            abort(404, 'ODP tidak ditemukan.');
        }

        // (opsional) ambil beberapa client untuk dropdown, atau kosongkan
        // Ambil 20 terbaru agar tidak berat. Kamu bisa ganti ke pencarian AJAX nanti.
        $clients = DataClients::orderByDesc('created_at')->limit(20)->get();

        return view('admin.odp_port.tambah', compact('odp', 'clients'));
    }

    /**
     * Simpan port baru pada ODP tertentu.
     * @param string $odpId UUID dari DataOdp
     */
    public function store(Request $request, string $odpId)
    {
        // Pastikan ODP ada
        $odp = \App\Models\DataOdp::find($odpId);
        if (!$odp) {
            abort(404, 'ODP tidak ditemukan.');
        }

        // Normalisasi ringan (trim) untuk port_numb
        $request->merge([
            'port_numb' => is_string($request->input('port_numb'))
                ? trim($request->input('port_numb'))
                : $request->input('port_numb'),
        ]);

        // Validasi dasar
        $validated = $request->validate([
            'client_id' => ['nullable', 'uuid', \Illuminate\Validation\Rule::exists('data_clients', 'id')],
            'port_numb' => [
                'required',
                'string',
                'max:32',                       // samakan dengan panjang kolom di DB
                'regex:/^[A-Za-z0-9_\-\.]+$/',  // alnum + _ - .
                \Illuminate\Validation\Rule::unique('data_odp_port', 'port_numb')
                    ->where(fn($q) => $q->where('odp_id', $odpId)),
            ],
            'status' => ['nullable', \Illuminate\Validation\Rule::in(['available', 'reserved', 'active', 'faulty', 'blocked'])],
        ], [
            'port_numb.regex' => 'Format port hanya boleh huruf/angka/_.-',
        ]);

        // ===== Aturan #1: Batas jumlah port tidak boleh melebihi port_install pada ODP =====
        // port_install disimpan varchar; kita coba baca sebagai integer (0 jika kosong/invalid)
        $installLimit = (int) preg_replace('/\D+/', '', (string) $odp->port_install); // ambil angka saja
        $currentCount = \App\Models\DataOdpPort::where('odp_id', $odp->id)->count();

        if ($installLimit > 0 && $currentCount >= $installLimit) {
            // Tolak dengan pesan error
            return back()
                ->withErrors([
                    'port_numb' => "Tidak bisa menambah port baru: jumlah port terpasang ($currentCount) sudah mencapai batas port_install ($installLimit) pada ODP {$odp->kode_odp}."
                ])
                ->withInput();
        }

        // ===== Aturan #2: Satu client hanya boleh punya satu port di data_odp_port =====
        if (!empty($validated['client_id'])) {
            $alreadyUsed = \App\Models\DataOdpPort::where('client_id', $validated['client_id'])->exists();
            if ($alreadyUsed) {
                return back()
                    ->withErrors([
                        'client_id' => 'Client ini sudah terhubung ke port lain. Set client kosong atau pilih client berbeda.',
                    ])
                    ->withInput();
            }
        }

        // Simpan
        $port = \App\Models\DataOdpPort::create([
            'odp_id'    => $odp->id,
            'client_id' => $validated['client_id'] ?? null,
            'port_numb' => $validated['port_numb'],
            'status'    => $validated['status'] ?? 'available',
        ]);

        return redirect()
            ->route('admin.odp.show', $odp->id)
            ->with('success', "Port {$port->port_numb} berhasil ditambahkan pada ODP {$odp->kode_odp}.");
    }

    /**
     * Form edit port ODP (berdasarkan ID port).
     */
    public function edit(string $portId)
    {
        $port = DataOdpPort::with(['odp', 'client'])->find($portId);
        if (!$port) {
            abort(404, 'Port ODP tidak ditemukan.');
        }

        // Opsi: ambil beberapa client untuk dropdown (bisa ganti ke select2/ajax nanti)
        $clients = DataClients::orderByDesc('created_at')->limit(50)->get();

        // Status enum
        $statuses = ['available', 'reserved', 'active', 'faulty', 'blocked'];

        return view('admin.odp_port.edit', compact('port', 'clients', 'statuses'));
    }

    /**
     * Update port ODP.
     */
    public function update(\Illuminate\Http\Request $request, string $portId)
    {
        $port = DataOdpPort::with('odp')->find($portId);
        if (!$port) {
            abort(404, 'Port ODP tidak ditemukan.');
        }

        // Validasi:
        // - client_id nullable, harus valid jika diisi
        // - port_numb unik per ODP (abaikan dirinya sendiri)
        // - status harus salah satu enum
        $validated = $request->validate([
            'client_id' => ['nullable', 'uuid', Rule::exists('data_clients', 'id')],
            'port_numb' => [
                'required',
                'string',
                'max:32',
                'regex:/^[A-Za-z0-9_\-\.]+$/',
                Rule::unique('data_odp_port', 'port_numb')
                    ->where(fn($q) => $q->where('odp_id', $port->odp_id))
                    ->ignore($port->id),
            ],
            'status' => ['required', Rule::in(['available', 'reserved', 'active', 'faulty', 'blocked'])],
        ], [
            'port_numb.regex' => 'Format port hanya boleh huruf/angka, underscore (_), minus (-), atau titik (.)',
        ]);

        // Aturan: satu client hanya boleh terhubung ke satu port di tabel ini
        if (!empty($validated['client_id'])) {
            $alreadyUsed = DataOdpPort::where('client_id', $validated['client_id'])
                ->where('id', '!=', $port->id)
                ->exists();

            if ($alreadyUsed) {
                return back()
                    ->withErrors([
                        'client_id' => 'Client ini sudah terhubung ke port lain. Kosongkan atau pilih client berbeda.',
                    ])
                    ->withInput();
            }
        }

        $port->update([
            'client_id' => $validated['client_id'] ?? null,
            'port_numb' => $validated['port_numb'],
            'status'    => $validated['status'],
        ]);

        return redirect()
            ->route('admin.odp.show', $port->odp_id)
            ->with('success', "Port {$port->port_numb} berhasil diperbarui pada ODP {$port->odp?->kode_odp}.");
    }
}
