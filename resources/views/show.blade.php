@extends('layouts.base')

@section('title', 'Organisation de collecte - OWEW')

@section('content')

<!-- Hero Section avec Image -->
<section class="position-relative" style="height: 500px; overflow: hidden;">
    <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=1200&h=500&fit=crop"
         alt="Projet" class="w-100 h-100 object-fit-cover">
    <div class="position-absolute top-0 start-0 w-100 h-100"
         style="background: linear-gradient(to bottom, rgba(75,0,130,0.7), rgba(75,0,130,0.9));">
        <div class="container h-100 d-flex align-items-end pb-5">
            <div class="text-white" data-aos="fade-up">
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/" class="text-warning text-decoration-none">Accueil</a></li>
                        <li class="breadcrumb-item"><a href="/projets" class="text-warning text-decoration-none">Projets</a></li>
                        <li class="breadcrumb-item active text-white">Éducation pour Tous</li>
                    </ol>
                </nav>
                <span class="badge bg-warning text-dark px-3 py-2 mb-3">En cours</span>
                <h1 class="display-4 fw-bold mb-3">Éducation pour Tous</h1>
                <p class="lead mb-0">Offrir une éducation de qualité à 500 orphelins</p>
            </div>
        </div>
    </div>
</section>

<!-- Barre de Progression Sticky -->
<section class="bg-white shadow-sm sticky-top" style="top: 0; z-index: 100;">
    <div class="container py-3">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="d-flex justify-content-between mb-2">
                    <span class="fw-semibold">Progression</span>
                    <span class="fw-bold text-primary">75%</span>
                </div>
                <div class="progress" style="height: 12px;">
                    <div class="progress-bar" style="width: 75%; background: linear-gradient(90deg, #4B0082, #FF9800);"></div>
                </div>
            </div>
            <div class="col-md-4 text-end">
                <a href="#donate" class="btn btn-primary btn-lg">
                    <i class="fas fa-heart me-2"></i>Faire un Don
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Contenu Principal -->
<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Colonne Principale -->
            <div class="col-lg-8">
                <!-- Statistiques -->
                <div class="row g-3 mb-5" data-aos="fade-up">
                    <div class="col-4">
                        <div class="card border-0 shadow-sm text-center">
                            <div class="card-body p-4">
                                <div class="display-5 fw-bold text-primary">7.5M</div>
                                <small class="text-muted">Collecté</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card border-0 shadow-sm text-center">
                            <div class="card-body p-4">
                                <div class="display-5 fw-bold text-warning">10M</div>
                                <small class="text-muted">Objectif</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card border-0 shadow-sm text-center">
                            <div class="card-body p-4">
                                <div class="display-5 fw-bold text-success">156</div>
                                <small class="text-muted">Donateurs</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-5" data-aos="fade-up">
                    <h3 class="fw-bold text-primary mb-4">À Propos du Projet</h3>
                    <p class="lead text-muted mb-4">
                        Dans les zones rurales de Côte d'Ivoire, de nombreux enfants orphelins n'ont pas accès
                        à l'éducation faute de moyens financiers. Ce projet vise à offrir une chance égale à
                        500 enfants orphelins en prenant en charge leurs frais de scolarité et fournitures.
                    </p>
                    <p class="mb-4">
                        L'éducation est la clé pour briser le cycle de la pauvreté. Grâce à ce projet, nous
                        permettons à ces enfants non seulement d'aller à l'école, mais aussi de recevoir un
                        soutien scolaire personnalisé et un suivi psychosocial adapté à leur situation.
                    </p>
                    <h5 class="fw-bold mb-3">Ce que nous offrons :</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Frais de scolarité complets</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Fournitures scolaires et uniformes</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Soutien scolaire après les cours</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Suivi médical et psychologique</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Repas quotidien à l'école</li>
                    </ul>
                </div>

                <!-- Galerie Photos -->
                <div class="mb-5" data-aos="fade-up">
                    <h3 class="fw-bold text-primary mb-4">Galerie du Projet</h3>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <img src="https://images.unsplash.com/photo-1497633762265-9d179a990aa6?w=400&h=300&fit=crop"
                                 class="img-fluid rounded shadow-sm" alt="Photo 1" style="cursor: pointer;">
                        </div>
                        <div class="col-md-4">
                            <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=400&h=300&fit=crop"
                                 class="img-fluid rounded shadow-sm" alt="Photo 2" style="cursor: pointer;">
                        </div>
                        <div class="col-md-4">
                            <img src="https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?w=400&h=300&fit=crop"
                                 class="img-fluid rounded shadow-sm" alt="Photo 3" style="cursor: pointer;">
                        </div>
                    </div>
                </div>

                <!-- Timeline / Actualités -->
                <div class="mb-5" data-aos="fade-up">
                    <h3 class="fw-bold text-primary mb-4">Actualités du Projet</h3>
                    <div class="timeline">
                        <div class="card border-0 shadow-sm mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="fw-bold mb-0">Distribution des kits scolaires</h6>
                                    <small class="text-muted"><i class="far fa-clock me-1"></i>Il y a 2 jours</small>
                                </div>
                                <p class="text-muted mb-0">
                                    150 enfants ont reçu leurs kits scolaires complets ce matin. Les sourires
                                    et la joie étaient au rendez-vous !
                                </p>
                            </div>
                        </div>
                        <div class="card border-0 shadow-sm mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="fw-bold mb-0">Nouveau donateur important</h6>
                                    <small class="text-muted"><i class="far fa-clock me-1"></i>Il y a 5 jours</small>
                                </div>
                                <p class="text-muted mb-0">
                                    Un généreux don de 1,5M FCFA nous rapproche de notre objectif.
                                    Merci à tous nos donateurs !
                                </p>
                            </div>
                        </div>
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="fw-bold mb-0">Lancement du projet</h6>
                                    <small class="text-muted"><i class="far fa-clock me-1"></i>Il y a 1 mois</small>
                                </div>
                                <p class="text-muted mb-0">
                                    Le projet "Éducation pour Tous" est officiellement lancé avec
                                    un objectif ambitieux de soutenir 500 enfants.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Donateurs Récents -->
                <div class="mb-5" data-aos="fade-up">
                    <h3 class="fw-bold text-primary mb-4">Donateurs Récents</h3>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3"
                                     style="width: 40px; height: 40px; font-weight: bold;">JK</div>
                                <div>
                                    <div class="fw-semibold">Jean Kouassi</div>
                                    <small class="text-muted">Il y a 2 heures</small>
                                </div>
                            </div>
                            <span class="fw-bold text-primary">50,000 FCFA</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-warning text-white d-flex align-items-center justify-content-center me-3"
                                     style="width: 40px; height: 40px; font-weight: bold;">MT</div>
                                <div>
                                    <div class="fw-semibold">Marie Traoré</div>
                                    <small class="text-muted">Il y a 5 heures</small>
                                </div>
                            </div>
                            <span class="fw-bold text-primary">25,000 FCFA</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center me-3"
                                     style="width: 40px; height: 40px; font-weight: bold;">AN</div>
                                <div>
                                    <div class="fw-semibold">Anonyme</div>
                                    <small class="text-muted">Il y a 1 jour</small>
                                </div>
                            </div>
                            <span class="fw-bold text-primary">100,000 FCFA</span>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <button class="btn btn-outline-primary">Voir tous les donateurs (156)</button>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Card Don -->
                <div class="card border-0 shadow-lg mb-4 sticky-top" style="top: 100px;" id="donate" data-aos="fade-left">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">Soutenir ce Projet</h5>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Montant (FCFA)</label>
                            <div class="row g-2 mb-2">
                                <div class="col-6">
                                    <button class="btn btn-outline-primary w-100">5,000</button>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-outline-primary w-100">10,000</button>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-outline-primary w-100">25,000</button>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-outline-primary w-100">50,000</button>
                                </div>
                            </div>
                            <input type="number" class="form-control form-control-lg" placeholder="Autre montant">
                        </div>

                        <button class="btn btn-lg w-100 mb-3"
                                style="background: linear-gradient(135deg, #4B0082, #FF9800); color: white; font-weight: 600;">
                            <i class="fas fa-heart me-2"></i>Faire un Don
                        </button>

                        <div class="text-center">
                            <small class="text-muted">
                                <i class="fas fa-lock me-1"></i>Paiement 100% sécurisé
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Informations Projet -->
                <div class="card border-0 shadow-sm mb-4" data-aos="fade-left" data-aos-delay="100">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3">Informations</h6>
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <i class="fas fa-calendar text-primary me-2"></i>
                                <strong>Début:</strong> 15 Sept 2024
                            </li>
                            <li class="mb-3">
                                <i class="fas fa-flag text-warning me-2"></i>
                                <strong>Fin prévue:</strong> 15 Déc 2024
                            </li>
                            <li class="mb-3">
                                <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                <strong>Localisation:</strong> Abidjan, CI
                            </li>
                            <li class="mb-3">
                                <i class="fas fa-users text-success me-2"></i>
                                <strong>Bénéficiaires:</strong> 500 enfants
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Partage Social -->
                <div class="card border-0 shadow-sm" data-aos="fade-left" data-aos-delay="200">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3">Partager ce Projet</h6>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary">
                                <i class="fab fa-facebook me-2"></i>Facebook
                            </button>
                            <button class="btn btn-info text-white">
                                <i class="fab fa-twitter me-2"></i>Twitter
                            </button>
                            <button class="btn btn-success">
                                <i class="fab fa-whatsapp me-2"></i>WhatsApp
                            </button>
                            <button class="btn btn-secondary">
                                <i class="fas fa-link me-2"></i>Copier le lien
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Projets Similaires -->
<section class="py-5 bg-light">
    <div class="container">
        <h3 class="fw-bold text-primary mb-4 text-center" data-aos="fade-up">Projets Similaires</h3>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up">
                <div class="card border-0 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1576765608535-5f04d1e3f289?w=400&h=250&fit=crop"
                         class="card-img-top" alt="Projet">
                    <div class="card-body">
                        <h5 class="fw-bold">Soins Médicaux pour Veuves</h5>
                        <div class="progress mb-2" style="height: 8px;">
                            <div class="progress-bar bg-primary" style="width: 45%"></div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <small>45%</small>
                            <small class="fw-bold">2.25M / 5M FCFA</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card border-0 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1509099836639-18ba1795216d?w=400&h=250&fit=crop"
                         class="card-img-top" alt="Projet">
                    <div class="card-body">
                        <h5 class="fw-bold">Aide Alimentaire d'Urgence</h5>
                        <div class="progress mb-2" style="height: 8px;">
                            <div class="progress-bar bg-warning" style="width: 30%"></div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <small>30%</small>
                            <small class="fw-bold">4.5M / 15M FCFA</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card border-0 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?w=400&h=250&fit=crop"
                         class="card-img-top" alt="Projet">
                    <div class="card-body">
                        <h5 class="fw-bold">Construction d'un Centre</h5>
                        <div class="progress mb-2" style="height: 8px;">
                            <div class="progress-bar bg-success" style="width: 60%"></div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <small>60%</small>
                            <small class="fw-bold">12M / 20M FCFA</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
