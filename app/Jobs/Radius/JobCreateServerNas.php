<?php

namespace App\Jobs\Radius;

use App\Models\DataServer;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Services\Radius\RadiusAPIService;

class JobCreateServerNas implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $serverId;

    public function __construct(string $serverId)
    {
        $this->serverId = $serverId;
    }

    public function handle(): void
    {
        $server = DataServer::find($this->serverId);

        if (!$server || !$server->ip_public || !$server->nama_pop || !$server->radius_secret) {
            return; // Optionally log or fail silently
        }

        $radius = new RadiusAPIService();

        $radius->createNas([
            'nasname'     => $server->ip_public,
            'shortname'   => $server->nama_pop,
            'type'        => 'mikrotik',
            'secret'      => $server->radius_secret,
            'server'      => '',
            'community'   => '',
            'description' => $server->lokasi ?? ''
        ]);
    }
}
