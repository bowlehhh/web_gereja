@extends('layout.app')
@section('title', ($item->name ?: 'Majelis').' | GKKA Samarinda')
@php
  $metaDescription = trim((string) ($item->about ?: $item->excerpt));
  if ($metaDescription === '') {
    $metaDescription = 'Informasi majelis GKKA Samarinda (GKKAI Samarinda).';
  }
  $metaDescription = \Illuminate\Support\Str::limit(strip_tags($metaDescription), 160);
  $metaImage = $item->photo_path ? asset('storage/'.$item->photo_path) : asset('img/fotogrj.jpeg');
@endphp
@section('meta_description', $metaDescription)
@section('meta_image', $metaImage)
@section('breadcrumb_title', $item->name ?: 'Majelis')
@section('content')
@php
  use Illuminate\Support\Facades\Storage;

  $hasPhoto = $item->photo_path && Storage::disk('public')->exists($item->photo_path);
  $img = $hasPhoto ? Storage::url($item->photo_path) : '/assets/logo.png'; // /storage/... or placeholder
	  $role = $item->role ?: 'Majelis';
	  $period = $item->period ?: null;
	  $profileText = $item->about ?: 'Belum ada deskripsi untuk majelis ini.';
	  $quoteText = $item->excerpt ?: null;
	  $serviceText = null;
	  if (!empty($periodConfig?->service) && is_string($periodConfig->service)) {
	    $serviceText = trim($periodConfig->service);
	  }
	  $galleryUrls = collect();
  if (!empty($periodConfig?->gallery_paths) && is_array($periodConfig->gallery_paths)) {
    $galleryUrls = collect($periodConfig->gallery_paths)
      ->filter(fn ($p) => is_string($p) && $p !== '' && Storage::disk('public')->exists($p))
      ->map(fn ($p) => Storage::url($p))
      ->values();
  }
  if ($galleryUrls->isEmpty() && isset($members) && $members?->isNotEmpty()) {
    $galleryUrls = $members
      ->filter(fn ($m) => filled($m->photo_path) && Storage::disk('public')->exists($m->photo_path))
      ->map(fn ($m) => Storage::url($m->photo_path))
      ->values();
  }
  $galleryUrls = $galleryUrls->take(20);
@endphp

