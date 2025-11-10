@extends('layouts.base')

@section('title', 'Accueil - OWEW')


@section('content')
    <!-- HERO SECTION -->
    <section class="hero-section">
        <div class="hero-pattern"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <h1 class="hero-title">
                            {{ app()->getLocale() == 'en' ? 'Together for a' : 'Ensemble pour un' }}
                            <span class="highlight">{{ app()->getLocale() == 'en' ? 'Better Future' : 'Avenir Meilleur' }}</span>
                        </h1>
                        <p class="hero-subtitle">
                            {{ app()->getLocale() == 'en' ? 'Help us bring hope to widows, orphans and people in need. Every gesture counts to transform lives.' : 'Aidez-nous à apporter de l\'espoir aux veuves, aux orphelins et aux personnes dans le besoin. Chaque geste compte pour transformer des vies.' }}
                        </p>
                        <div class="hero-buttons">
                            @if(setting('enable_donations') == '1')
                                <a href="{{ route('donate.index') }}" class="btn btn-hero-primary">
                                    <i class="fas fa-heart me-2"></i> {{ app()->getLocale() == 'en' ? 'Make a Donation' : 'Faire un Don' }}
                                </a>
                            @endif
                            @if(setting('enable_volunteers') == '1')
                                <a href="{{ route('volunteer') }}" class="btn btn-hero-secondary">
                                    <i class="fas fa-hands-helping"></i> {{ app()->getLocale() == 'en' ? 'Become a Volunteer' : 'Devenir Bénévole' }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image" data-aos="fade-left">
                        <img src="{{ asset('frontend/img/hero.jpg') }}"
                             alt="{{ app()->getLocale() == 'en' ? 'Humanitarian Aid' : 'Aide humanitaire' }}" class="img-fluid">
                        <div class="floating-hearts">
                            <i class="fas fa-heart heart" style="top: 10%; left: 20%; font-size: 2rem;"></i>
                            <i class="fas fa-heart heart" style="top: 60%; left: 70%; font-size: 1.5rem; animation-delay: 2s;"></i>
                            <i class="fas fa-heart heart" style="top: 80%; left: 30%; font-size: 1.8rem; animation-delay: 4s;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- STATS SECTION -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="0">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-users"></i></div>
                        <div class="stat-number">15,000+</div>
                        <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Beneficiaries' : 'Bénéficiaires' }}</div>
                    </div>
                </div>
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-project-diagram"></i></div>
                        <div class="stat-number">250+</div>
                        <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Projects Completed' : 'Projets Réalisés' }}</div>
                    </div>
                </div>
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-hand-holding-usd"></i></div>
                        <div class="stat-number">5M+</div>
                        <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Donations Collected' : 'Dons Collectés' }}</div>
                    </div>
                </div>
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-hands-helping"></i></div>
                        <div class="stat-number">500+</div>
                        <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Volunteers' : 'Bénévoles' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ABOUT SECTION -->
    <section class="about-section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title">{{ app()->getLocale() == 'en' ? 'Who Are We?' : 'Qui Sommes-Nous ?' }}</h2>
                <p class="section-subtitle">{{ app()->getLocale() == 'en' ? 'An NGO dedicated to the well-being of the most vulnerable' : 'Une ONG dédiée au bien-être des plus vulnérables' }}</p>
            </div>

            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <img src="https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=600&h=400&fit=crop"
                         alt="Notre Mission" class="img-fluid rounded">
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="about-text">
                        <p>
                            <strong>OWEW</strong> {{ app()->getLocale() == 'en' ? '(Orphan, Widows, Exceptional Women) is a non-governmental organization dedicated to improving the living conditions of widows, orphans, elderly people and all those in need.' : '(Orphan, Widows, Exceptional Women) est une organisation non gouvernementale dédiée à l\'amélioration des conditions de vie des veuves, des orphelins, des personnes âgées et de tous ceux qui sont dans le besoin.' }}
                        </p>
                        <p>
                            {{ app()->getLocale() == 'en' ? 'Since our creation, we have touched thousands of lives through our assistance, education and community development programs.' : 'Depuis notre création, nous avons touché des milliers de vies à travers nos programmes d\'assistance, d\'éducation et de développement communautaire.' }}
                        </p>

                        <div class="about-features">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-heart"></i>
                                </div>
                                <div>
                                    <h5>{{ app()->getLocale() == 'en' ? 'Compassion' : 'Compassion' }}</h5>
                                    <p class="mb-0">{{ app()->getLocale() == 'en' ? 'At the heart of everything' : 'Au cœur de tout' }}</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-balance-scale"></i>
                                </div>
                                <div>
                                    <h5>{{ app()->getLocale() == 'en' ? 'Transparency' : 'Transparence' }}</h5>
                                    <p class="mb-0">{{ app()->getLocale() == 'en' ? '100% traceable' : '100% traceable' }}</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div>
                                    <h5>{{ app()->getLocale() == 'en' ? 'Community' : 'Communauté' }}</h5>
                                    <p class="mb-0">{{ app()->getLocale() == 'en' ? 'Together, stronger' : 'Ensemble, plus forts' }}</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                <div>
                                    <h5>{{ app()->getLocale() == 'en' ? 'Excellence' : 'Excellence' }}</h5>
                                    <p class="mb-0">{{ app()->getLocale() == 'en' ? 'Quality service' : 'Service de qualité' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PROJECTS SECTION -->
    <section class="projects-section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title">{{ app()->getLocale() == 'en' ? 'Our Ongoing Projects' : 'Nos Projets en Cours' }}</h2>
                <p class="section-subtitle">{{ app()->getLocale() == 'en' ? 'Support the causes that matter to you' : 'Soutenez les causes qui vous tiennent à cœur' }}</p>
            </div>

            @if($featuredProjects->count() > 0)
            <div class="row g-4">
                @foreach($featuredProjects->take(3) as $project)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="project-card">
                        <div class="project-image">
                       @if($project->images->first())
                          <img src="{{ asset('storage/' . $project->images->first()->image_path) }}"
                              alt="{{ localized_field($project, 'title') }}"
                              style="width: 100%; height: 250px; object-fit: cover;">
                            @else
                          <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=500&h=300&fit=crop"
                              alt="{{ localized_field($project, 'title') }}">
                            @endif
                            @if($project->featured)
                                <span class="project-badge" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">{{ app()->getLocale() == 'en' ? 'Featured' : 'En vedette' }}</span>
                            @elseif($project->status === 'active')
                                <span class="project-badge">{{ app()->getLocale() == 'en' ? 'Ongoing' : 'En cours' }}</span>
                            @elseif($project->status === 'completed')
                                <span class="project-badge" style="background: #10b981;">{{ app()->getLocale() == 'en' ? 'Completed' : 'Complété' }}</span>
                            @endif
                        </div>
                        <div class="project-content">
                            <h3 class="project-title">{{ Str::limit(localized_field($project, 'title'), 50) }}</h3>
                            <p class="project-description">
                                {{ Str::limit(localized_field($project, 'description'), 120) }}
                            </p>
                            <div class="progress-wrapper">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $project->progress_percentage }}%"></div>
                                </div>
                                <div class="project-stats mt-3">
                                    <div class="project-stat">
                                        <div class="project-stat-value">{{ number_format($project->raised_amount / 1000000, 1) }}M</div>
                                                    <div class="project-stat-label">{{ app()->getLocale() == 'en' ? 'Raised' : 'Collecté' }}</div>
                                    </div>
                                    <div class="project-stat">
                                        <div class="project-stat-value">{{ number_format($project->progress_percentage, 0) }}%</div>
                                        <div class="project-stat-label">{{ app()->getLocale() == 'en' ? 'Progress' : 'Progression' }}</div>
                                    </div>
                                    <div class="project-stat">
                                        <div class="project-stat-value">{{ number_format($project->goal_amount / 1000000, 1) }}M</div>
                                        <div class="project-stat-label">{{ app()->getLocale() == 'en' ? 'Goal' : 'Objectif' }}</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('projects.show', $project->slug) }}" class="btn btn-hero-primary w-100 mt-3">
                                <i class="fas fa-heart me-2"></i>{{ app()->getLocale() == 'en' ? 'Support this Project' : 'Soutenir ce Projet' }}
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <!-- Aucun projet disponible -->
            <div class="text-center py-5">
                <i class="fas fa-project-diagram fa-3x text-muted mb-3"></i>
                <h3 class="text-muted">{{ app()->getLocale() == 'en' ? 'No Current Projects' : 'Aucun Projet Actuellement' }}</h3>
                <p class="text-muted">{{ app()->getLocale() == 'en' ? 'We are currently working on new projects. Stay tuned!' : 'Nous travaillons actuellement sur de nouveaux projets. Restez à l\'écoute !' }}</p>
            </div>
            @endif

            <div class="text-center mt-5" data-aos="fade-up">
                <a href="{{ route('projects.index') }}" class="btn btn-hero-primary">
                    {{ app()->getLocale() == 'en' ? 'View All Projects' : 'Voir Tous les Projets' }} <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- TESTIMONIALS SECTION -->
    <section class="testimonials-section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title">{{ app()->getLocale() == 'en' ? 'Testimonials' : 'Témoignages' }}</h2>
                <p class="section-subtitle">{{ app()->getLocale() == 'en' ? 'What the people we help say' : 'Ce que disent les personnes que nous aidons' }}</p>
            </div>

            @if($testimonials->count() > 0)
                <div class="row g-4">
                    @foreach($testimonials as $index => $testimonial)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="testimonial-card">
                            <i class="fas fa-quote-right quote-icon"></i>
                            <div class="testimonial-text">
                                "{{ localized_field($testimonial, 'content') }}"
                            </div>
                            <div class="testimonial-author">
                                <div class="author-image">
                                    @if($testimonial->image)
                                        <img src="{{ asset('storage/' . $testimonial->image) }}" alt="{{ $testimonial->name }}">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($testimonial->name) }}&background=4B0082&color=fff&size=100" alt="{{ $testimonial->name }}">
                                    @endif
                                </div>
                                <div class="author-info">
                                    <h5>{{ $testimonial->name }}</h5>
                                    <p>{{ localized_field($testimonial, 'role') }}</p>
                                    @if($testimonial->rating)
                                        <div class="rating">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $testimonial->rating)
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                    <p class="text-muted">{{ app()->getLocale() == 'en' ? 'No testimonials available at the moment.' : 'Aucun témoignage disponible pour le moment.' }}</p>
                </div>
            @endif
        </div>
    </section>

    <!-- NEWSLETTER SECTION -->
    @if(setting('enable_newsletter') == '1')
    <section class="newsletter-section" style="background: linear-gradient(135deg, var(--primary), #6a1b9a); padding: 5rem 0; color: white;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                    <div class="newsletter-content">
                        <div class="d-flex align-items-center mb-3">
                            <div class="newsletter-icon me-3">
                                <i class="fas fa-envelope-open-text fa-3x" style="color: var(--secondary);"></i>
                            </div>
                            <div>
                                <h2 class="mb-0 text-white">{{ app()->getLocale() == 'en' ? 'Stay Informed' : 'Restez Informé' }}</h2>
                                <p class="mb-0" style="color: rgba(255,255,255,0.8);">{{ app()->getLocale() == 'en' ? 'Receive our latest updates' : 'Recevez nos dernières actualités' }}</p>
                            </div>
                        </div>
                        <p class="lead" style="color: rgba(255,255,255,0.9);">
                            {{ app()->getLocale() == 'en' ? 'Subscribe to our newsletter to receive updates on our projects, events and the impact of your donations.' : 'Inscrivez-vous à notre newsletter pour recevoir des mises à jour sur nos projets, nos événements et l\'impact de vos dons.' }}
                        </p>
                        <div class="newsletter-benefits mt-4">
                            <div class="benefit-item mb-2 d-flex align-items-center">
                                <i class="fas fa-check-circle me-2" style="color: var(--secondary); font-size: 1.2rem;"></i>
                                <span style="color: white;">{{ app()->getLocale() == 'en' ? 'Exclusive news about our actions' : 'Actualités exclusives sur nos actions' }}</span>
                            </div>
                            <div class="benefit-item mb-2 d-flex align-items-center">
                                <i class="fas fa-check-circle me-2" style="color: var(--secondary); font-size: 1.2rem;"></i>
                                <span style="color: white;">{{ app()->getLocale() == 'en' ? 'Inspiring stories from our beneficiaries' : 'Histoires inspirantes de nos bénéficiaires' }}</span>
                            </div>
                            <div class="benefit-item d-flex align-items-center">
                                <i class="fas fa-check-circle me-2" style="color: var(--secondary); font-size: 1.2rem;"></i>
                                <span style="color: white;">{{ app()->getLocale() == 'en' ? 'Invitations to our special events' : 'Invitations à nos événements spéciaux' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-left">
                    <div class="newsletter-form-wrapper p-4" style="background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border-radius: 20px; border: 2px solid rgba(255,255,255,0.3);">
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="background: #10b981; color: white; border: none;">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                        </div>
                        @endif

                        @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="background: #ef4444; color: white; border: none;">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                        </div>
                        @endif

                        <form action="{{ route('newsletter.subscribe') }}" method="POST" class="newsletter-form">
                            @csrf
                            <div class="mb-3">
                                <label for="newsletter_name" class="form-label fw-semibold text-white">
                                    <i class="fas fa-user me-2"></i>{{ app()->getLocale() == 'en' ? 'Your Name (optional)' : 'Votre Nom (optionnel)' }}
                                </label>
                                <input type="text" class="form-control form-control-lg" id="newsletter_name" name="name"
                                    placeholder="{{ app()->getLocale() == 'en' ? 'Ex: Marie Kouadio' : 'Ex: Marie Kouadio' }}"
                                    style="background: white; border: 2px solid rgba(255,255,255,0.3); color: #333;">
                            </div>

                            <div class="mb-3">
                                <label for="newsletter_email" class="form-label fw-semibold text-white">
                                    <i class="fas fa-envelope me-2"></i>{{ app()->getLocale() == 'en' ? 'Email Address' : 'Adresse Email' }} <span style="color: var(--secondary);">*</span>
                                </label>
                                <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                                    id="newsletter_email" name="email" required
                                    placeholder="{{ app()->getLocale() == 'en' ? 'your.email@example.com' : 'votre.email@exemple.com' }}"
                                    style="background: white; border: 2px solid rgba(255,255,255,0.3); color: #333;">
                                @error('email')
                                <div class="invalid-feedback" style="color: #fca5a5;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="newsletter_consent" required
                                    style="border: 2px solid white;">
                                <label class="form-check-label small text-white" for="newsletter_consent">
                                    {{ app()->getLocale() == 'en' ? 'I accept to receive emails from' : 'J\'accepte de recevoir des emails de' }} {{ setting('site_name_fr', 'OWEW') }} {{ app()->getLocale() == 'en' ? 'and I can unsubscribe at any time.' : 'et je peux me désabonner à tout moment.' }}
                                </label>
                            </div>

                            <button type="submit" class="btn btn-lg w-100"
                                    style="background: var(--secondary); color: white; font-weight: 600; border: none; padding: 1rem; border-radius: 12px; transition: all 0.3s ease;"
                                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(255,152,0,0.4)';"
                                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                                <i class="fas fa-paper-plane me-2"></i>{{ app()->getLocale() == 'en' ? 'Subscribe to Newsletter' : 'S\'inscrire à la Newsletter' }}
                            </button>

                            <p class="text-center mt-3 mb-0 small" style="color: rgba(255,255,255,0.8);">
                                <i class="fas fa-lock me-1"></i>
                                {{ app()->getLocale() == 'en' ? 'Your data is protected. No spam.' : 'Vos données sont protégées. Pas de spam.' }}
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- CTA SECTION -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content" data-aos="zoom-in">
                <h2 class="cta-title">{{ app()->getLocale() == 'en' ? 'Join Us in Our Mission' : 'Rejoignez-Nous dans Notre Mission' }}</h2>
                <p class="cta-text">
                    {{ app()->getLocale() == 'en' ? 'Together, we can make a difference and bring hope to those who need it most.' : 'Ensemble, nous pouvons faire la différence et apporter de l\'espoir à ceux qui en ont le plus besoin.' }}
                </p>
                <div class="hero-buttons justify-content-center">
                    @if(setting('enable_donations') == '1')
                        <a href="{{ route('donate.index') }}" class="btn btn-hero-primary">
                            <i class="fas fa-heart me-2"></i> {{ app()->getLocale() == 'en' ? 'Make a Donation Now' : 'Faire un Don Maintenant' }}
                        </a>
                    @endif
                    <a href="/devenir-partenaire" class="btn btn-hero-secondary">
                        <i class="fas fa-hands-helping me-2"></i>{{ app()->getLocale() == 'en' ? 'Become a Partner' : 'Devenir Partenaire' }}
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection
