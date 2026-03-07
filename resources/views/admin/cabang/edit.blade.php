@extends('layout.admin')

@section('title','Edit Cabang')
@section('admin_heading','Edit Cabang')
@section('admin_subheading','Perbarui data cabang GKKA')

@section('content')
<div class="flex items-end justify-between gap-4 flex-wrap mb-6">
  <div>
    <h1 class="text-2xl font-black tracking-tight text-blue-900">Edit Cabang</h1>
    <p class="text-blue-900/80 font-semibold mt-1">Perbarui foto, profil, dan status publish cabang.</p>
  </div>
  <a class="h-10 px-4 rounded-xl border border-blue-900 bg-white hover:bg-blue-50 text-blue-900 font-extrabold text-sm inline-flex items-center transition"
     href="{{ route('admin.cabang.index') }}">← Kembali</a>
</div>

@if(session('ok'))
  <div class="mb-6 rounded-xl border border-blue-900 bg-blue-50 text-blue-900 font-bold p-4 shadow-sm">
    {{ session('ok') }}
  </div>
@endif

@if ($errors->any())
  <div class="mb-6 rounded-xl border border-blue-900 bg-blue-50 text-blue-900 font-bold p-4">
    {{ $errors->first() }}
  </div>
@endif

<form action="{{ route('admin.cabang.update', $cabang) }}" method="POST" enctype="multipart/form-data"
      class="max-w-5xl rounded-3xl border border-blue-100 bg-white shadow-sm overflow-hidden">
  @csrf
  @method('PUT')

  <div class="relative h-72 bg-blue-50 overflow-hidden">
    @php
      $image = $cabang->image_path ? asset('storage/'.$cabang->image_path) : asset('assets/logo.png');
    @endphp
    <img src="{{ $image }}" alt="{{ $cabang->name }}" class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-gradient-to-t from-blue-950/55 via-blue-900/10 to-transparent"></div>
    <div class="absolute bottom-4 left-4 right-4 flex items-center justify-between gap-3">
      <div>
        <div class="text-white/90 text-xs font-black tracking-widest uppercase">Preview</div>
        <div class="text-white text-2xl font-black">{{ $cabang->name }}</div>
      </div>
      <span class="inline-flex items-center rounded-full px-3 py-1 text-[11px] font-black tracking-wide {{ $cabang->is_published ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-200 text-slate-600' }}">
        {{ $cabang->is_published ? 'PUBLISHED' : 'DRAFT' }}
      </span>
    </div>
  </div>

  <div class="p-6 sm:p-8 space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        <label class="font-extrabold text-sm text-blue-900">Nama Cabang</label>
        <input type="text" name="name" required value="{{ old('name', $cabang->name) }}"
               class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
      </div>

      <div>
        <label class="font-extrabold text-sm text-blue-900">Kota / Lokasi</label>
        <input type="text" name="city" value="{{ old('city', $cabang->city) }}" required
               class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        <label class="font-extrabold text-sm text-blue-900">Alamat</label>
        <input type="text" name="address" value="{{ old('address', $cabang->address) }}" required
               class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
      </div>

      <div>
        <label class="font-extrabold text-sm text-blue-900">Email</label>
        <input type="email" name="email" value="{{ old('email', $cabang->email) }}" required
               class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        <label class="font-extrabold text-sm text-blue-900">Telp</label>
        <input type="text" name="phone" value="{{ old('phone', $cabang->phone) }}" required
               class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
      </div>

      <div>
        <label class="font-extrabold text-sm text-blue-900">Penanggung Jawab / Pendeta</label>
        <input type="text" name="pastor" value="{{ old('pastor', $cabang->pastor) }}" required
               class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        <label class="font-extrabold text-sm text-blue-900">Latitude Map</label>
        <input type="number" step="any" name="map_latitude" value="{{ old('map_latitude', $cabang->map_latitude) }}" required
               placeholder="-0.5021836"
               class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
      </div>

      <div>
        <label class="font-extrabold text-sm text-blue-900">Longitude Map</label>
        <input type="number" step="any" name="map_longitude" value="{{ old('map_longitude', $cabang->map_longitude) }}" required
               placeholder="117.1537097"
               class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
      </div>
    </div>
    <p class="-mt-3 text-xs font-semibold text-slate-500">Isi keduanya agar map tampil di halaman detail cabang. Klik kanan titik di Google Maps untuk copy koordinat.</p>

    <div>
      <label class="font-extrabold text-sm text-blue-900">About Cabang</label>
      <textarea name="about" rows="7" required
                class="mt-2 w-full p-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">{{ old('about', $cabang->about) }}</textarea>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        <label class="font-extrabold text-sm text-blue-900">Ganti Foto</label>
        <input type="file" name="photo" accept="image/*" required
               class="mt-2 w-full rounded-xl border border-blue-200 bg-white text-blue-900 p-2 focus:outline-none focus:ring-2 focus:ring-blue-900 transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-900 hover:file:bg-blue-100">
        <p class="mt-2 text-xs font-semibold text-slate-500">Maksimal ukuran foto 20MB.</p>
      </div>

      <div>
        <label class="font-extrabold text-sm text-blue-900">Urutan Tampil</label>
        <input type="number" min="0" name="sort_order" value="{{ old('sort_order', $cabang->sort_order) }}" required
               class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
      </div>
    </div>

    <label class="inline-flex items-center gap-3 font-extrabold text-sm text-blue-900 cursor-pointer">
      <input type="checkbox" name="is_published" value="1" {{ old('is_published', $cabang->is_published) ? 'checked' : '' }}
             class="size-5 rounded border-blue-300 text-blue-900 focus:ring-blue-900">
      Publish ke halaman user
    </label>

    <div class="pt-4 border-t border-blue-100 flex justify-end">
      <button type="submit"
              class="h-11 px-6 rounded-xl bg-blue-900 hover:bg-blue-800 text-white font-extrabold text-sm shadow-md transition">
        Update Cabang
      </button>
    </div>
  </div>
</form>
@endsection
