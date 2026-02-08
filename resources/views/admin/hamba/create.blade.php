@extends('layout.admin')

@section('title', 'Tambah Hamba Tuhan - GKKA Samarinda')
@section('admin_heading','Tambah Hamba Tuhan')

@section('content')
<div class="rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden max-w-4xl">
  <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between gap-4 flex-wrap">
    <div>
      <div class="text-xl font-black tracking-tight">Tambah Hamba Tuhan</div>
      <div class="text-slate-600 font-semibold text-sm mt-1">Minimal isi nama + upload foto (info lain bisa menyusul).</div>
    </div>
    <a class="h-10 px-4 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-extrabold text-sm inline-flex items-center"
       href="{{ route('admin.hamba.index') }}">← Kembali</a>
  </div>

  <div class="px-6 py-6">
    <form method="POST" action="{{ route('admin.hamba.store') }}" enctype="multipart/form-data">
      @csrf

      <div class="grid gap-4">
        <div>
          <label class="font-extrabold text-sm">Nama</label>
          <input name="name" value="{{ old('name') }}" required maxlength="160"
                 class="mt-2 w-full h-11 px-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-100">
          @error('name') <div class="mt-2 text-rose-700 font-semibold text-sm">{{ $message }}</div> @enderror
        </div>

        <div>
          <label class="font-extrabold text-sm">Foto</label>
          <input type="file" name="photo" accept=".jpg,.jpeg,.png,.webp"
                 class="mt-2 w-full rounded-xl border border-slate-200 bg-white p-2">
          <div class="mt-2 text-slate-500 text-sm font-semibold">Disarankan foto potret seperti contoh. Maks 5MB.</div>
          @error('photo') <div class="mt-2 text-rose-700 font-semibold text-sm">{{ $message }}</div> @enderror
        </div>

        <div>
          <label class="font-extrabold text-sm">Ringkasan (untuk kartu)</label>
          <input name="roles_summary" value="{{ old('roles_summary') }}" maxlength="255"
                 class="mt-2 w-full h-11 px-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-100"
                 placeholder="Contoh: Pembina Komisi Remaja Pemuda, Pembina Komisi Usia Indah">
          @error('roles_summary') <div class="mt-2 text-rose-700 font-semibold text-sm">{{ $message }}</div> @enderror
        </div>

        <div>
          <label class="font-extrabold text-sm">Kontak</label>
          <input name="contact" value="{{ old('contact') }}" maxlength="120"
                 class="mt-2 w-full h-11 px-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-100"
                 placeholder="Contoh: 0812 3333 0002">
          @error('contact') <div class="mt-2 text-rose-700 font-semibold text-sm">{{ $message }}</div> @enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="font-extrabold text-sm">Urutan tampil</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0" max="1000000"
                   class="mt-2 w-full h-11 px-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-100">
            @error('sort_order') <div class="mt-2 text-rose-700 font-semibold text-sm">{{ $message }}</div> @enderror
          </div>
          <div class="flex items-end">
            <label class="inline-flex items-center gap-2 font-extrabold text-sm">
              <input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}
                     class="size-4 rounded border-slate-300">
              Tampilkan di halaman publik
            </label>
          </div>
        </div>

        <div>
          <label class="font-extrabold text-sm">Profile (halaman detail)</label>
          <textarea name="profile" rows="6"
                    class="mt-2 w-full p-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-100"
                    placeholder="Tulis profile lengkap...">{{ old('profile') }}</textarea>
          @error('profile') <div class="mt-2 text-rose-700 font-semibold text-sm">{{ $message }}</div> @enderror
        </div>

        <div>
          <label class="font-extrabold text-sm">Bidang Pelayanan (halaman detail)</label>
          <textarea name="service_fields" rows="4"
                    class="mt-2 w-full p-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-emerald-100"
                    placeholder="Contoh: Pembina Komisi Remaja Pemuda, Pembina Komisi Usia Indah...">{{ old('service_fields') }}</textarea>
          @error('service_fields') <div class="mt-2 text-rose-700 font-semibold text-sm">{{ $message }}</div> @enderror
        </div>

        <div class="flex justify-end pt-2">
          <button class="h-11 px-5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-sm"
                  type="submit">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
