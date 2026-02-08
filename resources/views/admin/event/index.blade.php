@extends('layout.admin')

@section('title','Kelola Event')
@section('admin_heading','Kelola Event')

@section('content')
<div class="flex items-end justify-between gap-4 flex-wrap">
  <div>
    <h1 class="text-2xl font-black tracking-tight">Kelola Event</h1>
    <p class="text-slate-600 font-semibold mt-1">Tambah, edit, hapus event yang tampil ke user.</p>
  </div>
  <div class="flex gap-2 flex-wrap">
    <a class="h-10 px-4 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-extrabold text-sm inline-flex items-center"
       href="{{ route('admin.dashboard') }}">← Dashboard</a>
    <a class="h-10 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-sm inline-flex items-center"
       href="{{ route('admin.event.create') }}">+ Tambah</a>
  </div>
</div>

@if(session('ok'))
  <div class="mt-4 rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-800 font-semibold p-3">
    {{ session('ok') }}
  </div>
@endif

<div class="mt-5 grid gap-4">
  @forelse($items as $it)
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm p-5">
      <div class="flex items-start justify-between gap-4 flex-wrap">
        <div class="min-w-0">
          <div class="text-lg font-black">{{ $it->title }}</div>
          <div class="text-sm text-slate-600 font-semibold mt-1">
            Status: {{ $it->is_published ? 'PUBLISHED' : 'DRAFT' }}
            • Tanggal:
            @if($it->start_date)
              {{ \Carbon\Carbon::parse($it->start_date)->translatedFormat('d F Y') }}
            @else
              -
            @endif
            @if($it->end_date)
              – {{ \Carbon\Carbon::parse($it->end_date)->translatedFormat('d F Y') }}
            @endif
            • Lokasi: {{ $it->location ?? '-' }}
          </div>
        </div>

        <div class="flex gap-2 flex-wrap">
          <a class="h-10 px-4 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-extrabold text-sm inline-flex items-center"
             href="{{ route('admin.event.edit', $it->id) }}">Edit</a>
          <form action="{{ route('admin.event.destroy', $it->id) }}" method="POST" onsubmit="return confirm('Hapus event ini?')">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="h-10 px-4 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-extrabold text-sm">Hapus</button>
          </form>
        </div>
      </div>

      @if($it->description)
        <div class="mt-3 text-slate-700 font-semibold text-sm leading-relaxed">
          {{ $it->description }}
        </div>
      @endif
    </div>
  @empty
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm p-5 text-slate-600 font-semibold">
      Belum ada event.
    </div>
  @endforelse
</div>

<div class="mt-5">
  {{ $items->links() }}
</div>
@endsection
