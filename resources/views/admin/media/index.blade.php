@extends('layout.admin')

@section('title','Kelola Media')
@section('admin_heading','Kelola Media')

@section('content')
<div class="flex items-end justify-between gap-4 flex-wrap mb-6">
  <div>
    <h1 class="text-2xl font-black tracking-tight text-blue-900">Kelola Media</h1>
    <p class="text-blue-900 font-semibold mt-1">Masukkan link YouTube setelah ibadah live streaming selesai.</p>
  </div>
  <div class="flex gap-2 flex-wrap">
    <a class="h-10 px-4 rounded-xl border border-blue-900 bg-white hover:bg-blue-50 text-blue-900 font-extrabold text-sm inline-flex items-center transition"
       href="{{ route('admin.dashboard') }}">← Dashboard</a>
    <a class="h-10 px-4 rounded-xl bg-blue-900 hover:opacity-90 text-white font-extrabold text-sm inline-flex items-center shadow-md transition"
       href="{{ route('admin.media.create') }}">+ Tambah</a>
  </div>
</div>

@if(session('ok'))
  <div class="mb-6 rounded-xl border border-blue-900 bg-blue-50 text-blue-900 font-bold p-4 shadow-sm">
    {{ session('ok') }}
  </div>
@endif

@if($items->count() === 0)
  <div class="mt-5 rounded-2xl border border-blue-100 bg-white shadow-sm p-8 text-center text-blue-900 font-semibold">
    Belum ada media.
  </div>
@else
  <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($items as $it)
      <div class="rounded-2xl border border-blue-100 bg-white shadow-sm overflow-hidden hover:shadow-md transition group">
        <div class="aspect-[16/9] bg-blue-50 relative overflow-hidden">
          @if($it->thumbnail_url)
            <img src="{{ $it->thumbnail_url }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110" alt="{{ $it->title }}">
          @endif
          <div class="absolute inset-0 bg-gradient-to-t from-blue-950/60 via-transparent to-transparent"></div>
        </div>

        <div class="p-5">
          <div class="font-black text-blue-900 text-lg line-clamp-2">{{ $it->title }}</div>
          <div class="text-sm text-blue-800 font-medium mt-1 space-y-1">
            <div class="opacity-80">{{ $it->speaker ?: '-' }}</div>
            <div class="opacity-80">
              @if($it->service_at)
                {{ $it->service_at->locale('id')->translatedFormat('l, d F Y') }} • Jam {{ $it->service_at->format('H.i') }} WITA
              @else
                -
              @endif
            </div>
            <div>
              Status: <span class="font-bold">{{ $it->is_published ? 'PUBLISHED' : 'DRAFT' }}</span>
            </div>
            <div class="pt-2">
              <a href="{{ $it->youtube_url }}" target="_blank" rel="noopener"
                 class="text-blue-900 font-black hover:underline break-all">Buka YouTube</a>
            </div>
          </div>

          <div class="mt-4 flex gap-2 flex-wrap pt-4 border-t border-blue-50">
            <a class="h-10 px-4 rounded-xl border border-blue-900 bg-white hover:bg-blue-50 text-blue-900 font-extrabold text-sm inline-flex items-center transition flex-1 justify-center"
               href="{{ route('admin.media.edit', $it->id) }}">Edit</a>
            <form action="{{ route('admin.media.destroy', $it->id) }}" method="POST" onsubmit="return confirm('Hapus media ini?')" class="flex-1">
              @csrf
              @method('DELETE')
              <button type="submit"
                      class="w-full h-10 px-4 rounded-xl bg-blue-900 hover:opacity-90 text-white font-extrabold text-sm shadow-sm transition">Hapus</button>
            </form>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  <div class="mt-6">
    @if(method_exists($items, 'links'))
      {{ $items->links() }}
    @endif
  </div>
@endif
@endsection
