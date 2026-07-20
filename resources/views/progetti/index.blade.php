@php use Illuminate\Support\Facades\Storage; @endphp
@extends('layouts.app')

@section('title', app()->getLocale() === 'it' ? 'Progetti — TONINOcè' : 'Projects — TONINOcè')

@section('description', app()->getLocale() === 'it'
    ? 'Scopri il portfolio di TONINOcè: progetti di ingegneria strutturale, restauro e consolidamento in tutta Italia.'
    : 'Explore the TONINOcè portfolio: structural engineering, restoration and consolidation projects across Italy.')

@section('content')

{{-- Hero --}}
<section class="py-20 max-w-7xl mx-auto px-6" style="position:relative;">

    {{-- Immagine decorativa a destra del titolo --}}
    <div data-animate="fade" data-delay="0.3s"
         class="hidden lg:block"
         style="position:absolute; top:50%; right:7.5vw; transform:translateY(-50%);
                width:22vw; max-width:380px;
                pointer-events:none; z-index:0;">
        <img src="/images/UNI.png" alt=""
             style="width:100%; display:block; opacity:0.4; transform:scaleX(1.24);">
    </div>

    <div data-animate class="flex items-center gap-4 mb-6" style="position:relative; z-index:1;">
        <div class="w-8 h-px" style="background:#c0392b;"></div>
        <p class="text-xs tracking-[0.3em] uppercase" style="color:#4e4030;">
            {{ app()->getLocale() === 'it' ? 'Portafoglio' : 'Portfolio' }}
        </p>
    </div>
    <h1 data-animate data-delay="0.1s"
        class="font-display" style="font-size:clamp(2.5rem,6vw,5rem); font-weight:900; color:#1a1510; line-height:1.05; position:relative; z-index:1;">
        {{ app()->getLocale() === 'it' ? 'I nostri progetti' : 'Our projects' }}
    </h1>
</section>

{{-- Filtri --}}
<div class="sticky top-14 z-40 border-y py-3" style="background:rgba(240,234,214,0.95); border-color:#d8cdb8; backdrop-filter:blur(6px);">
    <div class="max-w-7xl mx-auto px-6 flex flex-wrap items-center gap-3">
        <a href="{{ route('progetti', ['locale' => app()->getLocale()]) }}"
           class="text-xs tracking-widest uppercase px-3 py-1 border transition-all"
           style="border-color: {{ !request('categoria') ? '#1a1510' : '#d8cdb8' }};
                  background: {{ !request('categoria') ? '#1a1510' : 'transparent' }};
                  color: {{ !request('categoria') ? '#f0ead6' : '#8a7a64' }};">
            {{ app()->getLocale() === 'it' ? 'Tutti' : 'All' }}
        </a>
        @foreach($categorie as $cat)
        <a href="{{ route('progetti', ['locale' => app()->getLocale(), 'categoria' => $cat->id]) }}"
           class="text-xs tracking-widest uppercase px-3 py-1 border transition-all"
           style="border-color: {{ request('categoria') == $cat->id ? '#1a1510' : '#d8cdb8' }};
                  background: {{ request('categoria') == $cat->id ? '#1a1510' : 'transparent' }};
                  color: {{ request('categoria') == $cat->id ? '#f0ead6' : '#8a7a64' }};">
            {{ $cat->getTranslation('nome', app()->getLocale()) }}
        </a>
        @endforeach

        @if($anni->count())
        <div class="ml-auto">
            <form method="GET">
                <input type="hidden" name="categoria" value="{{ request('categoria') }}">
                <select name="anno" onchange="this.form.submit()"
                        class="text-xs tracking-widest uppercase border px-3 py-1 bg-transparent focus:outline-none"
                        style="border-color:#d8cdb8; color:#8a7a64;">
                    <option value="">{{ app()->getLocale() === 'it' ? 'Tutti gli anni' : 'All years' }}</option>
                    @foreach($anni as $anno)
                    <option value="{{ $anno }}" {{ request('anno') == $anno ? 'selected' : '' }}>{{ $anno }}</option>
                    @endforeach
                </select>
            </form>
        </div>
        @endif
    </div>
