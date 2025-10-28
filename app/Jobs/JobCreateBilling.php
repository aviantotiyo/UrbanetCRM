<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Str;
use App\Models\DataBilling;
use App\Models\DataClients;
use App\Models\DataBillingItem;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class JobCreateBilling implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $clientId;

    public function __construct(string $clientId)
    {
        $this->clientId = $clientId;
    }

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

        // Generate merchant_ref seperti INV-09RT09WE
        $merchantRef = 'INV-' .
            rand(10, 99) .
            strtoupper(Str::random(2)) .
            rand(10, 99) .
            strtoupper(Str::random(2));

        // Buat DataBilling utama
        $billing = DataBilling::create([
            'client_id'     => $client->id,
            'merchant_ref'  => $merchantRef,
            'billing_create' => $today,
            'status'        => 'PENDING',
            'new_member'    => 1,
        ]);

        // Buat DataBillingItem terlebih dahulu
        $item = DataBillingItem::create([
            'sku'              => $client->name_profile,
            'name'             => $client->paket,
            'amount'           => $prorata,
            'billing_cycle'    => $today,
            'merchant_ref_id'  => $merchantRef,
        ]);
    }
}
