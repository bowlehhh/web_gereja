@extends('layout.app')

@section('title', $item->name.' - Hamba Tuhan')
@section('body_class','bg-gray-50')

@section('content')
<section class="bg-blue-900 text-white py-20">
  <div class="gkka-container text-center">
    <h1 class="text-4xl md:text-5xl font-black mb-4 tracking-tight">Hamba Tuhan</h1>
    <p class="text-lg text-blue-200 font-medium">Profile {{ $item->name }}</p>
  </div>
</section>

<section class="py-16 md:py-24 relative">
  <div class="w-full max-w-6xl mx-auto px-6">
    <div class="bg-white rounded-[2.5rem] shadow-2xl overflow-hidden border border-gray-100 flex flex-col md:flex-row">
      
      {{-- Photo Side --}}
      <div class="w-full md:w-5/12 lg:w-4/12 relative min-h-[400px] md:min-h-full bg-gray-200">
        @if($item->photo_path)
          <img class="absolute inset-0 w-full h-full object-cover" src="{{ asset('storage/'.$item->photo_path) }}" alt="{{ $item->name }}">
        @else
          <div class="absolute inset-0 flex items-center justify-center bg-blue-100 text-blue-300 font-black text-8xl">GK</div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-blue-900/80 via-transparent to-transparent md:hidden"></div>
        <div class="absolute bottom-6 left-6 right-6 text-white md:hidden">
           <div class="text-xs font-bold text-yellow-400 uppercase tracking-widest mb-1">HAMBA TUHAN</div>
           <h2 class="text-3xl font-black leading-tight">{{ $item->name }}</h2>
        </div>
      </div>

      {{-- Content Side --}}
      <div class="w-full md:w-7/12 lg:w-8/12 p-8 md:p-12 lg:p-16 flex flex-col">
        <div class="hidden md:block mb-8 border-b-2 border-gray-100 pb-6">
           <div class="text-xs font-bold text-blue-600 uppercase tracking-widest mb-2">HAMBA TUHAN</div>
           <h2 class="text-4xl lg:text-5xl font-black text-slate-800 leading-tight">{{ $item->name }}</h2>
        </div>

        <div class="space-y-10">
          <div>
            <h3 class="text-xl font-black text-slate-800 mb-4 flex items-center gap-3">
              <span class="w-8 h-1 bg-yellow-500 rounded-full"></span>
              Profile
            </h3>
            <div class="text-slate-600 text-lg leading-relaxed">
              {!! nl2br(e($item->profile ?: 'Info profile belum tersedia.')) !!}
            </div>
          </div>

          <div>
            <h3 class="text-xl font-black text-slate-800 mb-4 flex items-center gap-3">
              <span class="w-8 h-1 bg-yellow-500 rounded-full"></span>
              Bidang Pelayanan
            </h3>
            <div class="text-slate-600 text-lg leading-relaxed">
              @php
                $bidang = trim(($item->service_fields ?? ''));
                $ringkas = trim(($item->roles_summary ?? ''));
                $kontak = trim(($item->contact ?? ''));
              @endphp

              @if($bidang !== '')
                {!! nl2br(e($bidang)) !!}
              @elseif($ringkas !== '' || $kontak !== '')
                <p class="mb-2 font-bold text-blue-700">{{ $ringkas }}</p>
                @if($kontak) 
                  <p class="text-sm bg-blue-50 text-blue-800 py-2 px-4 rounded-lg inline-block font-bold">
                    Dukungan Doa &amp; Kontak : {{ $kontak }}
                  </p>
                @endif
              @else
                <span class="italic text-gray-400">Info bidang pelayanan belum tersedia.</span>
              @endif
            </div>
          </div>
        </div>

        <div class="mt-auto pt-12">
          <a class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-gray-100 text-slate-700 font-bold hover:bg-gray-200 transition-colors" href="{{ route('gereja.hamba') }}">
            <span>←</span> Kembali
          </a>
        </div>

      </div>
    </div>
  </div>
</section>

@php
  $kontak = trim(($item->contact ?? ''));
@endphp
<section class="py-20 bg-blue-600 text-white relative overflow-hidden text-center">
  <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
  <div class="relative z-10 container mx-auto px-6 max-w-3xl">
    <h2 class="text-3xl font-black mb-4">Butuh Dukungan Doa?</h2>
    <p class="text-blue-100 text-lg mb-8">
      @if($kontak !== '')
        Hubungi secara pribadi: <span class="font-bold text-white">{{ $kontak }}</span>
      @else
        Hubungi kami untuk informasi lebih lanjut.
      @endif
    </p>
    <a class="inline-block px-8 py-4 rounded-full bg-white text-blue-700 font-black shadow-xl hover:bg-yellow-400 hover:text-blue-900 hover:scale-105 transition-all duration-300" href="{{ route('kontak') }}">
      Hubungi Gereja
    </a>
  </div>
</section>
@endsection
