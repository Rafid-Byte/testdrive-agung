<div x-show="showStatusModal" x-cloak
    class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
    @click.self="showStatusModal = false">
    <div class="bg-white dark:bg-gray-800 rounded-xl max-w-md w-full shadow-2xl" @click.stop>
        <div class="px-4 lg:px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg lg:text-xl font-bold text-gray-900 dark:text-white">Update Status Mobil</h3>
        </div>
        <div class="p-4 lg:p-6">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status
                    Baru</label>
                <select x-model="newStatus"
                    class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white text-sm lg:text-base">
                    <option value="Sedang Pameran">Sedang Pameran</option>
                    <option value="Perawatan">Perawatan</option>
                    <option value="Selesai">Selesai</option>
                </select>
            </div>
            <div class="flex space-x-3">
                <button @click="showStatusModal = false"
                    class="flex-1 px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium transition-colors text-sm lg:text-base">
                    Batal
                </button>
                <button @click="updateStatus()"
                    class="flex-1 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors text-sm lg:text-base">
                    Update Status
                </button>
            </div>
        </div>
    </div>
</div>
