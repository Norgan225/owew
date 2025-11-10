<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use Illuminate\Http\Request;

class VolunteerController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'age' => 'nullable|integer|min:16|max:100',
            'city' => 'nullable|string|max:255',
            'profession' => 'nullable|string|max:255',
            'areas_of_interest' => 'required|array|min:1',
            'areas_of_interest.*' => 'string|in:education,sante,communication,logistique,tech,terrain',
            'skills' => 'nullable|string',
            'availability' => 'nullable|string|in:weekend,evenings,flexible',
            'motivation' => 'required|string|min:20',
        ], [
            'name.required' => 'Le nom complet est requis.',
            'email.required' => 'L\'email est requis.',
            'email.email' => 'L\'email doit être valide.',
            'phone.required' => 'Le téléphone est requis.',
            'areas_of_interest.required' => 'Veuillez sélectionner au moins un domaine d\'intérêt.',
            'areas_of_interest.min' => 'Veuillez sélectionner au moins un domaine d\'intérêt.',
            'motivation.required' => 'Veuillez expliquer votre motivation.',
            'motivation.min' => 'La motivation doit contenir au moins 20 caractères.',
        ]);

        // Combiner les informations supplémentaires dans le champ skills
        $skillsData = [];
        if (!empty($validated['age'])) {
            $skillsData[] = "Âge: {$validated['age']}";
        }
        if (!empty($validated['city'])) {
            $skillsData[] = "Ville: {$validated['city']}";
        }
        if (!empty($validated['profession'])) {
            $skillsData[] = "Profession: {$validated['profession']}";
        }
        if (!empty($validated['skills'])) {
            $skillsData[] = "Compétences: {$validated['skills']}";
        }
        if (!empty($validated['areas_of_interest'])) {
            $areas = implode(', ', array_map(function($area) {
                return match($area) {
                    'education' => 'Éducation & Formation',
                    'sante' => 'Santé & Bien-être',
                    'communication' => 'Communication',
                    'logistique' => 'Logistique',
                    'tech' => 'Tech & Digital',
                    'terrain' => 'Terrain',
                    default => $area
                };
            }, $validated['areas_of_interest']));
            $skillsData[] = "Domaines: {$areas}";
        }

        Volunteer::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'skills' => implode(' | ', $skillsData),
            'availability' => $validated['availability'] ?? 'flexible',
            'motivation_fr' => $validated['motivation'],
            'motivation_en' => null,
            'status' => 'pending'
        ]);

        return redirect()->back()->with('success', 'Votre candidature a été envoyée avec succès ! Nous vous contacterons bientôt.');
    }
}
