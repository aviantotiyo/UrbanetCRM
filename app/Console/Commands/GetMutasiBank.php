<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Moota\MootaService;
use App\Models\DataMutasi;
use App\Jobs\JobMutasiBank;

class GetMutasiBank extends Command
{
    protected $signature = 'mutasi:get';
    protected $description = 'Ambil data mutasi bank dari Moota';

    public function handle()
    {
        $start = now()->format('Y-m-d');
        $end = now()->format('Y-m-d');

        JobMutasiBank::dispatch($start, $end);
        $this->info("Job Mutasi Bank berhasil dikirim ke queue.");
    }
}
