<?php

namespace App\Console\Commands;

use App\Models\SiteSetting;
use Illuminate\Console\Command;

class CheckSeoSettings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seo:check {--locale=fr : Locale à utiliser (fr/en)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Vérifier les paramètres SEO enregistrés dans la base de données';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $locale = $this->option('locale');

        $this->info("🔍 Vérification des paramètres SEO ({$locale})");
        $this->line('=====================================');

        // Liste des clés SEO à vérifier
        $seoKeys = [
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Mots-clés',
            'canonical_url' => 'URL Canonique',
            'og_title' => 'Open Graph Title',
            'og_description' => 'Open Graph Description',
            'og_image' => 'Open Graph Image',
            'twitter_card_type' => 'Type Twitter Card',
            'robots_meta' => 'Meta Robots',
            'google_analytics_id' => 'Google Analytics ID',
            'google_tag_manager_id' => 'Google Tag Manager ID',
        ];

        $foundSettings = 0;
        $missingSettings = 0;

        foreach ($seoKeys as $key => $label) {
            $setting = SiteSetting::where('key', $key)->first();

            if ($setting) {
                $value = $locale === 'fr' ? $setting->value_fr : $setting->value_en;
                $this->line("✅ <comment>{$label}</comment>: <info>" . ($value ?: 'Non défini') . "</info>");
                $foundSettings++;
            } else {
                $this->line("❌ <comment>{$label}</comment>: <error>Non configuré</error>");
                $missingSettings++;
            }
        }

        $this->line('');
        $this->info("📊 Résumé:");
        $this->line("   • Paramètres configurés: <info>{$foundSettings}</info>");
        $this->line("   • Paramètres manquants: <error>{$missingSettings}</error>");

        // Vérifier si les fichiers favicon existent
        $this->line('');
        $this->info("🎨 Vérification des favicons:");
        $faviconFiles = [
            'favicon.ico',
            'favicons/favicon-32x32.png',
            'favicons/apple-touch-icon.png',
            'favicons/site.webmanifest'
        ];

        foreach ($faviconFiles as $file) {
            $path = public_path($file);
            if (file_exists($path)) {
                $this->line("✅ <comment>{$file}</comment>: <info>Présent</info>");
            } else {
                $this->line("❌ <comment>{$file}</comment>: <error>Manquant</error>");
            }
        }

        // Suggestions d'amélioration
        if ($missingSettings > 0) {
            $this->line('');
            $this->warn("💡 Suggestions:");
            $this->line("   • Allez dans Admin → Paramètres → Section SEO");
            $this->line("   • Remplissez les champs manquants");
            $this->line("   • Utilisez les compteurs de caractères pour optimiser");
        }

        return Command::SUCCESS;
    }
}
