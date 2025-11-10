@extends('layouts.admin')

@php
    $pageTitle = app()->getLocale() == 'en' ? 'Blog Management' : 'Gestion du Blog';
@endphp

@section('title', $pageTitle)

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">{{ app()->getLocale() == 'en' ? 'Blog Management' : 'Gestion du Blog' }}</h2>
            <p class="text-muted mb-0">{{ $posts->total() }} {{ app()->getLocale() == 'en' ? 'article(s) total' : 'article(s) au total' }}</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
                <i class="fas fa-filter me-2"></i>{{ app()->getLocale() == 'en' ? 'Filter' : 'Filtrer' }}
            </button>
            <a href="{{ route('admin.blog.create') }}" class="btn btn-primary-custom">
                <i class="fas fa-plus me-2"></i>{{ app()->getLocale() == 'en' ? 'New Article' : 'Nouvel Article' }}
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Total Articles' : 'Total Articles' }}</div>
                        <div class="stat-value">{{ $posts->total() }}</div>
                    </div>
                    <div class="stat-icon" style="background: #EDE9FE; color: var(--primary);">
                        <i class="fas fa-blog"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Published' : 'Publiés' }}</div>
                        <div class="stat-value text-success">{{ $publishedCount ?? 0 }}</div>
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
                        <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Drafts' : 'Brouillons' }}</div>
                        <div class="stat-value text-warning">{{ $draftCount ?? 0 }}</div>
                    </div>
                    <div class="stat-icon" style="background: #FEF3C7; color: #D97706;">
                        <i class="fas fa-file-alt"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Total Views' : 'Total Vues' }}</div>
                        <div class="stat-value text-primary">{{ number_format($totalViews ?? 0, 0, ',', ' ') }}</div>
                        <div class="stat-change up">
                            <i class="fas fa-arrow-up"></i> +15%
                        </div>
                    </div>
                    <div class="stat-icon" style="background: #DBEAFE; color: #2563EB;">
                        <i class="fas fa-eye"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="data-table">
        <!-- Table Header with Search -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold mb-0">{{ app()->getLocale() == 'en' ? 'Articles List' : 'Liste des Articles' }}</h5>
            <div class="d-flex gap-2">
                <div class="position-relative" style="width: 300px;">
                    <i class="fas fa-search position-absolute" style="left: 12px; top: 50%; transform: translateY(-50%); color: #9CA3AF;"></i>
                    <input type="text" class="form-control ps-5" placeholder="{{ app()->getLocale() == 'en' ? 'Search an article...' : 'Rechercher un article...' }}" id="searchInput">
                </div>
                <select class="form-select" style="width: 150px;" id="statusFilter">
                    <option value="">{{ app()->getLocale() == 'en' ? 'All statuses' : 'Tous les statuts' }}</option>
                    <option value="published">{{ app()->getLocale() == 'en' ? 'Published' : 'Publié' }}</option>
                    <option value="draft">{{ app()->getLocale() == 'en' ? 'Draft' : 'Brouillon' }}</option>
                    <option value="archived">{{ app()->getLocale() == 'en' ? 'Archived' : 'Archivé' }}</option>
                </select>
                <select class="form-select" style="width: 150px;" id="categoryFilter">
                    <option value="">{{ app()->getLocale() == 'en' ? 'All categories' : 'Toutes catégories' }}</option>
                    @foreach($categories ?? [] as $category)
                    <option value="{{ $category->id }}">{{ localized_field($category, 'name') }}</option>
                    @endforeach
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
            <table class="table" id="blogTable">
                <thead>
                    <tr>
                        <th style="width: 5%;">
                            <input type="checkbox" id="selectAll">
                        </th>
                        <th style="width: 35%;">{{ app()->getLocale() == 'en' ? 'Article' : 'Article' }}</th>
                        <th style="width: 15%;">{{ app()->getLocale() == 'en' ? 'Category' : 'Catégorie' }}</th>
                        <th style="width: 12%;">{{ app()->getLocale() == 'en' ? 'Author' : 'Auteur' }}</th>
                        <th style="width: 8%;">{{ app()->getLocale() == 'en' ? 'Views' : 'Vues' }}</th>
                        <th style="width: 10%;">{{ app()->getLocale() == 'en' ? 'Status' : 'Statut' }}</th>
                        <th style="width: 10%;">{{ app()->getLocale() == 'en' ? 'Date' : 'Date' }}</th>
                        <th style="width: 5%;" class="text-end">{{ app()->getLocale() == 'en' ? 'Actions' : 'Actions' }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                    <tr data-category="{{ $post->category_id ?? '' }}">
                        <td>
                            <input type="checkbox" class="row-checkbox" value="{{ $post->id }}">
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                @if($post->featured_image)
                                <img src="{{ asset('storage/' . $post->featured_image) }}"
                                     alt="{{ localized_field($post, 'title') }}"
                                     class="rounded"
                                     style="width: 80px; height: 60px; object-fit: cover;">
                                @else
                                <div class="rounded bg-light d-flex align-items-center justify-content-center"
                                     style="width: 80px; height: 60px;">
                                    <i class="fas fa-image text-muted"></i>
                                </div>
                                @endif
                                <div>
                                    <div class="fw-semibold mb-1">{{ Str::limit(localized_field($post, 'title'), 60) }}</div>
                                    <small class="text-muted d-block">{{ Str::limit(strip_tags(localized_field($post, 'content')), 80) }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($post->category)
                            <span class="badge" style="background: {{ $post->category->color ?? '#6B7280' }}; color: white; padding: 0.5rem 0.8rem;">
                                {{ localized_field($post->category, 'name') }}
                            </span>
                            @else
                            <span class="text-muted">{{ app()->getLocale() == 'en' ? 'No category' : 'Sans catégorie' }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                @if($post->author)
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($post->author->name) }}&background=4B0082&color=fff"
                                     alt="{{ $post->author->name }}"
                                     class="rounded-circle"
                                     style="width: 32px; height: 32px;">
                                <div>
                                    <div class="fw-semibold" style="font-size: 0.85rem;">{{ $post->author->name }}</div>
                                </div>
                                @else
                                <span class="text-muted">{{ app()->getLocale() == 'en' ? 'N/A' : 'N/A' }}</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-1">
                                <i class="fas fa-eye text-muted"></i>
                                <strong>{{ number_format($post->views_count ?? 0, 0, ',', ' ') }}</strong>
                            </div>
                        </td>
                        <td>
                            @if($post->status === 'published')
                                <span class="status-badge success">
                                    <i class="fas fa-globe"></i> {{ app()->getLocale() == 'en' ? 'Published' : 'Publié' }}
                                </span>
                            @elseif($post->status === 'draft')
                                <span class="status-badge warning">
                                    <i class="fas fa-file-alt"></i> {{ app()->getLocale() == 'en' ? 'Draft' : 'Brouillon' }}
                                </span>
                            @else
                                <span class="status-badge info">
                                    <i class="fas fa-archive"></i> {{ app()->getLocale() == 'en' ? 'Archived' : 'Archivé' }}
                                </span>
                            @endif
                        </td>
                        <td>
                            @if($post->published_at)
                            <small class="text-muted d-block">{{ $post->published_at->format('d/m/Y') }}</small>
                            <small class="text-muted">{{ $post->published_at->format('H:i') }}</small>
                            @else
                            <small class="text-muted">{{ app()->getLocale() == 'en' ? 'Not published' : 'Non publié' }}</small>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('blog.show', $post->slug) }}" target="_blank">
                                            <i class="fas fa-eye me-2"></i>{{ app()->getLocale() == 'en' ? 'View on site' : 'Voir sur le site' }}
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.blog.edit', $post) }}">
                                            <i class="fas fa-edit me-2"></i>{{ app()->getLocale() == 'en' ? 'Edit' : 'Modifier' }}
                                        </a>
                                    </li>
                                    @if($post->status === 'draft')
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('admin.blog.publish', $post) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="dropdown-item text-success">
                                                <i class="fas fa-paper-plane me-2"></i>{{ app()->getLocale() == 'en' ? 'Publish' : 'Publier' }}
                                            </button>
                                        </form>
                                    </li>
                                    @endif
                                    @if($post->status === 'published')
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('admin.blog.unpublish', $post) }}" method="POST">
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
                                        <a class="dropdown-item" href="#" onclick="duplicatePost({{ $post->id }})">
                                            <i class="fas fa-copy me-2"></i>{{ app()->getLocale() == 'en' ? 'Duplicate' : 'Dupliquer' }}
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('admin.blog.destroy', $post) }}"
                                              method="POST"
                                              onsubmit="return confirm(&quot;{{ app()->getLocale() == 'en' ? 'Are you sure you want to delete this article?' : 'Êtes-vous sûr de vouloir supprimer cet article ?' }}&quot;);">
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
                        <td colspan="8" class="text-center py-5">
                            <i class="fas fa-blog fa-3x text-muted mb-3 d-block"></i>
                            <p class="text-muted mb-3">{{ app()->getLocale() == 'en' ? 'No articles found' : 'Aucun article trouvé' }}</p>
                            <a href="{{ route('admin.blog.create') }}" class="btn btn-primary-custom">
                                <i class="fas fa-plus me-2"></i>{{ app()->getLocale() == 'en' ? 'Create the first article' : 'Créer le premier article' }}
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($posts->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="text-muted">
                {{ app()->getLocale() == 'en' ? 'Showing' : 'Affichage de' }} {{ $posts->firstItem() }} {{ app()->getLocale() == 'en' ? 'to' : 'à' }} {{ $posts->lastItem() }} {{ app()->getLocale() == 'en' ? 'of' : 'sur' }} {{ $posts->total() }} {{ app()->getLocale() == 'en' ? 'articles' : 'articles' }}
            </div>
            {{ $posts->links() }}
        </div>
        @endif

        <!-- Bulk Actions -->
        <div class="d-flex gap-2 mt-3" id="bulkActions" style="display: none !important;">
            <button class="btn btn-sm btn-outline-success" onclick="bulkAction('publish')">
                <i class="fas fa-paper-plane me-1"></i>{{ app()->getLocale() == 'en' ? 'Publish' : 'Publier' }}
            </button>
            <button class="btn btn-sm btn-outline-warning" onclick="bulkAction('draft')">
                <i class="fas fa-file-alt me-1"></i>{{ app()->getLocale() == 'en' ? 'Move to draft' : 'Mettre en brouillon' }}
            </button>
            <button class="btn btn-sm btn-outline-info" onclick="bulkAction('archive')">
                <i class="fas fa-archive me-1"></i>{{ app()->getLocale() == 'en' ? 'Archive' : 'Archiver' }}
            </button>
            <button class="btn btn-sm btn-outline-danger" onclick="bulkAction('delete')">
                <i class="fas fa-trash me-1"></i>{{ app()->getLocale() == 'en' ? 'Delete' : 'Supprimer' }}
            </button>
        </div>
    </div>

    <!-- Quick Stats Chart -->
    <div class="row mt-4">
        <div class="col-lg-8">
            <div class="chart-card">
                <h5 class="fw-bold mb-3">{{ app()->getLocale() == 'en' ? 'Article Views (Last 30 days)' : 'Vues des Articles (30 derniers jours)' }}</h5>
                <canvas id="viewsChart" height="80"></canvas>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="chart-card">
                <h5 class="fw-bold mb-3">{{ app()->getLocale() == 'en' ? 'Top 5 Articles' : 'Top 5 Articles' }}</h5>
                <div class="list-group list-group-flush">
                    @foreach($topPosts ?? [] as $index => $topPost)
                    <div class="list-group-item border-0 px-0 d-flex align-items-center gap-3">
                        <div class="fw-bold text-primary" style="font-size: 1.2rem; min-width: 30px;">
                            #{{ $index + 1 }}
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-semibold" style="font-size: 0.9rem;">
                                {{ Str::limit(localized_field($topPost, 'title'), 40) }}
                            </div>
                            <small class="text-muted">
                                <i class="fas fa-eye me-1"></i>{{ number_format($topPost->views_count, 0, ',', ' ') }} {{ app()->getLocale() == 'en' ? 'views' : 'vues' }}
                            </small>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
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
                        <select class="form-select" name="status">
                            <option value="">{{ app()->getLocale() == 'en' ? 'All' : 'Tous' }}</option>
                            <option value="published">{{ app()->getLocale() == 'en' ? 'Published' : 'Publié' }}</option>
                            <option value="draft">{{ app()->getLocale() == 'en' ? 'Draft' : 'Brouillon' }}</option>
                            <option value="archived">{{ app()->getLocale() == 'en' ? 'Archived' : 'Archivé' }}</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ app()->getLocale() == 'en' ? 'Category' : 'Catégorie' }}</label>
                        <select class="form-select" name="category">
                            <option value="">{{ app()->getLocale() == 'en' ? 'All' : 'Toutes' }}</option>
                            @foreach($categories ?? [] as $category)
                            <option value="{{ $category->id }}">{{ localized_field($category, 'name') }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ app()->getLocale() == 'en' ? 'Author' : 'Auteur' }}</label>
                        <select class="form-select" name="author">
                            <option value="">{{ app()->getLocale() == 'en' ? 'All' : 'Tous' }}</option>
                            @foreach($authors ?? [] as $author)
                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ app()->getLocale() == 'en' ? 'Publication Date' : 'Date de publication' }}</label>
                        <div class="row g-2">
                            <div class="col-6">
                                <input type="date" class="form-control" name="date_from">
                            </div>
                            <div class="col-6">
                                <input type="date" class="form-control" name="date_to">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ app()->getLocale() == 'en' ? 'Number of Views' : 'Nombre de vues' }}</label>
                        <div class="row g-2">
                            <div class="col-6">
                                <input type="number" class="form-control" name="views_min" placeholder="{{ app()->getLocale() == 'en' ? 'Min' : 'Min' }}">
                            </div>
                            <div class="col-6">
                                <input type="number" class="form-control" name="views_max" placeholder="{{ app()->getLocale() == 'en' ? 'Max' : 'Max' }}">
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
        const rows = document.querySelectorAll('#blogTable tbody tr');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });

    // Status filter
    document.getElementById('statusFilter').addEventListener('change', function() {
        const status = this.value.toLowerCase();
        const rows = document.querySelectorAll('#blogTable tbody tr');

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

    // Category filter
    document.getElementById('categoryFilter').addEventListener('change', function() {
        const categoryId = this.value;
        const rows = document.querySelectorAll('#blogTable tbody tr');

        rows.forEach(row => {
            if (!categoryId) {
                row.style.display = '';
                return;
            }

            const rowCategory = row.getAttribute('data-category');
            row.style.display = rowCategory === categoryId ? '' : 'none';
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
            alert("{{ app()->getLocale() == 'en' ? 'Please select at least one article' : 'Veuillez sélectionner au moins un article' }}");
            return;
        }

        let confirmMsg = '';
        switch(action) {
            case 'publish':
                confirmMsg = '{{ app()->getLocale() == 'en' ? 'Publish selected articles?' : 'Publier les articles sélectionnés ?' }}';
                break;
            case 'draft':
                confirmMsg = '{{ app()->getLocale() == 'en' ? 'Move selected articles to draft?' : 'Mettre en brouillon les articles sélectionnés ?' }}';
                break;
            case 'archive':
                confirmMsg = '{{ app()->getLocale() == 'en' ? 'Archive selected articles?' : 'Archiver les articles sélectionnés ?' }}';
                break;
            case 'delete':
                confirmMsg = '{{ app()->getLocale() == 'en' ? 'Permanently delete selected articles?' : 'Supprimer définitivement les articles sélectionnés ?' }}';
                break;
        }

        if (confirm(confirmMsg)) {
            // TODO: Implement bulk action AJAX call
            console.log(`Bulk ${action} for IDs:`, ids);
            alert('{{ app()->getLocale() == 'en' ? 'Action under development' : 'Action en cours de développement' }}');
        }
    }

    // Duplicate post
    function duplicatePost(postId) {
        if (confirm('{{ app()->getLocale() == 'en' ? 'Duplicate this article?' : 'Dupliquer cet article ?' }}')) {
            // TODO: Implement duplicate functionality
            window.location.href = '/admin/blog/' + postId + '/duplicate';
        }
    }

    // Chart for views
    @if(isset($viewsData))
    const ctx = document.getElementById('viewsChart');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($viewsData['labels'] ?? []) !!},
            datasets: [{
                label: "{{ app()->getLocale() == 'en' ? 'Views' : 'Vues' }}",
                data: {!! json_encode($viewsData['data'] ?? []) !!},
                borderColor: '#4B0082',
                backgroundColor: 'rgba(75, 0, 130, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    @endif

    // Auto-hide alerts after 5 seconds
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);
</script>
@endpush
