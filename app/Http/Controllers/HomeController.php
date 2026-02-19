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

        if (Schema::hasTable('event_items')) {
            $featuredEvent = EventItem::query()
                ->where('is_published', 1)
                ->orderByDesc('start_date')
                ->orderByDesc('id')
                ->first();

            $eventList = EventItem::query()
                ->where('is_published', 1)
                ->when($featuredEvent, fn ($q) => $q->where('id', '!=', $featuredEvent->id))
                ->orderByDesc('start_date')
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

        return view('pages.home', [
            'featuredEvent' => $featuredEvent,
            'eventList' => $eventList,
            'majelisPeriods' => $majelisPeriods,
        ]);
    }
}
