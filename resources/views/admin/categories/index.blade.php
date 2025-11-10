@extends('layouts.admin')

@php
    $pageTitle = app()->getLocale() == 'en' ? 'Categories Management' : 'Gestion des Catégories';
@endphp

@section('title', $pageTitle)

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">{{ app()->getLocale() == 'en' ? 'Categories Management' : 'Gestion des Catégories' }}</h2>
            <p class="text-muted mb-0">{{ $categories->total() }} {{ app()->getLocale() == 'en' ? 'category(ies) total' : 'catégorie(s) au total' }}</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary-custom">
            <i class="fas fa-plus me-2"></i>{{ app()->getLocale() == 'en' ? 'New Category' : 'Nouvelle Catégorie' }}
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Categories Table -->
    <div class="data-table">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>{{ app()->getLocale() == 'en' ? 'Name (FR)' : 'Nom (FR)' }}</th>
                        <th>{{ app()->getLocale() == 'en' ? 'Name (EN)' : 'Nom (EN)' }}</th>
                        <th>{{ app()->getLocale() == 'en' ? 'Slug' : 'Slug' }}</th>
                        <th>{{ app()->getLocale() == 'en' ? 'Articles' : 'Articles' }}</th>
                        <th>{{ app()->getLocale() == 'en' ? 'Creation Date' : 'Date de création' }}</th>
                        <th class="text-end">{{ app()->getLocale() == 'en' ? 'Actions' : 'Actions' }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td>
                            <div class="fw-semibold">{{ localized_field($category, 'name') }}</div>
                            @if(localized_field($category, 'description'))
                                <small class="text-muted">{{ Str::limit(localized_field($category, 'description'), 50) }}</small>
                            @endif
                        </td>
                        <td>{{ $category->name_en }}</td>
                        <td>
                            <code class="text-primary">{{ $category->slug }}</code>
                        </td>
                        <td>
                            <span class="badge bg-primary">{{ $category->blogPosts->count() }} {{ app()->getLocale() == 'en' ? 'article(s)' : 'article(s)' }}</span>
                        </td>
                        <td>
                            <small class="text-muted">{{ $category->created_at->format('d/m/Y') }}</small>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('admin.categories.edit', $category) }}"
                                   class="btn btn-outline-primary"
                                   title="{{ app()->getLocale() == 'en' ? 'Edit' : 'Modifier' }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.categories.destroy', $category) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm(&quot;{{ app()->getLocale() == 'en' ? 'Are you sure you want to delete this category?' : 'Êtes-vous sûr de vouloir supprimer cette catégorie ?' }}&quot;);">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-outline-danger"
                                            title="{{ app()->getLocale() == 'en' ? 'Delete' : 'Supprimer' }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <i class="fas fa-folder-open fa-3x text-muted mb-3 d-block"></i>
                            <p class="text-muted mb-3">{{ app()->getLocale() == 'en' ? 'No categories available' : 'Aucune catégorie disponible' }}</p>
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary-custom">
                                <i class="fas fa-plus me-2"></i>{{ app()->getLocale() == 'en' ? 'Create a category' : 'Créer une catégorie' }}
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($categories->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="text-muted">
                {{ app()->getLocale() == 'en' ? 'Showing' : 'Affichage de' }} {{ $categories->firstItem() }} {{ app()->getLocale() == 'en' ? 'to' : 'à' }} {{ $categories->lastItem() }} {{ app()->getLocale() == 'en' ? 'of' : 'sur' }} {{ $categories->total() }} {{ app()->getLocale() == 'en' ? 'categories' : 'catégories' }}
            </div>
            {{ $categories->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
