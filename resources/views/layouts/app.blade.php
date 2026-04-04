<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $title ?? 'Verified Talent Directory' }} | Your Agency</title>
        
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased bg-gray-50 text-gray-900">
        
        <nav class="bg-white shadow-sm border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="/" class="text-xl font-bold text-indigo-600 tracking-tight">
                            AgencyMarket.
                        </a>
                    </div>
                    <div class="flex items-center space-x-6">
                        <a href="/artists" class="text-sm font-medium text-gray-700 hover:text-indigo-600">Browse Talent</a>
                        
                        @auth
                            <a href="/app" class="text-sm font-medium text-gray-700 hover:text-indigo-600">Dashboard</a>
                        @else
                            <a href="/login" class="text-sm font-medium text-gray-700 hover:text-indigo-600">Log in</a>
                            <a href="/register" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                                Join as Professional
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <main>
            {{ $slot }}
        </main>

        <footer class="bg-white mt-12 border-t border-gray-200">
            <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} AgencyMarket. All rights reserved.
            </div>
        </footer>

        @livewireScripts
    </body>
</html>