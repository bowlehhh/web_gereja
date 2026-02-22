@extends('layout.app')

@section('title','Gallery - GKKA Samarinda')

@section('content')
@php
  $arr = $items instanceof \Illuminate\Pagination\AbstractPaginator ? $items->getCollection()->values() : collect($items)->values();
  $featured = $arr->first();
  $circles = $arr->slice(1, 6)->values();
  $rest = $arr->slice(7)->values();
@endphp

<section class="gkka-gallery-hero">
  <div class="relative z-10 gkka-container pt-28 pb-10 sm:pt-32 sm:pb-12">
    <h1 class="gkka-hero-title text-3xl sm:text-4xl md:text-5xl font-black tracking-tight">
      Galeri Foto Jemaat
    </h1>
    <p class="mt-3 text-sm sm:text-base text-white/80 font-semibold">
      Jelajahi momen indah GKKA Samarinda
    </p>
  </div>
</section>

<section class="gkka-gallery-body">
  <div class="gkka-container py-12 sm:py-14">
    <div class="relative z-10 px-2 sm:px-0">
      {{-- blue transparent blobs (like reference depth) --}}
      <div class="absolute -top-24 -left-24 size-[520px] rounded-full bg-blue-400/10 blur-3xl pointer-events-none"></div>
      <div class="absolute -bottom-28 -right-24 size-[560px] rounded-full bg-blue-700/10 blur-3xl pointer-events-none"></div>

      <div class="grid grid-cols-1 lg:grid-cols-[420px_1fr] gap-10 lg:gap-12 items-start">
        {{-- Featured (left) --}}
        <div class="max-w-[420px] mx-auto lg:mx-0">
          @if($featured)
            <button
              type="button"
              class="js-gallery-item w-full text-left focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-yellow-300/60"
              data-src="{{ asset('storage/'.$featured->image_path) }}"
              data-title="{{ $featured->title }}"
              data-caption="{{ $featured->caption ?? '' }}"
              aria-label="Buka foto: {{ $featured->title }}"
            >
              <div class="rounded-[1.75rem] overflow-hidden border-4 gkka-gold-ring bg-white">
                <div class="aspect-[16/9]">
                  <img
                    src="{{ asset('storage/'.$featured->image_path) }}"
                    alt="{{ $featured->title }}"
                    class="w-full h-full object-cover"
                    loading="eager"
                  >
                </div>
              </div>
            </button>
          @else
            <div class="rounded-[1.75rem] overflow-hidden border-4 gkka-gold-ring bg-white">
              <div class="aspect-[16/9] grid place-items-center text-slate-400 font-black">
                Belum ada foto
              </div>
            </div>
          @endif
        </div>

        {{-- Circles (right) --}}
        <div class="w-full">
          @if($arr->count() === 0)
            <div class="rounded-2xl border border-slate-200 bg-white/70 backdrop-blur px-6 py-5 text-slate-600 font-semibold shadow-sm">
              Belum ada foto gallery yang dipublish.
            </div>
          @elseif($circles->count())
            <div class="grid grid-cols-3 gap-6 sm:gap-7 place-items-center">
              @foreach($circles as $it)
                <button
                  type="button"
                  class="js-gallery-item group relative size-28 sm:size-32 md:size-36 lg:size-40 rounded-full overflow-hidden border-4 gkka-gold-ring bg-white focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-yellow-300/60"
                  data-src="{{ asset('storage/'.$it->image_path) }}"
                  data-title="{{ $it->title }}"
                  data-caption="{{ $it->caption ?? '' }}"
                  aria-label="Buka foto: {{ $it->title }}"
                >
                  <img
                    src="{{ asset('storage/'.$it->image_path) }}"
                    alt="{{ $it->title }}"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                    loading="lazy"
                  >
                  <div class="absolute inset-0 bg-blue-900/0 group-hover:bg-blue-900/15 transition-colors"></div>
                </button>
              @endforeach
            </div>
          @else
            <div class="rounded-2xl border border-slate-200 bg-white/70 backdrop-blur px-6 py-5 text-slate-600 font-semibold shadow-sm">
              Belum ada foto lainnya untuk ditampilkan.
            </div>
          @endif
        </div>
      </div>
    </div>

    {{-- Hidden items so modal navigation can include all photos --}}
    @if($rest->count())
      <div class="sr-only">
        @foreach($rest as $it)
          <button
            type="button"
            class="js-gallery-item"
            data-src="{{ asset('storage/'.$it->image_path) }}"
            data-title="{{ $it->title }}"
            data-caption="{{ $it->caption ?? '' }}"
            aria-label="Buka foto: {{ $it->title }}"
          ></button>
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
