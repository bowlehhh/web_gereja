<footer class="bg-blue-900 text-white pt-10 md:pt-12 pb-6">
  <div class="w-full max-w-7xl mx-auto px-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-10">
      
      {{-- Brand & Contact --}}
      <div class="space-y-4">
        <div class="flex items-center gap-4">
          <div class="bg-white p-2 rounded-xl shadow-lg">
             <img class="w-10 h-10 object-contain" src="{{ asset('assets/logo.png') }}" alt="Logo GKKA">
          </div>
          <div>
            <div class="font-black text-base leading-tight tracking-wide">GKKA Indonesia</div>
            <div class="text-blue-300 font-bold text-sm tracking-widest uppercase">Jemaat Samarinda</div>
          </div>
        </div>
        <div class="text-blue-100 text-sm leading-relaxed font-medium">
          <p class="mb-2">Alamat gereja (isi nanti)</p>
          <p>Kontak: 08xx-xxxx-xxxx</p>
        </div>
      </div>

      {{-- Gereja Links --}}
      <div>
        <h3 class="font-black text-base mb-4 tracking-wide border-b-2 border-blue-700 pb-2 inline-block">Gereja</h3>
        <ul class="space-y-2">
          <li><a href="{{ route('gereja.sejarah') }}" class="text-blue-200 hover:text-white hover:pl-1 transition-all duration-300 font-medium">Sejarah</a></li>
          <li><a href="{{ route('gereja.hamba') }}" class="text-blue-200 hover:text-white hover:pl-1 transition-all duration-300 font-medium">Hamba Tuhan</a></li>
          <li><a href="{{ route('gereja.majelis') }}" class="text-blue-200 hover:text-white hover:pl-1 transition-all duration-300 font-medium">Majelis</a></li>
          <li><a href="{{ route('gereja.komisi') }}" class="text-blue-200 hover:text-white hover:pl-1 transition-all duration-300 font-medium">Komisi</a></li>
        </ul>
      </div>

      {{-- Event Links --}}
      <div>
        <h3 class="font-black text-base mb-4 tracking-wide border-b-2 border-blue-700 pb-2 inline-block">Event</h3>
        <ul class="space-y-2">
          <li><a href="{{ route('event') }}" class="text-blue-200 hover:text-white hover:pl-1 transition-all duration-300 font-medium">Event Terbaru</a></li>
        </ul>
      </div>

      {{-- Lainnya Links --}}
      <div>
        <h3 class="font-black text-base mb-4 tracking-wide border-b-2 border-blue-700 pb-2 inline-block">Lainnya</h3>
        <ul class="space-y-2">
          <li><a href="{{ route('media') }}" class="text-blue-200 hover:text-white hover:pl-1 transition-all duration-300 font-medium">Media</a></li>
          <li><a href="{{ route('gallery') }}" class="text-blue-200 hover:text-white hover:pl-1 transition-all duration-300 font-medium">Gallery</a></li>
          <li><a href="{{ route('warta') }}" class="text-blue-200 hover:text-white hover:pl-1 transition-all duration-300 font-medium">Warta Jemaat</a></li>
          <li><a href="{{ route('kontak') }}" class="text-blue-200 hover:text-white hover:pl-1 transition-all duration-300 font-medium">Kontak</a></li>
        </ul>
      </div>

    </div>

    <div class="mt-10 pt-6 border-t border-blue-800 text-center text-blue-400 text-xs sm:text-sm font-bold tracking-wide">
      &copy; {{ date('Y') }} GKKA Samarinda. All rights reserved.
    </div>
  </div>
</footer>
