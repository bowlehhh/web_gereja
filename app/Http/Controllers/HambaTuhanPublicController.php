<?php

namespace App\Http\Controllers;

use App\Models\HambaTuhan;
use Illuminate\Support\Facades\Schema;

class HambaTuhanPublicController extends Controller
{
    public function index()
    {
        try {
            if (!Schema::hasTable('hamba_tuhans')) {
                return view('pages.gereja-hamba', [
                    'items' => collect(),
                    'table_ready' => false,
                    'db_ready' => true,
                ]);
            }
        } catch (\Throwable $e) {
            return view('pages.gereja-hamba', [
                'items' => collect(),
                'table_ready' => false,
                'db_ready' => false,
            ]);
        }

        $items = HambaTuhan::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(12);

        return view('pages.gereja-hamba', [
            'items' => $items,
            'table_ready' => true,
            'db_ready' => true,
        ]);
    }

    public function show(HambaTuhan $hambaTuhan)
    {
        try {
            abort_unless(Schema::hasTable('hamba_tuhans'), 404);
        } catch (\Throwable $e) {
            abort(404);
        }
        abort_unless($hambaTuhan->is_active, 404);

        return view('pages.gereja-hamba-show', [
            'item' => $hambaTuhan,
        ]);
    }
}
