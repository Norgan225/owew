@extends('layouts.base')

@section('title', 'Merci pour votre don - OWEW')

@section('content')
<section class="py-5" style="min-height: 100vh; background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Card Succès -->
                <div class="card border-0 shadow-lg text-center" data-aos="zoom-in">
                    <div class="card-body p-5">
                        <!-- Animation Succès -->
                        <div class="mb-4">
                            <div class="position-relative d-inline-block">
                                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto"
                                     style="width: 120px; height: 120px; background: linear-gradient(135deg, #4B0082, #FF9800);">
                                    <i class="fas fa-check text-white" style="font-size: 4rem;"></i>
                                </div>
                                <div class="position-absolute top-0 start-0"
                                     style="width: 120px; height: 120px; border: 3px solid #FF9800; border-radius: 50%; animation: pulse 2s infinite;"></div>
                            </div>
                        </div>

                        <h1 class="display-4 fw-bold text-primary mb-3">Merci pour votre Don !</h1>
                        <p class="lead text-muted mb-4">
                            Votre générosité fait une réelle différence dans la vie de nombreuses personnes.
                        </p>

                        <!-- Détails du Don -->
                        <div class="card bg-light border-0 mb-4">
                            <div class="card-body p-4">
                                <h5 class="fw-bold mb-4">Détails de votre Don</h5>
                                <div class="row text-start">
                                    <div class="col-6 mb-3">
                                        <small class="text-muted d-block mb-1">Montant</small>
                                        <div class="h4 fw-bold text-primary mb-0">
                                            {{ number_format($donation->amount, 0, ',', ' ') }} FCFA
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <small class="text-muted d-block mb-1">Nom du Donateur</small>
                                        <div class="fw-semibold">
                                            {{ $donation->is_anonymous ? 'Anonyme' : $donation->donor_name }}
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <small class="text-muted d-block mb-1">Email</small>
                                        <div class="fw-semibold">{{ $donation->donor_email }}</div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <small class="text-muted d-block mb-1">Date</small>
                                        <div class="fw-semibold">{{ $donation->created_at->format('d/m/Y à H:i') }}</div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <small class="text-muted d-block mb-1">Projet</small>
                                        <div class="fw-semibold">
                                            {{ $donation->project ? $donation->project->title : 'Don général' }}
                                        </div>
                                    </div>
                                    @if($donation->message)
                                    <div class="col-12 mb-3">
                                        <small class="text-muted d-block mb-1">Message</small>
                                        <div class="fst-italic">{{ $donation->message }}</div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Impact -->
                        <div class="alert alert-success border-0 mb-4">
                            <div class="d-flex align-items-center justify-content-center">
                                <i class="fas fa-star fa-2x me-3"></i>
                                <div class="text-start">
                                    <h6 class="fw-bold mb-1">Votre Impact</h6>
                                    <p class="mb-0">
                                        Votre don va directement soutenir nos bénéficiaires dans le projet choisi.
                                        Merci pour votre engagement !
                                    </p>
                                </div>
                            </div>
                        </div>


                        <!-- Actions -->
                        <div class="d-flex flex-wrap gap-3 justify-content-center mb-4">
                            <a href="/" class="btn btn-lg" style="background: linear-gradient(135deg, #4B0082, #FF9800); color: white;">
                                <i class="fas fa-home me-2"></i>Retour à l'Accueil
                            </a>
                            <a href="/projets" class="btn btn-outline-primary btn-lg">
                                <i class="fas fa-project-diagram me-2"></i>Voir les Projets
                            </a>
                        </div>

                    </div>
                </div>

                <!-- Newsletter -->
                <div class="card border-0 shadow-sm mt-4" data-aos="fade-up">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3">Restez Informé de nos Actions</h6>
                        <p class="text-muted mb-3">
                            Inscrivez-vous à notre newsletter pour recevoir des nouvelles
                            de l'impact de votre don
                        </p>
                        <form method="POST" action="{{ route('newsletter.subscribe') }}">
                            @csrf
                            <div class="input-group">
                                <input type="email" name="email" class="form-control form-control-lg"
                                       placeholder="votre@email.com" required>
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-paper-plane me-2"></i>S'inscrire
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Témoignage dynamique -->
                @if(isset($testimonial) && $testimonial)
                <div class="card border-0 shadow-sm mt-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <i class="fas fa-quote-left fa-2x text-primary"></i>
                        </div>
                        <p class="text-center fst-italic mb-3">
                            "{{ $testimonial->content }}"
                        </p>
                        <div class="text-center">
                            <img src="{{ $testimonial->photo ? asset('storage/' . $testimonial->photo) : asset('frontend/img/default-avatar.png') }}"
                                 class="rounded-circle mb-2" style="width: 50px; height: 50px;">
                            <div class="fw-bold">{{ $testimonial->author }}</div>
                            <small class="text-muted">{{ $testimonial->role ?? 'Bénéficiaire' }}</small>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Autres Projets à Soutenir -->
                @if(isset($otherProjects) && count($otherProjects))
                <div class="mt-5" data-aos="fade-up" data-aos-delay="200">
                    <h4 class="fw-bold text-primary mb-4 text-center">
                        Soutenez d'Autres Projets
                    </h4>
                    <div class="row g-3">
                        @foreach($otherProjects as $project)
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm h-100">
                                <img src="{{ $project->image ? asset('storage/' . $project->image) : asset('frontend/img/logo.png') }}"
                                     class="card-img-top" alt="{{ $project->title }}">
                                <div class="card-body">
                                    <h6 class="fw-bold mb-2">{{ $project->title }}</h6>
                                    <div class="progress mb-2" style="height: 6px;">
                                        <div class="progress-bar bg-primary" style="width: {{ $project->progress }}%"></div>
                                    </div>
                                    <small class="text-muted">{{ $project->progress }}% - {{ number_format($project->collected, 0, ',', ' ') }} / {{ number_format($project->goal, 0, ',', ' ') }} FCFA</small>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Animation CSS -->
<style>
    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
            opacity: 1;
        }
        50% {
            transform: scale(1.1);
            opacity: 0.5;
        }
    }

    .article-content p {
        line-height: 1.8;
        margin-bottom: 1.5rem;
    }

    .article-content h3,
    .article-content h5 {
        margin-top: 2rem;
        margin-bottom: 1rem;
    }

    .article-content img {
        max-width: 100%;
        height: auto;
    }

    .article-content blockquote {
        font-size: 1.1rem;
        margin: 2rem 0;
    }
</style>
@endsection
