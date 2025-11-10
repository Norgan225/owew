@extends('layouts.admin')

@section('title', app()->getLocale() == 'en' ? 'Contact Messages' : 'Messages de contact')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">{{ app()->getLocale() == 'en' ? 'Contact Messages' : 'Messages de contact' }}</h2>
            <p class="text-muted mb-0">{{ $messages->total() }} {{ app()->getLocale() == 'en' ? 'message(s) received' : 'message(s) reçu(s)' }}</p>
        </div>
        <div class="d-flex gap-2">
            <form method="GET" class="d-flex gap-2">
                <select name="status" class="form-select" style="width: 180px;" onchange="this.form.submit()">
                    <option value="">{{ app()->getLocale() == 'en' ? 'All statuses' : 'Tous les statuts' }}</option>
                    <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'New' : 'Nouveau' }}</option>
                    <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Read' : 'Lu' }}</option>
                    <option value="replied" {{ request('status') == 'replied' ? 'selected' : '' }}>{{ app()->getLocale() == 'en' ? 'Replied' : 'Répondu' }}</option>
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
                    <th>{{ app()->getLocale() == 'en' ? 'Sender' : 'Expéditeur' }}</th>
                    <th>{{ app()->getLocale() == 'en' ? 'Email' : 'Email' }}</th>
                    <th>{{ app()->getLocale() == 'en' ? 'Phone' : 'Téléphone' }}</th>
                    <th>{{ app()->getLocale() == 'en' ? 'Subject' : 'Sujet' }}</th>
                    <th>{{ app()->getLocale() == 'en' ? 'Message' : 'Message' }}</th>
                    <th>{{ app()->getLocale() == 'en' ? 'Status' : 'Statut' }}</th>
                    <th>{{ app()->getLocale() == 'en' ? 'Date' : 'Date' }}</th>
                    <th class="text-end">{{ app()->getLocale() == 'en' ? 'Actions' : 'Actions' }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $msg)
                <tr>
                    <td><strong>{{ $msg->name }}</strong></td>
                    <td>
                        <a href="mailto:{{ $msg->email }}" class="text-primary">{{ $msg->email }}</a>
                    </td>
                    <td>{{ $msg->phone ?? '-' }}</td>
                    <td>{{ Str::limit($msg->subject, 32) }}</td>
                    <td>
                        <span title="{{ $msg->message }}">{{ Str::limit($msg->message, 40) }}</span>
                    </td>
                    <td>
                        @if($msg->status === 'new')
                            <span class="badge bg-warning text-dark"><i class="fas fa-envelope"></i> {{ app()->getLocale() == 'en' ? 'New' : 'Nouveau' }}</span>
                        @elseif($msg->status === 'read')
                            <span class="badge bg-info"><i class="fas fa-eye"></i> {{ app()->getLocale() == 'en' ? 'Read' : 'Lu' }}</span>
                        @else
                            <span class="badge bg-success"><i class="fas fa-reply"></i> {{ app()->getLocale() == 'en' ? 'Replied' : 'Répondu' }}</span>
                        @endif
                    </td>
                    <td>
                        <small class="text-muted">{{ $msg->created_at->format('d/m/Y H:i') }}</small>
                        @if($msg->replied_at)
                            <br><small class="text-success">{{ app()->getLocale() == 'en' ? 'Replied on' : 'Répondu le' }} {{ $msg->replied_at->format('d/m/Y') }}</small>
                        @endif
                    </td>
                    <td class="text-end">
                        <a href="{{ route('admin.messages.show', $msg) }}" class="btn btn-sm btn-outline-primary me-1">
                            <i class="fas fa-eye"></i>
                        </a>
                        @if($msg->status !== 'replied')
                        <form action="{{ route('admin.messages.mark-replied', $msg) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-outline-success me-1"
                              title="{{ app()->getLocale() == 'en' ? 'Mark as replied' : 'Marquer comme répondu' }}">
                                <i class="fas fa-check"></i>
                            </button>
                        </form>
                        @endif
                        <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" style="display:inline;" onsubmit="return confirm(&quot;{{ app()->getLocale() == 'en' ? 'Delete this message?' : 'Supprimer ce message ?' }}&quot;);">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="{{ app()->getLocale() == 'en' ? 'Delete' : 'Supprimer' }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-5">
                        <i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
                        <p class="text-muted mb-3">{{ app()->getLocale() == 'en' ? 'No messages received' : 'Aucun message reçu' }}</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($messages->hasPages())
    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="text-muted">
            {{ app()->getLocale() == 'en' ? 'Showing' : 'Affichage de' }} {{ $messages->firstItem() }} {{ app()->getLocale() == 'en' ? 'to' : 'à' }} {{ $messages->lastItem() }} {{ app()->getLocale() == 'en' ? 'of' : 'sur' }} {{ $messages->total() }} {{ app()->getLocale() == 'en' ? 'messages' : 'messages' }}
        </div>
        {{ $messages->links() }}
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    // Auto-hide alerts after 5s
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);
</script>
@endpush
