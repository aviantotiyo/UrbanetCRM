<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url') . "/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });

        Auth::setRememberDuration(60 * 24 * 30);
        // Rate limit brute-force login: 5 percobaan / menit per IP+email
        RateLimiter::for('login', function (Request $request) {
            $key = $request->ip() . '|' . mb_strtolower($request->input('email', 'guest'));
            return [Limit::perMinute(5)->by($key)];
        });

        Paginator::useBootstrapFive();
    }
}
