<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Editorial;
use App\Models\Setting;
use App\Livewire\ArtistDirectory;
use App\Livewire\ArtistProfile;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// 1. The Homepage
Route::get('/', function () {
    $featuredArtists = User::role('Verified-Artist')
        ->with(['profile', 'media'])
        ->whereHas('subscriptions', function ($q) {
            $q->where('status', 'active');
        })
        ->inRandomOrder()
        ->take(8)
        ->get();

    return view('welcome', [
        'featuredArtists' => $featuredArtists
    ]);
});

// 2. Standard Pages & Livewire Components
Route::get('/videos', App\Livewire\VideoGallery::class)->name('videos.index');
Route::get('/contact', App\Livewire\ContactPage::class)->name('contact');
Route::get('/casting', App\Livewire\CastingPage::class)->name('casting');
Route::get('/artists', ArtistDirectory::class)->name('artists.index');
Route::get('/artist/{id}', ArtistProfile::class)->name('artist.show');

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