<x-layouts.app :title="'Dashboard'">
    <div x-data="bookingDashboard" x-init="init()"
        class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 transition-all duration-300">
        {{-- Sidebar Navigation --}}
        <div class="flex">
            {{-- Sidebar --}}
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
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <span
                                    class="text-xl font-bold text-gray-900 dark:text-white block leading-tight">Dashboard</span>
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

                        <a href="{{ route('dashboard') }}"
                            class="flex items-center px-4 py-3.5 text-gray-900 dark:text-white bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/30 dark:to-indigo-900/30 rounded-xl border border-blue-200 dark:border-blue-800 group transition-all duration-200 shadow-sm">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center mr-3 shadow-md group-hover:shadow-lg transition-shadow">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                    </path>
                                </svg>
                            </div>
                            <span class="font-semibold">Dashboard</span>
                        </a>

                        @if (auth()->user()->canAccessChecksheet())
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
                        @endif

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
                <nav
                    class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-lg border-b border-gray-200 dark:border-gray-700 px-6 py-4 sticky top-0 z-30 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <button @click="sidebarOpen = !sidebarOpen"
                                class="p-2.5 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-xl transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                        </div>

                        <div class="flex items-center gap-3">
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
                <div class="p-6 lg:p-8">
                    <div class="max-w-7xl mx-auto space-y-6">
                        {{-- Success & Error Messages --}}
                        @if (session('success'))
                            <div
                                class="p-4 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border-l-4 border-green-500 rounded-lg shadow-sm">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p class="text-green-800 dark:text-green-200 font-medium">{{ session('success') }}
                                    </p>
                                </div>
                            </div>
                        @endif

                        @if (session('error') && session('error') !== 'Anda tidak memiliki akses ke halaman tersebut.')
                            <div
                                class="p-4 bg-gradient-to-r from-red-50 to-rose-50 dark:from-red-900/20 dark:to-rose-900/20 border-l-4 border-red-500 rounded-lg shadow-sm">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-red-500 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p class="text-red-800 dark:text-red-200 font-medium">{{ session('error') }}</p>
                                </div>
                            </div>
                        @endif

                        {{-- UPDATED Management Booking Section --}}
                        <div
                            class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-200 dark:border-gray-600 shadow-lg mb-8">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Management Booking
                                </h2>

                                {{-- Toggle Booking Type --}}
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

                                    {{-- Toggle Booking Type untuk MANAGEMENT BOOKING --}}
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="inline-flex rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 p-1">
                                            <button
                                                @click="managementViewType = 'test_drive'; managementCurrentPage = 1"
                                                :class="managementViewType === 'test_drive' ? 'bg-blue-600 text-white' :
                                                    'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700'"
                                                class="px-4 py-2 rounded-md text-sm font-medium transition">
                                                Test Drive
                                            </button>
                                            <button @click="managementViewType = 'pameran'; managementCurrentPage = 1"
                                                :class="managementViewType === 'pameran' ? 'bg-blue-600 text-white' :
                                                    'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700'"
                                                class="px-4 py-2 rounded-md text-sm font-medium transition">
                                                Pameran/Movex
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Search & Count --}}
                            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mb-4">
                                <div class="relative flex-1">
                                    <input x-model="managementSearchQuery" type="text"
                                        placeholder="Cari booking..."
                                        class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 text-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <span
                                    class="px-3 py-2 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-sm font-medium rounded-lg whitespace-nowrap text-center">
                                    Total: <span x-text="filteredManagementBookings.length"></span> booking
                                </span>
                            </div>

                            {{-- Active Filters & Sort Display --}}
                            <div x-show="managementSPVFilter || managementSPVSort || managementStatusFilter || managementStatusSort"
                                class="mb-4 p-3 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="text-xs font-semibold text-blue-700 dark:text-blue-300">Filter
                                        Aktif:</span>

                                    {{-- SPV Filter --}}
                                    <template x-if="managementSPVFilter">
                                        <span
                                            class="inline-flex items-center gap-1 px-2 py-1 bg-blue-600 text-white text-xs font-medium rounded-full">
                                            SPV: <span x-text="managementSPVFilter"></span>
                                            <button
                                                @click.prevent="managementSPVFilter = ''; managementCurrentPage = 1"
                                                class="ml-1 hover:bg-blue-700 rounded-full p-0.5 transition">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    {{-- SPV Sort --}}
                                    <template x-if="managementSPVSort">
                                        <span
                                            class="inline-flex items-center gap-1 px-2 py-1 bg-purple-600 text-white text-xs font-medium rounded-full">
                                            Sort SPV: <span
                                                x-text="managementSPVSort === 'asc' ? 'A → Z' : 'Z → A'"></span>
                                            <button @click.prevent="managementSPVSort = ''; managementCurrentPage = 1"
                                                class="ml-1 hover:bg-purple-700 rounded-full p-0.5 transition">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    {{-- Status Filter --}}
                                    <template x-if="managementStatusFilter">
                                        <span
                                            class="inline-flex items-center gap-1 px-2 py-1 bg-green-600 text-white text-xs font-medium rounded-full">
                                            Status: <span x-text="managementStatusFilter"></span>
                                            <button
                                                @click.prevent="managementStatusFilter = ''; managementCurrentPage = 1"
                                                class="ml-1 hover:bg-green-700 rounded-full p-0.5 transition">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    {{-- Status Sort --}}
                                    <template x-if="managementStatusSort">
                                        <span
                                            class="inline-flex items-center gap-1 px-2 py-1 bg-indigo-600 text-white text-xs font-medium rounded-full">
                                            Sort Status: <span
                                                x-text="managementStatusSort === 'asc' ? 'Asc' : 'Desc'"></span>
                                            <button
                                                @click.prevent="managementStatusSort = ''; managementCurrentPage = 1"
                                                class="ml-1 hover:bg-indigo-700 rounded-full p-0.5 transition">
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
                                            managementSPVFilter = '';
                                            managementSPVSort = '';
                                            managementStatusFilter = '';
                                            managementStatusSort = '';
                                            managementSearchQuery = '';
                                            managementCurrentPage = 1;
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

                            {{-- TEST DRIVE MANAGEMENT TABLE - Desktop --}}
                            <div x-show="managementViewType === 'test_drive'" class="hidden lg:block overflow-x-auto">
                                <table class="w-full table-fixed">
                                    <thead>
                                        <tr
                                            class="bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                                            <th
                                                class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase">
                                                Tipe Booking</th>
                                            <th
                                                class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                                <div class="flex items-center justify-between">
                                                    <span x-show="'{{ auth()->user()->role }}' === 'spv'">Sales</span>
                                                    <span x-show="'{{ auth()->user()->role }}' !== 'spv'">SPV</span>
                                                    <div class="relative ml-2" x-data="{ open: false }">
                                                        <button @click="open = !open"
                                                            class="p-1 hover:bg-gray-200 dark:hover:bg-gray-600 rounded">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                                                            </svg>
                                                        </button>

                                                        <div x-show="open" @click.away="open = false" x-transition
                                                            class="absolute right-0 top-full mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-600 z-[200]"
                                                            style="display: none;">
                                                            <div class="py-2">
                                                                <p
                                                                    class="px-4 py-1 text-xs font-semibold text-gray-500 dark:text-gray-400">
                                                                    Sort by SPV Name:
                                                                </p>
                                                                <button
                                                                    @click="sortManagementBySPV('asc'); open = false"
                                                                    class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                                    :class="managementSPVSort === 'asc' ?
                                                                        'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                                        'text-gray-900 dark:text-gray-100'">
                                                                    A -> Z
                                                                </button>
                                                                <button
                                                                    @click="sortManagementBySPV('desc'); open = false"
                                                                    class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                                    :class="managementSPVSort === 'desc' ?
                                                                        'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                                        'text-gray-900 dark:text-gray-100'">
                                                                    Z <- A </button>
                                                            </div>
                                                            <!-- Filter by SPV (hanya untuk non-SPV users) -->
                                                            <div x-show="'{{ auth()->user()->role }}' !== 'spv'"
                                                                class="py-2 border-t border-gray-200 dark:border-gray-600">
                                                                <p
                                                                    class="px-4 py-1 text-xs font-semibold text-gray-500 dark:text-gray-400">
                                                                    Filter by SPV:
                                                                </p>
                                                                <button
                                                                    @click="filterManagementBySPV(''); open = false"
                                                                    class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700 font-semibold"
                                                                    :class="managementSPVFilter === '' ?
                                                                        'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                                        'text-gray-900 dark:text-gray-100'">
                                                                    All SPV
                                                                </button>

                                                                {{-- Dynamic SPV List --}}
                                                                <template x-for="spv in uniqueSPVList"
                                                                    :key="spv">
                                                                    <button
                                                                        @click="filterManagementBySPV(spv); open = false"
                                                                        class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                                        :class="managementSPVFilter === spv ?
                                                                            'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                                            'text-gray-900 dark:text-gray-100'">
                                                                        <span x-text="spv"></span>
                                                                    </button>
                                                                </template>
                                                            </div>

                                                            <div
                                                                class="py-2 border-t border-gray-200 dark:border-gray-600">
                                                                <button
                                                                    @click="clearManagementSPVFilter(); open = false"
                                                                    class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700 text-red-600 dark:text-red-400 font-semibold">
                                                                    Clear Filter
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </th>

                                            <th
                                                class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase w-40">
                                                Tanggal Booking
                                            </th>

                                            <th
                                                class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase w-40">
                                                Data Booking</th>
                                            <th
                                                class="px-4 py-3 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase w-48">
                                                <div class="flex items-center justify-center">
                                                    <span>Status</span>
                                                    <div class="relative ml-2" x-data="{ open: false }">
                                                        <button @click="open = !open"
                                                            class="p-1 hover:bg-gray-200 dark:hover:bg-gray-600 rounded">
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

                                                            {{-- Filter by Status --}}
                                                            <div class="py-2">
                                                                <p
                                                                    class="px-4 py-1 text-xs font-semibold text-gray-500 dark:text-gray-400">
                                                                    Filter by Status:</p>
                                                                <button
                                                                    @click="filterManagementByStatus(''); open = false"
                                                                    class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700 font-semibold"
                                                                    :class="managementStatusFilter === '' ?
                                                                        'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                                        'text-gray-900 dark:text-gray-100'">
                                                                    Semua Status
                                                                </button>
                                                                <button
                                                                    @click="filterManagementByStatus('Menunggu'); open = false"
                                                                    class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                                    :class="managementStatusFilter === 'Menunggu' ?
                                                                        'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                                        'text-gray-900 dark:text-gray-100'">
                                                                    Menunggu
                                                                </button>
                                                                <button
                                                                    @click="filterManagementByStatus('Diproses'); open = false"
                                                                    class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                                    :class="managementStatusFilter === 'Diproses' ?
                                                                        'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                                        'text-gray-900 dark:text-gray-100'">
                                                                    Diproses
                                                                </button>
                                                                <button
                                                                    @click="filterManagementByStatus('Dikonfirmasi'); open = false"
                                                                    class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                                    :class="managementStatusFilter === 'Dikonfirmasi' ?
                                                                        'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                                        'text-gray-900 dark:text-gray-100'">
                                                                    Dikonfirmasi
                                                                </button>
                                                                <button
                                                                    @click="filterManagementByStatus('Sedang test drive'); open = false"
                                                                    class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                                    :class="managementStatusFilter === 'Sedang test drive' ?
                                                                        'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                                        'text-gray-900 dark:text-gray-100'">
                                                                    <span
                                                                        x-show="managementViewType === 'test_drive'">Sedang
                                                                        Test Drive</span>
                                                                    <span
                                                                        x-show="managementViewType === 'pameran'">Sedang
                                                                        Pameran</span>
                                                                </button>
                                                                <button
                                                                    @click="filterManagementByStatus('Selesai'); open = false"
                                                                    class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                                    :class="managementStatusFilter === 'Selesai' ?
                                                                        'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                                        'text-gray-900 dark:text-gray-100'">
                                                                    Selesai
                                                                </button>
                                                                <button
                                                                    @click="filterManagementByStatus('Perawatan'); open = false"
                                                                    class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                                    :class="managementStatusFilter === 'Perawatan' ?
                                                                        'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                                        'text-gray-900 dark:text-gray-100'">
                                                                    Perawatan
                                                                </button>
                                                                <button
                                                                    @click="filterManagementByStatus('Dibatalkan'); open = false"
                                                                    class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                                    :class="managementStatusFilter === 'Dibatalkan' ?
                                                                        'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                                        'text-gray-900 dark:text-gray-100'">
                                                                    Dibatalkan
                                                                </button>
                                                            </div>

                                                            {{-- Clear Filter --}}
                                                            <div
                                                                class="py-2 border-t border-gray-200 dark:border-gray-600">
                                                                <button
                                                                    @click="clearManagementStatusFilter(); open = false"
                                                                    class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700 text-red-600 dark:text-red-400">
                                                                    Clear Filter
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </th>
                                            <th
                                                class="px-4 py-3 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase w-32">
                                                Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                                        <template x-for="booking in paginatedManagementBookings"
                                            :key="booking.id">
                                            <tr class="h-20">
                                                {{-- Tipe Booking --}}
                                                <td class="px-4 py-3">
                                                    <span
                                                        class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                                        Test Drive
                                                    </span>
                                                </td>

                                                <td class="px-4 py-3">
                                                    {{-- ✅ Show Sales for SPV, SPV for others --}}
                                                    <template x-if="'{{ auth()->user()->role }}' === 'spv'">
                                                        <div>
                                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100"
                                                                x-text="booking.sales_name || '-'"></div>
                                                            <div class="text-xs text-gray-500 dark:text-gray-400"
                                                                x-text="booking.sales_phone || '-'"></div>
                                                        </div>
                                                    </template>
                                                    <template x-if="'{{ auth()->user()->role }}' !== 'spv'">
                                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100"
                                                            x-text="booking.spv || '-'"></div>
                                                    </template>
                                                </td>

                                                <td class="px-4 py-3">
                                                    <div class="text-sm text-gray-900 dark:text-gray-100"
                                                        x-text="booking.date"></div>
                                                </td>

                                                {{-- Data Booking Button --}}
                                                <td class="px-4 py-3">
                                                    <button @click="openManagementDetailModal(booking)"
                                                        class="px-4 py-2 bg-gray-800 hover:bg-gray-900 dark:bg-gray-700 dark:hover:bg-gray-600 text-white text-sm font-medium rounded-lg transition">
                                                        Lihat Detail
                                                    </button>
                                                </td>

                                                {{-- Status --}}
                                                <td class="px-4 py-3 text-center">
                                                    <span
                                                        class="px-3 py-1 inline-flex text-xs font-semibold rounded-full whitespace-nowrap"
                                                        :class="{
                                                            'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200': booking
                                                                .status === 'Menunggu',
                                                            'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200': booking
                                                                .status === 'Dikonfirmasi',
                                                            'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200': booking
                                                                .status === 'Diproses',
                                                            'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200': booking
                                                                .status === 'Sedang test drive',
                                                            'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200': booking
                                                                .status === 'Selesai',
                                                            'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200': booking
                                                                .status === 'Perawatan',
                                                            'bg-gray-800 text-white dark:bg-white dark:text-gray-800': booking.status==='Dibatalkan'
                                                        }"
                                                        x-text="booking.status">
                                                    </span>
                                                </td>
                                                <td class="px-4 py-3 text-center">
                                                    <button @click="openStatusModalFromManagement(booking)"
                                                        class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-medium text-sm underline">
                                                        Ubah Status
                                                    </button>
                                                </td>
                                            </tr>
                                        </template>
                                        {{-- Empty rows to maintain table height --}}
                                        <template
                                            x-for="i in (managementItemsPerPage - paginatedManagementBookings.length)"
                                            :key="'empty-' + i">
                                            <tr class="h-20">
                                                <td class="px-4 py-3" colspan="5">
                                                    <div class="h-full">&nbsp;</div>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>

                            {{-- TEST DRIVE MANAGEMENT CARDS - Mobile & Tablet --}}
                            <div x-show="managementViewType === 'test_drive'" class="lg:hidden space-y-3">
                                <template x-for="booking in paginatedManagementBookings" :key="booking.id">
                                    <div
                                        class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg border border-gray-200 dark:border-gray-600">
                                        {{-- Header --}}
                                        <div class="flex items-start justify-between mb-3">
                                            <span
                                                class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                                Test Drive
                                            </span>
                                            <span
                                                class="ml-2 px-2 py-1 text-xs font-semibold rounded-full whitespace-nowrap"
                                                :class="{
                                                    'bg-yellow-100 text-yellow-800': booking.status === 'Menunggu',
                                                    'bg-blue-100 text-blue-800': booking.status === 'Dikonfirmasi',
                                                    'bg-purple-100 text-purple-800': booking.status === 'Diproses',
                                                    'bg-indigo-100 text-indigo-800': booking
                                                        .status === 'Sedang test drive',
                                                    'bg-green-100 text-green-800': booking.status === 'Selesai',
                                                    'bg-red-100 text-red-800': booking.status === 'Perawatan',
                                                    'bg-gray-800 text-white': booking.status === 'Dibatalkan'
                                                }"
                                                x-text="booking.status">
                                            </span>
                                        </div>

                                        {{-- SPV Info --}}
                                        <div class="mb-3">
                                            <template x-if="'{{ auth()->user()->role }}' === 'spv'">
                                                <div>
                                                    <div class="text-sm font-semibold text-gray-900 dark:text-gray-100"
                                                        x-text="booking.sales_name || '-'"></div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400"
                                                        x-text="booking.sales_phone || '-'"></div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400">Sales</div>
                                                </div>
                                            </template>
                                            <template x-if="'{{ auth()->user()->role }}' !== 'spv'">
                                                <div>
                                                    <div class="text-sm font-semibold text-gray-900 dark:text-gray-100"
                                                        x-text="booking.spv"></div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400">Supervisor
                                                    </div>
                                                </div>
                                            </template>
                                        </div>

                                        <div class="mb-3">
                                            <div class="text-xs text-gray-500 dark:text-gray-400">Tanggal Booking:
                                            </div>
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100"
                                                x-text="booking.date"></div>
                                        </div>

                                        {{-- Actions --}}
                                        <div class="flex gap-2">
                                            <button @click="openManagementDetailModal(booking)"
                                                class="flex-1 px-3 py-2 bg-gray-800 hover:bg-gray-900 text-white text-sm font-medium rounded-lg transition">
                                                Lihat Detail
                                            </button>

                                            <button @click="openStatusModalFromManagement(booking)"
                                                class="flex-1 px-3 py-2 text-sm font-medium rounded-lg transition"
                                                :class="booking.status === 'Diproses' && '{{ auth()->user()->role }}'
                                                === 'branch_manager'
                                                    ?
                                                    'bg-green-600 hover:bg-green-700 text-white' :
                                                    'bg-blue-600 hover:bg-blue-700 text-white'"
                                                :disabled="booking.status !== 'Diproses' && '{{ auth()->user()->role }}'
                                                === 'branch_manager'">
                                                <span
                                                    x-show="booking.status === 'Diproses' && '{{ auth()->user()->role }}' === 'branch_manager'">
                                                    Approve
                                                </span>
                                                <span
                                                    x-show="booking.status !== 'Diproses' || '{{ auth()->user()->role }}' !== 'branch_manager'">
                                                    Ubah Status
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            {{-- PAMERAN MANAGEMENT TABLE - Desktop --}}
                            <div x-show="managementViewType === 'pameran'" class="hidden lg:block overflow-x-auto">
                                <table class="w-full table-fixed">
                                    <thead>
                                        <tr
                                            class="bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                                            <th
                                                class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase w-32">
                                                Tipe Booking</th>
                                            <th
                                                class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase w-48">
                                                PIC</th>
                                            <th
                                                class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                                <div class="flex items-center justify-between">
                                                    <span>SPV</span>
                                                    <div class="relative ml-2" x-data="{ open: false }">
                                                        <button @click="open = !open"
                                                            class="p-1 hover:bg-gray-200 dark:hover:bg-gray-600 rounded">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                                                            </svg>
                                                        </button>

                                                        <div x-show="open" @click.away="open = false" x-transition
                                                            class="absolute right-0 top-full mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-600 z-[200]"
                                                            style="display: none;">
                                                            <div class="py-2">
                                                                <p
                                                                    class="px-4 py-1 text-xs font-semibold text-gray-500 dark:text-gray-400">
                                                                    Sort by SPV Name:
                                                                </p>
                                                                <button
                                                                    @click="sortManagementBySPV('asc'); open = false"
                                                                    class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                                    :class="managementSPVSort === 'asc' ?
                                                                        'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                                        'text-gray-900 dark:text-gray-100'">
                                                                    A → Z
                                                                </button>
                                                                <button
                                                                    @click="sortManagementBySPV('desc'); open = false"
                                                                    class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                                    :class="managementSPVSort === 'desc' ?
                                                                        'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                                        'text-gray-900 dark:text-gray-100'">
                                                                    Z ← A
                                                                </button>
                                                            </div>
                                                            <div
                                                                class="py-2 border-t border-gray-200 dark:border-gray-600">
                                                                <p
                                                                    class="px-4 py-1 text-xs font-semibold text-gray-500 dark:text-gray-400">
                                                                    Filter by SPV:
                                                                </p>
                                                                <button
                                                                    @click="filterManagementBySPV(''); open = false"
                                                                    class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700 font-semibold"
                                                                    :class="managementSPVFilter === '' ?
                                                                        'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                                        'text-gray-900 dark:text-gray-100'">
                                                                    All SPV
                                                                </button>

                                                                {{-- Dynamic SPV List --}}
                                                                <template x-for="spv in uniqueSPVList"
                                                                    :key="spv">
                                                                    <button
                                                                        @click="filterManagementBySPV(spv); open = false"
                                                                        class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                                        :class="managementSPVFilter === spv ?
                                                                            'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                                            'text-gray-900 dark:text-gray-100'">
                                                                        <span x-text="spv"></span>
                                                                    </button>
                                                                </template>
                                                            </div>

                                                            <!-- Clear All -->
                                                            <div
                                                                class="py-2 border-t border-gray-200 dark:border-gray-600">
                                                                <button
                                                                    @click="clearManagementSPVFilter(); open = false"
                                                                    class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700 text-red-600 dark:text-red-400 font-semibold">
                                                                    Clear All
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </th>
                                            <th
                                                class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase w-40">
                                                Tanggal Booking
                                            </th>
                                            <th
                                                class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase w-40">
                                                Data Booking</th>
                                            <th
                                                class="px-4 py-3 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase w-40">
                                                <div class="flex items-center justify-center">
                                                    <span>Status</span>
                                                    <div class="relative ml-2" x-data="{ open: false }">
                                                        <button @click="open = !open"
                                                            class="p-1 hover:bg-gray-200 dark:hover:bg-gray-600 rounded">
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

                                                            {{-- Filter by Status --}}
                                                            <div class="py-2">
                                                                <p
                                                                    class="px-4 py-1 text-xs font-semibold text-gray-500 dark:text-gray-400">
                                                                    Filter by Status:</p>
                                                                <button
                                                                    @click="filterManagementByStatus(''); open = false"
                                                                    class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700 font-semibold"
                                                                    :class="managementStatusFilter === '' ?
                                                                        'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                                        'text-gray-900 dark:text-gray-100'">
                                                                    Semua Status
                                                                </button>
                                                                <button
                                                                    @click="filterManagementByStatus('Menunggu'); open = false"
                                                                    class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                                    :class="managementStatusFilter === 'Menunggu' ?
                                                                        'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                                        'text-gray-900 dark:text-gray-100'">
                                                                    Menunggu
                                                                </button>
                                                                <button
                                                                    @click="filterManagementByStatus('Diproses'); open = false"
                                                                    class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                                    :class="managementStatusFilter === 'Diproses' ?
                                                                        'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                                        'text-gray-900 dark:text-gray-100'">
                                                                    Diproses
                                                                </button>
                                                                <button
                                                                    @click="filterManagementByStatus('Dikonfirmasi'); open = false"
                                                                    class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                                    :class="managementStatusFilter === 'Dikonfirmasi' ?
                                                                        'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                                        'text-gray-900 dark:text-gray-100'">
                                                                    Dikonfirmasi
                                                                </button>
                                                                <button
                                                                    @click="filterManagementByStatus('Sedang test drive'); open = false"
                                                                    class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                                    :class="managementStatusFilter === 'Sedang test drive' ?
                                                                        'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                                        'text-gray-900 dark:text-gray-100'">
                                                                    <span
                                                                        x-show="managementViewType === 'test_drive'">Sedang
                                                                        Test Drive</span>
                                                                    <span
                                                                        x-show="managementViewType === 'pameran'">Sedang
                                                                        Pameran</span>
                                                                </button>
                                                                <button
                                                                    @click="filterManagementByStatus('Selesai'); open = false"
                                                                    class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                                    :class="managementStatusFilter === 'Selesai' ?
                                                                        'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                                        'text-gray-900 dark:text-gray-100'">
                                                                    Selesai
                                                                </button>
                                                                <button
                                                                    @click="filterManagementByStatus('Perawatan'); open = false"
                                                                    class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                                    :class="managementStatusFilter === 'Perawatan' ?
                                                                        'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                                        'text-gray-900 dark:text-gray-100'">
                                                                    Perawatan
                                                                </button>
                                                                <button
                                                                    @click="filterManagementByStatus('Dibatalkan'); open = false"
                                                                    class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                                    :class="managementStatusFilter === 'Dibatalkan' ?
                                                                        'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                                        'text-gray-900 dark:text-gray-100'">
                                                                    Dibatalkan
                                                                </button>
                                                            </div>

                                                            {{-- Clear Filter --}}
                                                            <div
                                                                class="py-2 border-t border-gray-200 dark:border-gray-600">
                                                                <button
                                                                    @click="clearManagementStatusFilter(); open = false"
                                                                    class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700 text-red-600 dark:text-red-400 font-semibold">
                                                                    Clear Filter
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </th>
                                            <th
                                                class="px-4 py-3 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase w-32">
                                                Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                                        <template x-for="booking in paginatedManagementBookings"
                                            :key="booking.id">
                                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition h-20">
                                                <td class="px-4 py-3">
                                                    <span
                                                        class="px-2 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                                                        Pameran/Movex
                                                    </span>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100"
                                                        x-text="booking.customer"></div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400"
                                                        x-text="booking.phone || '-'"></div>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100"
                                                        x-text="booking.spv || '-'"></div>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <div class="text-sm text-gray-900 dark:text-gray-100"
                                                        x-text="booking.date"></div>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <button @click="openManagementDetailModal(booking)"
                                                        class="px-4 py-2 bg-gray-800 hover:bg-gray-900 dark:bg-gray-700 dark:hover:bg-gray-600 text-white text-sm font-medium rounded-lg transition">
                                                        Lihat Detail
                                                    </button>
                                                </td>
                                                <td class="px-4 py-3 text-center">
                                                    <span
                                                        class="px-3 py-1 inline-flex text-xs font-semibold rounded-full whitespace-nowrap"
                                                        :class="{
                                                            'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200': booking
                                                                .status === 'Menunggu',
                                                            'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200': booking
                                                                .status === 'Dikonfirmasi',
                                                            'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200': booking
                                                                .status === 'Diproses',
                                                            'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200': booking
                                                                .status === 'Sedang test drive' || booking
                                                                .status === 'Sedang Pameran',
                                                            'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200': booking
                                                                .status === 'Selesai',
                                                            'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200': booking
                                                                .status === 'Perawatan',
                                                            'bg-gray-800 text-white dark:bg-white dark:text-gray-800': booking.status==='Dibatalkan'
                                                        }"
                                                        x-text="booking.status">
                                                    </span>
                                                </td>
                                                <td class="px-4 py-3 text-center">
                                                    <button @click="openStatusModalFromManagement(booking)"
                                                        class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-medium text-sm underline">
                                                        Ubah Status
                                                    </button>
                                                </td>
                                            </tr>
                                        </template>
                                        {{-- Empty rows to maintain table height --}}
                                        <template
                                            x-for="i in (managementItemsPerPage - paginatedManagementBookings.length)"
                                            :key="'empty-' + i">
                                            <tr class="h-20">
                                                <td class="px-4 py-3" colspan="6">
                                                    <div class="h-full">&nbsp;</div>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>

                            {{-- PAMERAN MANAGEMENT CARDS - Mobile & Tablet --}}
                            <div x-show="managementViewType === 'pameran'" class="lg:hidden space-y-3">
                                <template x-for="booking in paginatedManagementBookings" :key="booking.id">
                                    <div
                                        class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg border border-gray-200 dark:border-gray-600">
                                        {{-- Header --}}
                                        <div class="flex items-start justify-between mb-3">
                                            <span
                                                class="px-2 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">
                                                Pameran/Movex
                                            </span>
                                            <span
                                                class="ml-2 px-2 py-1 text-xs font-semibold rounded-full whitespace-nowrap"
                                                :class="{
                                                    'bg-yellow-100 text-yellow-800': booking.status === 'Menunggu',
                                                    'bg-blue-100 text-blue-800': booking.status === 'Dikonfirmasi',
                                                    'bg-purple-100 text-purple-800': booking.status === 'Diproses',
                                                    'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200': booking
                                                        .status === 'Sedang Pameran',
                                                    'bg-green-100 text-green-800': booking.status === 'Selesai',
                                                    'bg-red-100 text-red-800': booking.status === 'Perawatan',
                                                    'bg-gray-800 text-white': booking.status === 'Dibatalkan'
                                                }"
                                                x-text="booking.status">
                                            </span>
                                        </div>

                                        {{-- PIC & SPV Info --}}
                                        <div class="mb-3 space-y-2">
                                            <div>
                                                <div class="text-sm font-semibold text-gray-900 dark:text-gray-100"
                                                    x-text="booking.customer"></div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400"
                                                    x-text="booking.phone || '-'"></div>
                                            </div>
                                            <div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">SPV:</div>
                                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100"
                                                    x-text="booking.spv || '-'"></div>
                                            </div>
                                        </div>

                                        {{-- ✅ NEW: Tanggal Booking --}}
                                        <div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">Tanggal Booking:
                                            </div>
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100"
                                                x-text="booking.date"></div>
                                        </div>

                                        {{-- Actions --}}
                                        <div class="flex gap-2">
                                            <button @click="openManagementDetailModal(booking)"
                                                class="flex-1 px-3 py-2 bg-gray-800 hover:bg-gray-900 text-white text-sm font-medium rounded-lg transition">
                                                Lihat Detail
                                            </button>
                                            <button @click="openStatusModalFromManagement(booking)"
                                                class="flex-1 px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition">
                                                Ubah Status
                                            </button>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            {{-- PAGINATION MANAGEMENT BOOKING - DESKTOP --}}
                            <div x-show="filteredManagementBookings.length > 0"
                                class="hidden lg:block bg-gray-50 dark:bg-gray-700 px-4 py-3 border-t border-gray-200 dark:border-gray-600 rounded-b-xl mt-0">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-gray-700 dark:text-gray-300">
                                            Showing
                                            <span class="font-medium" x-text="managementStartIndex + 1"></span>
                                            to
                                            <span class="font-medium"
                                                x-text="Math.min(managementEndIndex, filteredManagementBookings.length)"></span>
                                            of
                                            <span class="font-medium"
                                                x-text="filteredManagementBookings.length"></span>
                                            bookings
                                        </p>
                                    </div>

                                    <div>
                                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                                            <button @click="prevManagementPage()"
                                                :disabled="managementCurrentPage === 1"
                                                class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-sm font-medium text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-600 disabled:opacity-50 disabled:cursor-not-allowed">
                                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>

                                            <template x-for="page in managementVisiblePages" :key="page">
                                                <button @click="goToManagementPage(page)"
                                                    :disabled="typeof page !== 'number'"
                                                    :class="managementCurrentPage === page ?
                                                        'z-10 bg-blue-50 dark:bg-blue-900 border-blue-500 dark:border-blue-400 text-blue-600 dark:text-blue-200' :
                                                        'bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600 text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-600'"
                                                    class="relative inline-flex items-center px-4 py-2 border text-sm font-medium disabled:cursor-default">
                                                    <span x-text="page"></span>
                                                </button>
                                            </template>

                                            <button @click="nextManagementPage()"
                                                :disabled="managementCurrentPage === managementTotalPages"
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

                            {{-- Pagination untuk Mobile & Tablet - Management Booking --}}
                            <div x-show="filteredManagementBookings.length > 0"
                                class="lg:hidden bg-white dark:bg-gray-800 p-4 rounded-lg border border-gray-200 dark:border-gray-600 mt-4">
                                <div class="flex flex-col space-y-3">
                                    <div class="text-center">
                                        <p class="text-sm text-gray-700 dark:text-gray-300">
                                            Page <span class="font-medium" x-text="managementCurrentPage"></span> of
                                            <span class="font-medium" x-text="managementTotalPages"></span>
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                            Showing <span x-text="managementStartIndex + 1"></span>-<span
                                                x-text="Math.min(managementEndIndex, filteredManagementBookings.length)"></span>
                                            of <span x-text="filteredManagementBookings.length"></span>
                                        </p>
                                    </div>

                                    <div class="flex gap-2">
                                        <button @click="prevManagementPage()" :disabled="managementCurrentPage === 1"
                                            class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-lg text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed transition">
                                            ← Previous
                                        </button>
                                        <button @click="nextManagementPage()"
                                            :disabled="managementCurrentPage === managementTotalPages"
                                            class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-lg text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed transition">
                                            Next →
                                        </button>
                                    </div>
                                </div>
                            </div>

                            {{-- Empty States --}}
                            <div x-show="filteredManagementBookings.length === 0 && managementSearchQuery.length > 0"
                                class="text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <p class="text-gray-500 dark:text-gray-400 text-lg">Tidak ditemukan booking</p>
                                <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Coba kata kunci lain</p>
                            </div>

                            <div x-show="managementBookingsByType.length === 0" class="text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                <p class="text-gray-500 dark:text-gray-400 text-lg">Belum ada booking</p>
                                <p class="text-gray-400 dark:text-gray-500 text-sm mt-1"
                                    x-text="'Booking ' + (managementViewType === 'test_drive' ? 'test drive' : 'pameran/movex') + ' akan muncul di sini'">
                                </p>
                            </div>
                        </div>

                        {{-- UPDATED Management Detail Modal - Test Drive --}}
                        <div x-show="managementDetailModal && selectedManagementBooking?.booking_type === 'test_drive'"
                            x-cloak
                            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 p-4">
                            <div @click.away="managementDetailModal=false; selectedManagementBooking=null"
                                class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] overflow-hidden flex flex-col">

                                {{-- Simple Header --}}
                                <div
                                    class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Detail Booking Test
                                        Drive</h3>
                                    <button @click="managementDetailModal=false; selectedManagementBooking=null"
                                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>

                                {{-- Content --}}
                                <div x-show="selectedManagementBooking" class="overflow-y-auto flex-1 p-6">
                                    <div class="space-y-6">
                                        {{-- Mobil --}}
                                        <div>
                                            <label
                                                class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Mobil</label>
                                            <div class="text-base font-semibold text-gray-900 dark:text-white"
                                                x-text="selectedManagementBooking?.car"></div>
                                        </div>

                                        {{-- Data Sales --}}
                                        <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                            <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">
                                                Informasi Sales</h4>
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                <div>
                                                    <label
                                                        class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Nama
                                                        Sales</label>
                                                    <div class="text-sm text-gray-900 dark:text-white"
                                                        x-text="selectedManagementBooking?.sales_name || '-'"></div>
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">No.
                                                        HP Sales</label>
                                                    <div class="text-sm text-gray-900 dark:text-white"
                                                        x-text="selectedManagementBooking?.sales_phone || '-'"></div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Data Customer --}}
                                        <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                            <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Data
                                                Customer</h4>
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                <div>
                                                    <label
                                                        class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Nama
                                                        Lengkap</label>
                                                    <div class="text-sm text-gray-900 dark:text-white"
                                                        x-text="selectedManagementBooking?.customer"></div>
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">No.
                                                        HP</label>
                                                    <div class="text-sm text-gray-900 dark:text-white"
                                                        x-text="selectedManagementBooking?.phone"></div>
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Email</label>
                                                    <div class="text-sm text-gray-900 dark:text-white truncate"
                                                        x-text="selectedManagementBooking?.email"></div>
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">No.
                                                        KTP</label>
                                                    <div class="text-sm text-gray-900 dark:text-white font-mono"
                                                        x-text="selectedManagementBooking?.ktp"></div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Detail Test Drive --}}
                                        <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                            <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Detail
                                                Test Drive</h4>
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                <div>
                                                    <label
                                                        class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Tanggal
                                                        Booking</label>
                                                    <div class="text-sm text-gray-900 dark:text-white"
                                                        x-text="selectedManagementBooking?.date"></div>
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Jam
                                                        Test Drive</label>
                                                    <div class="text-sm text-gray-900 dark:text-white"
                                                        x-text="selectedManagementBooking?.test_drive_time || '-'">
                                                    </div>
                                                </div>
                                                <div class="sm:col-span-2">
                                                    <label
                                                        class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Lokasi
                                                        Test Drive</label>
                                                    <div class="text-sm text-gray-900 dark:text-white"
                                                        x-text="selectedManagementBooking?.test_drive_location || '-'">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Simple Footer --}}
                                <div
                                    class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                                    <button @click="managementDetailModal=false; selectedManagementBooking=null"
                                        class="w-full px-4 py-2 bg-gray-800 hover:bg-gray-900 dark:bg-gray-700 dark:hover:bg-gray-600 text-white font-medium rounded-lg transition">
                                        Tutup
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- UPDATED Management Detail Modal - Pameran --}}
                        <div x-show="managementDetailModal && selectedManagementBooking?.booking_type === 'pameran'"
                            x-cloak
                            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 p-4">
                            <div @click.away="managementDetailModal=false; selectedManagementBooking=null"
                                class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] overflow-hidden flex flex-col">

                                {{-- Simple Header --}}
                                <div
                                    class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Detail Booking
                                        Pameran/Movex</h3>
                                    <button @click="managementDetailModal=false; selectedManagementBooking=null"
                                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>

                                {{-- Content --}}
                                <div x-show="selectedManagementBooking" class="overflow-y-auto flex-1 p-6">
                                    <div class="space-y-6">
                                        {{-- Nama PIC --}}
                                        <div>
                                            <label
                                                class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Nama
                                                PIC</label>
                                            <div class="text-base font-semibold text-gray-900 dark:text-white"
                                                x-text="selectedManagementBooking?.customer"></div>
                                        </div>

                                        {{-- Mobil --}}
                                        <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                            <label
                                                class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Mobil</label>
                                            <div class="text-base font-semibold text-gray-900 dark:text-white"
                                                x-text="selectedManagementBooking?.car"></div>
                                        </div>

                                        {{-- Tanggal Acara --}}
                                        <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                <div>
                                                    <label
                                                        class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Tanggal
                                                        Booking</label>
                                                    <div class="text-sm text-gray-900 dark:text-white"
                                                        x-text="selectedManagementBooking?.date"></div>
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Tanggal
                                                        Acara</label>
                                                    <div class="text-sm text-gray-900 dark:text-white"
                                                        x-text="selectedManagementBooking?.event_date || '-'"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <label
                                                class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Tanggal
                                                Mulai</label>
                                            <div class="text-sm text-gray-900 dark:text-white"
                                                x-text="selectedManagementBooking?.start_date || '-'"></div>
                                        </div>
                                        <div>
                                            <label
                                                class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Tanggal
                                                Selesai</label>
                                            <div class="text-sm text-gray-900 dark:text-white"
                                                x-text="selectedManagementBooking?.end_date || '-'"></div>
                                        </div>

                                        {{-- Target Prospect --}}
                                        <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                            <label
                                                class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Target
                                                Prospect</label>
                                            <div class="text-sm text-gray-900 dark:text-white"
                                                x-text="selectedManagementBooking?.address || '-'"></div>
                                        </div>

                                        {{-- Lokasi Acara --}}
                                        <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                            <label
                                                class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Lokasi
                                                Acara</label>
                                            <div class="text-sm text-gray-900 dark:text-white"
                                                x-text="selectedManagementBooking?.event_location || '-'"></div>
                                        </div>

                                        {{-- Status --}}
                                        <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                            <label
                                                class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Status
                                                Booking</label>
                                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full"
                                                :class="{
                                                    'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200': selectedManagementBooking
                                                        ?.status === 'Menunggu',
                                                    'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200': selectedManagementBooking
                                                        ?.status === 'Dikonfirmasi',
                                                    'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200': selectedManagementBooking
                                                        ?.status === 'Diproses',
                                                    'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200': selectedManagementBooking
                                                        ?.status === 'Sedang test drive' || selectedManagementBooking
                                                        ?.status === 'Sedang Pameran',
                                                    'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200': selectedManagementBooking
                                                        ?.status === 'Selesai',
                                                    'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200': selectedManagementBooking
                                                        ?.status === 'Perawatan',
                                                    'bg-gray-800 text-white dark:bg-white dark:text-gray-800': selectedManagementBooking?.status==='Dibatalkan'
                                                }"
                                                x-text="selectedManagementBooking?.status">
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Simple Footer --}}
                                <div
                                    class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                                    <button @click="managementDetailModal=false; selectedManagementBooking=null"
                                        class="w-full px-4 py-2 bg-gray-800 hover:bg-gray-900 dark:bg-gray-700 dark:hover:bg-gray-600 text-white font-medium rounded-lg transition">
                                        Tutup
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Data Booking Section --}}
                        <div
                            class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-200 dark:border-gray-600 shadow-lg mb-8">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Data Booking
                                </h2>

                                {{-- Toggle Booking Type --}}
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="inline-flex rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 p-1">
                                            <button @click="bookingViewType = 'test_drive'; bookingCurrentPage = 1"
                                                :class="bookingViewType === 'test_drive' ? 'bg-blue-600 text-white' :
                                                    'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700'"
                                                class="px-4 py-2 rounded-md text-sm font-medium transition">
                                                Test Drive
                                            </button>
                                            <button @click="bookingViewType = 'pameran'; bookingCurrentPage = 1"
                                                :class="bookingViewType === 'pameran' ? 'bg-blue-600 text-white' :
                                                    'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700'"
                                                class="px-4 py-2 rounded-md text-sm font-medium transition">
                                                Pameran/Movex
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Search & Count --}}
                            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mb-6">
                                <div class="relative flex-1">
                                    <input x-model="bookingDataSearchQuery" type="text"
                                        placeholder="Cari booking..."
                                        class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 text-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <span
                                    class="px-3 py-2 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-sm font-medium rounded-lg whitespace-nowrap text-center">
                                    Total: <span x-text="filteredBookingData.length"></span> booking
                                </span>
                            </div>

                            {{-- TEST DRIVE BOOKING TABLE - Desktop --}}
                            <div x-show="bookingViewType === 'test_drive'" class="hidden lg:block overflow-x-auto">
                                <table class="w-full table-fixed">
                                    <thead>
                                        <tr
                                            class="bg-gray-100 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-600">
                                            <th x-show="'{{ auth()->user()->role }}' === 'spv'"
                                                class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase w-48">
                                                Sales
                                            </th>
                                            <th x-show="'{{ auth()->user()->role }}' !== 'spv'"
                                                class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase w-40">
                                                SPV
                                            </th>
                                            <th
                                                class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase w-48">
                                                Mobil</th>
                                            <th
                                                class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase w-40">
                                                Tanggal</th>
                                            <th
                                                class="px-4 py-3 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase w-40">
                                                Data Customer</th>
                                            <th
                                                class="px-4 py-3 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase w-40">
                                                Jam Test Drive</th>
                                            <th
                                                class="px-4 py-3 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase w-48">
                                                Checksheet Summary</th>
                                            <th
                                                class="px-4 py-3 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase w-40">
                                                Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                                        <template x-for="booking in paginatedBookingData" :key="booking.id">
                                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-600 transition h-20">
                                                {{-- Sales Info --}}
                                                <td x-show="'{{ auth()->user()->role }}' === 'spv'"
                                                    class="px-4 py-3">
                                                    <div class="font-medium text-gray-900 dark:text-gray-100"
                                                        x-text="booking.sales_name"></div>
                                                    <div class="text-sm text-gray-500 dark:text-gray-400"
                                                        x-text="booking.sales_phone"></div>
                                                </td>

                                                <td x-show="'{{ auth()->user()->role }}' !== 'spv'"
                                                    class="px-4 py-3">
                                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100"
                                                        x-text="booking.spv"></div>
                                                </td>
                                                {{-- Mobil --}}
                                                <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100"
                                                    x-text="booking.car"></td>

                                                {{-- Tanggal --}}
                                                <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100"
                                                    x-text="booking.date"></td>

                                                {{-- Data Customer Button --}}
                                                <td class="px-4 py-3 text-center">
                                                    <button @click="openCustomerDetailFromBooking(booking)"
                                                        class="px-4 py-2 bg-gray-800 hover:bg-gray-900 dark:bg-gray-700 dark:hover:bg-gray-600 text-white text-sm font-medium rounded-lg transition">
                                                        Detail Customer
                                                    </button>
                                                </td>

                                                {{-- Jam Test Drive --}}
                                                <td class="px-4 py-3 text-center">
                                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100"
                                                        x-text="booking.test_drive_time || '-'"></div>
                                                </td>

                                                {{-- Checksheet Summary --}}
                                                <td class="px-4 py-3 text-center">
                                                    <button @click="viewChecksheetSummary(booking.email)"
                                                        class="px-4 py-2 text-white text-sm font-medium rounded-lg transition inline-flex items-center gap-2"
                                                        :class="getChecksheetButtonClass(booking.email)">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                            </path>
                                                        </svg>
                                                        Checksheet
                                                    </button>
                                                </td>

                                                {{-- Status --}}
                                                <td class="px-4 py-3 text-center">
                                                    <span
                                                        class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full whitespace-nowrap"
                                                        :class="{
                                                            'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200': booking
                                                                .status === 'Menunggu',
                                                            'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200': booking
                                                                .status === 'Dikonfirmasi',
                                                            'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200': booking
                                                                .status === 'Diproses',
                                                            'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200': booking
                                                                .status === 'Sedang test drive',
                                                            'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200': booking
                                                                .status === 'Selesai',
                                                            'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200': booking
                                                                .status === 'Perawatan',
                                                            'bg-black text-white dark:bg-white dark:text-black': booking.status==='Dibatalkan'
                                                        }"
                                                        x-text="booking.status">
                                                    </span>
                                                </td>
                                            </tr>
                                        </template>
                                        {{-- Empty rows to maintain table height --}}
                                        <template x-for="i in (bookingItemsPerPage - paginatedBookingData.length)"
                                            :key="'empty-' + i">
                                            <tr class="h-20">
                                                <td class="px-4 py-3"
                                                    :colspan="'{{ auth()->user()->role }}'
                                                    === 'spv' ? 8 : 9">
                                                    <div class="h-full">&nbsp;</div>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                    </tbody>
                                </table>

                                <div x-show="filteredBookingData.length > 0"
                                    class="hidden lg:block bg-gray-50 dark:bg-gray-700 px-4 py-3 border-t border-gray-200 dark:border-gray-600 rounded-b-xl">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm text-gray-700 dark:text-gray-300">
                                                Showing
                                                <span class="font-medium" x-text="bookingStartIndex + 1"></span>
                                                to
                                                <span class="font-medium"
                                                    x-text="Math.min(bookingEndIndex, filteredBookingData.length)"></span>
                                                of
                                                <span class="font-medium" x-text="filteredBookingData.length"></span>
                                                bookings
                                            </p>
                                        </div>

                                        <div>
                                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                                                <button @click="prevBookingPage()"
                                                    :disabled="bookingCurrentPage === 1"
                                                    class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-sm font-medium text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-600 disabled:opacity-50 disabled:cursor-not-allowed">
                                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>

                                                <template x-for="page in bookingVisiblePages" :key="page">
                                                    <button @click="goToBookingPage(page)"
                                                        :disabled="typeof page !== 'number'"
                                                        :class="bookingCurrentPage === page ?
                                                            'z-10 bg-blue-50 dark:bg-blue-900 border-blue-500 dark:border-blue-400 text-blue-600 dark:text-blue-200' :
                                                            'bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600 text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-600'"
                                                        class="relative inline-flex items-center px-4 py-2 border text-sm font-medium disabled:cursor-default">
                                                        <span x-text="page"></span>
                                                    </button>
                                                </template>

                                                <button @click="nextBookingPage()"
                                                    :disabled="bookingCurrentPage === bookingTotalPages"
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

                            </div>

                            {{-- TEST DRIVE BOOKING CARDS - Mobile & Tablet --}}
                            <div x-show="bookingViewType === 'test_drive'" class="lg:hidden space-y-3">
                                <template x-for="booking in paginatedBookingData" :key="booking.id">
                                    <div
                                        class="bg-white dark:bg-gray-800 p-4 rounded-lg border border-gray-200 dark:border-gray-600 hover:shadow-md transition">
                                        {{-- Header: Sales & Status --}}
                                        <div class="flex items-start justify-between mb-3">
                                            <div class="flex-1 min-w-0">
                                                <template x-if="'{{ auth()->user()->role }}' === 'spv'">
                                                    <div>
                                                        <h4 class="font-semibold text-gray-900 dark:text-gray-100"
                                                            x-text="booking.sales_name"></h4>
                                                        <p class="text-xs text-gray-500 dark:text-gray-400"
                                                            x-text="booking.sales_phone"></p>
                                                    </div>
                                                </template>
                                                <template x-if="'{{ auth()->user()->role }}' !== 'spv'">
                                                    <div>
                                                        <h4 class="font-semibold text-gray-900 dark:text-gray-100">SPV
                                                        </h4>
                                                        <p class="text-sm text-gray-700 dark:text-gray-300"
                                                            x-text="booking.spv"></p>
                                                    </div>
                                                </template>
                                            </div>
                                            <span
                                                class="ml-2 px-2 py-1 text-xs font-semibold rounded-full whitespace-nowrap flex-shrink-0"
                                                :class="{
                                                    'bg-yellow-100 text-yellow-800': booking.status === 'Menunggu',
                                                    'bg-blue-100 text-blue-800': booking.status === 'Dikonfirmasi',
                                                    'bg-purple-100 text-purple-800': booking.status === 'Diproses',
                                                    'bg-indigo-100 text-indigo-800': booking
                                                        .status === 'Sedang test drive',
                                                    'bg-green-100 text-green-800': booking.status === 'Selesai',
                                                    'bg-red-100 text-red-800': booking.status === 'Perawatan',
                                                    'bg-black text-white': booking.status === 'Dibatalkan'
                                                }"
                                                x-text="booking.status">
                                            </span>
                                        </div>

                                        {{-- Details --}}
                                        <div class="space-y-1.5 text-xs text-gray-600 dark:text-gray-300 mb-3">
                                            <div class="flex items-start">
                                                <span class="font-medium w-24 flex-shrink-0">Mobil:</span>
                                                <span x-text="booking.car"></span>
                                            </div>
                                            <div class="flex items-start">
                                                <span class="font-medium w-24 flex-shrink-0">Tanggal:</span>
                                                <span x-text="booking.date"></span>
                                            </div>
                                            <div class="flex items-start">
                                                <span class="font-medium w-24 flex-shrink-0">Jam Test Drive:</span>
                                                <span class="font-semibold text-gray-900 dark:text-gray-100"
                                                    x-text="booking.test_drive_time || '-'"></span>
                                            </div>
                                        </div>

                                        {{-- Detail Customer Button --}}
                                        <button @click="openCustomerDetailFromBooking(booking)"
                                            class="w-full px-3 py-2 bg-gray-800 hover:bg-gray-900 text-white text-sm font-medium rounded-lg transition">
                                            Detail Customer
                                        </button>
                                    </div>
                            </div>
                            </template>
                        </div>

                        {{-- PAMERAN/MOVEX BOOKING TABLE - Desktop --}}
                        <div x-show="bookingViewType === 'pameran'" class="hidden lg:block overflow-x-auto">
                            <table class="w-full table-fixed">
                                <thead>
                                    <tr
                                        class="bg-gray-100 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-600">
                                        <th
                                            class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase w-32">
                                            PIC</th>
                                        <th x-show="'{{ auth()->user()->role }}' !== 'spv'"
                                            class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase w-32">
                                            SPV</th>
                                        <th
                                            class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase w-32">
                                            Mobil</th>
                                        <th
                                            class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase w-32">
                                            Tanggal Booking</th>
                                        <th
                                            class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase w-32">
                                            Tanggal Acara</th>
                                        <th
                                            class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase w-32">
                                            Tanggal Mulai</th>
                                        <th
                                            class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase w-32">
                                            Tanggal Selesai</th>
                                        <th
                                            class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase w-35">
                                            Target Prospect</th>
                                        <th
                                            class="px-4 py-3 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase w-35">
                                            Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                                    <template x-for="booking in paginatedBookingData" :key="booking.id">
                                        <tr class="h-20 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                            {{-- PIC --}}
                                            <td class="px-4 py-3">
                                                <div class="font-medium text-gray-900 dark:text-gray-100 text-sm"
                                                    x-text="booking.customer"></div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400"
                                                    x-text="booking.phone"></div>
                                            </td>

                                            {{-- SPV --}}
                                            <td x-show="'{{ auth()->user()->role }}' !== 'spv'" class="px-4 py-3">
                                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100"
                                                    x-text="booking.spv || '-'"></div>
                                            </td>

                                            {{-- Mobil --}}
                                            <td class="px-4 py-3">
                                                <div class="text-sm text-gray-900 dark:text-gray-100"
                                                    x-text="booking.car"></div>
                                            </td>

                                            {{-- Tanggal Booking --}}
                                            <td class="px-4 py-3">
                                                <div class="text-sm text-gray-900 dark:text-gray-100"
                                                    x-text="booking.date"></div>
                                            </td>

                                            {{-- Tanggal Acara --}}
                                            <td class="px-4 py-3">
                                                <div class="text-sm text-gray-900 dark:text-gray-100"
                                                    x-text="booking.event_date || '-'"></div>
                                            </td>

                                            {{-- Tanggal Mulai --}}
                                            <td class="px-4 py-3">
                                                <div class="text-sm text-gray-900 dark:text-gray-100"
                                                    x-text="booking.start_date || '-'"></div>
                                            </td>

                                            {{-- Tanggal Selesai --}}
                                            <td class="px-4 py-3">
                                                <div class="text-sm text-gray-900 dark:text-gray-100"
                                                    x-text="booking.end_date || '-'"></div>
                                            </td>

                                            {{-- Target Prospect --}}
                                            <td class="px-4 py-3">
                                                <div class="text-sm text-gray-900 dark:text-gray-100 truncate max-w-xs"
                                                    x-text="booking.address || '-'"></div>
                                            </td>

                                            {{-- Status --}}
                                            <td class="px-4 py-3 text-center">
                                                <span
                                                    class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full whitespace-nowrap"
                                                    :class="{
                                                        'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200': booking
                                                            .status === 'Menunggu',
                                                        'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200': booking
                                                            .status === 'Dikonfirmasi',
                                                        'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200': booking
                                                            .status === 'Diproses',
                                                        'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200': booking
                                                            .status === 'Sedang Pameran',
                                                        'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200': booking
                                                            .status === 'Selesai',
                                                        'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200': booking
                                                            .status === 'Perawatan',
                                                        'bg-black text-white dark:bg-white dark:text-black': booking.status==='Dibatalkan'
                                                    }"
                                                    x-text="booking.status">
                                                </span>
                                            </td>
                                        </tr>
                                    </template>
                                    {{-- Empty rows to maintain table height --}}
                                    <template x-for="i in (bookingItemsPerPage - paginatedBookingData.length)"
                                        :key="'empty-' + i">
                                        <tr class="h-20">
                                            <td class="px-4 py-3"
                                                :colspan="'{{ auth()->user()->role }}'
                                                === 'spv' ? 8 : 9">
                                                <div class="h-full">&nbsp;</div>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                            {{-- PAGINATION FOR PAMERAN/MOVEX --}}
                            <div x-show="filteredBookingData.length > 0"
                                class="bg-gray-50 dark:bg-gray-700 px-4 py-3 border-t border-gray-200 dark:border-gray-600 rounded-b-xl">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-gray-700 dark:text-gray-300">
                                            Showing
                                            <span class="font-medium" x-text="bookingStartIndex + 1"></span>
                                            to
                                            <span class="font-medium"
                                                x-text="Math.min(bookingEndIndex, filteredBookingData.length)"></span>
                                            of
                                            <span class="font-medium" x-text="filteredBookingData.length"></span>
                                            bookings
                                        </p>
                                    </div>

                                    <div>
                                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                                            <!-- Previous Button -->
                                            <button @click="prevBookingPage()" :disabled="bookingCurrentPage === 1"
                                                class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-sm font-medium text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-600 disabled:opacity-50 disabled:cursor-not-allowed">
                                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>

                                            <!-- Page Numbers -->
                                            <template x-for="page in bookingVisiblePages" :key="page">
                                                <button @click="goToBookingPage(page)"
                                                    :disabled="typeof page !== 'number'"
                                                    :class="bookingCurrentPage === page ?
                                                        'z-10 bg-blue-50 dark:bg-blue-900 border-blue-500 dark:border-blue-400 text-blue-600 dark:text-blue-200' :
                                                        'bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600 text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-600'"
                                                    class="relative inline-flex items-center px-4 py-2 border text-sm font-medium disabled:cursor-default">
                                                    <span x-text="page"></span>
                                                </button>
                                            </template>

                                            <!-- Next Button -->
                                            <button @click="nextBookingPage()"
                                                :disabled="bookingCurrentPage === bookingTotalPages"
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
                        </div>

                        {{-- PAMERAN/MOVEX BOOKING CARDS - Mobile & Tablet --}}
                        <div x-show="bookingViewType === 'pameran'" class="lg:hidden space-y-3">
                            <template x-for="booking in paginatedBookingData" :key="booking.id">
                                <div
                                    class="bg-white dark:bg-gray-800 p-4 rounded-lg border border-gray-200 dark:border-gray-600 hover:shadow-md transition">
                                    {{-- Header: PIC & Status --}}
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="flex-1 min-w-0">
                                            <h4 class="font-semibold text-gray-900 dark:text-gray-100"
                                                x-text="booking.customer"></h4>
                                            <p class="text-xs text-gray-500 dark:text-gray-400"
                                                x-text="booking.phone"></p>
                                        </div>
                                        <span
                                            class="ml-2 px-2 py-1 text-xs font-semibold rounded-full whitespace-nowrap flex-shrink-0"
                                            :class="{
                                                'bg-yellow-100 text-yellow-800': booking.status === 'Menunggu',
                                                'bg-blue-100 text-blue-800': booking.status === 'Dikonfirmasi',
                                                'bg-purple-100 text-purple-800': booking.status === 'Diproses',
                                                'bg-indigo-100 text-indigo-800': booking
                                                    .status === 'Sedang test drive',
                                                'bg-green-100 text-green-800': booking.status === 'Selesai',
                                                'bg-red-100 text-red-800': booking.status === 'Perawatan',
                                                'bg-black text-white': booking.status === 'Dibatalkan'
                                            }"
                                            x-text="booking.status">
                                        </span>
                                    </div>

                                    {{-- Details --}}
                                    <div class="space-y-1.5 text-xs text-gray-600 dark:text-gray-300 mb-3">
                                        <div x-show="'{{ auth()->user()->role }}' !== 'spv'"
                                            class="flex items-start">
                                            <span class="font-medium w-28 flex-shrink-0">SPV:</span>
                                            <span x-text="booking.spv || '-'"></span>
                                        </div>
                                        <div class="flex items-start">
                                            <span class="font-medium w-28 flex-shrink-0">Mobil:</span>
                                            <span x-text="booking.car"></span>
                                        </div>
                                        <div class="flex items-start">
                                            <span class="font-medium w-28 flex-shrink-0">Tgl Booking:</span>
                                            <span x-text="booking.date"></span>
                                        </div>
                                        <div class="flex items-start">
                                            <span class="font-medium w-28 flex-shrink-0">Tgl Acara:</span>
                                            <span x-text="booking.event_date || '-'"></span>
                                        </div>
                                        <div class="flex items-start">
                                            <span class="font-medium w-28 flex-shrink-0">Tgl Mulai:</span>
                                            <span class="font-semibold text-blue-600 dark:text-blue-400"
                                                x-text="booking.start_date || '-'"></span>
                                        </div>
                                        <div class="flex items-start">
                                            <span class="font-medium w-28 flex-shrink-0">Tgl Selesai:</span>
                                            <span class="font-semibold text-blue-600 dark:text-blue-400"
                                                x-text="booking.end_date || '-'"></span>
                                        </div>
                                        <div class="flex items-start">
                                            <span class="font-medium w-28 flex-shrink-0">Target:</span>
                                            <span class="line-clamp-2" x-text="booking.address || '-'"></span>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>

                        {{-- Pagination untuk Mobile & Tablet - Data Booking --}}
                        <div x-show="filteredBookingData.length > 0"
                            class="lg:hidden bg-white dark:bg-gray-800 p-4 rounded-lg border border-gray-200 dark:border-gray-600 mt-4">
                            <div class="flex flex-col space-y-3">
                                <div class="text-center">
                                    <p class="text-sm text-gray-700 dark:text-gray-300">
                                        Page <span class="font-medium" x-text="bookingCurrentPage"></span> of
                                        <span class="font-medium" x-text="bookingTotalPages"></span>
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        Showing <span x-text="bookingStartIndex + 1"></span>-<span
                                            x-text="Math.min(bookingEndIndex, filteredBookingData.length)"></span>
                                        of <span x-text="filteredBookingData.length"></span>
                                    </p>
                                </div>

                                <div class="flex gap-2">
                                    <button @click="prevBookingPage()" :disabled="bookingCurrentPage === 1"
                                        class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-lg text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed transition">
                                        ← Previous
                                    </button>
                                    <button @click="nextBookingPage()"
                                        :disabled="bookingCurrentPage === bookingTotalPages"
                                        class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-lg text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed transition">
                                        Next →
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Empty States --}}
                        <div x-show="filteredBookingData.length === 0 && bookingDataSearchQuery.length > 0"
                            class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <p class="text-gray-500 dark:text-gray-400 text-lg">Tidak ditemukan booking</p>
                            <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Coba kata kunci lain</p>
                        </div>

                        <div x-show="bookingsByType.length === 0" class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            <p class="text-gray-500 dark:text-gray-400 text-lg">Belum ada booking</p>
                            <p class="text-gray-400 dark:text-gray-500 text-sm mt-1"
                                x-text="'Booking ' + (bookingViewType === 'test_drive' ? 'test drive' : 'pameran/movex') + ' akan muncul di sini'">
                            </p>
                        </div>
                    </div>

                    {{-- UPDATED Management Detail Modal - Test Drive --}}
                    <div x-show="managementDetailModal && selectedManagementBooking?.booking_type === 'test_drive'"
                        x-cloak
                        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 p-4">
                        <div @click.away="managementDetailModal=false; selectedManagementBooking=null"
                            class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] overflow-hidden flex flex-col">

                            {{-- Simple Header --}}
                            <div
                                class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Detail Booking Test
                                    Drive</h3>
                                <button @click="managementDetailModal=false; selectedManagementBooking=null"
                                    class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>

                            {{-- Content --}}
                            <div x-show="selectedManagementBooking" class="overflow-y-auto flex-1 p-6">
                                <div class="space-y-6">
                                    {{-- Mobil --}}
                                    <div>
                                        <label
                                            class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Mobil</label>
                                        <div class="text-base font-semibold text-gray-900 dark:text-white"
                                            x-text="selectedManagementBooking?.car"></div>
                                    </div>

                                    {{-- Data Sales --}}
                                    <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                        <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Informasi
                                            Sales</h4>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div>
                                                <label
                                                    class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Nama
                                                    Sales</label>
                                                <div class="text-sm text-gray-900 dark:text-white"
                                                    x-text="selectedManagementBooking?.sales_name || '-'"></div>
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">No.
                                                    HP Sales</label>
                                                <div class="text-sm text-gray-900 dark:text-white"
                                                    x-text="selectedManagementBooking?.sales_phone || '-'"></div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Data Customer --}}
                                    <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                        <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Data
                                            Customer</h4>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div>
                                                <label
                                                    class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Nama
                                                    Lengkap</label>
                                                <div class="text-sm text-gray-900 dark:text-white"
                                                    x-text="selectedManagementBooking?.customer"></div>
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">No.
                                                    HP</label>
                                                <div class="text-sm text-gray-900 dark:text-white"
                                                    x-text="selectedManagementBooking?.phone"></div>
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Email</label>
                                                <div class="text-sm text-gray-900 dark:text-white truncate"
                                                    x-text="selectedManagementBooking?.email"></div>
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">No.
                                                    KTP</label>
                                                <div class="text-sm text-gray-900 dark:text-white font-mono"
                                                    x-text="selectedManagementBooking?.ktp"></div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Detail Test Drive --}}
                                    <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                        <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Detail
                                            Test Drive</h4>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div>
                                                <label
                                                    class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Tanggal
                                                    Booking</label>
                                                <div class="text-sm text-gray-900 dark:text-white"
                                                    x-text="selectedManagementBooking?.date"></div>
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Jam
                                                    Test Drive</label>
                                                <div class="text-sm text-gray-900 dark:text-white"
                                                    x-text="selectedManagementBooking?.test_drive_time || '-'"></div>
                                            </div>
                                            <div class="sm:col-span-2">
                                                <label
                                                    class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Lokasi
                                                    Test Drive</label>
                                                <div class="text-sm text-gray-900 dark:text-white"
                                                    x-text="selectedManagementBooking?.test_drive_location || '-'">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Simple Footer --}}
                            <div
                                class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                                <button @click="managementDetailModal=false; selectedManagementBooking=null"
                                    class="w-full px-4 py-2 bg-gray-800 hover:bg-gray-900 dark:bg-gray-700 dark:hover:bg-gray-600 text-white font-medium rounded-lg transition">
                                    Tutup
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- UPDATED Management Detail Modal - Pameran --}}
                    <div x-show="managementDetailModal && selectedManagementBooking?.booking_type === 'pameran'"
                        x-cloak
                        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 p-4">
                        <div @click.away="managementDetailModal=false; selectedManagementBooking=null"
                            class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] overflow-hidden flex flex-col">

                            {{-- Simple Header --}}
                            <div
                                class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Detail Booking
                                    Pameran/Movex</h3>
                                <button @click="managementDetailModal=false; selectedManagementBooking=null"
                                    class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>

                            {{-- Content --}}
                            <div x-show="selectedManagementBooking" class="overflow-y-auto flex-1 p-6">
                                <div class="space-y-6">
                                    {{-- Nama PIC --}}
                                    <div>
                                        <label
                                            class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Nama
                                            PIC</label>
                                        <div class="text-base font-semibold text-gray-900 dark:text-white"
                                            x-text="selectedManagementBooking?.customer"></div>
                                    </div>

                                    {{-- Mobil --}}
                                    <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                        <label
                                            class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Mobil</label>
                                        <div class="text-base font-semibold text-gray-900 dark:text-white"
                                            x-text="selectedManagementBooking?.car"></div>
                                    </div>

                                    {{-- Tanggal Acara --}}
                                    <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div>
                                                <label
                                                    class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Tanggal
                                                    Booking</label>
                                                <div class="text-sm text-gray-900 dark:text-white"
                                                    x-text="selectedManagementBooking?.date"></div>
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Tanggal
                                                    Acara</label>
                                                <div class="text-sm text-gray-900 dark:text-white"
                                                    x-text="selectedManagementBooking?.event_date || '-'"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <label
                                            class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Tanggal
                                            Mulai</label>
                                        <div class="text-sm text-gray-900 dark:text-white"
                                            x-text="selectedManagementBooking?.start_date || '-'"></div>
                                    </div>
                                    <div>
                                        <label
                                            class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Tanggal
                                            Selesai</label>
                                        <div class="text-sm text-gray-900 dark:text-white"
                                            x-text="selectedManagementBooking?.end_date || '-'"></div>
                                    </div>

                                    {{-- Target Prospect --}}
                                    <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                        <label
                                            class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Target
                                            Prospect</label>
                                        <div class="text-sm text-gray-900 dark:text-white"
                                            x-text="selectedManagementBooking?.address || '-'"></div>
                                    </div>

                                    {{-- Lokasi Acara --}}
                                    <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                        <label
                                            class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Lokasi
                                            Acara</label>
                                        <div class="text-sm text-gray-900 dark:text-white"
                                            x-text="selectedManagementBooking?.event_location || '-'"></div>
                                    </div>

                                    {{-- Status --}}
                                    <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                        <label
                                            class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Status
                                            Booking</label>
                                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full"
                                            :class="{
                                                'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200': selectedManagementBooking
                                                    ?.status === 'Menunggu',
                                                'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200': selectedManagementBooking
                                                    ?.status === 'Dikonfirmasi',
                                                'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200': selectedManagementBooking
                                                    ?.status === 'Diproses',
                                                'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200': selectedManagementBooking
                                                    ?.status === 'Sedang test drive' || selectedManagementBooking
                                                    ?.status === 'Sedang Pameran',
                                                'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200': selectedManagementBooking
                                                    ?.status === 'Selesai',
                                                'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200': selectedManagementBooking
                                                    ?.status === 'Perawatan',
                                                'bg-gray-800 text-white dark:bg-white dark:text-gray-800': selectedManagementBooking?.status==='Dibatalkan'
                                            }"
                                            x-text="selectedManagementBooking?.status">
                                        </span>
                                    </div>
                                </div>
                            </div>

                            {{-- Simple Footer --}}
                            <div
                                class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                                <button @click="managementDetailModal=false; selectedManagementBooking=null"
                                    class="w-full px-4 py-2 bg-gray-800 hover:bg-gray-900 dark:bg-gray-700 dark:hover:bg-gray-600 text-white font-medium rounded-lg transition">
                                    Tutup
                                </button>
                            </div>
                        </div>
                    </div>
                    {{-- Status Modal - FIXED WITH CORRECT DROPDOWN OPTIONS --}}
                    <div x-show="statusModal" x-cloak
                        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 p-4">
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-md">
                            <div class="p-6 border-b border-gray-200 dark:border-gray-600">
                                <div class="flex justify-between items-center">
                                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Update Status
                                        Booking</h3>
                                    <button @click="statusModal=false"
                                        class="text-gray-500 hover:text-red-500 text-xl font-bold">X</button>
                                </div>
                            </div>

                            <div class="p-6 space-y-4">
                                <div x-show="selectedBooking">
                                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg mb-4">
                                        <h4 class="font-medium text-gray-800 dark:text-gray-100 mb-2">Detail Booking
                                        </h4>
                                        <div class="text-sm text-gray-600 dark:text-gray-300 space-y-1">
                                            <p><span class="font-medium">Customer:</span> <span
                                                    x-text="selectedBooking?.customer"></span></p>
                                            <p><span class="font-medium">Mobil:</span> <span
                                                    x-text="selectedBooking?.car"></span></p>
                                            <p><span class="font-medium">Tanggal:</span> <span
                                                    x-text="selectedBooking?.date"></span></p>
                                            <p><span class="font-medium">Status Saat Ini:</span>
                                                <span class="font-bold"
                                                    :class="{
                                                        'text-yellow-600': selectedBooking?.status === 'Menunggu',
                                                        'text-blue-600': selectedBooking?.status === 'Dikonfirmasi',
                                                        'text-purple-600': selectedBooking?.status === 'Diproses',
                                                        'text-red-600': selectedBooking?.status === 'Dibatalkan'
                                                    }"
                                                    x-text="selectedBooking?.status"></span>
                                            </p>
                                        </div>
                                    </div>

                                    <div>
                                        <label
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status
                                            Booking</label>

                                        {{-- Conditional dropdown based on role --}}
                                        <select x-model="newStatus"
                                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">

                                            {{-- Admin: All statuses --}}
                                            <template x-if="'{{ auth()->user()->role }}' === 'admin'">
                                                <optgroup label="Pilih Status">
                                                    <option value="Menunggu">Menunggu</option>
                                                    <option value="Diproses">Diproses</option>
                                                    <option value="Dikonfirmasi">Dikonfirmasi</option>
                                                    <template x-if="selectedBooking?.booking_type === 'test_drive'">
                                                        <option value="Sedang test drive">Sedang test drive</option>
                                                    </template>
                                                    <template x-if="selectedBooking?.booking_type === 'pameran'">
                                                        <option value="Sedang Pameran">Sedang Pameran</option>
                                                    </template>
                                                    <option value="Selesai">Selesai</option>
                                                    <option value="Perawatan">Perawatan</option>
                                                    <option value="Dibatalkan">Dibatalkan</option>
                                                </optgroup>
                                            </template>

                                            {{-- SPV: Limited statuses (APPROVE/CANCEL ONLY) --}}
                                            <template x-if="'{{ auth()->user()->role }}' === 'spv'">
                                                <optgroup label="Pilih Aksi">
                                                    <option value="Diproses">Approve (Diproses)</option>
                                                    <option value="Dibatalkan">Cancel (Dibatalkan)</option>
                                                </optgroup>
                                            </template>

                                            {{-- Branch Manager: Approve or Cancel --}}
                                            <template x-if="'{{ auth()->user()->role }}' === 'branch_manager'">
                                                <optgroup label="Pilih Aksi">
                                                    <option value="Dikonfirmasi">Approve (Dikonfirmasi)</option>
                                                    <option value="Dibatalkan">Disapprove/Cancel (Dibatalkan)
                                                    </option>
                                                </optgroup>
                                            </template>
                                        </select>

                                        {{-- Status info --}}
                                        <div class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                            <template x-if="'{{ auth()->user()->role }}' === 'branch_manager'">
                                                <div>
                                                    <p>Branch Manager dapat:</p>
                                                    <ul class="list-disc list-inside ml-2 mt-1">
                                                        <li>Approve booking "Diproses" -> "Dikonfirmasi"</li>
                                                        <li>Cancel booking "Diproses" atau "Dikonfirmasi" ->
                                                            "Dibatalkan"
                                                        </li>
                                                    </ul>
                                                </div>
                                            </template>

                                            <template x-if="'{{ auth()->user()->role }}' === 'spv'">
                                                <div>
                                                    <p>SPV dapat:</p>
                                                    <ul class="list-disc list-inside ml-2 mt-1">
                                                        <li>Approve booking "Menunggu" -> "Diproses"</li>
                                                        <li>Cancel booking "Menunggu" -> "Dibatalkan"</li>
                                                    </ul>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex space-x-3 pt-4">
                                    <button @click="updateBookingStatus"
                                        class="flex-1 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">
                                        Update Status
                                    </button>
                                    <button @click="statusModal=false"
                                        class="flex-1 px-4 py-2 bg-gray-300 hover:bg-gray-400 dark:bg-gray-600 dark:hover:bg-gray-500 text-gray-700 dark:text-gray-200 font-medium rounded-lg transition">
                                        Batal
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Customer Detail Modal --}}
                    <div x-show="customerDetailModal" x-cloak
                        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 p-4">
                        <div @click.away="customerDetailModal=false"
                            class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] overflow-hidden flex flex-col">

                            {{-- Header --}}
                            <div
                                class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Detail Customer</h3>
                                <button @click="customerDetailModal=false"
                                    class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>

                            {{-- Content --}}
                            <div x-show="selectedCustomerDetail" class="overflow-y-auto flex-1 p-6 space-y-6">
                                {{-- Informasi Pribadi --}}
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-3">Informasi
                                        Pribadi</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Nama
                                                Lengkap</label>
                                            <p class="text-sm text-gray-900 dark:text-white font-medium"
                                                x-text="selectedCustomerDetail?.name"></p>
                                        </div>
                                        <div>
                                            <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">No.
                                                HP</label>
                                            <p class="text-sm text-gray-900 dark:text-white font-medium"
                                                x-text="selectedCustomerDetail?.phone"></p>
                                        </div>
                                        <div>
                                            <label
                                                class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Email</label>
                                            <p class="text-sm text-gray-900 dark:text-white font-medium truncate"
                                                x-text="selectedCustomerDetail?.email"></p>
                                        </div>
                                        <div>
                                            <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">No.
                                                KTP</label>
                                            <p class="text-sm text-gray-900 dark:text-white font-medium font-mono"
                                                x-text="selectedCustomerDetail?.ktp"></p>
                                        </div>
                                        <div class="md:col-span-2">
                                            <label
                                                class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Alamat</label>
                                            <p class="text-sm text-gray-900 dark:text-white"
                                                x-text="selectedCustomerDetail?.address"></p>
                                        </div>
                                    </div>
                                </div>

                                {{-- Riwayat Booking --}}
                                <div>
                                    <div class="flex items-center justify-between mb-3">
                                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Riwayat
                                            Booking</h4>
                                        <span class="px-2 py-1 bg-green-600 text-white text-xs font-bold rounded"
                                            x-text="selectedCustomerDetail?.totalBookings + ' booking'"></span>
                                    </div>
                                    <div class="space-y-2 max-h-64 overflow-y-auto">
                                        <template x-for="booking in selectedCustomerDetail?.bookingHistory || []"
                                            :key="booking.date + booking.car">
                                            <div
                                                class="bg-gray-100 dark:bg-gray-700 p-3 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-650 transition">
                                                <div class="flex items-start justify-between gap-3">
                                                    <div class="flex-1 min-w-0">
                                                        <p class="text-sm text-gray-900 dark:text-white font-medium mb-1"
                                                            x-text="booking.date"></p>
                                                        <p class="text-xs text-gray-600 dark:text-gray-400 truncate"
                                                            x-text="booking.car"></p>
                                                    </div>
                                                    <span
                                                        class="px-2 py-1 rounded text-xs font-semibold whitespace-nowrap flex-shrink-0"
                                                        :class="{
                                                            'bg-yellow-100 text-yellow-800 dark:bg-yellow-500/20 dark:text-yellow-300': booking.status==='Menunggu',
                                                            'bg-blue-100 text-blue-800 dark:bg-blue-500/20 dark:text-blue-300': booking.status==='Dikonfirmasi',
                                                            'bg-purple-100 text-purple-800 dark:bg-purple-500/20 dark:text-purple-300': booking.status==='Diproses',
                                                            'bg-indigo-100 text-indigo-800 dark:bg-indigo-500/20 dark:text-indigo-300': booking.status==='Sedang test drive',
                                                            'bg-green-100 text-green-800 dark:bg-green-500/20 dark:text-green-300': booking.status==='Selesai',
                                                            'bg-red-100 text-red-800 dark:bg-red-500/20 dark:text-red-300': booking.status==='Perawatan',
                                                            'bg-gray-200 text-gray-800 dark:bg-gray-600 dark:text-gray-300': booking.status==='Dibatalkan'
                                                        }"
                                                        x-text="booking.status">
                                                    </span>
                                                </div>
                                            </div>
                                        </template>
                                        <div x-show="!selectedCustomerDetail?.bookingHistory?.length"
                                            class="text-center py-8 text-gray-500 dark:text-gray-500">
                                            <svg class="w-12 h-12 mx-auto mb-2 text-gray-400 dark:text-gray-600"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                            <p class="text-sm">Belum ada riwayat booking</p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label
                                                class="block text-xs text-gray-500 dark:text-gray-400 mb-1">SPV</label>
                                            <p class="text-sm text-gray-900 dark:text-white font-medium"
                                                x-text="selectedCustomerDetail?.assignedSPV"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Footer --}}
                            <div
                                class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                                <div class="flex gap-3">
                                    <button @click="openEditCustomer(selectedCustomerDetail?.name)"
                                        class="flex-1 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition">
                                        Edit Customer
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Edit Customer Modal --}}
                    <div x-show="editCustomerModal" x-cloak
                        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 p-4">
                        <div @click.away="editCustomerModal=false; editingCustomer=null"
                            class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] overflow-hidden flex flex-col">

                            {{-- Simple Header (sama dengan Detail Booking) --}}
                            <div
                                class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Edit Customer</h3>
                                <button @click="editCustomerModal=false; editingCustomer=null"
                                    class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>

                            {{-- Content --}}
                            <div x-show="editingCustomer" class="overflow-y-auto flex-1 p-6">
                                <div class="space-y-6">
                                    {{-- Informasi Pribadi --}}
                                    <div>
                                        <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Informasi
                                            Pribadi</h4>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label
                                                    class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Nama
                                                    Lengkap</label>
                                                <input x-model="editingCustomer.name" type="text"
                                                    class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 text-sm">
                                            </div>

                                            <div>
                                                <label
                                                    class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">No.
                                                    KTP</label>
                                                <input x-model="editingCustomer.ktp" type="text" maxlength="16"
                                                    class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 text-sm">
                                            </div>

                                            <div>
                                                <label
                                                    class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">No.
                                                    HP</label>
                                                <input x-model="editingCustomer.phone" type="tel"
                                                    class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 text-sm">
                                            </div>

                                            <div>
                                                <label
                                                    class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Email</label>
                                                <input x-model="editingCustomer.email" type="email"
                                                    class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 text-sm">
                                            </div>

                                            <div class="md:col-span-2">
                                                <label
                                                    class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Alamat</label>
                                                <textarea x-model="editingCustomer.address" rows="3"
                                                    class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 text-sm resize-none"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- SPV Assignment - ONLY visible for Admin --}}
                                    <div x-show="isAdmin()"
                                        class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div>
                                                <label
                                                    class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">
                                                    <span class="flex items-center gap-2">
                                                        SPV
                                                    </span>
                                                </label>
                                                <select x-model="editingCustomer.assignedSPV"
                                                    class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 text-sm">
                                                    <template x-for="spv in staffData.supervisors"
                                                        :key="spv.name">
                                                        <option :value="spv.name" x-text="spv.name"></option>
                                                    </template>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Simple Footer (sama dengan Detail Booking) --}}
                                <div
                                    class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                                    <div class="flex gap-3">
                                        <button @click="updateCustomer()"
                                            class="flex-1 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition text-sm">
                                            Simpan Perubahan
                                        </button>
                                        <button @click="editCustomerModal=false; editingCustomer=null"
                                            class="px-6 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 font-medium rounded-lg transition text-sm">
                                            Batal
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Checksheet Summary Modal --}}
                    <div x-show="checksheetSummaryModal" x-cloak
                        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 p-4">
                        <div @click.away="checksheetSummaryModal=false; selectedChecksheetSummary=null"
                            class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-hidden flex flex-col">
                            {{-- Header --}}
                            <div
                                class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-800 dark:to-gray-800">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Summary Checksheet
                                    </h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Ringkasan kondisi
                                        kendaraan
                                        test drive</p>
                                </div>
                                <button @click="checksheetSummaryModal=false; selectedChecksheetSummary=null"
                                    class="p-2 hover:bg-white dark:hover:bg-gray-700 rounded-lg transition">
                                    <svg class="w-5 h-5 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>

                            {{-- Content --}}
                            <div class="overflow-y-auto flex-1 p-6">
                                <div x-show="!selectedChecksheetSummary || selectedChecksheetSummary.length === 0"
                                    class="text-center py-12">
                                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-300 dark:text-gray-600"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    <p class="text-gray-500 dark:text-gray-400 text-lg font-medium">Belum ada
                                        checksheet
                                    </p>
                                    <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Customer ini belum
                                        melakukan
                                        test drive</p>
                                </div>

                                <div x-show="selectedChecksheetSummary && selectedChecksheetSummary.length > 0"
                                    class="space-y-4">
                                    <template x-for="(summary, index) in selectedChecksheetSummary"
                                        :key="summary.checksheet_id">
                                        <div class="border rounded-xl overflow-hidden"
                                            :class="summary.status === 'good' ?
                                                'border-green-300 dark:border-green-700 bg-green-50 dark:bg-green-900/20' :
                                                'border-red-300 dark:border-red-700 bg-red-50 dark:bg-red-900/20'">
                                            {{-- Header Card --}}
                                            <div class="px-5 py-3 border-b"
                                                :class="summary.status === 'good' ?
                                                    'bg-green-100 dark:bg-green-900/30 border-green-200 dark:border-green-800' :
                                                    'bg-red-100 dark:bg-red-900/30 border-red-200 dark:border-red-800'">
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center gap-3">
                                                        <div class="flex items-center justify-center w-10 h-10 rounded-full"
                                                            :class="summary.status === 'good' ? 'bg-green-600' :
                                                                'bg-red-600'">
                                                            <svg x-show="summary.status === 'good'"
                                                                class="w-6 h-6 text-white" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                            </svg>
                                                            <svg x-show="summary.status === 'warning'"
                                                                class="w-6 h-6 text-white" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                                                </path>
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <h4 class="font-bold text-gray-900 dark:text-white"
                                                                x-text="summary.car"></h4>
                                                            <p class="text-xs text-gray-600 dark:text-gray-300">
                                                                <span x-text="summary.no_polisi"></span> ||
                                                                <span x-text="summary.test_drive_date"></span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <span class="px-3 py-1 rounded-full text-xs font-bold"
                                                        :class="summary.status === 'good' ? 'bg-green-600 text-white' :
                                                            'bg-red-600 text-white'"
                                                        x-text="summary.status_label">
                                                    </span>
                                                </div>
                                            </div>

                                            {{-- Body Card --}}
                                            <div class="p-5 space-y-4">
                                                {{-- Waktu --}}
                                                <div class="flex items-center gap-4 text-sm">
                                                    <div class="flex items-center gap-2">
                                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                                            fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        <span class="text-gray-600 dark:text-gray-300">
                                                            Pinjam: <strong x-text="summary.jam_pinjam"></strong>
                                                        </span>
                                                    </div>
                                                    <div class="flex items-center gap-2">
                                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                                            fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        <span class="text-gray-600 dark:text-gray-300">
                                                            Kembali: <strong x-text="summary.jam_kembali"></strong>
                                                        </span>
                                                    </div>
                                                </div>

                                                {{-- BAHAN BAKAR --}}
                                                <div x-show="summary.fuel_changed"
                                                    class="bg-blue-50 dark:bg-blue-900/20 border-2 border-blue-300 dark:border-blue-700 rounded-lg p-3">
                                                    <h5
                                                        class="text-xs font-bold text-blue-700 dark:text-blue-300 mb-2 flex items-center gap-2">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                        </svg>
                                                        PERUBAHAN BAHAN BAKAR:
                                                    </h5>
                                                    <div class="flex items-center gap-4 text-sm">
                                                        <span class="text-gray-700 dark:text-gray-200">
                                                            Saat Pinjam: <strong
                                                                class="text-blue-600 dark:text-blue-400"
                                                                x-text="summary.fuel_pinjam"></strong>
                                                        </span>
                                                        <span class="text-gray-500">-></span>
                                                        <span class="text-gray-700 dark:text-gray-200">
                                                            Saat Kembali: <strong
                                                                class="text-blue-600 dark:text-blue-400"
                                                                x-text="summary.fuel_kembali"></strong>
                                                        </span>
                                                    </div>
                                                </div>

                                                {{-- DOKUMEN & KUNCI --}}
                                                <div x-show="summary.dokumen_issues && summary.dokumen_issues.length > 0"
                                                    class="bg-purple-50 dark:bg-purple-900/20 border-2 border-purple-300 dark:border-purple-700 rounded-lg p-3">
                                                    <h5
                                                        class="text-xs font-bold text-purple-700 dark:text-purple-300 mb-2 flex items-center gap-2">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                        </svg>
                                                        PERUBAHAN DOKUMEN & KUNCI:
                                                    </h5>
                                                    <div class="flex flex-wrap gap-2">
                                                        <template x-for="issue in summary.dokumen_issues"
                                                            :key="issue">
                                                            <span
                                                                class="px-3 py-1.5 bg-purple-600 text-white text-xs font-bold rounded-lg shadow-md"
                                                                x-text="issue"></span>
                                                        </template>
                                                    </div>
                                                </div>

                                                {{-- KELENGKAPAN TAMBAHAN --}}
                                                <div x-show="summary.kelengkapan_issues && summary.kelengkapan_issues.length > 0"
                                                    class="bg-indigo-50 dark:bg-indigo-900/20 border-2 border-indigo-300 dark:border-indigo-700 rounded-lg p-3">
                                                    <h5
                                                        class="text-xs font-bold text-indigo-700 dark:text-indigo-300 mb-2 flex items-center gap-2">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                                        </svg>
                                                        PERUBAHAN KELENGKAPAN TAMBAHAN:
                                                    </h5>
                                                    <div class="flex flex-wrap gap-2">
                                                        <template x-for="issue in summary.kelengkapan_issues"
                                                            :key="issue">
                                                            <span
                                                                class="px-3 py-1.5 bg-indigo-600 text-white text-xs font-bold rounded-lg shadow-md"
                                                                x-text="issue"></span>
                                                        </template>
                                                    </div>
                                                </div>

                                                {{-- Issues saat dipinjam --}}
                                                <div
                                                    x-show="summary.pinjam_issues && summary.pinjam_issues.length > 0">
                                                    <h5
                                                        class="text-xs font-semibold text-gray-700 dark:text-gray-300 mb-2 flex items-center gap-2">
                                                        <svg class="w-4 h-4 text-yellow-600" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                                            </path>
                                                        </svg>
                                                        Kondisi Tidak Baik Saat Dipinjam:
                                                    </h5>
                                                    <div class="flex flex-wrap gap-2">
                                                        <template x-for="issue in summary.pinjam_issues"
                                                            :key="issue">
                                                            <span
                                                                class="px-2 py-1 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300 text-xs rounded-lg"
                                                                x-text="issue"></span>
                                                        </template>
                                                    </div>
                                                </div>

                                                {{-- Issues saat dikembalikan --}}
                                                <div
                                                    x-show="summary.kembali_issues && summary.kembali_issues.length > 0">
                                                    <h5
                                                        class="text-xs font-semibold text-gray-700 dark:text-gray-300 mb-2 flex items-center gap-2">
                                                        <svg class="w-4 h-4 text-orange-600" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                                            </path>
                                                        </svg>
                                                        Kondisi Tidak Baik Saat Dikembalikan:
                                                    </h5>
                                                    <div class="flex flex-wrap gap-2">
                                                        <template x-for="issue in summary.kembali_issues"
                                                            :key="issue">
                                                            <span
                                                                class="px-2 py-1 bg-orange-100 dark:bg-orange-900/30 text-orange-800 dark:text-orange-300 text-xs rounded-lg"
                                                                x-text="issue"></span>
                                                        </template>
                                                    </div>
                                                </div>

                                                {{-- Perubahan Kondisi --}}
                                                <div x-show="summary.changed_conditions && summary.changed_conditions.length > 0"
                                                    class="bg-white dark:bg-gray-900/50 border-2 border-red-300 dark:border-red-700 rounded-lg p-3">
                                                    <h5
                                                        class="text-xs font-bold text-red-700 dark:text-red-300 mb-2 flex items-center gap-2">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                                            </path>
                                                        </svg>
                                                        PERUBAHAN KONDISI KENDARAAN (Baik -> Tidak Baik):
                                                    </h5>
                                                    <div class="flex flex-wrap gap-2">
                                                        <template x-for="changed in summary.changed_conditions"
                                                            :key="changed">
                                                            <span
                                                                class="px-3 py-1.5 bg-red-600 text-white text-xs font-bold rounded-lg shadow-md"
                                                                x-text="changed"></span>
                                                        </template>
                                                    </div>
                                                </div>

                                                {{-- TANGGAL PENGGANTIAN PEWANGI --}}
                                                <div x-show="summary.tanggal_penggantian_pewangi"
                                                    class="bg-pink-50 dark:bg-pink-900/20 border border-pink-200 dark:border-pink-800 rounded-lg p-3">
                                                    <h5
                                                        class="text-xs font-semibold text-pink-700 dark:text-pink-300 mb-1 flex items-center gap-2">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                        Tanggal Penggantian Pewangi:
                                                    </h5>
                                                    <span class="text-sm font-bold text-pink-800 dark:text-pink-200"
                                                        x-text="summary.tanggal_penggantian_pewangi"></span>
                                                </div>

                                                {{-- Kondisi Sempurna --}}
                                                <div x-show="summary.status === 'good'"
                                                    class="bg-white dark:bg-gray-900/50 border-2 border-green-300 dark:border-green-700 rounded-lg p-3">
                                                    <div class="flex items-center gap-3">
                                                        <svg class="w-8 h-8 text-green-600" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                            </path>
                                                        </svg>
                                                        <div>
                                                            <p
                                                                class="text-sm font-bold text-green-700 dark:text-green-300">
                                                                Kendaraan dalam Kondisi Baik</p>
                                                            <p class="text-xs text-green-600 dark:text-green-400">
                                                                Tidak
                                                                ada kerusakan atau perubahan kondisi</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            {{-- Footer --}}
                            <div
                                class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                                <button @click="checksheetSummaryModal=false; selectedChecksheetSummary=null"
                                    class="w-full px-4 py-2.5 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-xl transition">
                                    Tutup
                                </button>
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
                            Alpine.data('bookingDashboard', () => ({
                                darkMode: false,
                                sidebarOpen: true,
                                searchQuery: '',
                                customerSearchQuery: '',
                                bookingDataSearchQuery: '', // NEW: untuk search di Data Booking
                                bookingViewType: 'test_drive', // Toggle antara test_drive dan pameran di Data Booking
                                managementViewType: 'test_drive', // Toggle antara test_drive dan pameran di Management Booking
                                managementSearchQuery: '', // NEW: search untuk Management Booking
                                managementDetailModal: false, // NEW: modal detail management booking   
                                selectedManagementBooking: null, // NEW: booking yang dipilih di management
                                managementSPVFilter: '',
                                managementSPVSort: '',
                                // Pagination untuk Data Booking
                                bookingCurrentPage: 1,
                                bookingItemsPerPage: 10,
                                managementCurrentPage: 1,
                                managementItemsPerPage: 10,
                                // Status filter & sort for Management Booking
                                managementStatusFilter: '',
                                managementStatusSort: '',
                                // Status order mapping
                                statusOrder: {
                                    'Menunggu': 1,
                                    'Diproses': 2,
                                    'Dikonfirmasi': 3,
                                    'Sedang test drive': 4,
                                    'Sedang Pameran': 4,
                                    'Selesai': 5,
                                    'Perawatan': 6,
                                    'Dibatalkan': 7
                                },
                                // Filter by status
                                filterManagementByStatus(status) {
                                    this.managementStatusFilter = status;
                                    this.managementCurrentPage = 1;
                                },

                                // Sort status
                                sortManagementStatus(direction) {
                                    this.managementStatusSort = direction;
                                    this.managementCurrentPage = 1;
                                },

                                // Clear filter
                                clearManagementStatusFilter() {
                                    this.managementStatusFilter = '';
                                    this.managementStatusSort = '';
                                    this.managementCurrentPage = 1;
                                },

                                // Sort by SPV Name
                                sortManagementBySPV(direction) {
                                    this.managementSPVSort = direction;
                                    this.managementCurrentPage = 1; // Reset to first page
                                },

                                // Clear SPV Sort
                                clearManagementSPVSort() {
                                    this.managementSPVSort = '';
                                    this.managementCurrentPage = 1;
                                },

                                // Computed - Get unique SPV list from bookings
                                get uniqueSPVList() {
                                    const spvSet = new Set();

                                    this.managementBookingsByType.forEach(booking => {
                                        if (booking.spv && booking.spv !== '-') {
                                            spvSet.add(booking.spv);
                                        }
                                    });

                                    // Convert to array and sort alphabetically
                                    return Array.from(spvSet).sort((a, b) => a.localeCompare(b));
                                },

                                // Sort by SPV Name
                                sortManagementBySPV(direction) {
                                    this.managementSPVSort = direction;
                                    this.managementSPVFilter = ''; // Clear specific filter when sorting
                                    this.managementCurrentPage = 1;
                                },

                                // Filter by Specific SPV
                                filterManagementBySPV(spvName) {
                                    this.managementSPVFilter = spvName;
                                    this.managementSPVSort = ''; // Clear sort when filtering by specific SPV
                                    this.managementCurrentPage = 1;
                                },

                                // Clear SPV Filter
                                clearManagementSPVFilter() {
                                    this.managementSPVSort = '';
                                    this.managementSPVFilter = '';
                                    this.managementCurrentPage = 1;
                                },


                                filters: {
                                    car: '',
                                    status: '',
                                    dateFrom: '',
                                    dateTo: ''
                                },

                                sorting: {
                                    customer: '',
                                    car: '',
                                    date: ''
                                },

                                newBooking: {
                                    customer: '',
                                    phone: '',
                                    email: '',
                                    ktp: '',
                                    address: '',
                                    car: '',
                                    spv: '',
                                    security: '',
                                    bookingDate: '',
                                    bookingType: 'test_drive',
                                    salesName: '',
                                    salesPhone: '',
                                    testDriveTime: '',
                                    testDriveLocation: '',
                                    targetProspect: '',
                                    eventDate: '',
                                    eventLocation: ''
                                },

                                customerDetailModal: false,
                                selectedCustomerDetail: null,
                                bookingCustomerDetailModal: false, // Modal untuk customer dari booking
                                selectedBookingCustomer: null, // Data customer yang dipilih dari booking
                                editCustomerModal: false,
                                editingCustomer: {
                                    name: '',
                                    phone: '',
                                    email: '',
                                    ktp: '',
                                    address: '',
                                    assignedSPV: '',
                                },
                                checksheetSummaryModal: false,
                                selectedChecksheetSummary: null,
                                statusModal: false,
                                selectedBooking: null,
                                selectedBookingIndex: null,
                                newStatus: '',

                                bookings: [],

                                carList: [{
                                        name: 'Toyota Hilux Rangga'
                                    },
                                    {
                                        name: 'Toyota Raize Abu Abu'
                                    },
                                    {
                                        name: 'Toyota Zenix'
                                    },
                                    {
                                        name: 'Toyota Agya Putih'
                                    },
                                    {
                                        name: 'Toyota Fortuner'
                                    },
                                    {
                                        name: 'Toyota Agya GR Merah'
                                    },
                                ],

                                customerData: {},

                                staffData: {
                                    supervisors: [],
                                    securities: []
                                },

                                async init() {
                                    // Apply theme IMMEDIATELY before any async operations
                                    const savedTheme = localStorage.getItem('darkMode');
                                    if (savedTheme !== null) {
                                        this.darkMode = savedTheme === 'true';
                                    } else {
                                        this.darkMode = window.matchMedia && window.matchMedia(
                                            '(prefers-color-scheme: dark)').matches;
                                    }

                                    // Apply theme synchronously before any await
                                    this.applyTheme();

                                    await this.$nextTick();

                                    // Watch management search
                                    this.$watch('managementSearchQuery', () => {
                                        this.managementCurrentPage = 1;
                                    });

                                    // Watch management view type
                                    this.$watch('managementViewType', () => {
                                        this.managementCurrentPage = 1;
                                    });

                                    // Watch booking data search
                                    this.$watch('bookingDataSearchQuery', () => {
                                        this.bookingCurrentPage = 1;
                                    });

                                    // Watch booking view type
                                    this.$watch('bookingViewType', () => {
                                        this.bookingCurrentPage = 1;
                                    });

                                    const today = new Date().toISOString().split('T')[0];
                                    this.newBooking.bookingDate = today;

                                    await this.loadBookings();
                                    await this.loadStaffData();
                                    await this.loadCustomerData();
                                },

                                async loadBookings() {
                                    try {
                                        const response = await fetch('/api/bookings', {
                                            headers: {
                                                'Accept': 'application/json',
                                                'X-CSRF-TOKEN': document.querySelector(
                                                    'meta[name="csrf-token"]').content
                                            }
                                        });

                                        if (response.ok) {
                                            const data = await response.json();
                                            this.bookings = data.data || [];
                                        }
                                    } catch (error) {
                                        console.error('Error loading bookings:', error);
                                    }
                                },

                                async loadStaffData() {
                                    try {
                                        const response = await fetch('/api/bookings/staff', {
                                            headers: {
                                                'Accept': 'application/json',
                                                'X-CSRF-TOKEN': document.querySelector(
                                                    'meta[name="csrf-token"]').content
                                            }
                                        });

                                        if (response.ok) {
                                            const data = await response.json();
                                            this.staffData = data.data;
                                        }
                                    } catch (error) {
                                        console.error('Error loading staff data:', error);
                                    }
                                },

                                async loadCustomerData() {
                                    try {
                                        // Single API call - checksheet summary sudah included
                                        const response = await fetch('/api/bookings/customers', {
                                            headers: {
                                                'Accept': 'application/json',
                                                'X-CSRF-TOKEN': document.querySelector(
                                                    'meta[name="csrf-token"]').content
                                            }
                                        });

                                        if (response.ok) {
                                            const data = await response.json();

                                            // Langsung assign, data sudah lengkap dari backend
                                            this.customerData = {};
                                            data.data.forEach(customer => {
                                                this.customerData[customer.name] = customer;
                                            });
                                        }
                                    } catch (error) {
                                        console.error('Error loading customer data:', error);
                                    }
                                },

                                async addBooking() {
                                    if (!this.newBooking.customer.trim()) {
                                        alert('Nama lengkap harus diisi!');
                                        return;
                                    }
                                    if (!this.newBooking.phone.trim()) {
                                        alert('No. telepon harus diisi!');
                                        return;
                                    }
                                    if (!this.newBooking.email.trim()) {
                                        alert('Email harus diisi!');
                                        return;
                                    }
                                    if (!this.newBooking.ktp.trim()) {
                                        alert('No. KTP harus diisi!');
                                        return;
                                    }
                                    if (!this.newBooking.address.trim()) {
                                        alert('Alamat harus diisi!');
                                        return;
                                    }
                                    if (!this.newBooking.car) {
                                        alert('Pilih mobil terlebih dahulu!');
                                        return;
                                    }
                                    if (!this.newBooking.spv) {
                                        alert('Pilih SPV terlebih dahulu!');
                                        return;
                                    }
                                    if (!this.newBooking.security) {
                                        alert('Pilih Security terlebih dahulu!');
                                        return;
                                    }
                                    if (!this.newBooking.bookingDate.trim()) {
                                        alert('Tanggal booking harus diisi!');
                                        return;
                                    }

                                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                                    if (!emailRegex.test(this.newBooking.email)) {
                                        alert('Format email tidak valid!');
                                        return;
                                    }

                                    const phoneRegex = /^[0-9]{10,13}$/;
                                    if (!phoneRegex.test(this.newBooking.phone.replace(/\D/g, ''))) {
                                        alert('No. telepon harus berupa angka 10-13 digit!');
                                        return;
                                    }

                                    if (this.newBooking.ktp.length !== 16) {
                                        alert('No. KTP harus 16 digit!');
                                        return;
                                    }

                                    try {
                                        let bookingData = {
                                            booking_type: this.newBooking.bookingType,
                                            nama_lengkap: this.newBooking.customer.trim(),
                                            nomor_telepon: this.newBooking.phone.trim(),
                                            email: this.newBooking.email.trim(),
                                            mobil_test_drive: this.newBooking.car,
                                            tanggal_booking: this.newBooking.bookingDate,
                                            supervisor_id: this.staffData.supervisors.find(s => s.name === this
                                                .newBooking.spv)?.id,
                                            security_id: this.staffData.securities.find(s => s.name === this
                                                .newBooking.security)?.id
                                        };

                                        if (this.newBooking.bookingType === 'test_drive') {
                                            bookingData.no_ktp = this.newBooking.ktp.trim();
                                            bookingData.alamat = this.newBooking.testDriveLocation.trim();
                                            bookingData.sales_name = this.newBooking.salesName.trim();
                                            bookingData.sales_phone = this.newBooking.salesPhone.trim();
                                            bookingData.test_drive_time = this.newBooking.testDriveTime;
                                            bookingData.test_drive_location = this.newBooking.testDriveLocation
                                                .trim();
                                        } else {
                                            bookingData.no_ktp = '0000000000000000';
                                            bookingData.alamat = this.newBooking.targetProspect.trim();
                                            bookingData.event_date = this.newBooking.eventDate;
                                            bookingData.event_location = this.newBooking.eventLocation.trim();
                                        }

                                        const response = await fetch('/api/bookings/manual', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'Accept': 'application/json',
                                                'X-CSRF-TOKEN': document.querySelector(
                                                    'meta[name="csrf-token"]').content
                                            },
                                            body: JSON.stringify(bookingData)
                                        });

                                        const data = await response.json();

                                        if (response.ok && data.success) {
                                            this.showNotification('Booking berhasil ditambahkan!', 'success');

                                            await this.loadBookings();
                                            await this.loadCustomerData();

                                            const today = new Date().toISOString().split('T')[0];
                                            this.newBooking = {
                                                customer: '',
                                                phone: '',
                                                email: '',
                                                ktp: '',
                                                address: '',
                                                car: '',
                                                spv: '',
                                                security: '',
                                                bookingDate: today,
                                                bookingType: 'test_drive',
                                                salesName: '',
                                                salesPhone: '',
                                                testDriveTime: '',
                                                testDriveLocation: '',
                                                targetProspect: '',
                                                eventDate: '',
                                                eventLocation: ''
                                            };
                                        } else {
                                            this.showNotification(data.message || 'Gagal menambahkan booking',
                                                'error');
                                        }
                                    } catch (error) {
                                        console.error('Error adding booking:', error);
                                        this.showNotification('Terjadi kesalahan saat menambahkan booking',
                                            'error');
                                    }
                                },

                                async updateBookingStatus() {
                                    if (this.selectedBookingIndex !== null && this.newStatus) {
                                        const booking = this.bookings[this.selectedBookingIndex];

                                        // ✅ CRITICAL: Kirim booking_type ke backend
                                        const bookingType = booking.booking_type || 'test_drive';

                                        // Client-side validation
                                        const userRole = '{{ auth()->user()->role }}';

                                        if (userRole === 'branch_manager') {
                                            // Branch Manager ONLY can set "Dikonfirmasi" or "Dibatalkan"
                                            if (!['Dikonfirmasi', 'Dibatalkan'].includes(this.newStatus)) {
                                                this.showNotification(
                                                    'Branch Manager hanya dapat:\n' +
                                                    'Approve (Dikonfirmasi)\n' +
                                                    'Disapprove/Cancel (Dibatalkan)',
                                                    'error'
                                                );
                                                return;
                                            }

                                            // Validate based on action
                                            if (this.newStatus === 'Dikonfirmasi') {
                                                // Approve: hanya dari "Diproses"
                                                if (booking.status !== 'Diproses') {
                                                    this.showNotification(
                                                        `Branch Manager hanya dapat approve booking dengan status "Diproses".\n\n` +
                                                        `Status booking saat ini: "${booking.status}"`,
                                                        'error'
                                                    );
                                                    return;
                                                }
                                            } else if (this.newStatus === 'Dibatalkan') {
                                                // Cancel: dari "Diproses" atau "Dikonfirmasi"
                                                if (!['Diproses', 'Dikonfirmasi'].includes(booking.status)) {
                                                    this.showNotification(
                                                        `Branch Manager hanya dapat cancel booking dengan status "Diproses" atau "Dikonfirmasi".\n\n` +
                                                        `Status booking saat ini: "${booking.status}"`,
                                                        'error'
                                                    );
                                                    return;
                                                }
                                            }
                                        } else if (userRole === 'spv') {
                                            // SPV: hanya approve/cancel "Menunggu" bookings
                                            if (booking.status !== 'Menunggu') {
                                                this.showNotification(
                                                    `SPV hanya dapat approve/cancel booking dengan status "Menunggu".\n\n` +
                                                    `Status booking saat ini: "${booking.status}"`,
                                                    'error'
                                                );
                                                return;
                                            }

                                            if (!['Diproses', 'Dibatalkan'].includes(this.newStatus)) {
                                                this.showNotification(
                                                    'SPV hanya dapat:\n' +
                                                    'Approve (Diproses)\n' +
                                                    'Cancel (Dibatalkan)',
                                                    'error'
                                                );
                                                return;
                                            }
                                        }

                                        // Proceed with status update
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
                                                    status: this.newStatus,
                                                    booking_type: bookingType
                                                })
                                            });

                                            const data = await response.json();

                                            if (response.ok && data.success) {
                                                this.showNotification(data.message, 'success');
                                                await this.loadBookings();
                                                this.statusModal = false;
                                                this.selectedBooking = null;
                                                this.selectedBookingIndex = null;
                                            } else {
                                                this.showNotification(data.message || 'Gagal update status',
                                                    'error');
                                            }
                                        } catch (error) {
                                            console.error('Error:', error);
                                            this.showNotification('Terjadi kesalahan saat update status', 'error');
                                        }
                                    }
                                },

                                // Computed: Paginated Data Booking
                                get paginatedBookingData() {
                                    const filtered = this.filteredBookingData;
                                    const start = (this.bookingCurrentPage - 1) * this.bookingItemsPerPage;
                                    const end = start + this.bookingItemsPerPage;
                                    return filtered.slice(start, end);
                                },

                                get bookingTotalPages() {
                                    return Math.ceil(this.filteredBookingData.length / this.bookingItemsPerPage) ||
                                        1;
                                },

                                get bookingStartIndex() {
                                    return (this.bookingCurrentPage - 1) * this.bookingItemsPerPage;
                                },

                                get bookingEndIndex() {
                                    return this.bookingCurrentPage * this.bookingItemsPerPage;
                                },

                                // Computed: Paginated Management Booking
                                get paginatedManagementBookings() {
                                    const filtered = this.filteredManagementBookings;
                                    const start = (this.managementCurrentPage - 1) * this.managementItemsPerPage;
                                    const end = start + this.managementItemsPerPage;
                                    return filtered.slice(start, end);
                                },

                                get managementTotalPages() {
                                    return Math.ceil(this.filteredManagementBookings.length / this
                                        .managementItemsPerPage) || 1;
                                },

                                get managementStartIndex() {
                                    return (this.managementCurrentPage - 1) * this.managementItemsPerPage;
                                },

                                get managementEndIndex() {
                                    return this.managementCurrentPage * this.managementItemsPerPage;
                                },

                                // Methods untuk pagination Management
                                nextManagementPage() {
                                    if (this.managementCurrentPage < this.managementTotalPages) {
                                        this.managementCurrentPage++;
                                    }
                                },

                                prevManagementPage() {
                                    if (this.managementCurrentPage > 1) {
                                        this.managementCurrentPage--;
                                    }
                                },

                                goToManagementPage(page) {
                                    if (typeof page === 'number' && page >= 1 && page <= this.managementTotalPages) {
                                        this.managementCurrentPage = page;
                                    }
                                },

                                // Methods untuk pagination Data Booking
                                nextBookingPage() {
                                    if (this.bookingCurrentPage < this.bookingTotalPages) {
                                        this.bookingCurrentPage++;
                                    }
                                },

                                prevBookingPage() {
                                    if (this.bookingCurrentPage > 1) {
                                        this.bookingCurrentPage--;
                                    }
                                },

                                goToBookingPage(page) {
                                    if (typeof page === 'number' && page >= 1 && page <= this.bookingTotalPages) {
                                        this.bookingCurrentPage = page;
                                    }
                                },

                                // Computed: Visible pages untuk Management
                                get managementVisiblePages() {
                                    const total = this.managementTotalPages;
                                    const current = this.managementCurrentPage;
                                    const pages = [];
                                    if (total <= 7) {
                                        for (let i = 1; i <= total; i++) pages.push(i);
                                    } else {
                                        if (current <= 3) pages.push(1, 2, 3, 4, '...', total);
                                        else if (current >= total - 2) pages.push(1, '...', total - 3, total - 2,
                                            total - 1, total);
                                        else pages.push(1, '...', current - 1, current, current + 1, '...', total);
                                    }
                                    return pages;
                                },

                                // Computed: Visible pages untuk Data Booking  
                                get bookingVisiblePages() {
                                    const total = this.bookingTotalPages;
                                    const current = this.bookingCurrentPage;
                                    const pages = [];
                                    if (total <= 7) {
                                        for (let i = 1; i <= total; i++) pages.push(i);
                                    } else {
                                        if (current <= 3) pages.push(1, 2, 3, 4, '...', total);
                                        else if (current >= total - 2) pages.push(1, '...', total - 3, total - 2,
                                            total - 1, total);
                                        else pages.push(1, '...', current - 1, current, current + 1, '...', total);
                                    }
                                    return pages;
                                },

                                getOriginalIndex(booking) {
                                    return this.bookings.findIndex(b =>
                                        b.id === booking.id
                                    );
                                },

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

                                isDateInRange(dateStr, fromDate, toDate) {
                                    if (!fromDate && !toDate) return true;

                                    const bookingDate = this.parseDate(dateStr);
                                    const from = fromDate ? new Date(fromDate) : null;
                                    const to = toDate ? new Date(toDate) : null;

                                    if (from && bookingDate < from) return false;
                                    if (to && bookingDate > to) return false;

                                    return true;
                                },

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

                                get filteredBookings() {
                                    let filtered = this.bookings;

                                    if (this.searchQuery.trim()) {
                                        const query = this.searchQuery.toLowerCase();
                                        filtered = filtered.filter(booking =>
                                            booking.customer.toLowerCase().includes(query) ||
                                            booking.car.toLowerCase().includes(query) ||
                                            booking.status.toLowerCase().includes(query) ||
                                            booking.date.toLowerCase().includes(query)
                                        );
                                    }

                                    if (this.filters.car) {
                                        filtered = filtered.filter(booking => booking.car === this.filters.car);
                                    }

                                    if (this.filters.status) {
                                        filtered = filtered.filter(booking => booking.status === this.filters
                                            .status);
                                    }

                                    if (this.filters.dateFrom || this.filters.dateTo) {
                                        filtered = filtered.filter(booking =>
                                            this.isDateInRange(booking.date, this.filters.dateFrom, this.filters
                                                .dateTo)
                                        );
                                    }

                                    return this.applySorting(filtered);
                                },

                                get filteredCustomers() {
                                    const customers = this.getAllCustomers();
                                    if (!this.customerSearchQuery.trim()) return customers;
                                    const query = this.customerSearchQuery.toLowerCase();
                                    return customers.filter(customer =>
                                        customer.name.toLowerCase().includes(query) ||
                                        customer.phone.toLowerCase().includes(query) ||
                                        customer.email.toLowerCase().includes(query) ||
                                        customer.ktp.toLowerCase().includes(query)
                                    );
                                },

                                // Get bookings by selected type
                                get bookingsByType() {
                                    return this.bookings.filter(booking => {
                                        // âœ… Strict type checking
                                        return booking.booking_type === this.bookingViewType;
                                    });
                                },

                                // Filtered booking data with search
                                get filteredBookingData() {
                                    let filtered = this.bookingsByType;
                                    if (this.bookingDataSearchQuery.trim()) {
                                        const query = this.bookingDataSearchQuery.toLowerCase();
                                        filtered = filtered.filter(booking =>
                                            booking.customer.toLowerCase().includes(query) ||
                                            booking.car.toLowerCase().includes(query) ||
                                            booking.date.toLowerCase().includes(query) ||
                                            (booking.phone && booking.phone.includes(query)) ||
                                            (booking.sales_name && booking.sales_name.toLowerCase().includes(
                                                query))
                                        );
                                    }

                                    return filtered;
                                },

                                // Get bookings by management view type
                                get managementBookingsByType() {
                                    return this.bookings.filter(booking => {
                                        // Strict type checking
                                        return booking.booking_type === this.managementViewType;
                                    });
                                },

                                // Filtered management bookings with search
                                get filteredManagementBookings() {
                                    let filtered = this.managementBookingsByType;
                                    // Search filter
                                    if (this.managementSearchQuery.trim()) {
                                        const query = this.managementSearchQuery.toLowerCase();
                                        filtered = filtered.filter(booking =>
                                            booking.customer.toLowerCase().includes(query) ||
                                            booking.car.toLowerCase().includes(query) ||
                                            booking.date.toLowerCase().includes(query) ||
                                            (booking.phone && booking.phone.includes(query)) ||
                                            (booking.sales_name && booking.sales_name.toLowerCase().includes(
                                                query)) ||
                                            (booking.spv && booking.spv.toLowerCase().includes(query)) ||
                                            // Include SPV in search    
                                            booking.status.toLowerCase().includes(query)
                                        );
                                    }

                                    // Filter by specific SPV
                                    if (this.managementSPVFilter) {
                                        filtered = filtered.filter(booking => booking.spv === this
                                            .managementSPVFilter);
                                    }

                                    // Sort by SPV
                                    if (this.managementSPVSort && !this.managementSPVFilter) {
                                        filtered = [...filtered].sort((a, b) => {
                                            const spvA = (a.spv || '').toLowerCase();
                                            const spvB = (b.spv || '').toLowerCase();

                                            const comparison = spvA.localeCompare(spvB);
                                            return this.managementSPVSort === 'asc' ? comparison : -
                                                comparison;
                                        });
                                    }

                                    // SPV Sort
                                    if (this.managementSPVSort) {
                                        filtered = [...filtered].sort((a, b) => {
                                            // Use sales_name for comparison
                                            const salesA = (a.sales_name || '').toLowerCase();
                                            const salesB = (b.sales_name || '').toLowerCase();

                                            const comparison = salesA.localeCompare(salesB);
                                            return this.managementSPVSort === 'asc' ? comparison : -
                                                comparison;
                                        });
                                    }

                                    // Status filter
                                    if (this.managementStatusFilter) {
                                        filtered = filtered.filter(booking => booking.status === this
                                            .managementStatusFilter);
                                    }

                                    // Status sort
                                    if (this.managementStatusSort) {
                                        filtered = [...filtered].sort((a, b) => {
                                            const orderA = this.statusOrder[a.status] || 999;
                                            const orderB = this.statusOrder[b.status] || 999;

                                            return this.managementStatusSort === 'asc' ?
                                                orderA - orderB :
                                                orderB - orderA;
                                        });
                                    }

                                    return filtered;
                                },

                                // Open management detail modal
                                openManagementDetailModal(booking) {
                                    this.selectedManagementBooking = booking;
                                    this.managementDetailModal = true;
                                },

                                // Open status modal from management section
                                openStatusModalFromManagement(booking) {
                                    const originalIndex = this.getOriginalIndex(booking);
                                    this.openStatusModal(originalIndex);
                                },

                                get hasActiveFilters() {
                                    return !!(this.filters.car || this.filters.status || this.filters.dateFrom ||
                                        this.filters.dateTo);
                                },

                                get hasActiveSorting() {
                                    return !!(this.sorting.customer || this.sorting.car || this.sorting.date);
                                },

                                get activeFilters() {
                                    const filters = [];
                                    if (this.filters.car) {
                                        filters.push({
                                            type: 'car',
                                            label: `Mobil: ${this.filters.car}`
                                        });
                                    }
                                    if (this.filters.status) {
                                        filters.push({
                                            type: 'status',
                                            label: `Status: ${this.filters.status}`
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

                                getChecksheetButtonClass(customerEmail) {
                                    // Find customer by email
                                    const customer = Object.values(this.customerData).find(c => c.email ===
                                        customerEmail);

                                    // Belum ada checksheet = Abu-abu
                                    if (!customer || !customer.checksheetSummary || customer.checksheetSummary
                                        .length === 0) {
                                        return 'bg-gray-600 hover:bg-gray-700';
                                    }

                                    // Cek apakah ada checksheet dengan status warning (ada masalah/perubahan kondisi)
                                    const hasWarning = customer.checksheetSummary.some(summary => {
                                        const hasChanged = summary.changed_conditions && summary
                                            .changed_conditions.length > 0;
                                        const hasPinjamIssues = summary.pinjam_issues && summary.pinjam_issues
                                            .length > 0;
                                        const hasKembaliIssues = summary.kembali_issues && summary
                                            .kembali_issues.length > 0;
                                        const hasDokumenIssues = summary.dokumen_issues && summary
                                            .dokumen_issues.length > 0;
                                        const hasKelengkapanIssues = summary.kelengkapan_issues && summary
                                            .kelengkapan_issues.length > 0;
                                        const hasFuelChanged = summary.fuel_changed;

                                        return hasChanged || hasPinjamIssues || hasKembaliIssues ||
                                            hasDokumenIssues || hasKelengkapanIssues || hasFuelChanged ||
                                            summary.status === 'warning';
                                    });

                                    // ✅ Return warna berdasarkan kondisi
                                    if (hasWarning) {
                                        return 'bg-red-600 hover:bg-red-700'; // Merah = Ada masalah
                                    } else {
                                        return 'bg-green-600 hover:bg-green-700'; // Hijau = Semua baik
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

                                clearAllFilters() {
                                    this.filters = {
                                        car: '',
                                        status: '',
                                        dateFrom: '',
                                        dateTo: ''
                                    };
                                    this.sorting = {
                                        customer: '',
                                        car: '',
                                        date: ''
                                    };
                                },

                                clearFilter(filterType) {
                                    this.filters[filterType] = '';
                                },

                                clearSorting(sortType) {
                                    this.sorting[sortType] = '';
                                },

                                toggleSort(field) {
                                    if (this.sorting[field] === '') {
                                        this.sorting[field] = 'asc';
                                    } else if (this.sorting[field] === 'asc') {
                                        this.sorting[field] = 'desc';
                                    } else {
                                        this.sorting[field] = '';
                                    }
                                },

                                openCustomerDetail(customerName) {
                                    this.selectedCustomerDetail = this.customerData[customerName] || null;
                                    this.customerDetailModal = true;
                                },

                                // Open customer detail from booking
                                openCustomerDetailFromBooking(booking) {
                                    // Method 1: Try to find in customerData by name
                                    if (this.customerData[booking.customer]) {
                                        this.openCustomerDetail(booking.customer);
                                        return;
                                    }

                                    // Method 2: If not found, create minimal customer detail
                                    this.selectedCustomerDetail = {
                                        name: booking.customer,
                                        phone: booking.phone,
                                        email: booking.email,
                                        ktp: booking.ktp || '-',
                                        address: booking.address || '-',
                                        assignedSPV: booking.spv,
                                        assignedSecurity: booking.security,
                                        totalBookings: 1,
                                        bookingHistory: [{
                                            date: booking.date,
                                            car: booking.car,
                                            status: booking.status
                                        }]
                                    };

                                    this.customerDetailModal = true;
                                },

                                // Open status modal from booking data section
                                openStatusModalFromBookingData(booking) {
                                    const originalIndex = this.getOriginalIndex(booking);
                                    this.openStatusModal(originalIndex);
                                },

                                openEditCustomer(customerName) {
                                    const customer = this.customerData[customerName];
                                    if (customer) {
                                        this.editingCustomer = {
                                            originalName: customerName,
                                            name: customer.name,
                                            phone: customer.phone,
                                            email: customer.email,
                                            ktp: customer.ktp,
                                            address: customer.address,
                                            assignedSPV: customer.assignedSPV,
                                            assignedSecurity: customer.assignedSecurity
                                        };
                                        this.customerDetailModal = false;
                                        this.editCustomerModal = true;
                                    }
                                },

                                async updateCustomer() {
                                    if (!this.editingCustomer.name.trim()) {
                                        alert('Nama harus diisi!');
                                        return;
                                    }
                                    if (!this.editingCustomer.phone.trim()) {
                                        alert('No. telepon harus diisi!');
                                        return;
                                    }
                                    if (!this.editingCustomer.email.trim()) {
                                        alert('Email harus diisi!');
                                        return;
                                    }
                                    if (!this.editingCustomer.ktp.trim()) {
                                        alert('No. KTP harus diisi!');
                                        return;
                                    }
                                    if (!this.editingCustomer.address.trim()) {
                                        alert('Alamat harus diisi!');
                                        return;
                                    }

                                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                                    if (!emailRegex.test(this.editingCustomer.email)) {
                                        alert('Format email tidak valid!');
                                        return;
                                    }

                                    const phoneRegex = /^[0-9]{10,13}$/;
                                    if (!phoneRegex.test(this.editingCustomer.phone.replace(/\D/g, ''))) {
                                        alert('No. telepon harus berupa angka 10-13 digit!');
                                        return;
                                    }

                                    if (this.editingCustomer.ktp.length !== 16) {
                                        alert('No. KTP harus 16 digit!');
                                        return;
                                    }

                                    try {
                                        const originalCustomer = this.customerData[this.editingCustomer
                                            .originalName];

                                        const response = await fetch('/api/bookings/customers/update', {
                                            method: 'PUT',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'Accept': 'application/json',
                                                'X-CSRF-TOKEN': document.querySelector(
                                                    'meta[name="csrf-token"]').content
                                            },
                                            body: JSON.stringify({
                                                original_email: originalCustomer.email,
                                                nama_lengkap: this.editingCustomer.name.trim(),
                                                nomor_telepon: this.editingCustomer.phone.trim(),
                                                email: this.editingCustomer.email.trim(),
                                                no_ktp: this.editingCustomer.ktp.trim(),
                                                alamat: this.editingCustomer.address.trim(),
                                                supervisor_id: this.staffData.supervisors.find(s =>
                                                        s.name === this.editingCustomer.assignedSPV)
                                                    ?.id,
                                                security_id: this.staffData.securities.find(s => s
                                                    .name === this.editingCustomer
                                                    .assignedSecurity)?.id
                                            })
                                        });

                                        const data = await response.json();

                                        if (response.ok && data.success) {
                                            this.showNotification('Data customer berhasil diupdate!', 'success');

                                            await this.loadBookings();
                                            await this.loadCustomerData();

                                            this.editCustomerModal = false;
                                            this.editingCustomer = null;
                                        } else {
                                            this.showNotification(data.message || 'Gagal update customer', 'error');
                                        }
                                    } catch (error) {
                                        console.error('Error updating customer:', error);
                                        this.showNotification('Terjadi kesalahan saat update customer', 'error');
                                    }
                                },

                                openStatusModal(bookingIndex) {
                                    this.selectedBookingIndex = bookingIndex;
                                    this.selectedBooking = this.bookings[bookingIndex];

                                    // Set default status berdasarkan role
                                    const userRole = '{{ auth()->user()->role }}';
                                    const currentStatus = this.selectedBooking.status;

                                    if (userRole === 'spv') {
                                        // SPV: Default ke "Diproses" (approve)
                                        this.newStatus = 'Diproses';
                                    } else if (userRole === 'branch_manager') {
                                        // Branch Manager: Default ke "Dikonfirmasi" (approve)
                                        this.newStatus = 'Dikonfirmasi';
                                    } else {
                                        // Admin: Keep current status
                                        this.newStatus = currentStatus;
                                    }

                                    this.statusModal = true;
                                },

                                getAllCustomers() {
                                    return Object.keys(this.customerData).map(name => {
                                        const customerInfo = this.customerData[name];
                                        return {
                                            ...customerInfo,
                                            totalBookings: customerInfo.totalBookings || 0,
                                            lastCar: customerInfo.lastCar || null
                                        };
                                    });
                                },

                                showNotification(message, type = 'info') {
                                    const notification = document.createElement('div');
                                    const bgColor = type === 'error' ? 'bg-red-500' : type === 'success' ?
                                        'bg-green-500' : 'bg-blue-500';
                                    notification.className =
                                        `fixed top-4 right-4 z-[9999] p-4 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full ${bgColor}`;
                                    notification.innerHTML = `
                    <div class="flex items-center gap-2">
                        <span class="text-white">${message}</span>
                        <button onclick="this.parentElement.parentElement.remove()" class="ml-2 text-white hover:text-gray-200">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                `;

                                    document.body.appendChild(notification);

                                    setTimeout(() => {
                                        notification.classList.remove('translate-x-full');
                                    }, 100);

                                    setTimeout(() => {
                                        notification.classList.add('translate-x-full');
                                        setTimeout(() => {
                                            if (notification.parentElement) {
                                                notification.remove();
                                            }
                                        }, 300);
                                    }, 3000);
                                },
                                async viewChecksheetSummary(customerEmail) {
                                    try {
                                        const response = await fetch(
                                            `/api/bookings/customers/${encodeURIComponent(customerEmail)}/checksheet-summary`, {
                                                headers: {
                                                    'Accept': 'application/json',
                                                    'X-CSRF-TOKEN': document.querySelector(
                                                        'meta[name="csrf-token"]').content
                                                }
                                            });

                                        if (response.ok) {
                                            const data = await response.json();
                                            this.selectedChecksheetSummary = data.data;
                                            this.checksheetSummaryModal = true;
                                        } else {
                                            this.showNotification('Gagal memuat summary checksheet', 'error');
                                        }
                                    } catch (error) {
                                        console.error('Error loading checksheet summary:', error);
                                        this.showNotification('Terjadi kesalahan saat memuat summary', 'error');
                                    }
                                },
                                getCsrfToken() {
                                    const token = document.querySelector('meta[name="csrf-token"]');
                                    return token ? token.getAttribute('content') : '';
                                },

                                isAdmin() {
                                    return '{{ auth()->user()->role }}' === 'admin';
                                },

                                isSPV() {
                                    return '{{ auth()->user()->role }}' === 'spv';
                                },

                                isBranchManager() {
                                    return '{{ auth()->user()->role }}' === 'branch_manager';
                                }
                            }));
                        });
                    </script>
</x-layouts.app>
