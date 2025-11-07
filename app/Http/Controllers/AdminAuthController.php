<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\RateLimiter;

class AdminAuthController extends Controller
{
    // public function showLogin()
    // {
    //     if (Auth::check()) {
    //         return redirect()->route('admin.dashboard');
    //     }
    //     return view('admin.auth.admin-login');
    // }


    public function showLogin()
    {
        if (Auth::check()) {
            $user = Auth::user(); // Ambil user yang sedang login
            $internalRoles = ['Admin', 'Finance', 'NOC', 'CustomerCare', 'Installer'];

            if (in_array($user->role, $internalRoles, true)) {
                return redirect()->route('admin.dashboard');
            } else {
                // Tidak boleh masuk halaman admin meskipun sudah login
                Auth::logout();
                return redirect()->route('admin.login')->withErrors([
                    'email' => 'Anda tidak memiliki akses ke halaman admin.'
                ]);
            }
        }

        return view('admin.auth.admin-login');
    }



    public function login(Request $request)
    {
        // 0) Validasi dasar + honeypot sederhana
        $validated = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
            'remember' => ['nullable', 'boolean'],
            'g-recaptcha-response' => ['required'],
        ]);

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret'   => env('RECAPTCHA_SECRET_KEY'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);

        $result = $response->json();
        if (!($result['success'] ?? false) || ($result['score'] ?? 0) < 0.5) {
            return back()->withErrors(['email' => 'reCAPTCHA gagal memverifikasi pengguna.'])->onlyInput('email');
        }



        if ($request->filled('website')) {
            // honeypot diisi → kemungkinan bot
            return back()
                ->withErrors(['email' => 'Invalid submission.'])
                ->onlyInput('email');
        }

        $email = mb_strtolower($validated['email']);
        $ip    = $request->ip();
        $key   = 'login:' . sha1($ip . '|' . $email); // throttle key per IP+email
        $maxAttempts = 5;      // 5 percobaan
        $decaySeconds = 60;    // reset 60 detik

        // 1) Throttle manual tanpa middleware (agar tetap jalan walau limiter global off)
        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            $retryAfter = RateLimiter::availableIn($key);
            return back()
                ->withErrors(['email' => "Terlalu banyak percobaan. Coba lagi dalam {$retryAfter} detik."])
                ->withInput($request->except('password'));
        }

        // 2) PRE-AUTH: hanya izinkan akun internal (hindari user enumeration)
        $user = User::where('email', $email)->first();
        $internalRoles = ['Admin', 'Finance', 'NOC', 'CustomerCare', 'Installer'];
        $eligible = $user && in_array($user->role, $internalRoles, true);

        if (! $eligible) {
            // hit + delay mikro → tambah “biaya” serangan
            RateLimiter::hit($key, $decaySeconds);
            usleep(150_000); // 150 ms
            return back()
                ->withErrors(['email' => 'These credentials do not match our records.'])
                ->onlyInput('email');
        }

        if (! $user->active) {
            return back()
                ->withErrors(['email' => 'Akun Anda belum aktif. Silakan hubungi administrator.'])
                ->onlyInput('email');
        }

        if ($user->is_first_login) {
            Auth::login($user, (bool) $request->boolean('remember'));
            $request->session()->regenerate();
            return redirect()->route('admin.team.new_password.form');
        }

        // 3) Verifikasi password eksplisit
        if (! Hash::check($validated['password'], $user->password)) {
            RateLimiter::hit($key, $decaySeconds);
            return back()
                ->withErrors(['email' => 'These credentials do not match our records.'])
                ->onlyInput('email');
        }

        // 4) Lolos → login & regen session, bersihkan counter
        RateLimiter::clear($key);

        $remember = (bool) $request->boolean('remember');
        Auth::login($user, $remember);
        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
