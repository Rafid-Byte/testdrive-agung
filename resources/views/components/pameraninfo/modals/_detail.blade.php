<div x-show="showDetailModal" x-cloak
            class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
            @click.self="showDetailModal = false">
            <div class="bg-white dark:bg-gray-800 rounded-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto shadow-2xl"
                @click.stop>
                <div
                    class="sticky top-0 bg-white dark:bg-gray-800 px-4 lg:px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                    <h3 class="text-lg lg:text-xl font-bold text-gray-900 dark:text-white">Detail Booking Pameran
                    </h3>
                    <button @click="showDetailModal = false"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-4 lg:p-6">
                    <template x-if="selectedBooking">
                        <div class="space-y-4">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Nama
                                        PIC</label>
                                    <p class="text-gray-900 dark:text-white font-medium"
                                        x-text="selectedBooking.nama_pic || '-'"></p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">No.
                                        Telepon</label>
                                    <p class="text-gray-900 dark:text-white"
                                        x-text="selectedBooking.nomor_telepon || '-'"></p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</label>
                                    <p class="text-gray-900 dark:text-white" x-text="selectedBooking.email || '-'">
                                    </p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Mobil</label>
                                    <p class="text-gray-900 dark:text-white" x-text="selectedBooking.mobil || '-'">
                                    </p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Target
                                        Prospect</label>
                                    <p class="text-gray-900 dark:text-white"
                                        x-text="selectedBooking.target_prospect || '-'"></p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Tanggal
                                        Acara</label>
                                    <p class="text-gray-900 dark:text-white"
                                        x-text="selectedBooking.tanggal_acara || '-'"></p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Tanggal
                                        Mulai</label>
                                    <p class="text-gray-900 dark:text-white"
                                        x-text="selectedBooking.tanggal_mulai || '-'"></p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Tanggal
                                        Selesai</label>
                                    <p class="text-gray-900 dark:text-white"
                                        x-text="selectedBooking.tanggal_selesai || '-'"></p>
                                </div>
                                <div class="col-span-1 lg:col-span-2">
                                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Lokasi
                                        Acara</label>
                                    <p class="text-gray-900 dark:text-white"
                                        x-text="selectedBooking.lokasi_acara || '-'"></p>
                                </div>
                                <div>
                                    <label
                                        class="text-sm font-medium text-gray-500 dark:text-gray-400">Supervisor</label>
                                    <p class="text-gray-900 dark:text-white"
                                        x-text="selectedBooking.supervisor_name || '-'"></p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</label>
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full"
                                        x-bind:class="{
                                            'bg-blue-100 text-blue-800': selectedBooking
                                                .status === 'Sedang Pameran',
                                            'bg-yellow-100 text-yellow-800': selectedBooking
                                                .status === 'Perawatan',
                                            'bg-green-100 text-green-800': selectedBooking.status === 'Selesai',
                                            'bg-indigo-100 text-indigo-800': selectedBooking
                                                .status === 'Dikonfirmasi',
                                            'bg-purple-100 text-purple-800': selectedBooking.status === 'Diproses'
                                        }"
                                        x-text="selectedBooking.status || '-'">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>