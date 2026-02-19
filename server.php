<?php

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/');
$publicPath = __DIR__ . '/public';

if ($uri !== '/') {
    $filePath = $publicPath . $uri;
    if (is_file($filePath)) {
        return false;
    }
}

require_once $publicPath . '/index.php';

