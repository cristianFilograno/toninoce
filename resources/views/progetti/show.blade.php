@php use Illuminate\Support\Facades\Storage; @endphp
@extends('layouts.app')

@section('title', $progetto->getTranslation('titolo', app()->getLocale()) . ' — TONINOcè')

@section('description', Str::limit(
    $progetto->getTranslation('descrizione', app()->getLocale())
        ?: (app()->getLocale() === 'it'
            ? 'Progetto di ingegneria strutturale — TONINOcè Studio.'
            : 'Structural engineering project — TONINOcè Studio.'),
    160
))

@section('content')
@php
    $locale    = app()->getLocale();
    $titolo    = $progetto->getTranslation('titolo', $locale);
    $desc      = $progetto->getTranslation('descrizione', $locale);
    $luogo     = $progetto->getTranslation('luogo', $locale);
    $copertina = $progetto->getFotoCopertina();
    $galleria  = $progetto->getGalleriaUrls();

    $slides = collect();
    if ($copertina) $slides->push($copertina);
    foreach ($galleria as $url) $slides->push($url);
    $total = $slides->count();
@endphp

{{-- Breadcrumb --}}
<div class="max-w-7xl mx-auto px-6 pt-10 pb-8">
    <nav class="flex items-center gap-2 text-xs tracking-widest uppercase" style="color:#4e4030;">
        <a href="{{ route('progetti', ['locale' => $locale]) }}"
           onmouseover="this.style.color='#1a1510';" onmouseout="this.style.color='#4e4030';"
           class="transition-colors">
            {{ $locale === 'it' ? 'Progetti' : 'Projects' }}
        </a>
        <span style="color:#d8cdb8;">/</span>
        <span style="color:#1a1510;">{{ $titolo }}</span>
    </nav>
</div>

