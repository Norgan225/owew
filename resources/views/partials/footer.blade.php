<footer class="footer">
        <div class="container">
            <div class="footer-content">
                <!-- About Column -->
                <div>
                    <div class="footer-logo">
                        <img src="{{ asset('frontend/img/logos/logo.png') }}" alt="OWEW">
                        <h3 class="footer-title">{{ setting('site_name_fr', 'OWEW') }}</h3>
                    </div>

                    <p class="footer-about">
                        {{ setting('site_description_fr', 'Organization, Widows, Exceptional Women...') }}
                    </p>

                    <div class="social-links">
                        @if(setting('social_facebook'))
                        <a href="{{ setting('social_facebook') }}" class="social-link" target="_blank">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        @endif

                        @if(setting('social_twitter'))
                        <a href="{{ setting('social_twitter') }}" class="social-link" target="_blank">
                            <i class="fab fa-twitter"></i>
                        </a>
                        @endif

                        @if(setting('social_instagram'))
                        <a href="{{ setting('social_instagram') }}" class="social-link" target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                        @endif

                        @if(setting('social_linkedin'))
                        <a href="{{ setting('social_linkedin') }}" class="social-link" target="_blank">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        @endif

                        @if(setting('social_youtube'))
                        <a href="{{ setting('social_youtube') }}" class="social-link" target="_blank">
                            <i class="fab fa-youtube"></i>
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="footer-title">{{ app()->getLocale() == 'en' ? 'Quick Links' : 'Liens Rapides' }}</h4>
                    <ul class="footer-links">
                        <li><a href="/a-propos">{{ app()->getLocale() == 'en' ? 'About' : 'À Propos' }}</a></li>
                        <li><a href="/notre-mission">{{ app()->getLocale() == 'en' ? 'Our Mission' : 'Notre Mission' }}</a></li>
                        <li><a href="/projets">{{ app()->getLocale() == 'en' ? 'Projects' : 'Nos Projets' }}</a></li>
                        <li><a href="/galerie">{{ app()->getLocale() == 'en' ? 'Gallery' : 'Galerie' }}</a></li>
                        <li><a href="/blog">{{ app()->getLocale() == 'en' ? 'Blog' : 'Blog' }}</a></li>
                    </ul>
                </div>

                <!-- Get Involved -->
                <div>
                    <h4 class="footer-title">{{ app()->getLocale() == 'en' ? 'Get Involved' : 'S\'engager' }}</h4>
                    <ul class="footer-links">
                        <li><a href="/faire-un-don">{{ app()->getLocale() == 'en' ? 'Make a Donation' : 'Faire un Don' }}</a></li>
                        <li><a href="/devenir-benevole">{{ app()->getLocale() == 'en' ? 'Become a Volunteer' : 'Devenir Bénévole' }}</a></li>
                        <li><a href="/devenir-partenaire">{{ app()->getLocale() == 'en' ? 'Become a Partner' : 'Devenir Partenaire' }}</a></li>
                        <li><a href="/organiser-collecte">{{ app()->getLocale() == 'en' ? 'Organize a Fundraiser' : 'Organiser une Collecte' }}</a></li>
                        <li><a href="/contact">{{ app()->getLocale() == 'en' ? 'Contact Us' : 'Contactez-nous' }}</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="footer-title">{{ app()->getLocale() == 'en' ? 'Contact' : 'Contact' }}</h4>
                    <ul class="footer-links">
                        <li>
                            <i class="fas fa-map-marker-alt me-2"></i>
                            {{ setting('contact_address_fr', 'Abidjan, Côte d\'Ivoire') }}
                        </li>
                        <li>
                            <i class="fas fa-phone me-2"></i>
                            {{ setting('contact_phone', '+225 XX XX XX XX XX') }}
                        </li>
                        <li>
                            <i class="fas fa-envelope me-2"></i>
                            {{ setting('contact_email', 'contact@owew.org') }}
                        </li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2025 OWEW. {{ app()->getLocale() == 'en' ? 'All rights reserved.' : 'Tous droits réservés.' }} |
                    <a href="/mentions-legales" style="color: rgba(255,255,255,0.6); text-decoration: none;">{{ app()->getLocale() == 'en' ? 'Legal Notice' : 'Mentions Légales' }}</a> |
                    <a href="/politique-confidentialite" style="color: rgba(255,255,255,0.6); text-decoration: none;">{{ app()->getLocale() == 'en' ? 'Privacy Policy' : 'Politique de Confidentialité' }}</a>
                </p>
            </div>
        </div>
</footer>
