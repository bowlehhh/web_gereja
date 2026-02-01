<header class="site-header">
    <div class="nav-wrap">
        <div class="container nav-inner">
            <a href="{{ route('home') }}" class="brand">
                <div class="brand-mark">GKKA</div>
                <div class="brand-text">
                    <div class="brand-title">GKKA Indonesia</div>
                    <div class="brand-sub">Jemaat Samarinda</div>
                </div>
            </a>

            <button class="mobile-btn" type="button" data-mobile-toggle aria-label="Buka Menu">
                ☰
            </button>

            <nav class="nav" data-mobile-nav>
                <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">BERANDA</a>

                <div class="nav-dd">
                    <a class="nav-link {{ request()->routeIs('sejarah','hamba_tuhan','majelis_komisi') ? 'active' : '' }}" href="#">
                        GEREJA <span class="chev">▾</span>
                    </a>
                    <div class="dd-menu">
                        <a href="{{ route('sejarah') }}">SEJARAH</a>
                        <a href="{{ route('hamba_tuhan') }}">HAMBA TUHAN</a>
                        <a href="{{ route('majelis_komisi') }}">MAJELIS & KOMISI</a>
                    </div>
                </div>

                <div class="nav-dd">
                    <a class="nav-link {{ request()->routeIs('event','warta') ? 'active' : '' }}" href="#">
                        EVENT & NEWS <span class="chev">▾</span>
                    </a>
                    <div class="dd-menu">
                        <a href="{{ route('event') }}">EVENT</a>
                        <a href="{{ route('warta') }}">WARTA JEMAAT</a>
                        <a href="{{ route('warta') }}">ARTIKEL</a>
                        <a href="{{ route('warta') }}">RENUNGAN</a>
                    </div>
                </div>

                <a class="nav-link {{ request()->routeIs('media') ? 'active' : '' }}" href="{{ route('media') }}">MEDIA</a>
                <a class="nav-link {{ request()->routeIs('kontak') ? 'active' : '' }}" href="{{ route('kontak') }}">KONTAK</a>
                <a class="nav-link {{ request()->routeIs('galeri') ? 'active' : '' }}" href="{{ route('galeri') }}">GALLERY</a>
                <a class="nav-link {{ request()->routeIs('warta') ? 'active' : '' }}" href="{{ route('warta') }}">WARTA JEMAAT</a>
            </nav>
        </div>
    </div>
</header>
