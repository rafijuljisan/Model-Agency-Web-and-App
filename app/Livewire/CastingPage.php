<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Setting;
use App\Models\CastingCall;

class CastingPage extends Component
{
    public function render()
    {
        $settings = Setting::first();
        
        // Fetch all active casting calls from the database, newest first!
        $castings = CastingCall::where('is_active', true)
                                ->latest()
                                ->get();

        return view('livewire.casting-page', compact('settings', 'castings'))
            ->layout('layouts.app')
            ->title('Casting Calls | AgencyMarket');
    }
}