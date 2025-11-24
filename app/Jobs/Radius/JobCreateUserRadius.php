<?php

namespace App\Jobs\Radius;

use App\Models\DataClients;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class JobCreateUserRadius implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $clientId;

    /**
     * Create a new job instance.
     */
    public function __construct(string $clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $client = DataClients::find($this->clientId);

        if (!$client || !$client->user_pppoe || !$client->pass_pppoe) {
            Log::warning("Gagal buat user Radius. Data tidak lengkap untuk client ID: {$this->clientId}");
            return;
        }

        $apiUrl = rtrim(config('radius.base_url'), '/') . '/api/users';
        $apiUrlGroup = rtrim(config('radius.base_url'), '/') . '/api/user-group';

        $apiKey = config('radius.api_key');

        // Log::info('⛳ [JobCreateUserRadius] URL & KEY', [
        //     'url' => $apiUrl,
        //     'key' => $apiKey,
        // ]);

        $response = Http::withHeaders([
            'x-api-key' => $apiKey,
            'Content-Type' => 'application/json',
        ])->post($apiUrl, [
            'username' => $client->user_pppoe,
            'password' => $client->pass_pppoe,
        ]);

        $response = Http::withHeaders([
            'x-api-key' => $apiKey,
            'Content-Type' => 'application/json',
        ])->post($apiUrlGroup, [
            'username' => $client->user_pppoe,
            'groupname' => $client->paket,
        ]);


        // if ($response->successful()) {
        //     Log::info("✅ Berhasil buat user Radius untuk {$client->user_pppoe}");
        // } else {
        //     Log::error("❌ Gagal buat user Radius untuk {$client->user_pppoe}", [
        //         'status' => $response->status(),
        //         'body'   => $response->body(),
        //     ]);
        // }
    }
}
