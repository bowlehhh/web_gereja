@php
  $item = $item ?? null;
  $action = $action ?? '#';
  $method = strtoupper($method ?? 'POST');
  $existingPhotos = collect($item?->member_photo_paths ?? [])
    ->filter(fn ($path) => is_string($path) && trim($path) !== '')
    ->values();
  $existingPhoto = $existingPhotos->first();
@endphp

@if ($errors->any())
  <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-bold text-red-700">
    {{ $errors->first() }}
  </div>
@endif

<form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="space-y-6">
  @csrf
  @if($method !== 'POST')
    @method($method)
  @endif

  <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
    <div>
      <label class="text-sm font-black text-blue-900">Nama Bidang</label>
      <input
        type="text"
        name="name"
        value="{{ old('name', $item?->name) }}"
        required
        class="mt-2 h-11 w-full rounded-xl border border-blue-200 px-4 text-blue-900 transition focus:border-transparent focus:outline-none focus:ring-2 focus:ring-blue-900"
        placeholder="Contoh: Bidang Pemuda Eirene"
      >
    </div>

    <div>
      <label class="text-sm font-black text-blue-900">Slug Opsional</label>
      <input
        type="text"
        name="slug"
        value="{{ old('slug', $item?->slug) }}"
        class="mt-2 h-11 w-full rounded-xl border border-blue-200 px-4 text-blue-900 transition focus:border-transparent focus:outline-none focus:ring-2 focus:ring-blue-900"
        placeholder="bidang-pemuda-eirene"
      >
      <p class="mt-2 text-xs font-semibold text-slate-500">Kosongkan jika ingin dibuat otomatis dari nama bidang.</p>
    </div>

    <div>
      <label class="text-sm font-black text-blue-900">Tahun Bidang</label>
      <input
        type="number"
        min="2000"
        max="2100"
        name="service_year"
        value="{{ old('service_year', $item?->service_year ?? now()->year) }}"
        required
        class="mt-2 h-11 w-full rounded-xl border border-blue-200 px-4 text-blue-900 transition focus:border-transparent focus:outline-none focus:ring-2 focus:ring-blue-900"
        placeholder="{{ now()->year }}"
      >
      <p class="mt-2 text-xs font-semibold text-slate-500">Tahun yang tampil di kartu awal bidang pelayanan.</p>
    </div>
  </div>

  <div>
    <label class="text-sm font-black text-blue-900">Deskripsi Bidang</label>
    <textarea
      name="description"
      rows="7"
      required
      class="mt-2 w-full rounded-xl border border-blue-200 p-4 text-blue-900 transition focus:border-transparent focus:outline-none focus:ring-2 focus:ring-blue-900"
      placeholder="Tulis deskripsi lengkap bidang pelayanan yang akan tampil di halaman detail."
    >{{ old('description', $item?->description) }}</textarea>
    <p class="mt-2 text-xs font-semibold text-slate-500">Deskripsi ini tampil di isi halaman detail, bukan di bagian head hero.</p>
  </div>

  <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
    <div>
      <label class="text-sm font-black text-blue-900">Foto Bidang Pelayanan</label>
      <input
        type="file"
        name="member_photo"
        accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
        {{ $item ? '' : 'required' }}
        class="mt-2 w-full rounded-xl border border-blue-200 bg-white p-2 text-blue-900 transition file:mr-4 file:rounded-lg file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-sm file:font-bold file:text-blue-900 hover:file:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-900"
      >
      <p class="mt-2 text-xs font-semibold text-slate-500">Format: JPG, JPEG, PNG, WEBP. Maksimal 12 MB. Sistem sekarang hanya memakai 1 foto utama untuk setiap bidang.</p>
    </div>

    <div>
      <label class="text-sm font-black text-blue-900">Urutan Tampil</label>
      <input
        type="number"
        min="0"
        name="sort_order"
        value="{{ old('sort_order', $item?->sort_order ?? 0) }}"
        required
        class="mt-2 h-11 w-full rounded-xl border border-blue-200 px-4 text-blue-900 transition focus:border-transparent focus:outline-none focus:ring-2 focus:ring-blue-900"
      >
      <label class="mt-4 inline-flex cursor-pointer items-center gap-3 text-sm font-black text-blue-900">
        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $item?->is_active ?? true)) class="size-5 rounded border-blue-300 text-blue-900 focus:ring-blue-900">
        Tampilkan di halaman publik
      </label>
    </div>
  </div>

  @if($existingPhoto)
    <div>
      <div>
        <div class="text-sm font-black text-blue-900">Foto Saat Ini</div>
        <p class="mt-1 text-xs font-semibold text-slate-500">Upload foto baru untuk mengganti foto lama, atau centang opsi hapus jika ingin mengosongkan foto bidang.</p>
      </div>

      <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-[220px_minmax(0,1fr)] sm:items-start">
        <div class="overflow-hidden rounded-2xl border border-blue-100 bg-white shadow-sm">
          <div class="aspect-[4/3] overflow-hidden bg-slate-100">
            <img src="{{ asset('storage/'.$existingPhoto) }}" alt="Foto bidang" class="h-full w-full object-cover" loading="lazy" decoding="async">
          </div>
        </div>

        <label class="inline-flex cursor-pointer items-center gap-3 rounded-2xl border border-blue-100 bg-blue-50/70 px-4 py-4 text-sm font-bold text-blue-900">
          <input type="checkbox" name="remove_member_photo" value="1" @checked(old('remove_member_photo')) class="size-5 rounded border-blue-300 text-blue-900 focus:ring-blue-900">
          Hapus foto saat menyimpan perubahan
        </label>
      </div>
    </div>
  @endif

  <div class="flex justify-end border-t border-blue-100 pt-4">
    <button type="submit" class="inline-flex min-h-11 items-center rounded-xl bg-blue-900 px-6 text-sm font-extrabold text-white shadow-md transition hover:bg-blue-800">
      {{ $submitLabel ?? 'Simpan Bidang' }}
    </button>
  </div>
</form>
