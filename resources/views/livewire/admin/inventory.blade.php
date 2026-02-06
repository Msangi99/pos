<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-white">Inventory Management</h1>
        <button wire:click="openCreateModal" class="bg-vibrant-green text-black font-bold px-4 py-2 rounded-xl hover:bg-green-400 transition">
            Add Product
        </button>
    </div>

    <div class="bg-deep-navy border border-royal-blue rounded-2xl overflow-hidden">
        <table class="w-full text-left text-gray-400">
            <thead class="bg-royal-blue/20 uppercase text-xs font-bold text-white">
                <tr>
                    <th class="px-6 py-4 w-10">
                        <input type="checkbox" wire:model.live="selectAll" class="rounded bg-black/30 border-gray-600 text-bright-blue focus:ring-offset-black">
                    </th>
                    <th class="px-6 py-4">Product Name</th>
                    <th class="px-6 py-4">Category</th>
                    <th class="px-6 py-4">Buy Price</th>
                    <th class="px-6 py-4">Sell Price</th>
                    <th class="px-6 py-4">Profit</th>
                    <th class="px-6 py-4">Stock</th>
                    <th class="px-6 py-4">
                        @if(count($selected) > 0)
                        <button 
                            wire:click="deleteSelected"
                            wire:confirm="Are you sure you want to delete {{ count($selected) }} items?"
                            class="bg-red-500 text-white text-xs px-3 py-1 rounded-lg hover:bg-red-600 transition"
                        >
                            Delete ({{ count($selected) }})
                        </button>
                        @else
                        Actions
                        @endif
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-royal-blue/30">
                @foreach($products as $product)
                <tr class="hover:bg-white/5 transition">
                    <td class="px-6 py-4">
                        <input type="checkbox" wire:model.live="selected" value="{{ $product->id }}" class="rounded bg-black/30 border-gray-600 text-bright-blue focus:ring-offset-black">
                    </td>
                    <td class="px-6 py-4 text-white font-medium">{{ $product->name }}</td>
                    <td class="px-6 py-4">{{ $product->category->name ?? 'N/A' }}</td>
                    <td class="px-6 py-4 font-mono text-gray-400">{{ number_format($product->buy_price) }}</td>
                    <td class="px-6 py-4 font-mono text-white">{{ number_format($product->price) }}</td>
                    <td class="px-6 py-4 font-mono text-vibrant-green font-bold">{{ number_format($product->profit) }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded text-xs {{ $product->stock < 10 ? 'bg-red-500/20 text-red-400' : 'bg-green-500/20 text-green-400' }}">
                            {{ $product->stock }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <button wire:click="edit({{ $product->id }})" class="text-cyan hover:text-white transition">Edit</button>
                            <button 
                                wire:click="delete({{ $product->id }})"
                                wire:confirm="Are you sure you want to delete this product? This action cannot be undone."
                                class="text-red-400 hover:text-red-300 transition"
                            >
                                Delete
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Create Product Modal -->
    @if($showCreateModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm" wire:click="$set('showCreateModal', false)"></div>
        
        <!-- Modal Content -->
        <div class="relative bg-deep-navy border border-royal-blue rounded-3xl p-8 w-full max-w-md shadow-2xl shadow-black/50 overflow-hidden">
            <!-- Neon Glow Effect -->
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-32 h-1 bg-vibrant-green blur-lg"></div>

            <button wire:click="$set('showCreateModal', false)" class="absolute top-6 right-6 text-gray-400 hover:text-white transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            
            <h3 class="text-2xl font-bold text-white mb-2">
                {{ $isEditMode ? 'Edit Product' : 'New Product' }}
            </h3>
            <p class="text-gray-400 text-sm mb-6">
                {{ $isEditMode ? 'Update product details.' : 'Add a new item to your inventory.' }}
            </p>

            <form wire:submit.prevent="save" class="space-y-5">
                <div>
                    <label class="block text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Product Name</label>
                    <input type="text" wire:model="name" class="w-full bg-black/50 border border-royal-blue rounded-xl p-4 text-white placeholder-gray-600 focus:border-bright-blue focus:ring-1 focus:ring-bright-blue outline-none transition" placeholder="e.g. Serengeti Lite">
                    @error('name') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Category</label>
                    <div class="relative">
                        <select wire:model="category_id" class="w-full appearance-none bg-black/50 border border-royal-blue rounded-xl p-4 text-white outline-none focus:border-bright-blue focus:ring-1 focus:ring-bright-blue transition cursor-pointer">
                            <option value="" class="bg-deep-navy">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" class="bg-deep-navy text-white py-2">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <!-- Custom Arrow -->
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </div>
                    </div>
                    @error('category_id') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Buy Price (Cost)</label>
                        <input type="number" wire:model="buy_price" class="w-full bg-black/50 border border-royal-blue rounded-xl p-4 text-white placeholder-gray-600 focus:border-bright-blue focus:ring-1 focus:ring-bright-blue outline-none transition" placeholder="0">
                        @error('buy_price') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Sell Price (TZS)</label>
                        <input type="number" wire:model="price" class="w-full bg-black/50 border border-royal-blue rounded-xl p-4 text-white placeholder-gray-600 focus:border-bright-blue focus:ring-1 focus:ring-bright-blue outline-none transition" placeholder="0">
                        @error('price') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Stock Qty</label>
                        <input type="number" wire:model="stock" class="w-full bg-black/50 border border-royal-blue rounded-xl p-4 text-white placeholder-gray-600 focus:border-bright-blue focus:ring-1 focus:ring-bright-blue outline-none transition" placeholder="0">
                        @error('stock') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-vibrant-green text-black font-bold py-4 rounded-xl hover:bg-green-400 hover:shadow-lg hover:shadow-green-500/30 transition active:scale-95 uppercase tracking-wide">
                        {{ $isEditMode ? 'Update Product' : 'Save Product' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
