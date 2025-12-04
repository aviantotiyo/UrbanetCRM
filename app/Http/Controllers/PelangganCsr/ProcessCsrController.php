<?php

namespace App\Http\Controllers\PelangganCsr;

use App\Http\Controllers\Controller;
use App\Models\DataCsr;
use App\Models\DataOdpPort;
use Illuminate\Http\Request;

class ProcessCsrController extends Controller
{
    public function inactive($id)
    {
        // Temukan data CSR
        $data = DataCsr::findOrFail($id);

        // Set kolom ODP dan ODP Port di DataCsr menjadi null
        $data->update([
            'odp_id' => null,
            'odp_port_id' => null,
            'status' => 'inactive',
        ]);

        // Cari semua port yang terhubung ke client_csr_id ini
        DataOdpPort::where('client_csr_id', $id)->update([
            'client_csr_id' => null,
            'status' => 'available',
        ]);

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
