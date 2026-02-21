@extends('layout.admin')

@section('title','Kelola Event')
@section('admin_heading','Kelola Event')

@section('content')
<div class="flex items-end justify-between gap-4 flex-wrap mb-6">
  <div>
    <h1 class="text-2xl font-black tracking-tight text-blue-900">Kelola Event</h1>
    <p class="text-blue-900 font-semibold mt-1">Tambah, edit, hapus event yang tampil ke user.</p>
  </div>
  <div class="flex gap-2 flex-wrap">
    <a class="h-10 px-4 rounded-xl border border-blue-900 bg-white hover:bg-blue-50 text-blue-900 font-extrabold text-sm inline-flex items-center transition"
       href="{{ route('admin.dashboard') }}">← Dashboard</a>
    <a class="h-10 px-4 rounded-xl bg-blue-900 hover:opacity-90 text-white font-extrabold text-sm inline-flex items-center shadow-md transition"
       href="{{ route('admin.event.create') }}">+ Tambah</a>
  </div>
</div>

@if(session('ok'))
  <div class="mb-6 rounded-xl border border-blue-900 bg-blue-50 text-blue-900 font-bold p-4 shadow-sm">
    {{ session('ok') }}
  </div>
@endif

<div class="grid gap-4">
  @forelse($items as $it)
    <div class="rounded-2xl border border-blue-100 bg-white shadow-sm p-6 hover:shadow-md transition">
      <div class="flex items-start justify-between gap-4 flex-wrap">
        <div class="min-w-0">
          <div class="text-xl font-black text-blue-900">{{ $it->title }}</div>
          <div class="text-sm text-blue-800 font-medium mt-1">
            Status: <span class="font-bold">{{ $it->is_published ? 'PUBLISHED' : 'DRAFT' }}</span>
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
          <a class="h-10 px-4 rounded-xl border border-blue-900 bg-white hover:bg-blue-50 text-blue-900 font-extrabold text-sm inline-flex items-center transition"
             href="{{ route('admin.event.edit', $it->id) }}">Edit</a>
          <form
            action="{{ route('admin.event.destroy', $it->id) }}"
            method="POST"
            data-confirm="Hapus event ini?"
            data-confirm-title="Hapus Event"
            data-confirm-ok="Ya, Hapus"
          >
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="h-10 px-4 rounded-xl bg-blue-900 hover:opacity-90 text-white font-extrabold text-sm shadow-sm transition">Hapus</button>
          </form>
        </div>
      </div>

      @if($it->description)
        <div class="mt-4 text-blue-900 font-medium text-sm leading-relaxed opacity-80 border-t border-blue-50 pt-3">
          {{ $it->description }}
        </div>
      @endif
    </div>
  @empty
    <div class="rounded-2xl border border-blue-100 bg-white shadow-sm p-8 text-center text-blue-900 font-semibold">
      Belum ada event.
    </div>
  @endforelse
</div>

<div class="mt-6">
  @if(method_exists($items, 'links'))
    {{ $items->links() }}
  @endif
</div>
@endsection
