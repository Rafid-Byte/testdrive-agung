<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks temporarily
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        User::truncate();
        
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $users = [
            // 1️⃣ ADMIN - Full Access (Dashboard + Checksheet)
            [
                'name' => 'Administrator',
                'email' => 'admin@toyota.com',
                'password' => bcrypt('admin123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ],
            
            // 2️⃣ SPV - Dashboard Only (4 SPV)
            [
                'name' => 'Andi Wijaya',
                'email' => 'spv1@toyota.com',
                'password' => bcrypt('spv123'),
                'role' => 'spv',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Sari Indah Lestari',
                'email' => 'spv2@toyota.com',
                'password' => bcrypt('spv123'),
                'role' => 'spv',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Budi Hartono',
                'email' => 'spv3@toyota.com',
                'password' => bcrypt('spv123'),
                'role' => 'spv',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Dewi Kusuma',
                'email' => 'spv4@toyota.com',
                'password' => bcrypt('spv123'),
                'role' => 'spv',
                'email_verified_at' => now(),
            ],

             // 3️⃣ BRANCH MANAGER - Dashboard Only (View Dikonfirmasi bookings only)
            [
                'name' => 'Ir. Bambang Suharto',
                'email' => 'branchmanager@toyota.com',
                'password' => bcrypt('branchmanager123'),
                'role' => 'branch_manager',
                'email_verified_at' => now(),
            ],
            
            // 4️⃣ SECURITY - Checksheet Only
            [
                'name' => 'Budi Santoso',
                'email' => 'security@toyota.com',
                'password' => bcrypt('security123'),
                'role' => 'security',
                'email_verified_at' => now(),
            ],
            
            // 5️⃣ SALES - Welcome Page Only (1 akun untuk semua sales)
            [
                'name' => 'Sales Toyota',
                'email' => 'sales@toyota.com',
                'password' => bcrypt('sales123'),
                'role' => 'sales',
                'email_verified_at' => now(),
            ],
        ];

        foreach ($users as $userData) {
        // ✅ Use updateOrCreate to avoid duplicate errors
        User::updateOrCreate(
            ['email' => $userData['email']], // Find by email
            $userData // Update or create with this data
        );
    }

        $this->command->info('✅ Users created successfully!');
        $this->command->newLine();
        $this->command->info('🔐 Login Credentials:');
        $this->command->table(
            ['Role', 'Email', 'Password', 'Access'],
            [
                ['Admin', 'admin@toyota.com', 'admin123', '✅ Dashboard + Checksheet (Full Access)'],
                ['SPV', 'spv@toyota.com', 'spv123', '✅ Dashboard Only'],
                ['Branch Manager', 'branchmanager@toyota.com', 'branchmanager123', '✅ Dashboard (Finalize and Approve Bookings)'],
                ['Security', 'security@toyota.com', 'security123', '✅ Checksheet Only'],
                ['Sales', 'sales@toyota.com', 'sales123', '✅ Welcome Page Only'],
            ]
        );
        
        $this->command->newLine();
        $this->command->warn('⚠️  Access Matrix:');
        $this->command->line('   Admin     → Can access: Dashboard, Checksheet, Welcome');
        $this->command->line('   SPV       → Can access: Dashboard, Welcome');
        $this->command->line('   Branch Manager  → Can access: Dashboard, Welcome (Fi)');
        $this->command->line('   Security  → Can access: Checksheet, Welcome');
        $this->command->line('   Sales     → Can access: Welcome Page Only');
    }
}