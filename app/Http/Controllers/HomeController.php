<?php

namespace App\Http\Controllers;

use App\Models\EventItem;
use App\Models\Cabang;
use App\Models\MajelisPeriod;
use App\Models\RenunganItem;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    public function index()
    {
        $featuredEvent = null;
        $eventList = collect();
        $majelisPeriods = collect();
        $cabangList = collect();
        $renunganList = collect();
        $dbReady = true;

        try {
            if (Schema::hasTable('event_items')) {
                $featuredEvent = EventItem::query()
                    ->orderByRaw('COALESCE(start_date, created_at) DESC')
                    ->orderByDesc('id')
                    ->first();

                $eventList = EventItem::query()
                    ->when($featuredEvent, fn ($q) => $q->where('id', '!=', $featuredEvent->id))
                    ->orderByRaw('COALESCE(start_date, created_at) DESC')
                    ->orderByDesc('id')
                    ->limit(4)
                    ->get();
            }

            if (Schema::hasTable('majelis_periods')) {
                $majelisPeriods = MajelisPeriod::query()
                    ->orderByDesc('period')
                    ->latest('updated_at')
                    ->limit(6)
                    ->get();
            }

            if (Schema::hasTable('cabangs')) {
                $cabangList = Cabang::query()
                    ->where('is_published', true)
                    ->orderBy('sort_order')
                    ->orderByDesc('id')
                    ->limit(6)
                    ->get();
            }

            if (Schema::hasTable('renungan_items')) {
                $renunganList = RenunganItem::query()
                    ->where('is_published', true)
                    ->orderBy('sort_order')
                    ->orderByDesc('published_at')
                    ->orderByDesc('id')
                    ->limit(8)
                    ->get();
            }
        } catch (\Throwable $e) {
            // DB belum siap / koneksi gagal: jangan bikin halaman public jadi 500.
            $dbReady = false;
            $featuredEvent = null;
            $eventList = collect();
            $majelisPeriods = collect();
            $cabangList = collect();
            $renunganList = collect();
        }

        return view('pages.home', [
            'featuredEvent' => $featuredEvent,
            'eventList' => $eventList,
            'majelisPeriods' => $majelisPeriods,
            'cabangList' => $cabangList,
            'renunganList' => $renunganList,
            'db_ready' => $dbReady,
        ]);
    }
}
