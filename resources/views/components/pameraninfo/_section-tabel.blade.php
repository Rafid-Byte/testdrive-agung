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
                    </tbody>
                </table>
            </div>
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
        </div>
    </div>
</div>
