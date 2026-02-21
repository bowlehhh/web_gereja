<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function show()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Basic bot protection (honeypot). Legit users won't fill this.
        // Kept generic to avoid giving hints to attackers.
        $honeypot = (string) $request->input('website', '');
        if (trim($honeypot) !== '') {
            $this->hitRateLimits($request, extraSeconds: 240);
            return back()
                ->withErrors(['email' => 'Email atau password salah.'])
                ->onlyInput('email');
        }

        // Rate limit login attempts (anti spam / brute force).
        if ($this->isRateLimited($request)) {
            $seconds = max(
                RateLimiter::availableIn($this->loginKey($request)),
                RateLimiter::availableIn($this->ipKey($request)),
            );

            $minutes = (int) ceil($seconds / 60);
            $msg = $seconds >= 60
                ? "Terlalu banyak percobaan login. Coba lagi dalam {$minutes} menit."
                : "Terlalu banyak percobaan login. Coba lagi dalam {$seconds} detik.";

            return back()
                ->withErrors(['email' => $msg])
                ->onlyInput('email');
        }

        // Captcha (Cloudflare Turnstile) – optional, enabled if secret key is set.
        $turnstileSecret = (string) config('services.turnstile.secret_key', '');
        $enforceCaptcha = trim($turnstileSecret) !== '' && (! app()->environment('local') || (bool) config('services.turnstile.enforce_local', false));
        if ($enforceCaptcha) {
            $token = (string) $request->input('cf-turnstile-response', '');
            if (trim($token) === '') {
                $this->hitRateLimits($request, extraSeconds: 60);
                return back()
                    ->withErrors(['email' => 'Captcha belum terisi. Silakan lakukan verifikasi terlebih dahulu.'])
                    ->onlyInput('email');
            }

            if (! $this->verifyTurnstile($turnstileSecret, $token, (string) $request->ip())) {
                $this->hitRateLimits($request, extraSeconds: 120);
                return back()
                    ->withErrors(['email' => 'Verifikasi captcha gagal. Silakan coba lagi.'])
                    ->onlyInput('email');
            }
        }

        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            $this->clearRateLimits($request);
            return redirect()->route('admin.dashboard');
        }

        // Failed attempt counts toward limit.
        $this->hitRateLimits($request);

        return back()
            ->withErrors(['email' => 'Email atau password salah.'])
            ->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    private function loginKey(Request $request): string
    {
        $email = Str::lower(trim((string) $request->input('email', '')));
        return 'login:email_ip:'.$email.'|'.$request->ip();
    }

    private function ipKey(Request $request): string
    {
        return 'login:ip:'.$request->ip();
    }

    private function isRateLimited(Request $request): bool
    {
        // 5 attempts/minute per (email+ip) and 20 attempts/minute per IP.
        return RateLimiter::tooManyAttempts($this->loginKey($request), 5)
            || RateLimiter::tooManyAttempts($this->ipKey($request), 20);
    }

    private function hitRateLimits(Request $request, int $extraSeconds = 0): void
    {
        $decay = 60 + max(0, $extraSeconds);
        RateLimiter::hit($this->loginKey($request), $decay);
        RateLimiter::hit($this->ipKey($request), $decay);
    }

    private function clearRateLimits(Request $request): void
    {
        RateLimiter::clear($this->loginKey($request));
        RateLimiter::clear($this->ipKey($request));
    }

    private function verifyTurnstile(string $secret, string $token, string $ip): bool
    {
        try {
            $resp = Http::asForm()
                ->timeout(4)
                ->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
                    'secret' => $secret,
                    'response' => $token,
                    'remoteip' => $ip,
                ]);

            if (! $resp->ok()) {
                if (config('app.debug')) {
                    Log::warning('Turnstile verify HTTP error', [
                        'status' => $resp->status(),
                        'ip' => $ip,
                    ]);
                }
                return false;
            }

            $data = $resp->json();
            $ok = is_array($data) && (($data['success'] ?? false) === true);

            if (! $ok && config('app.debug')) {
                Log::warning('Turnstile verify failed', [
                    'ip' => $ip,
                    'error_codes' => is_array($data) ? ($data['error-codes'] ?? []) : ['invalid-json'],
                ]);
            }

            return $ok;
        } catch (\Throwable $e) {
            if (config('app.debug')) {
                Log::warning('Turnstile verify exception', [
                    'ip' => $ip,
                    'error' => $e->getMessage(),
                ]);
            }
            return false;
        }
    }
}
