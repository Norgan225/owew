# Exemple d'utilisation des Favicons OWEW

## 📋 Instructions étape par étape

### 1. Préparez votre logo
Placez votre logo (PNG transparent recommandé) dans la racine du projet :
```
owew-ngo/
├── votre-logo.png  ← Placez votre logo ici
├── generate-favicons.js
└── ...
```

### 2. Générez tous les favicons
```bash
# Méthode 1: Via npm script
npm run favicons votre-logo.png

# Méthode 2: Directement avec Node.js
node generate-favicons.js votre-logo.png
```

### 3. Vérifiez les fichiers générés
```bash
ls -la public/favicons/
```

Vous devriez voir tous ces fichiers :
- favicon.ico
- favicon-16x16.png
- favicon-32x32.png
- apple-touch-icon.png
- android-chrome-192x192.png
- mstile-144x144.png
- site.webmanifest
- safari-pinned-tab.svg
- og-image.jpg

### 4. Testez dans le navigateur
1. Ouvrez `http://localhost/owew-ngo/public/` dans votre navigateur
2. Vérifiez que le favicon apparaît dans l'onglet
3. Testez sur mobile en ajoutant à l'écran d'accueil

## 🎯 Formats recommandés pour votre logo

### Dimensions minimales
- **Carré** : 512x512 pixels minimum
- **Rectangulaire** : 1024x512 pixels (sera recadré automatiquement)

### Formats supportés
- ✅ PNG avec transparence
- ✅ JPG haute qualité
- ✅ SVG (mais sera converti en PNG)

### Exemples de noms de fichiers
```
logo-owew.png
owew-logo-transparent.png
logo-carré-512x512.png
```

## 🔧 Commandes disponibles

```bash
# Générer les favicons
npm run favicons votre-logo.png

# Construire les assets (CSS/JS)
npm run build

# Mode développement
npm run dev
```

## 📱 Tests sur différents appareils

### Desktop
- **Chrome/Edge** : Vérifiez l'onglet et les favoris
- **Firefox** : Onglet + marque-page
- **Safari** : Onglet + favoris + icône épinglée

### Mobile
- **iOS Safari** : Ajouter à l'écran d'accueil
- **Chrome Android** : Ajouter à l'écran d'accueil (PWA)
- **Samsung Internet** : Favoris et écran d'accueil

## 🚨 Dépannage rapide

### "Commande non trouvée"
```bash
# Assurez-vous que Node.js et npm sont installés
node --version
npm --version

# Réinstallez les dépendances
rm -rf node_modules package-lock.json
npm install
```

### "Erreur Sharp"
```bash
# Problème de compilation native, essayez:
npm rebuild sharp
```

### "Favicons ne s'affichent pas"
1. Videz le cache : `Ctrl+F5`
2. Vérifiez les chemins dans `public/favicons/`
3. Redémarrez le serveur Laravel

## 📚 Ressources supplémentaires

- **Documentation complète** : `FAVICONS-README.md`
- **Validation en ligne** : https://realfavicongenerator.net/favicon_checker
- **Guide PWA** : https://web.dev/progressive-web-apps/

---

**Prêt à optimiser l'identité visuelle d'OWEW sur tous les appareils ! 🎨**
