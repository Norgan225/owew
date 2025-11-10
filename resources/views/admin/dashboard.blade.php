@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Welcome Header -->
    <div class="mb-4">
        <h2 class="fw-bold mb-1">{{ app()->getLocale() == 'en' ? 'Hello' : 'Bonjour' }}, {{ Auth::user()->name }} 👋</h2>
        <p class="text-muted mb-0">{{ app()->getLocale() == 'en' ? 'Here\'s an overview of your activity today' : 'Voici un aperçu de votre activité aujourd\'hui' }}</p>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="stat-card animate-in">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Total Donations Collected' : 'Total Dons Collectés' }}</div>
                        <div class="stat-value">{{ number_format($stats['total_donations'], 0, ',', ' ') }} FCFA</div>
                        <div class="stat-change up">
                            <i class="fas fa-arrow-up"></i> +{{ $stats['donations_count'] }} {{ app()->getLocale() == 'en' ? 'donations' : 'dons' }}
                        </div>
                    </div>
                    <div class="stat-icon" style="background: #D1FAE5; color: #059669;">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="stat-card animate-in" style="animation-delay: 0.1s;">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Active Projects' : 'Projets Actifs' }}</div>
                        <div class="stat-value">{{ $stats['active_projects'] }}</div>
                        <div class="stat-change">
                            <i class="fas fa-info-circle"></i> {{ app()->getLocale() == 'en' ? 'Out of' : 'Sur' }} {{ $stats['total_projects'] }} {{ app()->getLocale() == 'en' ? 'total' : 'total' }}
                        </div>
                    </div>
                    <div class="stat-icon" style="background: #DBEAFE; color: #2563EB;">
                        <i class="fas fa-project-diagram"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="stat-card animate-in" style="animation-delay: 0.2s;">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label">{{ app()->getLocale() == 'en' ? 'New Messages' : 'Nouveaux Messages' }}</div>
                        <div class="stat-value">{{ $stats['new_messages'] }}</div>
                        <div class="stat-change">
                            <i class="fas fa-envelope"></i> {{ app()->getLocale() == 'en' ? 'To process' : 'À traiter' }}
                        </div>
                    </div>
                    <div class="stat-icon" style="background: #FEF3C7; color: #D97706;">
                        <i class="fas fa-envelope"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="stat-card animate-in" style="animation-delay: 0.3s;">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Newsletter Subscribers' : 'Abonnés Newsletter' }}</div>
                        <div class="stat-value">{{ $stats['total_subscribers'] }}</div>
                        <div class="stat-change">
                            <i class="fas fa-users"></i> {{ app()->getLocale() == 'en' ? 'Active' : 'Actifs' }}
                        </div>
                    </div>
                    <div class="stat-icon" style="background: #EDE9FE; color: var(--primary);">
                        <i class="fas fa-paper-plane"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Second Row Stats -->
    <div class="row g-3 mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="stat-card animate-in" style="animation-delay: 0.4s;">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Pending Volunteers' : 'Bénévoles en Attente' }}</div>
                        <div class="stat-value">{{ $stats['pending_volunteers'] }}</div>
                        <div class="stat-change">
                            <i class="fas fa-clock"></i> {{ app()->getLocale() == 'en' ? 'To review' : 'À examiner' }}
                        </div>
                    </div>
                    <div class="stat-icon" style="background: #FED7AA; color: #EA580C;">
                        <i class="fas fa-user-clock"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="stat-card animate-in" style="animation-delay: 0.5s;">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Partnership Requests' : 'Demandes Partenariat' }}</div>
                        <div class="stat-value">{{ $stats['approved_partnerships'] }}</div>
                        <div class="stat-change">
                            <i class="fas fa-handshake"></i> {{ app()->getLocale() == 'en' ? 'En attente' : 'Approved' }}
                        </div>
                    </div>
                    <div class="stat-icon" style="background: #E9D5FF; color: #9333EA;">
                        <i class="fas fa-handshake"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="stat-card animate-in" style="animation-delay: 0.6s;">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Published Articles' : 'Articles Publiés' }}</div>
                        <div class="stat-value">{{ \App\Models\BlogPost::where('status', 'published')->count() }}</div>
                        <div class="stat-change">
                            <i class="fas fa-blog"></i> {{ app()->getLocale() == 'en' ? 'Online' : 'En ligne' }}
                        </div>
                    </div>
                    <div class="stat-icon" style="background: #BFDBFE; color: #1D4ED8;">
                        <i class="fas fa-newspaper"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="stat-card animate-in" style="animation-delay: 0.7s;">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label">{{ app()->getLocale() == 'en' ? 'Gallery Photos' : 'Photos Galerie' }}</div>
                        <div class="stat-value">{{ \App\Models\Gallery::count() }}</div>
                        <div class="stat-change">
                            <i class="fas fa-images"></i> {{ app()->getLocale() == 'en' ? 'Total' : 'Total' }}
                        </div>
                    </div>
                    <div class="stat-icon" style="background: #FED7E2; color: #BE185D;">
                        <i class="fas fa-camera"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Tables Row -->
    <div class="row g-4 mb-4">
        <!-- Monthly Donations Chart -->
        <div class="col-lg-8">
            <div class="chart-card animate-in">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0">{{ app()->getLocale() == 'en' ? 'Monthly Donations' : 'Dons Mensuels' }} ({{ date('Y') }})</h5>
                    <div class="btn-group btn-group-sm" role="group">
                        <button type="button" class="btn btn-outline-primary active">{{ app()->getLocale() == 'en' ? 'Year' : 'Année' }}</button>
                        <button type="button" class="btn btn-outline-primary">{{ app()->getLocale() == 'en' ? 'Month' : 'Mois' }}</button>
                        <button type="button" class="btn btn-outline-primary">{{ app()->getLocale() == 'en' ? 'Week' : 'Semaine' }}</button>
                    </div>
                </div>
                <canvas id="donationsChart" height="80"></canvas>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-lg-4">
            <div class="stat-card animate-in">
                <h5 class="fw-bold mb-4">{{ app()->getLocale() == 'en' ? 'Quick Actions' : 'Actions Rapides' }}</h5>
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.projects.create') }}" class="btn btn-outline-primary text-start">
                        <i class="fas fa-plus-circle me-2"></i> {{ app()->getLocale() == 'en' ? 'New Project' : 'Nouveau Projet' }}
                    </a>
                    <a href="{{ route('admin.blog.create') }}" class="btn btn-outline-primary text-start">
                        <i class="fas fa-pen me-2"></i> {{ app()->getLocale() == 'en' ? 'New Article' : 'Nouvel Article' }}
                    </a>
                    <a href="{{ route('admin.donations.index') }}" class="btn btn-outline-primary text-start">
                        <i class="fas fa-hand-holding-usd me-2"></i> {{ app()->getLocale() == 'en' ? 'View Donations' : 'Voir les Dons' }}
                    </a>
                    <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-primary text-start position-relative">
                        <i class="fas fa-envelope me-2"></i> {{ app()->getLocale() == 'en' ? 'Messages' : 'Messages' }}
                        @if($stats['new_messages'] > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $stats['new_messages'] }}
                        </span>
                        @endif
                    </a>
                    <a href="{{ route('admin.volunteers.index') }}" class="btn btn-outline-primary text-start position-relative">
                        <i class="fas fa-users me-2"></i> {{ app()->getLocale() == 'en' ? 'Volunteers' : 'Bénévoles' }}
                        @if($stats['pending_volunteers'] > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">
                            {{ $stats['pending_volunteers'] }}
                        </span>
                        @endif
                    </a>
                    <a href="{{ route('admin.partnerships.index') }}" class="btn btn-outline-primary text-start position-relative">
                        <i class="fas fa-handshake me-2"></i> {{ app()->getLocale() == 'en' ? 'Partnerships' : 'Partenariats' }}
                        @if($stats['approved_partnerships'] > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">
                            {{ $stats['approved_partnerships'] }}
                        </span>
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Row -->
    <div class="row g-4">
        <!-- Recent Donations -->
        <div class="col-lg-7">
            <div class="data-table animate-in">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0">{{ app()->getLocale() == 'en' ? 'Recent Donations' : 'Dons Récents' }}</h5>
                    <a href="{{ route('admin.donations.index') }}" class="btn btn-sm btn-outline-primary">
                        {{ app()->getLocale() == 'en' ? 'View all' : 'Voir tout' }}
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ app()->getLocale() == 'en' ? 'Donor' : 'Donateur' }}</th>
                                <th>{{ app()->getLocale() == 'en' ? 'Project' : 'Projet' }}</th>
                                <th>{{ app()->getLocale() == 'en' ? 'Amount' : 'Montant' }}</th>
                                <th>{{ app()->getLocale() == 'en' ? 'Date' : 'Date' }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentDonations as $donation)
                            <tr>
                                <td>
                                    <div class="fw-semibold">{{ $donation->donor_name }}</div>
                                    <small class="text-muted">{{ $donation->donor_email }}</small>
                                </td>
                                <td>
                                    @if($donation->project)
                                    <span class="text-truncate d-inline-block" style="max-width: 150px;">
                                        {{ localized_field($donation->project, 'title') }}
                                    </span>
                                    @else
                                    <span class="text-muted">Don général</span>
                                    @endif
                                </td>
                                <td>
                                    <strong class="text-success">
                                        {{ number_format($donation->amount, 0, ',', ' ') }} FCFA
                                    </strong>
                                </td>
                                <td>
                                    <small class="text-muted">{{ $donation->created_at->diffForHumans() }}</small>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <i class="fas fa-hand-holding-usd fa-2x text-muted mb-2 d-block"></i>
                                    <small class="text-muted">{{ app()->getLocale() == 'en' ? 'No recent donations' : 'Aucun don récent' }}</small>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Top Projects -->
        <div class="col-lg-5">
            <div class="data-table animate-in">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0">{{ app()->getLocale() == 'en' ? 'Top Projects' : 'Top Projets' }}</h5>
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-sm btn-outline-primary">
                        {{ app()->getLocale() == 'en' ? 'View all' : 'Voir tout' }}
                    </a>
                </div>
                <div class="list-group list-group-flush">
                    @forelse($topProjects as $index => $project)
                    <div class="list-group-item border-0 px-0">
                        <div class="d-flex align-items-start gap-3">
                            <div class="fw-bold text-primary" style="font-size: 1.5rem; min-width: 30px;">
                                #{{ $index + 1 }}
                            </div>
                            <div class="flex-grow-1">
                                <div class="fw-semibold mb-1">
                                    {{ Str::limit(localized_field($project, 'title'), 40) }}
                                </div>
                                <div class="progress mb-2" style="height: 6px;">
                                    @php
                                        $percentage = $project->goal_amount > 0
                                            ? min(100, ($project->raised_amount / $project->goal_amount) * 100)
                                            : 0;
                                    @endphp
                                    <div class="progress-bar bg-success" style="width: {{ $percentage }}%"></div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-success fw-semibold">
                                        {{ number_format($project->raised_amount, 0, ',', ' ') }} FCFA
                                    </small>
                                    <small class="text-muted">
                                        {{ number_format($percentage, 0) }}%
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-4">
                        <i class="fas fa-project-diagram fa-2x text-muted mb-2 d-block"></i>
                        <small class="text-muted">{{ app()->getLocale() == 'en' ? 'No active projects' : 'Aucun projet actif' }}</small>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Donations Chart
    const ctx = document.getElementById('donationsChart');

    // Préparer les données du graphique
    const monthlyData = @json($monthlyDonations);
    const labels = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'];
    const data = new Array(12).fill(0);

    // Remplir les données
    monthlyData.forEach(item => {
        data[item.month - 1] = item.total;
    });

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: "{{ app()->getLocale() == 'en' ? 'Donations (FCFA)' : 'Dons (FCFA)' }}",
                data: data,
                borderColor: '#4B0082',
                backgroundColor: 'rgba(75, 0, 130, 0.1)',
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#4B0082',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return '{{ app()->getLocale() == 'en' ? 'Donations: ' : 'Dons: ' }}' + new Intl.NumberFormat('fr-FR').format(context.parsed.y) + ' FCFA';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return new Intl.NumberFormat('fr-FR', {
                                notation: 'compact',
                                compactDisplay: 'short'
                            }).format(value);
                        }
                    }
                }
            }
        }
    });
</script>
@endpush