</div>

{{-- Tabella --}}
<section class="max-w-7xl mx-auto px-6 py-12">

    @if($progetti->isEmpty())
        <p class="text-center py-24" style="color:#4e4030;">
            {{ app()->getLocale() === 'it' ? 'Nessun progetto trovato.' : 'No projects found.' }}
        </p>
    @else

    {{-- Intestazione colonne --}}
    <div class="hidden lg:grid grid-cols-[180px_1fr_140px_120px_40px] gap-4 pb-3 border-b mb-1"
         style="border-color:#1a1510;">
        <span></span>
        <span class="text-[10px] tracking-[0.25em] uppercase font-medium" style="color:#4e4030;">Progetto</span>
        <span class="text-[10px] tracking-[0.25em] uppercase font-medium" style="color:#4e4030;">Luogo</span>
        <span class="text-[10px] tracking-[0.25em] uppercase font-medium" style="color:#4e4030;">Categoria</span>
        <span></span>
    </div>

    @foreach($progetti as $progetto)
    @php
        $locale    = app()->getLocale();
        $titolo    = $progetto->getTranslation('titolo', $locale);
        $luogo     = $progetto->getTranslation('luogo',  $locale);
        $desc      = $progetto->getTranslation('descrizione', $locale);
        $galleria  = $progetto->getGalleriaUrls();
        $copertina = $progetto->getFotoCopertina();
    @endphp

    <div data-animate class="border-b" style="border-color:#d8cdb8;">

        {{-- Riga principale --}}
        {{-- mobile: [nome | arrow]  md: [foto | nome | arrow]  lg: [foto | nome | luogo | cat | arrow] --}}
        <div class="grid gap-4 py-3 cursor-pointer group transition-colors duration-150 items-center hover:bg-[#ede7d3]"
             style="grid-template-columns: 1fr 40px;"
             onclick="toggleProgetto({{ $progetto->id }})"
             data-has-photo="{{ $copertina ? '1' : '0' }}">

            {{-- Foto (solo da md in su) — click → pagina progetto --}}
            @if($copertina)
            <a href="{{ route('progetto.show', ['locale' => $locale, 'slug' => $progetto->slug]) }}"
               onclick="event.stopPropagation()"
               class="foto-col hidden md:block flex-shrink-0 overflow-hidden"
               style="width:180px; height:130px; border:1px solid #d8cdb8;">
                <img src="{{ $copertina }}" alt="{{ $titolo }}"
                     class="w-full h-full object-cover transition-transform duration-300"
                     style="display:block;"
                     onmouseover="this.style.transform='scale(1.04)';"
                     onmouseout="this.style.transform='scale(1)';">
            </a>
            @else
            <div class="foto-col hidden md:block" style="width:180px;"></div>
            @endif

            {{-- Titolo + descrizione — click titolo → pagina progetto --}}
            <div class="min-w-0">
                <a href="{{ route('progetto.show', ['locale' => $locale, 'slug' => $progetto->slug]) }}"
                   onclick="event.stopPropagation()"
                   class="font-display font-bold transition-colors"
                   style="font-size:clamp(1.1rem,2vw,1.5rem); color:#1a1510; line-height:1.1; display:inline;"
                   onmouseover="this.style.color='#c0392b';" onmouseout="this.style.color='#1a1510';">
                    {{ $titolo }}
                </a>
                @if($desc)
                <p class="text-xs mt-0.5 line-clamp-1" style="color:#4e4030;">{{ Str::limit($desc, 80) }}</p>
                @endif
            </div>

            {{-- Luogo (solo lg) --}}
            <span class="luogo-col hidden lg:block text-sm truncate" style="color:#4e4030;">{{ $luogo ?: '—' }}</span>

            {{-- Categoria (solo lg) --}}
            <span class="cat-col hidden lg:block text-[10px] tracking-widest uppercase truncate"
                  style="color:#4e4030;">
                {{ $progetto->categoria?->getTranslation('nome', $locale) ?? '—' }}
            </span>

            {{-- Arrow --}}
            <div class="flex justify-end">
                <svg id="arrow-{{ $progetto->id }}"
                     class="w-4 h-4 transition-transform duration-300"
                     style="color:#4e4030;"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"/>
                </svg>
            </div>
        </div>

        {{-- Pannello espandibile: carosello + scheda tecnica --}}
        <div id="detail-{{ $progetto->id }}" class="progetto-detail">
            <div class="pb-8 pt-2 grid md:grid-cols-[1fr_260px] gap-8">

                {{-- Carosello --}}
                @php
                    $slides = collect();
                    if($copertina) $slides->push($copertina);
                    foreach($galleria as $url) $slides->push($url);
                    $total = $slides->count();
                @endphp

                {{-- Striscia scorrevole foto --}}
                <div>
                @if($total > 0)
                <div class="flex gap-2 overflow-x-auto pb-1"
                     style="scrollbar-width:thin; scrollbar-color:#d8cdb8 transparent;">
                    @foreach($slides as $idx => $url)
                    <img src="{{ $url }}" alt="{{ $titolo }}{{ $idx > 0 ? ' — foto '.($idx+1) : '' }}"
                         onclick="openLightbox(this.src, this.alt)"
                         style="height:200px; width:auto; flex-shrink:0; object-fit:cover;
                                border:1px solid #d8cdb8; display:block; cursor:zoom-in;
                                transition:opacity 0.2s;"
                         onmouseover="this.style.opacity='0.85';"
                         onmouseout="this.style.opacity='1';">
                    @endforeach
                </div>
                @endif
                </div>

                {{-- Scheda tecnica --}}
                <div class="space-y-4 pt-1">
                    @if($progetto->anno)
                    <div>
                        <p class="text-[10px] tracking-[0.2em] uppercase mb-0.5" style="color:#c0392b;">Anno</p>
                        <p class="text-sm" style="color:#1a1510;">{{ $progetto->anno }}</p>
                    </div>
                    @endif
                    @if($luogo)
                    <div>
                        <p class="text-[10px] tracking-[0.2em] uppercase mb-0.5" style="color:#c0392b;">{{ app()->getLocale() === 'it' ? 'Luogo' : 'Location' }}</p>
                        <p class="text-sm" style="color:#1a1510;">{{ $luogo }}</p>
                    </div>
                    @endif
                    @if($progetto->importo_lavori)
                    <div>
                        <p class="text-[10px] tracking-[0.2em] uppercase mb-0.5" style="color:#c0392b;">{{ app()->getLocale() === 'it' ? 'Importo lavori' : 'Works value' }}</p>
                        <p class="text-sm" style="color:#1a1510;">€ {{ number_format($progetto->importo_lavori, 0, ',', '.') }}</p>
                    </div>
                    @endif
                    @if($progetto->categoria)
                    <div>
                        <p class="text-[10px] tracking-[0.2em] uppercase mb-0.5" style="color:#c0392b;">{{ app()->getLocale() === 'it' ? 'Categoria' : 'Category' }}</p>
                        <p class="text-sm" style="color:#1a1510;">{{ $progetto->categoria->getTranslation('nome', $locale) }}</p>
                    </div>
                    @endif
                    @if($desc)
                    <div>
                        <p class="text-[10px] tracking-[0.2em] uppercase mb-0.5" style="color:#c0392b;">{{ app()->getLocale() === 'it' ? 'Descrizione' : 'Description' }}</p>
                        <p class="text-xs leading-relaxed" style="color:#1a1510;">{{ Str::limit($desc, 180) }}</p>
                    </div>
                    @endif
                    @php $allegati = $progetto->getAllegati(); @endphp
                    @if(count($allegati))
                    <div>
                        <p class="text-[10px] tracking-[0.2em] uppercase mb-1.5" style="color:#c0392b;">
                            {{ app()->getLocale() === 'it' ? 'Documentazione' : 'Documentation' }}
                        </p>
                        <div class="space-y-1">
                            @foreach($allegati as $file)
                            <div class="flex items-center gap-2 text-xs">
                                <span class="flex-shrink-0 text-[9px] font-bold px-1 py-0.5 tracking-wider"
                                      style="background:{{ $file['tipo'] === 'pdf' ? '#ef4444' : '#22c55e' }}; color:#fff;">
                                    {{ $file['ext'] }}
                                </span>
                                <span class="truncate flex-1" style="color:#1a1510;">{{ $file['nome'] }}</span>
                                @if($file['tipo'] === 'pdf')
                                <button type="button"
                                        onclick="openPdfModal('{{ $file['url'] }}', '{{ addslashes($file['nome']) }}')"
                                        style="background:none; border:none; padding:0; cursor:pointer; color:#8a7a64; flex-shrink:0;"
                                        title="{{ app()->getLocale() === 'it' ? 'Anteprima' : 'Preview' }}"
                                        onmouseover="this.style.color='#1a1510';" onmouseout="this.style.color='#8a7a64';">
                                    <svg style="width:12px;height:12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                                @endif
                                <a href="{{ $file['url'] }}" download
                                   style="color:#8a7a64; flex-shrink:0;"
                                   title="{{ app()->getLocale() === 'it' ? 'Scarica' : 'Download' }}"
                                   onmouseover="this.style.color='#1a1510';" onmouseout="this.style.color='#8a7a64';">
                                    <svg style="width:12px;height:12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                    </svg>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    <a href="{{ route('progetto.show', ['locale' => $locale, 'slug' => $progetto->slug]) }}"
                       class="inline-flex items-center gap-2 text-xs tracking-widest uppercase border px-4 py-2 transition-all mt-2"
                       style="border-color:#1a1510; color:#1a1510;"
                       onmouseover="this.style.background='#1a1510';this.style.color='#f0ead6';"
                       onmouseout="this.style.background='transparent';this.style.color='#1a1510';">
                        {{ app()->getLocale() === 'it' ? 'Vedi progetto' : 'View project' }}
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

    </div>
    @endforeach

    @if($progetti->hasPages())
    <div class="mt-10">{{ $progetti->appends(request()->query())->links() }}</div>
    @endif

    @endif
