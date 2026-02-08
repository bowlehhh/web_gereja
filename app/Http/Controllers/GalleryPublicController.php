<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;

class GalleryPublicController extends Controller
{
    public function index()
    {
        $items = GalleryItem::query()
            ->where('is_published', 1)
            ->orderByDesc('id')
            ->paginate(12);

        return view('pages.gallery', compact('items'));
    }
}
