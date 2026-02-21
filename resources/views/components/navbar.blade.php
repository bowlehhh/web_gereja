<header class="fixed w-full top-0 z-50 bg-white shadow-md max-sm:bg-white/95 max-sm:backdrop-blur">
  <div class="gkka-container py-3 flex justify-between items-center">
    
    {{-- BRAND --}}
    <a class="flex items-center gap-3 group shrink-0" href="{{ route('home') }}">
      <img src="{{ asset('assets/logo.png') }}" class="w-10 h-10 object-contain group-hover:scale-105 transition-transform duration-300" alt="Logo GKKA">
      <div>
        <div class="font-black text-lg leading-tight text-blue-900 group-hover:text-blue-700 transition-colors">GKKA Indonesia</div>
        <div class="text-xs text-gray-500 font-bold tracking-wide">Jemaat Samarinda</div>
      </div>
    </a>

    {{-- DESKTOP MENU --}}
    <nav class="hidden lg:flex items-center gap-6">
      <a href="{{ route('home') }}" class="font-bold text-sm text-blue-900 hover:text-yellow-500 transition-colors tracking-wide">BERANDA</a>

      <div class="relative group">
        <button class="font-bold text-sm text-blue-900 hover:text-yellow-500 transition-colors tracking-wide flex items-center gap-1 cursor-pointer">
          GEREJA <svg class="w-3 h-3 group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
        </button>
        <div class="absolute top-full left-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top translate-y-2 group-hover:translate-y-0">
          <div class="py-2">
            <a href="{{ route('gereja.sejarah') }}" class="block px-4 py-2 text-sm hover:bg-blue-50 text-gray-700 hover:text-blue-900 font-semibold transition-colors">SEJARAH</a>
            <a href="{{ route('gereja.hamba') }}" class="block px-4 py-2 text-sm hover:bg-blue-50 text-gray-700 hover:text-blue-900 font-semibold transition-colors">HAMBA TUHAN</a>
            <a href="{{ route('gereja.majelis') }}" class="block px-4 py-2 text-sm hover:bg-blue-50 text-gray-700 hover:text-blue-900 font-semibold transition-colors">MAJELIS</a>
            <a href="{{ route('gereja.komisi') }}" class="block px-4 py-2 text-sm hover:bg-blue-50 text-gray-700 hover:text-blue-900 font-semibold transition-colors">KOMISI</a>
          </div>
        </div>
      </div>

      <a href="{{ route('event') }}" class="font-bold text-sm text-blue-900 hover:text-yellow-500 transition-colors tracking-wide">EVENT</a>
      <a href="{{ route('media') }}" class="font-bold text-sm text-blue-900 hover:text-yellow-500 transition-colors tracking-wide">MEDIA</a>
      <a href="{{ route('kontak') }}" class="font-bold text-sm text-blue-900 hover:text-yellow-500 transition-colors tracking-wide">KONTAK</a>
      <a href="{{ route('gallery') }}" class="font-bold text-sm text-blue-900 hover:text-yellow-500 transition-colors tracking-wide">GALLERY</a>
      <a href="{{ route('warta') }}" class="font-bold text-sm text-blue-900 hover:text-yellow-500 transition-colors tracking-wide">WARTA JEMAAT</a>

      @auth
        <div class="ml-2 flex items-center gap-3">
            <a href="{{ route('admin.dashboard') }}" class="px-5 py-2 rounded-full bg-blue-900 text-white font-bold text-sm hover:bg-blue-800 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">DASHBOARD</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="font-bold text-sm text-red-500 hover:text-red-700 transition">LOGOUT</button>
            </form>
        </div>
      @else
        <a href="{{ route('login') }}" class="ml-2 px-6 py-2 rounded-full bg-blue-900 text-white font-bold text-sm hover:bg-blue-800 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">LOGIN</a>
      @endauth
    </nav>

    {{-- MOBILE TOGGLE --}}
    <button id="mobile-menu-btn" class="lg:hidden p-2 text-blue-900 rounded-lg hover:bg-blue-50 transition-colors focus:outline-none">
      <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16m-7 6h7"></path>
      </svg>
    </button>

  </div>
</header>

{{-- MOBILE SIDEBAR OVERLAY --}}
<div id="mobile-overlay" class="fixed inset-0 bg-black/60 z-[60] hidden opacity-0 transition-opacity duration-300 backdrop-blur-sm"></div>

