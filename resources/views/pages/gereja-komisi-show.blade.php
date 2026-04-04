@extends('layout.app')

@section('title', $item->name.' | Bidang GKKA-I Samarinda')
@section('body_class', 'bg-[#eef2fb]')
@section('meta_description', \Illuminate\Support\Str::limit(trim((string) $item->description), 155))
@section('meta_image', isset($item->member_photo_paths[0]) ? asset('storage/'.$item->member_photo_paths[0]) : asset('img/fotogrj.jpeg'))

@section('content')
@php
  use Illuminate\Support\Str;

  $photos = collect($item->member_photo_paths ?? [])
    ->filter(fn ($path) => is_string($path) && trim($path) !== '')
    ->values();

  $description = trim((string) $item->description);
  $description = $description !== '' ? $description : 'Deskripsi bidang belum tersedia.';
  $initial = Str::upper(Str::substr($item->name, 0, 1));
  $nameLower = Str::lower($item->name);
  $fallbackDetailImage = asset('img/fotogrj.jpeg');

  $keywordCovers = [
    'anak' => asset('img/sekolah%20minggu.jpeg'),
    'sekolah minggu' => asset('img/sekolah%20minggu.jpeg'),
    'pemuda' => asset('img/pemuda.jpeg'),
    'remaja' => asset('img/remajaa.jpeg'),
    'wanita' => asset('img/komisiwanita.jpeg'),
    'pria' => asset('img/komisi%20bapapk.jpeg'),
    'musik' => asset('img/media.jpeg'),
    'media' => asset('img/media.jpeg'),
    'multimedia' => asset('img/media.jpeg'),
  ];

  foreach ($keywordCovers as $keyword => $cover) {
    if (Str::contains($nameLower, $keyword)) {
      $fallbackDetailImage = $cover;
      break;
    }
  }

  $mainPhoto = $photos->first()
    ? asset('storage/'.$photos->first())
    : $fallbackDetailImage;
  $heroBackground = asset('img/majelis potong kue.jpeg');
@endphp

<section class="relative overflow-hidden text-white">
  <div class="absolute inset-0">
    <img
      src="{{ $heroBackground }}"
      alt="{{ $item->name }}"
      class="h-full w-full object-cover object-center"
      loading="eager"
      decoding="async"
      onerror="this.onerror=null;this.src='{{ asset('img/majelis potong kue.jpeg') }}';"
    >
    <div class="absolute inset-0 bg-blue-950/65 mix-blend-multiply"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-blue-950/80 via-blue-950/35 to-transparent"></div>
  </div>

  <div class="gkka-container relative pt-28 pb-14 sm:pt-32 sm:pb-16">
    <div class="max-w-2xl text-center sm:text-left mx-auto sm:mx-0">
      <div class="flex flex-wrap items-center justify-center sm:justify-start gap-3">
        <a href="{{ route('gereja.komisi') }}" class="inline-flex min-h-11 items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 text-[13px] font-black text-white transition hover:bg-white/16">
          <span aria-hidden="true">←</span>
          Kembali
        </a>
      </div>

      <h1 class="gkka-hero-title mt-6 text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black tracking-tight leading-[1.05]">
        Bidang Pelayanan
      </h1>

      <div class="mt-3 text-lg sm:text-xl md:text-2xl font-black uppercase tracking-[0.18em] text-blue-300 drop-shadow-[0_4px_14px_rgba(59,130,246,0.38)]">
        Detail Bidang Pelayanan
      </div>
    </div>
  </div>
</section>

