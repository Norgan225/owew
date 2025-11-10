@extends('layouts.admin')

@php
    $pageTitle = app()->getLocale() == 'en' ? 'Testimonials Management' : 'Gestion des Témoignages';
@endphp

@section('title', $pageTitle)

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">{{ app()->getLocale() == 'en' ? 'Testimonials Management' : 'Gestion des Témoignages' }}</h2>
            <p class="text-muted mb-0">{{ $testimonials->total() }} {{ app()->getLocale() == 'en' ? 'testimonial(s) total' : 'témoignage(s) au total' }}</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
                <i class="fas fa-filter me-2"></i>{{ app()->getLocale() == 'en' ? 'Filter' : 'Filtrer' }}
            </button>
            <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary-custom">
                <i class="fas fa-plus me-2"></i>{{ app()->getLocale() == 'en' ? 'New Testimonial' : 'Nouveau Témoignage' }}
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-lg-4 col-md-6">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Total Testimonials' : 'Total Témoignages' }}</div>
                        <div class="stat-value">{{ $testimonials->total() }}</div>
                    </div>
                    <div class="stat-icon" style="background: #EDE9FE; color: var(--primary);">
                        <i class="fas fa-comment-dots"></i>
                    </div>
                </div>
            </div>
        </div>
       <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Unpublished' : 'Non Publiés' }}</div>
                        <div class="stat-value text-warning">{{ $testimonials->total() - ($publishedCount ?? 0) }}</div>
                    </div>
                    <div class="stat-icon" style="background: #FEF3C7; color: #D97706;">
                        <i class="fas fa-pause-circle"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Average Rating' : 'Note Moyenne' }}</div>
                        <div class="stat-value text-warning">{{ number_format($averageRating ?? 0, 2) }}/5</div>
                    </div>
                    <div class="stat-icon" style="background: #FEF3C7; color: #D97706;">
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="data-table">
        <!-- Table Header with Search -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold mb-0">{{ app()->getLocale() == 'en' ? 'Testimonials List' : 'Liste des Témoignages' }}</h5>
            <div class="d-flex gap-2">
                <div class="position-relative" style="width: 300px;">
                    <i class="fas fa-search position-absolute" style="left: 12px; top: 50%; transform: translateY(-50%); color: #9CA3AF;"></i>
                    <input type="text" class="form-control ps-5" placeholder="{{ app()->getLocale() == 'en' ? 'Search...' : 'Rechercher...' }}" id="searchInput">
                </div>
                <select class="form-select" style="width: 150px;" id="statusFilter">
                    <option value="">{{ app()->getLocale() == 'en' ? 'All statuses' : 'Tous les statuts' }}</option>
                    <option value="published">{{ app()->getLocale() == 'en' ? 'Published' : 'Publié' }}</option>
                    <option value="unpublished">{{ app()->getLocale() == 'en' ? 'Unpublished' : 'Non publié' }}</option>
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
            <table class="table" id="testimonialTable">
                <thead>
                    <tr>
                        <th style="width: 5%;">
                            <input type="checkbox" id="selectAll">
                        </th>
                        <th style="width: 35%;">{{ app()->getLocale() == 'en' ? 'Testimonial' : 'Témoignage' }}</th>
                        <th style="width: 15%;">{{ app()->getLocale() == 'en' ? 'Name' : 'Nom' }}</th>
                        <th style="width: 15%;">{{ app()->getLocale() == 'en' ? 'Role' : 'Rôle' }}</th>
                        <th style="width: 10%;">{{ app()->getLocale() == 'en' ? 'Rating' : 'Note' }}</th>
                        <th style="width: 10%;">{{ app()->getLocale() == 'en' ? 'Status' : 'Statut' }}</th>
                        <th style="width: 15%;" class="text-end">{{ app()->getLocale() == 'en' ? 'Actions' : 'Actions' }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($testimonials as $testimonial)
                    <tr data-status="{{ $testimonial->is_published ? 'published' : 'unpublished' }}">
                        <td>
                            <input type="checkbox" class="row-checkbox" value="{{ $testimonial->id }}">
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                @if($testimonial->image)
                                <img src="{{ asset('storage/' . $testimonial->image) }}"
                                     alt="{{ $testimonial->name }}"
                                     class="rounded"
                                     style="width: 80px; height: 60px; object-fit: cover;">
                                @else
                                <div class="rounded bg-light d-flex align-items-center justify-content-center"
                                     style="width: 80px; height: 60px;">
                                    <i class="fas fa-user text-muted"></i>
                                </div>
                                @endif
                                <div>
                                    <div class="fw-semibold mb-1">{{ Str::limit(strip_tags($testimonial->content_fr), 60) }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="fw-semibold">{{ $testimonial->name }}</div>
                        </td>
                        <td>
                            <div class="text-muted">{{ $testimonial->role_fr }}</div>
                        </td>
                        <td>
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star{{ $testimonial->rating >= $i ? ' text-warning' : ' text-muted' }}"></i>
                            @endfor
                        </td>
                        <td>
                            @if($testimonial->is_published)
                                <span class="status-badge success">
                                    <i class="fas fa-globe"></i> {{ app()->getLocale() == 'en' ? 'Published' : 'Publié' }}
                                </span>
                            @else
                                <span class="status-badge warning">
                                    <i class="fas fa-file-alt"></i> {{ app()->getLocale() == 'en' ? 'Unpublished' : 'Non publié' }}
                                </span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.testimonials.edit', $testimonial) }}">
                                            <i class="fas fa-edit me-2"></i>{{ app()->getLocale() == 'en' ? 'Edit' : 'Modifier' }}
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    @if(!$testimonial->is_published)
                                    <li>
                                        <form action="{{ route('admin.testimonials.toggle-publish', $testimonial) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="dropdown-item text-success">
                                                <i class="fas fa-paper-plane me-2"></i>{{ app()->getLocale() == 'en' ? 'Publish' : 'Publier' }}
                                            </button>
                                        </form>
                                    </li>
                                    @endif
                                    @if($testimonial->is_published)
                                    <li>
                                        <form action="{{ route('admin.testimonials.toggle-publish', $testimonial) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="dropdown-item text-warning">
                                                <i class="fas fa-pause me-2"></i>{{ app()->getLocale() == 'en' ? 'Unpublish' : 'Dépublier' }}
                                            </button>
                                        </form>
                                    </li>
                                    @endif
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('admin.testimonials.destroy', $testimonial) }}"
                                              method="POST"
                                              onsubmit="return confirm(&quot;{{ app()->getLocale() == 'en' ? 'Are you sure you want to delete this testimonial?' : 'Êtes-vous sûr de vouloir supprimer ce témoignage ?' }}&quot;);">
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
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <i class="fas fa-comment-dots fa-3x text-muted mb-3 d-block"></i>
                            <p class="text-muted mb-3">{{ app()->getLocale() == 'en' ? 'No testimonials found' : 'Aucun témoignage trouvé' }}</p>
                            <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary-custom">
                                <i class="fas fa-plus me-2"></i>{{ app()->getLocale() == 'en' ? 'Create the first testimonial' : 'Créer le premier témoignage' }}
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($testimonials->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="text-muted">
                {{ app()->getLocale() == 'en' ? 'Showing' : 'Affichage de' }} {{ $testimonials->firstItem() }} {{ app()->getLocale() == 'en' ? 'to' : 'à' }} {{ $testimonials->lastItem() }} {{ app()->getLocale() == 'en' ? 'of' : 'sur' }} {{ $testimonials->total() }} {{ app()->getLocale() == 'en' ? 'testimonials' : 'témoignages' }}
            </div>
            {{ $testimonials->links() }}
        </div>
        @endif

        <!-- Bulk Actions -->
        <div class="d-flex gap-2 mt-3" id="bulkActions" style="display: none !important;">
            <button class="btn btn-sm btn-outline-success" onclick="bulkAction('publish')">
                <i class="fas fa-paper-plane me-1"></i>{{ app()->getLocale() == 'en' ? 'Publish' : 'Publier' }}
            </button>
            <button class="btn btn-sm btn-outline-warning" onclick="bulkAction('unpublish')">
                <i class="fas fa-pause me-1"></i>{{ app()->getLocale() == 'en' ? 'Unpublish' : 'Dépublier' }}
            </button>
            <button class="btn btn-sm btn-outline-danger" onclick="bulkAction('delete')">
                <i class="fas fa-trash me-1"></i>{{ app()->getLocale() == 'en' ? 'Delete' : 'Supprimer' }}
            </button>
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
                            <select class="form-select" name="status">
                                <option value="">{{ app()->getLocale() == 'en' ? 'All' : 'Tous' }}</option>
                                <option value="published">{{ app()->getLocale() == 'en' ? 'Published' : 'Publié' }}</option>
                                <option value="unpublished">{{ app()->getLocale() == 'en' ? 'Unpublished' : 'Non publié' }}</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ app()->getLocale() == 'en' ? 'Rating' : 'Note' }}</label>
                            <select class="form-select" name="rating">
                                <option value="">{{ app()->getLocale() == 'en' ? 'All' : 'Toutes' }}</option>
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }} {{ app()->getLocale() == 'en' ? 'star(s)' : 'étoile(s)' }}</option>
                                @endfor
                            </select>
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
</div>
@endsection

