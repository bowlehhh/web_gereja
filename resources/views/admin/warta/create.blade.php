@extends('layout.admin')

@section('title', 'Buat Warta - GKKA Samarinda')
@section('admin_heading','Buat Warta')

@section('content')
<div class="rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden max-w-4xl">
  <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between gap-4 flex-wrap">
    <div>
      <div class="text-xl font-black tracking-tight">Buat Warta Baru</div>
      <div class="text-slate-600 font-semibold text-sm mt-1">Upload thumbnail + PDF, lalu publish.</div>
    </div>
    <a class="h-10 px-4 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-extrabold text-sm inline-flex items-center"
       href="{{ route('admin.warta.index') }}">← Kembali</a>
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

    <form action="{{ route('admin.warta.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="grid gap-4">
        <div>
          <label class="font-extrabold text-sm">Judul</label>
          <input name="title" value="{{ old('title') }}" required
                 class="mt-2 w-full h-11 px-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-100">
        </div>

        <div>
          <label class="font-extrabold text-sm">Tanggal</label>
          <input type="date" name="date" value="{{ old('date') }}"
                 class="mt-2 w-full h-11 px-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-100">
        </div>

        <div>
          <label class="font-extrabold text-sm">Edisi</label>
          <input name="edition" value="{{ old('edition') }}" placeholder="Misal: 05"
                 class="mt-2 w-full h-11 px-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-100">
        </div>

        <div>
          <label class="font-extrabold text-sm">Thumbnail (jpg/png/webp, max 5MB)</label>
          <input type="file" name="thumbnail" accept="image/*"
                 class="mt-2 w-full rounded-xl border border-slate-200 bg-white p-2">
        </div>

        <div>
          <label class="font-extrabold text-sm">PDF Warta (pdf, max 20MB)</label>
          <input type="file" name="pdf" accept="application/pdf"
                 class="mt-2 w-full rounded-xl border border-slate-200 bg-white p-2">
        </div>

        <label class="inline-flex items-center gap-2 font-extrabold text-sm">
          <input type="checkbox" name="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }}
                 class="size-4 rounded border-slate-300">
          Publish
        </label>

        <div class="flex gap-2 flex-wrap justify-end pt-2">
          <button class="h-11 px-5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-sm"
                  type="submit">Simpan</button>
          <a class="h-11 px-5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-extrabold text-sm inline-flex items-center"
             href="{{ route('admin.warta.index') }}">Batal</a>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
