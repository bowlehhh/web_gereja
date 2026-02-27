@extends('layout.app')

@section('title', 'Media - GKKA Samarinda')
@section('meta_description', 'Koleksi media ibadah, khotbah, dan dokumentasi GKKA Indonesia Jemaat Samarinda.')
@section('meta_image', asset('img/media.jpeg'))

@section('content')
<section class="relative bg-blue-900 text-white overflow-hidden">
  <div class="absolute inset-0">
    <img
      src="{{ asset('img/media.jpeg') }}"
      alt="Media GKKA Samarinda"
      class="w-full h-full object-cover object-[35%_14%] sm:object-[20%_12%] lg:object-[15%_10%]"
      onerror="this.onerror=null;this.src='{{ asset('img/fotogrj.jpeg') }}';"
    >
    <div class="absolute inset-0 bg-blue-900/40 sm:bg-blue-900/60 mix-blend-multiply"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-blue-900/75 sm:from-blue-900/85 via-blue-900/18 sm:via-blue-900/25 to-transparent"></div>
  </div>

  {{-- Faith icons overlay: keep away from portrait/face area --}}
  <div
    class="absolute inset-y-0 right-0 w-[44%] hidden lg:block pointer-events-none opacity-[0.13] gkka-faith-icons"
    style="-webkit-mask-image: linear-gradient(to left, rgba(0,0,0,0.98) 72%, rgba(0,0,0,0) 100%); mask-image: linear-gradient(to left, rgba(0,0,0,0.98) 72%, rgba(0,0,0,0) 100%);"
    aria-hidden="true"
  ></div>

  <div class="absolute inset-0 pointer-events-none opacity-20">
    <div class="absolute -top-32 -left-28 size-[520px] bg-blue-500 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-40 -right-24 size-[560px] bg-blue-700 rounded-full blur-3xl"></div>
  </div>

  <div
    class="relative min-h-[100svh] sm:min-h-screen w-full mx-auto px-5 sm:px-8 lg:pl-14 lg:pr-24 flex items-center justify-center lg:justify-end pt-20 sm:pt-24 pb-20 sm:pb-16 lg:pt-28 lg:pb-24"
  >
    <div class="w-full text-center max-w-[520px] mx-auto lg:mx-0 lg:ml-auto lg:mr-16">
      <div class="relative overflow-hidden rounded-3xl border border-white/15 shadow-xl sm:shadow-2xl p-6 sm:p-8 lg:p-12 bg-slate-900/40 sm:bg-slate-900/55 backdrop-blur-lg">
        <div class="absolute inset-0 bg-gradient-to-b from-white/10 via-white/0 to-slate-900/30 pointer-events-none"></div>
        <div class="relative">
        <div class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-white/10 border border-white/10 text-blue-100 font-black tracking-[0.22em] uppercase text-xs">
          GKKA Samarinda
        </div>

        <h1 class="gkka-hero-title mt-6 text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black tracking-tight leading-[1.05]">
          Tayangan Ibadah
          <span class="block text-blue-200 mt-1">&amp; Dokumentasi</span>
        </h1>

        <p class="mt-5 text-base sm:text-lg md:text-xl text-blue-100 font-semibold leading-relaxed max-w-2xl mx-auto">
          Kumpulan media dan dokumentasi lainnya. Scroll ke bawah untuk melihat semua tayangan.
        </p>

        <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center">
          <a href="#tayangan"
             class="h-12 sm:h-14 px-7 sm:px-9 rounded-2xl bg-yellow-500 hover:bg-yellow-400 text-blue-900 font-black shadow-xl transition inline-flex items-center justify-center w-full sm:w-auto">
            Lihat Tayangan
          </a>
          <a href="{{ route('kontak') }}"
             class="h-12 sm:h-14 px-7 sm:px-9 rounded-2xl bg-white/10 hover:bg-white/15 border border-white/15 text-white font-black shadow-lg transition inline-flex items-center justify-center w-full sm:w-auto">
            Hubungi Admin
          </a>
        </div>
        </div>
      </div>
    </div>
  </div>

  <a href="#tayangan" class="absolute bottom-6 left-1/2 -translate-x-1/2 text-blue-100/90 hover:text-white font-bold text-sm inline-flex items-center gap-2">
    Scroll
    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12 16.5 5.5 10l1.4-1.4L12 13.7l5.1-5.1L18.5 10 12 16.5z"/></svg>
  </a>
</section>

