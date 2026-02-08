@extends('layout.app')

@section('title', 'Event - GKKA Samarinda')

@section('content')
<section class="page-head">
  <div class="container">
    <h1 class="page-title">Event</h1>
    <p class="page-sub">Daftar event yang ditampilkan ke jemaat.</p>
  </div>
</section>

<section class="warta-section">
  <div class="container">
    <div class="warta-grid reveal">
      @forelse($items as $it)
        <a class="warta-card" href="{{ route('event.show', $it) }}">
          @php
            $thumb = $it->thumbnail_path
              ? asset('storage/'.$it->thumbnail_path)
              : ($it->photo_path ? asset('storage/'.$it->photo_path) : asset('assets/logo.png'));
          @endphp
          <div class="warta-thumb"
               style="background-image:url('{{ $thumb }}');">
            <div class="warta-overlay"></div>
            <div class="warta-text">
              <div class="warta-kicker">Event</div>
              <div class="warta-title">{{ $it->title }}</div>
              <div class="warta-meta">
                <span>
                  @if($it->start_date)
                    {{ \Carbon\Carbon::parse($it->start_date)->translatedFormat('d F Y') }}
                  @else
                    -
                  @endif
                </span>
                <span class="dot">•</span>
                <span>{{ $it->location ?: '-' }}</span>
              </div>
            </div>
          </div>
          @if(!empty($it->description))
            <div class="warta-below">{{ \Illuminate\Support\Str::limit($it->description, 80) }}</div>
          @endif
        </a>
      @empty
        <div style="padding:18px;background:#fff;border:1px solid #e5e7eb;border-radius:14px;">
          Belum ada event yang dipublish.
        </div>
      @endforelse
    </div>

    <div style="margin-top:18px;">
      @if($items->hasMorePages())
        <div style="display:flex;justify-content:center;">
          <a class="hero-btn" href="{{ $items->nextPageUrl() }}">Lebih Banyak</a>
        </div>
      @else
        {{ $items->links() }}
      @endif
    </div>
  </div>
</section>
@endsection
