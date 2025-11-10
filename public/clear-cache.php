<?php
/**
 * Script temporaire pour vider tous les caches
 * À supprimer après utilisation !
 */

echo "<h2>Nettoyage des caches Laravel</h2>";

// Change to Laravel root directory
chdir(__DIR__ . '/..');

echo "<h3>1. Cache config</h3>";
passthru('php artisan config:clear');

echo "<h3>2. Cache routes</h3>";
passthru('php artisan route:clear');

echo "<h3>3. Cache views</h3>";
passthru('php artisan view:clear');

echo "<h3>4. Cache général</h3>";
passthru('php artisan cache:clear');

echo "<h3>5. Optimisation</h3>";
passthru('php artisan optimize');

echo "<br><br><strong>✅ Tous les caches ont été vidés !</strong>";
echo "<br><br><strong>⚠️ N'oubliez pas de supprimer ce fichier après utilisation !</strong>";
?>
