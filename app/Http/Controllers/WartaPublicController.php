<?php

namespace App\Http\Controllers;

use App\Models\Warta;

class WartaPublicController extends Controller
{
    public function index()
    {
        $wartas = Warta::where('is_published', true)
            ->latest('date')
            ->latest('id')
            ->paginate(12);

        return view('pages.warta', compact('wartas'));
    }
}
