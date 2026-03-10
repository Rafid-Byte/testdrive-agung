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
                    <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Informasi
                        Sales</h4>
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
                                x-text="selectedManagementBooking?.test_drive_time || '-'"></div>
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

<div x-show="managementDetailModal && selectedManagementBooking?.booking_type === 'pameran'" x-cloak
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 p-4">
    <div @click.away="managementDetailModal=false; selectedManagementBooking=null"
        class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] overflow-hidden flex flex-col">

        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Detail Booking
                Pameran/Movex</h3>
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
                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Nama
                        PIC</label>
                    <div class="text-base font-semibold text-gray-900 dark:text-white"
                        x-text="selectedManagementBooking?.customer"></div>
                </div>

                <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Mobil</label>
                    <div class="text-base font-semibold text-gray-900 dark:text-white"
                        x-text="selectedManagementBooking?.car"></div>
                </div>

                <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Tanggal
                                Booking</label>
                            <div class="text-sm text-gray-900 dark:text-white" x-text="selectedManagementBooking?.date">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Tanggal
                                Acara</label>
                            <div class="text-sm text-gray-900 dark:text-white"
                                x-text="selectedManagementBooking?.event_date || '-'"></div>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Tanggal
                        Mulai</label>
                    <div class="text-sm text-gray-900 dark:text-white"
                        x-text="selectedManagementBooking?.start_date || '-'"></div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Tanggal
                        Selesai</label>
                    <div class="text-sm text-gray-900 dark:text-white"
                        x-text="selectedManagementBooking?.end_date || '-'"></div>
                </div>

                <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Target
                        Prospect</label>
                    <div class="text-sm text-gray-900 dark:text-white"
                        x-text="selectedManagementBooking?.address || '-'"></div>
                </div>

                <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Lokasi
                        Acara</label>
                    <div class="text-sm text-gray-900 dark:text-white"
                        x-text="selectedManagementBooking?.event_location || '-'"></div>
                </div>

                <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Status
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

        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
            <button @click="managementDetailModal=false; selectedManagementBooking=null"
                class="w-full px-4 py-2 bg-gray-800 hover:bg-gray-900 dark:bg-gray-700 dark:hover:bg-gray-600 text-white font-medium rounded-lg transition">
                Tutup
            </button>
        </div>
    </div>
</div>
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
                        <p><span class="font-medium">Customer:</span> <span x-text="selectedBooking?.customer"></span>
                        </p>
                        <p><span class="font-medium">Mobil:</span> <span x-text="selectedBooking?.car"></span></p>
                        <p><span class="font-medium">Tanggal:</span> <span x-text="selectedBooking?.date"></span></p>
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
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status
                        Booking</label>

                    <select x-model="newStatus"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">

                        <template x-if="'{{ auth()->user()->role }}' === 'admin'">
                            <optgroup label="Pilih Status">
                                <option value="Menunggu">Menunggu</option>
                                <option value="Diproses">Diproses</option>
                                <option value="Dikonfirmasi">Dikonfirmasi</option>
                                <option value="Sedang test drive"
                                    x-show="selectedBooking?.booking_type === 'test_drive'">
                                    Sedang test drive
                                </option>
                                <option value="Sedang Pameran" x-show="selectedBooking?.booking_type === 'pameran'">
                                    Sedang Pameran
                                </option>
                                <option value="Selesai">Selesai</option>
                                <option value="Perawatan">Perawatan</option>
                                <option value="Dibatalkan">Dibatalkan</option>
                            </optgroup>
                        </template>

                        <template x-if="'{{ auth()->user()->role }}' === 'spv'">
                            <optgroup label="Pilih Aksi">
                                <option value="Diproses">Approve (Diproses)</option>
                                <option value="Dibatalkan">Cancel (Dibatalkan)</option>
                            </optgroup>
                        </template>

                        <template x-if="'{{ auth()->user()->role }}' === 'branch_manager'">
                            <optgroup label="Pilih Aksi">
                                <option value="Dikonfirmasi">Approve (Dikonfirmasi)</option>
                                <option value="Dibatalkan">Disapprove/Cancel (Dibatalkan)
                                </option>
                            </optgroup>
                        </template>
                    </select>

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

