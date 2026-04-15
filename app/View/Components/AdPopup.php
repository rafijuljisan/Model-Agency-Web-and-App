<?php

namespace App\View\Components;

use App\Models\Advertisement;
use Illuminate\View\Component;

class AdPopup extends Component
{
    public $ad;

    public function __construct()
    {
        // Fetch the latest active popup ad
        $this->ad = Advertisement::where('position', 'site_popup')
            ->where('is_active', true)
            ->latest()
            ->first();
    }

    public function render()
    {
        return view('components.ad-popup');
    }
}