<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('checksheets', function (Blueprint $table) {
            $table->id();

            // Relasi
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('booking_id')->constrained('test_drive_bookings')->onDelete('cascade');

            // Informasi Umum
            $table->string('nama_customer')->nullable();
            $table->date('tanggal_test_drive');
            $table->time('jam_pinjam');
            $table->time('jam_kembali');
            $table->string('tipe_mobil');
            $table->string('status_mobil')->default('Sedang test drive');
            $table->string('no_polisi');

            // Kondisi Kendaraan - Body Luar
            $table->boolean('body_luar_pinjam_baik')->default(false);
            $table->boolean('body_luar_pinjam_tidak_baik')->default(false);
            $table->text('body_luar_pinjam_catatan')->nullable();
            $table->boolean('body_luar_kembali_baik')->default(false);
            $table->boolean('body_luar_kembali_tidak_baik')->default(false);
            $table->text('body_luar_kembali_catatan')->nullable();

            // Kondisi Kendaraan - Ban & Velg
            $table->boolean('ban_velg_pinjam_baik')->default(false);
            $table->boolean('ban_velg_pinjam_tidak_baik')->default(false);
            $table->text('ban_velg_pinjam_catatan')->nullable();
            $table->boolean('ban_velg_kembali_baik')->default(false);
            $table->boolean('ban_velg_kembali_tidak_baik')->default(false);
            $table->text('ban_velg_kembali_catatan')->nullable();

            // Kondisi Kendaraan - Kaca & Spion
            $table->boolean('kaca_spion_pinjam_baik')->default(false);
            $table->boolean('kaca_spion_pinjam_tidak_baik')->default(false);
            $table->text('kaca_spion_pinjam_catatan')->nullable();
            $table->boolean('kaca_spion_kembali_baik')->default(false);
            $table->boolean('kaca_spion_kembali_tidak_baik')->default(false);
            $table->text('kaca_spion_kembali_catatan')->nullable();

            // Kondisi Kendaraan - Interior
            $table->boolean('interior_pinjam_baik')->default(false);
            $table->boolean('interior_pinjam_tidak_baik')->default(false);
            $table->text('interior_pinjam_catatan')->nullable();
            $table->boolean('interior_kembali_baik')->default(false);
            $table->boolean('interior_kembali_tidak_baik')->default(false);
            $table->text('interior_kembali_catatan')->nullable();

            // Kondisi Kendaraan - Kebersihan Interior
            $table->boolean('kebersihan_interior_pinjam_baik')->default(false);
            $table->boolean('kebersihan_interior_pinjam_tidak_baik')->default(false);
            $table->text('kebersihan_interior_pinjam_catatan')->nullable();
            $table->boolean('kebersihan_interior_kembali_baik')->default(false);
            $table->boolean('kebersihan_interior_kembali_tidak_baik')->default(false);
            $table->text('kebersihan_interior_kembali_catatan')->nullable();

            // Kondisi Kendaraan - Peralatan
            $table->boolean('peralatan_pinjam_baik')->default(false);
            $table->boolean('peralatan_pinjam_tidak_baik')->default(false);
            $table->text('peralatan_pinjam_catatan')->nullable();
            $table->boolean('peralatan_kembali_baik')->default(false);
            $table->boolean('peralatan_kembali_tidak_baik')->default(false);
            $table->text('peralatan_kembali_catatan')->nullable();

            // Kondisi Kendaraan - AC & Audio
            $table->boolean('ac_audio_pinjam_baik')->default(false);
            $table->boolean('ac_audio_pinjam_tidak_baik')->default(false);
            $table->text('ac_audio_pinjam_catatan')->nullable();
            $table->boolean('ac_audio_kembali_baik')->default(false);
            $table->boolean('ac_audio_kembali_tidak_baik')->default(false);
            $table->text('ac_audio_kembali_catatan')->nullable();

            // Kondisi Kendaraan - Lampu
            $table->boolean('lampu_pinjam_baik')->default(false);
            $table->boolean('lampu_pinjam_tidak_baik')->default(false);
            $table->text('lampu_pinjam_catatan')->nullable();
            $table->boolean('lampu_kembali_baik')->default(false);
            $table->boolean('lampu_kembali_tidak_baik')->default(false);
            $table->text('lampu_kembali_catatan')->nullable();

            // Bahan Bakar
            $table->boolean('bahan_bakar_pinjam_1')->default(false);
            $table->boolean('bahan_bakar_pinjam_2')->default(false);
            $table->boolean('bahan_bakar_pinjam_3')->default(false);
            $table->boolean('bahan_bakar_pinjam_4')->default(false);
            $table->boolean('bahan_bakar_pinjam_kembali_1')->default(false);
            $table->boolean('bahan_bakar_pinjam_kembali_2')->default(false);
            $table->boolean('bahan_bakar_pinjam_kembali_3')->default(false);
            $table->boolean('bahan_bakar_pinjam_kembali_4')->default(false);

            // Dokumen & Kunci - STNK
            $table->boolean('stnk_pinjam_ada')->default(false);
            $table->boolean('stnk_pinjam_tidak_ada')->default(false);
            $table->boolean('stnk_kembali_ada')->default(false);
            $table->boolean('stnk_kembali_tidak_ada')->default(false);

            // Dokumen & Kunci - Kunci Utama
            $table->boolean('kunci_utama_pinjam_ada')->default(false);
            $table->boolean('kunci_utama_pinjam_tidak_ada')->default(false);
            $table->boolean('kunci_utama_kembali_ada')->default(false);
            $table->boolean('kunci_utama_kembali_tidak_ada')->default(false);

            // Dokumen & Kunci - Remote/Keyless
            $table->boolean('remote_keyless_pinjam_ada')->default(false);
            $table->boolean('remote_keyless_pinjam_tidak_ada')->default(false);
            $table->boolean('remote_keyless_kembali_ada')->default(false);
            $table->boolean('remote_keyless_kembali_tidak_ada')->default(false);

            // Kelengkapan Tambahan - Air Mineral
            $table->boolean('air_mineral_pinjam_ada')->default(false);
            $table->boolean('air_mineral_pinjam_tidak_ada')->default(false);
            $table->boolean('air_mineral_kembali_ada')->default(false);
            $table->boolean('air_mineral_kembali_tidak_ada')->default(false);

            // Informasi Tambahan
            $table->date('tanggal_penggantian_pewangi')->nullable();

            $table->softDeletes();
            $table->timestamps();

            // Indexes
            $table->index('user_id');
            $table->index('booking_id');
            $table->index('tanggal_test_drive');
            $table->index('no_polisi');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('checksheets');
    }
};