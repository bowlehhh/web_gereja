<?php

namespace App\Http\Controllers;

use App\Models\BidangPelayanan;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Schema;

class BidangPelayananPublicController extends Controller
{
    public function index()
    {
        try {
            $items = Schema::hasTable('bidang_pelayanans')
                ? BidangPelayanan::query()
                    ->where('is_active', true)
                    ->orderBy('sort_order')
                    ->orderBy('name')
                    ->get()
                : collect();
        } catch (\Throwable $e) {
            $items = collect();
        }

        return view('pages.gereja-komisi', [
            'items' => $items,
        ]);
    }

    public function show(string $slug)
    {
        abort_unless(Schema::hasTable('bidang_pelayanans'), 404);

        try {
            $item = BidangPelayanan::query()
                ->where('slug', $slug)
                ->where('is_active', true)
                ->firstOrFail();
        } catch (ModelNotFoundException $e) {
            abort(404);
        } catch (\Throwable $e) {
            abort(404);
        }

        try {
            $related = BidangPelayanan::query()
                ->where('is_active', true)
                ->where('id', '!=', $item->id)
                ->orderBy('sort_order')
                ->orderBy('name')
                ->limit(3)
                ->get();
        } catch (\Throwable $e) {
            $related = collect();
        }

        return view('pages.gereja-komisi-show', [
            'item' => $item,
            'related' => $related,
        ]);
    }
}
