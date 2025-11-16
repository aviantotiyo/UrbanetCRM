<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Handler extends ExceptionHandler
{
    protected $levels = [
        //
    ];

    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception): Response
    {
        if ($exception instanceof \Illuminate\Session\TokenMismatchException) {
            // Coba deteksi dari current URL dan referer (fallback)
            $currentUrl = $request->fullUrl();
            $referer = $request->headers->get('referer');

            if (str_contains($currentUrl, '/mitra') || str_contains($referer, '/mitra')) {
                return redirect('/mitra')
                    ->with('error', 'Sesi Anda telah habis. Silakan login kembali.');
            }

            if (str_contains($currentUrl, '/pelanggan') || str_contains($referer, '/pelanggan')) {
                return redirect('/pelanggan')
                    ->with('error', 'Sesi Anda telah habis. Silakan login kembali.');
            }

            if (str_contains($currentUrl, '/admin') || str_contains($referer, '/admin')) {
                return redirect('/admin/login')
                    ->with('error', 'Sesi Anda telah habis. Silakan login kembali.');
            }

            return redirect('/login')
                ->with('error', 'Sesi Anda telah habis. Silakan login kembali.');
        }

        return parent::render($request, $exception);
    }
}
