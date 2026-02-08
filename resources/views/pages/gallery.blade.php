@extends('layout.app')

@section('title','Gallery - GKKA Samarinda')

@section('content')
<section class="page-head">
  <div class="container">
    <h1 class="page-title">Gallery</h1>
    <p class="page-sub">Dokumentasi kegiatan GKKA Indonesia Jemaat Samarinda</p>
  </div>
</section>

<section class="warta-section">
  <div class="container">

    @if($items->count())
      <div class="grid-3 reveal">
        @foreach($items as $it)
          <button
            type="button"
            class="card gallery-card js-gallery-item"
            data-src="{{ asset('storage/'.$it->image_path) }}"
            data-title="{{ $it->title }}"
            data-caption="{{ $it->caption ?? '' }}"
            aria-label="Buka foto: {{ $it->title }}"
          >
            <div class="thumb" style="background-image:url('{{ asset('storage/'.$it->image_path) }}')"></div>
            <div class="card-body">
              <div class="card-title">{{ $it->title }}</div>
              @if($it->caption)
                <div class="card-muted">{{ $it->caption }}</div>
              @endif
            </div>
          </button>
        @endforeach
      </div>

      <div style="margin-top:18px;">
        {{ $items->links() }}
      </div>
    @else
      <div style="padding:18px;background:#fff;border:1px solid #e5e7eb;border-radius:14px;">
        Belum ada foto gallery yang dipublish.
      </div>
    @endif

  </div>
</section>

{{-- Lightbox / modal (klik foto untuk melihat lebih besar) --}}
<div class="gmodal" id="galleryModal" aria-hidden="true">
  <div class="gmodal-backdrop" data-close="1"></div>
  <div class="gmodal-dialog" role="dialog" aria-modal="true" aria-label="Gallery preview">
    <button class="gmodal-close" type="button" aria-label="Tutup" data-close="1">×</button>

    <button class="gmodal-nav gmodal-prev" type="button" aria-label="Sebelumnya" data-prev="1">‹</button>
    <button class="gmodal-nav gmodal-next" type="button" aria-label="Berikutnya" data-next="1">›</button>

    <div class="gmodal-frame">
      <img class="gmodal-img" id="galleryModalImg" alt="">
    </div>

    <div class="gmodal-meta">
      <div class="gmodal-title" id="galleryModalTitle"></div>
      <div class="gmodal-caption" id="galleryModalCaption"></div>
    </div>
  </div>
</div>

<script>
  (function () {
    const items = Array.from(document.querySelectorAll('.js-gallery-item'));
    const modal = document.getElementById('galleryModal');
    const img = document.getElementById('galleryModalImg');
    const title = document.getElementById('galleryModalTitle');
    const caption = document.getElementById('galleryModalCaption');
    if (!items.length || !modal || !img || !title || !caption) return;

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
      modal.classList.add('is-open');
      modal.setAttribute('aria-hidden', 'false');
      document.body.classList.add('is-modal-open');
    }

    function close() {
      modal.classList.remove('is-open');
      modal.setAttribute('aria-hidden', 'true');
      document.body.classList.remove('is-modal-open');
      // stop image loading on close
      img.src = '';
    }

    function prev() { setIndex(idx - 1); }
    function next() { setIndex(idx + 1); }

    items.forEach((el, i) => {
      el.addEventListener('click', () => openAt(i));
    });

    modal.addEventListener('click', (e) => {
      const t = e.target;
      if (t && t.getAttribute && (t.getAttribute('data-close') === '1')) close();
      if (t && t.getAttribute && (t.getAttribute('data-prev') === '1')) prev();
      if (t && t.getAttribute && (t.getAttribute('data-next') === '1')) next();
    });

    window.addEventListener('keydown', (e) => {
      if (!modal.classList.contains('is-open')) return;
      if (e.key === 'Escape') close();
      if (e.key === 'ArrowLeft') prev();
      if (e.key === 'ArrowRight') next();
    });
  })();
</script>
@endsection
