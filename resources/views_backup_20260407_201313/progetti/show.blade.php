@php use Illuminate\Support\Facades\Storage; @endphp
@extends('layouts.app')

@section('title', $progetto->getTranslation('titolo', app()->getLocale()) . ' — TCeu')

@section('content')

{{-- Breadcrumb --}}
<section class="bg-gray-50 py-4 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-6">
        <nav class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ route('progetti', ['locale' => app()->getLocale()]) }}" class="hover:text-gray-900 transition">
                {{ app()->getLocale() === 'it' ? 'Progetti' : 'Projects' }}
            </a>
            <span>/</span>
            <span class="text-gray-900">{{ $progetto->getTranslation('titolo', app()->getLocale()) }}</span>
        </nav>
    </div>
</section>

{{-- Hero foto --}}
@if($progetto->foto_copertina)
<section class="bg-gray-900">
    <div class="max-w-7xl mx-auto">
        <img src="{{ Storage::disk('public')->url($progetto->foto_copertina) }}"
             alt="{{ $progetto->getTranslation('titolo', app()->getLocale()) }}"
             class="w-full max-h-[60vh] object-cover">
    </div>
</section>
@endif

{{-- Dettaglio progetto --}}
<section class="py-16">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">

            {{-- Contenuto principale --}}
            <div class="md:col-span-2">
                <h1 class="font-display text-4xl font-semibold text-gray-900 mb-6">
                    {{ $progetto->getTranslation('titolo', app()->getLocale()) }}
                </h1>
                <div class="text-gray-600 leading-relaxed text-lg">
                    {!! nl2br(e($progetto->getTranslation('descrizione', app()->getLocale()))) !!}
                </div>
            </div>

            {{-- Scheda tecnica --}}
            <div class="bg-gray-50 rounded-2xl p-6 h-fit">
                <h3 class="font-semibold text-gray-900 mb-4 text-sm uppercase tracking-wide">
                    {{ app()->getLocale() === 'it' ? 'Scheda tecnica' : 'Project details' }}
                </h3>
                <dl class="space-y-3">
                    @if($progetto->anno)
                    <div>
                        <dt class="text-xs text-gray-400 uppercase tracking-wide">{{ app()->getLocale() === 'it' ? 'Anno' : 'Year' }}</dt>
                        <dd class="text-sm font-medium text-gray-900 mt-0.5">{{ $progetto->anno }}</dd>
                    </div>
                    @endif

                    @if($progetto->getTranslation('luogo', app()->getLocale()))
                    <div>
                        <dt class="text-xs text-gray-400 uppercase tracking-wide">{{ app()->getLocale() === 'it' ? 'Luogo' : 'Location' }}</dt>
                        <dd class="text-sm font-medium text-gray-900 mt-0.5">
                            {{ $progetto->getTranslation('luogo', app()->getLocale()) }}
                        </dd>
                    </div>
                    @endif

                    @if($progetto->categoria)
                    <div>
                        <dt class="text-xs text-gray-400 uppercase tracking-wide">{{ app()->getLocale() === 'it' ? 'Categoria' : 'Category' }}</dt>
                        <dd class="text-sm font-medium text-gray-900 mt-0.5">
                            {{ $progetto->categoria->getTranslation('nome', app()->getLocale()) }}
                        </dd>
                    </div>
                    @endif
                </dl>
            </div>

        </div>

        {{-- Galleria immagini --}}
        @if($progetto->galleria && count($progetto->galleria))
        <div class="mt-16">
            <h2 class="font-display text-2xl font-semibold text-gray-900 mb-8">
                {{ app()->getLocale() === 'it' ? 'Galleria' : 'Gallery' }}
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($progetto->galleria as $fotoPath)
                <div class="overflow-hidden rounded-xl bg-gray-100 aspect-[4/3]">
                    <img src="{{ Storage::disk('public')->url($fotoPath) }}"
                         alt="{{ $progetto->getTranslation('titolo', app()->getLocale()) }}"
                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-300 cursor-pointer">
                </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</section>

{{-- Navigazione --}}
<section class="border-t border-gray-100 py-8">
    <div class="max-w-7xl mx-auto px-6">
        <a href="{{ route('progetti', ['locale' => app()->getLocale()]) }}"
           class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-gray-900 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            {{ app()->getLocale() === 'it' ? 'Torna ai progetti' : 'Back to projects' }}
        </a>
    </div>
</section>

@endsection
