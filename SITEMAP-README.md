# Sitemap OWEW - Guide d'utilisation

## 📋 Vue d'ensemble

Le système de sitemap a été configuré pour optimiser l'indexation de votre site OWEW par les moteurs de recherche.

## 🚀 Fonctionnalités

- **Génération automatique** : Sitemap XML généré automatiquement
- **Contenu dynamique** : Inclut toutes les pages statiques et dynamiques
- **Mise à jour planifiée** : Régénération quotidienne automatique
- **SEO optimisé** : Priorités et fréquences de changement configurées

## 📄 Pages incluses dans le sitemap

### Pages statiques (priorité haute)
- `/` - Page d'accueil (priorité 1.0, mise à jour quotidienne)
- `/about` - À propos (priorité 0.8, mise à jour mensuelle)
- `/projects` - Projets (priorité 0.9, mise à jour hebdomadaire)
- `/blog` - Blog (priorité 0.8, mise à jour quotidienne)
- `/gallery` - Galerie (priorité 0.7, mise à jour hebdomadaire)
- `/testimonials` - Témoignages (priorité 0.6, mise à jour mensuelle)
- `/contact` - Contact (priorité 0.8, mise à jour mensuelle)
- `/donate` - Faire un don (priorité 0.9, mise à jour mensuelle)

### Contenu dynamique
- **Projets actifs** : `/projects/{slug}` (priorité 0.8)
- **Articles publiés** : `/blog/{slug}` (priorité 0.7)
- **Catégories** : `/blog/category/{slug}` (priorité 0.6)
- **Témoignages publiés** : `/testimonials/{id}` (priorité 0.5)
- **Galeries publiées** : `/gallery/{id}` (priorité 0.6)

## 🛠️ Commandes disponibles

### Générer le sitemap manuellement
```bash
php artisan sitemap:generate
```

### Voir toutes les commandes disponibles
```bash
php artisan list
```

## ⏰ Tâches planifiées

Le sitemap est automatiquement régénéré **tous les jours** grâce au scheduler Laravel.

Pour activer les tâches planifiées en production :
```bash
# Ajouter cette ligne au crontab du serveur
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

## 🌐 Accès au sitemap

### Depuis le navigateur
- URL : `https://votredomaine.com/sitemap.xml`
- Format : XML standard pour les moteurs de recherche

### Depuis Google Search Console
1. Allez dans "Sitemaps" → "Ajouter un sitemap"
2. Entrez : `sitemap.xml`
3. Cliquez sur "Soumettre"

## 📊 Structure du fichier XML

```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>https://votredomaine.com/</loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <!-- Autres URLs -->
</urlset>
```

## 🔧 Personnalisation

### Modifier les priorités/fréquences
Éditez le fichier `app/Console/Commands/GenerateSitemap.php` :
```php
// Exemple : modifier la priorité de la page d'accueil
$sitemap->add(Url::create('/')->setPriority(1.0)->setChangeFrequency('daily'));
```

### Ajouter de nouvelles pages
Ajoutez-les dans la section "Pages statiques" de la commande.

### Conditions personnalisées
Modifiez les requêtes Eloquent selon vos besoins :
```php
$projects = Project::where('status', 'active')
    ->where('featured', true)  // Uniquement les projets featured
    ->get();
```

## 📈 Bénéfices SEO

- **Indexation améliorée** : Google découvre plus facilement vos pages
- **Mise à jour régulière** : Contenu frais signalé aux moteurs de recherche
- **Priorisation intelligente** : Pages importantes mises en avant
- **Suivi des performances** : Monitoring via Google Search Console

## 🔍 Dépannage

### Sitemap non accessible
- Vérifiez que le fichier `public/sitemap.xml` existe
- Vérifiez les permissions du fichier

### Erreur lors de la génération
- Vérifiez les logs Laravel : `storage/logs/laravel.log`
- Assurez-vous que la base de données est accessible

### Contenu manquant
- Vérifiez que les modèles ont le bon statut (`status`, `is_published`)
- Régénérez manuellement : `php artisan sitemap:generate`

## 📞 Support

En cas de problème, vérifiez :
1. Les logs d'erreurs Laravel
2. La structure de la base de données
3. Les permissions des fichiers
4. La configuration du domaine dans le sitemap

---

**OWEW** - Système de sitemap optimisé pour le référencement
