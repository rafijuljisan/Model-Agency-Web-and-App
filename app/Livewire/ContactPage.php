<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Setting;

class ContactPage extends Component
{
    public function render()
    {
        $settings = Setting::first();
        
        return view('livewire.contact-page', compact('settings'))
            ->layout('layouts.app')
            ->title('Contact Us | ' . ($settings->site_name ?? 'Agency'));
    }
}