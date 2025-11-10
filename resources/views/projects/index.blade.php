@extends('layouts.base')

@section('title', (app()->getLocale() == 'en' ? 'Our Projects - OWEW' : 'Nos Projets - OWEW'))

@section('content')

<!-- Hero Section -->
<section class="page-hero" style="background: linear-gradient(135deg, #4B0082, #6a1b9a); padding: 6rem 0 4rem; color: white; position: relative; overflow: hidden;">
    <div class="position-absolute w-100 h-100" style="top: 0; left: 0; opacity: 0.1; background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="1"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    <div class="container text-center position-relative">
    <h1 class="display-3 fw-bold mb-3" data-aos="fade-up">{{ app()->getLocale() == 'en' ? 'Our Projects' : 'Nos Projets' }}</h1>
    <p class="lead mb-4" data-aos="fade-up" data-aos-delay="100">{{ app()->getLocale() == 'en' ? 'Discover initiatives that change lives and support the ones that move you' : 'Découvrez les initiatives qui changent des vies et soutenez celles qui vous touchent' }}</p>
        <div class="d-flex justify-content-center gap-4" data-aos="fade-up" data-aos-delay="200">
            <div class="text-center">
                <h3 class="fw-bold mb-0">{{ $projects->total() }}</h3>
                <small>{{ app()->getLocale() == 'en' ? 'Active projects' : 'Projets actifs' }}</small>
            </div>
            <div class="text-center">
                <h3 class="fw-bold mb-0">{{ number_format(\App\Models\Project::sum('raised_amount'), 0, ',', ' ') }}</h3>
                <small>{{ app()->getLocale() == 'en' ? 'FCFA raised' : 'FCFA collectés' }}</small>
            </div>
        </div>
    </div>
</section>

<!-- Filtres -->
<section class="py-4 bg-light border-bottom">
    <div class="container">
        <div class="d-flex flex-wrap gap-2 justify-content-center align-items-center">
            <span class="text-muted me-2"><i class="fas fa-filter me-1"></i>{{ app()->getLocale() == 'en' ? 'Filter by:' : 'Filtrer par :' }}</span>
            <button class="btn btn-sm btn-primary rounded-pill px-4 filter-btn active" data-filter="all">
                {{ app()->getLocale() == 'en' ? 'All projects' : 'Tous les projets' }}
            </button>
            <button class="btn btn-sm btn-outline-primary rounded-pill px-4 filter-btn" data-filter="active">
                <i class="fas fa-fire me-1"></i>{{ app()->getLocale() == 'en' ? 'Ongoing' : 'En cours' }}
            </button>
            <button class="btn btn-sm btn-outline-success rounded-pill px-4 filter-btn" data-filter="featured">
                <i class="fas fa-star me-1"></i>{{ app()->getLocale() == 'en' ? 'Featured' : 'En vedette' }}
            </button>
        </div>
    </div>
</section>

