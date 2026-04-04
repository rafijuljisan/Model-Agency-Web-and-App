<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ArtistDirectory extends Component
{
    use WithPagination;

    public $search = '';
    public $category = '';
    public $location = '';

    public function updated($property)
    {
        if (in_array($property, ['search', 'category', 'location'])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        $query = User::role('Verified-Artist')
            ->with(['profile', 'media'])
            ->whereHas('subscriptions', function ($q) {
                $q->where('status', 'active');
            });

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        if ($this->category) {
            $query->whereHas('profile', function ($q) {
                $q->where('category', $this->category);
            });
        }

        if ($this->location) {
            $query->whereHas('profile', function ($q) {
                $q->where('location', $this->location);
            });
        }

        $artists = $query->latest()->paginate(12);
        
        $categories = \App\Models\Profile::whereNotNull('category')->distinct()->pluck('category');
        $locations = \App\Models\Profile::whereNotNull('location')->distinct()->pluck('location');

        return view('livewire.artist-directory', [
            'artists' => $artists,
            'categories' => $categories,
            'locations' => $locations,
        ])->title('Browse Verified Talent');
    }
}