@extends('layout.app')

@section('title', $item->name.' - Hamba Tuhan')
@section('body_class','bg-[#001B44]')

@section('content')
@php
  use Illuminate\Support\Facades\Storage;

  $kontak = trim(($item->contact ?? ''));
  $bidang = trim(($item->service_fields ?? ''));
  $ringkas = trim(($item->roles_summary ?? ''));

  $hasPhoto = filled($item->photo_path) && Storage::disk('public')->exists($item->photo_path);
  $photoUrl = $hasPhoto ? Storage::url($item->photo_path) : null;
@endphp

<section class="gkka-blue-page px-4 sm:px-6">
  <div class="w-full max-w-[1400px] mx-auto">
    <div class="gkka-blue-stage px-5 sm:px-8 md:px-14 py-10 sm:py-12 md:py-16">
      <div class="gkka-blue-corner tl"></div>
      <div class="gkka-blue-corner br"></div>

      <div class="relative z-10 grid grid-cols-1 lg:grid-cols-[1.1fr_0.9fr] gap-10 lg:gap-12 items-start">
        {{-- Text / About (mobile first) --}}
        <div class="order-1 lg:order-2">
          <div class="flex items-start justify-between gap-4">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/15 text-blue-100 font-black tracking-widest uppercase text-xs">
              Hamba Tuhan
            </div>
            <a class="h-11 px-6 rounded-2xl bg-white/10 hover:bg-white/15 border border-white/15 text-white font-black shadow-sm transition inline-flex items-center justify-center"
               href="{{ route('gereja.hamba') }}">
              ← Kembali
            </a>
          </div>

          <h1 class="gkka-hero-title mt-6 text-3xl sm:text-4xl md:text-5xl font-black tracking-tight leading-[1.05]">
            {{ $item->name }}
          </h1>
          <div class="mt-2 text-sm sm:text-base font-semibold text-blue-100/85">
            {{ $ringkas !== '' ? $ringkas : 'Hamba Tuhan' }}
          </div>

          <div class="mt-10 max-w-xl space-y-10">
            <div>
              <div class="text-xs font-black tracking-widest uppercase text-blue-100/80">About</div>
              <h2 class="mt-2 text-2xl sm:text-3xl font-black text-white leading-tight">{{ $item->name }}</h2>
              <div class="mt-5 h-px bg-white/15"></div>
            </div>

            <div>
              <div class="flex items-center gap-3 text-white font-black">
                <span class="w-10 h-1 bg-yellow-400 rounded-full"></span>
                Profile
              </div>
              <div class="mt-4 text-white/80 text-base sm:text-lg leading-relaxed">
                {!! nl2br(e($item->profile ?: 'Info profile belum tersedia.')) !!}
              </div>
            </div>

            <div>
              <div class="flex items-center gap-3 text-white font-black">
                <span class="w-10 h-1 bg-yellow-400 rounded-full"></span>
                Bidang Pelayanan
              </div>
              <div class="mt-4 text-white/80 text-base sm:text-lg leading-relaxed">
                @if($bidang !== '')
                  {!! nl2br(e($bidang)) !!}
                @elseif($ringkas !== '' || $kontak !== '')
                  <p class="font-bold text-white">{{ $ringkas }}</p>
                  @if($kontak !== '')
                    <p class="mt-3 inline-flex items-center gap-2 text-sm bg-white/10 border border-white/15 text-white px-4 py-2 rounded-2xl font-black">
                      Dukungan Doa &amp; Kontak: <span class="font-extrabold">{{ $kontak }}</span>
                    </p>
                  @endif
                @else
                  <span class="italic text-white/60">Info bidang pelayanan belum tersedia.</span>
                @endif
              </div>
            </div>

            <div class="pt-2 flex flex-wrap items-center gap-3">
              <a class="h-12 px-6 rounded-2xl bg-white/10 hover:bg-white/15 border border-white/15 text-white font-black shadow-sm transition inline-flex items-center justify-center"
                 href="{{ route('gereja.hamba') }}">
                ← Kembali
              </a>
              <a class="h-12 px-7 rounded-2xl bg-yellow-400/15 hover:bg-yellow-400/25 border border-yellow-300/50 text-white font-black shadow-sm transition inline-flex items-center justify-center"
                 href="{{ route('kontak') }}">
                Hubungi Kami
              </a>
            </div>
          </div>
        </div>

        {{-- Single Photo (match Majelis vibe) --}}
        <div class="order-2 lg:order-1">
          <div class="relative">
            <div class="absolute -inset-8 bg-yellow-400/10 blur-3xl rounded-full"></div>
            <div class="mx-auto lg:mx-0 max-w-[520px]">
              <div class="rounded-[2.5rem] overflow-hidden border border-white/20 shadow-[0_26px_56px_rgba(0,0,0,0.35)] bg-white/5 backdrop-blur">
                <div class="aspect-[4/5] sm:aspect-[16/12] lg:aspect-[4/5] overflow-hidden">
                  @if($photoUrl)
                    <img
                      src="{{ $photoUrl }}"
                      alt="{{ $item->name }}"
                      class="w-full h-full object-cover object-top transition-transform duration-700 hover:scale-105"
                      loading="eager"
                    >
                  @else
                    <div class="w-full h-full grid place-items-center bg-white/10 text-white/70 font-black text-6xl">
                      GK
                    </div>
                  @endif
                </div>
              </div>

              @if($kontak !== '')
                <div class="mt-5 rounded-3xl border border-white/15 bg-white/10 backdrop-blur p-5">
                  <div class="text-[11px] font-black tracking-widest uppercase text-blue-100/80">Kontak</div>
                  <div class="mt-1 text-sm sm:text-base font-semibold text-white break-words">{{ $kontak }}</div>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
