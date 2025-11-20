<?php

// Kirim pesan Inactive
// ambil setidaknya satu bulan lalu


namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\DataBilling;
use App\Jobs\JobInactiveUser;
use Carbon\Carbon;

class InactiveUser extends Command
{
    protected $signature = 'billing:inactive-user';
    protected $description = 'Ambil 3 tagihan UNPAID dan belum dikirim pesan, lalu masukkan ke Job untuk dikirimkan via WhatsApp';

    public function handle()
    {
        $now = Carbon::now();

        $billings = DataBilling::where('status', 'UNPAID')
            ->where('message_count', 4)
            ->where('new_member', 0)
            ->whereDate('billing_create', '<', now()->startOfMonth())
            ->limit(3)
            ->get();

        if ($billings->isEmpty()) {
            $this->info('Tidak ada data tagihan yang perlu dikirim pesan.');
            return Command::SUCCESS;
        }

        foreach ($billings as $billing) {
            JobInactiveUser::dispatch($billing->id);
            $this->info("Job dikirim untuk billing ID: {$billing->id}");
        }

        return Command::SUCCESS;
    }
}
