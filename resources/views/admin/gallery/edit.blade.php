@extends('layouts.admin')

@section('title', app()->getLocale() == 'en' ? 'Edit Image' : 'Modifier l\'Image')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">{{ app()->getLocale() == 'en' ? 'Edit Image' : 'Modifier l\'Image' }}</h2>
            <p class="text-muted mb-0">{{ $gallery->title_fr ? localized_field($gallery, 'title') : (app()->getLocale() == 'en' ? 'Gallery image' : 'Image de la galerie') }}</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ asset('storage/' . $gallery->image_path) }}" class="btn btn-outline-primary" target="_blank">
                <i class="fas fa-eye me-2"></i>{{ app()->getLocale() == 'en' ? 'View image' : 'Voir l\'image' }}
            </a>
            <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>{{ app()->getLocale() == 'en' ? 'Back' : 'Retour' }}
            </a>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.gallery.update', $gallery) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Image actuelle -->
                <div class="data-table mb-4">
                    <h5 class="fw-bold mb-4">
                        <i class="fas fa-image text-primary me-2"></i>{{ app()->getLocale() == 'en' ? 'Current Image' : 'Image Actuelle' }}
                    </h5>

                    <div class="text-center mb-4">
                        <img src="{{ asset('storage/' . $gallery->image_path) }}"
                             alt="{{ localized_field($gallery, 'title') }}"
                             class="img-fluid rounded"
                             style="max-height: 400px;">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Replace image' : 'Remplacer l\'image' }}</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror"
                               name="image" accept="image/*" id="imageInput">
                        @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Format: JPG, PNG, WEBP (max 5MB). Leave empty to keep current image' : 'Format: JPG, PNG, WEBP (max 5MB). Laisser vide pour conserver l\'image actuelle' }}</small>
                    </div>

                    <!-- New Image Preview -->
                    <div id="imagePreview" class="mt-4" style="display: none;">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'New image (preview)' : 'Nouvelle image (aperçu)' }}</label>
                        <div class="position-relative">
                            <img id="preview" src="" alt="Preview" class="img-fluid rounded" style="max-height: 400px; width: 100%; object-fit: contain; background: #f3f4f6;">
                            <div class="position-absolute top-0 end-0 p-2">
                                <button type="button" class="btn btn-sm btn-danger" onclick="removeNewImage()">
                                    <i class="fas fa-times"></i> {{ app()->getLocale() == 'en' ? 'Cancel' : 'Annuler' }}
                                </button>
                            </div>
                        </div>
                        <div id="imageInfo" class="mt-2 p-3 bg-light rounded">
                            <div class="row g-2 small">
                                <div class="col-md-4">
                                    <strong>{{ app()->getLocale() == 'en' ? 'Name:' : 'Nom:' }}</strong> <span id="fileName"></span>
                                </div>
                                <div class="col-md-4">
                                    <strong>{{ app()->getLocale() == 'en' ? 'Size:' : 'Taille:' }}</strong> <span id="fileSize"></span>
                                </div>
                                <div class="col-md-4">
                                    <strong>{{ app()->getLocale() == 'en' ? 'Dimensions:' : 'Dimensions:' }}</strong> <span id="fileDimensions"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informations -->
                <div class="data-table mb-4">
                    <h5 class="fw-bold mb-4">
                        <i class="fas fa-info-circle text-primary me-2"></i>{{ app()->getLocale() == 'en' ? 'Image Information' : 'Informations de l\'Image' }}
                    </h5>

                    <!-- Titre FR -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Title (French)' : 'Titre (Français)' }}</label>
                        <input type="text" class="form-control @error('title_fr') is-invalid @enderror"
                               name="title_fr" value="{{ old('title_fr', $gallery->title_fr) }}"
                               placeholder="{{ app()->getLocale() == 'en' ? 'Ex: School supplies distribution' : 'Ex: Distribution de fournitures scolaires' }}">
                        @error('title_fr')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Titre EN -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Title (English)' : 'Titre (Anglais)' }}</label>
                        <input type="text" class="form-control @error('title_en') is-invalid @enderror"
                               name="title_en" value="{{ old('title_en', $gallery->title_en) }}"
                               placeholder="{{ app()->getLocale() == 'en' ? 'Ex: School supplies distribution' : 'Ex: Distribution de fournitures scolaires' }}">
                        @error('title_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description FR -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Description (French)' : 'Description (Français)' }}</label>
                        <textarea class="form-control @error('description_fr') is-invalid @enderror"
                                  name="description_fr" rows="3"
                                  placeholder="{{ app()->getLocale() == 'en' ? 'Describe the image...' : 'Décrivez l\'image...' }}">{{ old('description_fr', $gallery->description_fr) }}</textarea>
                        @error('description_fr')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description EN -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Description (English)' : 'Description (Anglais)' }}</label>
                        <textarea class="form-control @error('description_en') is-invalid @enderror"
                                  name="description_en" rows="3"
                                  placeholder="{{ app()->getLocale() == 'en' ? 'Describe the image...' : 'Décrivez l\'image...' }}">{{ old('description_en', $gallery->description_en) }}</textarea>
                        @error('description_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Catégorie -->
                                <!-- Catégorie -->
                <div class="data-table mb-4">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-folder text-primary me-2"></i>{{ app()->getLocale() == 'en' ? 'Category' : 'Catégorie' }}
                    </h5>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Category' : 'Catégorie' }}</label>
                        <select class="form-select @error('category') is-invalid @enderror" name="category">
                            <option value="">{{ app()->getLocale() == 'en' ? '-- Select --' : '-- Sélectionnez --' }}</option>
                            @forelse($categories as $category)
                                <option value="{{ $category->slug }}" {{ old('category', $gallery->category) === $category->slug ? 'selected' : '' }}>
                                    {{ localized_field($category, 'name') }}
                                </option>
                            @empty
                                <option value="projets" {{ old('category', $gallery->category) === 'projets' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Projects' : 'Projets' }}</option>
                                <option value="evenements" {{ old('category', $gallery->category) === 'evenements' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Events' : 'Événements' }}</option>
                                <option value="equipe" {{ old('category', $gallery->category) === 'equipe' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Team' : 'Équipe' }}</option>
                                <option value="beneficiaires" {{ old('category', $gallery->category) === 'beneficiaires' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Beneficiaries' : 'Bénéficiaires' }}</option>
                                <option value="partenaires" {{ old('category', $gallery->category) === 'partenaires' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Partners' : 'Partenaires' }}</option>
                                <option value="autres" {{ old('category', $gallery->category) === 'autres' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Others' : 'Autres' }}</option>
                            @endforelse
                        </select>
                        @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            {{ app()->getLocale() == 'en' ? 'You can manage categories from' : 'Vous pouvez gérer les catégories depuis' }} <a href="{{ route('admin.categories.index') }}" target="_blank">{{ app()->getLocale() == 'en' ? 'the categories page' : 'la page des catégories' }}</a>
                        </small>
                    </div>
                </div>

                <!-- Paramètres -->
                <div class="data-table mb-4">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-cog text-primary me-2"></i>{{ app()->getLocale() == 'en' ? 'Settings' : 'Paramètres' }}
                    </h5>

                    <!-- Featured -->
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="is_featured" value="1"
                               id="is_featured" {{ old('is_featured', $gallery->is_featured) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="is_featured">
                            <i class="fas fa-star text-warning me-1"></i>{{ app()->getLocale() == 'en' ? 'Featured image' : 'Image vedette' }}
                        </label>
                        <div><small class="text-muted">{{ app()->getLocale() == 'en' ? 'Will appear first in the gallery' : 'Apparaîtra en premier dans la galerie' }}</small></div>
                    </div>

                    <!-- Published -->
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_published" value="1"
                               id="is_published" {{ old('is_published', $gallery->is_published) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="is_published">
                            <i class="fas fa-eye text-success me-1"></i>{{ app()->getLocale() == 'en' ? 'Publish' : 'Publier' }}
                        </label>
                        <div><small class="text-muted">{{ app()->getLocale() == 'en' ? 'The image will be visible on the website' : 'L\'image sera visible sur le site' }}</small></div>
                    </div>
                </div>

                <!-- Meta Info -->
                <div class="data-table mb-4">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-info text-primary me-2"></i>{{ app()->getLocale() == 'en' ? 'Information' : 'Informations' }}
                    </h5>
                    <div class="mb-2">
                        <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Path:' : 'Chemin:' }}</small><br>
                        <code style="font-size: 0.75rem; word-break: break-all;">{{ $gallery->image_path }}</code>
                    </div>
                    <div class="mb-2">
                        <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Added on:' : 'Ajoutée le:' }}</small><br>
                        <strong>{{ $gallery->created_at->format('d/m/Y à H:i') }}</strong>
                    </div>
                    <div>
                        <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Last modified:' : 'Dernière modification:' }}</small><br>
                        <strong>{{ $gallery->updated_at->format('d/m/Y à H:i') }}</strong>
                    </div>
                </div>

                <!-- Actions -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary-custom btn-lg">
                        <i class="fas fa-save me-2"></i>{{ app()->getLocale() == 'en' ? 'Save Changes' : 'Enregistrer les Modifications' }}
                    </button>
                    <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-2"></i>{{ app()->getLocale() == 'en' ? 'Cancel' : 'Annuler' }}
                    </a>
                    <button type="button" class="btn btn-outline-danger"
                            onclick="if(confirm(&quot;{{ app()->getLocale() == 'en' ? 'Are you sure you want to delete this image?' : 'Êtes-vous sûr de vouloir supprimer cette image ?' }}&quot;)) { document.getElementById('delete-form').submit(); }">
                        <i class="fas fa-trash me-2"></i>{{ app()->getLocale() == 'en' ? 'Delete Image' : 'Supprimer l\'Image' }}
                    </button>
                </div>
            </div>
        </div>
    </form>

    <!-- Delete Form -->
    <form id="delete-form" action="{{ route('admin.gallery.destroy', $gallery) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
</div>
@endsection

@push('scripts')
<script>
    // Image preview with detailed info
    document.getElementById('imageInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Check file size (5MB max)
            const maxSize = 5 * 1024 * 1024; // 5MB
            if (file.size > maxSize) {
                alert('{{ app()->getLocale() == 'en' ? 'Image size must not exceed 5MB' : 'La taille de l\'image ne doit pas dépasser 5MB' }}');
                this.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const img = new Image();
                img.onload = function() {
                    // Display preview
                    document.getElementById('preview').src = e.target.result;
                    document.getElementById('imagePreview').style.display = 'block';

                    // Display file info
                    document.getElementById('fileName').textContent = file.name;
                    document.getElementById('fileSize').textContent = formatFileSize(file.size);
                    document.getElementById('fileDimensions').textContent = `${img.width} x ${img.height}px`;
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    // Remove new image
    function removeNewImage() {
        document.getElementById('imageInput').value = '';
        document.getElementById('imagePreview').style.display = 'none';
    }

    // Format file size
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
    }
</script>
@endpush
