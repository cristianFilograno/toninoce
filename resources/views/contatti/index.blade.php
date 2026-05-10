@extends('layouts.app')

@section('title', app()->getLocale() === 'it' ? 'Contatti — TONINOcè' : 'Contact — TONINOcè')

@section('description', app()->getLocale() === 'it'
    ? 'Contatta TONINOcè Studio di Ingegneria Strutturale per consulenze, progettazione e direzione lavori. Scrivici o chiamaci.'
    : 'Contact TONINOcè Structural Engineering Studio for consultations, design and site management. Write or call us.')

@section('content')

{{-- Hero --}}
<section class="py-20 max-w-7xl mx-auto px-6">
    <div data-animate class="flex items-center gap-4 mb-6">
        <div class="w-8 h-px" style="background:#c0392b;"></div>
        <p class="text-xs tracking-[0.3em] uppercase" style="color:#4e4030;">
            {{ app()->getLocale() === 'it' ? 'Parliamo' : 'Let\'s talk' }}
        </p>
    </div>
    <h1 data-animate data-delay="0.1s"
        class="font-display" style="font-size:clamp(2.5rem,6vw,5rem); font-weight:900; color:#1a1510; line-height:1.05;">
        {{ app()->getLocale() === 'it' ? 'Contatti' : 'Contact us' }}
    </h1>
</section>

<section class="pb-28 max-w-7xl mx-auto px-6">
    <div class="grid md:grid-cols-2 gap-20">

        {{-- Info --}}
        <div data-animate="left">
            <p class="text-xs tracking-[0.3em] uppercase mb-8" style="color:#c0392b;">/ {{ app()->getLocale() === 'it' ? 'Come trovarci' : 'How to find us' }}</p>

            <div class="space-y-8">
                <div class="border-b pb-6" style="border-color:#d8cdb8;">
                    <p class="text-[10px] tracking-[0.25em] uppercase mb-2" style="color:#4e4030;">
                        {{ app()->getLocale() === 'it' ? 'Indirizzo' : 'Address' }}
                    </p>
                    <p class="font-display text-lg" style="color:#1a1510;">Via Roma, 1<br>00100 Roma (RM)</p>
                </div>
                <div class="border-b pb-6" style="border-color:#d8cdb8;">
                    <p class="text-[10px] tracking-[0.25em] uppercase mb-2" style="color:#4e4030;">Email</p>
                    <a href="mailto:info@toninoe.it"
                       class="font-display text-lg transition-colors"
                       style="color:#1a1510;"
                       onmouseover="this.style.color='#c0392b';" onmouseout="this.style.color='#1a1510';">
                        info@toninoe.it
                    </a>
                </div>
                <div>
                    <p class="text-[10px] tracking-[0.25em] uppercase mb-2" style="color:#4e4030;">
                        {{ app()->getLocale() === 'it' ? 'Telefono' : 'Phone' }}
                    </p>
                    <a href="tel:+390000000000"
                       class="font-display text-lg transition-colors"
                       style="color:#1a1510;"
                       onmouseover="this.style.color='#c0392b';" onmouseout="this.style.color='#1a1510';">
                        +39 00 0000 0000
                    </a>
                </div>
            </div>
        </div>

        {{-- Form --}}
        <div data-animate data-delay="0.15s">
            <p class="text-xs tracking-[0.3em] uppercase mb-8" style="color:#c0392b;">/ {{ app()->getLocale() === 'it' ? 'Scrivici' : 'Write to us' }}</p>

            @if(session('success'))
            <div class="mb-6 px-5 py-4 border text-sm" style="border-color:#c0392b; color:#1a1510; background:rgba(192,57,43,0.06);">
                {{ session('success') }}
            </div>
            @endif

            <form action="{{ route('contatti.store', ['locale' => app()->getLocale()]) }}" method="POST" class="space-y-5">
                @csrf

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] tracking-[0.25em] uppercase mb-2" style="color:#4e4030;">
                            {{ app()->getLocale() === 'it' ? 'Nome *' : 'Name *' }}
                        </label>
                        <input type="text" name="nome" value="{{ old('nome') }}" required
                               placeholder="{{ app()->getLocale() === 'it' ? 'Il tuo nome' : 'Your name' }}"
                               class="form-field {{ $errors->has('nome') ? 'error' : '' }}">
                        @error('nome')<p class="text-xs mt-1" style="color:#c0392b;">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-[10px] tracking-[0.25em] uppercase mb-2" style="color:#4e4030;">
                            Email *
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               placeholder="email@esempio.it"
                               class="form-field {{ $errors->has('email') ? 'error' : '' }}">
                        @error('email')<p class="text-xs mt-1" style="color:#c0392b;">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] tracking-[0.25em] uppercase mb-2" style="color:#4e4030;">
                            {{ app()->getLocale() === 'it' ? 'Telefono' : 'Phone' }}
                        </label>
                        <input type="tel" name="telefono" value="{{ old('telefono') }}"
                               placeholder="+39 000 000 0000"
                               class="form-field">
                    </div>
                    <div>
                        <label class="block text-[10px] tracking-[0.25em] uppercase mb-2" style="color:#4e4030;">
                            {{ app()->getLocale() === 'it' ? 'Oggetto' : 'Subject' }}
                        </label>
                        <input type="text" name="oggetto" value="{{ old('oggetto') }}"
                               placeholder="{{ app()->getLocale() === 'it' ? 'Oggetto del messaggio' : 'Message subject' }}"
                               class="form-field">
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] tracking-[0.25em] uppercase mb-2" style="color:#4e4030;">
                        {{ app()->getLocale() === 'it' ? 'Messaggio *' : 'Message *' }}
                    </label>
                    <textarea name="messaggio" rows="6" required
                              placeholder="{{ app()->getLocale() === 'it' ? 'Descrivi il tuo progetto o la tua richiesta…' : 'Describe your project or request…' }}"
                              class="form-field resize-none {{ $errors->has('messaggio') ? 'error' : '' }}">{{ old('messaggio') }}</textarea>
                    @error('messaggio')<p class="text-xs mt-1" style="color:#c0392b;">{{ $message }}</p>@enderror
                </div>

                <button type="submit"
                        class="inline-flex items-center gap-3 px-8 py-3.5 text-sm font-medium transition-all duration-200"
                        style="background:#1a1510; color:#f0ead6;"
                        onmouseover="this.style.background='#c0392b';"
                        onmouseout="this.style.background='#1a1510';">
                    {{ app()->getLocale() === 'it' ? 'Invia messaggio' : 'Send message' }}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </button>
            </form>
        </div>

    </div>
</section>

@endsection
