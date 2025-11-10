@extends('layouts.admin')

@section('title', app()->getLocale() == 'en' ? 'Message Details' : 'Détails du Message')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 fw-bold">
                <i class="fas fa-envelope-open-text me-2"></i>{{ app()->getLocale() == 'en' ? 'Message Details' : 'Détails du Message' }}
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ app()->getLocale() == 'en' ? 'Dashboard' : 'Dashboard' }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.messages.index') }}">{{ app()->getLocale() == 'en' ? 'Messages' : 'Messages' }}</a></li>
                    <li class="breadcrumb-item active">{{ app()->getLocale() == 'en' ? 'Details' : 'Détails' }}</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>{{ app()->getLocale() == 'en' ? 'Back' : 'Retour' }}
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Contenu du message -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold">{{ $message->subject }}</h5>
                        @if($message->status === 'new')
                            <span class="badge bg-primary">{{ app()->getLocale() == 'en' ? 'New' : 'Nouveau' }}</span>
                        @elseif($message->status === 'read')
                            <span class="badge bg-info">{{ app()->getLocale() == 'en' ? 'Read' : 'Lu' }}</span>
                        @elseif($message->status === 'replied')
                            <span class="badge bg-success">{{ app()->getLocale() == 'en' ? 'Replied' : 'Répondu' }}</span>
                        @else
                            <span class="badge bg-secondary">{{ app()->getLocale() == 'en' ? 'Archived' : 'Archivé' }}</span>
                        @endif
                    </div>
                </div>
                <div class="card-body p-4">
                    <!-- Informations de l'expéditeur -->
                    <div class="d-flex align-items-start mb-4 pb-3 border-bottom">
                        <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-3"
                             style="width: 50px; height: 50px; min-width: 50px;">
                            <i class="fas fa-user fa-lg text-white"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1 fw-bold">{{ $message->name }}</h6>
                            <div class="text-muted small">
                                <i class="fas fa-envelope me-1"></i>
                                <a href="mailto:{{ $message->email }}" class="text-decoration-none">{{ $message->email }}</a>
                            </div>
                            @if($message->phone)
                            <div class="text-muted small">
                                <i class="fas fa-phone me-1"></i>
                                <a href="tel:{{ $message->phone }}" class="text-decoration-none">{{ $message->phone }}</a>
                            </div>
                            @endif
                            <div class="text-muted small mt-1">
                                <i class="fas fa-clock me-1"></i>
                                {{ app()->getLocale() == 'en' ? 'Sent on' : 'Envoyé le' }} {{ $message->created_at->format('d/m/Y à H:i') }}
                                ({{ $message->created_at->diffForHumans() }})
                            </div>
                        </div>
                    </div>

                    <!-- Contenu du message -->
                    <div class="message-content">
                        <h6 class="fw-bold mb-3">{{ app()->getLocale() == 'en' ? 'Message:' : 'Message :' }}</h6>
                        <div class="bg-light p-3 rounded" style="white-space: pre-wrap;">{{ $message->message }}</div>
                    </div>
                </div>
            </div>

            <!-- Zone de réponse rapide -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-reply me-2"></i>{{ app()->getLocale() == 'en' ? 'Reply to message' : 'Répondre au message' }}
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        {{ app()->getLocale() == 'en' ? 'To reply to this message, you can use the link below to compose an email or copy the address.' : 'Pour répondre à ce message, vous pouvez utiliser le lien ci-dessous pour composer un email ou copier l\'adresse.' }}
                    </div>

                    <div class="d-grid gap-2">
                        <a href="mailto:{{ $message->email }}?subject=Re: {{ urlencode($message->subject) }}&body={{ urlencode(app()->getLocale() == 'en' ? 'Hello ' . $message->name . ',' : 'Bonjour ' . $message->name . ',') }}"
                           class="btn btn-primary btn-lg">
                            <i class="fas fa-envelope me-2"></i>{{ app()->getLocale() == 'en' ? 'Reply by Email' : 'Répondre par Email' }}
                        </a>

                        @if($message->phone)
                        <a href="tel:{{ $message->phone }}" class="btn btn-success btn-lg">
                            <i class="fas fa-phone me-2"></i>{{ app()->getLocale() == 'en' ? 'Call' : 'Appeler' }} {{ $message->phone }}
                        </a>
                        @endif

                        @if($message->phone)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $message->phone) }}?text={{ urlencode(app()->getLocale() == 'en' ? 'Hello ' . $message->name . ', we have received your message regarding: ' . $message->subject : 'Bonjour ' . $message->name . ', nous avons bien reçu votre message concernant : ' . $message->subject) }}"
                           target="_blank"
                           class="btn btn-outline-success btn-lg">
                            <i class="fab fa-whatsapp me-2"></i>WhatsApp
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Actions -->
        <div class="col-lg-4">
            <!-- Actions rapides -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-tasks me-2"></i>{{ app()->getLocale() == 'en' ? 'Actions' : 'Actions' }}
                    </h5>
                </div>
                <div class="card-body p-3">
                    @if($message->status !== 'replied')
                    <form action="{{ route('admin.messages.mark-replied', $message) }}" method="POST" class="mb-2">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fas fa-check-circle me-2"></i>{{ app()->getLocale() == 'en' ? 'Mark as replied' : 'Marquer comme répondu' }}
                        </button>
                    </form>
                    @endif

                    <form action="{{ route('admin.messages.destroy', $message) }}" method="POST"
                          onsubmit="return confirm(&quot;{{ app()->getLocale() == 'en' ? 'Are you sure you want to delete this message?' : 'Êtes-vous sûr de vouloir supprimer ce message ?' }}&quot;)">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-trash me-2"></i>{{ app()->getLocale() == 'en' ? 'Delete' : 'Supprimer' }}
                        </button>
                    </form>
                </div>
            </div>

            <!-- Informations supplémentaires -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-info-circle me-2"></i>{{ app()->getLocale() == 'en' ? 'Information' : 'Informations' }}
                    </h5>
                </div>
                <div class="card-body p-3">
                    <div class="mb-3">
                        <label class="small text-muted mb-1">{{ app()->getLocale() == 'en' ? 'Status' : 'Statut' }}</label>
                        <div>
                            @if($message->status === 'new')
                                <span class="badge bg-primary">{{ app()->getLocale() == 'en' ? 'New' : 'Nouveau' }}</span>
                            @elseif($message->status === 'read')
                                <span class="badge bg-info">{{ app()->getLocale() == 'en' ? 'Read' : 'Lu' }}</span>
                            @elseif($message->status === 'replied')
                                <span class="badge bg-success">{{ app()->getLocale() == 'en' ? 'Replied' : 'Répondu' }}</span>
                            @else
                                <span class="badge bg-secondary">{{ app()->getLocale() == 'en' ? 'Archived' : 'Archivé' }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="small text-muted mb-1">{{ app()->getLocale() == 'en' ? 'Received on' : 'Reçu le' }}</label>
                        <div>{{ $message->created_at->format('d/m/Y à H:i') }}</div>
                    </div>

                    @if($message->replied_at)
                    <div class="mb-3">
                        <label class="small text-muted mb-1">{{ app()->getLocale() == 'en' ? 'Replied on' : 'Répondu le' }}</label>
                        <div>{{ $message->replied_at->format('d/m/Y à H:i') }}</div>
                    </div>
                    @endif

                    <div class="mb-3">
                        <label class="small text-muted mb-1">{{ app()->getLocale() == 'en' ? 'Subject' : 'Sujet' }}</label>
                        <div>{{ $message->subject }}</div>
                    </div>

                    <div class="mb-0">
                        <label class="small text-muted mb-1">{{ app()->getLocale() == 'en' ? 'Message ID' : 'ID Message' }}</label>
                        <div class="small text-muted">#{{ $message->id }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .message-content {
        font-size: 1.05rem;
        line-height: 1.6;
    }
</style>
@endsection
