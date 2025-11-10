<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function index()
    {
        // Récupérer tous les paramètres groupés par catégorie
        $allSettings = SiteSetting::all();

        // Organiser par groupe avec valeurs par défaut si vide
        $settings = [
            'general' => $allSettings->where('group', 'general'),
            'contact' => $allSettings->where('group', 'contact'),
            'social' => $allSettings->where('group', 'social'),
            'seo' => $allSettings->where('group', 'seo'),
            'email' => $allSettings->where('group', 'email'),
            'appearance' => $allSettings->where('group', 'appearance'),
            'advanced' => $allSettings->where('group', 'advanced'),
        ];

        // Créer les paramètres par défaut s'ils n'existent pas
        $this->ensureDefaultSettings();

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        try {
            $validated = $request->validate([
                'settings' => 'required|array',
            ]);

            foreach ($validated['settings'] as $key => $values) {
                $group = $this->determineGroup($key);
                $type = $this->determineType($key);

                $valueFr = $values['value_fr'] ?? null;
                $valueEn = $values['value_en'] ?? $values['value_fr'] ?? null;

                // Gestion spéciale pour les checkboxes
                if (in_array($key, ['maintenance_mode', 'enable_donations', 'enable_newsletter', 'enable_volunteers'])) {
                    // Récupérer toutes les valeurs pour cette clé
                    $allValues = $request->input("settings.{$key}.value_fr");

                    // Si c'est un tableau, prendre la dernière valeur (celle du checkbox si coché)
                    if (is_array($allValues)) {
                        $valueFr = end($allValues);
                    } else {
                        $valueFr = $allValues;
                    }

                    // S'assurer que c'est bien 0 ou 1
                    $valueFr = $valueFr == '1' ? '1' : '0';
                    $valueEn = $valueFr;
                }

                SiteSetting::updateOrCreate(
                    ['key' => $key],
                    [
                        'value_fr' => $valueFr,
                        'value_en' => $valueEn,
                        'type' => $type,
                        'group' => $group
                    ]
                );
            }

            // Vider le cache
            clear_settings_cache();

            return redirect()->back()
                ->with('success', 'Paramètres mis à jour avec succès!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erreur lors de la mise à jour : ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Déterminer le groupe d'un paramètre basé sur sa clé
     */
    private function determineGroup($key)
    {
        if (strpos($key, 'site_') === 0) return 'general';
        if (strpos($key, 'contact_') === 0) return 'contact';
        if (strpos($key, 'social_') === 0) return 'social';
        if (strpos($key, 'seo_') === 0 || strpos($key, 'google_') === 0) return 'seo';
        if (strpos($key, 'mail_') === 0 || strpos($key, 'admin_notification') === 0) return 'email';
        if (strpos($key, 'theme_') === 0 || strpos($key, 'maintenance_') === 0) return 'appearance';
        if (strpos($key, 'custom_') === 0 || strpos($key, 'enable_') === 0) return 'advanced';

        return 'general';
    }

    /**
     * Déterminer le type d'un paramètre
     */
    private function determineType($key)
    {
        // Utiliser uniquement 'text' et 'textarea'
        if (strpos($key, 'description') !== false ||
            strpos($key, 'address') !== false ||
            strpos($key, 'scripts') !== false) {
            return 'textarea';
        }

        // Tout le reste en 'text' (y compris checkboxes, colors, emails, etc.)
        return 'text';
    }

    /**
     * S'assurer que les paramètres par défaut existent
     */
    private function ensureDefaultSettings()
    {
        $defaults = [
            // General
            ['key' => 'site_name_fr', 'value_fr' => 'OWEW', 'value_en' => 'OWEW', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_name_en', 'value_fr' => 'OWEW', 'value_en' => 'OWEW', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_tagline_fr', 'value_fr' => '', 'value_en' => '', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_tagline_en', 'value_fr' => '', 'value_en' => '', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_description_fr', 'value_fr' => '', 'value_en' => '', 'type' => 'textarea', 'group' => 'general'],
            ['key' => 'site_description_en', 'value_fr' => '', 'value_en' => '', 'type' => 'textarea', 'group' => 'general'],

            // Contact
            ['key' => 'contact_email', 'value_fr' => '', 'value_en' => '', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_phone', 'value_fr' => '', 'value_en' => '', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_whatsapp', 'value_fr' => '', 'value_en' => '', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_fax', 'value_fr' => '', 'value_en' => '', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_address_fr', 'value_fr' => '', 'value_en' => '', 'type' => 'textarea', 'group' => 'contact'],
            ['key' => 'contact_address_en', 'value_fr' => '', 'value_en' => '', 'type' => 'textarea', 'group' => 'contact'],
            ['key' => 'contact_latitude', 'value_fr' => '', 'value_en' => '', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_longitude', 'value_fr' => '', 'value_en' => '', 'type' => 'text', 'group' => 'contact'],

            // Social (tous en 'text')
            ['key' => 'social_facebook', 'value_fr' => '', 'value_en' => '', 'type' => 'text', 'group' => 'social'],
            ['key' => 'social_twitter', 'value_fr' => '', 'value_en' => '', 'type' => 'text', 'group' => 'social'],
            ['key' => 'social_instagram', 'value_fr' => '', 'value_en' => '', 'type' => 'text', 'group' => 'social'],
            ['key' => 'social_linkedin', 'value_fr' => '', 'value_en' => '', 'type' => 'text', 'group' => 'social'],
            ['key' => 'social_youtube', 'value_fr' => '', 'value_en' => '', 'type' => 'text', 'group' => 'social'],
            ['key' => 'social_tiktok', 'value_fr' => '', 'value_en' => '', 'type' => 'text', 'group' => 'social'],

            // SEO
            ['key' => 'seo_title_fr', 'value_fr' => '', 'value_en' => '', 'type' => 'text', 'group' => 'seo'],
            ['key' => 'seo_title_en', 'value_fr' => '', 'value_en' => '', 'type' => 'text', 'group' => 'seo'],
            ['key' => 'seo_description_fr', 'value_fr' => '', 'value_en' => '', 'type' => 'textarea', 'group' => 'seo'],
            ['key' => 'seo_description_en', 'value_fr' => '', 'value_en' => '', 'type' => 'textarea', 'group' => 'seo'],
            ['key' => 'seo_keywords_fr', 'value_fr' => '', 'value_en' => '', 'type' => 'text', 'group' => 'seo'],
            ['key' => 'google_analytics_id', 'value_fr' => '', 'value_en' => '', 'type' => 'text', 'group' => 'seo'],
            ['key' => 'google_tag_manager_id', 'value_fr' => '', 'value_en' => '', 'type' => 'text', 'group' => 'seo'],

            // Email (tous en 'text')
            ['key' => 'mail_from_address', 'value_fr' => '', 'value_en' => '', 'type' => 'text', 'group' => 'email'],
            ['key' => 'mail_from_name', 'value_fr' => '', 'value_en' => '', 'type' => 'text', 'group' => 'email'],
            ['key' => 'admin_notification_email', 'value_fr' => '', 'value_en' => '', 'type' => 'text', 'group' => 'email'],

            // Appearance (tous en 'text')
            ['key' => 'theme_primary_color', 'value_fr' => '#4B0082', 'value_en' => '#4B0082', 'type' => 'text', 'group' => 'appearance'],
            ['key' => 'theme_secondary_color', 'value_fr' => '#FF9800', 'value_en' => '#FF9800', 'type' => 'text', 'group' => 'appearance'],
            ['key' => 'maintenance_mode', 'value_fr' => '0', 'value_en' => '0', 'type' => 'text', 'group' => 'appearance'],

            // Advanced
            ['key' => 'custom_header_scripts', 'value_fr' => '', 'value_en' => '', 'type' => 'textarea', 'group' => 'advanced'],
            ['key' => 'custom_footer_scripts', 'value_fr' => '', 'value_en' => '', 'type' => 'textarea', 'group' => 'advanced'],
            ['key' => 'enable_donations', 'value_fr' => '1', 'value_en' => '1', 'type' => 'text', 'group' => 'advanced'],
            ['key' => 'enable_newsletter', 'value_fr' => '1', 'value_en' => '1', 'type' => 'text', 'group' => 'advanced'],
            ['key' => 'enable_volunteers', 'value_fr' => '1', 'value_en' => '1', 'type' => 'text', 'group' => 'advanced'],
        ];

        foreach ($defaults as $default) {
            SiteSetting::firstOrCreate(
                ['key' => $default['key']],
                $default
            );
        }
    }
}
