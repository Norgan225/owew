@extends('layouts.base')

@section('title', 'Politiques de confidentialité - OWEW')


@section('content')

    <!-- Hero Section -->
    <section class="page-hero" style="background: linear-gradient(135deg, #4B0082, #6a1b9a); padding: 4rem 0 3rem; color: white;">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-2" data-aos="fade-up">Politique de Confidentialité</h1>
            <p data-aos="fade-up" data-aos-delay="100">Protection de vos données personnelles</p>
        </div>
    </section>

    <!-- Contenu -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-5">

                            <div class="alert alert-primary mb-5">
                                <i class="fas fa-shield-alt me-2"></i>
                                <strong>Notre engagement :</strong> OWEW s'engage à protéger votre vie privée et
                                à traiter vos données personnelles avec le plus grand soin et conformément aux
                                réglementations en vigueur.
                            </div>

                            <h3 class="fw-bold text-primary mb-4">1. Données Collectées</h3>
                            <p>Nous collectons les types de données suivants :</p>

                            <h5 class="fw-semibold mt-4 mb-3">1.1 Données que vous nous fournissez</h5>
                            <ul>
                                <li><strong>Lors des dons :</strong> Nom, prénom, email, téléphone, adresse, montant du don</li>
                                <li><strong>Inscription newsletter :</strong> Adresse email</li>
                                <li><strong>Candidature bénévolat :</strong> Nom, prénom, email, téléphone, compétences, motivation</li>
                                <li><strong>Formulaire de contact :</strong> Nom, email, message</li>
                                <li><strong>Création de compte :</strong> Nom, email, mot de passe (crypté)</li>
                            </ul>

                            <h5 class="fw-semibold mt-4 mb-3">1.2 Données collectées automatiquement</h5>
                            <ul>
                                <li>Adresse IP</li>
                                <li>Type de navigateur et système d'exploitation</li>
                                <li>Pages visitées et durée de visite</li>
                                <li>Source de référence</li>
                                <li>Cookies (voir section dédiée)</li>
                            </ul>

                            <hr class="my-5">

                            <h3 class="fw-bold text-primary mb-4">2. Utilisation des Données</h3>
                            <p>Vos données personnelles sont utilisées pour :</p>
                            <ul>
                                <li>Traiter vos dons et émettre des reçus fiscaux</li>
                                <li>Vous tenir informé de nos activités via la newsletter (si vous êtes inscrit)</li>
                                <li>Gérer vos candidatures de bénévolat</li>
                                <li>Répondre à vos demandes de contact</li>
                                <li>Améliorer nos services et notre site web</li>
                                <li>Respecter nos obligations légales et comptables</li>
                                <li>Prévenir la fraude et assurer la sécurité</li>
                            </ul>

                            <hr class="my-5">

                            <h3 class="fw-bold text-primary mb-4">3. Base Légale du Traitement</h3>
                            <p>Nous traitons vos données personnelles sur les bases légales suivantes :</p>
                            <ul>
                                <li><strong>Consentement :</strong> Pour l'envoi de newsletter et communications marketing</li>
                                <li><strong>Exécution d'un contrat :</strong> Pour le traitement des dons</li>
                                <li><strong>Obligation légale :</strong> Pour la conservation des données de dons (obligations fiscales)</li>
                                <li><strong>Intérêt légitime :</strong> Pour l'amélioration de nos services</li>
                            </ul>

                            <hr class="my-5">

                            <h3 class="fw-bold text-primary mb-4">4. Partage des Données</h3>
                            <p>
                                OWEW ne vend, ne loue et ne partage pas vos données personnelles avec des tiers
                                à des fins commerciales. Vos données peuvent être partagées uniquement dans les cas suivants :
                            </p>
                            <ul>
                                <li><strong>Prestataires de services :</strong> Hébergement web, processeurs de paiement,
                                    services d'emailing (avec engagement de confidentialité)</li>
                                <li><strong>Obligations légales :</strong> Si la loi nous y oblige (autorités judiciaires, fiscales)</li>
                                <li><strong>Partenaires :</strong> Uniquement avec votre consentement explicite</li>
                            </ul>

                            <hr class="my-5">

                            <h3 class="fw-bold text-primary mb-4">5. Conservation des Données</h3>
                            <p>Nous conservons vos données pendant les durées suivantes :</p>
                            <ul>
                                <li><strong>Données de dons :</strong> 10 ans (obligation légale comptable)</li>
                                <li><strong>Newsletter :</strong> Jusqu'à votre désinscription</li>
                                <li><strong>Candidatures bénévolat :</strong> 2 ans maximum</li>
                                <li><strong>Messages de contact :</strong> 1 an</li>
                                <li><strong>Comptes utilisateurs :</strong> Durée d'activité + 3 ans</li>
                            </ul>

                            <hr class="my-5">

                            <h3 class="fw-bold text-primary mb-4">6. Vos Droits</h3>
                            <p>Conformément à la réglementation, vous disposez des droits suivants :</p>
                            <div class="row g-3 mt-3">
                                <div class="col-md-6">
                                    <div class="card bg-light border-0 h-100">
                                        <div class="card-body">
                                            <h6 class="fw-bold"><i class="fas fa-eye text-primary me-2"></i>Droit d'accès</h6>
                                            <p class="small mb-0">Obtenir une copie de vos données personnelles</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card bg-light border-0 h-100">
                                        <div class="card-body">
                                            <h6 class="fw-bold"><i class="fas fa-edit text-primary me-2"></i>Droit de rectification</h6>
                                            <p class="small mb-0">Corriger vos données inexactes</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card bg-light border-0 h-100">
                                        <div class="card-body">
                                            <h6 class="fw-bold"><i class="fas fa-trash text-primary me-2"></i>Droit à l'effacement</h6>
                                            <p class="small mb-0">Demander la suppression de vos données</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card bg-light border-0 h-100">
                                        <div class="card-body">
                                            <h6 class="fw-bold"><i class="fas fa-ban text-primary me-2"></i>Droit d'opposition</h6>
                                            <p class="small mb-0">Vous opposer au traitement de vos données</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card bg-light border-0 h-100">
                                        <div class="card-body">
                                            <h6 class="fw-bold"><i class="fas fa-pause text-primary me-2"></i>Droit à la limitation</h6>
                                            <p class="small mb-0">Limiter le traitement de vos données</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card bg-light border-0 h-100">
                                        <div class="card-body">
                                            <h6 class="fw-bold"><i class="fas fa-download text-primary me-2"></i>Droit à la portabilité</h6>
                                            <p class="small mb-0">Récupérer vos données dans un format structuré</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-info mt-4">
                                <strong>Pour exercer vos droits :</strong> Envoyez un email à
                                <a href="mailto:privacy@owew.org" class="fw-bold">privacy@owew.org</a>
                                avec une copie de votre pièce d'identité. Nous vous répondrons dans un délai de 30 jours.
                            </div>

                            <hr class="my-5">

                            <h3 class="fw-bold text-primary mb-4">7. Cookies</h3>
                            <p>Notre site utilise des cookies pour :</p>
                            <ul>
                                <li><strong>Cookies essentiels :</strong> Nécessaires au fonctionnement du site (session, sécurité)</li>
                                <li><strong>Cookies de performance :</strong> Google Analytics pour améliorer l'expérience</li>
                                <li><strong>Cookies fonctionnels :</strong> Mémoriser vos préférences (langue, etc.)</li>
                            </ul>
                            <p>
                                Vous pouvez gérer vos préférences de cookies via les paramètres de votre navigateur.
                                Le refus des cookies peut limiter certaines fonctionnalités du site.
                            </p>

                            <hr class="my-5">

                            <h3 class="fw-bold text-primary mb-4">8. Sécurité</h3>
                            <p>Nous mettons en œuvre des mesures de sécurité techniques et organisationnelles pour protéger vos données :</p>
                            <ul>
                                <li>Cryptage SSL/TLS (HTTPS)</li>
                                <li>Mot de passe cryptés (hash)</li>
                                <li>Accès restreint aux données (personnel autorisé uniquement)</li>
                                <li>Sauvegardes régulières</li>
                                <li>Protection contre les cyberattaques</li>
                                <li>Serveurs sécurisés</li>
                            </ul>

                            <hr class="my-5">

                            <h3 class="fw-bold text-primary mb-4">9. Transferts Internationaux</h3>
                            <p>
                                Vos données peuvent être transférées et stockées sur des serveurs situés en dehors
                                de la Côte d'Ivoire. Dans ce cas, nous nous assurons que des garanties appropriées
                                sont en place pour protéger vos données.
                            </p>

                            <hr class="my-5">

                            <h3 class="fw-bold text-primary mb-4">10. Mineurs</h3>
                            <p>
                                Notre site n'est pas destiné aux enfants de moins de 16 ans. Nous ne collectons pas
                                sciemment de données personnelles d'enfants. Si vous êtes parent et que vous pensez
                                que votre enfant nous a fourni des données, contactez-nous immédiatement.
                            </p>

                            <hr class="my-5">

                            <h3 class="fw-bold text-primary mb-4">11. Modifications</h3>
                            <p>
                                Nous nous réservons le droit de modifier cette politique de confidentialité à tout moment.
                                Les modifications prendront effet dès leur publication sur cette page. La date de dernière
                                mise à jour est indiquée ci-dessous.
                            </p>

                            <hr class="my-5">

                            <h3 class="fw-bold text-primary mb-4">12. Contact</h3>
                            <p>Pour toute question concernant cette politique de confidentialité ou vos données personnelles :</p>
                            <div class="card bg-light border-0 mt-4">
                                <div class="card-body">
                                    <h6 class="fw-bold mb-3">Responsable de la Protection des Données</h6>
                                    <ul class="list-unstyled mb-0">
                                        <li><i class="fas fa-envelope text-primary me-2"></i> <strong>Email :</strong> privacy@owew.org</li>
                                        <li><i class="fas fa-phone text-primary me-2"></i> <strong>Téléphone :</strong> +225 XX XX XX XX XX</li>
                                        <li><i class="fas fa-map-marker-alt text-primary me-2"></i> <strong>Adresse :</strong> OWEW, Abidjan, Côte d'Ivoire</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="alert alert-success mt-5">
                                <i class="fas fa-calendar-alt me-2"></i>
                                <strong>Dernière mise à jour :</strong> 23 Octobre 2025
                            </div>

                            <div class="text-center mt-5">
                                <a href="/" class="btn btn-primary btn-lg">
                                    <i class="fas fa-home me-2"></i>Retour à l'Accueil
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .page-hero {
            position: relative;
        }

        .page-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="10" cy="10" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="90" cy="90" r="1" fill="rgba(255,255,255,0.1)"/></svg>');
            opacity: 0.3;
        }
    </style>

@endsection
