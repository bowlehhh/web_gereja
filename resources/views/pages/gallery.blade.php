@extends('layout.app')

@section('title','Galeri GKKA Samarinda | Foto Kegiatan GKKAI')
@section('meta_description', 'Galeri foto kegiatan dan momen jemaat GKKA Samarinda (GKKAI Samarinda).')
@section('meta_image', asset('img/fotogrj.jpeg'))
@section('body_class', 'gallery-page')

@section('content')
@php
  $arr = $items instanceof \Illuminate\Pagination\AbstractPaginator ? $items->getCollection()->values() : collect($items)->values();
  $titleCounts = $arr->groupBy(function ($item) {
    return mb_strtolower(trim((string) $item->title));
  })->map->count();
@endphp

<section class="gkka-gallery-hero">
  <div class="relative z-10 gkka-container gkka-gallery-container pt-28 pb-10 sm:pt-32 sm:pb-12">
    <h1 class="gkka-hero-title text-3xl sm:text-4xl md:text-5xl font-black tracking-tight">
      Galeri Foto Jemaat
    </h1>
    <p class="mt-3 text-sm sm:text-base text-white/80 font-semibold">
      Jelajahi momen indah GKKA Samarinda
    </p>
  </div>
</section>

<section class="gkka-gallery-body">
  <div class="gkka-container gkka-gallery-container py-12 sm:py-14">
    <div class="relative z-10 px-2 sm:px-0">
      {{-- blue transparent blobs (like reference depth) --}}
      <div class="absolute -top-24 -left-24 size-[520px] rounded-full bg-blue-400/10 blur-3xl pointer-events-none"></div>
      <div class="absolute -bottom-28 -right-24 size-[560px] rounded-full bg-blue-700/10 blur-3xl pointer-events-none"></div>

      @if($arr->count() === 0)
        <div class="rounded-2xl border border-slate-200 bg-white/70 backdrop-blur px-6 py-5 text-slate-600 font-semibold shadow-sm">
          Belum ada foto gallery yang dipublish.
        </div>
      @else
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-5">
          @foreach($arr as $it)
            @php
              $titleKey = mb_strtolower(trim((string) $it->title));
              $photoCount = (int) ($titleCounts[$titleKey] ?? 1);
            @endphp
            <button
              type="button"
              class="js-gallery-item group w-full text-left rounded-2xl overflow-hidden border border-slate-300 bg-white/95 shadow-sm transition-all duration-300 hover:shadow-md hover:-translate-y-0.5 focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-yellow-300/60"
              data-src="{{ asset('storage/'.$it->image_path) }}"
              data-title="{{ $it->title }}"
              data-caption="{{ $it->caption ?? '' }}"
              aria-label="Buka foto: {{ $it->title }}"
            >
              <div class="relative aspect-[16/10] overflow-hidden border-b border-slate-200 bg-slate-100">
                <img
                  src="{{ asset('storage/'.$it->image_path) }}"
                  alt="{{ $it->title }}"
                  class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                  loading="lazy"
                >
                <div class="pointer-events-none absolute inset-0 ring-2 ring-inset ring-blue-100/90 group-hover:ring-blue-200 transition-colors duration-300"></div>
              </div>
              <div class="px-3 py-2.5 sm:px-4 sm:py-3">
                <h3 class="text-[15px] sm:text-lg font-black text-slate-800 leading-tight line-clamp-2">
                  {{ $it->title }}
                </h3>
                <div class="mt-1 text-xs sm:text-sm font-semibold text-slate-500">{{ number_format($photoCount, 0, ',', '.') }} Foto</div>
              </div>
            </button>
          @endforeach
        </div>
      @endif
    </div>

    <div class="mt-10">
      @if(method_exists($items, 'links'))
        {{ $items->links() }}
      @endif
    </div>
  </div>
</section>

