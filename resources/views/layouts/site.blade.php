<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $page->meta_description ?: $page->excerpt }}">
    <title>{{ $page->meta_title ?: $page->title.' — '.($settings['site_title'] ?? 'K Bashar') }}</title>
    <meta property="og:title" content="{{ $page->meta_title ?: $page->title }}">
    <meta property="og:description" content="{{ $page->meta_description ?: $page->excerpt }}">
    <meta property="og:type" content="website">
    <meta name="theme-color" content="#020810">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="tech-site">
    <header class="tech-header">
        <div class="tech-shell tech-header__inner">
            <a href="{{ route('home') }}" class="tech-brand" aria-label="{{ $settings['site_title'] ?? 'K Bashar' }} home">
                @if($settings['logo_path'] ?? null)
                    <img src="{{ asset('storage/'.$settings['logo_path']) }}" class="tech-brand__mark object-cover" alt="{{ $settings['site_title'] ?? 'K Bashar' }}">
                @else
                    <span class="tech-brand__mark">KB</span>
                @endif
                <span><strong>{{ $settings['site_title'] ?? 'K Bashar' }}</strong><small>Technology solutions</small></span>
            </a>

            <nav class="tech-nav" aria-label="Main navigation">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'is-active' : '' }}">Home</a>
                <a href="{{ route('home') }}#about">About</a>
                <a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'is-active' : '' }}">Services</a>
                <a href="{{ route('home') }}#work">Work</a>
            </nav>

            <div class="tech-header__actions">
                <a href="{{ route('contact') }}" class="tech-btn tech-btn--small">Contact</a>
                <button type="button" data-mobile-toggle class="tech-menu" aria-label="Toggle menu"><x-icon name="menu" /></button>
            </div>
        </div>
        <nav data-mobile-menu class="tech-mobile hidden" aria-label="Mobile navigation">
            <a href="{{ route('home') }}">Home</a><a href="{{ route('home') }}#about">About</a><a href="{{ route('services') }}">Services</a><a href="{{ route('home') }}#work">Work</a><a href="{{ route('contact') }}">Contact</a>
        </nav>
    </header>

    <main>@yield('content')</main>

    <footer class="tech-footer">
        <div class="tech-shell">
            <div class="tech-footer__main">
                <div>
                    <a href="{{ route('home') }}" class="tech-brand"><span class="tech-brand__mark">KB</span><span><strong>{{ $settings['site_title'] ?? 'K Bashar' }}</strong><small>Technology solutions</small></span></a>
                    <p>Reliable development, infrastructure and digital growth services for modern businesses.</p>
                </div>
                <div><h3>Navigate</h3><a href="{{ route('home') }}">Home</a><a href="{{ route('services') }}">Services</a><a href="{{ route('contact') }}">Contact</a></div>
                <div><h3>Legal</h3><a href="{{ route('privacy') }}">Privacy Policy</a><a href="{{ route('terms') }}">Terms of Service</a></div>
                <div><h3>Connect</h3><a href="mailto:{{ $settings['email'] ?? '' }}">{{ $settings['email'] ?? '' }}</a><span>{{ $settings['location'] ?? '' }}</span></div>
            </div>
            <div class="tech-footer__bottom"><span>© {{ date('Y') }} {{ $settings['site_title'] ?? 'K Bashar' }}</span><span>Designed to build · secure · grow</span></div>
        </div>
    </footer>
</body>
</html>
