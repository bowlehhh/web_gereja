@extends('layout.admin')

@section('title', 'Kelola Hamba Tuhan - GKKA Samarinda')
@section('admin_heading','Kelola Hamba Tuhan')

@section('content')
<div class="flex items-end justify-between gap-4 flex-wrap mb-6">
  <div>
    <h1 class="text-2xl font-black tracking-tight text-blue-900">Kelola Hamba Tuhan</h1>
    <p class="text-blue-900 font-semibold mt-1">Tambah, edit, hapus data hamba Tuhan.</p>
  </div>

  <div class="flex gap-2 flex-wrap">
    <a class="h-10 px-4 rounded-xl border border-blue-900 bg-white hover:bg-blue-50 text-blue-900 font-extrabold text-sm inline-flex items-center transition"
       href="{{ route('gereja.hamba') }}" target="_blank">Lihat Publik</a>
    <a class="h-10 px-4 rounded-xl bg-blue-900 hover:opacity-90 text-white font-extrabold text-sm inline-flex items-center shadow-md transition"
       href="{{ route('admin.hamba.create') }}">+ Tambah</a>
  </div>
</div>

@if(session('ok'))
  <div class="mb-6 rounded-xl border border-blue-900 bg-blue-50 text-blue-900 font-bold p-4 shadow-sm">
    {{ session('ok') }}
  </div>
@endif

@if(isset($table_ready) && $table_ready === false)
  <div class="mb-6 rounded-xl border border-blue-900 bg-blue-50 text-blue-900 font-bold p-4">
    Database belum siap: tabel <b>hamba_tuhans</b> belum ada. Jalankan <b>php artisan migrate</b> lalu buka ulang halaman ini.
  </div>
@endif

<div class="grid gap-4">
  @forelse($items as $item)
    <div class="rounded-2xl border border-blue-100 bg-white shadow-sm p-6 flex items-center justify-between gap-4 flex-wrap hover:shadow-md transition">
      <div class="flex items-center gap-4 min-w-0">
        <div class="size-16 rounded-2xl overflow-hidden bg-blue-50 border border-blue-100 shrink-0">
          @if($item->photo_path)
            <img src="{{ asset('storage/'.$item->photo_path) }}" alt="{{ $item->name }}" class="w-full h-full object-cover block">
          @endif
        </div>
        <div class="min-w-0">
          <div class="font-black text-blue-900 text-lg truncate">{{ $item->name }}</div>
          <div class="text-sm text-blue-800 font-medium mt-1">
            <span class="font-bold">{{ $item->is_active ? 'AKTIF' : 'NONAKTIF' }}</span> • Urutan {{ $item->sort_order }}
            @if($item->contact) • Kontak: {{ $item->contact }} @endif
          </div>
        </div>
      </div>

      <div class="flex gap-2 flex-wrap">
        <a class="h-10 px-4 rounded-xl border border-blue-900 bg-white hover:bg-blue-50 text-blue-900 font-extrabold text-sm inline-flex items-center transition"
           href="{{ route('gereja.hamba.show', $item) }}" target="_blank">Lihat</a>
        <a class="h-10 px-4 rounded-xl border border-blue-900 bg-white hover:bg-blue-50 text-blue-900 font-extrabold text-sm inline-flex items-center transition"
           href="{{ route('admin.hamba.edit', $item) }}">Edit</a>
        <form action="{{ route('admin.hamba.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
          @csrf
          @method('DELETE')
          <button class="h-10 px-4 rounded-xl bg-blue-900 hover:opacity-90 text-white font-extrabold text-sm shadow-sm transition"
                  type="submit">Hapus</button>
        </form>
      </div>
    </div>
  @empty
    <div class="rounded-2xl border border-blue-100 bg-white shadow-sm p-8 text-center text-blue-900 font-semibold">
      Belum ada data hamba Tuhan.
    </div>
  @endforelse
</div>
<div class="mt-5">
  @if(method_exists($items, 'links'))
    {{ $items->links() }}
  @endif
</div>
@endsection
