<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('test_drive_bookings', function (Blueprint $table) {
            $table->id();
            $table->enum('booking_type', ['test_drive', 'pameran'])->default('test_drive');
            $table->string('nama_lengkap', 100);
            $table->string('nomor_telepon', 15);
            $table->string('email', 100);
            $table->string('no_ktp', 16);
            $table->string('mobil_test_drive', 100);
            $table->date('tanggal_booking');
            $table->string('status', 50)->default('Menunggu');

            // Supervisor (referensi ke users)
            $table->unsignedBigInteger('supervisor_user_id')->nullable();
            $table->string('supervisor_user_name')->nullable();
            $table->foreign('supervisor_user_id')->references('id')->on('users')->onDelete('set null');

            // Sales info
            $table->string('sales_name', 100)->nullable();
            $table->string('sales_phone', 15)->nullable();

            // Test Drive details
            $table->time('test_drive_time')->nullable();
            $table->string('test_drive_location', 255)->nullable();

            $table->softDeletes();
            $table->timestamps();

            // Indexes
            $table->index('email');
            $table->index('status');
            $table->index('booking_type');
            $table->index('tanggal_booking');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_drive_bookings');
    }
};