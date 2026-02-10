@extends('layout.admin')
@section('title','Edit Gallery - Admin')
@section('admin_heading','Edit Gallery')

@section('content')
<div class="flex items-end justify-between gap-4 flex-wrap mb-6">
  <div>
    <h1 class="text-2xl font-black tracking-tight text-blue-900">Edit Foto Gallery</h1>
    <p class="text-blue-900/80 font-semibold mt-1">Update judul/caption atau ganti foto.</p>
  </div>
  <a class="h-10 px-4 rounded-xl border border-blue-900 bg-white hover:bg-blue-50 text-blue-900 font-extrabold text-sm inline-flex items-center transition"
     href="{{ route('admin.gallery.index') }}">← Kembali</a>
</div>

<form class="mt-6 rounded-2xl border border-blue-100 bg-white shadow-sm p-6 max-w-3xl"
      method="POST" action="{{ route('admin.gallery.update',$item) }}" enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <div class="h-64 rounded-2xl border border-blue-100 bg-blue-50 relative overflow-hidden">
       @if($item->image_path)
       <img src="{{ asset('storage/'.$item->image_path) }}" class="w-full h-full object-cover">
       @endif
  </div>

  <div class="mt-6 grid gap-6">
    <div>
      <label class="font-extrabold text-sm text-blue-900">Judul</label>
      <input class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition"
             name="title" value="{{ old('title',$item->title) }}" required>
    </div>

    <div>
      <label class="font-extrabold text-sm text-blue-900">Caption (opsional)</label>
      <textarea class="mt-2 w-full p-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition"
                name="caption" rows="4">{{ old('caption',$item->caption) }}</textarea>
    </div>

    <div>
      <label class="font-extrabold text-sm text-blue-900">Ganti Foto (opsional)</label>
      <input class="mt-2 w-full rounded-xl border border-blue-200 bg-white text-blue-900 p-2 focus:outline-none focus:ring-2 focus:ring-blue-900 transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-900 hover:file:bg-blue-100"
             type="file" name="image" accept="image/*">
    </div>

    <label class="inline-flex items-center gap-3 font-extrabold text-sm text-blue-900 cursor-pointer">
      <input type="checkbox" name="is_published" value="1" {{ $item->is_published ? 'checked' : '' }}
             class="size-5 rounded border-blue-300 text-blue-900 focus:ring-blue-900">
      Publish
    </label>

    <div class="flex justify-end border-t border-blue-100 pt-4">
      <button class="h-11 px-6 rounded-xl bg-blue-900 hover:opacity-90 text-white font-extrabold text-sm shadow-md transition"
              type="submit">Update</button>
    </div>
  </div>
</form>
@endsection
