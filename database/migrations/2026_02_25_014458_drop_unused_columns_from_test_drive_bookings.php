<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('test_drive_bookings', function (Blueprint $table) {
            // Drop foreign key constraints first (jika ada)
            // Gunakan try-catch karena constraint mungkin tidak dibuat secara eksplisit
            try {
                $table->dropForeign(['security_user_id']);
            } catch (\Exception $e) {
                // Constraint tidak ada, lanjut
            }

            try {
                $table->dropForeign(['sales_user_id']);
            } catch (\Exception $e) {
                // Constraint tidak ada, lanjut
            }

            $table->dropColumn([
                'security_user_id',
                'sales_user_id',
                'event_date',
                'event_location',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('test_drive_bookings', function (Blueprint $table) {
            $table->unsignedBigInteger('security_user_id')->nullable()->after('supervisor_user_id');
            $table->unsignedBigInteger('sales_user_id')->nullable()->after('security_user_id');
            $table->date('event_date')->nullable()->after('sales_phone');
            $table->string('event_location')->nullable()->after('event_date');

            $table->foreign('security_user_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('sales_user_id')->references('id')->on('users')->nullOnDelete();
        });
    }
};