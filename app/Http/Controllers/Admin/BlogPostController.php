<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogPostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with(['author', 'category'])
            ->latest()
            ->paginate(20);

        // Stats pour les cards
        $publishedCount = BlogPost::where('status', 'published')->count();
        $draftCount = BlogPost::where('status', 'draft')->count();
        $totalViews = BlogPost::sum('views_count');

        // Top 5 articles les plus vus
        $topPosts = BlogPost::orderBy('views_count', 'desc')
            ->take(5)
            ->get();

        // Catégories et auteurs pour les filtres
        $categories = Category::all();
        $authors = User::whereHas('blogPosts')->get();

        // Data pour le graphique (30 derniers jours)
        $viewsData = $this->getViewsChartData();

        return view('admin.blog.index', compact(
            'posts',
            'publishedCount',
            'draftCount',
            'totalViews',
            'topPosts',
            'categories',
            'authors',
            'viewsData'
        ));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.blog.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_fr' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'content_fr' => 'required|string',
            'content_en' => 'required|string',
            'featured_image' => 'nullable|image|max:2048',
            'category_id' => 'nullable|exists:categories,id',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
        ]);

        $validated['author_id'] = Auth::id();
        $validated['slug'] = Str::slug($validated['title_fr']);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')
                ->store('blog', 'public');
        }

        if ($validated['status'] === 'published' && !isset($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        BlogPost::create($validated);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Article créé avec succès!');
    }

    public function edit(BlogPost $blogPost)
    {
        $categories = Category::all();
        return view('admin.blog.edit', compact('blogPost', 'categories'));
    }

    public function update(Request $request, BlogPost $blogPost)
    {
        $validated = $request->validate([
            'title_fr' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'content_fr' => 'required|string',
            'content_en' => 'required|string',
            'featured_image' => 'nullable|image|max:2048',
            'category_id' => 'nullable|exists:categories,id',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
        ]);

        $validated['slug'] = Str::slug($validated['title_fr']);

        if ($request->hasFile('featured_image')) {
            // Supprimer l'ancienne image si elle existe
            if ($blogPost->featured_image) {
                Storage::disk('public')->delete($blogPost->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')
                ->store('blog', 'public');
        }

        if ($validated['status'] === 'published' && !$blogPost->published_at) {
            $validated['published_at'] = now();
        }

        $blogPost->update($validated);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Article mis à jour avec succès!');
    }

    public function destroy(BlogPost $blogPost)
    {
        // Supprimer l'image associée
        if ($blogPost->featured_image) {
            Storage::disk('public')->delete($blogPost->featured_image);
        }

        $blogPost->delete();

        return redirect()->route('admin.blog.index')
            ->with('success', 'Article supprimé avec succès!');
    }

    // Nouvelles méthodes pour les fonctionnalités de la vue

    public function publish(BlogPost $blogPost)
    {
        $blogPost->update([
            'status' => 'published',
            'published_at' => $blogPost->published_at ?? now()
        ]);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Article publié avec succès!');
    }

    public function unpublish(BlogPost $blogPost)
    {
        $blogPost->update([
            'status' => 'draft'
        ]);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Article dépublié avec succès!');
    }

    public function duplicate(BlogPost $blogPost)
    {
        $newPost = $blogPost->replicate();
        $newPost->title_fr = $blogPost->title_fr . ' (Copie)';
        $newPost->title_en = $blogPost->title_en . ' (Copy)';
        $newPost->slug = Str::slug($newPost->title_fr . '-' . time());
        $newPost->status = 'draft';
        $newPost->published_at = null;
        $newPost->views_count = 0;
        $newPost->author_id = Auth::id();
        $newPost->save();

        return redirect()->route('admin.blog.edit', $newPost)
            ->with('success', 'Article dupliqué avec succès!');
    }

    // Méthode privée pour générer les données du graphique
    private function getViewsChartData()
    {
        $labels = [];
        $data = [];

        // Calculer les vues cumulées par jour sur les 30 derniers jours
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $labels[] = $date->format('d/m');

            // Compter les vues des articles publiés avant ou à cette date
            // et qui ont été vus (views_count > 0)
            $dailyViews = BlogPost::where('status', 'published')
                ->where('created_at', '<=', $date->endOfDay())
                ->sum('views_count');

            // Si pas de données réelles, utiliser une valeur par défaut réaliste
            $data[] = max($dailyViews, 0);
        }

        return [
            'labels' => $labels,
            'data' => $data
        ];
    }
}
