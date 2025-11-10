@extends('layouts.base')

@section('title', app()->getLocale() == 'en' ? 'Organize a Fundraiser - OWEW' : 'Organisation de collecte - OWEW')

@section('content')

<!-- Hero Section -->
<section class="page-hero" style="background: linear-gradient(135deg, #4B0082, #6a1b9a); padding: 6rem 0 4rem; color: white;">
    <div class="container text-center">
        <h1 class="display-3 fw-bold mb-3" data-aos="fade-up">{{ app()->getLocale() == 'en' ? 'Organize a Fundraiser' : 'Organiser une Collecte' }}</h1>
        <p class="lead" data-aos="fade-up" data-aos-delay="100">{{ app()->getLocale() == 'en' ? 'Mobilize your community for a cause that matters' : 'Mobilisez votre communauté pour une cause qui compte' }}</p>
        <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
            <ol class="breadcrumb justify-content-center" style="background: transparent;">
                <li class="breadcrumb-item"><a href="/" style="color: #FF9800;">{{ app()->getLocale() == 'en' ? 'Home' : 'Accueil' }}</a></li>
                <li class="breadcrumb-item active text-white">{{ app()->getLocale() == 'en' ? 'Organize a Fundraiser' : 'Organiser une Collecte' }}</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Introduction -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <img src="https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=600&h=500&fit=crop"
                     alt="Collecte" class="img-fluid rounded shadow-lg">
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <h2 class="display-5 fw-bold text-primary mb-4">{{ app()->getLocale() == 'en' ? 'Why Organize a Fundraiser?' : 'Pourquoi Organiser une Collecte ?' }}</h2>
                <p class="lead text-muted mb-4">
                    {{ app()->getLocale() == 'en' ? 'Whether for a birthday, corporate event, sports competition or simply to support a cause close to your heart, organizing a fundraiser is a powerful way to make a difference.' : 'Que ce soit pour un anniversaire, un événement d\'entreprise, une compétition sportive ou tout simplement pour soutenir une cause qui vous tient à cœur, organiser une collecte de fonds est un moyen puissant de faire la différence.' }}
                </p>
                <ul class="list-unstyled">
                    <li class="mb-3">
                        <i class="fas fa-check-circle text-success fa-lg me-2"></i>
                        <strong>{{ app()->getLocale() == 'en' ? 'Direct Impact:' : 'Impact Direct :' }}</strong> {{ app()->getLocale() == 'en' ? '100% of funds go to beneficiaries' : '100% des fonds vont aux bénéficiaires' }}
                    </li>
                    <li class="mb-3">
                        <i class="fas fa-check-circle text-success fa-lg me-2"></i>
                        <strong>{{ app()->getLocale() == 'en' ? 'Simplicity:' : 'Simplicité :' }}</strong> {{ app()->getLocale() == 'en' ? 'Create your fundraiser in minutes' : 'Créez votre collecte en quelques minutes' }}
                    </li>
                    <li class="mb-3">
                        <i class="fas fa-check-circle text-success fa-lg me-2"></i>
                        <strong>{{ app()->getLocale() == 'en' ? 'Transparency:' : 'Transparence :' }}</strong> {{ app()->getLocale() == 'en' ? 'Track donations in real time' : 'Suivez les donations en temps réel' }}
                    </li>
                    <li class="mb-3">
                        <i class="fas fa-check-circle text-success fa-lg me-2"></i>
                        <strong>{{ app()->getLocale() == 'en' ? 'Support:' : 'Support :' }}</strong> {{ app()->getLocale() == 'en' ? 'We support you throughout' : 'Nous vous accompagnons tout au long' }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Comment ça marche -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold text-primary mb-3">{{ app()->getLocale() == 'en' ? 'How Does It Work?' : 'Comment ça Marche ?' }}</h2>
            <p class="lead text-muted">{{ app()->getLocale() == 'en' ? 'In 4 simple steps' : 'En 4 étapes simples' }}</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3" data-aos="fade-up">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3"
                             style="width: 70px; height: 70px; font-size: 2rem; font-weight: bold;">
                            1
                        </div>
                        <h5 class="fw-bold mb-3">{{ app()->getLocale() == 'en' ? 'Create Your Fundraiser' : 'Créez votre Collecte' }}</h5>
                        <p class="text-muted">
                            {{ app()->getLocale() == 'en' ? 'Fill out the form, choose a goal and customize your page.' : 'Remplissez le formulaire, choisissez un objectif et personnalisez votre page.' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <div class="rounded-circle bg-warning text-white d-flex align-items-center justify-content-center mx-auto mb-3"
                             style="width: 70px; height: 70px; font-size: 2rem; font-weight: bold;">
                            2
                        </div>
                        <h5 class="fw-bold mb-3">{{ app()->getLocale() == 'en' ? 'Share' : 'Partagez' }}</h5>
                        <p class="text-muted">
                            {{ app()->getLocale() == 'en' ? 'Share your fundraiser on social networks, by email, WhatsApp, etc.' : 'Diffusez votre collecte sur les réseaux sociaux, par email, WhatsApp, etc.' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center mx-auto mb-3"
                             style="width: 70px; height: 70px; font-size: 2rem; font-weight: bold;">
                            3
                        </div>
                        <h5 class="fw-bold mb-3">{{ app()->getLocale() == 'en' ? 'Collect' : 'Collectez' }}</h5>
                        <p class="text-muted">
                            {{ app()->getLocale() == 'en' ? 'Your loved ones contribute safely and follow the progress.' : 'Vos proches contribuent en toute sécurité et suivent la progression.' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <div class="rounded-circle bg-danger text-white d-flex align-items-center justify-content-center mx-auto mb-3"
                             style="width: 70px; height: 70px; font-size: 2rem; font-weight: bold;">
                            4
                        </div>
                        <h5 class="fw-bold mb-3">{{ app()->getLocale() == 'en' ? 'Change Lives' : 'Changez des Vies' }}</h5>
                        <p class="text-muted">
                            {{ app()->getLocale() == 'en' ? 'Funds are transferred directly to OWEW beneficiaries.' : 'Les fonds sont reversés directement aux bénéficiaires d\'OWEW.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Types de Collectes -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold text-primary mb-3">{{ app()->getLocale() == 'en' ? 'Types of Fundraisers' : 'Types de Collectes' }}</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4" data-aos="fade-up">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <i class="fas fa-birthday-cake fa-3x text-primary mb-3"></i>
                        <h5 class="fw-bold mb-3">{{ app()->getLocale() == 'en' ? 'Birthday Solidarity' : 'Anniversaire Solidaire' }}</h5>
                        <p class="text-muted">
                            {{ app()->getLocale() == 'en' ? 'Transform your birthday into a solidarity fundraiser and ask your loved ones to contribute to a cause instead of gifts.' : 'Transformez votre anniversaire en collecte solidaire et demandez à vos proches de contribuer à une cause au lieu de cadeaux.' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <i class="fas fa-ring fa-3x text-danger mb-3"></i>
                        <h5 class="fw-bold mb-3">{{ app()->getLocale() == 'en' ? 'Wedding / Event' : 'Mariage / Événement' }}</h5>
                        <p class="text-muted">
                            {{ app()->getLocale() == 'en' ? 'Celebrate your wedding or event by supporting a cause and create lasting impact together.' : 'Célébrez votre mariage ou événement en soutenant une cause et créez un impact durable ensemble.' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <i class="fas fa-running fa-3x text-success mb-3"></i>
                        <h5 class="fw-bold mb-3">{{ app()->getLocale() == 'en' ? 'Sports Challenge' : 'Défi Sportif' }}</h5>
                        <p class="text-muted">
                            {{ app()->getLocale() == 'en' ? 'Marathon, hike, bike... Mobilize your sponsors for each kilometer traveled in favor of OWEW.' : 'Marathon, randonnée, vélo... Mobilisez vos sponsors pour chaque kilomètre parcouru au profit d\'OWEW.' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <i class="fas fa-building fa-3x text-warning mb-3"></i>
                        <h5 class="fw-bold mb-3">{{ app()->getLocale() == 'en' ? 'Corporate Fundraiser' : 'Collecte d\'Entreprise' }}</h5>
                        <p class="text-muted">
                            {{ app()->getLocale() == 'en' ? 'Organize a fundraiser within your company to unite your teams around a solidarity project.' : 'Organisez une collecte au sein de votre entreprise pour fédérer vos équipes autour d\'un projet solidaire.' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="400">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <i class="fas fa-graduation-cap fa-3x text-info mb-3"></i>
                        <h5 class="fw-bold mb-3">{{ app()->getLocale() == 'en' ? 'School Fundraiser' : 'Collecte Scolaire' }}</h5>
                        <p class="text-muted">
                            {{ app()->getLocale() == 'en' ? 'Schools, universities... Raise awareness among young people about solidarity by organizing a student fundraiser.' : 'Écoles, universités... Sensibilisez les jeunes à la solidarité en organisant une collecte étudiante.' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="500">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <i class="fas fa-heart fa-3x text-danger mb-3"></i>
                        <h5 class="fw-bold mb-3">{{ app()->getLocale() == 'en' ? 'In Memory' : 'En Mémoire' }}</h5>
                        <p class="text-muted">
                            {{ app()->getLocale() == 'en' ? 'Honor a loved one\'s memory by creating a fundraiser in their honor to perpetuate their commitment.' : 'Honorez la mémoire d\'un être cher en créant une collecte en son honneur pour perpétuer son engagement.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Témoignages -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold text-primary mb-3">{{ app()->getLocale() == 'en' ? 'They Organized a Fundraiser' : 'Ils ont Organisé une Collecte' }}</h2>
        </div>

        @if(isset($testimonials) && $testimonials->count() > 0)
            <div class="row g-4">
                @foreach($testimonials as $index => $testimonial)
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <i class="fas fa-quote-left text-primary fa-2x mb-3"></i>
                            <p class="text-muted mb-4">
                                "{{ app()->getLocale() == 'en' ? $testimonial->content_en : $testimonial->content_fr }}"
                            </p>
                            <div class="d-flex align-items-center">
                                @if($testimonial->image)
                                    <img src="{{ asset('storage/' . $testimonial->image) }}"
                                         class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover;" alt="{{ $testimonial->name }}">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($testimonial->name) }}&background=4B0082&color=fff&size=50"
                                         class="rounded-circle me-3" style="width: 50px; height: 50px;" alt="{{ $testimonial->name }}">
                                @endif
                                <div>
                                    <div class="fw-bold">{{ $testimonial->name }}</div>
                                    <small class="text-muted">{{ app()->getLocale() == 'en' ? $testimonial->role_en : $testimonial->role_fr }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="row g-4">
                <div class="col-md-6 col-lg-4" data-aos="fade-up">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <i class="fas fa-quote-left text-primary fa-2x mb-3"></i>
                            <p class="text-muted mb-4">
                                "{{ app()->getLocale() == 'en' ? 'For my 30th birthday, I organized a fundraiser that allowed 15 children to be educated. It was the best gift I ever received!' : 'Pour mes 30 ans, j\'ai organisé une collecte qui a permis de scolariser 15 enfants. C\'est le plus beau cadeau que j\'ai reçu !' }}"
                            </p>
                            <div class="d-flex align-items-center">
                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=50&h=50&fit=crop"
                                     class="rounded-circle me-3" style="width: 50px; height: 50px;">
                                <div>
                                    <div class="fw-bold">{{ app()->getLocale() == 'en' ? 'Kouassi Jean' : 'Kouassi Jean' }}</div>
                                    <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Birthday fundraiser - 2.5M FCFA' : 'Collecte d\'anniversaire - 2.5M FCFA' }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <i class="fas fa-quote-left text-primary fa-2x mb-3"></i>
                            <p class="text-muted mb-4">
                                "{{ app()->getLocale() == 'en' ? 'Our solidarity marathon mobilized 200 runners and allowed us to fund a medical center. An unforgettable experience!' : 'Notre marathon solidaire a mobilisé 200 coureurs et permis de financer un centre médical. Une expérience inoubliable !' }}"
                            </p>
                            <div class="d-flex align-items-center">
                                <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=50&h=50&fit=crop"
                                     class="rounded-circle me-3" style="width: 50px; height: 50px;">
                                <div>
                                    <div class="fw-bold">{{ app()->getLocale() == 'en' ? 'Marie Traoré' : 'Marie Traoré' }}</div>
                                    <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Solidarity marathon - 8M FCFA' : 'Marathon solidaire - 8M FCFA' }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <i class="fas fa-quote-left text-primary fa-2x mb-3"></i>
                            <p class="text-muted mb-4">
                                "{{ app()->getLocale() == 'en' ? 'Our wedding was the perfect day to share our happiness. Thanks to our guests, 20 families received food aid.' : 'Notre mariage était le jour parfait pour partager notre bonheur. Grâce à nos invités, 20 familles ont reçu une aide alimentaire.' }}"
                            </p>
                            <div class="d-flex align-items-center">
                                <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?w=50&h=50&fit=crop"
                                     class="rounded-circle me-3" style="width: 50px; height: 50px;">
                                <div>
                                    <div class="fw-bold">{{ app()->getLocale() == 'en' ? 'Awa & Ibrahim' : 'Awa & Ibrahim' }}</div>
                                    <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Solidarity wedding - 3M FCFA' : 'Mariage solidaire - 3M FCFA' }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Formulaire de Création de Collecte -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up">
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-5">
                        <h3 class="fw-bold text-primary mb-4 text-center">
                            <i class="fas fa-plus-circle me-2"></i>
                            {{ app()->getLocale() == 'en' ? 'Create My Fundraiser' : 'Créer Ma Collecte' }}
                        </h3>

                        <form action="/fundraise/create" method="POST">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Fundraiser Title' : 'Titre de la Collecte' }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg"
                                           placeholder="{{ app()->getLocale() == 'en' ? 'Ex: My 30th birthday fundraiser for orphans' : 'Ex: Collecte pour mes 30 ans au profit des orphelins' }}" required>
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Type of Fundraiser' : 'Type de Collecte' }} <span class="text-danger">*</span></label>
                                    <select class="form-select form-select-lg" required>
                                        <option value="">{{ app()->getLocale() == 'en' ? 'Choose...' : 'Choisir...' }}</option>
                                        <option>{{ app()->getLocale() == 'en' ? 'Birthday' : 'Anniversaire' }}</option>
                                        <option>{{ app()->getLocale() == 'en' ? 'Wedding' : 'Mariage' }}</option>
                                        <option>{{ app()->getLocale() == 'en' ? 'Sports Challenge' : 'Défi sportif' }}</option>
                                        <option>{{ app()->getLocale() == 'en' ? 'Corporate Event' : 'Événement d\'entreprise' }}</option>
                                        <option>{{ app()->getLocale() == 'en' ? 'School Fundraiser' : 'Collecte scolaire' }}</option>
                                        <option>{{ app()->getLocale() == 'en' ? 'In Memory' : 'En mémoire' }}</option>
                                        <option>{{ app()->getLocale() == 'en' ? 'Other' : 'Autre' }}</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Fundraising Goal (FCFA)' : 'Objectif de Collecte (FCFA)' }} <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control form-control-lg"
                                           placeholder="1000000" min="50000" required>
                                    <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Minimum: 50,000 FCFA' : 'Minimum: 50,000 FCFA' }}</small>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'End Date' : 'Date de Fin' }}</label>
                                    <input type="date" class="form-control form-control-lg">
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Project to Support (Optional)' : 'Projet à Soutenir (Optionnel)' }}</label>
                                    <select class="form-select form-select-lg">
                                        <option value="">{{ app()->getLocale() == 'en' ? 'General support (all projects)' : 'Soutien général (tous les projets)' }}</option>
                                        <option>{{ app()->getLocale() == 'en' ? 'Education for All' : 'Éducation pour Tous' }}</option>
                                        <option>{{ app()->getLocale() == 'en' ? 'Medical Care for Widows' : 'Soins Médicaux pour Veuves' }}</option>
                                        <option>{{ app()->getLocale() == 'en' ? 'Emergency Food Aid' : 'Aide Alimentaire d\'Urgence' }}</option>
                                        <option>{{ app()->getLocale() == 'en' ? 'Center Construction' : 'Construction d\'un Centre' }}</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Fundraiser Description' : 'Description de votre Collecte' }} <span class="text-danger">*</span></label>
                                    <textarea class="form-control" rows="5"
                                              placeholder="{{ app()->getLocale() == 'en' ? 'Share your story and why this cause matters to you...' : 'Partagez votre histoire et pourquoi cette cause vous tient à cœur...' }}" required></textarea>
                                    <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Be authentic and inspiring!' : 'Soyez authentique et inspirant !' }}</small>
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Cover Image (Optional)' : 'Image de Couverture (Optionnel)' }}</label>
                                    <input type="file" class="form-control form-control-lg" accept="image/*">
                                    <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Recommended format: 1200x630px, JPG or PNG' : 'Format recommandé: 1200x630px, JPG ou PNG' }}</small>
                                </div>

                                <hr class="my-4">

                                <h5 class="fw-bold text-primary mb-3">{{ app()->getLocale() == 'en' ? 'Your Information' : 'Vos Informations' }}</h5>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Your Name' : 'Votre Nom' }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg"
                                           placeholder="{{ app()->getLocale() == 'en' ? 'John Doe' : 'John Doe' }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Email' : 'Email' }} <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control form-control-lg"
                                           placeholder="{{ app()->getLocale() == 'en' ? 'your@email.com' : 'votre@email.com' }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Phone' : 'Téléphone' }} <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control form-control-lg"
                                           placeholder="+225 XX XX XX XX XX" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'City' : 'Ville' }}</label>
                                    <input type="text" class="form-control form-control-lg"
                                           placeholder="{{ app()->getLocale() == 'en' ? 'Abidjan' : 'Abidjan' }}">
                                </div>

                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="newsletter">
                                        <label class="form-check-label" for="newsletter">
                                            {{ app()->getLocale() == 'en' ? 'Receive tips to optimize my fundraiser' : 'Recevoir des conseils pour optimiser ma collecte' }}
                                        </label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="terms" required>
                                        <label class="form-check-label" for="terms">
                                            {{ app()->getLocale() == 'en' ? 'I accept the' : 'J\'accepte les' }} <a href="/mentions-legales" class="text-primary">{{ app()->getLocale() == 'en' ? 'terms' : 'conditions' }}</a>
                                            {{ app()->getLocale() == 'en' ? 'and commit to promoting my fundraiser' : 'et m\'engage à promouvoir ma collecte' }}
                                        </label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-lg w-100"
                                            style="background: linear-gradient(135deg, #4B0082, #FF9800); color: white; font-weight: 600; padding: 1rem;">
                                        <i class="fas fa-rocket me-2"></i>
                                        {{ app()->getLocale() == 'en' ? 'Create My Fundraiser' : 'Créer Ma Collecte' }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Info Box -->
                <div class="alert alert-info mt-4" data-aos="fade-up">
                    <div class="d-flex">
                        <i class="fas fa-info-circle fa-2x me-3"></i>
                        <div>
                            <h6 class="fw-bold mb-2">{{ app()->getLocale() == 'en' ? 'What happens next:' : 'Ce qui se passe ensuite :' }}</h6>
                            <ul class="mb-0">
                                <li>{{ app()->getLocale() == 'en' ? 'Your fundraiser will be validated within 24 hours' : 'Votre collecte sera validée sous 24h' }}</li>
                                <li>{{ app()->getLocale() == 'en' ? 'You will receive a unique link to share' : 'Vous recevrez un lien unique à partager' }}</li>
                                <li>{{ app()->getLocale() == 'en' ? 'Our team will support you throughout to maximize impact' : 'Notre équipe vous accompagnera pour maximiser l\'impact' }}</li>
                                <li>{{ app()->getLocale() == 'en' ? 'You can track donations in real time' : 'Vous pourrez suivre les donations en temps réel' }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold text-primary mb-3">{{ app()->getLocale() == 'en' ? 'Frequently Asked Questions' : 'Questions Fréquentes' }}</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item border-0 shadow-sm mb-3" data-aos="fade-up">
                        <h2 class="accordion-header">
                            <button class="accordion-button fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                {{ app()->getLocale() == 'en' ? 'How are collected funds used?' : 'Comment sont utilisés les fonds collectés ?' }}
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                {{ app()->getLocale() == 'en' ? '100% of collected funds are transferred directly to OWEW beneficiaries. We cover all operating costs through our other funding sources.' : '100% des fonds collectés sont reversés directement aux bénéficiaires d\'OWEW. Nous prenons en charge tous les frais de fonctionnement via nos autres sources de financement.' }}
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 shadow-sm mb-3" data-aos="fade-up" data-aos-delay="100">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                {{ app()->getLocale() == 'en' ? 'Are there fees to create a fundraiser?' : 'Y a-t-il des frais pour créer une collecte ?' }}
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                {{ app()->getLocale() == 'en' ? 'No, creating a fundraiser is completely free. The only fees applied are banking transaction fees (approximately 2-3%), which are transparent to donors.' : 'Non, la création d\'une collecte est entièrement gratuite. Les seuls frais appliqués sont les frais de transaction bancaire (environ 2-3%), qui sont transparents pour les donateurs.' }}
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 shadow-sm mb-3" data-aos="fade-up" data-aos-delay="200">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                {{ app()->getLocale() == 'en' ? 'Can I modify my fundraiser after creation?' : 'Puis-je modifier ma collecte après création ?' }}
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                {{ app()->getLocale() == 'en' ? 'Yes, you can modify the text, images and goal of your fundraiser at any time from your personal space.' : 'Oui, vous pouvez modifier le texte, les images et l\'objectif de votre collecte à tout moment depuis votre espace personnel.' }}
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 shadow-sm mb-3" data-aos="fade-up" data-aos-delay="300">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                {{ app()->getLocale() == 'en' ? 'How long does a fundraiser last?' : 'Combien de temps dure une collecte ?' }}
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                {{ app()->getLocale() == 'en' ? 'The duration is flexible! You can set an end date or leave your fundraiser open. The average duration is 30 to 60 days to maximize mobilization.' : 'La durée est flexible ! Vous pouvez définir une date de fin ou laisser votre collecte ouverte. La durée moyenne est de 30 à 60 jours pour maximiser la mobilisation.' }}
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 shadow-sm" data-aos="fade-up" data-aos-delay="400">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                {{ app()->getLocale() == 'en' ? 'Can I get a tax receipt?' : 'Puis-je obtenir un reçu fiscal ?' }}
                            </button>
                        </h2>
                        <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                {{ app()->getLocale() == 'en' ? 'Yes, all donors automatically receive a tax receipt by email, allowing them to benefit from tax deductions according to current legislation.' : 'Oui, tous les donateurs reçoivent automatiquement un reçu fiscal par email, leur permettant de bénéficier de déductions fiscales selon la législation en vigueur.' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Final -->
<section class="py-5">
    <div class="container">
        <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #4B0082, #6a1b9a);">
            <div class="card-body p-5 text-center text-white" data-aos="zoom-in">
                <h3 class="fw-bold mb-3">{{ app()->getLocale() == 'en' ? 'Need Help Creating Your Fundraiser?' : 'Besoin d\'Aide pour Créer votre Collecte ?' }}</h3>
                <p class="lead mb-4">
                    {{ app()->getLocale() == 'en' ? 'Our team is here to support you every step of the way!' : 'Notre équipe est là pour vous accompagner à chaque étape !' }}
                </p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="/contact" class="btn btn-warning btn-lg px-5">
                        <i class="fas fa-comments me-2"></i>{{ app()->getLocale() == 'en' ? 'Contact the Team' : 'Contacter l\'Équipe' }}
                    </a>
                    <a href="tel:+225XXXXXXXXXX" class="btn btn-outline-light btn-lg px-5">
                        <i class="fas fa-phone me-2"></i>{{ app()->getLocale() == 'en' ? 'Call Now' : 'Appeler Maintenant' }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
