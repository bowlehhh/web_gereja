@extends('layout.admin')

@section('title','Dashboard Admin')
@section('admin_heading','Dashboard')

@section('content')
@php
  use Illuminate\Support\Facades\Schema;
  use App\Models\EventItem;
  use App\Models\GalleryItem;
  use App\Models\Warta;
  use App\Models\HambaTuhan;

  $safeCount = function (string $table, callable $query) {
    try {
      if (!Schema::hasTable($table)) return 0;
      return (int) $query();
    } catch (\Throwable $e) {
      return 0;
    }
  };

  $countHamba = $safeCount('hamba_tuhans', fn () => HambaTuhan::query()->count());
  $countWarta = $safeCount('wartas', fn () => Warta::query()->count());
  $countEvent = $safeCount('event_items', fn () => EventItem::query()->count());
  $countGallery = $safeCount('gallery_items', fn () => GalleryItem::query()->count());
@endphp

<!-- Stats -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
  <div class="bg-gradient-to-r from-[#0b4a8b] to-[#0a66c2] text-white p-6 rounded-2xl shadow-lg hover:scale-[1.02] transition">
    <p class="opacity-90 font-semibold">Hamba Tuhan</p>
    <h2 class="text-4xl font-black mt-1">{{ $countHamba }}</h2>
  </div>
  <div class="bg-gradient-to-r from-[#083a6f] to-[#0b4a8b] text-white p-6 rounded-2xl shadow-lg hover:scale-[1.02] transition">
    <p class="opacity-90 font-semibold">Warta</p>
    <h2 class="text-4xl font-black mt-1">{{ $countWarta }}</h2>
  </div>
  <div class="bg-gradient-to-r from-[#0b4a8b] to-[#083a6f] text-white p-6 rounded-2xl shadow-lg hover:scale-[1.02] transition">
    <p class="opacity-90 font-semibold">Event</p>
    <h2 class="text-4xl font-black mt-1">{{ $countEvent }}</h2>
  </div>
  <div class="bg-gradient-to-r from-[#083a6f] to-[#0a66c2] text-white p-6 rounded-2xl shadow-lg hover:scale-[1.02] transition">
    <p class="opacity-90 font-semibold">Gallery</p>
    <h2 class="text-4xl font-black mt-1">{{ $countGallery }}</h2>
  </div>
</div>

<!-- Quick Actions -->
<div class="bg-white/80 backdrop-blur rounded-2xl shadow-xl overflow-hidden">
  <div class="p-5 font-bold text-lg text-slate-700 flex justify-between items-center gap-4 flex-wrap">
    <div class="font-black">Kelola Konten</div>
    <div class="flex gap-2 flex-wrap">
      <a href="{{ route('admin.hamba.index') }}" class="text-sm bg-[#0b4a8b] text-white px-4 py-2 rounded-lg hover:bg-[#083a6f] font-extrabold">Hamba Tuhan</a>
      <a href="{{ route('admin.warta.index') }}" class="text-sm bg-[#0b4a8b] text-white px-4 py-2 rounded-lg hover:bg-[#083a6f] font-extrabold">Warta</a>
      <a href="{{ route('admin.event.index') }}" class="text-sm bg-[#0b4a8b] text-white px-4 py-2 rounded-lg hover:bg-[#083a6f] font-extrabold">Event</a>
      <a href="{{ route('admin.gallery.index') }}" class="text-sm bg-[#0b4a8b] text-white px-4 py-2 rounded-lg hover:bg-[#083a6f] font-extrabold">Gallery</a>
    </div>
  </div>

  <table class="min-w-full text-sm">
    <thead class="bg-slate-100">
      <tr>
        <th class="px-6 py-3 text-left">Menu</th>
        <th class="px-6 py-3 text-left">Total Data</th>
        <th class="px-6 py-3 text-left">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <tr class="border-t hover:bg-slate-50">
        <td class="px-6 py-4 font-semibold">Gallery</td>
        <td class="px-6 py-4">{{ $countGallery }}</td>
        <td class="px-6 py-4">
          <a class="text-sm bg-[#0b4a8b] text-white px-4 py-2 rounded-lg hover:bg-[#083a6f] font-extrabold" href="{{ route('admin.gallery.create') }}">+ Tambah</a>
        </td>
      </tr>
      <tr class="border-t hover:bg-slate-50">
        <td class="px-6 py-4 font-semibold">Event</td>
        <td class="px-6 py-4">{{ $countEvent }}</td>
        <td class="px-6 py-4">
          <a class="text-sm bg-[#0b4a8b] text-white px-4 py-2 rounded-lg hover:bg-[#083a6f] font-extrabold" href="{{ route('admin.event.create') }}">+ Tambah</a>
        </td>
      </tr>
      <tr class="border-t hover:bg-slate-50">
        <td class="px-6 py-4 font-semibold">Warta</td>
        <td class="px-6 py-4">{{ $countWarta }}</td>
        <td class="px-6 py-4">
          <a class="text-sm bg-[#0b4a8b] text-white px-4 py-2 rounded-lg hover:bg-[#083a6f] font-extrabold" href="{{ route('admin.warta.create') }}">+ Tambah</a>
        </td>
      </tr>
      <tr class="border-t hover:bg-slate-50">
        <td class="px-6 py-4 font-semibold">Hamba Tuhan</td>
        <td class="px-6 py-4">{{ $countHamba }}</td>
        <td class="px-6 py-4">
          <a class="text-sm bg-[#0b4a8b] text-white px-4 py-2 rounded-lg hover:bg-[#083a6f] font-extrabold" href="{{ route('admin.hamba.create') }}">+ Tambah</a>
        </td>
      </tr>
    </tbody>
  </table>
</div>
@endsection
