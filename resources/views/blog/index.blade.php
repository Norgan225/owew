@extends('layouts.base')

@section('title', 'Blog & Actualités - OWEW')

@push('styles')
<style>
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1.5rem rgba(0,0,0,0.15) !important;
    }
    .category-link:hover {
        background: #f8f9fa;
        border-radius: 5px;
        padding-left: 10px;
        transition: all 0.3s ease;
    }
</style>
@endpush

@section('content')

<!-- Hero Section -->
<section class="page-hero" style="background: linear-gradient(135deg, #4B0082, #6a1b9a); padding: 6rem 0 4rem; color: white;">
    <div class="container text-center">
        <h1 class="display-3 fw-bold mb-3" data-aos="fade-up">
            <i class="fas fa-blog me-3"></i>{{ translate('blog_news') ?? (app()->getLocale() == 'en' ? 'Blog & News' : 'Blog & Actualités') }}
        </h1>
        <p class="lead mb-4" data-aos="fade-up" data-aos-delay="100">
            {{ app()->getLocale() == 'en' ? 'Stay informed of our actions, events and impact in the community' : 'Restez informés de nos actions, événements et impact dans la communauté' }}
        </p>
        @if(isset($category))
        <span class="badge bg-white text-primary px-4 py-2 fs-6" data-aos="fade-up" data-aos-delay="200">
            <i class="fas fa-filter me-2"></i>{{ app()->getLocale() == 'en' ? 'Category' : 'Catégorie' }} : {{ localized_field($category, 'name') }}
        </span>
        @endif
    </div>
</section>

