<div x-show="checksheetModal" x-cloak
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 p-4 overflow-y-auto">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-6xl max-h-[90vh] overflow-y-auto my-8">
        <div class="sticky top-0 bg-white dark:bg-gray-800 p-6 border-b border-gray-200 dark:border-gray-600 z-10">
            <div class="flex justify-between items-center">
                <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                    <span
                        x-text="isViewMode ? 'Detail Check Sheet' : (isEditMode ? 'Edit Check Sheet' : 'Form Check Sheet')"></span>
                </h3>
                <button @click="closeChecksheetModal()"
                    class="text-gray-500 hover:text-red-500 text-2xl font-bold">×</button>
            </div>
        </div>

        <form @submit.prevent="submitChecksheet()" class="p-6">
            <input type="hidden" :value="selectedBooking?.id ?? ''">
            <div class="text-center mb-6">
                <h3
                    class="text-xl font-bold text-gray-800 dark:text-gray-900 bg-yellow-300 dark:bg-yellow-500 p-2 rounded">
                    Check Sheet Peminjaman & Pengembalian Unit Test Drive
                </h3>
                <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">Agung Toyota Jambi Pal
                    10</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <label class="w-32 text-sm font-medium text-gray-700 dark:text-gray-200">Nama
                            Customer:</label>
                        <input type="text" :value="selectedBooking?.customer || '-'" readonly
                            class="flex-1 px-3 py-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 bg-gray-100 dark:bg-gray-600">
                    </div>
                    <div class="flex items-center gap-3">
                        <label class="w-32 text-sm font-medium text-gray-700 dark:text-gray-200">Tanggal
                            Test Drive:</label>
                        <input type="date" x-model="formData.tanggal_test_drive" :readonly="isViewMode"
                            class="flex-1 px-3 py-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                            :class="isViewMode ? 'bg-gray-100 dark:bg-gray-600' : ''" required>
                    </div>
                    <div class="flex items-center gap-3">
                        <label class="w-32 text-sm font-medium text-gray-700 dark:text-gray-200">Jam
                            Pinjam:</label>
                        <input type="time" x-model="formData.jam_pinjam" :readonly="isViewMode"
                            class="flex-1 px-3 py-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                            :class="isViewMode ? 'bg-gray-100 dark:bg-gray-600' : ''" required>
                    </div>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <label class="w-32 text-sm font-medium text-gray-700 dark:text-gray-200">Jam
                            Kembali:</label>
                        <input type="time" x-model="formData.jam_kembali" :readonly="isViewMode"
                            class="flex-1 px-3 py-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                            :class="isViewMode ? 'bg-gray-100 dark:bg-gray-600' : ''" required>
                    </div>
                    <div class="flex items-center gap-3">
                        <label class="w-32 text-sm font-medium text-gray-700 dark:text-gray-200">Tipe
                            Mobil:</label>
                        <input type="text" x-model="formData.tipe_mobil" readonly
                            class="flex-1 px-3 py-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 bg-gray-100 dark:bg-gray-600">
                    </div>
                    <div class="flex items-center gap-3">
                        <label class="w-32 text-sm font-medium text-gray-700 dark:text-gray-200">No.
                            Polisi:</label>
                        <input type="text" x-model="formData.no_polisi" :readonly="isViewMode"
                            class="flex-1 px-3 py-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                            :class="isViewMode ? 'bg-gray-100 dark:bg-gray-600' : ''" required>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto mb-6">
                <table class="w-full border-collapse border-2 border-gray-500 dark:border-gray-400 text-sm">
                    <thead>
                        <tr>
                            <th class="border-2 border-gray-500 dark:border-gray-400 bg-yellow-300 dark:bg-yellow-500 p-2 font-bold text-center text-gray-900"
                                rowspan="2">
                                Kondisi Kendaraan Saat Di Pinjam<br>
                                <span class="text-xs">Bagian Di Cek</span>
                            </th>
                            <th
                                class="border-2 border-gray-500 dark:border-gray-400 bg-yellow-300 dark:bg-yellow-500 p-2 font-bold text-center text-gray-900">
                                Kondisi</th>
                            <th
                                class="border-2 border-gray-500 dark:border-gray-400 bg-yellow-300 dark:bg-yellow-500 p-2 font-bold text-center text-gray-900">
                                Catatan Kerusakan</th>
                            <th class="border-2 border-gray-500 dark:border-gray-400 bg-yellow-300 dark:bg-yellow-500 p-2 font-bold text-center text-gray-900"
                                rowspan="2">
                                Kondisi Kendaraan Saat Di Kembalikan<br>
                                <span class="text-xs">Bagian Di Cek</span>
                            </th>
                            <th
                                class="border-2 border-gray-500 dark:border-gray-400 bg-yellow-300 dark:bg-yellow-500 p-2 font-bold text-center text-gray-900">
                                Kondisi</th>
                            <th
                                class="border-2 border-gray-500 dark:border-gray-400 bg-yellow-300 dark:bg-yellow-500 p-2 font-bold text-center text-gray-900">
                                Catatan Kerusakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="item in checkItems" :key="item.name">
                            <tr>
                                <td class="border-2 border-gray-500 dark:border-gray-400 p-2 font-medium text-gray-900 dark:text-gray-100"
                                    x-text="item.label"></td>
                                <td class="border-2 border-gray-500 dark:border-gray-400 p-2 text-center">
                                    <div class="flex justify-center gap-4">
                                        <label class="flex items-center gap-1">
                                            <input type="checkbox" :name="`${item.name}_pinjam_baik`"
                                                x-model="formData[`${item.name}_pinjam_baik`]"
                                                @change="toggleCatatan(item.name, 'pinjam', 'baik')"
                                                :disabled="isViewMode" class="w-4 h-4">
                                            <span class="text-xs text-gray-900 dark:text-gray-100">Baik</span>
                                        </label>
                                        <label class="flex items-center gap-1">
                                            <input type="checkbox" :name="`${item.name}_pinjam_tidak_baik`"
                                                x-model="formData[`${item.name}_pinjam_tidak_baik`]"
                                                @change="toggleCatatan(item.name, 'pinjam', 'tidak_baik')"
                                                :disabled="isViewMode" class="w-4 h-4">
                                            <span class="text-xs text-gray-900 dark:text-gray-100">Tidak
                                                Baik</span>
                                        </label>
                                    </div>
                                </td>
                                <td class="border-2 border-gray-500 dark:border-gray-400 p-2">
                                    <input type="text" :name="`${item.name}_pinjam_catatan`"
                                        x-model="formData[`${item.name}_pinjam_catatan`]"
                                        :disabled="!formData[`${item.name}_pinjam_tidak_baik`] ||
                                            isViewMode"
                                        :readonly="isViewMode"
                                        class="w-full px-2 py-1 text-xs border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 disabled:bg-gray-100 dark:disabled:bg-gray-600 disabled:cursor-not-allowed">
                                </td>
                                <td class="border-2 border-gray-500 dark:border-gray-400 p-2 font-medium text-gray-900 dark:text-gray-100"
                                    x-text="item.label"></td>
                                <td class="border-2 border-gray-500 dark:border-gray-400 p-2 text-center">
                                    <div class="flex justify-center gap-4">
                                        <label class="flex items-center gap-1">
                                            <input type="checkbox" :name="`${item.name}_kembali_baik`"
                                                x-model="formData[`${item.name}_kembali_baik`]"
                                                @change="toggleCatatan(item.name, 'kembali', 'baik')"
                                                :disabled="isViewMode" class="w-4 h-4">
                                            <span class="text-xs text-gray-900 dark:text-gray-100">Baik</span>
                                        </label>
                                        <label class="flex items-center gap-1">
                                            <input type="checkbox" :name="`${item.name}_kembali_tidak_baik`"
                                                x-model="formData[`${item.name}_kembali_tidak_baik`]"
                                                @change="toggleCatatan(item.name, 'kembali', 'tidak_baik')"
                                                :disabled="isViewMode" class="w-4 h-4">
                                            <span class="text-xs text-gray-900 dark:text-gray-100">Tidak
                                                Baik</span>
                                        </label>
                                    </div>
                                </td>
                                <td class="border-2 border-gray-500 dark:border-gray-400 p-2">
                                    <input type="text" :name="`${item.name}_kembali_catatan`"
                                        x-model="formData[`${item.name}_kembali_catatan`]"
                                        :disabled="!formData[`${item.name}_kembali_tidak_baik`] ||
                                            isViewMode"
                                        :readonly="isViewMode"
                                        class="w-full px-2 py-1 text-xs border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 disabled:bg-gray-100 dark:disabled:bg-gray-600 disabled:cursor-not-allowed">
                                </td>
                            </tr>
                        </template>

                        <tr>
                            <td class="border-2 border-gray-500 dark:border-gray-400 p-3 font-bold bg-gray-100 dark:bg-gray-600 text-gray-900 dark:text-gray-100"
                                colspan="6">
                                <div class="text-center mb-3 text-base">Bahan Bakar</div>
                                <div class="border-t-2 border-gray-500 dark:border-gray-400 pt-3">
                                    <div class="text-sm mb-2 font-semibold">Saat dipinjam
                                    </div>
                                    <div
                                        class="flex flex-wrap gap-4 justify-center pb-3 mb-3 border-b-2 border-gray-500 dark:border-gray-400">
                                        <template x-for="fuel in fuelOptions" :key="`pinjam_${fuel.value}`">
                                            <label class="flex items-center gap-1">
                                                <input type="checkbox" :name="`bahan_bakar_pinjam_${fuel.value}`"
                                                    x-model="formData[`bahan_bakar_pinjam_${fuel.value}`]"
                                                    @change="handleSingleCheckbox('bahan_bakar_pinjam', fuel.value)"
                                                    :disabled="isViewMode" class="w-4 h-4">
                                                <span class="text-xs text-gray-900 dark:text-gray-100"
                                                    x-text="fuel.label"></span>
                                            </label>
                                        </template>
                                    </div>
                                    <div class="text-sm mb-2 font-semibold">Saat Kembali</div>
                                    <div class="flex flex-wrap gap-4 justify-center">
                                        <template x-for="fuel in fuelOptions" :key="`pinjam_kembali_${fuel.value}`">
                                            <label class="flex items-center gap-1">
                                                <input type="checkbox"
                                                    :name="`bahan_bakar_pinjam_kembali_${fuel.value}`"
                                                    x-model="formData[`bahan_bakar_pinjam_kembali_${fuel.value}`]"
                                                    @change="handleSingleCheckbox('bahan_bakar_pinjam_kembali', fuel.value)"
                                                    :disabled="isViewMode" class="w-4 h-4">
                                                <span class="text-xs text-gray-900 dark:text-gray-100"
                                                    x-text="fuel.label"></span>
                                            </label>
                                        </template>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="border-2 border-gray-500 dark:border-gray-400 p-3 font-bold bg-gray-100 dark:bg-gray-600 text-gray-900 dark:text-gray-100"
                                colspan="3">
                                <div class="text-center mb-3 text-base">Dokumen & Kunci Saat
                                    Di
                                    Pinjam</div>
                                <div class="border-t-2 border-gray-500 dark:border-gray-400 pt-3">
                                    <template x-for="doc in dokumenItems" :key="`pinjam_${doc.name}`">
                                        <div
                                            class="flex items-center justify-between mb-3 pb-3 border-b-2 border-gray-500 dark:border-gray-400 last:border-b-0 last:mb-0 last:pb-0">
                                            <span class="text-sm font-semibold" x-text="doc.label"></span>
                                            <div class="flex gap-4">
                                                <label class="flex items-center gap-1">
                                                    <input type="checkbox" :name="`${doc.name}_pinjam_ada`"
                                                        x-model="formData[`${doc.name}_pinjam_ada`]"
                                                        @change="handleSingleCheckbox(`${doc.name}_pinjam`, 'ada')"
                                                        :disabled="isViewMode" class="w-4 h-4">
                                                    <span class="text-xs">Ada</span>
                                                </label>
                                                <label class="flex items-center gap-1">
                                                    <input type="checkbox" :name="`${doc.name}_pinjam_tidak_ada`"
                                                        x-model="formData[`${doc.name}_pinjam_tidak_ada`]"
                                                        @change="handleSingleCheckbox(`${doc.name}_pinjam`, 'tidak_ada')"
                                                        :disabled="isViewMode" class="w-4 h-4">
                                                    <span class="text-xs">Tidak Ada</span>
                                                </label>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </td>
                            <td class="border-2 border-gray-500 dark:border-gray-400 p-3 font-bold bg-gray-100 dark:bg-gray-600 text-gray-900 dark:text-gray-100"
                                colspan="3">
                                <div class="text-center mb-3 text-base">Dokumen & Kunci Saat
                                    Di
                                    Kembalikan</div>
                                <div class="border-t-2 border-gray-500 dark:border-gray-400 pt-3">
                                    <template x-for="doc in dokumenItems" :key="`kembali_${doc.name}`">
                                        <div
                                            class="flex items-center justify-between mb-3 pb-3 border-b-2 border-gray-500 dark:border-gray-400 last:border-b-0 last:mb-0 last:pb-0">
                                            <span class="text-sm font-semibold" x-text="doc.label"></span>
                                            <div class="flex gap-4">
                                                <label class="flex items-center gap-1">
                                                    <input type="checkbox" :name="`${doc.name}_kembali_ada`"
                                                        x-model="formData[`${doc.name}_kembali_ada`]"
                                                        @change="handleSingleCheckbox(`${doc.name}_kembali`, 'ada')"
                                                        :disabled="isViewMode" class="w-4 h-4">
                                                    <span class="text-xs">Ada</span>
                                                </label>
                                                <label class="flex items-center gap-1">
                                                    <input type="checkbox" :name="`${doc.name}_kembali_tidak_ada`"
                                                        x-model="formData[`${doc.name}_kembali_tidak_ada`]"
                                                        @change="handleSingleCheckbox(`${doc.name}_kembali`, 'tidak_ada')"
                                                        :disabled="isViewMode" class="w-4 h-4">
                                                    <span class="text-xs">Tidak Ada</span>
                                                </label>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="border-2 border-gray-500 dark:border-gray-400 p-3 font-bold bg-gray-100 dark:bg-gray-600 text-gray-900 dark:text-gray-100"
                                colspan="3">
                                <div class="text-center mb-3 text-base">Kelengkapan Tambahan
                                    Saat Di Pinjam</div>
                                <div class="border-t-2 border-gray-500 dark:border-gray-400 pt-3">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm font-semibold">Air Mineral
                                            Botol</span>
                                        <div class="flex gap-4">
                                            <label class="flex items-center gap-1">
                                                <input type="checkbox" name="air_mineral_pinjam_ada"
                                                    x-model="formData.air_mineral_pinjam_ada"
                                                    @change="handleSingleCheckbox('air_mineral_pinjam', 'ada')"
                                                    :disabled="isViewMode" class="w-4 h-4">
                                                <span class="text-xs">Ada</span>
                                            </label>
                                            <label class="flex items-center gap-1">
                                                <input type="checkbox" name="air_mineral_pinjam_tidak_ada"
                                                    x-model="formData.air_mineral_pinjam_tidak_ada"
                                                    @change="handleSingleCheckbox('air_mineral_pinjam', 'tidak_ada')"
                                                    :disabled="isViewMode" class="w-4 h-4">
                                                <span class="text-xs">Tidak Ada</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="border-2 border-gray-500 dark:border-gray-400 p-3 font-bold bg-gray-100 dark:bg-gray-600 text-gray-900 dark:text-gray-100"
                                colspan="3">
                                <div class="text-center mb-3 text-base">Kelengkapan Tambahan
                                    Saat Di Kembalikan</div>
                                <div class="border-t-2 border-gray-500 dark:border-gray-400 pt-3">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm font-semibold">Air Mineral
                                            Botol</span>
                                        <div class="flex gap-4">
                                            <label class="flex items-center gap-1">
                                                <input type="checkbox" name="air_mineral_kembali_ada"
                                                    x-model="formData.air_mineral_kembali_ada"
                                                    @change="handleSingleCheckbox('air_mineral_kembali', 'ada')"
                                                    :disabled="isViewMode" class="w-4 h-4">
                                                <span class="text-xs">Ada</span>
                                            </label>
                                            <label class="flex items-center gap-1">
                                                <input type="checkbox" name="air_mineral_kembali_tidak_ada"
                                                    x-model="formData.air_mineral_kembali_tidak_ada"
                                                    @change="handleSingleCheckbox('air_mineral_kembali', 'tidak_ada')"
                                                    :disabled="isViewMode" class="w-4 h-4">
                                                <span class="text-xs">Tidak Ada</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                        Tanggal Penggantian Pewangi
                    </label>
                    <input type="date" name="tanggal_penggantian_pewangi"
                        x-model="formData.tanggal_penggantian_pewangi" :readonly="isViewMode"
                        class="w-full px-3 py-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                        :class="isViewMode ? 'bg-gray-100 dark:bg-gray-600' : ''">
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">( Wajib Di Ganti
                        14 Hari Kerja )</p>
                </div>
            </div>

            <div class="flex justify-center gap-4 mt-6 pt-6 border-t border-gray-200 dark:border-gray-600">
                <template x-if="isViewMode">
                    <div class="flex gap-4">
                        <button type="button" @click="enableEditMode()"
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            ✏️ Edit Checksheet
                        </button>
                        <button type="button" @click="confirmDeleteChecksheet()"
                            class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                            🗑️ Hapus Checksheet
                        </button>
                        <button type="button" @click="closeChecksheetModal()"
                            class="px-6 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500 transition">
                            ✕ Tutup
                        </button>
                    </div>
                </template>

                <template x-if="!isViewMode">
                    <div class="flex gap-4">
                        <button type="submit" :disabled="isSubmitting"
                            class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition disabled:bg-gray-400 disabled:cursor-not-allowed">
                            <span x-show="!isSubmitting">💾 <span x-text="isEditMode ? 'Update' : 'Simpan'"></span>
                                Check
                                Sheet</span>
                            <span x-show="isSubmitting" class="flex items-center gap-2">
                                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4">
                                    </circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                <span x-text="isEditMode ? 'Mengupdate...' : 'Menyimpan...'"></span>
                            </span>
                        </button>
                        <button type="button" @click="resetForm()"
                            class="px-6 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition">
                            🔄 Reset Form
                        </button>
                        <button type="button" @click="closeChecksheetModal()"
                            class="px-6 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500 transition">
                            ✕ Batal
                        </button>
                    </div>
                </template>
            </div>
        </form>
    </div>
</div>
