<?php

namespace App\Http\Controllers\Pelanggan;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\DataClients;
use App\Models\DataOdpPort;
use App\Models\DataOdpLogs;
use App\Models\DataOdp;


class InactiveController extends Controller
{
    /**
     * Soft-delete / nonaktifkan pelanggan (set status inactive dan lepaskan port)
     */
    public function softDelete(string $id)
    {
        $client = DataClients::findOrFail($id);

        // ⏹ Simpan data lama SEBELUM transaksi
        $oldPortId = $client->odp_port_id;
        $oldOdpId  = $client->odp_id;
        $clientName = $client->nama ?? 'UNKNOWN';

        DB::transaction(function () use ($client, $oldPortId) {
            // Update client: set inactive & clear ODP refs
            $client->status = 'inactive';
            $client->odp_id = null;
            $client->odp_port_id = null;
            $client->save();

            // Jika ada port yang terkait, lepaskan
            if ($oldPortId) {
                $port = DataOdpPort::find($oldPortId);
                if ($port) {
                    $port->client_id = null;
                    $port->status = 'available';
                    $port->save();
                }
            }
        });

        // 🔁 Gunakan oldOdpId dan oldPortId agar tetap terbaca
        $odpKode   = DataOdp::where('id', $oldOdpId)->value('kode_odp') ?? $oldOdpId;
        $portKode  = DataOdpPort::where('id', $oldPortId)->value('port_numb') ?? $oldPortId;

        $odpExists  = DataOdp::where('id', $oldOdpId)->exists();
        $portExists = DataOdpPort::where('id', $oldPortId)->exists();

        DataOdpLogs::create([
            'users_id'  => Auth::id(),
            'odp_id'    => $odpExists ? $oldOdpId : null,
            'odp_port'  => $portExists ? $oldPortId : null,
            'client_id' => $client->id,
            'status'    => sprintf(
                'User %s telah menonaktifkan Client (%s) dan melepas relasi ODP(%s)/Port(%s)',
                Auth::user()->name,
                $clientName,
                $odpKode,
                $portKode
            ),
        ]);

        return redirect()->back()->with('success', 'Pelanggan dinonaktifkan dan port ODP dilepaskan.');
    }
}
