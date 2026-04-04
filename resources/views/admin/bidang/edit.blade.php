@extends('layout.admin')

@section('title', 'Edit Bidang Pelayanan')
@section('admin_heading', 'Edit Bidang Pelayanan')
@section('admin_subheading', 'Perbarui isi bidang dan satu foto utama')

@section('content')
<div class="max-w-5xl overflow-hidden rounded-3xl border border-blue-100 bg-white shadow-sm">
  <div class="flex flex-wrap items-center justify-between gap-4 border-b border-blue-100 bg-blue-50/60 px-6 py-5">
    <div>
      <div class="text-2xl font-black tracking-tight text-blue-900">{{ $item->name }}</div>
      <p class="mt-1 text-sm font-semibold text-blue-900/75">Ganti foto utama bila perlu, atau kosongkan jika ingin memakai fallback gambar publik.</p>
    </div>
    <a href="{{ route('admin.bidang.index') }}" class="inline-flex h-10 items-center rounded-xl border border-blue-900 bg-white px-4 text-sm font-extrabold text-blue-900 transition hover:bg-blue-50">
      ← Kembali
    </a>
  </div>

  <div class="p-6 sm:p-8">
    @if(session('ok'))
      <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-bold text-emerald-700">
        {{ session('ok') }}
      </div>
    @endif

    @include('admin.bidang._form', [
      'item' => $item,
      'action' => route('admin.bidang.update', $item),
      'method' => 'PUT',
      'submitLabel' => 'Update Bidang',
    ])
  </div>
</div>
@endsection
