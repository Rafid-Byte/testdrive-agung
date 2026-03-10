<div x-show="showUnitModal" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" @click.self="showUnitModal = false"
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[70] p-4" style="display: none;">

    <div x-show="showUnitModal" x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        class="bg-white rounded-2xl w-full max-w-2xl max-h-[90vh] overflow-hidden shadow-2xl">

        <div class="bg-gray-900 text-white px-6 py-5 flex items-center justify-between"
            style="background-color: #111827 !important;">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center backdrop-blur-sm">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-xl">Status Unit</h3>
                    <p class="text-xs text-gray-300 mt-0.5">Update realtime ketersediaan mobil</p>
                </div>
            </div>
            <button @click="showUnitModal = false"
                class="w-10 h-10 rounded-lg bg-white/10 hover:bg-white/20 flex items-center justify-center transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="p-6 max-h-[calc(90vh-140px)] overflow-y-auto">
            <div class="space-y-3">
                <template x-for="(info, carName) in availableUnits" :key="carName">
                    <div class="group relative overflow-hidden rounded-xl border-2 transition-all duration-300 hover:shadow-lg"
                        :class="{
                            'border-green-300 bg-gradient-to-br from-green-50 to-emerald-50 hover:border-green-400': info
                                .status_code === 'available',
                            'border-red-300 bg-gradient-to-br from-red-50 to-rose-50 hover:border-red-400': info
                                .status_code === 'unavailable',
                            'border-yellow-300 bg-gradient-to-br from-yellow-50 to-amber-50 hover:border-yellow-400': info
                                .status_code === 'booked',
                            'border-purple-300 bg-gradient-to-br from-purple-50 to-violet-50 hover:border-purple-400': info
                                .status_code === 'in_use',
                            'border-orange-300 bg-gradient-to-br from-orange-50 to-amber-50 hover:border-orange-400': info
                                .status_code === 'maintenance'
                        }">

                        <div class="p-4 flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="relative flex items-center justify-center">
                                    <div class="w-4 h-4 rounded-full"
                                        :class="{
                                            'bg-green-500': info.status_code === 'available',
                                            'bg-red-500': info.status_code === 'unavailable',
                                            'bg-yellow-500': info.status_code === 'booked',
                                            'bg-purple-500': info.status_code === 'in_use',
                                            'bg-orange-500': info.status_code === 'maintenance'
                                        }">
                                    </div>
                                    <div class="absolute inset-0 w-4 h-4 rounded-full animate-ping opacity-75"
                                        :class="{
                                            'bg-green-400': info.status_code === 'available',
                                            'bg-red-400': info.status_code === 'unavailable',
                                            'bg-yellow-400': info.status_code === 'booked',
                                            'bg-purple-400': info.status_code === 'in_use',
                                            'bg-orange-400': info.status_code === 'maintenance'
                                        }"
                                        style="animation-duration: 2s;"></div>
                                </div>

                                <div class="w-10 h-10 rounded-lg flex items-center justify-center"
                                    :class="{
                                        'bg-green-100': info.status_code === 'available',
                                        'bg-red-100': info.status_code === 'unavailable',
                                        'bg-yellow-100': info.status_code === 'booked',
                                        'bg-purple-100': info.status_code === 'in_use',
                                        'bg-orange-100': info.status_code === 'maintenance'
                                    }">
                                    <svg class="w-6 h-6"
                                        :class="{
                                            'text-green-600': info.status_code === 'available',
                                            'text-red-600': info.status_code === 'unavailable',
                                            'text-yellow-600': info.status_code === 'booked',
                                            'text-purple-600': info.status_code === 'in_use',
                                            'text-orange-600': info.status_code === 'maintenance'
                                        }"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z" />
                                    </svg>
                                </div>

                                <div>
                                    <p class="font-bold text-gray-900" x-text="carName"></p>
                                    <p class="text-xs text-gray-500 mt-0.5">
                                        <span x-show="info.status_code === 'available'">Booking Tersedia</span>
                                        <span
                                            x-show="info.status_code === 'booked' && info.booking_type === 'test_drive'">Menunggu
                                            approval booking</span>
                                        <span x-show="info.status_code === 'booked' && info.booking_type === 'pameran'">
                                            Menunggu approval booking</span>
                                        <span x-show="info.status_code === 'unavailable'">Tidak dapat
                                            dibooking</span>
                                        <span
                                            x-show="info.status_code === 'in_use' && info.booking_type === 'test_drive'">
                                            Sedang digunakan untuk test drive</span>
                                        <span x-show="info.status_code === 'in_use' && info.booking_type === 'pameran'">
                                            Sedang digunakan untuk pameran</span>
                                        <span x-show="info.status_code === 'maintenance'">Dalam perawatan</span>
                                    </p>
                                </div>
                            </div>

                            <span class="px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider shadow-md"
                                :class="{
                                    'bg-green-600 text-white': info.status_code === 'available',
                                    'bg-red-600 text-white': info.status_code === 'unavailable',
                                    'bg-yellow-600 text-white': info.status_code === 'booked',
                                    'bg-purple-600 text-white': info.status_code === 'in_use',
                                    'bg-orange-600 text-white': info.status_code === 'maintenance'
                                }"
                                x-text="info.status"></span>
                        </div>

                        <div class="absolute bottom-0 left-0 right-0 h-1 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"
                            :class="{
                                'bg-gradient-to-r from-green-400 to-emerald-500': info.status_code === 'available',
                                'bg-gradient-to-r from-red-400 to-rose-500': info.status_code === 'unavailable',
                                'bg-gradient-to-r from-yellow-400 to-amber-500': info.status_code === 'booked',
                                'bg-gradient-to-r from-purple-400 to-violet-500': info.status_code === 'in_use',
                                'bg-gradient-to-r from-orange-400 to-amber-500': info.status_code === 'maintenance'
                            }">
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex items-center justify-between">
            <div class="flex items-center gap-2 text-sm text-gray-600">
                <svg class="w-4 h-4 text-gray-400 animate-spin" style="animation-duration: 3s;" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                <span class="font-medium">Last updated:</span>
                <span class="text-gray-900 font-semibold">Just now</span>
            </div>
            <button @click="showUnitModal = false"
                class="px-6 py-2 bg-gray-800 hover:bg-gray-900 text-white font-semibold rounded-lg transition">
                Tutup
            </button>
        </div>
    </div>
</div>
