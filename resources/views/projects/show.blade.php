@extends('layouts.base')

@section('title', localized_field($project, 'title') . ' - OWEW')

@section('content')

<!-- Hero Section avec Image -->
<section class="position-relative" style="height: 500px; overflow: hidden;">
    @if($project->images->first())
        <img src="{{ asset('storage/' . $project->images->first()->image_path) }}"
             class="w-100 h-100"
             style="object-fit: cover; filter: brightness(0.7);"
             alt="{{ localized_field($project, 'title') }}">
    @else
        <div class="w-100 h-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);"></div>
    @endif

    <!-- Overlay avec titre -->
    <div class="position-absolute w-100 h-100 d-flex align-items-center" style="top: 0; left: 0; background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb" data-aos="fade-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}" class="text-white text-decoration-none">
                                    <i class="fas fa-home me-1"></i>{{ app()->getLocale() == 'en' ? 'Home' : 'Accueil' }}
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('projects.index') }}" class="text-white text-decoration-none">{{ app()->getLocale() == 'en' ? 'Projects' : 'Projets' }}</a>
                            </li>
                            <li class="breadcrumb-item active text-white" aria-current="page">{{ Str::limit(localized_field($project, 'title'), 30) }}</li>
                        </ol>
                    </nav>

                    <!-- Badges -->
                    <div class="mb-3" data-aos="fade-right" data-aos-delay="100">
                        @if($project->featured)
                            <span class="badge rounded-pill px-3 py-2 me-2" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); font-size: 0.9rem;">
                                <i class="fas fa-star me-1"></i>{{ app()->getLocale() == 'en' ? 'Featured' : 'En Vedette' }}
                            </span>
                        @endif
                        @if($project->status === 'active')
                            <span class="badge bg-success rounded-pill px-3 py-2" style="font-size: 0.9rem;">
                                <i class="fas fa-circle fa-xs me-1" style="animation: pulse 2s infinite;"></i>{{ app()->getLocale() == 'en' ? 'Ongoing' : 'En cours' }}
                            </span>
                        @elseif($project->status === 'completed')
                            <span class="badge bg-primary rounded-pill px-3 py-2" style="font-size: 0.9rem;">
                                <i class="fas fa-check-circle me-1"></i>{{ app()->getLocale() == 'en' ? 'Completed' : 'Complété' }}
                            </span>
                        @endif
                    </div>

                    <h1 class="display-4 fw-bold text-white mb-3" data-aos="fade-right" data-aos-delay="200">
                        {{ localized_field($project, 'title') }}
                    </h1>

                    <div class="d-flex flex-wrap gap-4 text-white" data-aos="fade-right" data-aos-delay="300">
                        <div>
                            <i class="fas fa-users me-2"></i>
                            <span class="fw-semibold">{{ $project->donations->count() }}</span> {{ app()->getLocale() == 'en' ? 'donor(s)' : 'donateur(s)' }}
                        </div>
                        @if($project->start_date)
                        <div>
                            <i class="fas fa-calendar-alt me-2"></i>
                            {{ app()->getLocale() == 'en' ? 'Start:' : 'Début :' }} {{ $project->start_date->format('d/m/Y') }}
                        </div>
                        @endif
                        @if($project->end_date)
                        <div>
                            <i class="fas fa-calendar-check me-2"></i>
                            {{ app()->getLocale() == 'en' ? 'End:' : 'Fin :' }} {{ $project->end_date->format('d/m/Y') }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contenu Principal -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4">
            <!-- Colonne Gauche - Contenu -->
            <div class="col-lg-8">
                <!-- Carte de progression -->
                <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;" data-aos="fade-up">
                    <div class="card-body p-4">
                        <div class="row align-items-center mb-3">
                            <div class="col-md-6">
                                <h3 class="fw-bold mb-0" style="color: #4B0082;">
                                    {{ number_format($project->raised_amount, 0, ',', ' ') }} FCFA
                                </h3>
                                <p class="text-muted mb-0">{{ app()->getLocale() == 'en' ? 'raised of' : 'collectés sur' }} {{ number_format($project->goal_amount, 0, ',', ' ') }} FCFA</p>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <h3 class="fw-bold mb-0" style="color: #FF9800;">
                                    {{ number_format($project->progress_percentage, 0) }}%
                                </h3>
                                <p class="text-muted mb-0">{{ app()->getLocale() == 'en' ? 'of goal reached' : "de l'objectif atteint" }}</p>
                            </div>
                        </div>

                        <!-- Barre de progression -->
                        <div class="progress mb-3" style="height: 20px; border-radius: 10px; background: #e9ecef;">
                            <div class="progress-bar position-relative"
                                 role="progressbar"
                                 style="width: {{ $project->progress_percentage }}%;
                                        background: linear-gradient(90deg, #4B0082, #FF9800);
                                        border-radius: 10px;
                                        box-shadow: 0 2px 8px rgba(75, 0, 130, 0.3);"
                                 aria-valuenow="{{ $project->progress_percentage }}"
                                 aria-valuemin="0"
                                 aria-valuemax="100">
                                <span class="position-absolute w-100 text-center fw-bold text-white" style="line-height: 20px;">
                                    {{ number_format($project->progress_percentage, 0) }}%
                                </span>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between text-muted small">
                            <span><i class="fas fa-chart-line me-1"></i>{{ $project->donations->count() }} {{ app()->getLocale() == 'en' ? 'contribution(s)' : 'contribution(s)' }}</span>
                            @if($project->end_date && $project->end_date->isFuture())
                                <span><i class="fas fa-clock me-1"></i>{{ $project->end_date->diffForHumans() }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Description du projet -->
                <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-4" style="color: #4B0082;">
                            <i class="fas fa-info-circle me-2"></i>{{ app()->getLocale() == 'en' ? 'About the project' : 'À propos du projet' }}
                        </h4>
                        <div class="text-muted" style="line-height: 1.8; font-size: 1.05rem;">
                            {!! nl2br(e(localized_field($project, 'description'))) !!}
                        </div>
                    </div>
                </div>

                <!-- Galerie d'images -->
                @if($project->images->count() > 1)
                <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-body p-4">
                            <h4 class="fw-bold mb-4" style="color: #4B0082;">
                                <i class="fas fa-images me-2"></i>{{ app()->getLocale() == 'en' ? 'Project Gallery' : 'Galerie du projet' }}
                            </h4>
                        <div class="row g-3">
                            @foreach($project->images as $image)
                                <div class="col-md-4 col-6">
                                    <a href="{{ asset('storage/' . $image->image_path) }}"
                                       data-lightbox="project-gallery"
                                           data-title="{{ $image->caption_fr ?? localized_field($project, 'title') }}">
                                        <div class="position-relative overflow-hidden" style="height: 200px; border-radius: 12px; cursor: pointer;">
                                            <img src="{{ asset('storage/' . $image->image_path) }}"
                                                 class="w-100 h-100 gallery-image"
                                                 style="object-fit: cover; transition: transform 0.3s ease;"
                                                     alt="{{ $image->caption_fr ?? localized_field($project, 'title') }}">
                                            <div class="gallery-overlay position-absolute w-100 h-100 d-flex align-items-center justify-content-center"
                                                 style="top: 0; left: 0; background: rgba(75, 0, 130, 0.7); opacity: 0; transition: opacity 0.3s ease;">
                                                <i class="fas fa-search-plus fa-2x text-white"></i>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <!-- Dernières contributions -->
                @if($project->donations->where('status', 'completed')->count() > 0)
                <div class="card border-0 shadow-sm" style="border-radius: 16px;" data-aos="fade-up" data-aos-delay="300">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-4" style="color: #4B0082;">
                            <i class="fas fa-hand-holding-heart me-2"></i>{{ app()->getLocale() == 'en' ? 'Latest contributions' : 'Dernières contributions' }}
                        </h4>
                        <div class="list-group list-group-flush">
                            @foreach($project->donations->where('status', 'completed')->take(5) as $donation)
                            <div class="list-group-item border-0 px-0 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-gradient d-flex align-items-center justify-content-center me-3"
                                         style="width: 48px; height: 48px; background: linear-gradient(135deg, #4B0082, #FF9800);">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="fw-semibold">{{ $donation->donor_name ?? (app()->getLocale() == 'en' ? 'Anonymous donor' : 'Donateur anonyme') }}</div>
                                        <small class="text-muted">
                                            <i class="fas fa-clock me-1"></i>{{ $donation->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                    <div class="text-end">
                                        <div class="fw-bold" style="color: #4B0082;">
                                            {{ number_format($donation->amount, 0, ',', ' ') }} FCFA
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Colonne Droite - Widget de don -->
            <div class="col-lg-4">
                <!-- Carte de don -->
                <div class="card border-0 shadow-lg sticky-top" style="border-radius: 16px; top: 100px;" data-aos="fade-up">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-4 text-center" style="color: #4B0082;">
                            <i class="fas fa-heart me-2"></i>{{ app()->getLocale() == 'en' ? 'Make a Donation' : 'Faire un don' }}
                        </h4>

                        <!-- Montants suggérés -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-muted small">{{ app()->getLocale() == 'en' ? 'Suggested amounts' : 'Montants suggérés' }}</label>
                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <button class="btn btn-outline-primary w-100 amount-btn" data-amount="5000">
                                        5 000 FCFA
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-outline-primary w-100 amount-btn" data-amount="10000">
                                        10 000 FCFA
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-outline-primary w-100 amount-btn" data-amount="25000">
                                        25 000 FCFA
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-outline-primary w-100 amount-btn" data-amount="50000">
                                        50 000 FCFA
                                    </button>
                                </div>
                            </div>

                            <!-- Montant personnalisé -->
                <label class="form-label fw-semibold text-muted small">{{ app()->getLocale() == 'en' ? 'Or custom amount' : 'Ou montant personnalisé' }}</label>
                <input type="number"
                    id="customAmount"
                    class="form-control form-control-lg mb-3"
                    placeholder="{{ app()->getLocale() == 'en' ? 'Enter an amount' : 'Entrez un montant' }}"
                    min="1000"
                    step="1000">
                        </div>

                        <!-- Bouton de don -->
                            <a href="{{ route('donate.index') }}?project={{ $project->id }}"
                           class="btn btn-lg w-100 text-white fw-bold py-3 mb-3 donate-btn"
                           style="background: linear-gradient(135deg, #4B0082, #FF9800); border: none; border-radius: 12px; box-shadow: 0 8px 16px rgba(75, 0, 130, 0.3);">
                            <i class="fas fa-hand-holding-usd me-2"></i>{{ app()->getLocale() == 'en' ? 'Donate now' : 'Faire un don maintenant' }}
                        </a>

                        <!-- Partage social -->
                        <div class="text-center pt-3 border-top">
                            <p class="small text-muted mb-2">
                                <i class="fas fa-share-alt me-1"></i>{{ app()->getLocale() == 'en' ? 'Share this project' : 'Partagez ce projet' }}
                            </p>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('projects.show', $project->slug)) }}"
                                   target="_blank"
                                   class="btn btn-sm btn-outline-primary rounded-circle social-btn"
                                   style="width: 40px; height: 40px;">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('projects.show', $project->slug)) }}&text={{ urlencode(localized_field($project, 'title')) }}"
                                   target="_blank"
                                   class="btn btn-sm btn-outline-info rounded-circle social-btn"
                                   style="width: 40px; height: 40px;">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                          <a href="https://wa.me/?text={{ urlencode(localized_field($project, 'title') . ' - ' . route('projects.show', $project->slug)) }}"
                                   target="_blank"
                                   class="btn btn-sm btn-outline-success rounded-circle social-btn"
                                   style="width: 40px; height: 40px;">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                                <a href="mailto:?subject={{ urlencode(localized_field($project, 'title')) }}&body={{ urlencode((app()->getLocale() == 'en' ? 'Check out this project: ' : 'Découvrez ce projet : ') . route('projects.show', $project->slug)) }}"
                                   class="btn btn-sm btn-outline-secondary rounded-circle social-btn"
                                   style="width: 40px; height: 40px;">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informations supplémentaires -->
                <div class="card border-0 shadow-sm mt-4" style="border-radius: 16px;" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3" style="color: #4B0082;">
                            <i class="fas fa-shield-alt me-2"></i>{{ app()->getLocale() == 'en' ? 'Secure & Transparent' : 'Sécurisé & Transparent' }}
                        </h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <small>{{ app()->getLocale() == 'en' ? '100% secure payment' : 'Paiement 100% sécurisé' }}</small>
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <small>{{ app()->getLocale() == 'en' ? 'Real-time tracking' : 'Suivi en temps réel' }}</small>
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <small>{{ app()->getLocale() == 'en' ? 'Tax receipt available' : 'Reçu fiscal disponible' }}</small>
                            </li>
                            <li>
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <small>{{ app()->getLocale() == 'en' ? 'Measurable impact' : 'Impact mesurable' }}</small>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Projets similaires -->
<section class="py-5 bg-white">
    <div class="container">
        <h3 class="fw-bold mb-4 text-center" style="color: #4B0082;" data-aos="fade-up">
            <i class="fas fa-heart me-2"></i>{{ app()->getLocale() == 'en' ? 'Other projects you may be interested in' : 'Autres projets qui pourraient vous intéresser' }}
        </h3>

        <div class="row g-4">
            @foreach(\App\Models\Project::active()->where('id', '!=', $project->id)->inRandomOrder()->limit(3)->get() as $similarProject)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="card border-0 shadow-sm h-100 similar-card" style="border-radius: 16px; overflow: hidden; transition: transform 0.3s ease;">
                    <div class="position-relative overflow-hidden" style="height: 200px;">
                        @if($similarProject->images->first())
                            <img src="{{ asset('storage/' . $similarProject->images->first()->image_path) }}"
                                 class="w-100 h-100"
                                 style="object-fit: cover;"
                                 alt="{{ localized_field($similarProject, 'title') }}">
                        @else
                            <div class="w-100 h-100 bg-gradient" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);"></div>
                        @endif
                    </div>
                    <div class="card-body p-3">
                        <h6 class="fw-bold mb-2" style="color: #4B0082;">{{ Str::limit(localized_field($similarProject, 'title'), 50) }}</h6>
                        <div class="progress mb-2" style="height: 6px;">
                            <div class="progress-bar"
                                 style="width: {{ $similarProject->progress_percentage }}%; background: linear-gradient(90deg, #4B0082, #FF9800);">
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">{{ number_format($similarProject->progress_percentage, 0) }}% {{ app()->getLocale() == 'en' ? 'achieved' : 'atteint' }}</small>
                            <a href="{{ route('projects.show', $similarProject->slug) }}" class="btn btn-sm btn-primary rounded-pill px-3">
                                {{ app()->getLocale() == 'en' ? 'View' : 'Voir' }} <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.5;
        }
    }

    .amount-btn {
        transition: all 0.3s ease;
        border: 2px solid #4B0082;
        color: #4B0082;
        font-weight: 600;
    }

    .amount-btn:hover, .amount-btn.active {
        background: linear-gradient(135deg, #4B0082, #FF9800);
        border-color: transparent;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(75, 0, 130, 0.3);
    }

    .donate-btn {
        transition: all 0.3s ease;
    }

    .donate-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 24px rgba(75, 0, 130, 0.4) !important;
    }

    .social-btn {
        transition: all 0.3s ease;
    }

    .social-btn:hover {
        transform: translateY(-3px);
    }

    .gallery-image:hover {
        transform: scale(1.1);
    }

    .gallery-overlay {
        pointer-events: none;
    }

    a:hover .gallery-overlay {
        opacity: 1 !important;
    }

    .similar-card:hover {
        transform: translateY(-10px);
    }

    .sticky-top {
        position: sticky;
    }

    @media (max-width: 991px) {
        .sticky-top {
            position: relative;
            top: 0 !important;
        }
    }
</style>

<!-- Lightbox CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
@endpush

@push('scripts')
<!-- Lightbox JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

<script>
    // Gestion des boutons de montant
    document.querySelectorAll('.amount-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            // Retirer active de tous les boutons
            document.querySelectorAll('.amount-btn').forEach(b => b.classList.remove('active'));
            // Ajouter active au bouton cliqué
            this.classList.add('active');
            // Mettre le montant dans l'input personnalisé
            document.getElementById('customAmount').value = this.dataset.amount;
        });
    });

    // Désactiver les boutons suggérés quand on tape un montant personnalisé
    document.getElementById('customAmount').addEventListener('input', function() {
        document.querySelectorAll('.amount-btn').forEach(b => b.classList.remove('active'));
    });
</script>
@endpush
