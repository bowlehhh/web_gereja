@extends('layout.app')

@section('title', 'Warta Jemaat - GKKA Samarinda')
@section('meta_description', 'Arsip warta jemaat dan informasi pelayanan GKKA Indonesia Jemaat Samarinda.')
@section('meta_image', asset('img/fotogrj.jpeg'))

@section('content')
<section class="gkka-warta-hero">
  <div class="relative z-10">
    <div class="gkka-container pt-28 pb-10 sm:pt-32 sm:pb-14 md:pb-16 text-center">
      <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/15 text-blue-100 font-black tracking-widest uppercase text-xs backdrop-blur">
        Arsip
        <span class="text-white/35">•</span>
        Warta Jemaat
      </div>

      <h1 class="gkka-hero-title mt-6 text-4xl sm:text-5xl md:text-6xl font-black tracking-tight">
        Warta Jemaat
      </h1>
      <div class="mt-3 text-base sm:text-lg font-black tracking-widest text-white/90">
        GKKA-I SAMARINDA
      </div>

      <p class="mt-4 text-sm sm:text-base md:text-lg text-white/80 font-semibold max-w-2xl mx-auto">
        Kumpulan warta jemaat dan informasi pelayanan GKKA Indonesia Jemaat Samarinda.
      </p>
    </div>
  </div>
</section>

<section class="gkka-warta-body pt-10 pb-14 sm:pt-12 sm:pb-16">
  <div class="relative z-10">
    <div class="gkka-container">
      <div class="max-w-6xl mx-auto">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7 lg:gap-9 items-stretch justify-items-center">
          @forelse ($wartas as $w)
            @php
              $thumb = $w->thumbnail_path ? asset('storage/'.$w->thumbnail_path) : null;
              $dateLabel = optional($w->date)->translatedFormat('d F Y');
              $edition = $w->edition ?? '-';
            @endphp

            <a href="{{ asset('storage/'.$w->pdf_path) }}" target="_blank" rel="noopener"
               class="group block w-full max-w-[360px] rounded-[2.25rem] bg-[#f8fbff] text-slate-900 shadow-[0_26px_56px_rgba(0,0,0,0.35)] border border-white/70 overflow-hidden transition-all duration-200 hover:-translate-y-1 hover:shadow-[0_34px_70px_rgba(0,0,0,0.42)] active:-translate-y-2 active:shadow-[0_44px_90px_rgba(0,0,0,0.55)] focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-yellow-300/60">
              <div class="p-5 sm:p-6">
                <div class="relative rounded-[1.75rem] overflow-hidden bg-slate-100 border border-slate-200 shadow-sm">
                  <div class="aspect-[16/11]">
                    @if($thumb)
                      <img src="{{ $thumb }}" alt="{{ $w->title }}" class="w-full h-full object-cover group-hover:scale-[1.04] transition-transform duration-700">
                    @else
                      <div class="w-full h-full grid place-items-center text-slate-400 font-black">
                        PDF
                      </div>
                    @endif
                  </div>

                  <div class="absolute inset-0 bg-gradient-to-t from-black/35 via-black/0 to-black/0 opacity-60 pointer-events-none"></div>

                  <div class="absolute left-4 top-4">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/90 backdrop-blur text-slate-900 text-[11px] font-black shadow">
                      {{ $dateLabel ?: 'Warta' }}
                    </div>
                  </div>

                  {{-- PDF logo overlay (show on press/hover/focus) --}}
                  <div class="absolute inset-0 grid place-items-center opacity-0 scale-95 transition-all duration-200 bg-blue-900/20 backdrop-blur-[1px]
                              group-hover:opacity-100 group-hover:scale-100
                              group-focus-visible:opacity-100 group-focus-visible:scale-100
                              group-active:opacity-100 group-active:scale-100">
                    <div class="flex items-center gap-3 px-5 py-3 rounded-full bg-red-600 text-white shadow-2xl border border-white/30">
                      <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V8l-6-6zm1 7V3.5L19.5 9H15z"/>
                      </svg>
                      <span class="font-black tracking-widest text-sm">PDF</span>
                    </div>
                  </div>
                </div>

                <div class="mt-5">
                  <div class="font-black text-lg sm:text-xl leading-tight tracking-tight text-slate-900 line-clamp-2 group-hover:text-blue-800 transition-colors">
                    {{ $w->title }}
                  </div>
                  <div class="mt-2 text-xs font-bold uppercase tracking-widest text-slate-500">
                    Edisi {{ $edition }}
                    @if($dateLabel)
                      <span class="mx-2 text-slate-300">•</span>
                      {{ $dateLabel }}
                    @endif
                  </div>
                </div>
              </div>
            </a>
          @empty
            <div class="sm:col-span-2 lg:col-span-3 w-full">
              <div class="rounded-[2.25rem] border border-white/20 bg-white/10 backdrop-blur p-10 text-center text-white/80 font-semibold shadow-2xl">
                Belum ada warta.
              </div>
            </div>
          @endforelse
        </div>

        <div class="mt-12">
          @if(method_exists($wartas, 'links'))
            {{ $wartas->links() }}
          @endif
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
