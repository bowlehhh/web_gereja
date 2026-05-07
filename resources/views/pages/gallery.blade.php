@extends('layout.app')

@section('title','Galeri GKKA Samarinda | Foto Kegiatan GKKAI')
@section('meta_description', 'Galeri foto kegiatan dan momen jemaat GKKA Samarinda (GKKAI Samarinda).')
@section('meta_image', asset('img/fotogrj.jpeg'))
@section('body_class', 'gallery-page')

@section('content')
@php
  $photos = $items instanceof \Illuminate\Pagination\AbstractPaginator ? $items->getCollection()->values() : collect($items)->values();
  $hero = asset('img/fotogrj.jpeg');

  $galleryPhotos = $photos
    ->map(function ($photo, $index) {
      $title = trim((string) $photo->title);

      return [
        'index' => $index,
        'src' => !empty($photo->image_path) ? asset('storage/'.$photo->image_path) : asset('assets/logo.png'),
        'title' => $title !== '' ? $title : 'Foto Gallery',
        'caption' => trim((string) ($photo->caption ?? '')),
      ];
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

<section class="relative -mt-px overflow-hidden bg-[#eef4ff] py-10 sm:py-14 lg:py-16">
  <div class="absolute inset-0 pointer-events-none">
    <img
      src="{{ $hero }}"
      alt=""
      class="h-full w-full scale-125 object-cover opacity-[0.18] blur-3xl saturate-125"
      aria-hidden="true"
    >
    <div class="absolute inset-0 bg-blue-100/82 backdrop-blur-xl"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-blue-950/22 via-blue-100/84 to-[#f8faff]/95"></div>
    <div class="absolute -top-32 left-1/2 h-96 w-[72rem] -translate-x-1/2 rounded-full bg-blue-400/24 blur-3xl"></div>
    <div class="absolute bottom-0 right-0 h-80 w-80 rounded-full bg-blue-200/45 blur-3xl"></div>
  </div>

  <div class="gkka-container relative">
    <div class="mb-7 flex flex-col gap-3 text-center sm:mb-8 sm:flex-row sm:items-end sm:justify-between sm:text-left">
      <div>
        <h2 class="text-2xl font-black tracking-tight text-slate-900 sm:text-3xl">Koleksi Foto</h2>
        <p class="mt-2 text-sm font-semibold text-slate-600 sm:text-base">
          {{ number_format($photos->count(), 0, ',', '.') }} foto ditampilkan.
        </p>
      </div>
      @if(method_exists($items, 'total'))
        <div class="inline-flex justify-center rounded-full border border-white/70 bg-white/80 px-4 py-2 text-xs font-black uppercase tracking-widest text-slate-500 shadow-sm backdrop-blur">
          {{ number_format($items->total(), 0, ',', '.') }} foto
        </div>
      @endif
    </div>

    @if($photos->count() === 0)
      <div class="rounded-2xl border border-dashed border-slate-300 bg-white/82 px-6 py-12 text-center shadow-sm backdrop-blur">
        <div class="mx-auto grid h-14 w-14 place-items-center rounded-2xl bg-blue-50 text-blue-800">
          <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4-4 4 4 3-3 5 5M4 6h16v12H4z"></path>
          </svg>
        </div>
        <h3 class="mt-4 text-xl font-black text-slate-900">Belum ada foto gallery</h3>
        <p class="mt-2 text-sm font-semibold text-slate-500">Foto yang dipublish dari dashboard admin akan tampil di sini.</p>
      </div>
    @else
      <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4" id="galleryGrid">
        @foreach($galleryPhotos as $photo)
          <article class="group overflow-hidden rounded-2xl border border-white/80 bg-white shadow-[0_10px_30px_rgba(15,23,42,0.12)] transition duration-300 hover:-translate-y-1 hover:shadow-[0_20px_46px_rgba(15,23,42,0.18)]">
            <button
              type="button"
              class="js-gallery-photo block w-full text-left"
              data-index="{{ $photo['index'] }}"
              aria-label="Buka foto: {{ $photo['title'] }}"
            >
              <div class="relative aspect-[4/3] overflow-hidden bg-slate-100">
                <img
                  src="{{ $photo['src'] }}"
                  alt="{{ $photo['title'] }}"
                  class="h-full w-full object-cover brightness-110 contrast-110 saturate-125 transition duration-700 group-hover:scale-105 group-hover:brightness-[1.15]"
                  loading="lazy"
                  onerror="this.onerror=null;this.src='{{ asset('assets/logo.png') }}';"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/18 via-transparent to-transparent opacity-70 transition group-hover:opacity-[0.45]"></div>
              </div>

              <div class="p-4">
                <div class="line-clamp-1 text-base font-black leading-tight text-slate-900 transition group-hover:text-blue-800">
                  {{ $photo['title'] }}
                </div>
                @if($photo['caption'] !== '')
                  <p class="mt-2 line-clamp-2 text-sm font-semibold leading-relaxed text-slate-600">{{ $photo['caption'] }}</p>
                @else
                  <p class="mt-1 text-sm font-bold text-slate-500">Foto Gallery</p>
                @endif
              </div>
            </button>
          </article>
        @endforeach
      </div>
    @endif

    <div class="mt-10">
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
    const photoButtons = Array.from(document.querySelectorAll('.js-gallery-photo'));
    const modal = document.getElementById('galleryModal');
    const backdrop = document.getElementById('galleryBackdrop');
    const panel = document.getElementById('galleryPanel');
    const img = document.getElementById('galleryModalImg');
    const title = document.getElementById('galleryModalTitle');
    const caption = document.getElementById('galleryModalCaption');
    let idx = 0;

    function setIndex(nextIdx) {
      if (!allPhotos.length) return;
      idx = (nextIdx + allPhotos.length) % allPhotos.length;
      const item = allPhotos[idx];
      img.src = item.src || '';
      img.alt = item.title || '';
      title.textContent = item.title || '';
      caption.textContent = item.caption || '';
      caption.style.display = item.caption && item.caption.trim() ? 'block' : 'none';
    }

    function openAt(nextIdx) {
      if (!allPhotos.length) return;
      setIndex(nextIdx);
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

    photoButtons.forEach((button) => {
      button.addEventListener('click', () => openAt(Number(button.getAttribute('data-index') || 0)));
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
