<?php

namespace App\Livewire;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Component;

class ArtistProfile extends Component
{
    public User $artist;

    public bool $showContact = false;

    public bool $showAgencyModal = false; // Controls the new popup

    public function mount($slug)
    {
        // Extract the ID from the end of the slug
        $id = Str::afterLast($slug, '-');

        $this->artist = User::role('Verified-Artist')
            ->with(['profile', 'media', 'experiences'])
            ->whereHas('subscriptions', function ($q) {
                $q->where('status', 'active');
            })
            // Search by 'id' instead of 'member_id'
            ->where('id', $id)
            ->firstOrFail();
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

    public function generatePhotocard()
    {
        $user = auth()->user();

        $isOwner = $user && $user->id === $this->artist->id;
        $isAdmin = $user && $user->hasRole('Super-Admin');

        if (! $isOwner && ! $isAdmin) {
            $this->showAgencyModal = true; // reuse existing modal for non-auth visitors

            return;
        }

        return redirect()->route('photocard.download', $this->artist);
    }

    public function render()
    {
        $settings = Setting::first();

        // Build OG image with conversion fallback
        $ogImage = null;

        if ($this->artist->hasMedia('avatar')) {
            $ogImage = $this->artist->getFirstMedia('avatar')->getFullUrl();
        } elseif ($this->artist->hasMedia('portfolio')) {
            $ogImage = $this->artist->getFirstMedia('portfolio')->getFullUrl();
        }

        // Force HTTPS and ensure absolute URL
        if ($ogImage) {
            $ogImage = str_replace('http://', 'https://', $ogImage);
        } else {
            // Fallback static image if artist has no photo at all
            $ogImage = asset('images/og-default.jpg');
        }

        $ogTitle = $this->artist->name.' — Verified Talent | Dhaka Model Agency';

        $ogDescription = Str::limit(
            strip_tags($this->artist->profile?->bio ?? 'View this verified talent profile on Dhaka Model Agency.'),
            160
        );

        $ogUrl = route('artist.show', [
            'slug' => Str::slug($this->artist->name).'-'.$this->artist->id,
        ]);

        return view('livewire.artist-profile', [
            'settings' => $settings,
        ])->layout('layouts.app', [
            'ogImage' => $ogImage,
            'ogTitle' => $ogTitle,
            'ogDescription' => $ogDescription,
            'ogUrl' => $ogUrl,
        ]);
    }
}
