<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update test_drive_bookings table
        Schema::table('test_drive_bookings', function (Blueprint $table) {
            $table->string('status', 50)->change();
        });

        // Update pameran_bookings table
        Schema::table('pameran_bookings', function (Blueprint $table) {
            $table->string('status', 50)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('test_drive_bookings', function (Blueprint $table) {
            $table->string('status', 20)->change();
        });

        Schema::table('pameran_bookings', function (Blueprint $table) {
            $table->string('status', 20)->change();
        });
    }
};