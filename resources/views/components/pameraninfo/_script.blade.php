<script>
    function pameranInfoData() {
        return {
            sidebarOpen: window.innerWidth >= 1024,
            userRole: '{{ auth()->user()->role }}',
            darkMode: localStorage.getItem('darkMode') === 'true',
            bookings: [],
            loading: false,
            searchQuery: '',
            statusFilter: '',
            searchTimeout: null,
            showDetailModal: false,
            showStatusModal: false,
            selectedBooking: null,
            currentBookingId: null,
            newStatus: 'Sedang Pameran',
            totalBookings: 0,
            statusCount: {
                sedangPameran: 0,
                perawatan: 0,
                selesai: 0
            },
            currentPage: 1,
            itemsPerPage: 10,
            picSort: '',
            carFilter: '',
            dateSort: '',
            dateFilter: '',

            get filteredBookings() {
                let result = [...this.bookings];

                // Filter mobil
                if (this.carFilter) {
                    result = result.filter(b => b.mobil === this.carFilter);
                }

                // Filter tanggal acara spesifik (kalender)
                if (this.dateFilter) {
                    result = result.filter(b => {
                        if (!b.tanggal_acara_raw) return false;
                        return b.tanggal_acara_raw === this.dateFilter;
                    });
                }

                // Sort PIC
                if (this.picSort === 'asc') {
                    result.sort((a, b) => (a.nama_pic || '').localeCompare(b.nama_pic || ''));
                } else if (this.picSort === 'desc') {
                    result.sort((a, b) => (b.nama_pic || '').localeCompare(a.nama_pic || ''));
                }

                // Sort tanggal acara
                if (this.dateSort === 'asc') {
                    result.sort((a, b) => new Date(a.tanggal_acara_raw || 0) - new Date(b.tanggal_acara_raw || 0));
                } else if (this.dateSort === 'desc') {
                    result.sort((a, b) => new Date(b.tanggal_acara_raw || 0) - new Date(a.tanggal_acara_raw || 0));
                }

                return result;
            },

            get paginatedBookings() {
                const start = (this.currentPage - 1) * this.itemsPerPage;
                return this.filteredBookings.slice(start, start + this.itemsPerPage);
            },

            get totalPages() {
                return Math.ceil(this.filteredBookings.length / this.itemsPerPage);
            },

            get pageNumbers() {
                const total = this.totalPages;
                const current = this.currentPage;
                const pages = [];

                if (total <= 7) {
                    for (let i = 1; i <= total; i++) pages.push(i);
                } else {
                    pages.push(1);
                    if (current > 3) pages.push('...');
                    for (let i = Math.max(2, current - 1); i <= Math.min(total - 1, current + 1); i++) {
                        pages.push(i);
                    }
                    if (current < total - 2) pages.push('...');
                    pages.push(total);
                }
                return pages;
            },

            sortPic(dir) {
                this.picSort = dir;
                this.currentPage = 1;
            },

            clearPicSort() {
                this.picSort = '';
                this.currentPage = 1;
            },

            filterByCar(car) {
                this.carFilter = car;
                this.currentPage = 1;
            },

            setDateSort(dir) {
                this.dateSort = dir;
                this.dateFilter = '';
                this.currentPage = 1;
            },

            setDateFilter(val) {
                this.dateFilter = val;
                this.dateSort = '';
                this.currentPage = 1;
            },

            clearDateFilter() {
                this.dateFilter = '';
                this.dateSort = '';
                this.currentPage = 1;
            },

            clearAllFilters() {
                this.picSort = '';
                this.carFilter = '';
                this.dateSort = '';
                this.dateFilter = '';
                this.searchQuery = '';
                this.statusFilter = '';
                this.currentPage = 1;
                this.loadBookings();
            },

            goToPage(page) {
                if (page >= 1 && page <= this.totalPages) {
                    this.currentPage = page;
                }
            },

            prevPage() {
                if (this.currentPage > 1) this.goToPage(this.currentPage - 1);
            },

            nextPage() {
                if (this.currentPage < this.totalPages) this.goToPage(this.currentPage + 1);
            },

            init() {
                // Baca dari 'theme' (appearance page) atau fallback ke 'darkMode' lama
                const savedThemeKey = localStorage.getItem('theme');
                if (savedThemeKey) {
                    if (savedThemeKey === 'system') {
                        this.darkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    } else {
                        this.darkMode = savedThemeKey === 'dark';
                    }
                } else {
                    const savedDarkMode = localStorage.getItem('darkMode');
                    this.darkMode = savedDarkMode !== null ?
                        savedDarkMode === 'true' :
                        window.matchMedia('(prefers-color-scheme: dark)').matches;
                }

                this.loadBookings();
                this.setupDarkMode();
            },

            setupDarkMode() {
                if (this.darkMode) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }

                this.$watch('darkMode', value => {
                    document.documentElement.classList.toggle('dark', value);
                    localStorage.setItem('darkMode', value.toString());
                });

                // Dengarkan perubahan dari appearance page atau tab lain
                window.addEventListener('storage', (e) => {
                    if (e.key === 'theme') {
                        if (e.newValue === 'system') {
                            this.darkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
                        } else if (e.newValue) {
                            this.darkMode = e.newValue === 'dark';
                        }
                    } else if (e.key === 'darkMode') {
                        this.darkMode = e.newValue === 'true';
                    }
                });

                // System theme: ikuti perubahan OS
                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
                    if (localStorage.getItem('theme') === 'system') {
                        this.darkMode = e.matches;
                    }
                });
            },

            toggleTheme() {
                this.darkMode = !this.darkMode;
                localStorage.setItem('darkMode', this.darkMode.toString());
                localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
                document.documentElement.classList.toggle('dark', this.darkMode);
            },

            debounceSearch() {
                clearTimeout(this.searchTimeout);
                this.searchTimeout = setTimeout(() => {
                    this.loadBookings();
                }, 300);
            },

            async loadBookings() {
                this.loading = true;
                try {
                    const params = new URLSearchParams();
                    if (this.searchQuery) params.append('search', this.searchQuery);
                    if (this.statusFilter) params.append('status', this.statusFilter);

                    const response = await fetch(`/api/pameran-info?${params.toString()}`, {
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    });

                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    const result = await response.json();

                    if (result.success) {
                        this.bookings = (result.data || [])
                            .filter(booking => booking && booking.id)
                            .map(b => ({
                                ...b,
                                tanggal_acara_raw: b.tanggal_acara_raw || b.tanggal_acara || ''
                            }));
                        this.totalBookings = this.bookings.length;
                        this.calculateStatusCounts();
                        this.currentPage = 1;
                        this.picSort = '';
                        this.carFilter = '';
                        this.dateSort = '';
                        this.dateFilter = '';
                    } else {
                        console.error('API returned error:', result.message);
                        this.showNotification('error', 'Gagal memuat data');
                        this.bookings = [];
                        this.totalBookings = 0;
                    }
                } catch (error) {
                    console.error('Error loading bookings:', error);
                    this.showNotification('error', 'Terjadi kesalahan saat memuat data');
                    this.bookings = [];
                    this.totalBookings = 0;
                } finally {
                    this.loading = false;
                }
            },

            calculateStatusCounts() {
                this.statusCount = {
                    sedangPameran: this.bookings.filter(b => b && b.status === 'Sedang Pameran').length,
                    perawatan: this.bookings.filter(b => b && b.status === 'Perawatan').length,
                    selesai: this.bookings.filter(b => b && b.status === 'Selesai').length
                };
            },

            async showDetail(bookingId) {
                if (!bookingId) return;

                try {
                    const response = await fetch(`/api/pameran-info/${bookingId}`, {
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    });

                    const result = await response.json();

                    if (result.success && result.data) {
                        this.selectedBooking = result.data;
                        this.showDetailModal = true;
                    } else {
                        this.showNotification('error', 'Gagal memuat detail booking');
                    }
                } catch (error) {
                    console.error('Error loading detail:', error);
                    this.showNotification('error', 'Terjadi kesalahan saat memuat detail');
                }
            },

            canUpdateStatus(booking) {
                // Admin bisa update semua status
                if (this.userRole === 'admin') return true;
                // Non-admin tidak bisa ubah status Dibatalkan
                if (booking.status === 'Dibatalkan') return false;
                // Security tidak bisa ubah jika masih Diproses
                return booking.status !== 'Diproses';
            },

            openStatusModal(bookingId) {
                if (!bookingId) return;
                this.currentBookingId = bookingId;
                this.showStatusModal = true;
            },

            async updateStatus() {
                if (!this.currentBookingId) return;

                try {
                    const response = await fetch(`/api/pameran-info/${this.currentBookingId}/status`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            status: this.newStatus
                        })
                    });

                    const result = await response.json();

                    if (result.success) {
                        this.showNotification('success', 'Status berhasil diperbarui');
                        this.showStatusModal = false;
                        this.loadBookings();
                    } else {
                        this.showNotification('error', result.message || 'Gagal memperbarui status');
                    }
                } catch (error) {
                    console.error('Error updating status:', error);
                    this.showNotification('error', 'Terjadi kesalahan saat memperbarui status');
                }
            },

            showNotification(type, message) {
                if (type === 'success') {
                    alert('✅ ' + message);
                } else {
                    alert('❌ ' + message);
                }
            }
        }
    }
</script>
