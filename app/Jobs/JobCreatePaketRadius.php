<?php

namespace App\Jobs;

use App\Models\DataPaket;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use App\Services\Radius\RadiusAPIService;

class JobCreatePaketRadius implements ShouldQueue
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
            Log::warning("[JobCreatePaketRadius] DataPaket tidak lengkap atau tidak ditemukan.", ['paket_id' => $this->paketId]);
            return;
        }

        try {
            $service = new RadiusAPIService();
            $response = $service->createGroup(
                $paket->name_profile,
                $paket->limit_radius,
                $paket->ip_pool
            );

            Log::info("[JobCreatePaketRadius] Radius group berhasil dibuat.", [
                'group' => $paket->name_profile,
                'response' => $response,
            ]);
        } catch (\Exception $e) {
            Log::error("[JobCreatePaketRadius] Gagal mengirim ke Radius API.", [
                'error' => $e->getMessage(),
                'paket_id' => $this->paketId
            ]);
        }
    }
}
