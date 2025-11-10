@extends('layouts.admin')

@php
    $pageTitle = app()->getLocale() == 'en' ? 'Newsletter Subscribers Management' : 'Gestion des Abonnés Newsletter';
@endphp

@section('title', $pageTitle)

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">{{ app()->getLocale() == 'en' ? 'Newsletter Subscribers Management' : 'Gestion des Abonnés Newsletter' }}</h2>
            <p class="text-muted mb-0">{{ $subscribers->total() }} {{ app()->getLocale() == 'en' ? 'subscriber(s) total' : 'abonné(s) au total' }}</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-success" onclick="exportSubscribers()">
                <i class="fas fa-file-export me-2"></i>{{ app()->getLocale() == 'en' ? 'Export' : 'Exporter' }}
            </button>
            <button class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#sendNewsletterModal">
                <i class="fas fa-paper-plane me-2"></i>{{ app()->getLocale() == 'en' ? 'Send Newsletter' : 'Envoyer Newsletter' }}
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon bg-primary-custom text-white">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="card-title mb-1">{{ app()->getLocale() == 'en' ? 'Total Subscribers' : 'Total Abonnés' }}</h6>
                            <h3 class="mb-0">{{ $totalSubscribers }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon bg-success text-white">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="card-title mb-1">{{ app()->getLocale() == 'en' ? 'Active' : 'Actifs' }}</h6>
                            <h3 class="mb-0">{{ $activeCount }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon bg-danger text-white">
                            <i class="fas fa-user-times"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="card-title mb-1">{{ app()->getLocale() == 'en' ? 'Unsubscribed' : 'Désabonnés' }}</h6>
                            <h3 class="mb-0">{{ $unsubscribedCount }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon bg-info text-white">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="card-title mb-1">{{ app()->getLocale() == 'en' ? 'This Month' : 'Ce Mois' }}</h6>
                            <h3 class="mb-0">{{ $monthlyCount }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    <!-- Table -->
    <div class="data-table">
        <!-- Table Header with Search -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold mb-0">{{ app()->getLocale() == 'en' ? 'Subscribers List' : 'Liste des Abonnés' }}</h5>
            <div class="d-flex gap-2">
                <div class="position-relative" style="width: 300px;">
                    <i class="fas fa-search position-absolute" style="left: 12px; top: 50%; transform: translateY(-50%); color: #9CA3AF;"></i>
                    <input type="text" class="form-control ps-5" placeholder="{{ app()->getLocale() == 'en' ? 'Search an email...' : 'Rechercher un email...' }}" id="searchInput">
                </div>
                <select class="form-select" style="width: 150px;" id="statusFilter">
                    <option value="">{{ app()->getLocale() == 'en' ? 'All statuses' : 'Tous les statuts' }}</option>
                    <option value="active">{{ app()->getLocale() == 'en' ? 'Active' : 'Actifs' }}</option>
                    <option value="unsubscribed">{{ app()->getLocale() == 'en' ? 'Unsubscribed' : 'Désabonnés' }}</option>
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
            <table class="table" id="subscribersTable">
                <thead>
                    <tr>
                        <th style="width: 5%;">
                            <input type="checkbox" id="selectAll">
                        </th>
                        <th style="width: 40%;">{{ app()->getLocale() == 'en' ? 'Email' : 'Email' }}</th>
                        <th style="width: 15%;">{{ app()->getLocale() == 'en' ? 'Status' : 'Statut' }}</th>
                        <th style="width: 20%;">{{ app()->getLocale() == 'en' ? 'Subscription Date' : 'Date d\'inscription' }}</th>
                        <th style="width: 20%;">{{ app()->getLocale() == 'en' ? 'Unsubscription Date' : 'Date de désabonnement' }}</th>
                        <th style="width: 10%;" class="text-end">{{ app()->getLocale() == 'en' ? 'Actions' : 'Actions' }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subscribers as $subscriber)
                    <tr data-status="{{ $subscriber->status }}">
                        <td>
                            <input type="checkbox" class="row-checkbox" value="{{ $subscriber->id }}"
                                   {{ $subscriber->status === 'unsubscribed' ? 'disabled' : '' }}>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-envelope text-primary"></i>
                                <strong>{{ $subscriber->email }}</strong>
                            </div>
                        </td>
                        <td>
                            @if($subscriber->status === 'active')
                                <span class="status-badge success">
                                    <i class="fas fa-check-circle"></i> {{ app()->getLocale() == 'en' ? 'Active' : 'Actif' }}
                                </span>
                            @else
                                <span class="status-badge danger">
                                    <i class="fas fa-ban"></i> {{ app()->getLocale() == 'en' ? 'Unsubscribed' : 'Désabonné' }}
                                </span>
                            @endif
                        </td>
                        <td>
                            <small class="text-muted d-block">{{ $subscriber->subscribed_at->format('d/m/Y') }}</small>
                            <small class="text-muted">{{ $subscriber->subscribed_at->format('H:i') }}</small>
                        </td>
                        <td>
                            @if($subscriber->unsubscribed_at)
                                <small class="text-muted d-block">{{ $subscriber->unsubscribed_at->format('d/m/Y') }}</small>
                                <small class="text-muted">{{ $subscriber->unsubscribed_at->format('H:i') }}</small>
                            @else
                                <small class="text-muted">-</small>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    @if($subscriber->status === 'unsubscribed')
                                    <li>
                                        <form action="{{ route('admin.subscribers.resubscribe', $subscriber) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="dropdown-item text-success">
                                                <i class="fas fa-redo me-2"></i>{{ app()->getLocale() == 'en' ? 'Resubscribe' : 'Réabonner' }}
                                            </button>
                                        </form>
                                    </li>
                                    @else
                                    <li>
                                        <form action="{{ route('admin.subscribers.unsubscribe', $subscriber) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="dropdown-item text-warning">
                                                <i class="fas fa-ban me-2"></i>{{ app()->getLocale() == 'en' ? 'Unsubscribe' : 'Désabonner' }}
                                            </button>
                                        </form>
                                    </li>
                                    @endif
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('admin.subscribers.destroy', $subscriber) }}"
                                              method="POST"
                                              onsubmit="return confirm(&quot;{{ app()->getLocale() == 'en' ? 'Are you sure you want to delete this subscriber?' : 'Êtes-vous sûr de vouloir supprimer cet abonné ?' }}&quot;);">
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
                        <td colspan="6" class="text-center py-5">
                            <i class="fas fa-envelope-open fa-3x text-muted mb-3 d-block"></i>
                            <p class="text-muted mb-0">{{ app()->getLocale() == 'en' ? 'No subscribers found' : 'Aucun abonné trouvé' }}</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($subscribers->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="text-muted">
                {{ app()->getLocale() == 'en' ? 'Showing' : 'Affichage de' }} {{ $subscribers->firstItem() }} {{ app()->getLocale() == 'en' ? 'to' : 'à' }} {{ $subscribers->lastItem() }} {{ app()->getLocale() == 'en' ? 'of' : 'sur' }} {{ $subscribers->total() }} {{ app()->getLocale() == 'en' ? 'subscribers' : 'abonnés' }}
            </div>
            {{ $subscribers->links() }}
        </div>
        @endif

        <!-- Bulk Actions -->
        <div class="d-flex gap-2 mt-3" id="bulkActions" style="display: none !important;">
            <button class="btn btn-sm btn-outline-primary" onclick="bulkAction('send-email')">
                <i class="fas fa-paper-plane me-1"></i>{{ app()->getLocale() == 'en' ? 'Send email' : 'Envoyer email' }}
            </button>
            <button class="btn btn-sm btn-outline-success" onclick="bulkAction('export')">
                <i class="fas fa-file-export me-1"></i>{{ app()->getLocale() == 'en' ? 'Export selection' : 'Exporter sélection' }}
            </button>
            <button class="btn btn-sm btn-outline-danger" onclick="bulkAction('delete')">
                <i class="fas fa-trash me-1"></i>{{ app()->getLocale() == 'en' ? 'Delete' : 'Supprimer' }}
            </button>
        </div>
    </div>

    <!-- Chart -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="chart-card">
                <h5 class="fw-bold mb-3">{{ app()->getLocale() == 'en' ? 'Subscription Evolution (Last 12 Months)' : 'Évolution des abonnements (12 derniers mois)' }}</h5>
                <canvas id="subscribersChart" height="80"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Send Newsletter Modal -->
<div class="modal fade" id="sendNewsletterModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ app()->getLocale() == 'en' ? 'Send a Newsletter' : 'Envoyer une Newsletter' }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.subscribers.send-newsletter') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        {{ app()->getLocale() == 'en' ? 'This newsletter will be sent to' : 'Cette newsletter sera envoyée à' }} <strong>{{ $activeCount }} {{ app()->getLocale() == 'en' ? 'active subscriber(s)' : 'abonné(s) actif(s)' }}</strong>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Subject' : 'Sujet' }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="subject" required
                               placeholder="{{ app()->getLocale() == 'en' ? 'Your newsletter subject' : 'Sujet de votre newsletter' }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ app()->getLocale() == 'en' ? 'Message' : 'Message' }} <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="message" rows="8" required
                                  placeholder="{{ app()->getLocale() == 'en' ? 'Your newsletter content...' : 'Contenu de votre newsletter...' }}"></textarea>
                        <small class="text-muted">{{ app()->getLocale() == 'en' ? 'You can use HTML' : 'Vous pouvez utiliser du HTML' }}</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ app()->getLocale() == 'en' ? 'Cancel' : 'Annuler' }}</button>
                    <button type="submit" class="btn btn-primary-custom">
                        <i class="fas fa-paper-plane me-2"></i>{{ app()->getLocale() == 'en' ? 'Send Newsletter' : 'Envoyer Newsletter' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('#subscribersTable tbody tr');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });

    // Status filter
    document.getElementById('statusFilter').addEventListener('change', function() {
        const status = this.value;
        const rows = document.querySelectorAll('#subscribersTable tbody tr');

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
        const checkboxes = document.querySelectorAll('.row-checkbox:not(:disabled)');
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
            alert("{{ app()->getLocale() == 'en' ? 'Please select at least one subscriber' : 'Veuillez sélectionner au moins un abonné' }}");
            return;
        }

        let confirmMsg = '';
        switch(action) {
            case 'send-email':
                confirmMsg = `{{ app()->getLocale() == 'en' ? 'Send an email to' : 'Envoyer un email à' }} ${ids.length} {{ app()->getLocale() == 'en' ? 'subscriber(s)?' : 'abonné(s)?' }}`;
                break;
            case 'export':
                confirmMsg = `{{ app()->getLocale() == 'en' ? 'Export' : 'Exporter' }} ${ids.length} {{ app()->getLocale() == 'en' ? 'subscriber(s)?' : 'abonné(s)?' }}`;
                break;
            case 'delete':
                confirmMsg = `{{ app()->getLocale() == 'en' ? 'Permanently delete' : 'Supprimer définitivement' }} ${ids.length} {{ app()->getLocale() == 'en' ? 'subscriber(s)?' : 'abonné(s)?' }}`;
                break;
        }

        if (confirm(confirmMsg)) {
            // TODO: Implement bulk action
            console.log(`Bulk ${action} for IDs:`, ids);
            alert('Action en cours de développement');
        }
    }

    // Export subscribers
    function exportSubscribers() {
        if (confirm("{{ app()->getLocale() == 'en' ? 'Export all active subscribers to CSV?' : 'Exporter tous les abonnés actifs en CSV?' }}")) {
            window.location.href = '{{ route("admin.subscribers.export") }}';
        }
    }

    // Subscribers Chart
    const ctx = document.getElementById('subscribersChart');
    const monthlyData = @json($monthlySubscriptions);

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: monthlyData.labels,
            datasets: [{
                label: "{{ app()->getLocale() == 'en' ? 'New subscribers' : 'Nouveaux abonnés' }}",
                data: monthlyData.data,
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

    // Auto-hide alerts after 5 seconds
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);
</script>
@endpush
