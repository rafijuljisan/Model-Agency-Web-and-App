<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;

#[Title('Browse Verified Talent')]
class ArtistDirectory extends Component
{
    use WithPagination;

    // Existing filters
    public $search = '';

    #[Url] // <-- ADD THIS
    public $category = '';
    #[Url]
    public $group = '';
    
    // NEW Advanced Filters
    public $gender = '';
    public $minAge = null;
    public $maxAge = null;
    public $minHeight = null;
    public $maxHeight = null;
    #[Url]
    public $district = '';
    #[Url]
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
            ->with(['profile', 'media' => fn($q) => $q->whereIn('collection_name', ['avatar', 'portfolio'])])
            ->where('verification_status', 'verified')          // MUST be verified
            ->where('academic_verification_status', 'verified') // MUST be verified
            ->whereHas('subscriptions', fn($q) => $q->where('status', 'active'));

        // 1. Basic Search
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        // 2. Complex Profile Filters
        $query->whereHas('profile', function ($q) {
            
            // ── NEW: Handle Mega Menu Group Clicks ──
            if ($this->group) {
                // Find all sub-categories belonging to this group
                $categoryNames = \App\Models\Category::where('group', $this->group)->pluck('name')->toArray();
                
                if (!empty($categoryNames)) {
                    $q->where(function($subQ) use ($categoryNames) {
                        foreach($categoryNames as $catName) {
                            // If they have ANY of the skills in this group, show them
                            $subQ->orWhereJsonContains('categories', $catName);
                        }
                    });
                }
            }
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

        // ── THE NEW FAIR-ROTATION ALGORITHM ──
        
        $seed = date('Ymd'); // Generates a unique number for today (e.g., 20260407)
        $newThreshold = now()->subDays(15);
        $inactiveThreshold = now()->subDays(60);

        $query->orderByRaw("
            CASE 
                WHEN users.created_at >= ? THEN 1
                WHEN users.last_active_at IS NULL OR users.last_active_at < ? THEN 3
                ELSE 2
            END ASC
        ", [$newThreshold, $inactiveThreshold])
        
        // 1. Sort Tier 1 (New Talent) by absolute newest first
        ->orderByRaw("CASE WHEN users.created_at >= ? THEN users.created_at ELSE NULL END DESC", [$newThreshold])
        
        // 2. Sort Tier 2 (Active Talent) using the daily seeded randomizer
        // This shuffles everyone nightly, but keeps them in place during the day for pagination!
        ->orderByRaw("RAND({$seed})");

        $artists = $query->paginate(12);
        
        // ── END ALGORITHM ──

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