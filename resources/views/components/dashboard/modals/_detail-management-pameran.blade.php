<div x-show="managementDetailModal && selectedManagementBooking?.booking_type === 'pameran'"
                            x-cloak
                            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 p-4">
                            <div @click.away="managementDetailModal=false; selectedManagementBooking=null"
                                class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] overflow-hidden flex flex-col">

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

                                <div x-show="selectedManagementBooking" class="overflow-y-auto flex-1 p-6">
                                    <div class="space-y-6">
                                        <div>
                                            <label
                                                class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Nama
                                                PIC</label>
                                            <div class="text-base font-semibold text-gray-900 dark:text-white"
                                                x-text="selectedManagementBooking?.customer"></div>
                                        </div>

                                        <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                            <label
                                                class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Mobil</label>
                                            <div class="text-base font-semibold text-gray-900 dark:text-white"
                                                x-text="selectedManagementBooking?.car"></div>
                                        </div>

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

                                        <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                            <label
                                                class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Target
                                                Prospect</label>
                                            <div class="text-sm text-gray-900 dark:text-white"
                                                x-text="selectedManagementBooking?.address || '-'"></div>
                                        </div>

                                        <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                            <label
                                                class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Lokasi
                                                Acara</label>
                                            <div class="text-sm text-gray-900 dark:text-white"
                                                x-text="selectedManagementBooking?.event_location || '-'"></div>
                                        </div>

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

                                <div
                                    class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                                    <button @click="managementDetailModal=false; selectedManagementBooking=null"
                                        class="w-full px-4 py-2 bg-gray-800 hover:bg-gray-900 dark:bg-gray-700 dark:hover:bg-gray-600 text-white font-medium rounded-lg transition">
                                        Tutup
                                    </button>
                                </div>
                            </div>
                        </div>