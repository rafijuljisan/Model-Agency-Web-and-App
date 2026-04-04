<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AgencyMarket | Top Verified Talent</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,600,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50 text-gray-900 font-sans selection:bg-indigo-500 selection:text-white">
    
    <nav class="absolute w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-extrabold text-indigo-600 tracking-tight">AgencyMarket.</a>
                </div>
                <div class="flex space-x-4">
                    <a href="/artists" class="text-sm font-medium text-gray-700 hover:text-indigo-600 px-3 py-2">Browse Directory</a>
                    @auth
                        <a href="/app" class="text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-lg shadow-sm">Dashboard</a>
                    @else
                        <a href="/login" class="text-sm font-medium text-gray-700 hover:text-indigo-600 px-3 py-2">Log In</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="relative pt-32 pb-20 sm:pt-40 sm:pb-24 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative text-center">
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight text-gray-900 mb-8">
                Hire <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">Verified</span> Talent.
            </h1>
            <p class="mt-4 max-w-2xl text-lg md:text-xl text-gray-500 mx-auto mb-10">
                The premier destination for producers and directors to discover vetted models, photographers, and creative professionals in Bangladesh.
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="/artists" class="inline-flex justify-center items-center px-8 py-4 border border-transparent text-base font-bold rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 shadow-lg hover:shadow-xl transition-all duration-200">
                    Hire Professionals
                </a>
                <a href="/register" class="inline-flex justify-center items-center px-8 py-4 border-2 border-gray-200 text-base font-bold rounded-xl text-gray-700 bg-white hover:border-indigo-600 hover:text-indigo-600 transition-all duration-200">
                    Apply as an Artist
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white py-24 sm:py-32 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight sm:text-4xl">Exclusively Verified Talent</h2>
                <p class="mt-4 max-w-2xl text-lg text-gray-500 mx-auto">
                    Every professional on AgencyMarket has passed a strict NID verification process, ensuring 100% trust and safety for your productions.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($featuredArtists as $artist)
                    <a href="/artist/{{ $artist->id }}" class="group relative bg-gray-50 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300">
                        <div class="aspect-[4/5] w-full bg-gray-200 overflow-hidden relative">
                            @if($artist->hasMedia('portfolio'))
                                <img src="{{ $artist->getFirstMediaUrl('portfolio') }}" alt="{{ $artist->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400 bg-gray-100">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                            @endif
                            
                            <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm px-2 py-1 rounded-full flex items-center gap-1 shadow-sm">
                                <svg class="w-4 h-4 text-blue-500" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                                <span class="text-xs font-bold text-gray-900">Verified</span>
                            </div>
                        </div>

                        <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-gray-900 via-gray-900/80 to-transparent p-6 pt-12">
                            <h3 class="text-lg font-bold text-white line-clamp-1">{{ $artist->name }}</h3>
                            <p class="text-sm text-indigo-300 font-medium">{{ ucfirst($artist->profile->category ?? 'Professional') }}</p>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-500">
                        More talent joining soon. Check back later!
                    </div>
                @endforelse
            </div>

            <div class="mt-16 text-center">
                <a href="/artists" class="inline-flex justify-center items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                    View Complete Directory
                </a>
            </div>
        </div>
    </div>
</body>
</html>