<?php
/**
 * Script temporaire pour créer le lien symbolique du storage
 * À supprimer après utilisation !
 */

$targetFolder = $_SERVER['DOCUMENT_ROOT'].'/../storage/app/public';
$linkFolder = $_SERVER['DOCUMENT_ROOT'].'/storage';

if (file_exists($linkFolder)) {
    echo "Le lien symbolique existe déjà.\n";
} else {
    symlink($targetFolder, $linkFolder);
    echo "Lien symbolique créé avec succès !\n";
}

echo "<br><br>";
echo "Target: " . $targetFolder . "<br>";
echo "Link: " . $linkFolder . "<br>";
echo "<br><strong>N'oubliez pas de supprimer ce fichier après utilisation !</strong>";
?>
