@extends('layout.app')

@section('title', 'Beranda - GKKA Samarinda')
@section('meta_description', 'Situs resmi GKKA Indonesia Jemaat Samarinda. Info ibadah, event, warta jemaat, media, galeri, dan pelayanan.')
@section('meta_image', asset('img/fotogrj.jpeg'))

@section('content')
@php
  $heroImage = asset('img/fotogrj.jpeg');
  $sejarahSlides = [
    ['src' => asset('img/sejarah/batu-pertama.jpg'), 'alt' => 'Peletakan batu pertama GKKA Samarinda'],
    ['src' => asset('img/sejarah/pembangunan-gedung.jpg'), 'alt' => 'Pembangunan gedung GKKA Samarinda'],
    ['src' => asset('img/sejarah/foto-bersama.jpg'), 'alt' => 'Foto bersama jemaat GKKA Samarinda'],
  ];
  $homeSlides = [
    ['src' => asset('img/fotogrj.jpeg')],
    ['src' => asset('img/media.jpeg'), 'mobile_position' => '22% center'],
    ['src' => asset('img/komisiwanita.jpeg')],
    ['src' => asset('img/pemuda.jpeg')],
    ['src' => asset('img/remajaa.jpeg')],
    ['src' => asset('img/sekolah minggu.jpeg')],
  ];
@endphp

{{-- INTRO OVERLAY (like GKKA Balikpapan style) --}}
<div id="gkkaIntro" class="gkka-intro">
  <div class="absolute inset-0 opacity-25 pointer-events-none"
       style="background-image: radial-gradient(1200px 520px at 50% 0%, rgba(255,255,255,0.10) 0%, rgba(255,255,255,0) 60%);"></div>

  <div class="relative text-center px-6">
    <div class="gkka-intro__logo-wrap mx-auto">
      <img class="gkka-intro__logo" src="{{ asset('assets/logo.png') }}" alt="Logo GKKA">
    </div>
    <div class="mt-6 text-sm font-black tracking-[0.35em] text-white/80 uppercase">GKKA Indonesia</div>
    <div class="mt-2 text-3xl sm:text-4xl md:text-5xl font-black tracking-tight gkka-hero-title">
      Jemaat Samarinda
    </div>
    <button id="gkkaIntroSkip"
            class="mt-10 h-11 px-7 rounded-2xl bg-white/10 hover:bg-white/15 border border-white/15 text-white font-black shadow-sm transition inline-flex items-center justify-center">
      Masuk
    </button>
  </div>
</div>

{{-- HERO SECTION --}}
<section class="relative h-[100svh] min-h-[520px] w-full overflow-hidden">
  {{-- Background (slideshow) --}}
  <div class="absolute inset-0">
    <div id="gkkaHeroBgA" class="absolute inset-0 bg-blue-950 bg-no-repeat bg-cover bg-center scale-100 sm:scale-105 transition-opacity duration-1000 opacity-100"
         style="background-image:url('{{ $homeSlides[0]['src'] }}')"></div>
    <div id="gkkaHeroBgB" class="absolute inset-0 bg-blue-950 bg-no-repeat bg-cover bg-center scale-100 sm:scale-105 transition-opacity duration-1000 opacity-0"
         style="background-image:url('{{ $homeSlides[1]['src'] ?? $homeSlides[0]['src'] }}')"></div>

    <div class="absolute inset-0 bg-blue-900/55 mix-blend-multiply"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-blue-900/95 via-blue-900/30 to-transparent"></div>
  </div>

  {{-- Content --}}
  <div class="relative h-full gkka-container flex flex-col justify-center items-center text-center text-white z-10 pt-24 sm:pt-0 pb-10 sm:pb-0">
      <div class="font-black text-blue-200 tracking-widest uppercase mb-4 text-sm md:text-base animate-fade-in-up">
        Selamat Datang
      </div>
      <h1 class="text-3xl sm:text-4xl md:text-6xl lg:text-7xl font-black tracking-tight mb-6 leading-tight drop-shadow-lg animate-fade-in-up delay-100">
        GKKA Indonesia<br><span class="text-blue-200">Jemaat Samarinda</span>
      </h1>
      <p class="max-w-2xl text-base sm:text-lg md:text-xl text-blue-100 font-medium mb-10 leading-relaxed drop-shadow-md animate-fade-in-up delay-200">
        Informasi pelayanan, jadwal, komisi, event, dan dokumentasi kegiatan jemaat.
      </p>
      <div class="flex flex-wrap gap-4 justify-center animate-fade-in-up delay-300">
        <a href="{{ route('kontak') }}" class="px-8 py-3.5 rounded-full bg-yellow-500 text-blue-900 font-black shadow-xl hover:bg-yellow-400 hover:scale-105 transition-all duration-300">
          Hubungi Kami
        </a>
        <a href="{{ route('gereja.sejarah') }}" class="px-8 py-3.5 rounded-full bg-white text-blue-900 font-black shadow-xl hover:bg-gray-100 hover:scale-105 transition-all duration-300">
          Sejarah Gereja
        </a>
      </div>
  </div>
