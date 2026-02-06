<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Project Resta' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-deep-navy text-white font-sans antialiased min-h-screen flex">

    <!-- Sidebar (Shared) -->
    <aside class="w-64 bg-deep-navy border-r border-royal-blue fixed h-full overflow-y-auto hidden md:block">
        <div class="p-6">
            <h1 class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-cyan to-bright-blue">
                Resta POS
            </h1>
            <p class="text-xs text-gray-400 mt-1">v1.0.0</p>
        </div>
        
        <nav class="mt-6 px-4 space-y-2">
            @php
                $dashboardRoute = auth()->user()->role === 'admin' ? 'admin.dashboard' : 'cashier.dashboard';
            @endphp
            <a href="{{ route($dashboardRoute) }}" wire:navigate class="flex items-center px-4 py-3 {{ request()->routeIs($dashboardRoute) ? 'bg-royal-blue/30 text-cyan' : 'text-gray-400 hover:text-white hover:bg-white/5' }} rounded-xl transition">
                <span class="mr-3">📊</span>
                <span class="font-medium">Dashboard</span>
            </a>
            
            @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.inventory') }}" wire:navigate class="flex items-center px-4 py-3 {{ request()->routeIs('admin.inventory') ? 'bg-royal-blue/30 text-cyan' : 'text-gray-400 hover:text-white hover:bg-white/5' }} rounded-xl transition">
                <span class="mr-3">📦</span>
                <span class="font-medium">Inventory</span>
            </a>
            <a href="{{ route('admin.categories') }}" wire:navigate class="flex items-center px-4 py-3 {{ request()->routeIs('admin.categories') ? 'bg-royal-blue/30 text-cyan' : 'text-gray-400 hover:text-white hover:bg-white/5' }} rounded-xl transition">
                <span class="mr-3">🏷️</span>
                <span class="font-medium">Categories</span>
            </a>
            <a href="{{ route('admin.sales') }}" wire:navigate class="flex items-center px-4 py-3 {{ request()->routeIs('admin.sales') ? 'bg-royal-blue/30 text-cyan' : 'text-gray-400 hover:text-white hover:bg-white/5' }} rounded-xl transition">
                <span class="mr-3">💰</span>
                <span class="font-medium">Sales History</span>
            </a>
            <a href="{{ route('admin.users') }}" wire:navigate class="flex items-center px-4 py-3 {{ request()->routeIs('admin.users') ? 'bg-royal-blue/30 text-cyan' : 'text-gray-400 hover:text-white hover:bg-white/5' }} rounded-xl transition">
                <span class="mr-3">👥</span>
                <span class="font-medium">Users</span>
            </a>
            <a href="{{ route('admin.reports') }}" wire:navigate class="flex items-center px-4 py-3 {{ request()->routeIs('admin.reports') ? 'bg-royal-blue/30 text-cyan' : 'text-gray-400 hover:text-white hover:bg-white/5' }} rounded-xl transition">
                <span class="mr-3">📈</span>
                <span class="font-medium">Reports</span>
            </a>
            <a href="{{ route('admin.settings') }}" wire:navigate class="flex items-center px-4 py-3 {{ request()->routeIs('admin.settings') ? 'bg-royal-blue/30 text-cyan' : 'text-gray-400 hover:text-white hover:bg-white/5' }} rounded-xl transition">
                <span class="mr-3">⚙️</span>
                <span class="font-medium">Settings</span>
            </a>
            @endif

            @if(auth()->user()->role === 'cashier')
            <a href="{{ route('cashier.pos') }}" wire:navigate class="flex items-center px-4 py-3 {{ request()->routeIs('cashier.pos') ? 'bg-royal-blue/30 text-cyan' : 'text-gray-400 hover:text-white hover:bg-white/5' }} rounded-xl transition">
                <span class="mr-3">🛒</span>
                <span class="font-medium">POS</span>
            </a>
            <a href="{{ route('cashier.sales') }}" wire:navigate class="flex items-center px-4 py-3 {{ request()->routeIs('cashier.sales') ? 'bg-royal-blue/30 text-cyan' : 'text-gray-400 hover:text-white hover:bg-white/5' }} rounded-xl transition">
                <span class="mr-3">💰</span>
                <span class="font-medium">My Sales</span>
            </a>
            @endif
        </nav>
        
        <div class="absolute bottom-0 w-full p-4 border-t border-royal-blue/50">
             <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-400 hover:text-red-300 transition">
                    Sign Out
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 md:ml-64 p-8">
        {{ $slot }}
    </main>

</body>
</html>
