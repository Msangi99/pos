<div class="h-[calc(100vh-theme(spacing.24))] flex flex-col md:flex-row gap-6">
    <!-- Left Side: Product Table -->
    <div class="flex-1 flex flex-col gap-4 overflow-hidden bg-deep-navy/30 border border-royal-blue/30 rounded-3xl p-6">
        
        <!-- Header & Category Filter -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <h2 class="text-2xl font-bold text-white">Menu</h2>
            <div class="relative w-full md:w-64">
                <select 
                    wire:change="selectCategory($event.target.value)"
                    class="w-full bg-deep-navy border border-royal-blue text-white rounded-xl px-4 py-3 appearance-none focus:border-bright-blue focus:ring-1 focus:ring-bright-blue outline-none"
                    value="{{ $selectedCategory }}"
                >
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->icon }} {{ $category->name }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-400">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>
        </div>

        <!-- Product Table (Compact) -->
        <div class="flex-1 overflow-y-auto pr-2 scrollbar-thin scrollbar-thumb-royal-blue scrollbar-track-transparent">
            <table class="w-full text-left border-collapse">
                <thead class="sticky top-0 bg-deep-navy/95 backdrop-blur z-10 text-[10px] uppercase font-bold text-gray-500 border-b border-royal-blue/30">
                    <tr>
                        <th class="py-2 px-3 w-10">#</th>
                        <th class="py-2 px-3">Item Name</th>
                        <th class="py-2 px-3 text-right">Price</th>
                        <th class="py-2 px-3 text-center">Stock</th>
                        <th class="py-2 px-3 w-20"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-royal-blue/10">
                    @foreach($products as $index => $product)
                        <tr class="hover:bg-white/5 transition group">
                            <td class="py-2 px-3 text-gray-600 font-mono text-xs">{{ $index + 1 }}</td>
                            <td class="py-2 px-3">
                                <div class="font-bold text-white text-sm group-hover:text-cyan transition">{{ $product->name }}</div>
                            </td>
                            <td class="py-2 px-3 text-right font-mono text-xs text-gray-400">
                                {{ number_format($product->price) }}
                            </td>
                            <td class="py-2 px-3 text-center">
                                <span class="px-1.5 py-0.5 rounded text-[10px] font-bold 
                                    {{ $product->stock < 10 ? 'bg-red-500/10 text-red-500' : 'bg-green-500/10 text-green-500' }}">
                                    {{ $product->stock }}
                                </span>
                            </td>
                            <td class="py-2 px-3 text-right">
                                <button 
                                    wire:click="addToCart({{ $product->id }})"
                                    class="bg-bright-blue text-white px-3 py-1 rounded text-[10px] font-bold hover:bg-blue-600 active:scale-95 transition shadow-lg shadow-blue-500/20 uppercase tracking-wider"
                                >
                                    ADD
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Right Side: Cart Panel (Compact & Pro) -->
    <div class="w-full md:w-80 bg-deep-navy border border-royal-blue/30 rounded-3xl flex flex-col shadow-2xl overflow-hidden shrink-0">
        <!-- Cart Header (Minimal) -->
        <div class="px-5 py-4 border-b border-royal-blue/30 bg-royal-blue/5 flex justify-between items-center">
            <h2 class="font-bold text-white text-sm uppercase tracking-wider">Current Order</h2>
            <button wire:click="$set('cart', [])" class="text-[10px] text-red-500 hover:text-white transition uppercase font-bold border border-red-500/30 hover:bg-red-500 px-2 py-1 rounded">Clear</button>
        </div>

        <!-- Cart Items (Dense & Modern) -->
        <div class="flex-1 overflow-y-auto px-2 py-2 space-y-1 scrollbar-thin scrollbar-thumb-royal-blue">
            @forelse($cart as $item)
                <div class="flex items-center justify-between p-2 hover:bg-white/5 rounded-lg group transition shrink-0 select-none">
                    <div class="flex items-center gap-2 overflow-hidden">
                        <div class="min-w-0">
                            <h4 class="text-gray-200 font-medium text-xs truncate leading-tight">{{ $item['name'] }}</h4>
                            <div class="flex items-center gap-1 text-[10px] text-gray-500 font-mono">
                                <span>{{ $item['quantity'] }}</span>
                                <span>x</span>
                                <span>{{ number_format($item['price']) }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 shrink-0">
                        <span class="text-white font-bold font-mono text-xs">
                            {{ number_format($item['price'] * $item['quantity']) }}
                        </span>
                        <button 
                            wire:click="removeFromCart({{ $item['id'] }})"
                            class="h-5 w-5 rounded bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white flex items-center justify-center transition opacity-0 group-hover:opacity-100"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
                            </svg>
                        </button>
                    </div>
                </div>
            @empty
                <div class="h-full flex flex-col items-center justify-center text-gray-600 gap-2 opacity-50">
                    <span class="text-4xl text-gray-700">🛒</span>
                    <p class="text-xs uppercase font-bold tracking-widest">Empty</p>
                </div>
            @endforelse
        </div>

        <!-- Summary & Action (Sleek) -->
        <div class="p-4 bg-deep-navy border-t border-royal-blue/30">
             <div class="space-y-1 mb-4">
                <div class="flex justify-between text-gray-500 text-[10px] uppercase font-bold tracking-wider">
                    <span>Subtotal</span>
                    <span class="font-mono text-gray-400">{{ number_format($this->subtotal) }}</span>
                </div>
                <div class="flex justify-between text-gray-500 text-[10px] uppercase font-bold tracking-wider">
                    <span>Tax (18%)</span>
                    <span class="font-mono text-gray-400">{{ number_format($this->tax) }}</span>
                </div>
                <div class="flex justify-between text-white text-lg font-bold pt-2 border-t border-white/5 mt-2">
                    <span>Total</span>
                    <span class="text-vibrant-green font-mono">TZS {{ number_format($this->total) }}</span>
                </div>
            </div>
            
            <button 
                wire:click="charge"
                wire:confirm="Process this payment?"
                class="w-full py-3 bg-vibrant-green text-black font-bold text-sm rounded-xl hover:bg-green-400 active:scale-95 transition shadow-lg shadow-green-500/20 flex items-center justify-center gap-2 uppercase tracking-wide"
            >
                <span>Charge</span>
                <span class="bg-black/20 px-1.5 py-0.5 rounded text-[10px] font-mono">{{ count($cart) }}</span>
            </button>
            
            @if (session()->has('success'))
                <div class="mt-2 text-center text-green-400 text-xs font-bold animate-pulse">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>

    <!-- Approval Modal -->
    @if($showApprovalModal)
    <div class="fixed inset-0 bg-black/90 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-deep-navy border border-royal-blue rounded-3xl p-8 w-full max-w-sm shadow-2xl relative overflow-hidden">
            <!-- Glow -->
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-32 h-1 bg-red-500 blur-lg"></div>

            <button wire:click="closeModal" class="absolute top-4 right-4 text-gray-400 hover:text-white">✕</button>
            
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-red-500/20 text-red-500 rounded-full flex items-center justify-center text-3xl mx-auto mb-4">
                    👮
                </div>
                <h3 class="text-2xl font-bold text-white">Manager Approval</h3>
                <p class="text-gray-400 text-sm">PIN required to void item.</p>
            </div>

            <form wire:submit.prevent="verifyPin" class="space-y-4">
                <input 
                    type="password" 
                    wire:model="managerPin" 
                    class="w-full bg-black/50 border border-royal-blue rounded-xl p-4 text-white text-center text-3xl tracking-[1em] focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none placeholder-gray-700"
                    placeholder="••••"
                    autofocus
                >
                @error('managerPin') <span class="text-red-400 text-xs text-center block">{{ $message }}</span> @enderror
                
                <button type="submit" class="w-full bg-red-500 text-white font-bold py-4 rounded-xl hover:bg-red-600 transition shadow-lg shadow-red-500/20 uppercase tracking-widest text-sm">
                    Authorize Void
                </button>
            </form>
        </div>
    </div>
    @endif
</div>
