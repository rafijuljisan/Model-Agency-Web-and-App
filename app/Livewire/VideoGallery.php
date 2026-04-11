<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Video;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Title('Video Gallery | AgencyMarket')]
class VideoGallery extends Component
{
    use WithPagination;
    public function render()
    {
        $videos = Video::where('is_active', true)
            ->latest()
            ->paginate(12); // choose how many per page

        return view('livewire.video-gallery', [
            'videos' => $videos,
        ]);
    }

}