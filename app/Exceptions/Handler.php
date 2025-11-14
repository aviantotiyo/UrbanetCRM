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
        if ($exception instanceof TokenMismatchException) {

            // ========== MITRA ==========
            if ($request->is('mitra/*') || $request->routeIs('partner.*')) {
                return redirect()->route('partner.login')
                    ->with('error', 'Sesi Anda telah habis. Silakan login kembali.');
            }

            // ========== ADMIN ==========
            if ($request->is('admin/*') || $request->routeIs('admin.*')) {
                return redirect()->route('admin.login')
                    ->with('error', 'Sesi Anda telah habis. Silakan login kembali.');
            }

            // ========== PELANGGAN ==========
            if ($request->is('pelanggan/*') || $request->routeIs('client.*')) {
                return redirect()->route('client.auth.step1')
                    ->with('error', 'Sesi Anda telah habis. Silakan login kembali.');
            }

            // ========== DEFAULT (pelanggan / user biasa) ==========
            return redirect()->route('login')
                ->with('error', 'Sesi Anda telah habis. Silakan login kembali.');
        }

        return parent::render($request, $exception);
    }
}
