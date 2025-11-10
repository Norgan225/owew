<nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('frontend/img/logos/logo.png') }}" alt="OWEW Logo" height="30">
                <span>OWEW</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">{{ app()->getLocale() == 'en' ? 'Home' : 'Accueil' }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('a-propos') ? 'active' : '' }}" href="/a-propos">{{ app()->getLocale() == 'en' ? 'About' : 'À Propos' }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('projets') ? 'active' : '' }}" href="/projets">{{ app()->getLocale() == 'en' ? 'Projects' : 'Nos Projets' }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('galerie') ? 'active' : '' }}" href="/galerie">{{ app()->getLocale() == 'en' ? 'Gallery' : 'Galerie' }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('contact') ? 'active' : '' }}" href="/contact">{{ app()->getLocale() == 'en' ? 'Contact' : 'Contact' }}</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-3">
                    <div class="lang-switcher">
                        <a href="{{ route('lang.switch', 'fr') }}" class="lang-btn {{ app()->getLocale() == 'fr' ? 'active' : '' }}">FR</a>
                        <a href="{{ route('lang.switch', 'en') }}" class="lang-btn {{ app()->getLocale() == 'en' ? 'active' : '' }}">EN</a>
                    </div>
                    @if(setting('enable_donations') == '1')
                        <a href="{{ route('donate.index') }}" class="btn btn-donate">
                            <i class="fas fa-heart me-2"></i> {{ app()->getLocale() == 'en' ? 'Donate' : 'Faire un Don' }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
</nav>
