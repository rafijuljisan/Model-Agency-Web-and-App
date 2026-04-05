<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Video;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Video Gallery | AgencyMarket')]
class VideoGallery extends Component
{
    public function render()
    {
        $videos = Video::where('is_active', true)
            ->latest()
            ->get();

        return view('livewire.video-gallery', [
            'videos' => $videos,
        ]);
    }
}