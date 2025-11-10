<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class PublicProjectController extends Controller
{
    public function index()
    {
        $projects = Project::active()
            ->with('images')
            ->latest()
            ->paginate(12);

        return view('projects.index', compact('projects'));
    }

    public function show($slug)
    {
        $project = Project::where('slug', $slug)
            ->with('images', 'donations')
            ->firstOrFail();

        return view('projects.show', compact('project'));
    }
}
