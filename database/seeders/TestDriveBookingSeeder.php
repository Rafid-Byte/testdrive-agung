<?php

namespace Database\Seeders;

use App\Models\TestDriveBooking;
use App\Models\User;
use Illuminate\Database\Seeder;

class TestDriveBookingSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil SPV users (id 2–5 sesuai UserSeeder)
        $spvUsers = User::where('role', 'spv')->get();

        $mobils = [
            'Toyota Hilux Rangga', 'Toyota Raize Abu Abu',
            'Toyota Zenix', 'Toyota Agya Putih', 'Toyota Fortuner',
            'Toyota Agya GR Merah',
        ];

        $statuses = [
            'Menunggu', 'Menunggu', 'Menunggu',
            'Diproses', 'Diproses',
            'Dikonfirmasi', 'Dikonfirmasi', 'Dikonfirmasi',
            'Sedang test drive',
            'Selesai', 'Selesai', 'Selesai', 'Selesai', 'Selesai',
            'Perawatan',
            'Dibatalkan',
        ];

        $salesNames = [
            'Rizky Pratama', 'Fitriana Dewi', 'Hendra Gunawan', 'Maya Putri',
            'Doni Setiawan', 'Lestari Wulandari', 'Agus Santoso', 'Novia Rahmawati',
            'Fajar Nugroho', 'Siska Amelia',
        ];

        $salesPhones = [
            '081234567890', '082345678901', '083456789012', '084567890123',
            '085678901234', '086789012345', '087890123456', '088901234567',
            '089012345678', '081122334455',
        ];

        $customers = [
            ['nama' => 'Budi Santoso',       'email' => 'budi.santoso@gmail.com',       'telp' => '081111111101', 'ktp' => '3201010101010001'],
            ['nama' => 'Siti Rahayu',         'email' => 'siti.rahayu@yahoo.com',         'telp' => '081111111102', 'ktp' => '3201010101010002'],
            ['nama' => 'Ahmad Fauzi',         'email' => 'ahmad.fauzi@gmail.com',         'telp' => '081111111103', 'ktp' => '3201010101010003'],
            ['nama' => 'Dewi Anggraeni',      'email' => 'dewi.anggraeni@gmail.com',      'telp' => '081111111104', 'ktp' => '3201010101010004'],
            ['nama' => 'Rudi Hermawan',       'email' => 'rudi.hermawan@hotmail.com',     'telp' => '081111111105', 'ktp' => '3201010101010005'],
            ['nama' => 'Rina Kusumawati',     'email' => 'rina.kusuma@gmail.com',         'telp' => '081111111106', 'ktp' => '3201010101010006'],
            ['nama' => 'Hadi Prasetyo',       'email' => 'hadi.prasetyo@gmail.com',       'telp' => '081111111107', 'ktp' => '3201010101010007'],
            ['nama' => 'Yuni Astuti',         'email' => 'yuni.astuti@yahoo.com',         'telp' => '081111111108', 'ktp' => '3201010101010008'],
            ['nama' => 'Eko Purnomo',         'email' => 'eko.purnomo@gmail.com',         'telp' => '081111111109', 'ktp' => '3201010101010009'],
            ['nama' => 'Lina Setiawati',      'email' => 'lina.setiawati@gmail.com',      'telp' => '081111111110', 'ktp' => '3201010101010010'],
            ['nama' => 'Wahyu Hidayat',       'email' => 'wahyu.hidayat@gmail.com',       'telp' => '081111111111', 'ktp' => '3201010101010011'],
            ['nama' => 'Putri Handayani',     'email' => 'putri.handayani@gmail.com',     'telp' => '081111111112', 'ktp' => '3201010101010012'],
            ['nama' => 'Dimas Ariyanto',      'email' => 'dimas.ariyanto@gmail.com',      'telp' => '081111111113', 'ktp' => '3201010101010013'],
            ['nama' => 'Fitri Maharani',      'email' => 'fitri.maharani@yahoo.com',      'telp' => '081111111114', 'ktp' => '3201010101010014'],
            ['nama' => 'Galih Wicaksono',     'email' => 'galih.wicaksono@gmail.com',     'telp' => '081111111115', 'ktp' => '3201010101010015'],
            ['nama' => 'Novita Sari',         'email' => 'novita.sari@gmail.com',         'telp' => '081111111116', 'ktp' => '3201010101010016'],
            ['nama' => 'Bagas Kurniawan',     'email' => 'bagas.kurniawan@gmail.com',     'telp' => '081111111117', 'ktp' => '3201010101010017'],
            ['nama' => 'Winda Permatasari',   'email' => 'winda.permata@gmail.com',       'telp' => '081111111118', 'ktp' => '3201010101010018'],
            ['nama' => 'Andika Pratama',      'email' => 'andika.pratama@gmail.com',      'telp' => '081111111119', 'ktp' => '3201010101010019'],
            ['nama' => 'Rahma Yulianti',      'email' => 'rahma.yulianti@yahoo.com',      'telp' => '081111111120', 'ktp' => '3201010101010020'],
            ['nama' => 'Teguh Santoso',       'email' => 'teguh.santoso@gmail.com',       'telp' => '081111111121', 'ktp' => '3201010101010021'],
            ['nama' => 'Sri Wahyuni',         'email' => 'sri.wahyuni@gmail.com',         'telp' => '081111111122', 'ktp' => '3201010101010022'],
            ['nama' => 'Farid Maulana',       'email' => 'farid.maulana@gmail.com',       'telp' => '081111111123', 'ktp' => '3201010101010023'],
            ['nama' => 'Ayu Puspitasari',     'email' => 'ayu.puspita@yahoo.com',         'telp' => '081111111124', 'ktp' => '3201010101010024'],
            ['nama' => 'Irwan Saputra',       'email' => 'irwan.saputra@gmail.com',       'telp' => '081111111125', 'ktp' => '3201010101010025'],
            ['nama' => 'Melinda Safitri',     'email' => 'melinda.safitri@gmail.com',     'telp' => '081111111126', 'ktp' => '3201010101010026'],
            ['nama' => 'Yoga Dermawan',       'email' => 'yoga.dermawan@gmail.com',       'telp' => '081111111127', 'ktp' => '3201010101010027'],
            ['nama' => 'Citra Kusuma',        'email' => 'citra.kusuma@gmail.com',        'telp' => '081111111128', 'ktp' => '3201010101010028'],
            ['nama' => 'Hendri Wijaya',       'email' => 'hendri.wijaya@hotmail.com',     'telp' => '081111111129', 'ktp' => '3201010101010029'],
            ['nama' => 'Dian Permatasari',    'email' => 'dian.permata@gmail.com',        'telp' => '081111111130', 'ktp' => '3201010101010030'],
        ];

        $locations = [
            'Showroom Toyota Jambi', 'Showroom Toyota Kota Baru', 'Area Parkir Mall WTC',
            'Lapangan Kantor Gubernur', 'Showroom Toyota Sipin',
        ];

        $times = ['09:00', '10:00', '10:30', '11:00', '13:00', '14:00', '14:30', '15:00', '16:00'];

        foreach ($customers as $i => $customer) {
            $spv = $spvUsers->count() ? $spvUsers[$i % $spvUsers->count()] : null;
            $status = $statuses[$i % count($statuses)];
            $tanggal = now()->subDays(rand(1, 60))->format('Y-m-d');

            TestDriveBooking::create([
                'booking_type'        => 'test_drive',
                'nama_lengkap'        => $customer['nama'],
                'nomor_telepon'       => $customer['telp'],
                'email'               => $customer['email'],
                'no_ktp'              => $customer['ktp'],
                'mobil_test_drive'    => $mobils[$i % count($mobils)],
                'tanggal_booking'     => $tanggal,
                'status'              => $status,
                'supervisor_user_id'  => $spv?->id,
                'supervisor_user_name'=> $spv?->name,
                'sales_name'          => $salesNames[$i % count($salesNames)],
                'sales_phone'         => $salesPhones[$i % count($salesPhones)],
                'test_drive_time'     => $times[$i % count($times)],
                'test_drive_location' => $locations[$i % count($locations)],
            ]);
        }
    }
}