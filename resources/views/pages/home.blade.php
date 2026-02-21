@extends('layout.app')

@section('title', 'Beranda - GKKA Samarinda')

@section('content')
@php
  $heroImage = asset('img/fotogrj.jpeg');
@endphp

{{-- HERO SECTION --}}
<section class="relative h-[72svh] min-h-[360px] sm:min-h-[500px] w-full overflow-hidden">
  {{-- Background --}}
  <div class="absolute inset-0">
    <img src="{{ $heroImage }}" class="w-full h-full object-cover scale-105" alt="GKKA Samarinda">
    <div class="absolute inset-0 bg-blue-900/60 mix-blend-multiply"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-blue-900/90 via-transparent to-transparent"></div>
  </div>

  {{-- Content --}}
  <div class="relative h-full gkka-container flex flex-col justify-center items-center text-center text-white z-10 pt-24 sm:pt-0 pb-10 sm:pb-0">
      <div class="font-black text-blue-300 tracking-widest uppercase mb-4 text-sm md:text-base animate-fade-in-up">Selamat Datang</div>
      <h1 class="text-3xl sm:text-4xl md:text-6xl lg:text-7xl font-black tracking-tight mb-6 leading-tight drop-shadow-lg animate-fade-in-up delay-100">
        GKKA Indonesia<br><span class="text-blue-200">Jemaat Samarinda</span>
      </h1>
      <p class="max-w-2xl text-base sm:text-lg md:text-xl text-blue-100 font-medium mb-10 leading-relaxed drop-shadow-md animate-fade-in-up delay-200">
        Informasi pelayanan, jadwal, komisi, event, dan dokumentasi kegiatan jemaat.
      </p>
      <div class="flex flex-wrap gap-4 justify-center animate-fade-in-up delay-300">
        <a href="{{ route('kontak') }}" class="px-8 py-3.5 rounded-full bg-yellow-500 text-blue-900 font-black shadow-xl hover:bg-yellow-400 hover:scale-105 transition-all duration-300">
          Hubungi Kami
        </a>
        <a href="{{ route('gereja.sejarah') }}" class="px-8 py-3.5 rounded-full bg-white text-blue-900 font-black shadow-xl hover:bg-gray-100 hover:scale-105 transition-all duration-300">
          Sejarah Gereja
        </a>
      </div>
  </div>
</section>

{{-- MEDIA & WELCOME SECTION --}}
<section class="gkka-section-tight bg-gradient-to-b from-blue-50/50 to-white">
  <div class="gkka-container grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-12 items-center">
      
      {{-- Image --}}
      <div class="relative group">
        <div class="absolute inset-0 bg-blue-600 rounded-3xl rotate-3 opacity-20 group-hover:rotate-6 transition-transform duration-500"></div>
        <img src="{{ $heroImage }}" alt="GKKA Samarinda" class="relative w-full h-64 sm:h-80 lg:h-[420px] object-cover rounded-3xl shadow-2xl transform transition-transform duration-500 group-hover:-translate-y-2">
      </div>

      {{-- Video / Text --}}
      <div>
        <div class="w-full h-56 sm:h-72 md:h-[400px] rounded-3xl overflow-hidden shadow-2xl border-4 border-white bg-black/5">
          <iframe
            src="https://www.youtube.com/embed/dQw4w9WgXcQ"
            title="YouTube video"
            class="w-full h-full"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
        </div>
      </div>

  </div>
</section>

