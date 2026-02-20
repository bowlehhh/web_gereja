<?php

namespace App\Providers;

use Illuminate\Foundation\Console\ServeCommand;
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
