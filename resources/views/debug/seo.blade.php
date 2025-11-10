{{-- Vue de débogage SEO - Uniquement en développement --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Débogage SEO - OWEW</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .status-badge {
            font-size: 0.8em;
            padding: 4px 8px;
            border-radius: 4px;
        }
        .status-success { background: #d4edda; color: #155724; }
        .status-warning { background: #fff3cd; color: #856404; }
        .status-danger { background: #f8d7da; color: #721c24; }
        .seo-card { transition: all 0.3s ease; }
        .seo-card:hover { transform: translateY(-2px); box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3 mb-0">
                        🔍 Débogage SEO - OWEW
                    </h1>
                    <a href="{{ url('/') }}" class="btn btn-outline-primary">
                        ← Retour au site
                    </a>
                </div>

                {{-- Résumé --}}
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">📊 Résumé des paramètres SEO</h5>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-3">
                                <div class="h4 text-success">{{ $seoSettings->count() }}</div>
                                <small class="text-muted">Paramètres configurés</small>
                            </div>
                            <div class="col-md-3">
                                <div class="h4 text-info">{{ $seoSettings->where('value_fr', '!=', null)->count() }}</div>
                                <small class="text-muted">En français</small>
                            </div>
                            <div class="col-md-3">
                                <div class="h4 text-info">{{ $seoSettings->where('value_en', '!=', null)->count() }}</div>
                                <small class="text-muted">En anglais</small>
                            </div>
                            <div class="col-md-3">
                                <div class="h4 text-warning">{{ 11 - $seoSettings->count() }}</div>
                                <small class="text-muted">Manquants</small>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Liste détaillée --}}
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">📋 Paramètres SEO détaillés</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @php
                                $seoLabels = [
                                    'meta_title' => ['label' => 'Meta Title', 'icon' => 'fas fa-heading', 'desc' => 'Titre dans les résultats Google (50-60 caractères)'],
                                    'meta_description' => ['label' => 'Meta Description', 'icon' => 'fas fa-align-left', 'desc' => 'Description dans les résultats Google (150-160 caractères)'],
                                    'meta_keywords' => ['label' => 'Mots-clés', 'icon' => 'fas fa-tags', 'desc' => 'Mots-clés principaux séparés par des virgules'],
                                    'canonical_url' => ['label' => 'URL Canonique', 'icon' => 'fas fa-link', 'desc' => 'URL principale du site'],
                                    'og_title' => ['label' => 'Open Graph Title', 'icon' => 'fab fa-facebook', 'desc' => 'Titre pour Facebook/LinkedIn'],
                                    'og_description' => ['label' => 'Open Graph Description', 'icon' => 'fab fa-facebook', 'desc' => 'Description pour les réseaux sociaux'],
                                    'og_image' => ['label' => 'Open Graph Image', 'icon' => 'fas fa-image', 'desc' => 'Image pour partage social (1200x630px)'],
                                    'twitter_card_type' => ['label' => 'Twitter Card Type', 'icon' => 'fab fa-twitter', 'desc' => 'Type de carte Twitter'],
                                    'robots_meta' => ['label' => 'Meta Robots', 'icon' => 'fas fa-robot', 'desc' => 'Instructions pour les moteurs de recherche'],
                                    'google_analytics_id' => ['label' => 'Google Analytics', 'icon' => 'fab fa-google', 'desc' => 'ID Google Analytics (GA4)'],
                                    'google_tag_manager_id' => ['label' => 'Google Tag Manager', 'icon' => 'fas fa-code', 'desc' => 'ID Google Tag Manager'],
                                ];
                            @endphp

                            @foreach($seoLabels as $key => $info)
                                @php
                                    $setting = $seoSettings->where('key', $key)->first();
                                    $hasFr = $setting && $setting->value_fr;
                                    $hasEn = $setting && $setting->value_en;
                                @endphp

                                <div class="col-md-6 mb-3">
                                    <div class="card seo-card h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-2">
                                                <i class="{{ $info['icon'] }} me-2 text-primary"></i>
                                                <h6 class="mb-0">{{ $info['label'] }}</h6>
                                                @if($hasFr || $hasEn)
                                                    <span class="status-badge status-success ms-auto">Configuré</span>
                                                @else
                                                    <span class="status-badge status-danger ms-auto">Manquant</span>
                                                @endif
                                            </div>

                                            <p class="text-muted small mb-3">{{ $info['desc'] }}</p>

                                            @if($setting)
                                                <div class="mb-2">
                                                    <strong class="text-success">🇫🇷 FR:</strong>
                                                    @if($setting->value_fr)
                                                        <code class="ms-1">{{ Str::limit($setting->value_fr, 50) }}</code>
                                                    @else
                                                        <em class="text-muted">Non défini</em>
                                                    @endif
                                                </div>

                                                <div class="mb-2">
                                                    <strong class="text-info">🇬🇧 EN:</strong>
                                                    @if($setting->value_en)
                                                        <code class="ms-1">{{ Str::limit($setting->value_en, 50) }}</code>
                                                    @else
                                                        <em class="text-muted">Non défini</em>
                                                    @endif
                                                </div>

                                                <small class="text-muted">
                                                    Modifié: {{ $setting->updated_at->diffForHumans() }}
                                                </small>
                                            @else
                                                <div class="text-center py-3">
                                                    <em class="text-muted">Paramètre non configuré</em>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="card mt-4">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">🛠️ Actions disponibles</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Interface d'administration</h6>
                                <a href="{{ route('admin.settings.index') }}" class="btn btn-primary btn-sm" target="_blank">
                                    📝 Modifier les paramètres SEO
                                </a>
                            </div>
                            <div class="col-md-6">
                                <h6>Console</h6>
                                <code class="d-block mb-2">php artisan seo:check</code>
                                <code class="d-block">php artisan seo:check --locale=en</code>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Vérification des favicons --}}
                <div class="card mt-4">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0">🎨 État des favicons</h5>
                    </div>
                    <div class="card-body">
                        @php
                            $faviconFiles = [
                                'favicon.ico' => 'Favicon principal',
                                'favicons/favicon-32x32.png' => 'Favicon 32x32',
                                'favicons/apple-touch-icon.png' => 'Apple Touch Icon',
                                'favicons/site.webmanifest' => 'Web App Manifest',
                                'favicons/safari-pinned-tab.svg' => 'Safari Pinned Tab',
                                'favicons/og-image.jpg' => 'Open Graph Image'
                            ];
                        @endphp

                        <div class="row">
                            @foreach($faviconFiles as $file => $label)
                                <div class="col-md-4 mb-2">
                                    @if(file_exists(public_path($file)))
                                        <span class="badge bg-success">✅ {{ $label }}</span>
                                    @else
                                        <span class="badge bg-danger">❌ {{ $label }}</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        @if(!file_exists(public_path('favicons/favicon.ico')))
                            <div class="alert alert-warning mt-3">
                                <strong>Attention:</strong> Les favicons n'ont pas encore été générés.
                                Consultez <code>FAVICONS-EXEMPLE.md</code> pour les instructions.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
