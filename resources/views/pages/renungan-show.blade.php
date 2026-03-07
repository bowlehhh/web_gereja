@extends('layout.app')

@section('title', $item->title.' | Renungan GKKA-I INDONESIA')
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($item->excerpt), 160))
@section('meta_image', asset('img/tuhan%20yesus.jpeg'))

@section('content')
@php
  $hero = asset('img/tuhan%20yesus.jpeg');
  $published = $item->published_at;
  $contentWords = str_word_count(strip_tags((string) $item->content));
  $readingMinutes = max(1, (int) ceil($contentWords / 220));

  $dayLabel = $published ? \Illuminate\Support\Str::upper($published->translatedFormat('l')) : 'HARI INI';
  $dateLabel = $published ? \Illuminate\Support\Str::upper($published->translatedFormat('j F')) : '-';
  $yearLabel = $published ? $published->translatedFormat('Y') : '';
  $metaDate = $published ? $published->translatedFormat('d F Y') : '-';
  $categoryLabel = trim((string) $item->scripture_reference) !== '' ? trim((string) $item->scripture_reference) : 'Renungan Harian';

  $shareUrl = url()->current();
  $shareText = trim($item->title.' - '.$item->excerpt);
  $waUrl = 'https://wa.me/?text='.rawurlencode($shareText.' '.$shareUrl);
  $fbUrl = 'https://www.facebook.com/sharer/sharer.php?u='.rawurlencode($shareUrl);
  $mailUrl = 'mailto:?subject='.rawurlencode($item->title).'&body='.rawurlencode($shareText."\n\n".$shareUrl);

  $paragraphs = collect(preg_split('/\R+/', trim((string) $item->content) ?: '') ?: [])
    ->map(fn ($line) => trim((string) $line))
    ->filter(fn ($line) => $line !== '')
    ->values();
@endphp

