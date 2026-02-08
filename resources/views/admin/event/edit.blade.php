@extends('layout.admin')

@section('title','Edit Event - GKKA Samarinda')
@section('admin_heading','Edit Event')

@section('content')
<div class="flex items-end justify-between gap-4 flex-wrap">
  <div>
    <h1 class="text-2xl font-black tracking-tight">Edit Event</h1>
    <p class="text-slate-600 font-semibold mt-1">Perbarui data event.</p>
  </div>
  <a class="h-10 px-4 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-extrabold text-sm inline-flex items-center"
     href="{{ route('admin.event.index') }}">← Kembali</a>
</div>

@if($errors->any())
  <div class="mt-4 rounded-xl border border-rose-200 bg-rose-50 text-rose-800 font-semibold p-3">
    <div class="font-black mb-2">Ada error:</div>
    <ul class="list-disc pl-5 grid gap-1">
      @foreach($errors->all() as $e)
        <li>{{ $e }}</li>
      @endforeach
    </ul>
  </div>
@endif

<form class="mt-6 rounded-2xl border border-slate-200 bg-white shadow-sm p-5 max-w-3xl"
      action="{{ route('admin.event.update', $item) }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <div class="grid gap-4">
    <div>
      <label class="font-extrabold text-sm">Judul</label>
      <input name="title" value="{{ old('title', $item->title) }}" required
             class="mt-2 w-full h-11 px-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-100">
    </div>

    <div>
      <label class="font-extrabold text-sm">Deskripsi (opsional)</label>
      <textarea name="description" rows="4"
                class="mt-2 w-full p-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-100">{{ old('description', $item->description) }}</textarea>
    </div>

    <div>
      <label class="font-extrabold text-sm">Penjelasan Kegiatan (detail) (opsional)</label>
      <textarea name="content" rows="8"
                class="mt-2 w-full p-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-100"
                placeholder="Tulis penjelasan lengkap kegiatan...">{{ old('content', $item->content) }}</textarea>
      <div class="mt-2 text-slate-500 text-sm font-semibold">Tips: pisahkan paragraf dengan enter.</div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
      <div>
        <label class="font-extrabold text-sm">Tanggal Mulai</label>
        <input type="date" name="start_date"
               value="{{ old('start_date', $item->start_date ? \Carbon\Carbon::parse($item->start_date)->format('Y-m-d') : '') }}"
               class="mt-2 w-full h-11 px-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-100">
      </div>
      <div>
        <label class="font-extrabold text-sm">Tanggal Selesai</label>
        <input type="date" name="end_date"
               value="{{ old('end_date', $item->end_date ? \Carbon\Carbon::parse($item->end_date)->format('Y-m-d') : '') }}"
               class="mt-2 w-full h-11 px-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-100">
        <div class="mt-2 text-slate-500 text-sm font-semibold">
          Kosongkan jika 1 hari. Jika diisi, harus sama/lebih besar dari Tanggal Mulai.
        </div>
      </div>
    </div>

    <div>
      <label class="font-extrabold text-sm">Lokasi (opsional)</label>
      <input name="location" value="{{ old('location', $item->location) }}"
             class="mt-2 w-full h-11 px-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-100">
    </div>

    <div>
      <label class="font-extrabold text-sm">Thumbnail (opsional)</label>
      @if($item->thumbnail_path)
        <div class="mt-2">
          <img src="{{ asset('storage/'.$item->thumbnail_path) }}" class="max-w-[220px] rounded-xl border border-slate-200">
        </div>
      @endif
      <input type="file" name="thumbnail" accept=".jpg,.jpeg,.png,.webp"
             class="mt-2 w-full rounded-xl border border-slate-200 bg-white p-2">
    </div>

    <div>
      <label class="font-extrabold text-sm">Foto Kegiatan (detail) (opsional)</label>
      @if($item->photo_path)
        <div class="mt-2">
          <img src="{{ asset('storage/'.$item->photo_path) }}" class="max-w-[260px] rounded-xl border border-slate-200">
        </div>
      @endif
      <input type="file" name="photo" accept=".jpg,.jpeg,.png,.webp"
             class="mt-2 w-full rounded-xl border border-slate-200 bg-white p-2">
    </div>

    <div>
      <label class="font-extrabold text-sm">Video Upload (mp4/webm/ogg, max 50MB) (opsional)</label>
      @if($item->video_path)
        <div class="mt-3">
          <video controls class="w-full max-w-[560px] rounded-2xl border border-slate-200 bg-black">
            <source src="{{ asset('storage/'.$item->video_path) }}">
          </video>
        </div>
      @endif
      <input type="file" name="video" accept="video/mp4,video/webm,video/ogg"
             class="mt-2 w-full rounded-xl border border-slate-200 bg-white p-2">
    </div>

    <div>
      <label class="font-extrabold text-sm">YouTube URL (opsional)</label>
      <input name="youtube_url" value="{{ old('youtube_url', $item->youtube_url) }}" placeholder="Contoh: https://www.youtube.com/watch?v=xxxx"
             class="mt-2 w-full h-11 px-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-100">
    </div>

    <label class="inline-flex items-center gap-2 font-extrabold text-sm">
      <input type="checkbox" name="is_published" value="1" {{ old('is_published', $item->is_published) ? 'checked' : '' }}
             class="size-4 rounded border-slate-300">
      Publish
    </label>

    <div class="flex gap-2 flex-wrap justify-end">
      <button class="h-11 px-5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-sm"
              type="submit">Update</button>
      <a class="h-11 px-5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-extrabold text-sm inline-flex items-center"
         href="{{ route('admin.event.index') }}">Batal</a>
    </div>
  </div>
</form>
@endsection

  
