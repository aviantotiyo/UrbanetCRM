<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\DataBilling;
use App\Models\DataClients;
use Illuminate\Support\Str;
use App\Models\DataBillingItem;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;


class CheckPromoEnd extends Command
{
    protected $signature = 'promo:check-end';
    protected $description = 'Cek promo_day_end pada DataClients dan buat billing jika masa promo sudah selesai';

    public function handle()
    {
        $now = Carbon::now();

        // Ambil client yang masih status promo
        $clients = DataClients::where('status_promo', 1)
            ->whereDate('promo_day_end', '<', $now) // promo lewat
            ->get();

        if ($clients->isEmpty()) {
            $this->info("Tidak ada client yang promo-nya berakhir.");
            return Command::SUCCESS;
        }

        foreach ($clients as $client) {
            DB::transaction(function () use ($client) {
                $this->createBillingIfNotExist($client);
            });


            $this->info("Billing dibuat untuk client: {$client->id}");
        }

        return Command::SUCCESS;
    }


    /**
     * Buat billing jika belum ada billing bulan ini
     */
    private function createBillingIfNotExist($client)
    {
        $year  = now()->year;
        $month = now()->month;

        // Cek apakah billing bulan ini sudah ada
        $exists = DataBilling::where('client_id', $client->id)
            ->whereYear('billing_create', $year)
            ->whereMonth('billing_create', $month)
            ->exists();

        if ($exists) {
            return; // Jangan buat lagi
        }

        // Generate merchant_ref unik: ID + 8 alphanumeric
        $merchant_ref = $this->generateUniqueMerchantRef();

        // Create DataBilling
        DataBilling::create([
            'client_id'      => $client->id,
            'new_member'     => 1,
            'merchant_ref'   => $merchant_ref,
            'status'         => 'UNPAID',
            'billing_create' => now(),
        ]);

        // Create DataBillingItem
        DataBillingItem::create([
            'merchant_ref_id' => $merchant_ref,
            'sku'             => $client->name_profile,
            'name'            => $client->paket,
            'amount'          => $client->tagihan,
            'billing_cycle'   => now(),
        ]);

        $client->update([
            'status_promo' => 0
        ]);
    }


    /**
     * Generate unik merchant_ref
     * Format: ID + 8 alphanumeric (A-Z,0-9)
     */
    private function generateUniqueMerchantRef()
    {
        do {
            $random = strtoupper(Str::random(8)); // A-Z0-9
            $ref = "ID{$random}";
            $exists = DataBilling::where('merchant_ref', $ref)->exists();
        } while ($exists);

        return $ref;
    }
}
