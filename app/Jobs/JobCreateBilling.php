<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\DataBilling;
use App\Models\DataClients;
use App\Models\DataBillingItem;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Str;
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
            $prorata = ceil(($client->tagihan / $daysInMonth) * ($daysInMonth - $dayToday));
        }

        // Cek apakah sudah ada billing UNPAID
        $billing = DataBilling::where('client_id', $client->id)
            ->where('status', 'UNPAID')
            ->first();

        if (! $billing) {
            // Buat merchant_ref baru
            $merchantRef = 'INV-' .
                rand(10, 99) .
                strtoupper(Str::random(2)) .
                rand(10, 99) .
                strtoupper(Str::random(2));

            // Buat billing baru
            $billing = DataBilling::create([
                'client_id'      => $client->id,
                'merchant_ref'   => $merchantRef,
                'billing_create' => $today,
                'status'         => 'UNPAID',
                'new_member'     => 1,
            ]);
        }

        // Tambahkan billing item
        DataBillingItem::create([
            'sku'              => $client->name_profile,
            'name'             => $client->paket,
            'amount'           => $prorata,
            'billing_cycle'    => $today,
            'merchant_ref_id'  => $billing->merchant_ref,
        ]);
    }
}
