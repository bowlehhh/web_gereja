<?php

namespace App\Http\Controllers;

use App\Models\EventItem;
use Illuminate\Support\Str;

class EventPublicController extends Controller
{
    public function index()
    {
        $items = EventItem::query()
            ->orderByRaw('COALESCE(start_date, created_at) DESC')
            ->orderByDesc('id')
            ->paginate(12);

        return view('pages.event', compact('items'));
    }

    public function show(EventItem $item)
    {
        return view('pages.event-show', [
            'item' => $item,
            'youtubeEmbed' => $this->resolveYoutubeEmbedUrl($item->youtube_url),
            'latest' => EventItem::query()
                ->where('id', '!=', $item->id)
                ->orderByRaw('COALESCE(start_date, created_at) DESC')
                ->orderByDesc('id')
                ->limit(5)
                ->get(),
        ]);
    }

    private function resolveYoutubeEmbedUrl(?string $url): ?string
    {
        $url = trim((string) $url);
        if ($url === '') return null;

        // allow already-embedded URLs
        if (Str::contains($url, 'youtube.com/embed/')) {
            return $url;
        }

        // youtu.be/<id>
        if (preg_match('~youtu\\.be/([A-Za-z0-9_-]{6,})~', $url, $m)) {
            return 'https://www.youtube.com/embed/'.$m[1];
        }

        // youtube.com/watch?v=<id>
        if (preg_match('~v=([A-Za-z0-9_-]{6,})~', $url, $m)) {
            return 'https://www.youtube.com/embed/'.$m[1];
        }

        return null;
    }
}
