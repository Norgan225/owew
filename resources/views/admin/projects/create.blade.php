@extends('layouts.admin')

@php
    $pageTitle = app()->getLocale() == 'en' ? 'Create Project' : 'Créer un Projet';
@endphp

@section('title', $pageTitle)

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">{{ app()->getLocale() == 'en' ? 'Create New Project' : 'Créer un Nouveau Projet' }}</h2>
            <p class="text-muted mb-0">{{ app()->getLocale() == 'en' ? 'Add a new project to your organization' : 'Ajouter un nouveau projet à votre organisation' }}</p>
        </div>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>{{ app()->getLocale() == 'en' ? 'Back to list' : 'Retour à la liste' }}
        </a>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Informations Générales -->
                <div class="data-table mb-4">
                    <h5 class="fw-bold mb-4">
                        <i class="fas fa-info-circle text-primary me-2"></i>{{ app()->getLocale() == 'en' ? 'General Information' : 'Informations Générales' }}
                    </h5>

                    <!-- Titre FR -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Title (French)' : 'Titre (Français)' }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title_fr') is-invalid @enderror"
                               name="title_fr" value="{{ old('title_fr') }}" required
                               placeholder="{{ app()->getLocale() == 'en' ? 'Ex: Well Construction' : 'Ex: Construction d\'un puits' }}">
                        @error('title_fr')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Titre EN -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Title (English)' : 'Titre (Anglais)' }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title_en') is-invalid @enderror"
                               name="title_en" value="{{ old('title_en') }}" required
                               placeholder="{{ app()->getLocale() == 'en' ? 'Ex: Well Construction' : 'Ex: Well Construction' }}">
                        @error('title_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description FR -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Description (French)' : 'Description (Français)' }} <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description_fr') is-invalid @enderror"
                                  name="description_fr" rows="6" required
                                  placeholder="{{ app()->getLocale() == 'en' ? 'Detailed project description...' : 'Description détaillée du projet...' }}">{{ old('description_fr') }}</textarea>
                        @error('description_fr')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description EN -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Description (English)' : 'Description (Anglais)' }} <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description_en') is-invalid @enderror"
                                  name="description_en" rows="6" required
                                  placeholder="{{ app()->getLocale() == 'en' ? 'Detailed project description...' : 'Detailed project description...' }}">{{ old('description_en') }}</textarea>
                        @error('description_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Dates -->
                <div class="data-table mb-4">
                    <h5 class="fw-bold mb-4">
                        <i class="fas fa-calendar text-primary me-2"></i>{{ app()->getLocale() == 'en' ? 'Project Dates' : 'Dates du Projet' }}
                    </h5>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Start Date' : 'Date de début' }}</label>
                                <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                       name="start_date" value="{{ old('start_date') }}">
                                @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'End Date' : 'Date de fin' }}</label>
                                <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                       name="end_date" value="{{ old('end_date') }}">
                                @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">{{ app()->getLocale() == 'en' ? 'End date must be after start date' : 'La date de fin doit être après la date de début' }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Images -->
                <div class="data-table mb-4">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-image text-primary me-2"></i>{{ app()->getLocale() == 'en' ? 'Project Images' : 'Images du Projet' }}
                    </h5>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Add images' : 'Ajouter des images' }}</label>
                        <input type="file" class="form-control @error('images') is-invalid @enderror"
                            name="images[]" accept="image/*" id="imagesInput" multiple>
                        @error('images')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Format: JPG, PNG (max 2MB each). You can select multiple images.' : 'Format: JPG, PNG (max 2MB chacun). Vous pouvez sélectionner plusieurs images.' }}</small>
                    </div>

                    <!-- Preview des images -->
                    <div id="imagePreviewContainer" class="d-flex flex-wrap gap-2 mt-3" style="display: none !important;"></div>
                </div>

                <!-- Objectif Financier -->
                <div class="data-table mb-4">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-coins text-primary me-2"></i>{{ app()->getLocale() == 'en' ? 'Financial Goal' : 'Objectif Financier' }}
                    </h5>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Goal Amount (FCFA)' : 'Montant objectif (FCFA)' }} <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('goal_amount') is-invalid @enderror"
                               name="goal_amount" value="{{ old('goal_amount') }}" required min="0" step="1000"
                               placeholder="{{ app()->getLocale() == 'en' ? 'Ex: 5000000' : 'Ex: 5000000' }}">
                        @error('goal_amount')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Paramètres -->
                <div class="data-table mb-4">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-cog text-primary me-2"></i>{{ app()->getLocale() == 'en' ? 'Settings' : 'Paramètres' }}
                    </h5>

                    <!-- Statut -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Status' : 'Statut' }} <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" name="status" required>
                            <option value="">{{ app()->getLocale() == 'en' ? '-- Select --' : '-- Sélectionnez --' }}</option>
                            <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Active' : 'Actif' }}</option>
                            <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Completed' : 'Complété' }}</option>
                            <option value="archived" {{ old('status') === 'archived' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Archived' : 'Archivé' }}</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Projet en vedette -->
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="featured" value="1"
                               id="featured" {{ old('featured') ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="featured">
                            <i class="fas fa-star text-warning me-1"></i>{{ app()->getLocale() == 'en' ? 'Featured Project' : 'Projet en vedette' }}
                        </label>
                        <div><small class="text-muted">{{ app()->getLocale() == 'en' ? 'The project will appear first on the homepage' : 'Le projet apparaîtra en premier sur la page d\'accueil' }}</small></div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary-custom btn-lg">
                        <i class="fas fa-save me-2"></i>{{ app()->getLocale() == 'en' ? 'Create Project' : 'Créer le Projet' }}
                    </button>
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-2"></i>{{ app()->getLocale() == 'en' ? 'Cancel' : 'Annuler' }}
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    // Preview des images sélectionnées
    let selectedFiles = [];

    document.getElementById('imagesInput').addEventListener('change', function(e) {
        const files = Array.from(e.target.files);
        const previewContainer = document.getElementById('imagePreviewContainer');

        // Ajouter les nouveaux fichiers
        selectedFiles = files;

        // Vider le conteneur
        previewContainer.innerHTML = '';

        if (files.length > 0) {
            previewContainer.style.display = 'flex';

            files.forEach((file, index) => {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const previewDiv = document.createElement('div');
                    previewDiv.className = 'position-relative';
                    previewDiv.style.width = '100px';
                    previewDiv.style.height = '100px';

                    previewDiv.innerHTML = `
                        <img src="${e.target.result}"
                             class="rounded border"
                             style="width: 100%; height: 100%; object-fit: cover;">
                        <button type="button"
                                class="btn btn-danger btn-sm position-absolute"
                                style="top: -8px; right: -8px; width: 24px; height: 24px; padding: 0; border-radius: 50%; font-size: 14px; line-height: 1;"
                                onclick="removePreviewImage(${index})">
                            ×
                        </button>
                        <div class="small text-center mt-1 text-muted text-truncate" style="width: 100px;" title="${file.name}">
                            ${file.name}
                        </div>
                    `;

                    previewContainer.appendChild(previewDiv);
                };

                reader.readAsDataURL(file);
            });
        } else {
            previewContainer.style.display = 'none';
        }
    });

    // Supprimer une image du preview (avant upload)
    window.removePreviewImage = function(index) {
        selectedFiles.splice(index, 1);

        // Recréer le DataTransfer avec les fichiers restants
        const dt = new DataTransfer();
        selectedFiles.forEach(file => dt.items.add(file));

        document.getElementById('imagesInput').files = dt.files;

        // Re-trigger l'événement change pour rafraîchir le preview
        const event = new Event('change');
        document.getElementById('imagesInput').dispatchEvent(event);
    }

    // Auto generate slug (optional)
    document.querySelector('input[name="title_fr"]').addEventListener('input', function(e) {
        // This is just for preview, the actual slug is generated server-side
        console.log('Slug will be:', e.target.value.toLowerCase().replace(/ /g, '-'));
    });
</script>
@endpush
