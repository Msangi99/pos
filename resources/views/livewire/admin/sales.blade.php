<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-white">Sales History</h1>
        <div class="bg-deep-navy border border-royal-blue rounded-xl px-4 py-2 text-gray-400">
            <span class="text-xs font-bold uppercase tracking-wider">Total Sales:</span>
            <span class="text-white font-bold ml-2">{{ count($sales) }}</span>
        </div>
    </div>

    <div class="bg-deep-navy border border-royal-blue rounded-2xl overflow-hidden">
        <table class="w-full text-left text-gray-400">
            <thead class="bg-royal-blue/20 uppercase text-xs font-bold text-white">
                <tr>
                    <th class="px-6 py-4">Date</th>
                    <th class="px-6 py-4">Cashier</th>
                    <th class="px-6 py-4">Items Sold (Product Name)</th>
                    <th class="px-6 py-4">Quantity</th>
                    <th class="px-6 py-4">Total Amount</th>
                    <th class="px-6 py-4">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-royal-blue/30">
                @foreach($sales as $sale)
                <tr class="hover:bg-white/5 transition">
                    <td class="px-6 py-4">
                        <div class="text-white font-medium">{{ $sale->created_at->format('M d, Y') }}</div>
                        <div class="text-xs text-gray-500">{{ $sale->created_at->format('h:i A') }}</div>
                    </td>
                    <td class="px-6 py-4">{{ $sale->user->name ?? 'Unknown' }}</td>
                    <td class="px-6 py-4">
                        <div class="flex flex-col gap-1">
                            @foreach($sale->items as $item)
                            <div class="text-white text-sm">
                                <span class="text-gray-400">•</span> {{ $item->product_name }}
                            </div>
                            @endforeach
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-col gap-1">
                            @foreach($sale->items as $item)
                            <div class="text-gray-400 text-xs text-center">
                                x{{ $item->quantity }}
                            </div>
                            @endforeach
                        </div>
                    </td>
                    <td class="px-6 py-4 font-mono text-vibrant-green font-bold">
                        {{ number_format($sale->total_amount) }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded text-xs font-bold uppercase
                            {{ $sale->status === 'completed' ? 'bg-green-500/20 text-green-400' : '' }}
                            {{ $sale->status === 'refunded' ? 'bg-red-500/20 text-red-400' : '' }}
                            {{ $sale->status === 'voided' ? 'bg-gray-500/20 text-gray-400' : '' }}
                        ">
                            {{ $sale->status }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
