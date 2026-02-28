<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;

class GalleryPublicController extends Controller
{
    public function index()
    {
        try {
            $items = GalleryItem::query()
                ->orderByDesc('id')
                ->paginate(12);
        } catch (\Throwable $e) {
            // DB belum siap / koneksi gagal: halaman public jangan 500.
            $items = collect();
        }

        return view('pages.gallery', compact('items'));
    }
}
