<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Project Resta' }}</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-deep-navy text-white font-sans antialiased min-h-screen flex flex-col">
        
        <!-- Navbar -->
        <nav class="border-b border-royal-blue bg-deep-navy/80 backdrop-blur-md sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center gap-2">
                        <div class="w-8 h-8 rounded bg-gradient-to-br from-bright-blue to-royal-blue flex items-center justify-center text-white font-bold text-lg">
                            R
                        </div>
                        <span class="font-bold text-xl tracking-tight">Project <span class="text-bright-blue">Resta</span></span>
                    </div>

                    <!-- Right Side -->
                    <div class="flex items-center gap-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-medium hover:text-cyan transition" wire:navigate>Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-medium hover:text-cyan transition" wire:navigate>Login</a>
                            <a href="{{ route('register') }}" class="px-4 py-2 rounded-xl bg-bright-blue hover:bg-bright-blue/90 text-white text-sm font-bold transition shadow-lg shadow-bright-blue/20" wire:navigate>
                                Get Started
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="flex-grow flex flex-col justify-center relative">
            <!-- Background Glow Effects -->
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-royal-blue/20 rounded-full blur-3xl pointer-events-none -z-10"></div>
            <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-cyan/10 rounded-full blur-3xl pointer-events-none -z-10"></div>

            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="border-t border-royal-blue bg-deep-navy py-8 mt-auto">
            <div class="max-w-7xl mx-auto px-4 text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} Project Resta. All rights reserved.
            </div>
        </footer>

    </body>
</html>