<style>
  .ren-show-page {
    background: #e7edf6;
  }

  .ren-show-stage {
    min-height: 100dvh;
    padding: 102px 16px 72px;
    background-image:
      linear-gradient(180deg, rgba(249, 253, 255, 0.32) 0%, rgba(218, 231, 248, 0.24) 24%, rgba(17, 44, 80, 0.46) 68%, rgba(12, 33, 65, 0.56) 100%),
      url('{{ $hero }}');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center center;
  }

  .ren-show-wrap {
    max-width: 1180px;
    margin: 0 auto;
  }

  .ren-show-panel {
    max-width: 1080px;
    margin: 0 auto;
    border-radius: 22px;
    border: 1px solid rgba(164, 193, 229, 0.95);
    background: linear-gradient(180deg, rgba(214, 228, 245, 0.78) 0%, rgba(198, 217, 240, 0.70) 100%);
    backdrop-filter: blur(2px);
    box-shadow: 0 24px 56px rgba(9, 27, 52, 0.34);
    padding: 20px;
    color: #0f172a;
    min-height: clamp(520px, 68vh, 760px);
    display: flex;
    flex-direction: column;
  }

  .ren-show-head {
    display: flex;
    gap: 18px;
    align-items: flex-start;
  }

  .ren-date-badge {
    flex: 0 0 104px;
    min-height: 104px;
    border-radius: 16px;
    background: linear-gradient(180deg, #244f9f 0%, #173a7a 100%);
    color: #fff;
    display: grid;
    place-content: center;
    text-align: center;
    padding: 10px 8px;
    box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.2);
    overflow: hidden;
  }

  .ren-date-badge span {
    font-weight: 800;
    font-size: 12px;
    letter-spacing: 0.06em;
    line-height: 1.15;
  }

  .ren-date-badge strong {
    margin-top: 2px;
    font-size: 31px;
    line-height: 1.02;
    font-weight: 900;
    letter-spacing: 0.02em;
    white-space: normal;
    word-break: keep-all;
  }

  .ren-date-badge em {
    margin-top: 3px;
    font-size: 15px;
    line-height: 1;
    font-style: normal;
    font-weight: 900;
    letter-spacing: 0.04em;
  }

  .ren-head-main {
    flex: 1;
    min-width: 0;
  }

  .ren-head-main h1 {
    margin: 0;
    color: #11203f;
    font-size: clamp(34px, 5.2vw, 52px);
    line-height: 0.99;
    text-transform: uppercase;
    letter-spacing: 0.01em;
    font-family: "Georgia", "Times New Roman", serif;
    font-weight: 700;
  }

  .ren-head-meta {
    margin-top: 6px;
    font-size: 16px;
    font-weight: 600;
    color: #17233e;
    line-height: 1.45;
  }

  .ren-head-meta strong {
    font-weight: 800;
  }

  .ren-show-excerpt {
    margin: 14px 2px 14px;
    color: #091428;
    font-size: 17px;
    line-height: 1.5;
    font-weight: 500;
  }

  .ren-verse-label {
    display: inline-flex;
    align-items: center;
    border-radius: 999px;
    background: rgba(19, 51, 102, 0.12);
    border: 1px solid rgba(29, 66, 125, 0.24);
    color: #112a53;
    font-size: 11px;
    font-weight: 900;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    padding: 6px 10px;
  }

  .ren-content-card {
    background: #ffffff;
    border: 1px solid #cfdaea;
    border-radius: 18px;
    padding: 12px 16px 16px;
    box-shadow: inset 0 0 0 1px rgba(224, 232, 243, 0.7);
    flex: 1;
  }

  .ren-content-label {
    display: inline-flex;
    align-items: center;
    border-radius: 999px;
    background: #e7eef8;
    color: #172c52;
    border: 1px solid #d5e1f1;
    font-weight: 900;
    font-size: 12px;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    padding: 8px 14px;
  }

  .ren-content-text {
    margin-top: 12px;
    color: #101828;
    font-size: 16px;
    line-height: 1.66;
    font-weight: 500;
  }

  .ren-content-text p {
    margin: 0 0 11px;
  }

  .ren-content-text p:last-child {
    margin-bottom: 0;
  }

  .ren-content-text p:first-child::first-letter {
    font-size: 45px;
    font-weight: 900;
    color: #1d4fc0;
    float: left;
    margin-right: 6px;
    line-height: 0.9;
  }

  .ren-show-foot {
    margin-top: auto;
    padding-top: 14px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
  }

  .ren-share {
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .ren-share span {
    color: #ffffff;
    font-size: 16px;
    font-weight: 700;
    text-shadow: 0 1px 6px rgba(6, 20, 41, 0.45);
  }

  .ren-share-btn {
    width: 38px;
    height: 38px;
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px solid rgba(255, 255, 255, 0.38);
    box-shadow: 0 8px 18px rgba(7, 20, 39, 0.26);
  }

  .ren-share-btn svg {
    width: 18px;
    height: 18px;
    fill: #fff;
  }

  .ren-share-btn.whatsapp { background: #25d366; }
  .ren-share-btn.facebook { background: #1877f2; }
  .ren-share-btn.mail { background: #8f98a8; }

  .ren-comment-btn {
    min-height: 40px;
    padding: 0 16px;
    border-radius: 999px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    background: #f9fbff;
    border: 1px solid #b9c9de;
    color: #123059;
    font-size: 15px;
    font-weight: 700;
    text-decoration: none;
    box-shadow: 0 8px 18px rgba(7, 20, 39, 0.18);
  }

  .ren-comment-btn svg {
    width: 17px;
    height: 17px;
    stroke: currentColor;
  }

  @media (max-width: 900px) {
    .ren-show-wrap {
      max-width: 100%;
    }

    .ren-show-stage {
      padding-top: 96px;
      padding-bottom: 50px;
      background-position: 54% center;
    }

    .ren-show-panel {
      padding: 16px;
      border-radius: 18px;
      min-height: 0;
    }

    .ren-show-head {
      gap: 12px;
    }

    .ren-date-badge {
      flex-basis: 88px;
      min-height: 92px;
      border-radius: 13px;
    }

    .ren-date-badge strong {
      font-size: 28px;
    }

    .ren-head-main h1 {
      font-size: clamp(26px, 7vw, 38px);
    }

    .ren-head-meta {
      font-size: 15px;
    }

    .ren-show-excerpt {
      margin-top: 12px;
      font-size: 16px;
      line-height: 1.5;
    }

    .ren-verse-label {
      font-size: 10px;
      letter-spacing: 0.06em;
      padding: 5px 9px;
    }

    .ren-content-label {
      font-size: 11px;
      padding: 7px 11px;
    }

    .ren-content-text {
      font-size: 15px;
      line-height: 1.68;
    }

    .ren-share span {
      font-size: 18px;
    }

    .ren-share-btn {
      width: 34px;
      height: 34px;
    }

    .ren-comment-btn {
      min-height: 36px;
      font-size: 16px;
      padding: 0 13px;
    }
  }

  @media (max-width: 640px) {
    .ren-show-stage {
      padding-top: 84px;
      padding-left: 10px;
      padding-right: 10px;
      padding-bottom: 34px;
      background-position: 57% center;
    }

    .ren-show-head {
      flex-direction: column;
      gap: 10px;
    }

    .ren-date-badge {
      width: min(100%, 148px);
      min-height: 84px;
      padding: 8px 10px;
      align-self: flex-start;
      border-radius: 14px;
    }

    .ren-date-badge span {
      font-size: 10px;
      letter-spacing: 0.07em;
    }

    .ren-date-badge strong {
      font-size: clamp(22px, 8vw, 25px);
      line-height: 1.04;
      margin-top: 1px;
      white-space: normal;
    }

    .ren-date-badge em {
      font-size: 12px;
      margin-top: 2px;
    }

    .ren-head-main h1 {
      font-size: clamp(24px, 8vw, 32px);
    }

    .ren-head-meta {
      font-size: 13px;
      line-height: 1.5;
    }

    .ren-show-excerpt {
      margin: 10px 0 12px;
      font-size: 18px;
      line-height: 1.6;
    }

    .ren-content-card {
      padding: 10px 11px 12px;
      border-radius: 14px;
    }

    .ren-content-label {
      font-size: 10px;
      letter-spacing: 0.03em;
      line-height: 1.25;
      padding: 7px 10px;
    }

    .ren-content-text {
      margin-top: 10px;
      font-size: 14px;
      line-height: 1.75;
    }

    .ren-content-text p:first-child::first-letter {
      font-size: 36px;
    }

    .ren-show-foot {
      margin-top: 12px;
      flex-direction: column;
      align-items: stretch;
      gap: 10px;
    }

    .ren-share span {
      font-size: 15px;
    }

    .ren-share-btn {
      width: 30px;
      height: 30px;
      border-radius: 7px;
    }

    .ren-share-btn svg {
      width: 15px;
      height: 15px;
    }

    .ren-comment-btn {
      width: 100%;
      min-height: 36px;
      font-size: 14px;
      padding: 0 12px;
    }
  }

  @media (max-width: 420px) {
    .ren-date-badge {
      width: 126px;
      min-height: 80px;
    }

    .ren-date-badge strong {
      font-size: 22px;
    }
  }
</style>

<div class="ren-show-page">
  <section class="ren-show-stage">
    <div class="ren-show-wrap">
      <article class="ren-show-panel">
        <header class="ren-show-head">
          <div class="ren-date-badge">
            <span>{{ $dayLabel }},</span>
            <strong>{{ $dateLabel }}</strong>
            <em>{{ $yearLabel }}</em>
          </div>

          <div class="ren-head-main">
            <h1>{{ $item->title }}</h1>
            <div class="ren-head-meta">
              Oleh: <strong>{{ $item->author }}</strong> | Waktu Baca: {{ $readingMinutes }} Menit | Kategori: {{ $categoryLabel }}
            </div>
          </div>
        </header>

        @if(trim((string) $item->excerpt) !== '')
          <div class="ren-verse-label">Ayat Firman</div>
          <p class="ren-show-excerpt">{{ $item->excerpt }}</p>
        @endif

        <section class="ren-content-card">
          <div class="ren-content-label">Tafsiran Renungan</div>
          <div class="ren-content-text">
            @if($paragraphs->isNotEmpty())
              @foreach($paragraphs as $paragraph)
                <p>{{ $paragraph }}</p>
              @endforeach
            @else
              <p>{{ $item->content }}</p>
            @endif
          </div>
        </section>

        <footer class="ren-show-foot">
          <div class="ren-share">
            <span>Share</span>
            <a href="{{ $waUrl }}" class="ren-share-btn whatsapp" target="_blank" rel="noopener" aria-label="Share ke WhatsApp">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.198.297-.767.966-.94 1.164-.173.198-.347.223-.644.075-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.447-.52.149-.174.198-.298.298-.497.099-.199.05-.372-.025-.521-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.273.297-1.04 1.016-1.04 2.48s1.065 2.877 1.213 3.075c.149.198 2.095 3.2 5.076 4.487.709.306 1.262.489 1.694.625.712.227 1.361.195 1.874.118.572-.085 1.758-.718 2.006-1.412.248-.694.248-1.289.173-1.412-.074-.124-.272-.198-.57-.347zM12.004 2.003c-5.514 0-9.984 4.47-9.984 9.985 0 1.762.46 3.416 1.266 4.849L2 22l5.318-1.243a9.943 9.943 0 0 0 4.686 1.188h.004c5.513 0 9.988-4.47 9.988-9.985 0-2.672-1.04-5.184-2.93-7.073a9.94 9.94 0 0 0-7.062-2.884z"/></svg>
            </a>
            <a href="{{ $fbUrl }}" class="ren-share-btn facebook" target="_blank" rel="noopener" aria-label="Share ke Facebook">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.326v21.348c0 .732.593 1.326 1.325 1.326h11.495v-9.294h-3.128v-3.622h3.128V8.413c0-3.1 1.894-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24h-1.918c-1.504 0-1.796.716-1.796 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116c.73 0 1.324-.594 1.324-1.326V1.326C24 .593 23.405 0 22.675 0z"/></svg>
            </a>
            <a href="{{ $mailUrl }}" class="ren-share-btn mail" aria-label="Share via Email">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M2 4h20a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1zm10 8 9-6H3l9 6zm0 2-10-6v10h20V8l-10 6z"/></svg>
            </a>
          </div>

          <a href="{{ route('kontak') }}" class="ren-comment-btn">
            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M8 10h8M8 14h5m-5 6h8a3 3 0 0 0 3-3V9a3 3 0 0 0-3-3H8a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3zm0 0-4 3v-3" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Komentar
          </a>
        </footer>
      </article>
    </div>
  </section>
</div>
@endsection
