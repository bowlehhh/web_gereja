@extends('layout.app')
@section('title','Sejarah - GKKA Samarinda')
@section('content')
<section class="bg-blue-900 text-white py-20">
  <div class="gkka-container text-center">
    <h1 class="text-4xl md:text-5xl font-black mb-4 tracking-tight">Sejarah</h1>
    <p class="text-lg text-blue-200 font-medium">Profil singkat, tujuan & sasaran, serta perjalanan gereja.</p>
  </div>
</section>

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

<section class="py-16 md:py-24 bg-blue-50">
  <div class="gkka-container">
    <h2 class="text-2xl md:text-3xl font-black text-center text-blue-900 mb-12 uppercase tracking-wide leading-relaxed max-w-4xl mx-auto">{{ $judulStrategis }}</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">
      <div class="bg-white p-8 rounded-[2.5rem] shadow-xl border border-blue-100 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-blue-100 rounded-bl-full opacity-50 -mr-16 -mt-16"></div>
        <h3 class="text-2xl font-black text-slate-800 mb-6 relative z-10 flex items-center gap-3">
           <span class="w-8 h-1 bg-yellow-500 rounded-full"></span> Tujuan
        </h3>
        <ol class="space-y-4 list-decimal list-outside ml-5 text-slate-700 leading-relaxed font-medium relative z-10">
          @foreach ($tujuan as $item)
            <li class="pl-2">{{ $item }}</li>
          @endforeach
        </ol>
      </div>

      <div class="bg-white p-8 rounded-[2.5rem] shadow-xl border border-blue-100 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-yellow-100 rounded-bl-full opacity-50 -mr-16 -mt-16"></div>
        <h3 class="text-2xl font-black text-slate-800 mb-6 relative z-10 flex items-center gap-3">
           <span class="w-8 h-1 bg-yellow-500 rounded-full"></span> Sasaran
        </h3>
        <ol class="space-y-4 list-decimal list-outside ml-5 text-slate-700 leading-relaxed font-medium relative z-10">
          @foreach ($sasaran as $item)
            <li class="pl-2">{{ $item }}</li>
          @endforeach
        </ol>
      </div>
    </div>
  </div>
</section>

<section class="py-16 md:py-24 bg-white">
  <div class="w-full max-w-5xl mx-auto px-6">
    <div class="text-center mb-16">
      <p class="text-xl md:text-2xl text-slate-600 font-medium leading-relaxed max-w-3xl mx-auto">
        Isi bagian ini dengan ringkasan perjalanan gereja (mis. tahun berdiri, perpindahan tempat ibadah,
        penetapan/penugasan hamba Tuhan, dan momen penting lainnya).
      </p>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 mb-20">
      @foreach ($galeriTokoh as $tokoh)
        <div class="group text-center">
          <div class="w-full aspect-square bg-gray-100 rounded-2xl overflow-hidden mb-4 shadow-md border border-gray-100 relative">
            @if (!empty($tokoh['foto']))
              <img src="{{ $tokoh['foto'] }}" alt="{{ $tokoh['nama'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            @else
              <div class="w-full h-full flex items-center justify-center bg-blue-50 text-blue-300 font-black text-2xl group-hover:bg-blue-100 transition-colors uppercase select-none">{{ $initials($tokoh['nama']) }}</div>
            @endif
          </div>
          <div class="text-sm font-bold text-slate-700 group-hover:text-blue-700 transition-colors px-2">{{ $tokoh['nama'] }}</div>
        </div>
      @endforeach
    </div>

    <div class="prose prose-lg prose-blue mx-auto text-slate-600 leading-relaxed">
      <p>
        Tulis sejarah lengkap gereja di sini dalam beberapa paragraf agar mudah dibaca. Contoh: bagaimana
        persekutuan dimulai, perkembangan jemaat, pelayanan yang berjalan, hingga kondisi terkini.
      </p>
      <div class="p-6 bg-yellow-50 rounded-2xl border-l-4 border-yellow-400 text-yellow-800 not-prose font-medium">
        Jika kamu punya teks sejarah versi final, kirimkan saja — nanti aku rapikan formatnya (pemenggalan paragraf,
        penebalan nama/tanggal penting, dan penataan agar nyaman dibaca).
      </div>
    </div>
  </div>
</section>
@endsection
