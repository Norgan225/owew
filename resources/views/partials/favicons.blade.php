{{-- Favicon Configuration for OWEW --}}
{{-- Place your favicon files in public/favicons/ directory --}}

{{-- Standard Favicon --}}
<link rel="icon" type="image/x-icon" href="{{ asset('favicons/favicon.ico') }}">
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicons/favicon.ico') }}">

{{-- PNG Favicons for different sizes --}}
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">
<link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicons/favicon-192x192.png') }}">

{{-- Apple Touch Icons --}}
<link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-touch-icon-57x57.png') }}">
<link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-touch-icon-60x60.png') }}">
<link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-touch-icon-72x72.png') }}">
<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-touch-icon-76x76.png') }}">
<link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-touch-icon-114x114.png') }}">
<link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/apple-touch-icon-120x120.png') }}">
<link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-touch-icon-144x144.png') }}">
<link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/apple-touch-icon-152x152.png') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-touch-icon-180x180.png') }}">
<link rel="apple-touch-icon" href="{{ asset('favicons/apple-touch-icon.png') }}">

{{-- Android/Chrome Favicons --}}
<link rel="icon" type="image/png" sizes="36x36" href="{{ asset('favicons/android-chrome-36x36.png') }}">
<link rel="icon" type="image/png" sizes="48x48" href="{{ asset('favicons/android-chrome-48x48.png') }}">
<link rel="icon" type="image/png" sizes="72x72" href="{{ asset('favicons/android-chrome-72x72.png') }}">
<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/android-chrome-96x96.png') }}">
<link rel="icon" type="image/png" sizes="128x128" href="{{ asset('favicons/android-chrome-128x128.png') }}">
<link rel="icon" type="image/png" sizes="144x144" href="{{ asset('favicons/android-chrome-144x144.png') }}">
<link rel="icon" type="image/png" sizes="152x152" href="{{ asset('favicons/android-chrome-152x152.png') }}">
<link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicons/android-chrome-192x192.png') }}">
<link rel="icon" type="image/png" sizes="256x256" href="{{ asset('favicons/android-chrome-256x256.png') }}">
<link rel="icon" type="image/png" sizes="384x384" href="{{ asset('favicons/android-chrome-384x384.png') }}">
<link rel="icon" type="image/png" sizes="512x512" href="{{ asset('favicons/android-chrome-512x512.png') }}">

{{-- Windows Metro Tiles --}}
<meta name="msapplication-TileColor" content="#4B0082">
<meta name="msapplication-TileImage" content="{{ asset('favicons/mstile-144x144.png') }}">
<meta name="msapplication-square70x70logo" content="{{ asset('favicons/mstile-70x70.png') }}">
<meta name="msapplication-square150x150logo" content="{{ asset('favicons/mstile-150x150.png') }}">
<meta name="msapplication-wide310x150logo" content="{{ asset('favicons/mstile-310x150.png') }}">
<meta name="msapplication-square310x310logo" content="{{ asset('favicons/mstile-310x310.png') }}">

{{-- Safari Pinned Tab --}}
<link rel="mask-icon" href="{{ asset('favicons/safari-pinned-tab.svg') }}" color="#4B0082">

{{-- Theme Color for Mobile Browsers --}}
<meta name="theme-color" content="#4B0082">
<meta name="msapplication-navbutton-color" content="#4B0082">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

{{-- Web App Manifest --}}
<link rel="manifest" href="{{ asset('favicons/site.webmanifest') }}">

{{-- Open Graph Images (for social sharing) --}}
<meta property="og:image" content="{{ asset('favicons/og-image.jpg') }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
