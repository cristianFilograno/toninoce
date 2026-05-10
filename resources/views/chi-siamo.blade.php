@extends('layouts.app')

@section('title', app()->getLocale() === 'it' ? 'Studio — TONINOcè' : 'Studio — TONINOcè')

@section('description', app()->getLocale() === 'it'
    ? 'TONINOcè è uno studio di ingegneria strutturale specializzato in progettazione, direzione lavori, recupero e consolidamento di edifici. Dal 2010.'
    : 'TONINOcè is a structural engineering studio specialised in design, site management, recovery and consolidation of buildings. Since 2010.')

@section('content')

{{-- ── HERO ─────────────────────────────────────────────────────── --}}
<section class="min-h-[85vh] flex flex-col justify-center">
    <div class="max-w-7xl mx-auto px-6 py-24">

        <div data-animate data-delay="0.05s" class="flex items-center gap-4 mb-10">
            <div class="w-8 h-px" style="background:#c0392b;"></div>
            <p class="text-xs tracking-[0.3em] uppercase" style="color:#4e4030;">
                {{ app()->getLocale() === 'it' ? 'Studio di Ingegneria · Dal 2010' : 'Engineering Studio · Since 2010' }}
            </p>
        </div>

        <h1 data-animate data-delay="0.15s"
            class="font-display leading-[1.05] mb-8"
            style="font-size:clamp(3rem,8vw,7.5rem); font-weight:900; color:#1a1510; max-width:15ch;">
            {{ app()->getLocale() === 'it' ? 'Costruire con' : 'Building with' }}
            <span class="font-italic" style="font-style:italic; color:#c0392b; font-weight:400;">
                {{ app()->getLocale() === 'it' ? 'precisione,' : 'precision,' }}
            </span><br>
            {{ app()->getLocale() === 'it' ? 'progettare con' : 'designing with' }}
            <span class="font-italic" style="font-style:italic; color:#c0392b; font-weight:400;">
                {{ app()->getLocale() === 'it' ? 'misura.' : 'measure.' }}
            </span>
        </h1>

        <p data-animate data-delay="0.28s"
           class="mb-12 max-w-lg leading-relaxed"
           style="font-size:1.125rem; color:#4e4030; font-weight:300;">
            {{ app()->getLocale() === 'it'
                ? 'TONINOcè è uno studio di ingegneria strutturale specializzato in progettazione, direzione lavori e consolidamento. Operiamo dove la tecnica incontra la cura per il dettaglio.'
                : 'TONINOcè is a structural engineering studio specialised in design, site management and consolidation. We work where technique meets attention to detail.' }}
        </p>

        <div data-animate data-delay="0.4s"
             class="flex flex-wrap justify-center md:justify-start items-center gap-4">
            <a href="{{ route('progetti', ['locale' => app()->getLocale()]) }}"
               class="inline-flex items-center gap-2 px-7 py-3.5 font-medium text-sm transition-all duration-200"
               style="background:#1a1510; color:#f0ead6;"
               onmouseover="this.style.background='#c0392b';"
               onmouseout="this.style.background='#1a1510';">
                {{ app()->getLocale() === 'it' ? 'Vedi i progetti' : 'See our projects' }}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
            <a href="{{ route('contatti', ['locale' => app()->getLocale()]) }}"
               class="inline-flex items-center gap-2 px-7 py-3.5 font-medium text-sm border transition-all duration-200"
               style="border-color:#1a1510; color:#1a1510;"
               onmouseover="this.style.background='#1a1510';this.style.color='#f0ead6';"
               onmouseout="this.style.background='transparent';this.style.color='#1a1510';">
                {{ app()->getLocale() === 'it' ? 'Richiedi una consulenza' : 'Request a consultation' }}
            </a>
        </div>
    </div>
</section>

