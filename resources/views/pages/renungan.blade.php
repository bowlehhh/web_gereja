@extends('layout.app')

@section('title','Renungan GKKA-I INDONESIA | Jemaat Samarinda')
@section('meta_description', 'Renungan harian GKKA-I INDONESIA Jemaat Samarinda: bacaan rohani untuk menguatkan iman setiap hari.')
@section('meta_image', asset('img/tuhan%20yesus.jpeg'))

@push('styles')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
  <style>
    .renungan-page {
      background-image:
        linear-gradient(180deg, rgba(12, 16, 24, 0.42) 0%, rgba(14, 20, 28, 0.30) 34%, rgba(14, 20, 28, 0.28) 62%, rgba(12, 16, 24, 0.40) 100%),
        var(--renungan-bg);
      background-position: center center;
      background-size: cover;
      background-attachment: fixed;
      min-height: 100vh;
      padding-top: 104px;
      padding-bottom: 44px;
    }

    .renungan-wrap {
      max-width: 1140px;
      margin: 0 auto;
      padding: 18px 16px;
    }

    .topbar {
      display: flex;
      justify-content: space-between;
      align-items: flex-end;
      gap: 14px;
      margin-bottom: 14px;
      flex-wrap: wrap;
    }

    .topbar h2 {
      margin: 0;
      font-size: clamp(22px, 2.8vw, 34px);
      font-weight: 900;
      color: #ffffff;
      letter-spacing: 0.2px;
    }

    .topbar p {
      margin: 7px 0 0;
      color: rgba(235, 244, 255, 0.9);
      font-size: 14px;
      font-weight: 600;
    }

    .topbar-actions {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }

    .btn-primary {
      border: 0;
      background: #f4b400;
      color: #111827;
      padding: 12px 16px;
      border-radius: 12px;
      font-weight: 900;
      cursor: pointer;
      box-shadow: 0 10px 25px rgba(0, 0, 0, .14);
      transition: transform .12s ease, box-shadow .2s ease, opacity .12s ease;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      text-decoration: none;
    }

    .btn-primary:hover {
      box-shadow: 0 14px 30px rgba(0, 0, 0, .18);
    }

    .btn-primary:active {
      transform: scale(.985);
    }

    .btn-primary[disabled] {
      opacity: .65;
      cursor: not-allowed;
      box-shadow: none;
    }

    .btn-secondary {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 12px 14px;
      border-radius: 12px;
      border: 1px solid #d7deea;
      background: #fff;
      color: #0b2a55;
      font-weight: 900;
      text-decoration: none;
    }

    .swiper-shell {
      position: relative;
      border-radius: 22px;
      overflow: hidden;
      background: linear-gradient(165deg, rgba(12, 18, 32, 0.42), rgba(12, 18, 32, 0.26));
      padding: 12px 8px 18px;
      box-shadow: 0 18px 45px rgba(8, 12, 20, 0.28);
      border: 1px solid rgba(255, 255, 255, 0.34);
      backdrop-filter: blur(4px);
    }

    .swiper {
      padding: 8px 6px 32px;
    }

    .swiper-pagination {
      bottom: 4px !important;
    }

    .swiper-pagination-bullet {
      background: rgba(255, 255, 255, 0.72);
      opacity: 0.8;
    }

    .swiper-pagination-bullet-active {
      opacity: 1;
      background: #ffffff;
    }

    .r-card {
      display: block;
      position: relative;
      border-radius: 20px;
      overflow: hidden;
      background: linear-gradient(180deg, rgba(255, 255, 255, 0.98) 0%, rgba(246, 250, 255, 0.98) 100%);
      border: 1px solid rgba(222, 231, 245, 0.95);
      text-decoration: none;
      color: #111827;
      box-shadow: 0 16px 34px rgba(6, 29, 66, 0.18);
      transition: transform .18s ease, box-shadow .22s ease, border-color .22s ease;
      height: 100%;
      isolation: isolate;
    }

    .r-card::before {
      content: '';
      position: absolute;
      left: 0;
      right: 0;
      top: 0;
      height: 4px;
      background: linear-gradient(90deg, #59a9ff 0%, #2a6ed6 45%, #f4b400 100%);
      z-index: 1;
    }

    .r-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 22px 38px rgba(6, 29, 66, 0.28);
      border-color: rgba(143, 179, 238, 0.95);
    }

    .thumb {
      position: relative;
      height: 178px;
      background: #e8eef9;
      overflow: hidden;
    }

    .thumb::after {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(180deg, rgba(3, 19, 46, 0.04) 0%, rgba(3, 19, 46, 0.32) 100%);
      pointer-events: none;
    }

    .thumb img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center center;
      display: block;
      transition: transform .6s ease;
    }

    .r-card:hover .thumb img {
      transform: scale(1.06);
    }

    .body {
      padding: 14px 15px 16px;
      display: grid;
      gap: 8px;
    }

    .r-badge {
      display: inline-flex;
      width: fit-content;
      align-items: center;
      padding: 5px 11px;
      border-radius: 999px;
      background: linear-gradient(180deg, #eef4ff, #e5efff);
      color: #1e49b8;
      font-weight: 900;
      font-size: 11px;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      border: 1px solid #d5e4ff;
    }

    .r-title {
      font-weight: 900;
      font-size: 18px;
      line-height: 1.22;
      color: #0b1833;
      display: -webkit-box;
      -webkit-box-orient: vertical;
      -webkit-line-clamp: 2;
      overflow: hidden;
      min-height: 44px;
    }

    .r-sub {
      color: #2a4f9a;
      font-size: 12px;
      font-weight: 800;
      line-height: 1.5;
      display: -webkit-box;
      -webkit-box-orient: vertical;
      -webkit-line-clamp: 2;
      overflow: hidden;
      min-height: 36px;
    }

    .r-excerpt {
      color: #5b6a80;
      font-size: 13px;
      font-weight: 700;
      line-height: 1.55;
      display: -webkit-box;
      -webkit-box-orient: vertical;
      -webkit-line-clamp: 2;
      overflow: hidden;
      min-height: 40px;
    }

    .r-meta {
      margin-top: 2px;
      padding-top: 11px;
      border-top: 1px solid #e4ebf8;
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
      color: #667085;
      font-size: 12px;
      font-weight: 800;
    }

    .swiper-button-prev,
    .swiper-button-next {
      width: 42px;
      height: 42px;
      border-radius: 999px;
      background: #fff;
      box-shadow: 0 10px 25px rgba(0, 0, 0, .12);
      border: 1px solid #eef2f7;
      color: #0b2a55;
    }

    .swiper-button-prev:after,
    .swiper-button-next:after {
      font-size: 16px;
      font-weight: 900;
    }

    .swiper-fade {
      position: absolute;
      top: 0;
      bottom: 0;
      width: 88px;
      pointer-events: none;
      z-index: 2;
    }

    .swiper-fade-left {
      left: 0;
      background: linear-gradient(90deg, rgba(12, 18, 32, 0.44), rgba(12, 18, 32, 0));
    }

    .swiper-fade-right {
      right: 0;
      background: linear-gradient(270deg, rgba(12, 18, 32, 0.44), rgba(12, 18, 32, 0));
    }

    .swiper-shell.is-single .swiper-button-prev,
    .swiper-shell.is-single .swiper-button-next,
    .swiper-shell.is-single .swiper-pagination,
    .swiper-shell.is-single .swiper-fade {
      display: none;
    }

    .swiper-shell.is-single {
      max-width: 100%;
      padding: 0;
      border: 0;
      background: transparent;
      box-shadow: none;
      backdrop-filter: none;
      overflow: visible;
    }

    .swiper-shell.is-single .swiper-wrapper {
      justify-content: center;
    }

    .swiper-shell.is-single .swiper {
      max-width: 360px;
      margin: 0 auto;
      padding: 0;
    }

    .swiper-shell.is-single .swiper-slide {
      width: 100% !important;
      margin-right: 0 !important;
    }

    .swiper-shell.is-single .r-card {
      max-width: 100%;
      margin: 0;
    }

    .renungan-empty {
      border: 1px solid #dbe6f4;
      background: rgba(255, 255, 255, 0.92);
      border-radius: 18px;
      padding: 24px;
      text-align: center;
      color: #64748b;
      font-weight: 700;
      box-shadow: 0 10px 28px rgba(0, 0, 0, 0.06);
    }

    .renungan-empty strong {
      display: block;
      margin-bottom: 6px;
      color: #0f172a;
      font-size: 20px;
    }

    .modal-overlay {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, .55);
      display: none;
      align-items: center;
      justify-content: center;
      padding: 18px;
      z-index: 9999;
    }

    .modal-overlay.show {
      display: flex;
    }

    .modal-card {
      width: min(760px, 96vw);
      background: #fff;
      border-radius: 18px;
      overflow: hidden;
      box-shadow: 0 20px 70px rgba(0, 0, 0, .35);
      animation: pop .16s ease forwards;
    }

    @keyframes pop {
      from { transform: translateY(10px); opacity: .7; }
      to { transform: translateY(0); opacity: 1; }
    }

    .modal-header {
      padding: 16px;
      display: flex;
      justify-content: space-between;
      gap: 12px;
      border-bottom: 1px solid #eef2f7;
    }

    .modal-header h3 {
      margin: 10px 0 0;
      font-size: 20px;
      font-weight: 900;
      color: #0f172a;
      line-height: 1.2;
    }

    .badge {
      display: inline-block;
      padding: 5px 10px;
      border-radius: 999px;
      background: #e8f0ff;
      color: #1b4dd6;
      font-weight: 900;
      font-size: 11px;
      letter-spacing: 0.08em;
      text-transform: uppercase;
    }

    .meta {
      margin-top: 8px;
      color: #6b7280;
      font-size: 12px;
      font-weight: 700;
    }

    .icon-btn {
      border: 1px solid #e6eaf2;
      background: #fff;
      border-radius: 10px;
      width: 38px;
      height: 38px;
      cursor: pointer;
      color: #334155;
      font-weight: 900;
      line-height: 1;
    }

    .modal-body {
      padding: 14px 16px;
      max-height: min(56vh, 430px);
      overflow-y: auto;
    }

    .verse {
      font-weight: 900;
      color: #0b2a55;
      margin: 0 0 10px;
    }

    .text {
      line-height: 1.7;
      color: #111827;
      font-weight: 500;
    }

    .text p {
      margin: 0 0 12px;
    }

    .text p:last-child {
      margin-bottom: 0;
    }

    .modal-footer {
      padding: 12px 16px 16px;
      border-top: 1px solid #eef2f7;
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      flex-wrap: wrap;
    }

    .skeleton .sk-line {
      height: 12px;
      border-radius: 8px;
      background: linear-gradient(90deg,#eef2f7,#f7f9fc,#eef2f7);
      background-size: 200% 100%;
      animation: shimmer 1.1s infinite;
      margin: 10px 0;
    }

    .skeleton .w-60 { width: 60%; }
    .skeleton .w-80 { width: 80%; }

    @keyframes shimmer {
      0% { background-position: 200% 0; }
      100% { background-position: -200% 0; }
    }

    @media (max-width: 700px) {
      .renungan-page {
        padding-top: 84px;
        padding-bottom: 24px;
        background-attachment: scroll;
        background-position: center center;
      }

      .renungan-wrap {
        padding: 10px 10px 16px;
      }

      .topbar {
        margin-bottom: 10px;
        border-radius: 16px;
        border: 1px solid rgba(255, 255, 255, 0.28);
        background: linear-gradient(145deg, rgba(12, 18, 32, 0.52), rgba(12, 18, 32, 0.24));
        backdrop-filter: blur(6px);
        padding: 11px;
      }

      .topbar h2 {
        font-size: 30px;
      }

      .topbar p {
        margin-top: 5px;
        font-size: 12px;
      }

      .topbar-actions {
        width: 100%;
        gap: 8px;
      }

      .topbar-actions .btn-primary,
      .topbar-actions .btn-secondary {
        flex: 1 1 100%;
        height: 42px;
        padding: 0 12px;
        border-radius: 11px;
        font-size: 14px;
      }

      .swiper-shell {
        border-radius: 18px;
        padding: 8px 7px 12px;
      }

      .swiper-shell.is-single .swiper-slide {
        width: 100% !important;
      }

      .swiper {
        padding: 4px 3px 24px;
      }

      .thumb {
        height: 156px;
      }

      .thumb img {
        object-position: center center;
      }

      .body {
        padding: 11px 11px 12px;
        gap: 6px;
      }

      .r-badge {
        font-size: 10px;
        padding: 4px 8px;
      }

      .r-title {
        font-size: 17px;
        min-height: auto;
      }

      .r-sub {
        font-size: 11px;
        min-height: auto;
      }

      .r-excerpt {
        display: none;
      }

      .r-meta {
        margin-top: 0;
        padding-top: 8px;
        justify-content: space-between;
        font-size: 11px;
      }

      .r-meta span:nth-child(2) {
        display: none;
      }

      .swiper-fade {
        width: 28px;
      }

      .renungan-empty {
        border-radius: 14px;
        padding: 16px 12px;
        font-size: 13px;
      }

      .renungan-empty strong {
        font-size: 17px;
      }

      .modal-overlay {
        padding: 8px;
      }

      .modal-card {
        width: min(100%, 100vw - 16px);
        border-radius: 16px;
      }

      .modal-header {
        padding: 13px;
      }

      .modal-header h3 {
        font-size: 17px;
      }

      .modal-body {
        padding: 12px 13px;
        max-height: 58vh;
      }

      .modal-footer {
        padding: 10px 13px 13px;
      }

      .modal-footer .btn-secondary,
      .modal-footer .btn-primary {
        flex: 1 1 100%;
        height: 40px;
        padding: 0 12px;
        font-size: 13px;
      }
    }

    @media (max-width: 420px) {
      .topbar h2 {
        font-size: 28px;
      }

      .thumb {
        height: 148px;
      }

      .renungan-page {
        background-position: center center;
      }

      .r-title {
        font-size: 16px;
      }
    }
  </style>
@endpush

@section('content')
@php
  $itemsCollection = ($items ?? collect())->values();
  $carouselItems = $itemsCollection->take(60)->values();
  $pageBackground = asset('img/tuhan%20yesus.jpeg');
@endphp

<div class="renungan-page" style="--renungan-bg: url('{{ $pageBackground }}');">
  <section class="renungan-wrap">
    <div class="topbar">
      <div>
        <h2>Renungan</h2>
        <p>Geser atau biarkan berjalan otomatis.</p>
      </div>

      <div class="topbar-actions">
        <button id="btnRandom" class="btn-primary" type="button" {{ $itemsCollection->isEmpty() ? 'disabled' : '' }}>
          <span id="btnRandomLabel">{{ $itemsCollection->isEmpty() ? 'Belum Ada Renungan' : 'Random Renungan' }}</span>
        </button>
        <a href="{{ route('home') }}" class="btn-secondary">Kembali ke Beranda</a>
      </div>
    </div>

    @if($carouselItems->isNotEmpty())
      <div class="swiper-shell" id="renunganSwiperShell">
        <div class="swiper renunganSwiper" id="renunganSwiper">
          <div class="swiper-wrapper">
            @foreach($carouselItems as $r)
              @php
                $cover = $r->image_path ? asset('storage/'.$r->image_path) : asset('img/fotogrj.jpeg');
                $reference = trim((string) $r->scripture_reference);
                $category = 'RENUNGAN';
                if ($reference !== '') {
                    $parts = preg_split('/[\s:]+/', $reference);
                    $candidate = trim((string) ($parts[0] ?? ''));
                    if ($candidate !== '') {
                        $category = \Illuminate\Support\Str::upper($candidate);
                    }
                }
              @endphp
              <div class="swiper-slide">
                <a class="r-card" href="{{ route('renungan.show', $r) }}">
                  <div class="thumb">
                    <img
                      src="{{ $cover }}"
                      alt="{{ $r->title }}"
                      loading="lazy"
                      onerror="this.onerror=null;this.src='{{ asset('assets/logo.png') }}';">
                  </div>
                  <div class="body">
                    <span class="r-badge">{{ $category }}</span>
                    <div class="r-title">{{ $r->title }}</div>
                    <div class="r-sub">{{ $reference !== '' ? $reference : 'Tanpa referensi ayat' }}</div>
                    <div class="r-excerpt">{{ $r->excerpt }}</div>
                    <div class="r-meta">
                      <span>{{ optional($r->published_at)->translatedFormat('d F Y') }}</span>
                      <span>•</span>
                      <span>{{ $r->author }}</span>
                    </div>
                  </div>
                </a>
              </div>
            @endforeach
          </div>

          <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div>
          <div class="swiper-pagination"></div>
        </div>

        <div class="swiper-fade swiper-fade-left" aria-hidden="true"></div>
        <div class="swiper-fade swiper-fade-right" aria-hidden="true"></div>
      </div>
    @else
      <div class="renungan-empty">
        <strong>Renungan Belum Tersedia</strong>
        Konten akan muncul di sini setelah ditambahkan dari dashboard admin.
      </div>
    @endif
  </section>
</div>

<div id="renModal" class="modal-overlay" aria-hidden="true">
  <div class="modal-card" role="dialog" aria-modal="true" aria-labelledby="mTitle">
    <div class="modal-header">
      <div>
        <div class="badge" id="mCategory">RANDOM</div>
        <h3 id="mTitle">Mengambil renungan...</h3>
        <p class="meta" id="mMeta"></p>
      </div>
      <button id="mClose" class="icon-btn" type="button" aria-label="Tutup">X</button>
    </div>

    <div class="modal-body">
      <div id="mSkeleton" class="skeleton">
        <div class="sk-line w-60"></div>
        <div class="sk-line"></div>
        <div class="sk-line"></div>
        <div class="sk-line w-80"></div>
      </div>

      <div id="mContent" style="display:none;">
        <p class="verse" id="mVerse"></p>
        <div class="text" id="mText"></div>
      </div>
    </div>

    <div class="modal-footer">
      <a id="mOpen" class="btn-secondary" href="#">Buka Halaman</a>
      <button id="btnRandomAgain" class="btn-primary" type="button">Random Lagi</button>
    </div>
  </div>
</div>
@endsection

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script>
    (function () {
      const randomEndpoint = @json(route('renungan.random'));
      const hasItems = {{ ($items ?? collect())->isNotEmpty() ? 'true' : 'false' }};

      const shell = document.getElementById('renunganSwiperShell');
      const swiperElement = document.getElementById('renunganSwiper');
      if (window.Swiper && swiperElement) {
        const slideCount = swiperElement.querySelectorAll('.swiper-slide').length;
        const isSingle = slideCount <= 1;
        if (isSingle && shell) shell.classList.add('is-single');

        const swiperOptions = isSingle
          ? {
              loop: false,
              centeredSlides: true,
              centeredSlidesBounds: true,
              slidesPerView: 1,
              spaceBetween: 0,
              speed: 600,
              autoplay: false,
              allowTouchMove: false
            }
          : {
              loop: true,
              centeredSlides: false,
              spaceBetween: 16,
              speed: 900,
              autoplay: {
                delay: 2200,
                disableOnInteraction: false,
                pauseOnMouseEnter: true
              },
              breakpoints: {
                0: { slidesPerView: 1.04 },
                420: { slidesPerView: 1.16 },
                640: { slidesPerView: 2.05 },
                900: { slidesPerView: 3.2 },
                1100: { slidesPerView: 4 }
              }
            };

        new Swiper('.renunganSwiper', {
          ...swiperOptions,
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
          },
          pagination: {
            el: '.swiper-pagination',
            clickable: true
          }
        });
      }

      const modal = document.getElementById('renModal');
      const mClose = document.getElementById('mClose');
      const mSkeleton = document.getElementById('mSkeleton');
      const mContent = document.getElementById('mContent');

      const mCategory = document.getElementById('mCategory');
      const mTitle = document.getElementById('mTitle');
      const mMeta = document.getElementById('mMeta');
      const mVerse = document.getElementById('mVerse');
      const mText = document.getElementById('mText');
      const mOpen = document.getElementById('mOpen');

      const btnRandom = document.getElementById('btnRandom');
      const btnRandomAgain = document.getElementById('btnRandomAgain');
      const btnRandomLabel = document.getElementById('btnRandomLabel');

      function escapeHtml(str) {
        return String(str)
          .replaceAll('&', '&amp;')
          .replaceAll('<', '&lt;')
          .replaceAll('>', '&gt;')
          .replaceAll('"', '&quot;')
          .replaceAll("'", '&#039;');
      }

      function openModal() {
        if (!modal) return;
        modal.classList.add('show');
        modal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
      }

      function closeModal() {
        if (!modal) return;
        modal.classList.remove('show');
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
      }

      function setLoading(isLoading) {
        if (btnRandom) {
          btnRandom.disabled = isLoading || !hasItems;
          if (btnRandomLabel && hasItems) {
            btnRandomLabel.textContent = isLoading ? 'Memuat...' : 'Random Renungan';
          }
        }
        if (btnRandomAgain) {
          btnRandomAgain.disabled = isLoading || !hasItems;
          btnRandomAgain.textContent = isLoading ? 'Memuat...' : 'Random Lagi';
        }
      }

      async function randomRenungan() {
        if (!hasItems) return;

        openModal();
        setLoading(true);
        if (mSkeleton) mSkeleton.style.display = 'block';
        if (mContent) mContent.style.display = 'none';
        if (mCategory) mCategory.textContent = 'RANDOM';
        if (mTitle) mTitle.textContent = 'Mengambil renungan...';
        if (mMeta) mMeta.textContent = '';
        if (mVerse) mVerse.textContent = '';
        if (mText) mText.innerHTML = '';
        if (mOpen) mOpen.href = '#';

        try {
          const res = await fetch(randomEndpoint, { headers: { 'Accept': 'application/json' } });
          const data = await res.json().catch(() => ({}));
          if (!res.ok) {
            throw new Error(data.message || 'Gagal mengambil data random');
          }

          if (mCategory) mCategory.textContent = data.kategori || 'RENUNGAN';
          if (mTitle) mTitle.textContent = data.judul || '(Tanpa Judul)';
          if (mMeta) mMeta.textContent = `${data.tanggal || ''}${data.penulis ? ' • ' + data.penulis : ''}`;
          if (mVerse) mVerse.textContent = data.ayat ? `\uD83D\uDCD6 ${data.ayat}` : '';

          if (mText) {
            if (data.isi_html) {
              mText.innerHTML = data.isi_html;
            } else if (data.isi) {
              mText.innerHTML = `<p>${escapeHtml(data.isi)}</p>`;
            } else {
              mText.innerHTML = '<p>Isi renungan belum tersedia.</p>';
            }
          }

          if (mOpen) {
            const url = data.url || (data.slug ? `/renungan/${encodeURIComponent(data.slug)}` : '#');
            mOpen.href = url;
          }
        } catch (err) {
          if (mCategory) mCategory.textContent = 'ERROR';
          if (mTitle) mTitle.textContent = 'Oops!';
          if (mMeta) mMeta.textContent = 'Tidak bisa mengambil renungan random.';
          if (mText) mText.innerHTML = `<p style="color:#b42318; font-weight:900;">${escapeHtml(err.message || 'Terjadi kesalahan.')}</p>`;
          if (mOpen) mOpen.href = '#';
        } finally {
          if (mSkeleton) mSkeleton.style.display = 'none';
          if (mContent) mContent.style.display = 'block';
          setLoading(false);
        }
      }

      if (modal) {
        modal.addEventListener('click', (e) => {
          if (e.target === modal) closeModal();
        });
      }
      if (mClose) mClose.addEventListener('click', closeModal);
      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeModal();
      });

      if (btnRandom) btnRandom.addEventListener('click', randomRenungan);
      if (btnRandomAgain) btnRandomAgain.addEventListener('click', randomRenungan);
      setLoading(false);
    })();
  </script>
@endpush
