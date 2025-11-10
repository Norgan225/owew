@extends('layouts.base')

@section('title', 'Nous contacter - OWEW')


@section('content')
<!-- Hero Section -->
<section class="page-hero" style="background: linear-gradient(135deg, #4B0082, #6a1b9a); padding: 6rem 0 4rem; color: white;">
    <div class="container text-center">
        <h1 class="display-3 fw-bold mb-3" data-aos="fade-up">{{ app()->getLocale() == 'en' ? 'Contact Us' : 'Contactez-Nous' }}</h1>
        <p class="lead" data-aos="fade-up" data-aos-delay="100">{{ app()->getLocale() == 'en' ? 'We are here to answer all your questions' : 'Nous sommes là pour répondre à toutes vos questions' }}</p>
    </div>
</section>

<!-- Contact Section -->
<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Formulaire de Contact -->
            <div class="col-lg-8" data-aos="fade-right">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5">
                        <h3 class="fw-bold mb-4">{{ app()->getLocale() == 'en' ? 'Send Us a Message' : 'Envoyez-nous un Message' }}</h3>

                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif

                        @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif

                        @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>{{ app()->getLocale() == 'en' ? 'Error:' : 'Erreur :' }}</strong>
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif

                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Full Name' : 'Nom complet' }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror"
                                           name="name" placeholder="John Doe" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                                           name="email" placeholder="{{ app()->getLocale() == 'en' ? 'your@email.com' : 'votre@email.com' }}" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Phone' : 'Téléphone' }}</label>
                                    <input type="tel" class="form-control form-control-lg @error('phone') is-invalid @enderror"
                                           name="phone" placeholder="+225 XX XX XX XX XX" value="{{ old('phone') }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Subject' : 'Sujet' }} <span class="text-danger">*</span></label>
                                    <select class="form-select form-select-lg @error('subject') is-invalid @enderror" name="subject" required>
                                        <option value="">{{ app()->getLocale() == 'en' ? 'Choose...' : 'Choisir...' }}</option>
                                        <option value="Information générale" {{ old('subject') == 'Information générale' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'General Information' : 'Information générale' }}</option>
                                        <option value="Faire un don" {{ old('subject') == 'Faire un don' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Make a Donation' : 'Faire un don' }}</option>
                                        <option value="Devenir bénévole" {{ old('subject') == 'Devenir bénévole' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Become a Volunteer' : 'Devenir bénévole' }}</option>
                                        <option value="Partenariat" {{ old('subject') == 'Partenariat' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Partnership' : 'Partenariat' }}</option>
                                        <option value="Autre" {{ old('subject') == 'Autre' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Other' : 'Autre' }}</option>
                                    </select>
                                    @error('subject')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Message <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('message') is-invalid @enderror"
                                              name="message" rows="6" placeholder="{{ app()->getLocale() == 'en' ? 'Write your message here...' : 'Écrivez votre message ici...' }}" required>{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-lg px-5">
                                        <i class="fas fa-paper-plane me-2"></i>{{ app()->getLocale() == 'en' ? 'Send Message' : 'Envoyer le Message' }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Informations de Contact -->
            <div class="col-lg-4" data-aos="fade-left">
                <div class="card border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, #4B0082, #6a1b9a); color: white;">
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <div class="d-flex align-items-start mb-3">
                                <i class="fas fa-map-marker-alt fa-2x me-3 text-warning"></i>
                                <div>
                                    <h6 class="fw-bold mb-2">{{ app()->getLocale() == 'en' ? 'Address' : 'Adresse' }}</h6>
                                    <p class="mb-0 opacity-75">
                                        {{ $settings['contact']->where('key', 'contact_address_fr')->first()->value_fr ?? (app()->getLocale() == 'en' ? 'Address not provided' : 'Adresse non renseignée') }}
                                    </p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start mb-3">
                                <i class="fas fa-phone fa-2x me-3 text-warning"></i>
                                <div>
                                    <h6 class="fw-bold mb-2">{{ app()->getLocale() == 'en' ? 'Phone' : 'Téléphone' }}</h6>
                                    <p class="mb-0 opacity-75">
                                        {{ $settings['contact']->where('key', 'contact_phone')->first()->value_fr ?? (app()->getLocale() == 'en' ? 'Phone not provided' : 'Téléphone non renseigné') }}
                                    </p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start mb-3">
                                <i class="fas fa-envelope fa-2x me-3 text-warning"></i>
                                <div>
                                    <h6 class="fw-bold mb-2">Email</h6>
                                    <p class="mb-0 opacity-75">
                                        {{ $settings['contact']->where('key', 'contact_email')->first()->value_fr ?? (app()->getLocale() == 'en' ? 'Email not provided' : 'Email non renseigné') }}
                                    </p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start">
                                <i class="fas fa-clock fa-2x me-3 text-warning"></i>
                                <div>
                                    <h6 class="fw-bold mb-2">{{ app()->getLocale() == 'en' ? 'Hours' : 'Horaires' }}</h6>
                                    <p class="mb-0 opacity-75">
                                        {{ $settings['contact']->where('key', 'contact_hours')->first()->value_fr ?? (app()->getLocale() == 'en' ? 'Mon - Fri: 8am - 5pm <br> Sat: 9am - 1pm' : 'Lun - Ven: 8h - 17h <br> Sam: 9h - 13h') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4 text-center">
                        <h5 class="fw-bold mb-3">{{ app()->getLocale() == 'en' ? 'Follow Us' : 'Suivez-Nous' }}</h5>
                        <div class="d-flex justify-content-center gap-3">
                            <a href="{{ $settings['social']->where('key', 'social_facebook')->first()->value_fr ?? '#' }}" class="btn btn-primary btn-lg rounded-circle" style="width: 50px; height: 50px;">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="{{ $settings['social']->where('key', 'social_twitter')->first()->value_fr ?? '#' }}" class="btn btn-info btn-lg rounded-circle text-white" style="width: 50px; height: 50px;">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="{{ $settings['social']->where('key', 'social_instagram')->first()->value_fr ?? '#' }}" class="btn btn-danger btn-lg rounded-circle" style="width: 50px; height: 50px;">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="{{ $settings['social']->where('key', 'social_linkedin')->first()->value_fr ?? '#' }}" class="btn btn-primary btn-lg rounded-circle" style="width: 50px; height: 50px;">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Google Map -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="card border-0 shadow-sm overflow-hidden">
            @php
                $latitude = $settings['contact']->where('key', 'contact_latitude')->first()->value_fr ?? '5.3599517';
                $longitude = $settings['contact']->where('key', 'contact_longitude')->first()->value_fr ?? '-4.0082563';
            @endphp
            <iframe src="https://www.google.com/maps?q={{ $latitude }},{{ $longitude }}&hl=fr;z=14&amp;output=embed"
                    width="100%"
                    height="450"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"></iframe>
        </div>
    </div>
</section>
@endsection
