# Guide de déploiement SEO - OWEW

## 🚀 Comment déployer votre SEO en production

### **Méthode 1 : Via le fichier .env (RECOMMANDÉ)**

Cette méthode vous permet de **modifier le SEO sans toucher au code**.

#### Étape 1 : Ajoutez au fichier `.env` en production
```bash
# Connectez-vous à votre serveur en production
ssh user@votre-serveur.com

# Éditez le fichier .env
nano /chemin/vers/votre/projet/.env

# Ajoutez ces lignes à la fin du fichier :
SEO_TITLE="OWEW - Organisation pour les Veuves et les Orphelins | ONG Humanitaire"
SEO_DESCRIPTION="OWEW est une ONG dédiée à l'aide aux veuves, orphelins et personnes vulnérables."
SEO_KEYWORDS="ONG, humanitaire, veuves, orphelins, aide sociale, Côte d'Ivoire"
SEO_CANONICAL_URL="https://www.votredomaine.com"
SEO_OG_TITLE="OWEW - Ensemble pour un Avenir Meilleur"
SEO_OG_DESCRIPTION="Rejoignez notre mission humanitaire."
SEO_OG_IMAGE="https://www.votredomaine.com/images/og-image.jpg"
GOOGLE_ANALYTICS_ID="G-XXXXXXXXXX"
```

#### Étape 2 : Videz le cache
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

### **Méthode 2 : Via Git (pour fichiers modifiés)**

Si vous avez modifié `config/app.php` :

```bash
# Sur votre machine locale
git add config/app.php
git add resources/views/layouts/base.blade.php
git commit -m "Ajout configuration SEO"
git push origin main

# Sur le serveur
cd /chemin/vers/votre/projet
git pull origin main
php artisan config:clear
php artisan cache:clear
```

### **Méthode 3 : Via cPanel / FTP (Plus simple)**

Si vous utilisez un hébergement web classique :

1. **Téléchargez le fichier `.env` du serveur**
2. **Ouvrez-le avec un éditeur de texte**
3. **Ajoutez les variables SEO** (voir `.env.seo.example`)
4. **Rechargez le fichier sur le serveur**
5. **Videz le cache** via un script PHP :

Créez un fichier `clear-cache.php` dans `public/` :
```php
<?php
// À supprimer après utilisation !
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->call('config:clear');
$kernel->call('cache:clear');
echo "Cache vidé avec succès !";
```

Accédez à : `https://votredomaine.com/clear-cache.php`

## 📋 Variables disponibles

| Variable | Description | Exemple |
|----------|-------------|---------|
| `SEO_TITLE` | Titre principal du site | "OWEW - ONG Humanitaire" |
| `SEO_DESCRIPTION` | Description meta (150-160 car) | "ONG dédiée aux veuves..." |
| `SEO_KEYWORDS` | Mots-clés séparés par virgules | "ONG, humanitaire, veuves" |
| `SEO_CANONICAL_URL` | URL principale du site | "https://www.owew.org" |
| `SEO_OG_TITLE` | Titre Facebook/LinkedIn | "OWEW - Ensemble..." |
| `SEO_OG_DESCRIPTION` | Description réseaux sociaux | "Rejoignez notre mission" |
| `SEO_OG_IMAGE` | Image partage (1200x630px) | "https://.../og-image.jpg" |
| `GOOGLE_ANALYTICS_ID` | ID Google Analytics | "G-XXXXXXXXXX" |

## 🎯 Valeurs par défaut

Si vous **ne mettez rien dans le `.env`**, le système utilise les valeurs par défaut définies dans `config/app.php`.

Cela signifie que **ça fonctionne immédiatement** sans configuration !

## ✅ Vérification

Pour vérifier que votre SEO est bien configuré :

```bash
# Via console
php artisan seo:check

# Via navigateur (dev seulement)
http://localhost/debug-seo
```

## 🔧 Cas d'usage

### Développement local
```env
# Pas besoin de configuration, les valeurs par défaut suffisent
```

### Staging/Test
```env
SEO_ROBOTS="noindex, nofollow"
SEO_CANONICAL_URL="https://test.owew.org"
```

### Production
```env
SEO_ROBOTS="index, follow"
SEO_CANONICAL_URL="https://www.owew.org"
GOOGLE_ANALYTICS_ID="G-XXXXXXXXXX"
```

## 📦 Fichiers à déployer

Si vous utilisez Git, assurez-vous que ces fichiers sont **committés** :
- ✅ `config/app.php` (nouvelles configurations SEO)
- ✅ `resources/views/layouts/base.blade.php` (meta tags)
- ✅ `resources/views/partials/favicons.blade.php` (favicons)
- ❌ `.env` (ne JAMAIS commiter, configurer sur le serveur)

## 🚨 Important

1. **`.env` ne doit JAMAIS être dans Git** (il est dans `.gitignore`)
2. **Chaque serveur a son propre `.env`** (dev, staging, production)
3. **Videz toujours le cache** après modification du `.env`

## 💡 Astuce

Pour faciliter le déploiement, créez un script `deploy.sh` :

```bash
#!/bin/bash
git pull origin main
composer install --no-dev --optimize-autoloader
php artisan config:clear
php artisan cache:clear
php artisan view:clear
echo "Déploiement terminé !"
```

---

**Support** : Si vous avez des questions, consultez `README.md` ou contactez l'équipe technique.