</section>

<script>
  (function () {
    const intro = document.getElementById('gkkaIntro');
    const skip = document.getElementById('gkkaIntroSkip');
    const prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const storageKey = 'gkka_intro_seen_session_v1';

    function initSejarahSlider() {
      const sejarahSlider = document.querySelector('[data-sejarah-slider]');
      const sejarahFrames = Array.from(document.querySelectorAll('[data-sejarah-slide]'));
      const sejarahPrev = document.querySelector('[data-sejarah-prev]');
      const sejarahNext = document.querySelector('[data-sejarah-next]');
      if (!sejarahSlider || sejarahFrames.length <= 1) return;

      let sejarahIndex = 0;
      let sejarahTimer = null;
      let touchStartX = null;
      let touchStartY = null;
      const swipeThreshold = 42;

      function renderSejarah(index) {
        const total = sejarahFrames.length;
        sejarahIndex = (index + total) % total;
        sejarahFrames.forEach((frame, i) => {
          const isActive = i === sejarahIndex;
          frame.style.opacity = isActive ? '1' : '0';
          frame.setAttribute('aria-hidden', isActive ? 'false' : 'true');
        });
      }

      function stopSejarahAuto() {
        if (!sejarahTimer) return;
        clearInterval(sejarahTimer);
        sejarahTimer = null;
      }

      function startSejarahAuto() {
        if (prefersReduced) return;
        stopSejarahAuto();
        sejarahTimer = setInterval(() => renderSejarah(sejarahIndex + 1), 4200);
      }

      if (sejarahPrev) {
        sejarahPrev.addEventListener('click', () => {
          renderSejarah(sejarahIndex - 1);
          startSejarahAuto();
        });
      }

      if (sejarahNext) {
        sejarahNext.addEventListener('click', () => {
          renderSejarah(sejarahIndex + 1);
          startSejarahAuto();
        });
      }

      sejarahSlider.addEventListener('mouseenter', stopSejarahAuto);
      sejarahSlider.addEventListener('mouseleave', startSejarahAuto);
      sejarahSlider.addEventListener('focusin', stopSejarahAuto);
      sejarahSlider.addEventListener('focusout', (e) => {
        if (e.relatedTarget && sejarahSlider.contains(e.relatedTarget)) return;
        startSejarahAuto();
      });
      sejarahSlider.addEventListener('touchstart', (e) => {
        stopSejarahAuto();
        const touch = e.changedTouches && e.changedTouches[0];
        if (!touch) return;
        touchStartX = touch.clientX;
        touchStartY = touch.clientY;
      }, { passive: true });
      sejarahSlider.addEventListener('touchend', (e) => {
        const touch = e.changedTouches && e.changedTouches[0];
        if (!touch || touchStartX === null || touchStartY === null) {
          startSejarahAuto();
          return;
        }
        const deltaX = touch.clientX - touchStartX;
        const deltaY = touch.clientY - touchStartY;
        touchStartX = null;
        touchStartY = null;

        if (Math.abs(deltaX) > swipeThreshold && Math.abs(deltaX) > Math.abs(deltaY)) {
          renderSejarah(sejarahIndex + (deltaX < 0 ? 1 : -1));
        }
        startSejarahAuto();
      }, { passive: true });
      sejarahSlider.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') {
          e.preventDefault();
          renderSejarah(sejarahIndex - 1);
          startSejarahAuto();
        } else if (e.key === 'ArrowRight') {
          e.preventDefault();
          renderSejarah(sejarahIndex + 1);
          startSejarahAuto();
        }
      });

      renderSejarah(0);
      startSejarahAuto();
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initSejarahSlider, { once: true });
    } else {
      initSejarahSlider();
    }

    function hideIntro() {
      if (!intro) return;
      try { sessionStorage.setItem(storageKey, '1'); } catch (e) {}
      intro.classList.add('is-leaving');
      setTimeout(() => intro.remove(), prefersReduced ? 0 : 560);
    }

    // Show intro only once per session/tab (so navigating to Media then back won't show again)
    let shouldShowIntro = Boolean(intro);
    if (intro) {
      let seen = false;
      try { seen = sessionStorage.getItem(storageKey) === '1'; } catch (e) {}
      if (seen) {
        intro.remove();
        shouldShowIntro = false;
      }
    }

    if (shouldShowIntro) {
      // Auto leave after a short intro (tap/click also works).
      // If user prefers reduced motion, don't auto-close; wait for click.
      const t = prefersReduced ? null : setTimeout(hideIntro, 1600);
      if (skip) skip.addEventListener('click', () => { if (t) clearTimeout(t); hideIntro(); });
      if (intro) intro.addEventListener('click', (e) => {
        if (e.target === intro) { if (t) clearTimeout(t); hideIntro(); }
      });
    }

    // Background slideshow
    const slides = @json($homeSlides);
    const a = document.getElementById('gkkaHeroBgA');
    const b = document.getElementById('gkkaHeroBgB');

    function applyHeroSlide(el, slide) {
      if (!el || !slide) return;
      const src = typeof slide === 'string' ? slide : slide.src;
      const isMobile = window.matchMedia('(max-width: 639px)').matches;
      const mobileSize = typeof slide === 'object' ? (slide.mobile_size || 'cover') : 'cover';
      const mobilePosition = typeof slide === 'object' ? (slide.mobile_position || 'center') : 'center';

      el.style.backgroundImage = `url('${src}')`;
      el.style.backgroundSize = isMobile ? mobileSize : 'cover';
      el.style.backgroundPosition = isMobile ? mobilePosition : 'center';
    }

    let aIndex = 0;
    let bIndex = slides && slides.length > 1 ? 1 : 0;
    const reapplyHeroSlides = () => {
      applyHeroSlide(a, slides[aIndex]);
      applyHeroSlide(b, slides[bIndex]);
    };

    if (slides && slides.length > 0 && a && b) {
      reapplyHeroSlides();
      window.addEventListener('resize', reapplyHeroSlides, { passive: true });
    }

    if (slides && slides.length > 1 && a && b && !prefersReduced) {
      let si = 1;
      let frontIsA = true;
      setInterval(() => {
        const front = frontIsA ? a : b;
        const back = frontIsA ? b : a;
        applyHeroSlide(back, slides[si]);
        back.style.opacity = '1';
        front.style.opacity = '0';
        if (frontIsA) {
          bIndex = si;
        } else {
          aIndex = si;
        }
        frontIsA = !frontIsA;
        si = (si + 1) % slides.length;
      }, 5200);
    }
  })();
