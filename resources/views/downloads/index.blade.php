@php use Illuminate\Support\Facades\Storage; @endphp
@extends('layouts.app')

@section('title', 'Download — TONINOcè')

@section('description', app()->getLocale() === 'it'
    ? 'Scarica capitolati, schede tecniche, pubblicazioni e documentazione ufficiale di TONINOcè Studio di Ingegneria.'
    : 'Download specifications, technical sheets, publications and official documentation from TONINOcè Engineering Studio.')

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
    <p class="mt-4 max-w-lg" style="color:#4e4030;">
        {{ app()->getLocale() === 'it'
            ? 'Scarica capitolati, schede tecniche e documentazione ufficiale.'
            : 'Download specifications, technical sheets and official documentation.' }}
    </p>
</section>

{{-- 4 Macro categorie --}}
@php
$macroCategorie = [
    [
        'id'     => 'relazioni',
        'label'  => 'Relazioni tecniche',
        'format' => 'Word',
        'tipi'   => ['doc','docx'],
        'icon'   => 'M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm-1 7V3.5L18.5 9H13z',
        'color'  => '#3b82f6',
    ],
    [
        'id'     => 'pubblicazioni',
        'label'  => 'Pubblicazioni',
        'format' => 'PDF',
        'tipi'   => ['pdf'],
        'icon'   => 'M20 2H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6z',
        'color'  => '#ef4444',
    ],
    [
        'id'     => 'software',
        'label'  => 'Software di calcolo',
        'format' => 'Excel',
        'tipi'   => ['xls','xlsx'],
        'icon'   => 'M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm-1 7V3.5L18.5 9H13zm-3 8l-1.5-2.5L7 17H5.5l2.25-3.5L5.5 10H7l1.5 2.5L10 10h1.5l-2.25 3.5L11.5 17H10z',
        'color'  => '#22c55e',
    ],
    [
        'id'     => 'carpenterie',
        'label'  => 'Carpenterie & distinte',
        'format' => 'DWG',
        'tipi'   => ['dwg','dxf','dwf'],
        'icon'   => 'M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18',
        'color'  => '#f59e0b',
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
