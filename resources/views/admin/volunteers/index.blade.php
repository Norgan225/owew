@extends('layouts.admin')

@php
    $pageTitle = app()->getLocale() == 'en' ? 'Volunteer Management' : 'Gestion des bénévoles';
@endphp

@section('title', $pageTitle)

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">{{ app()->getLocale() == 'en' ? 'Volunteer Management' : 'Gestion des bénévoles' }}</h2>
            <p class="text-muted mb-0">{{ $volunteers->total() }} {{ app()->getLocale() == 'en' ? 'application(s)' : 'candidature(s)' }}</p>
        </div>
        <div class="d-flex gap-2">
            <form method="GET" class="d-flex gap-2">
                <select name="status" class="form-select" style="width: 180px;" onchange="this.form.submit()">
                    <option value="">{{ app()->getLocale() == 'en' ? 'All statuses' : 'Tous les statuts' }}</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Pending' : 'En attente' }}</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Approved' : 'Approuvé' }}</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Rejected' : 'Rejeté' }}</option>
                </select>
            </form>
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
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>{{ app()->getLocale() == 'en' ? 'Name' : 'Nom' }}</th>
                    <th>{{ app()->getLocale() == 'en' ? 'Email' : 'Email' }}</th>
                    <th>{{ app()->getLocale() == 'en' ? 'Phone' : 'Téléphone' }}</th>
                    <th>{{ app()->getLocale() == 'en' ? 'Skills' : 'Compétences' }}</th>
                    <th>{{ app()->getLocale() == 'en' ? 'Availability' : 'Disponibilité' }}</th>
                    <th>{{ app()->getLocale() == 'en' ? 'Motivation' : 'Motivation' }}</th>
                    <th>{{ app()->getLocale() == 'en' ? 'Status' : 'Statut' }}</th>
                    <th class="text-end">{{ app()->getLocale() == 'en' ? 'Actions' : 'Actions' }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($volunteers as $v)
                <tr>
                    <td><strong>{{ $v->name }}</strong></td>
                    <td>
                        <a href="mailto:{{ $v->email }}" class="text-primary">{{ $v->email }}</a>
                    </td>
                    <td>{{ $v->phone ?? '-' }}</td>
                    <td>{{ $v->skills ?? '-' }}</td>
                    <td>{{ $v->availability ?? '-' }}</td>
                    <td>
                        <span title="{{ $v->motivation_fr }}">{{ Str::limit($v->motivation_fr, 40) }}</span>
                    </td>
                    <td>
                        @if($v->status === 'pending')
                            <span class="badge bg-warning text-dark"><i class="fas fa-hourglass-half"></i> {{ app()->getLocale() == 'en' ? 'Pending' : 'En attente' }}</span>
                        @elseif($v->status === 'approved')
                            <span class="badge bg-success"><i class="fas fa-check"></i> {{ app()->getLocale() == 'en' ? 'Approved' : 'Approuvé' }}</span>
                        @else
                            <span class="badge bg-danger"><i class="fas fa-times"></i> {{ app()->getLocale() == 'en' ? 'Rejected' : 'Rejeté' }}</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <a href="{{ route('admin.volunteers.show', $v) }}" class="btn btn-sm btn-outline-primary me-1" title="{{ app()->getLocale() == 'en' ? 'View' : 'Afficher' }}">
                            <i class="fas fa-eye"></i>
                        </a>
                        @if($v->status === 'pending')
                        <form action="{{ route('admin.volunteers.approve', $v) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-outline-success me-1" title="{{ app()->getLocale() == 'en' ? 'Approve' : 'Approuver' }}">
                                <i class="fas fa-check"></i>
                            </button>
                        </form>
                        <form action="{{ route('admin.volunteers.reject', $v) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-outline-danger me-1" title="{{ app()->getLocale() == 'en' ? 'Reject' : 'Rejeter' }}">
                                <i class="fas fa-times"></i>
                            </button>
                        </form>
                        @endif
                        <form action="{{ route('admin.volunteers.destroy', $v) }}" method="POST" style="display:inline;" onsubmit="return confirm(&quot;{{ app()->getLocale() == 'en' ? 'Delete this application?' : 'Supprimer cette candidature ?' }}&quot;);">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-dark" title="{{ app()->getLocale() == 'en' ? 'Delete' : 'Supprimer' }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-5">
                        <i class="fas fa-users fa-3x text-muted mb-3 d-block"></i>
                        <p class="text-muted mb-3">{{ app()->getLocale() == 'en' ? 'No applications received' : 'Aucune candidature reçue' }}</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($volunteers->hasPages())
    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="text-muted">
            {{ app()->getLocale() == 'en' ? 'Showing' : 'Affichage de' }} {{ $volunteers->firstItem() }} {{ app()->getLocale() == 'en' ? 'to' : 'à' }} {{ $volunteers->lastItem() }} {{ app()->getLocale() == 'en' ? 'of' : 'sur' }} {{ $volunteers->total() }} {{ app()->getLocale() == 'en' ? 'applications' : 'candidatures' }}
        </div>
        {{ $volunteers->links() }}
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    // Auto-hide alerts after 5 seconds
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);
</script>
@endpush
