<?php

namespace App\Http\Controllers;

use App\Models\PartnershipRequest;
use Illuminate\Http\Request;

class PartnershipController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'organization_name' => 'required|string|max:255',
            'sector' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'contact_position' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'partnership_types' => 'required|array|min:1',
            'partnership_types.*' => 'string|in:financial,technical,volunteer,material,advocacy,other',
            'estimated_budget' => 'nullable|numeric|min:0',
            'message' => 'required|string|min:20',
        ], [
            'organization_name.required' => 'Le nom de l\'organisation est requis.',
            'sector.required' => 'Le secteur d\'activité est requis.',
            'contact_name.required' => 'Le nom du contact est requis.',
            'email.required' => 'L\'email est requis.',
            'email.email' => 'L\'email doit être valide.',
            'phone.required' => 'Le numéro de téléphone est requis.',
            'partnership_types.required' => 'Veuillez sélectionner au moins un type de partenariat.',
            'partnership_types.min' => 'Veuillez sélectionner au moins un type de partenariat.',
            'message.required' => 'Le message est requis.',
            'message.min' => 'Le message doit contenir au moins 20 caractères.',
        ]);

        PartnershipRequest::create($validated);

        return redirect()->back()->with('success', 'Votre demande de partenariat a été envoyée avec succès. Nous vous contacterons bientôt.');
    }
}
