<?php

namespace App\Http\Controllers\Odc;

use App\Http\Controllers\Controller;
use App\Models\DataOdc;
use App\Models\DataOdp;
use App\Models\DataOdcPort;
use App\Models\DataOdpLogs;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

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

        // Normalisasi input port number
        $request->merge([
            'port_numb' => is_string($request->input('port_numb'))
                ? trim($request->input('port_numb'))
                : $request->input('port_numb'),
        ]);

        // Validasi input
        $validated = $request->validate([
            'odp_id' => ['required', 'uuid', Rule::exists('data_odp', 'id')],
            'port_numb' => [
                'required',
                'string',
                'max:64',
                'regex:/^[A-Za-z0-9_\-\.]+$/',
                Rule::unique('data_odc_port', 'port_numb')
                    ->where(fn($q) => $q->where('odc_id', $odcId)),
            ],
            'status' => ['required', Rule::in(['available', 'reserved', 'active', 'faulty', 'blocked'])],
        ], [
            'port_numb.regex' => 'Format port hanya boleh huruf/angka, underscore (_), minus (-), atau titik (.)',
        ]);

        // Buat entri baru ODC Port
        $port = DataOdcPort::create([
            'odc_id'    => $odc->id,
            'odp_id'    => $validated['odp_id'],
            'port_numb' => $validated['port_numb'],
            'status'    => $validated['status'],
        ]);

        // Simpan log ke DataOdpLogs
        DataOdpLogs::create([
            'users_id' => Auth::id(),
            'status'   => sprintf(
                "User %s menambahkan Port ODC (%s) [%s] ke ODC %s pada %s",
                Auth::user()->name ?? 'Unknown',
                $port->port_numb,
                $port->status,
                $odc->kode_odc,
                now()->format('d/m/Y H:i')
            ),
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
    public function update(Request $request, string $portId)
    {
        $port = DataOdcPort::with('odc')->find($portId);
        if (!$port) {
            abort(404, 'Port ODC tidak ditemukan.');
        }

        $validated = $request->validate([
            'odp_id' => ['required', 'uuid', Rule::exists('data_odp', 'id')],
            'port_numb' => [
                'required',
                'string',
                'max:64',
                'regex:/^[A-Za-z0-9_\-\.]+$/',
                Rule::unique('data_odc_port', 'port_numb')
                    ->where(fn($q) => $q->where('odc_id', $port->odc_id))
                    ->ignore($port->id),
            ],
            'status' => ['required', Rule::in(['available', 'reserved', 'active', 'faulty', 'blocked'])],
        ], [
            'port_numb.regex' => 'Format port hanya boleh huruf/angka, underscore (_), minus (-), atau titik (.)',
        ]);

        // Deteksi perubahan
        $changes = [];
        if ($port->odp_id !== $validated['odp_id']) {
            $changes[] = "ODP ID diubah";
        }
        if ($port->port_numb !== $validated['port_numb']) {
            $changes[] = "Port Number diubah dari {$port->port_numb} ke {$validated['port_numb']}";
        }
        if ($port->status !== $validated['status']) {
            $changes[] = "Status diubah dari {$port->status} ke {$validated['status']}";
        }

        // Update data
        $port->update($validated);

        // Simpan log jika ada perubahan
        if (!empty($changes)) {
            DataOdpLogs::create([
                'users_id' => Auth::id(),
                'status'   => sprintf(
                    "User %s mengedit Port ODC %s pada ODC (%s) pada %s. Perubahan: %s",
                    Auth::user()->name ?? 'Unknown',
                    $port->port_numb,
                    $port->odc->kode_odc ?? '-',
                    now()->format('d/m/Y H:i'),
                    implode('; ', $changes)
                ),
            ]);
        }

        return redirect()
            ->route('admin.odc.show', $port->odc_id)
            ->with('success', "Port {$port->port_numb} berhasil diperbarui.");
    }
}
