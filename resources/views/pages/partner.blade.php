@extends('layouts.base')

@section('title', app()->getLocale() == 'en' ? 'Become a Partner - OWEW' : 'Devenir Partenaire - OWEW')


@section('content')
<!-- Hero Section -->
<section class="page-hero" style="background: linear-gradient(135deg, #4B0082, #6a1b9a); padding: 6rem 0 4rem; color: white;">
    <div class="container text-center">
        <h1 class="display-3 fw-bold mb-3" data-aos="fade-up">{{ app()->getLocale() == 'en' ? 'Become a Partner' : 'Devenir Partenaire' }}</h1>
        <p class="lead" data-aos="fade-up" data-aos-delay="100">{{ app()->getLocale() == 'en' ? 'Together, let\'s amplify our social impact' : 'Ensemble, amplifions notre impact social' }}</p>
        <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
            <ol class="breadcrumb justify-content-center" style="background: transparent;">
                <li class="breadcrumb-item"><a href="/" style="color: #FF9800;">{{ app()->getLocale() == 'en' ? 'Home' : 'Accueil' }}</a></li>
                <li class="breadcrumb-item active text-white">{{ app()->getLocale() == 'en' ? 'Become a Partner' : 'Devenir Partenaire' }}</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Introduction -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <h2 class="display-5 fw-bold text-primary mb-4">{{ app()->getLocale() == 'en' ? 'Why Become a Partner?' : 'Pourquoi Devenir Partenaire ?' }}</h2>
                <p class="lead text-muted mb-4">
                    {{ app()->getLocale() == 'en' ? 'By becoming a partner of OWEW, you join a network of organizations committed to sustainable and meaningful social impact.' : 'En devenant partenaire d\'OWEW, vous rejoignez un réseau d\'organisations engagées pour un impact social durable et significatif.' }}
                </p>
                <p class="mb-4">
                    {{ app()->getLocale() == 'en' ? 'Whether you are a company, foundation, institution or civil society organization, we offer partnership modalities adapted to your corporate social responsibility objectives.' : 'Que vous soyez une entreprise, une fondation, une institution ou une organisation de la société civile, nous vous proposons des modalités de partenariat adaptées à vos objectifs de responsabilité sociétale.' }}
                </p>
                <div class="d-flex gap-4 mb-4">
                    <div class="text-center">
                        <div class="display-4 fw-bold text-primary">50+</div>
                        <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Partners' : 'Partenaires' }}</small>
                    </div>
                    <div class="text-center">
                        <div class="display-4 fw-bold text-warning">100+</div>
                        <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Collaborations' : 'Collaborations' }}</small>
                    </div>
                    <div class="text-center">
                        <div class="display-4 fw-bold text-success">15+</div>
                        <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Countries' : 'Pays' }}</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <img src="https://images.unsplash.com/photo-1521791136064-7986c2920216?w=600&h=500&fit=crop"
                     alt="Partenariat" class="img-fluid rounded shadow-lg">
            </div>
        </div>
    </div>
</section>

