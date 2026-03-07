@extends('layout.admin')

@section('title','Kelola Cabang')
@section('admin_heading','Kelola Cabang')
@section('admin_subheading','Kelola foto dan profil cabang GKKA')

@section('content')
<div class="flex items-end justify-between gap-4 flex-wrap mb-6">
  <div>
    <h1 class="text-2xl font-black tracking-tight text-blue-900">Cabang GKKA</h1>
    <p class="text-blue-900/80 font-semibold mt-1">Data cabang yang tampil di beranda dan halaman publik.</p>
  </div>
  <div class="flex gap-2 flex-wrap">
    <a class="h-10 px-4 rounded-xl border border-blue-900 bg-white hover:bg-blue-50 text-blue-900 font-extrabold text-sm inline-flex items-center transition"
       href="{{ route('admin.dashboard') }}">← Dashboard</a>
    <a class="h-10 px-4 rounded-xl bg-blue-900 hover:bg-blue-800 text-white font-extrabold text-sm inline-flex items-center shadow-md transition"
       href="{{ route('admin.cabang.create') }}">+ Tambah Cabang</a>
  </div>
</div>

@if(session('ok'))
  <div class="mb-6 rounded-xl border border-blue-900 bg-blue-50 text-blue-900 font-bold p-4 shadow-sm">
    {{ session('ok') }}
  </div>
@endif

@if($items->count() === 0)
  <div class="rounded-2xl border border-blue-100 bg-white shadow-sm p-10 text-center">
    <div class="text-blue-900 text-xl font-black">Belum Ada Data Cabang</div>
    <p class="mt-2 text-slate-500 font-semibold">Mulai tambahkan cabang pertama agar tampil ke user.</p>
    <a href="{{ route('admin.cabang.create') }}"
       class="mt-5 inline-flex h-10 px-4 items-center rounded-xl bg-blue-900 hover:bg-blue-800 text-white font-extrabold text-sm shadow-md transition">
      Tambah Cabang
    </a>
  </div>
@else
  <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
    @foreach($items as $it)
      @php
        $image = $it->image_path ? asset('storage/'.$it->image_path) : asset('assets/logo.png');
      @endphp
      <article class="group relative overflow-hidden rounded-3xl border border-blue-100 bg-white shadow-sm hover:shadow-xl transition-all duration-300">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-transparent to-blue-100/40 opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none"></div>

        <div class="relative h-52 overflow-hidden">
          <img src="{{ $image }}" alt="{{ $it->name }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
          <div class="absolute inset-0 bg-gradient-to-t from-blue-950/70 via-blue-900/10 to-transparent"></div>
          <div class="absolute top-3 right-3">
            <span class="inline-flex items-center rounded-full px-3 py-1 text-[11px] font-black tracking-wide {{ $it->is_published ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-200 text-slate-600' }}">
              {{ $it->is_published ? 'PUBLISHED' : 'DRAFT' }}
            </span>
          </div>
        </div>

        <div class="relative p-5">
          <div class="flex items-center justify-between gap-3">
            <h3 class="text-xl font-black text-blue-900 leading-tight">{{ $it->name }}</h3>
            <span class="inline-flex items-center rounded-lg bg-blue-50 px-2.5 py-1 text-[11px] font-black text-blue-700">
              Urut {{ $it->sort_order }}
            </span>
          </div>

          <p class="mt-2 text-sm font-bold text-blue-700/85">
            {{ $it->city ?: 'Lokasi cabang belum diisi' }}
          </p>

          <div class="mt-2 text-xs text-slate-500 font-semibold space-y-1">
            @if(!empty($it->address))
              <div>Alamat: {{ $it->address }}</div>
            @endif
            @if(!empty($it->phone))
              <div>Telp: {{ $it->phone }}</div>
            @endif
          </div>

          <p class="mt-3 text-sm text-slate-600 font-medium leading-relaxed line-clamp-3">
            {{ $it->about }}
          </p>

          <div class="mt-5 pt-4 border-t border-blue-100 flex gap-2">
            <a href="{{ route('admin.cabang.edit', $it) }}"
               class="flex-1 h-10 rounded-xl border border-blue-900 bg-white hover:bg-blue-50 text-blue-900 font-extrabold text-sm inline-flex items-center justify-center transition">
              Edit
            </a>
            <form action="{{ route('admin.cabang.destroy', $it) }}"
                  method="POST"
                  data-confirm="Hapus cabang ini?"
                  data-confirm-title="Hapus Cabang"
                  data-confirm-ok="Ya, Hapus"
                  class="flex-1">
              @csrf
              @method('DELETE')
              <button type="submit"
                      class="w-full h-10 rounded-xl bg-blue-900 hover:bg-blue-800 text-white font-extrabold text-sm shadow-sm transition">
                Hapus
              </button>
            </form>
          </div>
        </div>
      </article>
    @endforeach
  </div>

  <div class="mt-8">
    @if(method_exists($items, 'links'))
      {{ $items->links() }}
    @endif
  </div>
@endif
@endsection