{{-- MOBILE SIDEBAR --}}
<div id="mobile-sidebar" class="fixed top-0 right-0 w-[85%] max-w-[320px] h-full bg-white z-[70] shadow-2xl flex flex-col hidden rounded-l-3xl overflow-hidden">
    
    {{-- HEADER --}}
    <div class="px-6 pt-8 pb-4 bg-white flex justify-between items-start">
        <div>
            <div class="text-xs font-bold text-blue-600 uppercase tracking-widest mb-1">MENU</div>
            <div class="font-black text-2xl text-slate-900 tracking-tight leading-none">GKKA SAMARINDA</div>
        </div>
        <button id="close-sidebar-btn" class="text-gray-400 hover:text-red-500 transition-colors bg-gray-50 p-2 rounded-full">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
    
    {{-- SCROLLABLE CONTENT --}}
    <div class="flex-1 overflow-y-auto px-6 pb-48 space-y-8" id="mobile-nav-links">
        
        {{-- SECTION: MAIN --}}
        <div>
            <a href="{{ route('home') }}" class="mobile-link w-full py-4 px-6 rounded-xl font-bold text-lg transition-all duration-300 flex items-center gap-3 shadow-md group {{ request()->routeIs('home') ? 'bg-blue-900 text-white shadow-blue-500/30' : 'bg-white text-slate-700 hover:bg-gray-50 border border-gray-100' }}">
                 <div class="w-2 h-2 rounded-full {{ request()->routeIs('home') ? 'bg-white' : 'bg-blue-600' }} group-hover:scale-125 transition-transform"></div>
                 Beranda
            </a>
        </div>

        {{-- SECTION: CHURCH --}}
        <div>
            <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3 px-1">Tentang Gereja</div>
            <div class="space-y-1">
                 <a href="{{ route('gereja.sejarah') }}" class="mobile-link block px-4 py-3 rounded-lg font-bold text-base transition-all duration-200 {{ request()->routeIs('gereja.sejarah') ? 'bg-blue-900 text-white' : 'text-slate-700 hover:bg-gray-50 hover:text-blue-700' }}">
                    Sejarah
                 </a>
                 <a href="{{ route('gereja.hamba') }}" class="mobile-link block px-4 py-3 rounded-lg font-bold text-base transition-all duration-200 {{ request()->routeIs('gereja.hamba*') ? 'bg-blue-900 text-white' : 'text-slate-700 hover:bg-gray-50 hover:text-blue-700' }}">
                    Hamba Tuhan
                 </a>
                 <a href="{{ route('gereja.majelis') }}" class="mobile-link block px-4 py-3 rounded-lg font-bold text-base transition-all duration-200 {{ request()->routeIs('gereja.majelis*') ? 'bg-blue-900 text-white' : 'text-slate-700 hover:bg-gray-50 hover:text-blue-700' }}">
                    Majelis
                 </a>
                 <a href="{{ route('gereja.komisi') }}" class="mobile-link block px-4 py-3 rounded-lg font-bold text-base transition-all duration-200 {{ request()->routeIs('gereja.komisi') ? 'bg-blue-900 text-white' : 'text-slate-700 hover:bg-gray-50 hover:text-blue-700' }}">
                    Komisi
                 </a>
            </div>
        </div>

        {{-- SECTION: ACTIVITY --}}
        <div>
            <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3 px-1">Aktivitas & Media</div>
             <div class="grid grid-cols-2 gap-3">
                <a href="{{ route('event') }}" class="mobile-link flex flex-col items-center justify-center h-24 rounded-xl transition-all duration-300 group border hover:border-blue-200 {{ request()->routeIs('event*') ? 'bg-blue-900 text-white border-transparent' : 'bg-gray-100 text-slate-800 hover:bg-gray-200 border-transparent' }}">
                    <span class="font-bold text-sm">Event</span>
                </a>
                <a href="{{ route('media') }}" class="mobile-link flex flex-col items-center justify-center h-24 rounded-xl transition-all duration-300 group border hover:border-blue-200 {{ request()->routeIs('media') ? 'bg-blue-900 text-white border-transparent' : 'bg-gray-100 text-slate-800 hover:bg-gray-200 border-transparent' }}">
                    <span class="font-bold text-sm">Media</span>
                </a>
                <a href="{{ route('gallery') }}" class="mobile-link flex flex-col items-center justify-center h-24 rounded-xl transition-all duration-300 group border hover:border-blue-200 {{ request()->routeIs('gallery') ? 'bg-blue-900 text-white border-transparent' : 'bg-gray-100 text-slate-800 hover:bg-gray-200 border-transparent' }}">
                    <span class="font-bold text-sm">Gallery</span>
                </a>
                <a href="{{ route('warta') }}" class="mobile-link flex flex-col items-center justify-center h-24 rounded-xl transition-all duration-300 group border hover:border-blue-200 {{ request()->routeIs('warta') ? 'bg-blue-900 text-white border-transparent' : 'bg-gray-100 text-slate-800 hover:bg-gray-200 border-transparent' }}">
                    <span class="font-bold text-sm">Warta</span>
                </a>
             </div>
        </div>

        {{-- SECTION: CONTACT --}}
        <div>
            <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3 px-1">Hubungi Kami</div>
            <a href="{{ route('kontak') }}" class="mobile-link w-full py-4 px-6 rounded-xl font-bold text-lg transition-all duration-300 flex items-center justify-between group {{ request()->routeIs('kontak') ? 'bg-blue-900 text-white shadow-lg shadow-blue-900/30' : 'bg-slate-900 text-white hover:bg-slate-800 hover:shadow-lg' }}">
                <span>Kontak</span>
                <span class="{{ request()->routeIs('kontak') ? 'bg-white/20' : 'bg-white/10' }} p-1 rounded-md group-hover:bg-white/30 transition-colors">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </span>
            </a>
            <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-3 mb-3 px-1">Login Area</div>
            <a href="{{ route('login') }}" class="mobile-link w-full py-4 px-6 rounded-xl bg-blue-900 text-white font-bold text-lg hover:bg-blue-800 hover:shadow-lg transition-all duration-300 flex items-center justify-between group">
                <span>Login Area</span>
                <span class="bg-white/10 p-1 rounded-md group-hover:bg-white/30 transition-colors">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </span>
            </a>
        </div>

        

    </div>

    {{-- FOOTER --}}
    <div class="absolute bottom-0 w-full p-6 bg-white border-t border-gray-100 z-20">
        @auth
            <div class="flex gap-2">
                <a href="{{ route('admin.dashboard') }}" class="flex-1 text-center py-3 bg-blue-50 text-blue-700 rounded-lg font-bold text-xs uppercase tracking-wider hover:bg-blue-100 transition-colors">
                    Dashboard
                </a>
                <form method="POST" action="{{ route('logout') }}" class="flex-1">
                    @csrf
                    <button class="w-full text-center py-3 border border-red-100 text-red-600 rounded-lg font-bold text-xs uppercase tracking-wider hover:bg-red-50 transition-colors">Keluar</button>
                </form>
            </div>
        @else

        @endauth
    </div>
</div>
