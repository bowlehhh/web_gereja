<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PUBLIC PAGES (USER)
|--------------------------------------------------------------------------
*/

Route::get('/', fn () => view('pages.home'))->name('home');

Route::get('/gereja', fn () => view('pages.gereja'))->name('gereja');

Route::get('/event', fn () => view('pages.event'))->name('event');

Route::get('/news', fn () => view('pages.news'))->name('news');

Route::get('/media', fn () => view('pages.media'))->name('media');

Route::get('/gallery', fn () => view('pages.gallery'))->name('gallery');

Route::get('/warta-jemaat', fn () => view('pages.warta'))->name('warta');


Route::get('/kontak', fn () => view('pages.kontak'))->name('kontak');



/*
|--------------------------------------------------------------------------
| AUTH (LOGIN)
|--------------------------------------------------------------------------
*/

Route::get('/login', fn () => view('auth.login'))->name('login');


/*
|--------------------------------------------------------------------------
| ADMIN CONTENT DASHBOARD
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware('auth')->group(function () {

    Route::get('/dashboard', fn () => view('admin.dashboard'))->name('admin.dashboard');

    Route::get('/gallery', fn () => view('admin.gallery'))->name('admin.gallery');

    Route::get('/warta', fn () => view('admin.warta'))->name('admin.warta');

    Route::get('/event', fn () => view('admin.event'))->name('admin.event');

    Route::get('/news', fn () => view('admin.news'))->name('admin.news');

    
});


/*
|--------------------------------------------------------------------------
| ADMIN JEMAAT DASHBOARD (KHUSUS DATA JEMAAT)
|--------------------------------------------------------------------------
*/

Route::prefix('admin-jemaat')->middleware('auth')->group(function () {

    Route::get('/dashboard', fn () => view('admin-jemaat.dashboard'))
        ->name('admin-jemaat.dashboard');

    Route::get('/data', fn () => view('admin-jemaat.data'))
        ->name('admin-jemaat.data');
});
