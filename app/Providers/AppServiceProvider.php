<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //URL::forceScheme('https');
        //URL::forceScheme('http');
        Carbon::setLocale('fr');

        if (!function_exists('setting')) {
            function setting($key, $default = '', $locale = 'fr')
            {
                try {
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

        if (!app()->runningInConsole()) {
            $maintenanceMode = setting('maintenance_mode', '0');

            if ($maintenanceMode == '1') {
                // 1. VÉRIFIER D'ABORD les URLs (plus fiable que les routes nommées)
                if (request()->is('admin') || request()->is('admin/*') || request()->is('login') || request()->is('logout') || request()->is('register')) {
                    return; // Autoriser et sortir immédiatement
                }

                // 2. Autoriser les routes nommées admin.*
                $currentRoute = request()->route()?->getName();
                if ($currentRoute && str_starts_with($currentRoute, 'admin.')) {
                    return; // Autoriser et sortir
                }

                // 3. Autoriser les admins connectés
                if (auth()->check() && auth()->user()->isAdmin()) {
                    return; // Autoriser et sortir
                }

                // 4. Si aucune condition ci-dessus, BLOQUER
                abort(503, view('maintenance', [
                    'site_name' => setting('site_name_fr', 'OWEW'),
                    'contact_email' => setting('contact_email', 'contact@owew.org'),
                ]));
            }
        }
    }
}
