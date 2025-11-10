@extends('layouts.base')

@section('title', localized_field($post, 'title') . ' - OWEW')

@push('styles')
<style>
    .article-content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #333;
    }
    .article-content h2, .article-content h3 {
        color: #4B0082;
        margin-top: 2rem;
        margin-bottom: 1rem;
        font-weight: 600;
    }
    .article-content p {
        margin-bottom: 1.5rem;
    }
    .article-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 2rem 0;
    }
    .article-content ul, .article-content ol {
        margin-bottom: 1.5rem;
        padding-left: 2rem;
    }
    .article-content blockquote {
        border-left: 4px solid #4B0082;
        padding-left: 1.5rem;
        margin: 2rem 0;
        font-style: italic;
        color: #666;
    }
    .hero-overlay {
        background: linear-gradient(to bottom, rgba(75, 0, 130, 0.7), rgba(0, 0, 0, 0.8));
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="position-relative" style="min-height: 500px;">
    <img src="{{ $post->featured_image ? asset('storage/' . $post->featured_image) : 'https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?w=1200&h=500&fit=crop' }}"
         alt="{{ localized_field($post, 'title') }}" class="w-100 h-100 position-absolute" style="object-fit: cover;">
    <div class="position-absolute top-0 start-0 w-100 h-100 hero-overlay d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center text-white">
                    <span class="badge bg-light text-primary px-3 py-2 mb-3" data-aos="fade-up">
                        {{ $post->category ? localized_field($post->category, 'name') : (app()->getLocale() == 'en' ? 'News' : 'Actualités') }}
                    </span>
                    <h1 class="display-4 fw-bold mb-4" data-aos="fade-up" data-aos-delay="100">
                        {{ localized_field($post, 'title') }}
                    </h1>
                    <div class="d-flex justify-content-center gap-4 text-white-50" data-aos="fade-up" data-aos-delay="200">
                        <span><i class="far fa-calendar me-2"></i>{{ $post->published_at ? $post->published_at->format('d M Y') : '' }}</span>
                        <span><i class="far fa-eye me-2"></i>{{ $post->views_count }} {{ translate('views') }}</span>
                        <span><i class="far fa-user me-2"></i>{{ $post->author ? $post->author->name : (app()->getLocale() == 'en' ? 'Author' : 'Auteur') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contenu Article -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb bg-white px-3 py-2 rounded shadow-sm">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">{{ translate('home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('blog.index') }}" class="text-decoration-none">Blog</a></li>
                        <li class="breadcrumb-item active">{{ Str::limit(localized_field($post, 'title'), 50) }}</li>
                    </ol>
                </nav>

                <!-- Card Article -->
                <article class="card border-0 shadow-lg rounded-3 overflow-hidden">
                    <div class="card-body p-lg-5 p-4">
                        <!-- Auteur -->
                        <div class="d-flex align-items-center mb-4 pb-4 border-bottom" data-aos="fade-up">
                           <img src="{{ $post->author && $post->author->profile_image ? asset('storage/' . $post->author->profile_image) : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=80&h=80&fit=crop' }}"
                               class="rounded-circle me-3 shadow-sm" style="width: 70px; height: 70px; object-fit: cover;">
                           <div>
                              <div class="fw-bold fs-5 text-dark">{{ $post->author ? $post->author->name : (app()->getLocale() == 'en' ? 'Unknown author' : 'Auteur inconnu') }}</div>
                              <small class="text-muted">{{ $post->author && $post->author->role ? $post->author->role : (app()->getLocale() == 'en' ? 'Writer' : 'Rédacteur') }}</small>
                           </div>
                        </div>

                        <!-- Contenu -->
                        <div class="article-content" data-aos="fade-up">
                                {!! localized_field($post, 'content') !!}
                        </div>

                        <!-- Tags -->
                        @if(isset($post->tags) && is_array($post->tags) && count($post->tags))
                        <div class="mt-5 pt-4 border-top">
                            <h6 class="fw-bold mb-3"><i class="fas fa-tags text-primary me-2"></i>{{ translate('tags') }}</h6>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($post->tags as $tag)
                                    <span class="badge bg-light text-dark border px-3 py-2">{{ $tag }}</span>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Partage -->
                        <div class="mt-4 pt-4 border-top">
                            <h6 class="fw-bold mb-3"><i class="fas fa-share-alt text-primary me-2"></i>{{ translate('share_article') }}</h6>
                            <div class="d-flex gap-2">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $post->slug)) }}" target="_blank" class="btn btn-primary btn-sm">
                                    <i class="fab fa-facebook me-1"></i> Facebook
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('blog.show', $post->slug)) }}&text={{ urlencode(localized_field($post, 'title')) }}" target="_blank" class="btn btn-info btn-sm text-white">
                                    <i class="fab fa-twitter me-1"></i> Twitter
                                </a>
                                <a href="https://wa.me/?text={{ urlencode(localized_field($post, 'title') . ' ' . route('blog.show', $post->slug)) }}" target="_blank" class="btn btn-success btn-sm">
                                    <i class="fab fa-whatsapp me-1"></i> WhatsApp
                                </a>
                            </div>
                        </div>

                        <!-- Auteur Bio -->
                        @if($post->author)
                        <div class="mt-5 pt-4 border-top">
                            <div class="bg-light p-4 rounded-3">
                                <div class="d-flex align-items-start">
                                    <img src="{{ $post->author->profile_image ? asset('storage/' . $post->author->profile_image) : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop' }}"
                                         class="rounded-circle me-4 shadow-sm" style="width: 90px; height: 90px; object-fit: cover;">
                                    <div>
                                        <h6 class="fw-bold mb-2 text-primary"><i class="fas fa-user-circle me-2"></i>{{ translate('about_author') }}</h6>
                                        <p class="mb-2">
                                            <strong class="text-dark fs-5">{{ $post->author->name }}</strong>
                                            @if($post->author->role)
                                                <span class="text-muted">— {{ $post->author->role }}</span>
                                            @endif
                                        </p>
                                        @if($post->author->bio)
                                        <p class="text-muted mb-3">{{ $post->author->bio }}</p>
                                        @endif
                                        <div class="d-flex gap-3">
                                            @if(isset($post->author->linkedin))
                                                <a href="{{ $post->author->linkedin }}" target="_blank" class="text-decoration-none text-primary"><i class="fab fa-linkedin fa-lg"></i></a>
                                            @endif
                                            @if(isset($post->author->twitter))
                                                <a href="{{ $post->author->twitter }}" target="_blank" class="text-decoration-none text-info"><i class="fab fa-twitter fa-lg"></i></a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </article>

                <!-- Articles Similaires -->
                @if($relatedPosts->count())
                <div class="mt-5">
                    <h3 class="fw-bold text-primary mb-4"><i class="fas fa-newspaper me-2"></i>{{ translate('similar_articles') }}</h3>
                    <div class="row g-4">
                        @foreach($relatedPosts as $related)
                        <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                            <div class="card border-0 shadow-sm h-100 hover-lift">
                                <img src="{{ $related->featured_image ? asset('storage/' . $related->featured_image) : 'https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?w=400&h=250&fit=crop' }}"
                                     class="card-img-top" alt="{{ localized_field($related, 'title') }}" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <span class="badge bg-primary mb-2">{{ $related->category ? localized_field($related->category, 'name') : (app()->getLocale() == 'en' ? 'News' : 'Actualités') }}</span>
                                    <h6 class="fw-bold mb-2">
                                        <a href="{{ route('blog.show', $related->slug) }}" class="text-decoration-none text-dark stretched-link">
                                            {{ Str::limit(localized_field($related, 'title'), 60) }}
                                        </a>
                                    </h6>
                                    <p class="text-muted small mb-2">
                                        {{ Str::limit(strip_tags(localized_field($related, 'content')), 80) }}
                                    </p>
                                    <small class="text-muted">
                                        <i class="far fa-calendar me-1"></i>{{ $related->published_at ? $related->published_at->format('d M Y') : '' }}
                                        <i class="far fa-eye ms-3 me-1"></i>{{ $related->views_count }}
                                    </small>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Section Commentaires (Optionnel) -->
                <div class="mt-5">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-5 text-center">
                            <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                            <h5 class="fw-bold text-dark mb-2">{{ translate('comments') }}</h5>
                            <p class="text-muted mb-0">
                                {{ app()->getLocale() == 'en' ? 'The comments section will be available soon. Come back soon to share your opinions!' : 'La section commentaires sera bientôt disponible. Revenez prochainement pour partager vos avis !' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
