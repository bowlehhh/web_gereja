<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class CabangPublicController extends Controller
{
    public function index(Request $request)
    {
        $stats = $this->defaultStats();
        $chart = $this->defaultChart();
        $filterMeta = [
            'city_options' => collect(),
            'year_options' => collect(),
            'member_enabled' => false,
            'member_column' => null,
            'inactive_city_label' => 'Tanpa Data',
            'inactive_city_count' => 0,
        ];

        try {
            if (!Schema::hasTable('cabangs')) {
                $items = collect();
            } else {
                $memberColumn = $this->detectMemberColumn();
                $status = (string) $request->query('status', 'active');
                $status = in_array($status, ['all', 'active', 'inactive'], true) ? $status : 'active';

                $search = trim((string) $request->query('q', ''));
                $city = trim((string) $request->query('city', ''));
                $sort = (string) $request->query('sort', 'default');
                $sort = in_array($sort, ['default', 'name', 'city', 'newest'], true) ? $sort : 'default';
                $year = trim((string) $request->query('year', ''));
                $members = trim((string) $request->query('members', ''));
                $hasFoundedYear = Schema::hasColumn('cabangs', 'founded_year');
                $hasAddress = Schema::hasColumn('cabangs', 'address');

                $query = Cabang::query();

                if ($status === 'active') {
                    $query->where('is_published', true);
                } elseif ($status === 'inactive') {
                    $query->where('is_published', false);
                }

                if ($search !== '') {
                    $like = '%'.$search.'%';
                    $query->where(function ($q) use ($like, $hasAddress) {
                        $q->where('name', 'like', $like)
                            ->orWhere('city', 'like', $like)
                            ->orWhere('about', 'like', $like);

                        if ($hasAddress) {
                            $q->orWhere('address', 'like', $like);
                        }
                    });
                }

                if ($city !== '') {
                    $query->where('city', 'like', '%'.$city.'%');
                }

                if ($year !== '' && ctype_digit($year)) {
                    if ($hasFoundedYear) {
                        $query->where('founded_year', (int) $year);
                    } else {
                        $query->whereYear('created_at', (int) $year);
                    }
                }

                if ($memberColumn !== null) {
                    if ($members === 'lt50') {
                        $query->where($memberColumn, '<', 50);
                    } elseif ($members === '50to150') {
                        $query->whereBetween($memberColumn, [50, 150]);
                    } elseif ($members === 'gt150') {
                        $query->where($memberColumn, '>', 150);
                    }
                }

                if ($sort === 'name') {
                    $query->orderBy('name')->orderBy('id');
                } elseif ($sort === 'city') {
                    $query
                        ->orderByRaw("CASE WHEN city IS NULL OR city = '' THEN 1 ELSE 0 END")
                        ->orderBy('city')
                        ->orderBy('name');
                } elseif ($sort === 'newest') {
                    $query->orderByDesc('created_at')->orderByDesc('id');
                } else {
                    $query->orderBy('sort_order')->orderByDesc('id');
                }

                $items = $query->paginate(9)->withQueryString();

                $cityOptions = Cabang::query()
                    ->select('city')
                    ->whereNotNull('city')
                    ->whereRaw("TRIM(city) <> ''")
                    ->distinct()
                    ->orderBy('city')
                    ->pluck('city');

                if ($hasFoundedYear) {
                    $yearOptions = Cabang::query()
                        ->whereNotNull('founded_year')
                        ->distinct()
                        ->orderByDesc('founded_year')
                        ->pluck('founded_year')
                        ->map(fn ($value) => (string) $value);
                } else {
                    $yearOptions = Cabang::query()
                        ->selectRaw('YEAR(created_at) as year_num')
                        ->whereNotNull('created_at')
                        ->groupBy('year_num')
                        ->orderByDesc('year_num')
                        ->pluck('year_num')
                        ->map(fn ($value) => (string) $value);
                }

                $totalCabang = (int) Cabang::query()->count();
                $activeCabang = (int) Cabang::query()->where('is_published', true)->count();
                $inactiveCabang = (int) Cabang::query()->where('is_published', false)->count();
                $newThisMonth = (int) Cabang::query()
                    ->whereYear('created_at', now()->year)
                    ->whereMonth('created_at', now()->month)
                    ->count();

                $inactiveCity = Cabang::query()
                    ->selectRaw("COALESCE(NULLIF(TRIM(city), ''), 'Tanpa Kota') as city_name, COUNT(*) as total")
                    ->where('is_published', false)
                    ->groupBy('city_name')
                    ->orderByDesc('total')
                    ->first();

                [$trendSeries, $trendLabels] = $this->buildGrowthSeries();
                $lastValue = (int) ($trendSeries[count($trendSeries) - 1] ?? 0);
                $prevValue = (int) ($trendSeries[count($trendSeries) - 2] ?? 0);
                $trendDelta = $lastValue - $prevValue;
                $trendDirection = $trendDelta > 0 ? 'up' : ($trendDelta < 0 ? 'down' : 'flat');
                $trendPercent = $prevValue > 0
                    ? round(($trendDelta / $prevValue) * 100, 1)
                    : ($lastValue > 0 ? 100.0 : 0.0);

                $stats = [
                    'total' => $totalCabang,
                    'active' => $activeCabang,
                    'inactive' => $inactiveCabang,
                    'new_this_month' => $newThisMonth,
                    'visible' => method_exists($items, 'total') ? $items->total() : (method_exists($items, 'count') ? $items->count() : count($items)),
                ];

                $chart = [
                    'series' => $trendSeries,
                    'labels' => $trendLabels,
                    'direction' => $trendDirection,
                    'delta' => $trendDelta,
                    'percent' => $trendPercent,
                ];

                $filterMeta = [
                    'city_options' => $cityOptions,
                    'year_options' => $yearOptions,
                    'member_enabled' => $memberColumn !== null,
                    'member_column' => $memberColumn,
                    'inactive_city_label' => $inactiveCity?->city_name ?? 'Tanpa Kota',
                    'inactive_city_count' => (int) ($inactiveCity?->total ?? 0),
                ];
            }
        } catch (\Throwable $e) {
            // DB belum siap / koneksi gagal: halaman public jangan 500.
            $items = collect();
        }

        return view('pages.cabang', [
            'items' => $items,
            'stats' => $stats,
            'chart' => $chart,
            'filterMeta' => $filterMeta,
        ]);
    }

    public function show(Cabang $cabang)
    {
        abort_unless(Schema::hasTable('cabangs'), 404);

        $mapColumnsReady = Schema::hasColumn('cabangs', 'map_latitude')
            && Schema::hasColumn('cabangs', 'map_longitude');

        try {
            $latest = Cabang::query()
                ->where('is_published', true)
                ->where('id', '!=', $cabang->id)
                ->orderBy('sort_order')
                ->orderByDesc('id')
                ->limit(5)
                ->get();
        } catch (\Throwable $e) {
            $latest = collect();
        }

        return view('pages.cabang-show', [
            'item' => $cabang,
            'latest' => $latest,
            'mapColumnsReady' => $mapColumnsReady,
        ]);
    }

    /**
     * @return array{total:int,active:int,inactive:int,new_this_month:int,visible:int}
     */
    private function defaultStats(): array
    {
        return [
            'total' => 0,
            'active' => 0,
            'inactive' => 0,
            'new_this_month' => 0,
            'visible' => 0,
        ];
    }

    /**
     * @return array{series:array<int,int>,labels:array<int,string>,direction:string,delta:int,percent:float}
     */
    private function defaultChart(): array
    {
        return [
            'series' => [0, 0, 0, 0, 0, 0],
            'labels' => [],
            'direction' => 'flat',
            'delta' => 0,
            'percent' => 0.0,
        ];
    }

    /**
     * @return array{0:array<int,int>,1:array<int,string>}
     */
    private function buildGrowthSeries(): array
    {
        $months = collect(range(5, 0))
            ->map(fn (int $offset) => Carbon::now()->subMonths($offset)->startOfMonth());

        $keys = $months->map(fn (Carbon $month) => $month->format('Y-m'))->all();

        $rows = Cabang::query()
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month_key, COUNT(*) as total")
            ->where('created_at', '>=', Carbon::now()->subMonths(5)->startOfMonth())
            ->groupBy('month_key')
            ->pluck('total', 'month_key');

        $series = [];
        foreach ($keys as $key) {
            $series[] = (int) ($rows[$key] ?? 0);
        }

        $labels = $months
            ->map(fn (Carbon $month) => $month->translatedFormat('M Y'))
            ->all();

        return [$series, $labels];
    }

    private function detectMemberColumn(): ?string
    {
        $candidates = ['congregation_total', 'member_count', 'jumlah_jemaat'];

        foreach ($candidates as $column) {
            if (Schema::hasColumn('cabangs', $column)) {
                return $column;
            }
        }

        return null;
    }
}
