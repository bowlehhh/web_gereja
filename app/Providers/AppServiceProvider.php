<?php

namespace App\Providers;

use Illuminate\Foundation\Console\ServeCommand;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureSeoHttpsUrls();
        $this->disableLoopbackViteHotFileForNonLoopbackClients();
        $this->configurePhpIniScanDirForArtisanServe();
    }

    private function configureSeoHttpsUrls(): void
    {
        $forceHttps = filter_var((string) config('app.force_https', false), FILTER_VALIDATE_BOOL);

        if (! $forceHttps) {
            return;
        }

        $appUrl = rtrim((string) config('app.url', ''), '/');

        if ($appUrl !== '') {
            $httpsRoot = preg_replace('/^http:/i', 'https:', $appUrl);

            if (is_string($httpsRoot) && $httpsRoot !== '') {
                URL::forceRootUrl($httpsRoot);
            }
        }

        URL::forceScheme('https');
    }

    private function disableLoopbackViteHotFileForNonLoopbackClients(): void
    {
        if ($this->app->runningInConsole()) {
            return;
        }

        $hotFile = public_path('hot');
        $manifest = public_path('build/manifest.json');

        if (! is_file($hotFile) || ! is_file($manifest)) {
            return;
        }

        $hotUrl = trim((string) @file_get_contents($hotFile));
        if ($hotUrl === '') {
            return;
        }

        $hotIsLoopback = Str::contains($hotUrl, ['127.0.0.1', 'localhost']);
        if (! $hotIsLoopback) {
            return;
        }

        $requestHost = request()->getHost();
        $clientIsLoopback = in_array($requestHost, ['127.0.0.1', 'localhost'], true);

        if ($clientIsLoopback) {
            return;
        }

        Vite::useHotFile(storage_path('app/vite.hot.disabled'));
    }

    private function configurePhpIniScanDirForArtisanServe(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $argv = $_SERVER['argv'] ?? [];
        $command = null;

        foreach (array_slice($argv, 1) as $arg) {
            if (is_string($arg) && $arg !== '' && $arg[0] !== '-') {
                $command = $arg;
                break;
            }
        }

        if (! is_string($command) || ! str_starts_with($command, 'serve')) {
            return;
        }

        $projectScanDir = base_path('php/conf.d');

        if (! is_dir($projectScanDir)) {
            return;
        }

        $scanDirs = [$projectScanDir];

        $existing = getenv('PHP_INI_SCAN_DIR');

        if (is_string($existing) && $existing !== '') {
            $scanDirs = array_merge($scanDirs, array_filter(explode(PATH_SEPARATOR, $existing)));
        } else {
            $defaultScanDir = ini_get('cfg_file_scan_dir');

            if (is_string($defaultScanDir) && $defaultScanDir !== '' && $defaultScanDir !== '(none)') {
                $scanDirs[] = $defaultScanDir;
            }
        }

        $scanDirs = array_values(array_unique($scanDirs));
        $scanDir = implode(PATH_SEPARATOR, $scanDirs);

        $_ENV['PHP_INI_SCAN_DIR'] = $scanDir;
        putenv("PHP_INI_SCAN_DIR={$scanDir}");

        ServeCommand::$passthroughVariables = array_values(array_unique([
            ...ServeCommand::$passthroughVariables,
            'PHP_INI_SCAN_DIR',
        ]));
    }
}