{{-- ── TICKER NEWS ──────────────────────────────────────────────── --}}
<div data-animate="fade" class="overflow-hidden border-y py-4" style="border-color:#d8cdb8; background:rgba(240,234,214,0.6);">
    <div class="ticker-track select-none" style="white-space:nowrap;">
        @php $items = [
            'Nuovo progetto completato a Milano',
            'Certificazione sismica edificio storico — Firenze',
            'Collaborazione con studio Archi+Partners',
            'Seminario BIM strutturale — Politecnico di Torino',
            'Progetto residenziale NZEB premiato',
            'Consolidamento fondazioni — Venezia Centro Storico',
            'Nuovo progetto completato a Milano',
            'Certificazione sismica edificio storico — Firenze',
            'Collaborazione con studio Archi+Partners',
            'Seminario BIM strutturale — Politecnico di Torino',
            'Progetto residenziale NZEB premiato',
            'Consolidamento fondazioni — Venezia Centro Storico',
        ]; @endphp
        @foreach($items as $item)
        <span class="inline-flex items-center gap-5 mx-5"
              style="font-style:italic; font-size:1.05rem; color:#4e4030;
                     font-family:'Cormorant Garamond',serif; font-weight:300;">
            <span style="color:#c0392b; font-style:normal; font-size:0.55rem;">&#9670;</span>
            {{ $item }}
        </span>
        @endforeach
    </div>
</div>

{{-- ── SEZIONE DETTAGLIO STUDIO ─────────────────────────────────── --}}
<section class="py-24 max-w-7xl mx-auto px-6">
    <div class="grid md:grid-cols-2 gap-16 items-center">

        <div data-animate="left" class="aspect-[4/3]" style="background:#e0d8c8;">
            <div class="w-full h-full flex items-center justify-center"
                 style="color:#b5a898; font-family:'Cormorant Garamond',serif; font-size:1.2rem; font-style:italic;">
                {{ app()->getLocale() === 'it' ? 'Immagine studio' : 'Studio image' }}
            </div>
        </div>

        <div>
            <p data-animate data-delay="0.05s"
               class="text-xs tracking-[0.3em] uppercase mb-6" style="color:#c0392b;">
                / {{ app()->getLocale() === 'it' ? 'Il metodo' : 'Our method' }}
            </p>
            <h2 data-animate data-delay="0.12s"
                class="font-display leading-tight mb-6"
                style="font-size:clamp(2rem,4vw,3rem); font-weight:700; color:#1a1510;">
                {{ app()->getLocale() === 'it' ? 'Ingegneria come sartoria del costruito.' : 'Engineering as bespoke construction.' }}
            </h2>
            <p data-animate data-delay="0.22s"
               class="leading-relaxed mb-6" style="color:#4e4030; font-size:1rem;">
                {{ app()->getLocale() === 'it'
                    ? 'Ogni progetto è un abito su misura: ascoltiamo il territorio, interpretiamo i vincoli, progettiamo soluzioni che durano. La nostra esperienza spazia dalla progettazione strutturale al recupero di edifici storici, dalla direzione lavori alla sostenibilità NZEB.'
                    : 'Every project is bespoke: we listen to the territory, interpret the constraints, and design solutions that last. Our expertise spans structural design, historic building restoration, site management and NZEB sustainability.' }}
            </p>
            <p data-animate data-delay="0.32s"
               class="leading-relaxed" style="color:#4e4030; font-size:1rem;">
                {{ app()->getLocale() === 'it'
                    ? 'Fondata nel 2010, la nostra squadra combina rigore tecnico e sensibilità architettonica per rispondere alle sfide più complesse dell\'ingegneria contemporanea.'
                    : 'Founded in 2010, our team combines technical rigour and architectural sensibility to meet the most complex challenges of contemporary engineering.' }}
            </p>
        </div>
    </div>
</section>

