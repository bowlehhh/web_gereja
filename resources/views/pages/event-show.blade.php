@extends('layout.app')

@section('title', $item->title.' | Event GKKA Samarinda')
@php
  $metaDescription = trim((string) ($item->description ?: $item->content));
  if ($metaDescription === '') {
    $metaDescription = 'Informasi event GKKA Samarinda (GKKAI Samarinda).';
  }
  $metaDescription = \Illuminate\Support\Str::limit(strip_tags($metaDescription), 160);
  $metaImage = $item->photo_path
    ? asset('storage/'.$item->photo_path)
    : ($item->thumbnail_path ? asset('storage/'.$item->thumbnail_path) : asset('img/fotogrj.jpeg'));
@endphp
@section('meta_description', $metaDescription)
@section('meta_image', $metaImage)
@section('meta_type', 'article')
@section('breadcrumb_title', $item->title)

@php
  $homeUrl = rtrim(url('/'), '/');
  $eventUrl = url()->current();
  try {
    $eventUrl = route('event.show', $item);
  } catch (\Throwable $e) {
  }
  $eventLocation = trim((string) ($item->location ?? ''));
  $eventStartAt = $item->start_date ?? $item->created_at;
  $eventEndAt = $item->end_date ?? $eventStartAt;

  $eventSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'Event',
    'name' => $item->title,
    'description' => $metaDescription,
    'startDate' => optional($eventStartAt)->toAtomString(),
    'endDate' => optional($eventEndAt)->toAtomString(),
    'eventStatus' => optional($eventEndAt)->isPast()
      ? 'https://schema.org/EventCompleted'
      : 'https://schema.org/EventScheduled',
    'eventAttendanceMode' => 'https://schema.org/OfflineEventAttendanceMode',
    'image' => [$metaImage],
    'url' => $eventUrl,
    'location' => [
      '@type' => 'Place',
      'name' => $eventLocation !== '' ? $eventLocation : (string) config('seo.organization_name', config('app.name')),
      'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => (string) config('seo.address.street', ''),
        'addressLocality' => (string) config('seo.address.locality', ''),
        'addressRegion' => (string) config('seo.address.region', ''),
        'postalCode' => (string) config('seo.address.postal_code', ''),
        'addressCountry' => (string) config('seo.address.country', 'ID'),
      ],
    ],
    'organizer' => [
      '@type' => 'Organization',
      '@id' => $homeUrl.'#organization',
      'name' => (string) config('seo.organization_name', config('app.name')),
      'url' => $homeUrl,
    ],
    'offers' => [
      '@type' => 'Offer',
      'url' => $eventUrl,
      'price' => '0',
      'priceCurrency' => 'IDR',
      'availability' => 'https://schema.org/InStock',
      'validFrom' => optional($item->created_at)->toAtomString(),
    ],
  ];

  $eventSchema['location']['address'] = array_filter(
    $eventSchema['location']['address'],
    fn ($value) => $value !== ''
  );

  $eventSchema = array_filter(
    $eventSchema,
    fn ($value) => $value !== null && $value !== []
  );
@endphp

