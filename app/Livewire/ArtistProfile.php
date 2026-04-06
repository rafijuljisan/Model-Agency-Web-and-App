<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Setting;
use Livewire\Component;

class ArtistProfile extends Component
{
    public User $artist;
    public bool $showContact = false;
    public bool $showAgencyModal = false; // Controls the new popup

    public function mount($id)
    {
        $this->artist = User::role('Verified-Artist')
            ->with(['profile', 'media'])
            ->whereHas('subscriptions', function ($q) {
                $q->where('status', 'active');
            })
            ->findOrFail($id); 
    }

    public function revealContact()
    {
        // Check if the user is logged in AND is a Super-Admin
        if (auth()->check() && auth()->user()->hasRole('Super-Admin')) {
            // Reveal the artist's private contact details
            $this->showContact = true;
        } else {
            // For visitors, clients, and other artists: Open the Agency Contact Modal
            $this->showAgencyModal = true;
        }
    }

    public function closeAgencyModal()
    {
        $this->showAgencyModal = false;
    }

    public function render()
    {
        // Fetch your global settings for the agency contact info in the modal
        $settings = Setting::first();

        return view('livewire.artist-profile', [
            'settings' => $settings
        ])->title($this->artist->name . ' | Verified Talent');
    }
}