{{-- SCHEDULES SECTION --}}
<section class="gkka-section bg-blue-900 text-white relative overflow-hidden">
  {{-- Background Decoration --}}
  <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
     <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-400 rounded-full blur-3xl"></div>
     <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-blue-600 rounded-full blur-3xl"></div>
  </div>

  <div class="gkka-container relative z-10">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
      
      {{-- JADWAL KOMISI --}}
      <div class="group relative rounded-3xl overflow-hidden bg-blue-800/50 border border-white/10 shadow-2xl hover:border-blue-400/50 transition-colors duration-300">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900/90 to-blue-800/50 z-0"></div>
        <div class="relative z-10 p-6 sm:p-8">
          <h2 class="text-2xl font-black uppercase tracking-wider mb-8 flex items-center gap-3">
            <span class="w-2 h-8 bg-yellow-500 rounded-full"></span>
            Jadwal Komisi
          </h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="space-y-2">
              <h3 class="font-bold text-yellow-400 text-lg">Komisi Wanita Rut</h3>
              <p class="text-blue-100 text-sm leading-relaxed">
                Tiap Selasa, 19.00 WITA<br>
                Minggu 2 & 4: Ibadah<br>
                Minggu 3: Komsel
              </p>
            </div>
            <div class="space-y-2">
              <h3 class="font-bold text-yellow-400 text-lg">Komisi Remaja Betania</h3>
              <p class="text-blue-100 text-sm leading-relaxed">
                Tiap Jumat, 19.00 WITA<br>
                Minggu 1 - 3: Ibadah<br>
                Minggu 4 & 5: Gabungan
              </p>
            </div>
            <div class="space-y-2">
              <h3 class="font-bold text-yellow-400 text-lg">Komisi Pria Hizkia</h3>
              <p class="text-blue-100 text-sm leading-relaxed">
                Jumat (Minggu 1)<br>
                19.00 WITA
              </p>
            </div>
            <div class="space-y-2">
              <h3 class="font-bold text-yellow-400 text-lg">Komisi Pemuda Eirene</h3>
              <p class="text-blue-100 text-sm leading-relaxed">
                Tiap Jumat, 19.00 WITA<br>
                Minggu 1 - 3: Ibadah<br>
                Minggu 4 & 5: Gabungan
              </p>
            </div>
          </div>
        </div>
      </div>

      {{-- JADWAL IBADAH --}}
      <div class="group relative rounded-3xl overflow-hidden bg-blue-800/50 border border-white/10 shadow-2xl hover:border-blue-400/50 transition-colors duration-300">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900/90 to-blue-800/50 z-0"></div>
        <div class="relative z-10 p-6 sm:p-8">
          <h2 class="text-2xl font-black uppercase tracking-wider mb-8 flex items-center gap-3">
            <span class="w-2 h-8 bg-yellow-500 rounded-full"></span>
            Jadwal Ibadah
          </h2>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="space-y-2">
              <h3 class="font-bold text-white text-lg">Ibadah Umum</h3>
              <p class="text-blue-100 text-sm leading-relaxed">
                Tiap Hari Minggu<br>
                <span class="font-semibold text-yellow-400">08.00 WITA</span> : KU 1<br>
                <span class="font-semibold text-yellow-400">10.00 WITA</span> : KU 2
              </p>
            </div>
            <div class="space-y-2">
              <h3 class="font-bold text-white text-lg">Sekolah Minggu “Agape”</h3>
              <p class="text-blue-100 text-sm leading-relaxed">
                Tiap Hari Minggu<br>
                10.00 WITA
              </p>
            </div>
            <div class="space-y-2">
              <h3 class="font-bold text-white text-lg">Usia Indah “Simeon”</h3>
              <p class="text-blue-100 text-sm leading-relaxed">
                Rabu (Minggu 1)<br>
                17.00 WITA
              </p>
            </div>
            <div class="space-y-2">
              <h3 class="font-bold text-white text-lg">Persekutuan Doa</h3>
              <p class="text-blue-100 text-sm leading-relaxed">
                Tiap Hari Kamis<br>
                19.00 WITA
              </p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- SEJARAH SIMPLE --}}
<section class="gkka-section bg-white">
  <div class="gkka-container">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
      <div class="relative">
         <div class="absolute -inset-4 bg-blue-100 rounded-3xl -rotate-2"></div>
         <img src="{{ $heroImage }}" alt="Sejarah GKKA" class="relative w-full h-64 sm:h-80 lg:h-[420px] object-cover rounded-3xl shadow-xl">
      </div>
      <div>
        <h2 class="text-3xl md:text-4xl font-black text-blue-900 mb-6">Sejarah Gereja</h2>
        <p class="text-slate-600 text-lg leading-relaxed mb-8">
           Ringkasan sejarah berdirinya GKKA Indonesia Jemaat Samarinda. Silakan lengkapi isi sesuai data gereja.
        </p>
        
        <div class="space-y-4">
           <details class="group p-4 bg-blue-50 rounded-2xl cursor-pointer open:bg-blue-100 transition-colors">
              <summary class="font-black text-blue-900 text-lg list-none flex justify-between items-center">
                Visi
                <span class="transform group-open:rotate-180 transition-transform">▼</span>
              </summary>
              <div class="mt-3 text-slate-700 font-medium">Menjadi jemaat yang bertumbuh dalam iman, kasih, dan pelayanan.</div>
           </details>
           <details class="group p-4 bg-blue-50 rounded-2xl cursor-pointer open:bg-blue-100 transition-colors">
              <summary class="font-black text-blue-900 text-lg list-none flex justify-between items-center">
                Misi
                <span class="transform group-open:rotate-180 transition-transform">▼</span>
              </summary>
              <div class="mt-3 text-slate-700 font-medium">Membangun persekutuan, pemuridan, dan penginjilan yang berdampak.</div>
           </details>
        </div>

        <div class="mt-8">
           <a href="{{ route('gereja.sejarah') }}" class="inline-flex items-center gap-2 font-bold text-blue-600 hover:text-blue-800 transition-colors">
             Lihat Selengkapnya <span class="text-xl">→</span>
           </a>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- MAJELIS SECTION --}}
