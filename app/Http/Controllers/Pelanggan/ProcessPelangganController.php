<?php

namespace App\Http\Controllers\Pelanggan;

use App\Models\DataOdp;
use App\Jobs\JobAddOdpLogs;
use App\Models\DataClients;
use App\Models\DataOdpLogs;
use App\Models\DataOdpPort;
use Illuminate\Http\Request;
use App\Jobs\JobCreateBilling;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProcessPelangganController extends Controller
{
    /**
     * Tampilkan form proses pemasangan (pilih ODP & Port).
     */
    public function create(Request $request, string $id)
    {
        $client = DataClients::find($id);
        if (!$client) {
            abort(404, 'Data pelanggan tidak ditemukan.');
        }

        $odps = DataOdp::orderBy('kode_odp')->get(['id', 'kode_odp', 'nama_odp']);

        $availablePorts = DataOdpPort::select('id', 'odp_id', 'port_numb', 'status')
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


    public function store(Request $request, string $id)
    {
        $client = DataClients::find($id);
        if (!$client) {
            abort(404, 'Data pelanggan tidak ditemukan.');
        }

        $validated = $request->validate([
            'odp_id'      => ['required', 'uuid', Rule::exists('data_odp', 'id')],
            'odp_port_id' => ['required', 'uuid', Rule::exists('data_odp_port', 'id')],
            'promo_day'   => ['nullable', 'integer', 'min:0', 'max:365'],
            'promo_start' => ['required', 'date'],
        ]);

        // Cek port valid dan masih available
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
            $promoDay = (int) ($validated['promo_day'] ?? 0);
            $promoStart = Carbon::parse($validated['promo_start']); // dari input datepicker


            // Logika promo
            if ($promoDay > 0) {
                $promoEnd = $promoStart->copy()->addDays($promoDay);
                $statusPromo = 1;
            } else {
                $promoEnd = null;
                $statusPromo = 0;
                JobCreateBilling::dispatch($client->id)->afterCommit();
            }


            // Update client
            $client->update([
                'odp_id'          => $validated['odp_id'],
                'odp_port_id'     => $port->id,
                'active_user'     => now(),
                'status'          => 'active',
                'promo_day'       => $promoDay,
                'promo_day_start' => $promoStart,
                'promo_day_end'   => $promoEnd,
                'status_promo'    => $statusPromo,
            ]);

            // Update port
            $port->update([
                'client_id' => $client->id,
                'status'    => 'reserved',
            ]);

            //Tambah log aktivitas

            $user = Auth::user();
            $actorId   = $user?->id;
            $actorName = $user?->name ?? 'Unknown User';

            // Dispatch job log
            JobAddOdpLogs::dispatch(
                $actorId,
                $actorName,
                $client->id,
                $validated['odp_id'],
                $validated['odp_port_id']
            )->afterCommit();
        });

        return redirect()
            ->route('admin.pelanggan.show', $client->id)
            ->with('success', 'Pemasangan diproses dan masa promo berhasil diset.');
    }
}