{{-- ── DISCIPLINE ───────────────────────────────────────────────── --}}
<section class="py-20 border-t" style="border-color:#d8cdb8;">
    <div class="max-w-7xl mx-auto px-6">
        <div data-animate class="flex flex-col lg:flex-row lg:items-baseline gap-3 lg:gap-6 mb-16">
            <p class="text-xs tracking-[0.3em] uppercase flex-shrink-0" style="color:#c0392b;">
                / {{ app()->getLocale() === 'it' ? 'Cosa facciamo' : 'What we do' }}
            </p>
            <h2 class="font-display font-bold" style="font-size:clamp(1.8rem,4vw,3rem); color:#1a1510;">
                {{ app()->getLocale() === 'it' ? 'Quattro discipline. Un unico studio.' : 'Four disciplines. One studio.' }}
            </h2>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-px" style="background:#d8cdb8;">
            @php $discipline = app()->getLocale() === 'it' ? [
                ['n'=>'01','t'=>'Progettazione strutturale','d'=>'Calcoli e modellazione FEM per edifici nuovi, ampliamenti e opere speciali. Acciaio, c.a., legno X-Lam, muratura.'],
                ['n'=>'02','t'=>'Direzione lavori','d'=>'Coordinamento di cantiere, controllo qualità, contabilità. Un solo riferimento dalla prima riunione al collaudo.'],
                ['n'=>'03','t'=>'Recupero & consolidamento','d'=>'Diagnosi strutturale, miglioramento sismico, restauro di edifici storici e patrimonio vincolato.'],
                ['n'=>'04','t'=>'Sostenibilità & NZEB','d'=>'Edifici a energia quasi-zero, certificazioni CasaClima e LEED, analisi del ciclo di vita.'],
            ] : [
                ['n'=>'01','t'=>'Structural design','d'=>'FEM calculations and modelling for new buildings, extensions and special works. Steel, r.c., X-Lam timber, masonry.'],
                ['n'=>'02','t'=>'Site management','d'=>'Site coordination, quality control, accounting. One point of contact from the first meeting to sign-off.'],
                ['n'=>'03','t'=>'Recovery & consolidation','d'=>'Structural diagnosis, seismic improvement, restoration of historic buildings and protected heritage.'],
                ['n'=>'04','t'=>'Sustainability & NZEB','d'=>'Nearly zero-energy buildings, CasaClima and LEED certifications, lifecycle analysis.'],
            ]; @endphp
            @foreach($discipline as $i => $d)
            <div data-animate data-delay="{{ $i * 0.1 }}s"
                 class="p-10 flex flex-col gap-4" style="background:#f0ead6;">
                <p class="text-sm font-medium" style="color:#c0392b;">{{ $d['n'] }}</p>
                <h3 class="font-display font-bold text-xl" style="color:#1a1510;">{{ $d['t'] }}</h3>
                <p class="leading-relaxed text-sm" style="color:#4e4030;">{{ $d['d'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ── CTA CONTATTI ─────────────────────────────────────────────── --}}
<section class="py-28 px-6" style="background:#14100c;">
    <div class="max-w-4xl mx-auto text-center">
        <p data-animate="fade" class="text-xs tracking-[0.35em] uppercase mb-6" style="color:#c0392b;">
            / Contatti
        </p>
        <h2 data-animate data-delay="0.1s"
            class="font-display mb-6"
            style="font-size:clamp(2.2rem,5vw,4.5rem); font-weight:700; color:#f0ead6; line-height:1.1;">
            {{ app()->getLocale() === 'it' ? 'Hai un progetto?' : 'Have a project?' }}<br>
            <span class="font-italic" style="font-style:italic; font-weight:400; color:#4e4030;">
                {{ app()->getLocale() === 'it' ? 'Parliamo insieme.' : 'Let\'s talk.' }}
            </span>
        </h2>
        <a data-animate data-delay="0.22s"
           href="{{ route('contatti', ['locale' => app()->getLocale()]) }}"
           class="inline-flex items-center gap-3 px-8 py-4 font-medium transition-all duration-200"
           style="background:#c0392b; color:#f0ead6;"
           onmouseover="this.style.background='#f0ead6';this.style.color='#1a1510';"
           onmouseout="this.style.background='#c0392b';this.style.color='#f0ead6';">
            {{ app()->getLocale() === 'it' ? 'Contattaci' : 'Contact us' }}
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
</section>

@endsection
