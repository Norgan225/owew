<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- SEO Meta Tags --}}
    <title>@yield('title', config('app.seo.title', 'OWEW - Organisation pour les Veuves et les Orphelins | ONG Humanitaire'))</title>
    <meta name="description" content="@yield('description', config('app.seo.description', 'OWEW est une ONG dédiée à l\'aide aux veuves, orphelins et personnes vulnérables en Côte d\'Ivoire. Découvrez nos projets humanitaires et faites un don.'))">
    <meta name="keywords" content="@yield('keywords', config('app.seo.keywords', 'ONG, humanitaire, veuves, orphelins, aide sociale, Côte d\'Ivoire, don, charité, association'))">
    <meta name="author" content="{{ config('app.seo.author', 'OWEW') }}">
    <meta name="robots" content="{{ config('app.seo.robots', 'index, follow') }}">
    <link rel="canonical" href="{{ config('app.seo.canonical_url', url()->current()) }}"

    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og_title', config('app.seo.og_title', 'OWEW - Ensemble pour un Avenir Meilleur'))">
    <meta property="og:description" content="@yield('og_description', config('app.seo.og_description', 'Rejoignez notre mission humanitaire pour aider les plus vulnérables.'))">
    <meta property="og:image" content="@yield('og_image', config('app.seo.og_image', asset('images/og-image.jpg')))">
    <meta property="og:locale" content="{{ app()->getLocale() == 'fr' ? 'fr_FR' : 'en_US' }}">
    <meta property="og:site_name" content="{{ config('app.name', 'OWEW') }}">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="@yield('twitter_title', 'OWEW - Organisation Humanitaire')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Soutenez notre action pour les veuves et orphelins.')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('images/og-image.jpg'))">

    {{-- Theme Color --}}
    <meta name="theme-color" content="#4B0082">
    <meta name="msapplication-TileColor" content="#4B0082">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    {{-- Favicons --}}
    @include('partials.favicons')

    {{-- Google Analytics (si configuré) --}}
    @if(config('services.google_analytics.tracking_id'))
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.google_analytics.tracking_id') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ config('services.google_analytics.tracking_id') }}');
    </script>
    @endif

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">

    @stack('styles')
</head>
<body>

    <!-- NAVBAR -->
    @include('partials.navbar')

    <!-- MAIN CONTENT -->
    @yield('content')

    <!-- FOOTER -->
    @include('partials.footer')

    <!-- Back to Top Button -->
    <button id="backToTop" style="position: fixed; bottom: 30px; right: 30px; width: 50px; height: 50px; border-radius: 50%; background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); color: white; border: none; display: none; cursor: pointer; box-shadow: 0 5px 15px rgba(0,0,0,0.3); z-index: 1000; transition: all 0.3s ease;">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>


    @stack('scripts')
</body>
</html>
