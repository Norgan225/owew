@extends('layouts.admin')

@php
    $pageTitle = app()->getLocale() == 'en' ? 'Volunteer Application' : 'Candidature Bénévole';
@endphp

@section('title', $pageTitle)

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.volunteers.index') }}">{{ app()->getLocale() == 'en' ? 'Volunteers' : 'Bénévoles' }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ app()->getLocale() == 'en' ? 'Details' : 'Détails' }}</li>
                </ol>
            </nav>
            <h1 class="h3 mb-0">{{ app()->getLocale() == 'en' ? 'Volunteer Application' : 'Candidature Bénévole' }}</h1>
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
            <!-- Volunteer Details Card -->
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">{{ app()->getLocale() == 'en' ? 'Candidate Information' : 'Informations du Candidat' }}</h5>
                        @if($volunteer->status == 'pending')
                            <span class="badge bg-warning">{{ app()->getLocale() == 'en' ? 'Pending' : 'En attente' }}</span>
                        @elseif($volunteer->status == 'approved')
                            <span class="badge bg-success">{{ app()->getLocale() == 'en' ? 'Approved' : 'Approuvé' }}</span>
                        @else
                            <span class="badge bg-danger">{{ app()->getLocale() == 'en' ? 'Rejected' : 'Rejeté' }}</span>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>{{ app()->getLocale() == 'en' ? 'Full Name:' : 'Nom complet :' }}</strong>
                            <p class="mb-0">{{ $volunteer->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>{{ app()->getLocale() == 'en' ? 'Application Date:' : 'Date de candidature :' }}</strong>
                            <p class="mb-0">{{ $volunteer->created_at->format('d/m/Y à H:i') }}</p>
                        </div>
                    </div>

                    <hr>

                    <h6 class="mb-3">{{ app()->getLocale() == 'en' ? 'Contact Information' : 'Informations de Contact' }}</h6>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>{{ app()->getLocale() == 'en' ? 'Email:' : 'Email :' }}</strong>
                            <p class="mb-0">
                                <a href="mailto:{{ $volunteer->email }}">{{ $volunteer->email }}</a>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <strong>{{ app()->getLocale() == 'en' ? 'Phone:' : 'Téléphone :' }}</strong>
                            <p class="mb-0">
                                <a href="tel:{{ $volunteer->phone }}">{{ $volunteer->phone }}</a>
                            </p>
                        </div>
                    </div>

                    <hr>

                    <h6 class="mb-3">{{ app()->getLocale() == 'en' ? 'Skills and Availability' : 'Compétences et Disponibilité' }}</h6>
                    @if($volunteer->skills)
                    <div class="mb-3">
                        <strong>{{ app()->getLocale() == 'en' ? 'Additional Information:' : 'Informations complémentaires :' }}</strong>
                        <div class="mt-2">
                            @foreach(explode(' | ', $volunteer->skills) as $info)
                                <div class="badge bg-light text-dark mb-1 me-1" style="font-size: 0.9em;">
                                    {{ $info }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if($volunteer->availability)
                    <div class="mb-3">
                        <strong>{{ app()->getLocale() == 'en' ? 'Availability:' : 'Disponibilité :' }}</strong>
                        <p class="mb-0">
                            @switch($volunteer->availability)
                                @case('weekend')
                                    <i class="fas fa-calendar-week text-primary"></i> {{ app()->getLocale() == 'en' ? 'Weekends only' : 'Week-ends uniquement' }}
                                    @break
                                @case('evenings')
                                    <i class="fas fa-moon text-info"></i> {{ app()->getLocale() == 'en' ? 'Week evenings' : 'Soirs de semaine' }}
                                    @break
                                @case('flexible')
                                    <i class="fas fa-clock text-success"></i> {{ app()->getLocale() == 'en' ? 'Flexible' : 'Flexible' }}
                                    @break
                                @default
                                    {{ ucfirst($volunteer->availability) }}
                            @endswitch
                        </p>
                    </div>
                    @endif

                    <hr>

                    <h6 class="mb-3">{{ app()->getLocale() == 'en' ? 'Motivation' : 'Motivation' }}</h6>
                    <div class="mb-3">
                        <p class="border-start border-3 border-primary ps-3 py-2 bg-light mb-0">
                            {{ localized_field($volunteer, 'motivation') }}
                        </p>
                    </div>
                </div>
            </div>
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
                        <a href="mailto:{{ $volunteer->email }}" class="btn btn-outline-primary">
                            <i class="fas fa-envelope"></i> {{ app()->getLocale() == 'en' ? 'Send Email' : 'Envoyer un Email' }}
                        </a>
                        <a href="tel:{{ $volunteer->phone }}" class="btn btn-outline-success">
                            <i class="fas fa-phone"></i> {{ app()->getLocale() == 'en' ? 'Call' : 'Appeler' }}
                        </a>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $volunteer->phone) }}"
                           target="_blank"
                           class="btn btn-outline-success">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                    </div>

                    <hr>

                    <!-- Status Actions -->
                    @if($volunteer->status == 'pending')
                        <h6 class="mb-3">{{ app()->getLocale() == 'en' ? 'Change Status' : 'Changer le Statut' }}</h6>
                        <div class="d-grid gap-2">
                            <form action="{{ route('admin.volunteers.approve', $volunteer) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="fas fa-check"></i> {{ app()->getLocale() == 'en' ? 'Approve' : 'Approuver' }}
                                </button>
                            </form>
                            <form action="{{ route('admin.volunteers.reject', $volunteer) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-warning w-100">
                                    <i class="fas fa-times"></i> {{ app()->getLocale() == 'en' ? 'Reject' : 'Rejeter' }}
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="alert alert-info mb-0">
                            <i class="fas fa-info-circle"></i>
                            {{ app()->getLocale() == 'en' ? 'This application has already been' : 'Cette candidature a déjà été' }}
                            @if($volunteer->status == 'approved')
                                <strong>{{ app()->getLocale() == 'en' ? 'approved' : 'approuvée' }}</strong>.
                            @else
                                <strong>{{ app()->getLocale() == 'en' ? 'rejected' : 'rejetée' }}</strong>.
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <!-- Delete Card -->
            <div class="card border-danger">
                <div class="card-header bg-danger text-white">
                    <h5 class="card-title mb-0">{{ app()->getLocale() == 'en' ? 'Danger Zone' : 'Zone Dangereuse' }}</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted small">
                        {{ app()->getLocale() == 'en' ? 'Deleting this application is irreversible.' : 'La suppression de cette candidature est irréversible.' }}
                    </p>
                    <form action="{{ route('admin.volunteers.destroy', $volunteer) }}"
                          method="POST"
                          onsubmit="return confirm(&quot;{{ app()->getLocale() == 'en' ? 'Are you sure you want to permanently delete this application?' : 'Êtes-vous sûr de vouloir supprimer définitivement cette candidature ?' }}&quot;);">
                        @csrf
                        @method('DELETE')
                        <div class="d-grid">
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash"></i> {{ app()->getLocale() == 'en' ? 'Delete' : 'Supprimer' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
