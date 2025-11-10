@extends('layouts.base')

@section('title', 'Mentions légales - OWEW')


@section('content')

<!-- Hero Section -->
<section class="page-hero" style="background: linear-gradient(135deg, #4B0082, #6a1b9a); padding: 4rem 0 3rem; color: white;">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-2" data-aos="fade-up">Mentions Légales</h1>
        <p data-aos="fade-up" data-aos-delay="100">Informations légales et réglementaires</p>
    </div>
</section>

<!-- Contenu -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5">

                        <h3 class="fw-bold text-primary mb-4">1. Éditeur du Site</h3>
                        <p>Le site web <strong>www.owew.org</strong> est édité par :</p>
                        <ul class="list-unstyled ms-4">
                            <li><strong>Nom de l'organisation :</strong> OWEW (Orphan, Widows, Exceptional Women)</li>
                            <li><strong>Forme juridique :</strong> Association à but non lucratif / ONG</li>
                            <li><strong>Siège social :</strong> Abidjan, Côte d'Ivoire</li>
                            <li><strong>Numéro d'enregistrement :</strong> [Numéro à compléter]</li>
                            <li><strong>Email :</strong> contact@owew.org</li>
                            <li><strong>Téléphone :</strong> +225 XX XX XX XX XX</li>
                        </ul>

                        <hr class="my-5">

                        <h3 class="fw-bold text-primary mb-4">2. Directeur de Publication</h3>
                        <p>Le directeur de la publication du site est : <strong>[Nom du Directeur]</strong></p>

                        <hr class="my-5">

                        <h3 class="fw-bold text-primary mb-4">3. Hébergement</h3>
                        <p>Le site est hébergé par :</p>
                        <ul class="list-unstyled ms-4">
                            <li><strong>Nom de l'hébergeur :</strong> [Nom de l'hébergeur]</li>
                            <li><strong>Adresse :</strong> [Adresse de l'hébergeur]</li>
                            <li><strong>Téléphone :</strong> [Téléphone de l'hébergeur]</li>
                        </ul>

                        <hr class="my-5">

                        <h3 class="fw-bold text-primary mb-4">4. Propriété Intellectuelle</h3>
                        <p>
                            L'ensemble du contenu de ce site (textes, images, vidéos, logos, graphismes, etc.)
                            est la propriété exclusive d'OWEW, sauf mention contraire. Toute reproduction,
                            distribution, modification, adaptation, retransmission ou publication de ces
                            différents éléments est strictement interdite sans l'accord écrit de l'ONG OWEW.
                        </p>
                        <p>
                            Le logo OWEW et la marque OWEW sont des marques déposées. Toute utilisation non
                            autorisée de ces marques est interdite et pourra faire l'objet de poursuites judiciaires.
                        </p>

                        <hr class="my-5">

                        <h3 class="fw-bold text-primary mb-4">5. Protection des Données Personnelles</h3>
                        <p>
                            OWEW s'engage à protéger la vie privée des utilisateurs de son site internet.
                            Les informations personnelles collectées sont traitées conformément à notre
                            <a href="/politique-confidentialite" class="text-primary fw-semibold">Politique de Confidentialité</a>.
                        </p>

                        <hr class="my-5">

                        <h3 class="fw-bold text-primary mb-4">6. Cookies</h3>
                        <p>
                            Ce site utilise des cookies pour améliorer l'expérience utilisateur. En naviguant
                            sur ce site, vous acceptez l'utilisation de cookies conformément à notre politique
                            de confidentialité.
                        </p>

                        <hr class="my-5">

                        <h3 class="fw-bold text-primary mb-4">7. Limitation de Responsabilité</h3>
                        <p>
                            OWEW s'efforce d'assurer au mieux l'exactitude et la mise à jour des informations
                            diffusées sur ce site. Toutefois, OWEW ne peut garantir l'exactitude, la précision
                            ou l'exhaustivité des informations mises à disposition sur ce site.
                        </p>
                        <p>
                            OWEW ne pourra être tenue responsable des dommages directs ou indirects causés
                            au matériel de l'utilisateur lors de l'accès au site, et résultant soit de
                            l'utilisation d'un matériel ne répondant pas aux spécifications techniques, soit
                            de l'apparition d'un bug ou d'une incompatibilité.
                        </p>

                        <hr class="my-5">

                        <h3 class="fw-bold text-primary mb-4">8. Liens Hypertextes</h3>
                        <p>
                            Le site peut contenir des liens hypertextes vers d'autres sites. OWEW n'exerce
                            aucun contrôle sur ces sites et décline toute responsabilité quant à leur contenu.
                        </p>

                        <hr class="my-5">

                        <h3 class="fw-bold text-primary mb-4">9. Droit Applicable</h3>
                        <p>
                            Les présentes mentions légales sont régies par le droit ivoirien. Tout litige
                            relatif à l'utilisation du site sera soumis aux tribunaux compétents d'Abidjan,
                            Côte d'Ivoire.
                        </p>

                        <hr class="my-5">

                        <h3 class="fw-bold text-primary mb-4">10. Contact</h3>
                        <p>
                            Pour toute question concernant les mentions légales, vous pouvez nous contacter :
                        </p>
                        <ul class="list-unstyled ms-4">
                            <li><i class="fas fa-envelope text-primary me-2"></i> <strong>Email :</strong> legal@owew.org</li>
                            <li><i class="fas fa-phone text-primary me-2"></i> <strong>Téléphone :</strong> +225 XX XX XX XX XX</li>
                            <li><i class="fas fa-map-marker-alt text-primary me-2"></i> <strong>Adresse :</strong> Abidjan, Côte d'Ivoire</li>
                        </ul>

                        <div class="alert alert-info mt-5">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Dernière mise à jour :</strong> 23 Octobre 2025
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
