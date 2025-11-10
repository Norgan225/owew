@extends('layouts.admin')

@php
    $pageTitle = app()->getLocale() == 'en' ? 'User Management' : 'Gestion des Utilisateurs';
@endphp

@section('title', $pageTitle)

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">{{ app()->getLocale() == 'en' ? 'User Management' : 'Gestion des Utilisateurs' }}</h2>
            <p class="text-muted mb-0">{{ $users->total() }} {{ app()->getLocale() == 'en' ? 'user(s) total' : 'utilisateur(s) au total' }}</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
                <i class="fas fa-filter me-2"></i>{{ app()->getLocale() == 'en' ? 'Filter' : 'Filtrer' }}
            </button>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary-custom">
                <i class="fas fa-plus me-2"></i>{{ app()->getLocale() == 'en' ? 'New User' : 'Nouvel Utilisateur' }}
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Total Users' : 'Total Utilisateurs' }}</div>
                        <div class="stat-value">{{ $totalUsers }}</div>
                    </div>
                    <div class="stat-icon" style="background: #EDE9FE; color: var(--primary);">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Administrators' : 'Administrateurs' }}</div>
                        <div class="stat-value text-danger">{{ $adminCount }}</div>
                    </div>
                    <div class="stat-icon" style="background: #FEE2E2; color: #DC2626;">
                        <i class="fas fa-user-shield"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Editors' : 'Éditeurs' }}</div>
                        <div class="stat-value text-warning">{{ $editorCount }}</div>
                    </div>
                    <div class="stat-icon" style="background: #FEF3C7; color: #D97706;">
                        <i class="fas fa-user-edit"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Viewers' : 'Viewers' }}</div>
                        <div class="stat-value text-secondary">{{ $viewerCount }}</div>
                    </div>
                    <div class="stat-icon" style="background: #F3F4F6; color: #6B7280;">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="data-table">
        <!-- Table Header with Search -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold mb-0">{{ app()->getLocale() == 'en' ? 'Users List' : 'Liste des Utilisateurs' }}</h5>
            <div class="d-flex gap-2">
                <div class="position-relative" style="width: 300px;">
                    <i class="fas fa-search position-absolute" style="left: 12px; top: 50%; transform: translateY(-50%); color: #9CA3AF;"></i>
                    <input type="text" class="form-control ps-5" placeholder="{{ app()->getLocale() == 'en' ? 'Search a user...' : 'Rechercher un utilisateur...' }}" id="searchInput">
                </div>
                <select class="form-select" style="width: 150px;" id="roleFilter">
                    <option value="">{{ app()->getLocale() == 'en' ? 'All roles' : 'Tous les rôles' }}</option>
                    <option value="admin">{{ app()->getLocale() == 'en' ? 'Admin' : 'Admin' }}</option>
                    <option value="editor">{{ app()->getLocale() == 'en' ? 'Editor' : 'Éditeur' }}</option>
                    <option value="viewer">{{ app()->getLocale() == 'en' ? 'Viewer' : 'Viewer' }}</option>
                </select>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <!-- Table -->
        <div class="table-responsive">
            <table class="table" id="usersTable">
                <thead>
                    <tr>
                        <th style="width: 5%;">
                            <input type="checkbox" id="selectAll">
                        </th>
                        <th style="width: 25%;">{{ app()->getLocale() == 'en' ? 'User' : 'Utilisateur' }}</th>
                        <th style="width: 20%;">{{ app()->getLocale() == 'en' ? 'Email' : 'Email' }}</th>
                        <th style="width: 12%;">{{ app()->getLocale() == 'en' ? 'Role' : 'Rôle' }}</th>
                        <th style="width: 10%;">{{ app()->getLocale() == 'en' ? 'Articles' : 'Articles' }}</th>
                        <th style="width: 10%;">{{ app()->getLocale() == 'en' ? 'Last Login' : 'Dernière connexion' }}</th>
                        <th style="width: 12%;">{{ app()->getLocale() == 'en' ? 'Creation Date' : 'Date création' }}</th>
                        <th style="width: 6%;" class="text-end">{{ app()->getLocale() == 'en' ? 'Actions' : 'Actions' }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr data-role="{{ $user->role }}">
                        <td>
                            <input type="checkbox" class="row-checkbox" value="{{ $user->id }}"
                                   {{ auth()->id() === $user->id ? 'disabled' : '' }}>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                @if($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}"
                                     alt="{{ $user->name }}"
                                     class="rounded-circle"
                                     style="width: 45px; height: 45px; object-fit: cover;">
                                @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=4B0082&color=fff"
                                     alt="{{ $user->name }}"
                                     class="rounded-circle"
                                     style="width: 45px; height: 45px;">
                                @endif
                                <div>
                                    <div class="fw-semibold">{{ $user->name }}</div>
                                    @if(auth()->id() === $user->id)
                                    <small class="badge bg-info">Vous</small>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="mailto:{{ $user->email }}" class="text-primary text-decoration-none">
                                <i class="fas fa-envelope me-1"></i>{{ $user->email }}
                            </a>
                        </td>
                        <td>
                            @if($user->role === 'admin')
                                <span class="status-badge danger">
                                    <i class="fas fa-user-shield"></i> {{ app()->getLocale() == 'en' ? 'Admin' : 'Admin' }}
                                </span>
                            @elseif($user->role === 'editor')
                                <span class="status-badge warning">
                                    <i class="fas fa-user-edit"></i> {{ app()->getLocale() == 'en' ? 'Editor' : 'Éditeur' }}
                                </span>
                            @else
                                <span class="status-badge info">
                                    <i class="fas fa-user"></i> {{ app()->getLocale() == 'en' ? 'Viewer' : 'Viewer' }}
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-1">
                                <i class="fas fa-blog text-muted"></i>
                                <strong>{{ $user->blogPosts()->count() }}</strong>
                            </div>
                        </td>
                        <td>
                            @if($user->last_login_at)
                            <small class="text-muted d-block">{{ $user->last_login_at->diffForHumans() }}</small>
                            @else
                            <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Never logged in' : 'Jamais connecté' }}</small>
                            @endif
                        </td>
                        <td>
                            <small class="text-muted d-block">{{ $user->created_at->format('d/m/Y') }}</small>
                            <small class="text-muted">{{ $user->created_at->format('H:i') }}</small>
                        </td>
                        <td class="text-end">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#viewUserModal{{ $user->id }}">
                                            <i class="fas fa-eye me-2"></i>{{ app()->getLocale() == 'en' ? 'View details' : 'Voir détails' }}
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.users.edit', $user) }}">
                                            <i class="fas fa-edit me-2"></i>{{ app()->getLocale() == 'en' ? 'Edit' : 'Modifier' }}
                                        </a>
                                    </li>
                                    @if(auth()->id() !== $user->id)
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item" href="#" onclick="resetPassword({{ $user->id }})">
                                            <i class="fas fa-key me-2"></i>{{ app()->getLocale() == 'en' ? 'Reset password' : 'Réinitialiser mot de passe' }}
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('admin.users.destroy', $user) }}"
                                              method="POST"
                                              onsubmit="return confirm(&quot;{{ app()->getLocale() == 'en' ? 'Are you sure you want to delete this user?' : 'Êtes-vous sûr de vouloir supprimer cet utilisateur ?' }}&quot;);">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="fas fa-trash me-2"></i>{{ app()->getLocale() == 'en' ? 'Delete' : 'Supprimer' }}
                                            </button>
                                        </form>
                                    </li>
                                    @else
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <span class="dropdown-item text-muted">
                                            <i class="fas fa-info-circle me-2"></i>{{ app()->getLocale() == 'en' ? 'Cannot delete yourself' : 'Impossible de vous supprimer' }}
                                        </span>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </td>
                    </tr>

                    <!-- View User Modal -->
                    <div class="modal fade" id="viewUserModal{{ $user->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{ app()->getLocale() == 'en' ? 'User Details' : 'Détails de l\'utilisateur' }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center mb-4">
                                        @if($user->avatar)
                                        <img src="{{ asset('storage/' . $user->avatar) }}"
                                             alt="{{ $user->name }}"
                                             class="rounded-circle mb-3"
                                             style="width: 100px; height: 100px; object-fit: cover;">
                                        @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=4B0082&color=fff&size=100"
                                             alt="{{ $user->name }}"
                                             class="rounded-circle mb-3">
                                        @endif
                                        <h4 class="mb-1">{{ $user->name }}</h4>
                                        <p class="text-muted">{{ $user->email }}</p>
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <strong>{{ app()->getLocale() == 'en' ? 'Role:' : 'Rôle:' }}</strong><br>
                                        @if($user->role === 'admin')
                                            <span class="status-badge danger mt-1">
                                                <i class="fas fa-user-shield"></i> {{ app()->getLocale() == 'en' ? 'Administrator' : 'Administrateur' }}
                                            </span>
                                        @elseif($user->role === 'editor')
                                            <span class="status-badge warning mt-1">
                                                <i class="fas fa-user-edit"></i> {{ app()->getLocale() == 'en' ? 'Editor' : 'Éditeur' }}
                                            </span>
                                        @else
                                            <span class="status-badge info mt-1">
                                                <i class="fas fa-user"></i> {{ app()->getLocale() == 'en' ? 'Viewer' : 'Viewer' }}
                                            </span>
                                        @endif
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <strong>{{ app()->getLocale() == 'en' ? 'Statistics:' : 'Statistiques:' }}</strong><br>
                                        <div class="mt-2">
                                            <i class="fas fa-blog text-primary me-2"></i>
                                            <strong>{{ $user->blogPosts()->count() }}</strong> {{ app()->getLocale() == 'en' ? 'published article(s)' : 'article(s) publié(s)' }}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <strong>{{ app()->getLocale() == 'en' ? 'Member since:' : 'Membre depuis:' }}</strong><br>
                                        {{ $user->created_at->format('d/m/Y à H:i') }}
                                        <small class="text-muted">({{ $user->created_at->diffForHumans() }})</small>
                                    </div>
                                    @if($user->last_login_at)
                                    <hr>
                                    <div>
                                        <strong>{{ app()->getLocale() == 'en' ? 'Last login:' : 'Dernière connexion:' }}</strong><br>
                                        {{ $user->last_login_at->format('d/m/Y à H:i') }}
                                        <small class="text-muted">({{ $user->last_login_at->diffForHumans() }})</small>
                                    </div>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ app()->getLocale() == 'en' ? 'Close' : 'Fermer' }}</button>
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary-custom">
                                        <i class="fas fa-edit me-2"></i>{{ app()->getLocale() == 'en' ? 'Edit' : 'Modifier' }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <i class="fas fa-users fa-3x text-muted mb-3 d-block"></i>
                            <p class="text-muted mb-3">{{ app()->getLocale() == 'en' ? 'No users found' : 'Aucun utilisateur trouvé' }}</p>
                            <a href="{{ route('admin.users.create') }}" class="btn btn-primary-custom">
                                <i class="fas fa-plus me-2"></i>{{ app()->getLocale() == 'en' ? 'Create the first user' : 'Créer le premier utilisateur' }}
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($users->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="text-muted">
                {{ app()->getLocale() == 'en' ? 'Showing' : 'Affichage de' }} {{ $users->firstItem() }} {{ app()->getLocale() == 'en' ? 'to' : 'à' }} {{ $users->lastItem() }} {{ app()->getLocale() == 'en' ? 'of' : 'sur' }} {{ $users->total() }} {{ app()->getLocale() == 'en' ? 'users' : 'utilisateurs' }}
            </div>
            {{ $users->links() }}
        </div>
        @endif

        <!-- Bulk Actions -->
        <div class="d-flex gap-2 mt-3" id="bulkActions" style="display: none !important;">
            <button class="btn btn-sm btn-outline-warning" onclick="bulkAction('change-role')">
                <i class="fas fa-user-tag me-1"></i>{{ app()->getLocale() == 'en' ? 'Change role' : 'Changer le rôle' }}
            </button>
            <button class="btn btn-sm btn-outline-danger" onclick="bulkAction('delete')">
                <i class="fas fa-trash me-1"></i>{{ app()->getLocale() == 'en' ? 'Delete' : 'Supprimer' }}
            </button>
        </div>
    </div>
</div>

<!-- Filter Modal -->
<div class="modal fade" id="filterModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ app()->getLocale() == 'en' ? 'Advanced Filters' : 'Filtres Avancés' }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">{{ app()->getLocale() == 'en' ? 'Role' : 'Rôle' }}</label>
                        <select class="form-select">
                            <option value="">{{ app()->getLocale() == 'en' ? 'All' : 'Tous' }}</option>
                            <option value="admin">{{ app()->getLocale() == 'en' ? 'Admin' : 'Admin' }}</option>
                            <option value="editor">{{ app()->getLocale() == 'en' ? 'Editor' : 'Éditeur' }}</option>
                            <option value="viewer">{{ app()->getLocale() == 'en' ? 'Viewer' : 'Viewer' }}</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ app()->getLocale() == 'en' ? 'Creation Date' : 'Date de création' }}</label>
                        <div class="row g-2">
                            <div class="col-6">
                                <input type="date" class="form-control">
                            </div>
                            <div class="col-6">
                                <input type="date" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ app()->getLocale() == 'en' ? 'Number of Articles' : 'Nombre d\'articles' }}</label>
                        <div class="row g-2">
                            <div class="col-6">
                                <input type="number" class="form-control" placeholder="{{ app()->getLocale() == 'en' ? 'Min' : 'Min' }}">
                            </div>
                            <div class="col-6">
                                <input type="number" class="form-control" placeholder="{{ app()->getLocale() == 'en' ? 'Max' : 'Max' }}">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ app()->getLocale() == 'en' ? 'Cancel' : 'Annuler' }}</button>
                <button type="button" class="btn btn-primary-custom">{{ app()->getLocale() == 'en' ? 'Apply Filters' : 'Appliquer les Filtres' }}</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        // Search functionality
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('#usersTable tbody tr');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });

        // Role filter
        document.getElementById('roleFilter').addEventListener('change', function() {
            const role = this.value.toLowerCase();
            const rows = document.querySelectorAll('#usersTable tbody tr');

            rows.forEach(row => {
                if (!role) {
                    row.style.display = '';
                    return;
                }

                const rowRole = row.getAttribute('data-role');
                row.style.display = rowRole === role ? '' : 'none';
            });
        });

        // Select all checkboxes
        document.getElementById('selectAll').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.row-checkbox:not(:disabled)');
            checkboxes.forEach(cb => cb.checked = this.checked);
            toggleBulkActions();
        });

        // Individual checkbox change
        document.querySelectorAll('.row-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', toggleBulkActions);
        });

        // Toggle bulk actions visibility
        function toggleBulkActions() {
            const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');
            const bulkActions = document.getElementById('bulkActions');

            if (checkedBoxes.length > 0) {
                bulkActions.style.display = 'flex';
            } else {
                bulkActions.style.display = 'none';
            }
        }

        // Bulk actions
        function bulkAction(action) {
            const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');
            const ids = Array.from(checkedBoxes).map(cb => cb.value);

            if (ids.length === 0) {
                alert("{{ app()->getLocale() == 'en' ? 'Please select at least one user' : 'Veuillez sélectionner au moins un utilisateur' }}");
                return;
            }

            if (action === 'delete') {
                if (confirm(`{{ app()->getLocale() == 'en' ? 'Are you sure you want to delete' : 'Êtes-vous sûr de vouloir supprimer' }} ${ids.length} {{ app()->getLocale() == 'en' ? 'user(s)?' : 'utilisateur(s)?' }}`)) {
                    // TODO: Implement bulk delete
                    console.log('Bulk delete for IDs:', ids);
                    alert('{{ app()->getLocale() == 'en' ? 'Action under development' : 'Action en cours de développement' }}');
                }
            } else if (action === 'change-role') {
                // TODO: Show modal to change role
                alert('{{ app()->getLocale() == 'en' ? 'Action under development' : 'Action en cours de développement' }}');
            }
        }

        // Reset password
        function resetPassword(userId) {
            if (confirm('{{ app()->getLocale() == 'en' ? 'Send a password reset email to this user?' : 'Envoyer un email de réinitialisation de mot de passe à cet utilisateur ?' }}')) {
                // TODO: Implement password reset
                console.log('Reset password for user:', userId);
                alert('{{ app()->getLocale() == 'en' ? 'Action under development' : 'Action en cours de développement' }}');
            }
        }

        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
@endpush
