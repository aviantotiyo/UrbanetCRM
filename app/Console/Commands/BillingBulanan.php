<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Str;
use App\Models\DataClients;
use App\Jobs\GenerateBillingForClient;

class BillingBulanan extends Command
{
    protected $signature = 'billing:bulanan {--force : Jalankan meskipun bukan tanggal 1}';
    protected $description = 'Generate billing bulanan untuk semua client aktif (tanpa promo)';

    public function handle()
    {
        if (now()->day !== 1 && !$this->option('force')) {
            $this->warn('Command ini hanya seharusnya dijalankan tanggal 1. Gunakan --force jika perlu.');
            return Command::SUCCESS;
        }

        $this->info('Mengambil data klien aktif...');

        $totalJobs = 0;

        DataClients::where('status', 'active')
            ->where('status_promo', 0)
            ->chunk(1000, function ($clients) use (&$totalJobs) {
                $jobs = [];

                foreach ($clients as $client) {
                    $jobs[] = new GenerateBillingForClient($client->id);
                    $totalJobs++;
                }

                if (!empty($jobs)) {
                    Bus::batch($jobs)
                        ->name('Generate Billing Bulanan')
                        ->dispatch();
                }
            });

        if ($totalJobs === 0) {
            $this->info('Tidak ada klien aktif untuk ditagih.');
        } else {
            $this->info("Total {$totalJobs} job telah dikirim ke queue dalam batch.");
        }

        return Command::SUCCESS;
    }
}
