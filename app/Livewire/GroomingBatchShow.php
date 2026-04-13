<?php

namespace App\Livewire;

use App\Models\GroomingBatch;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Grooming Batch Details')]
class GroomingBatchShow extends Component
{
    public GroomingBatch $batch;

    public function mount($id)
    {
        $this->batch = GroomingBatch::where('is_active', true)->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.grooming-batch-show');
    }
}