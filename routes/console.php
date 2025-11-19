<?php

use Illuminate\Foundation\Inspiring;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

use App\Console\Commands\CheckPromoEnd;
use App\Console\Commands\ResetExpiredBilling;
use App\Console\Commands\BillingBulanan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Schedule::command(ResetExpiredBilling::class)->everyFiveMinutes()->withoutOverlapping();
Schedule::command(CheckPromoEnd::class)->everyFiveMinutes()->withoutOverlapping();
Schedule::command(BillingBulanan::class)->monthlyOn(1, '01:00');
