<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProjectImageController extends Controller
{
    // Suppression d'une image
    public function destroy(ProjectImage $projectImage)
    {
        // Supprime le fichier sur le disque
        Storage::disk('public')->delete($projectImage->image_path);
        // Supprime la ligne en base
        $projectImage->delete();

        // Pour AJAX : retour 204
        return response()->noContent();
        // Pour formulaire classique :
        // return back()->with('success', 'Image supprimée');
    }

    // (optionnel) Mise à jour de la légende
    public function update(Request $request, ProjectImage $projectImage)
    {
        $request->validate([
            'caption_fr' => 'nullable|string|max:255',
            'caption_en' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
        ]);
        $projectImage->update($request->only(['caption_fr', 'caption_en', 'order']));
        return back()->with('success', 'Légende ou ordre modifié');
    }
}
