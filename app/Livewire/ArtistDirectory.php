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

    protected $paginationTheme = 'tailwind';
    // ── PRIMARY FILTERS ──
    public $search = '';
    #[Url]
    public $category = '';
    #[Url]
    public $group = '';
    public $gender = '';
    public $minAge = null;
    public $maxAge = null;
    public $minHeight = null;
    public $maxHeight = null;
    #[Url]
    public $district = '';
    #[Url]
    public $upazila = '';

    // ── ADVANCED FILTERS (NEW) ──
    public $experienceLevel = '';
    public $availability = '';
    public $minRate = null;
    public $maxRate = null;
    public $skinTone = '';
    public $hairColor = '';
    public $hairLength = '';
    public $willingToTravel = false;

    // ── UI STATE ──
    public $showMobileFilters = false;
    public $perPage = 12;

    // Reset pagination when a filter changes
    public function updating($property)
    {
        $this->resetPage();
    }

    public function updatedDistrict()
    {
        $this->upazila = ''; 
    }

    // Clean method to reset all filters at once
    public function resetFilters()
    {
        $this->reset([
            'search', 'category', 'group', 'gender', 'minAge', 'maxAge', 
            'minHeight', 'maxHeight', 'district', 'upazila', 'experienceLevel', 
            'availability', 'minRate', 'maxRate', 'skinTone', 'hairColor', 
            'hairLength', 'willingToTravel'
        ]);
        $this->resetPage();
    }

    // Add this method or merge it with your existing updating() method
    public function updatedPerPage()
    {
        $this->resetPage();
    }
    public function render()
    {
        $query = User::role('Verified-Artist')
            ->with(['profile', 'media' => fn($q) => $q->whereIn('collection_name', ['avatar', 'portfolio'])])
            ->where('verification_status', 'verified')
            ->where('nid_back_verification_status', 'verified')
            ->whereHas('subscriptions', fn($q) => $q->where('status', 'active'));

        // 1. Basic Search
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        // 2. Profile Filters
        $query->whereHas('profile', function ($q) {
            
            // Mega Menu Category Group
            if ($this->group) {
                $categoryNames = \App\Models\Category::where('group', $this->group)->pluck('name')->toArray();
                if (!empty($categoryNames)) {
                    $q->where(function($subQ) use ($categoryNames) {
                        foreach($categoryNames as $catName) {
                            $subQ->orWhereJsonContains('categories', $catName);
                        }
                    });
                }
            }
            
            // Primary Filters
            if ($this->category) $q->whereJsonContains('categories', $this->category);
            if ($this->gender) $q->where('gender', $this->gender);
            if ($this->district) $q->where('district', $this->district);
            if ($this->upazila) $q->where('upazila', $this->upazila);

            if ($this->minAge) $q->whereDate('date_of_birth', '<=', now()->subYears($this->minAge));
            if ($this->maxAge) $q->whereDate('date_of_birth', '>=', now()->subYears($this->maxAge + 1));
            if ($this->minHeight) $q->where('height_cm', '>=', $this->minHeight);
            if ($this->maxHeight) $q->where('height_cm', '<=', $this->maxHeight);

            // ── NEW ADVANCED FILTERS ──
            if ($this->experienceLevel) $q->where('experience_level', $this->experienceLevel);
            if ($this->availability) $q->where('availability', $this->availability);
            if ($this->skinTone) $q->where('skin_tone', $this->skinTone);
            if ($this->hairColor) $q->where('hair_color', $this->hairColor);
            if ($this->hairLength) $q->where('hair_length', $this->hairLength);
            
            if ($this->minRate) $q->where('hourly_rate', '>=', $this->minRate);
            if ($this->maxRate) $q->where('hourly_rate', '<=', $this->maxRate);
            
            if ($this->willingToTravel) $q->where('willing_to_travel', 1);
        });

        // ── FAIR-ROTATION ALGORITHM ──
        $seed = date('Ymd'); 
        $newThreshold = now()->subDays(15);
        $inactiveThreshold = now()->subDays(60);

        $query->orderByRaw("
            CASE 
                WHEN users.created_at >= ? THEN 1
                WHEN users.last_active_at IS NULL OR users.last_active_at < ? THEN 3
                ELSE 2
            END ASC
        ", [$newThreshold, $inactiveThreshold])
        ->orderByRaw("CASE WHEN users.created_at >= ? THEN users.created_at ELSE NULL END DESC", [$newThreshold])
        ->orderByRaw("RAND({$seed})");

        $totalCount = (clone $query)->count();
        
        // Use standard paginate() and handle the 'all' option
        $limit = $this->perPage === 'all' ? ($totalCount > 0 ? $totalCount : 1) : (int) $this->perPage;
        $artists = $query->paginate($limit);
        
        // Dynamic Sidebar Data
        $categories = \App\Models\Category::where('is_active', true)
            ->orderBy('group')
            ->orderBy('name')
            ->get()
            ->groupBy('group');
        
        $locations = \App\Models\Profile::whereNotNull('district')->distinct()->pluck('district');
        
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
            'totalCount'  => $totalCount,
            'categories' => $categories,
            'locations' => $locations,
            'upazilas' => $upazilas,
        ]);
    }
}