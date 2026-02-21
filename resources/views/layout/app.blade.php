<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','GKKA Samarinda')</title>

  {{-- SATU CSS SAJA --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  @stack('styles')
  
</head>
<body class="min-h-screen min-h-[100svh] flex flex-col overflow-x-hidden @yield('body_class')">

@include('components.navbar')

<main class="flex-1">
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

<script src="https://unpkg.com/lucide@latest"></script>

@stack('scripts')
</body>
</html>