<section class="bg-[linear-gradient(180deg,#eef3ff_0%,#ffffff_100%)] pb-12 pt-8 sm:pb-16 sm:pt-10">
  <div class="mx-auto w-full max-w-6xl px-4 sm:px-6 lg:max-w-[1180px] xl:max-w-[1240px]">
    <div class="grid gap-6 lg:grid-cols-2 lg:items-start lg:gap-8 xl:gap-10">
      <div class="overflow-hidden rounded-[30px] border border-[#d7e4fb] bg-white p-2.5 shadow-[0_24px_60px_rgba(15,43,107,0.12)] lg:max-w-[620px] lg:-ml-6">
        <div class="relative overflow-hidden rounded-[26px] bg-[#dce7fb]">
          <img
            src="{{ $mainPhoto }}"
            alt="{{ $item->name }}"
            class="aspect-[4/5] w-full object-cover sm:aspect-[16/13] lg:aspect-[4/5]"
            loading="lazy"
            decoding="async"
            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
          >
          <div class="hidden aspect-[4/5] w-full items-center justify-center bg-[linear-gradient(135deg,#dbe7ff_0%,#edf3ff_100%)] text-6xl font-black text-[#0F2B6B] sm:aspect-[16/13] lg:aspect-[4/5]">
            {{ $initial }}
          </div>
        </div>
      </div>

      <div class="space-y-5 sm:space-y-6">
        <div class="grid gap-4 sm:grid-cols-2">
          <div class="rounded-[24px] border border-[#af7a4f] bg-[linear-gradient(180deg,#ffffff_0%,#fff9f3_100%)] px-5 py-4 ring-1 ring-[#f1d4b5]/80 shadow-[0_10px_24px_rgba(120,75,35,0.14),inset_0_1px_0_rgba(255,255,255,0.92)]">
            <div class="text-[11px] font-black uppercase tracking-[0.22em] text-[#5a73b8]">Nama</div>
            <div class="mt-2 text-[1.25rem] font-black leading-tight text-[#0f2b6b]">
              {{ $item->name }}
            </div>
          </div>

          <div class="rounded-[24px] border border-[#af7a4f] bg-[linear-gradient(180deg,#ffffff_0%,#fff9f3_100%)] px-5 py-4 ring-1 ring-[#f1d4b5]/80 shadow-[0_10px_24px_rgba(120,75,35,0.14),inset_0_1px_0_rgba(255,255,255,0.92)]">
            <div class="text-[11px] font-black uppercase tracking-[0.22em] text-[#5a73b8]">Bidang</div>
            <div class="mt-2 text-[1.25rem] font-black leading-tight text-[#0f2b6b]">
              Bidang Pelayanan
            </div>
          </div>

          <div class="rounded-[24px] border border-[#af7a4f] bg-[linear-gradient(180deg,#ffffff_0%,#fff9f3_100%)] px-5 py-4 ring-1 ring-[#f1d4b5]/80 shadow-[0_10px_24px_rgba(120,75,35,0.14),inset_0_1px_0_rgba(255,255,255,0.92)] sm:col-span-2">
            <div class="text-[11px] font-black uppercase tracking-[0.22em] text-[#5a73b8]">Tahun Pelayanan</div>
            <div class="mt-2 text-[1.25rem] font-black leading-tight text-[#0f2b6b]">
              {{ $item->service_year ?? '-' }}
            </div>
          </div>
        </div>

        <div class="overflow-hidden rounded-[28px] border border-[#af7a4f] bg-[linear-gradient(145deg,#f5f8ff_0%,#eef4ff_52%,#fffdf9_100%)] ring-1 ring-[#f1d4b5]/80 shadow-[0_14px_32px_rgba(120,75,35,0.16)]">
          <div class="border-b border-[#d2ab86] px-5 py-4 sm:px-6">
            <div class="text-[11px] font-black uppercase tracking-[0.22em] text-[#5a73b8]">
              Deskripsi Lengkap
            </div>
            <div class="mt-2 text-[1.35rem] font-black tracking-tight text-[#102b69]">
              Tentang {{ $item->name }}
            </div>
            <p class="mt-2 text-[13px] font-semibold leading-6 text-[#41568a] sm:text-[14px]">
              Profil singkat, tahun pelayanan, dan deskripsi lengkap bidang {{ $item->name }}.
            </p>
          </div>

          <div class="p-5 sm:p-6">
            <div class="rounded-[22px] border border-[#d4ac84] bg-white/90 px-4 py-4 ring-1 ring-[#faead7]/85 shadow-[inset_0_1px_0_rgba(255,255,255,0.92)] sm:px-5 sm:py-5">
              <div class="text-[14px] leading-7 text-[#15233f] sm:text-[15px] sm:leading-8">
                {!! nl2br(e($description)) !!}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
