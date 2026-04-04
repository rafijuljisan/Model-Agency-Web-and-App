<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class ArtistProfile extends Component
{
    public User $artist;
    public bool $showContact = false;

    // This runs automatically when the page loads
    public function mount($id)
    {
        // Find the artist, but ONLY if they are verified and have an active subscription
        $this->artist = User::role('Verified-Artist')
            ->with(['profile', 'media'])
            ->whereHas('subscriptions', function ($q) {
                $q->where('status', 'active');
            })
            ->findOrFail($id); // Will throw a 404 if the artist isn't verified or doesn't exist
    }

    // The method to reveal the phone number
    public function revealContact()
    {
        if (auth()->check()) {
            $this->showContact = true;
            
            // Optional: You could log this view in the database here!
            // ProfileView::create(['user_id' => auth()->id(), 'artist_id' => $this->artist->id]);
        } else {
            return redirect()->route('login');
        }
    }

    public function render()
    {
        return view('livewire.artist-profile')
            ->title($this->artist->name . ' | Verified Talent');
    }
}