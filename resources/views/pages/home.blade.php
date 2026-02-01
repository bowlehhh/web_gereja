@extends('layout.app')

@section('title', 'Beranda - GKKA Samarinda')

@section('content')

<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-overlay"></div>

    <div class="container hero-content">
        <div class="hero-center">
            <div class="hero-big">KASIH</div>
            <a class="hero-btn" href="{{ route('kontak') }}">Hubungi Kami</a>
        </div>
    </div>
</section>

<section class="blue-section">
    <div class="container">

        <div class="blue-grid-top reveal">
            <div class="panel">
                <img class="panel-img" src="{{ asset('img/fotogrj.jpg') }}" alt="Foto Gereja">
            </div>

            <div class="panel">
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

        <div class="blue-grid-bottom reveal">
            <div class="schedule-card">
                <div class="schedule-title">JADWAL KOMISI</div>
                <div class="schedule-grid-2">
                    <div class="schedule-item">
                        <div class="schedule-name">Komisi Wanita “Gloria”</div>
                        <div class="schedule-text">
                            Tiap hari Selasa, Pukul 19.00 WITA<br>
                            Minggu ke 2 &amp; 4: Ibadah<br>
                            Minggu ke 3: Komsel
                        </div>
                    </div>

                    <div class="schedule-item">
                        <div class="schedule-name">Komisi Remaja “Philia”</div>
                        <div class="schedule-text">
                            Tiap hari Jumat, Pukul 19.00 WITA<br>
                            Minggu ke 1 - 3: Ibadah<br>
                            Minggu ke 4 &amp; 5: Gabungan
                        </div>
                    </div>
                </div>
            </div>

            <div class="schedule-card">
                <div class="schedule-title">JADWAL IBADAH</div>
                <div class="schedule-grid-2">
                    <div class="schedule-item">
                        <div class="schedule-name">Ibadah Umum</div>
                        <div class="schedule-text">
                            Tiap Hari Minggu<br>
                            Pukul 08.00 WITA : KU 1<br>
                            Pukul 10.00 WITA : KU 2
                        </div>
                    </div>

                    <div class="schedule-item">
                        <div class="schedule-name">Komisi Usia Indah “Simeon”</div>
                        <div class="schedule-text">
                            Hari Rabu (Minggu ke 1)<br>
                            Pukul 17.00 WITA
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
