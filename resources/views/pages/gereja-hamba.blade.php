@extends('layout.app')
@section('title','Hamba Tuhan - GKKA Samarinda')
@section('content')
@php
  $bgHero = asset('img/fotogrj.jpeg');

  $collection = $items instanceof \Illuminate\Pagination\AbstractPaginator ? $items->getCollection() : collect($items);
  $hasAny = $collection->isNotEmpty();

  $extractPhone = function (?string $text): ?string {
    $text = trim((string) $text);
    if ($text === '') return null;
    if (preg_match('/(\\+?\\d[\\d\\s\\-().]{7,}\\d)/', $text, $m)) {
      $raw = preg_replace('/[^\\d+]/', '', $m[1]) ?? '';
      return $raw !== '' ? $raw : null;
    }
    return null;
  };

  $extractEmail = function (?string $text): ?string {
    $text = trim((string) $text);
    if ($text === '') return null;
    if (preg_match('/[A-Z0-9._%+-]+@[A-Z0-9.-]+\\.[A-Z]{2,}/i', $text, $m)) {
      return $m[0] ?? null;
    }
    return null;
  };

  $cleanContactLabel = function (?string $contact) use ($extractPhone, $extractEmail): ?string {
    $contact = trim((string) $contact);
    if ($contact === '') return null;
    $email = $extractEmail($contact);
    if ($email) return $email;
    $phone = $extractPhone($contact);
    if ($phone) return $phone;
    return $contact;
  };

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

