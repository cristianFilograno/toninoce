<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TONINOcè — Studio di Ingegneria Strutturale</title>
    <meta name="description" content="TONINOcè — Studio di ingegneria strutturale specializzato in progettazione, direzione lavori e consolidamento. Structural engineering studio based in Italy.">
    <meta name="robots" content="index, follow">
    <meta property="og:type"        content="website">
    <meta property="og:title"       content="TONINOcè — Studio di Ingegneria Strutturale">
    <meta property="og:description" content="Studio di ingegneria strutturale specializzato in progettazione, direzione lavori e consolidamento.">
    <meta property="og:url"         content="{{ url('/') }}">
    <link rel="canonical" href="{{ url('/') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,900;1,400&family=Cormorant+Garamond:ital,wght@1,300;1,400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @view-transition { navigation: none; }

        /* ── Dissolvenza in uscita: resta solo lo sfondo bg-graph (comune alle altre pagine) ── */
        .fade-target {
            transition: opacity 0.6s ease;
        }
        .fade-target.fly-out {
            opacity: 0 !important;
        }

        /* ── Hero ── */
        .hero-line {
            width: clamp(1.5rem, 5vw, 4rem);
        }
        #hero-tagline {
            display: inline-block;
            font-family: 'Palatino Linotype', 'Palatino', 'Book Antiqua', serif;
            font-size: clamp(0.8rem, 2.3vw, 1.4rem);
            font-weight: 600;
            color: #1a1510;
            letter-spacing: 0.35em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        /* ── Bottoni lingua ── */
        .home-lang {
            padding: 1.1rem 2rem;
            transition: opacity 0.25s ease;
            text-decoration: none;
        }
        .home-lang:hover {
            opacity: 0.7;
        }

        /* ── Responsive immagine decorativa ── */
        @media (max-width: 1023px) {
            #vela-img { width: 60vw !important; opacity: 0.5 !important; }
        }
        @media (max-width: 639px) {
            #vela-img { width: 88vw !important; opacity: 0.4 !important; left: 4vw !important; bottom: 3vh !important; }
        }

        /* ── Accessibilità: rispetta la preferenza di riduzione del movimento ── */
        @media (prefers-reduced-motion: reduce) {
            .fade-target { transition: none; }
        }
    </style>
</head>
<body class="bg-graph overflow-hidden h-screen" style="color:#1a1510;">

    {{-- Immagine decorativa bottom-left --}}
    <img id="vela-img" src="/images/VELA.png" alt=""
         class="fade-target"
         style="position:fixed; bottom:0; left:6vw; width:52vw; max-width:780px;
                opacity:0.7; pointer-events:none; z-index:0; display:block;
                object-fit:contain; object-position:bottom left;">

    <div id="main-content" class="fade-target h-screen flex flex-col items-center justify-center px-6" style="position:relative; z-index:1;">

        {{-- Logo mark --}}
        <div class="text-center mb-12 select-none">
            <h1 class="sr-only">TONINOcè — Studio di Ingegneria Strutturale</h1>
            <img id="hero-logo"
                 src="/images/logo.png"
                 alt="TONINOcè"
                 style="height:clamp(7rem,20vw,17rem); width:auto; display:block; margin:0 auto;">
            <div class="flex items-center justify-center gap-3 sm:gap-5 mt-1">
                <div class="hero-line h-px" style="background:#d8cdb8;"></div>
                <span id="hero-tagline">Ingegneria dal 2022</span>
                <div class="hero-line h-px" style="background:#d8cdb8;"></div>
            </div>
        </div>

        {{-- Scelta lingua --}}
        <div class="flex items-center gap-6 sm:gap-12">

            <a href="{{ route('set-locale', 'it') }}"
               onclick="handleLocale(event, this.href)"
               class="home-lang flex flex-col items-center gap-2 cursor-pointer">
                <span class="home-lang-label"
                      style="font-family:'Playfair Display',serif; font-size:1.4rem; font-weight:900;
                             letter-spacing:0.2em; color:#4e4030; transition:color 0.35s;">
                    IT
                </span>
                <span style="font-family:'Cormorant Garamond',serif; font-style:italic; font-size:0.8rem;
                              color:#4e4030; letter-spacing:0.15em;">
                    Italiano
                </span>
            </a>

            <div style="width:1px; height:40px; background:#d8cdb8;"></div>

            <a href="{{ route('set-locale', 'en') }}"
               onclick="handleLocale(event, this.href)"
               class="home-lang flex flex-col items-center gap-2 cursor-pointer">
                <span class="home-lang-label"
                      style="font-family:'Playfair Display',serif; font-size:1.4rem; font-weight:900;
                             letter-spacing:0.2em; color:#4e4030; transition:color 0.35s;">
                    EN
                </span>
                <span style="font-family:'Cormorant Garamond',serif; font-style:italic; font-size:0.8rem;
                              color:#4e4030; letter-spacing:0.15em;">
                    English
                </span>
            </a>

        </div>
    </div>

    <script>
        var _fly = false;
        function handleLocale(e, url) {
            e.preventDefault();
            if (_fly) return;
            _fly = true;
            document.querySelectorAll('.fade-target').forEach(function (el) {
                el.classList.add('fly-out');
            });
            setTimeout(function(){ window.location.href = url; }, 600);
        }

        document.querySelectorAll('.home-lang').forEach(function(el) {
            el.addEventListener('mouseenter', function() {
                el.querySelector('.home-lang-label').style.color = '#c0392b';
            });
            el.addEventListener('mouseleave', function() {
                el.querySelector('.home-lang-label').style.color = '#4e4030';
            });
        });
    </script>
</body>
</html>
