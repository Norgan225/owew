@extends('layouts.admin')

@section('title', app()->getLocale() == 'en' ? 'Edit Testimonial' : 'Modifier le Témoignage')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">{{ app()->getLocale() == 'en' ? 'Edit Testimonial' : 'Modifier le Témoignage' }}</h2>
            <p class="text-muted mb-0">{{ $testimonial->name }}</p>
        </div>
        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>{{ app()->getLocale() == 'en' ? 'Back to list' : 'Retour à la liste' }}
        </a>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Informations de la personne -->
                <div class="data-table mb-4">
                    <h5 class="fw-bold mb-4">
                        <i class="fas fa-user text-primary me-2"></i>{{ app()->getLocale() == 'en' ? 'Person Information' : 'Informations de la Personne' }}
                    </h5>

                    <!-- Nom -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Full Name' : 'Nom complet' }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               name="name" value="{{ old('name', $testimonial->name) }}" required
                               placeholder="{{ app()->getLocale() == 'en' ? 'Ex: Marie Kouassi' : 'Ex: Marie Kouassi' }}">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <!-- Rôle FR -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Role/Function (FR)' : 'Rôle/Fonction (FR)' }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('role_fr') is-invalid @enderror"
                                       name="role_fr" value="{{ old('role_fr', $testimonial->role_fr) }}" required
                                       placeholder="{{ app()->getLocale() == 'en' ? 'Ex: Beneficiary' : 'Ex: Bénéficiaire' }}">
                                @error('role_fr')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Rôle EN -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Role/Function (EN)' : 'Rôle/Fonction (EN)' }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('role_en') is-invalid @enderror"
                                       name="role_en" value="{{ old('role_en', $testimonial->role_en) }}" required
                                       placeholder="{{ app()->getLocale() == 'en' ? 'Ex: Beneficiary' : 'Ex: Beneficiary' }}">
                                @error('role_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Témoignage -->
                <div class="data-table mb-4">
                    <h5 class="fw-bold mb-4">
                        <i class="fas fa-comment-dots text-primary me-2"></i>{{ app()->getLocale() == 'en' ? 'Testimonial' : 'Témoignage' }}
                    </h5>

                    <!-- Contenu FR -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Testimonial (French)' : 'Témoignage (Français)' }} <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('content_fr') is-invalid @enderror"
                                  name="content_fr" rows="6" required
                                  placeholder="{{ app()->getLocale() == 'en' ? 'The testimonial in French...' : 'Le témoignage en français...' }}">{{ old('content_fr', $testimonial->content_fr) }}</textarea>
                        @error('content_fr')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Maximum 500 characters recommended' : 'Maximum 500 caractères recommandé' }}</small>
                    </div>

                    <!-- Contenu EN -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Testimonial (English)' : 'Témoignage (Anglais)' }} <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('content_en') is-invalid @enderror"
                                  name="content_en" rows="6" required
                                  placeholder="{{ app()->getLocale() == 'en' ? 'The testimonial in English...' : 'The testimonial in English...' }}">{{ old('content_en', $testimonial->content_en) }}</textarea>
                        @error('content_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Maximum 500 characters recommended' : 'Maximum 500 characters recommended' }}</small>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Image -->
                <div class="data-table mb-4">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-image text-primary me-2"></i>{{ app()->getLocale() == 'en' ? 'Person Photo' : 'Photo de la Personne' }}
                    </h5>

                    <!-- Current Image -->
                    @if($testimonial->image)
                    <div class="mb-3 text-center">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Current Photo' : 'Photo actuelle' }}</label>
                        <img src="{{ asset('storage/' . $testimonial->image) }}"
                             alt="{{ $testimonial->name }}"
                             class="rounded-circle"
                             style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Change Photo' : 'Changer la photo' }}</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror"
                               name="image" accept="image/*" id="imageInput">
                        @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Format: JPG, PNG (max 2MB)' : 'Format: JPG, PNG (max 2MB)' }}</small>
                    </div>

                    <!-- Image Preview -->
                    <div id="imagePreview" class="mt-3 text-center" style="display: none;">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Preview' : 'Aperçu' }}</label>
                        <img id="preview" src="" alt="Preview" class="img-fluid rounded-circle"
                             style="width: 150px; height: 150px; object-fit: cover;">
                    </div>

                    <div class="alert alert-info mt-3">
                        <small>
                            <i class="fas fa-info-circle me-1"></i>
                            {{ app()->getLocale() == 'en' ? 'For better rendering, use a square photo' : 'Pour un meilleur rendu, utilisez une photo carrée' }}
                        </small>
                    </div>
                </div>

                <!-- Évaluation -->
                <div class="data-table mb-4">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-star text-primary me-2"></i>{{ app()->getLocale() == 'en' ? 'Rating' : 'Évaluation' }}
                    </h5>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Rating' : 'Note' }} <span class="text-danger">*</span></label>
                        <div class="d-flex gap-2 mb-2">
                            @for($i = 1; $i <= 5; $i++)
                            <label class="rating-star" style="cursor: pointer;">
                                <input type="radio" name="rating" value="{{ $i }}"
                                       {{ old('rating', $testimonial->rating) == $i ? 'checked' : '' }}
                                       style="display: none;" required>
                                <i class="fas fa-star fa-2x" id="star-{{ $i }}"
                                   style="color: {{ old('rating', $testimonial->rating) >= $i ? '#F59E0B' : '#D1D5DB' }};"
                                   onclick="setRating({{ $i }})"></i>
                            </label>
                            @endfor
                        </div>
                        @error('rating')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Current rating' : 'Note actuelle' }}: {{ $testimonial->rating }}/5</small>
                    </div>
                </div>

                <!-- Publication -->
                <div class="data-table mb-4">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-eye text-primary me-2"></i>{{ app()->getLocale() == 'en' ? 'Publication' : 'Publication' }}
                    </h5>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="is_published" value="1"
                               id="is_published" {{ old('is_published', $testimonial->is_published) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="is_published">
                            {{ app()->getLocale() == 'en' ? 'Publish the testimonial' : 'Publier le témoignage' }}
                        </label>
                        <div><small class="text-muted">{{ app()->getLocale() == 'en' ? 'The testimonial will be visible on the site' : 'Le témoignage sera visible sur le site' }}</small></div>
                    </div>

                    <div class="alert alert-info">
                        <small>
                            <i class="fas fa-info-circle me-1"></i>
                            {{ app()->getLocale() == 'en' ? 'Check the box above and click "Save" to publish/unpublish' : 'Cochez la case ci-dessus et cliquez sur "Enregistrer" pour publier/dépublier' }}
                        </small>
                    </div>
                </div>

                <!-- Meta Info -->
                <div class="data-table mb-4">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-info text-primary me-2"></i>{{ app()->getLocale() == 'en' ? 'Information' : 'Informations' }}
                    </h5>
                    <div class="mb-2">
                        <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Created on' : 'Créé le' }}:</small><br>
                        <strong>{{ $testimonial->created_at->format('d/m/Y à H:i') }}</strong>
                    </div>
                    <div>
                        <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Last modified' : 'Dernière modification' }}:</small><br>
                        <strong>{{ $testimonial->updated_at->format('d/m/Y à H:i') }}</strong>
                    </div>
                </div>

                <!-- Actions -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary-custom btn-lg">
                        <i class="fas fa-save me-2"></i>{{ app()->getLocale() == 'en' ? 'Save Changes' : 'Enregistrer les Modifications' }}
                    </button>
                    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-2"></i>{{ app()->getLocale() == 'en' ? 'Cancel' : 'Annuler' }}
                    </a>
                    <button type="button" class="btn btn-outline-danger"
                            onclick="if(confirm(&quot;{{ app()->getLocale() == 'en' ? 'Are you sure you want to delete this testimonial?' : 'Êtes-vous sûr de vouloir supprimer ce témoignage ?' }}&quot;)) { document.getElementById('delete-form').submit(); }">
                        <i class="fas fa-trash me-2"></i>{{ app()->getLocale() == 'en' ? 'Delete Testimonial' : 'Supprimer le Témoignage' }}
                    </button>
                </div>
            </div>
        </div>
    </form>

    <!-- Delete Form -->
    <form id="delete-form" action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
</div>
@endsection

@push('scripts')
    <script>
        // Image preview
        document.getElementById('imageInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result;
                    document.getElementById('imagePreview').style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });

        // Star rating system
        function setRating(rating) {
            // Update radio button
            document.querySelector(`input[name="rating"][value="${rating}"]`).checked = true;

            // Update star colors
            for (let i = 1; i <= 5; i++) {
                const star = document.getElementById(`star-${i}`);
                if (i <= rating) {
                    star.style.color = '#F59E0B'; // Yellow/Orange
                } else {
                    star.style.color = '#D1D5DB'; // Gray
                }
            }
        }

        // Character counter for testimonials
        function updateCharCount(textarea, maxChars = 500) {
            const length = textarea.value.length;
            const color = length > maxChars ? 'text-danger' : 'text-muted';
            const small = textarea.nextElementSibling;
            if (small && small.tagName === 'SMALL') {
                small.className = color;
                small.textContent = `${length} / ${maxChars} caractères`;
            }
        }

        document.querySelector('textarea[name="content_fr"]')?.addEventListener('input', function() {
            updateCharCount(this);
        });

        document.querySelector('textarea[name="content_en"]')?.addEventListener('input', function() {
            updateCharCount(this);
        });
    </script>

    <style>
    .rating-star:hover i,
    .rating-star:hover ~ .rating-star i {
        color: #FCD34D !important;
    }
    </style>
@endpush
