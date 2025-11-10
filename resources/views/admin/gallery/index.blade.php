@extends('layouts.admin')

@php
    $pageTitle = app()->getLocale() == 'en' ? 'Gallery Management' : 'Gestion de la Galerie';
@endphp

@section('title', $pageTitle)

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">{{ app()->getLocale() == 'en' ? 'Gallery Management' : 'Gestion de la Galerie' }}</h2>
            <p class="text-muted mb-0">{{ $albums->total() }} {{ app()->getLocale() == 'en' ? 'project(s)/album(s) total' : 'projet(s)/album(s) au total' }}</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
                <i class="fas fa-filter me-2"></i>{{ app()->getLocale() == 'en' ? 'Filter' : 'Filtrer' }}
            </button>
            <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary-custom">
                <i class="fas fa-plus me-2"></i>{{ app()->getLocale() == 'en' ? 'Add Media' : 'Ajouter un Média' }}
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Total Projects/Albums' : 'Total Projets/Albums' }}</div>
                        <div class="stat-value">{{ $albums->total() }}</div>
                    </div>
                    <div class="stat-icon" style="background: #EDE9FE; color: var(--primary);">
                        <i class="fas fa-images"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Published' : 'Publiées' }}</div>
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
                        <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Featured' : 'En Vedette' }}</div>
                        <div class="stat-value text-warning">{{ $featuredCount ?? 0 }}</div>
                    </div>
                    <div class="stat-icon" style="background: #FEF3C7; color: #D97706;">
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Categories' : 'Catégories' }}</div>
                        <div class="stat-value text-primary">{{ $categoriesCount ?? 6 }}</div>
                    </div>
                    <div class="stat-icon" style="background: #DBEAFE; color: #2563EB;">
                        <i class="fas fa-folder"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="data-table mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div class="d-flex gap-2 flex-wrap">
                <select class="form-select" style="width: 200px;" id="categoryFilter">
                    <option value="">{{ app()->getLocale() == 'en' ? 'All categories' : 'Toutes catégories' }}</option>
                    @forelse($categories as $category)
                        <option value="{{ $category->slug }}">{{ localized_field($category, 'name') }}</option>
                    @empty
                        <option value="projets">{{ app()->getLocale() == 'en' ? 'Projects' : 'Projets' }}</option>
                        <option value="evenements">{{ app()->getLocale() == 'en' ? 'Events' : 'Événements' }}</option>
                        <option value="equipe">{{ app()->getLocale() == 'en' ? 'Team' : 'Équipe' }}</option>
                        <option value="beneficiaires">{{ app()->getLocale() == 'en' ? 'Beneficiaries' : 'Bénéficiaires' }}</option>
                        <option value="partenaires">{{ app()->getLocale() == 'en' ? 'Partners' : 'Partenaires' }}</option>
                        <option value="autres">{{ app()->getLocale() == 'en' ? 'Others' : 'Autres' }}</option>
                    @endforelse
                </select>
                <select class="form-select" style="width: 150px;" id="statusFilter">
                    <option value="">{{ app()->getLocale() == 'en' ? 'All statuses' : 'Tous les statuts' }}</option>
                    <option value="published">{{ app()->getLocale() == 'en' ? 'Published' : 'Publiées' }}</option>
                    <option value="unpublished">{{ app()->getLocale() == 'en' ? 'Unpublished' : 'Non publiées' }}</option>
                </select>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-secondary btn-sm" onclick="viewMode('grid')" id="gridViewBtn">
                    <i class="fas fa-th"></i>
                </button>
                <button class="btn btn-outline-secondary btn-sm" onclick="viewMode('list')" id="listViewBtn">
                    <i class="fas fa-list"></i>
                </button>
            </div>
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

    <!-- Gallery Grid View -->
    <div id="gridView">
        <div class="row g-3">
            @forelse($albums as $album)
            <div class="col-lg-3 col-md-4 col-sm-6 gallery-item"
                 data-category="{{ $album['category'] ?? '' }}"
                 data-status="{{ $album['is_published'] ? 'published' : 'unpublished' }}">
                <div class="stat-card h-100 position-relative" style="padding: 0; overflow: hidden;">
                    <!-- Carrousel d'images -->
                    <div class="position-relative" style="height: 200px; overflow: hidden;">
                        @if($album['count'] > 1)
                            <!-- Carrousel Bootstrap -->
                            <div id="carousel{{ $album['id'] }}" class="carousel slide" data-bs-ride="false">
                                <div class="carousel-inner">
                                    @foreach($album['items'] as $index => $item)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        @if($item->media_type === 'video')
                                            @php
                                                $thumbSrc = $item->thumbnail_path
                                                    ? asset('storage/' . $item->thumbnail_path)
                                                    : asset('images/video-placeholder.jpg');
                                            @endphp
                                            <img src="{{ $thumbSrc }}"
                                                 alt="Vidéo {{ $index + 1 }}"
                                                 class="w-100 h-100"
                                                 style="object-fit: cover;">
                                            <div class="position-absolute top-50 start-50 translate-middle">
                                                <i class="fas fa-play-circle text-white" style="font-size: 40px; opacity: 0.8;"></i>
                                            </div>
                                        @else
                                            <img src="{{ asset('storage/' . $item->image_path) }}"
                                                 alt="Image {{ $index + 1 }}"
                                                 class="w-100 h-100"
                                                 style="object-fit: cover;">
                                        @endif
                                    </div>
                                    @endforeach
                                </div>

                                <!-- Contrôles -->
                                <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{ $album['id'] }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carousel{{ $album['id'] }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                </button>

                                <!-- Indicateurs -->
                                <div class="carousel-indicators" style="margin-bottom: 5px;">
                                    @foreach($album['items'] as $index => $item)
                                    <button type="button" data-bs-target="#carousel{{ $album['id'] }}"
                                            data-bs-slide-to="{{ $index }}"
                                            class="{{ $index === 0 ? 'active' : '' }}"
                                            aria-label="Slide {{ $index + 1 }}"></button>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <!-- Image unique -->
                            @php
                                $singleItem = $album['items']->first();
                                $thumbSrc = $singleItem->media_type === 'video'
                                    ? ($singleItem->thumbnail_path ? asset('storage/' . $singleItem->thumbnail_path) : asset('images/video-placeholder.jpg'))
                                    : asset('storage/' . $singleItem->image_path);
                            @endphp
                            <img src="{{ $thumbSrc }}"
                                 alt="{{ $album['title_fr'] }}"
                                 class="w-100 h-100"
                                 style="object-fit: cover;">
                            @if($singleItem->media_type === 'video')
                                <div class="position-absolute top-50 start-50 translate-middle">
                                    <i class="fas fa-play-circle text-white" style="font-size: 40px; opacity: 0.8;"></i>
                                </div>
                            @endif
                        @endif

                        <!-- Badges -->
                        <div class="position-absolute top-0 start-0 p-2">
                            @if($album['count'] > 1)
                            <span class="badge bg-info text-white">
                                <i class="fas {{ $album['has_video'] ? 'fa-photo-video' : 'fa-images' }}"></i> {{ $album['count'] }}
                            </span>
                            @endif
                            @if($album['is_featured'])
                            <span class="badge bg-warning text-dark">
                                <i class="fas fa-star"></i> {{ app()->getLocale() == 'en' ? 'Featured' : 'Vedette' }}
                            </span>
                            @endif
                            @if(!$album['is_published'])
                            <span class="badge bg-secondary">{{ app()->getLocale() == 'en' ? 'Draft' : 'Brouillon' }}</span>
                            @endif
                        </div>

                        <!-- Actions Overlay -->
                        <div class="position-absolute bottom-0 start-0 end-0 p-2 bg-dark bg-opacity-75 gallery-actions"
                             style="opacity: 0; transition: opacity 0.3s;">
                            <div class="d-flex gap-1 justify-content-center">
                                <button class="btn btn-sm btn-light"
                                        onclick="viewAlbum({{ $album['id'] }}, '{{ $album['title_fr'] }}')"
                                        title="{{ app()->getLocale() == 'en' ? 'View album' : 'Voir l\'album' }}">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <a href="{{ route('admin.gallery.edit', $album['id']) }}"
                                   class="btn btn-sm btn-primary" title="{{ app()->getLocale() == 'en' ? 'Edit' : 'Modifier' }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-sm btn-danger"
                                        onclick="deleteAlbum({{ $album['id'] }}, '{{ $album['title_fr'] }}', {{ $album['count'] }})"
                                        title="{{ app()->getLocale() == 'en' ? 'Delete' : 'Supprimer' }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Info -->
                    <div class="p-3">
                        <h6 class="fw-semibold mb-1 text-truncate">
                            {{ $album['title_fr'] ?? 'Sans titre' }}
                        </h6>
                        @if($album['category'])
                        <small class="text-muted">
                            <i class="fas fa-folder me-1"></i>{{ ucfirst($album['category']) }}
                        </small>
                        @endif
                        <div class="mt-2">
                            <small class="text-muted">
                                <i class="far fa-calendar me-1"></i>{{ \Carbon\Carbon::parse($album['created_at'])->format('d/m/Y') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-images fa-3x text-muted mb-3 d-block"></i>
                    <p class="text-muted mb-3">{{ app()->getLocale() == 'en' ? 'No projects/albums in the gallery' : 'Aucun projet/album dans la galerie' }}</p>
                    <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary-custom">
                        <i class="fas fa-plus me-2"></i>{{ app()->getLocale() == 'en' ? 'Add the first media' : 'Ajouter le premier média' }}
                    </a>
                </div>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Pagination -->
    @if($albums->hasPages())
    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="text-muted">
            {{ app()->getLocale() == 'en' ? 'Showing' : 'Affichage de' }} {{ $albums->firstItem() }} {{ app()->getLocale() == 'en' ? 'to' : 'à' }} {{ $albums->lastItem() }} {{ app()->getLocale() == 'en' ? 'of' : 'sur' }} {{ $albums->total() }} {{ app()->getLocale() == 'en' ? 'project(s)/album(s)' : 'projet(s)/album(s)' }}
        </div>
        {{ $albums->links() }}
    </div>
    @endif
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
                        <label class="form-label">{{ app()->getLocale() == 'en' ? 'Category' : 'Catégorie' }}</label>
                        <select class="form-select">
                            <option value="">{{ app()->getLocale() == 'en' ? 'All' : 'Toutes' }}</option>
                            <option value="projets">{{ app()->getLocale() == 'en' ? 'Projects' : 'Projets' }}</option>
                            <option value="evenements">{{ app()->getLocale() == 'en' ? 'Events' : 'Événements' }}</option>
                            <option value="equipe">{{ app()->getLocale() == 'en' ? 'Team' : 'Équipe' }}</option>
                            <option value="beneficiaires">{{ app()->getLocale() == 'en' ? 'Beneficiaries' : 'Bénéficiaires' }}</option>
                            <option value="partenaires">{{ app()->getLocale() == 'en' ? 'Partners' : 'Partenaires' }}</option>
                            <option value="autres">{{ app()->getLocale() == 'en' ? 'Others' : 'Autres' }}</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ app()->getLocale() == 'en' ? 'Period' : 'Période' }}</label>
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
                            {{ app()->getLocale() == 'en' ? 'Featured images only' : 'Images en vedette uniquement' }}
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ app()->getLocale() == 'en' ? 'Cancel' : 'Annuler' }}</button>
                <button type="button" class="btn btn-primary-custom">{{ app()->getLocale() == 'en' ? 'Apply' : 'Appliquer' }}</button>
            </div>
        </div>
    </div>
