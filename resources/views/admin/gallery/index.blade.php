@extends('layout.admin')

@section('title','Kelola Gallery')
@section('admin_heading','Kelola Gallery')

@section('content')
<div class="flex items-end justify-between gap-4 flex-wrap">
  <div>
    <h1 class="text-2xl font-black tracking-tight">Kelola Gallery</h1>
    <p class="text-slate-600 font-semibold mt-1">Tambah, edit, hapus foto yang tampil ke user.</p>
  </div>
  <div class="flex gap-2 flex-wrap">
    <a class="h-10 px-4 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-extrabold text-sm inline-flex items-center"
       href="{{ route('admin.dashboard') }}">← Dashboard</a>
    <a class="h-10 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-sm inline-flex items-center"
       href="{{ route('admin.gallery.create') }}">+ Tambah</a>
  </div>
</div>

@if(session('ok'))
  <div class="mt-4 rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-800 font-semibold p-3">
    {{ session('ok') }}
  </div>
@endif

@if($items->count() === 0)
  <div class="mt-5 rounded-2xl border border-slate-200 bg-white shadow-sm p-5 text-slate-600 font-semibold">
    Belum ada foto.
  </div>
@else
  <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach($items as $it)
      <div class="rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">
        <div class="h-44 bg-slate-100"
             style="background-image:url('{{ $it->image_path ? asset('storage/'.$it->image_path) : '' }}');background-size:cover;background-position:center;">
        </div>

        <div class="p-4">
          <div class="font-black">{{ $it->title }}</div>
          <div class="text-sm text-slate-600 font-semibold mt-1">
            {{ $it->caption ?? '-' }}<br>
            Status: {{ $it->is_published ? 'PUBLISHED' : 'DRAFT' }}
          </div>

          <div class="mt-4 flex gap-2 flex-wrap">
            <a class="h-10 px-4 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-extrabold text-sm inline-flex items-center"
               href="{{ route('admin.gallery.edit', $it->id) }}">Edit</a>
            <form action="{{ route('admin.gallery.destroy', $it->id) }}" method="POST" onsubmit="return confirm('Hapus foto ini?')">
              @csrf
              @method('DELETE')
              <button type="submit"
                      class="h-10 px-4 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-extrabold text-sm">Hapus</button>
            </form>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  <div class="mt-5">
    {{ $items->links() }}
  </div>
@endif
@endsection
