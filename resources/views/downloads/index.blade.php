@php use Illuminate\Support\Facades\Storage; @endphp
@extends('layouts.app')

@section('title', 'Download — TONINOcè')

@section('description', app()->getLocale() === 'it'
    ? 'Scarica gratuitamente elaborati scritti, grafici tipologici, applicativi di calcolo e pubblicazioni dalla biblioteca digitale di TONINOcè.'
    : 'Freely download written documents, technical drawings, calculation tools and publications from the TONINOcè digital library.')

@section('content')

{{-- Hero --}}
<section class="py-20 max-w-7xl mx-auto px-6">
    <div class="flex items-center gap-4 mb-6">
        <div class="w-8 h-px" style="background:#c0392b;"></div>
        <p class="text-xs tracking-[0.3em] uppercase" style="color:#4e4030;">{{ app()->getLocale() === 'it' ? 'Documenti' : 'Documents' }}</p>
    </div>
    <h1 class="font-display" style="font-size:clamp(2.5rem,6vw,5rem); font-weight:900; color:#1a1510; line-height:1.05;">
        Download
    </h1>

    {{-- Introduzione --}}
    <div class="mt-8 max-w-3xl space-y-5" style="color:#4e4030; font-size:0.95rem; line-height:1.8;">
        @if(app()->getLocale() === 'it')
        <p>
            Nella sezione è possibile scaricare i file gratuiti, quali elaborati scritti (word) e grafici (dwg) tipologici specifici per diverse opere, nonché applicativi di calcolo (excel) elaborati e dettagliati nel corso dell'esperienza lavorativa. La raccolta consiste in relazioni tecnico strutturali, geotecniche, tavole di carpenterie e distinte armature, organizzate in format e layout di stampa, pronte per la modifica dell'utente; si rendono altresì disponibili applicativi di calcolo, variamente applicati a diversi casi di studio, atti ad eseguire simulazioni numeriche in tema strutturale e geotecnico.
        </p>
        <p>
            Gli applicativi sono collegati a opere progettate negli elaborati tipo, ma costituiscono un calcolo specifico utile all'utente, indipendente dall'utilizzo delle relazioni ed elaborati grafici; la disposizione del materiale è finalizzata al contribuire seppur in minima parte, alla divulgazione, condivisione e progresso della disciplina. Che possa rappresentare per i Colleghi, un utile strumento per implementare qualità e celerità nella redazione degli elaborati, che a volte sono discordi.
        </p>
        @else
        <p>
            This section offers free downloads including written documents (Word) and typological drawings (DWG) specific to various types of works, as well as calculation tools (Excel) developed and refined over years of professional experience. The collection comprises structural and geotechnical technical reports, steelwork drawings and reinforcement schedules, organised in print-ready formats and layouts; calculation applications are also available, applied to various case studies and suited to running numerical simulations in structural and geotechnical engineering.
        </p>
        <p>
            The tools are linked to works designed in the template documents, but each constitutes a self-contained calculation useful to the user, independently of the reports and drawings. The material is shared with the aim of contributing, however modestly, to the dissemination, exchange and advancement of the discipline — and may serve as a practical instrument for colleagues seeking to improve the quality and efficiency of their documentation.
        </p>
        @endif

    </div>
</section>

