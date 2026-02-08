@extends('layout.admin')

@section('title', 'Kelola Hamba Tuhan - GKKA Samarinda')
@section('admin_heading','Kelola Hamba Tuhan')

@section('content')
<div class="flex items-end justify-between gap-4 flex-wrap">
  <div>
    <h1 class="text-2xl font-black tracking-tight">Kelola Hamba Tuhan</h1>
    <p class="text-slate-600 font-semibold mt-1">Tambah, edit, hapus data hamba Tuhan.</p>
  </div>

  <div class="flex gap-2 flex-wrap">
    <a class="h-10 px-4 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-extrabold text-sm inline-flex items-center"
       href="{{ route('gereja.hamba') }}" target="_blank">Lihat Publik</a>
    <a class="h-10 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-sm inline-flex items-center"
       href="{{ route('admin.hamba.create') }}">+ Tambah</a>
  </div>
</div>

@if(session('ok'))
  <div class="mt-4 rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-800 font-semibold p-3">
    {{ session('ok') }}
  </div>
@endif

@if(isset($table_ready) && $table_ready === false)
  <div class="mt-4 rounded-xl border border-rose-200 bg-rose-50 text-rose-800 font-semibold p-3">
    Database belum siap: tabel <b>hamba_tuhans</b> belum ada. Jalankan <b>php artisan migrate</b> lalu buka ulang halaman ini.
  </div>
@endif

<div class="mt-5 grid gap-3">
  @forelse($items as $item)
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm p-4 flex items-center justify-between gap-4 flex-wrap">
      <div class="flex items-center gap-3 min-w-0">
        <div class="size-14 rounded-2xl overflow-hidden bg-slate-100 border border-slate-200 shrink-0">
          @if($item->photo_path)
            <img src="{{ asset('storage/'.$item->photo_path) }}" alt="{{ $item->name }}" class="w-full h-full object-cover block">
          @endif
        </div>
        <div class="min-w-0">
          <div class="font-black truncate">{{ $item->name }}</div>
          <div class="text-sm text-slate-600 font-semibold">
            {{ $item->is_active ? 'AKTIF' : 'NONAKTIF' }} • Urutan {{ $item->sort_order }}
            @if($item->contact) • Kontak: {{ $item->contact }} @endif
          </div>
        </div>
      </div>

      <div class="flex gap-2 flex-wrap">
        <a class="h-10 px-4 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-extrabold text-sm inline-flex items-center"
           href="{{ route('gereja.hamba.show', $item) }}" target="_blank">Lihat</a>
        <a class="h-10 px-4 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-extrabold text-sm inline-flex items-center"
           href="{{ route('admin.hamba.edit', $item) }}">Edit</a>
        <form action="{{ route('admin.hamba.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
          @csrf
          @method('DELETE')
          <button class="h-10 px-4 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-extrabold text-sm"
                  type="submit">Hapus</button>
        </form>
      </div>
    </div>
  @empty
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm p-4 text-slate-600 font-semibold">
      Belum ada data hamba Tuhan.
    </div>
  @endforelse
</div>

<div class="mt-5">
  {{ $items->links() }}
</div>
@endsection
