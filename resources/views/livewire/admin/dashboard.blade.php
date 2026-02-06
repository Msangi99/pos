<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-white">Admin Dashboard</h1>
        <div class="text-gray-400">
            Tenant: <span class="text-white font-mono">{{ auth()->user()->tenant_id }}</span>
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Revenue Card (Stats) -->
        <div class="bg-deep-navy border border-royal-blue rounded-2xl p-6 hover:border-bright-blue transition shadow-lg">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold text-white">Today's Revenue</h3>
                <span class="text-2xl">💰</span>
            </div>
            <p class="text-4xl font-bold text-vibrant-green font-mono">TZS {{ number_format($todayRevenue) }}</p>
            <p class="text-sm text-gray-400 mt-2">{{ $todayOrders }} Orders today</p>
        </div>

        <!-- Management Links -->
        <a href="{{ route('admin.inventory') }}" wire:navigate class="bg-deep-navy border border-royal-blue rounded-2xl p-6 hover:border-bright-blue transition shadow-lg group cursor-pointer">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold text-white group-hover:text-cyan transition">Inventory</h3>
                <span class="text-2xl">📦</span>
            </div>
            <p class="text-gray-400 text-sm mb-4">Manage products, categories, suppliers, and stock levels.</p>
            <span class="text-bright-blue font-bold text-sm">Manage Items →</span>
        </a>

        <a href="{{ route('admin.users') }}" wire:navigate class="bg-deep-navy border border-royal-blue rounded-2xl p-6 hover:border-bright-blue transition shadow-lg group cursor-pointer">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold text-white group-hover:text-cyan transition">Users & Roles</h3>
                <span class="text-2xl">👥</span>
            </div>
            <p class="text-gray-400 text-sm mb-4">Add cashiers, managers, and configure access permissions.</p>
            <span class="text-bright-blue font-bold text-sm">Manage Users →</span>
        </a>

        <a href="{{ route('admin.reports') }}" wire:navigate class="bg-deep-navy border border-royal-blue rounded-2xl p-6 hover:border-bright-blue transition shadow-lg group cursor-pointer">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold text-white group-hover:text-cyan transition">Reports</h3>
                <span class="text-2xl">📊</span>
            </div>
            <p class="text-gray-400 text-sm mb-4">View sales reports, audit logs, and shift summaries.</p>
            <span class="text-bright-blue font-bold text-sm">View Analytics →</span>
        </a>

        <a href="{{ route('admin.settings') }}" wire:navigate class="bg-deep-navy border border-royal-blue rounded-2xl p-6 hover:border-bright-blue transition shadow-lg group cursor-pointer">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold text-white group-hover:text-cyan transition">Settings</h3>
                <span class="text-2xl">⚙️</span>
            </div>
            <p class="text-gray-400 text-sm mb-4">Configure receipts, taxes, printer settings, and subscriptions.</p>
            <span class="text-bright-blue font-bold text-sm">System Config →</span>
        </a>
    </div>
</div>
