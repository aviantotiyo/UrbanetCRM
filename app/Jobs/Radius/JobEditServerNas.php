<?php

namespace App\Jobs\Radius;

use App\Models\DataServer;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Services\Radius\RadiusAPIService;
use Illuminate\Support\Facades\Log;

class JobEditServerNas implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $serverId;
    protected string $oldIp;

    public function __construct(string $serverId, string $oldIp)
    {
        $this->serverId = $serverId;
        $this->oldIp = $oldIp;
    }

    public function handle(): void
    {
        $server = DataServer::find($this->serverId);

        if (!$server || !$server->ip_public || !$server->nama_pop || !$server->radius_secret) {
            Log::warning('[JobEditServerNas] Data server tidak lengkap atau tidak ditemukan.', [
                'server_id' => $this->serverId,
            ]);
            return;
        }

        $radius = new RadiusAPIService();

        $response = $radius->updateNas($this->oldIp, [
            'nasname'     => $server->ip_public,
            'shortname'   => $server->nama_pop,
            'type'        => 'mikrotik',
            'secret'      => $server->radius_secret,
            'server'      => '',
            'community'   => '',
            'description' => $server->lokasi ?? '',
        ]);

        Log::info('[JobEditServerNas] NAS updated via API', [
            'server_id' => $this->serverId,
            'nasname'   => $server->ip_public,
            'response'  => $response,
        ]);
    }
}
