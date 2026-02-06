<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-white">Sales Reports</h1>
        
        <!-- Date Filters -->
        <!-- Date Filters -->
        <div class="flex items-center gap-4 bg-deep-navy border border-royal-blue rounded-xl p-2" wire:ignore>
            <div class="flex items-center gap-2">
                <span class="text-gray-400 text-sm">Date Range:</span>
                <input type="text" id="reportrange" class="bg-black/30 border border-gray-600 rounded-lg px-3 py-1 text-white text-sm focus:border-bright-blue outline-none transition w-64 text-center cursor-pointer">
            </div>
        </div>
    </div>

    @script
    <script>
        $(function() {
            var start = moment('{{ $startDate }}');
            var end = moment('{{ $endDate }}');

            function cb(start, end) {
                $('#reportrange').val(start.format('MM/DD/YYYY') + ' - ' + end.format('MM/DD/YYYY'));
            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                   'Today': [moment(), moment()],
                   'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                   'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                   'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                   'This Month': [moment().startOf('month'), moment().endOf('month')],
                   'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);

            cb(start, end);

            // Update Livewire when date is chosen
            $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
                $wire.set('startDate', picker.startDate.format('YYYY-MM-DD'));
                $wire.set('endDate', picker.endDate.format('YYYY-MM-DD'));
            });
        });
    </script>
    @endscript

    <!-- Sales Table -->
    <div class="bg-deep-navy border border-royal-blue rounded-2xl overflow-hidden">
        <div class="p-4 border-b border-royal-blue/30 flex justify-between items-center">
            <h3 class="text-white font-bold">Sales History</h3>
            <span class="text-xs text-gray-500">Showing all records for selected range</span>
        </div>
        <table class="w-full text-left text-gray-400">
            <thead class="bg-royal-blue/20 uppercase text-xs font-bold text-white">
                <tr>
                    <th class="px-6 py-4">Date</th>
                    <th class="px-6 py-4">Cashier</th>
                    <th class="px-6 py-4">Items</th>
                    <th class="px-6 py-4 text-right">Buy Price</th>
                    <th class="px-6 py-4 text-right">Sell Price</th>
                    <th class="px-6 py-4 text-right">Profit</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-royal-blue/30">
                @forelse($sales as $sale)
                <tr class="hover:bg-white/5 transition">
                    <td class="px-6 py-4">{{ $sale->created_at->format('Y-m-d H:i') }}</td>
                    <td class="px-6 py-4 text-white">{{ $sale->user->name ?? 'Unknown' }}</td>
                    <td class="px-6 py-4">{{ $sale->items->sum('quantity') }}</td>
                    <td class="px-6 py-4 text-right font-mono text-gray-400 text-lg">{{ number_format($sale->buy_price) }}</td>
                    <td class="px-6 py-4 text-right font-mono text-cyan text-lg">{{ number_format($sale->total_amount) }}</td>
                    <td class="px-6 py-4 text-right font-mono font-bold text-lg {{ $sale->profit >= 0 ? 'text-vibrant-green' : 'text-red-400' }}">
                        {{ number_format($sale->profit) }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                        No sales found for the selected date range.
                    </td>
                </tr>
                @endforelse
            </tbody>
            <tfoot class="bg-royal-blue/20 font-bold text-white border-t-2 border-royal-blue">
                <tr>
                    <td colspan="3" class="px-6 py-4 text-right uppercase tracking-wider text-sm">Totals</td>
                    <td class="px-6 py-4 text-right font-mono text-xl">{{ number_format($totalBuyPrice) }}</td>
                    <td class="px-6 py-4 text-right font-mono text-cyan text-xl">{{ number_format($totalSellPrice) }}</td>
                    <td class="px-6 py-4 text-right font-mono text-xl {{ $totalProfit >= 0 ? 'text-vibrant-green' : 'text-red-400' }}">
                        {{ number_format($totalProfit) }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
