@extends('layout.app')
@section('title','Hamba Tuhan - GKKA Samarinda')
@section('content')
<section class="bg-blue-900 text-white py-20">
  <div class="gkka-container text-center">
    <h1 class="text-4xl md:text-5xl font-black mb-4 tracking-tight">Hamba Tuhan</h1>
    <p class="text-lg text-blue-200 font-medium">Daftar hamba Tuhan GKKA Indonesia Jemaat Samarinda.</p>
  </div>
</section>

<section class="py-16 bg-gray-50">
  <div class="gkka-container">
    <h2 class="text-3xl font-black text-center text-blue-900 mb-12 uppercase tracking-wide">Hamba Tuhan GKKA Samarinda</h2>

    @if(isset($table_ready) && $table_ready === false)
      <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-8 text-yellow-800 rounded-r-lg">
        Database belum siap: tabel <b>hamba_tuhans</b> belum ada. Jalankan <b>php artisan migrate</b> lalu refresh halaman ini.
      </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 mb-12">
      @forelse($items as $item)
        <div class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 border border-gray-100 flex flex-col h-full">
          <div class="h-80 overflow-hidden relative bg-gray-200">
            @if($item->photo_path)
              <img class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-700" src="{{ asset('storage/'.$item->photo_path) }}" alt="{{ $item->name }}">
            @else
              <div class="w-full h-full flex items-center justify-center bg-blue-100 text-blue-300 font-black text-6xl">GK</div>
            @endif
            <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-black/60 to-transparent"></div>
          </div>

          <div class="p-6 flex flex-col flex-grow">
            <div class="font-black text-xl text-slate-800 mb-2 leading-tight group-hover:text-blue-700 transition-colors">{{ $item->name }}</div>

            <div class="text-sm text-slate-500 mb-6 flex-grow space-y-2">
              @if($item->roles_summary)
                <div class="font-bold text-blue-600">{{ $item->roles_summary }}</div>
              @endif
              @if($item->contact)
                <div class="text-xs">
                   <span class="block font-bold text-gray-400 uppercase tracking-wider mb-1">Kontak</span>
                   {{ $item->contact }}
                </div>
              @endif
              @if(!$item->roles_summary && !$item->contact)
                <div class="italic opacity-70">Info singkat belum tersedia.</div>
              @endif
            </div>

            <div class="mt-auto">
              <a class="block w-full py-3 rounded-xl bg-blue-50 text-blue-700 font-bold text-center hover:bg-blue-600 hover:text-white transition-colors" href="{{ route('gereja.hamba.show', $item) }}">Lihat Profile</a>
            </div>
          </div>
        </div>
      @empty
        <div class="col-span-full p-12 bg-white rounded-3xl border border-gray-200 text-center text-gray-400 font-bold">Belum ada data Hamba Tuhan.</div>
      @endforelse
    </div>

    @if(method_exists($items, 'links'))
      <div class="mt-12">
        {{ $items->links() }}
      </div>
    @endif
  </div>
</section>
@endsection
