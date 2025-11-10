<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    /**
     * Inscription à la newsletter
     */
    public function subscribe(Request $request)
    {
        // Vérifier si la newsletter est activée
        if (setting('enable_newsletter') != '1') {
            return redirect()->back()->with('error', 'La newsletter n\'est pas disponible pour le moment.');
        }

        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
        ], [
            'email.required' => 'L\'adresse email est requise.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
            'email.max' => 'L\'email ne doit pas dépasser 255 caractères.',
            'name.max' => 'Le nom ne doit pas dépasser 255 caractères.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();

        // Vérifier si l'email existe déjà
        $existingSubscriber = Subscriber::where('email', $validated['email'])->first();

        if ($existingSubscriber) {
            // Si déjà inscrit et actif
            if ($existingSubscriber->status === 'active') {
                return redirect()->back()->with('error', '📧 Cet email est déjà inscrit à notre newsletter.');
            }

            // Si était désabonné, réactiver
            if ($existingSubscriber->status === 'unsubscribed') {
                $existingSubscriber->resubscribe();

                // Mettre à jour le nom si fourni
                if (!empty($validated['name'])) {
                    $existingSubscriber->update(['name' => $validated['name']]);
                }

                return redirect()->back()->with('success', '🎉 Bienvenue à nouveau ' . ($validated['name'] ?? '') . ' ! Vous êtes à nouveau inscrit à notre newsletter.');
            }
        }

        // Créer un nouveau subscriber
        Subscriber::create([
            'name' => $validated['name'] ?? null,
            'email' => $validated['email'],
            'status' => 'active',
            'subscribed_at' => now(),
        ]);

        // Message de succès personnalisé
        $message = '🎉 Merci';
        if (!empty($validated['name'])) {
            $message .= ' ' . $validated['name'];
        }
        $message .= ' ! Vous êtes maintenant inscrit à notre newsletter.';

        return redirect()->back()->with('success', $message);
    }

    /**
     * Désabonnement de la newsletter
     */
    public function unsubscribe(Request $request, $email = null)
    {
        // Récupérer l'email depuis le paramètre ou le formulaire
        $emailToUnsubscribe = $email ?? $request->input('email');

        if (!$emailToUnsubscribe) {
            return redirect()->route('home')->with('error', 'Email manquant.');
        }

        // Chercher le subscriber
        $subscriber = Subscriber::where('email', $emailToUnsubscribe)->first();

        if (!$subscriber) {
            return redirect()->route('home')->with('error', 'Cette adresse email n\'est pas inscrite à notre newsletter.');
        }

        // Si déjà désabonné
        if ($subscriber->status === 'unsubscribed') {
            return view('newsletter.unsubscribed', [
                'subscriber' => $subscriber,
                'alreadyUnsubscribed' => true,
            ]);
        }

        // Désabonner
        $subscriber->unsubscribe();

        // Afficher la page de confirmation
        return view('newsletter.unsubscribed', [
            'subscriber' => $subscriber,
            'alreadyUnsubscribed' => false,
        ]);
    }

    /**
     * Réabonnement (optionnel - si l'utilisateur change d'avis)
     */
    public function resubscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        $subscriber = Subscriber::where('email', $validated['email'])->first();

        if (!$subscriber) {
            return redirect()->route('home')->with('error', 'Email introuvable.');
        }

        if ($subscriber->status === 'active') {
            return redirect()->route('home')->with('info', 'Vous êtes déjà inscrit à notre newsletter.');
        }

        $subscriber->resubscribe();

        return redirect()->route('home')->with('success', '🎉 Vous êtes à nouveau inscrit à notre newsletter !');
    }

    /**
     * Page de confirmation de désabonnement
     */
    public function unsubscribeConfirm($email)
    {
        $subscriber = Subscriber::where('email', $email)->first();

        if (!$subscriber) {
            return redirect()->route('home')->with('error', 'Email introuvable.');
        }

        return view('newsletter.confirm-unsubscribe', compact('subscriber'));
    }
}
