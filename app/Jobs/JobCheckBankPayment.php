<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\DataBilling;
use App\Models\DataMutasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Jobs\WAMessage\PaidBillingAgent;

class JobCheckBankPayment implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $mutasiList = DataMutasi::where('mutasi_check', 0)
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->get();


        foreach ($mutasiList as $mutasi) {
            $amount = (int) $mutasi->amount;
            $bank = strtoupper($mutasi->bank);

            $billing = DataBilling::where('bank_check', 1)
                ->where('payment_method', 'MITRA')
                ->where('bank_name_manual', $bank)
                ->where('total_amount', $amount)
                ->first();

            if ($billing) {
                DB::transaction(function () use ($billing, $mutasi) {
                    $billing->update([
                        'status' => 'PAID',
                        'billing_paid' => now(),
                    ]);

                    $mutasi->update([
                        'mutasi_check' => 1,
                        'mutasi_check_time' => now(),
                    ]);
                });
                PaidBillingAgent::dispatch($billing->id);
            }
        }
    }
}
