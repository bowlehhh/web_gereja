@extends('layout.admin')

@section('title','Tambah Gallery')
@section('admin_heading','Tambah Gallery')

@section('content')
<div class="rounded-2xl border border-blue-100 bg-white shadow-sm overflow-hidden max-w-4xl">
  <div class="px-6 py-5 border-b border-blue-100 flex items-center justify-between gap-4 flex-wrap bg-blue-50/50">
    <div>
      <div class="text-xl font-black tracking-tight text-blue-900">Tambah Foto Gallery</div>
      <div class="text-blue-900/70 font-semibold text-sm mt-1">Upload foto, isi judul, dan publish.</div>
    </div>
    <a class="h-10 px-4 rounded-xl border border-blue-900 bg-white hover:bg-blue-50 text-blue-900 font-extrabold text-sm inline-flex items-center transition"
       href="{{ route('admin.gallery.index') }}">← Kembali</a>
  </div>

  <div class="px-6 py-8">
    @if ($errors->any())
      <div class="mb-6 rounded-xl border border-blue-900 bg-blue-50 text-blue-900 font-bold p-4">
        {{ $errors->first() }}
      </div>
    @endif

    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="grid gap-6">
        <div>
          <label class="font-extrabold text-sm text-blue-900">Judul</label>
          <input type="text" name="title" value="{{ old('title') }}" required
                 class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
        </div>

        <div>
          <label class="font-extrabold text-sm text-blue-900">Caption (opsional)</label>
          <textarea name="caption" rows="3"
                    class="mt-2 w-full p-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">{{ old('caption') }}</textarea>
        </div>

        <div>
          <label class="font-extrabold text-sm text-blue-900">Foto</label>
          <input type="file" name="photo" accept="image/*" required
                 class="mt-2 w-full rounded-xl border border-blue-200 bg-white text-blue-900 p-2 focus:outline-none focus:ring-2 focus:ring-blue-900 transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-900 hover:file:bg-blue-100">
        </div>

        <label class="inline-flex items-center gap-3 font-extrabold text-sm text-blue-900 cursor-pointer">
          <input type="checkbox" name="is_published" value="1" checked class="size-5 rounded border-blue-300 text-blue-900 focus:ring-blue-900">
          Publish
        </label>

        <div class="flex justify-end pt-4 border-t border-blue-100">
          <button type="submit"
                  class="h-11 px-6 rounded-xl bg-blue-900 hover:opacity-90 text-white font-extrabold text-sm shadow-md transition">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
