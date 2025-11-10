@extends('layouts.base')

@section('title', 'Contact - OWEW')


@section('content')

<!-- Hero Section -->
<section class="page-hero" style="background: linear-gradient(135deg, #4B0082, #6a1b9a); padding: 6rem 0 4rem; color: white;">
    <div class="container text-center">
        <h1 class="display-3 fw-bold mb-3" data-aos="fade-up">{{ app()->getLocale() == 'en' ? 'Make a Donation' : 'Faire un Don' }}</h1>
        <p class="lead" data-aos="fade-up" data-aos-delay="100">{{ app()->getLocale() == 'en' ? 'Your generosity changes lives' : 'Votre générosité change des vies' }}</p>
    </div>
</section>

<!-- Projets Disponibles -->
@if($projects->count() > 0)
<section class="py-4 bg-light border-bottom">
    <div class="container">
        <h5 class="fw-bold mb-3 text-center" style="color: #4B0082;">
            <i class="fas fa-heart me-2"></i>{{ app()->getLocale() == 'en' ? 'Active Projects - Choose where your donation makes a difference' : 'Projets Actifs - Choisissez où votre don fera la différence' }}
        </h5>
        <div class="row g-3">
            @foreach($projects->take(4) as $project)
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; cursor: pointer; transition: transform 0.3s ease;"
                     onclick="selectProject({{ $project->id }}, '{{ addslashes(localized_field($project, 'title')) }}')"
                     onmouseover="this.style.transform='translateY(-5px)'"
                     onmouseout="this.style.transform='translateY(0)'">
                    <div class="card-body p-3">
                        @if($project->images->first())
                        <img src="{{ asset('storage/' . $project->images->first()->image_path) }}"
                             class="w-100 rounded mb-2"
                             style="height: 120px; object-fit: cover;"
                             alt="{{ localized_field($project, 'title') }}">
                        @endif
                        <h6 class="fw-bold mb-2" style="color: #4B0082; font-size: 0.9rem;">
                            {{ Str::limit(localized_field($project, 'title'), 40) }}
                        </h6>
                        <div class="progress mb-2" style="height: 6px;">
                            <div class="progress-bar"
                                 style="width: {{ $project->progress_percentage }}%; background: linear-gradient(90deg, #4B0082, #FF9800);">
                            </div>
                        </div>
                        <small class="text-muted">
                            <i class="fas fa-chart-line me-1"></i>{{ number_format($project->progress_percentage, 0) }}% {{ app()->getLocale() == 'en' ? 'achieved' : 'atteint' }}
                        </small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @if($projects->count() > 4)
        <div class="text-center mt-3">
            <small class="text-muted">
                <i class="fas fa-info-circle me-1"></i>
                {{ app()->getLocale() == 'en' ? 'And' : 'Et' }} {{ $projects->count() - 4 }} {{ app()->getLocale() == 'en' ? 'other project(s) available in the form below' : 'autre(s) projet(s) disponible(s) dans le formulaire ci-dessous' }}
            </small>
        </div>
        @endif
    </div>
</section>
@endif

