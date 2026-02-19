@extends('layout.admin')

@section('title', 'Tambah Majelis - GKKA Samarinda')
@section('admin_heading','Tambah Majelis')

@section('content')
<style>
  .admin-majelis-pattern {
    position: relative;
    overflow: hidden;
    background: linear-gradient(135deg, #0b3b91 0%, #1d4ed8 45%, #38bdf8 120%);
  }

  .admin-majelis-pattern::before {
    content: "";
    position: absolute;
    inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='360' height='360' viewBox='0 0 360 360'%3E%3Cg fill='none' stroke='%23ffffff' stroke-opacity='0.55' stroke-width='4' stroke-linecap='round' stroke-linejoin='round'%3E%3Cg transform='translate(28 30) rotate(-10 72 72) scale(6)'%3E%3Cpath d='M4 19.5V6.5c0-1.1.9-2 2-2h6v15H6c-1.1 0-2 .9-2 2Z'/%3E%3Cpath d='M20 19.5V6.5c0-1.1-.9-2-2-2h-6v15h6c1.1 0 2 .9 2 2Z'/%3E%3Cpath d='M12 7v3'/%3E%3Cpath d='M10.5 8.5h3'/%3E%3C/g%3E%3Cg transform='translate(210 46) rotate(12 60 60) scale(7)'%3E%3Cpath d='M12 2v20'/%3E%3Cpath d='M7 7h10'/%3E%3C/g%3E%3Cg transform='translate(92 210) rotate(8 70 70) scale(6)'%3E%3Cpath d='M4 19.5V6.5c0-1.1.9-2 2-2h6v15H6c-1.1 0-2 .9-2 2Z'/%3E%3Cpath d='M20 19.5V6.5c0-1.1-.9-2-2-2h-6v15h6c1.1 0 2 .9 2 2Z'/%3E%3Cpath d='M12 7v3'/%3E%3Cpath d='M10.5 8.5h3'/%3E%3C/g%3E%3Cg transform='translate(250 244) rotate(-10 60 60) scale(7)'%3E%3Cpath d='M12 2v20'/%3E%3Cpath d='M7 7h10'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    background-repeat: repeat;
    background-size: 520px 520px;
    opacity: 0.14;
    pointer-events: none;
    z-index: 0;
  }

  .admin-majelis-pattern::after {
    content: "";
    position: absolute;
    inset: 0;
    background:
      radial-gradient(circle at 30% 25%, rgba(255,255,255,0.22) 0%, rgba(255,255,255,0) 55%),
      radial-gradient(circle at 70% 18%, rgba(255,255,255,0.14) 0%, rgba(255,255,255,0) 52%),
      linear-gradient(120deg, rgba(255,255,255,0.10) 0%, rgba(255,255,255,0) 35%, rgba(255,255,255,0.08) 62%, rgba(255,255,255,0) 100%);
    pointer-events: none;
    z-index: 0;
  }

  .admin-majelis-pattern > * { position: relative; z-index: 1; }
</style>

<div class="admin-majelis-pattern rounded-3xl p-6 max-w-4xl">
<div class="rounded-2xl border border-blue-100 bg-white shadow-sm overflow-hidden">
  <div class="px-6 py-5 border-b border-blue-100 flex items-center justify-between gap-4 flex-wrap bg-blue-50/50">
    <div>
      <div class="text-xl font-black tracking-tight text-blue-900">Tambah Majelis</div>
      <div class="text-blue-900/70 font-semibold text-sm mt-1">Isi nama + jabatan, lalu isi “About” untuk halaman detail.</div>
    </div>
    <a class="h-10 px-4 rounded-xl border border-blue-900 bg-white hover:bg-blue-50 text-blue-900 font-extrabold text-sm inline-flex items-center transition"
       href="{{ route('admin.majelis.index') }}">← Kembali</a>
  </div>

  <div class="px-6 py-8">
    <form method="POST" action="{{ route('admin.majelis.store') }}" enctype="multipart/form-data">
      @csrf

      <div class="grid gap-6">
        <div>
          <label class="font-extrabold text-sm text-blue-900">Nama</label>
          <input name="name" value="{{ old('name') }}" required maxlength="160"
                 class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
          @error('name') <div class="mt-2 text-blue-900 font-bold text-sm bg-blue-50 p-2 rounded-lg border border-blue-100 flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</div> @enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <div>
            <label class="font-extrabold text-sm text-blue-900">Jabatan</label>
            <input name="role" value="{{ old('role') }}" maxlength="120"
                   class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition"
                   placeholder="Contoh: Ketua Majelis">
            @error('role') <div class="mt-2 text-blue-900 font-bold text-sm bg-blue-50 p-2 rounded-lg border border-blue-100 flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</div> @enderror
          </div>
          <div>
            <label class="font-extrabold text-sm text-blue-900">Periode</label>
            <input name="period" value="{{ old('period') }}" maxlength="120"
                   class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition"
                   placeholder="Contoh: Periode 2026">
            @error('period') <div class="mt-2 text-blue-900 font-bold text-sm bg-blue-50 p-2 rounded-lg border border-blue-100 flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</div> @enderror
          </div>
        </div>

        <div>
          <label class="font-extrabold text-sm text-blue-900">Foto</label>
          <input type="file" name="photo" accept=".jpg,.jpeg,.png,.webp"
                 class="mt-2 w-full rounded-xl border border-blue-200 bg-white text-blue-900 p-2 focus:outline-none focus:ring-2 focus:ring-blue-900 transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-900 hover:file:bg-blue-100">
          <div class="mt-2 text-blue-900/60 text-sm font-semibold">Maks 20MB.</div>
          @error('photo') <div class="mt-2 text-blue-900 font-bold text-sm bg-blue-50 p-2 rounded-lg border border-blue-100 flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</div> @enderror
        </div>

        <div>
          <label class="font-extrabold text-sm text-blue-900">Ringkasan (untuk kartu)</label>
          <input name="excerpt" value="{{ old('excerpt') }}" maxlength="255"
                 class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition"
                 placeholder="Kalimat singkat yang muncul di kartu majelis.">
          @error('excerpt') <div class="mt-2 text-blue-900 font-bold text-sm bg-blue-50 p-2 rounded-lg border border-blue-100 flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</div> @enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <div>
            <label class="font-extrabold text-sm text-blue-900">Urutan tampil</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0" max="1000000"
                   class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
            @error('sort_order') <div class="mt-2 text-blue-900 font-bold text-sm bg-blue-50 p-2 rounded-lg border border-blue-100 flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</div> @enderror
          </div>
          <div class="flex items-end pb-3">
            <label class="inline-flex items-center gap-3 font-extrabold text-sm text-blue-900 cursor-pointer">
              <input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}
                     class="size-5 rounded border-blue-300 text-blue-900 focus:ring-blue-900">
              Tampilkan di halaman publik
            </label>
          </div>
        </div>

        <div>
          <label class="font-extrabold text-sm text-blue-900">About Majelis (halaman detail)</label>
          <textarea name="about" rows="8"
                    class="mt-2 w-full p-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition"
                    placeholder="Tulis deskripsi/about majelis...">{{ old('about') }}</textarea>
          @error('about') <div class="mt-2 text-blue-900 font-bold text-sm bg-blue-50 p-2 rounded-lg border border-blue-100 flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</div> @enderror
        </div>

        <div class="flex justify-end pt-4 border-t border-blue-100">
          <button class="h-11 px-6 rounded-xl bg-blue-900 hover:opacity-90 text-white font-extrabold text-sm shadow-md transition"
                  type="submit">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>
</div>
@endsection
