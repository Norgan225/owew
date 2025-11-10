<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Testimonial;


class DonateController extends Controller
{
    public function index()
    {
        $projects = Project::active()->get();
        $testimonial = Testimonial::inRandomOrder()->first();
        return view('donate.index', compact('projects', 'testimonial'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'donor_name'   => 'required|string|max:255',
            'donor_email'  => 'required|email',
            'donor_phone'  => 'nullable|string',
            'amount'       => 'required|numeric|min:1',
            'project_id'   => 'nullable|exists:projects,id',
            'is_anonymous' => 'boolean',
            'message'      => 'nullable|string|max:500',
        ]);

        $validated['currency'] = 'XOF';
        $validated['status'] = 'received';
        // On peut ignorer transaction_id

        // On enregistre le don (optionnel)
        $donation = Donation::create($validated);

        return redirect()->route('donate.success', $donation->id)
            ->with('success', 'Merci pour votre don!');
    }

    public function success($id)
    {
        $donation = Donation::findOrFail($id);
        $testimonial = Testimonial::inRandomOrder()->first(); // Optionnel, comme sur la page de don
        $otherProjects = Project::active()->where('id', '!=', $donation->project_id)->limit(3)->get();
        // Calculer progress pour chaque projet (optionnel)
        foreach ($otherProjects as $project) {
            $project->progress = $project->goal > 0 ? round(($project->collected / $project->goal) * 100) : 0;
        }
        return view('donate.success', compact('donation', 'testimonial', 'otherProjects'));
    }
}
