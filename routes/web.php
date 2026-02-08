<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WartaPublicController;
use App\Http\Controllers\EventPublicController;
use App\Http\Controllers\GalleryPublicController;
use App\Http\Controllers\HambaTuhanPublicController;

use App\Http\Controllers\Admin\WartaController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\HambaTuhanController;

/*
|--------------------------------------------------------------------------
| PUBLIC PAGES (USER)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

/* Halaman utama gereja (landing gereja) */
Route::get('/gereja', fn () => view('pages.gereja'))->name('gereja');

/* Submenu dropdown GEREJA */
Route::get('/gereja/sejarah', fn () => view('pages.gereja-sejarah'))->name('gereja.sejarah');
Route::get('/gereja/hamba-tuhan', [HambaTuhanPublicController::class, 'index'])->name('gereja.hamba');
Route::get('/gereja/hamba-tuhan/{hambaTuhan}', [HambaTuhanPublicController::class, 'show'])->name('gereja.hamba.show');
Route::get('/gereja/majelis', fn () => view('pages.gereja-majelis'))->name('gereja.majelis');
Route::get('/gereja/komisi', fn () => view('pages.gereja-komisi'))->name('gereja.komisi');

/* Event (PUBLIC) */
Route::get('/event', [EventPublicController::class, 'index'])->name('event');
Route::get('/event/{item}', [EventPublicController::class, 'show'])->name('event.show');

/* Dropdown EVENT */
Route::get('/artikel', fn () => view('pages.artikel'))->name('artikel');
Route::get('/renungan', fn () => view('pages.renungan'))->name('renungan');

Route::get('/media', fn () => view('pages.media'))->name('media');
Route::get('/gallery', [GalleryPublicController::class, 'index'])->name('gallery');

Route::get('/warta-jemaat', [WartaPublicController::class, 'index'])->name('warta');
Route::get('/kontak', fn () => view('pages.kontak'))->name('kontak');

/*
|--------------------------------------------------------------------------
| AUTH (LOGIN)
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'show'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN CONTENT DASHBOARD
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware('auth')->group(function () {

    Route::get('/dashboard', fn () => view('admin.dashboard'))->name('admin.dashboard');

    // HAMBA TUHAN ADMIN (CRUD)
    Route::get('/hamba-tuhan', [HambaTuhanController::class, 'index'])->name('admin.hamba.index');
    Route::get('/hamba-tuhan/create', [HambaTuhanController::class, 'create'])->name('admin.hamba.create');
    Route::post('/hamba-tuhan', [HambaTuhanController::class, 'store'])->name('admin.hamba.store');
    Route::get('/hamba-tuhan/{hambaTuhan}/edit', [HambaTuhanController::class, 'edit'])->name('admin.hamba.edit');
    Route::put('/hamba-tuhan/{hambaTuhan}', [HambaTuhanController::class, 'update'])->name('admin.hamba.update');
    Route::delete('/hamba-tuhan/{hambaTuhan}', [HambaTuhanController::class, 'destroy'])->name('admin.hamba.destroy');

    // WARTA ADMIN (CRUD)
    Route::get('/warta', [WartaController::class, 'index'])->name('admin.warta.index');
    Route::get('/warta/create', [WartaController::class, 'create'])->name('admin.warta.create');
    Route::post('/warta', [WartaController::class, 'store'])->name('admin.warta.store');
    Route::get('/warta/{warta}/edit', [WartaController::class, 'edit'])->name('admin.warta.edit');
    Route::put('/warta/{warta}', [WartaController::class, 'update'])->name('admin.warta.update');
    Route::delete('/warta/{warta}', [WartaController::class, 'destroy'])->name('admin.warta.destroy');

    // EVENT ADMIN (CRUD)  (boleh tetap {item} kalau controller kamu pakai $item)
    Route::get('/event', [EventController::class, 'index'])->name('admin.event.index');
    Route::get('/event/create', [EventController::class, 'create'])->name('admin.event.create');
    Route::post('/event', [EventController::class, 'store'])->name('admin.event.store');
    Route::get('/event/{item}/edit', [EventController::class, 'edit'])->name('admin.event.edit');
    Route::put('/event/{item}', [EventController::class, 'update'])->name('admin.event.update');
    Route::delete('/event/{item}', [EventController::class, 'destroy'])->name('admin.event.destroy');

    // ✅ GALLERY ADMIN (CRUD) — UBAH CUMA INI: {item} -> {gallery}
    Route::get('/gallery', [GalleryController::class, 'index'])->name('admin.gallery.index');
    Route::get('/gallery/create', [GalleryController::class, 'create'])->name('admin.gallery.create');
    Route::post('/gallery', [GalleryController::class, 'store'])->name('admin.gallery.store');
    Route::get('/gallery/{gallery}/edit', [GalleryController::class, 'edit'])->name('admin.gallery.edit');
    Route::put('/gallery/{gallery}', [GalleryController::class, 'update'])->name('admin.gallery.update');
    Route::delete('/gallery/{gallery}', [GalleryController::class, 'destroy'])->name('admin.gallery.destroy');

});
