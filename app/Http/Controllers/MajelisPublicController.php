<?php

namespace App\Http\Controllers;

use App\Models\MajelisMember;
use App\Models\MajelisPeriod;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class MajelisPublicController extends Controller
{
    public function index()
    {
        try {
            if (!Schema::hasTable('majelis_periods')) {
                return view('pages.gereja-majelis', [
                    'items' => collect(),
                    'table_ready' => false,
                    'db_ready' => true,
                ]);
            }
        } catch (\Throwable $e) {
            return view('pages.gereja-majelis', [
                'items' => collect(),
                'table_ready' => false,
                'db_ready' => false,
            ]);
        }

        $periodItems = collect();
        $periods = MajelisPeriod::query()
            ->orderByDesc('period')
            ->latest('updated_at')
            ->get();

        foreach ($periods as $cfg) {
            $period = $cfg->period;
            $cfgExcerpt = (!empty($cfg->about) && is_string($cfg->about)) ? Str::limit(trim($cfg->about), 140) : null;
            $periodItems->push((object) [
                'period' => $period,
                'role' => 'PERIODE',
                'name' => 'Majelis Periode '.$period,
                'excerpt' => $cfgExcerpt ?: ('Klik untuk melihat detail majelis periode '.$period.'.'),
                'photo_path' => $cfg->thumbnail_path,
                'slug' => Str::slug($period),
                'count' => null,
            ]);
        }

        return view('pages.gereja-majelis', [
            'items' => $periodItems,
            'table_ready' => true,
            'db_ready' => true,
        ]);
    }

    public function show(string $period)
    {
        try {
            abort_unless(Schema::hasTable('majelis_periods'), 404);
        } catch (\Throwable $e) {
            abort(404);
        }

        $period = trim(urldecode($period));

        $displayPeriod = $period;
        $periodConfig = MajelisPeriod::query()->where('period', $displayPeriod)->first();
        abort_if(!$periodConfig, 404);

        $hero = (object) [
            'name' => 'Majelis Periode '.$displayPeriod,
            'role' => 'MAJELIS',
            'period' => $displayPeriod,
            'photo_path' => $periodConfig->thumbnail_path,
            'about' => $periodConfig->about ?: 'Daftar lengkap majelis periode '.$displayPeriod.'.',
            'excerpt' => null,
        ];

        return view('pages.gereja-majelis-show', [
            'item' => $hero,
            'members' => collect(),
            'periodConfig' => $periodConfig,
        ]);
    }
}