<section id="tayangan" class="relative gkka-section-tight bg-gradient-to-b from-sky-700 via-cyan-700 to-blue-900 text-white overflow-hidden scroll-mt-24">
  <div class="absolute inset-0 pointer-events-none opacity-20">
    <svg class="absolute -top-8 left-8 w-36 h-36 text-white/60" viewBox="0 0 120 120" fill="none" stroke="currentColor" aria-hidden="true">
      <path d="M60 18v84M30 60h60" stroke-width="6" stroke-linecap="round"/>
    </svg>
    <svg class="absolute top-16 right-12 w-44 h-44 text-white/40" viewBox="0 0 120 120" fill="none" stroke="currentColor" aria-hidden="true">
      <path d="M60 14v18M60 88v18M14 60h18M88 60h18M27 27l13 13M80 80l13 13M93 27 80 40M40 80 27 93" stroke-width="5" stroke-linecap="round"/>
      <circle cx="60" cy="60" r="16" stroke-width="5"/>
    </svg>
    <svg class="absolute bottom-10 left-10 w-52 h-52 text-white/35" viewBox="0 0 160 120" fill="none" stroke="currentColor" aria-hidden="true">
      <path d="M18 28c18-10 40-10 62 0v74c-22-10-44-10-62 0V28z" stroke-width="5" stroke-linejoin="round"/>
      <path d="M80 28c22-10 44-10 62 0v74c-18-10-40-10-62 0V28z" stroke-width="5" stroke-linejoin="round"/>
      <path d="M80 28v74" stroke-width="5" stroke-linecap="round"/>
    </svg>
    <svg class="absolute -bottom-16 right-8 w-56 h-56 text-white/30" viewBox="0 0 120 120" fill="none" stroke="currentColor" aria-hidden="true">
      <path d="M60 18v84M30 60h60" stroke-width="6" stroke-linecap="round"/>
    </svg>
  </div>
  <div class="gkka-container">
    <div class="max-w-3xl mx-auto text-center">
      <h2 class="text-2xl md:text-3xl font-black tracking-tight">Tayangan Ibadah Rutin Mingguan</h2>

      <form method="GET" action="{{ route('media') }}" class="mt-6 flex flex-col md:flex-row gap-3 items-center justify-center rounded-3xl border border-white/15 bg-white/10 backdrop-blur-lg p-4 sm:p-5">
        <div class="w-full md:flex-1">
          <input type="text" name="q" value="{{ $q ?? '' }}" placeholder="Search..."
                 class="w-full h-12 px-5 rounded-2xl border border-white/20 bg-white/10 text-white placeholder:text-white/60 font-semibold focus:outline-none focus:ring-2 focus:ring-yellow-300/70 focus:border-transparent transition">
        </div>

        <div class="w-full md:w-56">
          <input type="date" name="date" value="{{ $date ?? '' }}"
                 class="w-full h-12 px-5 rounded-2xl border border-white/20 bg-white/10 text-white font-semibold focus:outline-none focus:ring-2 focus:ring-yellow-300/70 focus:border-transparent transition">
        </div>

        <div class="w-full md:w-auto flex gap-2">
          <button type="submit"
                  class="h-12 px-6 rounded-2xl bg-yellow-500 hover:bg-yellow-400 text-blue-900 font-black shadow-md transition w-full md:w-auto">
            Filter
          </button>
          @if(!empty($q) || !empty($date))
            <a href="{{ route('media') }}"
               class="h-12 px-6 rounded-2xl bg-white/10 hover:bg-white/15 text-white font-black border border-white/15 shadow-sm transition inline-flex items-center justify-center w-full md:w-auto">
              Reset
            </a>
          @endif
        </div>
      </form>
    </div>

    @if($items->count() === 0)
      <div class="mt-10 rounded-3xl border border-white/15 bg-white/10 backdrop-blur-lg p-10 text-center text-blue-100 font-bold">
        Belum ada tayangan untuk ditampilkan.
      </div>
    @else
      <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($items as $it)
          <a href="{{ $it->youtube_url }}" target="_blank" rel="noopener"
             class="group rounded-3xl overflow-hidden border border-slate-200 bg-white shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all">
            <div class="aspect-[16/9] bg-slate-100 relative overflow-hidden">
              @if($it->thumbnail_url)
                <img src="{{ $it->thumbnail_url }}" alt="{{ $it->title }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
              @endif
              <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-transparent"></div>
              <div class="absolute inset-0 grid place-items-center">
                <div class="size-14 rounded-2xl bg-white/90 backdrop-blur text-blue-900 grid place-items-center shadow-lg group-hover:scale-105 transition">
                  <svg class="w-7 h-7 translate-x-[1px]" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                </div>
              </div>
            </div>

            <div class="p-6">
              <div class="font-black text-slate-800 text-lg leading-snug line-clamp-2">{{ $it->title }}</div>
              @if(!empty($it->speaker))
                <div class="mt-2 text-sm font-bold text-slate-600">{{ $it->speaker }}</div>
              @endif
              <div class="mt-2 text-xs font-bold text-slate-500">
                @if($it->service_at)
                  {{ $it->service_at->locale('id')->translatedFormat('l, d F Y') }} • Jam {{ $it->service_at->format('H.i') }} WITA
                @else
                  &nbsp;
                @endif
              </div>
            </div>
          </a>
        @endforeach
      </div>

      <div class="mt-10">
        @if(method_exists($items, 'links'))
          {{ $items->links() }}
        @endif
      </div>
    @endif
  </div>
</section>
@endsection