</script>

{{-- MEDIA & WELCOME SECTION --}}
<section class="gkka-section-tight bg-gradient-to-b from-blue-50/50 to-white">
  <div class="gkka-container grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-12 items-center">
      
      {{-- Image --}}
      <div class="relative group">
        <div class="absolute inset-0 bg-blue-600 rounded-3xl rotate-3 opacity-20 group-hover:rotate-6 transition-transform duration-500"></div>
        <img src="{{ asset('img/doa.jpeg') }}" alt="GKKA Samarinda" class="relative w-full h-64 sm:h-80 lg:h-[420px] object-cover rounded-3xl shadow-2xl transform transition-transform duration-500 group-hover:-translate-y-2" onerror="this.onerror=null;this.src='{{ $heroImage }}';">
      </div>

      {{-- Video / Text --}}
      <div>
        <div class="w-full h-56 sm:h-72 md:h-[400px] rounded-3xl overflow-hidden shadow-2xl border-4 border-white bg-black/5">
          <iframe
            src="https://www.youtube.com/embed/mYXhv8ZUJa4?start=29&rel=0"
            title="YouTube video"
            class="w-full h-full"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
        </div>
      </div>

  </div>
</section>

{{-- SCHEDULES SECTION --}}
<section class="gkka-section bg-blue-900 text-white relative overflow-hidden">
  {{-- Background Photo --}}
  <div class="absolute inset-0">
    <img
      src="{{ asset('img/majelis potong kue.jpeg') }}"
      alt="GKKA Samarinda"
      class="w-full h-full object-cover object-center opacity-70"
      onerror="this.onerror=null;this.src='{{ asset('img/fotogrj.jpeg') }}';"
    >
    <div class="absolute inset-0 bg-blue-950/65 mix-blend-multiply"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-blue-950/80 via-blue-900/55 to-blue-900/80"></div>
  </div>

  {{-- Background Decoration --}}
  <div class="absolute top-0 left-0 w-full h-full opacity-15 pointer-events-none">
     <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-400 rounded-full blur-3xl"></div>
     <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-blue-600 rounded-full blur-3xl"></div>
  </div>

  <div class="gkka-container relative z-10">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
      
      {{-- JADWAL KOMISI --}}
      <div class="group relative rounded-3xl overflow-hidden bg-white/10 border border-white/20 shadow-2xl backdrop-blur-xl hover:border-white/40 transition-colors duration-300">
        <div class="absolute inset-0 bg-gradient-to-br from-white/10 via-blue-900/60 to-blue-800/70 z-0"></div>
        <div class="absolute inset-0 bg-white/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
        <div class="relative z-10 p-6 sm:p-8">
          <h2 class="text-2xl font-black uppercase tracking-wider mb-8 flex items-center gap-3">
            <span class="w-2 h-8 bg-yellow-500 rounded-full"></span>
            Jadwal Komisi
          </h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="space-y-2">
              <h3 class="font-bold text-yellow-400 text-lg">Komisi Wanita Rut</h3>
              <p class="text-blue-100 text-sm leading-relaxed">
                Ibadah sebulan sekali<br>
                Minggu ke-2<br>
                Setelah Kebaktian Umum di gereja
              </p>
            </div>
            <div class="space-y-2">
              <h3 class="font-bold text-yellow-400 text-lg">Komisi Sekolah Minggu Narwastu</h3>
              <p class="text-blue-100 text-sm leading-relaxed">
                Tiap Hari Minggu<br>
                09.00 WITA<br>
                di gereja
              </p>
            </div>
            <div class="space-y-2">
              <h3 class="font-bold text-yellow-400 text-lg">Komisi Remaja Betania</h3>
              <p class="text-blue-100 text-sm leading-relaxed">
                Tiap Hari Minggu<br>
                09.00 WITA • di gereja<br>
                Minggu ke-1: gabung Kebaktian Umum<br>
                Minggu ke-2 s/d terakhir: ibadah remaja
              </p>
            </div>
            <div class="space-y-2">
              <h3 class="font-bold text-yellow-400 text-lg">Komisi Pemuda Eirene</h3>
              <p class="text-blue-100 text-sm leading-relaxed">
                Tiap Hari Sabtu<br>
                18.00 WITA<br>
                di gereja
              </p>
            </div>
            <div class="space-y-2 sm:col-span-2">
              <h3 class="font-bold text-yellow-400 text-lg">Komisi Pria Hizkia</h3>
              <p class="text-blue-100 text-sm leading-relaxed">
                Ibadah sebulan sekali<br>
                (hari &amp; jam menyusul)
              </p>
            </div>
          </div>
        </div>
      </div>

      {{-- JADWAL IBADAH --}}
      <div class="group relative rounded-3xl overflow-hidden bg-white/10 border border-white/20 shadow-2xl backdrop-blur-xl hover:border-white/40 transition-colors duration-300">
        <div class="absolute inset-0 bg-gradient-to-br from-white/10 via-blue-900/60 to-blue-800/70 z-0"></div>
        <div class="absolute inset-0 bg-white/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
        <div class="relative z-10 p-6 sm:p-8">
          <h2 class="text-2xl font-black uppercase tracking-wider mb-8 flex items-center gap-3">
            <span class="w-2 h-8 bg-yellow-500 rounded-full"></span>
            Jadwal Ibadah
          </h2>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="space-y-2">
              <h3 class="font-bold text-white text-lg">Ibadah Umum</h3>
              <p class="text-blue-100 text-sm leading-relaxed">
                Tiap Hari Minggu<br>
                <span class="font-semibold text-yellow-400">09.00 WITA</span>
              </p>
            </div>
            <div class="space-y-2">
              <h3 class="font-bold text-white text-lg">Sekolah Minggu “Narwastu”</h3>
              <p class="text-blue-100 text-sm leading-relaxed">
                Tiap Hari Minggu<br>
                <span class="font-semibold text-yellow-400">09.00 WITA</span>
              </p>
            </div>
            <div class="space-y-2">
              <h3 class="font-bold text-white text-lg">Ibadah Rumah Tangga</h3>
              <p class="text-blue-100 text-sm leading-relaxed">
                Tiap Hari Kamis<br>
                <span class="font-semibold text-yellow-400">19.00 WITA</span>
              </p>
            </div>
            <div class="space-y-2">
              <h3 class="font-bold text-white text-lg">Persekutuan Doa</h3>
              <p class="text-blue-100 text-sm leading-relaxed">
                Tiap Hari Sabtu<br>
                <span class="font-semibold text-yellow-400">17.00 WITA</span>
              </p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- SEJARAH SIMPLE --}}
