<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pameran_bookings', function (Blueprint $table) {
            // ✅ Cek dulu kolom mana yang belum ada
            if (!Schema::hasColumn('pameran_bookings', 'booking_type')) {
                $table->string('booking_type')->default('pameran')->after('id');
            }
            
            if (!Schema::hasColumn('pameran_bookings', 'sales_user_id')) {
                $table->unsignedBigInteger('sales_user_id')->nullable()->after('security_id');
                $table->foreign('sales_user_id')->references('id')->on('users')->onDelete('set null');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pameran_bookings', function (Blueprint $table) {
            if (Schema::hasColumn('pameran_bookings', 'sales_user_id')) {
                $table->dropForeign(['sales_user_id']);
                $table->dropColumn('sales_user_id');
            }
            
            if (Schema::hasColumn('pameran_bookings', 'booking_type')) {
                $table->dropColumn('booking_type');
            }
        });
    }
};