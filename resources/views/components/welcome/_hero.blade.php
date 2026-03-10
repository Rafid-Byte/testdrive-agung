<section class="gradient-bg text-white py-16 md:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
                Test Drive Mobil Impian Anda
            </h1>
            <p class="text-lg md:text-xl text-gray-300 mb-8 max-w-2xl mx-auto">
                Rasakan pengalaman berkendara terbaik dengan jajaran kendaraan Toyota yang inovatif dan berkualitas
                tinggi.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="#vehicles" class="inline-block px-8 py-4 btn-primary text-white font-semibold rounded-lg">
                    Lihat Kendaraan
                </a>

                <div class="relative" x-data="{ showQuickAction: false }">
                    <button @click="showQuickAction = !showQuickAction"
                        class="inline-flex items-center px-8 py-4 bg-white text-red-600 font-semibold rounded-lg border-2 border-red-600 hover:bg-red-50 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        Quick Booking
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="showQuickAction" @click.away="showQuickAction = false"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        class="absolute top-full left-0 mt-2 w-64 bg-white rounded-lg shadow-xl z-50 overflow-hidden"
                        style="display: none;">

                        <button @click="openQuickBooking('test_drive'); showQuickAction = false"
                            class="w-full px-6 py-4 text-left hover:bg-gray-50 transition border-b border-gray-100 flex items-center">
                            <span class="text-2xl mr-3">🚘</span>
                            <div>
                                <p class="font-semibold text-gray-900">Booking Test Drive</p>
                                <p class="text-xs text-gray-500">Jadwalkan test drive langsung</p>
                            </div>
                        </button>

                        <button @click="openQuickBooking('pameran'); showQuickAction = false"
                            class="w-full px-6 py-4 text-left hover:bg-gray-50 transition flex items-center">
                            <span class="text-2xl mr-3">🏢</span>
                            <div>
                                <p class="font-semibold text-gray-900">Booking Pameran/Movex</p>
                                <p class="text-xs text-gray-500">Booking untuk acara pameran</p>
                            </div>
                        </button>
                    </div>
                </div>

                <button @click="showUnitModal = true"
                    class="inline-flex items-center px-8 py-4 bg-gray-800 text-white font-semibold rounded-lg border-2 border-gray-800 hover:bg-gray-700 hover:border-gray-700 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Info Unit Tersedia
                </button>
            </div>
        </div>
    </div>
</section>