<section class="relative overflow-hidden bg-gradient-to-b from-sky-50 via-white to-sky-50">
  <div class="absolute inset-0 pointer-events-none">
    <div class="absolute -top-24 -right-24 size-[520px] rounded-full bg-sky-200/60 blur-3xl"></div>
    <div class="absolute -bottom-28 -left-28 size-[520px] rounded-full bg-blue-200/50 blur-3xl"></div>
    <svg class="absolute inset-x-0 top-16 w-full text-blue-200/40" viewBox="0 0 1440 220" fill="none" aria-hidden="true">
      <path d="M0,128 C220,32 420,56 640,120 C860,184 1100,216 1440,88" stroke="currentColor" stroke-width="36" stroke-linecap="round"/>
      <path d="M0,188 C260,96 460,112 700,168 C940,224 1140,236 1440,140" stroke="currentColor" stroke-width="22" stroke-linecap="round" opacity="0.7"/>
    </svg>
  </div>

  <div class="gkka-container pt-28 pb-14 sm:pt-32 sm:pb-16">
    <div class="max-w-2xl">
      <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/80 backdrop-blur border border-slate-200 text-slate-700 font-black tracking-widest uppercase text-xs shadow-sm">
        Gereja
        <span class="text-slate-300">/</span>
        Hamba Tuhan
      </div>
      <h1 class="mt-6 text-3xl sm:text-4xl md:text-5xl font-black tracking-tight text-slate-900">
        <span class="block drop-shadow-[0_14px_36px_rgba(15,23,42,0.18)]">Hamba Tuhan</span>
        <span class="mt-1 inline-block drop-shadow-[0_14px_36px_rgba(15,23,42,0.18)]">
          <span class="relative">
            <span class="absolute -inset-x-2 -inset-y-1 rounded-2xl bg-sky-200/55 blur-[1px]"></span>
            <span class="relative">GKKA Samarinda</span>
          </span>
        </span>
      </h1>
      <p class="mt-3 text-sm sm:text-base text-slate-600 font-semibold">
        Melayani dengan Kasih, Membimbing Jemaat.
      </p>
    </div>

    @if(isset($table_ready) && $table_ready === false)
      <div class="mt-8 bg-yellow-50 border border-yellow-200 p-4 sm:p-5 text-yellow-900 rounded-3xl font-semibold">
        Database belum siap: tabel <span class="font-black">hamba_tuhans</span> belum ada. Jalankan <span class="font-black">php artisan migrate</span> lalu refresh halaman ini.
      </div>
    @endif

    @if(!$hasAny)
      <div class="mt-10 max-w-3xl">
        <div class="rounded-[2.25rem] border border-slate-200 bg-white shadow-xl overflow-hidden">
          <div class="p-7 sm:p-8">
            <div class="text-xs font-black tracking-widest uppercase text-slate-500">Info</div>
            <h2 class="mt-2 text-2xl sm:text-3xl font-black tracking-tight text-slate-900">Belum ada data hamba Tuhan</h2>
            <p class="mt-2 text-sm sm:text-base text-slate-600 font-semibold leading-relaxed">
              Data hamba Tuhan akan tampil di sini setelah ditambahkan di dashboard admin.
            </p>
            <div class="mt-6 flex flex-col sm:flex-row gap-3">
              @auth
                <a href="{{ route('admin.hamba.index') }}"
                   class="h-11 px-6 rounded-2xl bg-blue-700 hover:bg-blue-800 text-white font-black shadow-sm transition inline-flex items-center justify-center">
                  Buka Dashboard
                </a>
              @else
                <a href="{{ route('login') }}"
                   class="h-11 px-6 rounded-2xl bg-blue-700 hover:bg-blue-800 text-white font-black shadow-sm transition inline-flex items-center justify-center">
                  Login Admin
                </a>
              @endauth
              <a href="{{ route('kontak') }}"
                 class="h-11 px-6 rounded-2xl bg-sky-100 hover:bg-sky-200 text-blue-900 font-black shadow-sm transition inline-flex items-center justify-center">
                Hubungi Admin
              </a>
            </div>
          </div>
        </div>
      </div>
    @else
      <div class="mt-10 max-w-6xl">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 items-stretch">
          @foreach($collection as $item)
            @php
              $contactLabel = $cleanContactLabel($item->contact);
              $photo = $item->photo_path ? asset('storage/'.$item->photo_path) : null;
            @endphp

            <div class="relative overflow-hidden rounded-[2.25rem] border border-slate-200 bg-white shadow-xl">
              <div class="absolute inset-0 pointer-events-none">
                <div class="absolute -top-24 -right-28 size-[420px] rounded-full bg-sky-200/70 blur-3xl"></div>
                <div class="absolute -bottom-32 -left-28 size-[460px] rounded-full bg-blue-200/70 blur-3xl"></div>
              </div>

              <div class="relative p-7 sm:p-8">
                <div class="flex items-start justify-between gap-5">
                  <div class="min-w-0">
                    <div class="text-xs font-black tracking-widest uppercase text-blue-700">Hamba Tuhan</div>
                    <div class="mt-3 text-2xl sm:text-3xl font-black tracking-tight text-slate-900 leading-[1.05] line-clamp-2">
                      {{ $item->name }}
                    </div>
                    <div class="mt-2 text-sm font-bold text-slate-700">
                      {{ $item->roles_summary ?: 'Pelayan Tuhan' }}
                    </div>
                  </div>

                  <div class="shrink-0">
                    @if($photo)
                      <div class="size-24 sm:size-32 rounded-[1.75rem] overflow-hidden border border-white/60 shadow-lg bg-white">
                        <img
                          src="{{ $photo }}"
                          alt="{{ $item->name }}"
                          class="w-full h-full object-cover object-top"
                          onerror="this.onerror=null;this.src='{{ asset('assets/logo.png') }}';"
                        >
                      </div>
                    @else
                      <div class="size-24 sm:size-32 rounded-[1.75rem] overflow-hidden border border-white/60 shadow-lg bg-white grid place-items-center">
                        <div class="size-full bg-blue-50 text-blue-300 font-black text-4xl grid place-items-center">
                          {{ $initials($item->name) }}
                        </div>
                      </div>
                    @endif
                  </div>
                </div>

                @if($contactLabel)
                  <div class="mt-6">
                    <div class="text-[11px] font-black tracking-widest uppercase text-slate-400">Kontak</div>
                    <div class="mt-1 text-sm font-semibold text-slate-700 break-words">
                      {{ $contactLabel }}
                    </div>
                  </div>
                @endif

                <div class="mt-7 flex items-center gap-3">
                  <a href="{{ route('gereja.hamba.show', $item) }}"
                     class="h-11 px-6 rounded-2xl bg-sky-100 text-blue-800 font-black shadow-sm hover:bg-blue-700 hover:text-white transition inline-flex items-center justify-center">
                    Lihat Profile
                  </a>
                </div>
              </div>
            </div>
          @endforeach
        </div>

        @if(method_exists($items, 'links'))
          <div class="mt-10">
            {{ $items->links() }}
          </div>
        @endif
      </div>
    @endif
  </div>
</section>
@endsection
