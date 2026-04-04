@extends('layout.admin')

@section('title', 'Kelola Bidang Pelayanan')
@section('admin_heading', 'Kelola Bidang Pelayanan')
@section('admin_subheading', 'Dashboard bidang dengan satu foto utama dan detail yang lebih rapi')

@section('content')
<div class="mb-6 flex flex-wrap items-end justify-between gap-4">
  <div>
    <h1 class="text-2xl font-black tracking-tight text-blue-900">Bidang Pelayanan</h1>
    <p class="mt-1 font-semibold text-blue-900/80">Atur nama bidang, tahun tampil, deskripsi lengkap, status aktif, dan satu foto utama.</p>
  </div>
  <div class="flex flex-wrap gap-2">
    <a href="{{ route('admin.dashboard') }}" class="inline-flex h-10 items-center rounded-xl border border-blue-900 bg-white px-4 text-sm font-extrabold text-blue-900 transition hover:bg-blue-50">
      ← Dashboard
    </a>
    <a href="{{ route('admin.bidang.create') }}" class="inline-flex h-10 items-center rounded-xl bg-blue-900 px-4 text-sm font-extrabold text-white shadow-md transition hover:bg-blue-800">
      + Tambah Bidang
    </a>
  </div>
</div>

@if(session('ok'))
  <div class="mb-6 rounded-xl border border-blue-900 bg-blue-50 p-4 font-bold text-blue-900 shadow-sm">
    {{ session('ok') }}
  </div>
@endif

@if(!($table_ready ?? true))
  <div class="rounded-3xl border border-dashed border-blue-200 bg-white p-10 text-center shadow-sm">
    <div class="text-xl font-black text-blue-900">Tabel bidang pelayanan belum tersedia</div>
    <p class="mt-2 font-semibold text-slate-500">Jalankan migration terbaru agar modul bidang bisa digunakan.</p>
  </div>
@elseif($items->count() === 0)
  <div class="rounded-3xl border border-blue-100 bg-white p-10 text-center shadow-sm">
    <div class="text-xl font-black text-blue-900">Belum Ada Bidang Pelayanan</div>
    <p class="mt-2 font-semibold text-slate-500">Tambahkan bidang pertama agar dashboard publik langsung terisi.</p>
    <a href="{{ route('admin.bidang.create') }}" class="mt-5 inline-flex h-10 items-center rounded-xl bg-blue-900 px-4 text-sm font-extrabold text-white shadow-md transition hover:bg-blue-800">
      Tambah Bidang
    </a>
  </div>
@else
  <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-3">
    @foreach($items as $item)
      @php
        $photoPath = collect($item->member_photo_paths ?? [])
          ->filter(fn ($path) => is_string($path) && trim($path) !== '')
          ->first();
      @endphp

      <article class="group overflow-hidden rounded-3xl border border-blue-100 bg-white shadow-sm transition-all duration-300 hover:-translate-y-0.5 hover:shadow-xl">
        <div class="border-b border-blue-100 bg-[linear-gradient(135deg,#f7fbff_0%,#eef4ff_100%)] p-5">
          <div class="flex items-start justify-between gap-3">
            <div class="flex items-center">
              @if($photoPath)
                <span class="inline-flex h-11 w-11 items-center justify-center overflow-hidden rounded-full ring-2 ring-white shadow-sm">
                  <img src="{{ asset('storage/'.$photoPath) }}" alt="Foto {{ $item->name }}" class="h-full w-full object-cover" loading="lazy" decoding="async">
                </span>
              @else
                <span class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-blue-200 text-sm font-black text-blue-900">
                  {{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($item->name, 0, 1)) }}
                </span>
              @endif
            </div>

            <span class="inline-flex items-center rounded-full px-3 py-1 text-[11px] font-black tracking-wide {{ $item->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-200 text-slate-600' }}">
              {{ $item->is_active ? 'AKTIF' : 'NONAKTIF' }}
            </span>
          </div>

            <div class="mt-4">
              <h3 class="text-xl font-black leading-tight text-blue-900">{{ $item->name }}</h3>
            <div class="mt-2 flex flex-wrap items-center gap-2">
              <div class="inline-flex items-center rounded-lg bg-white px-2.5 py-1 text-[11px] font-black text-blue-700 shadow-sm">
                Tahun {{ $item->service_year ?? optional($item->created_at)->format('Y') ?? now()->year }}
              </div>
              <div class="inline-flex items-center rounded-lg bg-white px-2.5 py-1 text-[11px] font-black text-blue-700 shadow-sm">
                Urut {{ $item->sort_order }}
              </div>
            </div>
          </div>
        </div>

        <div class="p-5">
          <p class="line-clamp-4 text-sm font-medium leading-relaxed text-slate-600">
            {{ $item->description }}
          </p>

          <div class="mt-4 rounded-2xl bg-slate-50 px-4 py-3 text-xs font-bold text-slate-500">
            {{ $photoPath ? 'Foto bidang utama tersedia' : 'Belum ada foto bidang utama' }}
          </div>

          <div class="mt-5 flex gap-2 border-t border-blue-100 pt-4">
            <a href="{{ route('admin.bidang.edit', $item) }}" class="inline-flex h-10 flex-1 items-center justify-center rounded-xl border border-blue-900 bg-white text-sm font-extrabold text-blue-900 transition hover:bg-blue-50">
              Edit
            </a>
            <form action="{{ route('admin.bidang.destroy', $item) }}" method="POST" class="flex-1" data-confirm="Hapus bidang pelayanan ini?" data-confirm-title="Hapus Bidang Pelayanan" data-confirm-ok="Ya, Hapus">
              @csrf
              @method('DELETE')
              <button type="submit" class="h-10 w-full rounded-xl bg-blue-900 text-sm font-extrabold text-white shadow-sm transition hover:bg-blue-800">
                Hapus
              </button>
            </form>
          </div>
        </div>
      </article>
    @endforeach
  </div>

  <div class="mt-8">
    {{ $items->links() }}
  </div>
@endif
@endsection
