<?php

namespace App\Jobs\Radius;

use App\Models\DataPaket;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Services\Radius\RadiusAPIService;

class JobEditUserGroup implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $paketId;

    public function __construct(string $paketId)
    {
        $this->paketId = $paketId;
    }

    public function handle(): void
    {
        $paket = DataPaket::find($this->paketId);

        if (!$paket || !$paket->name_profile || !$paket->limit_radius || !$paket->ip_pool) {
            return;
        }

        $service = new RadiusAPIService();
        $service->updateGroup(
            $paket->name_profile,
            $paket->limit_radius,
            $paket->ip_pool
        );
    }
}
