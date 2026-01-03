<x-layouts.app :title="'Check Sheet Security'">
    <div x-data="checkSheetSecurity" x-init="init()"
        class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 transition-all duration-300">
        <div class="flex">
            {{-- Sidebar Navigation --}}
            <aside class="fixed left-0 top-0 z-40 h-screen shadow-2xl transition-transform duration-300"
                :class="sidebarOpen ? 'translate-x-0 w-72' : '-translate-x-full w-72'">
                <div
                    class="h-full bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-700 flex flex-col">
                    {{-- Logo Section --}}
                    <div class="px-6 py-6 border-b border-gray-200 dark:border-gray-700">
                        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center shadow-lg group-hover:shadow-xl transition-shadow">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <span
                                    class="text-xl font-bold text-gray-900 dark:text-white block leading-tight">Checksheet</span>
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
                            class="flex items-center px-4 py-3.5 text-gray-900 dark:text-white bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/30 dark:to-indigo-900/30 rounded-xl border border-blue-200 dark:border-blue-800 group transition-all duration-200 shadow-sm">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center mr-3 shadow-md group-hover:shadow-lg transition-shadow">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                    </path>
                                </svg>
                            </div>
                            <span class="font-semibold">Check Sheet</span>
                        </a>
                        <a href="{{ route('pameran-info') }}"
                            class="flex items-center px-4 py-3.5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-xl group transition-all duration-200">
                            <div
                                class="w-10 h-10 bg-gray-100 dark:bg-gray-800 rounded-lg flex items-center justify-center mr-3 group-hover:bg-gradient-to-br group-hover:from-blue-600 group-hover:to-indigo-600 transition-all duration-200">
                                <svg class="w-5 h-5 text-gray-600 dark:text-gray-400 group-hover:text-white transition-colors"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <span class="font-medium">Pameran Info</span>
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
            <div class="flex-1 transition-all duration-300" :class="sidebarOpen ? 'lg:ml-72' : 'lg:ml-0'">
                {{-- Top Navigation Bar --}}
                <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-4 py-3 lg:px-6">
                    <div class="flex items-center justify-between">
                        <button @click="sidebarOpen = !sidebarOpen"
                            class="p-2 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>

                        <div class="flex items-center gap-4 ml-auto">
                            {{-- Dark Mode Toggle --}}
                            <button @click="toggleTheme()"
                                class="flex items-center gap-2 px-4 py-2 rounded-xl bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100 transition hover:bg-gray-300 dark:hover:bg-gray-600">
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
                                <span x-text="darkMode ? 'Light Mode' : 'Dark Mode'"></span>
                            </button>
                        </div>
                    </div>
                </nav>

                {{-- Page Content --}}
                <div class="p-6">
                    <div class="max-w-7xl mx-auto">

                        {{-- Success Message --}}
                        @if (session('success'))
                            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- Error Message (exclude middleware redirect errors) --}}
                        @if (session('error') && session('error') !== 'Anda tidak memiliki akses ke halaman tersebut.')
                            <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                                {{ session('error') }}
                            </div>
                        @endif

                        {{-- Booking List for Checksheet --}}
                        <div
                            class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-200 dark:border-gray-600 shadow-lg">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Daftar Booking Test
                                    Drive</h2>

                                {{-- Search & Count Section --}}
                                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mb-4">
                                    <div class="relative flex-1">
                                        <input x-model="searchQuery" type="text" placeholder="Cari booking..."
                                            class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <span
                                        class="px-3 py-2 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-xs font-medium rounded-lg whitespace-nowrap">
                                        Total: <span x-text="filteredBookings.length"></span> booking
                                    </span>
                                </div>

                                {{-- Active Filters & Sort Display - MOVED BELOW SEARCH --}}
                                <div x-show="customerSort || carFilter || dateSort || dateFilter || carStatusFilter || approvalStatusFilter"
                                    class="mb-4 p-3 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <span class="text-xs font-semibold text-blue-700 dark:text-blue-300">Filter
                                            Aktif:</span>

                                        {{-- Customer Sort --}}
                                        <template x-if="customerSort">
                                            <span
                                                class="inline-flex items-center gap-1 px-2 py-1 bg-purple-600 text-white text-xs font-medium rounded-full">
                                                Sort Customer: <span
                                                    x-text="customerSort === 'asc' ? 'A → Z' : 'Z → A'"></span>
                                                <button @click.prevent="clearCustomerSort()"
                                                    class="ml-1 hover:bg-purple-700 rounded-full p-0.5 transition">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </span>
                                        </template>

                                        {{-- Car Filter --}}
                                        <template x-if="carFilter">
                                            <span
                                                class="inline-flex items-center gap-1 px-2 py-1 bg-blue-600 text-white text-xs font-medium rounded-full">
                                                Mobil: <span x-text="carFilter"></span>
                                                <button @click.prevent="filterByCar('')"
                                                    class="ml-1 hover:bg-blue-700 rounded-full p-0.5 transition">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </span>
                                        </template>

                                        {{-- Date Sort --}}
                                        <template x-if="dateSort">
                                            <span
                                                class="inline-flex items-center gap-1 px-2 py-1 bg-indigo-600 text-white text-xs font-medium rounded-full">
                                                Sort Tanggal: <span
                                                    x-text="dateSort === 'asc' ? 'Terlama' : 'Terbaru'"></span>
                                                <button @click.prevent="dateSort = ''; currentPage = 1"
                                                    class="ml-1 hover:bg-indigo-700 rounded-full p-0.5 transition">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </span>
                                        </template>

                                        {{-- Date Filter --}}
                                        <template x-if="dateFilter">
                                            <span
                                                class="inline-flex items-center gap-1 px-2 py-1 bg-green-600 text-white text-xs font-medium rounded-full">
                                                Tanggal: <span x-text="dateFilter"></span>
                                                <button @click.prevent="clearDateFilter()"
                                                    class="ml-1 hover:bg-green-700 rounded-full p-0.5 transition">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </span>
                                        </template>

                                        {{-- Car Status Filter --}}
                                        <template x-if="carStatusFilter">
                                            <span
                                                class="inline-flex items-center gap-1 px-2 py-1 bg-orange-600 text-white text-xs font-medium rounded-full">
                                                Status Mobil: <span x-text="carStatusFilter"></span>
                                                <button @click.prevent="filterByCarStatus('')"
                                                    class="ml-1 hover:bg-orange-700 rounded-full p-0.5 transition">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </span>
                                        </template>

                                        {{-- Approval Status Filter --}}
                                        <template x-if="approvalStatusFilter">
                                            <span
                                                class="inline-flex items-center gap-1 px-2 py-1 bg-yellow-600 text-white text-xs font-medium rounded-full">
                                                Status Approval: <span
                                                    x-text="approvalStatusFilter === 'approved' ? 'Disetujui' : approvalStatusFilter === 'pending' ? 'Menunggu' : 'Dibatalkan'"></span>
                                                <button @click.prevent="filterByApprovalStatus('')"
                                                    class="ml-1 hover:bg-yellow-700 rounded-full p-0.5 transition">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </span>
                                        </template>

                                        {{-- Clear All Button --}}
                                        <button type="button"
                                            @click.prevent.stop="
                customerSort = '';
                carFilter = '';
                dateSort = '';
                dateFilter = '';
                carStatusFilter = '';
                approvalStatusFilter = '';
                searchQuery = '';
                currentPage = 1;
            "
                                            class="ml-auto px-3 py-1.5 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white text-xs font-semibold rounded-lg transition-colors duration-200 flex items-center gap-1 shadow-sm hover:shadow">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Clear All
                                        </button>
                                    </div>
                                </div>
                            </div>

                            {{-- Desktop Table --}}
                            <div
                                class="hidden lg:block overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-600">
                                <table class="w-full min-w-full table-fixed">
                                    <thead>
                                        <tr
                                            class="bg-gray-100 dark:bg-gray-700 border-b-2 border-gray-300 dark:border-gray-600">
                                            {{-- Customer Column with Filter --}}
                                            <th
                                                class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                                <div class="flex items-center justify-between">
                                                    <span>Customer</span>
                                                    <div class="relative" x-data="{ open: false }">
                                                        <button @click="open = !open"
                                                            class="ml-2 p-1 hover:bg-gray-200 dark:hover:bg-gray-600 rounded">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                                                            </svg>
                                                        </button>
                                                        <div x-show="open" @click.away="open = false" x-transition
                                                            class="absolute right-0 top-full mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-600 z-[300]"
                                                            style="display: none;">
                                                            <button @click="sortCustomer('asc'); open = false"
                                                                class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-900 dark:text-gray-100">
                                                                A - Z
                                                            </button>
                                                            <button @click="sortCustomer('desc'); open = false"
                                                                class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-900 dark:text-gray-100">
                                                                Z - A
                                                            </button>
                                                            <button @click="clearCustomerSort(); open = false"
                                                                class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700 text-red-600 dark:text-red-400">
                                                                Clear Sort
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </th>

                                            {{-- Mobil Column with Filter --}}
                                            <th
                                                class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                                <div class="flex items-center justify-between">
                                                    <span>Mobil</span>
                                                    <div class="relative" x-data="{ open: false }">
                                                        <button @click="open = !open"
                                                            class="ml-2 p-1 hover:bg-gray-200 dark:hover:bg-gray-600 rounded">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h6a1 1 0 001-1v-6a1 1 0 00-1-1h-6z" />
                                                            </svg>
                                                        </button>
                                                        <div x-show="open" @click.away="open = false" x-transition
                                                            class="absolute right-0 top-full mt-2 w-56 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-600 z-[200] max-h-64 overflow-y-auto"
                                                            style="display: none;">
                                                            <button @click="filterByCar(''); open = false"
                                                                class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700 font-semibold"
                                                                :class="carFilter === '' ?
                                                                    'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                                    'text-gray-900 dark:text-gray-100'">
                                                                Semua Mobil
                                                            </button>
                                                            <button
                                                                @click="filterByCar('Toyota Hilux Rangga'); open = false"
                                                                class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                                :class="carFilter === 'Toyota Hilux Rangga' ?
                                                                    'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                                    'text-gray-900 dark:text-gray-100'">
                                                                Toyota Hilux Rangga
                                                            </button>
                                                            <button
                                                                @click="filterByCar('Toyota Raize Abu Abu'); open = false"
                                                                class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                                :class="carFilter === 'Toyota Raize Abu Abu' ?
                                                                    'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                                    'text-gray-900 dark:text-gray-100'">
                                                                Toyota Raize Abu Abu
                                                            </button>
                                                            <button @click="filterByCar('Toyota Zenix'); open = false"
                                                                class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                                :class="carFilter === 'Toyota Zenix' ?
                                                                    'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                                    'text-gray-900 dark:text-gray-100'">
                                                                Toyota Zenix
                                                            </button>
                                                            <button
                                                                @click="filterByCar('Toyota Agya Putih'); open = false"
                                                                class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                                :class="carFilter === 'Toyota Agya Putih' ?
                                                                    'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                                    'text-gray-900 dark:text-gray-100'">
                                                                Toyota Agya Putih
                                                            </button>
                                                            <button
                                                                @click="filterByCar('Toyota Fortuner'); open = false"
                                                                class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                                :class="carFilter === 'Toyota Fortuner' ?
                                                                    'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                                    'text-gray-900 dark:text-gray-100'">
                                                                Toyota Fortuner
                                                            </button>
                                                            <button
                                                                @click="filterByCar('Toyota Agya GR Merah'); open = false"
                                                                class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                                :class="carFilter === 'Toyota Agya GR Merah' ?
                                                                    'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                                    'text-gray-900 dark:text-gray-100'">
                                                                Toyota Agya GR Merah
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </th>

                                            {{-- Tanggal Column with Filter --}}
                                            <th
                                                class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                                <div class="flex items-center justify-between">
                                                    <span>Tanggal</span>
                                                    <div class="relative" x-data="{ open: false }">
                                                        <button @click="open = !open"
                                                            class="ml-2 p-1 hover:bg-gray-200 dark:hover:bg-gray-600 rounded">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                            </svg>
                                                        </button>
                                                        <div x-show="open" @click.away="open = false" x-transition
                                                            class="absolute right-0 top-full mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-600 z-[200]"
                                                            style="display: none;">
                                                            <button @click="sortDate('desc'); open = false"
                                                                class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-900 dark:text-gray-100">
                                                                Terbaru
                                                            </button>
                                                            <button @click="sortDate('asc'); open = false"
                                                                class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-900 dark:text-gray-100">
                                                                Terlama
                                                            </button>
                                                            <div
                                                                class="px-4 py-2 border-t border-gray-200 dark:border-gray-600">
                                                                <input type="date" x-model="dateFilter"
                                                                    @change="filterByDate(); open = false"
                                                                    class="w-full px-2 py-1 text-sm border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                                                            </div>
                                                            <button @click="clearDateFilter(); open = false"
                                                                class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700 text-red-600 dark:text-red-400">
                                                                Clear Filter
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </th>

                                            {{-- Status Mobil Column with Filter --}}
                                            <th
                                                class="px-4 py-3 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                                <div class="flex items-center justify-center">
                                                    <span>Status Mobil</span>
                                                    <div class="relative" x-data="{ open: false }">
                                                        <button @click="open = !open"
                                                            class="ml-2 p-1 hover:bg-gray-200 dark:hover:bg-gray-600 rounded">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h6a1 1 0 001-1v-6a1 1 0 00-1-1h-6z" />
                                                            </svg>
                                                        </button>
                                                        <div x-show="open" @click.away="open = false" x-transition
                                                            class="absolute right-0 top-full mt-2 w-56 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-600 z-[200]"
                                                            style="display: none;">
                                                            <button @click="filterByCarStatus(''); open = false"
                                                                class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700 font-semibold"
                                                                :class="carStatusFilter === '' ?
                                                                    'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                                    'text-gray-900 dark:text-gray-100'">
                                                                Semua Status
                                                            </button>
                                                            <button
                                                                @click="filterByCarStatus('Sedang test drive'); open = false"
                                                                class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                                :class="carStatusFilter === 'Sedang test drive' ?
                                                                    'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                                    'text-gray-900 dark:text-gray-100'">
                                                                Sedang Test Drive
                                                            </button>
                                                            <button @click="filterByCarStatus('Selesai'); open = false"
                                                                class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                                :class="carStatusFilter === 'Selesai' ?
                                                                    'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                                    'text-gray-900 dark:text-gray-100'">
                                                                Selesai
                                                            </button>
                                                            <button
                                                                @click="filterByCarStatus('Perawatan'); open = false"
                                                                class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                                :class="carStatusFilter === 'Perawatan' ?
                                                                    'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                                    'text-gray-900 dark:text-gray-100'">
                                                                Perawatan
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </th>

                                            {{-- Status Approval Column with Filter --}}
                                            <th
                                                class="px-4 py-3 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                                <div class="flex items-center justify-center">
                                                    <span>Status Approval</span>
                                                    <div class="relative" x-data="{ open: false }">
                                                        <button @click="open = !open"
                                                            class="ml-2 p-1 hover:bg-gray-200 dark:hover:bg-gray-600 rounded">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h6a1 1 0 001-1v-6a1 1 0 00-1-1h-6z" />
                                                            </svg>
                                                        </button>
                                                        <div x-show="open" @click.away="open = false" x-transition
                                                            class="absolute right-0 top-full mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-600 z-[200]"
                                                            style="display: none;">
                                                            <button @click="filterByApprovalStatus(''); open = false"
                                                                class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700 font-semibold"
                                                                :class="approvalStatusFilter === '' ?
                                                                    'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                                    'text-gray-900 dark:text-gray-100'">
                                                                Semua Status
                                                            </button>
                                                            <button
                                                                @click="filterByApprovalStatus('pending'); open = false"
                                                                class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                                :class="approvalStatusFilter === 'pending' ?
                                                                    'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                                    'text-gray-900 dark:text-gray-100'">
                                                                Menunggu
                                                            </button>
                                                            <button
                                                                @click="filterByApprovalStatus('approved'); open = false"
                                                                class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                                :class="approvalStatusFilter === 'approved' ?
                                                                    'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                                    'text-gray-900 dark:text-gray-100'">
                                                                Disetujui
                                                            </button>
                                                            <button
                                                                @click="filterByApprovalStatus('not_approved'); open = false"
                                                                class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                                :class="approvalStatusFilter === 'not_approved' ?
                                                                    'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                                    'text-gray-900 dark:text-gray-100'">
                                                                Dibatalkan
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </th>

                                            {{-- Aksi Column --}}
                                            <th
                                                class="px-4 py-3 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody
                                        class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                                        <template x-for="(booking, index) in paginatedBookings"
                                            :key="booking.id">
                                            <tr
                                                class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors h-20">
                                                {{-- Customer Column (NO Avatar) --}}
                                                <td class="px-4 py-4">
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100"
                                                            x-text="booking.customer"></div>
                                                        <div class="text-xs text-gray-500 dark:text-gray-400"
                                                            x-text="booking.phone"></div>
                                                    </div>
                                                </td>

                                                {{-- Mobil Column --}}
                                                <td class="px-4 py-4">
                                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100"
                                                        x-text="booking.car"></div>
                                                </td>

                                                {{-- Tanggal Column --}}
                                                <td class="px-4 py-4">
                                                    <div
                                                        class="flex items-center text-sm text-gray-900 dark:text-gray-100">
                                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                        <span x-text="booking.date"></span>
                                                    </div>
                                                </td>

                                                {{-- Status Mobil Column --}}
                                                <td class="px-4 py-4">
                                                    <div class="flex justify-center">
                                                        {{-- ✅ Tampilkan dropdown untuk status yang bisa diubah --}}
                                                        <template
                                                            x-if="booking.status === 'Dikonfirmasi' || booking.status === 'Sedang test drive' || booking.status === 'Selesai' || booking.status === 'Perawatan'">
                                                            <div class="relative" x-data="{ open: false }">
                                                                <button @click="open = !open"
                                                                    class="inline-flex items-center justify-center gap-2 px-3 py-2 rounded-lg font-medium text-xs transition-all hover:shadow-md min-w-[140px]"
                                                                    :class="{
                                                                        'bg-blue-600 text-white hover:bg-blue-700': booking
                                                                            .status === 'Dikonfirmasi',
                                                                        'bg-indigo-100 text-indigo-800 dark:bg-indigo-900/50 dark:text-indigo-200 hover:bg-indigo-200 dark:hover:bg-indigo-900': booking
                                                                            .status === 'Sedang test drive',
                                                                        'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-200 hover:bg-green-200 dark:hover:bg-green-900': booking
                                                                            .status === 'Selesai',
                                                                        'bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-200 hover:bg-red-200 dark:hover:bg-red-900': booking
                                                                            .status === 'Perawatan'
                                                                    }">
                                                                    <span
                                                                        x-text="booking.status === 'Dikonfirmasi' ? 'Ubah Status Mobil' : booking.status"></span>
                                                                    <svg class="w-3 h-3" fill="none"
                                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M19 9l-7 7-7-7" />
                                                                    </svg>
                                                                </button>

                                                                {{-- Dropdown Menu --}}
                                                                <div x-show="open" @click.away="open = false"
                                                                    x-transition:enter="transition ease-out duration-100"
                                                                    x-transition:enter-start="transform opacity-0 scale-95"
                                                                    x-transition:enter-end="transform opacity-100 scale-100"
                                                                    x-transition:leave="transition ease-in duration-75"
                                                                    x-transition:leave-start="transform opacity-100 scale-100"
                                                                    x-transition:leave-end="transform opacity-0 scale-95"
                                                                    class="absolute z-50 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-600 overflow-hidden"
                                                                    style="display: none;">

                                                                    <button
                                                                        @click="updateCarStatus(booking, 'Sedang test drive'); open = false"
                                                                        class="w-full px-4 py-3 text-left text-sm hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition flex items-center gap-3 text-gray-900 dark:text-gray-100">
                                                                        <div
                                                                            class="w-2.5 h-2.5 rounded-full bg-indigo-500">
                                                                        </div>
                                                                        <span class="font-medium">Sedang Test
                                                                            Drive</span>
                                                                    </button>

                                                                    <button
                                                                        @click="updateCarStatus(booking, 'Selesai'); open = false"
                                                                        class="w-full px-4 py-3 text-left text-sm hover:bg-green-50 dark:hover:bg-green-900/20 transition flex items-center gap-3 text-gray-900 dark:text-gray-100">
                                                                        <div
                                                                            class="w-2.5 h-2.5 rounded-full bg-green-500">
                                                                        </div>
                                                                        <span class="font-medium">Selesai</span>
                                                                    </button>

                                                                    <button
                                                                        @click="updateCarStatus(booking, 'Perawatan'); open = false"
                                                                        class="w-full px-4 py-3 text-left text-sm hover:bg-red-50 dark:hover:bg-red-900/20 transition flex items-center gap-3 text-gray-900 dark:text-gray-100">
                                                                        <div
                                                                            class="w-2.5 h-2.5 rounded-full bg-red-500">
                                                                        </div>
                                                                        <span class="font-medium">Perawatan</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </template>

                                                        {{-- ❌ Jika belum Dikonfirmasi atau Dibatalkan, tampilkan "No Access" --}}
                                                        <template
                                                            x-if="booking.status === 'Menunggu' || booking.status === 'Diproses' || booking.status === 'Dibatalkan'">
                                                            <span
                                                                class="inline-flex items-center justify-center gap-2 px-3 py-2 rounded-lg font-medium text-xs min-w-[140px] bg-gray-400 dark:bg-gray-600 text-white">
                                                                Belum bisa diakses
                                                            </span>
                                                        </template>
                                                    </div>
                                                </td>

                                                {{-- Status Approval Column --}}
                                                <td class="px-4 py-4">
                                                    <div class="flex justify-center">
                                                        <span
                                                            class="inline-flex items-center px-3 py-1.5 text-xs font-semibold rounded-full"
                                                            :class="{
                                                                'bg-green-100 text-green-700 dark:bg-green-900/50 dark:text-green-200': booking
                                                                    .approval_status === 'approved',
                                                                'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/50 dark:text-yellow-200': booking
                                                                    .approval_status === 'pending',
                                                                'bg-red-100 text-red-700 dark:bg-red-900/50 dark:text-red-200': booking
                                                                    .approval_status === 'not_approved'
                                                            }"
                                                            x-text="booking.approval_label">
                                                        </span>
                                                    </div>
                                                </td>

                                                {{-- Aksi Column --}}
                                                <td class="px-4 py-4">
                                                    {{-- Jika sudah ada checksheet --}}
                                                    <template x-if="booking.has_checksheet">
                                                        <div class="flex flex-col gap-2">
                                                            <button @click="viewChecksheet(booking.checksheet_id)"
                                                                class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-lg transition-all hover:shadow-md">
                                                                <svg class="w-4 h-4 mr-1.5" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M15 12a3 3 0 11-6 03 0 016 0z"></path>
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                                    </path>
                                                                </svg>
                                                                Lihat Checksheet
                                                            </button>
                                                            <a :href="`/checksheet/export?checksheet_id=${booking.checksheet_id}`"
                                                                class="w-full inline-flex items-center justify-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-xs font-medium rounded-lg transition-all hover:shadow-md">
                                                                <svg class="w-4 h-4 mr-1.5" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                                    </path>
                                                                </svg>
                                                                Export
                                                            </a>
                                                        </div>
                                                    </template>

                                                    {{-- Jika belum ada checksheet --}}
                                                    <template x-if="!booking.has_checksheet">
                                                        <div class="flex justify-center">
                                                            {{-- ✅ BARU: Tampilkan untuk SEMUA status yang sudah approved --}}
                                                            <button
                                                                x-show="['Dikonfirmasi', 'Sedang test drive', 'Selesai', 'Perawatan'].includes(booking.status)"
                                                                @click="openChecksheetModal(booking)"
                                                                class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-lg transition-all hover:shadow-md">
                                                                <svg class="w-4 h-4 mr-1.5" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                                    </path>
                                                                </svg>
                                                                Isi Checksheet
                                                            </button>

                                                            {{-- MENUNGGU (Pending SPV) --}}
                                                            <div x-show="booking.status === 'Menunggu'"
                                                                class="inline-flex items-center px-4 py-2 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300 text-xs font-medium rounded-lg">
                                                                <svg class="w-4 h-4 mr-1.5 animate-spin"
                                                                    fill="none" stroke="currentColor"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                                                    </path>
                                                                </svg>
                                                                <span>Menunggu SPV</span>
                                                            </div>

                                                            {{-- DIPROSES (Pending Branch Manager) --}}
                                                            <div x-show="booking.status === 'Diproses'"
                                                                class="inline-flex items-center px-4 py-2 bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 text-xs font-medium rounded-lg">
                                                                <svg class="w-4 h-4 mr-1.5 animate-spin"
                                                                    fill="none" stroke="currentColor"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                                                    </path>
                                                                </svg>
                                                                <span>Menunggu BM</span>
                                                            </div>

                                                            {{-- DIBATALKAN (Not Approved) --}}
                                                            <div x-show="booking.status === 'Dibatalkan'"
                                                                class="inline-flex items-center px-4 py-2 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 text-xs font-medium rounded-lg">
                                                                <svg class="w-4 h-4 mr-1.5" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M6 18L18 6M6 6l12 12"></path>
                                                                </svg>
                                                                <span>Dibatalkan</span>
                                                            </div>
                                                        </div>
                                                    </template>
                                                </td>
                                            </tr>
                                        </template>
                                        <template x-for="i in (itemsPerPage - paginatedBookings.length)"
                                            :key="'empty-' + i">
                                            <tr class="h-20">
                                                <td class="px-4 py-3" colspan="6">
                                                    <div class="h-full">&nbsp;</div>
                                                </td>
                                            </tr>
                                        </template>

                                    </tbody>
                                </table>

                                {{-- ✅ NEW: Pagination Controls (Desktop) --}}
                                <div x-show="filteredBookings.length > 0"
                                    class="bg-gray-50 dark:bg-gray-700 px-4 py-3 border-t border-gray-200 dark:border-gray-600 flex items-center justify-between">
                                    <div class="flex-1 flex justify-between sm:hidden">
                                        <button @click="prevPage()" :disabled="currentPage === 1"
                                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 disabled:opacity-50 disabled:cursor-not-allowed">
                                            Previous
                                        </button>
                                        <button @click="nextPage()" :disabled="currentPage === totalPages"
                                            class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 disabled:opacity-50 disabled:cursor-not-allowed">
                                            Next
                                        </button>
                                    </div>

                                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                        <div>
                                            <p class="text-sm text-gray-700 dark:text-gray-300">
                                                Showing
                                                <span class="font-medium" x-text="startIndex + 1"></span>
                                                to
                                                <span class="font-medium"
                                                    x-text="Math.min(endIndex, filteredBookings.length)"></span>
                                                of
                                                <span class="font-medium" x-text="filteredBookings.length"></span>
                                                results
                                            </p>
                                        </div>

                                        <div>
                                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                                                <button @click="prevPage()" :disabled="currentPage === 1"
                                                    class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-sm font-medium text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-600 disabled:opacity-50 disabled:cursor-not-allowed">
                                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>

                                                <template x-for="page in visiblePages" :key="page">
                                                    <button @click="goToPage(page)"
                                                        :class="currentPage === page ?
                                                            'z-10 bg-blue-50 dark:bg-blue-900 border-blue-500 dark:border-blue-400 text-blue-600 dark:text-blue-200' :
                                                            'bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600 text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-600'"
                                                        class="relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                                        <span x-text="page"></span>
                                                    </button>
                                                </template>

                                                <button @click="nextPage()" :disabled="currentPage === totalPages"
                                                    class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-sm font-medium text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-600 disabled:opacity-50 disabled:cursor-not-allowed">
                                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </nav>
                                        </div>
                                    </div>
                                </div>

                                {{-- Empty State --}}
                                <div x-show="filteredBookings.length === 0" class="text-center py-12">
                                    <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    <p class="text-gray-500 dark:text-gray-400 text-lg font-medium">Tidak ada booking
                                        yang ditemukan</p>
                                    <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Coba gunakan kata kunci
                                        pencarian yang berbeda atau ubah filter</p>
                                </div>
                            </div>

                            {{-- Mobile & Tablet Cards --}}
                            <div class="lg:hidden space-y-4">
                                <template x-for="(booking, index) in paginatedBookings" :key="booking.id">
                                    <div
                                        class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-600 p-4 hover:shadow-lg transition-shadow">
                                        {{-- Header (NO Avatar) --}}
                                        <div class="flex items-start justify-between mb-3">
                                            <div class="flex-1 min-w-0">
                                                <h3 class="font-semibold text-gray-900 dark:text-gray-100 truncate"
                                                    x-text="booking.customer"></h3>
                                                <p class="text-xs text-gray-500 dark:text-gray-400"
                                                    x-text="booking.phone"></p>
                                            </div>
                                            <span
                                                class="ml-2 flex-shrink-0 inline-flex items-center px-2.5 py-1 text-xs font-semibold rounded-full"
                                                :class="{
                                                    'bg-green-100 text-green-700 dark:bg-green-900/50 dark:text-green-200': booking
                                                        .approval_status === 'approved',
                                                    'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/50 dark:text-yellow-200': booking
                                                        .approval_status === 'pending',
                                                    'bg-red-100 text-red-700 dark:bg-red-900/50 dark:text-red-200': booking
                                                        .approval_status === 'not_approved'
                                                }"
                                                x-text="booking.approval_label">
                                            </span>
                                        </div>

                                        {{-- Info Grid --}}
                                        <div class="space-y-2 mb-4 text-sm">
                                            <div class="flex items-center text-gray-700 dark:text-gray-300">
                                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                                    </path>
                                                </svg>
                                                <span class="font-medium" x-text="booking.car"></span>
                                            </div>
                                            <div class="flex items-center text-gray-700 dark:text-gray-300">
                                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <span x-text="booking.date"></span>
                                            </div>
                                        </div>

                                        {{-- Status Mobil --}}
                                        <div class="mb-3">
                                            {{-- ✅ Tampilkan dropdown untuk status yang bisa diubah --}}
                                            <template
                                                x-if="booking.status === 'Dikonfirmasi' || booking.status === 'Sedang test drive' || booking.status === 'Selesai' || booking.status === 'Perawatan'">
                                                <div class="relative" x-data="{ open: false }">
                                                    <button @click="open = !open"
                                                        class="w-full inline-flex items-center justify-center gap-2 px-3 py-2 rounded-lg font-medium text-xs transition-all hover:shadow-md"
                                                        :class="{
                                                            'bg-blue-600 text-white hover:bg-blue-700': booking
                                                                .status === 'Dikonfirmasi',
                                                            'bg-indigo-100 text-indigo-800 dark:bg-indigo-900/50 dark:text-indigo-200 hover:bg-indigo-200': booking
                                                                .status === 'Sedang test drive',
                                                            'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-200 hover:bg-green-200': booking
                                                                .status === 'Selesai',
                                                            'bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-200 hover:bg-red-200': booking
                                                                .status === 'Perawatan'
                                                        }">
                                                        <span
                                                            x-text="booking.status === 'Dikonfirmasi' ? 'Ubah Status Mobil' : booking.status"></span>
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M19 9l-7 7-7-7" />
                                                        </svg>
                                                    </button>

                                                    <div x-show="open" @click.away="open = false" x-transition
                                                        class="absolute z-50 mt-2 w-full bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-600 overflow-hidden"
                                                        style="display: none;">
                                                        <button
                                                            @click="updateCarStatus(booking, 'Sedang test drive'); open = false"
                                                            class="w-full px-4 py-3 text-left text-sm hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition flex items-center gap-3 text-gray-900 dark:text-gray-100">
                                                            <div class="w-2.5 h-2.5 rounded-full bg-indigo-500"></div>
                                                            <span class="font-medium">Sedang Test Drive</span>
                                                        </button>
                                                        <button
                                                            @click="updateCarStatus(booking, 'Selesai'); open = false"
                                                            class="w-full px-4 py-3 text-left text-sm hover:bg-green-50 dark:hover:bg-green-900/20 transition flex items-center gap-3 text-gray-900 dark:text-gray-100">
                                                            <div class="w-2.5 h-2.5 rounded-full bg-green-500"></div>
                                                            <span class="font-medium">Selesai</span>
                                                        </button>
                                                        <button
                                                            @click="updateCarStatus(booking, 'Perawatan'); open = false"
                                                            class="w-full px-4 py-3 text-left text-sm hover:bg-red-50 dark:hover:bg-red-900/20 transition flex items-center gap-3 text-gray-900 dark:text-gray-100">
                                                            <div class="w-2.5 h-2.5 rounded-full bg-red-500"></div>
                                                            <span class="font-medium">Perawatan</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </template>

                                            {{-- ❌ Jika belum Dikonfirmasi atau Dibatalkan, tampilkan "No Access" --}}
                                            <template
                                                x-if="booking.status === 'Menunggu' || booking.status === 'Diproses' || booking.status === 'Dibatalkan'">
                                                <span
                                                    class="w-full inline-flex items-center justify-center gap-2 px-3 py-2 rounded-lg font-medium text-xs bg-gray-400 dark:bg-gray-600 text-white">
                                                    Belum bisa diakses
                                                </span>
                                            </template>
                                        </div>

                                        {{-- Action Buttons --}}
                                        <template x-if="booking.has_checksheet">
                                            <div class="flex gap-2">
                                                <button @click="viewChecksheet(booking.checksheet_id)"
                                                    class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-lg transition">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                        </path>
                                                    </svg>
                                                    Lihat
                                                </button>
                                                <a :href="`/checksheet/export?checksheet_id=${booking.checksheet_id}`"
                                                    class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-xs font-medium rounded-lg transition">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                        </path>
                                                    </svg>
                                                    Export
                                                </a>
                                            </div>
                                        </template>

                                        <template x-if="!booking.has_checksheet">
                                            <div class="flex justify-center">
                                                {{-- ✅ APPROVED STATUS - Bisa Isi Checksheet --}}
                                                <button
                                                    x-show="['Dikonfirmasi', 'Sedang test drive', 'Selesai', 'Perawatan'].includes(booking.status)"
                                                    @click="openChecksheetModal(booking)"
                                                    class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-lg transition-all hover:shadow-md">
                                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                        </path>
                                                    </svg>
                                                    Isi Checksheet
                                                </button>

                                                {{-- MENUNGGU (Pending SPV) --}}
                                                <div x-show="booking.status === 'Menunggu'"
                                                    class="inline-flex items-center px-4 py-2 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300 text-xs font-medium rounded-lg">
                                                    <svg class="w-4 h-4 mr-1.5 animate-spin" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                                        </path>
                                                    </svg>
                                                    <span>Menunggu SPV</span>
                                                </div>

                                                {{-- DIPROSES (Pending Branch Manager) --}}
                                                <div x-show="booking.status === 'Diproses'"
                                                    class="inline-flex items-center px-4 py-2 bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 text-xs font-medium rounded-lg">
                                                    <svg class="w-4 h-4 mr-1.5 animate-spin" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                                        </path>
                                                    </svg>
                                                    <span>Menunggu BM</span>
                                                </div>

                                                {{-- DIBATALKAN (Not Approved) --}}
                                                <div x-show="booking.status === 'Dibatalkan'"
                                                    class="inline-flex items-center px-4 py-2 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 text-xs font-medium rounded-lg">
                                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                    <span>Dibatalkan</span>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </template>

                                {{-- Mobile Empty State --}}
                                <div x-show="filteredBookings.length === 0" class="text-center py-12">
                                    <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    <p class="text-gray-500 dark:text-gray-400 text-lg font-medium">Tidak ada booking
                                    </p>
                                    <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Coba kata kunci lain atau
                                        ubah filter</p>
                                </div>

                                {{-- ✅ NEW: Pagination Controls (Mobile) --}}
                                <div x-show="filteredBookings.length > 0"
                                    class="bg-white dark:bg-gray-800 p-4 rounded-lg border border-gray-200 dark:border-gray-600">
                                    <div class="flex flex-col space-y-3">
                                        <div class="text-center">
                                            <p class="text-sm text-gray-700 dark:text-gray-300">
                                                Page <span class="font-medium" x-text="currentPage"></span> of <span
                                                    class="font-medium" x-text="totalPages"></span>
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                Showing <span x-text="startIndex + 1"></span>-<span
                                                    x-text="Math.min(endIndex, filteredBookings.length)"></span> of
                                                <span x-text="filteredBookings.length"></span>
                                            </p>
                                        </div>

                                        <div class="flex gap-2">
                                            <button @click="prevPage()" :disabled="currentPage === 1"
                                                class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-lg text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed transition">
                                                ← Previous
                                            </button>
                                            <button @click="nextPage()" :disabled="currentPage === totalPages"
                                                class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-lg text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed transition">
                                                Next →
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- History Checksheet Section --}}
                        <div
                            class="mt-8 bg-gray-50 dark:bg-gray-700 p-6 rounded-xl shadow-lg border border-gray-200 dark:border-gray-600">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">History Checksheet
                                </h3>
                                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                                    <div class="relative flex-1 sm:flex-initial sm:w-64">
                                        <input x-model="historySearchQuery" type="text"
                                            placeholder="Cari checksheet..."
                                            class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 text-sm">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <span
                                        class="px-3 py-2 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-sm font-medium rounded-lg whitespace-nowrap text-center">
                                        Total: <span x-text="filteredHistory.length"></span> checksheet
                                    </span>
                                </div>
                            </div>

                            {{-- Table - Desktop --}}
                            <div
                                class="hidden lg:block overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-600">
                                <table class="w-full">
                                    <thead>
                                        <tr
                                            class="bg-gray-100 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-600">
                                            <th
                                                class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase">
                                                Customer</th>
                                            <th
                                                class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase">
                                                Mobil</th>
                                            <th
                                                class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase">
                                                Tanggal</th>
                                            <th
                                                class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase">
                                                Jam</th>
                                            <th
                                                class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase">
                                                Supervisor</th>
                                            <th
                                                class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase">
                                                Diisi Oleh</th>
                                            <th
                                                class="px-4 py-3 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase">
                                                Status</th>
                                            <th
                                                class="px-4 py-3 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase">
                                                Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                                        <template x-for="checksheet in paginatedHistory" :key="checksheet.id">
                                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-600 transition">
                                                <td class="px-4 py-3">
                                                    <div class="font-medium text-gray-900 dark:text-gray-100"
                                                        x-text="checksheet.customer"></div>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <div class="text-sm text-gray-900 dark:text-gray-100"
                                                        x-text="checksheet.car"></div>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <div class="text-sm text-gray-900 dark:text-gray-100"
                                                        x-text="checksheet.date"></div>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <div class="text-xs text-gray-600 dark:text-gray-300">
                                                        <span x-text="checksheet.jam_pinjam"></span> - <span
                                                            x-text="checksheet.jam_kembali"></span>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <div class="text-xs text-gray-600 dark:text-gray-300">
                                                        <div><span class="font-medium">SPV:</span> <span
                                                                x-text="checksheet.spv"></span></div>
                                                    </div>
                                                <td class="px-4 py-3">
                                                    <div class="text-sm text-gray-900 dark:text-gray-100">
                                                        <div class="font-medium" x-text="checksheet.filled_by"></div>
                                                        <div class="text-xs text-gray-500 dark:text-gray-400"
                                                            x-text="checksheet.filled_by_email"></div>
                                                    </div>
                                                </td>
                                                </td>
                                                <td class="px-4 py-3 text-center">
                                                    <span
                                                        class="inline-flex items-center justify-center px-2.5 py-1 text-xs font-semibold rounded-full"
                                                        :class="{
                                                            'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300': checksheet
                                                                .status === 'approved',
                                                            'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-300': checksheet
                                                                .status === 'pending',
                                                            'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300': checksheet
                                                                .status === 'rejected'
                                                        }"
                                                        x-text="checksheet.status_label">
                                                    </span>
                                                </td>
                                                <td class="px-4 py-3 text-center">
                                                    <div class="flex items-center justify-center gap-2">
                                                        <button @click="viewChecksheet(checksheet.id)"
                                                            class="inline-flex items-center px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-lg transition">
                                                            <svg class="w-3.5 h-3.5 mr-1" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                                </path>
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                                </path>
                                                            </svg>
                                                            Detail
                                                        </button>
                                                        <a :href="`/checksheet/export?checksheet_id=${checksheet.id}`"
                                                            class="inline-flex items-center px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white text-xs font-medium rounded-lg transition">
                                                            <svg class="w-3.5 h-3.5" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                                </path>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>

                            {{-- ✅ Pagination Controls (Desktop) - DI LUAR table tapi DALAM hidden lg:block --}}
                            <div x-show="filteredHistory.length > 0"
                                class="hidden lg:block bg-gray-50 dark:bg-gray-700 px-4 py-3 border-t border-gray-200 dark:border-gray-600 rounded-b-lg">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-gray-700 dark:text-gray-300">
                                            Showing
                                            <span class="font-medium" x-text="historyStartIndex + 1"></span>
                                            to
                                            <span class="font-medium"
                                                x-text="Math.min(historyEndIndex, filteredHistory.length)"></span>
                                            of
                                            <span class="font-medium" x-text="filteredHistory.length"></span>
                                            checksheets
                                        </p>
                                    </div>

                                    <div>
                                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                                            <button @click="prevHistoryPage()" :disabled="historyCurrentPage === 1"
                                                class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-sm font-medium text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-600 disabled:opacity-50 disabled:cursor-not-allowed">
                                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>

                                            <template x-for="page in historyVisiblePages" :key="page">
                                                <button @click="goToHistoryPage(page)"
                                                    :class="historyCurrentPage === page ?
                                                        'z-10 bg-blue-50 dark:bg-blue-900 border-blue-500 dark:border-blue-400 text-blue-600 dark:text-blue-200' :
                                                        'bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600 text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-600'"
                                                    class="relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                                    <span x-text="page"></span>
                                                </button>
                                            </template>

                                            <button @click="nextHistoryPage()"
                                                :disabled="historyCurrentPage === historyTotalPages"
                                                class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-sm font-medium text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-600 disabled:opacity-50 disabled:cursor-not-allowed">
                                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </nav>
                                    </div>
                                </div>
                            </div>

                            {{-- Cards - Mobile & Tablet --}}
                            <div class="lg:hidden space-y-3">
                                <template x-for="checksheet in paginatedHistory" :key="checksheet.id">
                                    <div
                                        class="bg-white dark:bg-gray-800 p-4 rounded-lg border border-gray-200 dark:border-gray-600 hover:shadow-md transition">
                                        <div class="flex items-start justify-between mb-3">
                                            <div class="flex-1 min-w-0">
                                                <h4 class="font-semibold text-gray-900 dark:text-gray-100 truncate"
                                                    x-text="checksheet.customer"></h4>
                                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5"
                                                    x-text="checksheet.car"></p>
                                            </div>
                                            <span
                                                class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full ml-2 flex-shrink-0"
                                                :class="{
                                                    'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300': checksheet
                                                        .status === 'approved',
                                                    'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-300': checksheet
                                                        .status === 'pending',
                                                    'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300': checksheet
                                                        .status === 'rejected'
                                                }"
                                                x-text="checksheet.status_label">
                                            </span>
                                        </div>

                                        <div class="space-y-1.5 text-xs text-gray-600 dark:text-gray-300 mb-3">
                                            <div class="flex items-start">
                                                <span class="font-medium w-20 flex-shrink-0">Tanggal:</span>
                                                <span x-text="checksheet.date"></span>
                                            </div>
                                            <div class="flex items-start">
                                                <span class="font-medium w-20 flex-shrink-0">Jam:</span>
                                                <span><span x-text="checksheet.jam_pinjam"></span> - <span
                                                        x-text="checksheet.jam_kembali"></span></span>
                                            </div>
                                            <div class="flex items-start">
                                                <span class="font-medium w-20 flex-shrink-0">SPV:</span>
                                                <span x-text="checksheet.spv"></span>
                                            </div>
                                            <div class="flex items-start">
                                                <span class="font-medium w-20 flex-shrink-0">Diisi Oleh:</span>
                                                <div>
                                                    <div class="font-semibold text-gray-900 dark:text-gray-100"
                                                        x-text="checksheet.filled_by"></div>
                                                    <div class="text-[10px] text-gray-500 dark:text-gray-400"
                                                        x-text="checksheet.filled_by_email"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex gap-2">
                                            <button @click="viewChecksheet(checksheet.id)"
                                                class="flex-1 px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition flex items-center justify-center">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                    </path>
                                                </svg>
                                                Detail
                                            </button>
                                            <a :href="`/checksheet/export?checksheet_id=${checksheet.id}`"
                                                class="px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition flex items-center justify-center">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                    </path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            {{-- ✅ Pagination Controls (Mobile) - SETELAH cards, SEBELUM empty states --}}
                            <div x-show="filteredHistory.length > 0"
                                class="lg:hidden bg-white dark:bg-gray-800 p-4 rounded-lg border border-gray-200 dark:border-gray-600 mt-4">
                                <div class="flex flex-col space-y-3">
                                    <div class="text-center">
                                        <p class="text-sm text-gray-700 dark:text-gray-300">
                                            Page <span class="font-medium" x-text="historyCurrentPage"></span> of
                                            <span class="font-medium" x-text="historyTotalPages"></span>
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                            Showing <span x-text="historyStartIndex + 1"></span>-<span
                                                x-text="Math.min(historyEndIndex, filteredHistory.length)"></span>
                                            of <span x-text="filteredHistory.length"></span>
                                        </p>
                                    </div>

                                    <div class="flex gap-2">
                                        <button @click="prevHistoryPage()" :disabled="historyCurrentPage === 1"
                                            class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-lg text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed transition">
                                            ← Previous
                                        </button>
                                        <button @click="nextHistoryPage()"
                                            :disabled="historyCurrentPage === historyTotalPages"
                                            class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-lg text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed transition">
                                            Next →
                                        </button>
                                    </div>
                                </div>
                            </div>

                            {{-- Empty States --}}
                            <div x-show="filteredHistory.length === 0 && historySearchQuery.length > 0"
                                class="text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <p class="text-gray-500 dark:text-gray-400 text-lg">Tidak ditemukan checksheet</p>
                                <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Coba kata kunci lain</p>
                            </div>

                            <div x-show="checksheetHistory.length === 0" class="text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                <p class="text-gray-500 dark:text-gray-400 text-lg">Belum ada history checksheet</p>
                                <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Checksheet akan muncul setelah
                                    dibuat</p>
                            </div>
                        </div>

                        {{-- Checksheet Modal --}}
                        <div x-show="checksheetModal" x-cloak
                            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 p-4 overflow-y-auto">
                            <div
                                class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-6xl max-h-[90vh] overflow-y-auto my-8">
                                <div
                                    class="sticky top-0 bg-white dark:bg-gray-800 p-6 border-b border-gray-200 dark:border-gray-600 z-10">
                                    <div class="flex justify-between items-center">
                                        <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                                            <span
                                                x-text="isViewMode ? 'Detail Check Sheet' : (isEditMode ? 'Edit Check Sheet' : 'Form Check Sheet')"></span>
                                        </h3>
                                        <button @click="closeChecksheetModal()"
                                            class="text-gray-500 hover:text-red-500 text-2xl font-bold">×</button>
                                    </div>
                                </div>

                                <form @submit.prevent="submitChecksheet()" class="p-6">
                                    <input type="hidden" :value="selectedBooking?.id ?? ''">
                                    <div class="text-center mb-6">
                                        <h3
                                            class="text-xl font-bold text-gray-800 dark:text-gray-900 bg-yellow-300 dark:bg-yellow-500 p-2 rounded">
                                            Check Sheet Peminjaman & Pengembalian Unit Test Drive
                                        </h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">Agung Toyota Jambi Pal
                                            10</p>
                                    </div>

                                    {{-- Form Header --}}
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                        <div class="space-y-3">
                                            <div class="flex items-center gap-3">
                                                <label
                                                    class="w-32 text-sm font-medium text-gray-700 dark:text-gray-200">Nama
                                                    Customer:</label>
                                                <input type="text" :value="selectedBooking?.customer || '-'"
                                                    readonly
                                                    class="flex-1 px-3 py-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 bg-gray-100 dark:bg-gray-600">
                                            </div>
                                            <div class="flex items-center gap-3">
                                                <label
                                                    class="w-32 text-sm font-medium text-gray-700 dark:text-gray-200">Tanggal
                                                    Test Drive:</label>
                                                <input type="date" x-model="formData.tanggal_test_drive"
                                                    :readonly="isViewMode"
                                                    class="flex-1 px-3 py-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                                                    :class="isViewMode ? 'bg-gray-100 dark:bg-gray-600' : ''" required>
                                            </div>
                                            <div class="flex items-center gap-3">
                                                <label
                                                    class="w-32 text-sm font-medium text-gray-700 dark:text-gray-200">Jam
                                                    Pinjam:</label>
                                                <input type="time" x-model="formData.jam_pinjam"
                                                    :readonly="isViewMode"
                                                    class="flex-1 px-3 py-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                                                    :class="isViewMode ? 'bg-gray-100 dark:bg-gray-600' : ''" required>
                                            </div>
                                        </div>
                                        <div class="space-y-3">
                                            <div class="flex items-center gap-3">
                                                <label
                                                    class="w-32 text-sm font-medium text-gray-700 dark:text-gray-200">Jam
                                                    Kembali:</label>
                                                <input type="time" x-model="formData.jam_kembali"
                                                    :readonly="isViewMode"
                                                    class="flex-1 px-3 py-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                                                    :class="isViewMode ? 'bg-gray-100 dark:bg-gray-600' : ''" required>
                                            </div>
                                            <div class="flex items-center gap-3">
                                                <label
                                                    class="w-32 text-sm font-medium text-gray-700 dark:text-gray-200">Tipe
                                                    Mobil:</label>
                                                <input type="text" x-model="formData.tipe_mobil" readonly
                                                    class="flex-1 px-3 py-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 bg-gray-100 dark:bg-gray-600">
                                            </div>
                                            <div class="flex items-center gap-3">
                                                <label
                                                    class="w-32 text-sm font-medium text-gray-700 dark:text-gray-200">No.
                                                    Polisi:</label>
                                                <input type="text" x-model="formData.no_polisi"
                                                    :readonly="isViewMode"
                                                    class="flex-1 px-3 py-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                                                    :class="isViewMode ? 'bg-gray-100 dark:bg-gray-600' : ''" required>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Main Check Sheet Table --}}
                                    <div class="overflow-x-auto mb-6">
                                        <table
                                            class="w-full border-collapse border-2 border-gray-500 dark:border-gray-400 text-sm">
                                            <thead>
                                                <tr>
                                                    <th class="border-2 border-gray-500 dark:border-gray-400 bg-yellow-300 dark:bg-yellow-500 p-2 font-bold text-center text-gray-900"
                                                        rowspan="2">
                                                        Kondisi Kendaraan Saat Di Pinjam<br>
                                                        <span class="text-xs">Bagian Di Cek</span>
                                                    </th>
                                                    <th
                                                        class="border-2 border-gray-500 dark:border-gray-400 bg-yellow-300 dark:bg-yellow-500 p-2 font-bold text-center text-gray-900">
                                                        Kondisi</th>
                                                    <th
                                                        class="border-2 border-gray-500 dark:border-gray-400 bg-yellow-300 dark:bg-yellow-500 p-2 font-bold text-center text-gray-900">
                                                        Catatan Kerusakan</th>
                                                    <th class="border-2 border-gray-500 dark:border-gray-400 bg-yellow-300 dark:bg-yellow-500 p-2 font-bold text-center text-gray-900"
                                                        rowspan="2">
                                                        Kondisi Kendaraan Saat Di Kembalikan<br>
                                                        <span class="text-xs">Bagian Di Cek</span>
                                                    </th>
                                                    <th
                                                        class="border-2 border-gray-500 dark:border-gray-400 bg-yellow-300 dark:bg-yellow-500 p-2 font-bold text-center text-gray-900">
                                                        Kondisi</th>
                                                    <th
                                                        class="border-2 border-gray-500 dark:border-gray-400 bg-yellow-300 dark:bg-yellow-500 p-2 font-bold text-center text-gray-900">
                                                        Catatan Kerusakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <template x-for="item in checkItems" :key="item.name">
                                                    <tr>
                                                        <td class="border-2 border-gray-500 dark:border-gray-400 p-2 font-medium text-gray-900 dark:text-gray-100"
                                                            x-text="item.label"></td>
                                                        <td
                                                            class="border-2 border-gray-500 dark:border-gray-400 p-2 text-center">
                                                            <div class="flex justify-center gap-4">
                                                                <label class="flex items-center gap-1">
                                                                    <input type="checkbox"
                                                                        :name="`${item.name}_pinjam_baik`"
                                                                        x-model="formData[`${item.name}_pinjam_baik`]"
                                                                        @change="toggleCatatan(item.name, 'pinjam', 'baik')"
                                                                        :disabled="isViewMode" class="w-4 h-4">
                                                                    <span
                                                                        class="text-xs text-gray-900 dark:text-gray-100">Baik</span>
                                                                </label>
                                                                <label class="flex items-center gap-1">
                                                                    <input type="checkbox"
                                                                        :name="`${item.name}_pinjam_tidak_baik`"
                                                                        x-model="formData[`${item.name}_pinjam_tidak_baik`]"
                                                                        @change="toggleCatatan(item.name, 'pinjam', 'tidak_baik')"
                                                                        :disabled="isViewMode" class="w-4 h-4">
                                                                    <span
                                                                        class="text-xs text-gray-900 dark:text-gray-100">Tidak
                                                                        Baik</span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td class="border-2 border-gray-500 dark:border-gray-400 p-2">
                                                            <input type="text"
                                                                :name="`${item.name}_pinjam_catatan`"
                                                                x-model="formData[`${item.name}_pinjam_catatan`]"
                                                                :disabled="!formData[`${item.name}_pinjam_tidak_baik`] ||
                                                                    isViewMode"
                                                                :readonly="isViewMode"
                                                                class="w-full px-2 py-1 text-xs border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 disabled:bg-gray-100 dark:disabled:bg-gray-600 disabled:cursor-not-allowed">
                                                        </td>
                                                        <td class="border-2 border-gray-500 dark:border-gray-400 p-2 font-medium text-gray-900 dark:text-gray-100"
                                                            x-text="item.label"></td>
                                                        <td
                                                            class="border-2 border-gray-500 dark:border-gray-400 p-2 text-center">
                                                            <div class="flex justify-center gap-4">
                                                                <label class="flex items-center gap-1">
                                                                    <input type="checkbox"
                                                                        :name="`${item.name}_kembali_baik`"
                                                                        x-model="formData[`${item.name}_kembali_baik`]"
                                                                        @change="toggleCatatan(item.name, 'kembali', 'baik')"
                                                                        :disabled="isViewMode" class="w-4 h-4">
                                                                    <span
                                                                        class="text-xs text-gray-900 dark:text-gray-100">Baik</span>
                                                                </label>
                                                                <label class="flex items-center gap-1">
                                                                    <input type="checkbox"
                                                                        :name="`${item.name}_kembali_tidak_baik`"
                                                                        x-model="formData[`${item.name}_kembali_tidak_baik`]"
                                                                        @change="toggleCatatan(item.name, 'kembali', 'tidak_baik')"
                                                                        :disabled="isViewMode" class="w-4 h-4">
                                                                    <span
                                                                        class="text-xs text-gray-900 dark:text-gray-100">Tidak
                                                                        Baik</span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td class="border-2 border-gray-500 dark:border-gray-400 p-2">
                                                            <input type="text"
                                                                :name="`${item.name}_kembali_catatan`"
                                                                x-model="formData[`${item.name}_kembali_catatan`]"
                                                                :disabled="!formData[`${item.name}_kembali_tidak_baik`] ||
                                                                    isViewMode"
                                                                :readonly="isViewMode"
                                                                class="w-full px-2 py-1 text-xs border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 disabled:bg-gray-100 dark:disabled:bg-gray-600 disabled:cursor-not-allowed">
                                                        </td>
                                                    </tr>
                                                </template>

                                                {{-- Bahan Bakar Section --}}
                                                <tr>
                                                    <td class="border-2 border-gray-500 dark:border-gray-400 p-3 font-bold bg-gray-100 dark:bg-gray-600 text-gray-900 dark:text-gray-100"
                                                        colspan="6">
                                                        <div class="text-center mb-3 text-base">Bahan Bakar</div>
                                                        <div
                                                            class="border-t-2 border-gray-500 dark:border-gray-400 pt-3">
                                                            <div class="text-sm mb-2 font-semibold">Saat dipinjam
                                                            </div>
                                                            <div
                                                                class="flex flex-wrap gap-4 justify-center pb-3 mb-3 border-b-2 border-gray-500 dark:border-gray-400">
                                                                <template x-for="fuel in fuelOptions"
                                                                    :key="`pinjam_${fuel.value}`">
                                                                    <label class="flex items-center gap-1">
                                                                        <input type="checkbox"
                                                                            :name="`bahan_bakar_pinjam_${fuel.value}`"
                                                                            x-model="formData[`bahan_bakar_pinjam_${fuel.value}`]"
                                                                            @change="handleSingleCheckbox('bahan_bakar_pinjam', fuel.value)"
                                                                            :disabled="isViewMode" class="w-4 h-4">
                                                                        <span
                                                                            class="text-xs text-gray-900 dark:text-gray-100"
                                                                            x-text="fuel.label"></span>
                                                                    </label>
                                                                </template>
                                                            </div>
                                                            <div class="text-sm mb-2 font-semibold">Saat Kembali</div>
                                                            <div class="flex flex-wrap gap-4 justify-center">
                                                                <template x-for="fuel in fuelOptions"
                                                                    :key="`pinjam_kembali_${fuel.value}`">
                                                                    <label class="flex items-center gap-1">
                                                                        <input type="checkbox"
                                                                            :name="`bahan_bakar_pinjam_kembali_${fuel.value}`"
                                                                            x-model="formData[`bahan_bakar_pinjam_kembali_${fuel.value}`]"
                                                                            @change="handleSingleCheckbox('bahan_bakar_pinjam_kembali', fuel.value)"
                                                                            :disabled="isViewMode" class="w-4 h-4">
                                                                        <span
                                                                            class="text-xs text-gray-900 dark:text-gray-100"
                                                                            x-text="fuel.label"></span>
                                                                    </label>
                                                                </template>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                {{-- Dokumen & Kunci Section --}}
                                                <tr>
                                                    <td class="border-2 border-gray-500 dark:border-gray-400 p-3 font-bold bg-gray-100 dark:bg-gray-600 text-gray-900 dark:text-gray-100"
                                                        colspan="3">
                                                        <div class="text-center mb-3 text-base">Dokumen & Kunci Saat
                                                            Di
                                                            Pinjam</div>
                                                        <div
                                                            class="border-t-2 border-gray-500 dark:border-gray-400 pt-3">
                                                            <template x-for="doc in dokumenItems"
                                                                :key="`pinjam_${doc.name}`">
                                                                <div
                                                                    class="flex items-center justify-between mb-3 pb-3 border-b-2 border-gray-500 dark:border-gray-400 last:border-b-0 last:mb-0 last:pb-0">
                                                                    <span class="text-sm font-semibold"
                                                                        x-text="doc.label"></span>
                                                                    <div class="flex gap-4">
                                                                        <label class="flex items-center gap-1">
                                                                            <input type="checkbox"
                                                                                :name="`${doc.name}_pinjam_ada`"
                                                                                x-model="formData[`${doc.name}_pinjam_ada`]"
                                                                                @change="handleSingleCheckbox(`${doc.name}_pinjam`, 'ada')"
                                                                                :disabled="isViewMode"
                                                                                class="w-4 h-4">
                                                                            <span class="text-xs">Ada</span>
                                                                        </label>
                                                                        <label class="flex items-center gap-1">
                                                                            <input type="checkbox"
                                                                                :name="`${doc.name}_pinjam_tidak_ada`"
                                                                                x-model="formData[`${doc.name}_pinjam_tidak_ada`]"
                                                                                @change="handleSingleCheckbox(`${doc.name}_pinjam`, 'tidak_ada')"
                                                                                :disabled="isViewMode"
                                                                                class="w-4 h-4">
                                                                            <span class="text-xs">Tidak Ada</span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </template>
                                                        </div>
                                                    </td>
                                                    <td class="border-2 border-gray-500 dark:border-gray-400 p-3 font-bold bg-gray-100 dark:bg-gray-600 text-gray-900 dark:text-gray-100"
                                                        colspan="3">
                                                        <div class="text-center mb-3 text-base">Dokumen & Kunci Saat
                                                            Di
                                                            Kembalikan</div>
                                                        <div
                                                            class="border-t-2 border-gray-500 dark:border-gray-400 pt-3">
                                                            <template x-for="doc in dokumenItems"
                                                                :key="`kembali_${doc.name}`">
                                                                <div
                                                                    class="flex items-center justify-between mb-3 pb-3 border-b-2 border-gray-500 dark:border-gray-400 last:border-b-0 last:mb-0 last:pb-0">
                                                                    <span class="text-sm font-semibold"
                                                                        x-text="doc.label"></span>
                                                                    <div class="flex gap-4">
                                                                        <label class="flex items-center gap-1">
                                                                            <input type="checkbox"
                                                                                :name="`${doc.name}_kembali_ada`"
                                                                                x-model="formData[`${doc.name}_kembali_ada`]"
                                                                                @change="handleSingleCheckbox(`${doc.name}_kembali`, 'ada')"
                                                                                :disabled="isViewMode"
                                                                                class="w-4 h-4">
                                                                            <span class="text-xs">Ada</span>
                                                                        </label>
                                                                        <label class="flex items-center gap-1">
                                                                            <input type="checkbox"
                                                                                :name="`${doc.name}_kembali_tidak_ada`"
                                                                                x-model="formData[`${doc.name}_kembali_tidak_ada`]"
                                                                                @change="handleSingleCheckbox(`${doc.name}_kembali`, 'tidak_ada')"
                                                                                :disabled="isViewMode"
                                                                                class="w-4 h-4">
                                                                            <span class="text-xs">Tidak Ada</span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </template>
                                                        </div>
                                                    </td>
                                                </tr>

                                                {{-- Kelengkapan Tambahan Section --}}
                                                <tr>
                                                    <td class="border-2 border-gray-500 dark:border-gray-400 p-3 font-bold bg-gray-100 dark:bg-gray-600 text-gray-900 dark:text-gray-100"
                                                        colspan="3">
                                                        <div class="text-center mb-3 text-base">Kelengkapan Tambahan
                                                            Saat Di Pinjam</div>
                                                        <div
                                                            class="border-t-2 border-gray-500 dark:border-gray-400 pt-3">
                                                            <div class="flex items-center justify-between">
                                                                <span class="text-sm font-semibold">Air Mineral
                                                                    Botol</span>
                                                                <div class="flex gap-4">
                                                                    <label class="flex items-center gap-1">
                                                                        <input type="checkbox"
                                                                            name="air_mineral_pinjam_ada"
                                                                            x-model="formData.air_mineral_pinjam_ada"
                                                                            @change="handleSingleCheckbox('air_mineral_pinjam', 'ada')"
                                                                            :disabled="isViewMode" class="w-4 h-4">
                                                                        <span class="text-xs">Ada</span>
                                                                    </label>
                                                                    <label class="flex items-center gap-1">
                                                                        <input type="checkbox"
                                                                            name="air_mineral_pinjam_tidak_ada"
                                                                            x-model="formData.air_mineral_pinjam_tidak_ada"
                                                                            @change="handleSingleCheckbox('air_mineral_pinjam', 'tidak_ada')"
                                                                            :disabled="isViewMode" class="w-4 h-4">
                                                                        <span class="text-xs">Tidak Ada</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="border-2 border-gray-500 dark:border-gray-400 p-3 font-bold bg-gray-100 dark:bg-gray-600 text-gray-900 dark:text-gray-100"
                                                        colspan="3">
                                                        <div class="text-center mb-3 text-base">Kelengkapan Tambahan
                                                            Saat Di Kembalikan</div>
                                                        <div
                                                            class="border-t-2 border-gray-500 dark:border-gray-400 pt-3">
                                                            <div class="flex items-center justify-between">
                                                                <span class="text-sm font-semibold">Air Mineral
                                                                    Botol</span>
                                                                <div class="flex gap-4">
                                                                    <label class="flex items-center gap-1">
                                                                        <input type="checkbox"
                                                                            name="air_mineral_kembali_ada"
                                                                            x-model="formData.air_mineral_kembali_ada"
                                                                            @change="handleSingleCheckbox('air_mineral_kembali', 'ada')"
                                                                            :disabled="isViewMode" class="w-4 h-4">
                                                                        <span class="text-xs">Ada</span>
                                                                    </label>
                                                                    <label class="flex items-center gap-1">
                                                                        <input type="checkbox"
                                                                            name="air_mineral_kembali_tidak_ada"
                                                                            x-model="formData.air_mineral_kembali_tidak_ada"
                                                                            @change="handleSingleCheckbox('air_mineral_kembali', 'tidak_ada')"
                                                                            :disabled="isViewMode" class="w-4 h-4">
                                                                        <span class="text-xs">Tidak Ada</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    {{-- Additional Fields --}}
                                    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                                                Tanggal Penggantian Pewangi
                                            </label>
                                            <input type="date" name="tanggal_penggantian_pewangi"
                                                x-model="formData.tanggal_penggantian_pewangi" :readonly="isViewMode"
                                                class="w-full px-3 py-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                                                :class="isViewMode ? 'bg-gray-100 dark:bg-gray-600' : ''">
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">( Wajib Di Ganti
                                                14 Hari Kerja )</p>
                                        </div>
                                    </div>

                                    {{-- Action Buttons --}}
                                    <div
                                        class="flex justify-center gap-4 mt-6 pt-6 border-t border-gray-200 dark:border-gray-600">
                                        {{-- View Mode Buttons --}}
                                        <template x-if="isViewMode">
                                            <div class="flex gap-4">
                                                <button type="button" @click="enableEditMode()"
                                                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                                    ✏️ Edit Checksheet
                                                </button>
                                                <button type="button" @click="confirmDeleteChecksheet()"
                                                    class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                                                    🗑️ Hapus Checksheet
                                                </button>
                                                <button type="button" @click="closeChecksheetModal()"
                                                    class="px-6 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500 transition">
                                                    ✕ Tutup
                                                </button>
                                            </div>
                                        </template>

                                        {{-- Edit/Create Mode Buttons --}}
                                        <template x-if="!isViewMode">
                                            <div class="flex gap-4">
                                                <button type="submit" :disabled="isSubmitting"
                                                    class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition disabled:bg-gray-400 disabled:cursor-not-allowed">
                                                    <span x-show="!isSubmitting">💾 <span
                                                            x-text="isEditMode ? 'Update' : 'Simpan'"></span> Check
                                                        Sheet</span>
                                                    <span x-show="isSubmitting" class="flex items-center gap-2">
                                                        <svg class="animate-spin h-5 w-5 text-white"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24">
                                                            <circle class="opacity-25" cx="12"
                                                                cy="12" r="10" stroke="currentColor"
                                                                stroke-width="4">
                                                            </circle>
                                                            <path class="opacity-75" fill="currentColor"
                                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                            </path>
                                                        </svg>
                                                        <span
                                                            x-text="isEditMode ? 'Mengupdate...' : 'Menyimpan...'"></span>
                                                    </span>
                                                </button>
                                                <button type="button" @click="resetForm()"
                                                    class="px-6 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition">
                                                    🔄 Reset Form
                                                </button>
                                                <button type="button" @click="closeChecksheetModal()"
                                                    class="px-6 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500 transition">
                                                    ✕ Batal
                                                </button>
                                            </div>
                                        </template>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- Delete Checksheet Confirmation Modal --}}
                        <div x-show="deleteChecksheetModal" x-cloak
                            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 p-4">
                            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-md">
                                <div class="p-6 border-b border-gray-200 dark:border-gray-600">
                                    <div class="flex justify-between items-center">
                                        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Konfirmasi
                                            Hapus Checksheet</h3>
                                        <button @click="deleteChecksheetModal=false; checksheetToDelete=null"
                                            class="text-gray-500 hover:text-red-500 text-xl font-bold">×</button>
                                    </div>
                                </div>

                                <div class="p-6">
                                    <div
                                        class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4 mb-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <h4 class="text-sm font-medium text-red-800 dark:text-red-200">
                                                    Peringatan!
                                                </h4>
                                                <div class="mt-2 text-sm text-red-700 dark:text-red-300">
                                                    <p>Anda akan menghapus checksheet ini.</p>
                                                    <p class="mt-2 font-medium">Tindakan ini tidak dapat dibatalkan!
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex space-x-3">
                                        <button @click="deleteChecksheet()"
                                            class="flex-1 px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition">
                                            Ya, Hapus Checksheet
                                        </button>
                                        <button @click="deleteChecksheetModal=false; checksheetToDelete=null"
                                            class="flex-1 px-4 py-2 bg-gray-300 hover:bg-gray-400 dark:bg-gray-600 dark:hover:bg-gray-500 text-gray-700 dark:text-gray-200 font-medium rounded-lg transition">
                                            Batal
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Scripts --}}
        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>

        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('checkSheetSecurity', () => ({
                    darkMode: false,
                    sidebarOpen: true,
                    searchQuery: '',
                    isUpdatingStatus: false,
                    historySearchQuery: '',
                    checksheetModal: false,
                    selectedBooking: null,
                    isSubmitting: false,
                    isViewMode: false,
                    isEditMode: false,
                    currentChecksheetId: null,
                    originalBookingData: null,
                    deleteChecksheetModal: false,
                    checksheetToDelete: null,

                    bookings: {!! json_encode($bookings ?? []) !!},
                    checksheetHistory: [],
                    // ✅ NEW: Pagination state
                    currentPage: 1,
                    itemsPerPage: 10,
                    // Pagination for history checksheet
                    historyCurrentPage: 1,
                    historyItemsPerPage: 10,

                    // ✅ NEW: Filter & Sorting State
                    customerSort: '', // 'asc', 'desc', atau ''
                    carFilter: '',
                    dateSort: '', // 'asc', 'desc', atau ''
                    dateFilter: '',
                    carStatusFilter: '',
                    approvalStatusFilter: '',

                    // Filter & Sorting state
                    filters: {
                        car: '',
                        approvalStatus: '',
                        dateFrom: '',
                        dateTo: ''
                    },

                    sorting: {
                        customer: '',
                        car: '',
                        date: ''
                    },

                    formData: {
                        booking_id: '',
                        tanggal_test_drive: '',
                        jam_pinjam: '',
                        jam_kembali: '',
                        tipe_mobil: '',
                        no_polisi: '',
                        tanggal_penggantian_pewangi: '',
                    },

                    // ✅ NEW: Filter & Sort Methods
                    sortCustomer(direction) {
                        this.customerSort = direction;
                        this.currentPage = 1;
                    },

                    clearCustomerSort() {
                        this.customerSort = '';
                        this.currentPage = 1;
                    },

                    filterByCar(carName) {
                        this.carFilter = carName;
                        this.currentPage = 1;
                    },

                    sortDate(direction) {
                        this.dateSort = direction;
                        this.dateFilter = ''; // Clear date picker when using sort
                        this.currentPage = 1;
                    },

                    filterByDate() {
                        this.dateSort = ''; // Clear sort when using date picker
                        this.currentPage = 1;
                    },

                    clearDateFilter() {
                        this.dateFilter = '';
                        this.dateSort = '';
                        this.currentPage = 1;
                    },

                    filterByCarStatus(status) {
                        this.carStatusFilter = status;
                        this.currentPage = 1;
                    },

                    filterByApprovalStatus(status) {
                        this.approvalStatusFilter = status;
                        this.currentPage = 1;
                    },

                    checkItems: [{
                            name: 'body_luar',
                            label: 'Body Luar (baret, penyok)'
                        },
                        {
                            name: 'ban_velg',
                            label: 'Ban & Velg'
                        },
                        {
                            name: 'kaca_spion',
                            label: 'Kaca & Spion'
                        },
                        {
                            name: 'interior',
                            label: 'Interior (kursi, dashboard, karpet)'
                        },
                        {
                            name: 'kebersihan_interior',
                            label: 'Kebersihan Interior'
                        },
                        {
                            name: 'peralatan',
                            label: 'Peralatan (dongkrak, toolkit, segitiga pengaman)'
                        },
                        {
                            name: 'ac_audio',
                            label: 'AC & Audio'
                        },
                        {
                            name: 'lampu',
                            label: 'Lampu-lampu'
                        }
                    ],

                    fuelOptions: [{
                            value: '1',
                            label: '1 Kotak'
                        },
                        {
                            value: '2',
                            label: '2 Kotak'
                        },
                        {
                            value: '3',
                            label: '3 Kotak'
                        },
                        {
                            value: '4',
                            label: 'Di Atas 4 Kotak'
                        }
                    ],

                    dokumenItems: [{
                            name: 'stnk',
                            label: 'STNK'
                        },
                        {
                            name: 'kunci_utama',
                            label: 'Kunci Utama'
                        },
                        {
                            name: 'remote_keyless',
                            label: 'Remote / Keyless'
                        }
                    ],

                    init() {
                        // Apply theme SYNCHRONOUSLY at the very start
                        const savedTheme = localStorage.getItem('darkMode');
                        if (savedTheme !== null) {
                            this.darkMode = savedTheme === 'true';
                        } else {
                            this.darkMode = window.matchMedia && window.matchMedia(
                                '(prefers-color-scheme: dark)').matches;
                        }

                        // Apply theme immediately before anything else
                        this.applyTheme();

                        console.log('✅ Bookings loaded:', this.bookings.length, 'items');
                        if (this.bookings.length > 0) {
                            console.log('📋 First booking:', this.bookings[0]);
                        }

                        this.initializeFormData();
                        this.loadChecksheetHistory();
                    },

                    initializeFormData() {
                        this.formData = {
                            booking_id: '',
                            tanggal_test_drive: '',
                            jam_pinjam: '',
                            jam_kembali: '',
                            tipe_mobil: '',
                            no_polisi: '',
                            tanggal_penggantian_pewangi: '',
                        };

                        this.checkItems.forEach(item => {
                            this.formData[`${item.name}_pinjam_baik`] = false;
                            this.formData[`${item.name}_pinjam_tidak_baik`] = false;
                            this.formData[`${item.name}_pinjam_catatan`] = '';
                            this.formData[`${item.name}_kembali_baik`] = false;
                            this.formData[`${item.name}_kembali_tidak_baik`] = false;
                            this.formData[`${item.name}_kembali_catatan`] = '';
                        });

                        for (let i = 1; i <= 4; i++) {
                            this.formData[`bahan_bakar_pinjam_${i}`] = false;
                            this.formData[`bahan_bakar_pinjam_kembali_${i}`] = false;
                        }

                        this.dokumenItems.forEach(doc => {
                            this.formData[`${doc.name}_pinjam_ada`] = false;
                            this.formData[`${doc.name}_pinjam_tidak_ada`] = false;
                            this.formData[`${doc.name}_kembali_ada`] = false;
                            this.formData[`${doc.name}_kembali_tidak_ada`] = false;
                        });

                        this.formData.air_mineral_pinjam_ada = false;
                        this.formData.air_mineral_pinjam_tidak_ada = false;
                        this.formData.air_mineral_kembali_ada = false;
                        this.formData.air_mineral_kembali_tidak_ada = false;
                    },

                    async loadChecksheetHistory() {
                        try {
                            const response = await fetch('/api/checksheets', {
                                headers: {
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').content
                                }
                            });

                            if (response.ok) {
                                const data = await response.json();
                                this.checksheetHistory = data.data || [];
                                console.log('📜 History loaded:', this.checksheetHistory.length,
                                    'checksheets');
                            }
                        } catch (error) {
                            console.error('Error loading checksheet history:', error);
                        }
                    },

                    toggleTheme() {
                        this.darkMode = !this.darkMode;
                        localStorage.setItem('darkMode', this.darkMode.toString());
                        this.applyTheme();

                        // Force immediate DOM update
                        this.$nextTick(() => {
                            this.applyTheme();
                        });
                    },

                    applyTheme() {
                        // Use requestAnimationFrame for immediate visual update
                        requestAnimationFrame(() => {
                            if (this.darkMode) {
                                document.documentElement.classList.add('dark');
                            } else {
                                document.documentElement.classList.remove('dark');
                            }
                        });
                    },

                    // ✅ UPDATED: filteredBookings computed property
                    get filteredBookings() {
                        let filtered = this.bookings;

                        // Search filter
                        if (this.searchQuery.trim()) {
                            const query = this.searchQuery.toLowerCase();
                            filtered = filtered.filter(booking =>
                                booking.customer.toLowerCase().includes(query) ||
                                booking.phone.toLowerCase().includes(query) ||
                                booking.car.toLowerCase().includes(query) ||
                                booking.spv.toLowerCase().includes(query)
                            );
                        }

                        // Car filter
                        if (this.carFilter) {
                            filtered = filtered.filter(booking => booking.car === this.carFilter);
                        }

                        // Car Status filter
                        if (this.carStatusFilter) {
                            filtered = filtered.filter(booking => booking.status === this
                                .carStatusFilter);
                        }

                        // Approval Status filter
                        if (this.approvalStatusFilter) {
                            filtered = filtered.filter(booking => booking.approval_status === this
                                .approvalStatusFilter);
                        }

                        // Date filter (specific date)
                        if (this.dateFilter) {
                            filtered = filtered.filter(booking => {
                                // Parse Indonesian date format "14 November 2025" to comparable format
                                const bookingDate = this.parseIndonesianDate(booking.date);
                                const filterDate = new Date(this.dateFilter);

                                return bookingDate.toDateString() === filterDate.toDateString();
                            });
                        }

                        // Customer sort
                        if (this.customerSort) {
                            filtered.sort((a, b) => {
                                const comparison = a.customer.localeCompare(b.customer);
                                return this.customerSort === 'asc' ? comparison : -comparison;
                            });
                        }

                        // Date sort
                        if (this.dateSort) {
                            filtered.sort((a, b) => {
                                const dateA = this.parseIndonesianDate(a.date);
                                const dateB = this.parseIndonesianDate(b.date);
                                const comparison = dateA - dateB;
                                return this.dateSort === 'asc' ? comparison : -comparison;
                            });
                        }

                        return filtered;
                    },

                    // ✅ NEW: Computed - Paginated Bookings
                    get paginatedBookings() {
                        const filtered = this.filteredBookings;
                        const start = (this.currentPage - 1) * this.itemsPerPage;
                        const end = start + this.itemsPerPage;
                        return filtered.slice(start, end);
                    },

                    // ✅ NEW: Computed - Total Pages
                    get totalPages() {
                        return Math.ceil(this.filteredBookings.length / this.itemsPerPage) || 1;
                    },

                    // ✅ NEW: Computed - Start Index
                    get startIndex() {
                        return (this.currentPage - 1) * this.itemsPerPage;
                    },

                    // ✅ NEW: Computed - End Index
                    get endIndex() {
                        return this.currentPage * this.itemsPerPage;
                    },

                    // ✅ NEW: Computed - Visible Pages
                    get visiblePages() {
                        const total = this.totalPages;
                        const current = this.currentPage;
                        const pages = [];

                        if (total <= 7) {
                            for (let i = 1; i <= total; i++) {
                                pages.push(i);
                            }
                        } else {
                            if (current <= 3) {
                                pages.push(1, 2, 3, 4, '...', total);
                            } else if (current >= total - 2) {
                                pages.push(1, '...', total - 3, total - 2, total - 1, total);
                            } else {
                                pages.push(1, '...', current - 1, current, current + 1, '...', total);
                            }
                        }

                        return pages;
                    },

                    // ✅ NEW: Pagination Methods
                    nextPage() {
                        if (this.currentPage < this.totalPages) {
                            this.currentPage++;
                        }
                    },

                    prevPage() {
                        if (this.currentPage > 1) {
                            this.currentPage--;
                        }
                    },

                    goToPage(page) {
                        if (typeof page === 'number' && page >= 1 && page <= this.totalPages) {
                            this.currentPage = page;
                        }
                    },

                    scrollToTop() {
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                    },

                    // ✅ NEW: History Pagination Methods
                    nextHistoryPage() {
                        if (this.historyCurrentPage < this.historyTotalPages) {
                            this.historyCurrentPage++;
                        }
                    },

                    prevHistoryPage() {
                        if (this.historyCurrentPage > 1) {
                            this.historyCurrentPage--;
                        }
                    },

                    goToHistoryPage(page) {
                        if (typeof page === 'number' && page >= 1 && page <= this.historyTotalPages) {
                            this.historyCurrentPage = page;
                        }
                    },

                    // ✅ NEW: Helper method to parse Indonesian date
                    parseIndonesianDate(dateStr) {
                        const monthMap = {
                            'Januari': 0,
                            'Februari': 1,
                            'Maret': 2,
                            'April': 3,
                            'Mei': 4,
                            'Juni': 5,
                            'Juli': 6,
                            'Agustus': 7,
                            'September': 8,
                            'Oktober': 9,
                            'November': 10,
                            'Desember': 11
                        };

                        const parts = dateStr.split(' ');
                        if (parts.length === 3) {
                            const day = parseInt(parts[0]);
                            const month = monthMap[parts[1]];
                            const year = parseInt(parts[2]);
                            return new Date(year, month, day);
                        }
                        return new Date(dateStr);
                    },

                    get filteredHistory() {
                        if (!this.checksheetHistory || !Array.isArray(this.checksheetHistory)) {
                            return [];
                        }

                        if (!this.historySearchQuery || !this.historySearchQuery.trim()) {
                            return this.checksheetHistory;
                        }

                        const query = this.historySearchQuery.toLowerCase();
                        return this.checksheetHistory.filter(checksheet => {
                            const customer = checksheet.customer?.toLowerCase() || '';
                            const car = checksheet.car?.toLowerCase() || '';
                            const noPolisi = checksheet.no_polisi?.toLowerCase() || '';

                            return customer.includes(query) ||
                                car.includes(query) ||
                                noPolisi.includes(query);
                        });
                    },

                    // ✅ NEW: Computed - Paginated History
                    get paginatedHistory() {
                        const filtered = this.filteredHistory;
                        const start = (this.historyCurrentPage - 1) * this.historyItemsPerPage;
                        const end = start + this.historyItemsPerPage;
                        return filtered.slice(start, end);
                    },

                    // ✅ NEW: Computed - History Total Pages
                    get historyTotalPages() {
                        return Math.ceil(this.filteredHistory.length / this.historyItemsPerPage) || 1;
                    },

                    // ✅ NEW: Computed - History Start Index
                    get historyStartIndex() {
                        return (this.historyCurrentPage - 1) * this.historyItemsPerPage;
                    },

                    // ✅ NEW: Computed - History End Index
                    get historyEndIndex() {
                        return this.historyCurrentPage * this.historyItemsPerPage;
                    },

                    // ✅ NEW: Computed - History Visible Pages
                    get historyVisiblePages() {
                        const total = this.historyTotalPages;
                        const current = this.historyCurrentPage;
                        const pages = [];

                        if (total <= 7) {
                            for (let i = 1; i <= total; i++) {
                                pages.push(i);
                            }
                        } else {
                            if (current <= 3) {
                                pages.push(1, 2, 3, 4, '...', total);
                            } else if (current >= total - 2) {
                                pages.push(1, '...', total - 3, total - 2, total - 1, total);
                            } else {
                                pages.push(1, '...', current - 1, current, current + 1, '...', total);
                            }
                        }

                        return pages;
                    },

                    // Check if filters active
                    get hasActiveFilters() {
                        return !!(this.filters.car || this.filters.approvalStatus || this.filters
                            .dateFrom || this.filters.dateTo);
                    },

                    // Check if sorting active
                    get hasActiveSorting() {
                        return !!(this.sorting.customer || this.sorting.car || this.sorting.date);
                    },

                    // Active filters array
                    get activeFilters() {
                        const filters = [];
                        if (this.filters.car) {
                            filters.push({
                                type: 'car',
                                label: `Mobil: ${this.filters.car}`
                            });
                        }
                        if (this.filters.approvalStatus) {
                            const statusLabel = this.filters.approvalStatus === 'approved' ?
                                'Disetujui' :
                                this.filters.approvalStatus === 'pending' ? 'Menunggu' : 'Dibatalkan';
                            filters.push({
                                type: 'approvalStatus',
                                label: `Status: ${statusLabel}`
                            });
                        }
                        if (this.filters.dateFrom) {
                            filters.push({
                                type: 'dateFrom',
                                label: `Dari: ${this.filters.dateFrom}`
                            });
                        }
                        if (this.filters.dateTo) {
                            filters.push({
                                type: 'dateTo',
                                label: `Sampai: ${this.filters.dateTo}`
                            });
                        }
                        return filters;
                    },

                    // Active sorting array
                    get activeSorting() {
                        const sorting = [];
                        if (this.sorting.customer) {
                            sorting.push({
                                type: 'customer',
                                label: `Customer: ${this.sorting.customer === 'asc' ? 'A-Z' : 'Z-A'}`
                            });
                        }
                        if (this.sorting.car) {
                            sorting.push({
                                type: 'car',
                                label: `Mobil: ${this.sorting.car === 'asc' ? 'A-Z' : 'Z-A'}`
                            });
                        }
                        if (this.sorting.date) {
                            sorting.push({
                                type: 'date',
                                label: `Tanggal: ${this.sorting.date === 'asc' ? 'Terlama' : 'Terbaru'}`
                            });
                        }
                        return sorting;
                    },

                    // Parse date from Indonesian format
                    parseDate(dateStr) {
                        const months = {
                            'Januari': '01',
                            'Februari': '02',
                            'Maret': '03',
                            'April': '04',
                            'Mei': '05',
                            'Juni': '06',
                            'Juli': '07',
                            'Agustus': '08',
                            'September': '09',
                            'Oktober': '10',
                            'November': '11',
                            'Desember': '12'
                        };

                        const parts = dateStr.split(' ');
                        if (parts.length === 3) {
                            const day = parts[0].padStart(2, '0');
                            const month = months[parts[1]];
                            const year = parts[2];

                            if (month) {
                                return new Date(`${year}-${month}-${day}`);
                            }
                        }
                        return new Date(dateStr);
                    },

                    // Check if date in range
                    isDateInRange(dateStr, fromDate, toDate) {
                        if (!fromDate && !toDate) return true;

                        const bookingDate = this.parseDate(dateStr);
                        const from = fromDate ? new Date(fromDate) : null;
                        const to = toDate ? new Date(toDate) : null;

                        if (from && bookingDate < from) return false;
                        if (to && bookingDate > to) return false;

                        return true;
                    },

                    // Apply sorting
                    applySorting(bookings) {
                        let sorted = [...bookings];

                        if (this.sorting.customer) {
                            sorted.sort((a, b) => {
                                const comparison = a.customer.localeCompare(b.customer);
                                return this.sorting.customer === 'asc' ? comparison : -comparison;
                            });
                        }

                        if (this.sorting.car) {
                            sorted.sort((a, b) => {
                                const comparison = a.car.localeCompare(b.car);
                                return this.sorting.car === 'asc' ? comparison : -comparison;
                            });
                        }

                        if (this.sorting.date) {
                            sorted.sort((a, b) => {
                                const dateA = this.parseDate(a.date);
                                const dateB = this.parseDate(b.date);
                                const comparison = dateA - dateB;
                                return this.sorting.date === 'asc' ? comparison : -comparison;
                            });
                        }

                        return sorted;
                    },

                    // Clear all filters
                    clearAllFilters() {
                        this.filters = {
                            car: '',
                            approvalStatus: '',
                            dateFrom: '',
                            dateTo: ''
                        };
                        this.sorting = {
                            customer: '',
                            car: '',
                            date: ''
                        };
                    },

                    // Clear single filter
                    clearFilter(filterType) {
                        this.filters[filterType] = '';
                    },

                    // Clear single sorting
                    clearSorting(sortType) {
                        this.sorting[sortType] = '';
                    },

                    openChecksheetModal(booking) {
                        // ✅ UPDATED: Allow access for Dikonfirmasi, Sedang test drive, Selesai, Perawatan
                        const allowedStatuses = ['Dikonfirmasi', 'Sedang test drive', 'Selesai',
                            'Perawatan'
                        ];

                        if (!allowedStatuses.includes(booking.status)) {
                            const statusMessage = booking.status === 'Menunggu' ?
                                'Booking masih menunggu approval SPV!' :
                                booking.status === 'Diproses' ?
                                'Booking masih diproses, menunggu konfirmasi Branch Manager!' :
                                'Booking ini telah dibatalkan!';

                            this.showNotification(statusMessage, booking.status === 'Dibatalkan' ? 'error' :
                                'warning');
                            return;
                        }

                        this.originalBookingData = JSON.parse(JSON.stringify(booking));
                        this.selectedBooking = booking;
                        this.isViewMode = false;
                        this.isEditMode = false;
                        this.currentChecksheetId = null;

                        this.initializeFormData();

                        this.formData.booking_id = booking.id;
                        this.formData.tipe_mobil = booking.car;
                        this.formData.tanggal_test_drive = '';

                        console.log('🆕 NEW checksheet:', this.formData);
                        this.checksheetModal = true;
                    },

                    async viewChecksheet(checksheetId) {
                        try {
                            const response = await fetch(`/checksheet/${checksheetId}`, {
                                headers: {
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').content
                                }
                            });

                            if (response.ok) {
                                const result = await response.json();
                                const data = result.data;

                                this.originalBookingData = JSON.parse(JSON.stringify(data.booking));
                                this.selectedBooking = data.booking;
                                this.currentChecksheetId = checksheetId;
                                this.isViewMode = true;
                                this.isEditMode = false;

                                this.initializeFormData();

                                Object.keys(data.form_data).forEach(key => {
                                    if (this.formData.hasOwnProperty(key)) {
                                        const value = data.form_data[key];
                                        const checkboxFields = this.getAllCheckboxFieldNames();
                                        if (checkboxFields.includes(key)) {
                                            this.formData[key] = Boolean(value && value !==
                                                '0' && value !== 0 && value !== false);
                                        } else {
                                            this.formData[key] = value;
                                        }
                                    }
                                });

                                console.log('👁️ View:', this.formData);
                                this.checksheetModal = true;
                            }
                        } catch (error) {
                            console.error('Error:', error);
                            this.showNotification('Gagal memuat checksheet', 'error');
                        }
                    },

                    // ✅ NEW: Update car status method
                    async updateCarStatus(booking, newStatus) {
                        // âœ… Prevent multiple calls
                        if (this.isUpdatingStatus) {
                            console.log('âš ï¸ Update already in progress, skipping...');
                            return;
                        }

                        if (!confirm(`Ubah status mobil "${booking.car}" menjadi "${newStatus}"?`)) {
                            return;
                        }

                        // âœ… Set flag to prevent duplicate calls
                        this.isUpdatingStatus = true;

                        try {
                            const response = await fetch(`/api/bookings/${booking.id}/status`, {
                                method: 'PUT',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').content
                                },
                                body: JSON.stringify({
                                    status: newStatus,
                                    booking_type: booking.booking_type || 'test_drive'
                                })
                            });

                            const data = await response.json();

                            if (response.ok && data.success) {
                                // âœ… Show notification ONCE
                                this.showNotification(
                                    `Status mobil berhasil diubah menjadi "${newStatus}"`,
                                    'success'
                                );

                                // Update booking status in local state
                                const index = this.bookings.findIndex(b => b.id === booking.id);
                                if (index !== -1) {
                                    this.bookings[index].status = newStatus;
                                }

                                // âœ… DON'T reload immediately - just update state
                                // Remove this line if exists:
                                // await this.loadBookingHistory();
                            } else {
                                this.showNotification(data.message || 'Gagal mengubah status mobil',
                                    'error');
                            }
                        } catch (error) {
                            console.error('Error updating car status:', error);
                            this.showNotification('Terjadi kesalahan saat mengubah status', 'error');
                        } finally {
                            // âœ… Reset flag after operation complete
                            this.isUpdatingStatus = false;
                        }
                    },

                    getAllCheckboxFieldNames() {
                        const fields = [];

                        this.checkItems.forEach(item => {
                            fields.push(`${item.name}_pinjam_baik`);
                            fields.push(`${item.name}_pinjam_tidak_baik`);
                            fields.push(`${item.name}_kembali_baik`);
                            fields.push(`${item.name}_kembali_tidak_baik`);
                        });

                        for (let i = 1; i <= 4; i++) {
                            fields.push(`bahan_bakar_pinjam_${i}`);
                            fields.push(`bahan_bakar_pinjam_kembali_${i}`);
                        }

                        this.dokumenItems.forEach(doc => {
                            fields.push(`${doc.name}_pinjam_ada`);
                            fields.push(`${doc.name}_pinjam_tidak_ada`);
                            fields.push(`${doc.name}_kembali_ada`);
                            fields.push(`${doc.name}_kembali_tidak_ada`);
                        });

                        fields.push('air_mineral_pinjam_ada');
                        fields.push('air_mineral_pinjam_tidak_ada');
                        fields.push('air_mineral_kembali_ada');
                        fields.push('air_mineral_kembali_tidak_ada');

                        return fields;
                    },

                    enableEditMode() {
                        this.isViewMode = false;
                        this.isEditMode = true;
                        console.log('✏️ Edit mode');
                    },

                    closeChecksheetModal() {
                        this.checksheetModal = false;
                        this.selectedBooking = null;
                        this.originalBookingData = null;
                        this.isViewMode = false;
                        this.isEditMode = false;
                        this.currentChecksheetId = null;
                        this.initializeFormData();
                        console.log('❌ Modal closed');
                    },

                    // Reset form TIDAK boleh set selectedBooking = null
                    resetForm() {
                        if (!confirm('Reset form? Data yang belum disimpan akan hilang.')) {
                            return;
                        }

                        // Simpan booking info dulu
                        const bookingId = this.originalBookingData?.id || this.selectedBooking?.id;
                        const carType = this.originalBookingData?.car || this.selectedBooking?.car;

                        // Reset form
                        this.initializeFormData();

                        // Restore booking info
                        if (bookingId) {
                            this.formData.booking_id = bookingId;
                            this.formData.tipe_mobil = carType;

                            if (!this.isEditMode) {
                                this.formData.tanggal_test_drive = '';
                            }
                        }

                        console.log('🔄 Form reset:', this.formData);
                        this.showNotification('Form direset', 'info');
                    },

                    toggleCatatan(itemName, stage, kondisi) {
                        const baikKey = `${itemName}_${stage}_baik`;
                        const tidakBaikKey = `${itemName}_${stage}_tidak_baik`;
                        const catatanKey = `${itemName}_${stage}_catatan`;

                        if (kondisi === 'baik' && this.formData[baikKey]) {
                            this.formData[tidakBaikKey] = false;
                            this.formData[catatanKey] = '';
                        } else if (kondisi === 'tidak_baik' && this.formData[tidakBaikKey]) {
                            this.formData[baikKey] = false;
                        }
                    },

                    handleSingleCheckbox(groupName, value) {
                        Object.keys(this.formData).forEach(key => {
                            if (key.startsWith(groupName) && !key.endsWith(value)) {
                                this.formData[key] = false;
                            }
                        });
                    },

                    async submitChecksheet() {
                        if (this.isSubmitting) return;

                        // ✅ Validasi field wajib
                        if (!this.formData.tanggal_test_drive) {
                            this.showNotification('Tanggal Test Drive harus diisi!', 'error');
                            return;
                        }

                        if (!this.formData.jam_pinjam) {
                            this.showNotification('Jam Pinjam harus diisi!', 'error');
                            return;
                        }

                        if (!this.formData.jam_kembali) {
                            this.showNotification('Jam Kembali harus diisi!', 'error');
                            return;
                        }

                        if (!this.formData.no_polisi || !this.formData.no_polisi.trim()) {
                            this.showNotification('No. Polisi harus diisi!', 'error');
                            return;
                        }
                        this.isSubmitting = true;

                        try {
                            const url = this.isEditMode ?
                                `/checksheet/${this.currentChecksheetId}` :
                                '/checksheet/store';

                            const method = this.isEditMode ? 'PUT' : 'POST';

                            console.log('💾 Submitting:', {
                                url,
                                method,
                                data: this.formData
                            });

                            const response = await fetch(url, {
                                method: method,
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').content
                                },
                                body: JSON.stringify(this.formData)
                            });

                            const data = await response.json();

                            if (response.ok && data.success) {
                                this.showNotification(data.message, 'success');
                                this.closeChecksheetModal();
                                await this.loadChecksheetHistory();
                                setTimeout(() => window.location.reload(), 1500);
                            } else {
                                this.showNotification(data.message || 'Gagal menyimpan', 'error');
                            }
                        } catch (error) {
                            console.error('Error:', error);
                            this.showNotification('Terjadi kesalahan', 'error');
                        } finally {
                            this.isSubmitting = false;
                        }
                    },

                    confirmDeleteChecksheet() {
                        if (!this.currentChecksheetId) {
                            this.showNotification('Checksheet tidak ditemukan', 'error');
                            return;
                        }

                        this.checksheetToDelete = this.currentChecksheetId;
                        this.checksheetModal = false;
                        this.deleteChecksheetModal = true;
                    },

                    async deleteChecksheet() {
                        if (!this.checksheetToDelete) return;

                        try {
                            const response = await fetch(`/checksheet/${this.checksheetToDelete}`, {
                                method: 'DELETE',
                                headers: {
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').content
                                }
                            });

                            const data = await response.json();

                            if (response.ok && data.success) {
                                this.showNotification('Checksheet berhasil dihapus!', 'success');

                                await this.loadChecksheetHistory();

                                this.deleteChecksheetModal = false;
                                this.checksheetToDelete = null;

                                setTimeout(() => window.location.reload(), 1500);
                            } else {
                                this.showNotification(data.message || 'Gagal menghapus checksheet',
                                    'error');
                            }
                        } catch (error) {
                            console.error('Error:', error);
                            this.showNotification('Terjadi kesalahan saat menghapus', 'error');
                        }
                    },

                    showNotification(message, type = 'info') {
                        // Check if similar notification already exists
                        const existingNotifs = document.querySelectorAll('.notification-toast');
                        for (const notif of existingNotifs) {
                            if (notif.textContent.includes(message)) {
                                console.log('⚠️ Notification already exists, skipping...');
                                return;
                            }
                        }

                        const notification = document.createElement('div');
                        const bgColor = type === 'error' ? 'bg-red-500' :
                            type === 'success' ? 'bg-green-500' :
                            type === 'warning' ? 'bg-yellow-500' : 'bg-blue-500';

                        notification.className =
                            `notification-toast fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full ${bgColor}`;

                        notification.innerHTML = `
                            <div class="flex items-center gap-3">
                                <span class="text-white flex-1">${message}</span>
                                <button onclick="this.parentElement.parentElement.remove()" 
                                        class="ml-2 text-white hover:text-gray-200 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        `;

                        document.body.appendChild(notification);

                        setTimeout(() => notification.classList.remove('translate-x-full'), 100);

                        setTimeout(() => {
                            if (notification.parentElement) {
                                notification.classList.add('translate-x-full');
                                setTimeout(() => notification.remove(), 300);
                            }
                        }, 3000);
                    }
                }));
            });
        </script>
</x-layouts.app>