<section class="gkka-section bg-white">
  <div class="gkka-container">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
      <div class="relative" data-sejarah-slider tabindex="0">
         <div class="absolute -inset-4 bg-blue-100 rounded-3xl -rotate-2"></div>
         <div class="relative w-full h-64 sm:h-80 lg:h-[420px] overflow-hidden rounded-3xl shadow-xl">
           @foreach($sejarahSlides as $slide)
             <img
               src="{{ $slide['src'] }}"
               alt="{{ $slide['alt'] }}"
               data-sejarah-slide="{{ $loop->index }}"
               class="absolute inset-0 w-full h-full object-cover object-center transition-opacity duration-700 {{ $loop->first ? 'opacity-100' : 'opacity-0' }}"
               loading="{{ $loop->first ? 'eager' : 'lazy' }}"
               aria-hidden="{{ $loop->first ? 'false' : 'true' }}"
             >
           @endforeach
           <div class="absolute inset-0 bg-gradient-to-t from-blue-900/20 via-transparent to-transparent pointer-events-none"></div>
         </div>

         <button
           type="button"
           data-sejarah-prev
           class="absolute z-30 top-1/2 -translate-y-1/2 -left-4 sm:-left-5 lg:-left-6 inline-flex items-center justify-center w-10 h-10 sm:w-11 sm:h-11 rounded-full border border-blue-800/70 bg-blue-50/85 text-blue-800 backdrop-blur-md shadow-[0_10px_20px_rgba(30,64,175,0.20)] hover:bg-white hover:scale-105 active:scale-95 transition-all duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-300"
           aria-label="Foto sejarah sebelumnya"
         >
           <svg class="w-4 h-4 sm:w-5 sm:h-5 rotate-180" viewBox="0 0 20 20" fill="none" aria-hidden="true">
             <path d="M7.5 4.5L13 10l-5.5 5.5" stroke="currentColor" stroke-width="2.1" stroke-linecap="round" stroke-linejoin="round"/>
           </svg>
         </button>

         <button
           type="button"
           data-sejarah-next
           class="absolute z-30 top-1/2 -translate-y-1/2 -right-4 sm:-right-5 lg:-right-6 inline-flex items-center justify-center w-10 h-10 sm:w-11 sm:h-11 rounded-full border border-blue-800/70 bg-blue-50/85 text-blue-800 backdrop-blur-md shadow-[0_10px_20px_rgba(30,64,175,0.20)] hover:bg-white hover:scale-105 active:scale-95 transition-all duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-300"
           aria-label="Foto sejarah berikutnya"
         >
           <svg class="w-4 h-4 sm:w-5 sm:h-5" viewBox="0 0 20 20" fill="none" aria-hidden="true">
             <path d="M7.5 4.5L13 10l-5.5 5.5" stroke="currentColor" stroke-width="2.1" stroke-linecap="round" stroke-linejoin="round"/>
           </svg>
         </button>
      </div>
      <div>
        <h2 class="text-3xl md:text-4xl font-black text-blue-900 mb-6">Sejarah Gereja</h2>
        <p class="text-slate-600 text-lg leading-relaxed mb-8">
           Ringkasan sejarah berdirinya GKKA Indonesia Jemaat Samarinda. Silakan lengkapi isi sesuai data gereja.
        </p>
        
        <div class="space-y-4">
           <details class="group p-4 bg-blue-50 rounded-2xl cursor-pointer open:bg-blue-100 transition-colors">
              <summary class="font-black text-blue-900 text-lg list-none flex justify-between items-center">
                Visi
                <span class="transform group-open:rotate-180 transition-transform">▼</span>
              </summary>
              <div class="mt-3 text-slate-700 font-medium">Menjadi jemaat yang bertumbuh dalam iman, kasih, dan pelayanan.</div>
           </details>
           <details class="group p-4 bg-blue-50 rounded-2xl cursor-pointer open:bg-blue-100 transition-colors">
              <summary class="font-black text-blue-900 text-lg list-none flex justify-between items-center">
                Misi
                <span class="transform group-open:rotate-180 transition-transform">▼</span>
              </summary>
              <div class="mt-3 text-slate-700 font-medium">Membangun persekutuan, pemuridan, dan penginjilan yang berdampak.</div>
           </details>
        </div>

        <div class="mt-8">
           <a href="{{ route('gereja.sejarah') }}" class="inline-flex items-center gap-2 font-bold text-blue-600 hover:text-blue-800 transition-colors">
             Lihat Selengkapnya <span class="text-xl">→</span>
           </a>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- MAJELIS SECTION --}}
