@extends('layout.app')
@section('title','Majelis - GKKA Samarinda')
@section('meta_description', 'Daftar periode dan informasi majelis GKKA Indonesia Jemaat Samarinda.')
@section('meta_image', asset('img/fotogrj.jpeg'))

@push('styles')
<style>
    /* 3D Timbul Effect */
    .card-3d-timbul {
        background: #ffffff;
        border: 1px solid #f1f5f9;
        box-shadow: 0 10px 20px -5px rgba(0,0,0,0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        transform-style: preserve-3d;
    }
    
    .card-3d-timbul:hover {
        box-shadow: 15px 15px 0px #e2e8f0; /* Efek bayangan kaku seperti balok */
        transform: translate(-5px, -5px);
    }

    .icon-block-3d {
        background: #3b82f6;
        box-shadow: 4px 4px 0px #1e3a8a; /* Timbul di icon */
        color: white;
    }

    /* Timeline Line Styling */
    .timeline-container { position: relative; }
    #line-progress {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        width: 4px;
        height: 100%;
        background: #e2e8f0; /* Jalur kosong */
        border-radius: 10px;
        overflow: hidden;
        z-index: 0; /* keep the line behind cards/images */
    }
    #line-active {
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, #2563eb, #60a5fa);
        transform: scaleY(0); /* Start dari 0 */
        transform-origin: top;
    }

    .timeline-row { z-index: 1; }

    @media (max-width: 768px) {
        .timeline-container { overflow: hidden; }

        #line-progress {
            left: 20px;
            transform: none;
            width: 3px;
            opacity: 0.9;
        }

        .timeline-row {
            grid-template-columns: 1fr;
            gap: 0.9rem;
            margin-bottom: 2.75rem;
            padding-left: 2rem;
            align-items: start;
        }

        .timeline-row .reveal-img,
        .timeline-row .reveal-content {
            width: 100%;
            justify-self: stretch;
            text-align: left;
        }

        .timeline-row.is-right .reveal-content {
            text-align: left;
        }

        .timeline-row .reveal-img > div {
            border-radius: 1.45rem;
        }

        .timeline-row .reveal-img img {
            aspect-ratio: 16 / 11;
        }

        .timeline-row .card-3d-timbul {
            padding: 1.25rem;
            border-radius: 1.25rem;
        }

        .timeline-dot {
            position: absolute;
            left: 20px;
            top: 1.2rem;
            width: 14px;
            height: 14px;
            margin: 0;
            transform: translateX(-50%);
            border-width: 3px;
            z-index: 3;
        }

        .timeline-dot::before {
            content: "";
            position: absolute;
            top: 50%;
            left: calc(100% + 4px);
            width: 18px;
            height: 2px;
            background: #93c5fd;
            transform: translateY(-50%);
            z-index: 0;
        }
    }

    /* Background (biru/putih + icon) untuk section majelis (timeline) */
    .majelis-pattern-bg {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, #eff6ff 0%, #ffffff 45%, #dbeafe 120%);
    }

    .majelis-pattern-bg::before {
        content: "";
        position: absolute;
        inset: 0;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='360' height='360' viewBox='0 0 360 360'%3E%3Cg fill='none' stroke='%231d4ed8' stroke-opacity='0.35' stroke-width='4' stroke-linecap='round' stroke-linejoin='round'%3E%3Cg transform='translate(30 36) rotate(-10 72 72) scale(6)'%3E%3Cpath d='M4 19.5V6.5c0-1.1.9-2 2-2h6v15H6c-1.1 0-2 .9-2 2Z'/%3E%3Cpath d='M20 19.5V6.5c0-1.1-.9-2-2-2h-6v15h6c1.1 0 2 .9 2 2Z'/%3E%3Cpath d='M12 7v3'/%3E%3Cpath d='M10.5 8.5h3'/%3E%3C/g%3E%3Cg transform='translate(214 44) rotate(12 60 60) scale(7)'%3E%3Cpath d='M12 2v20'/%3E%3Cpath d='M7 7h10'/%3E%3C/g%3E%3Cg transform='translate(92 212) rotate(8 70 70) scale(6)'%3E%3Cpath d='M4 19.5V6.5c0-1.1.9-2 2-2h6v15H6c-1.1 0-2 .9-2 2Z'/%3E%3Cpath d='M20 19.5V6.5c0-1.1-.9-2-2-2h-6v15h6c1.1 0 2 .9 2 2Z'/%3E%3Cpath d='M12 7v3'/%3E%3Cpath d='M10.5 8.5h3'/%3E%3C/g%3E%3Cg transform='translate(252 252) rotate(-10 60 60) scale(7)'%3E%3Cpath d='M12 2v20'/%3E%3Cpath d='M7 7h10'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        background-repeat: repeat;
        background-size: 520px 520px;
        opacity: 0.10;
        pointer-events: none;
        z-index: 0;
    }

    .majelis-pattern-bg::after {
        content: "";
        position: absolute;
        inset: 0;
        background:
            radial-gradient(circle at 28% 30%, rgba(37,99,235,0.10) 0%, rgba(37,99,235,0) 55%),
            radial-gradient(circle at 70% 20%, rgba(59,130,246,0.08) 0%, rgba(59,130,246,0) 52%),
            linear-gradient(120deg, rgba(255,255,255,0.55) 0%, rgba(255,255,255,0) 45%, rgba(255,255,255,0.35) 72%, rgba(255,255,255,0) 100%);
        pointer-events: none;
        z-index: 0;
    }

    .majelis-pattern-bg > * {
        position: relative;
        z-index: 1;
    }

    .majelis-pattern-bg #line-progress { z-index: 1; }
    .majelis-pattern-bg .timeline-row { z-index: 2; }
