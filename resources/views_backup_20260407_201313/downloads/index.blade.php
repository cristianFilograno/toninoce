@php use Illuminate\Support\Facades\Storage; @endphp
@extends('layouts.app')

@section('title', 'Download — TCeu')

@section('content')

{{-- Hero --}}
<section class="bg-gray-950 text-white py-24">
    <div class="max-w-7xl mx-auto px-6">
        <p class="text-sm tracking-[0.3em] uppercase text-gray-500 mb-4">
            {{ app()->getLocale() === 'it' ? 'Documenti' : 'Documents' }}
        </p>
        <h1 class="font-display text-4xl md:text-6xl font-light">Download</h1>
        <p class="text-gray-400 mt-4 max-w-xl">
            {{ app()->getLocale() === 'it'
                ? 'Scarica capitolati, schede tecniche e documentazione ufficiale.'
                : 'Download specifications, technical sheets and official documentation.' }}
        </p>
    </div>
</section>

{{-- Categorie e file --}}
<section class="py-16">
    <div class="max-w-7xl mx-auto px-6">

        @if($categorie->isEmpty() && $senzaCategoria->isEmpty())
        <div class="text-center py-24 text-gray-400">
            <p>{{ app()->getLocale() === 'it' ? 'Nessun documento disponibile.' : 'No documents available.' }}</p>
        </div>
        @else

        <div class="space-y-12">
            @foreach($categorie as $categoria)

            @if($categoria->downloads->count())
            <div>
                {{-- Titolo categoria --}}
                <div class="flex items-center gap-4 mb-6">
                    <h2 class="font-display text-2xl font-semibold text-gray-900">
                        {{ $categoria->getTranslation('nome', app()->getLocale()) }}
                    </h2>
                    <div class="flex-1 h-px bg-gray-100"></div>
                    <span class="text-sm text-gray-400">{{ $categoria->downloads->count() }} file</span>
                </div>

                {{-- Lista file --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($categoria->downloads as $download)
                        @include('downloads._file-row', ['download' => $download])
                    @endforeach
                </div>
            </div>
            @endif

            @endforeach

            {{-- Download senza categoria --}}
            @if($senzaCategoria->count())
            <div>
                <div class="flex items-center gap-4 mb-6">
                    <h2 class="font-display text-2xl font-semibold text-gray-900">
                        {{ app()->getLocale() === 'it' ? 'Altri documenti' : 'Other documents' }}
                    </h2>
                    <div class="flex-1 h-px bg-gray-100"></div>
                    <span class="text-sm text-gray-400">{{ $senzaCategoria->count() }} file</span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($senzaCategoria as $download)
                    @include('downloads._file-row', ['download' => $download])
                    @endforeach
                </div>
            </div>
            @endif

        </div>

        @endif
    </div>
</section>

@endsection
