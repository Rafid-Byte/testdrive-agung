<div x-show="deleteChecksheetModal" x-cloak
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 p-4">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-md">
        <div class="p-6 border-b border-gray-200 dark:border-gray-600">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Konfirmasi
                    Hapus Checksheet</h3>
                <button @click="deleteChecksheetModal=false; checksheetToDelete=null"
                    class="text-gray-500 hover:text-red-500 text-xl font-bold">×</button>
            </div>
        </div>

        <div class="p-6">
            <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4 mb-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-sm font-medium text-red-800 dark:text-red-200">
                            Peringatan!
                        </h4>
                        <div class="mt-2 text-sm text-red-700 dark:text-red-300">
                            <p>Anda akan menghapus checksheet ini.</p>
                            <p class="mt-2 font-medium">Tindakan ini tidak dapat dibatalkan!
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex space-x-3">
                <button @click="deleteChecksheet()"
                    class="flex-1 px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition">
                    Ya, Hapus Checksheet
                </button>
                <button @click="deleteChecksheetModal=false; checksheetToDelete=null"
                    class="flex-1 px-4 py-2 bg-gray-300 hover:bg-gray-400 dark:bg-gray-600 dark:hover:bg-gray-500 text-gray-700 dark:text-gray-200 font-medium rounded-lg transition">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>
