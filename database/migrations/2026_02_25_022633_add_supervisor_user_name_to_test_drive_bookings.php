<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('test_drive_bookings', function (Blueprint $table) {
            $table->string('supervisor_user_name')->nullable()->after('supervisor_user_id');
        });

        // Isi data lama — ambil nama supervisor dari tabel users berdasarkan supervisor_user_id yang sudah ada
        DB::statement("
            UPDATE test_drive_bookings tdb
            JOIN users u ON u.id = tdb.supervisor_user_id
            SET tdb.supervisor_user_name = u.name
            WHERE tdb.supervisor_user_id IS NOT NULL
              AND (tdb.supervisor_user_name IS NULL OR tdb.supervisor_user_name = '')
        ");
    }

    public function down(): void
    {
        Schema::table('test_drive_bookings', function (Blueprint $table) {
            $table->dropColumn('supervisor_user_name');
        });
    }
};