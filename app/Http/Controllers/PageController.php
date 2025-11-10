<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about');
    }

    public function mission()
    {
        return view('pages.mission');
    }

    public function gallery()
    {
        return view('pages.gallery');
    }

    public function volunteer()
    {
        return view('pages.volunteer');
    }

    public function partner()
    {
        return view('pages.partner');
    }

    public function fundraise()
    {
        $testimonials = Testimonial::published()->latest()->take(3)->get();
        return view('pages.fundraise', compact('testimonials'));
    }
}
