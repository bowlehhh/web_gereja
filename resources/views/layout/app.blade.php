<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','GKKA Samarinda')</title>

  {{-- SATU CSS SAJA --}}
  <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

</head>
<body class="@yield('body_class')">

<header class="topbar">
  <div class="container">
    <div class="nav-wrap">

      <a class="brand" href="{{ route('home') }}">
        <img src="{{ asset('assets/logo.png') }}" class="brand-logo">
        <div class="brand-text">
          <div class="brand-title">GKKA Indonesia</div>
          <div class="brand-sub">Jemaat Samarinda</div>
        </div>
      </a>

      <nav class="nav">
        <a href="{{ route('home') }}">BERANDA</a>

        <div class="nav-drop">
          <a href="{{ route('gereja') }}">GEREJA <span class="nav-chev">▼</span></a>
          <div class="nav-drop-menu">
            <a href="{{ route('gereja.sejarah') }}">SEJARAH</a>
            <a href="{{ route('gereja.hamba') }}">HAMBA TUHAN</a>
            <a href="{{ route('gereja.majelis') }}">MAJELIS</a>
            <a href="{{ route('gereja.komisi') }}">KOMISI</a>
          </div>
        </div>

        <a href="{{ route('event') }}">EVENT</a>

        <a href="{{ route('media') }}">MEDIA</a>
        <a href="{{ route('kontak') }}">KONTAK</a>
        <a href="{{ route('gallery') }}">GALLERY</a>
        <a href="{{ route('warta') }}">WARTA JEMAAT</a>

        @auth
          <a href="{{ route('admin.dashboard') }}">DASHBOARD</a>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="nav-logout-btn">LOGOUT</button>
          </form>
        @else
          <a href="{{ route('login') }}">LOGIN</a>
        @endauth
      </nav>

    </div>
  </div>
</header>

<main>
  @yield('content')
</main>

@include('partials.footer')

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const els = Array.from(document.querySelectorAll('.reveal'));
    if (els.length === 0) return;

    if (!('IntersectionObserver' in window)) {
      els.forEach(el => el.classList.add('is-visible'));
      return;
    }

    const io = new IntersectionObserver((entries, obs) => {
      for (const e of entries) {
        if (e.isIntersecting) {
          e.target.classList.add('is-visible');
          obs.unobserve(e.target);
        }
      }
    }, { threshold: 0.12 });

    els.forEach(el => io.observe(el));
  });
</script>

</body>
</html>
