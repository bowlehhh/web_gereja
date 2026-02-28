<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','GKKA Samarinda')</title>

  @php
    $metaSiteName = config('app.name', 'GKKA Samarinda');
    $seo = config('seo', []);
    $homeUrl = rtrim(url('/'), '/');
    $logoPath = trim((string) ($seo['logo_path'] ?? 'assets/logo.png'));
    $logoUrl = asset($logoPath);

    $metaTitle = trim($__env->yieldContent('meta_title'));
    if ($metaTitle === '') {
      $metaTitle = trim($__env->yieldContent('title', $metaSiteName));
    }
    $metaDescription = trim($__env->yieldContent('meta_description', 'Situs resmi GKKA Indonesia Jemaat Samarinda. Informasi ibadah, event, warta jemaat, media, galeri, dan pelayanan.'));
    $metaImage = $logoUrl;
    $metaUrl = trim($__env->yieldContent('canonical', url()->current()));
    $metaType = trim($__env->yieldContent('meta_type', 'website'));

    $organizationName = trim((string) ($seo['organization_name'] ?? $metaSiteName));
    $legalName = trim((string) ($seo['legal_name'] ?? $organizationName));
    $phone = trim((string) ($seo['phone'] ?? ''));
    $email = trim((string) ($seo['email'] ?? ''));
    $priceRange = trim((string) ($seo['price_range'] ?? ''));
    $mapUrl = trim((string) ($seo['map_url'] ?? ''));
    $sameAs = $seo['same_as'] ?? [];
    if (!is_array($sameAs)) {
      $sameAs = [];
    }
    $sameAs = array_values(array_filter(array_map(fn ($item) => is_string($item) ? trim($item) : '', $sameAs)));

    $address = $seo['address'] ?? [];
    if (!is_array($address)) {
      $address = [];
    }
    $streetAddress = trim((string) ($address['street'] ?? ''));
    $addressLocality = trim((string) ($address['locality'] ?? ''));
    $addressRegion = trim((string) ($address['region'] ?? ''));
    $postalCode = trim((string) ($address['postal_code'] ?? ''));
    $addressCountry = trim((string) ($address['country'] ?? 'ID'));

    $geo = $seo['geo'] ?? [];
    if (!is_array($geo)) {
      $geo = [];
    }
    $latitude = trim((string) ($geo['latitude'] ?? ''));
    $longitude = trim((string) ($geo['longitude'] ?? ''));

    $isHome = rtrim($metaUrl, '/') === $homeUrl;
    $breadcrumbTitle = trim($__env->yieldContent('breadcrumb_title'));
    if ($breadcrumbTitle === '') {
      $breadcrumbTitle = preg_replace('/\s+\|\s+.*/', '', $metaTitle);
      if (!is_string($breadcrumbTitle) || trim($breadcrumbTitle) === '') {
        $breadcrumbTitle = $metaSiteName;
      }
    }
    $breadcrumbs = [
      ['name' => $metaSiteName, 'item' => $homeUrl],
    ];
    if (! $isHome) {
      $breadcrumbs[] = ['name' => $breadcrumbTitle, 'item' => $metaUrl];
    }

    $schemaOrg = [
      '@context' => 'https://schema.org',
      '@type' => 'Organization',
      '@id' => $homeUrl.'#organization',
      'name' => $organizationName,
      'legalName' => $legalName,
      'url' => $homeUrl,
      'logo' => $logoUrl,
      'email' => $email !== '' ? $email : null,
      'telephone' => $phone !== '' ? $phone : null,
      'sameAs' => !empty($sameAs) ? $sameAs : null,
    ];
    $schemaOrg = array_filter($schemaOrg, fn ($value) => $value !== null && $value !== []);

    $schemaChurch = [
      '@context' => 'https://schema.org',
      '@type' => ['Church', 'LocalBusiness'],
      '@id' => $homeUrl.'#church',
      'name' => $organizationName,
      'url' => $homeUrl,
      'image' => $logoUrl,
      'logo' => $logoUrl,
      'description' => $metaDescription,
      'email' => $email !== '' ? $email : null,
      'telephone' => $phone !== '' ? $phone : null,
      'priceRange' => $priceRange !== '' ? $priceRange : null,
      'hasMap' => $mapUrl !== '' ? $mapUrl : null,
      'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => $streetAddress,
        'addressLocality' => $addressLocality,
        'addressRegion' => $addressRegion,
        'postalCode' => $postalCode,
        'addressCountry' => $addressCountry,
      ],
      'geo' => ($latitude !== '' && $longitude !== '') ? [
        '@type' => 'GeoCoordinates',
        'latitude' => $latitude,
        'longitude' => $longitude,
      ] : null,
      'sameAs' => !empty($sameAs) ? $sameAs : null,
    ];
    $schemaChurch['address'] = array_filter($schemaChurch['address'], fn ($value) => $value !== '');
    $schemaChurch = array_filter($schemaChurch, fn ($value) => $value !== null && $value !== []);

    $schemaWebsite = [
      '@context' => 'https://schema.org',
      '@type' => 'WebSite',
      '@id' => $homeUrl.'#website',
      'name' => $organizationName,
      'url' => $homeUrl,
      'publisher' => ['@id' => $homeUrl.'#organization'],
      'potentialAction' => [
        '@type' => 'SearchAction',
        'target' => $homeUrl.'/media?q={search_term_string}',
        'query-input' => 'required name=search_term_string',
      ],
    ];

    $schemaBreadcrumb = [
      '@context' => 'https://schema.org',
      '@type' => 'BreadcrumbList',
      'itemListElement' => array_map(function ($item, $index) {
        return [
          '@type' => 'ListItem',
          'position' => $index + 1,
          'name' => $item['name'],
          'item' => $item['item'],
        ];
      }, $breadcrumbs, array_keys($breadcrumbs)),
    ];
  @endphp
  @php
    $faviconVersion = @filemtime(public_path('favicon.ico')) ?: time();
  @endphp
  <meta name="description" content="{{ $metaDescription }}">
  <meta name="robots" content="@yield('meta_robots', 'index,follow')">
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v={{ $faviconVersion }}">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v={{ $faviconVersion }}">
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
  <script type="application/ld+json">{!! json_encode($schemaChurch, JSON_UNESCAPED_SLASHES) !!}</script>
  <script type="application/ld+json">{!! json_encode($schemaWebsite, JSON_UNESCAPED_SLASHES) !!}</script>
  <script type="application/ld+json">{!! json_encode($schemaBreadcrumb, JSON_UNESCAPED_SLASHES) !!}</script>

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
