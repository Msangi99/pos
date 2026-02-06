<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-white">Cashier Dashboard</h1>
        <div class="text-gray-400">
            Welcome, <span class="text-white font-bold">{{ auth()->user()->name }}</span>
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Stats Card -->
        <div class="bg-deep-navy border border-royal-blue rounded-2xl p-6 hover:border-bright-blue transition shadow-lg">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold text-white">Today's Sales</h3>
                <span class="text-2xl">💰</span>
            </div>
            <p class="text-4xl font-bold text-vibrant-green font-mono">TZS {{ number_format($todaySalesTotal) }}</p>
            <p class="text-sm text-gray-400 mt-2">{{ $todaySalesCount }} Orders today</p>
        </div>

        <!-- POS Tile -->
        <a href="{{ route('cashier.pos') }}" wire:navigate class="bg-deep-navy border border-royal-blue rounded-2xl p-6 hover:border-bright-blue transition shadow-lg group cursor-pointer flex flex-col justify-between">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold text-white group-hover:text-cyan transition">New Sale / POS</h3>
                <span class="text-2xl">🛒</span>
            </div>
            <p class="text-gray-400 text-sm mb-4">Open the Point of Sale interface to process new orders.</p>
            <span class="text-bright-blue font-bold text-sm">Open POS →</span>
        </a>

        <!-- Sales History Tile -->
        <a href="{{ route('cashier.sales') }}" wire:navigate class="bg-deep-navy border border-royal-blue rounded-2xl p-6 hover:border-bright-blue transition shadow-lg group cursor-pointer flex flex-col justify-between">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold text-white group-hover:text-cyan transition">Sales History</h3>
                <span class="text-2xl">📜</span>
            </div>
            <p class="text-gray-400 text-sm mb-4">View your past transactions and daily reports.</p>
            <span class="text-bright-blue font-bold text-sm">View History →</span>
        </a>
    </div>
</div>
