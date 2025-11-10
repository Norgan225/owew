@extends('layouts.admin')

@php
    $pageTitle = app()->getLocale() == 'en' ? 'Donations Management' : 'Gestion des Dons';
@endphp

@section('title', $pageTitle)

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">{{ app()->getLocale() == 'en' ? 'Donations Management' : 'Gestion des Dons' }}</h2>
            <p class="text-muted mb-0">{{ $donations->total() }} {{ app()->getLocale() == 'en' ? 'donation(s) total' : 'don(s) au total' }}</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
                <i class="fas fa-filter me-2"></i>{{ app()->getLocale() == 'en' ? 'Filter' : 'Filtrer' }}
            </button>
            <button class="btn btn-outline-success" onclick="exportDonations()">
                <i class="fas fa-file-export me-2"></i>{{ app()->getLocale() == 'en' ? 'Export' : 'Exporter' }}
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Total Donations' : 'Total Dons' }}</div>
                        <div class="stat-value">{{ $donations->total() }}</div>
                    </div>
                    <div class="stat-icon" style="background: #EDE9FE;">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Total Amount' : 'Montant Total' }}</div>
                        <div class="stat-value text-success" style="font-size: 1.5rem;">
                            {{ number_format($totalAmount ?? 0, 0, ',', ' ') }} FCFA
                        </div>
                    </div>
                    <div class="stat-icon" style="background: #D1FAE5;">
                        <i class="fas fa-coins"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">{{ app()->getLocale() == 'en' ? 'This Month' : 'Ce Mois' }}</div>
                        <div class="stat-value text-primary">{{ $monthlyCount ?? 0 }}</div>
                    </div>
                    <div class="stat-icon" style="background: #DBEAFE;">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Average Donation' : 'Don Moyen' }}</div>
                        <div class="stat-value text-warning" style="font-size: 1.3rem;">
                            {{ number_format($averageDonation ?? 0, 0, ',', ' ') }} FCFA
                        </div>
                    </div>
                    <div class="stat-icon" style="background: #FEF3C7;">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="data-table">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold mb-0">{{ app()->getLocale() == 'en' ? 'Donations List' : 'Liste des Dons' }}</h5>
            <div class="d-flex gap-2">
                <div class="position-relative" style="width: 300px;">
                    <i class="fas fa-search position-absolute" style="left: 12px; top: 50%; transform: translateY(-50%); color: #9CA3AF;"></i>
                    <input type="text" class="form-control ps-5" placeholder="{{ app()->getLocale() == 'en' ? 'Search a donation...' : 'Rechercher un don...' }}" id="searchInput">
                </div>
                <select class="form-select" style="width: 150px;" id="statusFilter">
                    <option value="">{{ app()->getLocale() == 'en' ? 'All statuses' : 'Tous les statuts' }}</option>
                    <option value="received">{{ app()->getLocale() == 'en' ? 'Sent' : 'Envoyé' }}</option>
                    <option value="pending">{{ app()->getLocale() == 'en' ? 'Pending' : 'En attente' }}</option>
                    <option value="failed">{{ app()->getLocale() == 'en' ? 'Failed' : 'Échoué' }}</option>
                </select>
            </div>
        </div>

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

        <div class="table-responsive">
            <table class="table" id="donationsTable">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAll"></th>
                        <th>{{ app()->getLocale() == 'en' ? 'Donor' : 'Donateur' }}</th>
                        <th>{{ app()->getLocale() == 'en' ? 'Project' : 'Projet' }}</th>
                        <th>{{ app()->getLocale() == 'en' ? 'Amount' : 'Montant' }}</th>
                        <th>{{ app()->getLocale() == 'en' ? 'Status' : 'Statut' }}</th>
                        <th>{{ app()->getLocale() == 'en' ? 'Date' : 'Date' }}</th>
                        <th class="text-end">{{ app()->getLocale() == 'en' ? 'Actions' : 'Actions' }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($donations as $donation)
                    <tr>
                        <td><input type="checkbox" class="row-checkbox" value="{{ $donation->id }}"></td>
                        <td>
                            <div class="fw-semibold">{{ $donation->donor_name }}</div>
                            <small class="text-muted">{{ $donation->donor_email }}</small>
                            @if($donation->donor_phone)
                            <br><small class="text-muted">{{ $donation->donor_phone }}</small>
                            @endif
                        </td>
                        <td>
                            {{ $donation->project ? $donation->project->title : 'Don général' }}
                        </td>
                        <td>
                            <strong class="text-success">{{ number_format($donation->amount, 0, ',', ' ') }} FCFA</strong>
                        </td>
                        <td>
                            @if($donation->status === 'received')
                                <span class="status-badge success" data-status="received"><i class="fas fa-check-circle"></i> {{ app()->getLocale() == 'en' ? 'Sent' : 'Envoyé' }}</span>
                            @elseif($donation->status === 'pending')
                                <span class="status-badge warning" data-status="pending"><i class="fas fa-clock"></i> {{ app()->getLocale() == 'en' ? 'Pending' : 'En attente' }}</span>
                            @elseif($donation->status === 'failed')
                                <span class="status-badge danger" data-status="failed"><i class="fas fa-times-circle"></i> {{ app()->getLocale() == 'en' ? 'Failed' : 'Échoué' }}</span>
                            @else
                                <span class="status-badge secondary" data-status="{{ $donation->status }}"><i class="fas fa-question-circle"></i> {{ app()->getLocale() == 'en' ? 'Unknown' : 'Inconnu' }}</span>
                            @endif
                        </td>
                        <td>
                            <small class="text-muted d-block">{{ $donation->created_at->format('d/m/Y') }}</small>
                            <small class="text-muted">{{ $donation->created_at->format('H:i') }}</small>
                        </td>
                        <td class="text-end">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#viewDonationModal{{ $donation->id }}">
                                            <i class="fas fa-eye me-2"></i>{{ app()->getLocale() == 'en' ? 'View details' : 'Voir détails' }}
                                        </a>
                                    </li>
                                    @if($donation->status === 'pending')
                                    <li>
                                        <form action="{{ route('admin.donations.update-status', $donation) }}"
                                              method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="completed">
                                            <button type="submit" class="dropdown-item text-success">
                                                <i class="fas fa-check me-2"></i>{{ app()->getLocale() == 'en' ? 'Mark as completed' : 'Marquer comme complété' }}
                                            </button>
                                        </form>
                                    </li>
                                    @endif
                                    <li>
                                        <form action="{{ route('admin.donations.destroy', $donation) }}"
                                              method="POST"
                                              onsubmit="return confirm(&quot;{{ app()->getLocale() == 'en' ? 'Are you sure you want to delete this donation?' : 'Êtes-vous sûr de vouloir supprimer ce don ?' }}&quot;);">
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

                    <!-- View Donation Modal -->
                    <div class="modal fade" id="viewDonationModal{{ $donation->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{ app()->getLocale() == 'en' ? 'Donation Details' : 'Détails du Don' }} #{{ $donation->id }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <strong>{{ app()->getLocale() == 'en' ? 'Donor:' : 'Donateur:' }}</strong><br>
                                        {{ $donation->donor_name }}<br>
                                        <small class="text-muted">{{ $donation->donor_email }}</small>
                                        @if($donation->donor_phone)
                                        <br><small class="text-muted">{{ $donation->donor_phone }}</small>
                                        @endif
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <strong>{{ app()->getLocale() == 'en' ? 'Project:' : 'Projet:' }}</strong><br>
                                        {{ $donation->project ? $donation->project->title : (app()->getLocale() == 'en' ? 'General donation' : 'Don général') }}
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <strong>{{ app()->getLocale() == 'en' ? 'Amount:' : 'Montant:' }}</strong><br>
                                        <span class="text-success fw-bold" style="font-size: 1.5rem;">
                                            {{ number_format($donation->amount, 0, ',', ' ') }} FCFA
                                        </span>
                                    </div>
                                    @if($donation->message)
                                    <hr>
                                    <div class="mb-3">
                                        <strong>{{ app()->getLocale() == 'en' ? 'Message:' : 'Message:' }}</strong><br>
                                        <em>{{ $donation->message }}</em>
                                    </div>
                                    @endif
                                    <hr>
                                    <div class="mb-3">
                                        <strong>{{ app()->getLocale() == 'en' ? 'Status:' : 'Statut:' }}</strong><br>
                                        @if($donation->status === 'completed')
                                            <span class="status-badge success">{{ app()->getLocale() == 'en' ? 'Completed' : 'Complété' }}</span>
                                        @elseif($donation->status === 'pending')
                                            <span class="status-badge warning">{{ app()->getLocale() == 'en' ? 'Pending' : 'En attente' }}</span>
                                        @else
                                            <span class="status-badge danger">{{ app()->getLocale() == 'en' ? 'Failed' : 'Échoué' }}</span>
                                        @endif
                                    </div>
                                    <hr>
                                    <div>
                                        <strong>{{ app()->getLocale() == 'en' ? 'Date:' : 'Date:' }}</strong><br>
                                        {{ $donation->created_at->format('d/m/Y à H:i') }}
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
                            <i class="fas fa-hand-holding-usd fa-3x text-muted mb-3 d-block"></i>
                            <p class="text-muted mb-0">{{ app()->getLocale() == 'en' ? 'No donations found' : 'Aucun don trouvé' }}</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($donations->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="text-muted">
                {{ app()->getLocale() == 'en' ? 'Showing' : 'Affichage de' }} {{ $donations->firstItem() }} {{ app()->getLocale() == 'en' ? 'to' : 'à' }} {{ $donations->lastItem() }} {{ app()->getLocale() == 'en' ? 'of' : 'sur' }} {{ $donations->total() }} {{ app()->getLocale() == 'en' ? 'donations' : 'dons' }}
            </div>
            {{ $donations->links() }}
        </div>
        @endif

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
                            <option value="completed">{{ app()->getLocale() == 'en' ? 'Completed' : 'Complété' }}</option>
                            <option value="pending">{{ app()->getLocale() == 'en' ? 'Pending' : 'En attente' }}</option>
                            <option value="failed">{{ app()->getLocale() == 'en' ? 'Failed' : 'Échoué' }}</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ app()->getLocale() == 'en' ? 'Amount' : 'Montant' }}</label>
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
                    <div class="mb-3">
                        <label class="form-label">{{ app()->getLocale() == 'en' ? 'Project' : 'Projet' }}</label>
                        <select class="form-select">
                            <option value="">{{ app()->getLocale() == 'en' ? 'All projects' : 'Tous les projets' }}</option>
                            @if(isset($projects))
                                @foreach($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->title }}</option>
                                @endforeach
                            @endif
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
@endsection

