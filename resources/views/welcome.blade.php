<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @auth
        <meta name="user-id" content="{{ auth()->id() }}">
    @endauth
    <title>Toyota Car Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
        }

        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .btn-primary {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #b91c1c 0%, #991b1b 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(220, 38, 38, 0.4);
        }
    </style>
    <style>
        .status-available {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .status-booked {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }

        .status-unavailable {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }

        .status-in-use {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        }

        .status-maintenance {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
        }
    </style>
</head>

<body class="bg-gray-50 antialiased" x-data="bookingApp()">
    {{-- HEADER --}}
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 md:h-20">
                {{-- Logo --}}
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 md:w-12 md:h-12 bg-red-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 md:w-7 md:h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-lg md:text-xl font-bold text-gray-900">Toyota</h1>
                        <p class="text-xs text-gray-500 hidden sm:block">Booking Portal</p>
                    </div>
                </div>

                {{-- Navigation --}}
                @if (Route::has('login'))
                    <nav class="flex items-center space-x-2 md:space-x-4">
                        @auth
                            @if (auth()->user()->canAccessDashboard())
                                <a href="{{ route('dashboard') }}"
                                    class="px-3 md:px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition">
                                    Dashboard
                                </a>
                            @endif

                            @if (auth()->user()->canAccessChecksheet())
                                <a href="{{ route('checksheet') }}"
                                    class="px-3 md:px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition">
                                    Check Sheet
                                </a>
                            @endif

                            <div class="hidden md:flex items-center gap-2 px-3 py-2 bg-gray-100 rounded-lg">
                                <div
                                    class="w-8 h-8 bg-red-600 text-white rounded-full flex items-center justify-center text-xs font-semibold">
                                    {{ auth()->user()->initials() }}
                                </div>
                                <div class="text-left">
                                    <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-gray-500">{{ ucfirst(auth()->user()->role) }}</p>
                                </div>
                            </div>

                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit"
                                    class="px-3 md:px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg transition">
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}"
                                class="px-3 md:px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition">
                                Sign In
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="px-3 md:px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg transition">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </div>
    </header>

    {{-- HERO SECTION --}}
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

                {{-- Action Buttons --}}
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="#vehicles" class="inline-block px-8 py-4 btn-primary text-white font-semibold rounded-lg">
                        Lihat Kendaraan
                    </a>

                    {{-- Quick Booking Button --}}
                    <div class="relative" x-data="{ showQuickAction: false }">
                        <button @click="showQuickAction = !showQuickAction"
                            class="inline-flex items-center px-8 py-4 bg-white text-red-600 font-semibold rounded-lg border-2 border-red-600 hover:bg-red-50 transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            Quick Booking
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        {{-- Quick Booking Dropdown --}}
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

                    {{-- Info Unit Tersedia Button --}}
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

    {{-- VEHICLE COLLECTION --}}
    <main id="vehicles" class="py-16 md:py-24 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Section Header --}}
            <div class="text-center mb-12 md:mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Pilih Kendaraan Anda
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Jelajahi koleksi kendaraan Toyota kami dan jadwalkan test drive Anda hari ini
                </p>
            </div>

            {{-- Vehicle Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @php
                    $cars = [
                        [
                            'name' => 'Toyota Hilux Rangga',
                            'image' => 'img\Toyota Rangga.webp',
                            'description' => 'Pick-up tangguh dengan kekuatan maksimal dan kenyamanan modern.',
                        ],
                        [
                            'name' => 'Toyota Raize Abu Abu',
                            'image' => 'img\Toyota Raize Abu Abu.webp',
                            'description' => 'SUV kompak bergaya sporty dengan efisiensi tinggi.',
                        ],
                        [
                            'name' => 'Toyota Zenix',
                            'image' => 'img\Toyota Zenix Putih.jpg',
                            'description' => 'MPV elegan dengan ruang luas dan fitur modern.',
                        ],
                        [
                            'name' => 'Toyota Agya Putih',
                            'image' => 'img\Toyota Agya Putih.webp',
                            'description' => 'Mobil compact lincah dan hemat bahan bakar.',
                        ],
                        [
                            'name' => 'Toyota Fortuner',
                            'image' => 'img\Toyota Fortuner.png',
                            'description' => 'SUV tangguh berdesain gagah dengan performa kuat.',
                        ],
                        [
                            'name' => 'Toyota Agya GR Merah',
                            'image' => 'img\Toyota Agya GR Merah.webp',
                            'description' => 'Hatchback sporty dengan tampilan agresif.',
                        ],
                    ];
                @endphp

                @foreach ($cars as $car)
                    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden card-hover">
                        {{-- Image --}}
                        <div class="relative h-48 md:h-56 overflow-hidden bg-gray-100">
                            <img src="{{ $car['image'] }}" alt="{{ $car['name'] }}"
                                class="w-full h-full object-cover" />
                        </div>

                        {{-- Content --}}
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $car['name'] }}</h3>
                            <p class="text-gray-600 text-sm mb-4">{{ $car['description'] }}</p>
                            <button @click="handleBookingClick('{{ $car['name'] }}')"
                                class="w-full px-6 py-3 btn-primary text-white font-semibold rounded-lg">
                                Booking
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>

    {{-- BOOKING MODAL --}}
    <div x-show="showModal" x-cloak class="fixed inset-0 z-[100] overflow-y-auto" style="display: none;">

        {{-- Backdrop --}}
        <div class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm transition-opacity" x-show="showModal"
            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" @click="closeModal()"></div>

        {{-- Modal Container --}}
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative bg-white rounded-xl w-full max-w-2xl max-h-[90vh] overflow-hidden flex flex-col shadow-2xl"
                x-show="showModal" x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                @click.stop>

                {{-- Header --}}
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
                        <svg class="w-5 h-5 text-yellow-400 mr-2" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
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

                {{-- Form Booking --}}
                <div class="overflow-y-auto" style="max-height: calc(90vh - 180px);">
                    <form @submit.prevent="submitBooking" class="p-6 space-y-6">
                        {{-- Selected Vehicle --}}
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

                        {{-- Pilih Supervisor (SPV) --}}
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

                        {{-- Booking Type --}}
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

                        {{-- TEST DRIVE FORM --}}
                        <template x-if="bookingType === 'test_drive'">
                            <div class="space-y-6">
                                {{-- Sales Info --}}
                                <div class="bg-gray-50 p-4 rounded-lg space-y-4">
                                    <h3 class="font-semibold text-gray-900">Informasi Sales</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                Nama Sales <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" x-model="bookingForm.sales_name" required
                                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                No. HP Sales <span class="text-red-500">*</span>
                                            </label>
                                            <input type="tel" x-model="bookingForm.sales_phone" required
                                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                        </div>
                                    </div>
                                </div>

                                {{-- Customer Info --}}
                                <div class="bg-gray-50 p-4 rounded-lg space-y-4">
                                    <h3 class="font-semibold text-gray-900">Informasi Customer</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                Nama Lengkap <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" x-model="bookingForm.customer_name" required
                                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                No. HP <span class="text-red-500">*</span>
                                            </label>
                                            <input type="tel" x-model="bookingForm.customer_phone" required
                                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                Email <span class="text-red-500">*</span>
                                            </label>
                                            <input type="email" x-model="bookingForm.email" required
                                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                No. KTP <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" x-model="bookingForm.ktp" maxlength="16" required
                                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                        </div>
                                    </div>
                                </div>

                                {{-- Test Drive Details --}}
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
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                Lokasi <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" x-model="bookingForm.test_drive_location" required
                                                placeholder="Contoh: Dealer Toyota Paal 10"
                                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>

                        {{-- PAMERAN FORM --}}
                        <template x-if="bookingType === 'pameran'">
                            <div class="space-y-6">
                                {{-- PIC Information --}}
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
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                No. HP PIC <span class="text-red-500">*</span>
                                            </label>
                                            <input type="tel" x-model="bookingForm.pic_phone" required
                                                placeholder="08xxxxxxxxxx" maxlength="13"
                                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                Email PIC <span class="text-red-500">*</span>
                                            </label>
                                            <input type="email" x-model="bookingForm.pic_email" required
                                                placeholder="email@example.com"
                                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-900 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                        </div>
                                    </div>
                                </div>

                                {{-- Event Details --}}
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

                        {{-- Submit Button --}}
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

    {{-- FOOTER --}}
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center mb-6 md:mb-0">
                    <div class="w-12 h-12 bg-red-600 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold">Toyota</h3>
                        <p class="text-sm text-gray-400">Test Drive & Exhibition Booking Portal</p>
                    </div>
                </div>

                <div class="text-center md:text-right">
                    <p class="text-gray-300 mb-2">&copy; {{ date('Y') }} Toyota Experience</p>
                    <p class="text-gray-400 text-sm">Toyota Paal 10, Jambi, Indonesia</p>
                </div>
            </div>
        </div>
    </footer>

    {{-- JavaScript --}}
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
                    // Check authentication first
                    if (!this.isAuthenticated) {
                        this.showAlert(
                            '🔒 Login Required!\n\n' +
                            'Anda harus login dengan akun Sales terlebih dahulu untuk melakukan booking.\n\n' +
                            'Silakan klik tombol "Sign In" di pojok kanan atas untuk login.',
                            'error'
                        );
                        return;
                    }

                    // Check role authorization
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

                    // Check vehicle availability status
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

                    // If authenticated, authorized, and vehicle is available, open booking modal
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

            // Load SPV List
            async init() {
                await this.loadSPVList();
                await this.loadVehicleStatus();

                @auth
                this.loadNotifications();
                setInterval(() => {
                    this.checkNewNotifications();
                }, 30000);
                // Refresh vehicle status every 30 seconds
                setInterval(() => {
                    this.loadVehicleStatus();
                }, 30000);
            @endauth
        },

        // Method untuk load SPV List
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

        // Load real-time vehicle status from API
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

            // Fallback default status
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
                            // Custom success message dengan nama SPV
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
    {{-- UNIT INFO MODAL --}}
    <div x-show="showUnitModal" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" @click.self="showUnitModal = false"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[70] p-4"
        style="display: none;">

        <div x-show="showUnitModal" x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            class="bg-white rounded-2xl w-full max-w-2xl max-h-[90vh] overflow-hidden shadow-2xl">

            <!-- Header -->
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Content -->
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
                                    <!-- Animated Status Indicator -->
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

                                    <!-- Car Icon -->
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

                                    <!-- Car Name -->
                                    <div>
                                        <p class="font-bold text-gray-900" x-text="carName"></p>
                                        <p class="text-xs text-gray-500 mt-0.5">
                                            <span x-show="info.status_code === 'available'">Booking Tersedia</span>
                                            <span
                                                x-show="info.status_code === 'booked' && info.booking_type === 'test_drive'">Menunggu
                                                approval booking</span>
                                            <span
                                                x-show="info.status_code === 'booked' && info.booking_type === 'pameran'">
                                                Menunggu approval booking</span>
                                            <span x-show="info.status_code === 'unavailable'">Tidak dapat
                                                dibooking</span>
                                            <span
                                                x-show="info.status_code === 'in_use' && info.booking_type === 'test_drive'">
                                                Sedang digunakan untuk test drive</span>
                                            <span
                                                x-show="info.status_code === 'in_use' && info.booking_type === 'pameran'">
                                                Sedang digunakan untuk pameran</span>
                                            <span x-show="info.status_code === 'maintenance'">Dalam perawatan</span>
                                        </p>
                                    </div>
                                </div>

                                <!-- Status Badge -->
                                <span
                                    class="px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider shadow-md"
                                    :class="{
                                        'bg-green-600 text-white': info.status_code === 'available',
                                        'bg-red-600 text-white': info.status_code === 'unavailable',
                                        'bg-yellow-600 text-white': info.status_code === 'booked',
                                        'bg-purple-600 text-white': info.status_code === 'in_use',
                                        'bg-orange-600 text-white': info.status_code === 'maintenance'
                                    }"
                                    x-text="info.status"></span>
                            </div>

                            <!-- Hover Effect Border -->
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

            <!-- Footer -->
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
</body>
</html>