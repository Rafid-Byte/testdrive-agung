<script>
    function bookingApp() {
        return {
            showModal: false,
            showUnitModal: false,
            selectedCar: '',
            selectedSPV: '',
            spvList: [],
            isCarLocked: false,
            isBookingTypeLocked: false,
            isLoading: false,
            bookingType: 'test_drive',
            notifications: [],
            isAuthenticated: {{ auth()->check() ? 'true' : 'false' }},
            userRole: '{{ auth()->check() ? auth()->user()->role : 'guest' }}',
            availableUnits: {},
            bookingForm: {
                car: '',
                sales_name: '',
                sales_phone: '',
                customer_name: '',
                customer_phone: '',
                email: '',
                ktp: '',
                test_drive_time: '',
                test_drive_location: '',
                pic_name: '',
                pic_phone: '',
                pic_email: '',
                target_prospect: '',
                event_date: '',
                event_location: '',
                start_date: '',
                end_date: ''
            },

            handleBookingClick(carName) {
                if (!this.isAuthenticated) {
                    this.showAlert(
                        '🔒 Login Required!\n\n' +
                        'Anda harus login dengan akun Sales terlebih dahulu untuk melakukan booking.\n\n' +
                        'Silakan klik tombol "Sign In" di pojok kanan atas untuk login.',
                        'error'
                    );
                    return;
                }

                if (this.userRole !== 'sales' && this.userRole !== 'admin') {
                    this.showAlert(
                        '⚠️ Access Denied!\n\n' +
                        'Hanya akun Sales yang dapat melakukan booking dari halaman ini.\n\n' +
                        'Role Anda saat ini: ' + this.userRole.toUpperCase() + '\n\n' +
                        'Silakan hubungi administrator jika Anda memerlukan akses.',
                        'error'
                    );
                    return;
                }

                const unitInfo = this.getUnitInfo(carName);
                if (!unitInfo.available || unitInfo.status_code !== 'available') {
                    this.showAlert(
                        '🚫 Kendaraan Tidak Tersedia!\n\n' +
                        'Kendaraan: ' + carName + '\n' +
                        'Status: ' + unitInfo.status + '\n\n' +
                        'Mohon pilih kendaraan lain yang tersedia atau tunggu hingga kendaraan ini tersedia kembali.',
                        'error'
                    );
                    return;
                }

                this.selectedCar = carName;
                this.isCarLocked = true;
                this.showModal = true;
            },

            availableUnits: {
                'Toyota Hilux Rangga': {
                    available: true,
                    status: 'Tersedia'
                },
                'Toyota Raize Abu Abu': {
                    available: true,
                    status: 'Tersedia'
                },
                'Toyota Zenix': {
                    available: false,
                    status: 'Sedang Test Drive'
                },
                'Toyota Agya Putih': {
                    available: true,
                    status: 'Tersedia'
                },
                'Toyota Fortuner': {
                    available: false,
                    status: 'Perawatan'
                },
                'Toyota Agya GR Merah': {
                    available: true,
                    status: 'Tersedia'
                }
            },

            init() {
                @auth
                this.loadNotifications();
                setInterval(() => {
                    this.checkNewNotifications();
                }, 30000);
            @endauth
        },

        async init() {
            await this.loadSPVList();
            await this.loadVehicleStatus();

            @auth
            this.loadNotifications();
            setInterval(() => {
                this.checkNewNotifications();
            }, 30000);
            setInterval(() => {
                this.loadVehicleStatus();
            }, 30000);
        @endauth
    },

    async loadSPVList() {
            try {
                console.log('🔄 Loading SPV list...');

                const response = await fetch('/api/spv-list', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': this.getCsrfToken()
                    }
                });

                if (response.ok) {
                    const data = await response.json();
                    this.spvList = data.data || [];
                    console.log('✅ SPV List loaded:', this.spvList);
                } else {
                    console.error('❌ Failed to load SPV list:', response.status);
                    this.spvList = [];
                }
            } catch (error) {
                console.error('❌ Error loading SPV list:', error);
                this.spvList = [];
            }
        },

        async loadNotifications() {
            @auth
            try {
                const response = await fetch('/api/notifications', {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': this.getCsrfToken()
                    }
                });

                if (response.ok) {
                    const data = await response.json();
                    this.notifications = data.data || [];
                }
            } catch (error) {
                console.error('Error loading notifications:', error);
            }
        @endauth
    },

    async checkNewNotifications() {
        @auth
        try {
            const response = await fetch('/api/notifications/new', {
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': this.getCsrfToken()
                }
            });

            if (response.ok) {
                const data = await response.json();
                if (data.data && data.data.length > 0) {
                    data.data.forEach(notification => {
                        this.showNotification(notification.message, notification.type);
                    });
                }
            }
        } catch (error) {
            console.error('Error checking notifications:', error);
        }
    @endauth
    },

    async loadVehicleStatus() {
            try {
                console.log('🔄 Loading vehicle status...');

                const response = await fetch('/api/vehicle-status', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': this.getCsrfToken()
                    }
                });

                if (response.ok) {
                    const data = await response.json();
                    this.availableUnits = data.data || {};
                    console.log('✅ Vehicle status loaded:', this.availableUnits);
                } else {
                    console.error('❌ Failed to load vehicle status:', response.status);
                    this.setDefaultVehicleStatus();
                }
            } catch (error) {
                console.error('❌ Error loading vehicle status:', error);
                this.setDefaultVehicleStatus();
            }
        },

        setDefaultVehicleStatus() {
            this.availableUnits = {
                'Toyota Hilux Rangga': {
                    available: true,
                    status: 'Tersedia',
                    status_code: 'available'
                },
                'Toyota Raize Abu Abu': {
                    available: true,
                    status: 'Tersedia',
                    status_code: 'available'
                },
                'Toyota Zenix': {
                    available: true,
                    status: 'Tersedia',
                    status_code: 'available'
                },
                'Toyota Agya Putih': {
                    available: true,
                    status: 'Tersedia',
                    status_code: 'available'
                },
                'Toyota Fortuner': {
                    available: true,
                    status: 'Tersedia',
                    status_code: 'available'
                },
                'Toyota Agya GR Merah': {
                    available: true,
                    status: 'Tersedia',
                    status_code: 'available'
                }
            };
        },

        showNotification(message, type = 'info') {
            const notifDiv = document.createElement('div');
            const bgColor = type === 'approved' ? 'bg-green-500' :
                type === 'rejected' ? 'bg-red-500' :
                type === 'warning' ? 'bg-yellow-500' : 'bg-blue-500';

            const icon = type === 'approved' ? '✔' :
                type === 'rejected' ? '✕' :
                type === 'warning' ? '⚠' : 'ℹ';

            notifDiv.className =
                `fixed top-20 right-4 z-[9999] px-6 py-4 rounded-lg text-white font-medium shadow-2xl ${bgColor} transform translate-x-full transition-all duration-300`;
            notifDiv.innerHTML = `
                    <div class="flex items-start gap-3">
                        <span class="text-2xl">${icon}</span>
                        <div class="flex-1">
                            <p class="font-bold text-sm mb-1">Notifikasi dari Sistem</p>
                            <p class="text-sm">${message}</p>
                        </div>
                        <button onclick="this.parentElement.parentElement.remove()" class="ml-2 text-white/80 hover:text-white">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                `;

            document.body.appendChild(notifDiv);
            setTimeout(() => notifDiv.classList.remove('translate-x-full'), 100);
            setTimeout(() => {
                if (notifDiv.parentNode) {
                    notifDiv.classList.add('translate-x-full');
                    setTimeout(() => notifDiv.remove(), 300);
                }
            }, 8000);
        },

        getUnitInfo(carName) {
            return this.availableUnits[carName] || {
                available: false,
                status: 'Unknown'
            };
        },

        closeModal() {
            this.showModal = false;
            setTimeout(() => {
                this.resetForm();
                this.isCarLocked = false;
                this.isBookingTypeLocked = false;
            }, 300);
        },

        openQuickBooking(type) {
            if (!this.isAuthenticated) {
                this.showAlert(
                    '🔒 Login Required!\n\n' +
                    'Anda harus login dengan akun Sales terlebih dahulu untuk melakukan booking.\n\n' +
                    'Silakan login dengan akun sales.',
                    'error'
                );
                return;
            }

            if (this.userRole !== 'sales' && this.userRole !== 'admin') {
                this.showAlert(
                    '⚠️ Access Denied!\n\n' +
                    'Hanya akun Sales yang dapat melakukan booking dari halaman ini.\n\n' +
                    'Role Anda saat ini: ' + this.userRole.toUpperCase(),
                    'error'
                );
                return;
            }

            const typeName = type === 'test_drive' ? 'Test Drive' : 'Pameran/Movex';
            const confirmation = confirm(
                `Apakah Anda ingin membuat booking ${typeName}?\n\nAnda akan diarahkan ke form booking.`);

            if (confirmation) {
                this.bookingType = type;
                this.isBookingTypeLocked = true;
                this.selectedCar = '';
                this.isCarLocked = false;
                this.showModal = true;
                this.showAlert(`Form booking ${typeName} dibuka. Silakan pilih mobil terlebih dahulu.`, 'info');
            }
        },

        async submitBooking() {
                if (!this.selectedSPV) {
                    this.showAlert('Pilih Supervisor (SPV) terlebih dahulu!', 'error');
                    return;
                }
                if (!this.selectedCar) {
                    this.showAlert('Pilih kendaraan terlebih dahulu', 'error');
                    return;
                }

                const unitInfo = this.getUnitInfo(this.selectedCar);
                if (!unitInfo.available) {
                    this.showAlert('Mobil yang kamu pilih sedang tidak tersedia, silahkan pilih mobil lain.', 'error');
                    return;
                }

                if (!this.validateForm()) return;

                this.isLoading = true;

                try {
                    if (!this.isAuthenticated) {
                        this.showNotification('🔒 Login dengan akun sales terlebih dahulu!', 'error');
                        setTimeout(() => window.location.href = '/login', 2000);
                        return;
                    }

                    let bookingData = {
                        car: this.selectedCar,
                        booking_type: this.bookingType,
                        sales_user_id: this.selectedSPV
                    };
                    console.log('🚀 Sending booking request:', {
                        booking_type: this.bookingType,
                        is_pameran: this.bookingType === 'pameran',
                        is_test_drive: this.bookingType === 'test_drive',
                        data: bookingData
                    });


                    if (this.bookingType === 'test_drive') {
                        bookingData = {
                            ...bookingData,
                            sales_name: this.bookingForm.sales_name.trim(),
                            sales_phone: this.bookingForm.sales_phone.trim(),
                            customer_name: this.bookingForm.customer_name.trim(),
                            phone: this.bookingForm.customer_phone.trim(),
                            email: this.bookingForm.email.trim(),
                            ktp: this.bookingForm.ktp.trim(),
                            test_drive_time: this.bookingForm.test_drive_time,
                            test_drive_location: this.bookingForm.test_drive_location.trim()
                        };
                    } else {
                        bookingData = {
                            ...bookingData,
                            pic_name: this.bookingForm.pic_name.trim(),
                            pic_phone: this.bookingForm.pic_phone.trim(),
                            pic_email: this.bookingForm.pic_email.trim(),
                            target_prospect: this.bookingForm.target_prospect.trim(),
                            event_date: this.bookingForm.event_date,
                            event_location: this.bookingForm.event_location.trim(),
                            start_date: this.bookingForm.start_date,
                            end_date: this.bookingForm.end_date
                        };
                    }

                    const response = await fetch('/booking/store', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': this.getCsrfToken()
                        },
                        body: JSON.stringify(bookingData)
                    });

                    if (response.status === 401) {
                        this.showNotification('🔒 Sesi berakhir, redirect ke login', 'error');
                        setTimeout(() => window.location.href = '/login', 2000);
                        return;
                    }

                    if (response.status === 403) {
                        this.showNotification('⚠️ Hanya Sales yang bisa booking', 'error');
                        return;
                    }

                    const data = await response.json();

                    if (response.ok && data.success) {
                        const spvName = this.spvList.find(spv => spv.id == this.selectedSPV)?.name || 'SPV';

                        let successMessage = `✅ ${data.message}\n\n` +
                            `Booking ID: ${data.data.booking_id}\n` +
                            `Mobil: ${data.data.car}\n` +
                            `Status: ${data.data.status}\n` +
                            `Supervisor: ${spvName}\n` +
                            `Terima kasih telah melakukan booking melalui portal kami!`;

                        this.showAlert(successMessage, 'success');
                        this.closeModal();

                    } else {
                        let errorMessage = 'Booking gagal. Silakan coba lagi.';
                        if (data.errors) {
                            errorMessage = Object.values(data.errors).flat().join('\n');
                        } else if (data.message) {
                            errorMessage = data.message;
                        }
                        this.showAlert(errorMessage, 'error');
                    }

                } catch (error) {
                    console.error('❌ Network error:', error);
                    this.showAlert(
                        'Terjadi kesalahan jaringan.\nSilakan periksa koneksi internet Anda dan coba lagi.',
                        'error'
                    );
                } finally {
                    this.isLoading = false;
                }
            },

            validateForm() {
                if (this.bookingType === 'test_drive') {
                    const required = [{
                            field: 'sales_name',
                            label: 'Nama Sales'
                        },
                        {
                            field: 'sales_phone',
                            label: 'No. HP Sales'
                        },
                        {
                            field: 'customer_name',
                            label: 'Nama Customer'
                        },
                        {
                            field: 'customer_phone',
                            label: 'No. HP Customer'
                        },
                        {
                            field: 'email',
                            label: 'Email'
                        },
                        {
                            field: 'ktp',
                            label: 'No. KTP'
                        },
                        {
                            field: 'test_drive_time',
                            label: 'Jam Test Drive'
                        },
                        {
                            field: 'test_drive_location',
                            label: 'Lokasi Test Drive'
                        }
                    ];

                    for (let item of required) {
                        if (!this.bookingForm[item.field] || !this.bookingForm[item.field].toString().trim()) {
                            this.showAlert(`Mohon isi ${item.label}`, 'error');
                            return false;
                        }
                    }

                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(this.bookingForm.email)) {
                        this.showAlert('Format email tidak valid!', 'error');
                        return false;
                    }

                    const phoneRegex = /^[0-9]{10,13}$/;
                    const customerPhone = this.bookingForm.customer_phone.replace(/\D/g, '');
                    const salesPhone = this.bookingForm.sales_phone.replace(/\D/g, '');

                    if (!phoneRegex.test(customerPhone)) {
                        this.showAlert('No. HP Customer harus 10-13 digit!', 'error');
                        return false;
                    }

                    if (!phoneRegex.test(salesPhone)) {
                        this.showAlert('No. HP Sales harus 10-13 digit!', 'error');
                        return false;
                    }

                    if (this.bookingForm.ktp.length !== 16) {
                        this.showAlert('No. KTP harus 16 digit!', 'error');
                        return false;
                    }

                } else if (this.bookingType === 'pameran') {
                    const required = [{
                            field: 'pic_name',
                            label: 'Nama PIC'
                        },
                        {
                            field: 'pic_phone',
                            label: 'No. HP PIC'
                        },
                        {
                            field: 'pic_email',
                            label: 'Email PIC'
                        },
                        {
                            field: 'target_prospect',
                            label: 'Target Prospect'
                        },
                        {
                            field: 'event_date',
                            label: 'Tanggal Acara'
                        },
                        {
                            field: 'event_location',
                            label: 'Lokasi Acara'
                        },
                        {
                            field: 'start_date',
                            label: 'Tanggal Mulai'
                        },
                        {
                            field: 'end_date',
                            label: 'Tanggal Selesai'
                        }
                    ];

                    for (let item of required) {
                        if (!this.bookingForm[item.field] || !this.bookingForm[item.field].toString().trim()) {
                            this.showAlert(`Mohon isi ${item.label}`, 'error');
                            return false;
                        }
                    }

                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(this.bookingForm.pic_email)) {
                        this.showAlert('Format email PIC tidak valid!', 'error');
                        return false;
                    }

                    const phoneRegex = /^[0-9]{10,13}$/;
                    const picPhone = this.bookingForm.pic_phone.replace(/\D/g, '');

                    if (!phoneRegex.test(picPhone)) {
                        this.showAlert('No. HP PIC harus 10-13 digit!', 'error');
                        return false;
                    }

                    const startDate = new Date(this.bookingForm.start_date);
                    const endDate = new Date(this.bookingForm.end_date);
                    const eventDate = new Date(this.bookingForm.event_date);
                    const today = new Date();
                    today.setHours(0, 0, 0, 0);

                    if (startDate < today) {
                        this.showAlert('Tanggal mulai tidak boleh di masa lalu!', 'error');
                        return false;
                    }

                    if (eventDate < today) {
                        this.showAlert('Tanggal acara tidak boleh di masa lalu!', 'error');
                        return false;
                    }

                    if (endDate < startDate) {
                        this.showAlert('Tanggal selesai harus setelah tanggal mulai!', 'error');
                        return false;
                    }
                }

                return true;
            },

            resetForm() {
                this.bookingType = 'test_drive';
                this.isCarLocked = false;
                this.bookingForm = {
                    car: '',
                    sales_name: '',
                    sales_phone: '',
                    customer_name: '',
                    customer_phone: '',
                    email: '',
                    ktp: '',
                    test_drive_time: '',
                    test_drive_location: '',
                    pic_name: '',
                    pic_phone: '',
                    pic_email: '',
                    target_prospect: '',
                    event_date: '',
                    event_location: '',
                    start_date: '',
                    end_date: ''
                };
                this.selectedCar = '';
            },

            showAlert(message, type = 'info') {
                const alertDiv = document.createElement('div');
                const bgColor = type === 'error' ? 'bg-red-500' : type === 'success' ? 'bg-green-500' : 'bg-blue-500';

                alertDiv.className =
                    `fixed top-4 right-4 z-[9999] px-6 py-4 rounded-lg text-white font-medium shadow-2xl ${bgColor} transform translate-x-0 opacity-100 transition-all duration-300`;
                alertDiv.innerHTML = `
                    <div class="flex items-center justify-between">
                        <span class="pr-4">${message}</span>
                        <button onclick="this.parentElement.parentElement.remove()" class="ml-2 text-white/80 hover:text-white">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                `;

                document.body.appendChild(alertDiv);

                setTimeout(() => {
                    if (alertDiv.parentNode) {
                        alertDiv.classList.add('translate-x-full', 'opacity-0');
                        setTimeout(() => alertDiv.remove(), 300);
                    }
                }, 8000);
            },

            getCsrfToken() {
                const token = document.querySelector('meta[name="csrf-token"]');
                return token ? token.getAttribute('content') : '';
            }
    }
    }
</script>
