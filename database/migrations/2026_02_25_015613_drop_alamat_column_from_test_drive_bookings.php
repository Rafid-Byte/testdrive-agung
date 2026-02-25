<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Pindahkan data alamat → test_drive_location untuk baris yang test_drive_location masih kosong
        DB::statement("
            UPDATE test_drive_bookings
            SET test_drive_location = alamat
            WHERE (test_drive_location IS NULL OR test_drive_location = '')
              AND (alamat IS NOT NULL AND alamat != '')
        ");

        Schema::table('test_drive_bookings', function (Blueprint $table) {
            $table->dropColumn('alamat');
        });
    }

    public function down(): void
    {
        Schema::table('test_drive_bookings', function (Blueprint $table) {
            $table->string('alamat')->nullable()->after('no_ktp');
        });

        // Kembalikan data test_drive_location → alamat
        DB::statement("
            UPDATE test_drive_bookings
            SET alamat = test_drive_location
            WHERE test_drive_location IS NOT NULL
        ");
    }
};