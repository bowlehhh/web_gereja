@extends('layout.admin')

@section('title','Tambah Media')
@section('admin_heading','Tambah Media')

@section('content')
<div class="rounded-2xl border border-blue-100 bg-white shadow-sm overflow-hidden max-w-4xl">
  <div class="px-6 py-5 border-b border-blue-100 flex items-center justify-between gap-4 flex-wrap bg-blue-50/50">
    <div>
      <div class="text-xl font-black tracking-tight text-blue-900">Tambah Media YouTube</div>
      <div class="text-blue-900/70 font-semibold text-sm mt-1">Thumbnail optional (maks 10MB). Kalau kosong, pakai thumbnail dari YouTube.</div>
    </div>
    <a class="h-10 px-4 rounded-xl border border-blue-900 bg-white hover:bg-blue-50 text-blue-900 font-extrabold text-sm inline-flex items-center transition"
       href="{{ route('admin.media.index') }}">← Kembali</a>
  </div>

  <div class="px-6 py-8">
    @if ($errors->any())
      <div class="mb-6 rounded-xl border border-blue-900 bg-blue-50 text-blue-900 font-bold p-4">
        {{ $errors->first() }}
      </div>
    @endif

    <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="grid gap-6">
        <div>
          <label class="font-extrabold text-sm text-blue-900">Judul</label>
          <input type="text" name="title" value="{{ old('title') }}" required
                 class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <div>
            <label class="font-extrabold text-sm text-blue-900">Pembicara (opsional)</label>
            <input type="text" name="speaker" value="{{ old('speaker') }}"
                   class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
          </div>
          <div>
            <label class="font-extrabold text-sm text-blue-900">Tanggal & Jam (opsional)</label>
            <input type="datetime-local" name="service_at" value="{{ old('service_at') }}"
                   class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
            <div class="mt-1 text-xs font-bold text-slate-500">Format otomatis, contoh: 2026-02-08 10:00 (WITA)</div>
          </div>
        </div>

        <div>
          <label class="font-extrabold text-sm text-blue-900">Link YouTube</label>
          <input type="text" name="youtube_url" value="{{ old('youtube_url') }}" required placeholder="https://www.youtube.com/watch?v=..."
                 class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
        </div>

        <div>
          <label class="font-extrabold text-sm text-blue-900">Thumbnail (opsional, maks 10MB)</label>
          <input type="file" name="thumbnail" accept="image/*"
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

