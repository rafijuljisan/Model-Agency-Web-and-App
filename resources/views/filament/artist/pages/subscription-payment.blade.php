<x-filament-panels::page>
    
    <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg text-sm text-gray-700 dark:text-gray-300 mb-6">
        <h3 class="font-bold text-lg mb-2">Payment Instructions</h3>
        <p><strong>Step 1:</strong> Go to your bKash or Nagad App.</p>
        <p><strong>Step 2:</strong> Use "Send Money" to send exactly <strong>1200 BDT</strong> to <strong>017XXXXXXXX</strong> (Personal).</p>
        <p><strong>Step 3:</strong> Copy the Transaction ID (TrxID) and paste it below.</p>
    </div>

    <form wire:submit="submit">
        {{ $this->form }}
        
        <x-filament::button type="submit" class="mt-4 w-full">
            Submit Payment
        </x-filament::button>
    </form>
    
</x-filament-panels::page>