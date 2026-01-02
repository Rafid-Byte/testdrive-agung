<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supervisor;
use App\Models\Security;
use Illuminate\Support\Facades\DB;

class StaffSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Truncate tables
        Supervisor::truncate();
        Security::truncate();
        
        // Enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->command->info('🚀 Seeding Staff Data...');
        $this->command->newLine();

        // ✅ 4 Supervisors
        $supervisors = [
            ['nama_lengkap' => 'Andi Wijaya', 'position' => 'SPV Test Drive', 'nomor_hp' => '081234567890'],
            ['nama_lengkap' => 'Sari Indah Lestari', 'position' => 'SPV Pameran', 'nomor_hp' => '081234567891'],
            ['nama_lengkap' => 'Budi Hartono', 'position' => 'SPV Senior', 'nomor_hp' => '081234567892'],
            ['nama_lengkap' => 'Dewi Kusuma', 'position' => 'SPV Operasional', 'nomor_hp' => '081234567893'],
        ];

        foreach ($supervisors as $spv) {
            Supervisor::create($spv);
            $this->command->line("  ✓ Created SPV: {$spv['nama_lengkap']}");
        }

        $this->command->info('✅ 5 Supervisors created!');
        $this->command->newLine();

        // ✅ 5 Securities
        $securities = [
            ['nama_lengkap' => 'Ahmad Rahman', 'position' => 'Security Test Drive', 'nomor_hp' => '081234567895'],
            ['nama_lengkap' => 'Joko Susilo', 'position' => 'Security Pameran', 'nomor_hp' => '081234567896'],
            ['nama_lengkap' => 'Hendra Gunawan', 'position' => 'Security Senior', 'nomor_hp' => '081234567897'],
            ['nama_lengkap' => 'Agus Setiawan', 'position' => 'Security Koordinator', 'nomor_hp' => '081234567898'],
            ['nama_lengkap' => 'Bambang Wijayanto', 'position' => 'Security Backup', 'nomor_hp' => '081234567899'],
        ];

        foreach ($securities as $sec) {
            Security::create($sec);
            $this->command->line("  ✓ Created Security: {$sec['nama_lengkap']}");
        }

        $this->command->info('✅ 5 Securities created!');
        $this->command->newLine();

        // Display summary table
        $this->command->table(
            ['ID', 'Nama', 'Position', 'HP', 'Created At'],
            Supervisor::all()->map(fn($s) => [
                $s->id,
                $s->nama_lengkap,
                $s->position,
                $s->nomor_hp,
                $s->created_at->format('Y-m-d H:i:s')
            ])->toArray()
        );

        $this->command->newLine();
        
        $this->command->table(
            ['ID', 'Nama', 'Position', 'HP', 'Created At'],
            Security::all()->map(fn($s) => [
                $s->id,
                $s->nama_lengkap,
                $s->position,
                $s->nomor_hp,
                $s->created_at->format('Y-m-d H:i:s')
            ])->toArray()
        );
    }
}