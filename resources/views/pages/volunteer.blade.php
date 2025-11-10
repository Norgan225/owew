@extends('layouts.base')

@section('title', 'Devenir un volontaire - OWEW')


@section('content')

    <!-- Section Héros -->
    <section class="page-hero" style="background: linear-gradient(135deg, #4B0082, #6a1b9a); padding: 6rem 0 4rem; color: white;">
        <div class="container text-center">
            <h1 class="display-3 fw-bold mb-3" data-aos="fade-up">{{ app()->getLocale() == 'en' ? 'Become a Volunteer' : 'Devenir Bénévole' }}</h1>
            <p class="lead" data-aos="fade-up" data-aos-delay="100">{{ app()->getLocale() == 'en' ? 'Join our team and change lives' : 'Rejoignez notre équipe et changez des vies' }}</p>
            <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                <ol class="breadcrumb justify-content-center" style="background: transparent;">
                    <li class="breadcrumb-item"><a href="/" style="color: #FF9800;">{{ app()->getLocale() == 'en' ? 'Home' : 'Accueil' }}</a></li>
                    <li class="breadcrumb-item active text-white">{{ app()->getLocale() == 'en' ? 'Become a Volunteer' : 'Devenir Bénévole' }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Pourquoi devenir bénévole -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <h2 class="display-5 fw-bold text-primary mb-4">{{ app()->getLocale() == 'en' ? 'Why Become a Volunteer?' : 'Pourquoi Devenir Bénévole ?' }}</h2>
                    <p class="lead text-muted mb-4">
                        {{ app()->getLocale() == 'en' ? 'Volunteering at OWEW is much more than just a contribution. It\'s an enriching experience that transforms lives, including yours.' : 'Faire du bénévolat chez OWEW, c\'est bien plus qu\'une simple contribution. C\'est une expérience enrichissante qui transforme des vies, y compris la vôtre.' }}
                    </p>
                    <div class="mb-4">
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-heart fa-2x text-danger me-3"></i>
                            <div>
                                <h5 class="fw-bold mb-2">{{ app()->getLocale() == 'en' ? 'Concrete Impact' : 'Impact Concret' }}</h5>
                                <p class="text-muted mb-0">{{ app()->getLocale() == 'en' ? 'See directly the positive impact of your actions on beneficiaries' : 'Voyez directement l\'impact positif de vos actions sur les bénéficiaires' }}</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-users fa-2x text-primary me-3"></i>
                            <div>
                                <h5 class="fw-bold mb-2">{{ app()->getLocale() == 'en' ? 'Supportive Network' : 'Réseau Solidaire' }}</h5>
                                <p class="text-muted mb-0">{{ app()->getLocale() == 'en' ? 'Join a community of committed and passionate people' : 'Rejoignez une communauté de personnes engagées et passionnées' }}</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-star fa-2x text-warning me-3"></i>
                            <div>
                                <h5 class="fw-bold mb-2">{{ app()->getLocale() == 'en' ? 'Personal Development' : 'Développement Personnel' }}</h5>
                                <p class="text-muted mb-0">{{ app()->getLocale() == 'en' ? 'Acquire new skills and valuable experiences' : 'Acquérez de nouvelles compétences et expériences valorisantes' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <img src="https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=600&h=500&fit=crop"
                        alt="Bénévoles" class="img-fluid rounded shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Domaines de bénévolat -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="display-5 fw-bold text-primary mb-3">{{ app()->getLocale() == 'en' ? 'Our Areas of Intervention' : 'Nos Domaines d\'Intervention' }}</h2>
                <p class="lead text-muted">{{ app()->getLocale() == 'en' ? 'Choose the area that matches your skills and passions' : 'Choisissez le domaine qui correspond à vos compétences et passions' }}</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4" data-aos="fade-up">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4 text-center">
                            <i class="fas fa-chalkboard-teacher fa-3x text-primary mb-3"></i>
                            <h5 class="fw-bold mb-3">{{ app()->getLocale() == 'en' ? 'Education & Training' : 'Éducation & Formation' }}</h5>
                            <p class="text-muted">{{ app()->getLocale() == 'en' ? 'School support, literacy, professional training' : 'Soutien scolaire, alphabétisation, formations professionnelles' }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4 text-center">
                            <i class="fas fa-stethoscope fa-3x text-danger mb-3"></i>
                            <h5 class="fw-bold mb-3">{{ app()->getLocale() == 'en' ? 'Health & Wellness' : 'Santé & Bien-être' }}</h5>
                            <p class="text-muted">{{ app()->getLocale() == 'en' ? 'Health awareness, medical support, psychological support' : 'Sensibilisation santé, accompagnement médical, soutien psychologique' }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4 text-center">
                            <i class="fas fa-bullhorn fa-3x text-warning mb-3"></i>
                            <h5 class="fw-bold mb-3">{{ app()->getLocale() == 'en' ? 'Communication' : 'Communication' }}</h5>
                            <p class="text-muted">{{ app()->getLocale() == 'en' ? 'Social media, writing, photography, video' : 'Réseaux sociaux, rédaction, photographie, vidéo' }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4 text-center">
                            <i class="fas fa-box-open fa-3x text-success mb-3"></i>
                            <h5 class="fw-bold mb-3">{{ app()->getLocale() == 'en' ? 'Logistics' : 'Logistique' }}</h5>
                            <p class="text-muted">{{ app()->getLocale() == 'en' ? 'Event organization, distributions, stock management' : 'Organisation événements, distributions, gestion stocks' }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4 text-center">
                            <i class="fas fa-laptop-code fa-3x text-info mb-3"></i>
                            <h5 class="fw-bold mb-3">{{ app()->getLocale() == 'en' ? 'Tech & Digital' : 'Tech & Digital' }}</h5>
                            <p class="text-muted">{{ app()->getLocale() == 'en' ? 'Web development, design, website maintenance' : 'Développement web, design, maintenance site internet' }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="500">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4 text-center">
                            <i class="fas fa-hands-helping fa-3x text-secondary mb-3"></i>
                            <h5 class="fw-bold mb-3">{{ app()->getLocale() == 'en' ? 'Field Work' : 'Terrain' }}</h5>
                            <p class="text-muted">{{ app()->getLocale() == 'en' ? 'Beneficiary visits, activities, direct assistance' : 'Visites aux bénéficiaires, animations, aide directe' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Formulaire de Candidature -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8" data-aos="fade-up">
                    <div class="card border-0 shadow-lg">
                        <div class="card-body p-5">
                            <h3 class="fw-bold text-primary mb-4 text-center">
                                <i class="fas fa-clipboard-list me-2"></i>
                                {{ app()->getLocale() == 'en' ? 'Application Form' : 'Formulaire de Candidature' }}
                            </h3>

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fas fa-check-circle me-2"></i>
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Erreur :</strong>
                                    <ul class="mb-0 mt-2">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="{{ route('volunteer.store') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Full Name' : 'Nom complet' }} <span class="text-danger">*</span></label>
                                        <input type="text"
                                               name="name"
                                               class="form-control form-control-lg @error('name') is-invalid @enderror"
                                               placeholder="{{ app()->getLocale() == 'en' ? 'John Doe' : 'John Doe' }}"
                                               value="{{ old('name') }}"
                                               required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Email' : 'Email' }} <span class="text-danger">*</span></label>
                                        <input type="email"
                                               name="email"
                                               class="form-control form-control-lg @error('email') is-invalid @enderror"
                                               placeholder="{{ app()->getLocale() == 'en' ? 'your@email.com' : 'votre@email.com' }}"
                                               value="{{ old('email') }}"
                                               required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Phone' : 'Téléphone' }} <span class="text-danger">*</span></label>
                                        <input type="tel"
                                               name="phone"
                                               class="form-control form-control-lg @error('phone') is-invalid @enderror"
                                               placeholder="+225 XX XX XX XX XX"
                                               value="{{ old('phone') }}"
                                               required>
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Age' : 'Âge' }}</label>
                                        <input type="number"
                                               name="age"
                                               class="form-control form-control-lg @error('age') is-invalid @enderror"
                                               placeholder="25"
                                               min="16"
                                               value="{{ old('age') }}">
                                        @error('age')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'City' : 'Ville' }}</label>
                                        <input type="text"
                                               name="city"
                                               class="form-control form-control-lg @error('city') is-invalid @enderror"
                                               placeholder="{{ app()->getLocale() == 'en' ? 'Abidjan' : 'Abidjan' }}"
                                               value="{{ old('city') }}">
                                        @error('city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Profession' : 'Profession' }}</label>
                                        <input type="text"
                                               name="profession"
                                               class="form-control form-control-lg @error('profession') is-invalid @enderror"
                                               placeholder="{{ app()->getLocale() == 'en' ? 'Student, Employee, etc.' : 'Étudiant, Salarié, etc.' }}"
                                               value="{{ old('profession') }}">
                                        @error('profession')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Area(s) of Interest' : 'Domaine(s) d\'intérêt' }} <span class="text-danger">*</span></label>
                                        <select name="areas_of_interest[]"
                                                class="form-select form-select-lg @error('areas_of_interest') is-invalid @enderror"
                                                multiple
                                                size="3"
                                                required>
                                            <option value="education" {{ in_array('education', old('areas_of_interest', [])) ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Education & Training' : 'Éducation & Formation' }}</option>
                                            <option value="sante" {{ in_array('sante', old('areas_of_interest', [])) ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Health & Wellness' : 'Santé & Bien-être' }}</option>
                                            <option value="communication" {{ in_array('communication', old('areas_of_interest', [])) ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Communication' : 'Communication' }}</option>
                                            <option value="logistique" {{ in_array('logistique', old('areas_of_interest', [])) ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Logistics' : 'Logistique' }}</option>
                                            <option value="tech" {{ in_array('tech', old('areas_of_interest', [])) ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Tech & Digital' : 'Tech & Digital' }}</option>
                                            <option value="terrain" {{ in_array('terrain', old('areas_of_interest', [])) ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Field Work' : 'Terrain' }}</option>
                                        </select>
                                        <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Hold Ctrl (Windows) or Cmd (Mac) to select multiple options' : 'Maintenez Ctrl (Windows) ou Cmd (Mac) pour sélectionner plusieurs options' }}</small>
                                        @error('areas_of_interest')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Your Skills' : 'Vos compétences' }}</label>
                                        <textarea name="skills"
                                                  class="form-control @error('skills') is-invalid @enderror"
                                                  rows="3"
                                                  placeholder="{{ app()->getLocale() == 'en' ? 'Describe your skills and relevant experiences...' : 'Décrivez vos compétences et expériences pertinentes...' }}">{{ old('skills') }}</textarea>
                                        @error('skills')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Availability' : 'Disponibilité' }}</label>
                                        <div class="form-check">
                                            <input class="form-check-input @error('availability') is-invalid @enderror"
                                                   type="radio"
                                                   name="availability"
                                                   id="weekend"
                                                   value="weekend"
                                                   {{ old('availability') == 'weekend' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="weekend">{{ app()->getLocale() == 'en' ? 'Weekends only' : 'Week-ends uniquement' }}</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input @error('availability') is-invalid @enderror"
                                                   type="radio"
                                                   name="availability"
                                                   id="evenings"
                                                   value="evenings"
                                                   {{ old('availability') == 'evenings' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="evenings">{{ app()->getLocale() == 'en' ? 'Week evenings' : 'Soirs de semaine' }}</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input @error('availability') is-invalid @enderror"
                                                   type="radio"
                                                   name="availability"
                                                   id="flexible"
                                                   value="flexible"
                                                   {{ old('availability') == 'flexible' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="flexible">{{ app()->getLocale() == 'en' ? 'Flexible' : 'Flexible' }}</label>
                                        </div>
                                        @error('availability')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Why do you want to volunteer?' : 'Pourquoi voulez-vous devenir bénévole ?' }} <span class="text-danger">*</span></label>
                                        <textarea name="motivation"
                                                  class="form-control @error('motivation') is-invalid @enderror"
                                                  rows="4"
                                                  placeholder="{{ app()->getLocale() == 'en' ? 'Share your motivation...' : 'Partagez votre motivation...' }}"
                                                  required>{{ old('motivation') }}</textarea>
                                        @error('motivation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="terms" required>
                                            <label class="form-check-label" for="terms">
                                                {{ app()->getLocale() == 'en' ? 'I commit to respecting the OWEW volunteer charter' : 'Je m\'engage à respecter la charte des bénévoles d\'OWEW' }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-lg w-100"
                                                style="background: linear-gradient(135deg, #4B0082, #FF9800); color: white; font-weight: 600; padding: 1rem;">
                                            <i class="fas fa-paper-plane me-2"></i>
                                            {{ app()->getLocale() == 'en' ? 'Submit My Application' : 'Soumettre ma Candidature' }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
