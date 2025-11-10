@extends('layouts.base')

@section('title', 'Désabonnement - Newsletter')

@section('content')
<section style="min-height: 80vh; display: flex; align-items: center; background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                    <div class="card-body p-5 text-center">
                        @if(isset($alreadyUnsubscribed) && $alreadyUnsubscribed)
                            <!-- Déjà désabonné -->
                            <div class="mb-4">
                                <i class="fas fa-info-circle" style="font-size: 5rem; color: #FF9800;"></i>
                            </div>
                            <h2 class="mb-3" style="color: #4B0082;">Déjà désabonné</h2>
                            <p class="lead text-muted mb-4">
                                L'adresse <strong>{{ $subscriber->email }}</strong> est déjà désabonnée de notre newsletter.
                            </p>
                        @else
                            <!-- Désabonnement réussi -->
                            <div class="mb-4">
                                <i class="fas fa-check-circle" style="font-size: 5rem; color: #10b981;"></i>
                            </div>
                            <h2 class="mb-3" style="color: #4B0082;">Désabonnement réussi</h2>
                            <p class="lead text-muted mb-4">
                                @if($subscriber->name)
                                    {{ $subscriber->name }}, vous
                                @else
                                    Vous
                                @endif
                                avez été désabonné(e) de notre newsletter avec succès.
                            </p>
                            <p class="text-muted">
                                Nous sommes tristes de vous voir partir ! 😢<br>
                                Vous ne recevrez plus d'emails de notre part.
                            </p>
                        @endif

                        <hr class="my-4">

                        <!-- Options -->
                        <div class="d-grid gap-2">
                            <a href="{{ route('home') }}" class="btn btn-lg" style="background: #4B0082; color: white; border-radius: 50px;">
                                <i class="fas fa-home me-2"></i>Retour à l'accueil
                            </a>

                            @if(isset($alreadyUnsubscribed) && !$alreadyUnsubscribed)
                            <form action="{{ route('newsletter.subscribe') }}" method="POST">
                                @csrf
                                <input type="hidden" name="email" value="{{ $subscriber->email }}">
                                @if($subscriber->name)
                                <input type="hidden" name="name" value="{{ $subscriber->name }}">
                                @endif
                                <button type="submit" class="btn btn-outline-success btn-lg w-100" style="border-radius: 50px;">
                                    <i class="fas fa-undo me-2"></i>Je change d'avis, me réabonner
                                </button>
                            </form>
                            @endif
                        </div>

                        <!-- Raison du désabonnement (optionnel) -->
                        @if(isset($alreadyUnsubscribed) && !$alreadyUnsubscribed)
                        <div class="mt-4 p-3" style="background: #f8f9fa; border-radius: 10px;">
                            <p class="small text-muted mb-2">
                                <strong>Pourquoi vous désabonner ?</strong> (optionnel)
                            </p>
                            <div class="d-grid gap-2">
                                <button class="btn btn-sm btn-outline-secondary" onclick="sendFeedback('Trop d\'emails')">
                                    Trop d'emails
                                </button>
                                <button class="btn btn-sm btn-outline-secondary" onclick="sendFeedback('Contenu non pertinent')">
                                    Contenu non pertinent
                                </button>
                                <button class="btn btn-sm btn-outline-secondary" onclick="sendFeedback('Autre raison')">
                                    Autre raison
                                </button>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Contact info -->
                <div class="text-center mt-4">
                    <p class="text-muted">
                        Des questions ?
                        <a href="{{ route('contact.index') }}" style="color: #4B0082; text-decoration: none;">
                            Contactez-nous
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function sendFeedback(reason) {
    alert('Merci pour votre retour : ' + reason);
    // Tu peux ajouter un appel AJAX ici pour enregistrer le feedback
}
</script>
@endsection
