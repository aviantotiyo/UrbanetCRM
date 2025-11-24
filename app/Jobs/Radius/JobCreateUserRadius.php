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
        $client = \App\Models\DataClients::find($this->clientId);

        if (!$client || !$client->user_pppoe || !$client->pass_pppoe || !$client->paket) {
            return;
        }

        $radius = new \App\Services\Radius\RadiusAPIService();

        $radius->createUser([
            'username' => $client->user_pppoe,
            'password' => $client->pass_pppoe,
        ]);

        $radius->assignUserToGroup(
            $client->user_pppoe,
            $client->paket
        );
    }
}
