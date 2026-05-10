@php
    $tipo = strtolower($download->file_tipo ?? '');
    $isPdf = $tipo === 'pdf';
    $isWord = in_array($tipo, ['doc', 'docx']);
    $isExcel = in_array($tipo, ['xls', 'xlsx']);
    $descrizione = $download->getTranslation('descrizione', app()->getLocale());
    $fileUrl = Storage::disk('public')->url($download->file_path);
@endphp

<div class="group relative bg-white border border-gray-100 rounded-2xl overflow-hidden hover:shadow-lg hover:border-gray-200 transition-all duration-300">

    {{-- Header colorato con icona --}}
    <div class="p-6 pb-4 flex items-start gap-4">

        {{-- Icona tipo file --}}
        <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0
            {{ $isPdf ? 'bg-red-50 text-red-500' : ($isWord ? 'bg-blue-50 text-blue-500' : ($isExcel ? 'bg-green-50 text-green-500' : 'bg-gray-100 text-gray-500')) }}">
            @if($isPdf)
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M20 2H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-8.5 7.5c0 .83-.67 1.5-1.5 1.5H9v2H7.5V7H10c.83 0 1.5.67 1.5 1.5v1zm5 2c0 .83-.67 1.5-1.5 1.5h-2.5V7H15c.83 0 1.5.67 1.5 1.5v3zm4-3H19v1h1.5V11H19v2h-1.5V7h3v1.5zM9 9.5h1v-1H9v1zM4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6zm10 5.5h1v-3h-1v3z"/>
            </svg>
            @elseif($isWord)
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm-1 7V3.5L18.5 9H13zm-3 8l-2-7h1.5l1.25 4.5L11 10h1.5l1.25 4.5L15 10h1.5l-2 7H13l-1.25-4.25L10.5 17H9z"/>
            </svg>
            @elseif($isExcel)
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm-1 7V3.5L18.5 9H13zm-3 8l-1.5-2.5L7 17H5.5l2.25-3.5L5.5 10H7l1.5 2.5L10 10h1.5l-2.25 3.5L11.5 17H10z"/>
            </svg>
            @else
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
            </svg>
            @endif
        </div>

        {{-- Info --}}
        <div class="flex-1 min-w-0">
            <p class="font-semibold text-gray-900 leading-tight line-clamp-2">
                {{ $download->getTranslation('titolo', app()->getLocale()) }}
            </p>
            <div class="flex items-center gap-2 mt-1.5">
                <span class="text-xs uppercase font-bold tracking-wide
                    {{ $isPdf ? 'text-red-400' : ($isWord ? 'text-blue-400' : ($isExcel ? 'text-green-400' : 'text-gray-400')) }}">
                    {{ $tipo }}
                </span>
                @if($download->getDimensioneLeggibile())
                <span class="text-xs text-gray-300">·</span>
                <span class="text-xs text-gray-400">{{ $download->getDimensioneLeggibile() }}</span>
                @endif
            </div>
        </div>
    </div>

    {{-- Descrizione (appare sull'hover) --}}
    @if($descrizione)
    <div class="px-6 pb-4 max-h-0 overflow-hidden group-hover:max-h-24 transition-all duration-300">
        <p class="text-sm text-gray-500 leading-relaxed line-clamp-3">{{ $descrizione }}</p>
    </div>
    @endif

    {{-- Footer con azioni --}}
    <div class="px-6 pb-5 flex items-center gap-2 mt-auto">

        {{-- Download --}}
        <a href="{{ route('download.scarica', ['locale' => app()->getLocale(), 'download' => $download->id]) }}"
           class="flex-1 flex items-center justify-center gap-2 bg-gray-900 text-white text-xs font-medium py-2.5 px-4 rounded-xl hover:bg-gray-700 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
            </svg>
            {{ app()->getLocale() === 'it' ? 'Scarica' : 'Download' }}
        </a>

        {{-- Preview (solo PDF) --}}
        @if($isPdf)
        <a href="{{ $fileUrl }}" target="_blank"
           class="flex items-center justify-center gap-1.5 border border-gray-200 text-gray-600 text-xs font-medium py-2.5 px-4 rounded-xl hover:bg-gray-50 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            </svg>
            Preview
        </a>
        @endif

    </div>
</div>
