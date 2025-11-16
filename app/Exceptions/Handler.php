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
            $path = $request->path();       // contoh: 'mitra', 'pelanggan', 'admin/dashboard'
            $method = $request->method();   // POST, GET, etc.

            // ========== MITRA ==========
            if (str_starts_with($path, 'mitra')) {
                return redirect('/mitra')
                    ->with('error', 'Sesi Anda telah habis. Silakan login kembali.');
            }

            // ========== PELANGGAN ==========
            if (str_starts_with($path, 'pelanggan')) {
                return redirect('/pelanggan')
                    ->with('error', 'Sesi Anda telah habis. Silakan login kembali.');
            }

            // ========== ADMIN ==========
            if (str_starts_with($path, 'admin')) {
                return redirect('/admin/login')
                    ->with('error', 'Sesi Anda telah habis. Silakan login kembali.');
            }

            // ========== DEFAULT ==========
            return redirect('/login')
                ->with('error', 'Sesi Anda telah habis. Silakan login kembali.');
        }

        return parent::render($request, $exception);
    }
}