@push('scripts')
<script>
    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('#donationsTable tbody tr');
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });

    // Status filter
    document.getElementById('statusFilter').addEventListener('change', function() {
        const status = this.value.toLowerCase();
        const rows = document.querySelectorAll('#donationsTable tbody tr');
        rows.forEach(row => {
            if (!status) {
                row.style.display = '';
                return;
            }
            const statusBadge = row.querySelector('.status-badge');
            if (statusBadge && statusBadge.getAttribute('data-status') === status) {
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

    document.querySelectorAll('.row-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', toggleBulkActions);
    });

    function toggleBulkActions() {
        const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');
        const bulkActions = document.getElementById('bulkActions');
        bulkActions.style.display = checkedBoxes.length > 0 ? 'flex' : 'none';
    }

    function bulkAction(action) {
        const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');
        const ids = Array.from(checkedBoxes).map(cb => cb.value);
        if (ids.length === 0) {
            alert("{{ app()->getLocale() == 'en' ? 'Please select at least one donation' : 'Veuillez sélectionner au moins un don' }}");
            return;
        }
        let confirmMsg = '';
        switch(action) {
            case 'complete':
                confirmMsg = '{{ app()->getLocale() == 'en' ? 'Are you sure you want to mark these donations as completed?' : 'Êtes-vous sûr de vouloir marquer ces dons comme complétés ?' }}'; break;
            case 'export':
                confirmMsg = '{{ app()->getLocale() == 'en' ? 'Export selected donations?' : 'Exporter les dons sélectionnés ?' }}'; break;
            case 'delete':
                confirmMsg = '{{ app()->getLocale() == 'en' ? 'Are you sure you want to delete these donations?' : 'Êtes-vous sûr de vouloir supprimer ces dons ?' }}'; break;
        }
        if (confirm(confirmMsg)) {
            console.log(`Bulk ${action} for IDs:`, ids);
            alert('{{ app()->getLocale() == 'en' ? 'Action under development' : 'Action en cours de développement' }}');
        }
    }

    function exportDonations() {
        if (confirm('{{ app()->getLocale() == 'en' ? 'Export all donations to CSV?' : 'Exporter tous les dons en CSV ?' }}')) {
            window.location.href = '/admin/donations/export';
        }
    }

    function generateReceipt(donationId) {
        window.open('/admin/donations/' + donationId + '/receipt', '_blank');
    }

    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);
</script>
@endpush
