@extends('layouts.base')

@section('title', app()->getLocale() == 'en' ? 'Our Mission - OWEW' : 'Nos missions - OWEW')


@section('content')

<!-- Hero Section -->
<section class="page-hero" style="background: linear-gradient(135deg, #4B0082, #6a1b9a); padding: 6rem 0 4rem; color: white;">
    <div class="container text-center">
        <h1 class="display-3 fw-bold mb-3" data-aos="fade-up">{{ app()->getLocale() == 'en' ? 'Our Mission' : 'Notre Mission' }}</h1>
        <p class="lead" data-aos="fade-up" data-aos-delay="100">{{ app()->getLocale() == 'en' ? 'A commitment to serve the most vulnerable' : 'Un engagement au service des plus vulnérables' }}</p>
        <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
            <ol class="breadcrumb justify-content-center" style="background: transparent;">
                <li class="breadcrumb-item"><a href="/" style="color: #FF9800;">{{ app()->getLocale() == 'en' ? 'Home' : 'Accueil' }}</a></li>
                <li class="breadcrumb-item active text-white">{{ app()->getLocale() == 'en' ? 'Our Mission' : 'Notre Mission' }}</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Mission Statement -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="text-center mb-5" data-aos="fade-up">
                    <h2 class="display-5 fw-bold text-primary mb-4">{{ app()->getLocale() == 'en' ? 'Our Reason for Being' : 'Notre Raison d\'Être' }}</h2>
                    <p class="lead text-muted">
                        {{ app()->getLocale() == 'en' ? 'OWEW is committed to sustainably improving the living conditions of widows, orphans, the elderly and all those in need, by providing them with holistic and dignified support.' : 'OWEW s\'engage à améliorer durablement les conditions de vie des veuves, des orphelins, des personnes âgées et de tous ceux qui sont dans le besoin, en leur offrant un soutien holistique et digne.' }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Nos Piliers -->
        <div class="row g-4 mb-5">
            <div class="col-md-4" data-aos="fade-up">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-5 text-center">
                        <div class="mb-4">
                            <i class="fas fa-graduation-cap fa-4x text-primary"></i>
                        </div>
                        <h4 class="fw-bold mb-3">{{ app()->getLocale() == 'en' ? 'Education' : 'Éducation' }}</h4>
                        <p class="text-muted">
                            {{ app()->getLocale() == 'en' ? 'Provide equitable access to quality education for all children, particularly orphans and children from vulnerable families.' : 'Offrir un accès équitable à une éducation de qualité pour tous les enfants, en particulier les orphelins et les enfants de familles vulnérables.' }}
                        </p>
                        <ul class="list-unstyled text-start mt-4">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>{{ app()->getLocale() == 'en' ? 'School fees' : 'Frais de scolarité' }}</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>{{ app()->getLocale() == 'en' ? 'School supplies' : 'Fournitures scolaires' }}</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>{{ app()->getLocale() == 'en' ? 'Academic support' : 'Soutien scolaire' }}</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>{{ app()->getLocale() == 'en' ? 'Scholarships' : 'Bourses d\'études' }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-5 text-center">
                        <div class="mb-4">
                            <i class="fas fa-heartbeat fa-4x text-danger"></i>
                        </div>
                        <h4 class="fw-bold mb-3">{{ app()->getLocale() == 'en' ? 'Health' : 'Santé' }}</h4>
                        <p class="text-muted">
                            {{ app()->getLocale() == 'en' ? 'Ensure access to essential medical care and promote the physical and mental well-being of our beneficiaries.' : 'Garantir l\'accès aux soins médicaux essentiels et promouvoir le bien-être physique et mental de nos bénéficiaires.' }}
                        </p>
                        <ul class="list-unstyled text-start mt-4">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>{{ app()->getLocale() == 'en' ? 'Free consultations' : 'Consultations gratuites' }}</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>{{ app()->getLocale() == 'en' ? 'Medications' : 'Médicaments' }}</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>{{ app()->getLocale() == 'en' ? 'Prevention campaigns' : 'Campagnes de prévention' }}</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>{{ app()->getLocale() == 'en' ? 'Psychological support' : 'Soutien psychologique' }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-5 text-center">
                        <div class="mb-4">
                            <i class="fas fa-hands-helping fa-4x text-warning"></i>
                        </div>
                        <h4 class="fw-bold mb-3">{{ app()->getLocale() == 'en' ? 'Empowerment' : 'Autonomisation' }}</h4>
                        <p class="text-muted">
                            {{ app()->getLocale() == 'en' ? 'Develop the skills and capacities of beneficiaries to enable them to become autonomous and actors in their own development.' : 'Développer les compétences et capacités des bénéficiaires pour leur permettre de devenir autonomes et acteurs de leur propre développement.' }}
                        </p>
                        <ul class="list-unstyled text-start mt-4">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>{{ app()->getLocale() == 'en' ? 'Professional training' : 'Formations professionnelles' }}</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>{{ app()->getLocale() == 'en' ? 'Microcredits' : 'Microcrédits' }}</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>{{ app()->getLocale() == 'en' ? 'Entrepreneurial support' : 'Accompagnement entrepreneurial' }}</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>{{ app()->getLocale() == 'en' ? 'Income-generating activities' : 'Création d\'activités génératrices de revenus' }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Nos Objectifs -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold text-primary mb-3">{{ app()->getLocale() == 'en' ? 'Our Long-Term Objectives' : 'Nos Objectifs à Long Terme' }}</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-6" data-aos="fade-right">
                <div class="d-flex align-items-start mb-4">
                    <div class="flex-shrink-0">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                             style="width: 60px; height: 60px; font-size: 1.5rem; font-weight: bold;">1</div>
                    </div>
                    <div class="flex-grow-1 ms-4">
                        <h5 class="fw-bold">{{ app()->getLocale() == 'en' ? 'Reduce Poverty' : 'Réduire la Pauvreté' }}</h5>
                        <p class="text-muted mb-0">
                            {{ app()->getLocale() == 'en' ? 'Contribute to poverty reduction in our intervention communities by offering sustainable solutions.' : 'Contribuer à la réduction de la pauvreté dans nos communautés d\'intervention en offrant des solutions durables.' }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6" data-aos="fade-left">
                <div class="d-flex align-items-start mb-4">
                    <div class="flex-shrink-0">
                        <div class="rounded-circle bg-warning text-white d-flex align-items-center justify-content-center"
                             style="width: 60px; height: 60px; font-size: 1.5rem; font-weight: bold;">2</div>
                    </div>
                    <div class="flex-grow-1 ms-4">
                        <h5 class="fw-bold">{{ app()->getLocale() == 'en' ? 'Protect Rights' : 'Protéger les Droits' }}</h5>
                        <p class="text-muted mb-0">
                            {{ app()->getLocale() == 'en' ? 'Defend and protect the fundamental rights of vulnerable people, particularly widows and orphans.' : 'Défendre et protéger les droits fondamentaux des personnes vulnérables, en particulier des veuves et des orphelins.' }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6" data-aos="fade-right">
                <div class="d-flex align-items-start mb-4">
                    <div class="flex-shrink-0">
                        <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center"
                             style="width: 60px; height: 60px; font-size: 1.5rem; font-weight: bold;">3</div>
                    </div>
                    <div class="flex-grow-1 ms-4">
                        <h5 class="fw-bold">{{ app()->getLocale() == 'en' ? 'Strengthen Communities' : 'Renforcer les Communautés' }}</h5>
                        <p class="text-muted mb-0">
                            {{ app()->getLocale() == 'en' ? 'Create solid and resilient communities where everyone can flourish with dignity and respect.' : 'Créer des communautés solidaires et résilientes où chacun peut s\'épanouir dans la dignité et le respect.' }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6" data-aos="fade-left">
                <div class="d-flex align-items-start mb-4">
                    <div class="flex-shrink-0">
                        <div class="rounded-circle bg-danger text-white d-flex align-items-center justify-content-center"
                             style="width: 60px; height: 60px; font-size: 1.5rem; font-weight: bold;">4</div>
                    </div>
                    <div class="flex-grow-1 ms-4">
                        <h5 class="fw-bold">{{ app()->getLocale() == 'en' ? 'Sustainable Impact' : 'Impact Durable' }}</h5>
                        <p class="text-muted mb-0">
                            {{ app()->getLocale() == 'en' ? 'Implement projects with lasting impact that truly and sustainably transform living conditions.' : 'Mettre en œuvre des projets à impact durable qui transforment réellement et durablement les conditions de vie.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-5">
    <div class="container">
        <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #4B0082, #6a1b9a);">
            <div class="card-body p-5 text-center text-white">
                <h3 class="fw-bold mb-3">{{ app()->getLocale() == 'en' ? 'Join Our Mission' : 'Rejoignez Notre Mission' }}</h3>
                <p class="lead mb-4">
                    {{ app()->getLocale() == 'en' ? 'Together, we can make a difference and bring hope to those who need it most.' : 'Ensemble, nous pouvons faire la différence et apporter de l\'espoir à ceux qui en ont le plus besoin.' }}
                </p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="/faire-un-don" class="btn btn-warning btn-lg px-5">
                        <i class="fas fa-heart me-2"></i>{{ app()->getLocale() == 'en' ? 'Make a Donation' : 'Faire un Don' }}
                    </a>
                    <a href="/devenir-benevole" class="btn btn-outline-light btn-lg px-5">
                        <i class="fas fa-hands-helping me-2"></i>{{ app()->getLocale() == 'en' ? 'Become a Volunteer' : 'Devenir Bénévole' }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
