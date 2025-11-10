<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use App\Models\SiteSetting;

class ContactController extends Controller
{
    public function index()
    {
        $settings = [
            'contact' => SiteSetting::where('group', 'contact')->get(),
            'social' => SiteSetting::where('group', 'social')->get(),
        ];

        return view('contact.index', compact('settings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        $validated['status'] = 'new';

        ContactMessage::create($validated);

        return redirect()->back()->with('success', 'Merci pour votre message ! Nous vous répondrons dans les plus brefs délais.');
    }

    public function show()
    {
        // Charger les paramètres contact et social
        $settings = [
            'contact' => SiteSetting::where('group', 'contact')->get(),
            'social' => SiteSetting::where('group', 'social')->get(),
        ];

        return view('contact.index', compact('settings'));
    }
}
