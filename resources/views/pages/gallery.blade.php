@extends('layouts.base')

@section('title', 'Gallerie - OWEW')


@section('content')
<!-- Hero Section -->
<section class="page-hero" style="background: linear-gradient(135deg, #4B0082, #6a1b9a); padding: 6rem 0 4rem; color: white;">
    <div class="container text-center">
        <h1 class="display-3 fw-bold mb-3" data-aos="fade-up">{{ app()->getLocale() == 'en' ? 'Photo Gallery' : 'Galerie Photos' }}</h1>
        <p class="lead" data-aos="fade-up" data-aos-delay="100">{{ app()->getLocale() == 'en' ? 'Discover our actions in images' : 'Découvrez nos actions en images' }}</p>
    </div>
</section>

<!-- Filtres Galerie -->
<section class="py-4 bg-light">
    <div class="container">
        <div class="d-flex flex-wrap gap-2 justify-content-center">
            <a href="{{ route('gallery') }}"
               class="btn {{ !request('category') ? 'btn-primary' : 'btn-outline-primary' }} filter-btn">
                {{ app()->getLocale() == 'en' ? 'All' : 'Toutes' }}
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('gallery', ['category' => $cat->slug]) }}"
                   class="btn {{ request('category') == $cat->slug ? 'btn-primary' : 'btn-outline-primary' }} filter-btn">
                    {{ localized_field($cat, 'name') }}
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Galerie -->
<section class="py-5">
    <div class="container">
        @if($albums->count() > 0)
            <div class="row g-4">
                @foreach($albums as $index => $album)
                <div class="col-lg-3 col-md-4 col-sm-6 gallery-item" data-aos="fade-up" data-aos-delay="{{ $index * 50 }}" data-category="{{ $album['category'] }}">
                    <div class="card border-0 shadow-sm overflow-hidden">
                        <div class="position-relative overflow-hidden gallery-image-wrapper">
                            @php
                                $thumbnailSrc = $album['thumbnail']
                                    ? asset('storage/' . $album['thumbnail'])
                                    : ($album['main_image'] ? asset('storage/' . $album['main_image']) : asset('images/video-placeholder.jpg'));
                                $albumTitle = app()->getLocale() == 'en' ? $album['title_en'] : $album['title_fr'];
                                $albumDesc = app()->getLocale() == 'en' ? $album['description_en'] : $album['description_fr'];
                            @endphp
                            <img src="{{ $thumbnailSrc }}"
                                 class="card-img-top"
                                 alt="{{ $albumTitle }}"
                                 style="height: 250px; object-fit: cover; cursor: pointer; transition: transform 0.3s ease;"
                                 onclick='openLightbox(@json($album["items"]), "{{ $albumTitle }}", "{{ $albumDesc }}")'>

                            <!-- Overlay vidéo si c'est une vidéo -->
                            @if($album['media_type'] === 'video' || $album['has_video'])
                                <div class="position-absolute top-50 start-50 translate-middle">
                                    <div class="bg-dark bg-opacity-75 rounded-circle p-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-play text-white" style="font-size: 24px; margin-left: 3px;"></i>
                                    </div>
                                </div>
                            @endif

                            <div class="position-absolute bottom-0 start-0 w-100 p-3 text-white"
                                 style="background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);">
                                <h6 class="mb-0 fw-bold">{{ $albumTitle }}</h6>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small><i class="far fa-calendar me-1"></i>{{ \Carbon\Carbon::parse($album['created_at'])->format('d M Y') }}</small>
                                    @if($album['count'] > 1)
                                        <span class="badge bg-primary">
                                            <i class="fas {{ $album['has_video'] ? 'fa-photo-video' : 'fa-images' }} me-1"></i>{{ $album['count'] }}
                                        </span>
                                    @elseif($album['media_type'] === 'video')
                                        <span class="badge bg-danger">
                                            <i class="fas fa-video me-1"></i>{{ app()->getLocale() == 'en' ? 'Video' : 'Vidéo' }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <nav class="mt-5" data-aos="fade-up">
                {{ $albums->links() }}
            </nav>
        @else
            <div class="text-center py-5">
                <i class="fas fa-images fa-4x text-muted mb-3"></i>
                <h3 class="text-muted">{{ app()->getLocale() == 'en' ? 'No images available' : 'Aucune image disponible' }}</h3>
                <p class="text-muted">{{ app()->getLocale() == 'en' ? 'Gallery images will be available soon.' : 'Les images de la galerie seront bientôt disponibles.' }}</p>
            </div>
        @endif
    </div>
</section>

<!-- Lightbox Modal avec Carrousel -->
<div class="modal fade" id="lightboxModal" tabindex="-1" aria-labelledby="lightboxModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content bg-dark">
            <div class="modal-header border-0">
                <h5 class="modal-title text-white" id="lightboxModalLabel"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-0">
                <!-- Carrousel -->
                <div id="lightboxCarousel" class="carousel slide" data-bs-ride="false">
                    <div class="carousel-inner" id="carouselInner">
                        <!-- Les images seront insérées ici dynamiquement -->
                    </div>

                    <!-- Contrôles du carrousel -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#lightboxCarousel" data-bs-slide="prev" id="prevBtn" style="display:none;">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">{{ app()->getLocale() == 'en' ? 'Previous' : 'Précédent' }}</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#lightboxCarousel" data-bs-slide="next" id="nextBtn" style="display:none;">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">{{ app()->getLocale() == 'en' ? 'Next' : 'Suivant' }}</span>
                    </button>

                    <!-- Indicateurs -->
                    <div class="carousel-indicators" id="carouselIndicators" style="display:none;">
                        <!-- Les indicateurs seront insérés ici -->
                    </div>
                </div>

                <!-- Description -->
                <div class="p-4">
                    <p id="lightboxDescription" class="text-white mb-0"></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .gallery-image-wrapper:hover img {
        transform: scale(1.05);
    }

    .filter-btn {
        transition: all 0.3s ease;
    }

    .filter-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .carousel-item img {
        max-height: 70vh;
        width: auto;
        margin: 0 auto;
    }

    .carousel-control-prev,
    .carousel-control-next {
        width: 10%;
    }

    .carousel-indicators {
        margin-bottom: 0;
        padding: 1rem 0;
    }
</style>
@endpush

@push('scripts')
<script>
    function getYouTubeEmbedUrl(url) {
        const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
        const match = url.match(regExp);
        return (match && match[2].length === 11) ? `https://www.youtube.com/embed/${match[2]}` : url;
    }

    function getVimeoEmbedUrl(url) {
        const regExp = /vimeo\.com\/(\d+)/;
        const match = url.match(regExp);
        return match ? `https://player.vimeo.com/video/${match[1]}` : url;
    }

    function getEmbedUrl(url) {
        if (url.includes('youtube.com') || url.includes('youtu.be')) {
            return getYouTubeEmbedUrl(url);
        } else if (url.includes('vimeo.com')) {
            return getVimeoEmbedUrl(url);
        }
        return url;
    }

    function openLightbox(items, title, description) {
        // Mettre à jour le titre et la description
        document.getElementById('lightboxModalLabel').textContent = title;
        document.getElementById('lightboxDescription').textContent = description || '';

        // Conteneur du carrousel
        const carouselInner = document.getElementById('carouselInner');
        const carouselIndicators = document.getElementById('carouselIndicators');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');

        // Réinitialiser le contenu
        carouselInner.innerHTML = '';
        carouselIndicators.innerHTML = '';

        // Si plusieurs items, afficher les contrôles et indicateurs
        if (items.length > 1) {
            prevBtn.style.display = 'flex';
            nextBtn.style.display = 'flex';
            carouselIndicators.style.display = 'flex';
        } else {
            prevBtn.style.display = 'none';
            nextBtn.style.display = 'none';
            carouselIndicators.style.display = 'none';
        }

        // Ajouter les items au carrousel
        items.forEach((item, index) => {
            // Item du carrousel
            const carouselItem = document.createElement('div');
            carouselItem.className = 'carousel-item' + (index === 0 ? ' active' : '');

            if (item.media_type === 'video' && item.video_url) {
                // Vidéo
                const embedUrl = getEmbedUrl(item.video_url);
                carouselItem.innerHTML = `
                    <div class="ratio ratio-16x9" style="max-width: 900px; margin: 0 auto;">
                        <iframe src="${embedUrl}"
                                title="${title} - Vidéo ${index + 1}"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                        </iframe>
                    </div>
                `;
            } else {
                // Image
                carouselItem.innerHTML = `
                    <img src="/storage/${item.image_path}"
                         class="d-block img-fluid"
                         alt="${title} - Image ${index + 1}">
                `;
            }
            carouselInner.appendChild(carouselItem);

            // Indicateur
            if (items.length > 1) {
                const indicator = document.createElement('button');
                indicator.type = 'button';
                indicator.setAttribute('data-bs-target', '#lightboxCarousel');
                indicator.setAttribute('data-bs-slide-to', index);
                if (index === 0) indicator.className = 'active';
                indicator.setAttribute('aria-current', index === 0 ? 'true' : 'false');
                indicator.setAttribute('aria-label', `Média ${index + 1}`);
                carouselIndicators.appendChild(indicator);
            }
        });

        // Ouvrir le modal
        const lightboxModal = new bootstrap.Modal(document.getElementById('lightboxModal'));
        lightboxModal.show();
    }
</script>
@endpush
