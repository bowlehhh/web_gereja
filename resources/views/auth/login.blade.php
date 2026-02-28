<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - GKKA Samarinda</title>
    @php
        $faviconVersion = @filemtime(public_path('favicon.ico')) ?: time();
    @endphp
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v={{ $faviconVersion }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v={{ $faviconVersion }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4 md:p-10">

    <div class="w-full max-w-6xl bg-white rounded-[2rem] shadow-2xl overflow-hidden flex flex-col md:flex-row min-h-[600px]">
        
        <div class="w-full md:w-5/12 bg-blue-900 relative p-12 flex flex-col justify-between text-white overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-blue-800 rounded-full -mr-32 -mt-32 opacity-50"></div>
            <div class="absolute bottom-0 left-0 w-40 h-40 bg-blue-700 rounded-full -ml-20 -mb-20 opacity-30"></div>
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>

            <div class="relative z-10">
                <div class="mb-6">
                    <div class="size-24 rounded-full overflow-hidden bg-white/95 border border-white/70 shadow-lg p-2">
                        <img src="{{ asset('assets/css/image.png') }}" alt="GKKA Logo" class="w-full h-full object-contain rounded-full">
                    </div>
                </div>
                <h1 class="text-4xl font-extrabold leading-tight mb-4">GKKA<br>Samarinda</h1>
                <p class="text-blue-200 text-lg font-light leading-relaxed">Pusat Kendali Admin. Kelola konten dan jemaat dengan lebih efisien dalam satu dashboard.</p>
            </div>

        </div>

        <div class="w-full md:w-7/12 p-8 md:p-16 flex flex-col justify-center">
            <div class="max-w-md mx-auto w-full">
                <div class="mb-10">
                    <h2 class="text-3xl font-extrabold text-slate-800 mb-2">Selamat Datang</h2>
                    <p class="text-slate-500 font-medium">Silakan masuk untuk melanjutkan ke dashboard.</p>
                </div>

                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-8 text-sm flex items-center gap-3">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"></path></svg>
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.post') }}" class="space-y-6">
                    @csrf
                    {{-- Honeypot (anti-bot). Do not remove. --}}
                    <div style="position:absolute;left:-10000px;top:auto;width:1px;height:1px;overflow:hidden;" aria-hidden="true">
                        <label>Website</label>
                        <input type="text" name="website" tabindex="-1" autocomplete="off">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2 col-span-1 md:col-span-2">
                            <label class="text-xs font-bold text-slate-400 uppercase tracking-[0.2em] ml-1">Email Address</label>
                            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                                class="w-full px-5 py-4 rounded-2xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 outline-none transition-all font-semibold text-slate-700"
                                placeholder="name@church.com">
                        </div>

                        <div class="space-y-2 col-span-1 md:col-span-2">
                            <label class="text-xs font-bold text-slate-400 uppercase tracking-[0.2em] ml-1">Password</label>
                            <input type="password" name="password" required
                                class="w-full px-5 py-4 rounded-2xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 outline-none transition-all font-semibold text-slate-700"
                                placeholder="••••••••">
                        </div>
                    </div>

                    @php
                        $turnstileKey = config('services.turnstile.site_key');
                        $showTurnstile = !empty($turnstileKey) && (!app()->environment('local') || (bool) config('services.turnstile.enforce_local', false));
                    @endphp
                    @if($showTurnstile)
                        <div class="pt-2">
                            <div class="cf-turnstile" data-sitekey="{{ $turnstileKey }}"></div>
                            <p class="mt-2 text-xs text-slate-400 font-semibold">
                                Verifikasi untuk mencegah spam.
                            </p>
                        </div>
                    @endif

                    <div class="flex items-center justify-between py-2">
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <input type="checkbox" name="remember" class="w-5 h-5 rounded-md border-slate-300 text-blue-600 focus:ring-blue-500">
                            <span class="text-sm font-bold text-slate-500 group-hover:text-blue-900 transition-colors">Ingat Saya</span>
                        </label>
                    </div>

                    <button type="submit" class="w-full py-5 rounded-2xl bg-blue-900 text-white font-bold text-lg shadow-xl shadow-blue-900/20 hover:bg-blue-800 hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-3 group">
                        <span>Masuk Dashboard</span>
                        <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </button>
                </form>

                <div class="mt-12 text-center">
                    <p class="text-slate-400 text-sm font-medium">&copy; {{ date('Y') }} GKKA Samarinda.</p>
                </div>
            </div>
        </div>

    </div>

    @if($showTurnstile)
        <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    @endif

</body>
</html>
