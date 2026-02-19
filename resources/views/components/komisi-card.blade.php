@props([
  'href' => '#',
  'title',
  'image' => null,
  'label' => 'Komisi',
  'meta' => null,
  'excerpt' => null,
  'variant' => 'simple', // simple | detailed
])

@php
  $img = $image ?: asset('img/fotogrj.jpeg');
@endphp

@if($variant === 'detailed')
  <a href="{{ $href }}"
     class="gkka-komisi-card group">
    <div class="gkka-komisi-card__media">
      <img
        src="{{ $img }}"
        alt="{{ $title }}"
        class="gkka-komisi-card__img"
        onerror="this.onerror=null;this.src='{{ asset('img/media.jpeg') }}';"
      >
      <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-transparent"></div>
      <div class="absolute top-4 left-4">
        <span class="gkka-komisi-card__badge">
          {{ $label }}
        </span>
      </div>
    </div>

    <div class="gkka-komisi-card__body">
      <div class="gkka-komisi-card__title">
        {{ $title }}
      </div>
      @if(!empty($meta))
        <div class="gkka-komisi-card__meta">
          {{ $meta }}
        </div>
      @endif
      @if(!empty($excerpt))
        <p class="gkka-komisi-card__excerpt">
          {{ $excerpt }}
        </p>
      @endif
    </div>
  </a>
@else
  <a href="{{ $href }}"
     class="group block bg-white rounded-3xl overflow-hidden shadow-xl border border-gray-100 hover:-translate-y-2 transition-all duration-300">
    <div class="h-48 overflow-hidden relative">
      <img src="{{ $img }}" alt="{{ $title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
      <div class="absolute inset-0 bg-blue-900/0 group-hover:bg-blue-900/20 transition-colors duration-300"></div>
    </div>
    <div class="p-6 text-center">
      <h3 class="font-black text-xl text-slate-800 mb-4 group-hover:text-blue-700 transition-colors">{{ $title }}</h3>
    </div>
  </a>
@endif
