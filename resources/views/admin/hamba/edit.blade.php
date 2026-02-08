@extends('layout.admin')

@section('title', 'Edit Hamba Tuhan - GKKA Samarinda')
@section('admin_heading','Edit Hamba Tuhan')

@section('content')
<div class="flex items-end justify-between gap-4 flex-wrap">
  <div>
    <h1 class="text-2xl font-black tracking-tight">Edit Hamba Tuhan</h1>
    <p class="text-slate-600 font-semibold mt-1">{{ $item->name }}</p>
  </div>
  <div class="flex gap-2 flex-wrap">
    <a class="h-10 px-4 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-extrabold text-sm inline-flex items-center"
       href="{{ route('admin.hamba.index') }}">← Kembali</a>
    <a class="h-10 px-4 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-extrabold text-sm inline-flex items-center"
       href="{{ route('gereja.hamba.show', $item) }}" target="_blank">Lihat Publik</a>
  </div>
</div>

@if(session('ok'))
  <div class="mt-4 rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-800 font-semibold p-3">
    {{ session('ok') }}
  </div>
@endif

<form class="mt-6 rounded-2xl border border-slate-200 bg-white shadow-sm p-5 max-w-3xl"
      method="POST" action="{{ route('admin.hamba.update', $item) }}" enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <div class="grid gap-4">
    <div class="flex items-center gap-4 flex-wrap">
      <div class="size-28 rounded-2xl overflow-hidden bg-slate-100 border border-slate-200">
        @if($item->photo_path)
          <img src="{{ asset('storage/'.$item->photo_path) }}" alt="{{ $item->name }}" class="w-full h-full object-cover block">
        @endif
      </div>
      <div class="min-w-[240px]">
        <label class="font-extrabold text-sm">Ganti Foto</label>
        <input type="file" name="photo" accept=".jpg,.jpeg,.png,.webp"
               class="mt-2 w-full rounded-xl border border-slate-200 bg-white p-2">
        @error('photo') <div class="mt-2 text-rose-700 font-semibold text-sm">{{ $message }}</div> @enderror
      </div>
    </div>

    <div>
      <label class="font-extrabold text-sm">Nama</label>
      <input name="name" value="{{ old('name', $item->name) }}" required maxlength="160"
             class="mt-2 w-full h-11 px-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-100">
      @error('name') <div class="mt-2 text-rose-700 font-semibold text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
      <label class="font-extrabold text-sm">Ringkasan (untuk kartu)</label>
      <input name="roles_summary" value="{{ old('roles_summary', $item->roles_summary) }}" maxlength="255"
             class="mt-2 w-full h-11 px-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-100">
      @error('roles_summary') <div class="mt-2 text-rose-700 font-semibold text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
      <label class="font-extrabold text-sm">Kontak</label>
      <input name="contact" value="{{ old('contact', $item->contact) }}" maxlength="120"
             class="mt-2 w-full h-11 px-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-100">
      @error('contact') <div class="mt-2 text-rose-700 font-semibold text-sm">{{ $message }}</div> @enderror
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
      <div>
        <label class="font-extrabold text-sm">Urutan tampil</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order) }}" min="0" max="1000000"
               class="mt-2 w-full h-11 px-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-100">
        @error('sort_order') <div class="mt-2 text-rose-700 font-semibold text-sm">{{ $message }}</div> @enderror
      </div>
      <div class="flex items-end">
        <label class="inline-flex items-center gap-2 font-extrabold text-sm">
          <input type="checkbox" name="is_active" value="1" {{ old('is_active', $item->is_active) ? 'checked' : '' }}
                 class="size-4 rounded border-slate-300">
          Tampilkan di halaman publik
        </label>
      </div>
    </div>

    <div>
      <label class="font-extrabold text-sm">Profile (halaman detail)</label>
      <textarea name="profile" rows="7"
                class="mt-2 w-full p-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-100">{{ old('profile', $item->profile) }}</textarea>
      @error('profile') <div class="mt-2 text-rose-700 font-semibold text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
      <label class="font-extrabold text-sm">Bidang Pelayanan (halaman detail)</label>
      <textarea name="service_fields" rows="5"
                class="mt-2 w-full p-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-100">{{ old('service_fields', $item->service_fields) }}</textarea>
      @error('service_fields') <div class="mt-2 text-rose-700 font-semibold text-sm">{{ $message }}</div> @enderror
    </div>

    <div class="flex justify-end">
      <button class="h-11 px-5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-sm"
              type="submit">Update</button>
    </div>
  </div>
</form>
@endsection
