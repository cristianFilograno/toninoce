@php use Illuminate\Support\Facades\Storage; @endphp
@extends('layouts.app')

@section('title', app()->getLocale() === 'it' ? 'Progetti — TCeu' : 'Projects — TCeu')

@section('content')

{{-- Hero --}}
<section class="bg-gray-950 text-white py-24">
    <div class="max-w-7xl mx-auto px-6">
        <p class="text-sm tracking-[0.3em] uppercase text-gray-500 mb-4">
            {{ app()->getLocale() === 'it' ? 'Portafoglio' : 'Portfolio' }}
        </p>
        <h1 class="font-display text-4xl md:text-6xl font-light">
            {{ app()->getLocale() === 'it' ? 'I nostri progetti' : 'Our projects' }}
        </h1>
    </div>
</section>

{{-- Filtri --}}
<section class="sticky top-16 z-40 bg-white border-b border-gray-100 py-4">
    <div class="max-w-7xl mx-auto px-6">
        <form method="GET" action="{{ route('progetti', ['locale' => app()->getLocale()]) }}"
              class="flex flex-wrap items-center gap-3">

            {{-- Filtro categoria --}}
            <div class="flex items-center gap-2 flex-wrap">
                <a href="{{ route('progetti', ['locale' => app()->getLocale()]) }}"
                   class="px-4 py-1.5 rounded-full text-xs font-medium transition
                   {{ !request('categoria') ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    {{ app()->getLocale() === 'it' ? 'Tutti' : 'All' }}
                </a>
                @foreach($categorie as $cat)
                <a href="{{ route('progetti', ['locale' => app()->getLocale(), 'categoria' => $cat->id, 'anno' => request('anno')]) }}"
                   class="px-4 py-1.5 rounded-full text-xs font-medium transition
                   {{ request('categoria') == $cat->id ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    {{ $cat->getTranslation('nome', app()->getLocale()) }}
                </a>
                @endforeach
            </div>

            {{-- Filtro anno --}}
            @if($anni->count())
            <div class="ml-auto">
                <select name="anno" onchange="this.form.submit()"
                        class="text-xs border border-gray-200 rounded-full px-4 py-1.5 bg-white text-gray-600 focus:outline-none">
                    <option value="">{{ app()->getLocale() === 'it' ? 'Tutti gli anni' : 'All years' }}</option>
                    @foreach($anni as $anno)
                    <option value="{{ $anno }}" {{ request('anno') == $anno ? 'selected' : '' }}>{{ $anno }}</option>
                    @endforeach
                </select>
            </div>
            @endif

        </form>
    </div>
</section>

{{-- Griglia progetti --}}
<section class="py-16">
    <div class="max-w-7xl mx-auto px-6">

        @if($progetti->isEmpty())
        <div class="text-center py-24 text-gray-400">
            <p class="text-lg">{{ app()->getLocale() === 'it' ? 'Nessun progetto trovato.' : 'No projects found.' }}</p>
        </div>
        @else

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
            @foreach($progetti as $progetto)
            <a href="{{ route('progetto.show', ['locale' => app()->getLocale(), 'slug' => $progetto->slug]) }}"
               class="group block overflow-hidden rounded-xl bg-gray-100">

                {{-- Foto copertina --}}
                <div class="aspect-[4/3] overflow-hidden bg-gray-200">
                    @if($progetto->foto_copertina)
                    <img src="{{ Storage::disk('public')->url($progetto->foto_copertina) }}"
                         alt="{{ $progetto->getTranslation('titolo', app()->getLocale()) }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                    <div class="w-full h-full flex items-center justify-center bg-gray-200">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    @endif
                </div>

                {{-- Info --}}
                <div class="p-3">
                    <h3 class="text-xs font-semibold text-gray-900 truncate group-hover:text-gray-600 transition">
                        {{ $progetto->getTranslation('titolo', app()->getLocale()) }}
                    </h3>
                    <div class="flex items-center gap-2 mt-1">
                        @if($progetto->anno)
                        <span class="text-xs text-gray-400">{{ $progetto->anno }}</span>
                        @endif
                        @if($progetto->categoria)
                        <span class="text-xs text-gray-400">· {{ $progetto->categoria->getTranslation('nome', app()->getLocale()) }}</span>
                        @endif
                    </div>
                </div>

            </a>
            @endforeach
        </div>

        {{-- Paginazione --}}
        @if($progetti->hasPages())
        <div class="mt-12">
            {{ $progetti->appends(request()->query())->links() }}
        </div>
        @endif

        @endif
    </div>
</section>

@endsection