{{-- Layout: carosello a sinistra, scheda tecnica a destra --}}
<section class="max-w-7xl mx-auto px-6 mb-20">
    <div class="grid md:grid-cols-[1fr_300px] gap-12 items-start">

        {{-- Colonna sinistra: titolo + carosello + descrizione --}}
        <div>
            @if($progetto->anno)
            <p class="text-sm font-medium mb-3" style="color:#c0392b;">{{ $progetto->anno }}</p>
            @endif
            <h1 class="font-display mb-8"
                style="font-size:clamp(2rem,4vw,3.5rem); font-weight:900; color:#1a1510; line-height:1.05;">
                {{ $titolo }}
            </h1>

            {{-- Slider --}}
            @if($total > 0)
            <div class="relative mb-10 select-none" style="border:1px solid #d8cdb8; overflow:hidden;">

                {{-- Track --}}
                <div id="show-track" class="flex"
                     style="transition:transform 0.45s cubic-bezier(0.4,0,0.2,1);">
                    @foreach($slides as $idx => $url)
                    <img src="{{ $url }}"
                         alt="{{ $titolo }}{{ $idx > 0 ? ' — ' . ($locale === 'it' ? 'foto' : 'photo') . ' ' . ($idx+1) : '' }}"
                         draggable="false"
                         onclick="openLightbox(this.src, this.alt)"
                         style="width:100%; flex-shrink:0; height:520px; object-fit:cover; display:block;
                                cursor:zoom-in;">
                    @endforeach
                </div>

                @if($total > 1)
                {{-- Barra inferiore: frecce + counter --}}
                <div class="flex items-center justify-between px-4 py-2.5"
                     style="background:#1a1510;">
                    <button onclick="showPrev()"
                            class="flex items-center gap-2 text-xs tracking-widest uppercase transition-colors"
                            style="color:#8a7a64;"
                            onmouseover="this.style.color='#f0ead6';" onmouseout="this.style.color='#8a7a64';">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        {{ $locale === 'it' ? 'Prec' : 'Prev' }}
                    </button>

                    <span id="show-counter" class="text-xs tracking-widest" style="color:#8a7a64;">
                        1 / {{ $total }}
                    </span>

                    <button onclick="showNext()"
                            class="flex items-center gap-2 text-xs tracking-widest uppercase transition-colors"
                            style="color:#8a7a64;"
                            onmouseover="this.style.color='#f0ead6';" onmouseout="this.style.color='#8a7a64';">
                        {{ $locale === 'it' ? 'Succ' : 'Next' }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                </div>
                @endif
            </div>
            @endif

            {{-- Descrizione --}}
            @if($desc)
            <div class="leading-relaxed text-base" style="color:#1a1510; max-width:65ch;">
                {!! nl2br(e($desc)) !!}
            </div>
            @endif
        </div>

        {{-- Scheda tecnica --}}
        <div class="border-l pl-10 pt-16" style="border-color:#d8cdb8;">
            <p class="text-[10px] tracking-[0.3em] uppercase mb-8 font-medium" style="color:#c0392b;">
                {{ $locale === 'it' ? 'Scheda tecnica' : 'Project details' }}
            </p>
            <dl class="space-y-6">
                @if($progetto->anno)
                <div>
                    <dt class="text-[10px] tracking-[0.2em] uppercase mb-1" style="color:#4e4030;">Anno</dt>
                    <dd class="text-sm font-medium" style="color:#1a1510;">{{ $progetto->anno }}</dd>
                </div>
                @endif
                @if($luogo)
                <div>
                    <dt class="text-[10px] tracking-[0.2em] uppercase mb-1" style="color:#4e4030;">{{ $locale === 'it' ? 'Luogo' : 'Location' }}</dt>
                    <dd class="text-sm font-medium" style="color:#1a1510;">{{ $luogo }}</dd>
                </div>
                @endif
                @if($progetto->importo_lavori)
                <div>
                    <dt class="text-[10px] tracking-[0.2em] uppercase mb-1" style="color:#4e4030;">{{ $locale === 'it' ? 'Importo lavori' : 'Works value' }}</dt>
                    <dd class="text-sm font-medium" style="color:#1a1510;">€ {{ number_format($progetto->importo_lavori, 0, ',', '.') }}</dd>
                </div>
                @endif
                @if($progetto->categoria)
                <div>
                    <dt class="text-[10px] tracking-[0.2em] uppercase mb-1" style="color:#4e4030;">{{ $locale === 'it' ? 'Categoria' : 'Category' }}</dt>
                    <dd class="text-sm font-medium" style="color:#1a1510;">
                        {{ $progetto->categoria->getTranslation('nome', $locale) }}
                    </dd>
                </div>
                @endif
                @if($total > 0)
                <div>
                    <dt class="text-[10px] tracking-[0.2em] uppercase mb-1" style="color:#4e4030;">{{ $locale === 'it' ? 'Foto' : 'Photos' }}</dt>
                    <dd class="text-sm font-medium" style="color:#1a1510;">{{ $total }}</dd>
                </div>
                @endif
            </dl>
        </div>
    </div>
</section>

{{-- Documentazione allegata --}}
@php $allegati = $progetto->getAllegati(); @endphp
@if(count($allegati))
<section class="max-w-7xl mx-auto px-6 mb-16">
    <div class="border-t pt-10" style="border-color:#d8cdb8;">
        <p class="text-[10px] tracking-[0.3em] uppercase mb-6 font-medium" style="color:#c0392b;">
            {{ $locale === 'it' ? 'Documentazione allegata' : 'Attached documentation' }}
        </p>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-3">
            @foreach($allegati as $file)
            <a href="{{ $file['url'] }}" target="_blank" rel="noopener"
               class="flex items-center gap-4 px-4 py-3 border transition-all group"
               style="border-color:#d8cdb8;"
               onmouseover="this.style.borderColor='#1a1510'; this.style.background='#ede7d3';"
               onmouseout="this.style.borderColor='#d8cdb8'; this.style.background='transparent';">
                {{-- Badge tipo --}}
                <span class="flex-shrink-0 w-10 h-10 flex items-center justify-center text-[10px] font-bold tracking-wider"
                      style="background:{{ $file['tipo'] === 'pdf' ? '#ef4444' : '#22c55e' }}; color:#fff;">
                    {{ $file['ext'] }}
                </span>
                {{-- Nome file --}}
                <div class="min-w-0">
                    <p class="text-xs font-medium truncate" style="color:#1a1510;">{{ $file['nome'] }}</p>
                    <p class="text-[10px] mt-0.5" style="color:#8a7a64;">
                        {{ $locale === 'it' ? 'Scarica' : 'Download' }}
                        <svg class="inline w-3 h-3 ml-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                    </p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Nav torna ai progetti --}}
<div class="max-w-7xl mx-auto px-6 pb-20 border-t pt-8" style="border-color:#d8cdb8;">
    <a href="{{ route('progetti', ['locale' => $locale]) }}"
       class="inline-flex items-center gap-2 text-xs tracking-widest uppercase transition-colors"
       style="color:#4e4030;"
       onmouseover="this.style.color='#1a1510';" onmouseout="this.style.color='#4e4030';">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"/>
        </svg>
        {{ $locale === 'it' ? 'Tutti i progetti' : 'All projects' }}
    </a>
</div>

<script>
var _showIdx = 0;
var _showTotal = {{ $total }};

function showGoTo(idx) {
    _showIdx = idx;
    document.getElementById('show-track').style.transform = 'translateX(-' + (idx * 100) + '%)';
    var c = document.getElementById('show-counter');
    if (c) c.textContent = (idx + 1) + ' / ' + _showTotal;
}
function showNext() { showGoTo((_showIdx + 1) % _showTotal); }
function showPrev() { showGoTo((_showIdx - 1 + _showTotal) % _showTotal); }

// Swipe
(function() {
    var track = document.getElementById('show-track');
    if (!track) return;
    var startX = 0;
    track.addEventListener('touchstart', function(e) { startX = e.touches[0].clientX; }, {passive:true});
    track.addEventListener('touchend', function(e) {
        var diff = startX - e.changedTouches[0].clientX;
        if (Math.abs(diff) > 40) diff > 0 ? showNext() : showPrev();
    }, {passive:true});
})();
</script>

@endsection
