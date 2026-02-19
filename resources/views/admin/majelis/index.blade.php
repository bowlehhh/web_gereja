@extends('layout.admin')

@section('title', 'Kelola Majelis - GKKA Samarinda')
@section('admin_heading','Kelola Majelis')

@section('content')
@php
  $isPeriode = true;
@endphp

<div class="flex items-end justify-between gap-4 flex-wrap mb-6">
  <div>
    <h1 class="text-2xl font-black tracking-tight text-blue-900">Kelola Majelis</h1>
    <p class="text-blue-900 font-semibold mt-1">Kelola periode majelis (thumbnail timeline + gallery max 20 foto) untuk halaman publik.</p>
  </div>

  <div class="flex gap-2 flex-wrap">
    <a class="h-10 px-4 rounded-xl border border-blue-900 bg-white hover:bg-blue-50 text-blue-900 font-extrabold text-sm inline-flex items-center transition"
       href="{{ route('gereja.majelis') }}" target="_blank">Lihat Publik</a>
    <a class="h-10 px-4 rounded-xl bg-blue-900 hover:opacity-90 text-white font-extrabold text-sm inline-flex items-center shadow-md transition"
       href="#periode-form">+ Tambah Periode</a>
  </div>
</div>

@if(session('ok'))
  <div class="mb-6 rounded-xl border border-blue-900 bg-blue-50 text-blue-900 font-bold p-4 shadow-sm">
    {{ session('ok') }}
  </div>
@endif

@if(isset($table_ready) && $table_ready === false)
  <div class="mb-6 rounded-xl border border-blue-900 bg-blue-50 text-blue-900 font-bold p-4">
    Database belum siap: tabel <b>majelis_members</b> belum ada. Jalankan <b>php artisan migrate</b> lalu buka ulang halaman ini.
  </div>
@endif

