<?php

namespace App\Http\Controllers\PelangganCsr;

use App\Http\Controllers\Controller;
use App\Models\DataCsr;
use App\Models\DataOdp;
use App\Models\DataOdpPort;
use Illuminate\Support\Facades\Auth;
use App\Models\DataOdpLogs;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProcessCsrController extends Controller
{
    public function inactive($id)
    {
        $data = DataCsr::findOrFail($id);

        // Ambil data lama sebelum dihapus
        $odpId = $data->odp_id;
        $odpPortId = $data->odp_port_id;
        $clientName = $data->nama;

        // Ambil info kode_odp dan port_numb jika ada
        $kodeOdp = optional(DataOdp::find($odpId))->kode_odp ?? 'ODP-UNKNOWN';
        $portNumb = optional(DataOdpPort::find($odpPortId))->port_numb ?? 'PORT-UNKNOWN';

        // Update CSR jadi inactive dan kosongkan ODP
        $data->update([
            'odp_id' => null,
            'odp_port_id' => null,
            'status' => 'inactive',
        ]);

        // Kosongkan port
        DataOdpPort::where('client_csr_id', $id)->update([
            'client_csr_id' => null,
            'status' => 'available',
        ]);

        // Log jika sebelumnya ada ODP
        if ($odpId && $odpPortId) {
            DataOdpLogs::create([
                'users_id' => Auth::id(),
                'odp_id'   => $odpId,
                'odp_port' => $odpPortId,
                'status'   => "User CSR '{$clientName}' dinonaktifkan dari ODP {$kodeOdp}, Port {$portNumb} oleh " . (Auth::user()?->name ?? 'Unknown User') . " pada " . Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }

        return redirect()->back()->with('success', 'Pelanggan saat ini telah di nonaktifkan.');
    }

    public function isolirCsr($id)
    {
        // Temukan data CSR
        $data = DataCsr::findOrFail($id);

        $data->update([
            'status' => 'isolir',
        ]);

        return redirect()->back()->with('success', 'Pelanggan saat ini telah di isolir.');
    }
}
