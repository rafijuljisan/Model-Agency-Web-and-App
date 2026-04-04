<?php

use App\Livewire\ArtistDirectory;
use Illuminate\Support\Facades\Route;
use App\Livewire\ArtistProfile;
use App\Models\User;

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
// 3. Individual Artist Profile Page (We will build this in Step 6.3)
// Route::get('/artist/{id}', App\Livewire\ArtistProfile::class)->name('artist.show');


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
| This loads the default Breeze routes so users can still visit 
| /login and /register to create their accounts.
*/
require __DIR__.'/auth.php';