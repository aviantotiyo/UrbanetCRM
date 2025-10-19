<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Support\Facades\Log;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->api(prepend: [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        ]);

        $middleware->alias([
            'verified' => \App\Http\Middleware\EnsureEmailIsVerified::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Handler ramah untuk brute-force login (HTTP 429)
        $exceptions->render(function (ThrottleRequestsException $e, $request) {
            // Berlaku hanya untuk POST /admin/login (form sesi web)
            if ($request->is('admin/login') && $request->method() === 'POST') {
                $retryAfter = (int) ($e->getHeaders()['Retry-After'] ?? 60);

                // (Opsional) catat log
                Log::warning('Login throttled', [
                    'ip'         => $request->ip(),
                    'email'      => $request->input('email'),
                    'retry_after' => $retryAfter,
                ]);

                return redirect()
                    ->route('admin.login')
                    ->withErrors([
                        'email' => "Terlalu banyak percobaan. Coba lagi dalam {$retryAfter} detik.",
                    ])
                    ->withInput($request->except('password'));
            }

            return null; // biarkan exception lain pakai default handler
        });
    })
    ->create();
