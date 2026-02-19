@extends('layout.admin')

@section('title', 'Edit Majelis - GKKA Samarinda')
@section('admin_heading','Edit Majelis')

@section('content')
@php
  use Illuminate\Support\Facades\Storage;
@endphp

<div class="flex items-end justify-between gap-4 flex-wrap mb-6">
  <div>
    <h1 class="text-2xl font-black tracking-tight text-blue-900">Edit Majelis</h1>
    <p class="text-blue-900/80 font-semibold mt-1">{{ $item->name }}</p>
  </div>
  <div class="flex gap-2 flex-wrap">
    <a class="h-10 px-4 rounded-xl border border-blue-900 bg-white hover:bg-blue-50 text-blue-900 font-extrabold text-sm inline-flex items-center transition"
       href="{{ route('admin.majelis.index') }}">← Kembali</a>
    <a class="h-10 px-4 rounded-xl border border-blue-900 bg-white hover:bg-blue-50 text-blue-900 font-extrabold text-sm inline-flex items-center transition"
       href="{{ $item->period ? route('gereja.majelis.show', ['period' => $item->period]) : route('gereja.majelis') }}" target="_blank">Lihat Publik</a>
  </div>
</div>

@if(session('ok'))
  <div class="mb-6 rounded-xl border border-blue-900 bg-blue-50 text-blue-900 font-bold p-4 shadow-sm">
    {{ session('ok') }}
  </div>
@endif

<form class="mt-6 rounded-2xl border border-blue-100 bg-white shadow-sm p-6 max-w-3xl"
      method="POST" action="{{ route('admin.majelis.update', $item) }}" enctype="multipart/form-data">
  @csrf
  @method('PUT')

    <div class="grid gap-6">
    <div class="flex items-center gap-6 flex-wrap">
      <div class="size-32 rounded-2xl overflow-hidden bg-blue-50 border border-blue-100 shadow-sm">
        @if($item->photo_path && Storage::disk('public')->exists($item->photo_path))
          <img src="{{ Storage::url($item->photo_path) }}" alt="{{ $item->name }}" class="w-full h-full object-cover block">
        @endif
      </div>
      <div class="min-w-[240px]">
        <label class="font-extrabold text-sm text-blue-900">Ganti Foto</label>
        <input type="file" name="photo" accept=".jpg,.jpeg,.png,.webp"
               class="mt-2 w-full rounded-xl border border-blue-200 bg-white text-blue-900 p-2 focus:outline-none focus:ring-2 focus:ring-blue-900 transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-900 hover:file:bg-blue-100">
        <div class="mt-2 text-blue-900/60 text-sm font-semibold">Maks 20MB.</div>
        @error('photo') <div class="mt-2 text-blue-900 font-bold text-sm bg-blue-50 p-2 rounded-lg border border-blue-100 flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</div> @enderror
      </div>
    </div>

    <div>
      <label class="font-extrabold text-sm text-blue-900">Nama</label>
      <input name="name" value="{{ old('name', $item->name) }}" required maxlength="160"
             class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
      @error('name') <div class="mt-2 text-blue-900 font-bold text-sm bg-blue-50 p-2 rounded-lg border border-blue-100 flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</div> @enderror
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
      <div>
        <label class="font-extrabold text-sm text-blue-900">Jabatan</label>
        <input name="role" value="{{ old('role', $item->role) }}" maxlength="120"
               class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
        @error('role') <div class="mt-2 text-blue-900 font-bold text-sm bg-blue-50 p-2 rounded-lg border border-blue-100 flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</div> @enderror
      </div>
      <div>
        <label class="font-extrabold text-sm text-blue-900">Periode</label>
        <input name="period" value="{{ old('period', $item->period) }}" maxlength="120"
               class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
        @error('period') <div class="mt-2 text-blue-900 font-bold text-sm bg-blue-50 p-2 rounded-lg border border-blue-100 flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</div> @enderror
      </div>
    </div>

    <div>
      <label class="font-extrabold text-sm text-blue-900">Ringkasan (untuk kartu)</label>
      <input name="excerpt" value="{{ old('excerpt', $item->excerpt) }}" maxlength="255"
             class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
      @error('excerpt') <div class="mt-2 text-blue-900 font-bold text-sm bg-blue-50 p-2 rounded-lg border border-blue-100 flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</div> @enderror
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
      <div>
        <label class="font-extrabold text-sm text-blue-900">Urutan tampil</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order) }}" min="0" max="1000000"
               class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
        @error('sort_order') <div class="mt-2 text-blue-900 font-bold text-sm bg-blue-50 p-2 rounded-lg border border-blue-100 flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</div> @enderror
      </div>
      <div class="flex items-end pb-3">
        <label class="inline-flex items-center gap-3 font-extrabold text-sm text-blue-900 cursor-pointer">
          <input type="checkbox" name="is_active" value="1" {{ old('is_active', $item->is_active) ? 'checked' : '' }}
                 class="size-5 rounded border-blue-300 text-blue-900 focus:ring-blue-900">
          Tampilkan di halaman publik
        </label>
      </div>
    </div>

    <div>
      <label class="font-extrabold text-sm text-blue-900">About Majelis (halaman detail)</label>
      <textarea name="about" rows="9"
                class="mt-2 w-full p-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">{{ old('about', $item->about) }}</textarea>
      @error('about') <div class="mt-2 text-blue-900 font-bold text-sm bg-blue-50 p-2 rounded-lg border border-blue-100 flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</div> @enderror
    </div>

    <div class="flex justify-end pt-4 border-t border-blue-100">
      <button class="h-11 px-6 rounded-xl bg-blue-900 hover:opacity-90 text-white font-extrabold text-sm shadow-md transition"
              type="submit">Update</button>
    </div>
  </div>
</form>
@endsection
