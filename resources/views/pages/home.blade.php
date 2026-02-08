@extends('layout.app')

@section('title', 'Beranda - GKKA Samarinda')

@section('content')
@php
  $heroImage = asset('img/fotogrj.jpeg');
@endphp

<section class="home-media">
  <div class="container">
    <div class="home-head reveal">
      <div>
        <div class="home-kicker">Selamat Datang</div>
        <h1 class="home-title">GKKA Indonesia Jemaat Samarinda</h1>
        <p class="home-sub">Informasi pelayanan, jadwal, komisi, event, dan dokumentasi kegiatan jemaat.</p>
      </div>
      <div class="home-actions">
        <a class="hero-btn" href="{{ route('kontak') }}">Hubungi Kami</a>
        <a class="hero-btn" href="{{ route('gereja.sejarah') }}" style="background:#ffffff;color:#0b4a8b;">Sejarah Gereja</a>
      </div>
    </div>

    <div class="home-media-grid reveal">
      <div class="panel home-media-card">
        <img class="panel-img" src="{{ $heroImage }}" alt="GKKA Samarinda">
      </div>

      <div class="panel home-media-card">
        <div class="panel-video">
          <iframe
            src="https://www.youtube.com/embed/dQw4w9WgXcQ"
            title="YouTube video"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="home-schedules">
  <div class="container">
    <div class="home-schedule-grid reveal">
      <div class="home-schedule-card" style="background-image:url('{{ $heroImage }}');">
        <div class="home-schedule-overlay"></div>
        <div class="home-schedule-body">
          <div class="home-schedule-title">JADWAL KOMISI</div>
          <div class="home-schedule-items">
            <div class="home-schedule-item">
              <div class="home-schedule-name">Komisi Wanita “Gloria”</div>
              <div class="home-schedule-text">
                Tiap hari Selasa, Pukul 19.00 WITA<br>
                Minggu ke 2 &amp; 4: Ibadah<br>
                Minggu ke 3: Komsel
              </div>
            </div>
            <div class="home-schedule-item">
              <div class="home-schedule-name">Komisi Remaja “Philia”</div>
              <div class="home-schedule-text">
                Tiap hari Jumat, Pukul 19.00 WITA<br>
                Minggu ke 1 - 3: Ibadah<br>
                Minggu ke 4 &amp; 5: Gabungan
              </div>
            </div>
            <div class="home-schedule-item">
              <div class="home-schedule-name">Komisi Pria “Yosua”</div>
              <div class="home-schedule-text">
                Hari Jumat (Minggu ke 1)<br>
                Pukul 19.00 WITA
              </div>
            </div>
            <div class="home-schedule-item">
              <div class="home-schedule-name">Komisi Pemuda “Sola Gratia”</div>
              <div class="home-schedule-text">
                Tiap hari Jumat, Pukul 19.00 WITA<br>
                Minggu ke 1 - 3: Ibadah<br>
                Minggu ke 4 &amp; 5: Gabungan
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="home-schedule-card" style="background-image:url('{{ $heroImage }}');">
        <div class="home-schedule-overlay"></div>
        <div class="home-schedule-body">
          <div class="home-schedule-title">JADWAL IBADAH</div>
          <div class="home-schedule-items">
            <div class="home-schedule-item">
              <div class="home-schedule-name">Ibadah Umum</div>
              <div class="home-schedule-text">
                Tiap Hari Minggu<br>
                Pukul 08.00 WITA : KU 1<br>
                Pukul 10.00 WITA : KU 2
              </div>
            </div>
            <div class="home-schedule-item">
              <div class="home-schedule-name">Ibadah Sekolah Minggu “Agape”</div>
              <div class="home-schedule-text">
                Tiap Hari Minggu<br>
                Pukul 10.00 WITA
              </div>
            </div>
            <div class="home-schedule-item">
              <div class="home-schedule-name">Komisi Usia Indah “Simeon”</div>
              <div class="home-schedule-text">
                Hari Rabu (Minggu ke 1)<br>
                Pukul 17.00 WITA
              </div>
            </div>
            <div class="home-schedule-item">
              <div class="home-schedule-name">Persekutuan Doa</div>
              <div class="home-schedule-text">
                Tiap Hari Kamis<br>
                Pukul 19.00 WITA
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="home-sejarah">
  <div class="container">
    <div class="home-sejarah-grid reveal">
      <div class="panel home-sejarah-media">
        <img class="panel-img" src="{{ $heroImage }}" alt="Sejarah GKKA Samarinda">
      </div>
      <div class="home-sejarah-card">
        <h2 class="home-sejarah-title">Sejarah Gereja</h2>
        <p class="home-sejarah-text">
          Ringkasan sejarah berdirinya GKKA Indonesia Jemaat Samarinda. Silakan lengkapi isi sesuai data gereja.
        </p>

        <details class="home-acc">
          <summary>Visi</summary>
          <div class="home-acc-body">Menjadi jemaat yang bertumbuh dalam iman, kasih, dan pelayanan.</div>
        </details>
        <details class="home-acc">
          <summary>Misi</summary>
          <div class="home-acc-body">Membangun persekutuan, pemuridan, dan penginjilan yang berdampak.</div>
        </details>

        <div class="home-sejarah-actions">
          <a class="hero-btn" href="{{ route('gereja.sejarah') }}">Lihat Selengkapnya</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="home-komisi">
  <div class="container">
    <h2 class="home-section-title reveal">Komisi GKKA Samarinda</h2>

    <div class="home-komisi-grid reveal">
      <a class="home-komisi-card" href="{{ route('gereja.majelis') }}">
        <img src="{{ $heroImage }}" alt="Majelis">
        <div class="home-komisi-name">Majelis</div>
        <div class="home-komisi-btn">Lihat Selengkapnya</div>
      </a>
      <a class="home-komisi-card" href="{{ route('gereja.komisi') }}">
        <img src="{{ $heroImage }}" alt="Komisi Sekolah Minggu">
        <div class="home-komisi-name">Komisi Sekolah Minggu</div>
        <div class="home-komisi-btn">Lihat Selengkapnya</div>
      </a>
      <a class="home-komisi-card" href="{{ route('gereja.komisi') }}">
        <img src="{{ $heroImage }}" alt="Komisi Remaja Pemuda">
        <div class="home-komisi-name">Komisi Remaja Pemuda</div>
        <div class="home-komisi-btn">Lihat Selengkapnya</div>
      </a>
      <a class="home-komisi-card" href="{{ route('gereja.komisi') }}">
        <img src="{{ $heroImage }}" alt="Komisi Wanita">
        <div class="home-komisi-name">Komisi Wanita</div>
        <div class="home-komisi-btn">Lihat Selengkapnya</div>
      </a>
      <a class="home-komisi-card" href="{{ route('gereja.komisi') }}">
        <img src="{{ $heroImage }}" alt="Komisi Pria">
        <div class="home-komisi-name">Komisi Pria</div>
        <div class="home-komisi-btn">Lihat Selengkapnya</div>
      </a>
      <a class="home-komisi-card" href="{{ route('gereja.komisi') }}">
        <img src="{{ $heroImage }}" alt="Komisi Usia Indah">
        <div class="home-komisi-name">Komisi Usia Indah</div>
        <div class="home-komisi-btn">Lihat Selengkapnya</div>
      </a>
    </div>
  </div>
