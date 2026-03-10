<main id="vehicles" class="py-16 md:py-24 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 md:mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Pilih Kendaraan Anda
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Jelajahi koleksi kendaraan Toyota kami dan jadwalkan test drive Anda hari ini
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
            @php
                $cars = [
                    [
                        'name' => 'Toyota Hilux Rangga',
                        'image' => 'img\Toyota Rangga.webp',
                        'description' => 'Pick-up tangguh dengan kekuatan maksimal dan modern.',
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
                    <div class="relative h-48 md:h-56 overflow-hidden bg-gray-100">
                        <img src="{{ $car['image'] }}" alt="{{ $car['name'] }}" class="w-full h-full object-cover" />
                    </div>

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
