<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('🚀 Starting database seeding...');
        $this->command->newLine();
        
        // STEP 1: Seed Users (Admin, SPV, Security, Sales)
        $this->command->info('👤 Seeding Users...');
        $this->call([
            UserSeeder::class,
        ]);
        
        $this->command->newLine();
        
        // STEP 2: Seed Staff (Supervisors & Securities for assignment)
        $this->command->info('👥 Seeding Staff...');
        $this->call([
            StaffSeeder::class,
        ]);

        $this->command->newLine();
        $this->command->info('✅ Database seeding completed successfully!');
        $this->command->newLine();
        
        $this->command->info('📊 Summary:');
        $this->command->line('   ✅ 4 Users created (Admin, SPV, Security, Sales)');
        $this->command->line('   ✅ 2 Supervisors created (for booking assignment)');
        $this->command->line('   ✅ 2 Securities created (for booking assignment)');
        
        $this->command->newLine();
        $this->command->warn('⚠️  IMPORTANT: Test login dengan kredensial berikut:');
        $this->command->newLine();
        $this->command->line('   Admin    : admin@toyota.com / admin123');
        $this->command->line('   SPV      : spv@toyota.com / spv123');
        $this->command->line('   Security : security@toyota.com / security123');
        $this->command->line('   Sales    : sales@toyota.com / sales123');
    }
}