<section class="gkka-section majelis-pattern-bg">
  <div class="gkka-container">
    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-12">
      <div>
        <h2 class="text-3xl md:text-4xl font-black text-blue-900">Majelis GKKA Samarinda</h2>
        <p class="mt-2 text-slate-600 font-medium">Klik kartu untuk melihat “About Majelis”.</p>
      </div>
      <a href="{{ route('gereja.majelis') }}" class="inline-flex items-center gap-2 font-black text-blue-600 hover:text-blue-800 transition-colors">
        Lihat Semua <span class="text-xl">→</span>
      </a>
    </div>

    @if(isset($majelisPeriods) && $majelisPeriods->isNotEmpty())
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($majelisPeriods as $p)
          @php
            $thumb = $p->thumbnail_path ? asset('storage/'.$p->thumbnail_path) : asset('assets/logo.png');
          @endphp
          <a href="{{ route('gereja.majelis.show', ['period' => $p->period]) }}"
             class="group block bg-white rounded-3xl overflow-hidden shadow-xl border border-gray-100 hover:-translate-y-1 hover:shadow-2xl transition-all duration-300">
            <div class="h-44 overflow-hidden relative bg-white">
              <img src="{{ $thumb }}" alt="Periode {{ $p->period }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
              <div class="absolute inset-0 bg-blue-900/0 group-hover:bg-blue-900/15 transition-colors duration-300"></div>
            </div>
            <div class="p-6">
              <div class="flex items-center justify-between gap-3 mb-2">
                <div class="text-xs font-black uppercase tracking-wider text-blue-700 bg-blue-50 px-3 py-1 rounded-full">
                  Periode
                </div>
                <div class="text-xs font-bold text-slate-500">{{ $p->period }}</div>
              </div>
              <h3 class="text-lg font-black text-slate-900 group-hover:text-blue-700 transition-colors">Majelis Periode {{ $p->period }}</h3>
              @if(!empty($p->about))
                <p class="mt-2 text-slate-600 font-medium leading-relaxed line-clamp-2">{{ $p->about }}</p>
              @endif
            </div>
          </a>
        @endforeach
      </div>
    @else
      <div class="bg-slate-50 rounded-3xl border border-gray-100 p-10 text-center text-slate-500 font-bold">
        Data periode majelis belum tersedia.
      </div>
    @endif
  </div>
</section>

{{-- KOMISI SECTION --}}
<section class="gkka-section bg-slate-50">
  <div class="gkka-container">
    <h2 class="text-center text-3xl md:text-4xl font-black text-blue-900 mb-12">Komisi GKKA Samarinda</h2>

    @php
      $komisiCards = [
        [
          'label' => 'Komisi',
          'title' => 'Komisi Sekolah Minggu Narwastu',
          'date' => 'Pelayanan anak & keluarga',
          'excerpt' => 'Mendampingi pertumbuhan iman anak melalui pengajaran firman, ibadah, dan kegiatan pembinaan.',
          'image' => asset('img/sekolah minggu.jpeg'),
        ],
        [
          'label' => 'Komisi',
          'title' => 'Komisi Remaja Betania',
          'date' => 'Pembinaan remaja',
          'excerpt' => 'Ruang bertumbuh bersama, pemuridan, dan pelayanan bagi remaja di GKKA Samarinda.',
          'image' => asset('img/remajaa.jpeg'),
        ],
        [
          'label' => 'Komisi',
          'title' => 'Komisi Pemuda Eirene',
          'date' => 'Pembinaan pemuda',
          'excerpt' => 'Persekutuan, pemuridan, dan pelayanan bersama untuk pemuda di GKKA Samarinda.',
          'image' => asset('img/pemuda.jpeg'),
        ],
        [
          'label' => 'Komisi',
          'title' => 'Komisi Wanita Rut',
          'date' => 'Persekutuan wanita',
          'excerpt' => 'Persekutuan, doa, dan pelayanan yang menguatkan keluarga serta jemaat melalui karya kasih.',
          'image' => asset('img/komisiwanita.jpeg'),
        ],
        [
          'label' => 'Komisi',
          'title' => 'Komisi Pria Hizkia',
          'date' => 'Pembinaan pria',
          'excerpt' => 'Membangun karakter, keteladanan, dan kepekaan pelayanan melalui firman dan persekutuan.',
          'image' => asset('img/komisi bapapk.jpeg'),
        ],
      ];
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
      @foreach($komisiCards as $card)
        <x-komisi-card
          variant="detailed"
          :href="route('gereja.komisi')"
          :title="$card['title']"
          :image="$card['image']"
          :label="$card['label']"
          :meta="$card['date']"
          :excerpt="$card['excerpt']"
        />
      @endforeach
    </div>
  </div>
