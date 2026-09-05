@php $it = app()->getLocale() === 'it'; @endphp
<div id="cookie-banner"
     style="display:none; position:fixed; left:1rem; right:1rem; bottom:1rem; z-index:9997;
            max-width:560px; margin-inline:auto;
            background:#1a1510; color:#f0ead6; padding:1.25rem 1.4rem;
            box-shadow:0 10px 40px rgba(0,0,0,0.35);">
    <p style="font-size:0.85rem; line-height:1.6; margin-bottom:1rem;">
        {{ $it
            ? 'Questo sito usa cookie analitici (Google Analytics) per capire come viene navigato. Sono attivati solo con il tuo consenso.'
            : 'This site uses analytics cookies (Google Analytics) to understand how it is used. They are activated only with your consent.' }}
        <a href="{{ route('privacy', ['locale' => app()->getLocale()]) }}"
           style="color:#e0b0a8; text-decoration:underline;">
            {{ $it ? 'Informativa privacy' : 'Privacy policy' }}
        </a>
    </p>
    <div style="display:flex; gap:0.75rem; flex-wrap:wrap;">
        <button type="button" onclick="cookieConsent(true)"
                style="flex:1; min-width:120px; background:#c0392b; color:#f0ead6; border:none;
                       padding:0.7rem 1rem; font-size:0.8rem; letter-spacing:0.08em;
                       text-transform:uppercase; cursor:pointer; transition:background 0.2s;"
                onmouseover="this.style.background='#a8321f';" onmouseout="this.style.background='#c0392b';">
            {{ $it ? 'Accetta' : 'Accept' }}
        </button>
        <button type="button" onclick="cookieConsent(false)"
                style="flex:1; min-width:120px; background:transparent; color:#f0ead6;
                       border:1px solid #8a7a64; padding:0.7rem 1rem; font-size:0.8rem;
                       letter-spacing:0.08em; text-transform:uppercase; cursor:pointer; transition:border-color 0.2s;"
                onmouseover="this.style.borderColor='#f0ead6';" onmouseout="this.style.borderColor='#8a7a64';">
            {{ $it ? 'Rifiuta' : 'Decline' }}
        </button>
    </div>
</div>
<script>
    (function () {
        var banner = document.getElementById('cookie-banner');
        var choice;
        try { choice = localStorage.getItem('cookie-consent'); } catch (e) {}
        if (!choice) { banner.style.display = 'block'; }
    })();

    function cookieConsent(accepted) {
        try { localStorage.setItem('cookie-consent', accepted ? 'accepted' : 'rejected'); } catch (e) {}
        if (accepted && typeof gtag === 'function') {
            gtag('consent', 'update', { 'analytics_storage': 'granted' });
        }
        var b = document.getElementById('cookie-banner');
        if (b) b.style.display = 'none';
    }

    // Riapre il banner (link "Cookie" nel footer) per cambiare/revocare la scelta
    function reopenCookieBanner() {
        var b = document.getElementById('cookie-banner');
        if (b) b.style.display = 'block';
    }
</script>
