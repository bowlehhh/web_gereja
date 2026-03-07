@extends('layout.admin')

@section('title', 'Tambah Renungan - GKKA-I INDONESIA')
@section('admin_heading','Tambah Renungan')
@section('admin_subheading','Semua input wajib diisi')

@section('content')
<div class="rounded-2xl border border-blue-100 bg-white shadow-sm overflow-hidden max-w-4xl">
  <div class="px-6 py-5 border-b border-blue-100 flex items-center justify-between gap-4 flex-wrap bg-blue-50/50">
    <div>
      <div class="text-xl font-black tracking-tight text-blue-900">Tambah Renungan</div>
      <div class="text-blue-900/70 font-semibold text-sm mt-1">Konten akan tampil di halaman renungan publik jika dipublish.</div>
    </div>
    <a class="h-10 px-4 rounded-xl border border-blue-900 bg-white hover:bg-blue-50 text-blue-900 font-extrabold text-sm inline-flex items-center transition"
       href="{{ route('admin.renungan.index') }}">← Kembali</a>
  </div>

  <div class="px-6 py-8">
    @if($errors->any())
      <div class="mb-6 rounded-xl border border-blue-900 bg-blue-50 text-blue-900 font-bold p-4">
        <div class="font-black mb-2">Ada error:</div>
        <ul class="list-disc pl-5 grid gap-1">
          @foreach($errors->all() as $e)
            <li>{{ $e }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('admin.renungan.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="grid gap-6">
        <div>
          <label class="font-extrabold text-sm text-blue-900">Judul Renungan</label>
          <input name="title" value="{{ old('title') }}" required maxlength="180"
                 class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <div>
            <label class="font-extrabold text-sm text-blue-900">Ayat Referensi</label>
            <input name="scripture_reference" value="{{ old('scripture_reference') }}" required maxlength="180" placeholder="Contoh: Mazmur 23:1-6"
                   class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
          </div>
          <div>
            <label class="font-extrabold text-sm text-blue-900">Penulis/Pembawa</label>
            <input name="author" value="{{ old('author', 'Ibu Gembala') }}" required maxlength="120"
                   class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
          </div>
        </div>

        <div>
          <label class="font-extrabold text-sm text-blue-900">Ayat Firman (Isi Ayat)</label>
          <div class="mt-1 text-blue-900/65 text-xs font-semibold">Isi teks ayat firman yang akan ditampilkan di bagian atas.</div>
          <textarea name="excerpt" rows="5" required
                    class="mt-2 w-full p-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition"
                    placeholder="Contoh: Di tengah pergumulan hidup yang berat, kita diingatkan bahwa Tuhan tetap memanggil kita...">{{ old('excerpt') }}</textarea>
        </div>

        <div>
          <label class="font-extrabold text-sm text-blue-900">Tafsiran Renungan</label>
          <div class="mt-1 text-blue-900/65 text-xs font-semibold">Tulis penjelasan/tafsiran di bawah ayat firman.</div>
          <textarea name="content" rows="10" required
                    class="mt-2 w-full p-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition"
                    placeholder="Tulis tafsiran lengkap renungan...">{{ old('content') }}</textarea>
        </div>

        <div>
          <label class="font-extrabold text-sm text-blue-900">Gambar Renungan (jpg/png/webp, max 20MB)</label>
          <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp" required
                 class="mt-2 w-full rounded-xl border border-blue-200 bg-white text-blue-900 p-2 focus:outline-none focus:ring-2 focus:ring-blue-900 transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-900 hover:file:bg-blue-100">
          <div class="mt-2 text-blue-900/60 text-sm font-semibold">Batas ukuran foto maksimal 20MB.</div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <div>
            <label class="font-extrabold text-sm text-blue-900">Tanggal Tayang</label>
            <input type="date" name="published_at" value="{{ old('published_at', now()->format('Y-m-d')) }}" required
                   class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
          </div>
          <div>
            <label class="font-extrabold text-sm text-blue-900">Urutan Tampil</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0" max="1000000" required
                   class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
          </div>
        </div>

        <label class="inline-flex items-center gap-3 font-extrabold text-sm text-blue-900 cursor-pointer">
          <input type="checkbox" name="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }}
                 class="size-5 rounded border-blue-300 text-blue-900 focus:ring-blue-900">
          Publish
        </label>

        <div class="flex gap-3 flex-wrap justify-end pt-4 border-t border-blue-100">
          <button class="h-11 px-6 rounded-xl bg-blue-900 hover:opacity-90 text-white font-extrabold text-sm shadow-md transition"
                  type="submit">Simpan</button>
          <a class="h-11 px-6 rounded-xl border border-blue-900 bg-white hover:bg-blue-50 text-blue-900 font-extrabold text-sm inline-flex items-center transition"
             href="{{ route('admin.renungan.index') }}">Batal</a>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
