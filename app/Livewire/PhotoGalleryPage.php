<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PhotoGallery;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Title('Photo Gallery | AgencyMarket')]
class PhotoGalleryPage extends Component
{
    use WithPagination;

    public function render()
    {
        $photos = PhotoGallery::where('is_active', true)
            ->latest()
            ->paginate(15); 

        return view('livewire.photo-gallery-page', [
            'photos' => $photos,
        ]);
    }
}