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
  use App\Models\MajelisMember;

  $safeCount = function (string $table, callable $query) {
    try {
      if (!Schema::hasTable($table)) return 0;
      return (int) $query();
    } catch (\Throwable $e) {
      return 0;
    }
  };

  $safeGet = function (string $table, callable $query) {
    try {
      if (!Schema::hasTable($table)) return collect([]);
      return $query();
    } catch (\Throwable $e) {
      return collect([]);
    }
  };

  $countHamba = $safeCount('hamba_tuhans', fn () => HambaTuhan::query()->count());
  $countMajelis = $safeCount('majelis_members', fn () => MajelisMember::query()->count());
  $countWarta = $safeCount('wartas', fn () => Warta::query()->count());
  $countEvent = $safeCount('event_items', fn () => EventItem::query()->count());
  $countGallery = $safeCount('gallery_items', fn () => GalleryItem::query()->count());

  $latestWarta = $safeGet('wartas', fn () => Warta::latest()->limit(5)->get());
  $upcomingEvents = $safeGet('event_items', fn () => EventItem::where('start_date', '>=', now())->orderBy('start_date', 'asc')->limit(4)->get());
  
  // Fallback to latest events if no upcoming ones
  if($upcomingEvents->isEmpty()) {
      $upcomingEvents = $safeGet('event_items', fn () => EventItem::latest()->limit(4)->get());
  }
@endphp



