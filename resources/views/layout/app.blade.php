<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','GKKA Samarinda')</title>

  @php
    $metaSiteName = config('app.name', 'GKKA Samarinda');
    $metaTitle = trim($__env->yieldContent('meta_title'));
    if ($metaTitle === '') {
      $metaTitle = trim($__env->yieldContent('title', $metaSiteName));
    }
    $metaDescription = trim($__env->yieldContent('meta_description', 'Situs resmi GKKA Indonesia Jemaat Samarinda. Informasi ibadah, event, warta jemaat, media, galeri, dan pelayanan.'));
    $metaImage = trim($__env->yieldContent('meta_image', asset('img/fotogrj.jpeg')));
    $metaUrl = trim($__env->yieldContent('canonical', url()->current()));
    $metaType = trim($__env->yieldContent('meta_type', 'website'));
    $schemaOrg = [
      '@context' => 'https://schema.org',
      '@type' => 'Organization',
      'name' => $metaSiteName,
      'url' => url('/'),
      'logo' => asset('assets/logo.png'),
    ];
    $schemaWebsite = [
      '@context' => 'https://schema.org',
      '@type' => 'WebSite',
      'name' => $metaSiteName,
      'url' => url('/'),
      'potentialAction' => [
        '@type' => 'SearchAction',
        'target' => url('/media').'?q={search_term_string}',
        'query-input' => 'required name=search_term_string',
      ],
    ];
  @endphp
  @php
    $faviconVersion = @filemtime(public_path('favicon.ico')) ?: time();
  @endphp
  <meta name="description" content="{{ $metaDescription }}">
  <meta name="robots" content="@yield('meta_robots', 'index,follow')">
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v={{ $faviconVersion }}">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v={{ $faviconVersion }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/logo.png') }}?v={{ $faviconVersion }}">
  <link rel="canonical" href="{{ $metaUrl }}">
  <meta property="og:locale" content="id_ID">
  <meta property="og:type" content="{{ $metaType }}">
  <meta property="og:title" content="{{ $metaTitle }}">
  <meta property="og:description" content="{{ $metaDescription }}">
  <meta property="og:url" content="{{ $metaUrl }}">
  <meta property="og:site_name" content="{{ $metaSiteName }}">
  <meta property="og:image" content="{{ $metaImage }}">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="{{ $metaTitle }}">
  <meta name="twitter:description" content="{{ $metaDescription }}">
  <meta name="twitter:image" content="{{ $metaImage }}">
  <link rel="sitemap" type="application/xml" title="Sitemap" href="{{ url('/sitemap.xml') }}">
  <script type="application/ld+json">{!! json_encode($schemaOrg, JSON_UNESCAPED_SLASHES) !!}</script>
  <script type="application/ld+json">{!! json_encode($schemaWebsite, JSON_UNESCAPED_SLASHES) !!}</script>

  {{-- SATU CSS SAJA --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  @stack('styles')
  @stack('meta')
  
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
