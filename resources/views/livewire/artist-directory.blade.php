<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex flex-col md:flex-row gap-8">
        
        <div class="w-full md:w-1/4 flex-shrink-0">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 sticky top-6">
                <h2 class="text-lg font-bold text-gray-900 mb-6">Filter Talent</h2>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Search Name</label>
                    <input wire:model.live.debounce.300ms="search" type="text" placeholder="e.g. Artist Name" 
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <select wire:model.live="category" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}">{{ ucfirst($cat) }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                    <select wire:model.live="location" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        <option value="">Anywhere</option>
                        @foreach($locations as $loc)
                            <option value="{{ $loc }}">{{ ucfirst($loc) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="w-full md:w-3/4">
            
            <div wire:loading class="w-full text-center py-4">
                <span class="text-sm text-gray-500 flex items-center justify-center gap-2">
                    <svg class="animate-spin h-4 w-4 text-indigo-600" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    Searching...
                </span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" wire:loading.class="opacity-50">
                @forelse($artists as $artist)
                    <a href="/artist/{{ $artist->id }}" class="group bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-200 border border-gray-100 overflow-hidden flex flex-col">
                        
                        <div class="aspect-[4/5] w-full bg-gray-200 overflow-hidden relative">
                            @if($artist->hasMedia('portfolio'))
                                <img src="{{ $artist->getFirstMediaUrl('portfolio') }}" alt="{{ $artist->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                            @endif
                            
                            <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm px-2 py-1 rounded-full flex items-center gap-1 shadow-sm">
                                <svg class="w-4 h-4 text-blue-500" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                                <span class="text-xs font-bold text-gray-900">Verified</span>
                            </div>
                        </div>

                        <div class="p-4 flex flex-col flex-grow">
                            <h3 class="text-lg font-bold text-gray-900 line-clamp-1">{{ $artist->name }}</h3>
                            <p class="text-sm text-indigo-600 font-medium mb-2">{{ ucfirst($artist->profile->category ?? 'Professional') }}</p>
                            
                            <div class="flex items-center text-xs text-gray-500 mb-4 mt-auto">
                                <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ ucfirst($artist->profile->location ?? 'Anywhere') }}
                            </div>
                            
                            <div class="border-t border-gray-100 pt-3 flex justify-between items-center">
                                <span class="text-xs text-gray-500">Starting at</span>
                                <span class="font-bold text-gray-900">{{ $artist->profile->hourly_rate ?? 'Negotiable' }} BDT<span class="text-xs text-gray-500 font-normal">/hr</span></span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full py-12 text-center bg-white rounded-xl border border-gray-100">
                        <svg class="mx-auto h-12 w-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <h3 class="text-lg font-medium text-gray-900">No artists found</h3>
                        <p class="mt-1 text-sm text-gray-500">Try adjusting your filters or search term.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $artists->links(data: ['scrollTo' => false]) }}
            </div>
            
        </div>
    </div>
</div>