@extends('layout.admin')

@section('title','Tambah Event - GKKA Samarinda')
@section('admin_heading','Tambah Event')

@section('content')
<div class="rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden max-w-4xl">
  <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between gap-4 flex-wrap">
    <div>
      <div class="text-xl font-black tracking-tight">Tambah Event</div>
      <div class="text-slate-600 font-semibold text-sm mt-1">Isi data event, upload thumbnail (opsional). Event baru sebaiknya DRAFT dulu.</div>
    </div>
    <a class="h-10 px-4 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-extrabold text-sm inline-flex items-center"
       href="{{ route('admin.event.index') }}">← Kembali</a>
  </div>

  <div class="px-6 py-6">
    @if($errors->any())
      <div class="mb-5 rounded-xl border border-rose-200 bg-rose-50 text-rose-800 font-semibold p-3">
        <div class="font-black mb-2">Ada error:</div>
        <ul class="list-disc pl-5 grid gap-1">
          @foreach($errors->all() as $e)
            <li>{{ $e }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('admin.event.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="grid gap-4">
        <div>
          <label class="font-extrabold text-sm">Judul</label>
          <input name="title" value="{{ old('title') }}" required
                 class="mt-2 w-full h-11 px-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-100">
        </div>

        <div>
          <label class="font-extrabold text-sm">Deskripsi (opsional)</label>
          <textarea name="description" rows="4"
                    class="mt-2 w-full p-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-100">{{ old('description') }}</textarea>
        </div>

        <div>
          <label class="font-extrabold text-sm">Penjelasan Kegiatan (detail) (opsional)</label>
          <textarea name="content" rows="8"
                    class="mt-2 w-full p-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-100"
                    placeholder="Tulis penjelasan lengkap kegiatan...">{{ old('content') }}</textarea>
          <div class="mt-2 text-slate-500 text-sm font-semibold">Tips: pisahkan paragraf dengan enter.</div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="font-extrabold text-sm">Tanggal Mulai</label>
            <input type="date" name="start_date" value="{{ old('start_date') }}"
                   class="mt-2 w-full h-11 px-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-100">
          </div>
          <div>
            <label class="font-extrabold text-sm">Tanggal Selesai</label>
            <input type="date" name="end_date" value="{{ old('end_date') }}"
                   class="mt-2 w-full h-11 px-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-100">
            <div class="mt-2 text-slate-500 text-sm font-semibold">
              Kosongkan jika 1 hari. Jika diisi, harus sama/lebih besar dari Tanggal Mulai.
            </div>
          </div>
        </div>

        <div>
          <label class="font-extrabold text-sm">Lokasi (opsional)</label>
          <input name="location" value="{{ old('location') }}"
                 class="mt-2 w-full h-11 px-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-100">
        </div>

        <div>
          <label class="font-extrabold text-sm">Thumbnail (jpg/png/webp, max 5MB)</label>
          <input type="file" name="thumbnail" accept=".jpg,.jpeg,.png,.webp"
                 class="mt-2 w-full rounded-xl border border-slate-200 bg-white p-2">
        </div>

        <div>
          <label class="font-extrabold text-sm">Foto Kegiatan (detail) (jpg/png/webp, max 5MB) (opsional)</label>
          <input type="file" name="photo" accept=".jpg,.jpeg,.png,.webp"
                 class="mt-2 w-full rounded-xl border border-slate-200 bg-white p-2">
        </div>

        <div>
          <label class="font-extrabold text-sm">Video Upload (mp4/webm/ogg, max 50MB) (opsional)</label>
          <input type="file" name="video" accept="video/mp4,video/webm,video/ogg"
                 class="mt-2 w-full rounded-xl border border-slate-200 bg-white p-2">
          <div class="mt-2 text-slate-500 text-sm font-semibold">Jika diisi, video upload akan ditampilkan di halaman detail event.</div>
        </div>

        <div>
          <label class="font-extrabold text-sm">YouTube URL (opsional)</label>
          <input name="youtube_url" value="{{ old('youtube_url') }}" placeholder="Contoh: https://www.youtube.com/watch?v=xxxx"
                 class="mt-2 w-full h-11 px-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-100">
          <div class="mt-2 text-slate-500 text-sm font-semibold">Opsional. Kalau ada video upload, YouTube tetap bisa dipakai sebagai cadangan.</div>
        </div>

        <label class="inline-flex items-center gap-2 font-extrabold text-sm">
          <input type="checkbox" name="is_published" value="1" {{ old('is_published', false) ? 'checked' : '' }}
                 class="size-4 rounded border-slate-300">
          Publish
        </label>

        <div class="flex gap-2 flex-wrap justify-end pt-2">
          <button class="h-11 px-5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-sm"
                  type="submit">Simpan</button>
          <a class="h-11 px-5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-extrabold text-sm inline-flex items-center"
             href="{{ route('admin.event.index') }}">Batal</a>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
