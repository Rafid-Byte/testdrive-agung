<div class="p-3 lg:p-6">
    <div class="max-w-7xl mx-auto space-y-6">
        <div
            class="mb-4 lg:mb-6 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4 lg:p-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-3 lg:gap-4">
                <div class="lg:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Cari Booking
                    </label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
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

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 lg:gap-4 mb-4 lg:mb-6">
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-3 lg:p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs lg:text-sm text-gray-600 dark:text-gray-400">Total Booking
                        </p>
                        <p class="text-xl lg:text-2xl font-bold text-gray-900 dark:text-white" x-text="totalBookings">
                        </p>
                    </div>
                    <div
                        class="w-10 h-10 lg:w-12 lg:h-12 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 lg:w-6 lg:h-6 text-blue-600 dark:text-blue-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
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
                        <svg class="w-5 h-5 lg:w-6 lg:h-6 text-blue-600 dark:text-blue-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
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
                        <svg class="w-5 h-5 lg:w-6 lg:h-6 text-yellow-600 dark:text-yellow-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
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
                        <svg class="w-5 h-5 lg:w-6 lg:h-6 text-green-600 dark:text-green-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>


        {{-- FILTER BAR --}}
        <div x-show="picSort || carFilter || dateSort || dateFilter"
            class="mb-4 p-3 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
            <div class="flex flex-wrap items-center gap-2">
                <span class="text-xs font-semibold text-blue-700 dark:text-blue-300">Filter Aktif:</span>

                <template x-if="picSort">
                    <span
                        class="inline-flex items-center gap-1 px-2 py-1 bg-purple-600 text-white text-xs font-medium rounded-full">
                        Sort PIC: <span x-text="picSort === 'asc' ? 'A → Z' : 'Z → A'"></span>
                        <button @click.prevent="clearPicSort()"
                            class="ml-1 hover:bg-purple-700 rounded-full p-0.5 transition"><svg class="w-3 h-3"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg></button>
                    </span>
                </template>

                <template x-if="carFilter">
                    <span
                        class="inline-flex items-center gap-1 px-2 py-1 bg-blue-600 text-white text-xs font-medium rounded-full">
                        Mobil: <span x-text="carFilter"></span>
                        <button @click.prevent="filterByCar('')"
                            class="ml-1 hover:bg-blue-700 rounded-full p-0.5 transition"><svg class="w-3 h-3"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg></button>
                    </span>
                </template>

                <template x-if="dateSort">
                    <span
                        class="inline-flex items-center gap-1 px-2 py-1 bg-indigo-600 text-white text-xs font-medium rounded-full">
                        Sort Tanggal: <span x-text="dateSort === 'asc' ? 'Terlama' : 'Terbaru'"></span>
                        <button @click.prevent="clearDateFilter()"
                            class="ml-1 hover:bg-indigo-700 rounded-full p-0.5 transition"><svg class="w-3 h-3"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg></button>
                    </span>
                </template>

                <template x-if="dateFilter">
                    <span
                        class="inline-flex items-center gap-1 px-2 py-1 bg-green-600 text-white text-xs font-medium rounded-full">
                        Tanggal: <span x-text="dateFilter"></span>
                        <button @click.prevent="clearDateFilter()"
                            class="ml-1 hover:bg-green-700 rounded-full p-0.5 transition"><svg class="w-3 h-3"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg></button>
                    </span>
                </template>

                <button type="button" @click.prevent="clearAllFilters()"
                    class="ml-auto px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-xs font-semibold rounded-lg transition-colors flex items-center gap-1 shadow-sm">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    Clear All
                </button>
            </div>
        </div>

        <div
            class="hidden lg:block bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Daftar Booking Pameran
                </h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                <div class="flex items-center justify-between">
                                    <span>PIC</span>
                                    <div class="relative" x-data="{ open: false }">
                                        <button @click="open = !open"
                                            class="ml-2 p-1 hover:bg-gray-200 dark:hover:bg-gray-600 rounded"><svg
                                                class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                                            </svg></button>
                                        <div x-show="open" @click.away="open = false" x-transition
                                            class="absolute left-0 top-full mt-2 w-44 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-600 z-[300]"
                                            style="display:none;">
                                            <button @click="sortPic('asc'); open = false"
                                                class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-900 dark:text-gray-100">A
                                                - Z</button>
                                            <button @click="sortPic('desc'); open = false"
                                                class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-900 dark:text-gray-100">Z
                                                - A</button>
                                            <button @click="clearPicSort(); open = false"
                                                class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700 text-red-600 dark:text-red-400">Clear
                                                Sort</button>
                                        </div>
                                    </div>
                                </div>
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                <div class="flex items-center justify-between">
                                    <span>Mobil</span>
                                    <div class="relative" x-data="{ open: false }">
                                        <button @click="open = !open"
                                            class="ml-2 p-1 hover:bg-gray-200 dark:hover:bg-gray-600 rounded"><svg
                                                class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h6a1 1 0 001-1v-6a1 1 0 00-1-1h-6z" />
                                            </svg></button>
                                        <div x-show="open" @click.away="open = false" x-transition
                                            class="absolute left-0 top-full mt-2 w-64 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-600 z-[300] max-h-64 overflow-y-auto"
                                            style="display:none;">
                                            <button @click="filterByCar(''); open = false"
                                                class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700 font-semibold"
                                                :class="carFilter === '' ?
                                                    'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                    'text-gray-900 dark:text-gray-100'">Semua
                                                Mobil</button>
                                            <button @click="filterByCar('Toyota Hilux Rangga'); open = false"
                                                class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                :class="carFilter === 'Toyota Hilux Rangga' ?
                                                    'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                    'text-gray-900 dark:text-gray-100'">Toyota
                                                Hilux Rangga</button>
                                            <button @click="filterByCar('Toyota Raize Abu Abu'); open = false"
                                                class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                :class="carFilter === 'Toyota Raize Abu Abu' ?
                                                    'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                    'text-gray-900 dark:text-gray-100'">Toyota
                                                Raize Abu Abu</button>
                                            <button @click="filterByCar('Toyota Zenix'); open = false"
                                                class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                :class="carFilter === 'Toyota Zenix' ?
                                                    'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                    'text-gray-900 dark:text-gray-100'">Toyota
                                                Zenix</button>
                                            <button @click="filterByCar('Toyota Agya Putih'); open = false"
                                                class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                :class="carFilter === 'Toyota Agya Putih' ?
                                                    'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                    'text-gray-900 dark:text-gray-100'">Toyota
                                                Agya Putih</button>
                                            <button @click="filterByCar('Toyota Fortuner'); open = false"
                                                class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                :class="carFilter === 'Toyota Fortuner' ?
                                                    'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                    'text-gray-900 dark:text-gray-100'">Toyota
                                                Fortuner</button>
                                            <button @click="filterByCar('Toyota Agya GR Merah'); open = false"
                                                class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                :class="carFilter === 'Toyota Agya GR Merah' ?
                                                    'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                    'text-gray-900 dark:text-gray-100'">Toyota
                                                Agya GR Merah</button>
                                        </div>
                                    </div>
                                </div>
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                <div class="flex items-center justify-between">
                                    <span>Tanggal Acara</span>
                                    <div class="relative" x-data="{ open: false }">
                                        <button @click="open = !open"
                                            class="ml-2 p-1 hover:bg-gray-200 dark:hover:bg-gray-600 rounded"><svg
                                                class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg></button>
                                        <div x-show="open" @click.away="open = false" x-transition
                                            class="absolute left-0 top-full mt-2 w-52 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-600 z-[300]"
                                            style="display:none;">
                                            <button @click="setDateSort('desc'); open = false"
                                                class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                :class="dateSort === 'desc' ?
                                                    'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                    'text-gray-900 dark:text-gray-100'">Terbaru</button>
                                            <button @click="setDateSort('asc'); open = false"
                                                class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                :class="dateSort === 'asc' ?
                                                    'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                                    'text-gray-900 dark:text-gray-100'">Terlama</button>
                                            <div class="px-4 py-2 border-t border-gray-200 dark:border-gray-600">
                                                <label
                                                    class="text-xs text-gray-500 dark:text-gray-400 mb-1 block">Pilih
                                                    Tanggal</label>
                                                <input type="date"
                                                    @change="setDateFilter($event.target.value); open = false"
                                                    class="w-full px-2 py-1 text-sm border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                                            </div>
                                            <button @click="clearDateFilter(); open = false"
                                                class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700 text-red-600 dark:text-red-400">Clear
                                                Sort</button>
                                        </div>
                                    </div>
                                </div>
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
                                        <svg class="animate-spin h-8 w-8 text-blue-600 mb-3" fill="none"
                                            viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4">
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
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                            </path>
                                        </svg>
                                        <p class="text-gray-500 dark:text-gray-400 text-lg font-medium">
                                            Tidak ada data booking</p>
                                        <p class="text-gray-400 dark:text-gray-500 text-sm">Belum ada
                                            booking pameran yang disetujui</p>
                                    </div>
                                </td>
                            </tr>
                        </template>

                        <template x-for="(booking, index) in paginatedBookings" :key="'booking-' + booking.id">
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors h-16">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white"
                                        x-text="booking.nama_pic || '-'"></div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400"
                                        x-text="booking.nomor_telepon || '-'"></div>
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
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full"
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
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                            Detail
                                        </button>
                                        <button @click="canUpdateStatus(booking) ? openStatusModal(booking.id) : null"
                                            :disabled="!canUpdateStatus(booking)"
                                            :class="canUpdateStatus(booking) ?
                                                'text-green-700 bg-green-100 hover:bg-green-200 dark:bg-green-900/30 dark:text-green-400 dark:hover:bg-green-900/50 cursor-pointer' :
                                                'text-gray-400 bg-gray-100 dark:bg-gray-700 dark:text-gray-500 cursor-not-allowed opacity-60'"
                                            class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md transition-colors"
                                            :title="!canUpdateStatus(booking) ?
                                                'Status belum dapat diubah — menunggu konfirmasi Branch Manager' :
                                                'Update status'">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                            Status
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </template>
                        <template x-for="i in (itemsPerPage - paginatedBookings.length)" :key="'filler-' + i">
                            <tr class="h-16">
                                <td colspan="6" class="px-6 py-3">
                                    <div class="h-full">&nbsp;</div>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
            @include('components.pameraninfo._pagination')
        </div>

        <div class="lg:hidden space-y-3">
            <template x-if="loading">
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                    <div class="flex flex-col items-center justify-center">
                        <svg class="animate-spin h-8 w-8 text-blue-600 mb-3" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
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
                        <svg class="w-16 h-16 text-gray-400 mb-3" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
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

            <template x-for="(booking, index) in paginatedBookings" :key="'mobile-booking-' + booking.id">
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-semibold text-gray-900 dark:text-white truncate"
                                x-text="booking.nama_pic || '-'"></h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400" x-text="booking.nomor_telepon || '-'">
                            </p>
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
                            <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                            <span x-text="booking.mobil || '-'"></span>
                        </div>
                        <div class="flex items-center text-xs text-gray-600 dark:text-gray-400">
                            <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            <span x-text="booking.tanggal_acara || '-'"></span>
                        </div>
                        <div class="flex items-start text-xs text-gray-600 dark:text-gray-400">
                            <svg class="w-4 h-4 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
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
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                            Status
                        </button>
                    </div>
                </div>
            </template>

            @include('components.pameraninfo._pagination')
        </div>
    </div>
</div>
