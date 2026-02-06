<div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-[60vh] lg:py-0">
    <div class="w-full bg-deep-navy rounded-2xl border border-royal-blue shadow-2xl md:mt-0 sm:max-w-md xl:p-0 backdrop-blur-xl bg-opacity-90">
        <div class="p-6 space-y-3 md:space-y-4 sm:p-8">
            <h1 class="text-xl font-bold leading-tight tracking-tight text-white md:text-2xl text-center">
                Reset your password
            </h1>
            <p class="text-sm font-light text-gray-400 text-center">
                Enter your email address and we'll send you a link to reset your password.
            </p>

            @if ($status)
                <div class="p-4 text-sm text-green-400 bg-deep-navy/80 border border-green-500 rounded-xl" role="alert">
                    {{ $status }}
                </div>
            @endif

            <form class="space-y-3 md:space-y-4" wire:submit="sendResetLink">
                <div>
                    <label for="email" class="block mb-1 text-sm font-medium text-gray-300">Your email</label>
                    <input wire:model="email" type="email" name="email" id="email" class="bg-deep-navy/50 border border-royal-blue text-white sm:text-sm rounded-xl focus:ring-bright-blue focus:border-bright-blue block w-full p-2.5 placeholder-gray-500 transition-all font-light" placeholder="name@company.com" required="">
                    @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
               
                <button type="submit" class="w-full text-white bg-bright-blue hover:bg-bright-blue/90 focus:ring-4 focus:outline-none focus:ring-bright-blue/50 font-bold rounded-xl text-sm px-5 py-2.5 text-center shadow-lg shadow-bright-blue/20 transition-all transform hover:scale-[1.02]">
                    Send Reset Link
                </button>

                 <div wire:loading wire:target="sendResetLink" class="text-center text-xs text-cyan mt-1">
                    Sending...
                </div>

                <p class="text-sm font-light text-gray-400 text-center">
                    Remembered it? <a href="{{ route('login') }}" class="font-medium text-bright-blue hover:underline hover:text-cyan" wire:navigate>Login here</a>
                </p>
            </form>
        </div>
    </div>
</div>
