<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('images')->latest()->paginate(10);
        $stats = [
            'active' => Project::where('status', 'active')->count(),
            'completed' => Project::where('status', 'completed')->count(),
            'archived' => Project::where('status', 'archived')->count(),
            'total_raised' => Project::sum('raised_amount'),
        ];
        return view('admin.projects.index', compact('projects', 'stats'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_fr' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_fr' => 'required|string',
            'description_en' => 'required|string',
            'goal_amount' => 'required|numeric|min:0',
            'status' => 'required|in:active,completed,archived',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
            'featured' => 'boolean',
            'images.*' => 'image|max:2048',
        ]);
        $validated['featured'] = $request->has('featured');
        $project = Project::create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $img) {
                $path = $img->store('projects', 'public');
                $project->images()->create([
                    'image_path' => $path,
                    'order' => $index,
                ]);
            }
        }
        return redirect()->route('admin.projects.index')
            ->with('success', 'Projet créé avec succès!');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title_fr' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_fr' => 'required|string',
            'description_en' => 'required|string',
            'goal_amount' => 'required|numeric|min:0',
            'raised_amount' => 'nullable|numeric|min:0',
            'status' => 'required|in:active,completed,archived',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
            'featured' => 'boolean',
            'images.*' => 'image|max:2048',
        ]);
        $validated['featured'] = $request->has('featured');
        $project->update($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $img) {
                $path = $img->store('projects', 'public');
                $project->images()->create([
                    'image_path' => $path,
                    'order' => $index,
                ]);
            }
        }
        return redirect()->route('admin.projects.index')
            ->with('success', 'Projet mis à jour avec succès!');
    }

    public function destroy(Project $project)
    {
        foreach ($project->images as $img) {
            Storage::disk('public')->delete($img->image_path);
            $img->delete();
        }
        $project->delete();
        return redirect()->route('admin.projects.index')
            ->with('success', 'Projet supprimé avec succès!');
    }
}