<!-- Liste des Projets -->
<section class="py-5 bg-light">
    <div class="container">
        @if($projects->count() > 0)
        <div class="row g-4" id="projectsGrid">
            @foreach($projects as $project)
            <div class="col-lg-4 col-md-6 project-item" data-status="{{ $project->status }}" data-featured="{{ $project->featured ? 'true' : 'false' }}" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                <div class="card border-0 shadow-sm h-100 project-card-hover" style="transition: all 0.3s ease; border-radius: 16px; overflow: hidden;">
                    <!-- Image avec badge -->
                    <div class="position-relative overflow-hidden" style="height: 280px;">
                       @if($project->images->first())
                       <img src="{{ asset('storage/' . $project->images->first()->image_path) }}"
                           class="card-img-top h-100 w-100"
                           style="object-fit: cover; transition: transform 0.3s ease;"
                           alt="{{ localized_field($project, 'title') }}">
                        @else
                            <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-gradient" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                <i class="fas fa-image fa-4x text-white opacity-50"></i>
                            </div>
                        @endif

                        <!-- Badges -->
                        <div class="position-absolute top-0 start-0 m-3">
                            @if($project->featured)
                                <span class="badge rounded-pill px-3 py-2" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); font-weight: 600;">
                                    <i class="fas fa-star me-1"></i>{{ app()->getLocale() == 'en' ? 'Featured' : 'En Vedette' }}
                                </span>
                            @endif
                        </div>

                        <div class="position-absolute top-0 end-0 m-3">
                            @if($project->status === 'active')
                                <span class="badge bg-success rounded-pill px-3 py-2">
                                    <i class="fas fa-circle fa-xs me-1" style="animation: pulse 2s infinite;"></i>{{ app()->getLocale() == 'en' ? 'Ongoing' : 'En cours' }}
                                </span>
                            @elseif($project->status === 'completed')
                                <span class="badge bg-primary rounded-pill px-3 py-2">
                                    <i class="fas fa-check-circle me-1"></i>{{ app()->getLocale() == 'en' ? 'Completed' : 'Complété' }}
                                </span>
                            @endif
                        </div>

                        <!-- Overlay au survol -->
                        <div class="position-absolute w-100 h-100 d-flex align-items-center justify-content-center"
                             style="top: 0; left: 0; background: rgba(75, 0, 130, 0.9); opacity: 0; transition: opacity 0.3s ease;">
                            <a href="{{ route('projects.show', $project->slug) }}" class="btn btn-light btn-lg rounded-pill px-4">
                                <i class="fas fa-eye me-2"></i>{{ app()->getLocale() == 'en' ? 'View details' : 'Voir les détails' }}
                            </a>
                        </div>
                    </div>

                    <!-- Contenu de la carte -->
                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold mb-3" style="color: #4B0082; font-size: 1.25rem; min-height: 60px;">
                            {{ Str::limit(localized_field($project, 'title'), 60) }}
                        </h5>
                        <p class="card-text text-muted mb-3" style="font-size: 0.95rem; min-height: 72px;">
                            {{ Str::limit(localized_field($project, 'description'), 100) }}
                        </p>

                        <!-- Barre de progression avec style moderne -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <small class="text-muted fw-semibold">
                                    <i class="fas fa-chart-line me-1"></i>{{ app()->getLocale() == 'en' ? 'Progress' : 'Progression' }}
                                </small>
                                <small class="fw-bold" style="color: #4B0082; font-size: 1rem;">
                                    {{ number_format($project->progress_percentage, 0) }}%
                                </small>
                            </div>
                            <div class="progress" style="height: 10px; border-radius: 10px; background: #e9ecef;">
                                <div class="progress-bar position-relative"
                                     role="progressbar"
                                     style="width: {{ $project->progress_percentage }}%;
                                            background: linear-gradient(90deg, #4B0082, #FF9800);
                                            border-radius: 10px;
                                            box-shadow: 0 2px 4px rgba(75, 0, 130, 0.3);"
                                     aria-valuenow="{{ $project->progress_percentage }}"
                                     aria-valuemin="0"
                                     aria-valuemax="100">
                                </div>
                            </div>
                        </div>

                        <!-- Montants -->
                        <div class="row g-0 mb-3">
                            <div class="col-6">
                                <div class="text-start">
                                    <div class="fw-bold" style="color: #4B0082; font-size: 1.1rem;">
                                        {{ number_format($project->raised_amount, 0, ',', ' ') }}
                                    </div>
                                    <small class="text-muted">
                                        <i class="fas fa-coins me-1"></i>{{ app()->getLocale() == 'en' ? 'Raised' : 'Collecté' }}
                                    </small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-end">
                                    <div class="fw-bold text-dark" style="font-size: 1.1rem;">
                                        {{ number_format($project->goal_amount, 0, ',', ' ') }}
                                    </div>
                                    <small class="text-muted">
                                        <i class="fas fa-bullseye me-1"></i>{{ app()->getLocale() == 'en' ? 'Goal' : 'Objectif' }}
                                    </small>
                                </div>
                            </div>
                        </div>

                        <!-- Bouton d'action -->
                        <a href="{{ route('projects.show', $project->slug) }}"
                           class="btn w-100 text-white fw-semibold py-2 rounded-pill"
                           style="background: linear-gradient(135deg, #4B0082, #FF9800); border: none; transition: all 0.3s ease;">
                            <i class="fas fa-heart me-2"></i>{{ app()->getLocale() == 'en' ? 'Support this Project' : 'Soutenir ce Projet' }}
                        </a>
                    </div>

                    <!-- Footer de la carte avec info supplémentaire -->
                    <div class="card-footer bg-light border-0 p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                <i class="fas fa-users me-1"></i>
                                {{ $project->donations->count() }} {{ app()->getLocale() == 'en' ? 'donor(s)' : 'donateur(s)' }}
                            </small>
                            @if($project->end_date)
                                <small class="text-muted">
                                    <i class="fas fa-calendar me-1"></i>
                                    {{ app()->getLocale() == 'en' ? 'Until' : 'Jusqu\'au' }} {{ $project->end_date->format('d/m/Y') }}
                                </small>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination personnalisée -->
        @if($projects->hasPages())
        <div class="mt-5" data-aos="fade-up">
            <nav>
                {{ $projects->links('vendor.pagination.bootstrap-5') }}
            </nav>
        </div>
        @endif

        @else
        <!-- Empty state with friendly design -->
        <div class="text-center py-5" data-aos="fade-up">
            <div class="mb-4">
                <i class="fas fa-folder-open fa-5x text-muted" style="opacity: 0.3;"></i>
            </div>
            <h3 class="fw-bold text-dark mb-3">{{ app()->getLocale() == 'en' ? 'No projects at the moment' : 'Aucun projet pour le moment' }}</h3>
            <p class="text-muted mb-4">{{ app()->getLocale() == 'en' ? 'New projects will be available soon. Check back later!' : 'De nouveaux projets seront bientôt disponibles. Revenez nous voir !' }}</p>
            <a href="{{ route('home') }}" class="btn btn-primary rounded-pill px-4">
                <i class="fas fa-home me-2"></i>{{ app()->getLocale() == 'en' ? 'Back to Home' : "Retour à l'accueil" }}
            </a>
        </div>
        @endif
    </div>
</section>

<!-- Call to Action -->
<section class="py-5" style="background: linear-gradient(135deg, #4B0082, #FF9800);">
    <div class="container text-center text-white" data-aos="fade-up">
        <h2 class="fw-bold mb-3">{{ app()->getLocale() == 'en' ? 'Got a project idea?' : 'Vous avez un projet en tête ?' }}</h2>
        <p class="lead mb-4">{{ app()->getLocale() == 'en' ? 'Share your initiative with us and together we can make a difference!' : 'Partagez votre initiative avec nous et ensemble, faisons la différence !' }}</p>
        <a href="{{ route('contact.index') }}" class="btn btn-light btn-lg rounded-pill px-5">
            <i class="fas fa-paper-plane me-2"></i>{{ app()->getLocale() == 'en' ? 'Propose a Project' : 'Proposer un Projet' }}
        </a>
    </div>
</section>

@endsection

@push('styles')
<style>
    .project-card-hover {
        transform: translateY(0);
    }

    .project-card-hover:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15) !important;
    }

    .project-card-hover:hover img {
        transform: scale(1.1);
    }

    .project-card-hover:hover .position-absolute.w-100.h-100 {
        opacity: 1 !important;
    }

    .filter-btn {
        transition: all 0.3s ease;
    }

    .filter-btn:hover {
        transform: translateY(-2px);
    }

    .filter-btn.active {
        box-shadow: 0 4px 12px rgba(75, 0, 130, 0.3);
    }

    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.5;
        }
    }

    .btn-primary {
        background: linear-gradient(135deg, #4B0082, #FF9800);
        border: none;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #3a0066, #e68900);
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(75, 0, 130, 0.3);
    }

    .btn-outline-primary:hover {
        background: linear-gradient(135deg, #4B0082, #FF9800);
        border-color: transparent;
        color: white;
    }
</style>
@endpush

@push('scripts')
<script>
    // Filtrage des projets
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            // Retirer active de tous les boutons
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            // Ajouter active au bouton cliqué
            this.classList.add('active');

            const filter = this.dataset.filter;
            const projects = document.querySelectorAll('.project-item');

            projects.forEach(project => {
                if (filter === 'all') {
                    project.style.display = 'block';
                } else if (filter === 'featured') {
                    project.style.display = project.dataset.featured === 'true' ? 'block' : 'none';
                } else if (filter === 'active') {
                    project.style.display = project.dataset.status === 'active' ? 'block' : 'none';
                }
            });
        });
    });
</script>
@endpush
