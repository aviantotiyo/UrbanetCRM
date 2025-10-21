<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\DataBilling;
use App\Models\DataClients;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class JobCreateBilling implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $clientId;

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
        if (! $client) return;

        $today = Carbon::now();
        $daysInMonth = $today->daysInMonth;
        $dayToday = $today->day;

        $prorata = 0;
        if ($client->tagihan && $daysInMonth > 0) {
            $prorata = ceil(
                ($client->tagihan / $daysInMonth) * ($daysInMonth - $dayToday)
            );
        }

        $billing = DataBilling::create([
            'client_id'      => $client->id,
            'name'           => $client->paket,
            'sku'            => $client->name_profile,
            'billing_cycle'  => $today,
            'billing_create' => $today,
            'status'         => 'PENDING',
            'amount'         => $prorata,
            'new_member'     => (int) 1, // explicit integer
        ]);
    }
}
