<?php

namespace App\Http\Controllers;

use App\Models\EventItem;
use App\Models\MajelisPeriod;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    public function index()
    {
        $featuredEvent = null;
        $eventList = collect();
        $majelisPeriods = collect();
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
        } catch (\Throwable $e) {
            // DB belum siap / koneksi gagal: jangan bikin halaman public jadi 500.
            $dbReady = false;
            $featuredEvent = null;
            $eventList = collect();
            $majelisPeriods = collect();
        }

        return view('pages.home', [
            'featuredEvent' => $featuredEvent,
            'eventList' => $eventList,
            'majelisPeriods' => $majelisPeriods,
            'db_ready' => $dbReady,
        ]);
    }
}
