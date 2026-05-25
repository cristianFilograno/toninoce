<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- ── SEO ──────────────────────────────────────────────────── --}}
    <title>@yield('title', config('app.name'))</title>
    <meta name="description" content="@yield('description', app()->getLocale() === 'it' ? 'TONINOcè — Studio di ingegneria strutturale specializzato in progettazione, direzione lavori e consolidamento di edifici.' : 'TONINOcè — Structural engineering studio specialised in design, site management and building consolidation.')">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph --}}
    <meta property="og:type"        content="website">
    <meta property="og:locale"      content="{{ app()->getLocale() === 'it' ? 'it_IT' : 'en_GB' }}">
    <meta property="og:site_name"   content="TONINOcè">
    <meta property="og:title"       content="@yield('title', config('app.name'))">
    <meta property="og:description" content="@yield('description', app()->getLocale() === 'it' ? 'TONINOcè — Studio di ingegneria strutturale specializzato in progettazione, direzione lavori e consolidamento di edifici.' : 'TONINOcè — Structural engineering studio specialised in design, site management and building consolidation.')">
    <meta property="og:url"         content="{{ url()->current() }}">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400;1,500&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('head')

    {{-- ── JSON-LD Organization ──────────────────────────────────── --}}
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "ProfessionalService",
        "name": "TONINOcè",
        "description": "{{ app()->getLocale() === 'it' ? 'Studio di ingegneria strutturale specializzato in progettazione, direzione lavori e consolidamento.' : 'Structural engineering studio specialised in design, site management and consolidation.' }}",
        "url": "{{ config('app.url') }}",
        "address": {
            "@@type": "PostalAddress",
            "streetAddress": "Via Roma, 1",
            "addressLocality": "Roma",
            "postalCode": "00100",
            "addressCountry": "IT"
        },
        "email": "info@toninoe.it",
        "telephone": "+390000000000",
        "foundingDate": "2010",
        "inLanguage": ["it", "en"]
    }
    </script>
