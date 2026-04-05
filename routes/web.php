<?php

use App\Livewire\ArtistDirectory;
use Illuminate\Support\Facades\Route;
use App\Livewire\ArtistProfile;
use App\Models\User;
use App\Models\Package;
use App\Http\Controllers\PaymentController;
use App\Models\Editorial;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// 1. The Homepage (We will customize this view later)
Route::get('/', function () {
    // Fetch up to 8 verified artists who have an active subscription
    $featuredArtists = User::role('Verified-Artist')
        ->with(['profile', 'media'])
        ->whereHas('subscriptions', function ($q) {
            $q->where('status', 'active');
        })
        ->inRandomOrder() // Mixes them up so the homepage always looks fresh
        ->take(8)
        ->get();

    return view('welcome', [
        'featuredArtists' => $featuredArtists
    ]);
});

// 2. The Searchable Talent Directory (Livewire Component)
Route::get('/artists', ArtistDirectory::class)->name('artists.index');
Route::get('/artist/{id}', ArtistProfile::class)->name('artist.show');
Route::get('/pricing', [PaymentController::class, 'show'])->name('packages.index');
Route::post('/pricing', [PaymentController::class, 'store'])->name('packages.pay');
Route::get('/about', function () {
    // Fetch settings and pass to the view
    $settings = \App\Models\Setting::first();
    return view('about', compact('settings'));
})->name('about');

// Editorial Feed (Index)
Route::get('/editorial', function () {
    $editorials = Editorial::where('is_published', true)
        ->orderBy('published_at', 'desc')
        ->paginate(12);
        
    return view('editorial.index', compact('editorials'));
})->name('editorial.index');

// Single Editorial Post (Show)
Route::get('/editorial/{editorial}', function (Editorial $editorial) {
    abort_if(!$editorial->is_published, 404);
    return view('editorial.show', compact('editorial'));
})->name('editorial.show');
// 3. Individual Artist Profile Page (We will build this in Step 6.3)
// Route::get('/artist/{id}', App\Livewire\ArtistProfile::class)->name('artist.show');


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
| This loads the default Breeze routes so users can still visit 
| /login and /register to create their accounts.
*/
Route::middleware('auth')->group(function () {

    // ✅ Now passes both $packages AND $settings
    Route::get('/packages', [PaymentController::class, 'show'])->name('packages');

    Route::post('/packages/pay', [PaymentController::class, 'store'])->name('packages.pay');
    Route::get('/account', App\Livewire\ArtistAccount::class)->name('account.dashboard');
});

require __DIR__ . '/auth.php';