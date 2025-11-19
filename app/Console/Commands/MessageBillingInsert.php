<?php

// Kirim pesan ketika tagihan di buat

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\DataBilling;
use App\Jobs\MessageReminderBilling;
use Carbon\Carbon;

class MessageBillingInsert extends Command
{
    protected $signature = 'billing:message-insert';
    protected $description = 'Ambil 3 tagihan UNPAID dan belum dikirim pesan, lalu masukkan ke Job untuk dikirimkan via WhatsApp';

    public function handle()
    {
        $now = Carbon::now();

        $billings = DataBilling::where('status', 'UNPAID')
            ->where('message_count', 0)
            ->where('new_member', 0)
            ->whereYear('billing_create', $now->year)
            ->whereMonth('billing_create', $now->month)
            ->limit(3)
            ->get();

        if ($billings->isEmpty()) {
            $this->info('Tidak ada data tagihan yang perlu dikirim pesan.');
            return Command::SUCCESS;
        }

        foreach ($billings as $billing) {
            MessageReminderBilling::dispatch($billing->id);
            $this->info("Job dikirim untuk billing ID: {$billing->id}");
        }

        return Command::SUCCESS;
    }
}
