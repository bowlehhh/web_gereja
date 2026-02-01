<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home() { return view('pages.home'); }
    public function sejarah() { return view('pages.sejarah'); }
    public function hambaTuhan() { return view('pages.hamba-tuhan'); }
    public function majelisKomisi() { return view('pages.majelis-komisi'); }
    public function event() { return view('pages.event'); }
    public function warta() { return view('pages.warta'); }
    public function media() { return view('pages.media'); }
    public function galeri() { return view('pages.galeri'); }
    public function kontak() { return view('pages.kontak'); }
}