<!-- Types de Partenariat -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold text-primary mb-3">{{ app()->getLocale() == 'en' ? 'Types of Partnership' : 'Types de Partenariat' }}</h2>
            <p class="lead text-muted">{{ app()->getLocale() == 'en' ? 'Flexible modalities adapted to your needs' : 'Des modalités flexibles adaptées à vos besoins' }}</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3" data-aos="fade-up">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="fas fa-handshake fa-4x text-primary"></i>
                        </div>
                        <h5 class="fw-bold mb-3">{{ app()->getLocale() == 'en' ? 'Strategic Partnership' : 'Partenariat Stratégique' }}</h5>
                        <p class="text-muted">
                            {{ app()->getLocale() == 'en' ? 'Long-term collaboration on specific programs aligned with your values and CSR objectives.' : 'Collaboration à long terme sur des programmes spécifiques alignés avec vos valeurs et objectifs RSE.' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="fas fa-money-check-alt fa-4x text-success"></i>
                        </div>
                        <h5 class="fw-bold mb-3">{{ app()->getLocale() == 'en' ? 'Financial Partnership' : 'Partenariat Financier' }}</h5>
                        <p class="text-muted">
                            {{ app()->getLocale() == 'en' ? 'Direct financial support to our projects with brand visibility and transparent reporting.' : 'Soutien financier direct à nos projets avec visibilité de votre marque et reporting transparent.' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="fas fa-lightbulb fa-4x text-warning"></i>
                        </div>
                        <h5 class="fw-bold mb-3">{{ app()->getLocale() == 'en' ? 'Technical Partnership' : 'Partenariat Technique' }}</h5>
                        <p class="text-muted">
                            {{ app()->getLocale() == 'en' ? 'Provision of skills, expertise or services (pro bono or at preferential rates).' : 'Mise à disposition de compétences, expertise ou services (pro bono ou à tarif préférentiel).' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="fas fa-users fa-4x text-danger"></i>
                        </div>
                        <h5 class="fw-bold mb-3">{{ app()->getLocale() == 'en' ? 'Institutional Partnership' : 'Partenariat Institutionnel' }}</h5>
                        <p class="text-muted">
                            {{ app()->getLocale() == 'en' ? 'Collaboration with public institutions, NGOs and international organizations.' : 'Collaboration avec institutions publiques, ONG et organisations internationales.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Avantages -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold text-primary mb-3">{{ app()->getLocale() == 'en' ? 'Benefits for Partners' : 'Avantages pour les Partenaires' }}</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-6" data-aos="fade-right">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-trophy fa-2x text-warning me-3"></i>
                            <div>
                                <h5 class="fw-bold mb-2">{{ app()->getLocale() == 'en' ? 'Positive Brand Image' : 'Image de Marque Positive' }}</h5>
                                <p class="text-muted mb-0">
                                    {{ app()->getLocale() == 'en' ? 'Strengthen your reputation and CSR commitment to your stakeholders.' : 'Renforcez votre réputation et votre engagement RSE auprès de vos parties prenantes.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6" data-aos="fade-left">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-chart-line fa-2x text-success me-3"></i>
                            <div>
                                <h5 class="fw-bold mb-2">{{ app()->getLocale() == 'en' ? 'Measurable Impact' : 'Impact Mesurable' }}</h5>
                                <p class="text-muted mb-0">
                                    {{ app()->getLocale() == 'en' ? 'Receive detailed reports on the concrete impact of your contribution.' : 'Recevez des rapports détaillés sur l\'impact concret de votre contribution.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6" data-aos="fade-right">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-megaphone fa-2x text-primary me-3"></i>
                            <div>
                                <h5 class="fw-bold mb-2">{{ app()->getLocale() == 'en' ? 'Visibility' : 'Visibilité' }}</h5>
                                <p class="text-muted mb-0">
                                    {{ app()->getLocale() == 'en' ? 'Logo on our communication materials, mentions on social networks, events.' : 'Logo sur nos supports de communication, mentions sur réseaux sociaux, événements.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6" data-aos="fade-left">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-network-wired fa-2x text-info me-3"></i>
                            <div>
                                <h5 class="fw-bold mb-2">{{ app()->getLocale() == 'en' ? 'Network & Synergies' : 'Réseau & Synergies' }}</h5>
                                <p class="text-muted mb-0">
                                    {{ app()->getLocale() == 'en' ? 'Access our network of partners and create positive synergies.' : 'Accédez à notre réseau de partenaires et créez des synergies positives.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6" data-aos="fade-right">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-file-invoice fa-2x text-danger me-3"></i>
                            <div>
                                <h5 class="fw-bold mb-2">{{ app()->getLocale() == 'en' ? 'Tax Benefits' : 'Avantages Fiscaux' }}</h5>
                                <p class="text-muted mb-0">
                                    {{ app()->getLocale() == 'en' ? 'Benefit from tax deductions according to current legislation.' : 'Bénéficiez de déductions fiscales selon la législation en vigueur.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6" data-aos="fade-left">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-hands-helping fa-2x text-success me-3"></i>
                            <div>
                                <h5 class="fw-bold mb-2">{{ app()->getLocale() == 'en' ? 'Employee Engagement' : 'Engagement Employés' }}</h5>
                                <p class="text-muted mb-0">
                                    {{ app()->getLocale() == 'en' ? 'Mobilize your employees around solidarity projects (team building).' : 'Mobilisez vos collaborateurs autour de projets solidaires (team building).' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Nos Partenaires Actuels -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold text-primary mb-3">{{ app()->getLocale() == 'en' ? 'They Trust Us' : 'Ils Nous Font Confiance' }}</h2>
        </div>
        <div class="row align-items-center justify-content-center g-4">
            <div class="col-6 col-md-3" data-aos="fade-up">
                <div class="card border-0 shadow-sm p-4 text-center">
                    <div class="text-muted fw-semibold">{{ app()->getLocale() == 'en' ? 'Partner Logo 1' : 'Logo Partenaire 1' }}</div>
                </div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="100">
                <div class="card border-0 shadow-sm p-4 text-center">
                    <div class="text-muted fw-semibold">{{ app()->getLocale() == 'en' ? 'Partner Logo 2' : 'Logo Partenaire 2' }}</div>
                </div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="200">
                <div class="card border-0 shadow-sm p-4 text-center">
                    <div class="text-muted fw-semibold">{{ app()->getLocale() == 'en' ? 'Partner Logo 3' : 'Logo Partenaire 3' }}</div>
                </div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="300">
                <div class="card border-0 shadow-sm p-4 text-center">
                    <div class="text-muted fw-semibold">{{ app()->getLocale() == 'en' ? 'Partner Logo 4' : 'Logo Partenaire 4' }}</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Formulaire de Contact Partenariat -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up">
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-5">
                        <h3 class="fw-bold text-primary mb-4 text-center">
                            <i class="fas fa-envelope me-2"></i>
                            {{ app()->getLocale() == 'en' ? 'Become a Partner' : 'Devenez Partenaire' }}
                        </h3>
                        <p class="text-center text-muted mb-4">
                            {{ app()->getLocale() == 'en' ? 'Fill out this form and our team will contact you within 48 hours' : 'Remplissez ce formulaire et notre équipe vous contactera dans les 48 heures' }}
                        </p>

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ app()->getLocale() == 'en' ? 'Error:' : 'Erreur :' }}</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('partnership.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Organization Name' : 'Nom de l\'Organisation' }} <span class="text-danger">*</span></label>
                                    <input type="text"
                                           name="organization_name"
                                           class="form-control form-control-lg @error('organization_name') is-invalid @enderror"
                                           placeholder="{{ app()->getLocale() == 'en' ? 'ABC Company' : 'Entreprise ABC' }}"
                                           value="{{ old('organization_name') }}"
                                           required>
                                    @error('organization_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Sector of Activity' : 'Secteur d\'Activité' }} <span class="text-danger">*</span></label>
                                    <select name="sector"
                                            class="form-select form-select-lg @error('sector') is-invalid @enderror"
                                            required>
                                        <option value="">{{ app()->getLocale() == 'en' ? 'Choose...' : 'Choisir...' }}</option>
                                        <option value="Technologie" {{ old('sector') == 'Technologie' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Technology' : 'Technologie' }}</option>
                                        <option value="Finance/Banque" {{ old('sector') == 'Finance/Banque' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Finance/Banking' : 'Finance/Banque' }}</option>
                                        <option value="Télécommunications" {{ old('sector') == 'Télécommunications' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Telecommunications' : 'Télécommunications' }}</option>
                                        <option value="Énergie" {{ old('sector') == 'Énergie' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Energy' : 'Énergie' }}</option>
                                        <option value="Santé" {{ old('sector') == 'Santé' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Health' : 'Santé' }}</option>
                                        <option value="Éducation" {{ old('sector') == 'Éducation' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Education' : 'Éducation' }}</option>
                                        <option value="Commerce/Distribution" {{ old('sector') == 'Commerce/Distribution' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Commerce/Distribution' : 'Commerce/Distribution' }}</option>
                                        <option value="Industrie" {{ old('sector') == 'Industrie' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Industry' : 'Industrie' }}</option>
                                        <option value="Services" {{ old('sector') == 'Services' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Services' : 'Services' }}</option>
                                        <option value="ONG/Association" {{ old('sector') == 'ONG/Association' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'NGO/Association' : 'ONG/Association' }}</option>
                                        <option value="Autre" {{ old('sector') == 'Autre' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Other' : 'Autre' }}</option>
                                    </select>
                                    @error('sector')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Contact Name' : 'Nom du Contact' }} <span class="text-danger">*</span></label>
                                    <input type="text"
                                           name="contact_name"
                                           class="form-control form-control-lg @error('contact_name') is-invalid @enderror"
                                           placeholder="{{ app()->getLocale() == 'en' ? 'John Doe' : 'John Doe' }}"
                                           value="{{ old('contact_name') }}"
                                           required>
                                    @error('contact_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Position' : 'Fonction' }}</label>
                                    <input type="text"
                                           name="contact_position"
                                           class="form-control form-control-lg @error('contact_position') is-invalid @enderror"
                                           placeholder="{{ app()->getLocale() == 'en' ? 'CSR Director' : 'Directeur RSE' }}"
                                           value="{{ old('contact_position') }}">
                                    @error('contact_position')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Email' : 'Email' }} <span class="text-danger">*</span></label>
                                    <input type="email"
                                           name="email"
                                           class="form-control form-control-lg @error('email') is-invalid @enderror"
                                           placeholder="{{ app()->getLocale() == 'en' ? 'contact@company.com' : 'contact@entreprise.com' }}"
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
                                <div class="col-12">
                                    <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Type of Partnership Considered' : 'Type de Partenariat Envisagé' }} <span class="text-danger">*</span></label>
                                    <div class="row g-2">
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input @error('partnership_types') is-invalid @enderror"
                                                       type="checkbox"
                                                       name="partnership_types[]"
                                                       value="financial"
                                                       id="financial"
                                                       {{ in_array('financial', old('partnership_types', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="financial">
                                                    <i class="fas fa-money-bill-wave text-success"></i> {{ app()->getLocale() == 'en' ? 'Financial' : 'Financier' }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input @error('partnership_types') is-invalid @enderror"
                                                       type="checkbox"
                                                       name="partnership_types[]"
                                                       value="technical"
                                                       id="technical"
                                                       {{ in_array('technical', old('partnership_types', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="technical">
                                                    <i class="fas fa-tools text-primary"></i> {{ app()->getLocale() == 'en' ? 'Technical' : 'Technique' }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input @error('partnership_types') is-invalid @enderror"
                                                       type="checkbox"
                                                       name="partnership_types[]"
                                                       value="volunteer"
                                                       id="volunteer"
                                                       {{ in_array('volunteer', old('partnership_types', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="volunteer">
                                                    <i class="fas fa-users text-info"></i> {{ app()->getLocale() == 'en' ? 'Volunteering' : 'Bénévolat' }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input @error('partnership_types') is-invalid @enderror"
                                                       type="checkbox"
                                                       name="partnership_types[]"
                                                       value="material"
                                                       id="material"
                                                       {{ in_array('material', old('partnership_types', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="material">
                                                    <i class="fas fa-box text-warning"></i> {{ app()->getLocale() == 'en' ? 'Material' : 'Matériel' }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input @error('partnership_types') is-invalid @enderror"
                                                       type="checkbox"
                                                       name="partnership_types[]"
                                                       value="advocacy"
                                                       id="advocacy"
                                                       {{ in_array('advocacy', old('partnership_types', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="advocacy">
                                                    <i class="fas fa-bullhorn text-danger"></i> {{ app()->getLocale() == 'en' ? 'Advocacy' : 'Plaidoyer' }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input @error('partnership_types') is-invalid @enderror"
                                                       type="checkbox"
                                                       name="partnership_types[]"
                                                       value="other"
                                                       id="other"
                                                       {{ in_array('other', old('partnership_types', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="other">
                                                    <i class="fas fa-ellipsis-h text-secondary"></i> {{ app()->getLocale() == 'en' ? 'Other' : 'Autre' }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @error('partnership_types')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Estimated Annual Budget (FCFA)' : 'Budget Annuel Estimé (FCFA)' }}</label>
                                    <select name="estimated_budget"
                                            class="form-select form-select-lg @error('estimated_budget') is-invalid @enderror">
                                        <option value="">{{ app()->getLocale() == 'en' ? 'Select...' : 'Sélectionner...' }}</option>
                                        <option value="500000" {{ old('estimated_budget') == '500000' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Less than 1 Million' : 'Moins de 1 Million' }}</option>
                                        <option value="3000000" {{ old('estimated_budget') == '3000000' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? '1 - 5 Millions' : '1 - 5 Millions' }}</option>
                                        <option value="7500000" {{ old('estimated_budget') == '7500000' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? '5 - 10 Millions' : '5 - 10 Millions' }}</option>
                                        <option value="30000000" {{ old('estimated_budget') == '30000000' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? '10 - 50 Millions' : '10 - 50 Millions' }}</option>
                                        <option value="75000000" {{ old('estimated_budget') == '75000000' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'More than 50 Millions' : 'Plus de 50 Millions' }}</option>
                                    </select>
                                    @error('estimated_budget')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Message / Partnership Objectives' : 'Message / Objectifs du Partenariat' }} <span class="text-danger">*</span></label>
                                    <textarea name="message"
                                              class="form-control @error('message') is-invalid @enderror"
                                              rows="5"
                                              placeholder="{{ app()->getLocale() == 'en' ? 'Describe your objectives and expectations...' : 'Décrivez vos objectifs et attentes...' }}"
                                              required>{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-lg w-100"
                                            style="background: linear-gradient(135deg, #4B0082, #FF9800); color: white; font-weight: 600; padding: 1rem;">
                                        <i class="fas fa-paper-plane me-2"></i>
                                        {{ app()->getLocale() == 'en' ? 'Send Request' : 'Envoyer la Demande' }}
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
