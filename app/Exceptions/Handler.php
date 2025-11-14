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
        // Tambahkan penanganan error 419 (TokenMismatch)
        if ($exception instanceof TokenMismatchException) {
            if ($request->is('mitra/*') || $request->routeIs('partner.*')) {
                return redirect()->route('partner.login')
                    ->with('error', 'Sesi Anda telah habis. Silakan login kembali.');
            }

            return redirect()->route('login')
                ->with('error', 'Sesi Anda telah habis. Silakan login kembali.');
        }

        return parent::render($request, $exception);
    }
}
