@extends('layouts.admin')

@php
    $pageTitle = app()->getLocale() == 'en' ? 'Create Article' : 'Créer un Article';
@endphp

@section('title', $pageTitle)

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">{{ app()->getLocale() == 'en' ? 'Create New Article' : 'Créer un Nouvel Article' }}</h2>
            <p class="text-muted mb-0">{{ app()->getLocale() == 'en' ? 'Write a new blog article' : 'Rédiger un nouvel article de blog' }}</p>
        </div>
        <a href="{{ route('admin.blog.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>{{ app()->getLocale() == 'en' ? 'Back to list' : 'Retour à la liste' }}
        </a>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Titres -->
                <div class="data-table mb-4">
                    <h5 class="fw-bold mb-4">
                        <i class="fas fa-heading text-primary me-2"></i>{{ app()->getLocale() == 'en' ? 'Titles' : 'Titres' }}
                    </h5>

                    <!-- Titre FR -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Title (French)' : 'Titre (Français)' }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title_fr') is-invalid @enderror"
                               name="title_fr" value="{{ old('title_fr') }}" required
                               placeholder="{{ app()->getLocale() == 'en' ? 'Ex: How to help underprivileged children' : 'Ex: Comment aider les enfants défavorisés' }}">
                        @error('title_fr')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Titre EN -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Title (English)' : 'Titre (Anglais)' }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title_en') is-invalid @enderror"
                               name="title_en" value="{{ old('title_en') }}" required
                               placeholder="{{ app()->getLocale() == 'en' ? 'Ex: How to help underprivileged children' : 'Ex: Comment aider les enfants défavorisés' }}">
                        @error('title_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Contenu -->
                <div class="data-table mb-4">
                    <h5 class="fw-bold mb-4">
                        <i class="fas fa-file-alt text-primary me-2"></i>{{ app()->getLocale() == 'en' ? 'Content' : 'Contenu' }}
                    </h5>

                    <!-- Contenu FR -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Content (French)' : 'Contenu (Français)' }} <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('content_fr') is-invalid @enderror"
                                  name="content_fr" rows="15" required
                                  placeholder="{{ app()->getLocale() == 'en' ? 'Write your article in French...' : 'Rédigez votre article en français...' }}">{{ old('content_fr') }}</textarea>
                        @error('content_fr')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">{{ app()->getLocale() == 'en' ? 'You can use HTML for formatting' : 'Vous pouvez utiliser du HTML pour le formatage' }}</small>
                    </div>

                    <!-- Contenu EN -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Content (English)' : 'Contenu (Anglais)' }} <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('content_en') is-invalid @enderror"
                                  name="content_en" rows="15" required
                                  placeholder="{{ app()->getLocale() == 'en' ? 'Write your article in English...' : 'Rédigez votre article en anglais...' }}">{{ old('content_en') }}</textarea>
                        @error('content_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">{{ app()->getLocale() == 'en' ? 'You can use HTML for formatting' : 'Vous pouvez utiliser du HTML pour le formatage' }}</small>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Publication -->
                <div class="data-table mb-4">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-paper-plane text-primary me-2"></i>{{ app()->getLocale() == 'en' ? 'Publication' : 'Publication' }}
                    </h5>

                    <!-- Statut -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Status' : 'Statut' }} <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" name="status" required>
                            <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Draft' : 'Brouillon' }}</option>
                            <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Published' : 'Publié' }}</option>
                            <option value="archived" {{ old('status') === 'archived' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Archived' : 'Archivé' }}</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Date de publication -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Publication Date' : 'Date de publication' }}</label>
                        <input type="datetime-local" class="form-control @error('published_at') is-invalid @enderror"
                               name="published_at" value="{{ old('published_at') }}">
                        @error('published_at')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Leave empty to publish immediately' : 'Laisser vide pour publier immédiatement' }}</small>
                    </div>
                </div>

                <!-- Image mise en avant -->
                <div class="data-table mb-4">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-image text-primary me-2"></i>{{ app()->getLocale() == 'en' ? 'Featured Image' : 'Image Mise en Avant' }}
                    </h5>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Main Image' : 'Image principale' }}</label>
                        <input type="file" class="form-control @error('featured_image') is-invalid @enderror"
                               name="featured_image" accept="image/*" id="imageInput">
                        @error('featured_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Format: JPG, PNG (max 2MB)' : 'Format: JPG, PNG (max 2MB)' }}</small>
                    </div>

                    <!-- Image Preview -->
                    <div id="imagePreview" class="mt-3" style="display: none;">
                        <img id="preview" src="" alt="Preview" class="img-fluid rounded">
                    </div>
                </div>

                <!-- Catégorie -->
                                <!-- Catégorie -->
                <div class="data-table mb-4">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-folder text-primary me-2"></i>{{ app()->getLocale() == 'en' ? 'Category' : 'Catégorie' }}
                    </h5>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Category' : 'Catégorie' }}</label>
                        <select class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                            <option value="">{{ app()->getLocale() == 'en' ? '-- No category --' : '-- Sans catégorie --' }}</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ localized_field($category, 'name') }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Actions -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary-custom btn-lg">
                        <i class="fas fa-save me-2"></i>{{ app()->getLocale() == 'en' ? 'Create Article' : 'Créer l\'Article' }}
                    </button>
                    <a href="{{ route('admin.blog.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-2"></i>{{ app()->getLocale() == 'en' ? 'Cancel' : 'Annuler' }}
                    </a>
                </div>

                <!-- Tips -->
                <div class="alert alert-info mt-4">
                    <h6 class="fw-bold mb-2">
                        <i class="fas fa-lightbulb me-2"></i>{{ app()->getLocale() == 'en' ? 'Tips' : 'Conseils' }}
                    </h6>
                    <ul class="mb-0" style="font-size: 0.85rem;">
                        <li>{{ app()->getLocale() == 'en' ? 'Use an attractive title' : 'Utilisez un titre accrocheur' }}</li>
                        <li>{{ app()->getLocale() == 'en' ? 'Add an attractive image' : 'Ajoutez une image attractive' }}</li>
                        <li>{{ app()->getLocale() == 'en' ? 'Structure your content' : 'Structurez votre contenu' }}</li>
                        <li>{{ app()->getLocale() == 'en' ? 'Proofread before publishing' : 'Relisez avant de publier' }}</li>
                    </ul>
                </div>
            </div>
        </div>
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

    // Character counter (optional)
    const titleFr = document.querySelector('input[name="title_fr"]');
    const titleEn = document.querySelector('input[name="title_en"]');

    function updateCharCount(input) {
        const length = input.value.length;
        const maxLength = input.getAttribute('maxlength') || 255;
        console.log(`${length}/${maxLength} caractères`);
    }

    titleFr?.addEventListener('input', function() { updateCharCount(this); });
    titleEn?.addEventListener('input', function() { updateCharCount(this); });
</script>
@endpush
