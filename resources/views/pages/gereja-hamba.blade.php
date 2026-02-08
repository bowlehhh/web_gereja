@extends('layout.app')
@section('title','Hamba Tuhan - GKKA Samarinda')
@section('content')
<section class="page-head"><div class="container">
  <h1 class="page-title">Hamba Tuhan</h1>
  <p class="page-sub">Daftar hamba Tuhan GKKA Indonesia Jemaat Samarinda.</p>
</div></section>

<section class="hamba-section">
  <div class="container">
    <h2 class="hamba-heading">HAMBA TUHAN GKKA SAMARINDA</h2>

    @if(isset($table_ready) && $table_ready === false)
      <div class="panel" style="padding:16px;margin-bottom:16px;">
        Database belum siap: tabel <b>hamba_tuhans</b> belum ada. Jalankan <b>php artisan migrate</b> lalu refresh halaman ini.
      </div>
    @endif

    <div class="hamba-grid">
      @forelse($items as $item)
        <div class="hamba-card reveal">
          <div class="hamba-photo">
            @if($item->photo_path)
              <img src="{{ asset('storage/'.$item->photo_path) }}" alt="{{ $item->name }}">
            @else
              <div class="hamba-photo-placeholder">GK</div>
            @endif
          </div>

          <div class="hamba-body">
            <div class="hamba-name">{{ $item->name }}</div>

            <div class="hamba-meta">
              @if($item->roles_summary)
                <div>{{ $item->roles_summary }}</div>
              @endif
              @if($item->contact)
                <div>Dukungan Doa &amp; Kontak : {{ $item->contact }}</div>
              @endif
              @if(!$item->roles_summary && !$item->contact)
                <div style="opacity:.75">Info singkat belum tersedia.</div>
              @endif
            </div>

            <div class="hamba-actions">
              <a class="hamba-btn" href="{{ route('gereja.hamba.show', $item) }}">Lihat Selengkapnya</a>
            </div>
          </div>
        </div>
      @empty
        <div class="panel" style="padding:16px;">Belum ada data Hamba Tuhan.</div>
      @endforelse
    </div>

    @if(method_exists($items, 'links'))
      <div style="margin-top:18px;">
        {{ $items->links() }}
      </div>
    @endif
  </div>
</section>
@endsection