{{-- 4 Macro categorie --}}
@php
$locale = app()->getLocale();
$macroCategorie = [
    [
        'id'     => 'relazioni',
        'label'  => $locale === 'it' ? 'Relazioni tecniche' : 'Technical reports',
        'format' => 'Word',
        'tipi'   => ['doc','docx'],
        'icon'   => 'M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm-1 7V3.5L18.5 9H13z',
        'color'  => '#3b82f6',
        'desc'   => $locale === 'it'
            ? 'Gli elaborati sono composti ai sensi delle Norme vigenti (NTC18), per come indicato nel capitolo 10 sulla composizione degli stessi. Il format è impostato su Palatino Linotype, dimensione 11 e interlinea 1,5; i titoli sono suddivisi per livelli di riferimento con indice dotato di collegamento ipertestuale diretto.'
            : 'Documents are drafted in accordance with current Standards (NTC18), as set out in chapter 10. The format uses Palatino Linotype, size 11, 1.5 line spacing; headings are structured across reference levels with a directly hyperlinked table of contents.',
    ],
    [
        'id'     => 'pubblicazioni',
        'label'  => $locale === 'it' ? 'Pubblicazioni' : 'Publications',
        'format' => 'PDF',
        'tipi'   => ['pdf'],
        'icon'   => 'M20 2H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6z',
        'desc'   => $locale === 'it'
            ? 'La sezione raccoglie la biblioteca personale, condivisa nell\'ambito di una sana divulgazione della disciplina. Articoli e libri disponibili su internet sono organizzati per tipologia, costituendo una biblioteca digitale a disposizione degli utenti appassionati del settore.'
            : 'This section gathers a personal library, shared in the spirit of open dissemination of the discipline. Articles and books available online are organised by type, forming a digital library for users with a passion for the field.',
        'color'  => '#ef4444',
    ],
    [
        'id'     => 'software',
        'label'  => $locale === 'it' ? 'Software di calcolo' : 'Calculation tools',
        'format' => 'Excel',
        'tipi'   => ['xls','xlsx'],
        'icon'   => 'M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm-1 7V3.5L18.5 9H13zm-3 8l-1.5-2.5L7 17H5.5l2.25-3.5L5.5 10H7l1.5 2.5L10 10h1.5l-2.25 3.5L11.5 17H10z',
        'color'  => '#22c55e',
        'desc'   => $locale === 'it'
            ? 'Gli applicativi sviluppati eseguono analisi di dimensionamento e verifica di membrature strutturali e geotecniche. Strutturati per semplicità d\'uso, presentano la teoria di base e producono risultati in formato tabellare, pronti per l\'inserimento nelle relazioni mediante cattura schermo.'
            : 'The developed tools perform sizing and verification analyses for structural and geotechnical members. Designed for ease of use, they include background theory and deliver results in tabular format, ready for inclusion in reports via screenshot.',
    ],
    [
        'id'     => 'carpenterie',
        'label'  => $locale === 'it' ? 'Carpenterie & distinte' : 'Drawings & schedules',
        'format' => 'DWG',
        'tipi'   => ['dwg','dxf','dwf'],
        'icon'   => 'M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18',
        'color'  => '#f59e0b',
        'desc'   => $locale === 'it'
            ? 'Le carpenterie, distinte armature e unioni in acciaio sono suddivise per tipologia di opera e tavola, con scale e layout predefiniti pronti per la stampa diretta dalla finestra del modello.'
            : 'Steelwork drawings, reinforcement schedules and steel connections are organised by work type and sheet, with predefined scales and layouts ready for direct printing from the model window.',
    ],
];
@endphp