</section>

<script>
// Griglia responsive per ogni riga
function applyRowGrids() {
    var w = window.innerWidth;
    document.querySelectorAll('[data-has-photo]').forEach(function(row) {
        if (w >= 1024) {
            // lg: foto | nome | luogo | cat | arrow
            row.style.gridTemplateColumns = '180px 1fr 140px 120px 40px';
        } else if (w >= 768) {
            // md: foto | nome | arrow
            row.style.gridTemplateColumns = '180px 1fr 40px';
        } else {
            // mobile: nome | arrow
            row.style.gridTemplateColumns = '1fr 40px';
        }
        // Mostra/nascondi le celle extra
        row.querySelectorAll('.luogo-col, .cat-col').forEach(function(el) {
            el.style.display = w >= 1024 ? '' : 'none';
        });
        row.querySelectorAll('.foto-col').forEach(function(el) {
            el.style.display = w >= 768 ? '' : 'none';
        });
    });
}
applyRowGrids();
window.addEventListener('resize', applyRowGrids);

function toggleProgetto(id) {
    var panel = document.getElementById('detail-' + id);
    var arrow = document.getElementById('arrow-' + id);
    var isOpen = panel.classList.contains('open');
    document.querySelectorAll('.progetto-detail.open').forEach(function(el) {
        el.classList.remove('open');
    });
    document.querySelectorAll('[id^="arrow-"]').forEach(function(el) {
        el.style.transform = 'rotate(0deg)';
    });
    if (!isOpen) {
        panel.classList.add('open');
        arrow.style.transform = 'rotate(180deg)';
    }
}
</script>

@endsection