</style>
@endpush

@section('content')
<section class="bg-blue-900 text-white py-20 border-b border-slate-100">
    <div class="gkka-container text-center">
        <h1 class="text-4xl md:text-5xl font-black mb-4 tracking-tight">Majelis</h1>
        <p class="text-lg text-blue-200 font-medium">Pelayanan dengan kasih, bertumbuh dalam iman.</p>
    </div>
</section>

<section class="py-20 timeline-container overflow-hidden majelis-pattern-bg">
    @if($items->count())
        <div id="line-progress">
            <div id="line-active"></div>
        </div>
    @endif

    <div class="max-w-6xl mx-auto px-4 sm:px-6 relative">
        @if($items->count())
            @foreach($items as $i => $item)
                @php 
                    $isLeft = $i % 2 === 0; 
                    $periodParam = ($item->slug ?? null) === 'tidak-diketahui' ? 'tidak-diketahui' : ($item->period ?? null);
                    if ($item->photo_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($item->photo_path)) {
                        $img = \Illuminate\Support\Facades\Storage::url($item->photo_path); // /storage/...
                    } else {
                        $img = '/assets/logo.png';
                    }
                @endphp

                <div class="timeline-row {{ $isLeft ? 'is-left' : 'is-right' }} relative grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-24 items-center mb-32">
                    
                    <div class="timeline-dot order-2 md:order-none mx-auto md:mx-0 w-4 h-4 md:w-6 md:h-6 bg-white border-2 md:border-4 border-blue-600 rounded-full z-10 md:absolute md:left-1/2 md:top-1/2 md:-translate-x-1/2 md:-translate-y-1/2"></div>

                    <div class="{{ $isLeft ? 'md:text-right order-3 md:order-1' : 'md:col-start-2 order-3' }} reveal-content">
                        <div class="card-3d-timbul p-8 rounded-3xl">
                            <div class="mb-6 inline-flex p-3 rounded-xl icon-block-3d">
                                <i data-lucide="users-2" class="w-6 h-6"></i>
                            </div>
                            <h2 class="text-xs font-bold text-blue-600 uppercase tracking-widest mb-2">PERIODE</h2>
                            <h3 class="text-2xl font-black text-slate-800 mb-4">{{ $item->period ?: 'Tidak diketahui' }}</h3>
                            <p class="text-slate-500 leading-relaxed mb-6">{{ $item->excerpt }}</p>
                            
                            <a href="{{ $periodParam ? route('gereja.majelis.show', ['period' => $periodParam]) : route('gereja.majelis') }}" class="inline-flex items-center gap-2 font-bold text-blue-600 group">
                                ABOUT MAJELIS
                                <i data-lucide="arrow-up-right" class="w-4 h-4 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>

                    <div class="{{ $isLeft ? 'md:col-start-2 order-1' : 'md:col-start-1 md:row-start-1 order-1' }} reveal-img">
                        <div class="relative overflow-hidden rounded-[2.5rem] shadow-2xl bg-white">
                            <img src="{{ $img }}" class="w-full aspect-square object-cover transition-transform duration-700 hover:scale-110">
                        </div>
                    </div>

                </div>
            @endforeach
        @else
            <div class="max-w-2xl mx-auto text-center">
                <div class="card-3d-timbul rounded-3xl p-8 sm:p-10">
                    <div class="mx-auto mb-5 inline-flex size-14 items-center justify-center rounded-2xl bg-blue-50 text-blue-700 shadow-sm">
                        <i data-lucide="info" class="w-6 h-6"></i>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-black text-slate-800">Majelis belum tersedia</h2>
                    <p class="mt-2 text-slate-500 font-medium">
                        Data majelis akan ditampilkan di sini setelah ditambahkan oleh admin.
                    </p>
                    <div class="mt-6">
                        <a href="{{ route('kontak') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-blue-900 text-white font-bold shadow-lg hover:bg-blue-800 transition">
                            Hubungi Admin
                            <i data-lucide="arrow-up-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
