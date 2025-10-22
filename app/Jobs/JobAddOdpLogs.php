<?php

namespace App\Jobs;

use App\Models\DataOdp;
use App\Models\DataOdpPort;
use App\Models\DataClients;
use App\Models\DataOdpLogs;
use App\Models\DataClientLogs; // <— tambah ini
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class JobAddOdpLogs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $actorId;
    protected string $actorName;
    protected string $clientId;
    protected string $odpId;
    protected string $portId;

    /**
     * Buat instance job baru.
     */
    public function __construct(string $actorId, string $actorName, string $clientId, string $odpId, string $portId)
    {
        $this->actorId = $actorId;
        $this->actorName = $actorName;
        $this->clientId = $clientId;
        $this->odpId = $odpId;
        $this->portId = $portId;
    }

    /**
     * Jalankan job.
     */
    public function handle(): void
    {
        try {
            $odpKode = DataOdp::where('id', $this->odpId)->value('kode_odp') ?? $this->odpId;
            $portKode = DataOdpPort::where('id', $this->portId)->value('port_numb') ?? $this->portId;
            $clientName = DataClients::where('id', $this->clientId)->value('nama') ?? $this->clientId;

            $odpExists = DataOdp::where('id', $this->odpId)->exists();
            $portExists = DataOdpPort::where('id', $this->portId)->exists();


            // 🔹 Log ke DataOdpLogs
            DataOdpLogs::create([
                'users_id'  => $this->actorId,
                'odp_id'    => $odpExists ? $this->odpId : null,
                'odp_port'  => $portExists ? $this->portId : null,
                'client_id' => $this->clientId,
                'status'    => sprintf(
                    'User %s telah menambahkan relasi ODP(%s)/Port(%s) dari Client (%s)',
                    $this->actorName,
                    $odpKode,
                    $portKode,
                    $clientName
                ),
            ]);

            // 🔹 Log ke DataClientLogs
            DataClientLogs::create([
                'users_id'  => $this->actorId,
                'client_id' => $this->clientId,
                'status'    => sprintf(
                    'User %s telah memproses koneksi baru relasi dari Client (%s) ke ODP(%s)/Port(%s) dari Client (%s)',
                    $this->actorName,
                    $odpKode,
                    $portKode,
                    $clientName
                ),
            ]);

            // Log::info('[JobAddOdpLogs] ✅ Log berhasil dibuat', [
            //     'client_id' => $this->clientId,
            //     'odp_id' => $this->odpId,
            //     'port_id' => $this->portId,
            // ]);

        } catch (\Throwable $e) {
            Log::error('[JobAddOdpLogs] ❌ Gagal membuat log aktivitas', [
                'error' => $e->getMessage(),
                'client_id' => $this->clientId,
                'odp_id' => $this->odpId,
                'port_id' => $this->portId,
            ]);
        }
    }
}
