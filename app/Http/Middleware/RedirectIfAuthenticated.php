<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Custom: redirect ke dashboard tergantung role
                $user = Auth::guard($guard)->user();
                $role = $user->role ?? null;

                switch ($role) {
                    case 'Admin':
                    case 'Finance':
                    case 'NOC':
                    case 'Installer':
                    case 'CustomerCare':
                        return redirect()->route('admin.dashboard');
                    default:
                        return redirect('/'); // Default redirect
                }
            }
        }

        return $next($request);
    }
}
