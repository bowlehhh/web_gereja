@extends('layout.admin')

@section('title', 'Edit Warta - GKKA Samarinda')
@section('admin_heading','Edit Warta')

@section('content')
<div class="flex items-end justify-between gap-4 flex-wrap">
  <div>
    <h1 class="text-2xl font-black tracking-tight">Edit Warta</h1>
    <p class="text-slate-600 font-semibold mt-1">{{ $warta->title }}</p>
  </div>
  <a class="h-10 px-4 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-extrabold text-sm inline-flex items-center"
     href="{{ route('admin.warta.index') }}">← Kembali</a>
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
      action="{{ route('admin.warta.update', $warta) }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <div class="grid gap-4">
    <div>
      <label class="font-extrabold text-sm">Judul</label>
      <input name="title" value="{{ old('title', $warta->title) }}" required
             class="mt-2 w-full h-11 px-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-100">
    </div>

    <div>
      <label class="font-extrabold text-sm">Tanggal</label>
      <input type="date" name="date" value="{{ old('date', optional($warta->date)->format('Y-m-d')) }}"
             class="mt-2 w-full h-11 px-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-100">
    </div>

    <div>
      <label class="font-extrabold text-sm">Edisi</label>
      <input name="edition" value="{{ old('edition', $warta->edition) }}"
             class="mt-2 w-full h-11 px-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-100">
    </div>

    <div>
      <label class="font-extrabold text-sm">Ganti Thumbnail (opsional)</label>
      @if($warta->thumbnail_path)
        <div class="mt-2">
          <img src="{{ asset('storage/'.$warta->thumbnail_path) }}" alt="thumb" class="max-w-[220px] rounded-xl border border-slate-200">
        </div>
      @endif
      <input type="file" name="thumbnail" accept="image/*"
             class="mt-2 w-full rounded-xl border border-slate-200 bg-white p-2">
    </div>

    <div>
      <label class="font-extrabold text-sm">Ganti PDF (opsional)</label>
      @if($warta->pdf_path)
        <div class="mt-2">
          <a href="{{ asset('storage/'.$warta->pdf_path) }}" target="_blank" class="font-extrabold text-emerald-700 underline">
            Lihat PDF saat ini
          </a>
        </div>
      @endif
      <input type="file" name="pdf" accept="application/pdf"
             class="mt-2 w-full rounded-xl border border-slate-200 bg-white p-2">
    </div>

    <label class="inline-flex items-center gap-2 font-extrabold text-sm">
      <input type="checkbox" name="is_published" value="1" {{ old('is_published', $warta->is_published) ? 'checked' : '' }}
             class="size-4 rounded border-slate-300">
      Publish
    </label>

    <div class="flex gap-2 flex-wrap justify-end">
      <button class="h-11 px-5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-sm"
              type="submit">Update</button>
      <a class="h-11 px-5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-extrabold text-sm inline-flex items-center"
         href="{{ route('admin.warta.index') }}">Batal</a>
    </div>
  </div>
</form>
@endsection
