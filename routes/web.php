<?php

// ============================================
// Fichier: routes/web.php
// ============================================

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicProjectController;
use App\Http\Controllers\PublicBlogController;
use App\Http\Controllers\DonateController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PartnershipController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\ProjectImageController;
use App\Http\Controllers\Admin\VolunteerController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\PartnershipRequestController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\GalleryController as PublicGalleryController;

/*
|--------------------------------------------------------------------------
| Public Routes (Frontend)
|--------------------------------------------------------------------------
*/



// Home & Public Routes avec maintenance mode
Route::middleware(['check.maintenance'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Projects
    Route::prefix('projets')->name('projects.')->group(function () {
        Route::get('/', [PublicProjectController::class, 'index'])->name('index');
        Route::get('/{slug}', [PublicProjectController::class, 'show'])->name('show');
    });

    // Blog
        Route::prefix('blog')->name('blog.')->group(function () {
            Route::get('/', [PublicBlogController::class, 'index'])->name('index');
            Route::get('/categorie/{slug}', [PublicBlogController::class, 'category'])->name('category');
            Route::get('/{slug}', [PublicBlogController::class, 'show'])->name('show');
        });

    // Donations
    Route::prefix('faire-un-don')->name('donate.')->group(function () {
        Route::get('/', [DonateController::class, 'index'])->name('index');
        Route::post('/', [DonateController::class, 'store'])->name('store');
        Route::get('/success/{id}', [DonateController::class, 'success'])->name('success');
    });

    // Contact
    Route::prefix('contact')->name('contact.')->group(function () {
        Route::get('/', [ContactController::class, 'index'])->name('index');
        Route::post('/', [ContactController::class, 'store'])->name('store');
    });

    // Newsletter
    Route::prefix('newsletter')->name('newsletter.')->group(function () {
        Route::post('/subscribe', [NewsletterController::class, 'subscribe'])->name('subscribe');
        Route::get('/unsubscribe/{email}', [NewsletterController::class, 'unsubscribe'])->name('unsubscribe');
    });

    // Partnership Requests
    Route::post('/devenir-partenaire', [PartnershipController::class, 'store'])->name('partnership.store');

    // Volunteer Applications
    Route::post('/devenir-benevole', [\App\Http\Controllers\VolunteerController::class, 'store'])->name('volunteer.store');

    Route::get('/a-propos', [PageController::class, 'about'])->name('about');
    Route::get('/notre-mission', [PageController::class, 'mission'])->name('mission');
    Route::get('/galerie', [PublicGalleryController::class, 'index'])->name('gallery');
    Route::get('/devenir-benevole', [PageController::class, 'volunteer'])->name('volunteer');
    Route::get('/devenir-partenaire', [PageController::class, 'partner'])->name('partner');
    Route::get('/organiser-collecte', [PageController::class, 'fundraise'])->name('fundraise');

    // Static Pages
    Route::view('/mentions-legales', 'pages.legal')->name('legal');
    Route::view('/politique-confidentialite', 'pages.privacy')->name('privacy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Backend)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', 'editor'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Projects Management
    Route::resource('projects', ProjectController::class);

    // Project Images Management (sans "admin/" dans la route !)
    Route::delete('project-images/{projectImage}', [ProjectImageController::class, 'destroy'])
        ->name('project-images.destroy');
    Route::patch('project-images/{projectImage}', [ProjectImageController::class, 'update'])
        ->name('project-images.update');

    // Donations Management
    Route::prefix('donations')->name('donations.')->group(function () {
        Route::get('/', [DonationController::class, 'index'])->name('index');
        Route::get('/{donation}', [DonationController::class, 'show'])->name('show');
        Route::patch('/{donation}/status', [DonationController::class, 'updateStatus'])->name('update-status');
        Route::get('/export', [DonationController::class, 'export'])->name('export');
        Route::delete('/{donation}', [DonationController::class, 'destroy'])->name('destroy'); // <--- AJOUTE CETTE LIGNE
    });

    // Blog Management
    Route::resource('blog', BlogPostController::class)->parameters([
        'blog' => 'blogPost'
    ]);

    Route::patch('blog/{blogPost}/publish', [BlogPostController::class, 'publish'])->name('blog.publish');
    Route::patch('blog/{blogPost}/unpublish', [BlogPostController::class, 'unpublish'])->name('blog.unpublish');
    Route::post('blog/{blogPost}/duplicate', [BlogPostController::class, 'duplicate'])->name('blog.duplicate');

    // Categories Management
    Route::resource('categories', CategoryController::class)->except(['show']);

    // Testimonials Management
    Route::prefix('testimonials')->name('testimonials.')->group(function () {
        Route::get('/', [TestimonialController::class, 'index'])->name('index');
        Route::get('/create', [TestimonialController::class, 'create'])->name('create');
        Route::post('/', [TestimonialController::class, 'store'])->name('store');
        Route::get('/{testimonial}/edit', [TestimonialController::class, 'edit'])->name('edit');
        Route::patch('/{testimonial}/toggle-publish', [TestimonialController::class, 'togglePublish'])->name('toggle-publish');
        Route::put('/{testimonial}', [TestimonialController::class, 'update'])->name('update');
        Route::delete('/{testimonial}', [TestimonialController::class, 'destroy'])->name('destroy');
    });

    // Gallery Management
    Route::resource('gallery', GalleryController::class);

    // Test upload route (temporary)
    Route::get('gallery/test-upload', function() {
        return view('admin.gallery.test-upload');
    })->name('gallery.test-upload');

    // Contact Messages
    Route::prefix('messages')->name('messages.')->group(function () {
        Route::get('/', [ContactMessageController::class, 'index'])->name('index');
        Route::get('/{message}', [ContactMessageController::class, 'show'])->name('show');
        Route::patch('/{message}/replied', [ContactMessageController::class, 'markAsReplied'])->name('mark-replied');
        Route::delete('/{message}', [ContactMessageController::class, 'destroy'])->name('destroy');
    });

    // Volunteers Management
    Route::prefix('volunteers')->name('volunteers.')->group(function () {
        Route::get('/', [VolunteerController::class, 'index'])->name('index');
        Route::get('/{volunteer}', [VolunteerController::class, 'show'])->name('show');
        Route::patch('/{volunteer}/approve', [VolunteerController::class, 'approve'])->name('approve');
        Route::patch('/{volunteer}/reject', [VolunteerController::class, 'reject'])->name('reject');
        Route::delete('/{volunteer}', [VolunteerController::class, 'destroy'])->name('destroy');
    });

    // Site Settings
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [SiteSettingController::class, 'index'])->name('index');
        Route::put('/', [SiteSettingController::class, 'update'])->name('update');
    });

    // Users Management (Admin only)
    Route::middleware('admin')->prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('subscribers')->name('subscribers.')->group(function () {
        Route::get('/', [SubscriberController::class, 'index'])->name('index');
        Route::delete('/{subscriber}', [SubscriberController::class, 'destroy'])->name('destroy');
        Route::patch('/{subscriber}/unsubscribe', [SubscriberController::class, 'unsubscribe'])->name('unsubscribe');
        Route::patch('/{subscriber}/resubscribe', [SubscriberController::class, 'resubscribe'])->name('resubscribe');
        Route::get('/export', [SubscriberController::class, 'export'])->name('export');
        Route::post('/send-newsletter', [SubscriberController::class, 'sendNewsletter'])->name('send-newsletter');
    });

    // Partnership Requests Management
    Route::prefix('partnerships')->name('partnerships.')->group(function () {
        Route::get('/', [PartnershipRequestController::class, 'index'])->name('index');
        Route::get('/{partnershipRequest}', [PartnershipRequestController::class, 'show'])->name('show');
        Route::put('/{partnershipRequest}/status', [PartnershipRequestController::class, 'updateStatus'])->name('update-status');
        Route::delete('/{partnershipRequest}', [PartnershipRequestController::class, 'destroy'])->name('destroy');
    });
});


/*
|--------------------------------------------------------------------------
| Authentication Routes (Laravel Breeze)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Language Switcher
|--------------------------------------------------------------------------
*/

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['fr', 'en'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');

// Route pour le sitemap XML
Route::get('/sitemap.xml', function () {
    $path = public_path('sitemap.xml');
    if (!file_exists($path)) {
        abort(404);
    }
    return response(file_get_contents($path), 200, [
        'Content-Type' => 'application/xml'
    ]);
})->name('sitemap');

// Route de débogage SEO (uniquement en développement)
if (app()->environment('local')) {
    Route::get('/debug-seo', function () {
        $seoSettings = \App\Models\SiteSetting::where('group', 'seo')->get();

        return view('debug.seo', compact('seoSettings'));
    })->name('debug.seo');
}