<section class="gkka-section majelis-pattern-bg">
  <div class="gkka-container">
    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-12">
      <div>
        <h2 class="text-3xl md:text-4xl font-black text-blue-900">Majelis GKKA Samarinda</h2>
        <p class="mt-2 text-slate-600 font-medium">Klik kartu untuk melihat “About Majelis”.</p>
      </div>
      <a href="{{ route('gereja.majelis') }}" class="inline-flex items-center gap-2 font-black text-blue-600 hover:text-blue-800 transition-colors">
        Lihat Semua <span class="text-xl">→</span>
      </a>
    </div>

    @if(isset($majelisPeriods) && $majelisPeriods->isNotEmpty())
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($majelisPeriods as $p)
          @php
            $thumb = $p->thumbnail_path ? asset('storage/'.$p->thumbnail_path) : asset('assets/logo.png');
          @endphp
          <a href="{{ route('gereja.majelis.show', ['period' => $p->period]) }}"
             class="group block bg-white rounded-3xl overflow-hidden shadow-xl border border-gray-100 hover:-translate-y-1 hover:shadow-2xl transition-all duration-300">
            <div class="h-44 overflow-hidden relative bg-white">
              <img src="{{ $thumb }}" alt="Periode {{ $p->period }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
              <div class="absolute inset-0 bg-blue-900/0 group-hover:bg-blue-900/15 transition-colors duration-300"></div>
            </div>
            <div class="p-6">
              <div class="flex items-center justify-between gap-3 mb-2">
                <div class="text-xs font-black uppercase tracking-wider text-blue-700 bg-blue-50 px-3 py-1 rounded-full">
                  Periode
                </div>
                <div class="text-xs font-bold text-slate-500">{{ $p->period }}</div>
              </div>
              <h3 class="text-lg font-black text-slate-900 group-hover:text-blue-700 transition-colors">Majelis Periode {{ $p->period }}</h3>
              @if(!empty($p->about))
                <p class="mt-2 text-slate-600 font-medium leading-relaxed line-clamp-2">{{ $p->about }}</p>
              @endif
            </div>
          </a>
        @endforeach
      </div>
    @else
      <div class="bg-slate-50 rounded-3xl border border-gray-100 p-10 text-center text-slate-500 font-bold">
        Data periode majelis belum tersedia.
      </div>
    @endif
  </div>
