<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TC Europe — Sartoria per l'Ingegneria</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700;900&family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400;1,500&family=Inter:wght@300;400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .font-cinzel { font-family: 'Cinzel', serif; }
        .font-cormorant { font-family: 'Cormorant Garamond', serif; }
    </style>
</head>
<body class="bg-black text-white overflow-hidden h-screen">

    {{-- Sfondo --}}
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-br from-gray-950 via-gray-900 to-black"></div>
        {{-- Linee decorative architettoniche --}}
        <div class="absolute inset-0 opacity-[0.04]">
            <div class="absolute top-0 left-1/4 w-px h-full bg-white"></div>
            <div class="absolute top-0 right-1/4 w-px h-full bg-white"></div>
            <div class="absolute top-1/4 left-0 w-full h-px bg-white"></div>
            <div class="absolute bottom-1/4 left-0 w-full h-px bg-white"></div>
        </div>
        {{-- Alone centrale --}}
        <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
            <div class="w-[600px] h-[600px] bg-white/[0.02] rounded-full blur-3xl"></div>
        </div>
    </div>

    {{-- Contenuto centrato --}}
    <div class="relative z-10 h-screen flex flex-col items-center justify-center px-6">

        {{-- Nome studio --}}
        <div class="text-center mb-16">

            {{-- TC EUROPE in Cinzel leggero --}}
            <h1 class="font-cinzel text-white leading-none mb-8"
                style="font-size: clamp(3rem, 10vw, 9rem); letter-spacing: 0.22em; font-weight: 400;">
                TC EUROPE
            </h1>

            {{-- Linea sottile --}}
            <div class="flex items-center justify-center gap-6 mb-8">
                <div class="h-px bg-white/15 w-32"></div>
                <div class="w-1 h-1 bg-white/25 rounded-full"></div>
                <div class="h-px bg-white/15 w-32"></div>
            </div>

            {{-- Sottotitolo in Cormorant Garamond corsivo classico --}}
            <p class="font-cormorant text-white/55"
               style="font-size: clamp(1.1rem, 2.8vw, 1.75rem); font-weight: 300; letter-spacing: 0.28em; font-style: italic;">
                Sartoria per l'Ingegneria
            </p>

        </div>

        {{-- Scelta lingua --}}
        <div class="flex items-center gap-16">

            <a href="{{ route('set-locale', 'it') }}"
               class="group flex flex-col items-center gap-3 cursor-pointer">
                <span class="font-cinzel text-2xl md:text-3xl font-semibold tracking-[0.3em] text-white/50
                             group-hover:text-white transition-all duration-500">
                    IT
                </span>
                <span class="font-cormorant italic text-sm text-white/25 group-hover:text-white/50 transition-colors duration-300"
                      style="letter-spacing: 0.2em;">
                    Italiano
                </span>
                <div class="h-px bg-white/40 transition-all duration-500 w-0 group-hover:w-full"></div>
            </a>

            <div class="flex flex-col items-center gap-2">
                <div class="w-px h-8 bg-white/10"></div>
                <div class="w-1 h-1 bg-white/20 rounded-full"></div>
                <div class="w-px h-8 bg-white/10"></div>
            </div>

            <a href="{{ route('set-locale', 'en') }}"
               class="group flex flex-col items-center gap-3 cursor-pointer">
                <span class="font-cinzel text-2xl md:text-3xl font-semibold tracking-[0.3em] text-white/50
                             group-hover:text-white transition-all duration-500">
                    EN
                </span>
                <span class="font-cormorant italic text-sm text-white/25 group-hover:text-white/50 transition-colors duration-300"
                      style="letter-spacing: 0.2em;">
                    English
                </span>
                <div class="h-px bg-white/40 transition-all duration-500 w-0 group-hover:w-full"></div>
            </a>

        </div>

    </div>

</body>
</html>
