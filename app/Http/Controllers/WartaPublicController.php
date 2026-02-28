<?php

namespace App\Http\Controllers;

use App\Models\Warta;

class WartaPublicController extends Controller
{
    public function index()
    {
        try {
            $wartas = Warta::query()
                ->orderByRaw('COALESCE(date, created_at) DESC')
                ->latest('id')
                ->paginate(12);
        } catch (\Throwable $e) {
            // DB belum siap / koneksi gagal: halaman public jangan 500.
            $wartas = collect();
        }

        return view('pages.warta', compact('wartas'));
    }
}
