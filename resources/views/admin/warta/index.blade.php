@extends('layout.admin')

@section('title', 'Kelola Warta - GKKA Samarinda')
@section('admin_heading','Kelola Warta')

@section('content')
<div class="flex items-end justify-between gap-4 flex-wrap">
  <div>
    <h1 class="text-2xl font-black tracking-tight">Kelola Warta Jemaat</h1>
    <p class="text-slate-600 font-semibold mt-1">Tambah, edit, hapus warta jemaat.</p>
  </div>
  <div class="flex gap-2 flex-wrap">
    <a class="h-10 px-4 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-extrabold text-sm inline-flex items-center"
       href="{{ route('admin.dashboard') }}">← Dashboard</a>
    <a class="h-10 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-sm inline-flex items-center"
       href="{{ route('admin.warta.create') }}">+ Buat</a>
  </div>
</div>

@if(session('ok'))
  <div class="mt-4 rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-800 font-semibold p-3">
    {{ session('ok') }}
  </div>
@endif

<div class="mt-5 grid gap-3">
  @forelse($wartas as $w)
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm p-4 flex items-center justify-between gap-4 flex-wrap">
      <div class="min-w-0">
        <div class="font-black truncate">{{ $w->title }}</div>
        <div class="text-sm text-slate-600 font-semibold mt-1">
          {{ optional($w->date)->format('d M Y') ?? '-' }} • Edisi {{ $w->edition ?? '-' }} • {{ $w->is_published ? 'PUBLISHED' : 'DRAFT' }}
        </div>
      </div>

      <div class="flex gap-2 flex-wrap">
        @if($w->pdf_path)
          <a class="h-10 px-4 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-extrabold text-sm inline-flex items-center"
             target="_blank" href="{{ asset('storage/'.$w->pdf_path) }}">Lihat PDF</a>
        @endif
        <a class="h-10 px-4 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-extrabold text-sm inline-flex items-center"
           href="{{ route('admin.warta.edit', $w) }}">Edit</a>
        <form action="{{ route('admin.warta.destroy', $w) }}" method="POST" onsubmit="return confirm('Hapus warta ini?')">
          @csrf
          @method('DELETE')
          <button class="h-10 px-4 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-extrabold text-sm"
                  type="submit">Hapus</button>
        </form>
      </div>
    </div>
  @empty
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm p-4 text-slate-600 font-semibold">
      Belum ada data warta.
    </div>
  @endforelse
</div>

<div class="mt-5">
  {{ $wartas->links() }}
</div>
@endsection
