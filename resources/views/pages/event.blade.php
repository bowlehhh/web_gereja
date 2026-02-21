@extends('layout.app')

@section('title', 'Event - GKKA Samarinda')

@section('content')
<section class="bg-blue-900 text-white py-20">
  <div class="gkka-container text-center">
    <h1 class="text-4xl md:text-5xl font-black mb-4 tracking-tight">Event</h1>
    <p class="text-lg text-blue-200 font-medium">Daftar event yang ditampilkan ke jemaat.</p>
  </div>
</section>

<section class="py-16 bg-gray-50">
  <div class="gkka-container">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
      @forelse($items as $it)
        <a class="group block bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 border border-gray-100" href="{{ route('event.show', $it) }}">
          @php
            $thumb = $it->thumbnail_path
              ? asset('storage/'.$it->thumbnail_path)
              : ($it->photo_path ? asset('storage/'.$it->photo_path) : asset('assets/logo.png'));
          @endphp
          <div class="h-56 bg-cover bg-center relative overflow-hidden"
               style="background-image:url('{{ $thumb }}');">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-80 group-hover:opacity-100 transition-opacity"></div>
            <div class="absolute bottom-0 left-0 p-6 w-full text-white">
              <div class="text-xs font-bold text-yellow-400 uppercase tracking-widest mb-2">Event</div>
              <h3 class="text-xl font-black leading-tight mb-2 group-hover:text-blue-300 transition-colors">{{ $it->title }}</h3>
              <div class="flex items-center gap-2 text-xs font-bold text-gray-300">
                <span>
                  @if($it->start_date)
                    {{ \Carbon\Carbon::parse($it->start_date)->translatedFormat('d F Y') }}
                  @else
                    -
                  @endif
                </span>
                <span class="w-1 h-1 rounded-full bg-gray-400"></span>
                <span>{{ $it->location ?: '-' }}</span>
              </div>
            </div>
          </div>
          @if(!empty($it->description))
            <div class="p-6 text-slate-600 text-sm leading-relaxed border-t border-gray-100">
                {{ \Illuminate\Support\Str::limit($it->description, 80) }}
            </div>
          @endif
        </a>
      @empty
        <div class="col-span-full p-12 bg-white rounded-3xl border border-gray-200 text-center text-gray-400 font-bold">
          Belum ada event yang dipublish.
        </div>
      @endforelse
    </div>

    @if(method_exists($items, 'hasMorePages') && $items->hasMorePages())
      <div class="flex justify-center mt-12">
        <a class="px-8 py-3 rounded-full bg-blue-600 text-white font-bold shadow-lg hover:bg-blue-700 hover:scale-105 transition-all" href="{{ $items->nextPageUrl() }}">Lebih Banyak</a>
      </div>
    @elseif(method_exists($items, 'links'))
      <div class="mt-12">
        {{ $items->links() }}
      </div>
    @endif
  </div>
</section>
@endsection
