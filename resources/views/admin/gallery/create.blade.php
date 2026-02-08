@extends('layout.admin')

@section('title','Tambah Gallery')
@section('admin_heading','Tambah Gallery')

@section('content')
<div class="rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden max-w-4xl">
  <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between gap-4 flex-wrap">
    <div>
      <div class="text-xl font-black tracking-tight">Tambah Foto Gallery</div>
      <div class="text-slate-600 font-semibold text-sm mt-1">Upload foto, isi judul, dan publish.</div>
    </div>
    <a class="h-10 px-4 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-extrabold text-sm inline-flex items-center"
       href="{{ route('admin.gallery.index') }}">← Kembali</a>
  </div>

  <div class="px-6 py-6">
    @if ($errors->any())
      <div class="mb-5 rounded-xl border border-rose-200 bg-rose-50 text-rose-800 font-semibold p-3">
        {{ $errors->first() }}
      </div>
    @endif

    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="grid gap-4">
        <div>
          <label class="font-extrabold text-sm">Judul</label>
          <input type="text" name="title" value="{{ old('title') }}" required
                 class="mt-2 w-full h-11 px-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-100">
        </div>

        <div>
          <label class="font-extrabold text-sm">Caption (opsional)</label>
          <textarea name="caption" rows="3"
                    class="mt-2 w-full p-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-100">{{ old('caption') }}</textarea>
        </div>

        <div>
          <label class="font-extrabold text-sm">Foto</label>
          <input type="file" name="photo" accept="image/*" required
                 class="mt-2 w-full rounded-xl border border-slate-200 bg-white p-2">
        </div>

        <label class="inline-flex items-center gap-2 font-extrabold text-sm">
          <input type="checkbox" name="is_published" value="1" checked class="size-4 rounded border-slate-300">
          Publish
        </label>

        <div class="flex justify-end pt-2">
          <button type="submit"
                  class="h-11 px-5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-sm">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
