<?php

namespace App\Jobs\Radius;

use App\Models\DataPaket;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
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
        Log::info("[JobEditUserGroup] Mulai handle job untuk paket ID: {$this->paketId}");

        $paket = DataPaket::find($this->paketId);

        if (!$paket || !$paket->name_profile || !$paket->limit_radius || !$paket->ip_pool) {
            Log::warning("[JobEditUserGroup] DataPaket tidak lengkap atau tidak ditemukan.", ['paket_id' => $this->paketId]);
            return;
        }

        try {
            $service = new RadiusAPIService();
            $response = $service->updateGroup(
                $paket->name_profile,
                $paket->limit_radius,
                $paket->ip_pool
            );

            Log::info("[JobEditUserGroup] Radius group berhasil diperbarui.", [
                'group' => $paket->name_profile,
                'response' => $response,
            ]);
        } catch (\Exception $e) {
            Log::error("[JobEditUserGroup] Gagal update ke Radius API.", [
                'error' => $e->getMessage(),
                'paket_id' => $this->paketId
            ]);
        }
    }
}
