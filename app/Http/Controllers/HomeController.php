<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Testimonial;
use App\Models\BlogPost;
use App\Models\Gallery;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProjects = Project::active()->take(6)->get();
        $testimonials = Testimonial::published()->take(6)->get();
        $recentPosts = BlogPost::published()->latest('published_at')->take(3)->get();
        $galleryImages = Gallery::published()->ordered()->take(8)->get();

        return view('home', compact(
            'featuredProjects',
            'testimonials',
            'recentPosts',
            'galleryImages'
        ));
    }
}
