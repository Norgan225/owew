@extends('layouts.admin')

@php
    $pageTitle = app()->getLocale() == 'en' ? 'New Category' : 'Nouvelle Catégorie';
@endphp

@section('title', $pageTitle)

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">{{ app()->getLocale() == 'en' ? 'New Category' : 'Nouvelle Catégorie' }}</h2>
            <p class="text-muted mb-0">{{ app()->getLocale() == 'en' ? 'Create a new category for articles' : 'Créer une nouvelle catégorie pour les articles' }}</p>
        </div>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>{{ app()->getLocale() == 'en' ? 'Back' : 'Retour' }}
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="data-table">
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf

                    <!-- Nom Français -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            {{ app()->getLocale() == 'en' ? 'Name (French)' : 'Nom (Français)' }} <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               name="name_fr"
                               class="form-control form-control-lg @error('name_fr') is-invalid @enderror"
                               value="{{ old('name_fr') }}"
                               placeholder="{{ app()->getLocale() == 'en' ? 'Ex: Education' : 'Ex: Éducation' }}"
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
                               value="{{ old('name_en') }}"
                               placeholder="{{ app()->getLocale() == 'en' ? 'Ex: Education' : 'Ex: Education' }}"
                               required>
                        @error('name_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Slug -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            {{ app()->getLocale() == 'en' ? 'Slug' : 'Slug' }} <span class="text-muted">({{ app()->getLocale() == 'en' ? 'generated automatically' : 'généré automatiquement' }})</span>
                        </label>
                        <input type="text"
                               name="slug"
                               class="form-control @error('slug') is-invalid @enderror"
                               value="{{ old('slug') }}"
                               placeholder="education"
                               id="slugInput">
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">{{ app()->getLocale() == 'en' ? 'The slug will be generated automatically if left empty' : 'Le slug sera généré automatiquement si laissé vide' }}</small>
                    </div>

                    <!-- Description Français -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Description (French)' : 'Description (Français)' }}</label>
                        <textarea name="description_fr"
                                  class="form-control @error('description_fr') is-invalid @enderror"
                                  rows="4"
                                  placeholder="{{ app()->getLocale() == 'en' ? 'Category description in French...' : 'Description de la catégorie en français...' }}">{{ old('description_fr') }}</textarea>
                        @error('description_fr')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description Anglais -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Description (English)' : 'Description (Anglais)' }}</label>
                        <textarea name="description_en"
                                  class="form-control @error('description_en') is-invalid @enderror"
                                  rows="4"
                                  placeholder="{{ app()->getLocale() == 'en' ? 'Category description in English...' : 'Description de la catégorie en anglais...' }}">{{ old('description_en') }}</textarea>
                        @error('description_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-2"></i>{{ app()->getLocale() == 'en' ? 'Cancel' : 'Annuler' }}
                        </a>
                        <button type="submit" class="btn btn-primary-custom">
                            <i class="fas fa-save me-2"></i>{{ app()->getLocale() == 'en' ? 'Create Category' : 'Créer la Catégorie' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto-generate slug from French name
    document.querySelector('input[name="name_fr"]').addEventListener('input', function(e) {
        const slugInput = document.getElementById('slugInput');
        if (!slugInput.value || slugInput.dataset.autoGenerated) {
            const slug = e.target.value
                .toLowerCase()
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '') // Remove accents
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-+|-+$/g, '');
            slugInput.value = slug;
            slugInput.dataset.autoGenerated = 'true';
        }
    });

    // Mark slug as manually edited
    document.getElementById('slugInput').addEventListener('input', function() {
        this.dataset.autoGenerated = 'false';
    });
</script>
@endpush
