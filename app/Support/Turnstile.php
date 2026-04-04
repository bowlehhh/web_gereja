<?php

namespace App\Support;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

final class Turnstile
{
    public static function siteKey(): ?string
    {
        $value = trim((string) config('services.turnstile.site_key', ''));

        return $value !== '' ? $value : null;
    }

    public static function secretKey(): ?string
    {
        $value = trim((string) config('services.turnstile.secret_key', ''));

        return $value !== '' ? $value : null;
    }

    public static function shouldBypass(Request $request): bool
    {
        if (LoopbackHost::contains($request->getHost()) || LoopbackHost::urlUsesLoopbackHost(config('app.url'))) {
            return true;
        }

        return app()->environment('local') && ! (bool) config('services.turnstile.enforce_local', false);
    }

    public static function shouldRender(Request $request): bool
    {
        return self::siteKey() !== null
            && self::secretKey() !== null
            && ! self::shouldBypass($request);
    }

    /**
     * @return array{success: bool, message: string|null}
     */
    public static function verify(Request $request): array
    {
        if (! self::shouldRender($request)) {
            return [
                'success' => true,
                'message' => null,
            ];
        }

        $token = trim((string) $request->input('cf-turnstile-response', ''));
        if ($token === '') {
            return [
                'success' => false,
                'message' => 'Verifikasi Cloudflare wajib diselesaikan sebelum login.',
            ];
        }

        try {
            $response = Http::asForm()
                ->timeout(8)
                ->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
                    'secret' => self::secretKey(),
                    'response' => $token,
                    'remoteip' => $request->ip(),
                ]);

            $payload = $response->json();

            if ($response->successful() && is_array($payload) && ($payload['success'] ?? false) === true) {
                return [
                    'success' => true,
                    'message' => null,
                ];
            }
        } catch (\Throwable $e) {
            // Fall through to human-readable validation message below.
        }

        return [
            'success' => false,
            'message' => 'Verifikasi Cloudflare gagal. Silakan muat ulang halaman lalu coba lagi.',
        ];
    }
}
