<?php
/**
 * Script temporaire pour déployer la correction du formulaire Gallery
 * À exécuter UNE FOIS via navigateur : https://votredomaine.com/update-gallery-fix.php
 *
 * ⚠️ SUPPRIMER CE FICHIER après exécution !
 */

// Sécurité : restreindre l'accès
$allowed_ips = ['127.0.0.1', '::1']; // Ajouter votre IP si nécessaire
if (!in_array($_SERVER['REMOTE_ADDR'] ?? '', $allowed_ips) && !isset($_GET['force'])) {
    die('Accès refusé. Ajoutez ?force=1 à l\'URL pour forcer l\'exécution.');
}

echo "<h2>🔧 Mise à jour de la correction Gallery</h2>";
echo "<pre>";

// Chemin vers les fichiers
$basePath = dirname(__DIR__);
$createViewPath = $basePath . '/resources/views/admin/gallery/create.blade.php';

echo "📁 Chemin base: $basePath\n\n";

// 1. Vérifier que le fichier existe
if (!file_exists($createViewPath)) {
    die("❌ ERREUR: Le fichier create.blade.php n'existe pas à: $createViewPath\n");
}

echo "✅ Fichier trouvé: create.blade.php\n\n";

// 2. Lire le contenu actuel
$content = file_get_contents($createViewPath);

echo "📄 Taille du fichier: " . strlen($content) . " octets\n\n";

// 3. Vérifier si le problème existe encore
if (substr_count($content, 'const imageInput = document.getElementById(\'imageInput\')') > 1) {
    echo "⚠️  PROBLÈME DÉTECTÉ: Double déclaration de 'const imageInput'\n\n";

    // Appliquer la correction
    echo "🔄 Application de la correction...\n\n";

    // Correction 1: Drag and drop support
    $content = str_replace(
        "    // Drag and drop support\n    const imageInput = document.getElementById('imageInput');\n    const dropZone = imageInput.closest('.data-table');",
        "    // Drag and drop support (use existing imageInput variable from above)\n    const dropZone = document.getElementById('imageInput').closest('.data-table');",
        $content
    );

    // Correction 2: Dans le drop handler
    $content = str_replace(
        "    dropZone.addEventListener('drop', function(e) {\n        const dt = e.dataTransfer;\n        const files = dt.files;\n        imageInput.files = files;\n\n        // Trigger change event\n        const event = new Event('change', { bubbles: true });\n        imageInput.dispatchEvent(event);",
        "    dropZone.addEventListener('drop', function(e) {\n        const dt = e.dataTransfer;\n        const files = dt.files;\n        const imageInputElement = document.getElementById('imageInput');\n        imageInputElement.files = files;\n\n        // Trigger change event\n        const event = new Event('change', { bubbles: true });\n        imageInputElement.dispatchEvent(event);",
        $content
    );

    // Sauvegarder
    if (file_put_contents($createViewPath, $content)) {
        echo "✅ Correction appliquée avec succès!\n\n";
    } else {
        die("❌ ERREUR: Impossible d'écrire dans le fichier\n");
    }
} else {
    echo "ℹ️  Le fichier semble déjà corrigé (une seule déclaration trouvée)\n\n";
}

// 4. Nettoyer le cache des vues
echo "🗑️  Nettoyage du cache...\n\n";

$commands = [
    'php artisan view:clear',
    'php artisan cache:clear',
    'php artisan config:clear',
];

foreach ($commands as $cmd) {
    echo "Exécution: $cmd\n";
    $output = [];
    $return_var = 0;
    exec("cd $basePath && $cmd 2>&1", $output, $return_var);

    if ($return_var === 0) {
        echo "  ✅ " . implode("\n  ", $output) . "\n";
    } else {
        echo "  ⚠️  " . implode("\n  ", $output) . "\n";
    }
}

echo "\n";
echo "================================================\n";
echo "✅ MISE À JOUR TERMINÉE\n";
echo "================================================\n\n";
echo "📝 Prochaines étapes:\n";
echo "1. Testez la création d'images dans la galerie\n";
echo "2. Si tout fonctionne, SUPPRIMEZ ce fichier: update-gallery-fix.php\n";
echo "3. Si le problème persiste, vérifiez les logs: storage/logs/laravel.log\n\n";

echo "🔍 Pour tester:\n";
echo "   → Allez sur: /admin/gallery/create\n";
echo "   → Sélectionnez des images\n";
echo "   → Cliquez sur 'Ajouter à la Galerie'\n\n";

echo "</pre>";
echo "<p><a href='/admin/gallery' class='btn btn-primary'>Aller à la Galerie</a></p>";
?>
