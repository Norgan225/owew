@extends('layouts.admin')

@php
    $pageTitle = app()->getLocale() == 'en' ? 'Edit Article' : 'Modifier l\'Article';
@endphp

@section('title', $pageTitle)

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">{{ app()->getLocale() == 'en' ? 'Edit Article' : 'Modifier l\'Article' }}</h2>
            <p class="text-muted mb-0">{{ localized_field($blogPost, 'title') }}</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('blog.show', $blogPost->slug) }}" class="btn btn-outline-primary" target="_blank">
                <i class="fas fa-eye me-2"></i>{{ app()->getLocale() == 'en' ? 'View on site' : 'Voir sur le site' }}
            </a>
            <a href="{{ route('admin.blog.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>{{ app()->getLocale() == 'en' ? 'Back' : 'Retour' }}
            </a>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.blog.update', $blogPost) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

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
                               name="title_fr" value="{{ old('title_fr', $blogPost->title_fr) }}" required
                               placeholder="{{ app()->getLocale() == 'en' ? 'Ex: How to help underprivileged children' : 'Ex: Comment aider les enfants défavorisés' }}">
                        @error('title_fr')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Titre EN -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Title (English)' : 'Titre (Anglais)' }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title_en') is-invalid @enderror"
                               name="title_en" value="{{ old('title_en', $blogPost->title_en) }}" required
                               placeholder="{{ app()->getLocale() == 'en' ? 'Ex: How to help underprivileged children' : 'Ex: Comment aider les enfants défavorisés' }}">
                        @error('title_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Contenu -->
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
                                  placeholder="{{ app()->getLocale() == 'en' ? 'Write your article in French...' : 'Rédigez votre article en français...' }}">{{ old('content_fr', $blogPost->content_fr) }}</textarea>
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
                                  placeholder="{{ app()->getLocale() == 'en' ? 'Write your article in English...' : 'Rédigez votre article en anglais...' }}">{{ old('content_en', $blogPost->content_en) }}</textarea>
                        @error('content_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">{{ app()->getLocale() == 'en' ? 'You can use HTML for formatting' : 'Vous pouvez utiliser du HTML pour le formatage' }}</small>
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
                                <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Views' : 'Vues' }}</div>
                                <div class="stat-value text-primary" style="font-size: 1.5rem;">
                                    {{ number_format($blogPost->views_count ?? 0, 0, ',', ' ') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-card">
                                <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Status' : 'Statut' }}</div>
                                <div class="stat-value" style="font-size: 1.2rem;">
                                    @if($blogPost->status === 'published')
                                        <span class="status-badge success">{{ app()->getLocale() == 'en' ? 'Published' : 'Publié' }}</span>
                                    @elseif($blogPost->status === 'draft')
                                        <span class="status-badge warning">{{ app()->getLocale() == 'en' ? 'Draft' : 'Brouillon' }}</span>
                                    @else
                                        <span class="status-badge info">{{ app()->getLocale() == 'en' ? 'Archived' : 'Archivé' }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-card">
                                <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Published on' : 'Publié le' }}</div>
                                <div class="stat-value" style="font-size: 0.9rem;">
                                    @if($blogPost->published_at)
                                        {{ $blogPost->published_at->format('d/m/Y') }}
                                    @else
                                        <span class="text-muted">{{ app()->getLocale() == 'en' ? 'Not published' : 'Non publié' }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
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
                            <option value="draft" {{ old('status', $blogPost->status) === 'draft' ? 'selected' : '' }}>
                                {{ app()->getLocale() == 'en' ? 'Draft' : 'Brouillon' }}
                            </option>
                            <option value="published" {{ old('status', $blogPost->status) === 'published' ? 'selected' : '' }}>
                                {{ app()->getLocale() == 'en' ? 'Published' : 'Publié' }}
                            </option>
                            <option value="archived" {{ old('status', $blogPost->status) === 'archived' ? 'selected' : '' }}>
                                {{ app()->getLocale() == 'en' ? 'Archived' : 'Archivé' }}
                            </option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Date de publication -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Publication Date' : 'Date de publication' }}</label>
                        <input type="datetime-local" class="form-control @error('published_at') is-invalid @enderror"
                               name="published_at"
                               value="{{ old('published_at', $blogPost->published_at ? $blogPost->published_at->format('Y-m-d\TH:i') : '') }}">
                        @error('published_at')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Leave empty to publish immediately' : 'Laisser vide pour publier immédiatement' }}</small>
                    </div>

                    <!-- Actions rapides -->
                    <div class="d-grid gap-2 mt-3">
                        @if($blogPost->status === 'draft')
                        <form action="{{ route('admin.blog.publish', $blogPost) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success w-100">
                                <i class="fas fa-paper-plane me-2"></i>{{ app()->getLocale() == 'en' ? 'Publish Now' : 'Publier Maintenant' }}
                            </button>
                        </form>
                        @endif

                        @if($blogPost->status === 'published')
                        <form action="{{ route('admin.blog.unpublish', $blogPost) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-warning w-100">
                                <i class="fas fa-pause me-2"></i>{{ app()->getLocale() == 'en' ? 'Unpublish' : 'Dépublier' }}
                            </button>
                        </form>
                        @endif

                        <form action="{{ route('admin.blog.duplicate', $blogPost) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary w-100">
                                <i class="fas fa-copy me-2"></i>{{ app()->getLocale() == 'en' ? 'Duplicate' : 'Dupliquer' }}
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Image mise en avant -->
                <div class="data-table mb-4">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-image text-primary me-2"></i>{{ app()->getLocale() == 'en' ? 'Featured Image' : 'Image Mise en Avant' }}
                    </h5>

                    <!-- Current Image -->
                    @if($blogPost->featured_image)
                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Current Image' : 'Image actuelle' }}</label>
                        <img src="{{ asset('storage/' . $blogPost->featured_image) }}"
                             alt="{{ localized_field($blogPost, 'title') }}"
                             class="img-fluid rounded">
                    </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Change Image' : 'Changer l\'image' }}</label>
                        <input type="file" class="form-control @error('featured_image') is-invalid @enderror"
                               name="featured_image" accept="image/*" id="imageInput">
                        @error('featured_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Format: JPG, PNG (max 2MB)' : 'Format: JPG, PNG (max 2MB)' }}</small>
                    </div>

                    <!-- Image Preview -->
                    <div id="imagePreview" class="mt-3" style="display: none;">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Preview' : 'Aperçu' }}</label>
                        <img id="preview" src="" alt="Preview" class="img-fluid rounded">
                    </div>
                </div>

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
                            <option value="{{ $category->id }}"
                                    {{ old('category_id', $blogPost->category_id) == $category->id ? 'selected' : '' }}>
                                {{ localized_field($category, 'name') }}
                            </option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Meta Info -->
                <div class="data-table mb-4">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-info text-primary me-2"></i>{{ app()->getLocale() == 'en' ? 'Information' : 'Informations' }}
                    </h5>
                    <div class="mb-2">
                        <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Author:' : 'Auteur:' }}</small><br>
                        <strong>{{ $blogPost->author->name ?? 'N/A' }}</strong>
                    </div>
                    <div class="mb-2">
                        <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Slug:' : 'Slug:' }}</small><br>
                        <code>{{ $blogPost->slug }}</code>
                    </div>
                    <div class="mb-2">
                        <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Created on:' : 'Créé le:' }}</small><br>
                        <strong>{{ $blogPost->created_at->format('d/m/Y à H:i') }}</strong>
                    </div>
                    <div>
                        <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Last modified:' : 'Dernière modification:' }}</small><br>
                        <strong>{{ $blogPost->updated_at->format('d/m/Y à H:i') }}</strong>
                    </div>
                </div>

                <!-- Actions -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary-custom btn-lg">
                        <i class="fas fa-save me-2"></i>{{ app()->getLocale() == 'en' ? 'Save Changes' : 'Enregistrer les Modifications' }}
                    </button>
                    <a href="{{ route('admin.blog.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-2"></i>{{ app()->getLocale() == 'en' ? 'Cancel' : 'Annuler' }}
                    </a>
                    <button type="button" class="btn btn-outline-danger"
                            onclick="if(confirm(&quot;{{ app()->getLocale() == 'en' ? 'Are you sure you want to delete this article?' : 'Êtes-vous sûr de vouloir supprimer cet article ?' }}&quot;)) { document.getElementById('delete-form').submit(); }">
                        <i class="fas fa-trash me-2"></i>{{ app()->getLocale() == 'en' ? 'Delete Article' : 'Supprimer l\'Article' }}
                    </button>
                </div>
            </div>
        </div>
    </form>

    <!-- Delete Form -->
    <form id="delete-form" action="{{ route('admin.blog.destroy', $blogPost) }}" method="POST" style="display: none;">
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
</script>
@endpush
