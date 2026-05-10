@extends('layouts.app')

@section('title', app()->getLocale() === 'it' ? 'Chi Siamo — TCeu' : 'About Us — TCeu')

@section('content')

{{-- Hero --}}
<section class="bg-gray-950 text-white py-24">
    <div class="max-w-7xl mx-auto px-6">
        <p class="text-sm tracking-[0.3em] uppercase text-gray-500 mb-4">
            {{ app()->getLocale() === 'it' ? 'Chi Siamo' : 'About Us' }}
        </p>
        <h1 class="font-display text-4xl md:text-6xl font-light leading-tight max-w-3xl">
            {{ app()->getLocale() === 'it'
                ? 'Progettiamo spazi che durano nel tempo.'
                : 'We design spaces that stand the test of time.' }}
        </h1>
    </div>
</section>

{{-- Contenuto principale --}}
<section class="py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-start">

            <div>
                <h2 class="font-display text-3xl font-semibold text-gray-900 mb-6">
                    {{ app()->getLocale() === 'it' ? 'Il nostro studio' : 'Our studio' }}
                </h2>
                <div class="prose prose-gray max-w-none text-gray-600 leading-relaxed space-y-4">
                    <p>
                        {{ app()->getLocale() === 'it'
                            ? 'Testo descrittivo dello studio da aggiornare tramite il pannello admin. Raccontate la vostra storia, la vostra filosofia e i vostri valori.'
                            : 'Studio description text to be updated via the admin panel. Tell your story, your philosophy and your values.' }}
                    </p>
                    <p>
                        {{ app()->getLocale() === 'it'
                            ? 'Aggiungete qui ulteriori dettagli sulla vostra esperienza, specializzazioni e approccio al progetto.'
                            : 'Add more details here about your experience, specializations and approach to design.' }}
                    </p>
                </div>
            </div>

            <div class="bg-gray-100 rounded-2xl aspect-square flex items-center justify-center">
                <span class="text-gray-400 text-sm">
                    {{ app()->getLocale() === 'it' ? 'Foto studio' : 'Studio photo' }}
                </span>
            </div>

        </div>
    </div>
</section>

{{-- Valori / Numeri --}}
<section class="bg-gray-50 py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            @foreach([
                ['numero' => '20+', 'label_it' => 'Anni di esperienza', 'label_en' => 'Years of experience'],
                ['numero' => '150+', 'label_it' => 'Progetti completati', 'label_en' => 'Completed projects'],
                ['numero' => '50+', 'label_it' => 'Clienti soddisfatti', 'label_en' => 'Satisfied clients'],
                ['numero' => '10+', 'label_it' => 'Premi ricevuti', 'label_en' => 'Awards received'],
            ] as $stat)
            <div>
                <div class="font-display text-4xl font-bold text-gray-900 mb-2">{{ $stat['numero'] }}</div>
                <div class="text-sm text-gray-500">
                    {{ app()->getLocale() === 'it' ? $stat['label_it'] : $stat['label_en'] }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-20">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h2 class="font-display text-3xl font-semibold text-gray-900 mb-4">
            {{ app()->getLocale() === 'it' ? 'Inizia un progetto con noi' : 'Start a project with us' }}
        </h2>
        <p class="text-gray-500 mb-8">
            {{ app()->getLocale() === 'it'
                ? 'Raccontaci la tua visione, trasformiamola insieme in realtà.'
                : 'Tell us your vision, let\'s turn it into reality together.' }}
        </p>
        <a href="{{ route('contatti', ['locale' => app()->getLocale()]) }}"
           class="inline-block bg-gray-900 text-white px-8 py-3 rounded-full text-sm font-medium hover:bg-gray-700 transition">
            {{ app()->getLocale() === 'it' ? 'Contattaci' : 'Get in touch' }}
        </a>
    </div>
</section>

@endsection
