@extends('layout.app')
@section('title','Majelis - GKKA Samarinda')

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

        /* Zig-zag on mobile: alternate left/right around centered line */
        .timeline-row .reveal-content,
        .timeline-row .reveal-img {
            width: min(20rem, calc(100% - 5rem));
        }

        .timeline-row.is-left .reveal-content,
        .timeline-row.is-left .reveal-img {
            justify-self: start;
        }

        .timeline-row.is-right .reveal-content,
        .timeline-row.is-right .reveal-img {
            justify-self: end;
        }

        .timeline-row.is-right .reveal-content {
            text-align: right;
        }

        .timeline-dot {
            --branch-len: clamp(28px, 10vw, 64px);
            position: relative;
            z-index: 2;
        }

        .timeline-row.is-left .timeline-dot::before,
        .timeline-row.is-right .timeline-dot::before {
            content: "";
            position: absolute;
            top: 50%;
            height: 2px;
            background: #cbd5e1;
            width: var(--branch-len);
            transform: translateY(-50%);
            z-index: 0;
        }

        .timeline-row.is-left .timeline-dot::before {
            right: calc(100% + 0.5rem);
        }

        .timeline-row.is-right .timeline-dot::before {
            left: calc(100% + 0.5rem);
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
    <div class="w-full max-w-7xl mx-auto px-6 text-center">
        <h1 class="text-4xl md:text-5xl font-black mb-4 tracking-tight">Majelis</h1>
        <p class="text-lg text-blue-200 font-medium">Pelayanan dengan kasih, bertumbuh dalam iman.</p>
    </div>
</section>

<section class="py-20 timeline-container overflow-hidden majelis-pattern-bg">
    <div id="line-progress">
        <div id="line-active"></div>
    </div>

    <div class="max-w-6xl mx-auto px-6 relative">
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
    </div>
</section>
@endsection
