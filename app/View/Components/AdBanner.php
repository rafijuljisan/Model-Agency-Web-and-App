<?php

namespace App\View\Components;

use App\Models\Advertisement;
use Illuminate\View\Component;

class AdBanner extends Component
{
    public $position;
    public $ad;

    public function __construct($position)
    {
        $this->position = $position;
        // Fetch the latest active ad for this position
        $this->ad = Advertisement::activeAt($position)->latest()->first();
    }

    public function render()
    {
        return view('components.ad-banner');
    }
}