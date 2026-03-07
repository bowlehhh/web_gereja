@extends('layout.app')

@section('title', 'Informasi Lengkap Cabang: '.$item->name.' | Cabang GKKA Indonesia')
@php
  $metaDescription = trim((string) (($item->city ? $item->city.' - ' : '').$item->about));
  if ($metaDescription === '') {
    $metaDescription = 'Detail cabang GKKA Indonesia.';
  }
  $metaDescription = \Illuminate\Support\Str::limit(strip_tags($metaDescription), 160);
  $metaImage = $item->image_path ? asset('storage/'.$item->image_path) : asset('img/fotogrj.jpeg');
  $heroBg = asset('img/fotogrj.jpeg');
  $branchImage = $item->image_path ? asset('storage/'.$item->image_path) : asset('assets/logo.png');
  $mapColumnsReady = $mapColumnsReady ?? true;
  $mapLat = is_numeric($item->map_latitude ?? null) ? (float) $item->map_latitude : null;
  $mapLng = is_numeric($item->map_longitude ?? null) ? (float) $item->map_longitude : null;
  $hasMapCoordinates = $mapColumnsReady && $mapLat !== null && $mapLng !== null;

  $mapCoordinateText = null;
  $mapEmbedUrl = null;
  $mapDirectionUrl = null;
  if ($hasMapCoordinates) {
    $latText = rtrim(rtrim(number_format($mapLat, 7, '.', ''), '0'), '.');
    $lngText = rtrim(rtrim(number_format($mapLng, 7, '.', ''), '0'), '.');
    $mapCoordinateText = $latText.', '.$lngText;
    $mapQuery = $latText.','.$lngText;
    $mapEmbedUrl = 'https://www.google.com/maps?q='.rawurlencode($mapQuery).'&z=15&output=embed';
    $mapDirectionUrl = 'https://www.google.com/maps/dir/?api=1&destination='.rawurlencode($mapQuery);
  }
@endphp
@section('meta_description', $metaDescription)
@section('meta_image', $metaImage)
@section('meta_type', 'article')
@section('breadcrumb_title', $item->name)

@section('content')
<div class="relative px-4 sm:px-6 lg:px-8 pt-28 pb-28 md:pt-32 md:pb-36 cabang-hero-art" style="background-image: url('{{ $heroBg }}');">
    <div class="absolute inset-0 cabang-hero-dim"></div>
    <div class="absolute inset-0 cabang-hero-wash"></div>
    <div class="absolute inset-0 cabang-hero-glow"></div>
    <div class="absolute inset-x-0 bottom-0 h-10 sm:h-14 cabang-hero-fade"></div>

    <div class="relative z-10 w-full max-w-[1680px] mx-auto text-white cabang-hero-content">
        <span class="cabang-hero-kicker bg-gray-700/50 border border-white/20 px-3 py-1 rounded-full text-xs uppercase tracking-wider font-bold">Detail Cabang</span>
        <h1 class="cabang-hero-welcome-title mt-4">
            <span class="cabang-hero-welcome-line" aria-label="Selamat Datang di Cabang">
                <span class="cabang-hero-word cabang-hero-word-1 cabang-hero-welcome-accent">Selamat</span>
                <span class="cabang-hero-word cabang-hero-word-2">Datang</span>
                <span class="cabang-hero-word cabang-hero-word-3">di</span>
                <span class="cabang-hero-word cabang-hero-word-4">Cabang</span>
            </span>
        </h1>
        <p class="cabang-hero-welcome-sub" aria-label="Lokasi {{ $item->city ?: 'Belum diisi' }}. Temukan informasi kontak dan berita terbaru jemaat kami.">
            <span class="cabang-hero-sub-word cabang-hero-sub-word-1">Lokasi:</span>
            <span class="cabang-hero-sub-word cabang-hero-sub-word-2">{{ $item->city ?: 'Belum diisi' }}.</span>
            <span class="cabang-hero-sub-word cabang-hero-sub-word-3">Temukan</span>
            <span class="cabang-hero-sub-word cabang-hero-sub-word-4">informasi</span>
            <span class="cabang-hero-sub-word cabang-hero-sub-word-5">kontak</span>
            <span class="cabang-hero-sub-word cabang-hero-sub-word-6">dan</span>
            <span class="cabang-hero-sub-word cabang-hero-sub-word-7">berita</span>
            <span class="cabang-hero-sub-word cabang-hero-sub-word-8">terbaru</span>
            <span class="cabang-hero-sub-word cabang-hero-sub-word-9">jemaat</span>
            <span class="cabang-hero-sub-word cabang-hero-sub-word-10">kami.</span>
        </p>

        <div class="cabang-hero-actions flex gap-4 mt-8 flex-wrap justify-center">
            <a href="{{ route('cabang') }}" class="cabang-hero-btn cabang-hero-btn--light px-6 py-2 rounded-full font-semibold transition">
                ← Kembali ke Cabang
            </a>
            <a href="{{ route('kontak') }}" class="cabang-hero-btn cabang-hero-btn--dark px-6 py-2 rounded-full font-semibold transition">
                Hubungi Admin
            </a>
        </div>
    </div>
