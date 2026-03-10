<div class="mt-8 bg-gray-50 dark:bg-gray-700 p-6 rounded-xl shadow-lg border border-gray-200 dark:border-gray-600">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">History Checksheet
        </h3>
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
            <div class="relative flex-1 sm:flex-initial sm:w-64">
                <input x-model="historySearchQuery" type="text" placeholder="Cari checksheet..."
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 text-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

    <div class="hidden lg:block overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-600">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-100 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-600">
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase">
                        Customer</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase">
                        Mobil</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase">
                        Tanggal</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase">
                        Jam</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase">
                        Supervisor</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase">
                        Diisi Oleh</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase">
                        Status</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase">
                        Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                <template x-for="checksheet in paginatedHistory" :key="checksheet.id">
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-600 transition">
                        <td class="px-4 py-3">
                            <div class="font-medium text-gray-900 dark:text-gray-100" x-text="checksheet.customer">
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <div class="text-sm text-gray-900 dark:text-gray-100" x-text="checksheet.car"></div>
                        </td>
                        <td class="px-4 py-3">
                            <div class="text-sm text-gray-900 dark:text-gray-100" x-text="checksheet.date"></div>
                        </td>
                        <td class="px-4 py-3">
                            <div class="text-xs text-gray-600 dark:text-gray-300">
                                <span x-text="checksheet.jam_pinjam"></span> - <span
                                    x-text="checksheet.jam_kembali"></span>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <div class="text-xs text-gray-600 dark:text-gray-300">
                                <div><span class="font-medium">SPV:</span> <span x-text="checksheet.spv"></span></div>
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
                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor"
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
                                <a :href="`/checksheet/export?checksheet_id=${checksheet.id}`"
                                    class="inline-flex items-center px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white text-xs font-medium rounded-lg transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
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

    <div x-show="filteredHistory.length > 0"
        class="hidden lg:block bg-gray-50 dark:bg-gray-700 px-4 py-3 border-t border-gray-200 dark:border-gray-600 rounded-b-lg">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-700 dark:text-gray-300">
                    Showing
                    <span class="font-medium" x-text="historyStartIndex + 1"></span>
                    to
                    <span class="font-medium" x-text="Math.min(historyEndIndex, filteredHistory.length)"></span>
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

                    <button @click="nextHistoryPage()" :disabled="historyCurrentPage === historyTotalPages"
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

    <div class="lg:hidden space-y-3">
        <template x-for="checksheet in paginatedHistory" :key="checksheet.id">
            <div
                class="bg-white dark:bg-gray-800 p-4 rounded-lg border border-gray-200 dark:border-gray-600 hover:shadow-md transition">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex-1 min-w-0">
                        <h4 class="font-semibold text-gray-900 dark:text-gray-100 truncate"
                            x-text="checksheet.customer"></h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5" x-text="checksheet.car"></p>
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
                            <div class="font-semibold text-gray-900 dark:text-gray-100" x-text="checksheet.filled_by">
                            </div>
                            <div class="text-[10px] text-gray-500 dark:text-gray-400"
                                x-text="checksheet.filled_by_email"></div>
                        </div>
                    </div>
                </div>

                <div class="flex gap-2">
                    <button @click="viewChecksheet(checksheet.id)"
                        class="flex-1 px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition flex items-center justify-center">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                            </path>
                        </svg>
                        Detail
                    </button>
                    <a :href="`/checksheet/export?checksheet_id=${checksheet.id}`"
                        class="px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </template>
    </div>

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
                <button @click="nextHistoryPage()" :disabled="historyCurrentPage === historyTotalPages"
                    class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-lg text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed transition">
                    Next →
                </button>
            </div>
        </div>
    </div>

    <div x-show="filteredHistory.length === 0 && historySearchQuery.length > 0" class="text-center py-12">
        <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
        <p class="text-gray-500 dark:text-gray-400 text-lg">Tidak ditemukan checksheet</p>
        <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Coba kata kunci lain</p>
    </div>

    <div x-show="checksheetHistory.length === 0" class="text-center py-12">
        <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
            </path>
        </svg>
        <p class="text-gray-500 dark:text-gray-400 text-lg">Belum ada history checksheet</p>
        <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Checksheet akan muncul setelah
            dibuat</p>
    </div>
</div>
