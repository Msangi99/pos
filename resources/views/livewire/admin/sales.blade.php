<div class="space-y-6" x-data="{ activeTab: 'pending' }">
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-white">Sales History</h1>
        
        <!-- Tabs Navigation -->
        <div class="flex bg-deep-navy border border-royal-blue rounded-xl p-1">
            <button 
                @click="activeTab = 'pending'"
                :class="activeTab === 'pending' ? 'bg-royal-blue text-white shadow-lg' : 'text-gray-400 hover:text-white'"
                class="px-4 py-2 rounded-lg text-sm font-bold transition flex items-center gap-2"
            >
                ⚠️ Pending
                <span class="bg-black/30 px-2 py-0.5 rounded-full text-xs">{{ count($pendingSales) }}</span>
            </button>
            <button 
                @click="activeTab = 'completed'"
                :class="activeTab === 'completed' ? 'bg-royal-blue text-white shadow-lg' : 'text-gray-400 hover:text-white'"
                class="px-4 py-2 rounded-lg text-sm font-bold transition flex items-center gap-2"
            >
                ✅ Completed
                <span class="bg-black/30 px-2 py-0.5 rounded-full text-xs">{{ count($completedSales) }}</span>
            </button>
            <button 
                @click="activeTab = 'cancelled'"
                :class="activeTab === 'cancelled' ? 'bg-royal-blue text-white shadow-lg' : 'text-gray-400 hover:text-white'"
                class="px-4 py-2 rounded-lg text-sm font-bold transition flex items-center gap-2"
            >
                ❌ Cancelled
                <span class="bg-black/30 px-2 py-0.5 rounded-full text-xs">{{ count($cancelledSales) }}</span>
            </button>
        </div>
    </div>

    <!-- 1. PENDING SALES TAB -->
    <div x-show="activeTab === 'pending'" x-transition.opacity>
        @if($pendingSales->isNotEmpty())
        <div class="bg-deep-navy border border-yellow-500/30 rounded-2xl overflow-hidden relative">
            <div class="absolute inset-0 bg-yellow-500/5 pointer-events-none"></div>
            <table class="w-full text-left text-gray-300 relative z-10">
                <thead class="bg-yellow-500/10 uppercase text-xs font-bold text-yellow-500">
                    <tr>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4">Seller</th>
                        <th class="px-6 py-4">Items</th>
                        <th class="px-6 py-4">Total</th>
                        <th class="px-6 py-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-yellow-500/10">
                    @foreach($pendingSales as $sale)
                    <tr class="hover:bg-yellow-500/5 transition">
                        <td class="px-6 py-4">{{ $sale->created_at->format('M d, H:i') }}</td>
                        <td class="px-6 py-4 text-white">{{ $sale->user->name ?? 'Unknown' }}</td>
                        <td class="px-6 py-4 text-xs">
                            @foreach($sale->items as $item)
                                <div>{{ $item->product_name }} (x{{ $item->quantity }})</div>
                            @endforeach
                        </td>
                        <td class="px-6 py-4 font-mono font-bold text-yellow-400">{{ number_format($sale->total_amount) }}</td>
                        <td class="px-6 py-4 flex justify-center gap-2">
                            <button wire:click="approve({{ $sale->id }})" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-xs font-bold transition shadow-lg shadow-green-500/20">
                                Approve
                            </button>
                            <button wire:click="reject({{ $sale->id }})" class="bg-red-500/20 hover:bg-red-500/40 text-red-400 border border-red-500/50 px-3 py-1 rounded-lg text-xs font-bold transition">
                                Reject
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-12 text-gray-500">
            No pending sales to review.
        </div>
        @endif
    </div>

    <!-- 2. COMPLETED SALES TAB -->
    <div x-show="activeTab === 'completed'" x-transition.opacity>
        <div class="bg-deep-navy border border-royal-blue rounded-2xl overflow-hidden">
            <table class="w-full text-left text-gray-400">
                <thead class="bg-royal-blue/20 uppercase text-xs font-bold text-white">
                    <tr>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4">Seller</th>
                        <th class="px-6 py-4">Items</th>
                        <th class="px-6 py-4">Quantity</th>
                        <th class="px-6 py-4">Total</th>
                        <th class="px-6 py-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-royal-blue/30">
                    @forelse($completedSales as $sale)
                    <tr class="hover:bg-white/5 transition">
                        <td class="px-6 py-4">
                            <div class="text-white font-medium">{{ $sale->created_at->format('M d, Y') }}</div>
                            <div class="text-xs text-gray-500">{{ $sale->created_at->format('h:i A') }}</div>
                        </td>
                        <td class="px-6 py-4">{{ $sale->user->name ?? 'Unknown' }}</td>
                        <td class="px-6 py-4 text-sm">
                            @foreach($sale->items as $item)
                                <div>{{ $item->product_name }}</div>
                            @endforeach
                        </td>
                         <td class="px-6 py-4 text-sm">
                            @foreach($sale->items as $item)
                                <div>x{{ $item->quantity }}</div>
                            @endforeach
                        </td>
                        <td class="px-6 py-4 font-mono text-vibrant-green font-bold">
                            {{ number_format($sale->total_amount) }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded text-xs font-bold uppercase bg-green-500/20 text-green-400">
                                Completed
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">No completed sales found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- 3. CANCELLED SALES TAB -->
    <div x-show="activeTab === 'cancelled'" x-transition.opacity>
        <div class="bg-deep-navy border border-red-500/30 rounded-2xl overflow-hidden">
            <table class="w-full text-left text-gray-400">
                <thead class="bg-red-500/10 uppercase text-xs font-bold text-red-500">
                    <tr>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4">Seller</th>
                        <th class="px-6 py-4">Items</th>
                        <th class="px-6 py-4">Total</th>
                        <th class="px-6 py-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-red-500/10">
                    @forelse($cancelledSales as $sale)
                    <tr class="hover:bg-red-500/5 transition">
                        <td class="px-6 py-4">{{ $sale->created_at->format('M d, H:i') }}</td>
                        <td class="px-6 py-4 text-white">{{ $sale->user->name ?? 'Unknown' }}</td>
                        <td class="px-6 py-4 text-sm">
                            @foreach($sale->items as $item)
                                <div>{{ $item->product_name }} (x{{ $item->quantity }})</div>
                            @endforeach
                        </td>
                        <td class="px-6 py-4 font-mono font-bold text-red-400">{{ number_format($sale->total_amount) }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded text-xs font-bold uppercase {{ $sale->status === 'rejected' ? 'bg-red-500/20 text-red-400' : 'bg-gray-500/20 text-gray-400' }}">
                                {{ $sale->status }}
                            </span>
                        </td>
                    </tr>
                    @empty
                     <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">No cancelled sales found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
