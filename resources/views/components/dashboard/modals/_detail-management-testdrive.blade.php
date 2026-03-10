<div x-show="managementDetailModal && selectedManagementBooking?.booking_type === 'test_drive'" x-cloak
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 p-4">
    <div @click.away="managementDetailModal=false; selectedManagementBooking=null"
        class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] overflow-hidden flex flex-col">

        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Detail Booking Test
                Drive</h3>
            <button @click="managementDetailModal=false; selectedManagementBooking=null"
                class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        <div x-show="selectedManagementBooking" class="overflow-y-auto flex-1 p-6">
            <div class="space-y-6">
                <div>
                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Mobil</label>
                    <div class="text-base font-semibold text-gray-900 dark:text-white"
                        x-text="selectedManagementBooking?.car"></div>
                </div>

                <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                    <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">
                        Informasi Sales</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Nama
                                Sales</label>
                            <div class="text-sm text-gray-900 dark:text-white"
                                x-text="selectedManagementBooking?.sales_name || '-'"></div>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">No.
                                HP Sales</label>
                            <div class="text-sm text-gray-900 dark:text-white"
                                x-text="selectedManagementBooking?.sales_phone || '-'"></div>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                    <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Data
                        Customer</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Nama
                                Lengkap</label>
                            <div class="text-sm text-gray-900 dark:text-white"
                                x-text="selectedManagementBooking?.customer"></div>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">No.
                                HP</label>
                            <div class="text-sm text-gray-900 dark:text-white"
                                x-text="selectedManagementBooking?.phone"></div>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Email</label>
                            <div class="text-sm text-gray-900 dark:text-white truncate"
                                x-text="selectedManagementBooking?.email"></div>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">No.
                                KTP</label>
                            <div class="text-sm text-gray-900 dark:text-white font-mono"
                                x-text="selectedManagementBooking?.ktp"></div>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                    <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Detail
                        Test Drive</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Tanggal
                                Booking</label>
                            <div class="text-sm text-gray-900 dark:text-white" x-text="selectedManagementBooking?.date">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Jam
                                Test Drive</label>
                            <div class="text-sm text-gray-900 dark:text-white"
                                x-text="selectedManagementBooking?.test_drive_time || '-'">
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Lokasi
                                Test Drive</label>
                            <div class="text-sm text-gray-900 dark:text-white"
                                x-text="selectedManagementBooking?.test_drive_location || '-'">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
            <button @click="managementDetailModal=false; selectedManagementBooking=null"
                class="w-full px-4 py-2 bg-gray-800 hover:bg-gray-900 dark:bg-gray-700 dark:hover:bg-gray-600 text-white font-medium rounded-lg transition">
                Tutup
            </button>
        </div>
    </div>
</div>
