@extends('layout.admin')

@section('title', 'Kelola Renungan - GKKA-I INDONESIA')
@section('admin_heading','Kelola Renungan')
@section('admin_subheading','Tambah, edit, dan publish renungan jemaat')

@section('content')
<div class="flex items-end justify-between gap-4 flex-wrap mb-6">
  <div>
    <h1 class="text-2xl font-black tracking-tight text-blue-900">Kelola Renungan</h1>
    <p class="text-blue-900 font-semibold mt-1">Konten renungan dari ibu gembala untuk halaman publik.</p>
  </div>
  <div class="flex gap-2 flex-wrap">
    <a class="h-10 px-4 rounded-xl border border-blue-900 bg-white hover:bg-blue-50 text-blue-900 font-extrabold text-sm inline-flex items-center transition"
       href="{{ route('admin.dashboard') }}">← Dashboard</a>
    <a class="h-10 px-4 rounded-xl bg-blue-900 hover:opacity-90 text-white font-extrabold text-sm inline-flex items-center shadow-md transition"
       href="{{ route('admin.renungan.create') }}">+ Buat Renungan</a>
  </div>
</div>

@if(session('ok'))
  <div class="mb-6 rounded-xl border border-blue-900 bg-blue-50 text-blue-900 font-bold p-4 shadow-sm">
    {{ session('ok') }}
  </div>
@endif

@if(!empty($migrationMissing))
  <div class="mb-6 rounded-xl border border-amber-300 bg-amber-50 text-amber-900 font-bold p-4 shadow-sm">
    Tabel renungan belum tersedia. Jalankan <code>php artisan migrate</code> lalu refresh halaman ini.
  </div>
@endif

<div class="grid gap-4">
  @forelse($items as $it)
    @php
      $image = $it->image_path ? asset('storage/'.$it->image_path) : asset('assets/logo.png');
    @endphp
    <div class="rounded-2xl border border-blue-100 bg-white shadow-sm p-5 sm:p-6 hover:shadow-md transition">
      <div class="flex items-start justify-between gap-5 flex-wrap">
        <div class="flex items-start gap-4 min-w-0">
          <div class="w-24 h-24 rounded-2xl overflow-hidden border border-blue-100 bg-blue-50 shrink-0">
            <img src="{{ $image }}" alt="{{ $it->title }}" class="w-full h-full object-cover">
          </div>
          <div class="min-w-0">
            <div class="font-black text-blue-900 text-lg line-clamp-1">{{ $it->title }}</div>
            <div class="mt-1 text-sm text-blue-900/80 font-semibold line-clamp-1">{{ $it->scripture_reference }}</div>
            <div class="mt-1 text-xs text-slate-500 font-bold">
              {{ optional($it->published_at)->format('d M Y') }} • Oleh {{ $it->author }} • {{ $it->is_published ? 'PUBLISHED' : 'DRAFT' }}
            </div>
            <p class="mt-2 text-sm text-slate-600 font-medium line-clamp-2">{{ $it->excerpt }}</p>
          </div>
        </div>

        <div class="flex gap-2 flex-wrap">
          <a class="h-10 px-4 rounded-xl border border-blue-200 bg-blue-50 hover:bg-blue-100 text-blue-900 font-extrabold text-sm inline-flex items-center transition"
             href="{{ route('renungan.show', $it) }}" target="_blank">Lihat</a>
          <a class="h-10 px-4 rounded-xl border border-blue-900 bg-white hover:bg-blue-50 text-blue-900 font-extrabold text-sm inline-flex items-center transition"
             href="{{ route('admin.renungan.edit', $it) }}">Edit</a>
          <form
            action="{{ route('admin.renungan.destroy', $it) }}"
            method="POST"
            data-confirm="Hapus renungan ini?"
            data-confirm-title="Hapus Renungan"
            data-confirm-ok="Ya, Hapus"
          >
            @csrf
            @method('DELETE')
            <button class="h-10 px-4 rounded-xl bg-blue-900 hover:opacity-90 text-white font-extrabold text-sm shadow-sm transition"
                    type="submit">Hapus</button>
          </form>
        </div>
      </div>
    </div>
  @empty
    <div class="rounded-2xl border border-blue-100 bg-white shadow-sm p-8 text-center text-blue-900 font-semibold">
      Belum ada data renungan.
    </div>
  @endforelse
</div>

<div class="mt-5">
  @if(method_exists($items, 'links'))
    {{ $items->links() }}
  @endif
</div>
@endsection
