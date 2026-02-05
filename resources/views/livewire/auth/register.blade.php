<div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
    <div class="w-full bg-deep-navy rounded-2xl border border-royal-blue shadow md:mt-0 sm:max-w-md xl:p-0 backdrop-blur-sm bg-opacity-80">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
            <h1 class="text-xl font-bold leading-tight tracking-tight text-white md:text-2xl">
                Create your POS account
            </h1>
            <form class="space-y-4 md:space-y-6" wire:submit="register">
                <!-- Business Name -->
                <div>
                    <label for="tenant_name" class="block mb-2 text-sm font-medium text-white">Business / Lounge Name</label>
                    <input wire:model="tenant_name" type="text" name="tenant_name" id="tenant_name" class="bg-gray-800 border border-gray-600 text-white sm:text-sm rounded-lg focus:ring-bright-blue focus:border-bright-blue block w-full p-2.5 placeholder-gray-400" placeholder="e.g. Sky Lounge" required="">
                    @error('tenant_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Full Name -->
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-white">Your Name</label>
                    <input wire:model="name" type="text" name="name" id="name" class="bg-gray-800 border border-gray-600 text-white sm:text-sm rounded-lg focus:ring-bright-blue focus:border-bright-blue block w-full p-2.5 placeholder-gray-400" placeholder="John Doe" required="">
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-white">Work Email</label>
                    <input wire:model="email" type="email" name="email" id="email" class="bg-gray-800 border border-gray-600 text-white sm:text-sm rounded-lg focus:ring-bright-blue focus:border-bright-blue block w-full p-2.5 placeholder-gray-400" placeholder="name@company.com" required="">
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-white">Password</label>
                    <input wire:model="password" type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-800 border border-gray-600 text-white sm:text-sm rounded-lg focus:ring-bright-blue focus:border-bright-blue block w-full p-2.5 placeholder-gray-400" required="">
                    @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block mb-2 text-sm font-medium text-white">Confirm Password</label>
                    <input wire:model="password_confirmation" type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••" class="bg-gray-800 border border-gray-600 text-white sm:text-sm rounded-lg focus:ring-bright-blue focus:border-bright-blue block w-full p-2.5 placeholder-gray-400" required="">
                </div>

                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="terms" aria-describedby="terms" type="checkbox" class="w-4 h-4 border border-gray-600 rounded bg-gray-700 focus:ring-3 focus:ring-bright-blue ring-offset-gray-800" required="">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="terms" class="font-light text-gray-300">I accept the <a class="font-medium text-bright-blue hover:underline hover:text-cyan" href="#">Terms and Conditions</a></label>
                    </div>
                </div>

                <button type="submit" class="w-full text-white bg-bright-blue hover:bg-bright-blue/90 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center shadow-lg shadow-bright-blue/30 transition">
                    Create Account
                </button>
                 <div wire:loading wire:target="register" class="text-center text-sm text-cyan mt-2">
                    Creating Account...
                </div>
                <p class="text-sm font-light text-gray-400">
                    Already have an account? <a href="{{ route('login') }}" class="font-medium text-bright-blue hover:underline hover:text-cyan">Login here</a>
                </p>
            </form>
        </div>
    </div>
</div>
