@extends('layout.app')

@section('title','Cabang GKKA Indonesia | GKKA Samarinda')
@section('meta_description', 'Daftar cabang GKKA Indonesia yang dibina dalam jaringan pelayanan GKKA Samarinda.')
@section('meta_image', asset('img/fotogrj.jpeg'))

@section('content')
@php
  $hero = asset('img/fotogrj.jpeg');
  $totalCabang = method_exists($items, 'total') ? $items->total() : count($items);
@endphp

<section class="relative overflow-hidden text-white">
  <div class="absolute inset-0">
    <img src="{{ $hero }}" alt="Cabang GKKA Indonesia" class="w-full h-full object-cover" onerror="this.onerror=null;this.src='{{ asset('assets/logo.png') }}';">
    <div class="absolute inset-0 bg-blue-950/65 mix-blend-multiply"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-blue-950/80 via-blue-950/35 to-transparent"></div>
  </div>

  <div class="gkka-container relative pt-28 pb-14 sm:pt-32 sm:pb-16">
    <div class="max-w-2xl text-center sm:text-left mx-auto sm:mx-0">
      <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/15 text-blue-100 font-black tracking-widest uppercase text-xs">
        Jaringan Pelayanan GKKA
      </div>
      <h1 class="gkka-hero-title mt-6 text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black tracking-tight leading-[1.05]">
        Cabang Gereja<br class="hidden sm:block">
        <span class="text-blue-200">GKKA Indonesia</span>
      </h1>
      <p class="mt-5 text-sm sm:text-base md:text-lg text-blue-100 font-semibold leading-relaxed">
        Temukan cabang terdekat dan lihat ringkasan about tiap cabang sebelum masuk ke detail.
      </p>

      <div class="mt-7 flex items-center justify-center sm:justify-start gap-3">
        <a href="#list" class="h-11 px-5 rounded-2xl bg-yellow-500 hover:bg-yellow-400 text-blue-900 font-black shadow-md transition inline-flex items-center justify-center">
          Lihat Cabang
        </a>
        <a href="{{ route('home') }}#cabang-home" class="h-11 px-5 rounded-2xl bg-white/10 hover:bg-white/15 border border-white/15 text-white font-black shadow-sm transition inline-flex items-center justify-center">
          Lihat di Beranda
        </a>
      </div>
    </div>
  </div>
</section>

