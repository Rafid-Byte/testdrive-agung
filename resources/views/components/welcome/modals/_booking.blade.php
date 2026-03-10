<div x-show="showModal" x-cloak class="fixed inset-0 z-[100] overflow-y-auto" style="display: none;">
    <div class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm transition-opacity" x-show="showModal"
        x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" @click="closeModal()"></div>

    <div class="flex min-h-full items-center justify-center p-4">
        <div class="relative bg-white rounded-xl w-full max-w-2xl max-h-[90vh] overflow-hidden flex flex-col shadow-2xl"
            x-show="showModal" x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" @click.stop>

            <div class="sticky top-0 z-10 bg-white border-b border-gray-200 px-6 py-4 rounded-t-xl">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Booking Form</h2>
                        <p class="text-sm text-gray-500">Lengkapi formulir di bawah ini</p>
                    </div>
                    <button @click="closeModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <div x-show="isAuthenticated && userRole !== 'sales' && userRole !== 'admin'"
                class="bg-yellow-50 dark:bg-yellow-900/20 border-l-4 border-yellow-400 p-4 mb-4">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-yellow-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <p class="text-sm text-yellow-700 dark:text-yellow-300">
                        ⚠️ <strong>Akses Terbatas!</strong> Anda login sebagai <strong
                            x-text="userRole.toUpperCase()"></strong>.
                        Hanya akun Sales yang dapat melakukan booking.
                    </p>
                </div>
            </div>

            <div class="overflow-y-auto" style="max-height: calc(90vh - 180px);">
                <form @submit.prevent="submitBooking" class="p-6 space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Pilih Kendaraan <span class="text-red-500">*</span>
                            <span x-show="isCarLocked" class="text-xs text-blue-600 ml-2">(Terkunci)</span>
                        </label>
                        <select x-model="selectedCar" :disabled="isCarLocked"
                            :class="!selectedCar ? 'text-gray-400' : 'text-gray-900'"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent disabled:bg-gray-100 disabled:cursor-not-allowed disabled:opacity-75">
                            <option value="" disabled selected>-- Pilih Mobil --</option>
                            <option value="Toyota Hilux Rangga">Toyota Hilux Rangga</option>
                            <option value="Toyota Raize Abu Abu">Toyota Raize Abu Abu</option>
                            <option value="Toyota Zenix">Toyota Zenix</option>
                            <option value="Toyota Agya Putih">Toyota Agya Putih</option>
                            <option value="Toyota Fortuner">Toyota Fortuner</option>
                            <option value="Toyota Agya GR Merah">Toyota Agya GR Merah</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Pilih Supervisor (SPV) <span class="text-red-500">*</span>
                        </label>
                        <select x-model="selectedSPV" :class="!selectedSPV ? 'text-gray-400' : 'text-gray-900'"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                            <option value="" disabled selected>-- Pilih SPV Anda --</option>
                            <template x-for="spv in spvList" :key="spv.id">
                                <option :value="spv.id" x-text="spv.name"></option>
                            </template>
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Pilih Supervisor Anda</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Tipe Booking
                            <span x-show="isBookingTypeLocked" class="text-xs text-blue-600 ml-2">(🔒
                                Terkunci)</span>
                        </label>
                        <div class="grid grid-cols-2 gap-4">
                            <button type="button" @click="!isBookingTypeLocked && (bookingType = 'test_drive')"
                                :disabled="isBookingTypeLocked"
                                :class="bookingType === 'test_drive'
                                    ?
                                    'bg-red-600 text-white' :
                                    'bg-gray-100 text-gray-700'"
                                class="px-4 py-3 rounded-lg font-medium transition disabled:opacity-50 disabled:cursor-not-allowed">
                                🚗 Test Drive
                            </button>
                            <button type="button" @click="!isBookingTypeLocked && (bookingType = 'pameran')"
                                :disabled="isBookingTypeLocked"
                                :class="bookingType === 'pameran'
                                    ?
                                    'bg-red-600 text-white' :
                                    'bg-gray-100 text-gray-700'"
                                class="px-4 py-3 rounded-lg font-medium transition disabled:opacity-50 disabled:cursor-not-allowed">
                                🏢 Pameran/Movex
                            </button>
                        </div>
                    </div>

                    <template x-if="bookingType === 'test_drive'">
                        <div class="space-y-6">
                            <div class="bg-gray-50 p-4 rounded-lg space-y-4">
                                <h3 class="font-semibold text-gray-900">Informasi Sales</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Nama Sales <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" x-model="bookingForm.sales_name" required
                                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                        <p class="text-xs text-gray-500 mt-1">Masukkan nama lengkap sales</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            No. HP Sales <span class="text-red-500">*</span>
                                        </label>
                                        <input type="tel" x-model="bookingForm.sales_phone" required
                                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                        <p class="text-xs text-gray-500 mt-1">Masukkan nomor handphone sales yang aktif
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 p-4 rounded-lg space-y-4">
                                <h3 class="font-semibold text-gray-900">Informasi Customer</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Nama Customer <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" x-model="bookingForm.customer_name" required
                                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                        <p class="text-xs text-gray-500 mt-1">Masukkan nama lengkap customer</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            No. HP <span class="text-red-500">*</span>
                                        </label>
                                        <input type="tel" x-model="bookingForm.customer_phone" required
                                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                        <p class="text-xs text-gray-500 mt-1">Masukkan nomor handphone customer yang
                                            aktif</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Email <span class="text-red-500">*</span>
                                        </label>
                                        <input type="email" x-model="bookingForm.email" required
                                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                        <p class="text-xs text-gray-500 mt-1">Masukkan email customer</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            No. KTP <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" x-model="bookingForm.ktp" maxlength="16" required
                                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                        <p class="text-xs text-gray-500 mt-1">Masukkan nomor KTP customer</p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 p-4 rounded-lg space-y-4">
                                <h3 class="font-semibold text-gray-900 flex items-center gap-2">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke="#1f2937"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    Detail Test Drive
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Jam Test Drive <span class="text-red-500">*</span>
                                        </label>
                                        <input type="time" x-model="bookingForm.test_drive_time" required
                                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                        <p class="text-xs text-gray-500 mt-1">Note: Jika icon jam tidak muncul,
                                            silahkan refresh halaman</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Lokasi <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" x-model="bookingForm.test_drive_location" required
                                            placeholder="Contoh: Dealer Toyota Paal 10"
                                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                        <p class="text-xs text-gray-500 mt-1">Masukkan lokasi test drive</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                    <template x-if="bookingType === 'pameran'">
                        <div class="space-y-6">
                            <div class="bg-gray-50 p-4 rounded-lg space-y-4">
                                <h3 class="font-semibold text-gray-900">Informasi PIC</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Nama PIC <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" x-model="bookingForm.pic_name" required
                                            placeholder="Masukkan nama PIC"
                                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                        <p class="text-xs text-gray-500 mt-1">Masukkan nama lengkap PIC</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            No. HP PIC <span class="text-red-500">*</span>
                                        </label>
                                        <input type="tel" x-model="bookingForm.pic_phone" required
                                            placeholder="08xxxxxxxxxx" maxlength="13"
                                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                        <p class="text-xs text-gray-500 mt-1">Masukkan nomor handphone PIC yang aktif
                                        </p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Email PIC <span class="text-red-500">*</span>
                                        </label>
                                        <input type="email" x-model="bookingForm.pic_email" required
                                            placeholder="email@example.com"
                                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                        <p class="text-xs text-gray-500 mt-1">Masukkan email PIC</p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 p-4 rounded-lg space-y-4">
                                <h3 class="font-semibold text-gray-900">Detail Acara</h3>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Target Prospect <span class="text-red-500">*</span>
                                    </label>
                                    <textarea x-model="bookingForm.target_prospect" rows="3" required
                                        placeholder="Jelaskan target prospect acara..."
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 focus:ring-2 focus:ring-red-500 focus:border-transparent resize-none"></textarea>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Lokasi Acara <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" x-model="bookingForm.event_location" required
                                        placeholder="Masukkan lokasi lengkap acara"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Tanggal Acara <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" x-model="bookingForm.event_date" required
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Tanggal Mulai <span class="text-red-500">*</span>
                                        </label>
                                        <input type="date" x-model="bookingForm.start_date" required
                                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Tanggal Selesai <span class="text-red-500">*</span>
                                        </label>
                                        <input type="date" x-model="bookingForm.end_date" required
                                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                    <div class="pt-4">
                        <button type="submit" :disabled="isLoading"
                            class="w-full px-6 py-4 btn-primary text-white font-semibold rounded-lg disabled:opacity-50 disabled:cursor-not-allowed">
                            <span x-show="!isLoading">Confirm Booking</span>
                            <span x-show="isLoading" class="flex items-center justify-center">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none"
                                    viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Processing...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
