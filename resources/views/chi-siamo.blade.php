@extends('layouts.app')

@section('title', app()->getLocale() === 'it' ? 'Studio — TONINOcè' : 'Studio — TONINOcè')

@section('description', app()->getLocale() === 'it'
    ? 'TONINOcè è uno studio di ingegneria strutturale specializzato in progettazione, costruzione e consolidamento del costruito. Ingegnere dal 2022.'
    : 'TONINOcè is a structural engineering studio specialised in design, construction and consolidation of existing buildings. Engineer since 2022.')

@section('head')
<style>
    /* Comparsa al caricamento della pagina (hero chi-siamo) */
    @keyframes heroReveal {
        from { opacity: 0; transform: translateY(28px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .hero-reveal {
        animation: heroReveal 0.9s cubic-bezier(0.16,1,0.3,1) both;
    }
    @media (prefers-reduced-motion: reduce) {
        .hero-reveal { animation: none; }
    }
</style>
@endsection

@section('content')

{{-- ── HERO ─────────────────────────────────────────────────────── --}}
<section class="min-h-[85vh] flex flex-col justify-center" style="position:relative; overflow:hidden;">

    {{-- Immagine decorativa a destra del titolo --}}
    <div class="hero-reveal hidden lg:block"
         style="position:absolute; top:6%; right:3vw;
                width:32vw; max-width:560px;
                pointer-events:none; z-index:0;
                animation-delay:0.5s;">
        <img src="/images/STADIO.png" alt=""
             style="width:100%; display:block; opacity:0.4; transform:rotate(-7.1deg);">
    </div>

    {{-- Immagine decorativa in basso a destra (accanto ai bottoni) --}}
    <div class="hero-reveal hidden lg:block"
         style="position:absolute; bottom:0; right:12vw;
                width:34vw; max-width:600px;
                pointer-events:none; z-index:0;
                animation-delay:0.65s;">
        <img src="/images/ALBERO.png" alt=""
             style="width:100%; display:block; opacity:0.4;">
    </div>

    <div class="max-w-7xl mx-auto px-6 py-24" style="position:relative; z-index:1;">

        <div class="hero-reveal flex items-center gap-4 mb-10" style="animation-delay:0.05s;">
            <div class="w-8 h-px" style="background:#c0392b;"></div>
            <p class="text-xs tracking-[0.3em] uppercase" style="color:#4e4030;">
                {{ app()->getLocale() === 'it' ? 'Ingegnere dal 2022' : 'Engineer since 2022' }}
            </p>
        </div>

        <h1 class="hero-reveal font-display leading-[1.05] mb-8"
            style="font-size:clamp(3rem,8vw,7.5rem); font-weight:900; color:#1a1510; max-width:15ch; animation-delay:0.15s;">
            {{ app()->getLocale() === 'it' ? 'Costruire con' : 'Building with' }}
            <span class="font-italic" style="font-style:italic; color:#c0392b; font-weight:400;">
                {{ app()->getLocale() === 'it' ? 'precisione,' : 'precision,' }}
            </span><br>
            {{ app()->getLocale() === 'it' ? 'progettare su' : 'designing' }}
            <span class="font-italic" style="font-style:italic; color:#c0392b; font-weight:400;">
                {{ app()->getLocale() === 'it' ? 'misura.' : 'bespoke.' }}
            </span>
        </h1>

        <p class="hero-reveal mb-12 max-w-lg leading-relaxed"
           style="font-size:1.125rem; color:#4e4030; font-weight:300; animation-delay:0.28s;">
            {{ app()->getLocale() === 'it'
                ? 'Antonio Ceglie, in arte Tonino, è ingegnere strutturista specializzato in progettazione, costruzione e consolidamento del costruito. Operiamo dove la tecnica incontra la cura del dettaglio.'
                : 'Antonio Ceglie, known as Tonino, is a structural engineer specialised in design, construction and consolidation of existing buildings. We work where technique meets attention to detail.' }}
        </p>

        <div class="hero-reveal flex flex-wrap justify-center md:justify-start items-center gap-4" style="animation-delay:0.4s;">
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
        @php
        $items = app()->getLocale() === 'it' ? [
            'Diagnostica strutturale',
            'Consolidamento del costruito',
            'Analisi di vulnerabilità statica e sismica',
            'Progettazione di ponti',
            'Progettazione di edifici',
            'Progettazione di opere industriali',
            'Progettazione di opere geotecniche e fondazioni',
        ] : [
            'Structural diagnostics',
            'Consolidation of existing structures',
            'Static and seismic vulnerability analysis',
            'Bridge design',
            'Building design',
            'Industrial works design',
            'Geotechnical works and foundation design',
        ];
        // Duplica per loop continuo
        $items = array_merge($items, $items);
        @endphp
        @foreach($items as $item)
        <span style="display:inline-flex; align-items:center;
                     font-family:'Cormorant Garamond',serif; font-style:italic;
                     font-size:1.25rem; font-weight:400; color:#1a1510; letter-spacing:0.02em;">
            <span style="color:#c0392b; font-style:normal; font-size:0.5rem;
                         flex-shrink:0; margin:0 2rem;">&#9670;</span>
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
                    ? 'Ogni progetto è un abito su misura: ascoltiamo il contesto, interpretiamo i vincoli e progettiamo soluzioni che durano. La nostra esperienza si radica con operosità nell\'ambito delle opere pubbliche di ponti, edifici, opere geotecniche e supporti ai collaudi in fase costruttiva, nonché profonda esperienza ai fini delle valutazioni di vulnerabilità statiche e sismiche di edifici esistenti e storici.'
                    : 'Every project is bespoke: we listen to the context, interpret the constraints and design solutions that last. Our expertise is deeply rooted in public works — bridges, buildings, geotechnical works and construction-phase testing support — alongside extensive experience in static and seismic vulnerability assessments of existing and historic buildings.' }}
            </p>
            <p data-animate data-delay="0.32s"
               class="leading-relaxed" style="color:#4e4030; font-size:1rem;">
                {{ app()->getLocale() === 'it'
                    ? 'In attività dal 2022, la nostra metodologia combina rigore tecnico e sensibilità architettonica per rispondere alle sfide più complesse dell\'architettura contemporanea.'
                    : 'Active since 2022, our methodology combines technical rigour and architectural sensibility to meet the most complex challenges of contemporary architecture.' }}
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
                {{ app()->getLocale() === 'it' ? 'Quattro discipline, un unico abito.' : 'Four disciplines, one bespoke fit.' }}
            </h2>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-px" style="background:#d8cdb8;">
            @php $discipline = app()->getLocale() === 'it' ? [
                [
                    'n' => '01',
                    't' => 'Progettazione strutturale',
                    'd' => 'Analisi strutturale, modellazione f.e.m. e progetto delle membrature di edifici e ponti in acciaio, muratura e calcestruzzo armato semplice e precompresso.',
                ],
                [
                    'n' => '02',
                    't' => 'Progettazione geotecnica',
                    'd' => 'Analisi geotecniche, progetto e verifica di opere di contenimento, quali muri e paratie, nonché sotterranee quali tombini ferroviari e stradali, gallerie e fondazioni di edifici e ponti.',
                ],
                [
                    'n' => '03',
                    't' => 'Recupero e consolidamento dell\'esistente',
                    'd' => 'Analisi storico critiche, diagnosi strutturale e progetto di miglioramento e adeguamento statico e sismico di edifici e ponti esistenti e storici.',
                ],
                [
                    'n' => '04',
                    't' => 'Supporto al collaudo e alla costruzione',
                    'd' => 'Supporto al Collaudatore nella definizione delle relazioni metodologiche, elaborazione dei risultati e direzione esecutiva del collaudo; supporto all\'Impresa mediante redazione di varianti strutturali, ottimizzazione delle membrature e aggiornamento di carpenterie e distinte armature.',
                ],
            ] : [
                [
                    'n' => '01',
                    't' => 'Structural design',
                    'd' => 'Structural analysis, f.e.m. modelling and member design for buildings and bridges in steel, masonry and reinforced or prestressed concrete.',
                ],
                [
                    'n' => '02',
                    't' => 'Geotechnical design',
                    'd' => 'Geotechnical analysis, design and verification of retaining structures such as walls and sheet piles, as well as underground works including railway and road culverts, tunnels, and building and bridge foundations.',
                ],
                [
                    'n' => '03',
                    't' => 'Restoration & consolidation',
                    'd' => 'Historical and critical analysis, structural diagnosis, and design of static and seismic improvement and upgrading of existing and historic buildings and bridges.',
                ],
                [
                    'n' => '04',
                    't' => 'Testing & construction support',
                    'd' => 'Support to the Testing Inspector in defining methodological reports, processing results and overseeing structural testing; support to the Contractor through the preparation of structural variants, member optimisation and updated steelwork drawings and reinforcement schedules.',
                ],
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
