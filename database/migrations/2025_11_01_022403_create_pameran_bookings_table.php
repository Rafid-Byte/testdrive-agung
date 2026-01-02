<?php
// File: database/migrations/xxxx_xx_xx_create_pameran_bookings_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pameran_bookings', function (Blueprint $table) {
            $table->id();
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
            
            // Foreign keys
            $table->foreignId('supervisor_id')->nullable()->constrained('supervisors')->onDelete('set null');
            $table->foreignId('security_id')->nullable()->constrained('securities')->onDelete('set null');
            
            // Status
            $table->enum('status', [
                'Menunggu',
                'Dikonfirmasi', 
                'Diproses',
                'Sedang Pameran',
                'Selesai',
                'Dibatalkan'
            ])->default('Menunggu');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pameran_bookings');
    }
};