</div>

<style>
    .stat-card:hover .gallery-actions {
        opacity: 1 !important;
    }

    .gallery-item img {
        transition: transform 0.3s ease;
    }

    .gallery-item:hover img {
        transform: scale(1.05);
    }
</style>
@endsection

@push('scripts')
<script>
    // Voir un album (modal avec toutes les images)
    function viewAlbum(albumId, title) {
        // Rediriger vers la page d'édition pour le moment
        window.location.href = `/admin/gallery/${albumId}/edit`;
    }

    // Supprimer un album (tous les médias du même titre)
    function deleteAlbum(albumId, title, count) {
        const message = count > 1
            ? `{{ app()->getLocale() == 'en' ? 'Delete the album' : 'Supprimer l\'album' }} "${title}" {{ app()->getLocale() == 'en' ? 'and its' : 'et ses' }} ${count} {{ app()->getLocale() == 'en' ? 'media?' : 'médias ?' }}`
            : `{{ app()->getLocale() == 'en' ? 'Delete' : 'Supprimer' }} "${title}" ?`;

        if (confirm(message)) {
            // Créer un formulaire pour soumettre la suppression
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/gallery/${albumId}`;

            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken;

            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';

            form.appendChild(csrfInput);
            form.appendChild(methodInput);
            document.body.appendChild(form);
            form.submit();
        }
    }

    // Category filter
    document.getElementById('categoryFilter').addEventListener('change', function() {
        const category = this.value;
        const items = document.querySelectorAll('.gallery-item');

        items.forEach(item => {
            if (!category || item.getAttribute('data-category') === category) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    });

    // Status filter
    document.getElementById('statusFilter').addEventListener('change', function() {
        const status = this.value;
        const items = document.querySelectorAll('.gallery-item');

        items.forEach(item => {
            if (!status || item.getAttribute('data-status') === status) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    });

    // View mode (Grid/List) - placeholder
    function viewMode(mode) {
        if (mode === 'grid') {
            document.getElementById('gridViewBtn').classList.add('active');
            document.getElementById('listViewBtn').classList.remove('active');
            // Grid view is default
        } else {
            document.getElementById('listViewBtn').classList.add('active');
            document.getElementById('gridViewBtn').classList.remove('active');
            alert('{{ app()->getLocale() == 'en' ? 'List view to be developed' : 'Vue liste à développer' }}');
        }
    }

    // Set grid view as default
    document.getElementById('gridViewBtn').classList.add('active');

    // Auto-hide alerts
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);
</script>
@endpush