</section>

<section class="home-events">
  <div class="container">
    <div class="home-events-head reveal">
      <h2 class="home-section-title" style="margin:0;">Event Terbaru</h2>
      <a class="hero-btn" href="{{ route('event') }}">Lihat Lebih Banyak</a>
    </div>

    <div class="home-events-grid reveal">
      <div class="panel home-events-feature">
        @if(!empty($featuredEvent))
          @php
            $thumb = $featuredEvent->thumbnail_path
              ? asset('storage/'.$featuredEvent->thumbnail_path)
              : ($featuredEvent->photo_path ? asset('storage/'.$featuredEvent->photo_path) : asset('assets/logo.png'));
          @endphp
          <a href="{{ route('event.show', $featuredEvent) }}" class="home-events-feature-link">
            <div class="home-events-feature-media" style="background-image:url('{{ $thumb }}');"></div>
            <div class="home-events-feature-body">
              <div class="home-events-feature-title">{{ $featuredEvent->title }}</div>
              <div class="home-events-feature-meta">
                @if($featuredEvent->start_date)
                  {{ optional($featuredEvent->start_date)->translatedFormat('d F Y') }}
                @endif
                @if($featuredEvent->location)
                  <span class="dot">•</span> {{ $featuredEvent->location }}
                @endif
              </div>
              @if($featuredEvent->description)
                <div class="home-events-feature-desc">{{ \Illuminate\Support\Str::limit($featuredEvent->description, 160) }}</div>
              @endif
            </div>
          </a>
        @else
          <div style="padding:16px;font-weight:800;color:#64748b;">
            Belum ada event yang dipublish.
          </div>
        @endif
      </div>

      <aside class="panel home-events-aside">
        <div class="home-events-aside-title">Last Post</div>
        <div class="home-events-aside-list">
          @forelse(($eventList ?? collect()) as $it)
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

<section class="hamba-cta">
  <div class="container">
    <div class="hamba-cta-inner reveal">
      <div class="hamba-cta-title">Temukan kekuatan iman &amp; Pertumbuhan Rohani</div>
      <div class="hamba-cta-actions">
        <a class="hamba-cta-btn" href="{{ route('kontak') }}">Hubungi Kami</a>
      </div>
    </div>
  </div>
</section>

@endsection
