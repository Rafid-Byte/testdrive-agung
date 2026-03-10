<div
                            class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-200 dark:border-gray-600 shadow-lg mb-8">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Data Booking
                                </h2>

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
                                                class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase w-40">
                                                Mobil</th>
                                            <th
                                                class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase w-40">
                                                Tanggal booking</th>
                                            <th
                                                class="px-4 py-3 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase w-48">
                                                Data Customer</th>
                                            <th
                                                class="px-4 py-3 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase w-48">
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

                                                <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100"
                                                    x-text="booking.car"></td>

                                                <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100"
                                                    x-text="booking.date"></td>

                                                <td class="px-4 py-3 text-center">
                                                    <button @click="openCustomerDetailFromBooking(booking)"
                                                        class="px-4 py-2 bg-gray-800 hover:bg-gray-900 dark:bg-gray-700 dark:hover:bg-gray-600 text-white text-sm font-medium rounded-lg transition">
                                                        Detail Customer
                                                    </button>
                                                </td>

                                                <td class="px-4 py-3 text-center">
                                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100"
                                                        x-text="booking.test_drive_time || '-'"></div>
                                                </td>

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

                            <div x-show="bookingViewType === 'test_drive'" class="lg:hidden space-y-3">
                                <template x-for="booking in paginatedBookingData" :key="booking.id">
                                    <div
                                        class="bg-white dark:bg-gray-800 p-4 rounded-lg border border-gray-200 dark:border-gray-600 hover:shadow-md transition">
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

                                        <button @click="openCustomerDetailFromBooking(booking)"
                                            class="w-full px-3 py-2 bg-gray-800 hover:bg-gray-900 text-white text-sm font-medium rounded-lg transition">
                                            Detail Customer
                                        </button>
                                    </div>
                            </div>
                            </template>
                        </div>

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
                                            <td class="px-4 py-3">
                                                <div class="font-medium text-gray-900 dark:text-gray-100 text-sm"
                                                    x-text="booking.customer"></div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400"
                                                    x-text="booking.phone"></div>
                                            </td>

                                            <td x-show="'{{ auth()->user()->role }}' !== 'spv'" class="px-4 py-3">
                                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100"
                                                    x-text="booking.spv || '-'"></div>
                                            </td>

                                            <td class="px-4 py-3">
                                                <div class="text-sm text-gray-900 dark:text-gray-100"
                                                    x-text="booking.car"></div>
                                            </td>

                                            <td class="px-4 py-3">
                                                <div class="text-sm text-gray-900 dark:text-gray-100"
                                                    x-text="booking.date"></div>
                                            </td>

                                            <td class="px-4 py-3">
                                                <div class="text-sm text-gray-900 dark:text-gray-100"
                                                    x-text="booking.event_date || '-'"></div>
                                            </td>

                                            <td class="px-4 py-3">
                                                <div class="text-sm text-gray-900 dark:text-gray-100"
                                                    x-text="booking.start_date || '-'"></div>
                                            </td>

                                            <td class="px-4 py-3">
                                                <div class="text-sm text-gray-900 dark:text-gray-100"
                                                    x-text="booking.end_date || '-'"></div>
                                            </td>

                                            <td class="px-4 py-3">
                                                <div class="text-sm text-gray-900 dark:text-gray-100 truncate max-w-xs"
                                                    x-text="booking.target_prospect || booking.address || '-'"></div>
                                            </td>

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
                                            <button @click="prevBookingPage()" :disabled="bookingCurrentPage === 1"
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

                        <div x-show="bookingViewType === 'pameran'" class="lg:hidden space-y-3">
                            <template x-for="booking in paginatedBookingData" :key="booking.id">
                                <div
                                    class="bg-white dark:bg-gray-800 p-4 rounded-lg border border-gray-200 dark:border-gray-600 hover:shadow-md transition">
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
                                            <span class="line-clamp-2" x-text="booking.target_prospect || booking.address || '-'"></span>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>

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