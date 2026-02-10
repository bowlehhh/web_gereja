@extends('layout.admin')

@section('title', 'Edit Warta - GKKA Samarinda')
@section('admin_heading','Edit Warta')

@section('content')
<div class="flex items-end justify-between gap-4 flex-wrap mb-6">
  <div>
    <h1 class="text-2xl font-black tracking-tight text-blue-900">Edit Warta</h1>
    <p class="text-blue-900/80 font-semibold mt-1">{{ $warta->title }}</p>
  </div>
  <a class="h-10 px-4 rounded-xl border border-blue-900 bg-white hover:bg-blue-50 text-blue-900 font-extrabold text-sm inline-flex items-center transition"
     href="{{ route('admin.warta.index') }}">← Kembali</a>
</div>

@if($errors->any())
  <div class="mb-6 rounded-xl border border-blue-900 bg-blue-50 text-blue-900 font-bold p-4">
    <div class="font-black mb-2 flex items-center gap-2">
         <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
         Ada error:
    </div>
    <ul class="list-disc pl-5 grid gap-1">
      @foreach($errors->all() as $e)
        <li>{{ $e }}</li>
      @endforeach
    </ul>
  </div>
@endif

<form class="mt-6 rounded-2xl border border-blue-100 bg-white shadow-sm p-6 max-w-3xl"
      action="{{ route('admin.warta.update', $warta) }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <div class="grid gap-6">
    <div>
      <label class="font-extrabold text-sm text-blue-900">Judul</label>
      <input name="title" value="{{ old('title', $warta->title) }}" required
             class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
    </div>

    <div>
      <label class="font-extrabold text-sm text-blue-900">Tanggal</label>
      <input type="date" name="date" value="{{ old('date', optional($warta->date)->format('Y-m-d')) }}"
             class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
    </div>

    <div>
      <label class="font-extrabold text-sm text-blue-900">Edisi</label>
      <input name="edition" value="{{ old('edition', $warta->edition) }}"
             class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
    </div>

    <div>
      <label class="font-extrabold text-sm text-blue-900">Ganti Thumbnail (opsional)</label>
      @if($warta->thumbnail_path)
        <div class="mt-2">
          <img src="{{ asset('storage/'.$warta->thumbnail_path) }}" alt="thumb" class="max-w-[220px] rounded-xl border border-blue-200">
        </div>
      @endif
      <input type="file" name="thumbnail" accept="image/*"
             class="mt-2 w-full rounded-xl border border-blue-200 bg-white text-blue-900 p-2 focus:outline-none focus:ring-2 focus:ring-blue-900 transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-900 hover:file:bg-blue-100">
    </div>

    <div>
      <label class="font-extrabold text-sm text-blue-900">Ganti PDF (opsional)</label>
      @if($warta->pdf_path)
        <div class="mt-2">
          <a href="{{ asset('storage/'.$warta->pdf_path) }}" target="_blank" class="font-extrabold text-blue-900 underline hover:text-blue-700">
            Lihat PDF saat ini
          </a>
        </div>
      @endif
      <input type="file" name="pdf" accept="application/pdf"
             class="mt-2 w-full rounded-xl border border-blue-200 bg-white text-blue-900 p-2 focus:outline-none focus:ring-2 focus:ring-blue-900 transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-900 hover:file:bg-blue-100">
    </div>

    <label class="inline-flex items-center gap-3 font-extrabold text-sm text-blue-900 cursor-pointer">
      <input type="checkbox" name="is_published" value="1" {{ old('is_published', $warta->is_published) ? 'checked' : '' }}
             class="size-5 rounded border-blue-300 text-blue-900 focus:ring-blue-900">
      Publish
    </label>

    <div class="flex gap-3 flex-wrap justify-end pt-4 border-t border-blue-100">
      <button class="h-11 px-6 rounded-xl bg-blue-900 hover:opacity-90 text-white font-extrabold text-sm shadow-md transition"
              type="submit">Update</button>
      <a class="h-11 px-6 rounded-xl border border-blue-900 bg-white hover:bg-blue-50 text-blue-900 font-extrabold text-sm inline-flex items-center transition"
         href="{{ route('admin.warta.index') }}">Batal</a>
    </div>
  </div>
</form>
@endsection
