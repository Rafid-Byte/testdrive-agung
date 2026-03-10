<script>
        function pameranInfoData() {
            return {
                sidebarOpen: window.innerWidth >= 1024,
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
                        this.darkMode = savedDarkMode !== null
                            ? savedDarkMode === 'true'
                            : window.matchMedia('(prefers-color-scheme: dark)').matches;
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
                            this.bookings = (result.data || []).filter(booking => booking && booking.id);
                            this.totalBookings = this.bookings.length;
                            this.calculateStatusCounts();
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