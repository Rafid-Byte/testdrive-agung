<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<section class="w-full max-w-4xl mx-auto">
    {{-- Back to Dashboard Button --}}
    <div class="mb-6">
        <a href="{{ route('dashboard') }}" 
           class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200 shadow-sm hover:shadow-md">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    {{-- Settings Header --}}
    <div class="mb-8">
        <div class="flex items-center gap-4 mb-2">
            <div class="p-3 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl shadow-lg">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Settings</h1>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Kelola profil dan pengaturan akun Anda</p>
            </div>
        </div>
        <div class="mt-6 h-px bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 dark:from-gray-700 dark:via-gray-600 dark:to-gray-700"></div>
    </div>

    {{-- Navigation Tabs --}}
    <div class="mb-8">
        <nav class="flex gap-2 p-1 bg-gray-100 dark:bg-gray-800 rounded-xl">
            <a href="{{ route('profile.edit') }}" 
               class="flex-1 flex items-center justify-center gap-2 px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-white/50 dark:hover:bg-gray-700/50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Profile
            </a>
            <a href="{{ route('password.edit') }}" 
               class="flex-1 flex items-center justify-center gap-2 px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-white/50 dark:hover:bg-gray-700/50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                Password
            </a>
            <a href="{{ route('appearance.edit') }}" 
               class="flex-1 flex items-center justify-center gap-2 px-4 py-3 text-sm font-semibold rounded-lg transition-all duration-200 bg-white dark:bg-gray-700 text-blue-600 dark:text-blue-400 shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                </svg>
                Appearance
            </a>
        </nav>
    </div>

    {{-- Main Content Card --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="p-8">
            <div class="mb-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Tampilan</h2>
                <p class="text-sm text-gray-600 dark:text-gray-400">Sesuaikan tampilan interface sesuai preferensi Anda</p>
            </div>

            <div class="space-y-6">
                <div>
                    <label class="text-sm font-semibold text-zinc-900 dark:text-zinc-100 block mb-3">
                        Pilih Theme
                    </label>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4" id="theme-switcher">
                        {{-- Light Theme --}}
                        <button 
                            type="button"
                            data-theme="light"
                            class="theme-button group relative p-6 rounded-xl border-2 border-gray-200 dark:border-gray-700 transition-all duration-300 hover:scale-105 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white dark:bg-zinc-800"
                        >
                            <div class="flex flex-col items-center gap-3">
                                <div class="p-3 rounded-full bg-gradient-to-br from-yellow-400 to-orange-500 group-hover:scale-110 transition-transform">
                                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                                <div class="text-center">
                                    <span class="text-base font-bold text-gray-900 dark:text-zinc-100 block">Light</span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">Terang & Cerah</span>
                                </div>
                            </div>
                            <div class="checkmark absolute top-3 right-3 hidden">
                                <div class="w-6 h-6 bg-blue-600 rounded-full flex items-center justify-center">
                                    <svg class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </button>

                        {{-- Dark Theme --}}
                        <button 
                            type="button"
                            data-theme="dark"
                            class="theme-button group relative p-6 rounded-xl border-2 border-gray-200 dark:border-gray-700 transition-all duration-300 hover:scale-105 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white dark:bg-zinc-800"
                        >
                            <div class="flex flex-col items-center gap-3">
                                <div class="p-3 rounded-full bg-gradient-to-br from-indigo-600 to-purple-600 group-hover:scale-110 transition-transform">
                                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                                    </svg>
                                </div>
                                <div class="text-center">
                                    <span class="text-base font-bold text-gray-900 dark:text-zinc-100 block">Dark</span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">Gelap & Nyaman</span>
                                </div>
                            </div>
                            <div class="checkmark absolute top-3 right-3 hidden">
                                <div class="w-6 h-6 bg-blue-600 rounded-full flex items-center justify-center">
                                    <svg class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </button>

                        {{-- System Theme --}}
                        <button 
                            type="button"
                            data-theme="system"
                            class="theme-button group relative p-6 rounded-xl border-2 border-gray-200 dark:border-gray-700 transition-all duration-300 hover:scale-105 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white dark:bg-zinc-800"
                        >
                            <div class="flex flex-col items-center gap-3">
                                <div class="p-3 rounded-full bg-gradient-to-br from-gray-600 to-gray-800 group-hover:scale-110 transition-transform">
                                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="text-center">
                                    <span class="text-base font-bold text-gray-900 dark:text-zinc-100 block">System</span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">Ikuti Sistem</span>
                                </div>
                            </div>
                            <div class="checkmark absolute top-3 right-3 hidden">
                                <div class="w-6 h-6 bg-blue-600 rounded-full flex items-center justify-center">
                                    <svg class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
                
                <div class="rounded-xl bg-blue-50 dark:bg-blue-900/20 p-4 border-l-4 border-blue-500">
                    <div class="flex gap-3">
                        <svg class="h-5 w-5 text-blue-600 dark:text-blue-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-sm text-blue-800 dark:text-blue-200">
                            Perubahan theme akan diterapkan secara otomatis dan disimpan di browser Anda.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Toast notification placeholder --}}
    <x-toast-notification on="theme-updated" />

    <script>
        (function() {
            const buttons = document.querySelectorAll('.theme-button');
            
            function showThemeNotification(themeName) {
                const notificationEl = document.querySelector('[x-data*="shown"]');
                if (notificationEl && notificationEl.__x) {
                    const component = notificationEl.__x.$data;
                    if (component && typeof component.show === 'function') {
                        component.show(`Theme diubah ke ${themeName}`, 'success');
                    }
                }
            }
            
            function applyTheme(theme) {
                const html = document.documentElement;
                const body = document.body;
                
                const shouldBeDark = theme === 'dark' || (theme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);
                
                if (shouldBeDark) {
                    html.classList.add('dark');
                    html.setAttribute('data-theme', 'dark');
                    body.classList.add('dark');
                } else {
                    html.classList.remove('dark');
                    html.setAttribute('data-theme', 'light');
                    body.classList.remove('dark');
                }
                
                localStorage.setItem('theme', theme);
                
                if (typeof Flux !== 'undefined' && Flux.appearance) {
                    Flux.appearance = theme;
                }
                
                buttons.forEach(btn => {
                    const checkmark = btn.querySelector('.checkmark');
                    if (btn.dataset.theme === theme) {
                        btn.classList.add('ring-2', 'ring-blue-500', 'border-blue-500', 'bg-blue-50', 'dark:bg-blue-900/30');
                        if (checkmark) checkmark.classList.remove('hidden');
                    } else {
                        btn.classList.remove('ring-2', 'ring-blue-500', 'border-blue-500', 'bg-blue-50', 'dark:bg-blue-900/30');
                        if (checkmark) checkmark.classList.add('hidden');
                    }
                });

                const themeNames = {
                    'light': 'Light Mode',
                    'dark': 'Dark Mode', 
                    'system': 'System Theme'
                };
                
                setTimeout(() => {
                    showThemeNotification(themeNames[theme] || theme);
                }, 100);
            }
            
            const savedTheme = localStorage.getItem('theme') || 'system';
            applyTheme(savedTheme);
            
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const theme = this.dataset.theme;
                    applyTheme(theme);
                });
            });
            
            const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
            mediaQuery.addEventListener('change', function(e) {
                const currentTheme = localStorage.getItem('theme');
                if (currentTheme === 'system') {
                    applyTheme('system');
                }
            });
        })();
    </script>
</section>