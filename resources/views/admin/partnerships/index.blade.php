@extends('layouts.admin')

@php
    $pageTitle = app()->getLocale() == 'en' ? 'Partnership Requests' : 'Demandes de Partenariat';
@endphp

@section('title', $pageTitle)

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col">
            <h1 class="h3 mb-0">{{ app()->getLocale() == 'en' ? 'Partnership Requests' : 'Demandes de Partenariat' }}</h1>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Filter tabs -->
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link {{ !$status ? 'active' : '' }}" href="{{ route('admin.partnerships.index') }}">
                {{ app()->getLocale() == 'en' ? 'All' : 'Tous' }} <span class="badge bg-secondary ms-1">{{ $counts['all'] }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $status == 'pending' ? 'active' : '' }}" href="{{ route('admin.partnerships.index', ['status' => 'pending']) }}">
                {{ app()->getLocale() == 'en' ? 'Pending' : 'En attente' }} <span class="badge bg-warning ms-1">{{ $counts['pending'] }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $status == 'reviewed' ? 'active' : '' }}" href="{{ route('admin.partnerships.index', ['status' => 'reviewed']) }}">
                {{ app()->getLocale() == 'en' ? 'Reviewed' : 'Examiné' }} <span class="badge bg-info ms-1">{{ $counts['reviewed'] }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $status == 'approved' ? 'active' : '' }}" href="{{ route('admin.partnerships.index', ['status' => 'approved']) }}">
                {{ app()->getLocale() == 'en' ? 'Approved' : 'Approuvé' }} <span class="badge bg-success ms-1">{{ $counts['approved'] }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $status == 'rejected' ? 'active' : '' }}" href="{{ route('admin.partnerships.index', ['status' => 'rejected']) }}">
                {{ app()->getLocale() == 'en' ? 'Rejected' : 'Rejeté' }} <span class="badge bg-danger ms-1">{{ $counts['rejected'] }}</span>
            </a>
        </li>
    </ul>

    <div class="card">
        <div class="card-body p-0">
            @if ($requests->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>{{ app()->getLocale() == 'en' ? 'Date' : 'Date' }}</th>
                                <th>{{ app()->getLocale() == 'en' ? 'Organization' : 'Organisation' }}</th>
                                <th>{{ app()->getLocale() == 'en' ? 'Sector' : 'Secteur' }}</th>
                                <th>{{ app()->getLocale() == 'en' ? 'Contact' : 'Contact' }}</th>
                                <th>{{ app()->getLocale() == 'en' ? 'Partnership Types' : 'Types de Partenariat' }}</th>
                                <th>{{ app()->getLocale() == 'en' ? 'Estimated Budget' : 'Budget Estimé' }}</th>
                                <th>{{ app()->getLocale() == 'en' ? 'Status' : 'Statut' }}</th>
                                <th>{{ app()->getLocale() == 'en' ? 'Actions' : 'Actions' }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requests as $request)
                                <tr>
                                    <td>
                                        <small class="text-muted">
                                            {{ $request->created_at->format('d/m/Y') }}<br>
                                            {{ $request->created_at->format('H:i') }}
                                        </small>
                                    </td>
                                    <td>
                                        <strong>{{ $request->organization_name }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark">{{ $request->sector }}</span>
                                    </td>
                                    <td>
                                        {{ $request->contact_name }}
                                        @if($request->contact_position)
                                            <br><small class="text-muted">{{ $request->contact_position }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        @foreach ($request->partnership_types as $type)
                                            <span class="badge bg-primary mb-1">
                                                @switch($type)
                                                    @case('financial') {{ app()->getLocale() == 'en' ? 'Financial' : 'Financier' }} @break
                                                    @case('technical') {{ app()->getLocale() == 'en' ? 'Technical' : 'Technique' }} @break
                                                    @case('volunteer') {{ app()->getLocale() == 'en' ? 'Volunteer' : 'Bénévolat' }} @break
                                                    @case('material') {{ app()->getLocale() == 'en' ? 'Material' : 'Matériel' }} @break
                                                    @case('advocacy') {{ app()->getLocale() == 'en' ? 'Advocacy' : 'Plaidoyer' }} @break
                                                    @case('other') {{ app()->getLocale() == 'en' ? 'Other' : 'Autre' }} @break
                                                @endswitch
                                            </span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @if($request->estimated_budget)
                                            {{ number_format($request->estimated_budget, 0, ',', ' ') }} XOF
                                        @else
                                            <span class="text-muted">{{ app()->getLocale() == 'en' ? 'Not specified' : 'Non spécifié' }}</span>
                                        @endif
                                    </td>
                                    <td>{!! $request->status_badge !!}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.partnerships.show', $request) }}"
                                               class="btn btn-outline-primary"
                                               title="{{ app()->getLocale() == 'en' ? 'View details' : 'Voir les détails' }}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <form action="{{ route('admin.partnerships.destroy', $request) }}"
                                                  method="POST"
                                                  onsubmit="return confirm(&quot;{{ app()->getLocale() == 'en' ? 'Are you sure you want to delete this request?' : 'Êtes-vous sûr de vouloir supprimer cette demande ?' }}&quot;);"
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" title="{{ app()->getLocale() == 'en' ? 'Delete' : 'Supprimer' }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="p-3">
                    {{ $requests->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-handshake fa-3x text-muted mb-3"></i>
                    <p class="text-muted">{{ app()->getLocale() == 'en' ? 'No partnership request found.' : 'Aucune demande de partenariat trouvée.' }}</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
