@extends('layout.admin')

@section('title','Edit Media')
@section('admin_heading','Edit Media')

@section('content')
<div class="rounded-2xl border border-blue-100 bg-white shadow-sm overflow-hidden max-w-5xl">
  <div class="px-6 py-5 border-b border-blue-100 flex items-center justify-between gap-4 flex-wrap bg-blue-50/50">
    <div>
      <div class="text-xl font-black tracking-tight text-blue-900">Edit Media</div>
      <div class="text-blue-900/70 font-semibold text-sm mt-1">Update judul, tanggal, link YouTube, dan thumbnail (maks 10MB).</div>
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

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
      <div class="rounded-2xl border border-blue-100 overflow-hidden bg-blue-50">
        <div class="aspect-[16/9] relative overflow-hidden">
          @if($media->thumbnail_url)
            <img src="{{ $media->thumbnail_url }}" alt="{{ $media->title }}" class="w-full h-full object-cover">
          @endif
          <div class="absolute inset-0 bg-gradient-to-t from-blue-950/60 via-transparent to-transparent"></div>
        </div>
        <div class="p-4">
          <div class="font-black text-blue-900 line-clamp-2">{{ $media->title }}</div>
          <div class="text-sm text-blue-900/80 font-semibold mt-1">{{ $media->speaker ?: '-' }}</div>
          <div class="text-xs text-blue-900/70 font-bold mt-1">
            @if($media->service_at)
              {{ $media->service_at->locale('id')->translatedFormat('l, d F Y') }} • Jam {{ $media->service_at->format('H.i') }} WITA
            @else
              -
            @endif
          </div>
        </div>
      </div>

      <div class="rounded-2xl border border-blue-100 overflow-hidden bg-white">
        <div class="px-4 py-3 border-b border-blue-100 bg-blue-50/50 font-black text-blue-900">Preview YouTube</div>
        <div class="aspect-video bg-slate-100">
          @if($media->embed_url)
            <iframe class="w-full h-full"
                    src="{{ $media->embed_url }}"
                    title="YouTube preview"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
          @else
            <div class="w-full h-full grid place-items-center text-slate-400 font-bold">Tidak ada preview</div>
          @endif
        </div>
        <div class="p-4">
          <a href="{{ $media->youtube_url }}" target="_blank" rel="noopener"
             class="text-blue-900 font-black hover:underline break-all">Buka YouTube</a>
        </div>
      </div>
    </div>

    <form action="{{ route('admin.media.update', $media->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="grid gap-6">
        <div>
          <label class="font-extrabold text-sm text-blue-900">Judul</label>
          <input type="text" name="title" value="{{ old('title', $media->title) }}" required
                 class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <div>
            <label class="font-extrabold text-sm text-blue-900">Pembicara (opsional)</label>
            <input type="text" name="speaker" value="{{ old('speaker', $media->speaker) }}"
                   class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
          </div>
          <div>
            <label class="font-extrabold text-sm text-blue-900">Tanggal & Jam (opsional)</label>
            <input type="datetime-local" name="service_at"
                   value="{{ old('service_at', $media->service_at ? $media->service_at->format('Y-m-d\\TH:i') : '') }}"
                   class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
          </div>
        </div>

        <div>
          <label class="font-extrabold text-sm text-blue-900">Link YouTube</label>
          <input type="text" name="youtube_url" value="{{ old('youtube_url', $media->youtube_url) }}" required
                 class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
        </div>

        <div>
          <label class="font-extrabold text-sm text-blue-900">Ganti Thumbnail (opsional, maks 10MB)</label>
          <input type="file" name="thumbnail" accept="image/*"
                 class="mt-2 w-full rounded-xl border border-blue-200 bg-white text-blue-900 p-2 focus:outline-none focus:ring-2 focus:ring-blue-900 transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-900 hover:file:bg-blue-100">
        </div>

        <label class="inline-flex items-center gap-3 font-extrabold text-sm text-blue-900 cursor-pointer">
          <input type="checkbox" name="is_published" value="1" {{ old('is_published', $media->is_published) ? 'checked' : '' }}
                 class="size-5 rounded border-blue-300 text-blue-900 focus:ring-blue-900">
          Publish
        </label>

        <div class="flex justify-end pt-4 border-t border-blue-100">
          <button type="submit"
                  class="h-11 px-6 rounded-xl bg-blue-900 hover:opacity-90 text-white font-extrabold text-sm shadow-md transition">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