<div x-show="customerDetailModal" x-cloak
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 p-4">
    <div @click.away="customerDetailModal=false"
        class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] overflow-hidden flex flex-col">

        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Detail Customer</h3>
            <button @click="customerDetailModal=false"
                class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        <div x-show="selectedCustomerDetail" class="overflow-y-auto flex-1 p-6 space-y-6">
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
                        <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Email</label>
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
                        <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Alamat</label>
                        <p class="text-sm text-gray-900 dark:text-white" x-text="selectedCustomerDetail?.address"></p>
                    </div>
                </div>
            </div>

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
                                    <p class="text-xs text-gray-600 dark:text-gray-400 truncate" x-text="booking.car">
                                    </p>
                                </div>
                                <span class="px-2 py-1 rounded text-xs font-semibold whitespace-nowrap flex-shrink-0"
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
                        <svg class="w-12 h-12 mx-auto mb-2 text-gray-400 dark:text-gray-600" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
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
                        <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">SPV</label>
                        <p class="text-sm text-gray-900 dark:text-white font-medium"
                            x-text="selectedCustomerDetail?.assignedSPV"></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
            <div class="flex gap-3">
                <button @click="openEditCustomer(selectedCustomerDetail?.name)"
                    class="flex-1 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition">
                    Edit Customer
                </button>
            </div>
        </div>
    </div>
</div>

<div x-show="editCustomerModal" x-cloak
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 p-4">
    <div @click.away="editCustomerModal=false; editingCustomer=null"
        class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] overflow-hidden flex flex-col">

        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Edit Customer</h3>
            <button @click="editCustomerModal=false; editingCustomer=null"
                class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        <div x-show="editingCustomer" class="overflow-y-auto flex-1 p-6">
            <div class="space-y-6">
                <div>
                    <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Informasi
                        Pribadi</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Nama
                                Lengkap</label>
                            <input x-model="editingCustomer.name" type="text"
                                class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 text-sm">
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">No.
                                KTP</label>
                            <input x-model="editingCustomer.ktp" type="text" maxlength="16"
                                class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 text-sm">
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">No.
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

                <div x-show="isAdmin()" class="pt-4 border-t border-gray-200 dark:border-gray-700">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">
                                <span class="flex items-center gap-2">
                                    SPV
                                </span>
                            </label>
                            <select x-model="editingCustomer.assignedSPV"
                                class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 text-sm">
                                <template x-for="spv in staffData.supervisors" :key="spv.name">
                                    <option :value="spv.name" x-text="spv.name"></option>
                                </template>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
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