@push('meta')
  <script type="application/ld+json">{!! json_encode($eventSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endpush

@section('content')
<section class="bg-blue-900 text-white py-20">
  <div class="gkka-container text-center">
    <h1 class="text-4xl md:text-5xl font-black mb-4 tracking-tight">Event GKKA Samarinda</h1>
    <p class="text-lg text-blue-200 font-medium">{{ $item->title }}</p>
  </div>
</section>

<section class="py-16 bg-gray-50">
  <div class="gkka-container">
    <div class="grid grid-cols-1 lg:grid-cols-[2fr_1fr] gap-12">
      
      {{-- Main Content --}}
      <article class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
        <div class="relative">
          @if($item->photo_path)
            <img class="w-full h-auto object-cover" src="{{ asset('storage/'.$item->photo_path) }}" alt="{{ $item->title }}">
          @elseif($item->thumbnail_path)
            <img class="w-full h-auto object-cover" src="{{ asset('storage/'.$item->thumbnail_path) }}" alt="{{ $item->title }}">
          @else
            <div class="w-full h-64 bg-gray-100 flex items-center justify-center">
              <img src="{{ asset('assets/logo.png') }}" alt="GKKA" class="w-24 h-24 object-contain opacity-50">
            </div>
          @endif
        </div>

        @if($item->video_path || !empty($youtubeEmbed))
          <div class="p-6 bg-black">
            @if($item->video_path)
              <div class="aspect-video w-full rounded-xl overflow-hidden">
                <video controls class="w-full h-full">
                  <source src="{{ asset('storage/'.$item->video_path) }}">
                </video>
              </div>
            @else
              <div class="aspect-video w-full rounded-xl overflow-hidden">
                <iframe
                  src="{{ $youtubeEmbed }}"
                  title="YouTube video"
                  class="w-full h-full"
                  frameborder="0"
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                  allowfullscreen></iframe>
              </div>
            @endif
          </div>
        @endif

        <div class="p-8 md:p-10">
          <h2 class="text-3xl md:text-4xl font-black text-slate-900 mb-6 leading-tight">{{ $item->title }}</h2>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6 bg-blue-50 rounded-2xl mb-8 border border-blue-100">
            <div>
               <div class="text-xs font-bold text-blue-500 uppercase tracking-widest mb-1">Tanggal</div>
               <div class="font-bold text-slate-800 text-lg">
                  @if($item->start_date)
                    {{ optional($item->start_date)->translatedFormat('d F Y') }}
                    @if($item->end_date)
                      <span class="text-gray-400 mx-1">–</span> {{ optional($item->end_date)->translatedFormat('d F Y') }}
                    @endif
                  @else
                    -
                  @endif
               </div>
            </div>
            <div>
               <div class="text-xs font-bold text-blue-500 uppercase tracking-widest mb-1">Lokasi</div>
               <div class="font-bold text-slate-800 text-lg">{{ $item->location ?: '-' }}</div>
            </div>
          </div>

          @if($item->description)
            <div class="text-slate-600 text-lg leading-relaxed mb-8 font-medium">
                {!! nl2br(e($item->description)) !!}
            </div>
          @endif

          @php $content = trim((string) ($item->content ?? '')); @endphp
          @if($content !== '')
            <div class="mt-8 pt-8 border-t border-gray-100">
              <h3 class="text-xl font-black text-slate-800 mb-4">Penjelasan Kegiatan</h3>
              <div class="prose prose-blue max-w-none text-slate-600">
                  {!! nl2br(e($content)) !!}
              </div>
            </div>
          @endif

          <div class="flex flex-wrap gap-4 mt-10 pt-8 border-t border-gray-100">
            <a class="px-6 py-3 rounded-full bg-gray-100 text-slate-700 font-bold hover:bg-gray-200 transition-colors" href="{{ route('event') }}">← Kembali</a>
            <a class="px-6 py-3 rounded-full bg-blue-600 text-white font-bold hover:bg-blue-700 shadow-lg transition-colors" href="{{ route('home') }}">Home</a>
          </div>
        </div>
      </article>

      {{-- Sidebar --}}
      <aside>
        <div class="sticky top-24 space-y-8">
           <div class="bg-white rounded-3xl p-6 shadow-xl border border-gray-100">
             <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-100">
                <h3 class="font-black text-xl text-slate-800">Event Lainnya</h3>
                <a class="text-sm font-bold text-blue-600 hover:text-blue-800" href="{{ route('event') }}">Lihat Semua</a>
             </div>

             <div class="space-y-4">
               @forelse(($latest ?? collect()) as $it)
                 @php
                   $thumb = $it->thumbnail_path
                     ? asset('storage/'.$it->thumbnail_path)
                     : ($it->photo_path ? asset('storage/'.$it->photo_path) : asset('assets/logo.png'));
                 @endphp
                 <a class="flex gap-4 p-3 rounded-2xl hover:bg-blue-50 transition-colors group" href="{{ route('event.show', $it) }}">
                   <div class="w-16 h-16 rounded-xl bg-cover bg-center flex-shrink-0 shadow-sm" style="background-image:url('{{ $thumb }}');"></div>
                   <div class="flex flex-col justify-center">
                     <h4 class="font-bold text-slate-800 text-sm group-hover:text-blue-700 line-clamp-2 leading-tight mb-1">{{ $it->title }}</h4>
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
                 <div class="text-center text-gray-400 font-bold p-4 text-sm">Belum ada event lainnya.</div>
               @endforelse
             </div>
           </div>
        </div>
      </aside>
    </div>
  </div>
</section>
@endsection
