<?php

namespace App\Http\Controllers;

use App\Models\EventItem;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    public function index()
    {
        $featuredEvent = null;
        $eventList = collect();

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

        return view('pages.home', [
            'featuredEvent' => $featuredEvent,
            'eventList' => $eventList,
        ]);
    }
}