<div x-show="checksheetSummaryModal" x-cloak
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 p-4">
    <div @click.away="checksheetSummaryModal=false; selectedChecksheetSummary=null"
        class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-hidden flex flex-col">
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        <div class="overflow-y-auto flex-1 p-6">
            <div x-show="!selectedChecksheetSummary || selectedChecksheetSummary.length === 0"
                class="text-center py-12">
                <svg class="w-16 h-16 mx-auto mb-4 text-gray-300 dark:text-gray-600" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
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

            <div x-show="selectedChecksheetSummary && selectedChecksheetSummary.length > 0" class="space-y-4">
                <template x-for="(summary, index) in selectedChecksheetSummary" :key="summary.checksheet_id">
                    <div class="border rounded-xl overflow-hidden"
                        :class="summary.status === 'good' ?
                            'border-green-300 dark:border-green-700 bg-green-50 dark:bg-green-900/20' :
                            'border-red-300 dark:border-red-700 bg-red-50 dark:bg-red-900/20'">
                        <div class="px-5 py-3 border-b"
                            :class="summary.status === 'good' ?
                                'bg-green-100 dark:bg-green-900/30 border-green-200 dark:border-green-800' :
                                'bg-red-100 dark:bg-red-900/30 border-red-200 dark:border-red-800'">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center justify-center w-10 h-10 rounded-full"
                                        :class="summary.status === 'good' ? 'bg-green-600' :
                                            'bg-red-600'">
                                        <svg x-show="summary.status === 'good'" class="w-6 h-6 text-white"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <svg x-show="summary.status === 'warning'" class="w-6 h-6 text-white"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900 dark:text-white" x-text="summary.car"></h4>
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

                        <div class="p-5 space-y-4">
                            <div class="flex items-center gap-4 text-sm">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-gray-600 dark:text-gray-300">
                                        Pinjam: <strong x-text="summary.jam_pinjam"></strong>
                                    </span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-gray-600 dark:text-gray-300">
                                        Kembali: <strong x-text="summary.jam_kembali"></strong>
                                    </span>
                                </div>
                            </div>

                            <div x-show="summary.fuel_changed"
                                class="bg-blue-50 dark:bg-blue-900/20 border-2 border-blue-300 dark:border-blue-700 rounded-lg p-3">
                                <h5
                                    class="text-xs font-bold text-blue-700 dark:text-blue-300 mb-2 flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                    PERUBAHAN BAHAN BAKAR:
                                </h5>
                                <div class="flex items-center gap-4 text-sm">
                                    <span class="text-gray-700 dark:text-gray-200">
                                        Saat Pinjam: <strong class="text-blue-600 dark:text-blue-400"
                                            x-text="summary.fuel_pinjam"></strong>
                                    </span>
                                    <span class="text-gray-500">-></span>
                                    <span class="text-gray-700 dark:text-gray-200">
                                        Saat Kembali: <strong class="text-blue-600 dark:text-blue-400"
                                            x-text="summary.fuel_kembali"></strong>
                                    </span>
                                </div>
                            </div>

                            <div x-show="summary.dokumen_issues && summary.dokumen_issues.length > 0"
                                class="bg-purple-50 dark:bg-purple-900/20 border-2 border-purple-300 dark:border-purple-700 rounded-lg p-3">
                                <h5
                                    class="text-xs font-bold text-purple-700 dark:text-purple-300 mb-2 flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    PERUBAHAN DOKUMEN & KUNCI:
                                </h5>
                                <div class="flex flex-wrap gap-2">
                                    <template x-for="issue in summary.dokumen_issues" :key="issue">
                                        <span
                                            class="px-3 py-1.5 bg-purple-600 text-white text-xs font-bold rounded-lg shadow-md"
                                            x-text="issue"></span>
                                    </template>
                                </div>
                            </div>

                            <div x-show="summary.kelengkapan_issues && summary.kelengkapan_issues.length > 0"
                                class="bg-indigo-50 dark:bg-indigo-900/20 border-2 border-indigo-300 dark:border-indigo-700 rounded-lg p-3">
                                <h5
                                    class="text-xs font-bold text-indigo-700 dark:text-indigo-300 mb-2 flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                    PERUBAHAN KELENGKAPAN TAMBAHAN:
                                </h5>
                                <div class="flex flex-wrap gap-2">
                                    <template x-for="issue in summary.kelengkapan_issues" :key="issue">
                                        <span
                                            class="px-3 py-1.5 bg-indigo-600 text-white text-xs font-bold rounded-lg shadow-md"
                                            x-text="issue"></span>
                                    </template>
                                </div>
                            </div>

                            <div x-show="summary.pinjam_issues && summary.pinjam_issues.length > 0">
                                <h5
                                    class="text-xs font-semibold text-gray-700 dark:text-gray-300 mb-2 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                        </path>
                                    </svg>
                                    Kondisi Tidak Baik Saat Dipinjam:
                                </h5>
                                <div class="flex flex-wrap gap-2">
                                    <template x-for="issue in summary.pinjam_issues" :key="issue">
                                        <span
                                            class="px-2 py-1 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300 text-xs rounded-lg"
                                            x-text="issue"></span>
                                    </template>
                                </div>
                            </div>

                            <div x-show="summary.kembali_issues && summary.kembali_issues.length > 0">
                                <h5
                                    class="text-xs font-semibold text-gray-700 dark:text-gray-300 mb-2 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                        </path>
                                    </svg>
                                    Kondisi Tidak Baik Saat Dikembalikan:
                                </h5>
                                <div class="flex flex-wrap gap-2">
                                    <template x-for="issue in summary.kembali_issues" :key="issue">
                                        <span
                                            class="px-2 py-1 bg-orange-100 dark:bg-orange-900/30 text-orange-800 dark:text-orange-300 text-xs rounded-lg"
                                            x-text="issue"></span>
                                    </template>
                                </div>
                            </div>

                            <div x-show="summary.changed_conditions && summary.changed_conditions.length > 0"
                                class="bg-white dark:bg-gray-900/50 border-2 border-red-300 dark:border-red-700 rounded-lg p-3">
                                <h5
                                    class="text-xs font-bold text-red-700 dark:text-red-300 mb-2 flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                        </path>
                                    </svg>
                                    PERUBAHAN KONDISI KENDARAAN (Baik -> Tidak Baik):
                                </h5>
                                <div class="flex flex-wrap gap-2">
                                    <template x-for="changed in summary.changed_conditions" :key="changed">
                                        <span
                                            class="px-3 py-1.5 bg-red-600 text-white text-xs font-bold rounded-lg shadow-md"
                                            x-text="changed"></span>
                                    </template>
                                </div>
                            </div>

                            <div x-show="summary.tanggal_penggantian_pewangi"
                                class="bg-pink-50 dark:bg-pink-900/20 border border-pink-200 dark:border-pink-800 rounded-lg p-3">
                                <h5
                                    class="text-xs font-semibold text-pink-700 dark:text-pink-300 mb-1 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Tanggal Penggantian Pewangi:
                                </h5>
                                <span class="text-sm font-bold text-pink-800 dark:text-pink-200"
                                    x-text="summary.tanggal_penggantian_pewangi"></span>
                            </div>

                            <div x-show="summary.status === 'good'"
                                class="bg-white dark:bg-gray-900/50 border-2 border-green-300 dark:border-green-700 rounded-lg p-3">
                                <div class="flex items-center gap-3">
                                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                        </path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-bold text-green-700 dark:text-green-300">
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

        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
            <button @click="checksheetSummaryModal=false; selectedChecksheetSummary=null"
                class="w-full px-4 py-2.5 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-xl transition">
                Tutup
            </button>
        </div>
    </div>
</div>
