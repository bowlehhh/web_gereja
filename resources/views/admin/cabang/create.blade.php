@extends('layout.admin')

@section('title','Tambah Cabang')
@section('admin_heading','Tambah Cabang')
@section('admin_subheading','Tambahkan cabang baru GKKA')

@section('content')
<div class="max-w-5xl rounded-3xl border border-blue-100 bg-white shadow-sm overflow-hidden">
  <div class="px-6 py-5 border-b border-blue-100 flex items-center justify-between gap-4 flex-wrap bg-blue-50/60">
    <div>
      <div class="text-2xl font-black tracking-tight text-blue-900">Tambah Cabang</div>
      <p class="text-blue-900/75 font-semibold mt-1 text-sm">Upload foto cabang dan isi profil singkatnya.</p>
    </div>
    <a class="h-10 px-4 rounded-xl border border-blue-900 bg-white hover:bg-blue-50 text-blue-900 font-extrabold text-sm inline-flex items-center transition"
       href="{{ route('admin.cabang.index') }}">← Kembali</a>
  </div>

  <div class="p-6 sm:p-8">
    @if ($errors->any())
      <div class="mb-6 rounded-xl border border-blue-900 bg-blue-50 text-blue-900 font-bold p-4">
        {{ $errors->first() }}
      </div>
    @endif

    <form action="{{ route('admin.cabang.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
      @csrf

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="font-extrabold text-sm text-blue-900">Nama Cabang</label>
          <input type="text" name="name" value="{{ old('name') }}" required
                 class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
        </div>

        <div>
          <label class="font-extrabold text-sm text-blue-900">Kota / Lokasi</label>
          <input type="text" name="city" value="{{ old('city') }}" required
                 class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="font-extrabold text-sm text-blue-900">Alamat</label>
          <input type="text" name="address" value="{{ old('address') }}" required
                 class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
        </div>

        <div>
          <label class="font-extrabold text-sm text-blue-900">Email</label>
          <input type="email" name="email" value="{{ old('email') }}" required
                 class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="font-extrabold text-sm text-blue-900">Telp</label>
          <input type="text" name="phone" value="{{ old('phone') }}" required
                 class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
        </div>

        <div>
          <label class="font-extrabold text-sm text-blue-900">Penanggung Jawab / Pendeta</label>
          <input type="text" name="pastor" value="{{ old('pastor') }}" required
                 class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="font-extrabold text-sm text-blue-900">Latitude Map</label>
          <input type="number" step="any" name="map_latitude" value="{{ old('map_latitude') }}" required
                 placeholder="-0.5021836"
                 class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
        </div>

        <div>
          <label class="font-extrabold text-sm text-blue-900">Longitude Map</label>
          <input type="number" step="any" name="map_longitude" value="{{ old('map_longitude') }}" required
                 placeholder="117.1537097"
                 class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
        </div>
      </div>
      <p class="-mt-3 text-xs font-semibold text-slate-500">Isi keduanya agar map tampil di halaman detail cabang. Klik kanan titik di Google Maps untuk copy koordinat.</p>

      <div>
        <label class="font-extrabold text-sm text-blue-900">About Cabang</label>
        <textarea name="about" rows="7" required
                  class="mt-2 w-full p-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">{{ old('about') }}</textarea>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="font-extrabold text-sm text-blue-900">Foto Cabang</label>
          <input type="file" name="photo" accept="image/*" required
                 class="mt-2 w-full rounded-xl border border-blue-200 bg-white text-blue-900 p-2 focus:outline-none focus:ring-2 focus:ring-blue-900 transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-900 hover:file:bg-blue-100">
          <p class="mt-2 text-xs font-semibold text-slate-500">Maksimal ukuran foto 20MB. Saran rasio: 4:3 atau 16:9.</p>
        </div>

        <div>
          <label class="font-extrabold text-sm text-blue-900">Urutan Tampil</label>
          <input type="number" min="0" name="sort_order" value="{{ old('sort_order', 0) }}" required
                 class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
          <p class="mt-2 text-xs font-semibold text-slate-500">Nilai kecil tampil lebih awal.</p>
        </div>
      </div>

      <label class="inline-flex items-center gap-3 font-extrabold text-sm text-blue-900 cursor-pointer">
        <input type="checkbox" name="is_published" value="1" checked class="size-5 rounded border-blue-300 text-blue-900 focus:ring-blue-900">
        Publish ke halaman user
      </label>

      <div class="pt-4 border-t border-blue-100 flex justify-end">
        <button type="submit"
                class="h-11 px-6 rounded-xl bg-blue-900 hover:bg-blue-800 text-white font-extrabold text-sm shadow-md transition">
          Simpan Cabang
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
