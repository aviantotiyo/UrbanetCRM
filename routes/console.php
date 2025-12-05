<?php

use App\Console\Commands\IsolirUser;

use Illuminate\Foundation\Inspiring;
use App\Console\Commands\SuspendUser;

use App\Console\Commands\InactiveUser;
use App\Console\Commands\CheckPromoEnd;
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\BillingBulanan;
use Illuminate\Support\Facades\Schedule;
use App\Console\Commands\ResetExpiredBilling;
use App\Console\Commands\MessageBillingInsert;
use App\Console\Commands\MessageBillingBulanan;
use App\Console\Commands\GetMutasiBank;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Schedule::command(ResetExpiredBilling::class)->everyFiveMinutes()->withoutOverlapping();
Schedule::command(CheckPromoEnd::class)->everyFiveMinutes()->withoutOverlapping();

// Jadwal rutin bulanan
Schedule::command(BillingBulanan::class)->monthlyOn(1, '01:00');
// Kirim info awal tagihan
Schedule::command(MessageBillingInsert::class)
    ->everyTenMinutes()
    ->when(function () {
        return now()->day === 1 && now()->between('08:00', '19:00');
    })
    ->withoutOverlapping();
// Kirim info tagihan pengingat
Schedule::command(MessageBillingBulanan::class)
    ->everyTenMinutes()
    ->when(function () {
        return now()->day === 10 && now()->between('08:00', '19:00');
    })
    ->withoutOverlapping();

Schedule::command(IsolirUser::class)
    ->everyTenMinutes()
    ->when(function () {
        return now()->day === 15 && now()->between('08:00', '19:00');
    })
    ->withoutOverlapping();

Schedule::command(SuspendUser::class)
    ->everyTenMinutes()
    ->when(function () {
        return now()->isSameDay(now()->copy()->endOfMonth()) &&
            now()->between('08:00', '19:00');
    })
    ->withoutOverlapping();

Schedule::command(InactiveUser::class)
    ->everyTenMinutes()
    // ->when(function () {
    //     return now()->isSameDay(now()->copy()->endOfMonth()) &&
    //         now()->between('08:00', '19:00');
    // })
    ->withoutOverlapping();


// Jadwal check mutasi ke moota
Schedule::command(GetMutasiBank::class)->everyFiveMinutes()->withoutOverlapping();
