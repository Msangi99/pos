<div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
    <div class="w-full bg-deep-navy rounded-2xl border border-royal-blue shadow md:mt-0 sm:max-w-md xl:p-0 backdrop-blur-sm bg-opacity-80">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
            <h1 class="text-xl font-bold leading-tight tracking-tight text-white md:text-2xl">
                Reset your password
            </h1>
            <p class="text-sm font-light text-gray-400">
                Enter your email address and we'll send you a link to reset your password.
            </p>

            @if ($status)
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                    {{ $status }}
                </div>
            @endif

            <form class="space-y-4 md:space-y-6" wire:submit="sendResetLink">
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-white">Your email</label>
                    <input wire:model="email" type="email" name="email" id="email" class="bg-gray-800 border border-gray-600 text-white sm:text-sm rounded-lg focus:ring-bright-blue focus:border-bright-blue block w-full p-2.5 placeholder-gray-400" placeholder="name@company.com" required="">
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
               
                <button type="submit" class="w-full text-white bg-bright-blue hover:bg-bright-blue/90 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center shadow-lg shadow-bright-blue/30 transition">
                    Send Reset Link
                </button>

                 <div wire:loading wire:target="sendResetLink" class="text-center text-sm text-cyan mt-2">
                    Sending...
                </div>

                <p class="text-sm font-light text-gray-400">
                    Remembered it? <a href="{{ route('login') }}" class="font-medium text-bright-blue hover:underline hover:text-cyan">Login here</a>
                </p>
            </form>
        </div>
    </div>
</div>
