@extends('layout.app')

@section('title','Galeri GKKA Samarinda | Foto Kegiatan GKKAI')
@section('meta_description', 'Galeri foto kegiatan dan momen jemaat GKKA Samarinda (GKKAI Samarinda).')
@section('meta_image', asset('img/fotogrj.jpeg'))
@section('body_class', 'gallery-page')

@section('content')
@php
  $arr = $items instanceof \Illuminate\Pagination\AbstractPaginator ? $items->getCollection()->values() : collect($items)->values();
  $hero = asset('img/fotogrj.jpeg');
  $galleryBackground = asset('img/media.jpeg');

  $albums = $arr
    ->groupBy(function ($item) {
      $title = trim((string) $item->title);
      return $title !== '' ? $title : 'Foto Gallery';
    })
    ->map(function ($photos, $title) {
      return (object) [
        'title' => $title,
        'key' => \Illuminate\Support\Str::slug($title) ?: 'foto-gallery',
        'count' => $photos->count(),
        'cover' => $photos->first(),
        'photos' => $photos->values(),
      ];
    })
    ->values();

  $galleryPhotos = $albums
    ->flatMap(function ($album) {
      return $album->photos->map(function ($photo) use ($album) {
        $title = trim((string) $photo->title);

        return [
          'category' => $album->key,
          'src' => !empty($photo->image_path) ? asset('storage/'.$photo->image_path) : asset('assets/logo.png'),
          'title' => $title !== '' ? $title : $album->title,
          'caption' => trim((string) ($photo->caption ?? '')),
        ];
      });
    })
    ->values();
@endphp

<section class="relative min-h-[430px] overflow-hidden bg-slate-950 text-white sm:min-h-[520px]">
  <div class="absolute inset-0">
    <img
      src="{{ $hero }}"
      alt="Galeri Foto GKKA Samarinda"
      class="h-full w-full object-cover"
      onerror="this.onerror=null;this.src='{{ asset('assets/logo.png') }}';"
    >
    <div class="absolute inset-0 bg-slate-950/62 backdrop-blur-[2px]"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-slate-950/75 via-blue-950/38 to-slate-950/80"></div>
  </div>

  <div class="absolute inset-0 pointer-events-none opacity-20">
    <div class="absolute left-8 top-24 h-32 w-32 rounded-full border border-white/30"></div>
    <div class="absolute bottom-16 right-10 h-44 w-44 rounded-full border border-yellow-300/30"></div>
    <div class="absolute left-1/2 top-1/2 h-px w-[80vw] -translate-x-1/2 bg-white/20"></div>
  </div>

  <div class="gkka-container relative flex min-h-[430px] items-center justify-center pt-28 pb-16 text-center sm:min-h-[520px] sm:pt-32">
    <div class="max-w-3xl">
      <div class="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-4 py-2 text-xs font-black uppercase tracking-[0.22em] text-blue-100 backdrop-blur">
        Gallery
        <span class="h-1.5 w-1.5 rounded-full bg-yellow-300"></span>
        GKKA Samarinda
      </div>
      <h1 class="mt-6 text-4xl font-black leading-[1.02] tracking-tight drop-shadow-lg sm:text-5xl lg:text-6xl">
        Galeri Foto
        <span class="block text-blue-200">GKKA Samarinda</span>
      </h1>
      <p class="mx-auto mt-5 max-w-2xl text-sm font-semibold leading-relaxed text-blue-50/90 sm:text-lg">
        Jelajahi momen pelayanan, ibadah, dan kebersamaan jemaat yang tersimpan dalam galeri GKKA Samarinda.
      </p>
    </div>
  </div>
</section>

