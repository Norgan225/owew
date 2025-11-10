@extends('layouts.admin')

@php
    $pageTitle = app()->getLocale() == 'en' ? 'Create User' : 'Créer un Utilisateur';
@endphp

@section('title', $pageTitle)

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">{{ app()->getLocale() == 'en' ? 'Create New User' : 'Créer un Nouvel Utilisateur' }}</h2>
            <p class="text-muted mb-0">{{ app()->getLocale() == 'en' ? 'Add a user to the system' : 'Ajouter un utilisateur au système' }}</p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>{{ app()->getLocale() == 'en' ? 'Back to list' : 'Retour à la liste' }}
        </a>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Informations Personnelles -->
                <div class="data-table mb-4">
                    <h5 class="fw-bold mb-4">
                        <i class="fas fa-user text-primary me-2"></i>{{ app()->getLocale() == 'en' ? 'Personal Information' : 'Informations Personnelles' }}
                    </h5>

                    <!-- Nom -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Full Name' : 'Nom complet' }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               name="name" value="{{ old('name') }}" required
                               placeholder="{{ app()->getLocale() == 'en' ? 'Ex: John Doe' : 'Ex: Jean Kouadio' }}">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Email' : 'Email' }} <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required
                               placeholder="{{ app()->getLocale() == 'en' ? 'ex: john.doe@example.com' : 'ex: jean.kouadio@example.com' }}">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Mot de Passe -->
                <div class="data-table mb-4">
                    <h5 class="fw-bold mb-4">
                        <i class="fas fa-lock text-primary me-2"></i>{{ app()->getLocale() == 'en' ? 'Password' : 'Mot de Passe' }}
                    </h5>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Password' : 'Mot de passe' }} <span class="text-danger">*</span></label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                       name="password" required
                                       placeholder="{{ app()->getLocale() == 'en' ? 'Minimum 8 characters' : 'Minimum 8 caractères' }}">
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Confirm Password' : 'Confirmer le mot de passe' }} <span class="text-danger">*</span></label>
                                <input type="password" class="form-control"
                                       name="password_confirmation" required
                                       placeholder="{{ app()->getLocale() == 'en' ? 'Retype password' : 'Retaper le mot de passe' }}">
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <small>
                            <i class="fas fa-info-circle me-1"></i>
                            {{ app()->getLocale() == 'en' ? 'Password must contain at least 8 characters' : 'Le mot de passe doit contenir au moins 8 caractères' }}
                        </small>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Avatar -->
                <div class="data-table mb-4">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-image text-primary me-2"></i>{{ app()->getLocale() == 'en' ? 'Profile Picture' : 'Photo de Profil' }}
                    </h5>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Avatar' : 'Avatar' }}</label>
                        <input type="file" class="form-control @error('avatar') is-invalid @enderror"
                               name="avatar" accept="image/*" id="avatarInput">
                        @error('avatar')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Format: JPG, PNG (max 2MB)' : 'Format: JPG, PNG (max 2MB)' }}</small>
                    </div>

                    <!-- Avatar Preview -->
                    <div id="avatarPreview" class="mt-3 text-center" style="display: none;">
                        <img id="preview" src="" alt="Preview" class="img-fluid rounded-circle"
                             style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                </div>

                <!-- Rôle -->
                <div class="data-table mb-4">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-user-tag text-primary me-2"></i>{{ app()->getLocale() == 'en' ? 'Role and Permissions' : 'Rôle et Permissions' }}
                    </h5>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Role' : 'Rôle' }} <span class="text-danger">*</span></label>
                        <select class="form-select @error('role') is-invalid @enderror" name="role" required>
                            <option value="">{{ app()->getLocale() == 'en' ? '-- Select a role --' : '-- Sélectionnez un rôle --' }}</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>
                                <i class="fas fa-user-shield"></i> {{ app()->getLocale() == 'en' ? 'Administrator' : 'Administrateur' }}
                            </option>
                            <option value="editor" {{ old('role') === 'editor' ? 'selected' : '' }}>
                                <i class="fas fa-user-edit"></i> {{ app()->getLocale() == 'en' ? 'Editor' : 'Éditeur' }}
                            </option>
                            <option value="viewer" {{ old('role') === 'viewer' ? 'selected' : '' }}>
                                <i class="fas fa-user"></i> {{ app()->getLocale() == 'en' ? 'Viewer' : 'Viewer' }}
                            </option>
                        </select>
                        @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Role Descriptions -->
                    <div class="alert alert-light">
                        <small class="d-block mb-2">
                            <strong><i class="fas fa-user-shield text-danger me-1"></i>{{ app()->getLocale() == 'en' ? 'Administrator:' : 'Administrateur:' }}</strong>
                            {{ app()->getLocale() == 'en' ? 'Full access to the system' : 'Accès complet au système' }}
                        </small>
                        <small class="d-block mb-2">
                            <strong><i class="fas fa-user-edit text-warning me-1"></i>{{ app()->getLocale() == 'en' ? 'Editor:' : 'Éditeur:' }}</strong>
                            {{ app()->getLocale() == 'en' ? 'Can manage content' : 'Peut gérer les contenus' }}
                        </small>
                        <small class="d-block">
                            <strong><i class="fas fa-user text-secondary me-1"></i>{{ app()->getLocale() == 'en' ? 'Viewer:' : 'Viewer:' }}</strong>
                            {{ app()->getLocale() == 'en' ? 'Read-only' : 'Lecture seule' }}
                        </small>
                    </div>
                </div>

                <!-- Actions -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary-custom btn-lg">
                        <i class="fas fa-user-plus me-2"></i>{{ app()->getLocale() == 'en' ? 'Create User' : 'Créer l\'Utilisateur' }}
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
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
    // Avatar preview
    document.getElementById('avatarInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
                document.getElementById('avatarPreview').style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
