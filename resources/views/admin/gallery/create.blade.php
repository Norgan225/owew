@extends('layouts.admin')

@section('title', app()->getLocale() == 'en' ? 'Add Media' : 'Ajouter un Média')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">{{ app()->getLocale() == 'en' ? 'Add Media to Gallery' : 'Ajouter un Média à la Galerie' }}</h2>
            <p class="text-muted mb-0">{{ app()->getLocale() == 'en' ? 'Upload images or add a video' : 'Télécharger des images ou ajouter une vidéo' }}</p>
        </div>
        <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>{{ app()->getLocale() == 'en' ? 'Back to Gallery' : 'Retour à la Galerie' }}
        </a>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Type de média -->
                <div class="data-table mb-4">
                    <h5 class="fw-bold mb-4">
                        <i class="fas fa-photo-video text-primary me-2"></i>{{ app()->getLocale() == 'en' ? 'Media Type' : 'Type de Média' }}
                    </h5>

                    <div class="mb-3">
                        <div class="btn-group w-100" role="group">
                            <input type="radio" class="btn-check" name="media_type" id="mediaTypeImage" value="image" checked>
                            <label class="btn btn-outline-primary" for="mediaTypeImage">
                                <i class="fas fa-image me-2"></i>{{ app()->getLocale() == 'en' ? 'Images' : 'Images' }}
                            </label>

                            <input type="radio" class="btn-check" name="media_type" id="mediaTypeVideo" value="video">
                            <label class="btn btn-outline-primary" for="mediaTypeVideo">
                                <i class="fas fa-video me-2"></i>{{ app()->getLocale() == 'en' ? 'Video' : 'Vidéo' }}
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Upload Zone Images -->
                <div class="data-table mb-4" id="imageUploadSection">
                    <h5 class="fw-bold mb-4">
                        <i class="fas fa-cloud-upload-alt text-primary me-2"></i>{{ app()->getLocale() == 'en' ? 'Upload Images' : 'Télécharger les Images' }}
                    </h5>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Images' : 'Images' }} <span class="text-danger">*</span></label>
                        <input type="file" class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror"
                               name="images[]" accept="image/*" id="imageInput" multiple>
                        @error('images')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @error('images.*')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            {{ app()->getLocale() == 'en' ? 'You can select multiple images. Format: JPG, PNG, WEBP (max 2MB per image). Recommended resolution: 1920x1080px' : 'Vous pouvez sélectionner plusieurs images. Format: JPG, PNG, WEBP (max 2MB par image). Résolution recommandée: 1920x1080px' }}
                        </small>
                    </div>

                    <!-- Images Preview -->
                    <div id="imagesPreview" class="mt-4" style="display: none;">
                        <label class="form-label fw-semibold">
                            {{ app()->getLocale() == 'en' ? 'Preview' : 'Aperçu' }} (<span id="imageCount">0</span> {{ app()->getLocale() == 'en' ? 'image(s) selected' : 'image(s) sélectionnée(s)' }})
                        </label>
                        <div class="row g-3" id="previewContainer"></div>
                    </div>
                </div>

                <!-- Upload Zone Vidéo -->
                <div class="data-table mb-4" id="videoUploadSection" style="display: none;">
                    <h5 class="fw-bold mb-4">
                        <i class="fas fa-link text-primary me-2"></i>{{ app()->getLocale() == 'en' ? 'Add a Video' : 'Ajouter une Vidéo' }}
                    </h5>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Video URL' : 'URL de la vidéo' }} <span class="text-danger">*</span></label>
                        <input type="url" class="form-control @error('video_url') is-invalid @enderror"
                               name="video_url" value="{{ old('video_url') }}"
                               placeholder="{{ app()->getLocale() == 'en' ? 'https://www.youtube.com/watch?v=... or https://vimeo.com/...' : 'https://www.youtube.com/watch?v=... ou https://vimeo.com/...' }}">
                        @error('video_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            {{ app()->getLocale() == 'en' ? 'Paste the full URL of your video from YouTube, Vimeo, or other platform' : 'Collez l\'URL complète de votre vidéo YouTube, Vimeo, ou autre plateforme' }}
                        </small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Thumbnail (Preview Image)' : 'Thumbnail (Miniature)' }}</label>
                        <input type="file" class="form-control @error('thumbnail') is-invalid @enderror"
                               name="thumbnail" accept="image/*" id="thumbnailInput">
                        @error('thumbnail')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            {{ app()->getLocale() == 'en' ? 'Preview image for the video (max 2MB)' : 'Image d\'aperçu pour la vidéo (max 2MB)' }}
                        </small>
                    </div>

                    <!-- Thumbnail Preview -->
                    <div id="thumbnailPreview" class="mt-3" style="display: none;">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Thumbnail Preview' : 'Aperçu du Thumbnail' }}</label>
                        <img id="thumbnailPreviewImg" src="" alt="Thumbnail" class="img-fluid rounded" style="max-height: 200px;">
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
                               name="title_fr" value="{{ old('title_fr') }}"
                               placeholder="{{ app()->getLocale() == 'en' ? 'Ex: School supplies distribution' : 'Ex: Distribution de fournitures scolaires' }}">
                        @error('title_fr')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Titre EN -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Title (English)' : 'Titre (Anglais)' }}</label>
                        <input type="text" class="form-control @error('title_en') is-invalid @enderror"
                               name="title_en" value="{{ old('title_en') }}"
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
                                  placeholder="{{ app()->getLocale() == 'en' ? 'Describe the image...' : 'Décrivez l\'image...' }}">{{ old('description_fr') }}</textarea>
                        @error('description_fr')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description EN -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Description (English)' : 'Description (Anglais)' }}</label>
                        <textarea class="form-control @error('description_en') is-invalid @enderror"
                                  name="description_en" rows="3"
                                  placeholder="{{ app()->getLocale() == 'en' ? 'Describe the image...' : 'Décrivez l\'image...' }}">{{ old('description_en') }}</textarea>
                        @error('description_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Catégorie -->
                <div class="data-table mb-4">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-folder text-primary me-2"></i>{{ app()->getLocale() == 'en' ? 'Category' : 'Catégorie' }}
                    </h5>

                                        <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Category' : 'Catégorie' }}</label>
                        <select class="form-select @error('category') is-invalid @enderror" name="category">
                            <option value="">{{ app()->getLocale() == 'en' ? 'Select a category...' : 'Sélectionner une catégorie...' }}</option>
                            @forelse($categories as $category)
                                <option value="{{ $category->slug }}" {{ old('category') === $category->slug ? 'selected' : '' }}>
                                    {{ localized_field($category, 'name') }}
                                </option>
                            @empty
                                <option value="projets" {{ old('category') === 'projets' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Projects' : 'Projets' }}</option>
                                <option value="evenements" {{ old('category') === 'evenements' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Events' : 'Événements' }}</option>
                                <option value="equipe" {{ old('category') === 'equipe' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Team' : 'Équipe' }}</option>
                                <option value="beneficiaires" {{ old('category') === 'beneficiaires' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Beneficiaries' : 'Bénéficiaires' }}</option>
                                <option value="partenaires" {{ old('category') === 'partenaires' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Partners' : 'Partenaires' }}</option>
                                <option value="autres" {{ old('category') === 'autres' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Others' : 'Autres' }}</option>
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
                               id="is_featured" {{ old('is_featured') ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="is_featured">
                            <i class="fas fa-star text-warning me-1"></i>{{ app()->getLocale() == 'en' ? 'Featured image' : 'Image vedette' }}
                        </label>
                        <div><small class="text-muted">{{ app()->getLocale() == 'en' ? 'Will appear first in the gallery' : 'Apparaîtra en premier dans la galerie' }}</small></div>
                    </div>

                    <!-- Published -->
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_published" value="1"
                               id="is_published" {{ old('is_published', true) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="is_published">
                            <i class="fas fa-eye text-success me-1"></i>{{ app()->getLocale() == 'en' ? 'Publish' : 'Publier' }}
                        </label>
                        <div><small class="text-muted">{{ app()->getLocale() == 'en' ? 'The image will be visible on the website' : 'L\'image sera visible sur le site' }}</small></div>
                    </div>
                </div>

                <!-- Tips -->
                <div class="alert alert-info">
                    <h6 class="fw-bold mb-2">
                        <i class="fas fa-lightbulb me-2"></i>{{ app()->getLocale() == 'en' ? 'Tips' : 'Conseils' }}
                    </h6>
                    <ul class="mb-0" style="font-size: 0.85rem;">
                        <li>{{ app()->getLocale() == 'en' ? 'Use high-quality images' : 'Utilisez des images de haute qualité' }}</li>
                        <li>{{ app()->getLocale() == 'en' ? 'Landscape format recommended (16:9)' : 'Format paysage recommandé (16:9)' }}</li>
                        <li>{{ app()->getLocale() == 'en' ? 'Avoid blurry images' : 'Évitez les images floues' }}</li>
                        <li>{{ app()->getLocale() == 'en' ? 'Compress large images' : 'Compressez les images volumineuses' }}</li>
                        <li>{{ app()->getLocale() == 'en' ? 'Add descriptive titles' : 'Ajoutez des titres descriptifs' }}</li>
                    </ul>
                </div>

                <!-- Actions -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary-custom btn-lg">
                        <i class="fas fa-upload me-2"></i>{{ app()->getLocale() == 'en' ? 'Add to Gallery' : 'Ajouter à la Galerie' }}
                    </button>
                    <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary">
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
    // Toggle between image and video sections
    const mediaTypeImage = document.getElementById('mediaTypeImage');
    const mediaTypeVideo = document.getElementById('mediaTypeVideo');
    const imageUploadSection = document.getElementById('imageUploadSection');
    const videoUploadSection = document.getElementById('videoUploadSection');
    const imageInput = document.getElementById('imageInput');

    mediaTypeImage.addEventListener('change', function() {
        if (this.checked) {
            imageUploadSection.style.display = 'block';
            videoUploadSection.style.display = 'none';
            imageInput.required = true;
        }
    });

    mediaTypeVideo.addEventListener('change', function() {
        if (this.checked) {
            imageUploadSection.style.display = 'none';
            videoUploadSection.style.display = 'block';
            imageInput.required = false;
        }
    });

    // Thumbnail preview
    const thumbnailInput = document.getElementById('thumbnailInput');
    if (thumbnailInput) {
        thumbnailInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('thumbnailPreviewImg').src = e.target.result;
                    document.getElementById('thumbnailPreview').style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Image upload logic (existing code)
    let selectedFiles = [];

    // Image preview with multiple files support
    document.getElementById('imageInput').addEventListener('change', function(e) {
        const files = Array.from(e.target.files);
        selectedFiles = files;

        if (files.length === 0) {
            document.getElementById('imagesPreview').style.display = 'none';
            return;
        }

        // Check file sizes
        const maxSize = 2 * 1024 * 1024; // 2MB (limite PHP locale)
        const invalidFiles = files.filter(file => file.size > maxSize);

        if (invalidFiles.length > 0) {
            alert(`${invalidFiles.length} {{ app()->getLocale() == 'en' ? 'image(s) exceed the maximum size of 2MB and will not be uploaded.' : 'image(s) dépassent la taille maximale de 2MB et ne seront pas téléchargées.' }}`);
            selectedFiles = files.filter(file => file.size <= maxSize);
        }

        // Display previews
        displayPreviews(selectedFiles);
    });

    function displayPreviews(files) {
        const container = document.getElementById('previewContainer');
        container.innerHTML = '';
        document.getElementById('imageCount').textContent = files.length;
        document.getElementById('imagesPreview').style.display = 'block';

        files.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = new Image();
                img.onload = function() {
                    const col = document.createElement('div');
                    col.className = 'col-md-4';
                    col.innerHTML = `
                        <div class="card">
                            <div class="position-relative">
                                <img src="${e.target.result}" class="card-img-top" style="height: 200px; object-fit: cover;">
                                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2" onclick="removeFile(${index})">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <div class="card-body p-2">
                                <small class="d-block text-truncate fw-semibold">${file.name}</small>
                                <small class="text-muted">${formatFileSize(file.size)} • ${img.width}x${img.height}px</small>
                            </div>
                        </div>
                    `;
                    container.appendChild(col);
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        });
    }

    function removeFile(index) {
        selectedFiles.splice(index, 1);

        // Update file input
        const dt = new DataTransfer();
        selectedFiles.forEach(file => dt.items.add(file));
        document.getElementById('imageInput').files = dt.files;

        displayPreviews(selectedFiles);

        if (selectedFiles.length === 0) {
            document.getElementById('imagesPreview').style.display = 'none';
        }
    }

    // Format file size
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
    }

    // Drag and drop support (use existing imageInput variable from above)
    const dropZone = document.getElementById('imageInput').closest('.data-table');

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => {
            dropZone.style.border = '2px dashed #4B0082';
            dropZone.style.background = '#f8f9fa';
        }, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => {
            dropZone.style.border = '';
            dropZone.style.background = '';
        }, false);
    });

    dropZone.addEventListener('drop', function(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        const imageInputElement = document.getElementById('imageInput');
        imageInputElement.files = files;

        // Trigger change event
        const event = new Event('change', { bubbles: true });
        imageInputElement.dispatchEvent(event);
    }, false);
</script>
@endpush