<section id="list" class="gkka-section-tight bg-gray-50 scroll-mt-24">
  <div class="gkka-container">
    <div class="flex items-end justify-between gap-4 mb-8">
      <div>
        <h2 class="text-2xl sm:text-3xl font-black tracking-tight text-slate-900">Cabang GKKA Indonesia</h2>
        <p class="mt-1 text-sm sm:text-base text-slate-600 font-semibold">Klik kartu untuk lihat detail dan about lengkap cabang.</p>
      </div>
      <div class="hidden sm:inline-flex items-center px-3 py-1.5 rounded-full bg-white border border-slate-200 text-slate-700 text-xs font-black tracking-widest uppercase shadow-sm">
        {{ $totalCabang }} cabang
      </div>
    </div>

    <div class="lg:hidden space-y-6">
      @forelse($items as $it)
        @php
          $image = $it->image_path ? asset('storage/'.$it->image_path) : asset('assets/logo.png');
          $about = trim((string) $it->about);
        @endphp
        <a href="{{ route('cabang.show', $it) }}"
           class="group block rounded-3xl overflow-hidden border border-slate-200 bg-white shadow-sm hover:shadow-xl transition-shadow">
          <div class="relative">
            <div class="aspect-[16/10] bg-slate-100 overflow-hidden">
              <img src="{{ $image }}" alt="{{ $it->name }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-105">
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/75 via-slate-950/0 to-transparent"></div>

            <div class="absolute top-4 left-4 flex items-center gap-2">
              <span class="inline-flex items-center px-3 py-1.5 rounded-full bg-white/90 backdrop-blur text-blue-900 text-xs font-black tracking-widest uppercase shadow">
                Cabang
              </span>
              <span class="inline-flex items-center px-3 py-1.5 rounded-full backdrop-blur text-xs font-black tracking-widest uppercase shadow {{ $it->is_published ? 'bg-emerald-400/95 text-emerald-950' : 'bg-rose-300/95 text-rose-950' }}">
                {{ $it->is_published ? 'Aktif' : 'Nonaktif' }}
              </span>
            </div>

            <div class="absolute bottom-0 left-0 w-full p-5 text-white">
              <div class="font-black text-lg leading-snug line-clamp-2">{{ $it->name }}</div>
              <div class="mt-2 text-xs font-bold text-white/80">
                {{ $it->city ?: 'Lokasi belum diisi' }}
              </div>
            </div>
          </div>

          <div class="p-5">
            <div class="text-sm font-semibold text-slate-600 leading-relaxed line-clamp-4">
              {{ $about !== '' ? \Illuminate\Support\Str::limit($about, 180) : 'Informasi about cabang belum tersedia.' }}
            </div>
            <div class="mt-4 inline-flex items-center gap-2 text-sm font-black text-blue-700 group-hover:text-blue-900 transition-colors">
              Lihat detail cabang
              <span aria-hidden="true">→</span>
            </div>
          </div>
        </a>
      @empty
        <div class="p-10 bg-white rounded-3xl border border-slate-200 text-center text-slate-500 font-bold">
          Belum ada cabang yang dipublish.
        </div>
      @endforelse
    </div>

    <div class="hidden lg:grid grid-cols-3 gap-8 mb-12">
      @forelse($items as $it)
        @php
          $image = $it->image_path ? asset('storage/'.$it->image_path) : asset('assets/logo.png');
          $about = trim((string) $it->about);
        @endphp
        <a class="group block bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 border border-gray-100"
           href="{{ route('cabang.show', $it) }}">
          <div class="h-56 bg-cover bg-center relative overflow-hidden" style="background-image:url('{{ $image }}');">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-80 group-hover:opacity-100 transition-opacity"></div>
            <div class="absolute bottom-0 left-0 p-6 w-full text-white">
              <div class="text-xs font-bold text-yellow-400 uppercase tracking-widest mb-2">Cabang</div>
              <h3 class="text-xl font-black leading-tight mb-2 group-hover:text-blue-300 transition-colors line-clamp-2">{{ $it->name }}</h3>
              <div class="flex items-center gap-2 text-xs font-bold text-gray-200">
                <span>{{ $it->city ?: 'Lokasi belum diisi' }}</span>
                <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                <span>{{ $it->is_published ? 'Aktif' : 'Nonaktif' }}</span>
              </div>
            </div>
          </div>

          <div class="p-6 text-slate-600 text-sm leading-relaxed border-t border-gray-100">
            <p class="line-clamp-4">
              {{ $about !== '' ? \Illuminate\Support\Str::limit($about, 200) : 'Informasi about cabang belum tersedia.' }}
            </p>
            <div class="mt-4 inline-flex items-center gap-2 text-sm font-black text-blue-700 group-hover:text-blue-900 transition-colors">
              Lihat detail cabang
              <span aria-hidden="true">→</span>
            </div>
          </div>
        </a>
      @empty
        <div class="col-span-full p-12 bg-white rounded-3xl border border-gray-200 text-center text-gray-400 font-bold">
          Belum ada cabang yang dipublish.
        </div>
      @endforelse
    </div>

    @if(method_exists($items, 'hasMorePages') && $items->hasMorePages())
      <div class="flex justify-center mt-12">
        <a class="px-8 py-3 rounded-full bg-blue-600 text-white font-bold shadow-lg hover:bg-blue-700 hover:scale-105 transition-all" href="{{ $items->nextPageUrl() }}">Lebih Banyak</a>
      </div>
    @elseif(method_exists($items, 'links'))
      <div class="mt-12">
        {{ $items->links() }}
      </div>
    @endif
  </div>
</section>
@endsection
