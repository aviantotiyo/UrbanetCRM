<?php

use Illuminate\Foundation\Inspiring;
use App\Console\Commands\CheckPromoEnd;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Console\Commands\ResetExpiredBilling;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Schedule::command(ResetExpiredBilling::class)->everyFiveMinutes()->withoutOverlapping();
Schedule::command(CheckPromoEnd::class)->everyFiveMinutes()->withoutOverlapping();
