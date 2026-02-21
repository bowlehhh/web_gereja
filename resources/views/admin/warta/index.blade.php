@extends('layout.admin')

@section('title', 'Kelola Warta - GKKA Samarinda')
@section('admin_heading','Kelola Warta')

@section('content')
<div class="flex items-end justify-between gap-4 flex-wrap mb-6">
  <div>
    <h1 class="text-2xl font-black tracking-tight text-blue-900">Kelola Warta Jemaat</h1>
    <p class="text-blue-900 font-semibold mt-1">Tambah, edit, hapus warta jemaat.</p>
  </div>
  <div class="flex gap-2 flex-wrap">
    <a class="h-10 px-4 rounded-xl border border-blue-900 bg-white hover:bg-blue-50 text-blue-900 font-extrabold text-sm inline-flex items-center transition"
       href="{{ route('admin.dashboard') }}">← Dashboard</a>
    <a class="h-10 px-4 rounded-xl bg-blue-900 hover:opacity-90 text-white font-extrabold text-sm inline-flex items-center shadow-md transition"
       href="{{ route('admin.warta.create') }}">+ Buat</a>
  </div>
</div>

@if(session('ok'))
  <div class="mb-6 rounded-xl border border-blue-900 bg-blue-50 text-blue-900 font-bold p-4 shadow-sm">
    {{ session('ok') }}
  </div>
@endif

<div class="grid gap-4">
  @forelse($wartas as $w)
    <div class="rounded-2xl border border-blue-100 bg-white shadow-sm p-6 flex items-center justify-between gap-4 flex-wrap hover:shadow-md transition">
      <div class="min-w-0">
        <div class="font-black text-blue-900 text-lg truncate">{{ $w->title }}</div>
        <div class="text-sm text-blue-800 font-medium mt-1">
          {{ optional($w->date)->format('d M Y') ?? '-' }} • Edisi <span class="font-bold">{{ $w->edition ?? '-' }}</span> • <span class="font-bold">{{ $w->is_published ? 'PUBLISHED' : 'DRAFT' }}</span>
        </div>
      </div>

      <div class="flex gap-2 flex-wrap">
        @if($w->pdf_path)
          <a class="h-10 px-4 rounded-xl border border-blue-200 bg-blue-50 hover:bg-blue-100 text-blue-900 font-extrabold text-sm inline-flex items-center transition"
             target="_blank" href="{{ asset('storage/'.$w->pdf_path) }}">
             <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
             PDF
          </a>
        @endif
        <a class="h-10 px-4 rounded-xl border border-blue-900 bg-white hover:bg-blue-50 text-blue-900 font-extrabold text-sm inline-flex items-center transition"
           href="{{ route('admin.warta.edit', $w) }}">Edit</a>
        <form
          action="{{ route('admin.warta.destroy', $w) }}"
          method="POST"
          data-confirm="Hapus warta ini?"
          data-confirm-title="Hapus Warta"
          data-confirm-ok="Ya, Hapus"
        >
          @csrf
          @method('DELETE')
          <button class="h-10 px-4 rounded-xl bg-blue-900 hover:opacity-90 text-white font-extrabold text-sm shadow-sm transition"
                  type="submit">Hapus</button>
        </form>
      </div>
    </div>
  @empty
    <div class="rounded-2xl border border-blue-100 bg-white shadow-sm p-8 text-center text-blue-900 font-semibold">
      Belum ada data warta.
    </div>
  @endforelse
</div>

<div class="mt-5">
  @if(method_exists($wartas, 'links'))
    {{ $wartas->links() }}
  @endif
</div>
@endsection