<section class="max-w-7xl mx-auto px-6 pb-24">

    <div class="space-y-2">
    @foreach($macroCategorie as $macro)
    @php
        // Raccoglie i download di questo tipo da tutte le categorie + senza categoria
        $allDownloads = collect();
        foreach($categorie as $cat) {
            $allDownloads = $allDownloads->merge(
                $cat->downloads->filter(fn($d) => in_array(strtolower($d->file_tipo ?? ''), $macro['tipi']))
            );
        }
        $allDownloads = $allDownloads->merge(
            $senzaCategoria->filter(fn($d) => in_array(strtolower($d->file_tipo ?? ''), $macro['tipi']))
        );
        $totale = $allDownloads->count();
    @endphp

    <div class="border" style="border-color:#d8cdb8;">

        {{-- Intestazione macro categoria --}}
        <button type="button"
                onclick="toggleMacro('{{ $macro['id'] }}')"
                class="w-full flex items-center gap-5 px-6 py-5 text-left transition-colors duration-150 hover:bg-[#ede7d3]">

            {{-- Icona --}}
            <div class="w-8 h-8 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5" fill="{{ str_starts_with($macro['icon'], 'M9 3') ? 'none' : 'currentColor' }}"
                     stroke="{{ str_starts_with($macro['icon'], 'M9 3') ? 'currentColor' : 'none' }}"
                     stroke-width="1.5"
                     viewBox="0 0 24 24"
                     style="color:{{ $macro['color'] }};">
                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $macro['icon'] }}"/>
                </svg>
            </div>

            {{-- Label + formato --}}
            <div class="flex-1">
                <span class="font-display font-bold text-lg" style="color:#1a1510;">
                    {{ $macro['label'] }}
                </span>
                <span class="ml-2 text-xs tracking-widest uppercase" style="color:#8a7a64;">
                    ({{ $macro['format'] }})
                </span>
            </div>

            {{-- Contatore --}}
            <span class="text-xs mr-4" style="color:#8a7a64;">{{ $totale }} file</span>

            {{-- Arrow --}}
            <svg id="macro-arrow-{{ $macro['id'] }}"
                 class="w-4 h-4 transition-transform duration-300 flex-shrink-0"
                 style="color:#8a7a64;"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"/>
            </svg>
        </button>

        {{-- Pannello espandibile --}}
        <div id="macro-{{ $macro['id'] }}" class="progetto-detail border-t" style="border-color:#d8cdb8;">
            <div class="px-6 py-6">

                {{-- Descrizione categoria --}}
                @if(!empty($macro['desc']))
                <p class="text-sm leading-relaxed mb-6 pb-6 border-b max-w-3xl" style="color:#4e4030; border-color:#e8e0cc;">
                    {{ $macro['desc'] }}
                </p>
                @endif

                @if($totale === 0)
                <p class="text-sm py-4 text-center" style="color:#b5a898; font-style:italic;">
                    Nessun documento disponibile in questa categoria.
                </p>
                @else

                {{-- Cartelle (categorie DB) con download di questo tipo --}}
                <div class="space-y-3">
                    @foreach($categorie as $cat)
                    @php
                        $catDownloads = $cat->downloads->filter(fn($d) => in_array(strtolower($d->file_tipo ?? ''), $macro['tipi']));
                    @endphp
                    @if($catDownloads->count())
                    <div class="border" style="border-color:#e8e0cc;">

                        <button type="button"
                                onclick="toggleCartella('{{ $macro['id'] }}-{{ $cat->id }}')"
                                class="w-full flex items-center gap-3 px-4 py-3 text-left hover:bg-[#ede7d3] transition-colors">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24" style="color:#c0392b;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M3 7a2 2 0 012-2h4l2 2h8a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/>
                            </svg>
                            <span class="text-sm font-medium flex-1" style="color:#1a1510;">
                                {{ $cat->getTranslation('nome', app()->getLocale()) }}
                            </span>
                            <span class="text-xs" style="color:#8a7a64;">{{ $catDownloads->count() }}</span>
                            <svg id="cart-arrow-{{ $macro['id'] }}-{{ $cat->id }}"
                                 class="w-3 h-3 transition-transform duration-200 ml-2" style="color:#8a7a64;"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div id="cartella-{{ $macro['id'] }}-{{ $cat->id }}" class="progetto-detail">
                            <div class="border-t" style="border-color:#e8e0cc;">
                                @foreach($catDownloads as $download)
                                    @include('downloads._file-row', ['download' => $download])
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach

                    {{-- Senza categoria --}}
                    @php
                        $senzaCatFiltrati = $senzaCategoria->filter(fn($d) => in_array(strtolower($d->file_tipo ?? ''), $macro['tipi']));
                    @endphp
                    @if($senzaCatFiltrati->count())
                    <div class="border" style="border-color:#e8e0cc;">
                        <button type="button"
                                onclick="toggleCartella('{{ $macro['id'] }}-senza')"
                                class="w-full flex items-center gap-3 px-4 py-3 text-left hover:bg-[#ede7d3] transition-colors">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24" style="color:#c0392b;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M3 7a2 2 0 012-2h4l2 2h8a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/>
                            </svg>
                            <span class="text-sm font-medium flex-1" style="color:#1a1510;">
                                {{ app()->getLocale() === 'it' ? 'Altri documenti' : 'Other documents' }}
                            </span>
                            <span class="text-xs" style="color:#8a7a64;">{{ $senzaCatFiltrati->count() }}</span>
                            <svg id="cart-arrow-{{ $macro['id'] }}-senza"
                                 class="w-3 h-3 transition-transform duration-200 ml-2" style="color:#8a7a64;"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div id="cartella-{{ $macro['id'] }}-senza" class="progetto-detail">
                            <div class="border-t" style="border-color:#e8e0cc;">
                                @foreach($senzaCatFiltrati as $download)
                                    @include('downloads._file-row', ['download' => $download])
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
                @endif
            </div>
        </div>

    </div>
    @endforeach
    </div>

</section>

<script>
function toggleMacro(id) {
    var panel = document.getElementById('macro-' + id);
    var arrow = document.getElementById('macro-arrow-' + id);
    var isOpen = panel.classList.contains('open');
    panel.classList.toggle('open', !isOpen);
    arrow.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
}
function toggleCartella(id) {
    var panel = document.getElementById('cartella-' + id);
    var arrow = document.getElementById('cart-arrow-' + id);
    var isOpen = panel.classList.contains('open');
    panel.classList.toggle('open', !isOpen);
    arrow.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
}
</script>

@endsection
