@extends('layouts.app')

@section('title', app()->getLocale() === 'it' ? 'Contatti — TCeu' : 'Contact — TCeu')

@section('content')

{{-- Hero --}}
<section class="bg-gray-950 text-white py-24">
    <div class="max-w-7xl mx-auto px-6">
        <p class="text-sm tracking-[0.3em] uppercase text-gray-500 mb-4">
            {{ app()->getLocale() === 'it' ? 'Parliamo' : 'Let\'s talk' }}
        </p>
        <h1 class="font-display text-4xl md:text-6xl font-light">
            {{ app()->getLocale() === 'it' ? 'Contatti' : 'Contact us' }}
        </h1>
    </div>
</section>

<section class="py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16">

            {{-- Info contatto --}}
            <div>
                <h2 class="font-display text-2xl font-semibold text-gray-900 mb-8">
                    {{ app()->getLocale() === 'it' ? 'Come trovarci' : 'How to find us' }}
                </h2>

                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-wide text-gray-400 mb-1">{{ app()->getLocale() === 'it' ? 'Indirizzo' : 'Address' }}</p>
                            <p class="text-gray-700">Via Roma, 1<br>00100 Roma (RM)</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-wide text-gray-400 mb-1">Email</p>
                            <a href="mailto:info@tceu.it" class="text-gray-700 hover:text-gray-900 transition">info@tceu.it</a>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-wide text-gray-400 mb-1">{{ app()->getLocale() === 'it' ? 'Telefono' : 'Phone' }}</p>
                            <a href="tel:+390000000000" class="text-gray-700 hover:text-gray-900 transition">+39 00 0000 0000</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Form --}}
            <div>
                @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm">
                    {{ session('success') }}
                </div>
                @endif

                <form action="{{ route('contatti.store', ['locale' => app()->getLocale()]) }}" method="POST" class="space-y-5">
                    @csrf

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs uppercase tracking-wide text-gray-500 mb-1.5">
                                {{ app()->getLocale() === 'it' ? 'Nome *' : 'Name *' }}
                            </label>
                            <input type="text" name="nome" value="{{ old('nome') }}" required
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gray-400 transition @error('nome') border-red-300 @enderror">
                            @error('nome')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-xs uppercase tracking-wide text-gray-500 mb-1.5">Email *</label>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gray-400 transition @error('email') border-red-300 @enderror">
                            @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs uppercase tracking-wide text-gray-500 mb-1.5">
                                {{ app()->getLocale() === 'it' ? 'Telefono' : 'Phone' }}
                            </label>
                            <input type="tel" name="telefono" value="{{ old('telefono') }}"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gray-400 transition">
                        </div>
                        <div>
                            <label class="block text-xs uppercase tracking-wide text-gray-500 mb-1.5">
                                {{ app()->getLocale() === 'it' ? 'Oggetto' : 'Subject' }}
                            </label>
                            <input type="text" name="oggetto" value="{{ old('oggetto') }}"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gray-400 transition">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs uppercase tracking-wide text-gray-500 mb-1.5">
                            {{ app()->getLocale() === 'it' ? 'Messaggio *' : 'Message *' }}
                        </label>
                        <textarea name="messaggio" rows="5" required
                                  class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-gray-400 transition resize-none @error('messaggio') border-red-300 @enderror">{{ old('messaggio') }}</textarea>
                        @error('messaggio')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <button type="submit"
                            class="w-full bg-gray-900 text-white py-3 rounded-xl text-sm font-medium hover:bg-gray-700 transition">
                        {{ app()->getLocale() === 'it' ? 'Invia messaggio' : 'Send message' }}
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>

@endsection
