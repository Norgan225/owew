@extends('layouts.admin')

@php
    $pageTitle = app()->getLocale() == 'en' ? 'Edit Project' : 'Modifier le Projet';
@endphp

@section('title', $pageTitle)

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
            <h2 class="fw-bold mb-1">{{ app()->getLocale() == 'en' ? 'Edit Project' : 'Modifier le Projet' }}</h2>
            <p class="text-muted mb-0">{{ localized_field($project, 'title') }}</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('projects.show', $project->slug) }}" class="btn btn-outline-primary" target="_blank">
                <i class="fas fa-eye me-2"></i>{{ app()->getLocale() == 'en' ? 'View on site' : 'Voir sur le site' }}
            </a>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>{{ app()->getLocale() == 'en' ? 'Back' : 'Retour' }}
            </a>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

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
                               name="title_fr" value="{{ old('title_fr', $project->title_fr) }}" required
                               placeholder="{{ app()->getLocale() == 'en' ? 'Ex: Well Construction' : 'Ex: Construction d\'un puits' }}">
                        @error('title_fr')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Titre EN -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Title (English)' : 'Titre (Anglais)' }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title_en') is-invalid @enderror"
                               name="title_en" value="{{ old('title_en', $project->title_en) }}" required
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
                                  placeholder="{{ app()->getLocale() == 'en' ? 'Detailed project description...' : 'Description détaillée du projet...' }}">{{ old('description_fr', $project->description_fr) }}</textarea>
                        @error('description_fr')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description EN -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Description (English)' : 'Description (Anglais)' }} <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description_en') is-invalid @enderror"
                                  name="description_en" rows="6" required
                                  placeholder="{{ app()->getLocale() == 'en' ? 'Detailed project description...' : 'Detailed project description...' }}">{{ old('description_en', $project->description_en) }}</textarea>
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
                                       name="start_date" value="{{ old('start_date', $project->start_date ? $project->start_date->format('Y-m-d') : '') }}">
                                @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'End Date' : 'Date de fin' }}</label>
                                <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                       name="end_date" value="{{ old('end_date', $project->end_date ? $project->end_date->format('Y-m-d') : '') }}">
                                @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">{{ app()->getLocale() == 'en' ? 'End date must be after start date' : 'La date de fin doit être après la date de début' }}</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistiques -->
                <div class="data-table mb-4">
                    <h5 class="fw-bold mb-4">
                        <i class="fas fa-chart-line text-primary me-2"></i>{{ app()->getLocale() == 'en' ? 'Statistics' : 'Statistiques' }}
                    </h5>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="stat-card">
                                <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Goal' : 'Objectif' }}</div>
                                <div class="stat-value text-primary" style="font-size: 1.3rem;">
                                    {{ number_format($project->goal_amount, 0, ',', ' ') }} FCFA
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-card">
                                <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Raised' : 'Collecté' }}</div>
                                <div class="stat-value text-success" style="font-size: 1.3rem;">
                                    {{ number_format($project->raised_amount, 0, ',', ' ') }} FCFA
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-card">
                                <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Progress' : 'Progression' }}</div>
                                @php
                                    $percentage = $project->goal_amount > 0
                                        ? min(100, ($project->raised_amount / $project->goal_amount) * 100)
                                        : 0;
                                @endphp
                                <div class="stat-value text-warning" style="font-size: 1.3rem;">
                                    {{ number_format($percentage, 0) }}%
                                </div>
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

                    <!-- Images existantes -->
                    @if($project->images->count() > 0)
                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Existing Images' : 'Images existantes' }}</label>
                        <div class="d-flex flex-wrap gap-2" id="existingImages">
                            @foreach($project->images as $img)
                                <div class="position-relative" style="width: 100px; height: 100px;">
                                    <img src="{{ asset('storage/' . $img->image_path) }}"
                                        class="rounded border"
                                        style="width: 100%; height: 100%; object-fit: cover;">
                                    <!-- Bouton Supprimer -->
                                    <button type="button"
                                            class="btn btn-danger btn-sm position-absolute"
                                            style="top: -8px; right: -8px; width: 24px; height: 24px; padding: 0; border-radius: 50%; font-size: 14px; line-height: 1;"
                                            onclick="deleteImage({{ $img->id }}, this)">
                                        ×
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Upload nouvelles images -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Add New Images' : 'Ajouter de nouvelles images' }}</label>
                        <input type="file" name="images[]" id="imageInput" class="form-control" accept="image/*" multiple>
                        <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Format: JPG, PNG (max 2MB each)' : 'Format: JPG, PNG (max 2MB chacun)' }}</small>
                    </div>

                    <!-- Preview des nouvelles images -->
                    <div id="imagePreviewContainer" class="d-flex flex-wrap gap-2 mt-3" style="display: none !important;"></div>
                </div>

                <!-- Objectif Financier -->
                                <!-- Objectif Financier -->
                <div class="data-table mb-4">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-coins text-primary me-2"></i>{{ app()->getLocale() == 'en' ? 'Financial Goal' : 'Objectif Financier' }}
                    </h5>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Target Amount (FCFA)' : 'Montant Cible (FCFA)' }}</label>
                        <input type="number" name="goal_amount" class="form-control" value="{{ old('goal_amount', $project->goal_amount) }}" min="0" step="1000" required>
                        @error('goal_amount')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Current Amount Raised (FCFA)' : 'Montant Actuellement Collecté (FCFA)' }}</label>
                        <input type="number" name="raised_amount" class="form-control" value="{{ old('raised_amount', $project->raised_amount) }}" min="0" step="1000" required>
                        @error('raised_amount')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Paramètres -->
                <div class="data-table mb-4">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-cog text-primary me-2"></i>Paramètres
                    </h5>

                    <!-- Statut -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Statut <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" name="status" required>
                            <option value="">-- Sélectionnez --</option>
                            <option value="active" {{ old('status', $project->status) === 'active' ? 'selected' : '' }}>
                                Actif
                            </option>
                            <option value="completed" {{ old('status', $project->status) === 'completed' ? 'selected' : '' }}>
                                Complété
                            </option>
                            <option value="archived" {{ old('status', $project->status) === 'archived' ? 'selected' : '' }}>
                                Archivé
                            </option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Projet en vedette -->
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="featured" value="1"
                               id="featured" {{ old('featured', $project->featured) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="featured">
                            <i class="fas fa-star text-warning me-1"></i>{{ app()->getLocale() == 'en' ? 'Featured Project' : 'Projet en vedette' }}
                        </label>
                        <div><small class="text-muted">{{ app()->getLocale() == 'en' ? 'The project will appear first on the homepage' : 'Le projet apparaîtra en premier sur la page d\'accueil' }}</small></div>
                    </div>
                </div>

                <!-- Meta Info -->
                <div class="data-table mb-4">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-info text-primary me-2"></i>{{ app()->getLocale() == 'en' ? 'Information' : 'Informations' }}
                    </h5>
                    <div class="mb-2">
                        <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Slug:' : 'Slug:' }}</small><br>
                        <code>{{ $project->slug }}</code>
                    </div>
                    <div class="mb-2">
                        <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Created on:' : 'Créé le:' }}</small><br>
                        <strong>{{ $project->created_at->format('d/m/Y à H:i') }}</strong>
                    </div>
                    <div>
                        <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Last modified:' : 'Dernière modification:' }}</small><br>
                        <strong>{{ $project->updated_at->format('d/m/Y à H:i') }}</strong>
                    </div>
                </div>

                <!-- Actions -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary-custom btn-lg">
                        <i class="fas fa-save me-2"></i>{{ app()->getLocale() == 'en' ? 'Save Changes' : 'Enregistrer les Modifications' }}
                    </button>
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-2"></i>{{ app()->getLocale() == 'en' ? 'Cancel' : 'Annuler' }}
                    </a>
                </div>
            </div>
        </div>
    </form>

    <!-- Formulaire de suppression séparé -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-danger">
                <div class="card-body">
                    <h5 class="card-title text-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>{{ app()->getLocale() == 'en' ? 'Danger Zone' : 'Zone de danger' }}
                    </h5>
                    <p class="card-text text-muted">
                        {{ app()->getLocale() == 'en' ? 'Deleting this project is irreversible. All associated images and data will be permanently lost.' : 'La suppression de ce projet est irréversible. Toutes les images et données associées seront définitivement perdues.' }}
                    </p>
                    <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                        <i class="fas fa-trash me-2"></i>Supprimer définitivement ce projet
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulaire de suppression caché -->
    <form id="delete-form" action="{{ route('admin.projects.destroy', $project) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
</div>
@endsection

@push('scripts')
<script>
    // Preview des nouvelles images sélectionnées
    let selectedFiles = [];

    document.getElementById('imageInput').addEventListener('change', function(e) {
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
                        <div class="small text-center mt-1 text-muted">${file.name}</div>
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
    function removePreviewImage(index) {
        selectedFiles.splice(index, 1);

        // Recréer le DataTransfer avec les fichiers restants
        const dt = new DataTransfer();
        selectedFiles.forEach(file => dt.items.add(file));

        document.getElementById('imageInput').files = dt.files;

        // Re-trigger l'événement change pour rafraîchir le preview
        const event = new Event('change');
        document.getElementById('imageInput').dispatchEvent(event);
    }

    // Supprimer une image existante (via AJAX)
    function deleteImage(imageId, button) {
        if (!confirm('Êtes-vous sûr de vouloir supprimer cette image ?')) {
            return;
        }

        // Désactiver le bouton
        button.disabled = true;
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

        fetch(`/admin/project-images/${imageId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (response.ok) {
                // Supprimer l'élément du DOM
                button.closest('.position-relative').remove();

                // Afficher un message de succès
                showAlert('{{ app()->getLocale() == 'en' ? 'Image deleted successfully!' : 'Image supprimée avec succès !' }}', 'success');
            } else {
                throw new Error('Erreur lors de la suppression');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            showAlert('{{ app()->getLocale() == 'en' ? 'Error deleting image' : 'Erreur lors de la suppression de l\'image' }}', 'danger');
            button.disabled = false;
            button.innerHTML = '×';
        });
    }

    // Confirmer la suppression du projet
    function confirmDelete() {
        if (confirm('⚠️ {{ app()->getLocale() == 'en' ? 'WARNING' : 'ATTENTION' }} ⚠️\n\n{{ app()->getLocale() == 'en' ? 'Are you absolutely sure you want to delete this project?' : 'Êtes-vous absolument sûr de vouloir supprimer ce projet ?' }}\n\n{{ app()->getLocale() == 'en' ? 'This action is IRREVERSIBLE and will delete:' : 'Cette action est IRRÉVERSIBLE et supprimera :' }}\n{{ app()->getLocale() == 'en' ? '- The project\n- All its images\n- All associated data' : '- Le projet\n- Toutes ses images\n- Toutes les données associées' }}\n\n{{ app()->getLocale() == 'en' ? 'Type "DELETE" to confirm.' : 'Tapez "SUPPRIMER" pour confirmer.' }}')) {
            const confirmation = prompt('{{ app()->getLocale() == 'en' ? 'To confirm, type "DELETE" in uppercase:' : 'Pour confirmer, tapez "SUPPRIMER" en majuscules :' }}');
            if (confirmation === '{{ app()->getLocale() == 'en' ? 'DELETE' : 'SUPPRIMER' }}') {
                document.getElementById('delete-form').submit();
            } else {
                alert('{{ app()->getLocale() == 'en' ? 'Deletion cancelled.' : 'Suppression annulée.' }}');
            }
        }
    }

    // Afficher un message d'alerte
    function showAlert(message, type = 'success') {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
        alertDiv.innerHTML = `
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;

        const container = document.querySelector('.container-fluid');
        container.insertBefore(alertDiv, container.firstChild);

        // Auto-hide après 5 secondes
        setTimeout(() => {
            alertDiv.remove();
        }, 5000);
    }
</script>
@endpush
