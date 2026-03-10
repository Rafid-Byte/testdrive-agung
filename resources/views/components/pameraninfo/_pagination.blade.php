<div
    class="px-4 lg:px-6 py-3 bg-gray-50 dark:bg-gray-700/50 border-t border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row items-center justify-between gap-3">

    {{-- Info: Menampilkan X-Y dari Z --}}
    <p class="text-sm text-gray-600 dark:text-gray-400 order-2 sm:order-1">
        Menampilkan
        <span class="font-semibold text-gray-900 dark:text-white" x-text="((currentPage - 1) * itemsPerPage) + 1"></span>
        –
        <span class="font-semibold text-gray-900 dark:text-white"
            x-text="Math.min(currentPage * itemsPerPage, bookings.length)"></span>
        dari
        <span class="font-semibold text-gray-900 dark:text-white" x-text="bookings.length"></span>
        booking
    </p>

    {{-- Tombol navigasi --}}
    <div class="flex items-center gap-1 order-1 sm:order-2">

        {{-- Prev --}}
        <button @click="prevPage()" :disabled="currentPage === 1"
            :class="currentPage === 1 ?
                'text-gray-300 dark:text-gray-600 cursor-not-allowed' :
                'text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-600 cursor-pointer'"
            class="p-2 rounded-lg transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>

        {{-- Page numbers --}}
        <template x-for="page in pageNumbers" :key="'page-' + page">
            <button @click="page !== '...' ? goToPage(page) : null"
                :class="{
                    'bg-blue-600 text-white shadow-sm': page === currentPage,
                    'text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-600': page !== currentPage &&
                        page !== '...',
                    'text-gray-400 dark:text-gray-500 cursor-default': page === '...'
                }"
                class="min-w-[2rem] h-8 px-2 rounded-lg text-sm font-medium transition-colors" x-text="page">
            </button>
        </template>

        {{-- Next --}}
        <button @click="nextPage()" :disabled="currentPage === totalPages"
            :class="currentPage === totalPages ?
                'text-gray-300 dark:text-gray-600 cursor-not-allowed' :
                'text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-600 cursor-pointer'"
            class="p-2 rounded-lg transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
    </div>
</div>