{{-- Lightbox / modal --}}
<div id="galleryModal" class="fixed inset-0 z-[100] hidden items-center justify-center" aria-hidden="true">
  {{-- Backdrop --}}
  <div class="absolute inset-0 bg-black/90 backdrop-blur-sm transition-opacity opacity-0" id="galleryBackdrop" data-close="1"></div>
  
  {{-- Dialog --}}
  <div class="relative w-full max-w-5xl max-h-[90vh] flex flex-col items-center bg-transparent z-10 opacity-0 scale-95 transition-all duration-300 transform" id="galleryPanel" role="dialog" aria-modal="true" aria-label="Gallery preview">
    
    {{-- Close Button --}}
    <button class="absolute -top-12 right-0 md:top-0 md:-right-12 text-white/50 hover:text-white text-4xl font-bold transition-colors focus:outline-none z-20" type="button" aria-label="Tutup" data-close="1">×</button>

    {{-- Nav Buttons --}}
    <button class="absolute left-4 top-1/2 -translate-y-1/2 text-white/50 hover:text-white text-6xl font-black transition-colors focus:outline-none z-20 hidden md:block" type="button" aria-label="Sebelumnya" data-prev="1">‹</button>
    <button class="absolute right-4 top-1/2 -translate-y-1/2 text-white/50 hover:text-white text-6xl font-black transition-colors focus:outline-none z-20 hidden md:block" type="button" aria-label="Berikutnya" data-next="1">›</button>

    {{-- Image Container --}}
    <div class="w-auto h-auto max-h-[80vh] overflow-hidden rounded-xl shadow-2xl relative bg-black">
      <img id="galleryModalImg" src="" alt="" class="max-w-full max-h-[80vh] object-contain mx-auto">
    </div>

    {{-- Meta --}}
    <div class="mt-4 text-center text-white px-6 w-full max-w-2xl mx-auto">
      <div id="galleryModalTitle" class="text-xl font-bold mb-2"></div>
      <div id="galleryModalCaption" class="text-sm text-gray-300 font-medium leading-relaxed"></div>
    </div>
  </div>
</div>

<script>
  (function () {
    const items = Array.from(document.querySelectorAll('.js-gallery-item'));
    const modal = document.getElementById('galleryModal');
    const backdrop = document.getElementById('galleryBackdrop');
    const panel = document.getElementById('galleryPanel');
    const img = document.getElementById('galleryModalImg');
    const title = document.getElementById('galleryModalTitle');
    const caption = document.getElementById('galleryModalCaption');
    
    if (!items.length || !modal || !img) return;

    let idx = 0;

    function setIndex(nextIdx) {
      idx = (nextIdx + items.length) % items.length;
      const el = items[idx];
      const src = el.getAttribute('data-src') || '';
      const t = el.getAttribute('data-title') || '';
      const c = el.getAttribute('data-caption') || '';

      img.src = src;
      img.alt = t;
      title.textContent = t;
      caption.textContent = c;
      caption.style.display = c.trim() ? 'block' : 'none';
    }

    function openAt(i) {
      setIndex(i);
      // Show modal
      modal.classList.remove('hidden');
      modal.classList.add('flex');
      modal.setAttribute('aria-hidden', 'false');
      
      // Animate in
      requestAnimationFrame(() => {
        backdrop.classList.remove('opacity-0');
        panel.classList.remove('opacity-0', 'scale-95');
        panel.classList.add('opacity-100', 'scale-100');
      });
      
      document.body.style.overflow = 'hidden'; // Lock scroll
    }

    function close() {
      // Animate out
      backdrop.classList.add('opacity-0');
      panel.classList.remove('opacity-100', 'scale-100');
      panel.classList.add('opacity-0', 'scale-95');

      setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = ''; // Unlock scroll
        img.src = '';
      }, 300); // Wait for transition
    }

    function prev() { setIndex(idx - 1); }
    function next() { setIndex(idx + 1); }

    items.forEach((el, i) => {
      el.addEventListener('click', () => openAt(i));
    });

    modal.addEventListener('click', (e) => {
      const t = e.target;
      if (t.getAttribute('data-close') === '1') close();
      if (t.getAttribute('data-prev') === '1') prev();
      if (t.getAttribute('data-next') === '1') next();
    });

    window.addEventListener('keydown', (e) => {
      if (modal.classList.contains('hidden')) return;
      if (e.key === 'Escape') close();
      if (e.key === 'ArrowLeft') prev();
      if (e.key === 'ArrowRight') next();
    });
  })();
</script>
@endsection
