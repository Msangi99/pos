<div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-[80vh] lg:py-0">
    <div class="w-full bg-deep-navy rounded-2xl border border-royal-blue shadow-2xl md:mt-0 sm:max-w-md xl:p-0 backdrop-blur-xl bg-opacity-90">
        <div class="p-6 space-y-3 md:space-y-4 sm:p-8">
            <h1 class="text-xl font-bold leading-tight tracking-tight text-white md:text-2xl text-center">
                Welcome Back
            </h1>
            <form class="space-y-3 md:space-y-4" wire:submit="login">
                <div>
                    <label for="email" class="block mb-1 text-sm font-medium text-gray-300">Email</label>
                    <input wire:model="email" type="email" name="email" id="email" class="bg-deep-navy/50 border border-royal-blue text-white sm:text-sm rounded-xl focus:ring-bright-blue focus:border-bright-blue block w-full p-2.5 placeholder-gray-500 transition-all font-light" placeholder="name@company.com" required="">
                    @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="password" class="block mb-1 text-sm font-medium text-gray-300">Password</label>
                    <input wire:model="password" type="password" name="password" id="password" placeholder="••••••••" class="bg-deep-navy/50 border border-royal-blue text-white sm:text-sm rounded-xl focus:ring-bright-blue focus:border-bright-blue block w-full p-2.5 placeholder-gray-500 transition-all font-light" required="">
                    @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input wire:model="remember" id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-600 rounded bg-gray-700 focus:ring-3 focus:ring-bright-blue ring-offset-gray-800">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="remember" class="text-gray-400">Remember me</label>
                        </div>
                    </div>
                    <a href="{{ route('password.request') }}" class="text-sm font-medium text-bright-blue hover:underline hover:text-cyan" wire:navigate>Forgot password?</a>
                </div>
                <button type="submit" class="w-full text-white bg-bright-blue hover:bg-bright-blue/90 focus:ring-4 focus:outline-none focus:ring-bright-blue/50 font-bold rounded-xl text-sm px-5 py-2.5 text-center shadow-lg shadow-bright-blue/20 transition-all transform hover:scale-[1.02]">
                    Sign in
                </button>
                <div wire:loading wire:target="login" class="text-center text-xs text-cyan mt-1">
                    Authenticating...
                </div>
                <p class="text-sm font-light text-gray-400 text-center">
                    Don't have an account? <a href="{{ route('register') }}" class="font-medium text-bright-blue hover:underline hover:text-cyan" wire:navigate>Sign up</a>
                </p>
            </form>
        </div>
    </div>
</div>
