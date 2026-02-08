@extends('layout.admin')
@section('title','Edit Gallery - Admin')
@section('admin_heading','Edit Gallery')

@section('content')
<div class="flex items-end justify-between gap-4 flex-wrap">
  <div>
    <h1 class="text-2xl font-black tracking-tight">Edit Foto Gallery</h1>
    <p class="text-slate-600 font-semibold mt-1">Update judul/caption atau ganti foto.</p>
  </div>
  <a class="h-10 px-4 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-extrabold text-sm inline-flex items-center"
     href="{{ route('admin.gallery.index') }}">← Kembali</a>
</div>

<form class="mt-6 rounded-2xl border border-slate-200 bg-white shadow-sm p-5 max-w-3xl"
      method="POST" action="{{ route('admin.gallery.update',$item) }}" enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <div class="h-48 rounded-2xl border border-slate-200 bg-slate-100"
       style="background-image:url('{{ asset('storage/'.$item->image_path) }}');background-size:cover;background-position:center;"></div>

  <div class="mt-4 grid gap-4">
    <div>
      <label class="font-extrabold text-sm">Judul</label>
      <input class="mt-2 w-full h-11 px-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-100"
             name="title" value="{{ old('title',$item->title) }}" required>
    </div>

    <div>
      <label class="font-extrabold text-sm">Caption (opsional)</label>
      <textarea class="mt-2 w-full p-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-100"
                name="caption" rows="4">{{ old('caption',$item->caption) }}</textarea>
    </div>

    <div>
      <label class="font-extrabold text-sm">Ganti Foto (opsional)</label>
      <input class="mt-2 w-full rounded-xl border border-slate-200 bg-white p-2"
             type="file" name="image" accept="image/*">
    </div>

    <label class="inline-flex items-center gap-2 font-extrabold text-sm">
      <input type="checkbox" name="is_published" value="1" {{ $item->is_published ? 'checked' : '' }}
             class="size-4 rounded border-slate-300">
      Publish
    </label>

    <div class="flex justify-end">
      <button class="h-11 px-5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-sm"
              type="submit">Update</button>
    </div>
  </div>
</form>
@endsection
