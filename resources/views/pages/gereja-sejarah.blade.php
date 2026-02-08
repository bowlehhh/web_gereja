@extends('layout.app')
@section('title','Sejarah - GKKA Samarinda')
@section('content')
<section class="page-head"><div class="container">
  <h1 class="page-title">Sejarah</h1>
  <p class="page-sub">Profil singkat, tujuan & sasaran, serta perjalanan gereja.</p>
</div></section>

@php
  $judulStrategis = 'TUJUAN & SASARAN STRATEGIS GEREJA KEBANGUNAN KALAM ALLAH INDONESIA JEMAAT SAMARINDA';

  $tujuan = [
    'Meningkatkan iman jemaat melalui pengajaran dan pembinaan sehingga ke-iman-an tersebut akan terwujud melalui keterlibatan dalam pelayanan, keaktifan dalam kelompok kecil dan terpanggil untuk memuridkan.',
    'Meningkatkan persekutuan antar anggota Jemaat dan Komisi sehingga mulai terbentuk kelompok-kelompok kecil dengan lahirnya pemimpin-pemimpin baru yang berkomitmen untuk memimpin.',
    'Meningkatkan kualitas kasih dalam diri Jemaat sehingga Jemaat GKKA Indonesia Jemaat Samarinda menjadi saluran kasih Tuhan bagi anggota jemaat bahkan masyarakat secara umum untuk menggenapi misi Allah yang holistik.',
    'Membentuk jemaat misioner dimana penginjilan menjadi gaya hidup jemaat untuk mengemban tugas pemberitaan Injil sebagaimana yang telah diamanatkan Tuhan Yesus sehingga ada pertambahan jiwa baru yang dibawa kepada Tuhan.',
  ];

  $sasaran = [
    'Meningkatnya iman jemaat melalui pengajaran dan pembinaan sehingga keimanan tersebut akan terwujud melalui keterlibatan dalam pelayanan, keaktifan dalam kelompok kecil dan panggilan untuk memuridkan.',
    'Terbentuknya kelompok-kelompok kecil dalam persekutuan yang sudah ada sehingga lahir banyak pemimpin yang berkomitmen untuk memimpin dalam kelompok yang baru.',
    'Meningkatnya kualitas kasih dalam diri Jemaat sehingga Jemaat GKKA Indonesia Jemaat Samarinda menjadi saluran kasih Tuhan bagi anggota jemaat bahkan masyarakat secara umum untuk menggenapi misi Allah yang holistik.',
    'Terbentuknya jemaat misioner yang menjadikan penginjilan sebagai gaya hidupnya sehingga tugas pemberitaan Injil terlaksana sebagaimana yang telah diamanatkan Tuhan Yesus.',
  ];

  $galeriTokoh = [
    ['nama' => 'Pdt. (Nama)', 'foto' => null],
    ['nama' => 'Sdr. (Nama)', 'foto' => null],
    ['nama' => 'Bpk. (Nama)', 'foto' => null],
    ['nama' => 'Ibu (Nama)', 'foto' => null],
    ['nama' => 'Bpk. (Nama) & Istri', 'foto' => null],
    ['nama' => 'Peresmian', 'foto' => null],
  ];

  $initials = function (string $name): string {
    $clean = preg_replace('/[^\\p{L}\\p{N} ]+/u', '', $name) ?? '';
    $parts = array_values(array_filter(preg_split('/\\s+/u', trim($clean)) ?: []));
    $take = array_slice($parts, 0, 2);
    $out = '';
    foreach ($take as $p) {
      $out .= mb_strtoupper(mb_substr($p, 0, 1));
    }
    return $out !== '' ? $out : 'GK';
  };
@endphp

<section class="sejarah-section">
  <div class="container">
    <h2 class="sejarah-heading">{{ $judulStrategis }}</h2>

    <div class="sejarah-grid-2">
      <div class="sejarah-box reveal">
        <h3 class="sejarah-box-title">Tujuan</h3>
        <ol class="sejarah-ol">
          @foreach ($tujuan as $item)
            <li>{{ $item }}</li>
          @endforeach
        </ol>
      </div>

      <div class="sejarah-box reveal">
        <h3 class="sejarah-box-title">Sasaran</h3>
        <ol class="sejarah-ol">
          @foreach ($sasaran as $item)
            <li>{{ $item }}</li>
          @endforeach
        </ol>
      </div>
    </div>
  </div>
</section>

<section class="sejarah-section sejarah-section--white">
  <div class="container">
    <div class="sejarah-lead reveal">
      <p>
        Isi bagian ini dengan ringkasan perjalanan gereja (mis. tahun berdiri, perpindahan tempat ibadah,
        penetapan/penugasan hamba Tuhan, dan momen penting lainnya).
      </p>
    </div>

    <div class="sejarah-card-grid">
      @foreach ($galeriTokoh as $tokoh)
        <div class="sejarah-card reveal">
          <div class="sejarah-card-media">
            @if (!empty($tokoh['foto']))
              <img src="{{ $tokoh['foto'] }}" alt="{{ $tokoh['nama'] }}">
            @else
              <div class="sejarah-card-placeholder">{{ $initials($tokoh['nama']) }}</div>
            @endif
          </div>
          <div class="sejarah-card-name">{{ $tokoh['nama'] }}</div>
        </div>
      @endforeach
    </div>

    <div class="sejarah-article reveal">
      <p>
        Tulis sejarah lengkap gereja di sini dalam beberapa paragraf agar mudah dibaca. Contoh: bagaimana
        persekutuan dimulai, perkembangan jemaat, pelayanan yang berjalan, hingga kondisi terkini.
      </p>
      <p>
        Jika kamu punya teks sejarah versi final, kirimkan saja — nanti aku rapikan formatnya (pemenggalan paragraf,
        penebalan nama/tanggal penting, dan penataan agar nyaman dibaca).
      </p>
    </div>
  </div>
</section>
@endsection
