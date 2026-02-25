@extends('layout.app')
@section('title','Komisi - GKKA Samarinda')
@section('meta_description', 'Komisi pelayanan GKKA Indonesia Jemaat Samarinda: sekolah minggu, remaja, pemuda, wanita, dan pria.')
@section('meta_image', asset('img/komisiwanita.jpeg'))
@section('content')
@php
  $pageBackground = asset('img/backgroundKomisi.jpeg');
  $heroImage = asset('img/fotogrj.jpeg');
  $komisiImageSekolahMinggu = asset('img/sekolah minggu.jpeg');
  $komisiImageRemaja = asset('img/remajaa.jpeg');
  $komisiImagePemuda = asset('img/pemuda.jpeg');
  $komisiImageWanita = asset('img/komisiwanita.jpeg');
  $komisiImagePria = asset('img/komisi bapapk.jpeg');
  $komisiCards = [
    [
      'label' => 'Komisi',
      'title' => 'Komisi Sekolah Minggu Narwastu',
      'date' => 'Pelayanan anak & keluarga',
      'excerpt' => 'Mendampingi pertumbuhan iman anak melalui pengajaran firman, ibadah, dan kegiatan pembinaan.',
      'image' => $komisiImageSekolahMinggu,
    ],
    [
      'label' => 'Komisi',
      'title' => 'Komisi Remaja Betania',
      'date' => 'Pembinaan remaja',
      'excerpt' => 'Ruang bertumbuh bersama, pemuridan, dan pelayanan bagi remaja di GKKA Samarinda.',
      'image' => $komisiImageRemaja,
    ],
    [
      'label' => 'Komisi',
      'title' => 'Komisi Pemuda Eirene',
      'date' => 'Pembinaan pemuda',
      'excerpt' => 'Persekutuan, pemuridan, dan pelayanan bersama untuk pemuda di GKKA Samarinda.',
      'image' => $komisiImagePemuda,
    ],
    [
      'label' => 'Komisi',
      'title' => 'Komisi Wanita Rut',
      'date' => 'Persekutuan wanita',
      'excerpt' => 'Persekutuan, doa, dan pelayanan yang menguatkan keluarga serta jemaat melalui karya kasih.',
      'image' => $komisiImageWanita,
    ],
    [
      'label' => 'Komisi',
      'title' => 'Komisi Pria Hizkia',
      'date' => 'Pembinaan pria',
      'excerpt' => 'Membangun karakter, keteladanan, dan kepekaan pelayanan melalui firman dan persekutuan.',
      'image' => $komisiImagePria,
    ],
  ];
@endphp

<div class="relative overflow-x-hidden">
  <div class="absolute inset-0 -z-10">
	    <div
	      class="absolute inset-0 bg-center bg-cover blur-[2px] scale-105 opacity-80 brightness-[0.40] saturate-[0.55] contrast-[0.95]"
	      style="background-image: url('{{ $pageBackground }}');"
	    ></div>
	    <div class="absolute inset-0 bg-blue-950/55"></div>
	    <div class="absolute inset-0 bg-gradient-to-b from-blue-950/35 via-transparent to-blue-950/45"></div>
    <div class="absolute inset-0 pointer-events-none opacity-25">
      <div class="absolute -top-32 -left-28 size-[520px] bg-blue-500 rounded-full blur-3xl"></div>
      <div class="absolute -bottom-40 -right-24 size-[560px] bg-blue-700 rounded-full blur-3xl"></div>
    </div>
  </div>

  <section class="relative text-white overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-b from-blue-950/55 via-blue-950/35 to-transparent"></div>

    <div class="gkka-container relative">
      <div class="py-14 sm:py-16 lg:py-20 text-center">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/10 text-blue-100 font-black tracking-widest uppercase text-xs">
          GKKA Samarinda
        </div>
        <h1 class="mt-6 text-4xl md:text-5xl lg:text-6xl font-black tracking-tight leading-tight">
          Komisi<br class="hidden md:block">
          <span class="text-blue-200">& Pelayanan</span>
        </h1>
        <p class="mt-5 text-base md:text-lg text-blue-100 font-semibold leading-relaxed max-w-2xl mx-auto">
          Daftar komisi di GKKA Samarinda. Silakan lihat gambaran singkat pelayanannya.
        </p>
      </div>
    </div>
  </section>

  <section class="gkka-section-tight">
    <div class="gkka-container">
      <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-10">
        <div>
          <h2 class="text-2xl md:text-3xl font-black tracking-tight text-white drop-shadow-sm">Komisi GKKA Samarinda</h2>
        </div>
        <div class="flex gap-3">
          <a href="{{ route('kontak') }}"
             class="h-11 px-5 rounded-2xl bg-blue-900/90 hover:bg-blue-800 text-white font-black shadow-sm transition inline-flex items-center justify-center backdrop-blur">
            Hubungi Admin
          </a>
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($komisiCards as $card)
          <x-komisi-card
            variant="detailed"
            :href="route('kontak')"
            :title="$card['title']"
            :image="$card['image']"
            :label="$card['label']"
            :meta="$card['date']"
            :excerpt="$card['excerpt']"
          />
        @endforeach
      </div>

      <div class="mt-12 rounded-3xl border border-white/10 bg-slate-950/35 backdrop-blur p-8 md:p-10 text-center shadow-sm">
        <div class="text-white font-black text-xl drop-shadow-sm">Ingin bergabung melayani di salah satu komisi?</div>
        <p class="mt-2 text-blue-100/90 font-semibold drop-shadow-sm">Klik tombol di bawah untuk menghubungi admin/pengurus.</p>
        <div class="mt-6">
          <a href="{{ route('kontak') }}"
             class="h-12 px-8 rounded-2xl bg-yellow-500 hover:bg-yellow-400 text-blue-900 font-black shadow-md transition inline-flex items-center justify-center">
            Hubungi Kami
          </a>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
