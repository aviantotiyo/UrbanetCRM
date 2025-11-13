<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\DataBilling;
use Carbon\Carbon;

class ResetExpiredBilling extends Command
{
    protected $signature = 'billing:reset-expired';
    protected $description = 'Reset tagihan yang expired hari ini dan belum diproses (UNPAID & bank_check NULL)';

    public function handle()
    {
        $today = Carbon::today();
        $now   = Carbon::now();

        // Ambil tagihan yang:
        // - bank_check NULL
        // - status UNPAID
        // - exp_tx_bank hari ini
        // - exp_tx_bank sudah lewat
        $expiredBillings = DataBilling::whereNull('bank_check')
            ->where('status', 'UNPAID')
            ->whereDate('exp_tx_bank', $today)
            ->where('exp_tx_bank', '<=', $now)
            ->get();

        if ($expiredBillings->isEmpty()) {
            $this->info("Tidak ada tagihan expired.");
            return;
        }

        foreach ($expiredBillings as $billing) {
            $billing->update([
                'payment_method'   => null,
                'payment_name'     => null,
                'total_amount'     => null,
                'fee_merchant'     => null,
                'amount_received'  => null,
                'tax'              => null,
                'after_tax'        => null,
                'kode_unik'        => null,
                'bank_name_manual' => null,
                'exp_tx_bank'      => null,
                'partner_id'       => null,
            ]);
        }

        $this->info(count($expiredBillings) . " tagihan expired berhasil direset.");
    }
}
