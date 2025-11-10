<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMaintenanceMode
{
    public function handle(Request $request, Closure $next): Response
    {
        // Récupérer l'URL
        $url = $request->getPathInfo();

        // TOUJOURS autoriser ces routes EN PREMIER (avant toute vérification)
        $excludedPrefixes = [
            '/admin',
            '/login',
            '/register',
            '/password',
            '/forgot-password',
            '/reset-password',
            '/email/verify',
            '/verify-email',
            '/confirm-password',
            '/logout'
        ];

        foreach ($excludedPrefixes as $prefix) {
            if (str_starts_with($url, $prefix)) {
                return $next($request); // Laisser passer IMMÉDIATEMENT
            }
        }

        // Si utilisateur admin connecté, laisser passer
        if (auth()->check() && auth()->user()->isAdmin()) {
            return $next($request);
        }

        // Maintenant seulement, vérifier le mode maintenance
        try {
            $maintenanceMode = setting('maintenance_mode', '0');

            if ($maintenanceMode === '1') {
                return response()->view('maintenance', [
                    'site_name' => setting('site_name_fr', 'OWEW'),
                    'contact_email' => setting('contact_email', 'contact@owew.org'),
                ], 503)->header('Retry-After', 3600);
            }

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Erreur mode maintenance : ' . $e->getMessage());
        }

        return $next($request);
    }
}
