<?php

// Dibuat untuk membuat invoice bulanan bagi pelanggan yang sudah aktif
// Client sudah tidak masa promo

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Bus\Batchable;
use Illuminate\Support\Str;
use App\Models\DataClients;
use App\Models\DataBilling;
use App\Models\DataBillingItem;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GenerateBillingForClient implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    protected $clientId;

    public function __construct($clientId)
    {
        $this->clientId = $clientId;
    }

    public function handle()
    {
        $client = DataClients::find($this->clientId);
        if (!$client) return;

        // Cek apakah billing sudah ada untuk bulan ini
        $exists = DataBilling::where('client_id', $client->id)
            ->whereYear('billing_create', now()->year)
            ->whereMonth('billing_create', now()->month)
            ->exists();

        if ($exists) return;

        // Generate unique merchant_ref
        $merchant_ref = $this->generateUniqueMerchantRef();

        $billing = DataBilling::create([
            'client_id'      => $client->id,
            'new_member'     => 1,
            'merchant_ref'   => $merchant_ref,
            'status'         => 'UNPAID',
            'billing_create' => now(),
        ]);

        DataBillingItem::create([
            'merchant_ref_id' => $merchant_ref,
            'sku'             => $client->name_profile,
            'name'            => $client->paket,
            'amount'          => $client->tagihan,
            'billing_cycle'   => now(),
        ]);
    }

    private function generateUniqueMerchantRef()
    {
        do {
            $random = strtoupper(Str::random(8));
            $ref = "INV-{$random}";
            $exists = DataBilling::where('merchant_ref', $ref)->exists();
        } while ($exists);

        return $ref;
    }
}
