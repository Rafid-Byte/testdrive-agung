<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('bookingDashboard', () => ({
            darkMode: false,
            sidebarOpen: true,
            searchQuery: '',
            customerSearchQuery: '',
            bookingDataSearchQuery: '',
            bookingViewType: 'test_drive',
            managementViewType: 'test_drive',
            managementSearchQuery: '',
            managementDetailModal: false,
            selectedManagementBooking: null,
            managementSPVFilter: '',
            managementSPVSort: '',
            bookingCurrentPage: 1,
            bookingItemsPerPage: 10,
            managementCurrentPage: 1,
            managementItemsPerPage: 10,
            managementStatusFilter: '',
            managementStatusSort: '',
            statusOrder: {
                'Menunggu': 1,
                'Diproses': 2,
                'Dikonfirmasi': 3,
                'Sedang test drive': 4,
                'Sedang Pameran': 4,
                'Selesai': 5,
                'Perawatan': 6,
                'Dibatalkan': 7
            },

            filterManagementByStatus(status) {
                this.managementStatusFilter = status;
                this.managementCurrentPage = 1;
            },

            sortManagementStatus(direction) {
                this.managementStatusSort = direction;
                this.managementCurrentPage = 1;
            },

            clearManagementStatusFilter() {
                this.managementStatusFilter = '';
                this.managementStatusSort = '';
                this.managementCurrentPage = 1;
            },

            sortManagementBySPV(direction) {
                this.managementSPVSort = direction;
                this.managementCurrentPage = 1;
            },

            clearManagementSPVSort() {
                this.managementSPVSort = '';
                this.managementCurrentPage = 1;
            },

            get uniqueSPVList() {
                const spvSet = new Set();

                this.managementBookingsByType.forEach(booking => {
                    if (booking.spv && booking.spv !== '-') {
                        spvSet.add(booking.spv);
                    }
                });

                return Array.from(spvSet).sort((a, b) => a.localeCompare(b));
            },

            sortManagementBySPV(direction) {
                this.managementSPVSort = direction;
                this.managementSPVFilter = '';
                this.managementCurrentPage = 1;
            },

            filterManagementBySPV(spvName) {
                this.managementSPVFilter = spvName;
                this.managementSPVSort = '';
                this.managementCurrentPage = 1;
            },

            clearManagementSPVFilter() {
                this.managementSPVSort = '';
                this.managementSPVFilter = '';
                this.managementCurrentPage = 1;
            },

            filters: {
                car: '',
                status: '',
                dateFrom: '',
                dateTo: ''
            },

            sorting: {
                customer: '',
                car: '',
                date: ''
            },

            newBooking: {
                customer: '',
                phone: '',
                email: '',
                ktp: '',
                address: '',
                car: '',
                spv: '',
                security: '',
                bookingDate: '',
                bookingType: 'test_drive',
                salesName: '',
                salesPhone: '',
                testDriveTime: '',
                testDriveLocation: '',
                targetProspect: '',
                eventDate: '',
                eventLocation: ''
            },

            customerDetailModal: false,
            selectedCustomerDetail: null,
            bookingCustomerDetailModal: false,
            selectedBookingCustomer: null,
            editCustomerModal: false,
            editingCustomer: {
                name: '',
                phone: '',
                email: '',
                ktp: '',
                address: '',
                assignedSPV: '',
            },
            checksheetSummaryModal: false,
            selectedChecksheetSummary: null,
            statusModal: false,
            selectedBooking: null,
            selectedBookingIndex: null,
            newStatus: '',

            bookings: [],

            carList: [{
                    name: 'Toyota Hilux Rangga'
                },
                {
                    name: 'Toyota Raize Abu Abu'
                },
                {
                    name: 'Toyota Zenix'
                },
                {
                    name: 'Toyota Agya Putih'
                },
                {
                    name: 'Toyota Fortuner'
                },
                {
                    name: 'Toyota Agya GR Merah'
                },
            ],

            customerData: {},

            staffData: {
                supervisors: [],
                securities: []
            },

            async init() {
                // Baca dari 'theme' (appearance page) atau fallback ke 'darkMode' lama
                const savedThemeKey = localStorage.getItem('theme');
                if (savedThemeKey) {
                    if (savedThemeKey === 'system') {
                        this.darkMode = window.matchMedia('(prefers-color-scheme: dark)')
                            .matches;
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

                // Dengarkan perubahan dari appearance page atau tab lain
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

                // System theme: ikuti perubahan OS
                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (
                    e) => {
                        if (localStorage.getItem('theme') === 'system') {
                            this.darkMode = e.matches;
                            this.applyTheme();
                        }
                    });

                await this.$nextTick();

                this.$watch('managementSearchQuery', () => {
                    this.managementCurrentPage = 1;
                });

                this.$watch('managementViewType', () => {
                    this.managementCurrentPage = 1;
                });

                this.$watch('bookingDataSearchQuery', () => {
                    this.bookingCurrentPage = 1;
                });

                this.$watch('bookingViewType', () => {
                    this.bookingCurrentPage = 1;
                });

                const today = new Date().toISOString().split('T')[0];
                this.newBooking.bookingDate = today;

                await this.loadBookings();
                await this.loadStaffData();
                await this.loadCustomerData();
            },

            async loadBookings() {
                try {
                    const response = await fetch('/api/bookings', {
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').content
                        }
                    });

                    if (response.ok) {
                        const data = await response.json();
                        this.bookings = data.data || [];
                    }
                } catch (error) {
                    console.error('Error loading bookings:', error);
                }
            },

            async loadStaffData() {
                try {
                    const response = await fetch('/api/bookings/staff', {
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').content
                        }
                    });

                    if (response.ok) {
                        const data = await response.json();
                        this.staffData = data.data;
                    }
                } catch (error) {
                    console.error('Error loading staff data:', error);
                }
            },

            async loadCustomerData() {
                try {
                    const response = await fetch('/api/bookings/customers', {
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').content
                        }
                    });

                    if (response.ok) {
                        const data = await response.json();

                        this.customerData = {};
                        data.data.forEach(customer => {
                            this.customerData[customer.name] = customer;
                        });
                    }
                } catch (error) {
                    console.error('Error loading customer data:', error);
                }
            },

            async addBooking() {
                if (!this.newBooking.customer.trim()) {
                    alert('Nama lengkap harus diisi!');
                    return;
                }
                if (!this.newBooking.phone.trim()) {
                    alert('No. telepon harus diisi!');
                    return;
                }
                if (!this.newBooking.email.trim()) {
                    alert('Email harus diisi!');
                    return;
                }
                if (!this.newBooking.ktp.trim()) {
                    alert('No. KTP harus diisi!');
                    return;
                }
                if (!this.newBooking.address.trim()) {
                    alert('Alamat harus diisi!');
                    return;
                }
                if (!this.newBooking.car) {
                    alert('Pilih mobil terlebih dahulu!');
                    return;
                }
                if (!this.newBooking.spv) {
                    alert('Pilih SPV terlebih dahulu!');
                    return;
                }
                if (!this.newBooking.security) {
                    alert('Pilih Security terlebih dahulu!');
                    return;
                }
                if (!this.newBooking.bookingDate.trim()) {
                    alert('Tanggal booking harus diisi!');
                    return;
                }

                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(this.newBooking.email)) {
                    alert('Format email tidak valid!');
                    return;
                }

                const phoneRegex = /^[0-9]{10,13}$/;
                if (!phoneRegex.test(this.newBooking.phone.replace(/\D/g, ''))) {
                    alert('No. telepon harus berupa angka 10-13 digit!');
                    return;
                }

                if (this.newBooking.ktp.length !== 16) {
                    alert('No. KTP harus 16 digit!');
                    return;
                }

                try {
                    let bookingData = {
                        booking_type: this.newBooking.bookingType,
                        nama_lengkap: this.newBooking.customer.trim(),
                        nomor_telepon: this.newBooking.phone.trim(),
                        email: this.newBooking.email.trim(),
                        mobil_test_drive: this.newBooking.car,
                        tanggal_booking: this.newBooking.bookingDate,
                        supervisor_id: this.staffData.supervisors.find(s => s.name === this
                            .newBooking.spv)?.id,
                        security_id: this.staffData.securities.find(s => s.name === this
                            .newBooking.security)?.id
                    };

                    if (this.newBooking.bookingType === 'test_drive') {
                        bookingData.no_ktp = this.newBooking.ktp.trim();
                        bookingData.test_drive_location = this.newBooking.testDriveLocation
                            .trim();
                        bookingData.sales_name = this.newBooking.salesName.trim();
                        bookingData.sales_phone = this.newBooking.salesPhone.trim();
                        bookingData.test_drive_time = this.newBooking.testDriveTime;
                    } else {
                        bookingData.no_ktp = '0000000000000000';
                        bookingData.event_date = this.newBooking.eventDate;
                        bookingData.event_location = this.newBooking.eventLocation.trim();
                    }

                    const response = await fetch('/api/bookings/manual', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify(bookingData)
                    });

                    const data = await response.json();

                    if (response.ok && data.success) {
                        this.showNotification('Booking berhasil ditambahkan!', 'success');

                        await this.loadBookings();
                        await this.loadCustomerData();

                        const today = new Date().toISOString().split('T')[0];
                        this.newBooking = {
                            customer: '',
                            phone: '',
                            email: '',
                            ktp: '',
                            address: '',
                            car: '',
                            spv: '',
                            security: '',
                            bookingDate: today,
                            bookingType: 'test_drive',
                            salesName: '',
                            salesPhone: '',
                            testDriveTime: '',
                            testDriveLocation: '',
                            targetProspect: '',
                            eventDate: '',
                            eventLocation: ''
                        };
                    } else {
                        this.showNotification(data.message || 'Gagal menambahkan booking',
                            'error');
                    }
                } catch (error) {
                    console.error('Error adding booking:', error);
                    this.showNotification('Terjadi kesalahan saat menambahkan booking',
                        'error');
                }
            },

            async updateBookingStatus() {
                if (this.selectedBookingIndex !== null && this.newStatus) {
                    const booking = this.bookings[this.selectedBookingIndex];

                    const bookingType = this.selectedBooking?.booking_type || booking
                        .booking_type || 'test_drive';

                    console.log('🚀 Sending status update:', {
                        booking_id: booking.id,
                        booking_type: bookingType,
                        old_status: booking.status,
                        new_status: this.newStatus,
                        user_role: '{{ auth()->user()->role }}'
                    });

                    const userRole = '{{ auth()->user()->role }}';

                    if (userRole === 'branch_manager') {
                        if (!['Dikonfirmasi', 'Dibatalkan'].includes(this.newStatus)) {
                            this.showNotification(
                                'Branch Manager hanya dapat:\n' +
                                'Approve (Dikonfirmasi)\n' +
                                'Disapprove/Cancel (Dibatalkan)',
                                'error'
                            );
                            return;
                        }

                        if (this.newStatus === 'Dikonfirmasi') {
                            if (booking.status !== 'Diproses') {
                                this.showNotification(
                                    `Branch Manager hanya dapat approve booking dengan status "Diproses".\n\n` +
                                    `Status booking saat ini: "${booking.status}"`,
                                    'error'
                                );
                                return;
                            }
                        } else if (this.newStatus === 'Dibatalkan') {
                            if (!['Diproses', 'Dikonfirmasi'].includes(booking.status)) {
                                this.showNotification(
                                    `Branch Manager hanya dapat cancel booking dengan status "Diproses" atau "Dikonfirmasi".\n\n` +
                                    `Status booking saat ini: "${booking.status}"`,
                                    'error'
                                );
                                return;
                            }
                        }
                    } else if (userRole === 'spv') {

                        if (booking.status !== 'Menunggu') {
                            this.showNotification(
                                `SPV hanya dapat approve/cancel booking dengan status "Menunggu".\n\n` +
                                `Status booking saat ini: "${booking.status}"`,
                                'error'
                            );
                            return;
                        }

                        if (!['Diproses', 'Dibatalkan'].includes(this.newStatus)) {
                            this.showNotification(
                                'SPV hanya dapat:\n' +
                                'Approve (Diproses)\n' +
                                'Cancel (Dibatalkan)',
                                'error'
                            );
                            return;
                        }
                    }

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
                                status: this.newStatus,
                                booking_type: bookingType
                            })
                        });

                        const data = await response.json();

                        if (response.ok && data.success) {
                            this.showNotification(data.message, 'success');
                            await this.loadBookings();
                            this.statusModal = false;
                            this.selectedBooking = null;
                            this.selectedBookingIndex = null;
                        } else {
                            this.showNotification(data.message || 'Gagal update status',
                                'error');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        this.showNotification('Terjadi kesalahan saat update status', 'error');
                    }
                }
            },

            get paginatedBookingData() {
                const filtered = this.filteredBookingData;
                const start = (this.bookingCurrentPage - 1) * this.bookingItemsPerPage;
                const end = start + this.bookingItemsPerPage;
                return filtered.slice(start, end);
            },

            get bookingTotalPages() {
                return Math.ceil(this.filteredBookingData.length / this.bookingItemsPerPage) ||
                    1;
            },

            get bookingStartIndex() {
                return (this.bookingCurrentPage - 1) * this.bookingItemsPerPage;
            },

            get bookingEndIndex() {
                return this.bookingCurrentPage * this.bookingItemsPerPage;
            },

            get paginatedManagementBookings() {
                const filtered = this.filteredManagementBookings;
                const start = (this.managementCurrentPage - 1) * this.managementItemsPerPage;
                const end = start + this.managementItemsPerPage;
                return filtered.slice(start, end);
            },

            get managementTotalPages() {
                return Math.ceil(this.filteredManagementBookings.length / this
                    .managementItemsPerPage) || 1;
            },

            get managementStartIndex() {
                return (this.managementCurrentPage - 1) * this.managementItemsPerPage;
            },

            get managementEndIndex() {
                return this.managementCurrentPage * this.managementItemsPerPage;
            },

            nextManagementPage() {
                if (this.managementCurrentPage < this.managementTotalPages) {
                    this.managementCurrentPage++;
                }
            },

            prevManagementPage() {
                if (this.managementCurrentPage > 1) {
                    this.managementCurrentPage--;
                }
            },

            goToManagementPage(page) {
                if (typeof page === 'number' && page >= 1 && page <= this.managementTotalPages) {
                    this.managementCurrentPage = page;
                }
            },

            nextBookingPage() {
                if (this.bookingCurrentPage < this.bookingTotalPages) {
                    this.bookingCurrentPage++;
                }
            },

            prevBookingPage() {
                if (this.bookingCurrentPage > 1) {
                    this.bookingCurrentPage--;
                }
            },

            goToBookingPage(page) {
                if (typeof page === 'number' && page >= 1 && page <= this.bookingTotalPages) {
                    this.bookingCurrentPage = page;
                }
            },

            get managementVisiblePages() {
                const total = this.managementTotalPages;
                const current = this.managementCurrentPage;
                const pages = [];
                if (total <= 7) {
                    for (let i = 1; i <= total; i++) pages.push(i);
                } else {
                    if (current <= 3) pages.push(1, 2, 3, 4, '...', total);
                    else if (current >= total - 2) pages.push(1, '...', total - 3, total - 2,
                        total - 1, total);
                    else pages.push(1, '...', current - 1, current, current + 1, '...', total);
                }
                return pages;
            },

            get bookingVisiblePages() {
                const total = this.bookingTotalPages;
                const current = this.bookingCurrentPage;
                const pages = [];
                if (total <= 7) {
                    for (let i = 1; i <= total; i++) pages.push(i);
                } else {
                    if (current <= 3) pages.push(1, 2, 3, 4, '...', total);
                    else if (current >= total - 2) pages.push(1, '...', total - 3, total - 2,
                        total - 1, total);
                    else pages.push(1, '...', current - 1, current, current + 1, '...', total);
                }
                return pages;
            },

            getOriginalIndex(booking) {
                return this.bookings.findIndex(b =>
                    b.id === booking.id && b.booking_type === booking.booking_type
                );
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

            get filteredBookings() {
                let filtered = this.bookings;

                if (this.searchQuery.trim()) {
                    const query = this.searchQuery.toLowerCase();
                    filtered = filtered.filter(booking =>
                        booking.customer.toLowerCase().includes(query) ||
                        booking.car.toLowerCase().includes(query) ||
                        booking.status.toLowerCase().includes(query) ||
                        booking.date.toLowerCase().includes(query)
                    );
                }

                if (this.filters.car) {
                    filtered = filtered.filter(booking => booking.car === this.filters.car);
                }

                if (this.filters.status) {
                    filtered = filtered.filter(booking => booking.status === this.filters
                        .status);
                }

                if (this.filters.dateFrom || this.filters.dateTo) {
                    filtered = filtered.filter(booking =>
                        this.isDateInRange(booking.date, this.filters.dateFrom, this.filters
                            .dateTo)
                    );
                }

                return this.applySorting(filtered);
            },

            get filteredCustomers() {
                const customers = this.getAllCustomers();
                if (!this.customerSearchQuery.trim()) return customers;
                const query = this.customerSearchQuery.toLowerCase();
                return customers.filter(customer =>
                    customer.name.toLowerCase().includes(query) ||
                    customer.phone.toLowerCase().includes(query) ||
                    customer.email.toLowerCase().includes(query) ||
                    customer.ktp.toLowerCase().includes(query)
                );
            },

            get bookingsByType() {
                return this.bookings.filter(booking => {
                    return booking.booking_type === this.bookingViewType;
                });
            },

            get filteredBookingData() {
                let filtered = this.bookingsByType;
                if (this.bookingDataSearchQuery.trim()) {
                    const query = this.bookingDataSearchQuery.toLowerCase();
                    filtered = filtered.filter(booking =>
                        booking.customer.toLowerCase().includes(query) ||
                        booking.car.toLowerCase().includes(query) ||
                        booking.date.toLowerCase().includes(query) ||
                        (booking.phone && booking.phone.includes(query)) ||
                        (booking.sales_name && booking.sales_name.toLowerCase().includes(
                            query))
                    );
                }

                return filtered;
            },

            get managementBookingsByType() {
                return this.bookings.filter(booking => {
                    return booking.booking_type === this.managementViewType;
                });
            },

            get filteredManagementBookings() {
                let filtered = this.managementBookingsByType;
                if (this.managementSearchQuery.trim()) {
                    const query = this.managementSearchQuery.toLowerCase();
                    filtered = filtered.filter(booking =>
                        booking.customer.toLowerCase().includes(query) ||
                        booking.car.toLowerCase().includes(query) ||
                        booking.date.toLowerCase().includes(query) ||
                        (booking.phone && booking.phone.includes(query)) ||
                        (booking.sales_name && booking.sales_name.toLowerCase().includes(
                            query)) ||
                        (booking.spv && booking.spv.toLowerCase().includes(query)) ||
                        booking.status.toLowerCase().includes(query)
                    );
                }

                if (this.managementSPVFilter) {
                    filtered = filtered.filter(booking => booking.spv === this
                        .managementSPVFilter);
                }

                if (this.managementSPVSort && !this.managementSPVFilter) {
                    filtered = [...filtered].sort((a, b) => {
                        const spvA = (a.spv || '').toLowerCase();
                        const spvB = (b.spv || '').toLowerCase();
                        const comparison = spvA.localeCompare(spvB);
                        return this.managementSPVSort === 'asc' ? comparison : -
                            comparison;
                    });
                }

                if (this.managementStatusFilter) {
                    filtered = filtered.filter(booking => booking.status === this
                        .managementStatusFilter);
                }

                if (this.managementStatusSort) {
                    filtered = [...filtered].sort((a, b) => {
                        const orderA = this.statusOrder[a.status] || 999;
                        const orderB = this.statusOrder[b.status] || 999;

                        return this.managementStatusSort === 'asc' ?
                            orderA - orderB :
                            orderB - orderA;
                    });
                }

                return filtered;
            },

            openManagementDetailModal(booking) {
                this.selectedManagementBooking = booking;
                this.managementDetailModal = true;
            },

            openStatusModalFromManagement(booking) {
                const originalIndex = this.getOriginalIndex(booking);

                this.selectedBooking = {
                    ...booking,
                    booking_type: booking.booking_type ||
                        'test_drive'
                };
                this.selectedBookingIndex = originalIndex;

                console.log('📋 Selected Booking:', {
                    id: this.selectedBooking.id,
                    booking_type: this.selectedBooking.booking_type,
                    customer: this.selectedBooking.customer,
                    status: this.selectedBooking.status
                });

                const userRole = '{{ auth()->user()->role }}';
                const currentStatus = this.selectedBooking.status;

                if (userRole === 'spv') {
                    this.newStatus = 'Diproses';
                } else if (userRole === 'branch_manager') {
                    this.newStatus = 'Dikonfirmasi';
                } else {
                    this.newStatus = currentStatus;
                }

                this.statusModal = true;
            },

            get hasActiveFilters() {
                return !!(this.filters.car || this.filters.status || this.filters.dateFrom ||
                    this.filters.dateTo);
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
                if (this.filters.status) {
                    filters.push({
                        type: 'status',
                        label: `Status: ${this.filters.status}`
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

            getChecksheetButtonClass(customerEmail) {
                const customer = Object.values(this.customerData).find(c => c.email ===
                    customerEmail);

                if (!customer || !customer.checksheetSummary || customer.checksheetSummary
                    .length === 0) {
                    return 'bg-gray-600 hover:bg-gray-700';
                }

                const hasWarning = customer.checksheetSummary.some(summary => {
                    const hasChanged = summary.changed_conditions && summary
                        .changed_conditions.length > 0;
                    const hasPinjamIssues = summary.pinjam_issues && summary.pinjam_issues
                        .length > 0;
                    const hasKembaliIssues = summary.kembali_issues && summary
                        .kembali_issues.length > 0;
                    const hasDokumenIssues = summary.dokumen_issues && summary
                        .dokumen_issues.length > 0;
                    const hasKelengkapanIssues = summary.kelengkapan_issues && summary
                        .kelengkapan_issues.length > 0;
                    const hasFuelChanged = summary.fuel_changed;

                    return hasChanged || hasPinjamIssues || hasKembaliIssues ||
                        hasDokumenIssues || hasKelengkapanIssues || hasFuelChanged ||
                        summary.status === 'warning';
                });

                if (hasWarning) {
                    return 'bg-red-600 hover:bg-red-700';
                } else {
                    return 'bg-green-600 hover:bg-green-700';
                }
            },

            toggleTheme() {
                this.darkMode = !this.darkMode;
                localStorage.setItem('darkMode', this.darkMode.toString());
                localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
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

            clearAllFilters() {
                this.filters = {
                    car: '',
                    status: '',
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

            toggleSort(field) {
                if (this.sorting[field] === '') {
                    this.sorting[field] = 'asc';
                } else if (this.sorting[field] === 'asc') {
                    this.sorting[field] = 'desc';
                } else {
                    this.sorting[field] = '';
                }
            },

            openCustomerDetail(customerName) {
                this.selectedCustomerDetail = this.customerData[customerName] || null;
                this.customerDetailModal = true;
            },

            openCustomerDetailFromBooking(booking) {
                if (this.customerData[booking.customer]) {
                    this.openCustomerDetail(booking.customer);
                    return;
                }

                this.selectedCustomerDetail = {
                    name: booking.customer,
                    phone: booking.phone,
                    email: booking.email,
                    ktp: booking.ktp || '-',
                    address: booking.address || '-',
                    assignedSPV: booking.spv,
                    assignedSecurity: booking.security,
                    totalBookings: 1,
                    bookingHistory: [{
                        date: booking.date,
                        car: booking.car,
                        status: booking.status
                    }]
                };

                this.customerDetailModal = true;
            },

            openStatusModalFromBookingData(booking) {
                const originalIndex = this.getOriginalIndex(booking);
                this.openStatusModal(originalIndex);
            },

            openEditCustomer(customerName) {
                const customer = this.customerData[customerName];
                if (customer) {
                    this.editingCustomer = {
                        originalName: customerName,
                        name: customer.name,
                        phone: customer.phone,
                        email: customer.email,
                        ktp: customer.ktp,
                        address: customer.address,
                        assignedSPV: customer.assignedSPV,
                        assignedSecurity: customer.assignedSecurity
                    };
                    this.customerDetailModal = false;
                    this.editCustomerModal = true;
                }
            },

            async updateCustomer() {
                if (!this.editingCustomer.name.trim()) {
                    alert('Nama harus diisi!');
                    return;
                }
                if (!this.editingCustomer.phone.trim()) {
                    alert('No. telepon harus diisi!');
                    return;
                }
                if (!this.editingCustomer.email.trim()) {
                    alert('Email harus diisi!');
                    return;
                }
                if (!this.editingCustomer.ktp.trim()) {
                    alert('No. KTP harus diisi!');
                    return;
                }
                if (!this.editingCustomer.address.trim()) {
                    alert('Alamat harus diisi!');
                    return;
                }

                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(this.editingCustomer.email)) {
                    alert('Format email tidak valid!');
                    return;
                }

                const phoneRegex = /^[0-9]{10,13}$/;
                if (!phoneRegex.test(this.editingCustomer.phone.replace(/\D/g, ''))) {
                    alert('No. telepon harus berupa angka 10-13 digit!');
                    return;
                }

                if (this.editingCustomer.ktp.length !== 16) {
                    alert('No. KTP harus 16 digit!');
                    return;
                }

                try {
                    const originalCustomer = this.customerData[this.editingCustomer
                        .originalName];

                    const response = await fetch('/api/bookings/customers/update', {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            original_email: originalCustomer.email,
                            nama_lengkap: this.editingCustomer.name.trim(),
                            nomor_telepon: this.editingCustomer.phone.trim(),
                            email: this.editingCustomer.email.trim(),
                            no_ktp: this.editingCustomer.ktp.trim(),
                            alamat: this.editingCustomer.address.trim(),
                            supervisor_id: this.staffData.supervisors.find(s =>
                                    s.name === this.editingCustomer.assignedSPV)
                                ?.id,
                            security_id: this.staffData.securities.find(s => s
                                .name === this.editingCustomer
                                .assignedSecurity)?.id
                        })
                    });

                    const data = await response.json();

                    if (response.ok && data.success) {
                        this.showNotification('Data customer berhasil diupdate!', 'success');

                        await this.loadBookings();
                        await this.loadCustomerData();

                        this.editCustomerModal = false;
                        this.editingCustomer = null;
                    } else {
                        this.showNotification(data.message || 'Gagal update customer', 'error');
                    }
                } catch (error) {
                    console.error('Error updating customer:', error);
                    this.showNotification('Terjadi kesalahan saat update customer', 'error');
                }
            },

            openStatusModal(bookingIndex) {
                this.selectedBookingIndex = bookingIndex;
                this.selectedBooking = this.bookings[bookingIndex];

                const userRole = '{{ auth()->user()->role }}';
                const currentStatus = this.selectedBooking.status;

                if (userRole === 'spv') {
                    this.newStatus = 'Diproses';
                } else if (userRole === 'branch_manager') {
                    this.newStatus = 'Dikonfirmasi';
                } else {
                    this.newStatus = currentStatus;
                }

                this.statusModal = true;
            },

            getAllCustomers() {
                return Object.keys(this.customerData).map(name => {
                    const customerInfo = this.customerData[name];
                    return {
                        ...customerInfo,
                        totalBookings: customerInfo.totalBookings || 0,
                        lastCar: customerInfo.lastCar || null
                    };
                });
            },

            showNotification(message, type = 'info') {
                const notification = document.createElement('div');
                const bgColor = type === 'error' ? 'bg-red-500' : type === 'success' ?
                    'bg-green-500' : 'bg-blue-500';
                notification.className =
                    `fixed top-4 right-4 z-[9999] p-4 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full ${bgColor}`;
                notification.innerHTML = `
                    <div class="flex items-center gap-2">
                        <span class="text-white">${message}</span>
                        <button onclick="this.parentElement.parentElement.remove()" class="ml-2 text-white hover:text-gray-200">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                `;

                document.body.appendChild(notification);

                setTimeout(() => {
                    notification.classList.remove('translate-x-full');
                }, 100);

                setTimeout(() => {
                    notification.classList.add('translate-x-full');
                    setTimeout(() => {
                        if (notification.parentElement) {
                            notification.remove();
                        }
                    }, 300);
                }, 3000);
            },
            async viewChecksheetSummary(customerEmail) {
                try {
                    const response = await fetch(
                        `/api/bookings/customers/${encodeURIComponent(customerEmail)}/checksheet-summary`, {
                            headers: {
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').content
                            }
                        });

                    if (response.ok) {
                        const data = await response.json();
                        this.selectedChecksheetSummary = data.data;
                        this.checksheetSummaryModal = true;
                    } else {
                        this.showNotification('Gagal memuat summary checksheet', 'error');
                    }
                } catch (error) {
                    console.error('Error loading checksheet summary:', error);
                    this.showNotification('Terjadi kesalahan saat memuat summary', 'error');
                }
            },
            getCsrfToken() {
                const token = document.querySelector('meta[name="csrf-token"]');
                return token ? token.getAttribute('content') : '';
            },

            isAdmin() {
                return '{{ auth()->user()->role }}' === 'admin';
            },

            isSPV() {
                return '{{ auth()->user()->role }}' === 'spv';
            },

            isBranchManager() {
                return '{{ auth()->user()->role }}' === 'branch_manager';
            }
        }));
    });
</script>
