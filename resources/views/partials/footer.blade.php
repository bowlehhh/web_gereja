<footer class="bg-blue-900 text-white pt-6 sm:pt-7 md:pt-10 pb-3 sm:pb-4 md:pb-6">
  <div class="gkka-container">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 md:gap-8 lg:gap-10">
      
      {{-- Brand & Contact --}}
      <div class="sm:col-span-2 lg:col-span-1 space-y-2 md:space-y-4">
        <div class="flex items-center gap-3 md:gap-4">
          <div class="bg-white p-2 rounded-xl shadow-lg">
             <img class="w-8 h-8 md:w-10 md:h-10 object-contain" src="{{ asset('assets/logo.png') }}" alt="Logo GKKA">
          </div>
          <div>
            <div class="font-black text-sm md:text-base leading-tight tracking-wide">GKKA-I INDONESIA</div>
            <div class="text-blue-300 font-bold text-xs md:text-sm tracking-widest uppercase">Jemaat Samarinda</div>
          </div>
        </div>
        <div class="text-blue-100 text-xs sm:text-sm leading-relaxed font-medium">
          @php
            $adminEmail = 'gkkaisamarinda@yahoo.com';
            $adminPhoneDisplay = '+62 823-5052-6337';
            $adminPhoneTel = '+6282350526337';
            $adminWa = 'https://wa.me/6282350526337';
            $adminInstagramHandle = '@gkkaismr';
            $adminInstagramUrl = 'https://www.instagram.com/gkkaismr/';
            $alamat = 'Jl. Sentosa No.25, Sungai Pinang Dalam, Kec. Sungai Pinang, Kota Samarinda, Kalimantan Timur 75117';
          @endphp

          <p class="mb-2">{{ $alamat }}</p>
          <p class="flex flex-wrap gap-x-3 gap-y-1 items-center">
            <a class="underline decoration-white/30 hover:decoration-white hover:text-white transition" href="mailto:{{ $adminEmail }}">{{ $adminEmail }}</a>
            <span class="text-white/30 hidden sm:inline">•</span>
            <a class="underline decoration-white/30 hover:decoration-white hover:text-white transition" href="tel:{{ $adminPhoneTel }}">{{ $adminPhoneDisplay }}</a>
            <span class="text-white/30 hidden sm:inline">•</span>
            <a class="underline decoration-white/30 hover:decoration-white hover:text-white transition" href="{{ $adminWa }}" target="_blank" rel="noopener">WhatsApp</a>
            <span class="text-white/30 hidden sm:inline">•</span>
            <a class="underline decoration-white/30 hover:decoration-white hover:text-white transition" href="{{ $adminInstagramUrl }}" target="_blank" rel="noopener">{{ $adminInstagramHandle }}</a>
          </p>
        </div>
      </div>

      {{-- Gereja Links --}}
      <div>
        <h3 class="font-black text-sm md:text-base mb-1.5 md:mb-3 tracking-wide border-b-2 border-blue-700 pb-1 md:pb-2 inline-block">Gereja</h3>
        <ul class="space-y-1.5 md:space-y-2">
          <li><a href="{{ route('gereja.sejarah') }}" class="text-blue-200 hover:text-white hover:pl-1 transition-all duration-300 font-medium text-sm">Sejarah</a></li>
          <li><a href="{{ route('gereja.hamba') }}" class="text-blue-200 hover:text-white hover:pl-1 transition-all duration-300 font-medium text-sm">Hamba Tuhan</a></li>
          <li><a href="{{ route('gereja.majelis') }}" class="text-blue-200 hover:text-white hover:pl-1 transition-all duration-300 font-medium text-sm">Majelis</a></li>
          <li><a href="{{ route('gereja.komisi') }}" class="text-blue-200 hover:text-white hover:pl-1 transition-all duration-300 font-medium text-sm">Komisi</a></li>
          <li><a href="{{ route('cabang') }}" class="text-blue-200 hover:text-white hover:pl-1 transition-all duration-300 font-medium text-sm">Cabang</a></li>
        </ul>
      </div>

      {{-- Event Links --}}
      <div>
        <h3 class="font-black text-sm md:text-base mb-1.5 md:mb-3 tracking-wide border-b-2 border-blue-700 pb-1 md:pb-2 inline-block">Event</h3>
        <ul class="space-y-1.5 md:space-y-2">
          <li><a href="{{ route('event') }}" class="text-blue-200 hover:text-white hover:pl-1 transition-all duration-300 font-medium text-sm">Event Terbaru</a></li>
        </ul>
      </div>

      {{-- Lainnya Links --}}
      <div>
        <h3 class="font-black text-sm md:text-base mb-1.5 md:mb-3 tracking-wide border-b-2 border-blue-700 pb-1 md:pb-2 inline-block">Lainnya</h3>
        <ul class="space-y-1.5 md:space-y-2">
          <li><a href="{{ route('media') }}" class="text-blue-200 hover:text-white hover:pl-1 transition-all duration-300 font-medium text-sm">Media</a></li>
          <li><a href="{{ route('renungan') }}" class="text-blue-200 hover:text-white hover:pl-1 transition-all duration-300 font-medium text-sm">Renungan</a></li>
          <li><a href="{{ route('gallery') }}" class="text-blue-200 hover:text-white hover:pl-1 transition-all duration-300 font-medium text-sm">Gallery</a></li>
          <li><a href="{{ route('warta') }}" class="text-blue-200 hover:text-white hover:pl-1 transition-all duration-300 font-medium text-sm">Warta Jemaat</a></li>
          <li><a href="{{ route('kontak') }}" class="text-blue-200 hover:text-white hover:pl-1 transition-all duration-300 font-medium text-sm">Kontak</a></li>
        </ul>
      </div>

    </div>

    @php
      $visitorStats = is_array($visitorStats ?? null) ? $visitorStats : ['daily' => 0, 'monthly' => 0, 'yearly' => 0];
      $dailyVisitors = number_format((int) ($visitorStats['daily'] ?? 0), 0, ',', '.');
      $monthlyVisitors = number_format((int) ($visitorStats['monthly'] ?? 0), 0, ',', '.');
      $yearlyVisitors = number_format((int) ($visitorStats['yearly'] ?? 0), 0, ',', '.');
    @endphp

    <div class="mt-4 sm:mt-6 md:mt-7 rounded-xl border border-blue-800/80 bg-blue-950/35 p-2.5 sm:p-3">
      <div class="text-blue-100 text-[10px] sm:text-xs font-black tracking-[0.18em] uppercase">Statistik Pengunjung</div>
      <div class="mt-2 grid grid-cols-3 gap-2">
        <div class="rounded-lg border border-blue-700/70 bg-blue-900/55 px-2 py-1.5 sm:px-3 sm:py-2 text-center">
          <div class="text-[9px] sm:text-[10px] font-bold text-blue-200 uppercase tracking-wider">Hari</div>
          <div class="mt-0.5 text-sm sm:text-base font-black text-white leading-none">{{ $dailyVisitors }}</div>
        </div>
        <div class="rounded-lg border border-blue-700/70 bg-blue-900/55 px-2 py-1.5 sm:px-3 sm:py-2 text-center">
          <div class="text-[9px] sm:text-[10px] font-bold text-blue-200 uppercase tracking-wider">Bulan</div>
          <div class="mt-0.5 text-sm sm:text-base font-black text-white leading-none">{{ $monthlyVisitors }}</div>
        </div>
        <div class="rounded-lg border border-blue-700/70 bg-blue-900/55 px-2 py-1.5 sm:px-3 sm:py-2 text-center">
          <div class="text-[9px] sm:text-[10px] font-bold text-blue-200 uppercase tracking-wider">Tahun</div>
          <div class="mt-0.5 text-sm sm:text-base font-black text-white leading-none">{{ $yearlyVisitors }}</div>
        </div>
      </div>
    </div>

    <div class="mt-4 sm:mt-5 md:mt-10 pt-3 md:pt-6 border-t border-blue-800 text-center text-blue-400 text-[11px] sm:text-xs md:text-sm font-bold tracking-wide">
      &copy; {{ date('Y') }} GKKA-I INDONESIA. All rights reserved.
    </div>
  </div>
</footer>
