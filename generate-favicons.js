#!/usr/bin/env node

/**
 * Script de génération automatique des favicons pour OWEW
 * Utilise Sharp pour le redimensionnement des images
 *
 * Usage: node generate-favicons.js <source-image>
 * Exemple: node generate-favicons.js logo.png
 */

const fs = require('fs');
const path = require('path');
const sharp = require('sharp');

const sourceImage = process.argv[2];

if (!sourceImage) {
    console.error('❌ Erreur: Veuillez spécifier le chemin vers l\'image source');
    console.log('Usage: node generate-favicons.js <source-image>');
    console.log('Exemple: node generate-favicons.js logo.png');
    process.exit(1);
}

if (!fs.existsSync(sourceImage)) {
    console.error(`❌ Erreur: Le fichier "${sourceImage}" n'existe pas`);
    process.exit(1);
}

const outputDir = path.join(__dirname, 'favicons');

// Créer le dossier de sortie s'il n'existe pas
if (!fs.existsSync(outputDir)) {
    fs.mkdirSync(outputDir, { recursive: true });
}

console.log('🚀 Génération des favicons en cours...');

// Configuration des tailles à générer
const sizes = [
    // Standard favicons
    { size: 16, name: 'favicon-16x16.png' },
    { size: 32, name: 'favicon-32x32.png' },
    { size: 96, name: 'favicon-96x96.png' },
    { size: 192, name: 'favicon-192x192.png' },

    // Apple Touch Icons
    { size: 57, name: 'apple-touch-icon-57x57.png' },
    { size: 60, name: 'apple-touch-icon-60x60.png' },
    { size: 72, name: 'apple-touch-icon-72x72.png' },
    { size: 76, name: 'apple-touch-icon-76x76.png' },
    { size: 114, name: 'apple-touch-icon-114x114.png' },
    { size: 120, name: 'apple-touch-icon-120x120.png' },
    { size: 144, name: 'apple-touch-icon-144x144.png' },
    { size: 152, name: 'apple-touch-icon-152x152.png' },
    { size: 180, name: 'apple-touch-icon-180x180.png' },

    // Android/Chrome
    { size: 36, name: 'android-chrome-36x36.png' },
    { size: 48, name: 'android-chrome-48x48.png' },
    { size: 72, name: 'android-chrome-72x72.png' },
    { size: 96, name: 'android-chrome-96x96.png' },
    { size: 128, name: 'android-chrome-128x128.png' },
    { size: 144, name: 'android-chrome-144x144.png' },
    { size: 152, name: 'android-chrome-152x152.png' },
    { size: 192, name: 'android-chrome-192x192.png' },
    { size: 256, name: 'android-chrome-256x256.png' },
    { size: 384, name: 'android-chrome-384x384.png' },
    { size: 512, name: 'android-chrome-512x512.png' },

    // Windows Metro Tiles
    { size: 70, name: 'mstile-70x70.png' },
    { size: 144, name: 'mstile-144x144.png' },
    { size: 150, name: 'mstile-150x150.png' },
    { size: 310, name: 'mstile-310x150.png', width: 310, height: 150 },
    { size: 310, name: 'mstile-310x310.png' },
];

async function generateFavicons() {
    try {
        const promises = sizes.map(async ({ size, name, width, height }) => {
            const outputPath = path.join(outputDir, name);

            // Pour les images rectangulaires (comme mstile-310x150)
            const resizeOptions = width && height
                ? { width, height, fit: 'cover', position: 'center' }
                : { width: size, height: size, fit: 'cover', position: 'center' };

            await sharp(sourceImage)
                .resize(resizeOptions)
                .png()
                .toFile(outputPath);

            console.log(`✅ Généré: ${name}`);
        });

        await Promise.all(promises);

        // Générer le favicon.ico (format spécial)
        const icoPath = path.join(outputDir, 'favicon.ico');
        await sharp(sourceImage)
            .resize(32, 32, { fit: 'cover', position: 'center' })
            .toFile(icoPath);

        console.log('✅ Généré: favicon.ico');

        // Générer l'image Open Graph (1200x630)
        const ogPath = path.join(outputDir, 'og-image.jpg');
        await sharp(sourceImage)
            .resize(1200, 630, { fit: 'cover', position: 'center' })
            .jpeg({ quality: 90 })
            .toFile(ogPath);

        console.log('✅ Généré: og-image.jpg (Open Graph)');

        // Copier l'icône 180x180 comme apple-touch-icon.png par défaut
        const defaultAppleIcon = path.join(outputDir, 'apple-touch-icon.png');
        fs.copyFileSync(path.join(outputDir, 'apple-touch-icon-180x180.png'), defaultAppleIcon);
        console.log('✅ Généré: apple-touch-icon.png (défaut)');

        console.log('\n🎉 Tous les favicons ont été générés avec succès !');
        console.log(`📁 Fichiers créés dans: ${outputDir}`);
        console.log('\n📋 Liste des fichiers générés:');
        console.log(fs.readdirSync(outputDir).join('\n'));

    } catch (error) {
        console.error('❌ Erreur lors de la génération:', error.message);
        process.exit(1);
    }
}

generateFavicons();
