<div
                            class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-200 dark:border-gray-600 shadow-lg mb-8">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Management Booking
                                </h2>

                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
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

                            <div x-show="managementSPVFilter || managementSPVSort || managementStatusFilter || managementStatusSort"
                                class="mb-4 p-3 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="text-xs font-semibold text-blue-700 dark:text-blue-300">Filter
                                        Aktif:</span>

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
                                                <td class="px-4 py-3">
                                                    <span
                                                        class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                                        Test Drive
                                                    </span>
                                                </td>

                                                <td class="px-4 py-3">
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
                                                        class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition">
                                                        Ubah Status
                                                    </button>
                                                </td>
                                            </tr>
                                        </template>
                                        <template
                                            x-for="i in (managementItemsPerPage - paginatedManagementBookings.length)"
                                            :key="'empty-' + i">
                                            <tr class="h-20" x-show="managementBookingsByType.length > 0">
                                                <td class="px-4 py-3" colspan="5">
                                                    <div class="h-full">&nbsp;</div>
                                                </td>
                                            </tr>
                                        </template>
                                        <tr x-show="managementBookingsByType.length === 0">
                                            <td colspan="5" class="px-4 py-16 text-center">
                                                <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                                <p class="text-gray-500 dark:text-gray-400 text-lg">Belum ada booking</p>
                                                <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Booking test drive akan muncul di sini</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div x-show="managementViewType === 'test_drive'" class="lg:hidden space-y-3">
                                <template x-for="booking in paginatedManagementBookings" :key="booking.id">
                                    <div
                                        class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg border border-gray-200 dark:border-gray-600">
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
                                                                    @click="filterManagementByStatus(managementViewType === 'pameran' ? 'Sedang Pameran' : 'Sedang test drive'); open = false"
                                                                    class="w-full px-4 py-2 text-left text-sm hover:bg-gray-100 dark:hover:bg-gray-700"
                                                                    :class="(managementViewType === 'pameran' &&
                                                                        managementStatusFilter === 'Sedang Pameran') ||
                                                                    (managementViewType === 'test_drive' &&
                                                                        managementStatusFilter === 'Sedang test drive'
                                                                        ) ?
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
                                                        class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition">
                                                        Ubah Status
                                                    </button>
                                                </td>
                                            </tr>
                                        </template>
                                        <template
                                            x-for="i in (managementItemsPerPage - paginatedManagementBookings.length)"
                                            :key="'empty-' + i">
                                            <tr class="h-20" x-show="managementBookingsByType.length > 0">
                                                <td class="px-4 py-3" colspan="6">
                                                    <div class="h-full">&nbsp;</div>
                                                </td>
                                            </tr>
                                        </template>
                                        <tr x-show="managementBookingsByType.length === 0">
                                            <td colspan="6" class="px-4 py-16 text-center">
                                                <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                                <p class="text-gray-500 dark:text-gray-400 text-lg">Belum ada booking</p>
                                                <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Booking pameran/movex akan muncul di sini</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div x-show="managementViewType === 'pameran'" class="lg:hidden space-y-3">
                                <template x-for="booking in paginatedManagementBookings" :key="booking.id">
                                    <div
                                        class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg border border-gray-200 dark:border-gray-600">
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

                                        <div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">Tanggal Booking:
                                            </div>
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100"
                                                x-text="booking.date"></div>
                                        </div>

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
                        </div>