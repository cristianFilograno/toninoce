@php
    $tipo        = strtolower($download->file_tipo ?? '');
    $isPdf       = $tipo === 'pdf';
    $isWord      = in_array($tipo, ['doc','docx']);
    $isExcel     = in_array($tipo, ['xls','xlsx']);
    $titolo      = $download->getTranslation('titolo', app()->getLocale());
    $descrizione = $download->getTranslation('descrizione', app()->getLocale());
    $fileUrl     = Storage::disk('public')->url($download->file_path);
    $badgeColor  = $isPdf ? '#ef4444' : ($isWord ? '#3b82f6' : ($isExcel ? '#22c55e' : '#8a7a64'));
@endphp

<div class="group flex items-center gap-5 px-4 pt-3 pb-1 border-b transition-colors duration-150 hover:bg-[#ede7d3]"
     style="border-color:#e8e0cc;">

    {{-- Tipo --}}
    <span class="w-10 text-[9px] font-bold tracking-widest uppercase flex-shrink-0 text-right"
          style="color:{{ $badgeColor }};">
        {{ $tipo ?: '—' }}
    </span>

    {{-- Titolo + descrizione --}}
    <div class="flex-1 min-w-0 flex gap-4 items-baseline">
        <span class="text-sm flex-shrink-0" style="color:#1a1510; width:25%;">{{ $titolo }}</span>
        @if($descrizione)
        <span class="text-sm truncate flex-1" style="color:#4e4030;">{{ $descrizione }}</span>
        @endif
    </div>

    {{-- Dimensione --}}
    <span class="text-xs hidden sm:block w-14 text-right flex-shrink-0" style="color:#b5a898;">
        {{ $download->getDimensioneLeggibile() ?? '' }}
    </span>

    {{-- Azioni --}}
    <div class="flex items-center gap-3 flex-shrink-0">
        @if($isPdf)
        <a href="{{ $fileUrl }}" target="_blank" title="Preview"
           class="transition-colors" style="color:#d8cdb8;"
           onmouseover="this.style.color='#8a7a64';" onmouseout="this.style.color='#d8cdb8';">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            </svg>
        </a>
        @endif
        <a href="{{ route('download.scarica', ['locale' => app()->getLocale(), 'download' => $download->id]) }}"
           title="{{ app()->getLocale() === 'it' ? 'Scarica' : 'Download' }}"
           class="transition-colors" style="color:#8a7a64;"
           onmouseover="this.style.color='#1a1510';" onmouseout="this.style.color='#8a7a64';">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
            </svg>
        </a>
    </div>
</div>