</section>

{{-- KOMISI SECTION --}}
<section class="gkka-section bg-slate-50">
  <div class="gkka-container">
    <h2 class="text-center text-3xl md:text-4xl font-black text-blue-900 mb-12">Komisi GKKA Samarinda</h2>

    @php
      $komisiCards = [
        [
          'label' => 'Komisi',
          'title' => 'Komisi Sekolah Minggu Narwastu',
          'date' => 'Pelayanan anak & keluarga',
          'excerpt' => 'Mendampingi pertumbuhan iman anak melalui pengajaran firman, ibadah, dan kegiatan pembinaan.',
          'image' => asset('img/sekolah minggu.jpeg'),
        ],
        [
          'label' => 'Komisi',
          'title' => 'Komisi Remaja Betania',
          'date' => 'Pembinaan remaja',
          'excerpt' => 'Ruang bertumbuh bersama, pemuridan, dan pelayanan bagi remaja di GKKA Samarinda.',
          'image' => asset('img/remajaa.jpeg'),
        ],
        [
          'label' => 'Komisi',
          'title' => 'Komisi Pemuda Eirene',
          'date' => 'Pembinaan pemuda',
          'excerpt' => 'Persekutuan, pemuridan, dan pelayanan bersama untuk pemuda di GKKA Samarinda.',
          'image' => asset('img/pemuda.jpeg'),
        ],
        [
          'label' => 'Komisi',
          'title' => 'Komisi Wanita Rut',
          'date' => 'Persekutuan wanita',
          'excerpt' => 'Persekutuan, doa, dan pelayanan yang menguatkan keluarga serta jemaat melalui karya kasih.',
          'image' => asset('img/komisiwanita.jpeg'),
        ],
        [
          'label' => 'Komisi',
          'title' => 'Komisi Pria Hizkia',
          'date' => 'Pembinaan pria',
          'excerpt' => 'Membangun karakter, keteladanan, dan kepekaan pelayanan melalui firman dan persekutuan.',
          'image' => asset('img/komisi bapapk.jpeg'),
        ],
      ];
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
      @foreach($komisiCards as $card)
        <x-komisi-card
          variant="detailed"
          :href="route('gereja.komisi')"
          :title="$card['title']"
          :image="$card['image']"
          :label="$card['label']"
          :meta="$card['date']"
          :excerpt="$card['excerpt']"
        />
      @endforeach
    </div>
  </div>
