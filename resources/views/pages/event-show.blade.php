@extends('layout.app')

@section('title', $item->title.' - Event')

@section('content')
<section class="page-head">
  <div class="container">
    <h1 class="page-title">Event</h1>
    <p class="page-sub">{{ $item->title }}</p>
  </div>
</section>

<section class="warta-section">
  <div class="container">
    <div class="event-layout">
      <article class="panel event-article">
        <div class="event-media">
          @if($item->photo_path)
            <img class="panel-img" src="{{ asset('storage/'.$item->photo_path) }}" alt="{{ $item->title }}">
          @elseif($item->thumbnail_path)
            <img class="panel-img" src="{{ asset('storage/'.$item->thumbnail_path) }}" alt="{{ $item->title }}">
          @else
            <div class="event-empty-media">
              <img src="{{ asset('assets/logo.png') }}" alt="GKKA" class="event-empty-logo">
            </div>
          @endif
        </div>

        @if($item->video_path || !empty($youtubeEmbed))
          <div class="event-video">
            @if($item->video_path)
              <div class="panel-video">
                <video controls style="width:100%;height:100%;display:block;background:#000;">
                  <source src="{{ asset('storage/'.$item->video_path) }}">
                </video>
              </div>
            @else
              <div class="panel-video">
                <iframe
                  src="{{ $youtubeEmbed }}"
                  title="YouTube video"
                  frameborder="0"
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                  allowfullscreen></iframe>
              </div>
            @endif
          </div>
        @endif

        <div class="event-body">
          <div class="event-title">{{ $item->title }}</div>

          <div class="event-meta">
            <div><span>Tanggal:</span>
              @if($item->start_date)
                {{ optional($item->start_date)->translatedFormat('d F Y') }}
                @if($item->end_date)
                  – {{ optional($item->end_date)->translatedFormat('d F Y') }}
                @endif
              @else
                -
              @endif
            </div>
            <div><span>Lokasi:</span> {{ $item->location ?: '-' }}</div>
          </div>

          @if($item->description)
            <div class="event-desc">{!! nl2br(e($item->description)) !!}</div>
          @endif

          @php $content = trim((string) ($item->content ?? '')); @endphp
          @if($content !== '')
            <div class="event-content">
              <div class="event-content-title">Penjelasan Kegiatan</div>
              <div class="event-content-text">{!! nl2br(e($content)) !!}</div>
            </div>
          @endif

          <div class="event-actions">
            <a class="hero-btn" href="{{ route('event') }}">← Kembali</a>
            <a class="hero-btn" href="{{ route('home') }}">Home</a>
          </div>
        </div>
      </article>

      <aside class="panel event-aside">
        <div class="event-aside-head">
          <div class="event-aside-title">Event Lainnya</div>
          <a class="event-aside-link" href="{{ route('event') }}">Lihat Semua</a>
        </div>

        <div class="event-aside-list">
          @forelse(($latest ?? collect()) as $it)
            @php
              $thumb = $it->thumbnail_path
                ? asset('storage/'.$it->thumbnail_path)
                : ($it->photo_path ? asset('storage/'.$it->photo_path) : asset('assets/logo.png'));
            @endphp
            <a class="event-mini" href="{{ route('event.show', $it) }}">
              <img class="event-mini-thumb" src="{{ $thumb }}" alt="{{ $it->title }}">
              <div class="event-mini-text">
                <div class="event-mini-title">{{ $it->title }}</div>
                <div class="event-mini-meta">
                  @if($it->start_date)
                    {{ optional($it->start_date)->translatedFormat('d M Y') }}
                  @else
                    -
                  @endif
                </div>
              </div>
            </a>
          @empty
            <div class="event-empty-aside">Belum ada event lainnya.</div>
          @endforelse
        </div>
      </aside>
    </div>
  </div>
</section>
@endsection
