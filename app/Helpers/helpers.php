<?php

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;

if (!function_exists('setting')) {
    /**
     * Récupérer une valeur de paramètre du site
     *
     * @param string $key Clé du paramètre
     * @param string $default Valeur par défaut
     * @param string $locale Langue (fr ou en)
     * @return string
     */
    function setting($key, $default = '', $locale = 'fr')
    {
        try {
            // Cache les settings pour 1 heure
            $settings = Cache::remember('all_site_settings', 3600, function () {
                return SiteSetting::all();
            });

            $setting = $settings->where('key', $key)->first();

            if (!$setting) {
                return $default;
            }

            $column = 'value_' . $locale;
            return $setting->$column ?? $setting->value_fr ?? $default;
        } catch (\Exception $e) {
            return $default;
        }
    }
}

if (!function_exists('clear_settings_cache')) {
    /**
     * Vider le cache des paramètres
     */
    function clear_settings_cache()
    {
        Cache::forget('all_site_settings');
        Cache::forget('site_settings');

        // Supprimer tous les caches de groupes
        $groups = ['general', 'contact', 'social', 'seo', 'email', 'appearance', 'advanced'];
        foreach ($groups as $group) {
            Cache::forget("site_settings_group_{$group}");
        }
    }
}

if (!function_exists('localized_field')) {
    /**
     * Récupérer un champ localisé d'un modèle
     *
     * @param object $model Le modèle
     * @param string $field Le nom du champ (sans suffixe _fr ou _en)
     * @param string|null $locale La langue (null = langue actuelle)
     * @return string
     */
    function localized_field($model, $field, $locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        $fieldName = $field . '_' . $locale;

        // Si le champ localisé existe, le retourner
        if (isset($model->$fieldName) && !empty($model->$fieldName)) {
            return $model->$fieldName;
        }

        // Fallback sur français si champ anglais vide
        $fallbackField = $field . '_fr';
        return $model->$fallbackField ?? '';
    }
}

if (!function_exists('translate')) {
    /**
     * Traduction simple pour les textes statiques
     *
     * @param string $key Clé de traduction
     * @return string
     */
    function translate($key)
    {
        $translations = [
            'home' => ['fr' => 'Accueil', 'en' => 'Home'],
            'about' => ['fr' => 'À Propos', 'en' => 'About'],
            'projects' => ['fr' => 'Nos Projets', 'en' => 'Our Projects'],
            'gallery' => ['fr' => 'Galerie', 'en' => 'Gallery'],
            'contact' => ['fr' => 'Contact', 'en' => 'Contact'],
            'donate' => ['fr' => 'Faire un Don', 'en' => 'Donate'],
            'read_more' => ['fr' => 'Lire plus', 'en' => 'Read more'],
            'views' => ['fr' => 'vues', 'en' => 'views'],
            'by' => ['fr' => 'Par', 'en' => 'By'],
            'search' => ['fr' => 'Rechercher', 'en' => 'Search'],
            'categories' => ['fr' => 'Catégories', 'en' => 'Categories'],
            'popular_posts' => ['fr' => 'Articles Populaires', 'en' => 'Popular Posts'],
            'all_articles' => ['fr' => 'Tous les articles', 'en' => 'All articles'],
            'no_article_found' => ['fr' => 'Aucun article trouvé', 'en' => 'No article found'],
            'similar_articles' => ['fr' => 'Articles Similaires', 'en' => 'Similar Articles'],
            'share_article' => ['fr' => 'Partager cet article', 'en' => 'Share this article'],
            'about_author' => ['fr' => 'À propos de l\'auteur', 'en' => 'About the author'],
            'tags' => ['fr' => 'Tags', 'en' => 'Tags'],
            'comments' => ['fr' => 'Commentaires', 'en' => 'Comments'],
        ];

        $locale = app()->getLocale();
        return $translations[$key][$locale] ?? $key;
    }
}
