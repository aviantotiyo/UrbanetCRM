<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ClientAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('client_authenticated')) {
            return redirect()->route('client.auth.step1');
        }

        return $next($request);
    }
}
