<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','Dashboard Admin')</title>
  @php
    $faviconVersion = @filemtime(public_path('favicon.ico')) ?: time();
  @endphp
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v={{ $faviconVersion }}">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v={{ $faviconVersion }}">

  @vite(['resources/css/admin.css'])
</head>
<body class="bg-slate-50 min-h-screen font-sans text-slate-900 selection:bg-blue-100 selection:text-blue-900 overflow-x-hidden @yield('body_class')">
  <div class="flex min-h-screen">

    <!-- Sidebar -->
    @php
      $adminLinks = [
        [
            'label' => 'Dashboard', 
            'route' => 'admin.dashboard', 
            'is' => request()->routeIs('admin.dashboard'),
            'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'
        ],
        [
            'label' => 'Hamba Tuhan', 
            'route' => 'admin.hamba.index', 
            'is' => request()->routeIs('admin.hamba.*'),
            'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'
        ],
        [
            'label' => 'Majelis',
            'route' => 'admin.majelis.index',
            'is' => request()->routeIs('admin.majelis.*'),
            'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'
        ],
        [
            'label' => 'Warta Jemaat', 
            'route' => 'admin.warta.index', 
            'is' => request()->routeIs('admin.warta.*'),
            'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'
        ],
        [
            'label' => 'Event', 
            'route' => 'admin.event.index', 
            'is' => request()->routeIs('admin.event.*'),
            'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'
        ],
        [
            'label' => 'Gallery', 
            'route' => 'admin.gallery.index', 
            'is' => request()->routeIs('admin.gallery.*'),
            'icon' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z'
        ],
        [
            'label' => 'Media', 
            'route' => 'admin.media.index', 
            'is' => request()->routeIs('admin.media.*'),
            'icon' => 'M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.26a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z M21 12a9 9 0 11-18 0 9 9 0 0118 0z'
        ],
      ];
    @endphp

    <div id="adminOverlay" class="hidden fixed inset-0 bg-slate-900/20 z-40 md:hidden backdrop-blur-sm"></div>

    <aside id="adminSidebar"
           class="w-72 bg-white text-slate-600 hidden md:flex md:static fixed inset-y-0 left-0 z-50 flex-col sidebar-transition border-r border-slate-100 shadow-2xl md:shadow-none md:h-screen">
      
      <!-- Brand -->
      <div class="h-24 flex items-center px-8 border-b border-slate-100">
        <div class="flex items-center gap-3 logo-text group cursor-default">
          <div class="w-10 h-10 min-w-10 min-h-10 bg-gradient-to-br from-blue-900 to-blue-950 rounded-xl flex items-center justify-center shadow-lg shadow-blue-900/20 shrink-0">
            <span class="font-black text-white text-lg">G</span>
          </div>
          <div class="flex flex-col">
            <span class="text-blue-950 font-black tracking-tight text-xl leading-none">GKKA</span>
            <span class="text-slate-400 text-[10px] font-bold tracking-widest uppercase">Admin Panel</span>
          </div>
        </div>
      </div>

      <!-- Nav -->
      <nav class="flex-1 py-8 px-4 space-y-2 overflow-y-auto scrollbar-hide">
        @foreach($adminLinks as $l)
          <a href="{{ route($l['route']) }}"
             class="group flex items-center gap-4 px-5 py-3.5 rounded-2xl font-bold transition-all relative overflow-hidden
                    {{ $l['is'] ? 'bg-gradient-to-br from-blue-900 to-blue-950 text-white shadow-lg shadow-blue-900/30' : 'hover:bg-blue-50 text-slate-500 hover:text-blue-900' }}">
             <div class="w-6 h-6 flex-shrink-0 grid place-items-center relative z-10 transition-transform group-hover:scale-110">
                 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="{{ $l['is'] ? '2.5' : '2' }}" d="{{ $l['icon'] }}"></path></svg>
             </div>
            <span class="whitespace-nowrap sidebar-text opacity-100 transition-opacity duration-300 relative z-10">{{ $l['label'] }}</span>
          </a>
        @endforeach
      </nav>
      
      <!-- Footer / Logout -->
      <div class="p-4 border-t border-slate-100 sidebar-text">
          <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100">
              <div class="flex items-center gap-3 mb-4">
                  <div class="w-10 h-10 min-w-10 min-h-10 rounded-full bg-gradient-to-br from-blue-900 to-blue-950 grid place-items-center text-white font-bold text-sm shadow-md shrink-0">
                      {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                  </div>
                  <div class="overflow-hidden">
                      <div class="text-sm font-bold text-blue-950 truncate">{{ auth()->user()->name ?? 'Administrator' }}</div>
                      <div class="text-xs text-slate-400 truncate">{{ auth()->user()->email ?? 'admin@gkka.ov' }}</div>
                  </div>
              </div>
              <button type="button" id="logoutBtn" 
                      class="w-full h-10 flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 text-white rounded-xl text-xs font-bold transition-all group border border-red-200 shadow-sm">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                  <span>Log Out</span>
              </button>
          </div>
      </div>

    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-w-0 transition-all duration-300 h-screen overflow-hidden" id="mainContent">

      <!-- Navbar -->
      <header class="px-8 py-5 flex justify-between items-center gap-4 bg-transparent sticky top-0 z-30">
        <div class="flex items-center gap-6 min-w-0">
          <!-- Mobile Burger -->
          <button id="adminBurger"
                  class="md:hidden size-11 rounded-2xl bg-white shadow-sm border border-slate-200 text-blue-900 hover:bg-slate-50 grid place-items-center transition active:scale-90"
                  type="button" aria-label="Toggle menu">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"></path></svg>
          </button>
          
          <!-- Desktop Toggle -->
           <button id="adminSidebarToggle"
                  class="hidden md:grid size-11 rounded-2xl bg-white shadow-sm border border-slate-200 text-slate-600 hover:text-blue-900 hover:bg-slate-50 place-items-center transition active:scale-90"
                  type="button" aria-label="Toggle sidebar">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"></path></svg>
          </button>

          <div class="min-w-0">
            <h1 class="text-2xl font-black tracking-tight text-slate-800 truncate">
              @yield('admin_heading', 'Dashboard')
            </h1>
            <p class="text-slate-500 text-xs font-bold uppercase tracking-wider opacity-60 truncate">
              @yield('admin_subheading', 'System Management Control')
            </p>
          </div>
        </div>

        <div class="flex items-center gap-4 shrink-0">
          <a href="{{ route('home') }}"
             class="hidden sm:inline-flex items-center justify-center size-11 rounded-2xl bg-white text-slate-400 hover:text-blue-900 hover:bg-blue-50 border border-slate-200 transition shadow-sm"
             title="Home">
             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
          </a>
        </div>
      </header>

      <!-- Content -->
      <main class="px-8 pb-8 flex-1 overflow-y-auto scrollbar-hide">
        @yield('content')
      </main>
    </div>
  </div>

  <!-- Logout Confirmation Modal -->
  <div id="logoutModal" class="hidden fixed inset-0 z-[60] flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-md opacity-0" id="logoutModalOverlay"></div>
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-sm overflow-hidden relative z-10 scale-90 opacity-0" id="logoutModalContent">
      <div class="p-8 text-center">
        <div class="size-20 rounded-2xl bg-red-50 text-red-600 grid place-items-center mx-auto mb-6">
          <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
        </div>
        <h3 class="text-2xl font-black text-slate-800 mb-2">Konfirmasi Logout</h3>
        <p class="text-slate-500 font-bold mb-8">Apakah Anda yakin ingin keluar dari sistem admin?</p>
        
        <div class="grid grid-cols-2 gap-3">
          <button type="button" id="closeLogoutModal"
                  class="h-12 rounded-2xl border border-slate-200 text-slate-600 font-black hover:bg-slate-50 transition">
            Batal
          </button>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="w-full h-12 rounded-2xl bg-red-600 text-white font-black hover:bg-red-700 shadow-lg shadow-red-200 transition active:scale-95">
              Ya, Logout
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Global Confirm Modal (for delete actions, etc.) -->
  <div id="confirmModal" class="hidden fixed inset-0 z-[70] flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-md opacity-0" id="confirmModalOverlay" data-close="1"></div>
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-sm overflow-hidden relative z-10 scale-90 opacity-0" id="confirmModalContent" role="dialog" aria-modal="true" aria-labelledby="confirmModalTitle">
      <div class="p-8 text-center">
        <div id="confirmModalIconWrap" class="size-20 rounded-2xl bg-red-50 text-red-600 grid place-items-center mx-auto mb-6">
          <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m4 0H5" />
          </svg>
        </div>

        <h3 id="confirmModalTitle" class="text-2xl font-black text-slate-800 mb-2">Konfirmasi</h3>
        <p id="confirmModalMessage" class="text-slate-500 font-bold mb-8">Apakah Anda yakin?</p>

        <div class="grid grid-cols-2 gap-3">
          <button type="button" id="confirmModalCancel"
                  class="h-12 rounded-2xl border border-slate-200 text-slate-600 font-black hover:bg-slate-50 transition">
            Batal
          </button>
          <button type="button" id="confirmModalOk"
                  class="h-12 rounded-2xl bg-red-600 text-white font-black hover:bg-red-700 shadow-lg shadow-red-200 transition active:scale-95">
            Ya, Hapus
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Global Submit Loader -->
  <div id="adminSubmitLoader" class="hidden fixed inset-0 z-[80]">
    <div class="absolute inset-0 bg-slate-900/45 backdrop-blur-sm"></div>
    <div class="relative z-10 flex h-full w-full items-center justify-center p-4">
      <div class="w-full max-w-sm rounded-3xl bg-white p-7 text-center shadow-2xl border border-slate-100">
        <div class="mx-auto mb-4 grid h-16 w-16 place-items-center rounded-2xl bg-blue-50 text-blue-700">
          <svg class="h-8 w-8 animate-spin" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"></circle>
            <path class="opacity-90" d="M12 2a10 10 0 0110 10" stroke="currentColor" stroke-width="3" stroke-linecap="round"></path>
          </svg>
        </div>
        <h3 class="text-xl font-black text-slate-800">Memproses Data</h3>
        <p id="adminSubmitLoaderText" class="mt-2 text-sm font-semibold text-slate-500">Mohon tunggu, data sedang diproses...</p>
      </div>
    </div>
  </div>

  <!-- Network Warning Modal -->
  <div id="adminNetworkModal" class="hidden fixed inset-0 z-[85]">
    <button type="button" id="adminNetworkModalOverlay" class="absolute inset-0 h-full w-full bg-slate-900/45 backdrop-blur-sm cursor-default" aria-label="Tutup"></button>
    <div class="relative z-10 flex h-full w-full items-center justify-center p-4">
      <div class="w-full max-w-md rounded-3xl bg-white p-7 shadow-2xl border border-slate-100">
        <div class="mx-auto mb-4 grid h-16 w-16 place-items-center rounded-2xl bg-amber-50 text-amber-600">
          <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.3" d="M12 9v4m0 4h.01M10.29 3.86l-7.5 13A2 2 0 004.5 20h15a2 2 0 001.71-3.14l-7.5-13a2 2 0 00-3.42 0z" />
          </svg>
        </div>
        <h3 class="text-xl font-black text-slate-800 text-center">Peringatan Jaringan</h3>
        <p id="adminNetworkModalText" class="mt-2 text-sm font-semibold text-slate-500 text-center">
          Upload gagal. Koneksi internet sedang tidak stabil, silakan coba lagi.
        </p>
        <button type="button" id="adminNetworkModalClose"
                class="mt-6 h-12 w-full rounded-2xl bg-blue-900 text-white font-black hover:bg-blue-800 transition">
          Mengerti
        </button>
      </div>
    </div>
  </div>
  
  @vite(['resources/js/admin.js'])
</body>
</html>
