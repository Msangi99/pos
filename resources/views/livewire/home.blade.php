<div>
    <div class="relative isolate overflow-hidden">
        <div class="mx-auto max-w-7xl px-6 pb-24 pt-10 sm:pb-32 lg:flex lg:px-8 lg:py-40">
            <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-xl lg:flex-shrink-0 lg:pt-8">
                <div class="mt-24 sm:mt-32 lg:mt-16">
                    <a href="#" class="inline-flex space-x-6">
                        <span class="rounded-full bg-royal-blue/30 px-3 py-1 text-sm font-semibold leading-6 text-bright-blue ring-1 ring-inset ring-bright-blue/20">Latest Update</span>
                        <span class="inline-flex items-center space-x-2 text-sm font-medium leading-6 text-gray-300">
                            <span>v1.0 is live</span>
                            <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </a>
                </div>
                <h1 class="mt-10 text-4xl font-bold tracking-tight text-white sm:text-6xl">
                    Modern POS for the <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan to-bright-blue">Nightlife</span>
                </h1>
                <p class="mt-6 text-lg leading-8 text-gray-300">
                    Project Resta is an offline-first, anti-theft POS system designed for high-paced bars and lounges. 
                    Protect your revenue with military-grade audit logs.
                </p>
                <div class="mt-10 flex items-center gap-x-6">
                    <a href="{{ route('register') }}" class="rounded-xl bg-bright-blue px-5 py-3 text-lg font-bold text-white shadow-lg shadow-bright-blue/25 hover:bg-bright-blue/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-bright-blue transition" wire:navigate>
                        Get Started
                    </a>
                    <a href="#" class="text-sm font-semibold leading-6 text-white hover:text-cyan transition">Live Demo <span aria-hidden="true">→</span></a>
                </div>
            </div>
            
            <!-- Visual Hero Element -->
            <div class="mx-auto mt-16 flex max-w-2xl sm:mt-24 lg:ml-10 lg:mt-0 lg:mr-0 lg:max-w-none lg:flex-none xl:ml-32">
                <div class="max-w-3xl flex-none sm:max-w-5xl lg:max-w-none">
                    <div class="-m-2 rounded-xl bg-gray-900/5 p-2 ring-1 ring-inset ring-gray-900/10 lg:-m-4 lg:rounded-2xl lg:p-4">
                        <div class="rounded-xl bg-royal-blue/20 ring-1 ring-white/10 backdrop-blur-md p-6 border border-white/5 shadow-2xl">
                            <!-- Mock UI Grid -->
                            <div class="grid grid-cols-2 gap-4 w-full sm:w-[500px]">
                                <div class="col-span-2 flex justify-between items-center mb-4">
                                    <div class="h-4 w-24 bg-gray-600 rounded"></div>
                                    <div class="h-4 w-8 bg-vibrant-green rounded-full animate-pulse"></div>
                                </div>
                                <div class="bg-royal-blue p-4 rounded-xl border border-white/5 flex flex-col gap-2">
                                    <div class="h-20 w-full bg-deep-navy/50 rounded-lg"></div>
                                    <div class="h-4 w-16 bg-vibrant-green rounded"></div>
                                </div>
                                <div class="bg-royal-blue p-4 rounded-xl border border-white/5 flex flex-col gap-2">
                                    <div class="h-20 w-full bg-deep-navy/50 rounded-lg"></div>
                                    <div class="h-4 w-16 bg-vibrant-green rounded"></div>
                                </div>
                                <div class="col-span-2 bg-deep-navy/50 p-4 rounded-xl mt-2 border border-bright-blue/30">
                                    <div class="flex justify-between text-sm">
                                        <span>Total Sales</span>
                                        <span class="text-cyan font-bold">TZS 1,250,000</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Features Grid -->
    <div class="bg-deep-navy py-24 sm:py-32 border-t border-white/5">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:text-center">
                <h2 class="text-base font-semibold leading-7 text-bright-blue">Deploy Faster</h2>
                <p class="mt-2 text-3xl font-bold tracking-tight text-white sm:text-4xl">Everything you need to run your bar</p>
                <p class="mt-6 text-lg leading-8 text-gray-300">
                    From inventory tracking to employee shift management, Project Resta puts you in control.
                </p>
            </div>
            <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-4xl">
                <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-10 lg:max-w-none lg:grid-cols-2 lg:gap-y-16">
                    <!-- Feature 1 -->
                    <div class="relative pl-16">
                        <dt class="text-base font-semibold leading-7 text-white">
                            <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-royal-blue">
                                <svg class="h-6 w-6 text-cyan" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                                </svg>
                            </div>
                            Offline-First Architecture
                        </dt>
                        <dd class="mt-2 text-base leading-7 text-gray-400">Keep selling even when the internet goes down. Data syncs automatically when connection is restored.</dd>
                    </div>

                    <!-- Feature 2 -->
                    <div class="relative pl-16">
                        <dt class="text-base font-semibold leading-7 text-white">
                            <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-royal-blue">
                                <svg class="h-6 w-6 text-vibrant-green" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                                </svg>
                            </div>
                            Anti-Theft Protection
                        </dt>
                        <dd class="mt-2 text-base leading-7 text-gray-400">Blind close shifts, strict void auditing, and suspicious activity alerts keep your revenue safe.</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>
