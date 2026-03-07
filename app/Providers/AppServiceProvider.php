<?php

namespace App\Providers;

use App\Models\VisitorDailyStat;
use Illuminate\Foundation\Console\ServeCommand;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\Facades\View;
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
        $this->shareFooterVisitorStats();
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

    private function shareFooterVisitorStats(): void
    {
        View::composer('partials.footer', function ($view): void {
            $stats = [
                'daily' => 0,
                'monthly' => 0,
                'yearly' => 0,
            ];

            if (! Schema::hasTable('visitor_daily_stats')) {
                $view->with('visitorStats', $stats);
                return;
            }

            $today = Carbon::today();
            $todayDate = $today->toDateString();
            $monthStart = $today->copy()->startOfMonth()->toDateString();
            $yearStart = $today->copy()->startOfYear()->toDateString();

            $stats['daily'] = (int) (VisitorDailyStat::query()
                ->whereDate('visit_date', $todayDate)
                ->value('visitor_count') ?? 0);

            $stats['monthly'] = (int) VisitorDailyStat::query()
                ->whereBetween('visit_date', [$monthStart, $todayDate])
                ->sum('visitor_count');

            $stats['yearly'] = (int) VisitorDailyStat::query()
                ->whereBetween('visit_date', [$yearStart, $todayDate])
                ->sum('visitor_count');

            $view->with('visitorStats', $stats);
        });
    }
}
