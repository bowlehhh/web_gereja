@extends('layout.app')

@section('title','Gallery - GKKA Samarinda')

@section('content')
<section class="bg-blue-900 text-white py-20">
  <div class="gkka-container text-center">
    <h1 class="text-4xl md:text-5xl font-black mb-4 tracking-tight">Gallery</h1>
    <p class="text-lg text-blue-200 font-medium">Dokumentasi kegiatan GKKA Indonesia Jemaat Samarinda</p>
  </div>
</section>

<section class="py-16 bg-gray-50">
  <div class="gkka-container">

    @if($items->count())
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
        @foreach($items as $it)
          <button
            type="button"
            class="group relative block w-full text-left bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 js-gallery-item focus:outline-none focus:ring-4 focus:ring-blue-300"
            data-src="{{ asset('storage/'.$it->image_path) }}"
            data-title="{{ $it->title }}"
            data-caption="{{ $it->caption ?? '' }}"
            aria-label="Buka foto: {{ $it->title }}"
          >
            <div class="h-64 bg-gray-200 bg-cover bg-center group-hover:scale-105 transition-transform duration-700" style="background-image:url('{{ asset('storage/'.$it->image_path) }}')"></div>
            
            <div class="p-6">
              <div class="font-bold text-lg text-slate-900 mb-1 group-hover:text-blue-600 transition-colors">{{ $it->title }}</div>
              @if($it->caption)
                <div class="text-sm text-slate-500 line-clamp-2">{{ $it->caption }}</div>
              @endif
            </div>
          </button>
        @endforeach
      </div>

      <div class="mt-12">
        @if(method_exists($items, 'links'))
          {{ $items->links() }}
        @endif
      </div>
    @else
      <div class="p-12 bg-white rounded-3xl border border-gray-200 text-center text-gray-400 font-bold">
        Belum ada foto gallery yang dipublish.
      </div>
    @endif

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
