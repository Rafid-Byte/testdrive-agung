<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('checkSheetSecurity', () => ({
            darkMode: false,
            sidebarOpen: true,
            searchQuery: '',
            isUpdatingStatus: false,
            historySearchQuery: '',
            checksheetModal: false,
            selectedBooking: null,
            isSubmitting: false,
            isViewMode: false,
            isEditMode: false,
            currentChecksheetId: null,
            originalBookingData: null,
            deleteChecksheetModal: false,
            checksheetToDelete: null,

            bookings: {!! json_encode($bookings ?? []) !!},
            checksheetHistory: [],
            currentPage: 1,
            itemsPerPage: 10,
            historyCurrentPage: 1,
            historyItemsPerPage: 10,

            customerSort: '',
            carFilter: '',
            dateSort: '',
            dateFilter: '',
            carStatusFilter: '',
            approvalStatusFilter: '',

            filters: {
                car: '',
                approvalStatus: '',
                dateFrom: '',
                dateTo: ''
            },

            sorting: {
                customer: '',
                car: '',
                date: ''
            },

            formData: {
                booking_id: '',
                tanggal_test_drive: '',
                jam_pinjam: '',
                jam_kembali: '',
                tipe_mobil: '',
                no_polisi: '',
                tanggal_penggantian_pewangi: '',
            },

            sortCustomer(direction) {
                this.customerSort = direction;
                this.currentPage = 1;
            },

            clearCustomerSort() {
                this.customerSort = '';
                this.currentPage = 1;
            },

            filterByCar(carName) {
                this.carFilter = carName;
                this.currentPage = 1;
            },

            sortDate(direction) {
                this.dateSort = direction;
                this.dateFilter = '';
                this.currentPage = 1;
            },

            filterByDate() {
                this.dateSort = '';
                this.currentPage = 1;
            },

            clearDateFilter() {
                this.dateFilter = '';
                this.dateSort = '';
                this.currentPage = 1;
            },

            filterByCarStatus(status) {
                this.carStatusFilter = status;
                this.currentPage = 1;
            },

            filterByApprovalStatus(status) {
                this.approvalStatusFilter = status;
                this.currentPage = 1;
            },

            checkItems: [{
                    name: 'body_luar',
                    label: 'Body Luar (baret, penyok)'
                },
                {
                    name: 'ban_velg',
                    label: 'Ban & Velg'
                },
                {
                    name: 'kaca_spion',
                    label: 'Kaca & Spion'
                },
                {
                    name: 'interior',
                    label: 'Interior (kursi, dashboard, karpet)'
                },
                {
                    name: 'kebersihan_interior',
                    label: 'Kebersihan Interior'
                },
                {
                    name: 'peralatan',
                    label: 'Peralatan (dongkrak, toolkit, segitiga pengaman)'
                },
                {
                    name: 'ac_audio',
                    label: 'AC & Audio'
                },
                {
                    name: 'lampu',
                    label: 'Lampu-lampu'
                }
            ],

            fuelOptions: [{
                    value: '1',
                    label: '1 Kotak'
                },
                {
                    value: '2',
                    label: '2 Kotak'
                },
                {
                    value: '3',
                    label: '3 Kotak'
                },
                {
                    value: '4',
                    label: 'Di Atas 4 Kotak'
                }
            ],

            dokumenItems: [{
                    name: 'stnk',
                    label: 'STNK'
                },
                {
                    name: 'kunci_utama',
                    label: 'Kunci Utama'
                },
                {
                    name: 'remote_keyless',
                    label: 'Remote / Keyless'
                }
            ],

            init() {
                const savedThemeKey = localStorage.getItem('theme');
                if (savedThemeKey) {
                    if (savedThemeKey === 'system') {
                        this.darkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    } else {
                        this.darkMode = savedThemeKey === 'dark';
                    }
                } else {
                    const savedDarkMode = localStorage.getItem('darkMode');
                    if (savedDarkMode !== null) {
                        this.darkMode = savedDarkMode === 'true';
                    } else {
                        this.darkMode = window.matchMedia && window.matchMedia(
                            '(prefers-color-scheme: dark)').matches;
                    }
                }

                this.applyTheme();

                window.addEventListener('storage', (e) => {
                    if (e.key === 'theme') {
                        if (e.newValue === 'system') {
                            this.darkMode = window.matchMedia(
                                '(prefers-color-scheme: dark)').matches;
                        } else if (e.newValue) {
                            this.darkMode = e.newValue === 'dark';
                        }
                        this.applyTheme();
                    } else if (e.key === 'darkMode') {
                        this.darkMode = e.newValue === 'true';
                        this.applyTheme();
                    }
                });

                console.log('✅ Bookings loaded:', this.bookings.length, 'items');
                if (this.bookings.length > 0) {
                    console.log('📋 First booking:', this.bookings[0]);
                }

                this.initializeFormData();
                this.loadChecksheetHistory();
            },

            initializeFormData() {
                this.formData = {
                    booking_id: '',
                    tanggal_test_drive: '',
                    jam_pinjam: '',
                    jam_kembali: '',
                    tipe_mobil: '',
                    no_polisi: '',
                    tanggal_penggantian_pewangi: '',
                };

                this.checkItems.forEach(item => {
                    this.formData[`${item.name}_pinjam_baik`] = false;
                    this.formData[`${item.name}_pinjam_tidak_baik`] = false;
                    this.formData[`${item.name}_pinjam_catatan`] = '';
                    this.formData[`${item.name}_kembali_baik`] = false;
                    this.formData[`${item.name}_kembali_tidak_baik`] = false;
                    this.formData[`${item.name}_kembali_catatan`] = '';
                });

                for (let i = 1; i <= 4; i++) {
                    this.formData[`bahan_bakar_pinjam_${i}`] = false;
                    this.formData[`bahan_bakar_pinjam_kembali_${i}`] = false;
                }

                this.dokumenItems.forEach(doc => {
                    this.formData[`${doc.name}_pinjam_ada`] = false;
                    this.formData[`${doc.name}_pinjam_tidak_ada`] = false;
                    this.formData[`${doc.name}_kembali_ada`] = false;
                    this.formData[`${doc.name}_kembali_tidak_ada`] = false;
                });

                this.formData.air_mineral_pinjam_ada = false;
                this.formData.air_mineral_pinjam_tidak_ada = false;
                this.formData.air_mineral_kembali_ada = false;
                this.formData.air_mineral_kembali_tidak_ada = false;
            },

            async loadChecksheetHistory() {
                try {
                    const response = await fetch('/api/checksheets', {
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').content
                        }
                    });

                    if (response.ok) {
                        const data = await response.json();
                        this.checksheetHistory = data.data || [];
                        console.log('📜 History loaded:', this.checksheetHistory.length,
                            'checksheets');
                    }
                } catch (error) {
                    console.error('Error loading checksheet history:', error);
                }
            },

            toggleTheme() {
                this.darkMode = !this.darkMode;
                localStorage.setItem('darkMode', this.darkMode.toString());
                this.applyTheme();

                this.$nextTick(() => {
                    this.applyTheme();
                });
            },

            applyTheme() {
                requestAnimationFrame(() => {
                    if (this.darkMode) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                });
            },

            get filteredBookings() {
                let filtered = this.bookings;

                if (this.searchQuery.trim()) {
                    const query = this.searchQuery.toLowerCase();
                    filtered = filtered.filter(booking =>
                        booking.customer.toLowerCase().includes(query) ||
                        booking.phone.toLowerCase().includes(query) ||
                        booking.car.toLowerCase().includes(query) ||
                        booking.spv.toLowerCase().includes(query)
                    );
                }

                if (this.carFilter) {
                    filtered = filtered.filter(booking => booking.car === this.carFilter);
                }

                if (this.carStatusFilter) {
                    filtered = filtered.filter(booking => booking.status === this
                        .carStatusFilter);
                }

                if (this.approvalStatusFilter) {
                    filtered = filtered.filter(booking => booking.approval_status === this
                        .approvalStatusFilter);
                }

                if (this.dateFilter) {
                    filtered = filtered.filter(booking => booking.date_raw === this.dateFilter);
                }

                if (this.customerSort) {
                    filtered.sort((a, b) => {
                        const comparison = a.customer.localeCompare(b.customer);
                        return this.customerSort === 'asc' ? comparison : -comparison;
                    });
                }

                if (this.dateSort) {
                    // Gunakan date_raw (YYYY-MM-DD) untuk sort — string comparison = date comparison
                    filtered = [...filtered].sort((a, b) => {
                        const comparison = (a.date_raw || '').localeCompare(b
                            .date_raw || '');
                        return this.dateSort === 'asc' ? comparison : -comparison;
                    });
                }

                return filtered;
            },

            get paginatedBookings() {
                const filtered = this.filteredBookings;
                const start = (this.currentPage - 1) * this.itemsPerPage;
                const end = start + this.itemsPerPage;
                return filtered.slice(start, end);
            },

            get totalPages() {
                return Math.ceil(this.filteredBookings.length / this.itemsPerPage) || 1;
            },

            get startIndex() {
                return (this.currentPage - 1) * this.itemsPerPage;
            },

            get endIndex() {
                return this.currentPage * this.itemsPerPage;
            },

            get visiblePages() {
                const total = this.totalPages;
                const current = this.currentPage;
                const pages = [];

                if (total <= 7) {
                    for (let i = 1; i <= total; i++) {
                        pages.push(i);
                    }
                } else {
                    if (current <= 3) {
                        pages.push(1, 2, 3, 4, '...', total);
                    } else if (current >= total - 2) {
                        pages.push(1, '...', total - 3, total - 2, total - 1, total);
                    } else {
                        pages.push(1, '...', current - 1, current, current + 1, '...', total);
                    }
                }

                return pages;
            },

            nextPage() {
                if (this.currentPage < this.totalPages) {
                    this.currentPage++;
                }
            },

            prevPage() {
                if (this.currentPage > 1) {
                    this.currentPage--;
                }
            },

            goToPage(page) {
                if (typeof page === 'number' && page >= 1 && page <= this.totalPages) {
                    this.currentPage = page;
                }
            },

            scrollToTop() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            },

            nextHistoryPage() {
                if (this.historyCurrentPage < this.historyTotalPages) {
                    this.historyCurrentPage++;
                }
            },

            prevHistoryPage() {
                if (this.historyCurrentPage > 1) {
                    this.historyCurrentPage--;
                }
            },

            goToHistoryPage(page) {
                if (typeof page === 'number' && page >= 1 && page <= this.historyTotalPages) {
                    this.historyCurrentPage = page;
                }
            },

            parseIndonesianDate(dateStr) {
                // Support both Indonesian (from locale) AND English (Carbon default format('d F Y'))
                const monthMap = {
                    // Indonesia
                    'Januari': 0,
                    'Februari': 1,
                    'Maret': 2,
                    'April': 3,
                    'Mei': 4,
                    'Juni': 5,
                    'Juli': 6,
                    'Agustus': 7,
                    'September': 8,
                    'Oktober': 9,
                    'November': 10,
                    'Desember': 11,
                    // English (Carbon format('d F Y') default)
                    'January': 0,
                    'February': 1,
                    'March': 2,
                    'May': 4,
                    'June': 5,
                    'July': 6,
                    'August': 7,
                    'October': 9
                    // April, September, November, December sama di kedua bahasa
                };

                const parts = dateStr.split(' ');
                if (parts.length === 3) {
                    const day = parseInt(parts[0]);
                    const month = monthMap[parts[1]];
                    const year = parseInt(parts[2]);
                    if (month !== undefined) {
                        return new Date(year, month, day);
                    }
                }
                return new Date(dateStr);
            },

            get filteredHistory() {
                if (!this.checksheetHistory || !Array.isArray(this.checksheetHistory)) {
                    return [];
                }

                if (!this.historySearchQuery || !this.historySearchQuery.trim()) {
                    return this.checksheetHistory;
                }

                const query = this.historySearchQuery.toLowerCase();
                return this.checksheetHistory.filter(checksheet => {
                    const customer = checksheet.customer?.toLowerCase() || '';
                    const car = checksheet.car?.toLowerCase() || '';
                    const noPolisi = checksheet.no_polisi?.toLowerCase() || '';

                    return customer.includes(query) ||
                        car.includes(query) ||
                        noPolisi.includes(query);
                });
            },

            get paginatedHistory() {
                const filtered = this.filteredHistory;
                const start = (this.historyCurrentPage - 1) * this.historyItemsPerPage;
                const end = start + this.historyItemsPerPage;
                return filtered.slice(start, end);
            },

            get historyTotalPages() {
                return Math.ceil(this.filteredHistory.length / this.historyItemsPerPage) || 1;
            },

            get historyStartIndex() {
                return (this.historyCurrentPage - 1) * this.historyItemsPerPage;
            },

            get historyEndIndex() {
                return this.historyCurrentPage * this.historyItemsPerPage;
            },

            get historyVisiblePages() {
                const total = this.historyTotalPages;
                const current = this.historyCurrentPage;
                const pages = [];

                if (total <= 7) {
                    for (let i = 1; i <= total; i++) {
                        pages.push(i);
                    }
                } else {
                    if (current <= 3) {
                        pages.push(1, 2, 3, 4, '...', total);
                    } else if (current >= total - 2) {
                        pages.push(1, '...', total - 3, total - 2, total - 1, total);
                    } else {
                        pages.push(1, '...', current - 1, current, current + 1, '...', total);
                    }
                }

                return pages;
            },

            get hasActiveFilters() {
                return !!(this.filters.car || this.filters.approvalStatus || this.filters
                    .dateFrom || this.filters.dateTo);
            },

            get hasActiveSorting() {
                return !!(this.sorting.customer || this.sorting.car || this.sorting.date);
            },

            get activeFilters() {
                const filters = [];
                if (this.filters.car) {
                    filters.push({
                        type: 'car',
                        label: `Mobil: ${this.filters.car}`
                    });
                }
                if (this.filters.approvalStatus) {
                    const statusLabel = this.filters.approvalStatus === 'approved' ?
                        'Disetujui' :
                        this.filters.approvalStatus === 'pending' ? 'Menunggu' : 'Dibatalkan';
                    filters.push({
                        type: 'approvalStatus',
                        label: `Status: ${statusLabel}`
                    });
                }
                if (this.filters.dateFrom) {
                    filters.push({
                        type: 'dateFrom',
                        label: `Dari: ${this.filters.dateFrom}`
                    });
                }
                if (this.filters.dateTo) {
                    filters.push({
                        type: 'dateTo',
                        label: `Sampai: ${this.filters.dateTo}`
                    });
                }
                return filters;
            },

            get activeSorting() {
                const sorting = [];
                if (this.sorting.customer) {
                    sorting.push({
                        type: 'customer',
                        label: `Customer: ${this.sorting.customer === 'asc' ? 'A-Z' : 'Z-A'}`
                    });
                }
                if (this.sorting.car) {
                    sorting.push({
                        type: 'car',
                        label: `Mobil: ${this.sorting.car === 'asc' ? 'A-Z' : 'Z-A'}`
                    });
                }
                if (this.sorting.date) {
                    sorting.push({
                        type: 'date',
                        label: `Tanggal: ${this.sorting.date === 'asc' ? 'Terlama' : 'Terbaru'}`
                    });
                }
                return sorting;
            },

            parseDate(dateStr) {
                const months = {
                    'Januari': '01',
                    'Februari': '02',
                    'Maret': '03',
                    'April': '04',
                    'Mei': '05',
                    'Juni': '06',
                    'Juli': '07',
                    'Agustus': '08',
                    'September': '09',
                    'Oktober': '10',
                    'November': '11',
                    'Desember': '12'
                };

                const parts = dateStr.split(' ');
                if (parts.length === 3) {
                    const day = parts[0].padStart(2, '0');
                    const month = months[parts[1]];
                    const year = parts[2];

                    if (month) {
                        return new Date(`${year}-${month}-${day}`);
                    }
                }
                return new Date(dateStr);
            },

            isDateInRange(dateStr, fromDate, toDate) {
                if (!fromDate && !toDate) return true;

                const bookingDate = this.parseDate(dateStr);
                const from = fromDate ? new Date(fromDate) : null;
                const to = toDate ? new Date(toDate) : null;

                if (from && bookingDate < from) return false;
                if (to && bookingDate > to) return false;

                return true;
            },

            applySorting(bookings) {
                let sorted = [...bookings];

                if (this.sorting.customer) {
                    sorted.sort((a, b) => {
                        const comparison = a.customer.localeCompare(b.customer);
                        return this.sorting.customer === 'asc' ? comparison : -comparison;
                    });
                }

                if (this.sorting.car) {
                    sorted.sort((a, b) => {
                        const comparison = a.car.localeCompare(b.car);
                        return this.sorting.car === 'asc' ? comparison : -comparison;
                    });
                }

                if (this.sorting.date) {
                    sorted.sort((a, b) => {
                        const dateA = this.parseDate(a.date);
                        const dateB = this.parseDate(b.date);
                        const comparison = dateA - dateB;
                        return this.sorting.date === 'asc' ? comparison : -comparison;
                    });
                }

                return sorted;
            },

            clearAllFilters() {
                this.filters = {
                    car: '',
                    approvalStatus: '',
                    dateFrom: '',
                    dateTo: ''
                };
                this.sorting = {
                    customer: '',
                    car: '',
                    date: ''
                };
            },

            clearFilter(filterType) {
                this.filters[filterType] = '';
            },

            clearSorting(sortType) {
                this.sorting[sortType] = '';
            },

            openChecksheetModal(booking) {
                const allowedStatuses = ['Dikonfirmasi', 'Sedang test drive', 'Selesai',
                    'Perawatan'
                ];

                if (!allowedStatuses.includes(booking.status)) {
                    const statusMessage = booking.status === 'Menunggu' ?
                        'Booking masih menunggu approval SPV!' :
                        booking.status === 'Diproses' ?
                        'Booking masih diproses, menunggu konfirmasi Branch Manager!' :
                        'Booking ini telah dibatalkan!';

                    this.showNotification(statusMessage, booking.status === 'Dibatalkan' ? 'error' :
                        'warning');
                    return;
                }

                this.originalBookingData = JSON.parse(JSON.stringify(booking));
                this.selectedBooking = booking;
                this.isViewMode = false;
                this.isEditMode = false;
                this.currentChecksheetId = null;

                this.initializeFormData();

                this.formData.booking_id = booking.id;
                this.formData.tipe_mobil = booking.car;
                this.formData.tanggal_test_drive = '';

                console.log('🆕 NEW checksheet:', this.formData);
                this.checksheetModal = true;
            },

            async viewChecksheet(checksheetId) {
                try {
                    const response = await fetch(`/checksheet/${checksheetId}`, {
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').content
                        }
                    });

                    if (response.ok) {
                        const result = await response.json();
                        const data = result.data;

                        this.originalBookingData = JSON.parse(JSON.stringify(data.booking));
                        this.selectedBooking = data.booking;
                        this.currentChecksheetId = checksheetId;
                        this.isViewMode = true;
                        this.isEditMode = false;

                        this.initializeFormData();

                        Object.keys(data.form_data).forEach(key => {
                            if (this.formData.hasOwnProperty(key)) {
                                const value = data.form_data[key];
                                const checkboxFields = this.getAllCheckboxFieldNames();
                                if (checkboxFields.includes(key)) {
                                    this.formData[key] = Boolean(value && value !==
                                        '0' && value !== 0 && value !== false);
                                } else {
                                    this.formData[key] = value;
                                }
                            }
                        });

                        console.log('👁️ View:', this.formData);
                        this.checksheetModal = true;
                    }
                } catch (error) {
                    console.error('Error:', error);
                    this.showNotification('Gagal memuat checksheet', 'error');
                }
            },

            async updateCarStatus(booking, newStatus) {

                if (this.isUpdatingStatus) {
                    console.log('âš ï¸ Update already in progress, skipping...');
                    return;
                }

                if (!confirm(`Ubah status mobil "${booking.car}" menjadi "${newStatus}"?`)) {
                    return;
                }

                this.isUpdatingStatus = true;

                try {
                    const response = await fetch(`/api/bookings/${booking.id}/status`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            status: newStatus,
                            booking_type: booking.booking_type || 'test_drive'
                        })
                    });

                    const data = await response.json();

                    if (response.ok && data.success) {

                        if (booking.has_checksheet) {
                            await fetch(`/checksheet/booking/${booking.id}/status-mobil`, {
                                method: 'PUT',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').content
                                },
                                body: JSON.stringify({
                                    status_mobil: newStatus
                                })
                            });
                        }

                        this.showNotification(
                            `Status mobil berhasil diubah menjadi "${newStatus}"`,
                            'success'
                        );

                        const index = this.bookings.findIndex(b => b.id === booking.id);
                        if (index !== -1) {
                            this.bookings[index].status = newStatus;
                            this.bookings[index].status_mobil = newStatus;
                        }

                    } else {
                        this.showNotification(data.message || 'Gagal mengubah status mobil',
                            'error');
                    }
                } catch (error) {
                    console.error('Error updating car status:', error);
                    this.showNotification('Terjadi kesalahan saat mengubah status', 'error');
                } finally {
                    this.isUpdatingStatus = false;
                }
            },

            getAllCheckboxFieldNames() {
                const fields = [];

                this.checkItems.forEach(item => {
                    fields.push(`${item.name}_pinjam_baik`);
                    fields.push(`${item.name}_pinjam_tidak_baik`);
                    fields.push(`${item.name}_kembali_baik`);
                    fields.push(`${item.name}_kembali_tidak_baik`);
                });

                for (let i = 1; i <= 4; i++) {
                    fields.push(`bahan_bakar_pinjam_${i}`);
                    fields.push(`bahan_bakar_pinjam_kembali_${i}`);
                }

                this.dokumenItems.forEach(doc => {
                    fields.push(`${doc.name}_pinjam_ada`);
                    fields.push(`${doc.name}_pinjam_tidak_ada`);
                    fields.push(`${doc.name}_kembali_ada`);
                    fields.push(`${doc.name}_kembali_tidak_ada`);
                });

                fields.push('air_mineral_pinjam_ada');
                fields.push('air_mineral_pinjam_tidak_ada');
                fields.push('air_mineral_kembali_ada');
                fields.push('air_mineral_kembali_tidak_ada');

                return fields;
            },

            enableEditMode() {
                this.isViewMode = false;
                this.isEditMode = true;
                console.log('✏️ Edit mode');
            },

            closeChecksheetModal() {
                this.checksheetModal = false;
                this.selectedBooking = null;
                this.originalBookingData = null;
                this.isViewMode = false;
                this.isEditMode = false;
                this.currentChecksheetId = null;
                this.initializeFormData();
                console.log('❌ Modal closed');
            },

            resetForm() {
                if (!confirm('Reset form? Data yang belum disimpan akan hilang.')) {
                    return;
                }

                const bookingId = this.originalBookingData?.id || this.selectedBooking?.id;
                const carType = this.originalBookingData?.car || this.selectedBooking?.car;

                this.initializeFormData();

                if (bookingId) {
                    this.formData.booking_id = bookingId;
                    this.formData.tipe_mobil = carType;

                    if (!this.isEditMode) {
                        this.formData.tanggal_test_drive = '';
                    }
                }

                console.log('🔄 Form reset:', this.formData);
                this.showNotification('Form direset', 'info');
            },

            toggleCatatan(itemName, stage, kondisi) {
                const baikKey = `${itemName}_${stage}_baik`;
                const tidakBaikKey = `${itemName}_${stage}_tidak_baik`;
                const catatanKey = `${itemName}_${stage}_catatan`;

                if (kondisi === 'baik' && this.formData[baikKey]) {
                    this.formData[tidakBaikKey] = false;
                    this.formData[catatanKey] = '';
                } else if (kondisi === 'tidak_baik' && this.formData[tidakBaikKey]) {
                    this.formData[baikKey] = false;
                }
            },

            handleSingleCheckbox(groupName, value) {
                Object.keys(this.formData).forEach(key => {
                    if (key.startsWith(groupName) && !key.endsWith(value)) {
                        this.formData[key] = false;
                    }
                });
            },

            async submitChecksheet() {
                if (this.isSubmitting) return;

                if (!this.formData.tanggal_test_drive) {
                    this.showNotification('Tanggal Test Drive harus diisi!', 'error');
                    return;
                }

                if (!this.formData.jam_pinjam) {
                    this.showNotification('Jam Pinjam harus diisi!', 'error');
                    return;
                }

                if (!this.formData.jam_kembali) {
                    this.showNotification('Jam Kembali harus diisi!', 'error');
                    return;
                }

                if (!this.formData.no_polisi || !this.formData.no_polisi.trim()) {
                    this.showNotification('No. Polisi harus diisi!', 'error');
                    return;
                }
                this.isSubmitting = true;

                try {
                    const url = this.isEditMode ?
                        `/checksheet/${this.currentChecksheetId}` :
                        '/checksheet/store';

                    const method = this.isEditMode ? 'PUT' : 'POST';

                    console.log('💾 Submitting:', {
                        url,
                        method,
                        data: this.formData
                    });

                    const response = await fetch(url, {
                        method: method,
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify(this.formData)
                    });

                    const data = await response.json();

                    if (response.ok && data.success) {
                        this.showNotification(data.message, 'success');
                        this.closeChecksheetModal();
                        await this.loadChecksheetHistory();
                        setTimeout(() => window.location.reload(), 1500);
                    } else {
                        this.showNotification(data.message || 'Gagal menyimpan', 'error');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    this.showNotification('Terjadi kesalahan', 'error');
                } finally {
                    this.isSubmitting = false;
                }
            },

            confirmDeleteChecksheet() {
                if (!this.currentChecksheetId) {
                    this.showNotification('Checksheet tidak ditemukan', 'error');
                    return;
                }

                this.checksheetToDelete = this.currentChecksheetId;
                this.checksheetModal = false;
                this.deleteChecksheetModal = true;
            },

            async deleteChecksheet() {
                if (!this.checksheetToDelete) return;

                try {
                    const response = await fetch(`/checksheet/${this.checksheetToDelete}`, {
                        method: 'DELETE',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').content
                        }
                    });

                    const data = await response.json();

                    if (response.ok && data.success) {
                        this.showNotification('Checksheet berhasil dihapus!', 'success');

                        await this.loadChecksheetHistory();

                        this.deleteChecksheetModal = false;
                        this.checksheetToDelete = null;

                        setTimeout(() => window.location.reload(), 1500);
                    } else {
                        this.showNotification(data.message || 'Gagal menghapus checksheet',
                            'error');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    this.showNotification('Terjadi kesalahan saat menghapus', 'error');
                }
            },

            showNotification(message, type = 'info') {
                const existingNotifs = document.querySelectorAll('.notification-toast');
                for (const notif of existingNotifs) {
                    if (notif.textContent.includes(message)) {
                        console.log('⚠️ Notification already exists, skipping...');
                        return;
                    }
                }

                const notification = document.createElement('div');
                const bgColor = type === 'error' ? 'bg-red-500' :
                    type === 'success' ? 'bg-green-500' :
                    type === 'warning' ? 'bg-yellow-500' : 'bg-blue-500';

                notification.className =
                    `notification-toast fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full ${bgColor}`;

                notification.innerHTML = `
                            <div class="flex items-center gap-3">
                                <span class="text-white flex-1">${message}</span>
                                <button onclick="this.parentElement.parentElement.remove()" 
                                        class="ml-2 text-white hover:text-gray-200 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        `;

                document.body.appendChild(notification);

                setTimeout(() => notification.classList.remove('translate-x-full'), 100);

                setTimeout(() => {
                    if (notification.parentElement) {
                        notification.classList.add('translate-x-full');
                        setTimeout(() => notification.remove(), 300);
                    }
                }, 3000);
            }
        }));
    });
</script>
