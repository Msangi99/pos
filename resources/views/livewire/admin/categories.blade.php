<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-white">Categories</h1>
        <button wire:click="openCreateModal" class="bg-vibrant-green text-black font-bold px-6 py-3 rounded-xl hover:bg-green-400 transition shadow-lg shadow-green-500/20 active:scale-95">
            + New Category
        </button>
    </div>

    <!-- Categories Grid -->
    <!-- Categories Table -->
    <div class="bg-deep-navy border border-royal-blue rounded-2xl overflow-hidden">
        <table class="w-full text-left text-gray-400">
            <thead class="bg-royal-blue/20 uppercase text-xs font-bold text-white">
                <tr>
                    <th class="px-6 py-4 w-10">
                        <input type="checkbox" wire:model.live="selectAll" class="rounded bg-black/30 border-gray-600 text-bright-blue focus:ring-offset-black">
                    </th>
                    <th class="px-6 py-4">Icon</th>
                    <th class="px-6 py-4">Category Name</th>
                    <th class="px-6 py-4">Products Count</th>
                    <th class="px-6 py-4">
                        @if(count($selected) > 0)
                        <button 
                            wire:click="deleteSelected"
                            wire:confirm="Are you sure you want to delete {{ count($selected) }} categories?"
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
                @foreach($categories as $category)
                <tr class="hover:bg-white/5 transition">
                    <td class="px-6 py-4">
                        <input type="checkbox" wire:model.live="selected" value="{{ $category->id }}" class="rounded bg-black/30 border-gray-600 text-bright-blue focus:ring-offset-black">
                    </td>
                    <td class="px-6 py-4 text-2xl mb-1">{{ $category->icon }}</td>
                    <td class="px-6 py-4 text-white font-medium">{{ $category->name }}</td>
                    <td class="px-6 py-4">
                        <span class="bg-royal-blue/20 text-blue-300 px-2 py-1 rounded text-xs">
                            {{ $category->products()->count() }} Items
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <button wire:click="openEditModal({{ $category->id }})" class="text-cyan hover:text-white transition">Edit</button>
                            <button 
                                wire:click="delete({{ $category->id }})"
                                wire:confirm="Are you sure you want to delete this category?"
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

    <!-- Create/Edit Modal -->
    @if($showCreateModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm" wire:click="$set('showCreateModal', false)"></div>
        
        <!-- Modal Content -->
        <div class="relative bg-deep-navy border border-royal-blue rounded-3xl p-8 w-full max-w-md shadow-2xl shadow-black/50 overflow-hidden">
            <!-- Neon Glow Effect -->
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-32 h-1 bg-bright-blue blur-lg"></div>

            <button wire:click="$set('showCreateModal', false)" class="absolute top-6 right-6 text-gray-400 hover:text-white transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            
            <h3 class="text-2xl font-bold text-white mb-2">
                {{ $isEditMode ? 'Edit Category' : 'New Category' }}
            </h3>
            <p class="text-gray-400 text-sm mb-6">Organize your menu items efficiently.</p>

            <form wire:submit.prevent="save" class="space-y-5">
                <div>
                    <label class="block text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Category Name</label>
                    <input type="text" wire:model="name" class="w-full bg-black/50 border border-royal-blue rounded-xl p-4 text-white placeholder-gray-600 focus:border-bright-blue focus:ring-1 focus:ring-bright-blue outline-none transition" placeholder="e.g. Cocktails">
                    @error('name') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Icon / Emoji</label>
                    <input type="text" wire:model="icon" class="w-full bg-black/50 border border-royal-blue rounded-xl p-4 text-white placeholder-gray-600 focus:border-bright-blue focus:ring-1 focus:ring-bright-blue outline-none transition" placeholder="e.g. 🍹">
                    @error('icon') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-bright-blue text-white font-bold py-4 rounded-xl hover:bg-blue-600 hover:shadow-lg hover:shadow-blue-500/30 transition active:scale-95 uppercase tracking-wide">
                        {{ $isEditMode ? 'Update Category' : 'Save Category' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
