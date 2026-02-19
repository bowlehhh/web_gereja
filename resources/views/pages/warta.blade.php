@extends('layout.app')

@section('title', 'Warta Jemaat - GKKA Samarinda')

@section('content')
<section class="bg-blue-900 text-white py-20">
  <div class="w-full max-w-7xl mx-auto px-6 text-center">
    <h1 class="text-4xl md:text-5xl font-black mb-4 tracking-tight">Warta Jemaat</h1>
    <p class="text-lg text-blue-200 font-medium">Arsip warta jemaat GKKA Indonesia Jemaat Samarinda</p>
  </div>
</section>

<section class="py-16 bg-gray-50">
  <div class="w-full max-w-7xl mx-auto px-6">

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 mb-12">
      @forelse ($wartas as $w)
        <a href="{{ asset('storage/'.$w->pdf_path) }}" target="_blank" class="group block bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
           {{-- THUMBNAIL --}}
           <div class="h-64 bg-gray-200 bg-cover bg-center group-hover:scale-105 transition-transform duration-700 relative"
                style="background-image: url('{{ $w->thumbnail_path ? asset('storage/'.$w->thumbnail_path) : '' }}');">
                <div class="absolute inset-0 bg-black/0 group-hover:bg-blue-900/20 transition-colors duration-300"></div>
                
                {{-- PDF Icon Overlay --}}
                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                  <span class="w-16 h-16 bg-red-600 text-white rounded-full flex items-center justify-center shadow-2xl font-black text-xl">PDF</span>
                </div>
           </div>

           {{-- TEXT --}}
           <div class="p-6">
             <div class="font-black text-lg text-slate-800 mb-2 leading-tight group-hover:text-blue-700 transition-colors">{{ $w->title }}</div>
             <div class="text-xs font-bold text-slate-400 uppercase tracking-wide">
               {{ optional($w->date)->translatedFormat('d F Y') }}
               <span class="mx-1 text-gray-300">•</span>
               Edisi {{ $w->edition ?? '-' }}
             </div>
           </div>
        </a>
      @empty
        <div class="col-span-full p-12 bg-white rounded-3xl border border-gray-200 text-center text-gray-400 font-bold">
          Belum ada warta.
        </div>
      @endforelse
    </div>

    <div class="mt-12">
      @if(method_exists($wartas, 'links'))
        {{ $wartas->links() }}
      @endif
    </div>

  </div>
</section>
@endsection
