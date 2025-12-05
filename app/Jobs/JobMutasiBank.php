<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Models\DataMutasi;
use App\Services\Moota\MootaService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class JobMutasiBank implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function handle(MootaService $service)
    {
        $mutasiList = $service->fetchMutasi($this->startDate, $this->endDate);

        foreach ($mutasiList as $item) {
            if (DataMutasi::where('mutation_id', $item['mutation_id'])->exists()) {
                continue;
            }

            DataMutasi::create([
                'mutation_id'    => $item['mutation_id'],
                'account_number' => $item['account_number'],
                'type'           => $item['type'],
                'bank'           => $item['bank']['label'] ?? '-',
                'bank_name'      => $item['bank']['atas_nama'] ?? '-',
                'description'    => $item['description'],
                'amount'         => (int) $item['amount'],
                'balance'        => $item['balance'],
                'date'           => $item['created_at'],
            ]);
        }
    }
}
