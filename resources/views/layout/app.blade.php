<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'GKKA Samarinda')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>
<body>

    {{-- INTRO FULLSCREEN --}}
    <div id="intro" class="intro-screen">
        <div class="intro-bg"></div>
        <div class="intro-overlay"></div>

        <div class="intro-content">
            <div class="intro-script">Welcome Home</div>
            <div class="intro-big">Selamat Datang</div>
            <div class="intro-sub">di Website GKKA Indonesia Jemaat Samarinda</div>
            <button type="button" class="intro-skip" id="introSkip">Lewati</button>
        </div>
    </div>

    {{-- HEADER / NAVBAR (JANGAN HILANG) --}}
    <header class="site-header">
        <div class="nav-wrap">
            <div class="nav-inner container">
                <a class="brand" href="{{ route('home') }}">
                    <div class="brand-mark">GKKA</div>
                    <div>
                        <div class="brand-title">GKKA Indonesia</div>
                        <div class="brand-sub">Jemaat Samarinda</div>
                    </div>
                </a>

                <button class="mobile-btn" id="navBtn" type="button">☰</button>

                {{-- NAVBAR FIX: SEMUA LINK PAKAI ROUTE --}}
                <nav class="nav" id="navMenu">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        BERANDA
                    </a>

                    <a class="nav-link {{ request()->routeIs('gereja') ? 'active' : '' }}" href="{{ route('gereja') }}">
                        GEREJA
                    </a>

                    <a class="nav-link {{ request()->routeIs('event') ? 'active' : '' }}" href="{{ route('event') }}">
                        EVENT
                    </a>

                    <a class="nav-link {{ request()->routeIs('news') ? 'active' : '' }}" href="{{ route('news') }}">
                        NEWS
                    </a>

                    <a class="nav-link {{ request()->routeIs('media') ? 'active' : '' }}" href="{{ route('media') }}">
                        MEDIA
                    </a>

                    <a class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}" href="{{ route('gallery') }}">
                        GALLERY
                    </a>

                    <a class="nav-link {{ request()->routeIs('warta') ? 'active' : '' }}" href="{{ route('warta') }}">
                        WARTA JEMAAT
                    </a>

                    <a class="nav-link {{ request()->routeIs('kontak') ? 'active' : '' }}" href="{{ route('kontak') }}">
                        KONTAK
                    </a>
                </nav>
            </div>
        </div>
    </header>

    {{-- CONTENT --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="footer">
        <div class="container footer-inner">
            <div>
                <div class="footer-logo">GKKA</div>
                <div class="footer-name">GKKA Indonesia Jemaat Samarinda</div>
                <div class="footer-muted">© {{ date('Y') }}</div>
            </div>
        </div>
    </footer>

    <script>
        // ===== MOBILE NAV TOGGLE =====
        (function () {
            const btn = document.getElementById('navBtn');
            const nav = document.getElementById('navMenu');
            if (!btn || !nav) return;
            btn.addEventListener('click', () => nav.classList.toggle('is-open'));
        })();

        // ===== INTRO (FULL) =====
        (function () {
            const intro = document.getElementById('intro');
            const skipBtn = document.getElementById('introSkip');
            if (!intro) return;

            function hideIntro() {
                intro.classList.add('is-hide');
                sessionStorage.setItem('intro_seen', '1');

                setTimeout(() => {
                    intro.style.display = 'none';
                    document.body.style.overflow = ''; // BALIKIN SCROLL
                }, 800);
            }

            // kalau sudah pernah lihat intro, jangan tampilkan lagi
            if (sessionStorage.getItem('intro_seen') === '1') {
                intro.style.display = 'none';
                document.body.style.overflow = '';
            } else {
                // blok scroll hanya saat intro tampil
                document.body.style.overflow = 'hidden';

                // auto hide setelah 2.5 detik
                setTimeout(hideIntro, 2500);
            }

            if (skipBtn) skipBtn.addEventListener('click', hideIntro);
        })();

        // ===== SCROLL REVEAL =====
        (function () {
            const revealEls = document.querySelectorAll('.reveal');
            if (!revealEls.length) return;

            if ('IntersectionObserver' in window) {
                const io = new IntersectionObserver((entries) => {
                    entries.forEach((e) => {
                        if (e.isIntersecting) e.target.classList.add('is-visible');
                    });
                }, { threshold: 0.12 });

                revealEls.forEach(el => io.observe(el));
            } else {
                revealEls.forEach(el => el.classList.add('is-visible'));
            }
        })();
    </script>

</body>
</html>
