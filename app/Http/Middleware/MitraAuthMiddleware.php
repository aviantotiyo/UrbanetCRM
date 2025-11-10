<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class MitraAuthMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Session::has('partner_auth_id') || Session::get('partner_role') !== 'mitra') {
            return redirect()->route('partner.login');
        }

        return $next($request);
    }
}
