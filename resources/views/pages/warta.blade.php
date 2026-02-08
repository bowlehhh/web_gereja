@extends('layout.app')

@section('title', 'Warta Jemaat - GKKA Samarinda')

@section('content')
<section class="page-head">
  <div class="container">
    <h1 class="page-title">Warta Jemaat</h1>
    <p class="page-sub">Arsip warta jemaat GKKA Indonesia Jemaat Samarinda</p>
  </div>
</section>

<section class="warta-section">
  <div class="container">

    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:20px;">
      @forelse ($wartas as $w)
        <a href="{{ asset('storage/'.$w->pdf_path) }}" target="_blank" style="text-decoration:none;color:inherit;">
          <div style="
            border-radius:16px;
            overflow:hidden;
            background:#fff;
            box-shadow:0 12px 28px rgba(0,0,0,.12);
          ">

            {{-- THUMBNAIL --}}
            <div style="
              height:280px;
              background:#e5e5e5;
              background-image: url('{{ $w->thumbnail_path ? asset('storage/'.$w->thumbnail_path) : '' }}');
              background-size:cover;
              background-position:center;
            "></div>

            {{-- TEXT --}}
            <div style="padding:14px;">
              <div style="font-weight:900;">{{ $w->title }}</div>
              <div style="font-size:13px;color:#64748b;margin-top:4px;">
                {{ optional($w->date)->translatedFormat('d F Y') }}
                &nbsp;•&nbsp;
                Edisi {{ $w->edition ?? '-' }}
              </div>
            </div>

          </div>
        </a>
      @empty
        <div style="padding:18px;background:#fff;border-radius:12px;">
          Belum ada warta.
        </div>
      @endforelse
    </div>

    <div style="margin-top:20px;">
      {{ $wartas->links() }}
    </div>

  </div>
</section>
@endsection
