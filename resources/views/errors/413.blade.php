<!doctype html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Upload Terlalu Besar</title>
        @php
            $faviconVersion = @filemtime(public_path('favicon.ico')) ?: time();
        @endphp
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v={{ $faviconVersion }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v={{ $faviconVersion }}">
        <link rel="icon" type="image/png" href="{{ asset('assets/logo.png') }}?v={{ $faviconVersion }}">
        <style>
            :root { color-scheme: light dark; }
            body { margin: 0; font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, "Apple Color Emoji", "Segoe UI Emoji"; }
            .wrap { min-height: 100vh; display: grid; place-items: center; padding: 24px; }
            .card { max-width: 640px; width: 100%; border: 1px solid rgba(127,127,127,.35); border-radius: 16px; padding: 24px; }
            h1 { margin: 0 0 8px; font-size: 22px; }
            p { margin: 8px 0; line-height: 1.5; opacity: .9; }
            a { color: inherit; }
            .hint { font-size: 14px; opacity: .8; }
        </style>
    </head>
    <body>
        <div class="wrap">
            <div class="card">
                <h1>Upload terlalu besar (413)</h1>
                <p>Ukuran foto maksimal <strong>{{ $maxMb ?? 20 }}MB</strong>. Silakan kompres/resize foto lalu coba upload lagi.</p>
                <p class="hint"><a href="{{ url()->previous() }}">Kembali</a></p>
            </div>
        </div>
    </body>
</html>
