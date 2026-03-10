<?php

namespace Database\Seeders;

use App\Models\PameranBooking;
use App\Models\User;
use Illuminate\Database\Seeder;

class PameranBookingSeeder extends Seeder
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
            'Menunggu',   'Menunggu',
            'Diproses',   'Diproses',   'Diproses',
            'Dikonfirmasi', 'Dikonfirmasi', 'Dikonfirmasi',
            'Sedang Pameran', 'Sedang Pameran', 'Sedang Pameran', 'Sedang Pameran',
            'Perawatan',  'Perawatan',
            'Selesai',    'Selesai',    'Selesai',    'Selesai',    'Selesai',
            'Selesai',    'Selesai',
        ];

        $targetProspects = [
            '50 orang', '100 orang', '75 orang', '30 orang', '200 orang',
            '150 orang', '80 orang', '60 orang', '120 orang', '45 orang',
        ];

        $lokasiAcaras = [
            'Mall WTC Jambi, Jl. Sultan Thaha No.17',
            'Grand Mall Jambi, Jl. Sultan Agung No.12',
            'Transmart Jambi, Jl. Kolonel Abunjani',
            'Ramayana Sipin, Jl. Sipin No.8',
            'Lapangan Kantor Gubernur Jambi',
            'Mal Pelayanan Publik Jambi, Jl. Dr. Sutomo',
            'Hotel Novita Jambi, Jl. Gatot Subroto No.1',
            'Hotel Aston Jambi, Jl. Jend. Sudirman No.56',
            'Square Jambi, Jl. Hayam Wuruk No.10',
            'Pasar Modern Angso Duo, Jl. Raden Mattaher',
        ];

        $pics = [
            ['nama' => 'Rina Setiawati',       'email' => 'rina.setiawati@toyota.com',       'telp' => '082211110001'],
            ['nama' => 'Fajar Kurniawan',       'email' => 'fajar.kurniawan@toyota.com',       'telp' => '082211110002'],
            ['nama' => 'Mega Wulandari',        'email' => 'mega.wulandari@toyota.com',        'telp' => '082211110003'],
            ['nama' => 'Rizal Hamdani',         'email' => 'rizal.hamdani@toyota.com',         'telp' => '082211110004'],
            ['nama' => 'Tika Rahmawati',        'email' => 'tika.rahmawati@toyota.com',        'telp' => '082211110005'],
            ['nama' => 'Bayu Adiputra',         'email' => 'bayu.adiputra@toyota.com',         'telp' => '082211110006'],
            ['nama' => 'Laila Fitriani',        'email' => 'laila.fitriani@toyota.com',        'telp' => '082211110007'],
            ['nama' => 'Guntur Wibowo',         'email' => 'guntur.wibowo@toyota.com',         'telp' => '082211110008'],
            ['nama' => 'Hana Pertiwi',          'email' => 'hana.pertiwi@toyota.com',          'telp' => '082211110009'],
            ['nama' => 'Ivan Maulana',          'email' => 'ivan.maulana@toyota.com',          'telp' => '082211110010'],
            ['nama' => 'Jeni Oktaviani',        'email' => 'jeni.oktaviani@toyota.com',        'telp' => '082211110011'],
            ['nama' => 'Kevin Prasetya',        'email' => 'kevin.prasetya@toyota.com',        'telp' => '082211110012'],
            ['nama' => 'Lisa Andriani',         'email' => 'lisa.andriani@toyota.com',         'telp' => '082211110013'],
            ['nama' => 'Manda Sulistyo',        'email' => 'manda.sulistyo@toyota.com',        'telp' => '082211110014'],
            ['nama' => 'Nando Wijaksono',       'email' => 'nando.wijaksono@toyota.com',       'telp' => '082211110015'],
            ['nama' => 'Orin Yuliana',          'email' => 'orin.yuliana@toyota.com',          'telp' => '082211110016'],
            ['nama' => 'Pandu Wicaksono',       'email' => 'pandu.wicaksono@toyota.com',       'telp' => '082211110017'],
            ['nama' => 'Qori Ramadhani',        'email' => 'qori.ramadhani@toyota.com',        'telp' => '082211110018'],
            ['nama' => 'Rendra Setiabudi',      'email' => 'rendra.setiabudi@toyota.com',      'telp' => '082211110019'],
            ['nama' => 'Sinta Nurhaliza',       'email' => 'sinta.nurhaliza@toyota.com',       'telp' => '082211110020'],
            ['nama' => 'Tono Budiman',          'email' => 'tono.budiman@toyota.com',          'telp' => '082211110021'],
            ['nama' => 'Umi Kalsum',            'email' => 'umi.kalsum@toyota.com',            'telp' => '082211110022'],
            ['nama' => 'Vino Septian',          'email' => 'vino.septian@toyota.com',          'telp' => '082211110023'],
            ['nama' => 'Weni Astari',           'email' => 'weni.astari@toyota.com',           'telp' => '082211110024'],
            ['nama' => 'Xena Maharani',         'email' => 'xena.maharani@toyota.com',         'telp' => '082211110025'],
            ['nama' => 'Yogi Firmansyah',       'email' => 'yogi.firmansyah@toyota.com',       'telp' => '082211110026'],
            ['nama' => 'Zahra Aulia',           'email' => 'zahra.aulia@toyota.com',           'telp' => '082211110027'],
            ['nama' => 'Aldi Nugraha',          'email' => 'aldi.nugraha@toyota.com',          'telp' => '082211110028'],
            ['nama' => 'Bella Safira',          'email' => 'bella.safira@toyota.com',          'telp' => '082211110029'],
            ['nama' => 'Cahyo Saputro',         'email' => 'cahyo.saputro@toyota.com',         'telp' => '082211110030'],
        ];

        foreach ($pics as $i => $pic) {
            $spv = $spvUsers->count() ? $spvUsers[$i % $spvUsers->count()] : null;
            $status = $statuses[$i % count($statuses)];

            $tanggalBooking = now()->subDays(rand(5, 90));
            $tanggalMulai   = (clone $tanggalBooking)->addDays(rand(3, 14));
            $tanggalSelesai = (clone $tanggalMulai)->addDays(rand(1, 5));
            $tanggalAcara   = (clone $tanggalMulai)->addDays(1);

            PameranBooking::create([
                'booking_type'         => 'pameran',
                'nama_pic'             => $pic['nama'],
                'nomor_telepon'        => $pic['telp'],
                'email'                => $pic['email'],
                'mobil'                => $mobils[$i % count($mobils)],
                'target_prospect'      => $targetProspects[$i % count($targetProspects)],
                'tanggal_booking'      => $tanggalBooking->format('Y-m-d'),
                'tanggal_mulai'        => $tanggalMulai->format('Y-m-d'),
                'tanggal_selesai'      => $tanggalSelesai->format('Y-m-d'),
                'tanggal_acara'        => $tanggalAcara->format('Y-m-d'),
                'lokasi_acara'         => $lokasiAcaras[$i % count($lokasiAcaras)],
                'supervisor_user_id'   => $spv?->id,
                'supervisor_user_name' => $spv?->name,
                'status'               => $status,
            ]);
        }
    }
}