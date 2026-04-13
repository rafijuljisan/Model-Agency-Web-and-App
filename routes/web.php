<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Editorial;
use App\Models\Setting;
use App\Livewire\ArtistDirectory;
use App\Livewire\ArtistProfile;
use App\Livewire\PhotoGalleryPage;
use App\Models\PhotoGallery;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// 1. The Homepage
Route::get('/', function () {
    $featuredArtists = App\Models\User::role('Verified-Artist')
        ->with([
            'profile',
            'media' => fn($q) => $q->whereIn('collection_name', ['avatar', 'portfolio']),
        ])
        // 1. MUST BE FULLY VERIFIED
        ->where('verification_status', 'verified')
        ->where('academic_verification_status', 'verified')
        ->whereHas('profile')
        
        // 2. MUST HAVE AN AVATAR
        ->whereHas('media', function ($q) {
            $q->where('collection_name', 'avatar');
        })
        
        // 3. MUST HAVE AT LEAST 3 PORTFOLIO IMAGES
        ->withCount(['media as portfolio_count' => function ($q) {
            $q->where('collection_name', 'portfolio');
        }])
        ->having('portfolio_count', '>=', 3)
        
        // 4. GET THE HIGHEST ACTIVE SUBSCRIPTION TIER (Pro = 3, Verified = 2)
        ->addSelect(['subscription_tier' => function ($query) {
            $query->select('package_id')
                  ->from('subscriptions')
                  ->whereColumn('user_id', 'users.id')
                  ->where('status', 'active')
                  ->orderByDesc('package_id')
                  ->limit(1);
        }])
        
        // 5. THE WEIGHTED SORTING ALGORITHM
        ->orderByDesc('is_featured')       // Priority 1: Admin manually toggled "is_featured"
        ->orderByDesc('subscription_tier') // Priority 2: Pro Artists (ID 3) beat Verified (ID 2)
        ->orderByDesc('last_active_at')    // Priority 3: Recently active users
        ->orderByDesc('created_at')        // Priority 4: Newest accounts fallback
        ->take(8)
        ->get();

    // Fetch the dynamic content for the rest of the page
    $clients = App\Models\Client::where('is_active', true)->orderBy('sort_order')->get();
    $testimonials = App\Models\Testimonial::where('is_active', true)->orderBy('sort_order')->get();
    $teamMembers = App\Models\TeamMember::where('is_active', true)->orderBy('sort_order')->get();

    // 🔴 NEW: Fetch the latest 12 active gallery photos for the slider
    $galleryPhotos = App\Models\PhotoGallery::where('is_active', true)
        ->latest()
        ->take(12)
        ->get();

    // 🔴 NEW: Added 'galleryPhotos' to compact()
    return view('welcome', compact('featuredArtists', 'clients', 'testimonials', 'teamMembers', 'galleryPhotos'));
});
// SEO Routes (public, no auth)
Route::get('/sitemap.xml', [App\Http\Controllers\SitemapController::class, 'index'])
    ->name('sitemap');

Route::get('/robots.txt', function () {
    $settings = \App\Models\Setting::first();
    $content = $settings?->robots_txt 
        ?? "User-agent: *\nAllow: /\nDisallow: /admin/\nSitemap: " . url('/sitemap.xml');
    return response($content, 200)->header('Content-Type', 'text/plain');
});
// Admin-only route to serve private verification documents
// Admin-only route to serve private verification documents
Route::middleware('auth')->group(function () {
    Route::get('/admin/documents/{type}/{user}', function (string $type, User $user) {

        /** @var \App\Models\User $admin */
        $admin = \Illuminate\Support\Facades\Auth::user();

        if (!$admin || !$admin->hasRole('Super-Admin')) {
            abort(403, 'Unauthorized.');
        }

        $path = match($type) {
            'nid'      => $user->nid_path,
            'academic' => $user->academic_certificate_path,
            default    => null,
        };

        if (!$path || !\Illuminate\Support\Facades\Storage::disk('private')->exists($path)) {
            abort(404, 'Document not found.');
        }

        $fullPath = \Illuminate\Support\Facades\Storage::disk('private')->path($path);
        $mimeType = mime_content_type($fullPath) ?: 'application/octet-stream';

        return response()->file($fullPath, [
            'Content-Type' => $mimeType,
        ]);

    })->name('admin.document.view');
});
// 2. Standard Pages & Livewire Components
Route::get('/gallery', PhotoGalleryPage::class)->name('photo-gallery');
Route::get('/videos', App\Livewire\VideoGallery::class)->name('videos.index');
Route::get('/contact', App\Livewire\ContactPage::class)->name('contact');
Route::get('/casting', App\Livewire\CastingPage::class)->name('casting');
Route::get('/artists', ArtistDirectory::class)->name('artists.index');
Route::get('/artist/{id}', ArtistProfile::class)->name('artist.show');
Route::get('/grooming-class', App\Livewire\GroomingPage::class)->name('grooming');
Route::get('/grooming-class/{id}', \App\Livewire\GroomingBatchShow::class)->name('grooming.show');

// 3. About Page
Route::get('/about', function () {
    $settings = Setting::first();
    return view('about', compact('settings'));
})->name('about');

// 4. Editorial / Blog
Route::get('/editorial', function () {
    $editorials = Editorial::where('is_published', true)
        ->orderBy('published_at', 'desc')
        ->paginate(12);
        
    return view('editorial.index', compact('editorials'));
})->name('editorial.index');

Route::get('/editorial/{editorial}', function (Editorial $editorial) {
    abort_if(!$editorial->is_published, 404);
    return view('editorial.show', compact('editorial'));
})->name('editorial.show');
// Static & Legal Pages
Route::get('/help', function () {
    $settings = \App\Models\Setting::first();
    return view('pages.help', compact('settings'));
})->name('help');

Route::get('/privacy', function () {
    $settings = \App\Models\Setting::first();
    return view('pages.privacy', compact('settings'));
})->name('privacy');

Route::get('/terms', function () {
    $settings = \App\Models\Setting::first();
    return view('pages.terms', compact('settings'));
})->name('terms');

Route::get('/legal', function () {
    $settings = \App\Models\Setting::first();
    return view('pages.legal', compact('settings'));
})->name('legal');
// 5. Public Pricing Page (Renamed to avoid conflict)
Route::get('/pricing', [App\Http\Controllers\PaymentController::class, 'show'])->name('pricing.index');


/*
|--------------------------------------------------------------------------
| Authentication Routes (Requires Login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    
    // Package & Payment Routes (Private)
    Route::get('/packages', [App\Http\Controllers\PackageController::class, 'index'])->name('packages.index');
    Route::post('/packages/pay', [App\Http\Controllers\PackageController::class, 'pay'])->name('packages.pay');
    
    // Artist Dashboard
    Route::get('/account', App\Livewire\ArtistAccount::class)->name('account.dashboard');
    
});

require __DIR__ . '/auth.php';