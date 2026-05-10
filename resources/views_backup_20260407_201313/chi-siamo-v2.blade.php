@extends('layouts.app')

@section('title', app()->getLocale() === 'it' ? 'Chi Siamo — TCeu' : 'About Us — TCeu')

@section('content')

{{-- HERO: full viewport, testo grande a sinistra, elemento grafico a destra --}}
<section class="min-h-screen bg-black text-white flex items-center relative overflow-hidden">

    {{-- Elemento grafico di sfondo --}}
    <div class="absolute right-0 top-0 h-full w-1/2 opacity-10 pointer-events-none">
        <div class="absolute top-1/4 right-0 w-96 h-96 border border-white/30 rotate-45 translate-x-1/3"></div>
        <div class="absolute top-1/3 right-16 w-64 h-64 border border-white/20 rotate-45"></div>
        <div class="absolute bottom-1/4 right-8 w-48 h-48 border border-white/10 rotate-45 -translate-x-8"></div>
    </div>

    {{-- Numero decorativo grande --}}
    <div class="absolute right-8 bottom-8 text-white/5 font-display text-[20rem] font-bold leading-none select-none pointer-events-none hidden lg:block">
        01
    </div>

    <div class="max-w-7xl mx-auto px-6 py-32 relative z-10">
        <div class="max-w-3xl">
            <p class="text-xs tracking-[0.4em] uppercase text-white/40 mb-8">
                {{ app()->getLocale() === 'it' ? '— Chi Siamo' : '— About Us' }}
            </p>
            <h1 class="font-display text-5xl md:text-7xl xl:text-8xl font-light leading-[1.05] mb-10">
                @if(app()->getLocale() === 'it')
                    Ingegneria<br>
                    <span class="italic text-white/50">che lascia</span><br>
                    il segno.
                @else
                    Engineering<br>
                    <span class="italic text-white/50">that leaves</span><br>
                    a mark.
                @endif
            </h1>
            <div class="w-16 h-px bg-white/30 mb-10"></div>
            <p class="text-white/60 text-lg font-light leading-relaxed max-w-xl">
                {{ app()->getLocale() === 'it'
                    ? 'Da oltre vent\'anni progettiamo strutture che coniugano precisione tecnica, sostenibilità e visione. Non costruiamo solo edifici — costruiamo contesti.'
                    : 'For over twenty years we\'ve designed structures that combine technical precision, sustainability and vision. We don\'t just build buildings — we build contexts.' }}
            </p>
        </div>
    </div>

    {{-- Freccia scroll --}}
    <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-white/30">
        <span class="text-xs tracking-widest uppercase">scroll</span>
        <div class="w-px h-12 bg-gradient-to-b from-white/30 to-transparent"></div>
    </div>
</section>

{{-- MANIFESTO: testo grande centrato su sfondo bianco --}}
<section class="py-32 bg-white">
    <div class="max-w-5xl mx-auto px-6">
        <p class="font-display text-3xl md:text-4xl xl:text-5xl font-light text-gray-900 leading-[1.3] text-center">
            @if(app()->getLocale() === 'it')
                "La vera ingegneria non si vede.<br>
                <span class="text-gray-400">Si sente nella solidità di ogni spazio,</span><br>
                nella naturalezza di ogni forma."
            @else
                "True engineering is invisible.<br>
                <span class="text-gray-400">You feel it in the solidity of every space,</span><br>
                in the naturalness of every form."
            @endif
        </p>
    </div>
</section>

{{-- NUMERI: fullwidth, sfondo grigio scuro, 4 numeri grandi --}}
<section class="bg-gray-950 py-24">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-2 lg:grid-cols-4 divide-x divide-white/10">
            @foreach([
                ['n' => '1998', 'label_it' => 'Anno di fondazione', 'label_en' => 'Year founded'],
                ['n' => '200+', 'label_it' => 'Progetti realizzati', 'label_en' => 'Projects built'],
                ['n' => '12', 'label_it' => 'Paesi in cui operiamo', 'label_en' => 'Countries of operation'],
                ['n' => '4', 'label_it' => 'Premi internazionali', 'label_en' => 'International awards'],
            ] as $s)
            <div class="px-8 py-12 text-center">
                <div class="font-display text-5xl md:text-6xl font-light text-white mb-3">{{ $s['n'] }}</div>
                <div class="text-xs uppercase tracking-[0.2em] text-white/40">
                    {{ app()->getLocale() === 'it' ? $s['label_it'] : $s['label_en'] }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- STORIA: layout a due colonne con linea verticale timeline --}}