@push('styles')
  <style>
    .gkka-page {
      min-height: 100vh;
      padding-top: 112px; /* offset navbar fixed + extra spacing */
      padding-bottom: 0;
    }

    .gkka-hero {
      position: relative;
      overflow: hidden;
      border-radius: 44px;
      min-height: calc(100vh - 84px - 56px); /* viewport minus navbar offset + section padding */
      background:
        radial-gradient(1200px 420px at 0% 0%, rgba(59,130,246,0.55) 0%, rgba(0,27,68,0) 60%),
        radial-gradient(900px 520px at 100% 10%, rgba(29,78,216,0.35) 0%, rgba(0,27,68,0) 55%),
        radial-gradient(700px 420px at 55% 100%, rgba(14,165,233,0.22) 0%, rgba(0,27,68,0) 55%),
        linear-gradient(135deg, #083b8a 0%, #022a5f 45%, #001B44 100%);
      border: 1px solid rgba(234, 179, 8, 0.28);
      box-shadow: 0 30px 70px rgba(0, 0, 0, 0.45);
    }

    .gkka-hero::before {
      content: "";
      position: absolute;
      inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='260' height='260' viewBox='0 0 260 260'%3E%3Cg fill='none' stroke='%23eab308' stroke-opacity='0.13' stroke-width='2'%3E%3Cpath d='M22 54h20m-10-10v20'/%3E%3Cpath d='M86 34h20m-10-10v20'/%3E%3Cpath d='M206 70h20m-10-10v20'/%3E%3Cpath d='M170 190h20m-10-10v20'/%3E%3Cpath d='M46 196h20m-10-10v20'/%3E%3C/g%3E%3C/svg%3E");
      background-repeat: repeat;
      background-size: 260px 260px;
      opacity: 0.9;
      pointer-events: none;
    }

    .gkka-corner {
      position: absolute;
      width: 120px;
      height: 120px;
      border-color: rgba(234, 179, 8, 0.28);
      pointer-events: none;
    }

    .gkka-corner.tl { top: 18px; left: 18px; border-left-width: 1px; border-top-width: 1px; border-style: solid; }
    .gkka-corner.br { bottom: 18px; right: 18px; border-right-width: 1px; border-bottom-width: 1px; border-style: solid; }

    .gkka-blob {
      border-radius: 44% 56% 42% 58% / 46% 34% 66% 54%;
    }

    .gkka-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 2.5rem;
      align-items: start;
    }

    @media (min-width: 1024px) {
      .gkka-grid {
        grid-template-columns: 1.25fr 0.75fr;
        gap: 3rem;
      }
    }

    .gkka-photo-wrap {
      display: flex;
      justify-content: center;
      padding-top: 20px; /* mobile: beri napas tanpa mendorong konten terlalu jauh */
    }

    @media (min-width: 640px) {
      .gkka-photo-wrap {
        padding-top: 28px;
      }
    }

    @media (min-width: 1024px) {
      .gkka-photo-wrap {
        justify-content: center;
        padding-top: 12px;
      }
    }

    .gkka-photo-frame {
      width: min(100%, 860px);
      max-width: 100%;
    }

    @media (min-width: 1024px) {
      .gkka-photo-frame {
        width: 100%;
        max-width: 920px;
        margin-left: 14px; /* sedikit ke tengah seperti referensi */
      }
    }

    .gkka-gallery-grid {
      display: grid;
      gap: 14px;
      grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
      align-items: stretch;
    }

    @media (min-width: 640px) {
      .gkka-gallery-grid {
        gap: 16px;
        grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
      }
    }

    @media (min-width: 1024px) {
      .gkka-gallery-grid {
        gap: 18px;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      }
    }

	    .gkka-gallery-tile {
	      padding: 0;
	      border-radius: 1.5rem;
	      border: 1px solid rgba(255,255,255,0.22);
	      box-shadow: 0 22px 48px rgba(0,0,0,0.30);
	      overflow: hidden;
	    }

	    .gkka-gallery-inner {
	      overflow: hidden;
	      border-radius: 0;
	      background: transparent;
	      aspect-ratio: 1 / 1;
	    }

    .gkka-btn {
      position: relative;
      overflow: hidden;
      transition: transform 180ms ease, background-color 180ms ease, border-color 180ms ease, box-shadow 180ms ease;
      will-change: transform;
    }

    .gkka-btn::after {
      content: "";
      position: absolute;
      inset: -2px;
      background: radial-gradient(180px 60px at 20% 20%, rgba(255,255,255,0.28), rgba(255,255,255,0) 60%);
      opacity: 0;
      transition: opacity 180ms ease;
      pointer-events: none;
    }

    .gkka-btn:hover {
      transform: translateY(-1px);
      box-shadow: 0 18px 32px rgba(0,0,0,0.22);
    }

    .gkka-btn:hover::after { opacity: 1; }
    .gkka-btn:active { transform: translateY(0); box-shadow: 0 10px 18px rgba(0,0,0,0.18); }

    .gkka-btn-primary {
      border-color: rgba(250, 204, 21, 0.65) !important;
      background: linear-gradient(135deg, rgba(250, 204, 21, 0.18), rgba(250, 204, 21, 0.06)) !important;
      box-shadow: 0 14px 28px rgba(250, 204, 21, 0.12);
    }

    .gkka-btn-primary::after {
      background: radial-gradient(200px 60px at 18% 18%, rgba(250, 204, 21, 0.38), rgba(255,255,255,0) 62%);
    }

    .gkka-frame {
      border: 1px solid rgba(255,255,255,0.60);
      border-radius: 2.5rem;
      background: #fff;
      box-shadow:
        0 0 0 1px rgba(255,255,255,0.22) inset,
        0 0 0 18px rgba(255,255,255,0.12),
        0 26px 56px rgba(0,0,0,0.35);
      overflow: hidden;
    }
  </style>
@endpush

