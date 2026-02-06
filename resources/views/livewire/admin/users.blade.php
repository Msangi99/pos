<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-white">User Management</h1>
        <button class="bg-vibrant-green text-black font-bold px-4 py-2 rounded-xl">
            Add User
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($users as $user)
        <div class="bg-deep-navy border border-royal-blue rounded-2xl p-6 flex flex-col gap-4">
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 rounded-full bg-royal-blue flex items-center justify-center text-xl font-bold text-white uppercase">
                    {{ substr($user->name, 0, 2) }}
                </div>
                <div>
                    <h3 class="text-white font-bold">{{ $user->name }}</h3>
                    <p class="text-sm text-gray-400">{{ $user->email }}</p>
                </div>
            </div>
            <div class="flex items-center justify-between mt-2 pt-4 border-t border-royal-blue/30">
                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase
                {{ $user->role === 'admin' ? 'bg-purple-500/20 text-purple-400' : 'bg-cyan/20 text-cyan' }}">
                    {{ $user->role }}
                </span>
                <button class="text-sm text-gray-400 hover:text-white">Manage</button>
            </div>
        </div>
        @endforeach
    </div>
</div>