</div>

<div class="pt-16 pb-12 sm:pt-20 px-4 sm:px-6 lg:px-8 cabang-detail-body">
    <div class="w-full max-w-[1680px] mx-auto grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-10 cabang-detail-shell">

        <div class="lg:col-span-2 relative group">
            <div class="decorative-frame p-1 rounded-3xl shadow-2xl">
                <div class="decorative-frame-inner rounded-[1.4rem] overflow-hidden cabang-detail-card">
                    <div class="cabang-photo-pane">
                        <img src="{{ $branchImage }}" alt="Gereja {{ $item->name }}" class="cabang-photo-img">
                    </div>

                    <div class="p-6 sm:p-8 relative cabang-info-pane">
                        <div class="absolute bottom-0 right-0 opacity-35 w-36 h-28 cabang-batik-pattern"></div>

                        <h2 class="text-3xl font-bold text-gray-800">{{ $item->name }}</h2>
                        <p class="text-gray-600 mb-6">Lokasi: {{ $item->city ?: 'Belum diisi' }}</p>

                        <div class="space-y-2 text-gray-700">
                            <p><strong>Alamat:</strong> {{ $item->address ?: 'Belum diisi' }}</p>
                            <p><strong>Email:</strong> {{ $item->email ?: 'Belum diisi' }}</p>
                            <p><strong>Telp:</strong> {{ $item->phone ?: 'Belum diisi' }}</p>
                            <p><strong>Penanggung Jawab:</strong> {{ $item->pastor ?: 'Belum diisi' }}</p>
                        </div>

                        @php
                            $aboutText = trim((string) $item->about);
                        @endphp
                        <div class="mt-5 relative z-10">
                            <div class="cabang-about-panel rounded-2xl p-5 sm:p-6">
                                <div class="cabang-about-label text-[11px] sm:text-xs font-black tracking-widest uppercase">About Cabang</div>
                                <div class="cabang-about-content mt-3 text-sm sm:text-base leading-relaxed text-justify">
                                    @if($aboutText !== '')
                                        {!! nl2br(e($aboutText)) !!}
                                    @else
                                        Informasi about cabang belum diisi.
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 flex gap-3 flex-wrap">
                            <a href="{{ route('cabang') }}" class="border border-gray-300 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-50">← Kembali</a>
                            <a href="{{ route('home') }}#cabang-home" class="bg-blue-900 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-800 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                Lihat di Beranda
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="decorative-frame decorative-frame--small p-1 rounded-2xl shadow-lg">
                <div class="decorative-frame-inner p-6 rounded-[0.9rem]">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-bold text-gray-800">Cabang Lainnya</h3>
                        <a href="{{ route('cabang') }}" class="text-blue-600 text-xs font-semibold">Lihat Semua</a>
                    </div>

                    @if($latest->isEmpty())
                        <p class="text-gray-500 text-sm py-4">Saat ini belum ada cabang lainnya yang terdaftar.</p>
                    @else
                        <div class="space-y-3">
                            @foreach($latest as $cabang)
                                @php
                                    $thumb = $cabang->image_path ? asset('storage/'.$cabang->image_path) : asset('assets/logo.png');
                                @endphp
                                <a href="{{ route('cabang.show', $cabang) }}" class="flex items-center gap-3 rounded-lg p-2 hover:bg-slate-50 transition">
                                    <img src="{{ $thumb }}" alt="{{ $cabang->name }}" class="w-12 h-12 rounded-lg object-cover border border-slate-200">
                                    <div class="min-w-0">
                                        <div class="text-sm font-semibold text-slate-800 truncate">{{ $cabang->name }}</div>
                                        <div class="text-xs text-slate-500 truncate">{{ $cabang->city ?: 'Lokasi belum diisi' }}</div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <div class="decorative-frame decorative-frame--small p-1 rounded-2xl shadow-lg">
                <div class="decorative-frame-inner rounded-[0.9rem] overflow-hidden">
                    <div class="p-6 pb-4">
                        <div class="flex justify-between items-center gap-3">
                            <h3 class="font-bold text-gray-800">Map Cabang</h3>
                            @if($hasMapCoordinates)
                                <span class="inline-flex items-center rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 px-2 py-1 text-[10px] font-bold tracking-wide">SIAP</span>
                            @elseif(!$mapColumnsReady)
                                <span class="inline-flex items-center rounded-full bg-amber-50 text-amber-700 border border-amber-200 px-2 py-1 text-[10px] font-bold tracking-wide">MIGRASI DB</span>
                            @else
                                <span class="inline-flex items-center rounded-full bg-slate-100 text-slate-600 border border-slate-200 px-2 py-1 text-[10px] font-bold tracking-wide">BELUM DIISI</span>
                            @endif
                        </div>
                        <p class="mt-2 text-xs text-slate-500">
                            @if($hasMapCoordinates)
                                Koordinat: {{ $mapCoordinateText }}
                            @elseif(!$mapColumnsReady)
                                Kolom map belum ada di database. Jalankan migrasi terbaru.
                            @else
                                Koordinat cabang belum diisi dari dashboard admin.
                            @endif
                        </p>
                    </div>

                    @if($hasMapCoordinates)
                        <div class="relative cabang-map-box">
                            <iframe
                                src="{{ $mapEmbedUrl }}"
                                class="cabang-map-frame"
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                                title="Lokasi {{ $item->name }}"
                            ></iframe>
                            <a
                                href="{{ $mapDirectionUrl }}"
                                target="_blank"
                                rel="noopener"
                                class="absolute inset-0 z-10"
                                aria-label="Buka Google Maps untuk {{ $item->name }}"
                            ></a>
                            <div class="cabang-map-overlay pointer-events-none">
                                <span class="cabang-map-chip">Klik untuk buka Google Maps</span>
                            </div>
                        </div>
                        <div class="px-6 py-4 border-t border-slate-200/90">
                            <a
                                href="{{ $mapDirectionUrl }}"
                                target="_blank"
                                rel="noopener"
                                class="inline-flex items-center gap-2 text-sm font-semibold text-blue-700 hover:text-blue-900 transition"
                            >
                                Buka Petunjuk Arah di Google Maps
                                <span aria-hidden="true">↗</span>
                            </a>
                        </div>
                    @else
                        <div class="px-6 pb-6">
                            <div class="cabang-map-empty">
                                @if(!$mapColumnsReady)
                                    Jalankan <code class="font-semibold">php artisan migrate</code>, lalu isi latitude dan longitude dari dashboard.
                                @else
                                    Isi latitude dan longitude di dashboard agar map tampil di sini.
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('styles')
<style>
  .cabang-hero-art {
    min-height: clamp(380px, 54vh, 640px);
    display: flex;
    align-items: flex-end;
    position: relative;
    isolation: isolate;
    overflow: hidden;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center 34%;
  }

  .cabang-hero-dim {
    background: linear-gradient(180deg, rgba(2, 18, 46, 0.28) 0%, rgba(2, 18, 46, 0.52) 60%, rgba(2, 18, 46, 0.70) 100%);
  }

  .cabang-hero-wash {
    background:
      linear-gradient(90deg, rgba(2, 24, 63, 0.82) 0%, rgba(6, 63, 134, 0.26) 44%, rgba(2, 24, 63, 0.72) 100%),
      radial-gradient(760px 260px at 50% 95%, rgba(15, 23, 42, 0.45) 0%, rgba(15, 23, 42, 0) 68%);
  }

  .cabang-hero-art::before {
    content: "";
    position: absolute;
    inset: 0;
    pointer-events: none;
    opacity: 0.24;
    background-image:
      url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='520' height='220' viewBox='0 0 520 220'%3E%3Cg fill='none' stroke='%23cbd5e1' stroke-width='2' stroke-opacity='0.35'%3E%3Cpath d='M8 170h120M26 152h82M68 170V46m-20 104h40'/%3E%3Cpath d='M445 170h62M456 156h40M475 170V48m-14 108h28'/%3E%3Cpath d='M175 170h74M188 156h48M212 170V84m-10 86h20'/%3E%3C/g%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
  }

  .cabang-hero-glow {
    background:
      radial-gradient(620px 280px at 16% 16%, rgba(125, 211, 252, 0.32) 0%, rgba(125, 211, 252, 0) 64%),
      radial-gradient(700px 320px at 84% 14%, rgba(59, 130, 246, 0.30) 0%, rgba(59, 130, 246, 0) 66%),
      radial-gradient(480px 180px at 50% 6%, rgba(186, 230, 253, 0.20) 0%, rgba(186, 230, 253, 0) 72%);
  }

  .cabang-hero-fade {
    pointer-events: none;
    background: linear-gradient(180deg, rgba(214, 229, 246, 0) 0%, rgba(214, 229, 246, 0.72) 66%, #d6e5f6 100%);
  }

  .cabang-hero-content {
    padding-bottom: clamp(2.2rem, 5vw, 4.4rem);
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .cabang-hero-kicker {
    opacity: 0;
    animation: cabangWelcomeIn 720ms cubic-bezier(0.18, 0.84, 0.32, 1) 80ms both;
  }

  .cabang-hero-welcome-title {
    margin: 0;
    display: block;
    line-height: 1.04;
    font-family: "Montserrat", "Poppins", "Nunito Sans", "Segoe UI", sans-serif;
  }

  .cabang-hero-welcome-line {
    display: inline-flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 0.22em;
    font-size: clamp(2.1rem, 2.1vw + 1rem, 3.85rem);
    font-weight: 900;
    letter-spacing: 0.02em;
    text-transform: uppercase;
    background: linear-gradient(180deg, #ffffff 0%, #dbeafe 100%);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    text-shadow: 0 8px 24px rgba(30, 64, 175, 0.34);
  }

  .cabang-hero-word {
    display: inline-block;
    background: linear-gradient(180deg, #ffffff 0%, #bfdbfe 100%);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    text-shadow: 0 8px 24px rgba(30, 64, 175, 0.36);
    -webkit-text-stroke: 0.3px rgba(191, 219, 254, 0.55);
    opacity: 0;
    transform: translateY(22px) scale(0.97);
    filter: blur(2px);
    animation: cabangWordIn 980ms cubic-bezier(0.18, 0.84, 0.32, 1) both;
  }

  .cabang-hero-word-1 { animation-delay: 0.18s; }
  .cabang-hero-word-2 { animation-delay: 0.60s; }
  .cabang-hero-word-3 { animation-delay: 1.02s; }
  .cabang-hero-word-4 { animation-delay: 1.44s; }

  .cabang-hero-word.cabang-hero-welcome-accent {
    background: linear-gradient(180deg, #fde68a 0%, #facc15 100%);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    -webkit-text-stroke: 0.3px rgba(250, 204, 21, 0.28);
  }

  .cabang-hero-welcome-accent {
    background: linear-gradient(180deg, #fde68a 0%, #facc15 100%);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
  }

  .cabang-hero-welcome-sub {
    margin-top: 0.65rem;
    max-width: 78ch;
    color: rgba(226, 232, 240, 0.98);
    font-size: clamp(1.06rem, 0.38vw + 0.98rem, 1.3rem);
    font-weight: 700;
    line-height: 1.55;
    text-shadow: 0 3px 12px rgba(15, 23, 42, 0.44);
    display: inline-flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 0.34em;
  }

  .cabang-hero-sub-word {
    display: inline-block;
    opacity: 0;
    transform: translateY(14px);
    filter: blur(1.4px);
    animation: cabangWordIn 760ms cubic-bezier(0.18, 0.84, 0.32, 1) both;
  }

  .cabang-hero-sub-word-1 { animation-delay: 1.90s; }
  .cabang-hero-sub-word-2 { animation-delay: 2.10s; }
  .cabang-hero-sub-word-3 { animation-delay: 2.30s; }
  .cabang-hero-sub-word-4 { animation-delay: 2.50s; }
  .cabang-hero-sub-word-5 { animation-delay: 2.70s; }
  .cabang-hero-sub-word-6 { animation-delay: 2.90s; }
  .cabang-hero-sub-word-7 { animation-delay: 3.10s; }
  .cabang-hero-sub-word-8 { animation-delay: 3.30s; }
  .cabang-hero-sub-word-9 { animation-delay: 3.50s; }
  .cabang-hero-sub-word-10 { animation-delay: 3.70s; }

  @keyframes cabangWordIn {
    0% {
      opacity: 0;
      transform: translateY(22px) scale(0.97);
      filter: blur(2px);
    }
    100% {
      opacity: 1;
      transform: translateY(0) scale(1);
      filter: blur(0);
    }
  }

  .cabang-hero-actions {
    position: relative;
    z-index: 2;
    margin-bottom: clamp(0.35rem, 1.4vw, 1rem);
    margin-inline: auto;
    width: fit-content;
    padding: 0.3rem;
    border-radius: 999px;
    border: 1px solid rgba(191, 219, 254, 0.24);
    background: rgba(8, 25, 58, 0.30);
    backdrop-filter: blur(6px);
  }

  .cabang-hero-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px solid rgba(191, 219, 254, 0.50);
    box-shadow: 0 10px 20px rgba(2, 18, 46, 0.18);
    backdrop-filter: blur(3px);
    color: #eff6ff;
  }

  .cabang-hero-btn--light {
    background: rgba(224, 235, 252, 0.95);
    color: #102b57;
    border-color: rgba(219, 234, 254, 0.92);
  }

  .cabang-hero-btn--light:hover {
    background: rgba(240, 246, 255, 0.98);
  }

  .cabang-hero-btn--dark {
    background: linear-gradient(135deg, rgba(37, 99, 235, 0.82) 0%, rgba(29, 78, 216, 0.90) 100%);
    color: #ffffff;
    border-color: rgba(191, 219, 254, 0.66);
  }

  .cabang-hero-btn--dark:hover {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.90) 0%, rgba(37, 99, 235, 0.96) 100%);
  }

  @media (max-width: 767px) {
    .cabang-hero-art {
      min-height: clamp(320px, 46vh, 460px);
      background-position: center 28%;
    }

    .cabang-hero-content {
      padding-bottom: clamp(1.2rem, 4vw, 2rem);
    }

    .cabang-hero-welcome-line {
      gap: 0.15em;
      font-size: clamp(1.45rem, 1.65vw + 0.96rem, 2.45rem);
    }

    .cabang-hero-welcome-sub {
      font-size: 1.02rem;
      gap: 0.22em;
    }

    .cabang-hero-actions {
      margin-top: 1rem;
      gap: 0.7rem;
      width: 100%;
      padding: 0;
      border: 0;
      background: transparent;
      backdrop-filter: none;
    }

    .cabang-hero-btn {
      width: 100%;
    }
  }

  .cabang-detail-body {
    position: relative;
    overflow: hidden;
    margin-top: -1px;
    background: linear-gradient(180deg, #d6e5f6 0%, #e4edf9 20%, #e9f1fb 46%, #eef3f9 100%);
  }

  .cabang-detail-body::before {
    content: "";
    position: absolute;
    inset: 0;
    pointer-events: none;
    opacity: 0.48;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='280' height='280' viewBox='0 0 280 280'%3E%3Cg fill='none' stroke='%230a3a84' stroke-width='1.1' stroke-opacity='0.18'%3E%3Cpath d='M8 142c34-46 88-46 122 0s88 46 142 0'/%3E%3Cpath d='M8 188c34-46 88-46 122 0s88 46 142 0'/%3E%3Cpath d='M8 234c34-46 88-46 122 0s88 46 142 0'/%3E%3Cpath d='M58 8c0 50 0 102-48 146'/%3E%3Cpath d='M114 0c0 62 0 122-76 176'/%3E%3C/g%3E%3C/svg%3E");
    background-size: 280px 280px;
    background-position: 0 48px;
  }

  .cabang-detail-body::after {
    content: "";
    position: absolute;
    inset: 0;
    pointer-events: none;
    background:
      radial-gradient(900px 420px at -12% 32%, rgba(37, 99, 235, 0.30) 0%, rgba(37, 99, 235, 0) 62%),
      radial-gradient(780px 380px at 112% 30%, rgba(14, 116, 144, 0.25) 0%, rgba(14, 116, 144, 0) 64%),
      radial-gradient(920px 460px at 52% 112%, rgba(59, 130, 246, 0.20) 0%, rgba(59, 130, 246, 0) 68%),
      radial-gradient(380px 180px at 12% 16%, rgba(255, 255, 255, 0.24) 0%, rgba(255, 255, 255, 0) 70%),
      radial-gradient(440px 210px at 88% 88%, rgba(30, 64, 175, 0.14) 0%, rgba(30, 64, 175, 0) 72%);
  }

  .cabang-detail-body > .cabang-detail-shell {
    position: relative;
    z-index: 1;
  }

  .decorative-frame {
    position: relative;
    background: linear-gradient(145deg, #5f3d2a 0%, #a56b4b 26%, #efc79f 49%, #8b593f 72%, #40271b 100%);
    box-shadow: 0 18px 30px rgba(15, 23, 42, 0.22), inset 0 1px 4px rgba(255, 255, 255, 0.35);
  }

  .decorative-frame::before {
    content: "";
    position: absolute;
    inset: 0;
    border-radius: inherit;
    pointer-events: none;
    background:
      radial-gradient(circle at 15% 18%, rgba(255, 235, 199, 0.45), transparent 32%),
      radial-gradient(circle at 85% 86%, rgba(38, 20, 12, 0.35), transparent 34%);
    mix-blend-mode: soft-light;
  }

  .decorative-frame::after {
    content: "";
    position: absolute;
    inset: 5px;
    border-radius: calc(1.5rem - 4px);
    pointer-events: none;
    border: 1px solid rgba(255, 244, 224, 0.42);
  }

  .decorative-frame-inner {
    position: relative;
    background: #ffffff;
  }

  .decorative-frame-inner::before {
    content: "";
    position: absolute;
    right: -34px;
    bottom: -42px;
    width: 170px;
    height: 130px;
    background: radial-gradient(circle at 30% 20%, rgba(112, 65, 44, 0.26), rgba(65, 36, 24, 0.08) 60%, transparent 70%);
    border-top-left-radius: 84px;
    transform: rotate(-12deg);
    pointer-events: none;
  }

  .decorative-frame--small .decorative-frame-inner::before {
    display: none;
  }

  .cabang-batik-pattern {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='180' height='130' viewBox='0 0 180 130'%3E%3Cg fill='none' stroke='%2362472f' stroke-width='1.8' stroke-opacity='0.55'%3E%3Cpath d='M0 98c24-26 52-26 76 0s52 26 104 0'/%3E%3Cpath d='M0 70c24-26 52-26 76 0s52 26 104 0'/%3E%3Cpath d='M0 42c24-26 52-26 76 0s52 26 104 0'/%3E%3Cpath d='M18 130V0M50 130V0M82 130V0M114 130V0M146 130V0'/%3E%3C/g%3E%3C/svg%3E");
    background-size: cover;
  }

  .cabang-about-panel {
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(29, 78, 216, 0.22);
    background:
      radial-gradient(320px 180px at 12% -8%, rgba(96, 165, 250, 0.22) 0%, rgba(96, 165, 250, 0) 72%),
      radial-gradient(260px 140px at 95% 96%, rgba(56, 189, 248, 0.18) 0%, rgba(56, 189, 248, 0) 72%),
      linear-gradient(155deg, #f9fbff 0%, #f3f8ff 44%, #e8f1ff 100%);
    box-shadow:
      inset 0 1px 0 rgba(255, 255, 255, 0.85),
      0 10px 22px rgba(30, 64, 175, 0.14);
  }

  .cabang-about-panel::before {
    content: "";
    position: absolute;
    inset: 0;
    pointer-events: none;
    background:
      linear-gradient(90deg, rgba(30, 64, 175, 0.10) 0, rgba(30, 64, 175, 0.10) 3px, transparent 3px, transparent 100%),
      linear-gradient(180deg, rgba(191, 219, 254, 0.42) 0%, rgba(191, 219, 254, 0) 48%);
  }

  .cabang-about-label {
    color: #1e3a8a;
    letter-spacing: 0.17em;
  }

  .cabang-about-content {
    color: #334155;
  }

  .cabang-about-content strong {
    color: #0f172a;
    font-weight: 700;
  }

  .cabang-about-content a {
    color: #1d4ed8;
    font-weight: 700;
    text-decoration: underline;
    text-underline-offset: 2px;
  }

  @keyframes cabangWelcomeIn {
    0% {
      opacity: 0;
      transform: translateY(18px) scale(0.98);
      filter: blur(3px);
    }
    100% {
      opacity: 1;
      transform: translateY(0) scale(1);
      filter: blur(0);
    }
  }

  @media (prefers-reduced-motion: reduce) {
    .cabang-hero-kicker,
    .cabang-hero-word,
    .cabang-hero-sub-word {
      animation: none;
      opacity: 1;
      transform: none;
      filter: none;
    }

    .cabang-hero-welcome-title,
    .cabang-hero-welcome-sub { opacity: 1; }
  }

  .cabang-map-box {
    position: relative;
    overflow: hidden;
    border-top: 1px solid rgba(226, 232, 240, 0.9);
    border-bottom: 1px solid rgba(226, 232, 240, 0.9);
  }

  .cabang-map-frame {
    width: 100%;
    height: 250px;
    border: 0;
    display: block;
    filter: saturate(1.05) contrast(1.02);
  }

  .cabang-map-overlay {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: flex-end;
    justify-content: center;
    padding: 14px;
    background: linear-gradient(180deg, rgba(15, 23, 42, 0) 52%, rgba(15, 23, 42, 0.45) 100%);
  }

  .cabang-map-chip {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 999px;
    padding: 0.3rem 0.8rem;
    border: 1px solid rgba(191, 219, 254, 0.45);
    background: rgba(30, 64, 175, 0.72);
    color: #eff6ff;
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 0.01em;
  }

  .cabang-map-empty {
    border: 1px dashed rgba(148, 163, 184, 0.5);
    border-radius: 0.9rem;
    padding: 0.95rem 1rem;
    font-size: 0.85rem;
    line-height: 1.45;
    color: #64748b;
    background: linear-gradient(180deg, rgba(248, 250, 252, 0.92) 0%, rgba(241, 245, 249, 0.96) 100%);
  }

  .cabang-detail-card {
    display: grid;
    grid-template-columns: minmax(0, 1fr);
  }

  .cabang-photo-pane {
    position: relative;
    overflow: hidden;
    min-height: clamp(250px, 56vw, 430px);
    border-bottom: 1px solid rgba(148, 163, 184, 0.25);
  }

  .cabang-photo-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
  }

  @media (min-width: 768px) {
    .cabang-map-frame {
      height: 270px;
    }

    .cabang-detail-card {
      grid-template-columns: minmax(250px, 46%) minmax(0, 54%);
      align-items: stretch;
    }

    .cabang-photo-pane {
      min-height: clamp(370px, 48vw, 560px);
      border-bottom: 0;
      border-right: 1px solid rgba(148, 163, 184, 0.25);
    }

    .cabang-info-pane {
      min-width: 0;
    }
  }
</style>
@endpush
