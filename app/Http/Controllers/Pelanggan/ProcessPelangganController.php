<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\DataClients;
use App\Models\DataOdp;
use App\Models\DataOdpPort;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProcessPelangganController extends Controller
{
    /**
     * Tampilkan form proses pemasangan (pilih ODP & Port).
     */
    public function create(Request $request, string $id)
    {
        $client = \App\Models\DataClients::find($id);
        if (!$client) {
            abort(404, 'Data pelanggan tidak ditemukan.');
        }

        // List ODP utk dropdown
        $odps = \App\Models\DataOdp::orderBy('kode_odp')->get(['id', 'kode_odp', 'nama_odp']);

        // Kumpulkan port "available".
        // Tambahkan juga port milik client (jika ada), agar tetap muncul walau statusnya bukan "available".
        $availablePorts = \App\Models\DataOdpPort::select('id', 'odp_id', 'port_numb', 'status')
            ->where('status', 'available')
            ->orWhere(function ($q) use ($client) {
                if ($client->odp_port_id) {
                    $q->where('id', $client->odp_port_id);
                }
            })
            ->orderBy('odp_id')
            ->orderBy('port_numb')
            ->get();

        return view('admin.pelanggan.process', [
            'client'         => $client,
            'odps'           => $odps,
            'availablePorts' => $availablePorts,
        ]);
    }


    /**
     * Simpan hasil pemilihan ODP & Port:
     * - clients: set odp_id, odp_port_id, active_user = now()
     * - data_odp_port: set client_id & status = 'reserved'
     */
    public function store(Request $request, string $id)
    {
        $client = DataClients::find($id);
        if (!$client) {
            abort(404, 'Data pelanggan tidak ditemukan.');
        }

        // Validasi dasar
        $validated = $request->validate([
            'odp_id'      => ['required', 'uuid', Rule::exists('data_odp', 'id')],
            'odp_port_id' => ['required', 'uuid', Rule::exists('data_odp_port', 'id')],
        ]);

        // Pastikan port yang dipilih:
        // - status masih 'available'
        // - memang milik ODP yang dipilih
        $port = DataOdpPort::where('id', $validated['odp_port_id'])
            ->where('odp_id', $validated['odp_id'])
            ->where('status', 'available')
            ->first();

        if (!$port) {
            return back()
                ->withErrors(['odp_port_id' => 'Port tidak tersedia / tidak cocok dengan ODP terpilih.'])
                ->withInput();
        }

        DB::transaction(function () use ($client, $validated, $port) {
            // Update client
            $client->update([
                'odp_id'      => $validated['odp_id'],
                'odp_port_id' => $port->id,
                'active_user' => now(),
                'status'    => 'active',
            ]);

            // Update port
            $port->update([
                'client_id' => $client->id,
                'status'    => 'reserved',
            ]);
        });

        return redirect()
            ->route('admin.pelanggan.show', $client->id)
            ->with('success', 'Pemasangan diproses: ODP & port berhasil direservasi untuk pelanggan.');
    }
}
