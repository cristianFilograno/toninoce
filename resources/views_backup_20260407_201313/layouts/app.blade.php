<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    <meta name="description" content="@yield('description', '')">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-800 font-sans antialiased">

    {{-- Navbar --}}
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 flex items-center justify-between h-16">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="font-display font-bold text-xl tracking-tight text-gray-900">
                TCeu
            </a>

            {{-- Menu --}}
            <div class="hidden md:flex items-center gap-8">
                <a href="{{ route('chi-siamo', ['locale' => app()->getLocale()]) }}"
                   class="text-sm font-medium text-gray-600 hover:text-gray-900 transition {{ request()->routeIs('chi-siamo') ? 'text-gray-900' : '' }}">
                    {{ app()->getLocale() === 'it' ? 'Chi Siamo' : 'About Us' }}
                </a>
                <a href="{{ route('progetti', ['locale' => app()->getLocale()]) }}"
                   class="text-sm font-medium text-gray-600 hover:text-gray-900 transition {{ request()->routeIs('progetti*') ? 'text-gray-900' : '' }}">
                    {{ app()->getLocale() === 'it' ? 'Progetti' : 'Projects' }}
                </a>
                <a href="{{ route('download', ['locale' => app()->getLocale()]) }}"
                   class="text-sm font-medium text-gray-600 hover:text-gray-900 transition {{ request()->routeIs('download*') ? 'text-gray-900' : '' }}">
                    Download
                </a>
                <a href="{{ route('contatti', ['locale' => app()->getLocale()]) }}"
                   class="text-sm font-medium text-gray-600 hover:text-gray-900 transition {{ request()->routeIs('contatti*') ? 'text-gray-900' : '' }}">
                    {{ app()->getLocale() === 'it' ? 'Contatti' : 'Contact' }}
                </a>
            </div>

            {{-- Cambio lingua --}}
            <div class="flex items-center gap-2">
                <a href="{{ route('set-locale', 'it') }}"
                   class="text-xs font-semibold px-2 py-1 rounded transition {{ app()->getLocale() === 'it' ? 'bg-gray-900 text-white' : 'text-gray-500 hover:text-gray-900' }}">
                    IT
                </a>
                <span class="text-gray-300">|</span>
                <a href="{{ route('set-locale', 'en') }}"
                   class="text-xs font-semibold px-2 py-1 rounded transition {{ app()->getLocale() === 'en' ? 'bg-gray-900 text-white' : 'text-gray-500 hover:text-gray-900' }}">
                    EN
                </a>

                {{-- Menu mobile --}}
                <button id="menu-toggle" class="md:hidden ml-4 p-2 text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Menu mobile dropdown --}}
        <div id="mobile-menu" class="hidden md:hidden border-t border-gray-100 bg-white">
            <div class="px-6 py-4 flex flex-col gap-4">
                <a href="{{ route('chi-siamo', ['locale' => app()->getLocale()]) }}" class="text-sm font-medium text-gray-700">
                    {{ app()->getLocale() === 'it' ? 'Chi Siamo' : 'About Us' }}
                </a>
                <a href="{{ route('progetti', ['locale' => app()->getLocale()]) }}" class="text-sm font-medium text-gray-700">
                    {{ app()->getLocale() === 'it' ? 'Progetti' : 'Projects' }}
                </a>
                <a href="{{ route('download', ['locale' => app()->getLocale()]) }}" class="text-sm font-medium text-gray-700">Download</a>
                <a href="{{ route('contatti', ['locale' => app()->getLocale()]) }}" class="text-sm font-medium text-gray-700">
                    {{ app()->getLocale() === 'it' ? 'Contatti' : 'Contact' }}
                </a>
            </div>
        </div>
    </nav>

    {{-- Contenuto --}}
    <main class="pt-16">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-900 text-gray-400 py-12 mt-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="font-display font-bold text-white text-lg">TCeu</div>
                <p class="text-sm">© {{ date('Y') }} TCeu. {{ app()->getLocale() === 'it' ? 'Tutti i diritti riservati.' : 'All rights reserved.' }}</p>
                <div class="flex gap-6">
                    <a href="{{ route('chi-siamo', ['locale' => app()->getLocale()]) }}" class="text-sm hover:text-white transition">
                        {{ app()->getLocale() === 'it' ? 'Chi Siamo' : 'About' }}
                    </a>
                    <a href="{{ route('contatti', ['locale' => app()->getLocale()]) }}" class="text-sm hover:text-white transition">
                        {{ app()->getLocale() === 'it' ? 'Contatti' : 'Contact' }}
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.getElementById('menu-toggle')?.addEventListener('click', () => {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
</body>
</html>
