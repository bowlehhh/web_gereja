@extends('layout.admin')

@section('title', 'Tambah Bidang Pelayanan')
@section('admin_heading', 'Tambah Bidang Pelayanan')
@section('admin_subheading', 'Input nama bidang, deskripsi lengkap, dan satu foto utama')

@section('content')
<div class="max-w-5xl overflow-hidden rounded-3xl border border-blue-100 bg-white shadow-sm">
  <div class="flex flex-wrap items-center justify-between gap-4 border-b border-blue-100 bg-blue-50/60 px-6 py-5">
    <div>
      <div class="text-2xl font-black tracking-tight text-blue-900">Tambah Bidang Pelayanan</div>
      <p class="mt-1 text-sm font-semibold text-blue-900/75">Setiap bidang sekarang memakai satu foto utama agar tampilan publik tetap bersih dan fokus.</p>
    </div>
    <a href="{{ route('admin.bidang.index') }}" class="inline-flex h-10 items-center rounded-xl border border-blue-900 bg-white px-4 text-sm font-extrabold text-blue-900 transition hover:bg-blue-50">
      ← Kembali
    </a>
  </div>

  <div class="p-6 sm:p-8">
    @include('admin.bidang._form', [
      'action' => route('admin.bidang.store'),
      'method' => 'POST',
      'submitLabel' => 'Simpan Bidang',
    ])
  </div>
</div>
@endsection