</head>
<body class="bg-graph antialiased">

    {{-- ── NAVBAR ─────────────────────────────────────────────────────── --}}
    <nav class="fixed top-0 left-0 right-0 z-50 border-b"
         style="background:rgba(240,234,214,0.95); border-color:#d8cdb8; backdrop-filter:blur(8px);">
        <div class="max-w-7xl mx-auto px-6 flex items-center justify-between h-14">

            {{-- Logo --}}
            <a href="{{ route('home') }}"
               aria-label="TONINOcè — Home"
               class="font-display font-bold text-lg tracking-tight"
               style="color:#1a1510;">
                TONINO<span style="font-style:italic; font-weight:400; color:#c0392b; letter-spacing:0; font-family:'Cormorant Garamond',serif;">cè</span>
            </a>

            {{-- Menu centrale --}}
            <div class="hidden md:flex items-center gap-8">
                @foreach([
                    ['route' => 'chi-siamo',  'it' => 'Studio',   'en' => 'Studio'],
                    ['route' => 'progetti',   'it' => 'Progetti', 'en' => 'Projects'],
                    ['route' => 'download',   'it' => 'Download', 'en' => 'Download'],
                ] as $link)
                @php $active = request()->routeIs($link['route'].'*'); @endphp
                <a href="{{ route($link['route'], ['locale' => app()->getLocale()]) }}"
                   class="nav-link text-sm {{ $active ? 'active' : '' }}"
                   style="color:#1a1510; font-weight:{{ $active ? '500' : '400' }};">
                    {{ app()->getLocale() === 'it' ? $link['it'] : $link['en'] }}
                </a>
                @endforeach
            </div>

            {{-- Destra: Contatti (solo desktop) + IT/EN + burger --}}
            <div class="flex items-center gap-5">

                {{-- Contatti — nascosto su mobile --}}
                <div class="hidden md:block">
                    @php $contattiActive = request()->routeIs('contatti*'); @endphp
                    <a href="{{ route('contatti', ['locale' => app()->getLocale()]) }}"
                       class="nav-link text-sm font-medium {{ $contattiActive ? 'active' : '' }}"
                       style="color:#1a1510;">
                        {{ app()->getLocale() === 'it' ? 'Contatti' : 'Contact' }}
                    </a>
                </div>

                {{-- IT / EN --}}
                <div class="flex items-center gap-2 text-xs font-medium tracking-widest">
                    <a href="{{ route('set-locale', 'it') }}"
                       class="nav-link {{ app()->getLocale() === 'it' ? 'active' : '' }}"
                       style="color:#1a1510;">IT</a>
                    <span style="color:#d8cdb8;">·</span>
                    <a href="{{ route('set-locale', 'en') }}"
                       class="nav-link {{ app()->getLocale() === 'en' ? 'active' : '' }}"
                       style="color:#1a1510;">EN</a>
                </div>

                {{-- Burger (solo mobile) --}}
                <button id="menu-toggle"
                        aria-label="{{ app()->getLocale() === 'it' ? 'Apri menu' : 'Open menu' }}"
                        aria-expanded="false"
                        aria-controls="mobile-menu"
                        class="md:hidden flex flex-col justify-between"
                        style="width:22px; height:16px; background:none; border:none; padding:0; cursor:pointer; overflow:visible;">
                    <span class="burger-line" style="display:block; height:1px; width:100%; background:#1a1510;
                                                     transform-origin:center;
                                                     transition:transform 0.3s ease, opacity 0.2s ease;"></span>
                    <span class="burger-line" style="display:block; height:1px; width:100%; background:#1a1510;
                                                     transition:opacity 0.2s ease;"></span>
                    <span class="burger-line" style="display:block; height:1px; width:100%; background:#1a1510;
                                                     transform-origin:center;
                                                     transition:transform 0.3s ease, opacity 0.2s ease;"></span>
                </button>
            </div>
        </div>

        {{-- Mobile menu --}}
        <div id="mobile-menu"
             role="navigation"
             aria-label="{{ app()->getLocale() === 'it' ? 'Menu mobile' : 'Mobile menu' }}"
             class="hidden md:hidden border-t py-8 flex flex-col items-center gap-6"
             style="border-color:#d8cdb8; background:#f0ead6;">
            <a href="{{ route('chi-siamo', ['locale' => app()->getLocale()]) }}"
               class="nav-link text-base font-medium {{ request()->routeIs('chi-siamo*') ? 'active' : '' }}"
               style="color:#1a1510; letter-spacing:0.05em;">
                Studio
            </a>
            <a href="{{ route('progetti', ['locale' => app()->getLocale()]) }}"
               class="nav-link text-base font-medium {{ request()->routeIs('progetti*') ? 'active' : '' }}"
               style="color:#1a1510; letter-spacing:0.05em;">
                {{ app()->getLocale() === 'it' ? 'Progetti' : 'Projects' }}
            </a>
            <a href="{{ route('download', ['locale' => app()->getLocale()]) }}"
               class="nav-link text-base font-medium {{ request()->routeIs('download*') ? 'active' : '' }}"
               style="color:#1a1510; letter-spacing:0.05em;">
                Download
            </a>
            <a href="{{ route('contatti', ['locale' => app()->getLocale()]) }}"
               class="nav-link text-base font-medium {{ request()->routeIs('contatti*') ? 'active' : '' }}"
               style="color:#1a1510; letter-spacing:0.05em;">
                {{ app()->getLocale() === 'it' ? 'Contatti' : 'Contact' }}
            </a>
        </div>
    </nav>

    {{-- Contenuto --}}
    <main class="pt-14">
        @yield('content')
    </main>

    {{-- ── FOOTER ──────────────────────────────────────────────────── --}}
    <footer class="mt-24 border-t py-10" style="border-color:#d8cdb8;">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-4">
            <span class="font-display font-bold text-base" style="color:#1a1510;">
                TONINO<span style="font-style:italic; font-weight:400; color:#c0392b; letter-spacing:0; font-family:'Cormorant Garamond',serif;">cè</span>
            </span>
            <p class="text-xs" style="color:#4e4030;">
                &copy; {{ date('Y') }} TONINOcè. {{ app()->getLocale() === 'it' ? 'Tutti i diritti riservati.' : 'All rights reserved.' }}
            </p>
            <div class="flex gap-6">
                <a href="{{ route('chi-siamo', ['locale' => app()->getLocale()]) }}"
                   class="nav-link text-xs" style="color:#4e4030;">
                    Studio
                </a>
                <a href="{{ route('contatti', ['locale' => app()->getLocale()]) }}"
                   class="nav-link text-xs" style="color:#4e4030;">
                    {{ app()->getLocale() === 'it' ? 'Contatti' : 'Contact' }}
                </a>
            </div>
        </div>
    </footer>

    {{-- ── PDF PREVIEW MODAL ───────────────────────────────────────── --}}
    <div id="pdf-modal"
         role="dialog"
         aria-modal="true"
         onclick="closePdfModal(event)"
         style="display:none; position:fixed; inset:0; z-index:9998; background:rgba(0,0,0,0.85);">
        <div onclick="event.stopPropagation()"
             style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%);
                    width:90vw; max-width:1100px; height:88vh;
                    display:flex; flex-direction:column; background:#1a1510;">
            <div style="display:flex; align-items:center; justify-content:space-between;
                        padding:10px 16px; flex-shrink:0;">
                <span id="pdf-modal-title"
                      style="color:#f0ead6; font-size:0.7rem; letter-spacing:0.15em;
                             text-transform:uppercase; overflow:hidden; text-overflow:ellipsis;
                             white-space:nowrap; max-width:70%;"></span>
                <div style="display:flex; align-items:center; gap:16px;">
                    <a id="pdf-modal-download" href="#"
                       style="color:#8a7a64; font-size:0.7rem; letter-spacing:0.15em;
                              text-transform:uppercase; text-decoration:none;
                              display:flex; align-items:center; gap:6px;"
                       onmouseover="this.style.color='#f0ead6';" onmouseout="this.style.color='#8a7a64';">
                        <svg style="width:13px;height:13px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        {{ app()->getLocale() === 'it' ? 'Scarica' : 'Download' }}
                    </a>
                    <button onclick="closePdfModal()"
                            style="background:none; border:none; color:#8a7a64; font-size:1.6rem;
                                   line-height:1; cursor:pointer; padding:0;"
                            onmouseover="this.style.color='#f0ead6';" onmouseout="this.style.color='#8a7a64';">×</button>
                </div>
            </div>
            <iframe id="pdf-modal-frame" src=""
                    style="flex:1; border:none; width:100%; background:#fff;"></iframe>
        </div>
    </div>

    {{-- ── LIGHTBOX ─────────────────────────────────────────────────── --}}
    <div id="lightbox"
         role="dialog"
         aria-modal="true"
         aria-label="{{ app()->getLocale() === 'it' ? 'Visualizzatore immagine' : 'Image viewer' }}"
         onclick="closeLightbox()"
         style="display:none; position:fixed; inset:0; z-index:9999;
                background:rgba(0,0,0,0.93); cursor:zoom-out;">
        <img id="lightbox-img" src="" alt=""
             style="max-width:92vw; max-height:92vh; position:absolute;
                    top:50%; left:50%; transform:translate(-50%,-50%);
                    object-fit:contain; pointer-events:none;">
        <button onclick="closeLightbox()"
                aria-label="{{ app()->getLocale() === 'it' ? 'Chiudi' : 'Close' }}"
                style="position:absolute; top:18px; right:22px; background:none; border:none;
                       color:#f0ead6; font-size:2rem; line-height:1; cursor:pointer; opacity:0.7;"
                onmouseover="this.style.opacity='1';" onmouseout="this.style.opacity='0.7';">×</button>
    </div>

    <script>
        // ── Scroll animations ─────────────────────────────────────────
        (function () {
            var observer = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.08, rootMargin: '0px 0px -48px 0px' });

            function observe() {
                document.querySelectorAll('[data-animate]').forEach(function (el) {
                    var d = el.dataset.delay;
                    if (d) el.style.transitionDelay = d;
                    observer.observe(el);
                });
            }
            observe();
            document.addEventListener('DOMContentLoaded', observe);
        })();

        // ── Lightbox ─────────────────────────────────────────────────
        function openLightbox(src, altText) {
            var img = document.getElementById('lightbox-img');
            img.src = src;
            img.alt = altText || '';
            document.getElementById('lightbox').style.display = 'block';
            document.body.style.overflow = 'hidden';
        }
        function closeLightbox() {
            document.getElementById('lightbox').style.display = 'none';
            document.getElementById('lightbox-img').src = '';
            document.body.style.overflow = '';
        }
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') { closeLightbox(); closePdfModal(); }
        });

        // ── PDF Modal ─────────────────────────────────────────────────
        function openPdfModal(url, nome) {
            document.getElementById('pdf-modal-frame').src = url;
            document.getElementById('pdf-modal-title').textContent = nome || '';
            document.getElementById('pdf-modal-download').href = url;
            document.getElementById('pdf-modal').style.display = 'block';
            document.body.style.overflow = 'hidden';
        }
        function closePdfModal(e) {
            if (e && e.target !== document.getElementById('pdf-modal')) return;
            document.getElementById('pdf-modal').style.display = 'none';
            document.getElementById('pdf-modal-frame').src = '';
            document.body.style.overflow = '';
        }

        // ── Burger menu ───────────────────────────────────────────────
        (function () {
            var btn  = document.getElementById('menu-toggle');
            var menu = document.getElementById('mobile-menu');
            if (!btn || !menu) return;

            var lines  = btn.querySelectorAll('.burger-line');
            var top    = lines[0];
            var mid    = lines[1];
            var bot    = lines[2];
            var isOpen = false;

            btn.addEventListener('click', function () {
                isOpen = !isOpen;
                var offset = (btn.offsetHeight / 2) + 'px';
                menu.classList.toggle('hidden', !isOpen);
                btn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');

                if (isOpen) {
                    top.style.transform = 'translateY(' + offset + ') rotate(45deg)';
                    mid.style.opacity   = '0';
                    bot.style.transform = 'translateY(-' + offset + ') rotate(-45deg)';
                } else {
                    top.style.transform = '';
                    mid.style.opacity   = '1';
                    bot.style.transform = '';
                }
            });
        })();
    </script>
</body>
</html>