<section class="border-b border-slate-200 bg-[#eef4ff] py-8">
  <div class="gkka-container">
    <div class="flex flex-wrap justify-center gap-3" id="galleryFilters">
      <button
        type="button"
        class="js-gallery-filter rounded-full bg-slate-950 px-6 py-2.5 text-sm font-black text-white shadow-md transition active:scale-95"
        data-filter="all"
        aria-pressed="true"
      >
        Semua
      </button>
      @foreach($albums->take(8) as $album)
        <button
          type="button"
          class="js-gallery-filter rounded-full border border-slate-300 bg-white px-6 py-2.5 text-sm font-black text-slate-600 shadow-sm transition hover:border-blue-700 hover:text-blue-800 active:scale-95"
          data-filter="{{ $album->key }}"
          aria-pressed="false"
        >
          {{ $album->title }}
        </button>
      @endforeach
    </div>
  </div>
</section>

<section class="relative overflow-hidden bg-slate-950 py-12 sm:py-16 lg:py-20">
  <div class="absolute inset-0 pointer-events-none">
    <img
      src="{{ $galleryBackground }}"
      alt=""
      class="h-full w-full scale-110 object-cover opacity-35 blur-xl saturate-125"
      aria-hidden="true"
    >
    <div class="absolute inset-0 bg-white/82 backdrop-blur-[1px]"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-[#f8f9ff]/94 via-[#eef4ff]/88 to-[#f8f9ff]/94"></div>
    <div class="absolute -top-24 left-8 h-72 w-72 rounded-full bg-blue-200/55 blur-3xl"></div>
    <div class="absolute bottom-0 right-0 h-80 w-80 rounded-full bg-yellow-100/80 blur-3xl"></div>
  </div>

  <div class="gkka-container relative">
    <div class="mb-8 flex flex-col gap-3 text-center sm:mb-10 sm:flex-row sm:items-end sm:justify-between sm:text-left">
      <div>
        <h2 class="text-2xl font-black tracking-tight text-slate-900 sm:text-3xl">Koleksi Foto</h2>
        <p class="mt-2 text-sm font-semibold text-slate-600 sm:text-base">
          {{ number_format($albums->count(), 0, ',', '.') }} album tersimpan untuk ditampilkan.
        </p>
      </div>
      @if(method_exists($items, 'total'))
        <div class="inline-flex justify-center rounded-full border border-slate-200 bg-white px-4 py-2 text-xs font-black uppercase tracking-widest text-slate-500 shadow-sm">
          {{ number_format($items->total(), 0, ',', '.') }} foto
        </div>
      @endif
    </div>

    @if($albums->count() === 0)
      <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-12 text-center shadow-sm">
        <div class="mx-auto grid h-14 w-14 place-items-center rounded-2xl bg-blue-50 text-blue-800">
          <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4-4 4 4 3-3 5 5M4 6h16v12H4z"></path>
          </svg>
        </div>
        <h3 class="mt-4 text-xl font-black text-slate-900">Belum ada foto gallery</h3>
        <p class="mt-2 text-sm font-semibold text-slate-500">Foto yang dipublish dari dashboard admin akan tampil di sini.</p>
      </div>
    @else
      <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 lg:gap-8" id="galleryGrid">
        @foreach($albums as $album)
          @php
            $cover = $album->cover;
            $coverUrl = !empty($cover?->image_path) ? asset('storage/'.$cover->image_path) : asset('assets/logo.png');
            $caption = trim((string) ($cover->caption ?? ''));
          @endphp
          <article
            class="js-gallery-card group overflow-hidden rounded-xl border border-white/80 bg-white shadow-[0_10px_34px_rgba(15,23,42,0.12)] ring-1 ring-slate-200/60 transition duration-300 hover:-translate-y-1 hover:shadow-[0_22px_52px_rgba(15,23,42,0.20)]"
            data-category="{{ $album->key }}"
          >
            <button
              type="button"
              class="js-gallery-album w-full text-left"
              data-category="{{ $album->key }}"
              aria-label="Buka album: {{ $album->title }}"
            >
              <div class="relative aspect-[16/10] overflow-hidden bg-slate-100">
                <img
                  src="{{ $coverUrl }}"
                  alt="{{ $album->title }}"
                  class="h-full w-full object-cover brightness-110 contrast-110 saturate-125 transition duration-700 group-hover:scale-105 group-hover:brightness-[1.15]"
                  loading="lazy"
                  onerror="this.onerror=null;this.src='{{ asset('assets/logo.png') }}';"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/48 via-slate-950/0 to-transparent opacity-75 transition group-hover:opacity-65"></div>
                <div class="absolute left-4 top-4 rounded-full bg-white/92 px-3 py-1.5 text-[11px] font-black uppercase tracking-widest text-slate-900 shadow-sm backdrop-blur">
                  Album
                </div>
                <div class="absolute bottom-4 left-4 right-4 text-white">
                  <div class="text-xs font-black uppercase tracking-[0.18em] text-yellow-300">GKKA Samarinda</div>
                  <h3 class="mt-1 line-clamp-2 text-xl font-black leading-tight">{{ $album->title }}</h3>
                </div>
              </div>

              <div class="p-5 sm:p-6">
                <div class="flex items-center justify-between gap-4">
                  <div>
                    <div class="text-lg font-black leading-tight text-slate-900 transition group-hover:text-blue-800">
                      {{ $album->title }}
                    </div>
                    <div class="mt-1 text-sm font-bold text-slate-500">
                      {{ number_format($album->count, 0, ',', '.') }} Foto
                    </div>
                  </div>
                  <span class="grid h-11 w-11 shrink-0 place-items-center rounded-full bg-blue-50 text-blue-800 transition group-hover:bg-blue-800 group-hover:text-white">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.4" d="M9 5l7 7-7 7"></path>
                    </svg>
                  </span>
                </div>

                @if($caption !== '')
                  <p class="mt-4 line-clamp-2 text-sm font-semibold leading-relaxed text-slate-600">{{ $caption }}</p>
                @endif
              </div>
            </button>
          </article>
        @endforeach
      </div>
    @endif

    <div class="mt-12">
      @if(method_exists($items, 'links'))
        {{ $items->links() }}
      @endif
    </div>
  </div>
</section>

<div id="galleryModal" class="fixed inset-0 z-[100] hidden items-center justify-center px-4" aria-hidden="true">
  <div class="absolute inset-0 bg-slate-950/92 backdrop-blur-sm opacity-0 transition-opacity duration-300" id="galleryBackdrop" data-close="1"></div>

  <div class="relative z-10 flex max-h-[92vh] w-full max-w-6xl scale-95 flex-col items-center opacity-0 transition-all duration-300" id="galleryPanel" role="dialog" aria-modal="true" aria-label="Gallery preview">
    <button class="absolute right-0 -top-12 grid h-10 w-10 place-items-center rounded-full bg-white/10 text-3xl font-bold text-white/80 transition hover:bg-white/20 hover:text-white" type="button" aria-label="Tutup" data-close="1">×</button>

    <button class="absolute left-2 top-1/2 z-20 hidden h-12 w-12 -translate-y-1/2 place-items-center rounded-full bg-white/12 text-4xl font-black text-white/80 backdrop-blur transition hover:bg-white/22 hover:text-white md:grid" type="button" aria-label="Sebelumnya" data-prev="1">‹</button>
    <button class="absolute right-2 top-1/2 z-20 hidden h-12 w-12 -translate-y-1/2 place-items-center rounded-full bg-white/12 text-4xl font-black text-white/80 backdrop-blur transition hover:bg-white/22 hover:text-white md:grid" type="button" aria-label="Berikutnya" data-next="1">›</button>

    <div class="max-h-[78vh] w-full overflow-hidden rounded-2xl bg-black shadow-2xl">
      <img id="galleryModalImg" src="" alt="" class="mx-auto max-h-[78vh] w-full object-contain">
    </div>

    <div class="mt-4 w-full max-w-3xl text-center text-white">
      <div id="galleryModalTitle" class="text-xl font-black"></div>
      <div id="galleryModalCaption" class="mt-2 text-sm font-medium leading-relaxed text-white/70"></div>
    </div>
  </div>
</div>

<script>
  window.GKKA_GALLERY = @json($galleryPhotos);

  (function () {
    const allPhotos = Array.isArray(window.GKKA_GALLERY) ? window.GKKA_GALLERY : [];
    const filterButtons = Array.from(document.querySelectorAll('.js-gallery-filter'));
    const cards = Array.from(document.querySelectorAll('.js-gallery-card'));
    const albumButtons = Array.from(document.querySelectorAll('.js-gallery-album'));
    const modal = document.getElementById('galleryModal');
    const backdrop = document.getElementById('galleryBackdrop');
    const panel = document.getElementById('galleryPanel');
    const img = document.getElementById('galleryModalImg');
    const title = document.getElementById('galleryModalTitle');
    const caption = document.getElementById('galleryModalCaption');
    let activePhotos = allPhotos;
    let idx = 0;

    function setFilter(nextFilter) {
      filterButtons.forEach((button) => {
        const active = button.getAttribute('data-filter') === nextFilter;
        button.setAttribute('aria-pressed', active ? 'true' : 'false');
        button.classList.toggle('bg-slate-950', active);
        button.classList.toggle('text-white', active);
        button.classList.toggle('shadow-md', active);
        button.classList.toggle('bg-white', !active);
        button.classList.toggle('text-slate-600', !active);
        button.classList.toggle('border', !active);
        button.classList.toggle('border-slate-300', !active);
      });

      cards.forEach((card) => {
        const show = nextFilter === 'all' || card.getAttribute('data-category') === nextFilter;
        card.classList.toggle('hidden', !show);
      });
    }

    function setIndex(nextIdx) {
      if (!activePhotos.length) return;
      idx = (nextIdx + activePhotos.length) % activePhotos.length;
      const item = activePhotos[idx];
      img.src = item.src || '';
      img.alt = item.title || '';
      title.textContent = item.title || '';
      caption.textContent = item.caption || '';
      caption.style.display = item.caption && item.caption.trim() ? 'block' : 'none';
    }

    function openAlbum(category) {
      activePhotos = allPhotos.filter((item) => item.category === category);
      if (!activePhotos.length) return;
      setIndex(0);
      modal.classList.remove('hidden');
      modal.classList.add('flex');
      modal.setAttribute('aria-hidden', 'false');
      requestAnimationFrame(() => {
        backdrop.classList.remove('opacity-0');
        panel.classList.remove('opacity-0', 'scale-95');
        panel.classList.add('opacity-100', 'scale-100');
      });
      document.body.style.overflow = 'hidden';
    }

    function close() {
      backdrop.classList.add('opacity-0');
      panel.classList.remove('opacity-100', 'scale-100');
      panel.classList.add('opacity-0', 'scale-95');
      setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
        img.src = '';
      }, 250);
    }

    filterButtons.forEach((button) => {
      button.addEventListener('click', () => setFilter(button.getAttribute('data-filter') || 'all'));
    });

    albumButtons.forEach((button) => {
      button.addEventListener('click', () => openAlbum(button.getAttribute('data-category') || ''));
    });

    modal.addEventListener('click', (event) => {
      const target = event.target;
      if (!(target instanceof Element)) return;
      if (target.getAttribute('data-close') === '1') close();
      if (target.getAttribute('data-prev') === '1') setIndex(idx - 1);
      if (target.getAttribute('data-next') === '1') setIndex(idx + 1);
    });

    window.addEventListener('keydown', (event) => {
      if (modal.classList.contains('hidden')) return;
      if (event.key === 'Escape') close();
      if (event.key === 'ArrowLeft') setIndex(idx - 1);
      if (event.key === 'ArrowRight') setIndex(idx + 1);
    });
  })();
</script>
@endsection
