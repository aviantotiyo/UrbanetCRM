<?php

namespace App\Http\Controllers\Odc;

use App\Http\Controllers\Controller;
use App\Models\DataOdc;
use App\Models\DataOdp;
use App\Models\DataOdcPort;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OdcPortController extends Controller
{
    /**
     * Form tambah ODC Port untuk ODC tertentu.
     */
    public function create(string $odcId)
    {
        $odc = DataOdc::find($odcId);
        if (!$odc) {
            abort(404, 'ODC tidak ditemukan.');
        }

        // Ambil daftar ODP untuk dipilih (urutkan sesuai kebutuhan)
        $odps = DataOdp::orderBy('kode_odp')->get(['id', 'kode_odp', 'nama_odp']);

        $statuses = ['available', 'reserved', 'active', 'faulty', 'blocked'];

        return view('admin.odc_port.tambah', compact('odc', 'odps', 'statuses'));
    }

    /**
     * Simpan ODC Port untuk ODC tertentu.
     */
    public function store(Request $request, string $odcId)
    {
        $odc = DataOdc::find($odcId);
        if (!$odc) {
            abort(404, 'ODC tidak ditemukan.');
        }

        // Normalisasi ringan
        $request->merge([
            'port_numb' => is_string($request->input('port_numb'))
                ? trim($request->input('port_numb'))
                : $request->input('port_numb'),
        ]);

        // Validasi:
        // - odp_id: wajib, uuid, harus ada di data_odp
        // - port_numb: wajib, string, unik per ODC (unique (odc_id, port_numb))
        // - status: enum
        $validated = $request->validate([
            'odp_id' => ['required', 'uuid', Rule::exists('data_odp', 'id')],
            'port_numb' => [
                'required',
                'string',
                'max:64',
                'regex:/^[A-Za-z0-9_\-\.]+$/', // alnum + _ - .
                Rule::unique('data_odc_port', 'port_numb')
                    ->where(fn($q) => $q->where('odc_id', $odcId)),
            ],
            'status' => ['required', Rule::in(['available', 'reserved', 'active', 'faulty', 'blocked'])],
        ], [
            'port_numb.regex' => 'Format port hanya boleh huruf/angka, underscore (_), minus (-), atau titik (.)',
        ]);

        DataOdcPort::create([
            'odc_id'    => $odc->id,                 // dari URL
            'odp_id'    => $validated['odp_id'],
            'port_numb' => $validated['port_numb'],
            'status'    => $validated['status'],
        ]);

        return redirect()

            ->route('admin.odc.show', $odc->id)
            ->with('success', "Port {$validated['port_numb']} berhasil ditambahkan ke ODC {$odc->kode_odc}.");
    }

    /**
     * Form edit ODC Port (berdasarkan id port).
     */
    public function edit(string $portId)
    {
        $port = DataOdcPort::with(['odc', 'odp'])->find($portId);
        if (!$port) {
            abort(404, 'Port ODC tidak ditemukan.');
        }

        // daftar ODP untuk pilihan tujuan
        $odps = DataOdp::orderBy('kode_odp')->get(['id', 'kode_odp', 'nama_odp']);

        // enum status
        $statuses = DataOdcPort::STATUSES ?? ['available', 'reserved', 'active', 'faulty', 'blocked'];

        return view('admin.odc_port.edit', [
            'port'     => $port,
            'odps'     => $odps,
            'statuses' => $statuses,
        ]);
    }

    /**
     * Update ODC Port.
     */
    public function update(\Illuminate\Http\Request $request, string $portId)
    {
        $port = DataOdcPort::with('odc')->find($portId);
        if (!$port) {
            abort(404, 'Port ODC tidak ditemukan.');
        }

        // Validasi: odp_id wajib valid; port_numb unik per ODC (kecuali dirinya sendiri); status valid
        $validated = $request->validate([
            'odp_id' => ['required', 'uuid', Rule::exists('data_odp', 'id')],
            'port_numb' => [
                'required',
                'string',
                'max:64',
                'regex:/^[A-Za-z0-9_\-\.]+$/',
                // unique (odc_id, port_numb) tapi abaikan id saat ini
                Rule::unique('data_odc_port', 'port_numb')
                    ->where(fn($q) => $q->where('odc_id', $port->odc_id))
                    ->ignore($port->id),
            ],
            'status' => ['required', Rule::in(['available', 'reserved', 'active', 'faulty', 'blocked'])],
        ], [
            'port_numb.regex' => 'Format port hanya boleh huruf/angka, underscore (_), minus (-), atau titik (.)',
        ]);

        $port->update([
            'odp_id'    => $validated['odp_id'],
            'port_numb' => $validated['port_numb'],
            'status'    => $validated['status'],
        ]);

        return redirect()
            ->route('admin.odc.show', $port->odc_id)
            ->with('success', "Port {$port->port_numb} berhasil diperbarui.");
    }
}
