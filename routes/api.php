<?php
use App\Models\BlogPost;
use App\Models\Donation;
use App\Models\Project;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public API endpoints
Route::prefix('v1')->group(function () {

    // Projects
    Route::get('/projects', function () {
        return App\Models\Project::active()->with('images')->get();
    });

    Route::get('/projects/{slug}', function ($slug) {
        return App\Models\Project::where('slug', $slug)
            ->with('images')
            ->firstOrFail();
    });

    // Blog Posts
    Route::get('/blog', function () {
        return App\Models\BlogPost::published()
            ->with(['author', 'category'])
            ->latest('published_at')
            ->paginate(10);
    });

    Route::get('/blog/{slug}', function ($slug) {
        return App\Models\BlogPost::where('slug', $slug)
            ->published()
            ->with(['author', 'category'])
            ->firstOrFail();
    });

    // Testimonials
    Route::get('/testimonials', function () {
        return App\Models\Testimonial::published()->get();
    });

    // Statistics
    Route::get('/stats', function () {
        return [
            'total_projects' => App\Models\Project::count(),
            'active_projects' => App\Models\Project::active()->count(),
            'total_raised' => App\Models\Donation::completed()->sum('amount'),
            'total_donations' => App\Models\Donation::completed()->count(),
        ];
    });
});
