<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\Title;

#[Title('Browse Verified Talent')]
class ArtistDirectory extends Component
{
    use WithPagination;

    // Existing filters
    public $search = '';
    public $category = '';
    
    // NEW Advanced Filters
    public $gender = '';
    public $minAge = null;
    public $maxAge = null;
    public $minHeight = null;
    public $maxHeight = null;
    public $district = '';
    public $upazila = '';
    public $language = '';
    public $showMobileFilters = false;

    // Reset pagination when a filter changes
    public function updating($property)
    {
        $this->resetPage();
    }

    public function updatedDistrict()
    {
        $this->upazila = ''; 
    }
    public function render()
    {
        $query = User::role('Verified-Artist')
            ->with(['profile', 'media'])
            ->where('verification_status', 'verified')          // MUST be verified
            ->where('academic_verification_status', 'verified') // MUST be verified
            ->whereHas('subscriptions', fn($q) => $q->where('status', 'active'));

        // 1. Basic Search
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        // 2. Complex Profile Filters
        $query->whereHas('profile', function ($q) {
            // ── BUG FIXED: Uses whereJsonContains for the new array! ──
            if ($this->category) $q->whereJsonContains('categories', $this->category);
            
            if ($this->gender) $q->where('gender', $this->gender);
            if ($this->district) $q->where('district', $this->district);
            if ($this->upazila) $q->where('upazila', $this->upazila);

            if ($this->minAge) {
                $q->whereDate('date_of_birth', '<=', now()->subYears($this->minAge));
            }
            if ($this->maxAge) {
                $q->whereDate('date_of_birth', '>=', now()->subYears($this->maxAge + 1));
            }

            if ($this->minHeight) $q->where('height_cm', '>=', $this->minHeight);
            if ($this->maxHeight) $q->where('height_cm', '<=', $this->maxHeight);

            if ($this->language) {
                $q->whereJsonContains('languages', $this->language);
            }
        });

        $artists = $query->latest()->paginate(12);

        // Fetch dynamic categories and districts for the sidebar
        $categories = \App\Models\Category::where('is_active', true)
            ->orderBy('group')
            ->orderBy('name')
            ->get()
            ->groupBy('group');
        
        $locations = \App\Models\Profile::whereNotNull('district')->distinct()->pluck('district');
        
        // <-- ADD THIS BLOCK -->
        $upazilas = collect();
        if ($this->district) {
            $upazilas = \App\Models\Profile::where('district', $this->district)
                ->whereNotNull('upazila')
                ->where('upazila', '!=', '')
                ->distinct()
                ->pluck('upazila');
        }

        return view('livewire.artist-directory', [
            'artists' => $artists,
            'categories' => $categories,
            'locations' => $locations,
            'upazilas' => $upazilas, // <-- PASS TO VIEW
        ]);
    }
}