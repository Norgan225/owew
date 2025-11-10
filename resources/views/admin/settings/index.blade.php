@extends('layouts.admin')

@php
    $pageTitle = app()->getLocale() == 'en' ? 'Site Settings' : 'Paramètres du Site';
@endphp

@section('title', $pageTitle)

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">{{ app()->getLocale() == 'en' ? 'Site Settings' : 'Paramètres du Site' }}</h2>
            <p class="text-muted mb-0">{{ app()->getLocale() == 'en' ? 'Manage your website global settings' : 'Gérer les paramètres globaux de votre site web' }}</p>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show animate-in" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show animate-in" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle me-2"></i>
        <strong>{{ app()->getLocale() == 'en' ? 'Validation errors:' : 'Erreurs de validation :' }}</strong>
        <ul class="mb-0 mt-2">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Sidebar Navigation -->
            <div class="col-lg-3 mb-4">
                <div class="stat-card sticky-top" style="top: 90px;">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-list-ul me-2 text-primary"></i>{{ app()->getLocale() == 'en' ? 'Sections' : 'Sections' }}
                    </h5>
                    <nav class="nav flex-column settings-nav">
                        <a class="nav-link active" href="#general" data-section="general">
                            <i class="fas fa-cog me-2"></i>{{ app()->getLocale() == 'en' ? 'General' : 'Général' }}
                        </a>
                        <a class="nav-link" href="#contact" data-section="contact">
                            <i class="fas fa-address-book me-2"></i>{{ app()->getLocale() == 'en' ? 'Contact' : 'Contact' }}
                        </a>
                        <a class="nav-link" href="#social" data-section="social">
                            <i class="fas fa-share-alt me-2"></i>{{ app()->getLocale() == 'en' ? 'Social Media' : 'Réseaux Sociaux' }}
                        </a>
                        <a class="nav-link" href="#seo" data-section="seo">
                            <i class="fas fa-search me-2"></i>SEO
                        </a>
                        <a class="nav-link" href="#email" data-section="email">
                            <i class="fas fa-envelope me-2"></i>{{ app()->getLocale() == 'en' ? 'Email' : 'Email' }}
                        </a>
                        <a class="nav-link" href="#appearance" data-section="appearance">
                            <i class="fas fa-palette me-2"></i>{{ app()->getLocale() == 'en' ? 'Appearance' : 'Apparence' }}
                        </a>
                        <a class="nav-link" href="#advanced" data-section="advanced">
                            <i class="fas fa-tools me-2"></i>{{ app()->getLocale() == 'en' ? 'Advanced' : 'Avancé' }}
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <!-- General Settings -->
                <div class="data-table mb-4 setting-section" id="general" data-section="general">
                    <div class="d-flex align-items-center mb-4">
                        <div class="stat-icon me-3" style="background: #EDE9FE; color: var(--primary); width: 50px; height: 50px;">
                            <i class="fas fa-cog"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-1">{{ app()->getLocale() == 'en' ? 'General Settings' : 'Paramètres Généraux' }}</h4>
                            <p class="text-muted mb-0">{{ app()->getLocale() == 'en' ? 'Basic site information' : 'Informations de base du site' }}</p>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Site Name (FR)' : 'Nom du Site (FR)' }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="settings[site_name_fr][value_fr]"
                                   value="{{ $settings['general']->where('key', 'site_name_fr')->first()->value_fr ?? 'OWEW' }}"
                                   required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Site Name (EN)' : 'Nom du Site (EN)' }}</label>
                            <input type="text" class="form-control" name="settings[site_name_en][value_en]"
                                   value="{{ $settings['general']->where('key', 'site_name_en')->first()->value_en ?? 'OWEW' }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Tagline (FR)' : 'Slogan (FR)' }}</label>
                            <input type="text" class="form-control" name="settings[site_tagline_fr][value_fr]"
                                   value="{{ $settings['general']->where('key', 'site_tagline_fr')->first()->value_fr ?? '' }}"
                                   placeholder="{{ app()->getLocale() == 'en' ? 'Your tagline in French' : 'Votre slogan en français' }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Tagline (EN)' : 'Slogan (EN)' }}</label>
                            <input type="text" class="form-control" name="settings[site_tagline_en][value_en]"
                                   value="{{ $settings['general']->where('key', 'site_tagline_en')->first()->value_en ?? '' }}"
                                   placeholder="{{ app()->getLocale() == 'en' ? 'Your tagline in English' : 'Votre slogan en anglais' }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Description (FR)' : 'Description (FR)' }}</label>
                            <textarea class="form-control" name="settings[site_description_fr][value_fr]" rows="3"
                                      placeholder="{{ app()->getLocale() == 'en' ? 'Description of your organization in French' : 'Description de votre organisation' }}">{{ $settings['general']->where('key', 'site_description_fr')->first()->value_fr ?? '' }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Description (EN)' : 'Description (EN)' }}</label>
                            <textarea class="form-control" name="settings[site_description_en][value_en]" rows="3"
                                      placeholder="{{ app()->getLocale() == 'en' ? 'Description of your organization' : 'Description de votre organisation en anglais' }}">{{ $settings['general']->where('key', 'site_description_en')->first()->value_en ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Contact Settings -->
                <div class="data-table mb-4 setting-section" id="contact" data-section="contact" style="display: none;">
                    <div class="d-flex align-items-center mb-4">
                        <div class="stat-icon me-3" style="background: #D1FAE5; color: #059669; width: 50px; height: 50px;">
                            <i class="fas fa-address-book"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-1">{{ app()->getLocale() == 'en' ? 'Contact Information' : 'Informations de Contact' }}</h4>
                            <p class="text-muted mb-0">{{ app()->getLocale() == 'en' ? 'Organization contact details' : 'Coordonnées de l\'organisation' }}</p>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-envelope text-primary me-2"></i>{{ app()->getLocale() == 'en' ? 'Primary Email' : 'Email Principal' }}
                            </label>
                            <input type="email" class="form-control" name="settings[contact_email][value_fr]"
                                   value="{{ $settings['contact']->where('key', 'contact_email')->first()->value_fr ?? '' }}"
                                   placeholder="contact@owew.org">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-phone text-success me-2"></i>{{ app()->getLocale() == 'en' ? 'Phone' : 'Téléphone' }}
                            </label>
                            <input type="text" class="form-control" name="settings[contact_phone][value_fr]"
                                   value="{{ $settings['contact']->where('key', 'contact_phone')->first()->value_fr ?? '' }}"
                                   placeholder="+225 XX XX XX XX XX">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-mobile-alt text-info me-2"></i>WhatsApp
                            </label>
                            <input type="text" class="form-control" name="settings[contact_whatsapp][value_fr]"
                                   value="{{ $settings['contact']->where('key', 'contact_whatsapp')->first()->value_fr ?? '' }}"
                                   placeholder="+225 XX XX XX XX XX">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-fax text-secondary me-2"></i>{{ app()->getLocale() == 'en' ? 'Fax' : 'Fax' }}
                            </label>
                            <input type="text" class="form-control" name="settings[contact_fax][value_fr]"
                                   value="{{ $settings['contact']->where('key', 'contact_fax')->first()->value_fr ?? '' }}"
                                   placeholder="{{ app()->getLocale() == 'en' ? 'Fax number' : 'Numéro de fax' }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-map-marker-alt text-danger me-2"></i>{{ app()->getLocale() == 'en' ? 'Address (FR)' : 'Adresse (FR)' }}
                            </label>
                            <textarea class="form-control" name="settings[contact_address_fr][value_fr]" rows="2"
                                      placeholder="{{ app()->getLocale() == 'en' ? 'Complete address in French' : 'Adresse complète' }}">{{ $settings['contact']->where('key', 'contact_address_fr')->first()->value_fr ?? '' }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-map-marker-alt text-danger me-2"></i>{{ app()->getLocale() == 'en' ? 'Address (EN)' : 'Adresse (EN)' }}
                            </label>
                            <textarea class="form-control" name="settings[contact_address_en][value_en]" rows="2"
                                      placeholder="{{ app()->getLocale() == 'en' ? 'Full address' : 'Adresse complète en anglais' }}">{{ $settings['contact']->where('key', 'contact_address_en')->first()->value_en ?? '' }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Latitude (Google Maps)' : 'Latitude (Google Maps)' }}</label>
                            <input type="text" class="form-control" name="settings[contact_latitude][value_fr]"
                                   value="{{ $settings['contact']->where('key', 'contact_latitude')->first()->value_fr ?? '' }}"
                                   placeholder="5.3599517">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Longitude (Google Maps)</label>
                            <input type="text" class="form-control" name="settings[contact_longitude][value_fr]"
                                   value="{{ $settings['contact']->where('key', 'contact_longitude')->first()->value_fr ?? '' }}"
                                   placeholder="-4.0082563">
                        </div>
                    </div>
                </div>

                <!-- Social Media Settings -->
                <div class="data-table mb-4 setting-section" id="social" data-section="social" style="display: none;">
                    <div class="d-flex align-items-center mb-4">
                        <div class="stat-icon me-3" style="background: #DBEAFE; color: #2563EB; width: 50px; height: 50px;">
                            <i class="fas fa-share-alt"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-1">{{ app()->getLocale() == 'en' ? 'Social Media' : 'Réseaux Sociaux' }}</h4>
                            <p class="text-muted mb-0">{{ app()->getLocale() == 'en' ? 'Links to your social profiles' : 'Liens vers vos profils sociaux' }}</p>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                <i class="fab fa-facebook text-primary me-2"></i>Facebook
                            </label>
                            <input type="url" class="form-control" name="settings[social_facebook][value_fr]"
                                   value="{{ $settings['social']->where('key', 'social_facebook')->first()->value_fr ?? '' }}"
                                   placeholder="{{ app()->getLocale() == 'en' ? 'https://facebook.com/yourpage' : 'https://facebook.com/votrepage' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                <i class="fab fa-twitter text-info me-2"></i>{{ app()->getLocale() == 'en' ? 'Twitter / X' : 'Twitter / X' }}
                            </label>
                            <input type="url" class="form-control" name="settings[social_twitter][value_fr]"
                                   value="{{ $settings['social']->where('key', 'social_twitter')->first()->value_fr ?? '' }}"
                                   placeholder="{{ app()->getLocale() == 'en' ? 'https://twitter.com/youraccount' : 'https://twitter.com/votrecompte' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                <i class="fab fa-instagram text-danger me-2"></i>Instagram
                            </label>
                            <input type="url" class="form-control" name="settings[social_instagram][value_fr]"
                                   value="{{ $settings['social']->where('key', 'social_instagram')->first()->value_fr ?? '' }}"
                                   placeholder="{{ app()->getLocale() == 'en' ? 'https://instagram.com/youraccount' : 'https://instagram.com/votrecompte' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                <i class="fab fa-linkedin text-primary me-2"></i>LinkedIn
                            </label>
                            <input type="url" class="form-control" name="settings[social_linkedin][value_fr]"
                                   value="{{ $settings['social']->where('key', 'social_linkedin')->first()->value_fr ?? '' }}"
                                   placeholder="https://linkedin.com/company/votrepage">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                <i class="fab fa-youtube text-danger me-2"></i>YouTube
                            </label>
                            <input type="url" class="form-control" name="settings[social_youtube][value_fr]"
                                   value="{{ $settings['social']->where('key', 'social_youtube')->first()->value_fr ?? '' }}"
                                   placeholder="https://youtube.com/@votrepage">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                <i class="fab fa-tiktok me-2"></i>TikTok
                            </label>
                            <input type="url" class="form-control" name="settings[social_tiktok][value_fr]"
                                   value="{{ $settings['social']->where('key', 'social_tiktok')->first()->value_fr ?? '' }}"
                                   placeholder="https://tiktok.com/@votrecompte">
                        </div>
                    </div>
                </div>

                <!-- SEO Settings -->
                <div class="data-table mb-4 setting-section" id="seo" data-section="seo" style="display: none;">
                    <div class="d-flex align-items-center mb-4">
                        <div class="stat-icon me-3" style="background: #FEF3C7; color: #D97706; width: 50px; height: 50px;">
                            <i class="fas fa-search"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-1">{{ app()->getLocale() == 'en' ? 'SEO Optimization' : 'Référencement SEO' }}</h4>
                            <p class="text-muted mb-0">{{ app()->getLocale() == 'en' ? 'Search engine optimization' : 'Optimisation pour les moteurs de recherche' }}</p>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Meta Title (FR)' : 'Meta Title (FR)' }}</label>
                            <input type="text" class="form-control seo-title-counter" name="settings[seo_title_fr][value_fr]"
                                   value="{{ $settings['seo']->where('key', 'seo_title_fr')->first()->value_fr ?? '' }}"
                                   placeholder="{{ app()->getLocale() == 'en' ? 'Title for search engines in French' : 'Titre pour les moteurs de recherche' }}"
                                   maxlength="60">
                            <small class="text-muted">
                                <span class="char-count" data-max="60">
                                    {{ strlen($settings['seo']->where('key', 'seo_title_fr')->first()->value_fr ?? '') }}/60 {{ app()->getLocale() == 'en' ? 'characters' : 'caractères' }}
                                </span>
                                <span class="text-success ms-2" id="seo-title-fr-status"></span>
                            </small>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Meta Title (EN)' : 'Meta Title (EN)' }}</label>
                            <input type="text" class="form-control seo-title-counter" name="settings[seo_title_en][value_en]"
                                   value="{{ $settings['seo']->where('key', 'seo_title_en')->first()->value_en ?? '' }}"
                                   placeholder="{{ app()->getLocale() == 'en' ? 'Title for search engines' : 'Titre pour les moteurs de recherche en anglais' }}"
                                   maxlength="60">
                            <small class="text-muted">
                                <span class="char-count" data-max="60">
                                    {{ strlen($settings['seo']->where('key', 'seo_title_en')->first()->value_en ?? '') }}/60 {{ app()->getLocale() == 'en' ? 'characters' : 'caractères' }}
                                </span>
                                <span class="text-success ms-2" id="seo-title-en-status"></span>
                            </small>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Meta Description (FR)' : 'Meta Description (FR)' }}</label>
                            <textarea class="form-control seo-description-counter" name="settings[seo_description_fr][value_fr]" rows="2"
                                      placeholder="{{ app()->getLocale() == 'en' ? 'Description for search engines in French' : 'Description pour les moteurs de recherche' }}"
                                      maxlength="160">{{ $settings['seo']->where('key', 'seo_description_fr')->first()->value_fr ?? '' }}</textarea>
                            <small class="text-muted">
                                <span class="char-count" data-max="160">
                                    {{ strlen($settings['seo']->where('key', 'seo_description_fr')->first()->value_fr ?? '') }}/160 {{ app()->getLocale() == 'en' ? 'characters' : 'caractères' }}
                                </span>
                                <span class="text-success ms-2" id="seo-description-fr-status"></span>
                            </small>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Meta Description (EN)' : 'Meta Description (EN)' }}</label>
                            <textarea class="form-control seo-description-counter" name="settings[seo_description_en][value_en]" rows="2"
                                      placeholder="{{ app()->getLocale() == 'en' ? 'Description for search engines' : 'Description pour les moteurs de recherche en anglais' }}"
                                      maxlength="160">{{ $settings['seo']->where('key', 'seo_description_en')->first()->value_en ?? '' }}</textarea>
                            <small class="text-muted">
                                <span class="char-count" data-max="160">
                                    {{ strlen($settings['seo']->where('key', 'seo_description_en')->first()->value_en ?? '') }}/160 {{ app()->getLocale() == 'en' ? 'characters' : 'caractères' }}
                                </span>
                                <span class="text-success ms-2" id="seo-description-en-status"></span>
                            </small>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Keywords (EN)' : 'Mots-clés (EN)' }}</label>
                            <input type="text" class="form-control" name="settings[seo_keywords_en][value_en]"
                                   value="{{ $settings['seo']->where('key', 'seo_keywords_en')->first()->value_en ?? '' }}"
                                   placeholder="keyword1, keyword2, keyword3">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Canonical URL' : 'URL Canonique' }}</label>
                            <input type="url" class="form-control" name="settings[canonical_url][value_fr]"
                                   value="{{ $settings['seo']->where('key', 'canonical_url')->first()->value_fr ?? '' }}"
                                   placeholder="https://www.owew.org">
                            <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Canonical URL for SEO (leave empty for auto)' : 'URL canonique pour le SEO (laisser vide pour auto)' }}</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Open Graph Title (FR)' : 'Titre Open Graph (FR)' }}</label>
                            <input type="text" class="form-control" name="settings[og_title_fr][value_fr]"
                                   value="{{ $settings['seo']->where('key', 'og_title_fr')->first()->value_fr ?? '' }}"
                                   placeholder="{{ app()->getLocale() == 'en' ? 'Title for social media sharing' : 'Titre pour le partage sur les réseaux sociaux' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Open Graph Title (EN)' : 'Titre Open Graph (EN)' }}</label>
                            <input type="text" class="form-control" name="settings[og_title_en][value_en]"
                                   value="{{ $settings['seo']->where('key', 'og_title_en')->first()->value_en ?? '' }}"
                                   placeholder="{{ app()->getLocale() == 'en' ? 'Title for social media sharing' : 'Titre pour le partage sur les réseaux sociaux' }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Open Graph Description (FR)' : 'Description Open Graph (FR)' }}</label>
                            <textarea class="form-control" name="settings[og_description_fr][value_fr]" rows="2"
                                      placeholder="{{ app()->getLocale() == 'en' ? 'Description for social media sharing' : 'Description pour le partage sur les réseaux sociaux' }}">{{ $settings['seo']->where('key', 'og_description_fr')->first()->value_fr ?? '' }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Open Graph Description (EN)' : 'Description Open Graph (EN)' }}</label>
                            <textarea class="form-control" name="settings[og_description_en][value_en]" rows="2"
                                      placeholder="{{ app()->getLocale() == 'en' ? 'Description for social media sharing' : 'Description pour le partage sur les réseaux sociaux' }}">{{ $settings['seo']->where('key', 'og_description_en')->first()->value_en ?? '' }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Open Graph Image' : 'Image Open Graph' }}</label>
                            <input type="file" class="form-control" name="og_image" accept="image/*">
                            @if($settings['seo']->where('key', 'og_image')->first() && $settings['seo']->where('key', 'og_image')->first()->value_fr)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $settings['seo']->where('key', 'og_image')->first()->value_fr) }}"
                                         alt="OG Image" class="img-thumbnail" style="max-width: 200px;">
                                    <small class="text-muted d-block">{{ app()->getLocale() == 'en' ? 'Current image' : 'Image actuelle' }}</small>
                                </div>
                            @endif
                            <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Recommended: 1200x630px' : 'Recommandé : 1200x630px' }}</small>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Twitter Card Type' : 'Type de Twitter Card' }}</label>
                            <select class="form-select" name="settings[twitter_card_type][value_fr]">
                                <option value="summary" {{ ($settings['seo']->where('key', 'twitter_card_type')->first()->value_fr ?? 'summary') == 'summary' ? 'selected' : '' }}>
                                    {{ app()->getLocale() == 'en' ? 'Summary' : 'Résumé' }}
                                </option>
                                <option value="summary_large_image" {{ ($settings['seo']->where('key', 'twitter_card_type')->first()->value_fr ?? 'summary') == 'summary_large_image' ? 'selected' : '' }}>
                                    {{ app()->getLocale() == 'en' ? 'Summary Large Image' : 'Résumé Grande Image' }}
                                </option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Robots Meta' : 'Meta Robots' }}</label>
                            <select class="form-select" name="settings[robots_meta][value_fr]">
                                <option value="index,follow" {{ ($settings['seo']->where('key', 'robots_meta')->first()->value_fr ?? 'index,follow') == 'index,follow' ? 'selected' : '' }}>
                                    {{ app()->getLocale() == 'en' ? 'Index, Follow' : 'Indexer, Suivre' }}
                                </option>
                                <option value="noindex,follow" {{ ($settings['seo']->where('key', 'robots_meta')->first()->value_fr ?? 'index,follow') == 'noindex,follow' ? 'selected' : '' }}>
                                    {{ app()->getLocale() == 'en' ? 'No Index, Follow' : 'Ne pas indexer, Suivre' }}
                                </option>
                                <option value="index,nofollow" {{ ($settings['seo']->where('key', 'robots_meta')->first()->value_fr ?? 'index,follow') == 'index,nofollow' ? 'selected' : '' }}>
                                    {{ app()->getLocale() == 'en' ? 'Index, No Follow' : 'Indexer, Ne pas suivre' }}
                                </option>
                                <option value="noindex,nofollow" {{ ($settings['seo']->where('key', 'robots_meta')->first()->value_fr ?? 'index,follow') == 'noindex,nofollow' ? 'selected' : '' }}>
                                    {{ app()->getLocale() == 'en' ? 'No Index, No Follow' : 'Ne pas indexer, Ne pas suivre' }}
                                </option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Google Analytics ID</label>
                            <input type="text" class="form-control" name="settings[google_analytics_id][value_fr]"
                                   value="{{ $settings['seo']->where('key', 'google_analytics_id')->first()->value_fr ?? '' }}"
                                   placeholder="G-XXXXXXXXXX ou UA-XXXXXXXXX-X">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Google Tag Manager ID</label>
                            <input type="text" class="form-control" name="settings[google_tag_manager_id][value_fr]"
                                   value="{{ $settings['seo']->where('key', 'google_tag_manager_id')->first()->value_fr ?? '' }}"
                                   placeholder="GTM-XXXXXXX">
                        </div>
                    </div>

                    <!-- SEO Tips -->
                    <div class="alert alert-info mt-4">
                        <h6 class="fw-bold mb-2">
                            <i class="fas fa-lightbulb me-2"></i>{{ app()->getLocale() == 'en' ? 'SEO Tips' : 'Conseils SEO' }}
                        </h6>
                        <ul class="mb-0 small">
                            <li>{{ app()->getLocale() == 'en' ? 'Meta title: 50-60 characters' : 'Meta title : 50-60 caractères' }}</li>
                            <li>{{ app()->getLocale() == 'en' ? 'Meta description: 150-160 characters' : 'Meta description : 150-160 caractères' }}</li>
                            <li>{{ app()->getLocale() == 'en' ? 'Include main keywords naturally' : 'Inclure les mots-clés principaux naturellement' }}</li>
                            <li>{{ app()->getLocale() == 'en' ? 'Open Graph image: 1200x630px recommended' : 'Image Open Graph : 1200x630px recommandé' }}</li>
                        </ul>
                    </div>
                </div>

                <!-- Email Settings -->
                <div class="data-table mb-4 setting-section" id="email" data-section="email" style="display: none;">
                    <div class="d-flex align-items-center mb-4">
                        <div class="stat-icon me-3" style="background: #FEE2E2; color: #DC2626; width: 50px; height: 50px;">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-1">{{ app()->getLocale() == 'en' ? 'Email Configuration' : 'Configuration Email' }}</h4>
                            <p class="text-muted mb-0">{{ app()->getLocale() == 'en' ? 'Email sending settings' : 'Paramètres d\'envoi d\'emails' }}</p>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Sender Email' : 'Email d\'envoi' }}</label>
                            <input type="email" class="form-control" name="settings[mail_from_address][value_fr]"
                                   value="{{ $settings['email']->where('key', 'mail_from_address')->first()->value_fr ?? '' }}"
                                   placeholder="noreply@owew.org">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Sender Name' : 'Nom de l\'expéditeur' }}</label>
                            <input type="text" class="form-control" name="settings[mail_from_name][value_fr]"
                                   value="{{ $settings['email']->where('key', 'mail_from_name')->first()->value_fr ?? '' }}"
                                   placeholder="OWEW">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Admin Notification Email' : 'Email de notification admin' }}</label>
                            <input type="email" class="form-control" name="settings[admin_notification_email][value_fr]"
                                   value="{{ $settings['email']->where('key', 'admin_notification_email')->first()->value_fr ?? '' }}"
                                   placeholder="admin@owew.org">
                            <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Email that will receive notifications (new donations, messages, etc.)' : 'Email qui recevra les notifications (nouveaux dons, messages, etc.)' }}</small>
                        </div>
                    </div>
                </div>

                <!-- Appearance Settings -->
                <div class="data-table mb-4 setting-section" id="appearance" data-section="appearance" style="display: none;">
                    <div class="d-flex align-items-center mb-4">
                        <div class="stat-icon me-3" style="background: #E0E7FF; color: #4F46E5; width: 50px; height: 50px;">
                            <i class="fas fa-palette"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-1">{{ app()->getLocale() == 'en' ? 'Appearance' : 'Apparence' }}</h4>
                            <p class="text-muted mb-0">{{ app()->getLocale() == 'en' ? 'Visual customization' : 'Personnalisation visuelle' }}</p>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Primary Color' : 'Couleur Primaire' }}</label>
                            <div class="input-group">
                                <input type="color" class="form-control form-control-color" name="settings[theme_primary_color][value_fr]"
                                       value="{{ $settings['appearance']->where('key', 'theme_primary_color')->first()->value_fr ?? '#4B0082' }}">
                                <input type="text" class="form-control" readonly
                                       value="{{ $settings['appearance']->where('key', 'theme_primary_color')->first()->value_fr ?? '#4B0082' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Secondary Color' : 'Couleur Secondaire' }}</label>
                            <div class="input-group">
                                <input type="color" class="form-control form-control-color" name="settings[theme_secondary_color][value_fr]"
                                       value="{{ $settings['appearance']->where('key', 'theme_secondary_color')->first()->value_fr ?? '#FF9800' }}">
                                <input type="text" class="form-control" readonly
                                       value="{{ $settings['appearance']->where('key', 'theme_secondary_color')->first()->value_fr ?? '#FF9800' }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <!-- Hidden field pour envoyer 0 si décoché -->
                            <input type="hidden" name="settings[maintenance_mode][value_fr]" value="0">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox"
                                    name="settings[maintenance_mode][value_fr]"
                                    id="maintenanceCheckbox"
                                    value="1"
                                    {{ ($settings['appearance']->where('key', 'maintenance_mode')->first()->value_fr ?? '0') == '1' ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="maintenanceCheckbox">
                                    {{ app()->getLocale() == 'en' ? 'Maintenance Mode' : 'Mode Maintenance' }}
                                    <small class="text-muted d-block">{{ app()->getLocale() == 'en' ? 'Temporarily disable the site for maintenance' : 'Désactiver temporairement le site pour maintenance' }}</small>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Advanced Settings -->
                <div class="data-table mb-4 setting-section" id="advanced" data-section="advanced" style="display: none;">
                    <div class="d-flex align-items-center mb-4">
                        <div class="stat-icon me-3" style="background: #F3F4F6; color: #6B7280; width: 50px; height: 50px;">
                            <i class="fas fa-tools"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-1">{{ app()->getLocale() == 'en' ? 'Advanced Settings' : 'Paramètres Avancés' }}</h4>
                            <p class="text-muted mb-0">{{ app()->getLocale() == 'en' ? 'Technical configuration' : 'Configuration technique' }}</p>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Custom Scripts (Header)' : 'Scripts personnalisés (Header)' }}</label>
                            <textarea class="form-control font-monospace" name="settings[custom_header_scripts][value_fr]" rows="4"
                                      placeholder="{{ app()->getLocale() == 'en' ? '<!-- Scripts to insert in <head> -->' : '<!-- Scripts à insérer dans le <head> -->' }}">{{ $settings['advanced']->where('key', 'custom_header_scripts')->first()->value_fr ?? '' }}</textarea>
                            <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Custom JavaScript or CSS code' : 'Code JavaScript ou CSS personnalisé' }}</small>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Custom Scripts (Footer)' : 'Scripts personnalisés (Footer)' }}</label>
                            <textarea class="form-control font-monospace" name="settings[custom_footer_scripts][value_fr]" rows="4"
                                      placeholder="{{ app()->getLocale() == 'en' ? '<!-- Scripts to insert before </body> -->' : '<!-- Scripts à insérer avant </body> -->' }}">{{ $settings['advanced']->where('key', 'custom_footer_scripts')->first()->value_fr ?? '' }}</textarea>
                        </div>
                        <div class="col-12">
                            <input type="hidden" name="settings[enable_donations][value_fr]" value="0">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox"
                                    name="settings[enable_donations][value_fr]"
                                    value="1"
                                    {{ ($settings['advanced']->where('key', 'enable_donations')->first()->value_fr ?? '1') == '1' ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Enable online donations' : 'Activer les dons en ligne' }}</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <input type="hidden" name="settings[enable_newsletter][value_fr]" value="0">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox"
                                    name="settings[enable_newsletter][value_fr]"
                                    value="1"
                                    {{ ($settings['advanced']->where('key', 'enable_newsletter')->first()->value_fr ?? '1') == '1' ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Enable newsletter' : 'Activer la newsletter' }}</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <input type="hidden" name="settings[enable_volunteers][value_fr]" value="0">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox"
                                    name="settings[enable_volunteers][value_fr]"
                                    value="1"
                                    {{ ($settings['advanced']->where('key', 'enable_volunteers')->first()->value_fr ?? '1') == '1' ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Enable volunteer applications' : 'Activer les inscriptions bénévoles' }}</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Save Button -->
                <div class="text-end">
                    <button type="submit" class="btn btn-primary-custom btn-lg px-5">
                        <i class="fas fa-save me-2"></i>{{ app()->getLocale() == 'en' ? 'Save all settings' : 'Enregistrer tous les paramètres' }}
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>


@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ========== VARIABLES DE TRADUCTION ==========
    const translations = {
        characters: '{{ app()->getLocale() == 'en' ? 'characters' : 'caractères' }}',
        ideal_50_60: '{{ app()->getLocale() == 'en' ? 'ideal: 50-60' : 'idéal: 50-60' }}',
        ideal_150_160: '{{ app()->getLocale() == 'en' ? 'ideal: 150-160' : 'idéal: 150-160' }}',
        unsaved_changes: '{{ app()->getLocale() == 'en' ? 'Unsaved changes' : 'Modifications non sauvegardées' }}',
        saving: '{{ app()->getLocale() == 'en' ? 'Saving...' : 'Enregistrement en cours...' }}',
        save_all_settings: '{{ app()->getLocale() == 'en' ? 'Save all settings' : 'Enregistrer tous les paramètres' }}',
        fill_required_fields: '{{ app()->getLocale() == 'en' ? '⚠️ Please fill in all required fields' : '⚠️ Veuillez remplir tous les champs obligatoires' }}',
        field_required: '{{ app()->getLocale() == 'en' ? 'This field is required' : 'Ce champ est requis' }}'
    };

    // ========== NAVIGATION ENTRE SECTIONS ==========
    const navLinks = document.querySelectorAll('.settings-nav .nav-link');
    const sections = document.querySelectorAll('.setting-section');

    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();

            // Retirer active de tous les liens
            navLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');

            // Cacher toutes les sections
            sections.forEach(section => section.style.display = 'none');

            // Afficher la section ciblée
            const targetSection = this.getAttribute('data-section');
            const targetElement = document.querySelector(`[data-section="${targetSection}"].setting-section`);
            if (targetElement) {
                targetElement.style.display = 'block';
                targetElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // ========== SYNC COULEURS (Color Picker <-> Text Input) ==========
    document.querySelectorAll('.form-control-color').forEach(colorInput => {
        const textInput = colorInput.parentElement.querySelector('input[readonly]');

        colorInput.addEventListener('input', function() {
            textInput.value = this.value;

            // Preview en temps réel des couleurs
            if (this.name.includes('theme_primary_color')) {
                document.documentElement.style.setProperty('--primary', this.value);
            }
            if (this.name.includes('theme_secondary_color')) {
                document.documentElement.style.setProperty('--secondary', this.value);
            }
        });
    });

    // ========== CONFIRMATION MODE MAINTENANCE ==========
    const maintenanceCheckbox = document.querySelector('input[name="settings[maintenance_mode][value_fr]"]');
    if (maintenanceCheckbox) {
        maintenanceCheckbox.addEventListener('change', function() {
            if (this.checked) {
                if (!confirm("{{ app()->getLocale() == 'en' ? '⚠️ Enable maintenance mode?\\n\\nThe site will no longer be accessible to visitors.' : '⚠️ Activer le mode maintenance ?\\n\\nLe site ne sera plus accessible aux visiteurs.' }}")) {
                    this.checked = false;
                }
            }
        });
    }

    // ========== VALIDATION URLs SOCIALES ==========
    document.querySelectorAll('input[name*="social_"]').forEach(input => {
        input.addEventListener('blur', function() {
            const url = this.value.trim();
            if (url && !url.startsWith('http://') && !url.startsWith('https://')) {
                if (confirm("{{ app()->getLocale() == 'en' ? 'This URL does not start with http:// or https://.\\n\\nAdd https:// automatically?' : 'Cette URL ne commence pas par http:// ou https://.\\n\\nAjouter https:// automatiquement ?' }}")) {
                    this.value = 'https://' + url;
                }
            }
        });
    });

    // ========== COMPTEUR CARACTÈRES SEO ==========
    // Meta Title (50-60 caractères)
    document.querySelectorAll('input[name*="seo_title"]').forEach(input => {
        const small = input.nextElementSibling;

        function updateCounter() {
            const length = input.value.length;
            const isGood = length >= 50 && length <= 60;
            small.textContent = `${length}/60 ${translations.characters} ${isGood ? '✓' : '(' + translations.ideal_50_60 + ')'}`;
            small.className = isGood ? 'text-success' : 'text-warning';
        }

        input.addEventListener('input', updateCounter);
        updateCounter(); // Init
    });

    // Meta Description (150-160 caractères)
    document.querySelectorAll('textarea[name*="seo_description"]').forEach(textarea => {
        const small = textarea.nextElementSibling;

        function updateCounter() {
            const length = textarea.value.length;
            const isGood = length >= 150 && length <= 160;
            small.textContent = `${length}/160 ${translations.characters} ${isGood ? '✓' : '(' + translations.ideal_150_160 + ')'}`;
            small.className = isGood ? 'text-success' : 'text-warning';
        }

        textarea.addEventListener('input', updateCounter);
        updateCounter(); // Init
    });

    // ========== DÉTECTION MODIFICATIONS & AVERTISSEMENT ==========
    let formModified = false;
    const form = document.querySelector('form');
    const inputs = form.querySelectorAll('input, textarea, select');
    const saveBtn = document.querySelector('button[type="submit"]');

    inputs.forEach(input => {
        input.addEventListener('change', () => {
            formModified = true;

            // Changer le style du bouton
            if (saveBtn && !saveBtn.classList.contains('btn-warning')) {
                saveBtn.classList.remove('btn-primary-custom');
                saveBtn.classList.add('btn-warning');
                saveBtn.innerHTML = '<i class="fas fa-exclamation-triangle me-2"></i>' + translations.unsaved_changes;
            }
        });
    });

    // Avertir avant de quitter la page
    window.addEventListener('beforeunload', (e) => {
        if (formModified) {
            e.preventDefault();
            e.returnValue = '';
        }
    });

    // Réinitialiser lors de la soumission
    form.addEventListener('submit', function() {
        formModified = false;

        if (saveBtn) {
            saveBtn.disabled = true;
            saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>' + translations.saving;
        }
    });

    // ========== GESTION CHECKBOXES ==========
    // Envoyer "0" pour les checkboxes non cochées
    form.addEventListener('submit', function() {
        document.querySelectorAll('input[type="checkbox"][name*="settings"]').forEach(checkbox => {
            if (!checkbox.checked && checkbox.name) {
                const hidden = document.createElement('input');
                hidden.type = 'hidden';
                hidden.name = checkbox.name;
                hidden.value = '0';
                checkbox.parentNode.appendChild(hidden);
            }
        });
    });

    // ========== AUTO-HIDE ALERTES ==========
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);

    // ========== VALIDATION FORMULAIRE ==========
    form.addEventListener('submit', function(e) {
        const requiredFields = this.querySelectorAll('[required]');
        let isValid = true;
        let firstInvalidField = null;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('is-invalid');

                if (!firstInvalidField) {
                    firstInvalidField = field;
                }

                // Ajouter message d'erreur si pas déjà présent
                if (!field.nextElementSibling || !field.nextElementSibling.classList.contains('invalid-feedback')) {
                    const errorMsg = document.createElement('div');
                    errorMsg.className = 'invalid-feedback';
                    errorMsg.textContent = translations.field_required;
                    field.parentNode.insertBefore(errorMsg, field.nextSibling);
                }
            } else {
                field.classList.remove('is-invalid');
            }
        });

        if (!isValid) {
            e.preventDefault();

            // Scroll vers le premier champ invalide
            if (firstInvalidField) {
                firstInvalidField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstInvalidField.focus();
            }

            alert(translations.fill_required_fields);

            // Réactiver le bouton
            if (saveBtn) {
                saveBtn.disabled = false;
                saveBtn.classList.remove('btn-warning');
                saveBtn.classList.add('btn-primary-custom');
                saveBtn.innerHTML = '<i class="fas fa-save me-2"></i>' + translations.save_all_settings;
            }
        }
    });

    // ========== RACCOURCIS CLAVIER ==========
    document.addEventListener('keydown', function(e) {
        // Ctrl+S ou Cmd+S pour sauvegarder
        if ((e.ctrlKey || e.metaKey) && e.key === 's') {
            e.preventDefault();
            form.submit();
        }
    });
});
</script>

<style>
    /* Styles pour la navigation */
    .settings-nav .nav-link {
        padding: 0.75rem 1rem;
        border-radius: 8px;
        color: #6B7280;
        transition: all 0.3s ease;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
    }

    .settings-nav .nav-link:hover {
        background: #F3F4F6;
        color: var(--primary);
        transform: translateX(5px);
    }

    .settings-nav .nav-link.active {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(75, 0, 130, 0.3);
    }

    .settings-nav .nav-link i {
        width: 20px;
        text-align: center;
    }

    /* Animation pour les sections */
    .setting-section {
        animation: fadeIn 0.4s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(15px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Style pour les champs invalides */
    .is-invalid {
        border-color: #dc3545 !important;
        animation: shake 0.3s ease;
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
        });
    });

    // ========== COMPTEURS DE CARACTÈRES SEO ==========
    function updateCharCount(element, counterElement, statusElement) {
        const maxLength = parseInt(counterElement.dataset.max);
        const currentLength = element.value.length;
        const remaining = maxLength - currentLength;

        counterElement.textContent = `${currentLength}/${maxLength} ${currentLength === 1 ? 'caractère' : 'caractères'}`;

        // Indicateur visuel
        if (remaining < 0) {
            counterElement.style.color = '#dc3545'; // Rouge
            statusElement.innerHTML = '<i class="fas fa-exclamation-triangle"></i> Trop long';
            statusElement.className = 'text-danger ms-2';
        } else if (remaining <= 10) {
            counterElement.style.color = '#fd7e14'; // Orange
            statusElement.innerHTML = '<i class="fas fa-exclamation-circle"></i> Presque plein';
            statusElement.className = 'text-warning ms-2';
        } else {
            counterElement.style.color = '#6c757d'; // Gris
            statusElement.innerHTML = '<i class="fas fa-check-circle"></i> Parfait';
            statusElement.className = 'text-success ms-2';
        }
    }

    // Initialiser les compteurs pour les champs SEO
    document.querySelectorAll('.seo-title-counter').forEach(input => {
        const counter = input.parentNode.querySelector('.char-count');
        const status = input.parentNode.querySelector('span[id$="-status"]');
        if (counter && status) {
            updateCharCount(input, counter, status);
            input.addEventListener('input', () => updateCharCount(input, counter, status));
        }
    });

    document.querySelectorAll('.seo-description-counter').forEach(textarea => {
        const counter = textarea.parentNode.querySelector('.char-count');
        const status = textarea.parentNode.querySelector('span[id$="-status"]');
        if (counter && status) {
            updateCharCount(textarea, counter, status);
            textarea.addEventListener('input', () => updateCharCount(textarea, counter, status));
        }
    });

    /* Color picker amélioré */
    .form-control-color {
        width: 60px;
        height: 45px;
        border: 2px solid #E5E7EB;
        cursor: pointer;
    }

    .form-control-color::-webkit-color-swatch {
        border-radius: 8px;
        border: none;
    }

    /* Badge pour compteur de caractères */
    .text-success {
        font-weight: 600;
    }

    /* Indicateur de modifications non sauvegardées */
    .btn-warning {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.8; }
    }
</style>
@endpush
