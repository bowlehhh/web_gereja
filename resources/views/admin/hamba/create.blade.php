@extends('layout.admin')

@section('title', 'Tambah Hamba Tuhan - GKKA Samarinda')
@section('admin_heading','Tambah Hamba Tuhan')

@section('content')
<div class="rounded-2xl border border-blue-100 bg-white shadow-sm overflow-hidden max-w-4xl">
  <div class="px-6 py-5 border-b border-blue-100 flex items-center justify-between gap-4 flex-wrap bg-blue-50/50">
    <div>
      <div class="text-xl font-black tracking-tight text-blue-900">Tambah Hamba Tuhan</div>
      <div class="text-blue-900/70 font-semibold text-sm mt-1">Minimal isi nama + upload foto (info lain bisa menyusul).</div>
    </div>
    <a class="h-10 px-4 rounded-xl border border-blue-900 bg-white hover:bg-blue-50 text-blue-900 font-extrabold text-sm inline-flex items-center transition"
       href="{{ route('admin.hamba.index') }}">← Kembali</a>
  </div>

  <div class="px-6 py-8">
    <form method="POST" action="{{ route('admin.hamba.store') }}" enctype="multipart/form-data">
      @csrf

      <div class="grid gap-6">
        <div>
          <label class="font-extrabold text-sm text-blue-900">Nama</label>
          <input name="name" value="{{ old('name') }}" required maxlength="160"
                 class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition">
          @error('name') <div class="mt-2 text-blue-900 font-bold text-sm bg-blue-50 p-2 rounded-lg border border-blue-100 flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</div> @enderror
        </div>

        <div>
          <label class="font-extrabold text-sm text-blue-900">Foto</label>
          <input type="file" name="photo" accept=".jpg,.jpeg,.png,.webp"
                 class="mt-2 w-full rounded-xl border border-blue-200 bg-white text-blue-900 p-2 focus:outline-none focus:ring-2 focus:ring-blue-900 transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-900 hover:file:bg-blue-100">
          <div class="mt-2 text-blue-900/60 text-sm font-semibold">Disarankan foto potret seperti contoh. Maks 5MB.</div>
          @error('photo') <div class="mt-2 text-blue-900 font-bold text-sm bg-blue-50 p-2 rounded-lg border border-blue-100 flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</div> @enderror
        </div>

        <div>
          <label class="font-extrabold text-sm text-blue-900">Ringkasan (untuk kartu)</label>
          <input name="roles_summary" value="{{ old('roles_summary') }}" maxlength="255"
                 class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition"
                 placeholder="Contoh: Pembina Komisi Remaja Pemuda, Pembina Komisi Usia Indah">
          @error('roles_summary') <div class="mt-2 text-blue-900 font-bold text-sm bg-blue-50 p-2 rounded-lg border border-blue-100 flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</div> @enderror
        </div>

        <div>
          <label class="font-extrabold text-sm text-blue-900">Kontak</label>
          <input name="contact" value="{{ old('contact') }}" maxlength="120"
                 class="mt-2 w-full h-11 px-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition"
                 placeholder="Contoh: 0812 3333 0002">
          @error('contact') <div class="mt-2 text-blue-900 font-bold text-sm bg-blue-50 p-2 rounded-lg border border-blue-100 flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</div> @enderror
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
          <label class="font-extrabold text-sm text-blue-900">Profile (halaman detail)</label>
          <textarea name="profile" rows="6"
                    class="mt-2 w-full p-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition"
                    placeholder="Tulis profile lengkap...">{{ old('profile') }}</textarea>
          @error('profile') <div class="mt-2 text-blue-900 font-bold text-sm bg-blue-50 p-2 rounded-lg border border-blue-100 flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</div> @enderror
        </div>

        <div>
          <label class="font-extrabold text-sm text-blue-900">Bidang Pelayanan (halaman detail)</label>
          <textarea name="service_fields" rows="4"
                    class="mt-2 w-full p-4 rounded-xl border border-blue-200 text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition"
                    placeholder="Contoh: Pembina Komisi Remaja Pemuda, Pembina Komisi Usia Indah...">{{ old('service_fields') }}</textarea>
          @error('service_fields') <div class="mt-2 text-blue-900 font-bold text-sm bg-blue-50 p-2 rounded-lg border border-blue-100 flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</div> @enderror
        </div>

        <div class="flex justify-end pt-4 border-t border-blue-100">
          <button class="h-11 px-6 rounded-xl bg-blue-900 hover:opacity-90 text-white font-extrabold text-sm shadow-md transition"
                  type="submit">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
