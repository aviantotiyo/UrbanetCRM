<?php

namespace App\Providers;

use App\Models\DataClientsProspect;
use App\Models\DataClientsRegist;
use App\Models\DataClients;
use App\Models\DataTicket;
use App\Models\DataTicketHc;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Auth\Notifications\ResetPassword;

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

        // view()->composer('*', function ($view) {
        //     if (Auth::check() && is_numeric(Auth::user()->id)) {
        //         Auth::logout();
        //         session()->invalidate();
        //         session()->regenerateToken();
        //         abort(403, 'Session user lama (numeric ID) terdeteksi. Silakan login ulang.');
        //     }
        // });

        ResetPassword::createUrlUsing(function ($user, string $token) {
            return url(route('admin.password.reset', [
                'token' => $token,
                'email' => $user->email,
            ], false));
        });

        view()->composer('*', function ($view) {
            $jumlah_ticket_open = DataTicket::where('status', 'open')->count();
            $view->with('jumlah_ticket_open', $jumlah_ticket_open);
        });

        view()->composer('*', function ($view) {
            $jumlah_ticket_open = DataTicketHc::where('status', 'open')->count();
            $view->with('jumlah_ticket_hc_open', $jumlah_ticket_open);
        });

        view()->composer('*', function ($view) {
            $pending_cust_referral = DataClientsProspect::where('status', 'pending')->count();
            $view->with('pending_cust_referral', $pending_cust_referral);
        });

        view()->composer('*', function ($view) {
            $pending_cust_regist = DataClientsRegist::where('status', 'pending')->count();
            $view->with('pending_cust_regist', $pending_cust_regist);
        });

        view()->composer('*', function ($view) {
            $booking_cust = DataClients::where('status', 'booking')->count();
            $view->with('booking_cust', $booking_cust);
        });
    }
}