<section class="gkka-page bg-blue-900 text-white px-4 sm:px-6">
  <div class="w-full max-w-[1400px] mx-auto">
    <div class="gkka-hero w-full px-5 sm:px-8 md:px-14 py-8 sm:py-10 md:py-16">
      <div class="gkka-corner tl"></div>
      <div class="gkka-corner br"></div>

      <div class="relative z-10">
        <div class="gkka-grid">
        <div class="gkka-photo-wrap order-1">
          <div class="relative">
            <div class="absolute -inset-8 bg-yellow-500/10 blur-3xl rounded-full"></div>

	            <div class="gkka-photo-frame">
	              <div class="gkka-gallery-grid">
	                @forelse($galleryUrls as $i => $src)
	                  <div class="gkka-gallery-tile">
	                    <div class="gkka-gallery-inner">
	                      <img
	                        src="{{ $src }}"
	                        alt="Foto majelis {{ $item->period ?? '' }}"
	                        class="w-full h-full object-cover transition-transform duration-700 hover:scale-110"
	                        loading="{{ $i < 6 ? 'eager' : 'lazy' }}"
	                        onerror="this.onerror=null;this.src='{{ $img }}';"
	                      >
	                    </div>
	                  </div>
	                @empty
	                  <div class="gkka-gallery-tile">
	                    <div class="gkka-gallery-inner">
	                      <img
	                        src="{{ $img }}"
	                        alt="Foto majelis {{ $item->period ?? '' }}"
	                        class="w-full h-full object-contain p-10"
	                      >
	                    </div>
	                  </div>
	                @endforelse
	              </div>
	              @if($galleryUrls->count())
	                <div class="mt-5 text-center text-white/70 text-xs md:text-sm font-semibold">
	                  Menampilkan {{ $galleryUrls->count() }} foto
	                  @if(isset($members) && $members?->count())
	                    • Total {{ $members->count() }} orang
	                  @endif
	                </div>
	              @endif
	            </div>
	          </div>
	        </div>

        <div class="order-2">
          <div class="text-white/80 uppercase tracking-[0.35em] text-xl md:text-2xl font-semibold">
            {{ strtoupper($role) }}
          </div>

          <h1 class="mt-3 text-4xl md:text-6xl font-serif font-semibold text-white leading-tight">
            {{ $item->name ?: 'Majelis' }}
          </h1>

          <div class="mt-8 space-y-4">
            <div class="flex items-center gap-3">
              <span class="size-2 rounded-full bg-sky-300/80"></span>
              <h2 class="text-xl md:text-2xl font-semibold text-white/95">Profile</h2>
            </div>
            <div class="text-white/75 leading-relaxed text-justify whitespace-pre-line text-sm md:text-base max-w-2xl">
              {{ $profileText }}
            </div>

            @if($quoteText)
              <p class="italic text-white/80 whitespace-pre-line text-sm md:text-base">
                {{ $quoteText }}
              </p>
            @endif
          </div>

	          <div class="mt-10 space-y-4">
	            <div class="flex items-center gap-3">
	              <h2 class="text-xl md:text-2xl font-semibold text-white/95">Bidang Pelayanan</h2>
	            </div>
	            <div class="text-white/85 text-sm md:text-base">
	              <div class="flex items-start gap-3">
	                <span class="text-yellow-300 mt-0.5">✚</span>
	                <div>
	                  @if(!empty($serviceText))
	                    <div class="whitespace-pre-line">{{ $serviceText }}</div>
	                  @else
	                    {{ $role }}@if($period), {{ $period }}@endif
	                  @endif
	                </div>
	              </div>
	            </div>
	          </div>

          <div class="mt-10">
            <div class="h-px w-full bg-white/25"></div>
          </div>

          <div class="mt-8 flex flex-wrap items-center gap-4 justify-between">
            <div class="text-white/75 text-sm">
              <div class="font-semibold text-white/90">Dukungan Doa &amp; Kontak</div>
              <div class="mt-1">Silakan hubungi gereja untuk info lebih lanjut.</div>
            </div>
            <div class="flex items-center gap-3">
              <a href="{{ route('gereja.majelis') }}" class="gkka-btn inline-flex items-center gap-2 px-6 py-3 rounded-full border border-white/30 bg-white/10 hover:bg-white/15 text-white font-extrabold transition-colors">
                <span class="text-lg">←</span> Kembali
              </a>
              <a href="{{ route('kontak') }}" class="gkka-btn gkka-btn-primary px-7 py-3 rounded-full border text-yellow-50 hover:bg-yellow-400/20 transition">
                Hubungi Kami
              </a>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>
</section>
@endsection
