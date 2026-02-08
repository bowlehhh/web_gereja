<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','Dashboard Admin')</title>

  @vite(['resources/css/admin.css'])
</head>
<body class="bg-gradient-to-br from-sky-100 via-blue-100 to-indigo-100 min-h-screen font-sans text-slate-900 @yield('body_class')">
  <div class="flex min-h-screen">

    <!-- Sidebar -->
    @php
      $adminLinks = [
        ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'is' => request()->routeIs('admin.dashboard')],
        ['label' => 'Hamba Tuhan', 'route' => 'admin.hamba.index', 'is' => request()->routeIs('admin.hamba.*')],
        ['label' => 'Warta Jemaat', 'route' => 'admin.warta.index', 'is' => request()->routeIs('admin.warta.*')],
        ['label' => 'Event', 'route' => 'admin.event.index', 'is' => request()->routeIs('admin.event.*')],
        ['label' => 'Gallery', 'route' => 'admin.gallery.index', 'is' => request()->routeIs('admin.gallery.*')],
      ];
    @endphp

    <div id="adminOverlay" class="hidden fixed inset-0 bg-black/40 z-40 md:hidden"></div>

    <aside id="adminSidebar"
           class="w-72 bg-gradient-to-b from-[#0b4a8b] to-[#083a6f] text-white hidden md:flex md:static fixed inset-y-0 left-0 z-50 flex-col">
      <div class="px-6 py-6 text-3xl font-extrabold tracking-wide">
        GKKA Admin
      </div>

      <nav class="flex-1 px-4 space-y-2">
        @foreach($adminLinks as $l)
          <a href="{{ route($l['route']) }}"
             class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold transition
                    {{ $l['is'] ? 'bg-white/20 backdrop-blur' : 'hover:bg-white/20' }}">
            {{ $l['label'] }}
          </a>
        @endforeach
      </nav>

    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-w-0">

      <!-- Navbar -->
      <header class="px-8 py-6 flex justify-between items-center gap-4">
        <div class="flex items-center gap-3 min-w-0">
          <button id="adminBurger"
                  class="md:hidden size-10 rounded-xl bg-white/80 backdrop-blur shadow border border-white/60 font-black"
                  type="button" aria-label="Toggle menu">
            ☰
          </button>

          <div class="min-w-0">
            <h1 class="text-3xl font-bold text-slate-800 truncate">
              @yield('admin_heading', 'Dashboard')
            </h1>
            <p class="text-slate-600 text-sm font-semibold truncate">
              @yield('admin_subheading', 'Have a nice day, Admin ✨')
            </p>
          </div>
        </div>

        <div class="flex items-center gap-3 shrink-0">
          <div class="flex items-center gap-3">
            <span class="text-gray-700 text-sm font-semibold hidden sm:block">
              {{ auth()->user()->email ?? 'Admin' }}
            </span>
            <div class="size-11 rounded-full ring-4 ring-white shadow bg-white grid place-items-center font-black text-slate-700">
              A
            </div>
          </div>

          <a href="{{ route('home') }}"
             class="hidden sm:inline-flex items-center h-10 px-4 rounded-xl bg-white/80 backdrop-blur shadow border border-white/60 font-extrabold text-sm text-slate-700 hover:bg-white">
            Home
          </a>

          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="hidden sm:inline-flex items-center h-10 px-4 rounded-xl bg-white/80 backdrop-blur shadow border border-white/60 font-extrabold text-sm text-slate-700 hover:bg-white">
              Logout
            </button>
          </form>
        </div>
      </header>

      <!-- Content -->
      <main class="px-8 pb-10 space-y-10 overflow-y-auto">
        @yield('content')
      </main>
    </div>
  </div>

  <script>
    (function () {
      const burger = document.getElementById('adminBurger');
      const sidebar = document.getElementById('adminSidebar');
      const overlay = document.getElementById('adminOverlay');
      if (!burger || !sidebar || !overlay) return;

      function openSidebar() {
        sidebar.classList.remove('hidden');
        sidebar.classList.add('flex');
        overlay.classList.remove('hidden');
      }
      function closeSidebar() {
        sidebar.classList.add('hidden');
        sidebar.classList.remove('flex');
        overlay.classList.add('hidden');
      }

      burger.addEventListener('click', () => {
        const isHidden = sidebar.classList.contains('hidden');
        if (isHidden) openSidebar();
        else closeSidebar();
      });

      overlay.addEventListener('click', closeSidebar);
    })();
  </script>
</body>
</html>
