@extends('layouts.admin')

@php
    $pageTitle = app()->getLocale() == 'en' ? 'Project Management' : 'Gestion des Projets';
@endphp

@section('title', $pageTitle)

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">{{ app()->getLocale() == 'en' ? 'Project Management' : 'Gestion des Projets' }}</h2>
            <p class="text-muted mb-0">{{ $projects->total() }} {{ app()->getLocale() == 'en' ? 'project(s) total' : 'projet(s) au total' }}</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
                <i class="fas fa-filter me-2"></i>{{ app()->getLocale() == 'en' ? 'Filter' : 'Filtrer' }}
            </button>
            <a href="{{ route('admin.projects.create') }}" class="btn btn-primary-custom">
                <i class="fas fa-plus me-2"></i>{{ app()->getLocale() == 'en' ? 'New Project' : 'Nouveau Projet' }}
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Total Projects' : 'Total Projets' }}</div>
                        <div class="stat-value">{{ $projects->total() }}</div>
                    </div>
                    <div class="stat-icon" style="background: #EDE9FE; color: var(--primary);">
                        <i class="fas fa-project-diagram"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Active' : 'Actifs' }}</div>
                        <div class="stat-value text-success">{{ $stats['active'] }}</div>
                    </div>
                    <div class="stat-icon" style="background: #D1FAE5; color: #059669;">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Completed' : 'Complétés' }}</div>
                        <div class="stat-value text-primary">{{ $stats['completed'] }}</div>
                    </div>
                    <div class="stat-icon" style="background: #DBEAFE; color: #2563EB;">
                        <i class="fas fa-trophy"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Funds Raised' : 'Fonds Collectés' }}</div>
                        <div class="stat-value text-warning" style="font-size: 1.5rem;">
                            {{ number_format($stats['total_raised'], 0, ',', ' ') }} FCFA
                        </div>
                    </div>
                    <div class="stat-icon" style="background: #FEF3C7; color: #D97706;">
                        <i class="fas fa-coins"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="data-table">
        <!-- Table Header with Search -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold mb-0">{{ app()->getLocale() == 'en' ? 'Project List' : 'Liste des Projets' }}</h5>
            <div class="d-flex gap-2">
                <div class="position-relative" style="width: 300px;">
                    <i class="fas fa-search position-absolute" style="left: 12px; top: 50%; transform: translateY(-50%); color: #9CA3AF;"></i>
                    <input type="text" class="form-control ps-5" placeholder="{{ app()->getLocale() == 'en' ? 'Search a project...' : 'Rechercher un projet...' }}" id="searchInput">
                </div>
                <select class="form-select" style="width: 150px;" id="statusFilter">
                    <option value="">{{ app()->getLocale() == 'en' ? 'All statuses' : 'Tous les statuts' }}</option>
                    <option value="active">{{ app()->getLocale() == 'en' ? 'Active' : 'Actif' }}</option>
                    <option value="completed">{{ app()->getLocale() == 'en' ? 'Completed' : 'Complété' }}</option>
                    <option value="archived">{{ app()->getLocale() == 'en' ? 'Archived' : 'Archivé' }}</option>
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
            <table class="table" id="projectsTable">
                <thead>
                    <tr>
                        <th style="width: 5%;">
                            <input type="checkbox" id="selectAll">
                        </th>
                        <th style="width: 30%;">{{ app()->getLocale() == 'en' ? 'Project' : 'Projet' }}</th>
                        <th style="width: 12%;">{{ app()->getLocale() == 'en' ? 'Goal' : 'Objectif' }}</th>
                        <th style="width: 12%;">{{ app()->getLocale() == 'en' ? 'Raised' : 'Collecté' }}</th>
                        <th style="width: 15%;">{{ app()->getLocale() == 'en' ? 'Progress' : 'Progression' }}</th>
                        <th style="width: 10%;">{{ app()->getLocale() == 'en' ? 'Status' : 'Statut' }}</th>
                        <th style="width: 10%;">{{ app()->getLocale() == 'en' ? 'Date' : 'Date' }}</th>
                        <th style="width: 6%;" class="text-end">{{ app()->getLocale() == 'en' ? 'Actions' : 'Actions' }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($projects as $project)
                    <tr>
                        <td>
                            <input type="checkbox" class="row-checkbox" value="{{ $project->id }}">
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                @if($project->main_image)
                                    <img src="{{ asset('storage/' . $project->main_image->image_path) }}"
                                        alt="{{ $project->title_fr }}"
                                        class="rounded"
                                        style="width: 60px; height: 60px; object-fit: cover;">
                                @else
                                    <div class="rounded bg-light d-flex align-items-center justify-content-center"
                                        style="width: 60px; height: 60px;">
                                        <i class="fas fa-image text-muted"></i>
                                    </div>
                                @endif
                                <div>
                                    <div class="fw-semibold">{{ $project->title_fr }}</div>
                                    <small class="text-muted">{{ Str::limit($project->description_fr, 50) }}</small>
                                    @if($project->featured)
                                    <span class="badge bg-warning text-dark ms-2">
                                        <i class="fas fa-star"></i> {{ app()->getLocale() == 'en' ? 'Featured' : 'Vedette' }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <strong>{{ number_format($project->goal_amount, 0, ',', ' ') }} FCFA</strong>
                        </td>
                        <td>
                            <strong class="text-success">{{ number_format($project->raised_amount, 0, ',', ' ') }} FCFA</strong>
                        </td>
                        <td>
                            @php
                                $percentage = $project->goal_amount > 0
                                    ? min(100, ($project->raised_amount / $project->goal_amount) * 100)
                                    : 0;
                                $colorClass = $percentage >= 75 ? 'bg-success' : ($percentage >= 50 ? 'bg-warning' : 'bg-danger');
                            @endphp
                            <div class="d-flex align-items-center gap-2">
                                <div class="progress flex-grow-1" style="height: 8px;">
                                    <div class="progress-bar {{ $colorClass }}" style="width: {{ $percentage }}%"></div>
                                </div>
                                <small class="fw-semibold">{{ number_format($percentage, 0) }}%</small>
                            </div>
                        </td>
                        <td>
                            @if($project->status === 'active')
                                <span class="status-badge success">
                                    <i class="fas fa-check-circle"></i> {{ app()->getLocale() == 'en' ? 'Active' : 'Actif' }}
                                </span>
                            @elseif($project->status === 'completed')
                                <span class="status-badge info">
                                    <i class="fas fa-flag-checkered"></i> {{ app()->getLocale() == 'en' ? 'Completed' : 'Complété' }}
                                </span>
                            @else
                                <span class="status-badge warning">
                                    <i class="fas fa-archive"></i> {{ app()->getLocale() == 'en' ? 'Archived' : 'Archivé' }}
                                </span>
                            @endif
                        </td>
                        <td>
                            <small class="text-muted">{{ $project->created_at->format('d/m/Y') }}</small>
                        </td>
                        <td class="text-end">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                   <li>
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#viewProjectModal{{ $project->id }}">
                                            <i class="fas fa-eye me-2"></i>{{ app()->getLocale() == 'en' ? 'View' : 'Voir' }}
                                        </button>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.projects.edit', $project) }}">
                                            <i class="fas fa-edit me-2"></i>{{ app()->getLocale() == 'en' ? 'Edit' : 'Modifier' }}
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('admin.projects.destroy', $project) }}"
                                              method="POST"
                                              onsubmit="return confirm(&quot;{{ app()->getLocale() == 'en' ? 'Are you sure you want to delete this project?' : 'Êtes-vous sûr de vouloir supprimer ce projet ?' }}&quot;);">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="fas fa-trash me-2"></i>{{ app()->getLocale() == 'en' ? 'Delete' : 'Supprimer' }}
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                     <!-- Modal Vue Projet details-->
                    <div class="modal fade" id="viewProjectModal{{ $project->id }}" tabindex="-1">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{ $project->title_fr }}
                                        @if($project->featured)
                                            <span class="badge bg-warning text-dark ms-2"><i class="fas fa-star"></i> {{ app()->getLocale() == 'en' ? 'Featured' : 'Vedette' }}</span>
                                        @endif
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row g-4">
                                        <div class="col-lg-6">
                                            <!-- Toutes les images du projet -->
                                            <div class="d-flex flex-wrap gap-2 mb-3">
                                                @forelse($project->images as $img)
                                                    <div>
                                                        <img src="{{ asset('storage/' . $img->image_path) }}"
                                                            alt="Image projet"
                                                            class="rounded border"
                                                            style="width: 180px; height: 150px; object-fit: cover;">
                                                        @if($img->caption_fr)
                                                            <div class="text-muted small mt-1">{{ $img->caption_fr }}</div>
                                                        @endif
                                                    </div>
                                                @empty
                                                    <div class="rounded bg-light d-flex align-items-center justify-content-center"
                                                        style="width: 180px; height: 150px;">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                @endforelse
                                            </div>
                                            <div class="mb-3">
                                                <strong>{{ app()->getLocale() == 'en' ? 'Description (FR)' : 'Description (FR)' }} :</strong>
                                                <p>{{ $project->description_fr }}</p>
                                            </div>
                                            <div class="mb-3">
                                                <strong>{{ app()->getLocale() == 'en' ? 'Description (EN)' : 'Description (EN)' }} :</strong>
                                                <p>{{ $project->description_en }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <strong>{{ app()->getLocale() == 'en' ? 'Goal' : 'Objectif' }} :</strong> {{ number_format($project->goal_amount, 0, ',', ' ') }} FCFA
                                            </div>
                                            <div class="mb-2">
                                                <strong>{{ app()->getLocale() == 'en' ? 'Raised' : 'Collecté' }} :</strong> {{ number_format($project->raised_amount, 0, ',', ' ') }} FCFA
                                            </div>
                                            <div class="mb-2">
                                                <strong>{{ app()->getLocale() == 'en' ? 'Progress' : 'Progression' }} :</strong>
                                                @php
                                                    $percentage = $project->goal_amount > 0
                                                        ? min(100, ($project->raised_amount / $project->goal_amount) * 100)
                                                        : 0;
                                                    $colorClass = $percentage >= 75 ? 'bg-success' : ($percentage >= 50 ? 'bg-warning' : 'bg-danger');
                                                @endphp
                                                <div class="progress" style="height: 12px; width: 80%;">
                                                    <div class="progress-bar {{ $colorClass }}" style="width: {{ $percentage }}%"></div>
                                                </div>
                                                <span class="fw-semibold ms-2">{{ number_format($percentage, 0) }}%</span>
                                            </div>
                                            <div class="mb-2">
                                                <strong>{{ app()->getLocale() == 'en' ? 'Status' : 'Statut' }} :</strong>
                                                @if($project->status === 'active')
                                                    <span class="badge bg-success"><i class="fas fa-check-circle"></i> {{ app()->getLocale() == 'en' ? 'Active' : 'Actif' }}</span>
                                                @elseif($project->status === 'completed')
                                                    <span class="badge bg-primary"><i class="fas fa-flag-checkered"></i> {{ app()->getLocale() == 'en' ? 'Completed' : 'Complété' }}</span>
                                                @else
                                                    <span class="badge bg-warning text-dark"><i class="fas fa-archive"></i> {{ app()->getLocale() == 'en' ? 'Archived' : 'Archivé' }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-2">
                                                <strong>{{ app()->getLocale() == 'en' ? 'Start Date' : 'Date début' }} :</strong>
                                                {{ $project->start_date ? $project->start_date->format('d/m/Y') : '-' }}<br>
                                                <strong>{{ app()->getLocale() == 'en' ? 'End Date' : 'Date fin' }} :</strong>
                                                {{ $project->end_date ? $project->end_date->format('d/m/Y') : '-' }}
                                            </div>
                                            <div class="mb-2">
                                                <strong>Slug :</strong> <code>{{ $project->slug }}</code>
                                            </div>
                                            <div class="mb-2">
                                                <strong>{{ app()->getLocale() == 'en' ? 'Created on' : 'Créé le' }} :</strong> {{ $project->created_at->format('d/m/Y à H:i') }}<br>
                                                <strong>{{ app()->getLocale() == 'en' ? 'Last modified' : 'Dernière modification' }} :</strong> {{ $project->updated_at->format('d/m/Y à H:i') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ app()->getLocale() == 'en' ? 'Close' : 'Fermer' }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <i class="fas fa-folder-open fa-3x text-muted mb-3 d-block"></i>
                            <p class="text-muted mb-3">{{ app()->getLocale() == 'en' ? 'No project found' : 'Aucun projet trouvé' }}</p>
                            <a href="{{ route('admin.projects.create') }}" class="btn btn-primary-custom">
                                <i class="fas fa-plus me-2"></i>{{ app()->getLocale() == 'en' ? 'Create the first project' : 'Créer le premier projet' }}
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($projects->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="text-muted">
                {{ app()->getLocale() == 'en' ? 'Showing' : 'Affichage de' }} {{ $projects->firstItem() }} {{ app()->getLocale() == 'en' ? 'to' : 'à' }} {{ $projects->lastItem() }} {{ app()->getLocale() == 'en' ? 'on' : 'sur' }} {{ $projects->total() }} {{ app()->getLocale() == 'en' ? 'projects' : 'projets' }}
            </div>
            {{ $projects->links() }}
        </div>
        @endif

        <!-- Bulk Actions -->
        <div class="d-flex gap-2 mt-3" id="bulkActions" style="display: none !important;">
            <button class="btn btn-sm btn-outline-primary" onclick="bulkAction('featured')">
                <i class="fas fa-star me-1"></i>{{ app()->getLocale() == 'en' ? 'Feature' : 'Mettre en vedette' }}
            </button>
            <button class="btn btn-sm btn-outline-warning" onclick="bulkAction('archive')">
                <i class="fas fa-archive me-1"></i>{{ app()->getLocale() == 'en' ? 'Archive' : 'Archiver' }}
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
                        <label class="form-label">{{ app()->getLocale() == 'en' ? 'Status' : 'Statut' }}</label>
                        <select class="form-select">
                            <option value="">{{ app()->getLocale() == 'en' ? 'All' : 'Tous' }}</option>
                            <option value="active">{{ app()->getLocale() == 'en' ? 'Active' : 'Actif' }}</option>
                            <option value="completed">{{ app()->getLocale() == 'en' ? 'Completed' : 'Complété' }}</option>
                            <option value="archived">{{ app()->getLocale() == 'en' ? 'Archived' : 'Archivé' }}</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ app()->getLocale() == 'en' ? 'Goal Amount' : 'Montant Objectif' }}</label>
                        <div class="row g-2">
                            <div class="col-6">
                                <input type="number" class="form-control" placeholder="{{ app()->getLocale() == 'en' ? 'Min' : 'Min' }}">
                            </div>
                            <div class="col-6">
                                <input type="number" class="form-control" placeholder="{{ app()->getLocale() == 'en' ? 'Max' : 'Max' }}">
                            </div>
                        </div>
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
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="featuredOnly">
                        <label class="form-check-label" for="featuredOnly">
                            {{ app()->getLocale() == 'en' ? 'Featured projects only' : 'Projets en vedette uniquement' }}
                        </label>
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
            const rows = document.querySelectorAll('#projectsTable tbody tr');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });

        // Status filter
        document.getElementById('statusFilter').addEventListener('change', function() {
            const status = this.value.toLowerCase();
            const rows = document.querySelectorAll('#projectsTable tbody tr');

            rows.forEach(row => {
                if (!status) {
                    row.style.display = '';
                    return;
                }

                const statusBadge = row.querySelector('.status-badge');
                if (statusBadge && statusBadge.textContent.toLowerCase().includes(status)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Select all checkboxes
        document.getElementById('selectAll').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.row-checkbox');
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
                alert("{{ app()->getLocale() == 'en' ? 'Please select at least one project' : 'Veuillez sélectionner au moins un projet' }}");
                return;
            }

            if (confirm(`{{ app()->getLocale() == 'en' ? 'Are you sure you want to' : 'Êtes-vous sûr de vouloir' }} ${action === 'delete' ? '{{ app()->getLocale() == 'en' ? 'delete' : 'supprimer' }}' : '{{ app()->getLocale() == 'en' ? 'modify' : 'modifier' }}'} ${ids.length} {{ app()->getLocale() == 'en' ? 'project(s)?' : 'projet(s)?' }}`)) {
                // TODO: Implement bulk action AJAX call
                console.log(`Bulk ${action} for IDs:`, ids);
                alert('Action en cours de développement');
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
