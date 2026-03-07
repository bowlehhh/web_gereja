<?php

namespace App\Http\Middleware;

use App\Models\VisitorDailyStat;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class TrackWebsiteVisit
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (! $this->shouldTrack($request) || ! $request->hasSession()) {
            return $response;
        }

        $today = now()->toDateString();
        $sessionKey = 'visitor_tracked.'.$today;

        if ($request->session()->get($sessionKey, false)) {
            return $response;
        }

        try {
            DB::transaction(function () use ($today): void {
                $row = VisitorDailyStat::query()
                    ->whereDate('visit_date', $today)
                    ->lockForUpdate()
                    ->first();

                if ($row) {
                    $row->increment('visitor_count');
                    return;
                }

                VisitorDailyStat::query()->create([
                    'visit_date' => $today,
                    'visitor_count' => 1,
                ]);
            });

            $request->session()->put($sessionKey, true);
        } catch (\Throwable $e) {
            report($e);
        }

        return $response;
    }

    private function shouldTrack(Request $request): bool
    {
        if (! $request->isMethod('GET')) {
            return false;
        }

        if ($request->expectsJson() || $request->ajax()) {
            return false;
        }

        if ($request->is('admin') || $request->is('admin/*')) {
            return false;
        }

        if ($request->is('login') || $request->is('logout')) {
            return false;
        }

        if ($request->is('api/*') || $request->is('up')) {
            return false;
        }

        return true;
    }
}
