<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\JobCheckBankPayment;

class CheckBankPayment extends Command
{

    protected $signature = 'app:check-bank-payment';
    protected $description = 'Check nilai mutasi ke billing pelanggan';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        JobCheckBankPayment::dispatch();
        $this->info('JobCheckBankPayment dispatched!');
    }
}
