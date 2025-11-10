@extends('layouts.admin')

@php
    $pageTitle = app()->getLocale() == 'en' ? 'Edit User' : 'Modifier l\'Utilisateur';
@endphp

@section('title', $pageTitle)

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">{{ app()->getLocale() == 'en' ? 'Edit User' : 'Modifier l\'Utilisateur' }}</h2>
            <p class="text-muted mb-0">{{ $user->name }}</p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>{{ app()->getLocale() == 'en' ? 'Back to list' : 'Retour à la liste' }}
        </a>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Informations personnelles -->
                <div class="data-table mb-4">
                    <h5 class="fw-bold mb-4">
                        <i class="fas fa-user text-primary me-2"></i>{{ app()->getLocale() == 'en' ? 'Personal Information' : 'Informations Personnelles' }}
                    </h5>

                    <!-- Nom -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Full Name' : 'Nom complet' }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               name="name" value="{{ old('name', $user->name) }}" required
                               placeholder="{{ app()->getLocale() == 'en' ? 'Ex: John Doe' : 'Ex: Jean Dupont' }}">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Email Address' : 'Adresse Email' }} <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email', $user->email) }}" required
                               placeholder="{{ app()->getLocale() == 'en' ? 'example@email.com' : 'exemple@email.com' }}">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Mot de passe -->
                <div class="data-table mb-4">
                    <h5 class="fw-bold mb-4">
                        <i class="fas fa-lock text-primary me-2"></i>{{ app()->getLocale() == 'en' ? 'Change Password' : 'Changer le Mot de Passe' }}
                    </h5>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'New password' : 'Nouveau mot de passe' }}</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                       name="password" placeholder="••••••••">
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Leave blank to not change' : 'Laisser vide pour ne pas changer' }}</small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Confirm password' : 'Confirmer le mot de passe' }}</label>
                                <input type="password" class="form-control"
                                       name="password_confirmation" placeholder="••••••••">
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <small>{{ app()->getLocale() == 'en' ? 'Leave blank if you do not want to change the password' : 'Laissez vide si vous ne souhaitez pas modifier le mot de passe' }}</small>
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
                                <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Published articles' : 'Articles publiés' }}</div>
                                <div class="stat-value text-primary">
                                    {{ $user->blogPosts()->count() }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-card">
                                <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Member since' : 'Membre depuis' }}</div>
                                <div style="font-size: 0.9rem; font-weight: 600;">
                                    {{ $user->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-card">
                                <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Last login' : 'Dernière connexion' }}</div>
                                <div style="font-size: 0.9rem; font-weight: 600;">
                                    @if($user->last_login_at)
                                        {{ $user->last_login_at->diffForHumans() }}
                                    @else
                                        {{ app()->getLocale() == 'en' ? 'Never' : 'Jamais' }}
                                    @endif
                                </div>
                            </div>
                        </div>
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

                    <!-- Current Avatar -->
                    <div class="mb-3 text-center">
                        @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}"
                             alt="{{ $user->name }}"
                             class="rounded-circle mb-3"
                             style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=4B0082&color=fff&size=150"
                             alt="{{ $user->name }}"
                             class="rounded-circle mb-3">
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Change avatar' : 'Changer l\'avatar' }}</label>
                        <input type="file" class="form-control @error('avatar') is-invalid @enderror"
                               name="avatar" accept="image/*" id="imageInput">
                        @error('avatar')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Format: JPG, PNG (max 2MB)' : 'Format: JPG, PNG (max 2MB)' }}</small>
                    </div>

                    <!-- New Image Preview -->
                    <div id="imagePreview" class="mt-3 text-center" style="display: none;">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Preview' : 'Aperçu' }}</label>
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
                        <select class="form-select @error('role') is-invalid @enderror" name="role" required
                                {{ auth()->id() === $user->id ? 'disabled' : '' }}>
                            <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>
                                {{ app()->getLocale() == 'en' ? 'Administrator' : 'Administrateur' }}
                            </option>
                            <option value="editor" {{ old('role', $user->role) === 'editor' ? 'selected' : '' }}>
                                {{ app()->getLocale() == 'en' ? 'Editor' : 'Éditeur' }}
                            </option>
                            <option value="viewer" {{ old('role', $user->role) === 'viewer' ? 'selected' : '' }}>
                                {{ app()->getLocale() == 'en' ? 'Viewer' : 'Viewer' }}
                            </option>
                        </select>
                        @if(auth()->id() === $user->id)
                        <input type="hidden" name="role" value="{{ $user->role }}">
                        <small class="text-warning">
                            <i class="fas fa-exclamation-triangle me-1"></i>{{ app()->getLocale() == 'en' ? 'You cannot modify your own role' : 'Vous ne pouvez pas modifier votre propre rôle' }}
                        </small>
                        @endif
                        @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description des rôles -->
                    <div class="alert alert-light">
                        <small class="fw-bold d-block mb-2">{{ app()->getLocale() == 'en' ? 'Role descriptions:' : 'Description des rôles :' }}</small>
                        <ul class="mb-0" style="font-size: 0.85rem;">
                            <li><strong>{{ app()->getLocale() == 'en' ? 'Admin' : 'Admin' }}</strong> : {{ app()->getLocale() == 'en' ? 'Full access' : 'Accès complet' }}</li>
                            <li><strong>{{ app()->getLocale() == 'en' ? 'Editor' : 'Éditeur' }}</strong> : {{ app()->getLocale() == 'en' ? 'Content management' : 'Gestion du contenu' }}</li>
                            <li><strong>{{ app()->getLocale() == 'en' ? 'Viewer' : 'Viewer' }}</strong> : {{ app()->getLocale() == 'en' ? 'Read-only' : 'Lecture seule' }}</li>
                        </ul>
                    </div>
                </div>

                <!-- Meta Info -->
                <div class="data-table mb-4">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-info text-primary me-2"></i>{{ app()->getLocale() == 'en' ? 'Information' : 'Informations' }}
                    </h5>
                    <div class="mb-2">
                        <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Created on:' : 'Créé le:' }}</small><br>
                        <strong>{{ $user->created_at->format('d/m/Y à H:i') }}</strong>
                    </div>
                    <div>
                        <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Last modification:' : 'Dernière modification:' }}</small><br>
                        <strong>{{ $user->updated_at->format('d/m/Y à H:i') }}</strong>
                    </div>
                </div>

                <!-- Actions -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary-custom btn-lg">
                        <i class="fas fa-save me-2"></i>{{ app()->getLocale() == 'en' ? 'Save Changes' : 'Enregistrer les Modifications' }}
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-2"></i>{{ app()->getLocale() == 'en' ? 'Cancel' : 'Annuler' }}
                    </a>
                    @if(auth()->id() !== $user->id)
                    <button type="button" class="btn btn-outline-danger"
                            onclick="if(confirm(&quot;{{ app()->getLocale() == 'en' ? 'Are you sure you want to delete this user?' : 'Êtes-vous sûr de vouloir supprimer cet utilisateur ?' }}&quot;)) { document.getElementById('delete-form').submit(); }">
                        <i class="fas fa-trash me-2"></i>{{ app()->getLocale() == 'en' ? 'Delete User' : 'Supprimer l\'Utilisateur' }}
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </form>

    <!-- Delete Form -->
    @if(auth()->id() !== $user->id)
    <form id="delete-form" action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
    @endif
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