<!-- Formulaire de Don -->
<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Formulaire -->
            <div class="col-lg-8" data-aos="fade-right">
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-5">
                        <h3 class="fw-bold mb-4 text-primary">
                            <i class="fas fa-hand-holding-heart me-2"></i>
                            {{ app()->getLocale() == 'en' ? 'Complete Your Donation' : 'Complétez votre Don' }}
                        </h3>

                        <form action="{{ route('donate.store') }}" method="POST">
                            @csrf
                            <!-- Montant -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold fs-5">{{ app()->getLocale() == 'en' ? 'Donation Amount (FCFA)' : 'Montant du Don (FCFA)' }}</label>
                                <input type="number" class="form-control form-control-lg" name="amount" id="customAmount" placeholder="{{ app()->getLocale() == 'en' ? 'Enter the amount' : 'Entrez le montant' }}" min="1000" required>
                            </div>

                            <!-- Projet -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold fs-5">{{ app()->getLocale() == 'en' ? 'Choose a Project (Optional)' : 'Choisir un Projet (Optionnel)' }}</label>
                                <select class="form-select form-select-lg" name="project_id">
                                    <option value="">{{ app()->getLocale() == 'en' ? 'General donation (all projects)' : 'Don général (tous les projets)' }}</option>
                                    @foreach($projects as $project)
                                            <option value="{{ $project->id }}">
                                                {{ localized_field($project, 'title') }} - {{ number_format($project->progress_percentage, 0) }}% {{ app()->getLocale() == 'en' ? 'achieved' : 'atteint' }}
                                            </option>
                                    @endforeach
                                </select>
                                <small class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i>
                                    {{ app()->getLocale() == 'en' ? 'Select a specific project or leave empty for a general donation' : 'Sélectionnez un projet spécifique ou laissez vide pour un don général' }}
                                </small>
                            </div>

                            <!-- Informations Personnelles -->
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Full Name' : 'Nom complet' }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" name="donor_name" placeholder="{{ app()->getLocale() == 'en' ? 'John Doe' : 'John Doe' }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Email' : 'Email' }} <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control form-control-lg" name="donor_email" placeholder="{{ app()->getLocale() == 'en' ? 'your@email.com' : 'votre@email.com' }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Phone' : 'Téléphone' }}</label>
                                    <input type="tel" class="form-control form-control-lg" name="donor_phone" placeholder="+225 XX XX XX XX XX">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Country' : 'Pays' }}</label>
                                    <select class="form-select form-select-lg" name="country">
                                        <option>{{ app()->getLocale() == 'en' ? 'Ivory Coast' : 'Côte d\'Ivoire' }}</option>
                                        <option>{{ app()->getLocale() == 'en' ? 'France' : 'France' }}</option>
                                        <option>{{ app()->getLocale() == 'en' ? 'Burkina Faso' : 'Burkina Faso' }}</option>
                                        <option>{{ app()->getLocale() == 'en' ? 'Senegal' : 'Sénégal' }}</option>
                                        <option>{{ app()->getLocale() == 'en' ? 'Other' : 'Autre' }}</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Message -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Message (Optional)' : 'Message (Optionnel)' }}</label>
                                <textarea class="form-control" name="message" rows="3" placeholder="{{ app()->getLocale() == 'en' ? 'Leave an encouraging message...' : 'Laissez un message d\'encouragement...' }}"></textarea>
                            </div>

                            <!-- Options -->
                            <div class="mb-4">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="is_anonymous" id="anonymous" value="1">
                                    <label class="form-check-label" for="anonymous">
                                        {{ app()->getLocale() == 'en' ? 'Stay anonymous' : 'Rester anonyme' }}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="newsletter" id="newsletter" value="1">
                                    <label class="form-check-label" for="newsletter">
                                        {{ app()->getLocale() == 'en' ? 'Receive the newsletter' : 'Recevoir la newsletter' }}
                                    </label>
                                </div>
                            </div>

                            <!-- Bouton Submit -->
                            <button type="submit" class="btn btn-lg w-100"
                                    style="background: linear-gradient(135deg, #4B0082, #FF9800); color: white; font-weight: 600; padding: 1rem;">
                                <i class="fas fa-heart me-2"></i>
                                {{ app()->getLocale() == 'en' ? 'Finalize the Donation' : 'Finaliser le Don' }}
                            </button>

                            <p class="text-center text-muted mt-3 small">
                                <i class="fas fa-lock me-1"></i>
                                {{ app()->getLocale() == 'en' ? 'Your information is confidential and transmitted to the OWEW team' : 'Vos informations sont confidentielles et transmises à l\'équipe OWEW' }}
                            </p>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar Récapitulatif du Don -->
            <div class="col-lg-4" data-aos="fade-left">
                <div class="card border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, #4B0082, #6a1b9a); color: white;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">{{ app()->getLocale() == 'en' ? 'Donation Summary' : 'Récapitulatif du Don' }}</h5>
                        <div class="mb-3">
                            <span class="fw-semibold">{{ app()->getLocale() == 'en' ? 'Name:' : 'Nom :' }}</span>
                            <span id="recapName">-</span>
                        </div>
                        <div class="mb-3">
                            <span class="fw-semibold">{{ app()->getLocale() == 'en' ? 'Email:' : 'Email :' }}</span>
                            <span id="recapEmail">-</span>
                        </div>
                        <div class="mb-3">
                            <span class="fw-semibold">{{ app()->getLocale() == 'en' ? 'Amount:' : 'Montant :' }}</span>
                            <span id="recapAmount">-</span>
                        </div>
                        <div class="mb-3">
                            <span class="fw-semibold">{{ app()->getLocale() == 'en' ? 'Project:' : 'Projet :' }}</span>
                            <span id="recapProject">-</span>
                        </div>
                        <div class="mb-3">
                            <span class="fw-semibold">{{ app()->getLocale() == 'en' ? 'Message:' : 'Message :' }}</span>
                            <span id="recapMessage">-</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Témoignage -->
            @if($testimonial)
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <i class="fas fa-quote-left text-primary fa-2x mb-3"></i>
                    <p class="fst-italic mb-3">
                        "{{ $testimonial->content }}"
                    </p>
                    <div class="d-flex align-items-center">
                        <img src="{{ $testimonial->photo ? asset('storage/' . $testimonial->photo) : asset('frontend/img/default-avatar.png') }}"
                            class="rounded-circle me-2" style="width: 40px; height: 40px;">
                        <div>
                            <div class="fw-bold small">{{ $testimonial->author }}</div>
                            <small class="text-muted">{{ $testimonial->role ?? 'Bénéficiaire' }}</small>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>


<script>
    // Sélectionner un projet depuis les cartes
    function selectProject(projectId, projectTitle) {
        const selectElement = document.querySelector('select[name="project_id"]');
        selectElement.value = projectId;

        // Mettre à jour le récapitulatif
        document.getElementById('recapProject').innerText = projectTitle;

        // Scroll vers le formulaire
        document.querySelector('.card.border-0.shadow-lg').scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });

        // Animation de highlight
        selectElement.classList.add('border-success');
        setTimeout(() => {
            selectElement.classList.remove('border-success');
        }, 2000);
    }

    document.querySelector('input[name="donor_name"]').addEventListener('input', function(){
        document.getElementById('recapName').innerText = this.value || '-';
    });
    document.querySelector('input[name="donor_email"]').addEventListener('input', function(){
        document.getElementById('recapEmail').innerText = this.value || '-';
    });
    document.querySelector('input[name="amount"]').addEventListener('input', function(){
        document.getElementById('recapAmount').innerText = this.value ? this.value + ' FCFA' : '-';
    });
    document.querySelector('select[name="project_id"]').addEventListener('change', function(){
        document.getElementById('recapProject').innerText = this.options[this.selectedIndex].text || '-';
    });
    document.querySelector('textarea[name="message"]').addEventListener('input', function(){
        document.getElementById('recapMessage').innerText = this.value || '-';
    });
</script>

@endsection