<div class="space-y-8">
  <!-- Stats Grid -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
    <!-- Hamba Tuhan Card -->
    <div class="relative overflow-hidden bg-white p-6 rounded-3xl shadow-sm border border-slate-100 group hover:shadow-lg transition-all duration-300">
      <div class="absolute -right-4 -top-4 opacity-10 group-hover:opacity-20 transition-opacity rotate-12">
        <svg class="w-32 h-32 text-blue-900" fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path></svg>
      </div>
      <div class="relative z-10 flex flex-col h-full justify-between">
        <div class="flex items-center gap-3 mb-4">
          <div class="p-2.5 bg-blue-50 text-blue-900 rounded-xl">
             <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path></svg>
          </div>
          <span class="font-bold text-slate-500 text-sm uppercase tracking-wider">Hamba Tuhan</span>
        </div>
        <div>
          <h3 class="text-4xl font-black text-slate-800 tracking-tight">{{ $countHamba }}</h3>
          <p class="text-slate-400 text-xs font-bold mt-1">Total Aktif</p>
        </div>
      </div>
    </div>

    <!-- Warta Card -->
    <div class="relative overflow-hidden bg-white p-6 rounded-3xl shadow-sm border border-slate-100 group hover:shadow-lg transition-all duration-300">
      <div class="absolute -right-4 -top-4 opacity-10 group-hover:opacity-20 transition-opacity rotate-12">
         <svg class="w-32 h-32 text-indigo-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 3.414L15.586 7A2 2 0 0116 8.414V16a6 6 0 01-6 6H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
      </div>
      <div class="relative z-10 flex flex-col h-full justify-between">
        <div class="flex items-center gap-3 mb-4">
          <div class="p-2.5 bg-indigo-50 text-indigo-600 rounded-xl">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 3.414L15.586 7A2 2 0 0116 8.414V16a6 6 0 01-6 6H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
          </div>
          <span class="font-bold text-slate-500 text-sm uppercase tracking-wider">Warta</span>
        </div>
        <div>
          <h3 class="text-4xl font-black text-slate-800 tracking-tight">{{ $countWarta }}</h3>
          <p class="text-slate-400 text-xs font-bold mt-1">Dokumen Terupload</p>
        </div>
      </div>
    </div>

    <!-- Event Card -->
    <div class="relative overflow-hidden bg-white p-6 rounded-3xl shadow-sm border border-slate-100 group hover:shadow-lg transition-all duration-300">
      <div class="absolute -right-4 -top-4 opacity-10 group-hover:opacity-20 transition-opacity rotate-12">
         <svg class="w-32 h-32 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
      </div>
      <div class="relative z-10 flex flex-col h-full justify-between">
        <div class="flex items-center gap-3 mb-4">
          <div class="p-2.5 bg-emerald-50 text-emerald-600 rounded-xl">
             <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
          </div>
          <span class="font-bold text-slate-500 text-sm uppercase tracking-wider">Event Item</span>
        </div>
        <div>
          <h3 class="text-4xl font-black text-slate-800 tracking-tight">{{ $countEvent }}</h3>
          <p class="text-slate-400 text-xs font-bold mt-1">Agenda Kegiatan</p>
        </div>
      </div>
    </div>

    <!-- Gallery Card -->
    <div class="relative overflow-hidden bg-white p-6 rounded-3xl shadow-sm border border-slate-100 group hover:shadow-lg transition-all duration-300">
      <div class="absolute -right-4 -top-4 opacity-10 group-hover:opacity-20 transition-opacity rotate-12">
         <svg class="w-32 h-32 text-pink-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path></svg>
      </div>
      <div class="relative z-10 flex flex-col h-full justify-between">
        <div class="flex items-center gap-3 mb-4">
          <div class="p-2.5 bg-pink-50 text-pink-600 rounded-xl">
             <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path></svg>
          </div>
          <span class="font-bold text-slate-500 text-sm uppercase tracking-wider">Gallery</span>
        </div>
        <div>
          <h3 class="text-4xl font-black text-slate-800 tracking-tight">{{ $countGallery }}</h3>
          <p class="text-slate-400 text-xs font-bold mt-1">Dokumentasi</p>
        </div>
      </div>
    </div>
    <!-- Majelis Card -->
    <div class="relative overflow-hidden bg-white p-6 rounded-3xl shadow-sm border border-slate-100 group hover:shadow-lg transition-all duration-300">
      <div class="absolute -right-4 -top-4 opacity-10 group-hover:opacity-20 transition-opacity rotate-12">
        <svg class="w-32 h-32 text-blue-700" fill="currentColor" viewBox="0 0 20 20"><path d="M13 7a4 4 0 11-8 0 4 4 0 018 0zM17 9a3 3 0 11-6 0 3 3 0 016 0zM2 18a6 6 0 0112 0v1H2v-1zm13 1v-1a5 5 0 00-1.5-3.57A5 5 0 0119 19v0h-4z"></path></svg>
      </div>
      <div class="relative z-10 flex flex-col h-full justify-between">
        <div class="flex items-center gap-3 mb-4">
          <div class="p-2.5 bg-blue-50 text-blue-700 rounded-xl">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M13 7a4 4 0 11-8 0 4 4 0 018 0zM17 9a3 3 0 11-6 0 3 3 0 016 0zM2 18a6 6 0 0112 0v1H2v-1zm13 1v-1a5 5 0 00-1.5-3.57A5 5 0 0119 19v0h-4z"></path></svg>
          </div>
          <span class="font-bold text-slate-500 text-sm uppercase tracking-wider">Majelis</span>
        </div>
        <div>
          <h3 class="text-4xl font-black text-slate-800 tracking-tight">{{ $countMajelis }}</h3>
          <p class="text-slate-400 text-xs font-bold mt-1">Data Terdaftar</p>
        </div>
        <div class="mt-4">
          <a href="{{ route('admin.majelis.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-blue-600 hover:text-blue-800 hover:underline">
            Kelola Majelis →
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
    
    <!-- Left Column -->
    <div class="xl:col-span-2 space-y-8">
        
        <!-- Recent Uploads / Table -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-black text-slate-800">Warta Terkini</h3>
                <a href="{{ route('admin.warta.index') }}" class="text-xs font-bold text-blue-600 hover:text-blue-800 hover:underline">Lihat Semua</a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-100">
                            <th class="py-3 px-4 text-xs font-bold uppercase tracking-wider text-slate-500">Judul / Edisi</th>
                            <th class="py-3 px-4 text-xs font-bold uppercase tracking-wider text-slate-500">Tanggal</th>
                            <th class="py-3 px-4 text-xs font-bold uppercase tracking-wider text-slate-500 text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($latestWarta as $w)
                        <tr class="group hover:bg-slate-50/80 transition-colors">
                            <td class="py-3 px-4">
                                <div class="font-bold text-slate-700 group-hover:text-blue-900 transition-colors">{{ $w->title }}</div>
                                <div class="text-xs text-slate-400">{{ $w->edition }}</div>
                            </td>
                            <td class="py-3 px-4 text-sm text-slate-600 font-medium">
                                {{ $w->date ? $w->date->format('d M Y') : '-' }}
                            </td>
                            <td class="py-3 px-4 text-right">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-bold {{ $w->is_published ? 'bg-emerald-50 text-emerald-600' : 'bg-slate-100 text-slate-500' }}">
                                    {{ $w->is_published ? 'Published' : 'Draft' }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="py-8 text-center text-slate-400 text-sm italic">Belum ada data warta.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Right Column -->
    <div class="space-y-8">
        
        <!-- Quick Actions -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
          <h3 class="text-lg font-black text-slate-800 mb-5 flex items-center gap-2">
            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            Aksi Cepat
          </h3>
          <div class="grid grid-cols-2 gap-3">
            <a href="{{ route('admin.warta.create') }}" class="flex flex-col items-center justify-center gap-2 p-4 bg-blue-50 hover:bg-blue-100 rounded-2xl transition border border-blue-100 group">
              <svg class="w-6 h-6 text-blue-600 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
              <span class="text-xs font-bold text-blue-900">Upload Warta</span>
            </a>
            <a href="{{ route('admin.event.create') }}" class="flex flex-col items-center justify-center gap-2 p-4 bg-emerald-50 hover:bg-emerald-100 rounded-2xl transition border border-emerald-100 group">
              <svg class="w-6 h-6 text-emerald-600 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
              <span class="text-xs font-bold text-emerald-900">Buat Event</span>
            </a>
            <a href="{{ route('admin.gallery.create') }}" class="flex flex-col items-center justify-center gap-2 p-4 bg-pink-50 hover:bg-pink-100 rounded-2xl transition border border-pink-100 group">
              <svg class="w-6 h-6 text-pink-600 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
              <span class="text-xs font-bold text-pink-900">Tambah Foto</span>
            </a>
            <a href="{{ route('admin.hamba.create') }}" class="flex flex-col items-center justify-center gap-2 p-4 bg-amber-50 hover:bg-amber-100 rounded-2xl transition border border-amber-100 group">
              <svg class="w-6 h-6 text-amber-600 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
              <span class="text-xs font-bold text-amber-900">Data Hamba</span>
            </a>
          </div>
        </div>

        <!-- Upcoming Events / Recent -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
            <h3 class="text-lg font-black text-slate-800 mb-4 flex items-center justify-between">
                <span>Agenda / Event</span>
                <span class="text-xs bg-blue-50 text-blue-600 px-2 py-1 rounded-lg">Terbaru</span>
            </h3>
            
            <div class="space-y-4">
                @forelse($upcomingEvents as $e)
                <div class="flex gap-4 group">
                    <div class="flex-shrink-0 w-14 h-14 bg-slate-50 rounded-xl border border-slate-100 flex flex-col items-center justify-center text-center">
                        <span class="text-[10px] font-bold text-red-500 uppercase">{{ $e->start_date ? $e->start_date->format('M') : 'N/A' }}</span>
                        <span class="text-lg font-black text-slate-800 leading-none">{{ $e->start_date ? $e->start_date->format('d') : '-' }}</span>
                    </div>
                    <div class="flex-1 min-w-0 py-0.5">
                        <h4 class="text-sm font-bold text-slate-800 truncate group-hover:text-blue-900 transition-colors">{{ $e->title }}</h4>
                        <div class="flex items-center gap-1.5 mt-1 text-slate-400 text-xs">
                             <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                             <span class="truncate">{{ $e->location ?? 'Lokasi tidak ada' }}</span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-6">
                    <p class="text-slate-400 text-sm italic">Belum ada agenda mendatang.</p>
                </div>
                @endforelse
            </div>
            
             <a href="{{ route('admin.event.index') }}" class="block mt-5 text-center text-sm font-bold text-slate-500 hover:text-blue-600 transition p-2 hover:bg-slate-50 rounded-xl border border-transparent hover:border-slate-100">
                Lihat Semua Agenda
            </a>
        </div>

        <!-- System Info -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
            <h3 class="text-sm font-black text-slate-400 uppercase tracking-widest mb-4">System Info</h3>
            <div class="space-y-3">
            <div class="flex items-center justify-between">
                <div class="text-xs font-bold text-slate-600">Laravel</div>
                <div class="text-xs font-black text-slate-800 bg-slate-100 px-2 py-0.5 rounded">{{ app()->version() }}</div>
            </div>
            <div class="flex items-center justify-between">
                <div class="text-xs font-bold text-slate-600">PHP</div>
                <div class="text-xs font-black text-slate-800 bg-slate-100 px-2 py-0.5 rounded">{{ phpversion() }}</div>
            </div>
            <div class="flex items-center justify-between">
                <div class="text-xs font-bold text-slate-600">Server Status</div>
                 <div class="flex items-center gap-1.5">
                    <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    <div class="text-xs font-black text-emerald-600">Online</div>
                </div>
            </div>
            </div>
        </div>

    </div>
  </div>
</div>
@endsection