<!-- Articles de Blog -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4">
                <!-- Recherche -->
                <div class="card border-0 shadow-sm mb-4 hover-lift">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3"><i class="fas fa-search text-primary me-2"></i>{{ translate('search') }}</h5>
                        <form action="{{ route('blog.index') }}" method="GET">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="{{ translate('search') }}..." value="{{ request('search') }}">
                                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Catégories -->
                <div class="card border-0 shadow-sm mb-4 hover-lift">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3"><i class="fas fa-folder text-primary me-2"></i>{{ translate('categories') }}</h5>
                            @if($categories->count())
                            <ul class="list-unstyled">
                                @foreach($categories as $category)
                                    <li class="mb-2 category-link">
                                        <a href="{{ route('blog.category', $category->slug) }}" class="text-decoration-none text-dark d-flex justify-content-between align-items-center">
                                            <span><i class="fas fa-angle-right text-primary me-2"></i>{{ localized_field($category, 'name') }}</span>
                                            <span class="badge bg-light text-dark">{{ $category->post_count }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            @else
                            <div class="text-muted text-center py-3">
                                <i class="fas fa-folder-open fa-2x mb-2 d-block"></i>
                                {{ app()->getLocale() == 'en' ? 'No category available.' : 'Aucune catégorie disponible.' }}
                            </div>
                            @endif
                        </div>
                </div>

                <!-- Articles Populaires -->
                <div class="card border-0 shadow-sm hover-lift">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3"><i class="fas fa-fire text-danger me-2"></i>{{ translate('popular_posts') }}</h5>
                            @php
                                $popularPosts = $posts->sortByDesc('views_count')->take(3);
                            @endphp
                            @if($popularPosts->count())
                                @foreach($popularPosts as $popular)
                                <div class="d-flex mb-3 pb-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                                    <img src="{{ $popular->featured_image ? asset('storage/' . $popular->featured_image) : 'https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?w=80&h=80&fit=crop' }}"
                                         class="rounded me-3 shadow-sm" style="width: 70px; height: 70px; object-fit: cover;">
                                    <div>
                                        <a href="{{ route('blog.show', $popular->slug) }}" class="text-decoration-none text-dark fw-semibold small d-block mb-1 hover-link">
                                            {{ Str::limit(localized_field($popular, 'title'), 50) }}
                                        </a>
                                        <small class="text-muted d-block">
                                            <i class="far fa-calendar me-1"></i>{{ $popular->published_at ? $popular->published_at->format('d M Y') : '' }}
                                        </small>
                                        <small class="text-muted">
                                            <i class="far fa-eye me-1"></i>{{ $popular->views_count }} {{ translate('views') }}
                                        </small>
                                    </div>
                                </div>
                                @endforeach
                            @else
                            <div class="text-muted text-center py-3">
                                <i class="fas fa-newspaper fa-2x mb-2 d-block"></i>
                                {{ app()->getLocale() == 'en' ? 'No popular article.' : 'Aucun article populaire.' }}
                            </div>
                            @endif
                        </div>
                </div>
            </div>

            <!-- Articles -->
            <div class="col-lg-9">
                @if($posts->count())
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold text-dark mb-0">
                        <i class="fas fa-newspaper text-primary me-2"></i>
                        {{ isset($category) ? (app()->getLocale() == 'en' ? 'Articles in ' : 'Articles dans ') . localized_field($category, 'name') : translate('all_articles') }}
                    </h4>
                    <span class="text-muted">{{ $posts->total() }} {{ app()->getLocale() == 'en' ? 'article(s) found' : 'article(s) trouvé(s)' }}</span>
                </div>
                @endif

                <div class="row g-4">
                        @forelse($posts as $post)
                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 50 }}">
                            <article class="card border-0 shadow-sm h-100 hover-lift">
                                <div class="position-relative">
                                    <img src="{{ $post->featured_image ? asset('storage/' . $post->featured_image) : 'https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?w=500&h=300&fit=crop' }}"
                                         class="card-img-top" alt="{{ localized_field($post, 'title') }}" style="height: 250px; object-fit: cover;">
                                    <span class="badge bg-primary position-absolute top-0 start-0 m-3">
                                        {{ $post->category ? localized_field($post->category, 'name') : (app()->getLocale() == 'en' ? 'News' : 'Actualités') }}
                                    </span>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex gap-3 mb-3 text-muted small">
                                        <span><i class="far fa-calendar me-1"></i>{{ $post->published_at ? $post->published_at->format('d M Y') : '' }}</span>
                                        <span><i class="far fa-eye me-1"></i>{{ $post->views_count }}</span>
                                    </div>
                                    <h5 class="card-title fw-bold mb-3">
                                        <a href="{{ route('blog.show', $post->slug) }}" class="text-decoration-none text-dark stretched-link">
                                            {{ localized_field($post, 'title') }}
                                        </a>
                                    </h5>
                                    <p class="card-text text-muted flex-grow-1">
                                        {{ Str::limit(strip_tags(localized_field($post, 'content')), 120) }}
                                    </p>
                                    <div class="d-flex align-items-center mt-3 pt-3 border-top">
                                        <img src="{{ $post->author && $post->author->profile_image ? asset('storage/' . $post->author->profile_image) : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=40&h=40&fit=crop' }}"
                                             class="rounded-circle me-2" style="width: 35px; height: 35px; object-fit: cover;">
                                        <small class="text-muted">{{ translate('by') }} <strong>{{ $post->author ? $post->author->name : (app()->getLocale() == 'en' ? 'Unknown author' : 'Auteur inconnu') }}</strong></small>
                                    </div>
                                </div>
                            </article>
                        </div>
                        @empty
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body text-center py-5">
                                    <i class="fas fa-newspaper fa-4x text-muted mb-3"></i>
                                    <h5 class="fw-bold text-dark mb-2">{{ translate('no_article_found') }}</h5>
                                    <p class="text-muted mb-4">{{ app()->getLocale() == 'en' ? 'There are no published articles in this section yet.' : 'Il n\'y a pas encore d\'articles publiés dans cette section.' }}</p>
                                    <a href="{{ route('blog.index') }}" class="btn btn-primary">
                                        <i class="fas fa-arrow-left me-2"></i>{{ app()->getLocale() == 'en' ? 'See all articles' : 'Voir tous les articles' }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforelse
                </div>

                <!-- Pagination -->
                @if($posts->hasPages())
                    <nav class="mt-5">
                        {{ $posts->links('vendor.pagination.bootstrap-4') }}
                    </nav>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
