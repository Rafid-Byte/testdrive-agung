<div class="w-full min-h-screen bg-white dark:bg-zinc-900">
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-8 lg:flex-row lg:gap-12">
            <!-- Sidebar Navigation -->
            <aside class="w-full lg:w-64 shrink-0">
                <nav class="sticky top-8 space-y-1 rounded-lg bg-zinc-50 dark:bg-zinc-800/50 p-3">
                    <flux:navlist variant="pills">
                        <flux:navlist.item 
                            :href="route('profile.edit')" 
                            wire:navigate
                            class="rounded-md transition-all duration-200"
                        >
                            <span class="flex items-center gap-3">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                {{ __('Profile') }}
                            </span>
                        </flux:navlist.item>
                        
                        <flux:navlist.item 
                            :href="route('password.edit')" 
                            wire:navigate
                            class="rounded-md transition-all duration-200"
                        >
                            <span class="flex items-center gap-3">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                {{ __('Password') }}
                            </span>
                        </flux:navlist.item>
                        
                        <flux:navlist.item 
                            :href="route('appearance.edit')" 
                            wire:navigate
                            class="rounded-md transition-all duration-200"
                        >
                            <span class="flex items-center gap-3">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                                </svg>
                                {{ __('Appearance') }}
                            </span>
                        </flux:navlist.item>
                    </flux:navlist>
                </nav>
            </aside>

            <!-- Mobile Separator -->
            <flux:separator class="lg:hidden" />

            <!-- Content Area -->
            <main class="flex-1 min-w-0">
                <div class="rounded-xl bg-white dark:bg-zinc-800/50 shadow-sm ring-1 ring-zinc-200 dark:ring-zinc-700/50 p-6 sm:p-8">
                    <header class="mb-8 pb-6 border-b border-zinc-200 dark:border-zinc-700">
                        <flux:heading size="xl" class="mb-2 text-zinc-900 dark:text-zinc-100">
                            {{ $heading ?? '' }}
                        </flux:heading>
                        <flux:subheading class="text-zinc-600 dark:text-zinc-400">
                            {{ $subheading ?? '' }}
                        </flux:subheading>
                    </header>

                    <div class="w-full max-w-2xl">
                        {{ $slot }}
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>