<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pameran_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_type')->default('pameran');
            $table->string('nama_pic', 100);
            $table->string('nomor_telepon', 15)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('mobil', 100);
            $table->text('target_prospect');
            $table->date('tanggal_booking');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->date('tanggal_acara')->nullable();
            $table->string('lokasi_acara', 255)->nullable();

            // Supervisor (referensi ke users)
            $table->unsignedBigInteger('supervisor_user_id')->nullable();
            $table->string('supervisor_user_name')->nullable();
            $table->foreign('supervisor_user_id')->references('id')->on('users')->onDelete('set null');

            $table->string('status', 50)->default('Menunggu');

            $table->softDeletes();
            $table->timestamps();

            // Indexes
            $table->index('status');
            $table->index('tanggal_booking');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pameran_bookings');
    }
};