<footer class="bg-blue-900 text-white pt-16 pb-8">
  <div class="w-full max-w-7xl mx-auto px-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
      
      {{-- Brand & Contact --}}
      <div class="space-y-6">
        <div class="flex items-center gap-4">
          <div class="bg-white p-2 rounded-xl shadow-lg">
             <img class="w-12 h-12 object-contain" src="{{ asset('assets/logo.png') }}" alt="Logo GKKA">
          </div>
          <div>
            <div class="font-black text-lg leading-tight tracking-wide">GKKA Indonesia</div>
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
        <h3 class="font-black text-lg mb-6 tracking-wide border-b-2 border-blue-700 pb-2 inline-block">Gereja</h3>
        <ul class="space-y-3">
          <li><a href="{{ route('gereja.sejarah') }}" class="text-blue-200 hover:text-white hover:pl-2 transition-all duration-300 font-medium">Sejarah</a></li>
          <li><a href="{{ route('gereja.hamba') }}" class="text-blue-200 hover:text-white hover:pl-2 transition-all duration-300 font-medium">Hamba Tuhan</a></li>
          <li><a href="{{ route('gereja.majelis') }}" class="text-blue-200 hover:text-white hover:pl-2 transition-all duration-300 font-medium">Majelis</a></li>
          <li><a href="{{ route('gereja.komisi') }}" class="text-blue-200 hover:text-white hover:pl-2 transition-all duration-300 font-medium">Komisi</a></li>
        </ul>
      </div>

      {{-- Event Links --}}
      <div>
        <h3 class="font-black text-lg mb-6 tracking-wide border-b-2 border-blue-700 pb-2 inline-block">Event</h3>
        <ul class="space-y-3">
          <li><a href="{{ route('event') }}" class="text-blue-200 hover:text-white hover:pl-2 transition-all duration-300 font-medium">Event Terbaru</a></li>
        </ul>
      </div>

      {{-- Lainnya Links --}}
      <div>
        <h3 class="font-black text-lg mb-6 tracking-wide border-b-2 border-blue-700 pb-2 inline-block">Lainnya</h3>
        <ul class="space-y-3">
          <li><a href="{{ route('media') }}" class="text-blue-200 hover:text-white hover:pl-2 transition-all duration-300 font-medium">Media</a></li>
          <li><a href="{{ route('gallery') }}" class="text-blue-200 hover:text-white hover:pl-2 transition-all duration-300 font-medium">Gallery</a></li>
          <li><a href="{{ route('warta') }}" class="text-blue-200 hover:text-white hover:pl-2 transition-all duration-300 font-medium">Warta Jemaat</a></li>
          <li><a href="{{ route('kontak') }}" class="text-blue-200 hover:text-white hover:pl-2 transition-all duration-300 font-medium">Kontak</a></li>
        </ul>
      </div>

    </div>

    <div class="mt-16 pt-8 border-t border-blue-800 text-center text-blue-400 text-sm font-bold tracking-wide">
      &copy; {{ date('Y') }} GKKA Samarinda. All rights reserved.
    </div>
  </div>
</footer>
