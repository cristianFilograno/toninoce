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
    </style>
</head>
<body class="bg-graph overflow-hidden h-screen" style="color:#1a1510;">

    <div id="main-content" class="h-screen flex flex-col items-center justify-center px-6">

        {{-- Logo mark --}}
        <div class="text-center mb-16 select-none">
            <h1 style="font-family:'Playfair Display',serif; font-weight:900; line-height:1;
                       font-size:clamp(4rem,12vw,10rem); letter-spacing:-0.01em; color:#1a1510;">
                TONINO<span style="font-style:italic; font-weight:400; color:#c0392b; font-size:0.72em; letter-spacing:0;">cè</span>
            </h1>
            <div class="flex items-center justify-center gap-5 mt-5">
                <div class="h-px w-16" style="background:#d8cdb8;"></div>
                <p style="font-family:'Inter',sans-serif; font-size:0.7rem; letter-spacing:0.35em;
                           text-transform:uppercase; color:#4e4030; font-weight:300;">
                    Studio di Ingegneria
                </p>
                <div class="h-px w-16" style="background:#d8cdb8;"></div>
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