<section class="py-32 bg-white">
    <div class="max-w-7xl mx-auto px-6">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-24 items-start">

            {{-- Colonna sinistra: titolo sticky --}}
            <div class="lg:sticky lg:top-24">
                <p class="text-xs tracking-[0.3em] uppercase text-gray-400 mb-4">
                    {{ app()->getLocale() === 'it' ? '— La nostra storia' : '— Our story' }}
                </p>
                <h2 class="font-display text-4xl md:text-5xl font-light text-gray-900 leading-tight mb-8">
                    {{ app()->getLocale() === 'it' ? 'Tre decenni di evoluzione continua.' : 'Three decades of continuous evolution.' }}
                </h2>
                {{-- Placeholder immagine studio --}}
                <div class="aspect-[4/3] bg-gray-100 rounded-2xl flex items-center justify-center">
                    <span class="text-gray-400 text-sm">
                        {{ app()->getLocale() === 'it' ? 'Foto dello studio' : 'Studio photo' }}
                    </span>
                </div>
            </div>

            {{-- Colonna destra: timeline --}}
            <div class="relative">
                <div class="absolute left-0 top-0 bottom-0 w-px bg-gray-100"></div>

                @foreach([
                    ['anno' => '1998', 'it' => 'Fondazione dello studio con una visione chiara: ingegneria al servizio dell\'architettura, non contro di essa.', 'en' => 'Studio founded with a clear vision: engineering at the service of architecture, not against it.'],
                    ['anno' => '2005', 'it' => 'Primo grande progetto internazionale. L\'apertura verso nuovi mercati segna una svolta nella nostra identità.', 'en' => 'First major international project. Opening to new markets marks a turning point in our identity.'],
                    ['anno' => '2012', 'it' => 'Integriamo la sostenibilità ambientale come pilastro progettuale, non come opzione aggiuntiva.', 'en' => 'We integrate environmental sustainability as a design pillar, not an add-on.'],
                    ['anno' => '2020', 'it' => 'Adottiamo tecnologie BIM avanzate e un nuovo approccio digitale alla progettazione strutturale.', 'en' => 'We adopt advanced BIM technologies and a new digital approach to structural design.'],
                    ['anno' => 'Oggi', 'it' => 'Un team di professionisti che guarda avanti, con la solidità dell\'esperienza e la curiosità di chi inizia.', 'en' => 'A team of professionals looking ahead, with the solidity of experience and the curiosity of beginners.'],
                ] as $item)
                <div class="relative pl-10 pb-16 last:pb-0">
                    {{-- Dot sulla timeline --}}
                    <div class="absolute left-0 top-1 w-2 h-2 bg-gray-900 rounded-full -translate-x-[3px]"></div>
                    <span class="text-xs font-semibold tracking-widest uppercase text-gray-400 mb-3 block">
                        {{ $item['anno'] }}
                    </span>
                    <p class="text-gray-600 leading-relaxed">
                        {{ app()->getLocale() === 'it' ? $item['it'] : $item['en'] }}
                    </p>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</section>

{{-- APPROCCIO: 3 colonne con icone grandi e testo --}}
<section class="py-32 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-20">
            <p class="text-xs tracking-[0.3em] uppercase text-gray-400 mb-4">
                {{ app()->getLocale() === 'it' ? '— Il nostro metodo' : '— Our method' }}
            </p>
            <h2 class="font-display text-4xl md:text-5xl font-light text-gray-900">
                {{ app()->getLocale() === 'it' ? 'Come lavoriamo.' : 'How we work.' }}
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-1">
            @foreach([
                [
                    'num'   => '01',
                    'it'    => 'Ascolto',
                    'en'    => 'Listen',
                    'desc_it' => 'Ogni progetto inizia da una conversazione profonda. Capiamo la visione, il contesto, i vincoli e le ambizioni prima di tracciare qualsiasi linea.',
                    'desc_en' => 'Every project starts with a deep conversation. We understand the vision, context, constraints and ambitions before drawing any line.',
                ],
                [
                    'num'   => '02',
                    'it'    => 'Progettare',
                    'en'    => 'Design',
                    'desc_it' => 'La tecnica si mette al servizio dell\'idea. Strutture che reggono, ma che non si vedono — perché il migliore ingegnere è quello invisibile.',
                    'desc_en' => 'Technique serves the idea. Structures that hold, but aren\'t seen — because the best engineer is the invisible one.',
                ],
                [
                    'num'   => '03',
                    'it'    => 'Costruire',
                    'en'    => 'Build',
                    'desc_it' => 'Seguiamo ogni cantiere con la stessa attenzione del tavolo da disegno. Il progetto finisce quando l\'ultimo dettaglio è perfetto.',
                    'desc_en' => 'We follow every construction site with the same attention as the drawing table. The project ends when the last detail is perfect.',
                ],
            ] as $step)
            <div class="bg-white p-10 group hover:bg-gray-900 transition-colors duration-500">
                <div class="font-display text-6xl font-light text-gray-100 group-hover:text-white/10 mb-8 transition-colors">
                    {{ $step['num'] }}
                </div>
                <h3 class="font-display text-2xl font-semibold text-gray-900 group-hover:text-white mb-4 transition-colors">
                    {{ app()->getLocale() === 'it' ? $step['it'] : $step['en'] }}
                </h3>
                <p class="text-gray-500 group-hover:text-white/60 leading-relaxed transition-colors text-sm">
                    {{ app()->getLocale() === 'it' ? $step['desc_it'] : $step['desc_en'] }}
                </p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA FINALE: fullscreen scuro con testo centrato --}}
<section class="bg-gray-950 py-40 text-white text-center">
    <div class="max-w-3xl mx-auto px-6">
        <p class="text-xs tracking-[0.4em] uppercase text-white/30 mb-8">
            {{ app()->getLocale() === 'it' ? '— Iniziamo a lavorare insieme' : '— Let\'s work together' }}
        </p>
        <h2 class="font-display text-4xl md:text-6xl font-light leading-tight mb-10">
            {{ app()->getLocale() === 'it'
                ? 'Hai un progetto in mente?'
                : 'Do you have a project in mind?' }}
        </h2>
        <a href="{{ route('contatti', ['locale' => app()->getLocale()]) }}"
           class="inline-flex items-center gap-3 border border-white/30 text-white px-10 py-4 rounded-full text-sm tracking-widest uppercase hover:bg-white hover:text-gray-900 transition-all duration-300">
            {{ app()->getLocale() === 'it' ? 'Parliamone' : 'Let\'s talk' }}
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
</section>

@endsection
