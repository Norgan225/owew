<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Category;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->get('category');

        $query = Gallery::published()->ordered();

        if ($category) {
            $query->where('category', $category);
        }

        // Récupérer toutes les images et les regrouper par titre
        $allImages = $query->get();

        // Grouper les images par titre_fr
        $groupedImages = $allImages->groupBy('title_fr')->map(function ($group) {
            $firstItem = $group->first();
            return [
                'title_fr' => $firstItem->title_fr,
                'title_en' => $firstItem->title_en,
                'description_fr' => $firstItem->description_fr,
                'description_en' => $firstItem->description_en,
                'category' => $firstItem->category,
                'created_at' => $firstItem->created_at,
                'media_type' => $firstItem->media_type,
                'main_image' => $firstItem->image_path,
                'thumbnail' => $firstItem->thumbnail_path,
                'video_url' => $firstItem->video_url,
                'items' => $group->map(function($item) {
                    return [
                        'media_type' => $item->media_type,
                        'image_path' => $item->image_path,
                        'video_url' => $item->video_url,
                        'thumbnail_path' => $item->thumbnail_path,
                    ];
                })->toArray(),
                'count' => $group->count(),
                'has_video' => $group->contains('media_type', 'video'),
            ];
        })->values();

        // Pagination manuelle
        $perPage = 12;
        $currentPage = $request->get('page', 1);
        $offset = ($currentPage - 1) * $perPage;

        $albums = new \Illuminate\Pagination\LengthAwarePaginator(
            $groupedImages->slice($offset, $perPage),
            $groupedImages->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        $categories = Category::orderBy('name_fr')->get();

        return view('pages.gallery', compact('albums', 'categories', 'category'));
    }
}
