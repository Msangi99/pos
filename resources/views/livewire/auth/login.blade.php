<div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
    <div class="w-full bg-deep-navy rounded-2xl border border-royal-blue shadow md:mt-0 sm:max-w-md xl:p-0 backdrop-blur-sm bg-opacity-80">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
            <h1 class="text-xl font-bold leading-tight tracking-tight text-white md:text-2xl">
                Sign in to your account
            </h1>
            <form class="space-y-4 md:space-y-6" wire:submit="login">
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-white">Your email</label>
                    <input wire:model="email" type="email" name="email" id="email" class="bg-gray-800 border border-gray-600 text-white sm:text-sm rounded-lg focus:ring-bright-blue focus:border-bright-blue block w-full p-2.5 placeholder-gray-400" placeholder="name@company.com" required="">
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-white">Password</label>
                    <input wire:model="password" type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-800 border border-gray-600 text-white sm:text-sm rounded-lg focus:ring-bright-blue focus:border-bright-blue block w-full p-2.5 placeholder-gray-400" required="">
                    @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input wire:model="remember" id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-600 rounded bg-gray-700 focus:ring-3 focus:ring-bright-blue ring-offset-gray-800">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="remember" class="text-gray-300">Remember me</label>
                        </div>
                    </div>
                    <a href="{{ route('password.request') }}" class="text-sm font-medium text-bright-blue hover:underline hover:text-cyan">Forgot password?</a>
                </div>
                <button type="submit" class="w-full text-white bg-bright-blue hover:bg-bright-blue/90 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center shadow-lg shadow-bright-blue/30 transition">
                    Sign in
                </button>
                <div wire:loading wire:target="login" class="text-center text-sm text-cyan mt-2">
                    Authenticating...
                </div>
                <p class="text-sm font-light text-gray-400">
                    Don't have an account yet? <a href="{{ route('register') }}" class="font-medium text-bright-blue hover:underline hover:text-cyan">Sign up</a>
                </p>
            </form>
        </div>
    </div>
</div>
