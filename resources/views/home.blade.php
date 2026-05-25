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
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,900;1,400&family=Cormorant+Garamond:ital,wght@1,300;1,400&family=Inter:wght@300;400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @view-transition { navigation: none; }
        #main-content {
            transition: transform 0.7s cubic-bezier(0.2,0,0.8,1), opacity 0.65s ease-in;
            transform-origin: center center;
        }
        #main-content.fly-out { transform: scale(3.5); opacity: 0; }

        @keyframes logoReveal {
            0%   { opacity: 0; transform: translateY(28px) scale(0.97); filter: blur(6px); }
            60%  { filter: blur(0); }
            100% { opacity: 1; transform: translateY(0) scale(1); filter: blur(0); }
        }
        @keyframes lineExpand {
            from { width: 0; opacity: 0; }
            to   { width: 4rem; opacity: 1; }
        }
        @keyframes writeReveal {
            from { clip-path: inset(0 100% 0 0); opacity: 1; }
            to   { clip-path: inset(0 0% 0 0);   opacity: 1; }
        }
        @keyframes cursorBlink {
            0%, 100% { opacity: 1; }
            50%       { opacity: 0; }
        }
        #hero-logo {
            animation: logoReveal 1.4s cubic-bezier(0.16,1,0.3,1) 0.1s both;
        }
        .hero-line {
            animation: lineExpand 0.5s ease-out 1.2s both;
        }
        #hero-tagline-wrap {
            position: relative;
            display: inline-block;
            opacity: 0;
            animation: none;
        }
        #hero-tagline-wrap.start-write {
            opacity: 1;
        }
        #hero-tagline {
            display: inline-block;
            clip-path: inset(0 100% 0 0);
        }
        #hero-tagline.start-write {
            animation: writeReveal 1.3s cubic-bezier(0.4,0,0.2,1) forwards;
        }
        #hero-cursor { display: none; }
    </style>
</head>
<body class="bg-graph overflow-hidden h-screen" style="color:#1a1510;">

    <div id="main-content" class="h-screen flex flex-col items-center justify-center px-6">

        {{-- Logo mark --}}
        <div class="text-center mb-16 select-none">
            <h1>
                <img id="hero-logo"
                     src="/images/logo.png"
                     alt="TONINOcè"
                     style="height:clamp(5rem,16vw,13rem); width:auto; display:block; margin:0 auto;">
            </h1>
            <div class="flex items-center justify-center gap-5 mt-6">
                <div class="hero-line h-px" style="background:#d8cdb8;"></div>
                <span id="hero-tagline-wrap">
                    <span id="hero-tagline"
                          style="font-family:'Cormorant Garamond',serif; font-style:italic;
                                 font-size:1.7rem; font-weight:300; color:#4e4030; letter-spacing:0.08em;">
                        Sartoria per l'Ingegneria
                    </span>
                    <span id="hero-cursor"></span>
                </span>
                <div class="hero-line h-px" style="background:#d8cdb8;"></div>
            </div>
        </div>

        {{-- Scelta lingua --}}
        <div class="flex items-center gap-12">

            <a href="{{ route('set-locale', 'it') }}"
               onclick="handleLocale(event, this.href)"
               class="home-lang flex flex-col items-center gap-2 cursor-pointer">
                <span class="home-lang-label"
                      style="font-family:'Playfair Display',serif; font-size:1.6rem; font-weight:900;
                             letter-spacing:0.2em; color:#4e4030; transition:color 0.35s;">
                    IT
                </span>
                <span style="font-family:'Cormorant Garamond',serif; font-style:italic; font-size:0.85rem;
                              color:#4e4030; letter-spacing:0.15em;">
                    Italiano
                </span>
                <div class="home-lang-bar" style="height:1px; background:#c0392b; width:0; transition:width 0.35s cubic-bezier(0.4,0,0.2,1);"></div>
            </a>

            <div style="width:1px; height:40px; background:#d8cdb8;"></div>

            <a href="{{ route('set-locale', 'en') }}"
               onclick="handleLocale(event, this.href)"
               class="home-lang flex flex-col items-center gap-2 cursor-pointer">
                <span class="home-lang-label"
                      style="font-family:'Playfair Display',serif; font-size:1.6rem; font-weight:900;
                             letter-spacing:0.2em; color:#4e4030; transition:color 0.35s;">
                    EN
                </span>
                <span style="font-family:'Cormorant Garamond',serif; font-style:italic; font-size:0.85rem;
                              color:#4e4030; letter-spacing:0.15em;">
                    English
                </span>
                <div class="home-lang-bar" style="height:1px; background:#c0392b; width:0; transition:width 0.35s cubic-bezier(0.4,0,0.2,1);"></div>
            </a>

        </div>
    </div>

    <script>
        // ── Scrittura tagline ─────────────────────────────────────────
        window.addEventListener('load', function () {
            setTimeout(function () {
                var wrap    = document.getElementById('hero-tagline-wrap');
                var tagline = document.getElementById('hero-tagline');
                var cursor  = document.getElementById('hero-cursor');
                // Mostra il cursore e avvia la scrittura
                wrap.classList.add('start-write');
                cursor.style.opacity = '1';
                tagline.classList.add('start-write');
                // Dopo la scrittura il cursore lampeggia 3 volte poi scompare
                setTimeout(function () {
                    cursor.classList.add('blinking');
                    setTimeout(function () { cursor.style.opacity = '0'; }, 1800);
                }, 2000);
            }, 900); // parte dopo che il logo è apparso
        });

        var _fly = false;
        function handleLocale(e, url) {
            e.preventDefault();
            if (_fly) return;
            _fly = true;
            document.getElementById('main-content').classList.add('fly-out');
            setTimeout(function(){ window.location.href = url; }, 650);
        }

        document.querySelectorAll('.home-lang').forEach(function(el) {
            el.addEventListener('mouseenter', function() {
                el.querySelector('.home-lang-label').style.color = '#c0392b';
                el.querySelector('.home-lang-bar').style.width   = '100%';
            });
            el.addEventListener('mouseleave', function() {
                el.querySelector('.home-lang-label').style.color = '#4e4030';
                el.querySelector('.home-lang-bar').style.width   = '0';
            });
        });
    </script>
</body>
</html>
