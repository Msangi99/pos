<div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-[90vh] lg:py-0">
    <div class="w-full bg-deep-navy rounded-2xl border border-royal-blue shadow-2xl md:mt-0 sm:max-w-md xl:p-0 backdrop-blur-xl bg-opacity-90">
        <div class="p-6 space-y-3 md:space-y-4 sm:p-8">
            <h1 class="text-xl font-bold leading-tight tracking-tight text-white md:text-2xl text-center">
                New POS Account
            </h1>
            <form class="space-y-3 md:space-y-4" wire:submit="register">
                <!-- Business Name -->
                <div>
                    <label for="tenant_name" class="block mb-1 text-sm font-medium text-gray-300">Business / Lounge Name</label>
                    <input wire:model="tenant_name" type="text" name="tenant_name" id="tenant_name" class="bg-deep-navy/50 border border-royal-blue text-white sm:text-sm rounded-xl focus:ring-bright-blue focus:border-bright-blue block w-full p-2.5 placeholder-gray-500 transition-all font-light" placeholder="e.g. Sky Lounge" required="">
                    @error('tenant_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Full Name -->
                <div>
                    <label for="name" class="block mb-1 text-sm font-medium text-gray-300">Your Name</label>
                    <input wire:model="name" type="text" name="name" id="name" class="bg-deep-navy/50 border border-royal-blue text-white sm:text-sm rounded-xl focus:ring-bright-blue focus:border-bright-blue block w-full p-2.5 placeholder-gray-500 transition-all font-light" placeholder="John Doe" required="">
                    @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block mb-1 text-sm font-medium text-gray-300">Work Email</label>
                    <input wire:model="email" type="email" name="email" id="email" class="bg-deep-navy/50 border border-royal-blue text-white sm:text-sm rounded-xl focus:ring-bright-blue focus:border-bright-blue block w-full p-2.5 placeholder-gray-500 transition-all font-light" placeholder="name@company.com" required="">
                    @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Password Row -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block mb-1 text-sm font-medium text-gray-300">Password</label>
                        <input wire:model="password" type="password" name="password" id="password" placeholder="••••••••" class="bg-deep-navy/50 border border-royal-blue text-white sm:text-sm rounded-xl focus:ring-bright-blue focus:border-bright-blue block w-full p-2.5 placeholder-gray-500 transition-all font-light" required="">
                        @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="password_confirmation" class="block mb-1 text-sm font-medium text-gray-300">Confirm</label>
                        <input wire:model="password_confirmation" type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••" class="bg-deep-navy/50 border border-royal-blue text-white sm:text-sm rounded-xl focus:ring-bright-blue focus:border-bright-blue block w-full p-2.5 placeholder-gray-500 transition-all font-light" required="">
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="terms" aria-describedby="terms" type="checkbox" class="w-4 h-4 border border-gray-600 rounded bg-gray-700 focus:ring-3 focus:ring-bright-blue ring-offset-gray-800" required="">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="terms" class="font-light text-gray-400">I accept the <a class="font-medium text-bright-blue hover:underline hover:text-cyan" href="#">Terms</a></label>
                    </div>
                </div>

                <button type="submit" class="w-full text-white bg-bright-blue hover:bg-bright-blue/90 focus:ring-4 focus:outline-none focus:ring-bright-blue/50 font-bold rounded-xl text-sm px-5 py-2.5 text-center shadow-lg shadow-bright-blue/20 transition-all transform hover:scale-[1.02]">
                    Create Account
                </button>
                 <div wire:loading wire:target="register" class="text-center text-xs text-cyan mt-1">
                    Creating Account...
                </div>
                <p class="text-sm font-light text-gray-400 text-center">
                    Already have an account? <a href="{{ route('login') }}" class="font-medium text-bright-blue hover:underline hover:text-cyan" wire:navigate>Login here</a>
                </p>
            </form>
        </div>
    </div>
</div>
