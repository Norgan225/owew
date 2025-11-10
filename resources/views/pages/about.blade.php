@extends('layouts.base')

@section('title', 'A propos de nous - OWEW')


@section('content')

    <!-- Hero Section -->
    <section class="page-hero" style="background: linear-gradient(135deg, #4B0082, #6a1b9a); padding: 6rem 0 4rem; color: white;">
        <div class="container text-center">
            <h1 class="display-3 fw-bold mb-3" data-aos="fade-up">{{ app()->getLocale() == 'en' ? 'About OWEW' : 'À Propos de OWEW' }}</h1>
            <p class="lead" data-aos="fade-up" data-aos-delay="100">Orphan, Widows, Exceptional Women</p>
            <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                <ol class="breadcrumb justify-content-center" style="background: transparent;">
                    <li class="breadcrumb-item"><a href="/" style="color: #FF9800;">{{ translate('home') }}</a></li>
                    <li class="breadcrumb-item active text-white">{{ translate('about') }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Notre Histoire -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <h2 class="display-5 fw-bold text-primary mb-4">{{ app()->getLocale() == 'en' ? 'Our Story' : 'Notre Histoire' }}</h2>
                    <p class="lead text-muted mb-4">
                        {{ app()->getLocale() == 'en'
                            ? 'OWEW was born from a simple vision: to create a world where every widow, orphan and abused woman can live with dignity.'
                            : 'OWEW est née d\'une vision simple : créer un monde où chaque veuve, orphelin et femme abusée peut vivre dans la dignité.' }}
                    </p>
                    <p class="mb-4">
                        {{ app()->getLocale() == 'en'
                            ? 'We have already impacted several neighborhoods in Côte d\'Ivoire: Angré, Bengerville, Yopougon, Songon, Marcory... with our limited means but great determination.'
                            : 'Nous avons déjà impacté plusieurs quartiers de la Côte d\'Ivoire : Angré, Bengerville, Yopougon, Songon, Marcory… et ce, avec nos faibles moyens mais une grande détermination.' }}
                    </p>
                    <p class="mb-4">
                        {{ app()->getLocale() == 'en'
                            ? 'Our desire is to extend this vision throughout the world. We are looking for partners and supporters to help us achieve this mission.'
                            : 'Notre désir est d\'étendre cette vision partout dans le monde entier. Nous cherchons des partenaires et des soutiens pour nous aider à réaliser cette mission.' }}
                    </p>
                    <p class="fw-bold text-success mb-4">
                        {{ app()->getLocale() == 'en' ? 'May God bless you.' : 'Que Dieu vous bénisse.' }}
                    </p>
                    <div class="d-flex gap-3">
                        <div class="text-center">
                            <div class="display-4 fw-bold text-primary">15K+</div>
                            <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Beneficiaries' : 'Bénéficiaires' }}</small>
                        </div>
                        <div class="text-center">
                            <div class="display-4 fw-bold text-warning">250+</div>
                            <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Projects' : 'Projets' }}</small>
                        </div>
                        <div class="text-center">
                            <div class="display-4 fw-bold text-success">500+</div>
                            <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Volunteers' : 'Bénévoles' }}</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <video class="img-fluid rounded shadow-lg" autoplay muted loop playsinline poster="{{ asset('frontend/img/logo.png') }}">
                        <source src="{{ asset('frontend/video/notre_histoire.mp4') }}" type="video/mp4">
                        Votre navigateur ne prend pas en charge la vidéo.
                    </video>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission, Vision, Valeurs -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-5">
                            <div class="mb-4">
                                <i class="fas fa-bullseye fa-4x text-primary"></i>
                            </div>
                            <h3 class="card-title fw-bold mb-3">{{ app()->getLocale() == 'en' ? 'Our Mission' : 'Notre Mission' }}</h3>
                            <p class="card-text text-muted">
                                {{ app()->getLocale() == 'en'
                                    ? 'Improve the living conditions of widows, orphans and the elderly by providing them with material, educational and psychological support.'
                                    : 'Améliorer les conditions de vie des veuves, orphelins et personnes âgées en leur offrant un soutien matériel, éducatif et psychologique.' }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-5">
                            <div class="mb-4">
                                <i class="fas fa-eye fa-4x text-warning"></i>
                            </div>
                            <h3 class="card-title fw-bold mb-3">{{ app()->getLocale() == 'en' ? 'Our Vision' : 'Notre Vision' }}</h3>
                            <p class="card-text text-muted">
                                {{ app()->getLocale() == 'en'
                                    ? 'A world where every vulnerable individual has access to the resources they need to live with dignity and thrive.'
                                    : 'Un monde où chaque individu vulnérable a accès aux ressources nécessaires pour vivre dignement et s\'épanouir pleinement.' }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-5">
                            <div class="mb-4">
                                <i class="fas fa-heart fa-4x text-danger"></i>
                            </div>
                            <h3 class="card-title fw-bold mb-3">{{ app()->getLocale() == 'en' ? 'Our Values' : 'Nos Valeurs' }}</h3>
                            <p class="card-text text-muted">
                                {{ app()->getLocale() == 'en'
                                    ? 'Compassion, integrity, transparency, respect for human dignity and commitment to excellence in everything we do.'
                                    : 'Compassion, intégrité, transparence, respect de la dignité humaine et engagement envers l\'excellence dans tout ce que nous faisons.' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-md-5 text-center" data-aos="fade-right">
                    <img src="{{ asset('frontend/img/profil_funder.jpeg') }}" alt="Anick C. Thomas" class="rounded-circle shadow" style="width: 180px; height: 180px; object-fit: cover;">
                    <h4 class="fw-bold mt-3 mb-1">Evangelist Anick C. Thomas</h4>
                    <p class="text-muted mb-0">{{ app()->getLocale() == 'en' ? 'Founder & President' : 'Fondatrice & Présidente' }}</p>
                    <div class="mt-3">
                        <a href="tel:+2250759755625" class="btn btn-outline-primary rounded-pill me-2">
                            <i class="fas fa-phone"></i> +2250759755625
                        </a>
                        <a href="tel:7814261557" class="btn btn-outline-secondary rounded-pill">
                            <i class="fas fa-phone"></i> 781 4261557
                        </a>
                    </div>
                </div>
                <div class="col-md-7" data-aos="fade-left">
                    <h3 class="fw-bold mb-3 text-primary">{{ app()->getLocale() == 'en' ? 'About the Founder' : 'À propos de la Fondatrice' }}</h3>
                    <div class="lead" style="white-space: pre-line;">
                        {{ app()->getLocale() == 'en'
                            ? 'I am of Ivorian origin
Who has lived in the United States for several years
I am married and mother of 5 children
I received this vision since 2023,
God called me to take care of orphans, widows and abused women'
                            : 'Je suis d\'origine Ivoirienne
Qui reside aux Etats Unis depius plusieur année
Je suis marrié et mére de 5 enfants
J\'ai reçu cette vision depuis 2023 ,
Dieu ma apellé a m\' occupé des orphelin , les veuves et les femmes abuisé' }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Notre Équipe -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="display-5 fw-bold text-primary mb-3">{{ app()->getLocale() == 'en' ? 'Our Team' : 'Notre Équipe' }}</h2>
                <p class="lead text-muted">{{ app()->getLocale() == 'en' ? 'Passionate people serving a noble cause' : 'Des personnes passionnées au service d\'une noble cause' }}</p>
            </div>
            <div class="row g-4">
                <div class="col-md-3" data-aos="fade-up">
                    <div class="card border-0 shadow-sm text-center">
                        <div class="card-body p-4">
                            <img src="{{ asset('frontend/img/co-owner.jpg') }}" alt="R. Thomas" class="rounded-circle shadow" style="width: 180px; height: 180px; object-fit: cover;">
                            <h5 class="fw-bold mb-1">Pasteur. R. Thomas</h5>
                            <p class="text-muted small mb-2">{{ app()->getLocale() == 'en' ? 'Co-Founder' : 'Co-Fondateur' }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="card border-0 shadow-sm text-center">
                        <div class="card-body p-4">
                            <img src="{{ asset('frontend/img/secretariat.jpg') }}" alt="Zokora Blega Arnaud" class="rounded-circle shadow" style="width: 180px; height: 180px; object-fit: cover;">
                            <h5 class="fw-bold mb-1">Zokora Blega Arnaud</h5>
                            <p class="text-muted small mb-2">{{ app()->getLocale() == 'en' ? 'General Secretary' : 'Sécrétaire Général' }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="card border-0 shadow-sm text-center">
                        <div class="card-body p-4">
                            <img src="{{ asset('frontend/img/tresoriere.jpg') }}" alt="Koffi Lida Chantal" class="rounded-circle shadow" style="width: 180px; height: 180px; object-fit: cover;">
                            <h5 class="fw-bold mb-1">Koffi Lida Chantal</h5>
                            <p class="text-muted small mb-2">{{ app()->getLocale() == 'en' ? 'General Treasurer' : 'Trésorière Générale' }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="card border-0 shadow-sm text-center">
                        <div class="card-body p-4">
                            <img src="{{ asset('frontend/img/advisor.jpg') }}" alt="Théophile Omer Beugré" class="rounded-circle shadow" style="width: 180px; height: 180px; object-fit: cover;">
                            <h5 class="fw-bold mb-1">Théophile Omer Beugré</h5>
                            <p class="text-muted small mb-2">{{ app()->getLocale() == 'en' ? 'General Advisor' : 'Conseiller Générale' }}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
