<?php

namespace App\Http\Controllers;

use App\Models\MediaItem;
use Illuminate\Http\Request;

class MediaPublicController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $date = trim((string) $request->query('date', ''));

        try {
            $items = MediaItem::query()
                ->where('is_published', true)
                ->when($q !== '', function ($query) use ($q) {
                    $query->where(function ($q2) use ($q) {
                        $q2->where('title', 'like', "%{$q}%")
                            ->orWhere('speaker', 'like', "%{$q}%");
                    });
                })
                ->when($date !== '', function ($query) use ($date) {
                    $query->whereDate('service_at', $date);
                })
                ->orderByDesc('service_at')
                ->orderByDesc('id')
                ->paginate(9)
                ->withQueryString();
        } catch (\Throwable $e) {
            // DB belum siap / koneksi gagal: halaman public jangan 500.
            $items = collect();
        }

        return view('pages.media', [
            'items' => $items,
            'q' => $q,
            'date' => $date,
        ]);
    }
}
