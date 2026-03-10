<div class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-200 dark:border-gray-600 shadow-lg">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Daftar Booking Test Drive</h2>
    </div>

    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mb-4">
        <div class="relative flex-1">
            <input x-model="searchQuery" type="text" placeholder="Cari booking..."
                class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>
        <span
            class="px-3 py-2 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-sm font-medium rounded-lg whitespace-nowrap text-center">
            Total: <span x-text="filteredBookings.length"></span> booking
        </span>
    </div>

    <div x-show="customerSort || carFilter || dateSort || dateFilter || carStatusFilter || approvalStatusFilter"
        class="mb-4 p-3 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
        <div class="flex flex-wrap items-center gap-2">
            <span class="text-xs font-semibold text-blue-700 dark:text-blue-300">Filter
                Aktif:</span>

            <template x-if="customerSort">
                <span
                    class="inline-flex items-center gap-1 px-2 py-1 bg-purple-600 text-white text-xs font-medium rounded-full">
                    Sort Customer: <span x-text="customerSort === 'asc' ? 'A → Z' : 'Z → A'"></span>
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

            <template x-if="dateSort">
                <span
                    class="inline-flex items-center gap-1 px-2 py-1 bg-indigo-600 text-white text-xs font-medium rounded-full">
                    Sort Tanggal: <span x-text="dateSort === 'asc' ? 'Terlama' : 'Terbaru'"></span>
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
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Clear All
            </button>
        </div>
    </div>


    <div class="hidden lg:block overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-600">
        <table class="w-full min-w-full table-fixed">
            <thead>
                <tr class="bg-gray-100 dark:bg-gray-700 border-b-2 border-gray-300 dark:border-gray-600">
                    <th
                        class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                        <div class="flex items-center justify-between">
                            <span>Customer</span>
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open"
                                    class="ml-2 p-1 hover:bg-gray-200 dark:hover:bg-gray-600 rounded">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
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

                    <th
                        class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                        <div class="flex items-center justify-between">
                            <span>Mobil</span>
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open"
                                    class="ml-2 p-1 hover:bg-gray-200 dark:hover:bg-gray-600 rounded">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
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
                                    <button @click="filterByCar('Toyota Hilux Rangga'); open = false"
                                        class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                        :class="carFilter === 'Toyota Hilux Rangga' ?
                                            'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                            'text-gray-900 dark:text-gray-100'">
                                        Toyota Hilux Rangga
                                    </button>
                                    <button @click="filterByCar('Toyota Raize Abu Abu'); open = false"
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
                                    <button @click="filterByCar('Toyota Agya Putih'); open = false"
                                        class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                        :class="carFilter === 'Toyota Agya Putih' ?
                                            'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                            'text-gray-900 dark:text-gray-100'">
                                        Toyota Agya Putih
                                    </button>
                                    <button @click="filterByCar('Toyota Fortuner'); open = false"
                                        class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                        :class="carFilter === 'Toyota Fortuner' ?
                                            'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                            'text-gray-900 dark:text-gray-100'">
                                        Toyota Fortuner
                                    </button>
                                    <button @click="filterByCar('Toyota Agya GR Merah'); open = false"
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

                    <th
                        class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                        <div class="flex items-center justify-between">
                            <span>Tanggal</span>
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open"
                                    class="ml-2 p-1 hover:bg-gray-200 dark:hover:bg-gray-600 rounded">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
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
                                    <div class="px-4 py-2 border-t border-gray-200 dark:border-gray-600">
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

                    <th
                        class="px-4 py-3 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                        <div class="flex items-center justify-center">
                            <span>Status Mobil</span>
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open"
                                    class="ml-2 p-1 hover:bg-gray-200 dark:hover:bg-gray-600 rounded">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
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
                                    <button @click="filterByCarStatus('Sedang test drive'); open = false"
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
                                    <button @click="filterByCarStatus('Perawatan'); open = false"
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

                    <th
                        class="px-4 py-3 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                        <div class="flex items-center justify-center">
                            <span>Status Approval</span>
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open"
                                    class="ml-2 p-1 hover:bg-gray-200 dark:hover:bg-gray-600 rounded">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
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
                                    <button @click="filterByApprovalStatus('pending'); open = false"
                                        class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                        :class="approvalStatusFilter === 'pending' ?
                                            'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                            'text-gray-900 dark:text-gray-100'">
                                        Menunggu
                                    </button>
                                    <button @click="filterByApprovalStatus('approved'); open = false"
                                        class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                        :class="approvalStatusFilter === 'approved' ?
                                            'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' :
                                            'text-gray-900 dark:text-gray-100'">
                                        Disetujui
                                    </button>
                                    <button @click="filterByApprovalStatus('not_approved'); open = false"
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

                    <th
                        class="px-4 py-3 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                <template x-for="(booking, index) in paginatedBookings" :key="booking.id">
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors h-20">
                        <td class="px-4 py-4">
                            <div>
                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100"
                                    x-text="booking.customer"></div>
                                <div class="text-xs text-gray-500 dark:text-gray-400" x-text="booking.phone"></div>
                            </div>
                        </td>

                        <td class="px-4 py-4">
                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100" x-text="booking.car">
                            </div>
                        </td>

                        <td class="px-4 py-4">
                            <div class="flex items-center text-sm text-gray-900 dark:text-gray-100">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span x-text="booking.date"></span>
                            </div>
                        </td>

                        <td class="px-4 py-4">
                            <div class="flex justify-center">
                                <template
                                    x-if="booking.status === 'Dikonfirmasi' || booking.status_mobil === 'Sedang test drive' || booking.status_mobil === 'Selesai' || booking.status_mobil === 'Perawatan'">
                                    <div class="relative" x-data="{ open: false }">
                                        <button @click="open = !open"
                                            class="inline-flex items-center justify-center gap-2 px-3 py-2 rounded-lg font-medium text-xs transition-all hover:shadow-md min-w-[140px]"
                                            :class="{
                                                'bg-blue-600 text-white hover:bg-blue-700': booking
                                                    .status === 'Dikonfirmasi',
                                                'bg-indigo-100 text-indigo-800 dark:bg-indigo-900/50 dark:text-indigo-200 hover:bg-indigo-200 dark:hover:bg-indigo-900': booking
                                                    .status_mobil === 'Sedang test drive',
                                                'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-200 hover:bg-green-200 dark:hover:bg-green-900': booking
                                                    .status_mobil === 'Selesai',
                                                'bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-200 hover:bg-red-200 dark:hover:bg-red-900': booking
                                                    .status_mobil === 'Perawatan'
                                            }">
                                            <span
                                                x-text="(booking.status_mobil === 'Sedang test drive' || booking.status_mobil === 'Selesai' || booking.status_mobil === 'Perawatan') ? booking.status_mobil : 'Ubah Status Mobil'"></span>
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>

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
                                                <div class="w-2.5 h-2.5 rounded-full bg-indigo-500">
                                                </div>
                                                <span class="font-medium">Sedang Test
                                                    Drive</span>
                                            </button>

                                            <button @click="updateCarStatus(booking, 'Selesai'); open = false"
                                                class="w-full px-4 py-3 text-left text-sm hover:bg-green-50 dark:hover:bg-green-900/20 transition flex items-center gap-3 text-gray-900 dark:text-gray-100">
                                                <div class="w-2.5 h-2.5 rounded-full bg-green-500">
                                                </div>
                                                <span class="font-medium">Selesai</span>
                                            </button>

                                            <button @click="updateCarStatus(booking, 'Perawatan'); open = false"
                                                class="w-full px-4 py-3 text-left text-sm hover:bg-red-50 dark:hover:bg-red-900/20 transition flex items-center gap-3 text-gray-900 dark:text-gray-100">
                                                <div class="w-2.5 h-2.5 rounded-full bg-red-500">
                                                </div>
                                                <span class="font-medium">Perawatan</span>
                                            </button>
                                        </div>
                                    </div>
                                </template>

                                <template
                                    x-if="booking.status === 'Menunggu' || booking.status === 'Diproses' || booking.status === 'Dibatalkan'">
                                    <span
                                        class="inline-flex items-center justify-center gap-2 px-3 py-2 rounded-lg font-medium text-xs min-w-[140px] bg-gray-400 dark:bg-gray-600 text-white">
                                        Belum bisa diakses
                                    </span>
                                </template>
                            </div>
                        </td>

                        <td class="px-4 py-4">
                            <div class="flex justify-center">
                                <span class="inline-flex items-center px-3 py-1.5 text-xs font-semibold rounded-full"
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

                        <td class="px-4 py-4">
                            <template x-if="booking.has_checksheet">
                                <div class="flex flex-col gap-2">
                                    <button @click="viewChecksheet(booking.checksheet_id)"
                                        class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-lg transition-all hover:shadow-md">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 03 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                        Lihat Checksheet
                                    </button>
                                    <a :href="`/checksheet/export?checksheet_id=${booking.checksheet_id}`"
                                        class="w-full inline-flex items-center justify-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-xs font-medium rounded-lg transition-all hover:shadow-md">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                        Export
                                    </a>
                                </div>
                            </template>

                            <template x-if="!booking.has_checksheet">
                                <div class="flex justify-center">
                                    <button
                                        x-show="['Dikonfirmasi', 'Sedang test drive', 'Selesai', 'Perawatan'].includes(booking.status)"
                                        @click="openChecksheetModal(booking)"
                                        class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-lg transition-all hover:shadow-md">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                        Isi Checksheet
                                    </button>

                                    <div x-show="booking.status === 'Menunggu'"
                                        class="inline-flex items-center px-4 py-2 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300 text-xs font-medium rounded-lg">
                                        <svg class="w-4 h-4 mr-1.5 animate-spin" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                            </path>
                                        </svg>
                                        <span>Menunggu SPV</span>
                                    </div>

                                    <div x-show="booking.status === 'Diproses'"
                                        class="inline-flex items-center px-4 py-2 bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 text-xs font-medium rounded-lg">
                                        <svg class="w-4 h-4 mr-1.5 animate-spin" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                            </path>
                                        </svg>
                                        <span>Menunggu BM</span>
                                    </div>

                                    <div x-show="booking.status === 'Dibatalkan'"
                                        class="inline-flex items-center px-4 py-2 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 text-xs font-medium rounded-lg">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        <span>Dibatalkan</span>
                                    </div>
                                </div>
                            </template>
                        </td>
                    </tr>
                </template>
                <template x-for="i in (itemsPerPage - paginatedBookings.length)" :key="'empty-' + i">
                    <tr class="h-20">
                        <td class="px-4 py-3" colspan="6">
                            <div class="h-full">&nbsp;</div>
                        </td>
                    </tr>
                </template>

            </tbody>
        </table>

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
                        <span class="font-medium" x-text="Math.min(endIndex, filteredBookings.length)"></span>
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

        <div x-show="filteredBookings.length === 0" class="text-center py-12">
            <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
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

    <div class="lg:hidden space-y-4">
        <template x-for="(booking, index) in paginatedBookings" :key="booking.id">
            <div
                class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-600 p-4 hover:shadow-lg transition-shadow">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-gray-900 dark:text-gray-100 truncate" x-text="booking.customer">
                        </h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400" x-text="booking.phone"></p>
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

                <div class="space-y-2 mb-4 text-sm">
                    <div class="flex items-center text-gray-700 dark:text-gray-300">
                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                        <span class="font-medium" x-text="booking.car"></span>
                    </div>
                    <div class="flex items-center text-gray-700 dark:text-gray-300">
                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span x-text="booking.date"></span>
                    </div>
                </div>

                <div class="mb-3">
                    <template
                        x-if="booking.status === 'Dikonfirmasi' || booking.status_mobil === 'Sedang test drive' || booking.status_mobil === 'Selesai' || booking.status_mobil === 'Perawatan'">
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="w-full inline-flex items-center justify-center gap-2 px-3 py-2 rounded-lg font-medium text-xs transition-all hover:shadow-md"
                                :class="{
                                    'bg-blue-600 text-white hover:bg-blue-700': booking
                                        .status === 'Dikonfirmasi',
                                    'bg-indigo-100 text-indigo-800 dark:bg-indigo-900/50 dark:text-indigo-200 hover:bg-indigo-200': booking
                                        .status_mobil === 'Sedang test drive',
                                    'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-200 hover:bg-green-200': booking
                                        .status_mobil === 'Selesai',
                                    'bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-200 hover:bg-red-200': booking
                                        .status_mobil === 'Perawatan'
                                }">
                                <span
                                    x-text="(booking.status_mobil === 'Sedang test drive' || booking.status_mobil === 'Selesai' || booking.status_mobil === 'Perawatan') ? booking.status_mobil : 'Ubah Status Mobil'"></span>
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div x-show="open" @click.away="open = false" x-transition
                                class="absolute z-50 mt-2 w-full bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-600 overflow-hidden"
                                style="display: none;">
                                <button @click="updateCarStatus(booking, 'Sedang test drive'); open = false"
                                    class="w-full px-4 py-3 text-left text-sm hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition flex items-center gap-3 text-gray-900 dark:text-gray-100">
                                    <div class="w-2.5 h-2.5 rounded-full bg-indigo-500"></div>
                                    <span class="font-medium">Sedang Test Drive</span>
                                </button>
                                <button @click="updateCarStatus(booking, 'Selesai'); open = false"
                                    class="w-full px-4 py-3 text-left text-sm hover:bg-green-50 dark:hover:bg-green-900/20 transition flex items-center gap-3 text-gray-900 dark:text-gray-100">
                                    <div class="w-2.5 h-2.5 rounded-full bg-green-500"></div>
                                    <span class="font-medium">Selesai</span>
                                </button>
                                <button @click="updateCarStatus(booking, 'Perawatan'); open = false"
                                    class="w-full px-4 py-3 text-left text-sm hover:bg-red-50 dark:hover:bg-red-900/20 transition flex items-center gap-3 text-gray-900 dark:text-gray-100">
                                    <div class="w-2.5 h-2.5 rounded-full bg-red-500"></div>
                                    <span class="font-medium">Perawatan</span>
                                </button>
                            </div>
                        </div>
                    </template>

                    <template
                        x-if="booking.status === 'Menunggu' || booking.status === 'Diproses' || booking.status === 'Dibatalkan'">
                        <span
                            class="w-full inline-flex items-center justify-center gap-2 px-3 py-2 rounded-lg font-medium text-xs bg-gray-400 dark:bg-gray-600 text-white">
                            Belum bisa diakses
                        </span>
                    </template>
                </div>

                <template x-if="booking.has_checksheet">
                    <div class="flex gap-2">
                        <button @click="viewChecksheet(booking.checksheet_id)"
                            class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-lg transition">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                </path>
                            </svg>
                            Lihat
                        </button>
                        <a :href="`/checksheet/export?checksheet_id=${booking.checksheet_id}`"
                            class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-xs font-medium rounded-lg transition">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Export
                        </a>
                    </div>
                </template>

                <template x-if="!booking.has_checksheet">
                    <div class="flex justify-center">
                        <button
                            x-show="['Dikonfirmasi', 'Sedang test drive', 'Selesai', 'Perawatan'].includes(booking.status)"
                            @click="openChecksheetModal(booking)"
                            class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-lg transition-all hover:shadow-md">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                            Isi Checksheet
                        </button>

                        <div x-show="booking.status === 'Menunggu'"
                            class="inline-flex items-center px-4 py-2 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300 text-xs font-medium rounded-lg">
                            <svg class="w-4 h-4 mr-1.5 animate-spin" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                </path>
                            </svg>
                            <span>Menunggu SPV</span>
                        </div>

                        <div x-show="booking.status === 'Diproses'"
                            class="inline-flex items-center px-4 py-2 bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 text-xs font-medium rounded-lg">
                            <svg class="w-4 h-4 mr-1.5 animate-spin" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                </path>
                            </svg>
                            <span>Menunggu BM</span>
                        </div>

                        <div x-show="booking.status === 'Dibatalkan'"
                            class="inline-flex items-center px-4 py-2 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 text-xs font-medium rounded-lg">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            <span>Dibatalkan</span>
                        </div>
                    </div>
                </template>
            </div>
        </template>

        <div x-show="filteredBookings.length === 0" class="text-center py-12">
            <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                </path>
            </svg>
            <p class="text-gray-500 dark:text-gray-400 text-lg font-medium">Tidak ada booking
            </p>
            <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Coba kata kunci lain atau
                ubah filter</p>
        </div>

        <div x-show="filteredBookings.length > 0"
            class="bg-white dark:bg-gray-800 p-4 rounded-lg border border-gray-200 dark:border-gray-600">
            <div class="flex flex-col space-y-3">
                <div class="text-center">
                    <p class="text-sm text-gray-700 dark:text-gray-300">
                        Page <span class="font-medium" x-text="currentPage"></span> of <span class="font-medium"
                            x-text="totalPages"></span>
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
