@extends('layout.app')

@section('title', 'Bidang Pelayanan GKKA Samarinda | GKKA INDONESIA')
@section('meta_description', 'Dashboard bidang pelayanan GKKA Samarinda yang menampilkan pemuda, wanita, sekolah minggu, multimedia, musik, dan pelayanan lain dalam tampilan mobile-first yang ringan.')
@section('meta_image', asset('img/fotogrj.jpeg'))

@section('content')
@php
  $heroBackground = asset('img/backgroundKomisi.jpeg');
  $items = $items ?? collect();
@endphp

<section class="relative overflow-hidden text-white">
  <div class="absolute inset-0">
    <img src="{{ $heroBackground }}" alt="Bidang Pelayanan GKKA" class="w-full h-full object-cover object-[center_72%] sm:object-[center_66%]">
    <div class="absolute inset-0 bg-blue-950/65 mix-blend-multiply"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-blue-950/80 via-blue-950/35 to-transparent"></div>
  </div>

  <div class="gkka-container relative pt-28 pb-14 sm:pt-32 sm:pb-16">
    <div class="max-w-2xl text-center sm:text-left mx-auto sm:mx-0">
      <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/15 text-blue-100 font-black tracking-widest uppercase text-xs">
        Bidang Pelayanan GKKA
      </div>
      <h1 class="gkka-hero-title mt-6 text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black tracking-tight leading-[1.05]">
        Bidang Pelayanan<br class="hidden sm:block">
        <span class="text-blue-200">GKKA-I Samarinda</span>
      </h1>
      <p class="mt-5 text-sm sm:text-base md:text-lg text-blue-100 font-semibold leading-relaxed">
        Lihat daftar bidang pelayanan dan buka detail setiap pelayanan jemaat dengan tampilan yang lebih ringkas.
      </p>
      <div class="mt-7 flex items-center justify-center sm:justify-start gap-3">
        <a href="#daftar-bidang" class="h-11 px-5 rounded-2xl bg-yellow-500 hover:bg-yellow-400 text-blue-900 font-black shadow-md transition inline-flex items-center justify-center">
          Lihat Bidang
        </a>
      </div>
    </div>
  </div>
</section>

<section id="daftar-bidang" class="bg-[#f5f7fb] py-6 sm:py-10">
  <div class="mx-auto w-full max-w-[430px] px-4 sm:max-w-6xl sm:px-6">
    <div class="mb-4 rounded-[24px] border border-[#d9e3f4] bg-white/90 p-4 shadow-[0_14px_30px_rgba(15,43,107,0.08)] sm:mb-8 sm:p-5">
      <h2 class="text-[1.35rem] font-black tracking-tight text-[#0F2B6B] sm:text-[1.55rem]">Bidang Pelayanan</h2>
      <p class="mt-2 max-w-2xl text-[14px] leading-6 text-slate-600">
        Halaman awal hanya menampilkan thumbnail, nama bidang, dan tahun pelayanan.
      </p>
    </div>

    @if($items->isEmpty())
      <div class="rounded-[26px] border border-dashed border-[#b9c9e9] bg-white px-5 py-8 text-center shadow-[0_14px_30px_rgba(15,43,107,0.06)] sm:px-8 sm:py-12">
        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-[#eff4ff] text-[#0F2B6B]">
          <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h10M7 12h10M7 17h6M5 4h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z"></path>
          </svg>
        </div>
        <h3 class="mt-4 text-[1.15rem] font-black text-[#0F2B6B]">Bidang pelayanan belum ditambahkan</h3>
        <a href="{{ route('kontak') }}" class="mt-5 inline-flex min-h-11 items-center rounded-2xl bg-[#0F2B6B] px-4 text-sm font-black text-white transition hover:bg-[#16367f]">
          Hubungi Admin
        </a>
      </div>
    @else
      <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:gap-4 xl:grid-cols-3">
        @foreach($items as $item)
          @php
            $photos = collect($item->member_photo_paths ?? [])
              ->filter(fn ($path) => is_string($path) && trim($path) !== '')
              ->values();
            $primaryPhoto = $photos->first();
            $initial = \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($item->name, 0, 1));
            $serviceYear = $item->service_year ?? optional($item->created_at)->format('Y') ?? now()->year;
          @endphp

          <article class="group overflow-hidden rounded-[24px] border border-[#d9e3f4] bg-white shadow-[0_14px_30px_rgba(15,43,107,0.08)] transition duration-300 hover:-translate-y-0.5 hover:shadow-[0_18px_36px_rgba(15,43,107,0.12)]">
            <a href="{{ route('gereja.komisi.show', ['slug' => $item->slug]) }}" class="block">
              <div class="relative aspect-[16/10] overflow-hidden bg-[linear-gradient(135deg,#dbe7ff_0%,#f4f7ff_100%)]">
                @if($primaryPhoto)
                  <img
                    src="{{ asset('storage/'.$primaryPhoto) }}"
                    alt="{{ $item->name }}"
                    class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
                    loading="lazy"
                    decoding="async"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                  >
                  <div class="absolute inset-0 hidden items-center justify-center bg-[linear-gradient(135deg,#dbe7ff_0%,#f4f7ff_100%)] text-4xl font-black text-[#0F2B6B]">
                    {{ $initial }}
                  </div>
                @else
                  <div class="flex h-full w-full items-center justify-center text-4xl font-black text-[#0F2B6B]">
                    {{ $initial }}
                  </div>
                @endif

                <div class="absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-[#071a4a]/55 to-transparent"></div>
                <div class="absolute right-3 top-3 inline-flex items-center rounded-full bg-white/92 px-3 py-1.5 text-[11px] font-black text-[#0F2B6B] shadow-sm">
                  {{ $serviceYear }}
                </div>
              </div>

              <div class="p-4 sm:p-[18px]">
                <h3 class="text-[1.08rem] font-black leading-6 tracking-tight text-[#0F2B6B]">
                  {{ $item->name }}
                </h3>
                <div class="mt-2 inline-flex items-center rounded-full bg-[#eef4ff] px-3 py-1.5 text-[12px] font-black text-[#1d3f8f]">
                  Tahun {{ $serviceYear }}
                </div>

                <div class="mt-4 flex items-center justify-between gap-3 border-t border-[#e7eef9] pt-4">
                  <div class="text-[12px] font-bold text-slate-500">
                    Buka detail
                  </div>
                  <span class="inline-flex min-h-10 items-center rounded-xl bg-[#0F2B6B] px-3.5 text-[13px] font-black text-white transition group-hover:bg-[#16367f]">
                    Buka
                  </span>
                </div>
              </div>
            </a>
          </article>
        @endforeach
      </div>
    @endif
  </div>
</section>
@endsection
