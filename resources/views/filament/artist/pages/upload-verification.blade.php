<x-filament-panels::page>
    <div class="bg-indigo-50 border border-indigo-200 text-indigo-800 p-4 rounded-xl mb-6 shadow-sm">
        <h3 class="font-bold mb-2">Why do we need this?</h3>
        <p class="text-sm">To maintain 100% trust on AgencyMarket, we require all professionals to verify their real identity. <strong>This document will NEVER be shown to the public.</strong></p>
    </div>

    <form wire:submit="submit">
        {{ $this->form }}
        
        <div class="mt-6">
            <x-filament::button type="submit" color="primary" class="w-full sm:w-auto">
                Submit Document
            </x-filament::button>
        </div>
    </form>
</x-filament-panels::page>