</section>

{{-- EVENTS SECTION --}}
<section class="gkka-section bg-white">
  <div class="gkka-container">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-end gap-4 mb-12">
       <h2 class="text-3xl md:text-4xl font-black text-blue-900">Event Terbaru</h2>
       <a href="{{ route('event') }}" class="font-bold text-blue-600 hover:text-blue-800 transition-colors">Lihat Semua Event →</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-[1.65fr_1fr] gap-10">
       {{-- Featured Event --}}
       <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden group">
         @if(!empty($featuredEvent))
           @php
             $thumb = $featuredEvent->thumbnail_path
               ? asset('storage/'.$featuredEvent->thumbnail_path)
               : ($featuredEvent->photo_path ? asset('storage/'.$featuredEvent->photo_path) : asset('assets/logo.png'));
           @endphp
           <a href="{{ route('event.show', $featuredEvent) }}" class="block">
             <div class="h-[300px] md:h-[400px] w-full bg-cover bg-center group-hover:scale-105 transition-transform duration-700" style="background-image:url('{{ $thumb }}');"></div>
             <div class="relative p-8 bg-white z-10 -mt-10 mx-6 rounded-2xl shadow-lg border border-gray-100">
                <div class="flex items-center gap-3 text-sm font-bold text-gray-500 mb-3">
                   @if($featuredEvent->start_date)
                     <span class="text-blue-600">{{ optional($featuredEvent->start_date)->translatedFormat('d F Y') }}</span>
                   @endif
                   @if($featuredEvent->location)
                     <span>•</span> <span>{{ $featuredEvent->location }}</span>
                   @endif
                </div>
                <h3 class="text-2xl font-black text-slate-800 mb-4 group-hover:text-blue-700 transition-colors">{{ $featuredEvent->title }}</h3>
                @if($featuredEvent->description)
                  <p class="text-slate-600 line-clamp-3">{{ \Illuminate\Support\Str::limit($featuredEvent->description, 160) }}</p>
                @endif
             </div>
           </a>
         @else
           <div class="p-12 text-center text-gray-400 font-bold bg-gray-50">
             Belum ada event yang dipublish.
           </div>
         @endif
       </div>

       {{-- Side List --}}
       <aside class="space-y-6">
          <h3 class="font-black text-xl text-blue-900 mb-6 border-l-4 border-yellow-500 pl-4">Last Post</h3>
          <div class="space-y-4">
            @forelse(($eventList ?? collect()) as $it)
              @php
                $thumb = $it->thumbnail_path
                  ? asset('storage/'.$it->thumbnail_path)
                  : ($it->photo_path ? asset('storage/'.$it->photo_path) : asset('assets/logo.png'));
              @endphp
              <a href="{{ route('event.show', $it) }}" class="flex gap-4 p-3 rounded-2xl bg-white hover:bg-blue-50 border border-gray-100 hover:border-blue-200 transition-all duration-300 group">
                <div class="w-24 h-24 rounded-xl bg-cover bg-center flex-shrink-0 group-hover:shadow-md transition-shadow" style="background-image:url('{{ $thumb }}');"></div>
                <div class="flex flex-col justify-center">
                  <h4 class="font-bold text-slate-800 group-hover:text-blue-700 mb-1">{{ $it->title }}</h4>
                  <div class="text-xs font-bold text-gray-400">
                     @if($it->start_date)
                       {{ optional($it->start_date)->translatedFormat('d M Y') }}
                     @else
                       -
                     @endif
                  </div>
                </div>
              </a>
            @empty
              <div class="text-gray-400 text-sm font-bold p-4 text-center">Belum ada event lainnya.</div>
            @endforelse
          </div>
       </aside>
    </div>
  </div>
</section>

{{-- CTA SECTION --}}
<section class="py-20 sm:py-24 bg-blue-900 relative overflow-hidden text-center text-white">
   <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
   <div class="relative z-10 max-w-3xl mx-auto px-4 sm:px-6">
      <h2 class="text-3xl md:text-5xl font-black mb-8 tracking-tight">Temukan kekuatan iman &<br>Pertumbuhan Rohani</h2>
      <a href="{{ route('kontak') }}" class="inline-block px-10 py-4 rounded-full bg-yellow-500 text-blue-900 font-black text-lg shadow-xl hover:bg-yellow-400 hover:scale-105 transition-all duration-300">
        Hubungi Kami
      </a>
   </div>
</section>

@endsection
