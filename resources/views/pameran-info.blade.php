<x-layouts.app :title="'Pameran Info'">
    <div x-data="pameranInfoData()" x-init="init()"
        class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 transition-all duration-300">
        <div class="flex">
            {{-- Sidebar Navigation --}}
            <aside class="fixed left-0 top-0 z-40 h-screen shadow-2xl transition-transform duration-300"
                :class="sidebarOpen ? 'translate-x-0 w-72' : '-translate-x-full w-72'">
                <div
                    class="h-full bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-700 flex flex-col">
                    {{-- Logo Section --}}
                    <div class="px-6 py-6 border-b border-gray-200 dark:border-gray-700">
                        <a href="{{ route('pameran-info') }}" class="flex items-center space-x-3 group">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center shadow-lg group-hover:shadow-xl transition-shadow">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <span
                                    class="text-xl font-bold text-gray-900 dark:text-white block leading-tight">Pameran
                                    Info</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">Management Portal</span>
                            </div>
                        </a>
                    </div>

                    {{-- Navigation Menu --}}
                    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                        <div class="mb-4">
                            <p
                                class="px-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Main Menu</p>
                        </div>

                        @if (auth()->user()->canAccessDashboard())
                            <a href="{{ route('dashboard') }}"
                                class="flex items-center px-4 py-3.5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-xl group transition-all duration-200">
                                <div
                                    class="w-10 h-10 bg-gray-100 dark:bg-gray-800 rounded-lg flex items-center justify-center mr-3 group-hover:bg-gradient-to-br group-hover:from-blue-600 group-hover:to-indigo-600 transition-all duration-200">
                                    <svg class="w-5 h-5 text-gray-600 dark:text-gray-400 group-hover:text-white transition-colors"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                        </path>
                                    </svg>
                                </div>
                                <span class="font-medium">Dashboard</span>
                            </a>
                        @endif

                        <a href="{{ route('checksheet') }}"
                            class="flex items-center px-4 py-3.5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-xl group transition-all duration-200">
                            <div
                                class="w-10 h-10 bg-gray-100 dark:bg-gray-800 rounded-lg flex items-center justify-center mr-3 group-hover:bg-gradient-to-br group-hover:from-blue-600 group-hover:to-indigo-600 transition-all duration-200">
                                <svg class="w-5 h-5 text-gray-600 dark:text-gray-400 group-hover:text-white transition-colors"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                    </path>
                                </svg>
                            </div>
                            <span class="font-medium">Check Sheet</span>
                        </a>

                        <a href="{{ route('pameran-info') }}"
                            class="flex items-center px-4 py-3.5 text-gray-900 dark:text-white bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/30 dark:to-indigo-900/30 rounded-xl border border-blue-200 dark:border-blue-800 group transition-all duration-200 shadow-sm">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center mr-3 shadow-md group-hover:shadow-lg transition-shadow">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <span class="font-semibold">Pameran Info</span>
                        </a>
                    </nav>

                    {{-- User Profile Section --}}
                    <div
                        class="p-4 mt-auto border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                        <div class="mb-3">
                            <div
                                class="flex items-center gap-3 p-3 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                                <div
                                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-blue-600 to-indigo-600 text-white font-bold shadow-md">
                                    {{ auth()->user()->initials() }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">
                                        {{ auth()->user()->name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate">
                                        {{ auth()->user()->email }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-1">
                            @if (Route::has('profile.edit'))
                                <a href="{{ route('profile.edit') }}"
                                    class="flex items-center px-4 py-2.5 text-gray-700 dark:text-gray-300 hover:bg-white dark:hover:bg-gray-800 rounded-lg group transition-all duration-200">
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 mr-3 transition-colors"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span class="text-sm font-medium">Settings</span>
                                </a>
                            @endif

                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit"
                                    class="w-full flex items-center px-4 py-2.5 text-left text-gray-700 dark:text-gray-300 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg group transition-all duration-200">
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400 group-hover:text-red-600 dark:group-hover:text-red-400 mr-3 transition-colors"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                        </path>
                                    </svg>
                                    <span
                                        class="text-sm font-medium group-hover:text-red-600 dark:group-hover:text-red-400 transition-colors">Log
                                        Out</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </aside>

            {{-- Overlay for mobile when sidebar is open --}}
            <div x-show="sidebarOpen" @click="sidebarOpen = false"
                x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden"></div>

            {{-- Main Content --}}
            <div class="w-full transition-all duration-300" :class="sidebarOpen ? 'lg:ml-72' : 'lg:ml-0'">
                <div class="max-w-7xl mx-auto">
                    {{-- Top Navigation Bar --}}
                    <nav
                        class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-4 py-3 lg:px-6 sticky top-0 z-20">
                        <div class="flex items-center justify-between">
                            <button @click="sidebarOpen = !sidebarOpen"
                                class="p-2 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>

                            <div class="flex items-center gap-2 lg:gap-4 ml-auto">
                                {{-- Dark Mode Toggle --}}
                                <button @click="darkMode = !darkMode"
                                    class="p-2 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                                    <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z">
                                        </path>
                                    </svg>
                                    <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                                        </path>
                                    </svg>
                                </button>

                                {{-- Page Title - Hidden on mobile --}}
                                <div class="hidden md:block">
                                    <h1 class="text-lg lg:text-xl font-bold text-gray-900 dark:text-white">Pameran Info
                                    </h1>
                                    <p class="text-xs lg:text-sm text-gray-500 dark:text-gray-400">Kelola informasi
                                        booking pameran
                                    </p>
                                </div>
                            </div>
                        </div>
                    </nav>

                    {{-- Main Content Area --}}
                    <div class="p-3 lg:p-6">
                        {{-- Filters & Search --}}
                        <div
                            class="mb-4 lg:mb-6 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4 lg:p-6">
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-3 lg:gap-4">
                                <div class="lg:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Cari Booking
                                    </label>
                                    <div class="relative">
                                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                        <input type="text" x-model="searchQuery" @input="debounceSearch()"
                                            placeholder="Cari nama PIC, mobil, atau lokasi..."
                                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white text-sm lg:text-base">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Filter Status
                                    </label>
                                    <select x-model="statusFilter" @change="loadBookings()"
                                        class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white text-sm lg:text-base">
                                        <option value="">Semua Status</option>
                                        <option value="Dikonfirmasi">Dikonfirmasi</option>
                                        <option value="Diproses">Diproses</option>
                                        <option value="Sedang Pameran">Sedang Pameran</option>
                                        <option value="Perawatan">Perawatan</option>
                                        <option value="Selesai">Selesai</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- Stats Cards --}}
                        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 lg:gap-4 mb-4 lg:mb-6">
                            <div
                                class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-3 lg:p-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-xs lg:text-sm text-gray-600 dark:text-gray-400">Total Booking
                                        </p>
                                        <p class="text-xl lg:text-2xl font-bold text-gray-900 dark:text-white"
                                            x-text="totalBookings"></p>
                                    </div>
                                    <div
                                        class="w-10 h-10 lg:w-12 lg:h-12 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 lg:w-6 lg:h-6 text-blue-600 dark:text-blue-400"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-3 lg:p-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-xs lg:text-sm text-gray-600 dark:text-gray-400">Sedang Pameran
                                        </p>
                                        <p class="text-xl lg:text-2xl font-bold text-blue-600 dark:text-blue-400"
                                            x-text="statusCount.sedangPameran || 0"></p>
                                    </div>
                                    <div
                                        class="w-10 h-10 lg:w-12 lg:h-12 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 lg:w-6 lg:h-6 text-blue-600 dark:text-blue-400"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-3 lg:p-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-xs lg:text-sm text-gray-600 dark:text-gray-400">Perawatan</p>
                                        <p class="text-xl lg:text-2xl font-bold text-yellow-600 dark:text-yellow-400"
                                            x-text="statusCount.perawatan || 0"></p>
                                    </div>
                                    <div
                                        class="w-10 h-10 lg:w-12 lg:h-12 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 lg:w-6 lg:h-6 text-yellow-600 dark:text-yellow-400"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-3 lg:p-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-xs lg:text-sm text-gray-600 dark:text-gray-400">Selesai</p>
                                        <p class="text-xl lg:text-2xl font-bold text-green-600 dark:text-green-400"
                                            x-text="statusCount.selesai || 0"></p>
                                    </div>
                                    <div
                                        class="w-10 h-10 lg:w-12 lg:h-12 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 lg:w-6 lg:h-6 text-green-600 dark:text-green-400"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Bookings Table - Desktop --}}
                        <div
                            class="hidden lg:block bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Daftar Booking Pameran
                                </h3>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead
                                        class="bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700">
                                        <tr>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                                PIC
                                            </th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                                Mobil
                                            </th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                                Tanggal Acara
                                            </th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                                Lokasi
                                            </th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                                Status
                                            </th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                        <template x-if="loading">
                                            <tr>
                                                <td colspan="6" class="px-6 py-12 text-center">
                                                    <div class="flex flex-col items-center justify-center">
                                                        <svg class="animate-spin h-8 w-8 text-blue-600 mb-3"
                                                            fill="none" viewBox="0 0 24 24">
                                                            <circle class="opacity-25" cx="12" cy="12"
                                                                r="10" stroke="currentColor" stroke-width="4">
                                                            </circle>
                                                            <path class="opacity-75" fill="currentColor"
                                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                            </path>
                                                        </svg>
                                                        <p class="text-gray-500 dark:text-gray-400">Memuat data...</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        </template>

                                        <template x-if="!loading && bookings.length === 0">
                                            <tr>
                                                <td colspan="6" class="px-6 py-12 text-center">
                                                    <div class="flex flex-col items-center justify-center">
                                                        <svg class="w-16 h-16 text-gray-400 mb-3" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                                            </path>
                                                        </svg>
                                                        <p
                                                            class="text-gray-500 dark:text-gray-400 text-lg font-medium">
                                                            Tidak ada data booking</p>
                                                        <p class="text-gray-400 dark:text-gray-500 text-sm">Belum ada
                                                            booking pameran yang disetujui</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        </template>

                                        <template x-for="(booking, index) in bookings" :key="'booking-' + booking.id">
                                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div
                                                            class="flex-shrink-0 h-10 w-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center text-white font-semibold">
                                                            <span
                                                                x-text="booking.nama_pic ? booking.nama_pic.substring(0, 2).toUpperCase() : 'NA'"></span>
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900 dark:text-white"
                                                                x-text="booking.nama_pic || '-'"></div>
                                                            <div class="text-sm text-gray-500 dark:text-gray-400"
                                                                x-text="booking.nomor_telepon || '-'"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900 dark:text-white"
                                                        x-text="booking.mobil || '-'"></div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900 dark:text-white"
                                                        x-text="booking.tanggal_acara || '-'"></div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                                        <span x-text="booking.tanggal_mulai || '-'"></span> - <span
                                                            x-text="booking.tanggal_selesai || '-'"></span>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="text-sm text-gray-900 dark:text-white max-w-xs truncate"
                                                        x-text="booking.lokasi_acara || '-'"></div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span
                                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full"
                                                        x-bind:class="{
                                                            'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400': booking
                                                                .status === 'Sedang Pameran',
                                                            'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400': booking
                                                                .status === 'Perawatan',
                                                            'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400': booking
                                                                .status === 'Selesai',
                                                            'bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-400': booking
                                                                .status === 'Dikonfirmasi',
                                                            'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400': booking
                                                                .status === 'Diproses'
                                                        }"
                                                        x-text="booking.status || '-'">
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                    <div class="flex space-x-2">
                                                        <button @click="showDetail(booking.id)"
                                                            class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 dark:bg-blue-900/30 dark:text-blue-400 dark:hover:bg-blue-900/50 transition-colors">
                                                            <svg class="w-4 h-4 mr-1" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                                </path>
                                                            </svg>
                                                            Detail
                                                        </button>
                                                        <button @click="openStatusModal(booking.id)"
                                                            class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 dark:bg-green-900/30 dark:text-green-400 dark:hover:bg-green-900/50 transition-colors">
                                                            <svg class="w-4 h-4 mr-1" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                                </path>
                                                            </svg>
                                                            Status
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Bookings Cards - Mobile --}}
                        <div class="lg:hidden space-y-3">
                            <template x-if="loading">
                                <div
                                    class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="animate-spin h-8 w-8 text-blue-600 mb-3" fill="none"
                                            viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                        <p class="text-gray-500 dark:text-gray-400 text-sm">Memuat data...</p>
                                    </div>
                                </div>
                            </template>

                            <template x-if="!loading && bookings.length === 0">
                                <div
                                    class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-8">
                                    <div class="flex flex-col items-center justify-center text-center">
                                        <svg class="w-16 h-16 text-gray-400 mb-3" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                            </path>
                                        </svg>
                                        <p class="text-gray-500 dark:text-gray-400 font-medium mb-1">Tidak ada data
                                            booking</p>
                                        <p class="text-gray-400 dark:text-gray-500 text-sm">Belum ada booking pameran
                                            yang disetujui</p>
                                    </div>
                                </div>
                            </template>

                            <template x-for="(booking, index) in bookings" :key="'mobile-booking-' + booking.id">
                                <div
                                    class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4">
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="flex items-center flex-1">
                                            <div
                                                class="flex-shrink-0 h-12 w-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                                                <span
                                                    x-text="booking.nama_pic ? booking.nama_pic.substring(0, 2).toUpperCase() : 'NA'"></span>
                                            </div>
                                            <div class="ml-3 flex-1 min-w-0">
                                                <h4 class="text-sm font-semibold text-gray-900 dark:text-white truncate"
                                                    x-text="booking.nama_pic || '-'"></h4>
                                                <p class="text-xs text-gray-500 dark:text-gray-400"
                                                    x-text="booking.nomor_telepon || '-'"></p>
                                            </div>
                                        </div>
                                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full ml-2 flex-shrink-0"
                                            x-bind:class="{
                                                'bg-blue-100 text-blue-800': booking.status === 'Sedang Pameran',
                                                'bg-yellow-100 text-yellow-800': booking.status === 'Perawatan',
                                                'bg-green-100 text-green-800': booking.status === 'Selesai',
                                                'bg-indigo-100 text-indigo-800': booking.status === 'Dikonfirmasi',
                                                'bg-purple-100 text-purple-800': booking.status === 'Diproses'
                                            }"
                                            x-text="booking.status || '-'">
                                        </span>
                                    </div>

                                    <div class="space-y-2 mb-3">
                                        <div class="flex items-center text-xs text-gray-600 dark:text-gray-400">
                                            <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                                </path>
                                            </svg>
                                            <span x-text="booking.mobil || '-'"></span>
                                        </div>
                                        <div class="flex items-center text-xs text-gray-600 dark:text-gray-400">
                                            <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            <span x-text="booking.tanggal_acara || '-'"></span>
                                        </div>
                                        <div class="flex items-start text-xs text-gray-600 dark:text-gray-400">
                                            <svg class="w-4 h-4 mr-2 flex-shrink-0 mt-0.5" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <span class="break-words" x-text="booking.lokasi_acara || '-'"></span>
                                        </div>
                                    </div>

                                    <div class="flex gap-2 pt-3 border-t border-gray-200 dark:border-gray-700">
                                        <button @click="showDetail(booking.id)"
                                            class="flex-1 inline-flex items-center justify-center px-3 py-2 border border-transparent text-xs font-medium rounded-lg text-blue-700 bg-blue-100 hover:bg-blue-200">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                            Detail
                                        </button>
                                        <button @click="openStatusModal(booking.id)"
                                            class="flex-1 inline-flex items-center justify-center px-3 py-2 border border-transparent text-xs font-medium rounded-lg text-green-700 bg-green-100 hover:bg-green-200">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                            Status
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Detail Modal --}}
            <div x-show="showDetailModal" x-cloak
                class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
                @click.self="showDetailModal = false">
                <div class="bg-white dark:bg-gray-800 rounded-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto shadow-2xl"
                    @click.stop>
                    <div
                        class="sticky top-0 bg-white dark:bg-gray-800 px-4 lg:px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                        <h3 class="text-lg lg:text-xl font-bold text-gray-900 dark:text-white">Detail Booking Pameran
                        </h3>
                        <button @click="showDetailModal = false"
                            class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="p-4 lg:p-6">
                        <template x-if="selectedBooking">
                            <div class="space-y-4">
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Nama
                                            PIC</label>
                                        <p class="text-gray-900 dark:text-white font-medium"
                                            x-text="selectedBooking.nama_pic || '-'"></p>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">No.
                                            Telepon</label>
                                        <p class="text-gray-900 dark:text-white"
                                            x-text="selectedBooking.nomor_telepon || '-'"></p>
                                    </div>
                                    <div>
                                        <label
                                            class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</label>
                                        <p class="text-gray-900 dark:text-white"
                                            x-text="selectedBooking.email || '-'"></p>
                                    </div>
                                    <div>
                                        <label
                                            class="text-sm font-medium text-gray-500 dark:text-gray-400">Mobil</label>
                                        <p class="text-gray-900 dark:text-white"
                                            x-text="selectedBooking.mobil || '-'"></p>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Target
                                            Prospect</label>
                                        <p class="text-gray-900 dark:text-white"
                                            x-text="selectedBooking.target_prospect || '-'"></p>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Tanggal
                                            Acara</label>
                                        <p class="text-gray-900 dark:text-white"
                                            x-text="selectedBooking.tanggal_acara || '-'"></p>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Tanggal
                                            Mulai</label>
                                        <p class="text-gray-900 dark:text-white"
                                            x-text="selectedBooking.tanggal_mulai || '-'"></p>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Tanggal
                                            Selesai</label>
                                        <p class="text-gray-900 dark:text-white"
                                            x-text="selectedBooking.tanggal_selesai || '-'"></p>
                                    </div>
                                    <div class="col-span-1 lg:col-span-2">
                                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Lokasi
                                            Acara</label>
                                        <p class="text-gray-900 dark:text-white"
                                            x-text="selectedBooking.lokasi_acara || '-'"></p>
                                    </div>
                                    <div>
                                        <label
                                            class="text-sm font-medium text-gray-500 dark:text-gray-400">Supervisor</label>
                                        <p class="text-gray-900 dark:text-white"
                                            x-text="selectedBooking.supervisor_name || '-'"></p>
                                    </div>
                                    <div>
                                        <label
                                            class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</label>
                                        <span
                                            class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full"
                                            x-bind:class="{
                                                'bg-blue-100 text-blue-800': selectedBooking
                                                    .status === 'Sedang Pameran',
                                                'bg-yellow-100 text-yellow-800': selectedBooking
                                                    .status === 'Perawatan',
                                                'bg-green-100 text-green-800': selectedBooking.status === 'Selesai',
                                                'bg-indigo-100 text-indigo-800': selectedBooking
                                                    .status === 'Dikonfirmasi',
                                                'bg-purple-100 text-purple-800': selectedBooking.status === 'Diproses'
                                            }"
                                            x-text="selectedBooking.status || '-'">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            {{-- Status Update Modal --}}
            <div x-show="showStatusModal" x-cloak
                class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
                @click.self="showStatusModal = false">
                <div class="bg-white dark:bg-gray-800 rounded-xl max-w-md w-full shadow-2xl" @click.stop>
                    <div class="px-4 lg:px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg lg:text-xl font-bold text-gray-900 dark:text-white">Update Status Mobil</h3>
                    </div>
                    <div class="p-4 lg:p-6">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status
                                Baru</label>
                            <select x-model="newStatus"
                                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white text-sm lg:text-base">
                                <option value="Sedang Pameran">Sedang Pameran</option>
                                <option value="Perawatan">Perawatan</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>
                        <div class="flex space-x-3">
                            <button @click="showStatusModal = false"
                                class="flex-1 px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium transition-colors text-sm lg:text-base">
                                Batal
                            </button>
                            <button @click="updateStatus()"
                                class="flex-1 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors text-sm lg:text-base">
                                Update Status
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function pameranInfoData() {
                return {
                    sidebarOpen: window.innerWidth >= 1024,
                    darkMode: localStorage.getItem('darkMode') === 'true',
                    bookings: [],
                    loading: false,
                    searchQuery: '',
                    statusFilter: '',
                    searchTimeout: null,
                    showDetailModal: false,
                    showStatusModal: false,
                    selectedBooking: null,
                    currentBookingId: null,
                    newStatus: 'Sedang Pameran',
                    totalBookings: 0,
                    statusCount: {
                        sedangPameran: 0,
                        perawatan: 0,
                        selesai: 0
                    },

                    init() {
                        this.loadBookings();
                        this.setupDarkMode();
                    },

                    setupDarkMode() {
                        if (this.darkMode) {
                            document.documentElement.classList.add('dark');
                        }
                        this.$watch('darkMode', value => {
                            if (value) {
                                document.documentElement.classList.add('dark');
                            } else {
                                document.documentElement.classList.remove('dark');
                            }
                            localStorage.setItem('darkMode', value);
                        });
                    },

                    debounceSearch() {
                        clearTimeout(this.searchTimeout);
                        this.searchTimeout = setTimeout(() => {
                            this.loadBookings();
                        }, 300);
                    },

                    async loadBookings() {
                        this.loading = true;
                        try {
                            const params = new URLSearchParams();
                            if (this.searchQuery) params.append('search', this.searchQuery);
                            if (this.statusFilter) params.append('status', this.statusFilter);

                            const response = await fetch(`/api/pameran-info?${params.toString()}`, {
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                    'Accept': 'application/json'
                                }
                            });

                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }

                            const result = await response.json();

                            if (result.success) {
                                // Filter to ensure we only have valid booking data
                                this.bookings = (result.data || []).filter(booking => booking && booking.id);
                                this.totalBookings = this.bookings.length;
                                this.calculateStatusCounts();
                            } else {
                                console.error('API returned error:', result.message);
                                this.showNotification('error', 'Gagal memuat data');
                                this.bookings = [];
                                this.totalBookings = 0;
                            }
                        } catch (error) {
                            console.error('Error loading bookings:', error);
                            this.showNotification('error', 'Terjadi kesalahan saat memuat data');
                            this.bookings = [];
                            this.totalBookings = 0;
                        } finally {
                            this.loading = false;
                        }
                    },

                    calculateStatusCounts() {
                        this.statusCount = {
                            sedangPameran: this.bookings.filter(b => b && b.status === 'Sedang Pameran').length,
                            perawatan: this.bookings.filter(b => b && b.status === 'Perawatan').length,
                            selesai: this.bookings.filter(b => b && b.status === 'Selesai').length
                        };
                    },

                    async showDetail(bookingId) {
                        if (!bookingId) return;

                        try {
                            const response = await fetch(`/api/pameran-info/${bookingId}`, {
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                    'Accept': 'application/json'
                                }
                            });

                            const result = await response.json();

                            if (result.success && result.data) {
                                this.selectedBooking = result.data;
                                this.showDetailModal = true;
                            } else {
                                this.showNotification('error', 'Gagal memuat detail booking');
                            }
                        } catch (error) {
                            console.error('Error loading detail:', error);
                            this.showNotification('error', 'Terjadi kesalahan saat memuat detail');
                        }
                    },

                    openStatusModal(bookingId) {
                        if (!bookingId) return;
                        this.currentBookingId = bookingId;
                        this.showStatusModal = true;
                    },

                    async updateStatus() {
                        if (!this.currentBookingId) return;

                        try {
                            const response = await fetch(`/api/pameran-info/${this.currentBookingId}/status`, {
                                method: 'PUT',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({
                                    status: this.newStatus
                                })
                            });

                            const result = await response.json();

                            if (result.success) {
                                this.showNotification('success', 'Status berhasil diperbarui');
                                this.showStatusModal = false;
                                this.loadBookings();
                            } else {
                                this.showNotification('error', result.message || 'Gagal memperbarui status');
                            }
                        } catch (error) {
                            console.error('Error updating status:', error);
                            this.showNotification('error', 'Terjadi kesalahan saat memperbarui status');
                        }
                    },

                    showNotification(type, message) {
                        if (type === 'success') {
                            alert('✅ ' + message);
                        } else {
                            alert('❌ ' + message);
                        }
                    }
                }
            }
        </script>

        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>
</x-layouts.app>
