@extends('layouts.app')

@section('title', 'Privacy Policy')

@section('description', app()->getLocale() === 'it'
    ? 'Informativa sul trattamento dei dati personali del sito ingantonioceglie.it ai sensi del GDPR.'
    : 'Privacy policy for the ingantonioceglie.it website pursuant to the GDPR.')

@section('head')
<meta name="robots" content="noindex, follow">
@endsection

@section('content')

@php $it = app()->getLocale() === 'it'; @endphp

<section class="max-w-3xl mx-auto px-6 py-20">

    <div class="flex items-center gap-4 mb-6">
        <div class="w-8 h-px" style="background:#c0392b;"></div>
        <p class="text-xs tracking-[0.3em] uppercase" style="color:#4e4030;">
            {{ $it ? 'Informativa' : 'Legal' }}
        </p>
    </div>

    <h1 class="font-display mb-10" style="font-size:clamp(2rem,5vw,3.5rem); font-weight:900; color:#1a1510; line-height:1.1;">
        Privacy Policy
    </h1>

    <div class="space-y-8 leading-relaxed" style="color:#4e4030; font-size:1rem;">

        <p style="color:#1a1510;">
            {{ $it
                ? 'La presente informativa descrive le modalità di trattamento dei dati personali degli utenti che consultano il sito ingantonioceglie.it, ai sensi del Regolamento (UE) 2016/679 (GDPR).'
                : 'This policy describes how the personal data of users who visit the ingantonioceglie.it website is processed, pursuant to Regulation (EU) 2016/679 (GDPR).' }}
        </p>

        <div>
            <h2 class="font-display font-bold mb-2" style="font-size:1.25rem; color:#1a1510;">
                {{ $it ? '1. Titolare del trattamento' : '1. Data controller' }}
            </h2>
            <p>
                {{ $it
                    ? 'Il titolare del trattamento è Antonio Ceglie, con sede in Via Sigismondo Castromediano 48, 70126 Bari (BA).'
                    : 'The data controller is Antonio Ceglie, based at Via Sigismondo Castromediano 48, 70126 Bari (BA), Italy.' }}
                Email: <a href="mailto:antonio.ceglie1@gmail.com" style="color:#c0392b;">antonio.ceglie1@gmail.com</a>
            </p>
        </div>

        <div>
            <h2 class="font-display font-bold mb-2" style="font-size:1.25rem; color:#1a1510;">
                {{ $it ? '2. Dati raccolti tramite il modulo di contatto' : '2. Data collected via the contact form' }}
            </h2>
            <p>
                {{ $it
                    ? 'Quando compili il modulo di contatto raccogliamo i dati che fornisci volontariamente: nome, indirizzo email, numero di telefono (facoltativo), oggetto e testo del messaggio. Questi dati sono utilizzati esclusivamente per rispondere alla tua richiesta.'
                    : 'When you fill in the contact form we collect the data you voluntarily provide: name, email address, phone number (optional), subject and message text. This data is used solely to respond to your request.' }}
            </p>
            <p class="mt-3">
                <strong style="color:#1a1510;">{{ $it ? 'Base giuridica:' : 'Legal basis:' }}</strong>
                {{ $it
                    ? 'il consenso dell\'interessato e l\'esecuzione di misure precontrattuali adottate su sua richiesta.'
                    : 'the data subject\'s consent and the performance of pre-contractual measures taken at their request.' }}
            </p>
            <p class="mt-3">
                <strong style="color:#1a1510;">{{ $it ? 'Conservazione:' : 'Retention:' }}</strong>
                {{ $it
                    ? 'i dati sono conservati per il tempo necessario a gestire la richiesta e agli adempimenti di legge, dopodiché vengono cancellati.'
                    : 'data is kept for as long as necessary to handle the request and to meet legal obligations, after which it is deleted.' }}
            </p>
        </div>

        <div>
            <h2 class="font-display font-bold mb-2" style="font-size:1.25rem; color:#1a1510;">
                {{ $it ? '3. Cookie e statistiche' : '3. Cookies and analytics' }}
            </h2>
            <p>
                {{ $it
                    ? 'Il sito utilizza Google Analytics 4 per raccogliere statistiche anonime e aggregate sulla navigazione (pagine viste, provenienza, dispositivo). I cookie analitici vengono attivati solo previo tuo consenso, espresso tramite l\'apposito banner. Puoi rifiutarli o revocare il consenso in qualsiasi momento senza pregiudicare la navigazione. Gli indirizzi IP sono trattati in forma anonimizzata.'
                    : 'The site uses Google Analytics 4 to collect anonymous, aggregated browsing statistics (pages viewed, source, device). Analytics cookies are activated only with your prior consent, given via the dedicated banner. You may refuse them or withdraw consent at any time without affecting your browsing. IP addresses are processed in anonymised form.' }}
            </p>
        </div>

        <div>
            <h2 class="font-display font-bold mb-2" style="font-size:1.25rem; color:#1a1510;">
                {{ $it ? '4. Comunicazione dei dati' : '4. Data sharing' }}
            </h2>
            <p>
                {{ $it
                    ? 'I dati non vengono diffusi né ceduti a terzi per finalità di marketing. Possono essere trattati da fornitori di servizi tecnici (hosting, statistiche) in qualità di responsabili del trattamento, nel rispetto della normativa vigente.'
                    : 'Data is neither disclosed nor sold to third parties for marketing purposes. It may be processed by technical service providers (hosting, analytics) acting as data processors, in compliance with applicable law.' }}
            </p>
        </div>

        <div>
            <h2 class="font-display font-bold mb-2" style="font-size:1.25rem; color:#1a1510;">
                {{ $it ? '5. Diritti dell\'interessato' : '5. Your rights' }}
            </h2>
            <p>
                {{ $it
                    ? 'Hai il diritto di accedere ai tuoi dati, chiederne la rettifica o la cancellazione, limitarne od opporti al trattamento, e alla portabilità. Puoi esercitare questi diritti scrivendo a antonio.ceglie1@gmail.com. Hai inoltre il diritto di proporre reclamo al Garante per la protezione dei dati personali.'
                    : 'You have the right to access your data, request its correction or deletion, restrict or object to its processing, and to data portability. You may exercise these rights by writing to antonio.ceglie1@gmail.com. You also have the right to lodge a complaint with the Italian Data Protection Authority.' }}
            </p>
        </div>

        <p class="pt-6 text-sm" style="color:#8a7a64;">
            {{ $it ? 'Ultimo aggiornamento:' : 'Last updated:' }} {{ now()->format('d/m/Y') }}
        </p>
    </div>
</section>

@endsection