</section>

{{-- EVENTS SECTION --}}
<section class="gkka-section bg-white">
  <div class="gkka-container">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-end gap-4 mb-12">
       <h2 class="text-3xl md:text-4xl font-black text-blue-900">Event Terbaru</h2>
       <a href="{{ route('event') }}" class="font-bold text-blue-600 hover:text-blue-800 transition-colors">Lihat Semua Event →</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-[1.65fr_1fr] gap-10">
       {{-- Featured Event --}}
       <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden group">
         @if(!empty($featuredEvent))
           @php
             $thumb = $featuredEvent->thumbnail_path
               ? asset('storage/'.$featuredEvent->thumbnail_path)
               : ($featuredEvent->photo_path ? asset('storage/'.$featuredEvent->photo_path) : asset('assets/logo.png'));
           @endphp
           <a href="{{ route('event.show', $featuredEvent) }}" class="block">
             <div class="h-[300px] md:h-[400px] w-full bg-cover bg-center group-hover:scale-105 transition-transform duration-700" style="background-image:url('{{ $thumb }}');"></div>
             <div class="relative p-8 bg-white z-10 -mt-10 mx-6 rounded-2xl shadow-lg border border-gray-100">
                <div class="flex items-center gap-3 text-sm font-bold text-gray-500 mb-3">
                   @if($featuredEvent->start_date)
                     <span class="text-blue-600">{{ optional($featuredEvent->start_date)->translatedFormat('d F Y') }}</span>
                   @endif
                   @if($featuredEvent->location)
                     <span>•</span> <span>{{ $featuredEvent->location }}</span>
                   @endif
                </div>
                <h3 class="text-2xl font-black text-slate-800 mb-4 group-hover:text-blue-700 transition-colors">{{ $featuredEvent->title }}</h3>
                @if($featuredEvent->description)
                  <p class="text-slate-600 line-clamp-3">{{ \Illuminate\Support\Str::limit($featuredEvent->description, 160) }}</p>
                @endif
             </div>
           </a>
         @else
           <div class="p-12 text-center text-gray-400 font-bold bg-gray-50">
             Belum ada event yang dipublish.
           </div>
         @endif
       </div>

       {{-- Side List --}}
       <aside class="space-y-6">
          <h3 class="font-black text-xl text-blue-900 mb-6 border-l-4 border-yellow-500 pl-4">Last Post</h3>
          <div class="space-y-4">
            @forelse(($eventList ?? collect()) as $it)
              @php
                $thumb = $it->thumbnail_path
                  ? asset('storage/'.$it->thumbnail_path)
                  : ($it->photo_path ? asset('storage/'.$it->photo_path) : asset('assets/logo.png'));
              @endphp
              <a href="{{ route('event.show', $it) }}" class="flex gap-4 p-3 rounded-2xl bg-white hover:bg-blue-50 border border-gray-100 hover:border-blue-200 transition-all duration-300 group">
                <div class="w-24 h-24 rounded-xl bg-cover bg-center flex-shrink-0 group-hover:shadow-md transition-shadow" style="background-image:url('{{ $thumb }}');"></div>
                <div class="flex flex-col justify-center">
                  <h4 class="font-bold text-slate-800 group-hover:text-blue-700 mb-1">{{ $it->title }}</h4>
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
              <div class="text-gray-400 text-sm font-bold p-4 text-center">Belum ada event lainnya.</div>
            @endforelse
          </div>
       </aside>
    </div>
  </div>
</section>

{{-- CTA SECTION --}}
<section class="py-20 sm:py-24 bg-blue-900 relative overflow-hidden text-center text-white">
   <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
   <div class="relative z-10 max-w-3xl mx-auto px-4 sm:px-6">
      <h2 class="text-3xl md:text-5xl font-black mb-8 tracking-tight">Temukan kekuatan iman &<br>Pertumbuhan Rohan</h2>
      <a href="{{ route('kontak') }}" class="inline-block px-10 py-4 rounded-full bg-yellow-500 text-blue-900 font-black text-lg shadow-xl hover:bg-yellow-400 hover:scale-105 transition-all duration-300">
        Hubungi Kami
      </a>
   </div>
</section>

@endsection
