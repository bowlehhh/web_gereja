@extends('layout.app')

@section('title', $item->name.' - Hamba Tuhan')
@section('body_class','page-hamba-detail')

@section('content')
<section class="hamba-detail hamba-detail--fullscreen">
  <div class="hamba-detail-shell">
    <div class="hamba-detail-grid">
      <div class="hamba-detail-photo reveal">
        @if($item->photo_path)
          <img src="{{ asset('storage/'.$item->photo_path) }}" alt="{{ $item->name }}">
        @else
          <div class="hamba-detail-placeholder">GK</div>
        @endif
      </div>

      <div class="hamba-detail-panel reveal">
        <div class="hamba-detail-kicker">HAMBA TUHAN</div>
        <div class="hamba-detail-name">{{ $item->name }}</div>
        <div class="hamba-detail-line"></div>

        <div class="hamba-detail-section">
          <div class="hamba-detail-title">Profile</div>
          <div class="hamba-detail-text">
            {!! nl2br(e($item->profile ?: 'Info profile belum tersedia.')) !!}
          </div>
        </div>

        <div class="hamba-detail-section" style="margin-top:18px;">
          <div class="hamba-detail-title">Bidang Pelayanan</div>
          <div class="hamba-detail-text">
            @php
              $bidang = trim(($item->service_fields ?? ''));
              $ringkas = trim(($item->roles_summary ?? ''));
              $kontak = trim(($item->contact ?? ''));
            @endphp

            @if($bidang !== '')
              {!! nl2br(e($bidang)) !!}
            @elseif($ringkas !== '' || $kontak !== '')
              {{ $ringkas }}@if($ringkas && $kontak). @endif
              @if($kontak) Dukungan Doa &amp; Kontak : {{ $kontak }} @endif
            @else
              Info bidang pelayanan belum tersedia.
            @endif
          </div>
        </div>

        <div class="hamba-detail-back">
          <a class="hamba-back-btn" href="{{ route('gereja.hamba') }}">← Kembali</a>
        </div>
      </div>
    </div>
  </div>
</section>

@php
  $kontak = trim(($item->contact ?? ''));
@endphp
<section class="hamba-cta">
  <div class="container">
    <div class="hamba-cta-inner reveal">
      <div class="hamba-cta-title">Dukungan Doa &amp; Kontak</div>
      <div class="hamba-cta-sub">
        @if($kontak !== '')
          Kontak: {{ $kontak }}
        @else
          Hubungi kami untuk informasi lebih lanjut.
        @endif
      </div>
      <div class="hamba-cta-actions">
        <a class="hamba-cta-btn" href="{{ route('kontak') }}">Hubungi Kami</a>
      </div>
    </div>
  </div>
</section>
@endsection
