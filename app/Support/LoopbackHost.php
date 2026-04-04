<?php

namespace App\Support;

final class LoopbackHost
{
    /**
     * @param  string|null  $host
     */
    public static function contains(?string $host): bool
    {
        if (! is_string($host) || $host === '') {
            return false;
        }

        $normalizedHost = strtolower(trim($host, '[]'));

        return in_array($normalizedHost, ['127.0.0.1', 'localhost', '::1'], true);
    }

    /**
     * @param  string|null  $url
     */
    public static function urlUsesLoopbackHost(?string $url): bool
    {
        if (! is_string($url) || $url === '') {
            return false;
        }

        $host = parse_url($url, PHP_URL_HOST);

        return is_string($host) && self::contains($host);
    }
}
