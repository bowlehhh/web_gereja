<?php

namespace App\Http\Controllers;

use App\Support\Turnstile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // tampilkan halaman login
    public function show()
    {
        // kalau sudah login, langsung masuk dashboard
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.login');
    }

    // proses login
    public function login(Request $request)
    {
        if (filled($request->input('website'))) {
            throw ValidationException::withMessages([
                'email' => 'Permintaan login tidak valid.',
            ]);
        }

        $turnstile = Turnstile::verify($request);
        if (! $turnstile['success']) {
            throw ValidationException::withMessages([
                'email' => $turnstile['message'] ?? 'Verifikasi Cloudflare gagal.',
            ]);
        }

        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // remember optional
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // setelah login langsung ke dashboard admin
            return redirect()->route('admin.dashboard');
        }

        return back()
            ->withErrors(['email' => 'Email atau password salah.'])
            ->onlyInput('email');
    }

    // logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
