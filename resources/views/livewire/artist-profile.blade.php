<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-8">
        <div class="h-48 w-full bg-gradient-to-r from-indigo-500 to-purple-600"></div>
        
        <div class="px-8 pb-8 relative">
            <div class="-mt-16 mb-4 flex justify-between items-end">
                <div class="relative h-32 w-32 rounded-full border-4 border-white bg-white shadow-md overflow-hidden">
                    @if($artist->hasMedia('portfolio'))
                        <img src="{{ $artist->getFirstMediaUrl('portfolio') }}" alt="{{ $artist->name }}" class="h-full w-full object-cover">
                    @else
                        <div class="h-full w-full bg-gray-200 flex items-center justify-center text-gray-500">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                    @endif
                </div>
                
                <div class="md:hidden">
                    <button wire:click="revealContact" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-bold shadow-sm hover:bg-indigo-700">
                        Contact
                    </button>
                </div>
            </div>

            <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4">
                <div>
                    <div class="flex items-center gap-2">
                        <h1 class="text-3xl font-bold text-gray-900">{{ $artist->name }}</h1>
                        <svg class="w-6 h-6 text-blue-500" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                    </div>
                    <p class="text-lg text-indigo-600 font-medium">{{ ucfirst($artist->profile->category ?? 'Professional') }}</p>
                    <div class="flex items-center text-sm text-gray-500 mt-2">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        {{ ucfirst($artist->profile->location ?? 'Location not specified') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col md:flex-row gap-8">
        
        <div class="w-full md:w-2/3 space-y-8">
            
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <h2 class="text-xl font-bold text-gray-900 mb-4">About</h2>
                <div class="prose max-w-none text-gray-600">
                    {!! nl2br(e($artist->profile->bio ?? 'This professional has not added a bio yet.')) !!}
                </div>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Portfolio</h2>
                
                @if($artist->hasMedia('portfolio'))
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($artist->getMedia('portfolio') as $media)
                            <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden cursor-pointer">
                                <img src="{{ $media->getUrl() }}" alt="Portfolio image" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-gray-500 bg-gray-50 rounded-lg border border-dashed border-gray-200">
                        No portfolio images uploaded yet.
                    </div>
                @endif
            </div>
        </div>

        <div class="w-full md:w-1/3 space-y-8">
            
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 sticky top-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Hire Details</h3>
                
                <div class="flex justify-between items-center mb-6 pb-6 border-b border-gray-100">
                    <span class="text-gray-500">Starting Rate</span>
                    <span class="text-xl font-bold text-gray-900">{{ $artist->profile->hourly_rate ?? 'Negotiable' }} BDT<span class="text-sm font-normal text-gray-500">/hr</span></span>
                </div>

                @if($showContact)
                    <div class="bg-indigo-50 border border-indigo-100 rounded-xl p-4 text-center">
                        <p class="text-xs text-indigo-600 font-bold uppercase tracking-wider mb-1">Phone Number</p>
                        <p class="text-xl font-bold text-gray-900">{{ $artist->phone ?? 'No phone provided' }}</p>
                        <p class="text-sm text-gray-500 mt-2">{{ $artist->email }}</p>
                    </div>
                @else
                    <button wire:click="revealContact" class="w-full bg-indigo-600 text-white py-3 rounded-xl font-bold shadow-md hover:bg-indigo-700 hover:shadow-lg transition-all duration-200 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        Reveal Contact Info
                    </button>
                    @guest
                        <p class="text-xs text-center text-gray-500 mt-3">You must be logged in as a Client to view contact details.</p>
                    @endguest
                @endif
            </div>

            @if($artist->profile->height || $artist->profile->weight)
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Physical Attributes</h3>
                    <div class="space-y-3">
                        @if($artist->profile->height)
                            <div class="flex justify-between">
                                <span class="text-gray-500 text-sm">Height</span>
                                <span class="font-medium text-gray-900">{{ $artist->profile->height }}</span>
                            </div>
                        @endif
                        @if($artist->profile->weight)
                            <div class="flex justify-between">
                                <span class="text-gray-500 text-sm">Weight</span>
                                <span class="font-medium text-gray-900">{{ $artist->profile->weight }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>