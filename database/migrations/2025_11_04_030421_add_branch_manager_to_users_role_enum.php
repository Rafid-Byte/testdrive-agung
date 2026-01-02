<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // ✅ Ubah ENUM role untuk menambahkan 'branch_manager'
        DB::statement("
            ALTER TABLE users 
            MODIFY COLUMN role 
            ENUM('admin', 'spv', 'branch_manager', 'security', 'sales') 
            DEFAULT 'sales'
        ");
    }

    public function down(): void
    {
        // ✅ Rollback: hapus 'branch_manager' dari ENUM
        DB::statement("
            ALTER TABLE users 
            MODIFY COLUMN role 
            ENUM('admin', 'spv', 'security', 'sales') 
            DEFAULT 'sales'
        ");
    }
};