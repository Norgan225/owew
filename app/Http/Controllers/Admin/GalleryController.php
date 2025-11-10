<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupérer toutes les images et les regrouper par titre
        $allImages = Gallery::latest()->get();

        // Grouper les images par titre_fr
        $groupedImages = $allImages->groupBy('title_fr')->map(function ($group) {
            $firstItem = $group->first();
            return [
                'id' => $firstItem->id, // ID du premier élément pour les actions
                'title_fr' => $firstItem->title_fr,
                'title_en' => $firstItem->title_en,
                'description_fr' => $firstItem->description_fr,
                'category' => $firstItem->category,
                'created_at' => $firstItem->created_at,
                'updated_at' => $firstItem->updated_at,
                'is_published' => $firstItem->is_published,
                'is_featured' => $firstItem->is_featured,
                'media_type' => $firstItem->media_type,
                'main_image' => $firstItem->image_path,
                'thumbnail' => $firstItem->thumbnail_path,
                'video_url' => $firstItem->video_url,
                'items' => $group,
                'count' => $group->count(),
                'has_video' => $group->contains('media_type', 'video'),
            ];
        })->values();

        // Pagination manuelle
        $perPage = 20;
        $currentPage = request()->get('page', 1);
        $offset = ($currentPage - 1) * $perPage;

        $albums = new \Illuminate\Pagination\LengthAwarePaginator(
            $groupedImages->slice($offset, $perPage),
            $groupedImages->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        $publishedCount = Gallery::where('is_published', true)->count();
        $featuredCount = Gallery::where('is_featured', true)->count();
        $categoriesCount = Gallery::distinct('category')->count('category');
        $categories = \App\Models\Category::orderBy('name_fr')->get();

        return view('admin.gallery.index', compact(
            'albums',
            'publishedCount',
            'featuredCount',
            'categoriesCount',
            'categories'
        ));
    }

    public function create()
    {
        $categories = \App\Models\Category::orderBy('name_fr')->get();
        return view('admin.gallery.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Debug: log incoming request info to help diagnose file upload issues on hosts
        Log::debug('GalleryController@store request start', [
            'has_files_images' => $request->hasFile('images'),
            'images_count' => is_array($request->file('images')) ? count($request->file('images')) : ( $request->hasFile('images') ? 1 : 0 ),
            'has_file_thumbnail' => $request->hasFile('thumbnail'),
            'post_max_size' => ini_get('post_max_size'),
            'upload_max_filesize' => ini_get('upload_max_filesize'),
            'content_length' => isset($_SERVER['CONTENT_LENGTH']) ? $_SERVER['CONTENT_LENGTH'] : null,
        ]);

        try {
            $validated = $request->validate([
            'title_fr' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description_fr' => 'nullable|string',
            'description_en' => 'nullable|string',
            'media_type' => 'required|in:image,video',
            'images' => 'required_if:media_type,image|array|min:1',
            'images.*' => 'image|max:2048', // Temporaire: 2M au lieu de 5M pour test local
            'video_url' => 'nullable|url|required_if:media_type,video',
            'thumbnail' => 'nullable|image|max:2048',
            'category' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
    ], [
            'images.required_if' => 'Veuillez sélectionner au moins une image.',
            'images.*.image' => 'Chaque fichier doit être une image valide.',
            'images.*.max' => 'Chaque image ne doit pas dépasser 5MB.',
            'video_url.required_if' => 'L\'URL de la vidéo est requise.',
            'video_url.url' => 'L\'URL de la vidéo doit être valide.',
        ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log validation errors so we can inspect them on the server
            Log::debug('GalleryController@store validation failed', [
                'errors' => $e->errors(),
                'request_all' => array_filter($request->except(['images', 'thumbnail'])),
            ]);
            throw $e; // rethrow so Laravel handles the response as usual
        }

        $uploadedCount = 0;

        if ($request->input('media_type') === 'video') {
            // Upload de la vidéo
            $thumbnailPath = null;
            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('gallery/thumbnails', 'public');
            }

            Gallery::create([
                'title_fr' => $validated['title_fr'] ?? 'Vidéo',
                'title_en' => $validated['title_en'] ?? 'Video',
                'description_fr' => $validated['description_fr'] ?? null,
                'description_en' => $validated['description_en'] ?? null,
                'media_type' => 'video',
                'video_url' => $validated['video_url'],
                'thumbnail_path' => $thumbnailPath,
                'category' => $validated['category'] ?? null,
                'order' => $validated['order'] ?? 0,
                'is_featured' => $request->has('is_featured'),
                'is_published' => $request->has('is_published'),
            ]);

            $uploadedCount = 1;
        } else {
            // Upload des images (code existant)
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    $imagePath = $image->store('gallery', 'public');

                    Gallery::create([
                        'title_fr' => $validated['title_fr'] ?? 'Image ' . ($index + 1),
                        'title_en' => $validated['title_en'] ?? 'Image ' . ($index + 1),
                        'description_fr' => $validated['description_fr'] ?? null,
                        'description_en' => $validated['description_en'] ?? null,
                        'media_type' => 'image',
                        'image_path' => $imagePath,
                        'category' => $validated['category'] ?? null,
                        'order' => ($validated['order'] ?? 0) + $index,
                        'is_featured' => $request->has('is_featured'),
                        'is_published' => $request->has('is_published'),
                    ]);

                    $uploadedCount++;
                }
            }
        }

        $mediaType = $request->input('media_type') === 'video' ? 'vidéo' : 'image(s)';
        return redirect()->route('admin.gallery.index')
            ->with('success', "{$uploadedCount} {$mediaType} ajoutée(s) à la galerie avec succès!");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        $categories = \App\Models\Category::orderBy('name_fr')->get();
        return view('admin.gallery.edit', compact('gallery', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|max:5120',
            'title_fr' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description_fr' => 'nullable|string',
            'description_en' => 'nullable|string',
            'media_type' => 'required|in:image,video',
            'video_url' => 'required_if:media_type,video|nullable|url',
            'thumbnail' => 'nullable|image|max:2048',
            'category' => 'nullable|string',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ]);

        // Mise à jour de l'image
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            if ($gallery->image_path) {
                Storage::disk('public')->delete($gallery->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('gallery', 'public');
        }

        // Mise à jour du thumbnail vidéo
        if ($request->hasFile('thumbnail')) {
            if ($gallery->thumbnail_path) {
                Storage::disk('public')->delete($gallery->thumbnail_path);
            }
            $validated['thumbnail_path'] = $request->file('thumbnail')->store('gallery/thumbnails', 'public');
        }

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_published'] = $request->has('is_published');

        $gallery->update($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Média mis à jour avec succès!');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->image_path) {
            Storage::disk('public')->delete($gallery->image_path);
        }

        if ($gallery->thumbnail_path) {
            Storage::disk('public')->delete($gallery->thumbnail_path);
        }

        $gallery->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Média supprimé avec succès!');
    }
}
