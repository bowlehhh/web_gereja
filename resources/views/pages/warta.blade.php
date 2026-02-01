@extends('layout.app')

@section('title', 'Warta Jemaat - GKKA Samarinda')

@section('content')
<section class="page-head">
  <div class="container">
    <h1 class="page-title">Warta Jemaat</h1>
    <p class="page-sub">Arsip warta jemaat GKKA Indonesia Jemaat Samarinda</p>
  </div>
</section>

<section class="warta-section">
  <div class="container">

    <div class="warta-grid reveal">

      {{-- CARD 1 --}}
      <a class="warta-card" href="#">
        <div class="warta-thumb">
          <img class="warta-img" src="{{ asset('img/fotogrj.jpg') }}" alt="Warta Jemaat">
          <div class="warta-overlay"></div>

          <div class="warta-text">
            <div class="warta-kicker">Warta Jemaat</div>
            <div class="warta-title">GKKA Samarinda</div>
            <div class="warta-meta">
              <span>01 Februari 2026</span>
              <span class="dot">•</span>
              <span>Edisi 05</span>
            </div>
          </div>
        </div>

        <div class="warta-below">Warta Jemaat Minggu, 1 Februari 2026</div>
      </a>

      {{-- CARD 2 --}}
      <a class="warta-card" href="#">
        <div class="warta-thumb">
          <img class="warta-img" src="{{ asset('img/fotogrj.jpg') }}" alt="Warta Jemaat">
          <div class="warta-overlay"></div>

          <div class="warta-text">
            <div class="warta-kicker">Warta Jemaat</div>
            <div class="warta-title">GKKA Samarinda</div>
            <div class="warta-meta">
              <span>25 Januari 2026</span>
              <span class="dot">•</span>
              <span>Edisi 04</span>
            </div>
          </div>
        </div>

        <div class="warta-below">Warta Jemaat Minggu, 25 Januari 2026</div>
      </a>

      {{-- CARD 3 --}}
      <a class="warta-card" href="#">
        <div class="warta-thumb">
          <img class="warta-img" src="{{ asset('img/fotogrj.jpg') }}" alt="Warta Jemaat">
          <div class="warta-overlay"></div>

          <div class="warta-text">
            <div class="warta-kicker">Warta Jemaat</div>
            <div class="warta-title">GKKA Samarinda</div>
            <div class="warta-meta">
              <span>18 Januari 2026</span>
              <span class="dot">•</span>
              <span>Edisi 03</span>
            </div>
          </div>
        </div>

        <div class="warta-below">Warta Jemaat Minggu, 18 Januari 2026</div>
      </a>

      {{-- CARD 4 --}}
      <a class="warta-card" href="#">
        <div class="warta-thumb">
          <img class="warta-img" src="{{ asset('img/fotogrj.jpg') }}" alt="Warta Jemaat">
          <div class="warta-overlay"></div>

          <div class="warta-text">
            <div class="warta-kicker">Warta Jemaat</div>
            <div class="warta-title">GKKA Samarinda</div>
            <div class="warta-meta">
              <span>11 Januari 2026</span>
              <span class="dot">•</span>
              <span>Edisi 02</span>
            </div>
          </div>
        </div>

        <div class="warta-below">Warta Jemaat Minggu, 11 Januari 2026</div>
      </a>

      {{-- CARD 5 --}}
      <a class="warta-card" href="#">
        <div class="warta-thumb">
          <img class="warta-img" src="{{ asset('img/fotogrj.jpg') }}" alt="Warta Jemaat">
          <div class="warta-overlay"></div>

          <div class="warta-text">
            <div class="warta-kicker">Warta Jemaat</div>
            <div class="warta-title">GKKA Samarinda</div>
            <div class="warta-meta">
              <span>04 Januari 2026</span>
              <span class="dot">•</span>
              <span>Edisi 01</span>
            </div>
          </div>
        </div>

        <div class="warta-below">Warta Jemaat Minggu, 4 Januari 2026</div>
      </a>

    </div>

  </div>
</section>
@endsection
