@if(config('services.google_analytics.id'))
@php $gaId = config('services.google_analytics.id'); @endphp
{{-- Google Analytics 4 con Consent Mode v2 — non traccia finché l'utente non acconsente --}}
<script async src="https://www.googletagmanager.com/gtag/js?id={{ $gaId }}"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    // Consenso di default NEGATO (GDPR): nessun cookie di tracciamento finché l'utente non accetta
    gtag('consent', 'default', {
        'ad_storage': 'denied',
        'ad_user_data': 'denied',
        'ad_personalization': 'denied',
        'analytics_storage': 'denied'
    });

    // Se l'utente aveva già acconsentito, riattiva il tracciamento
    try {
        if (localStorage.getItem('cookie-consent') === 'accepted') {
            gtag('consent', 'update', { 'analytics_storage': 'granted' });
        }
    } catch (e) {}

    gtag('config', '{{ $gaId }}', { 'anonymize_ip': true });
</script>
@endif