@push('scripts')
<script>
    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('#testimonialTable tbody tr');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });

    // Status filter
    document.getElementById('statusFilter').addEventListener('change', function() {
        const status = this.value;
        const rows = document.querySelectorAll('#testimonialTable tbody tr');

        rows.forEach(row => {
            if (!status) {
                row.style.display = '';
                return;
            }

            const rowStatus = row.getAttribute('data-status');
            row.style.display = rowStatus === status ? '' : 'none';
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

    // Bulk actions (à développer)
    function bulkAction(action) {
        const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');
        const ids = Array.from(checkedBoxes).map(cb => cb.value);

        if (ids.length === 0) {
            alert("{{ app()->getLocale() == 'en' ? 'Please select at least one testimonial' : 'Veuillez sélectionner au moins un témoignage' }}");
            return;
        }

        let confirmMsg = '';
        switch(action) {
            case 'publish':
                confirmMsg = '{{ app()->getLocale() == 'en' ? 'Publish selected testimonials?' : 'Publier les témoignages sélectionnés ?' }}';
                break;
            case 'unpublish':
                confirmMsg = '{{ app()->getLocale() == 'en' ? 'Unpublish selected testimonials?' : 'Dépublier les témoignages sélectionnés ?' }}';
                break;
            case 'delete':
                confirmMsg = '{{ app()->getLocale() == 'en' ? 'Permanently delete selected testimonials?' : 'Supprimer définitivement les témoignages sélectionnés ?' }}';
                break;
        }

        if (confirm(confirmMsg)) {
            // TODO: Implémenter l'appel AJAX pour l'action groupée
            console.log(`Bulk ${action} for IDs:`, ids);
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