@if($isPeriode)
  @if(empty($period_table_ready))
    <div class="rounded-2xl border border-blue-900 bg-blue-50 text-blue-900 font-bold p-6">
      Database belum siap: tabel <b>majelis_periods</b> belum ada. Jalankan <b>php artisan migrate</b> lalu buka ulang halaman ini.
    </div>
  @else
    @php
      $edit = $edit_period ?? null;
    @endphp

    @if($errors->any())
      <div class="mb-6 rounded-xl border border-red-200 bg-red-50 text-red-800 font-semibold p-4 shadow-sm">
        <div class="font-black mb-2">Periksa input:</div>
        <ul class="list-disc ml-5">
          @foreach($errors->all() as $e)
            <li>{{ $e }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form id="periode-form"
      method="POST"
      action="{{ $edit ? route('admin.majelis.periods.update', $edit) : route('admin.majelis.periods.store') }}"
      enctype="multipart/form-data"
      class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 md:p-8"
    >
      @csrf
      @if($edit) @method('PUT') @endif

      <div class="flex items-start justify-between gap-4 flex-wrap mb-6">
        <div>
          <div class="text-xl font-black text-slate-900">{{ $edit ? 'Edit' : 'Tambah' }} Periode Majelis</div>
          <div class="mt-1 text-sm text-slate-500 font-semibold">
            Thumbnail dipakai untuk gambar di timeline publik `/gereja/majelis`. Gallery (maks. 20 foto) dipakai untuk halaman About Majelis.
          </div>
        </div>
        @if($edit)
          <a href="{{ route('admin.majelis.index', ['tab' => 'periode']) }}"
             class="h-10 px-4 rounded-2xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-800 font-black text-sm inline-flex items-center transition">
            Batal Edit
          </a>
        @endif
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div>
          <label class="block text-sm font-black text-slate-800">Periode</label>
          <input
            type="text"
            name="period"
            value="{{ old('period', $edit->period ?? '') }}"
            placeholder="Contoh: 2026"
            class="mt-2 w-full h-12 px-4 rounded-2xl border border-slate-200 bg-white text-slate-800 font-semibold focus:outline-none focus:ring-2 focus:ring-blue-600/20"
            required
          >
        </div>

        <div>
          <label class="block text-sm font-black text-slate-800">Thumbnail (untuk timeline publik)</label>
          <div class="mt-2 rounded-2xl border border-slate-200 bg-white p-4">
            <input
              type="file"
              name="thumbnail"
              accept="image/*"
              class="block w-full text-sm font-semibold text-slate-700 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:bg-blue-900 file:text-white hover:file:opacity-90"
            >
            <div class="mt-2 text-xs text-slate-500 font-semibold">Untuk gambar kartu periode di halaman publik `/gereja/majelis`.</div>
          </div>
          @if($edit && $edit->thumbnail_path)
            <div class="mt-3 flex items-center gap-3">
              <div class="size-16 rounded-2xl overflow-hidden bg-white border border-slate-200 shadow-sm">
                <img src="{{ asset('storage/'.$edit->thumbnail_path) }}" class="w-full h-full object-cover bg-white" alt="Thumbnail">
              </div>
              <div class="text-xs text-slate-500 font-semibold">Thumbnail saat ini.</div>
            </div>
          @endif
        </div>
      </div>

      <div class="mt-8">
        <label class="block text-sm font-black text-slate-800">Tentang Majelis (About)</label>
        <textarea
          name="about"
          rows="4"
          placeholder="Cerita / deskripsi majelis periode ini..."
          class="mt-2 w-full px-4 py-3 rounded-2xl border border-slate-200 bg-white text-slate-800 font-semibold focus:outline-none focus:ring-2 focus:ring-blue-600/20"
        >{{ old('about', $edit->about ?? '') }}</textarea>
        <div class="mt-2 text-xs text-slate-500 font-semibold">Tampil di kartu periode (ringkas) dan detail About Majelis.</div>
      </div>

      <div class="mt-8">
        <label class="block text-sm font-black text-slate-800">Pelayanan / Bidang Pelayanan</label>
        <textarea
          name="service"
          rows="3"
          placeholder="Contoh: Pelayanan ibadah, persekutuan, diakonia (boleh multi-line)"
          class="mt-2 w-full px-4 py-3 rounded-2xl border border-slate-200 bg-white text-slate-800 font-semibold focus:outline-none focus:ring-2 focus:ring-blue-600/20"
        >{{ old('service', $edit->service ?? '') }}</textarea>
        <div class="mt-2 text-xs text-slate-500 font-semibold">Tampil di bagian “Bidang Pelayanan” pada halaman detail.</div>
      </div>

      <div class="mt-8">
        <div class="flex items-end justify-between gap-4 flex-wrap">
          <div>
            <label class="block text-sm font-black text-slate-800">Gallery Foto About (maks. 20)</label>
            <div class="mt-1 text-xs text-slate-500 font-semibold">Upload beberapa foto sekaligus. Jika diupload lagi, gallery akan mengganti yang lama.</div>
          </div>
          @if($edit && is_array($edit->gallery_paths) && count($edit->gallery_paths))
            <label class="inline-flex items-center gap-2 text-sm font-bold text-slate-700">
              <input type="checkbox" name="clear_gallery" value="1" class="rounded border-slate-300">
              Hapus gallery lama
            </label>
          @endif
        </div>

        <div class="mt-3 rounded-2xl border border-slate-200 bg-white p-4">
          <input
            type="file"
            name="gallery[]"
            accept="image/*"
            multiple
            class="block w-full text-sm font-semibold text-slate-700 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:bg-blue-900 file:text-white hover:file:opacity-90"
          >
          <div class="mt-2 text-xs text-slate-500 font-semibold">Foto-foto ini tampil di halaman About Majelis (maksimal 20).</div>
        </div>

        @if($edit && is_array($edit->gallery_paths) && count($edit->gallery_paths))
          <div class="mt-5 grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-6 gap-3">
            @foreach($edit->gallery_paths as $p)
              <div class="rounded-2xl border border-slate-200 bg-white p-2 shadow-sm">
                <div class="aspect-square overflow-hidden rounded-xl bg-white">
                  <img src="{{ asset('storage/'.$p) }}" class="w-full h-full object-cover" alt="Gallery">
                </div>
              </div>
            @endforeach
          </div>
        @endif
      </div>

      <div class="mt-10 flex items-center justify-end gap-3 flex-wrap">
        <button
          type="submit"
          class="h-11 px-6 rounded-2xl bg-blue-900 hover:opacity-90 text-white font-black shadow-md transition"
        >
          Simpan
        </button>
      </div>
    </form>

    <div class="mt-8 bg-white rounded-3xl border border-slate-100 shadow-sm p-6 md:p-8">
      <div class="flex items-end justify-between gap-4 flex-wrap mb-5">
        <div class="text-lg font-black text-slate-900">Daftar Periode</div>
      </div>

      <div class="grid gap-4">
        @forelse($period_items as $p)
          <div class="rounded-2xl border border-slate-200 bg-white shadow-sm p-5 flex items-center justify-between gap-4 flex-wrap">
            <div class="flex items-center gap-4 min-w-0">
              <div class="size-16 rounded-2xl overflow-hidden bg-white border border-slate-200 shrink-0">
                @if($p->thumbnail_path)
                  <img src="{{ asset('storage/'.$p->thumbnail_path) }}" alt="{{ $p->period }}" class="w-full h-full object-cover bg-white">
                @endif
              </div>
              <div class="min-w-0">
                <div class="font-black text-slate-900 text-lg truncate">Periode {{ $p->period }}</div>
                <div class="text-sm text-slate-600 font-semibold mt-1">
                  Gallery: {{ is_array($p->gallery_paths) ? count($p->gallery_paths) : 0 }} foto
                </div>
              </div>
            </div>

            <div class="flex gap-2 flex-wrap">
              <a
                class="h-10 px-4 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-800 font-extrabold text-sm inline-flex items-center transition"
                href="{{ route('gereja.majelis.show', ['period' => $p->period]) }}"
                target="_blank"
              >Lihat</a>
              <a
                class="h-10 px-4 rounded-xl border border-blue-900 bg-white hover:bg-blue-50 text-blue-900 font-extrabold text-sm inline-flex items-center transition"
                href="{{ route('admin.majelis.index', ['tab' => 'periode', 'edit_period' => $p->id]) }}"
              >Edit</a>
              <form
                action="{{ route('admin.majelis.periods.destroy', $p) }}"
                method="POST"
                onsubmit="return confirm('Hapus periode ini?')"
              >
                @csrf
                @method('DELETE')
                <button class="h-10 px-4 rounded-xl bg-blue-900 hover:opacity-90 text-white font-extrabold text-sm shadow-sm transition"
                        type="submit">Hapus</button>
              </form>
            </div>
          </div>
        @empty
          <div class="rounded-2xl border border-slate-200 bg-white p-8 text-center text-slate-700 font-semibold">
            Belum ada data periode.
          </div>
        @endforelse
      </div>
    </div>
  @endif
@endif
@endsection
