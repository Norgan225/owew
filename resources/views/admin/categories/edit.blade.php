@extends('layouts.admin')

@php
    $pageTitle = app()->getLocale() == 'en' ? 'Edit Category' : 'Modifier la Catégorie';
@endphp

@section('title', $pageTitle)

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
            <h2 class="fw-bold mb-1">{{ app()->getLocale() == 'en' ? 'Edit Category' : 'Modifier la Catégorie' }}</h2>
            <p class="text-muted mb-0">{{ localized_field($category, 'name') }}</p>
        </div>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>{{ app()->getLocale() == 'en' ? 'Back' : 'Retour' }}
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="data-table">
                <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Nom Français -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            {{ app()->getLocale() == 'en' ? 'Name (French)' : 'Nom (Français)' }} <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               name="name_fr"
                               class="form-control form-control-lg @error('name_fr') is-invalid @enderror"
                               value="{{ old('name_fr', $category->name_fr) }}"
                               required>
                        @error('name_fr')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nom Anglais -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            {{ app()->getLocale() == 'en' ? 'Name (English)' : 'Nom (Anglais)' }} <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               name="name_en"
                               class="form-control form-control-lg @error('name_en') is-invalid @enderror"
                               value="{{ old('name_en', $category->name_en) }}"
                               required>
                        @error('name_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Slug -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Slug' : 'Slug' }}</label>
                        <input type="text"
                               name="slug"
                               class="form-control @error('slug') is-invalid @enderror"
                               value="{{ old('slug', $category->slug) }}"
                               id="slugInput">
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Edit with caution, this may affect existing URLs' : 'Modifiez avec précaution, cela peut affecter les URLs existantes' }}</small>
                    </div>

                    <!-- Description Français -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Description (French)' : 'Description (Français)' }}</label>
                        <textarea name="description_fr"
                                  class="form-control @error('description_fr') is-invalid @enderror"
                                  rows="4">{{ old('description_fr', $category->description_fr) }}</textarea>
                        @error('description_fr')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description Anglais -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Description (English)' : 'Description (Anglais)' }}</label>
                        <textarea name="description_en"
                                  class="form-control @error('description_en') is-invalid @enderror"
                                  rows="4">{{ old('description_en', $category->description_en) }}</textarea>
                        @error('description_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Info Box -->
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        {{ app()->getLocale() == 'en' ? 'This category contains' : 'Cette catégorie contient' }} <strong>{{ $category->blogPosts->count() }}</strong> {{ app()->getLocale() == 'en' ? 'article(s)' : 'article(s)' }}
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-2"></i>{{ app()->getLocale() == 'en' ? 'Cancel' : 'Annuler' }}
                        </a>
                        <button type="submit" class="btn btn-primary-custom">
                            <i class="fas fa-save me-2"></i>{{ app()->getLocale() == 'en' ? 'Update' : 'Mettre à Jour' }}
                        </button>
                    </div>
                </form>
            </div>

            <!-- Danger Zone -->
            <div class="data-table mt-4 border-danger">
                <h5 class="fw-bold text-danger mb-3">
                    <i class="fas fa-exclamation-triangle me-2"></i>{{ app()->getLocale() == 'en' ? 'Danger Zone' : 'Zone Dangereuse' }}
                </h5>
                <p class="text-muted mb-3">
                    {{ app()->getLocale() == 'en' ? 'Deleting a category is irreversible.' : 'La suppression d\'une catégorie est irréversible.' }}
                    @if($category->blogPosts->count() > 0)
                        <strong class="text-danger">{{ app()->getLocale() == 'en' ? 'Warning: This category contains articles.' : 'Attention: Cette catégorie contient des articles.' }}</strong>
                    @endif
                </p>
                <form action="{{ route('admin.categories.destroy', $category) }}"
                      method="POST"
                      onsubmit="return confirm(&quot;{{ app()->getLocale() == 'en' ? 'Are you absolutely sure you want to delete this category? This action is irreversible.' : 'Êtes-vous absolument sûr de vouloir supprimer cette catégorie ? Cette action est irréversible.' }}&quot;);">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="btn btn-danger"
                            @if($category->blogPosts->count() > 0) disabled title="{{ app()->getLocale() == 'en' ? 'Remove articles from this category first' : 'Supprimez d\'abord les articles de cette catégorie' }}" @endif>
                        <i class="fas fa-trash me-2"></i>{{ app()->getLocale() == 'en' ? 'Delete Category' : 'Supprimer la Catégorie' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto-update slug from French name
    document.querySelector('input[name="name_fr"]').addEventListener('input', function(e) {
        const slugInput = document.getElementById('slugInput');
        if (slugInput.dataset.autoUpdate !== 'false') {
            const slug = e.target.value
                .toLowerCase()
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-+|-+$/g, '');
            slugInput.value = slug;
        }
    });

    // Stop auto-update if manually edited
    document.getElementById('slugInput').addEventListener('input', function() {
        this.dataset.autoUpdate = 'false';
    });
</script>
@endpush
