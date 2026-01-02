<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Hapus kolom is_active jika ada
        if (Schema::hasColumn('supervisors', 'is_active')) {
            Schema::table('supervisors', function (Blueprint $table) {
                $table->dropColumn('is_active');
            });
        }
        
        if (Schema::hasColumn('securities', 'is_active')) {
            Schema::table('securities', function (Blueprint $table) {
                $table->dropColumn('is_active');
            });
        }
    }

    public function down(): void
    {
        Schema::table('supervisors', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('nomor_hp');
        });
        
        Schema::table('securities', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('nomor_hp');
        });
    }
};