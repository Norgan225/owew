@extends('layouts.admin')

@php
    $pageTitle = app()->getLocale() == 'en' ? 'Partnership Request Details' : 'Détails de la Demande de Partenariat';
@endphp

@section('title', $pageTitle)

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.partnerships.index') }}">{{ app()->getLocale() == 'en' ? 'Partnership Requests' : 'Demandes de Partenariat' }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ app()->getLocale() == 'en' ? 'Details' : 'Détails' }}</li>
                </ol>
            </nav>
            <h1 class="h3 mb-0">{{ app()->getLocale() == 'en' ? 'Partnership Request Details' : 'Détails de la Demande de Partenariat' }}</h1>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <!-- Request Details Card -->
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">{{ app()->getLocale() == 'en' ? 'Request Information' : 'Informations de la Demande' }}</h5>
                        {!! $partnershipRequest->status_badge !!}
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>{{ app()->getLocale() == 'en' ? 'Organization:' : 'Organisation :' }}</strong>
                            <p class="mb-0">{{ $partnershipRequest->organization_name }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>{{ app()->getLocale() == 'en' ? 'Business Sector:' : 'Secteur d\'activité :' }}</strong>
                            <p class="mb-0">{{ $partnershipRequest->sector }}</p>
                        </div>
                    </div>

                    <hr>

                    <h6 class="mb-3">{{ app()->getLocale() == 'en' ? 'Contact Information' : 'Informations de Contact' }}</h6>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>{{ app()->getLocale() == 'en' ? 'Contact Name:' : 'Nom du contact :' }}</strong>
                            <p class="mb-0">{{ $partnershipRequest->contact_name }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>{{ app()->getLocale() == 'en' ? 'Position:' : 'Poste :' }}</strong>
                            <p class="mb-0">{{ $partnershipRequest->contact_position ?: (app()->getLocale() == 'en' ? 'Not specified' : 'Non spécifié') }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>{{ app()->getLocale() == 'en' ? 'Email:' : 'Email :' }}</strong>
                            <p class="mb-0">
                                <a href="mailto:{{ $partnershipRequest->email }}">{{ $partnershipRequest->email }}</a>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <strong>{{ app()->getLocale() == 'en' ? 'Phone:' : 'Téléphone :' }}</strong>
                            <p class="mb-0">
                                <a href="tel:{{ $partnershipRequest->phone }}">{{ $partnershipRequest->phone }}</a>
                            </p>
                        </div>
                    </div>

                    <hr>

                    <h6 class="mb-3">{{ app()->getLocale() == 'en' ? 'Partnership Details' : 'Détails du Partenariat' }}</h6>
                    <div class="mb-3">
                        <strong>{{ app()->getLocale() == 'en' ? 'Desired partnership types:' : 'Types de partenariat souhaités :' }}</strong>
                        <div class="mt-2">
                            @foreach ($partnershipRequest->partnership_types as $type)
                                <span class="badge bg-primary me-1 mb-1">
                                    @switch($type)
                                        @case('financial') <i class="fas fa-money-bill-wave"></i> {{ app()->getLocale() == 'en' ? 'Financial' : 'Financier' }} @break
                                        @case('technical') <i class="fas fa-tools"></i> {{ app()->getLocale() == 'en' ? 'Technical' : 'Technique' }} @break
                                        @case('volunteer') <i class="fas fa-users"></i> {{ app()->getLocale() == 'en' ? 'Volunteer' : 'Bénévolat' }} @break
                                        @case('material') <i class="fas fa-box"></i> {{ app()->getLocale() == 'en' ? 'Material' : 'Matériel' }} @break
                                        @case('advocacy') <i class="fas fa-bullhorn"></i> {{ app()->getLocale() == 'en' ? 'Advocacy' : 'Plaidoyer' }} @break
                                        @case('other') <i class="fas fa-ellipsis-h"></i> {{ app()->getLocale() == 'en' ? 'Other' : 'Autre' }} @break
                                    @endswitch
                                </span>
                            @endforeach
                        </div>
                    </div>

                    @if($partnershipRequest->estimated_budget)
                    <div class="mb-3">
                        <strong>{{ app()->getLocale() == 'en' ? 'Estimated budget:' : 'Budget estimé :' }}</strong>
                        <p class="mb-0 text-success">{{ number_format($partnershipRequest->estimated_budget, 0, ',', ' ') }} XOF</p>
                    </div>
                    @endif

                    <div class="mb-3">
                        <strong>{{ app()->getLocale() == 'en' ? 'Message:' : 'Message :' }}</strong>
                        <p class="mb-0 border-start border-3 border-primary ps-3 py-2 bg-light">
                            {{ $partnershipRequest->message }}
                        </p>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <small class="text-muted">
                                <i class="fas fa-clock"></i> {{ app()->getLocale() == 'en' ? 'Received on' : 'Reçu le' }} {{ $partnershipRequest->created_at->format('d/m/Y à H:i') }}
                            </small>
                        </div>
                        @if($partnershipRequest->reviewed_at)
                        <div class="col-md-6 text-end">
                            <small class="text-muted">
                                <i class="fas fa-check-circle"></i> {{ app()->getLocale() == 'en' ? 'Reviewed on' : 'Examiné le' }} {{ $partnershipRequest->reviewed_at->format('d/m/Y à H:i') }}
                            </small>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Admin Notes Card -->
            @if($partnershipRequest->admin_notes)
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">{{ app()->getLocale() == 'en' ? 'Administrative Notes' : 'Notes Administratives' }}</h5>
                </div>
                <div class="card-body">
                    <p class="mb-0">{{ $partnershipRequest->admin_notes }}</p>
                </div>
            </div>
            @endif
        </div>

        <div class="col-lg-4">
            <!-- Actions Card -->
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">{{ app()->getLocale() == 'en' ? 'Actions' : 'Actions' }}</h5>
                </div>
                <div class="card-body">
                    <!-- Contact Actions -->
                    <div class="d-grid gap-2 mb-3">
                        <a href="mailto:{{ $partnershipRequest->email }}" class="btn btn-outline-primary">
                            <i class="fas fa-envelope"></i> {{ app()->getLocale() == 'en' ? 'Send Email' : 'Envoyer un Email' }}
                        </a>
                        <a href="tel:{{ $partnershipRequest->phone }}" class="btn btn-outline-success">
                            <i class="fas fa-phone"></i> {{ app()->getLocale() == 'en' ? 'Call' : 'Appeler' }}
                        </a>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $partnershipRequest->phone) }}"
                           target="_blank"
                           class="btn btn-outline-success">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                    </div>

                    <hr>

                    <!-- Update Status Form -->
                    <form action="{{ route('admin.partnerships.update-status', $partnershipRequest) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="status" class="form-label">{{ app()->getLocale() == 'en' ? 'Change status' : 'Changer le statut' }}</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="pending" {{ $partnershipRequest->status == 'pending' ? 'selected' : '' }}>
                                    {{ app()->getLocale() == 'en' ? 'Pending' : 'En attente' }}
                                </option>
                                <option value="reviewed" {{ $partnershipRequest->status == 'reviewed' ? 'selected' : '' }}>
                                    {{ app()->getLocale() == 'en' ? 'Reviewed' : 'Examiné' }}
                                </option>
                                <option value="approved" {{ $partnershipRequest->status == 'approved' ? 'selected' : '' }}>
                                    {{ app()->getLocale() == 'en' ? 'Approved' : 'Approuvé' }}
                                </option>
                                <option value="rejected" {{ $partnershipRequest->status == 'rejected' ? 'selected' : '' }}>
                                    {{ app()->getLocale() == 'en' ? 'Rejected' : 'Rejeté' }}
                                </option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="admin_notes" class="form-label">{{ app()->getLocale() == 'en' ? 'Notes (optional)' : 'Notes (optionnel)' }}</label>
                            <textarea name="admin_notes"
                                      id="admin_notes"
                                      rows="4"
                                      class="form-control"
                                      placeholder="{{ app()->getLocale() == 'en' ? 'Add notes about this request...' : 'Ajouter des notes sur cette demande...' }}">{{ $partnershipRequest->admin_notes }}</textarea>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> {{ app()->getLocale() == 'en' ? 'Update' : 'Mettre à jour' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Delete Card -->
            <div class="card border-danger">
                <div class="card-header bg-danger text-white">
                    <h5 class="card-title mb-0">{{ app()->getLocale() == 'en' ? 'Danger Zone' : 'Zone Dangereuse' }}</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted small">
                        {{ app()->getLocale() == 'en' ? 'Deleting this request is irreversible.' : 'La suppression de cette demande est irréversible.' }}
                    </p>
                    <form action="{{ route('admin.partnerships.destroy', $partnershipRequest) }}"
                          method="POST"
                          onsubmit="return confirm(&quot;{{ app()->getLocale() == 'en' ? 'Are you sure you want to permanently delete this partnership request?' : 'Êtes-vous sûr de vouloir supprimer définitivement cette demande de partenariat ?' }}&quot;);">
                        @csrf
                        @method('DELETE')
                        <div class="d-grid">
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash"></i> {{ app()->getLocale() == 'en' ? 'Delete Request' : 'Supprimer la Demande' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
