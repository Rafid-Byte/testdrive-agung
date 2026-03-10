<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Step 1: Tambah kolom status_mobil setelah tipe_mobil
        if (!Schema::hasColumn('checksheets', 'status_mobil')) {
            Schema::table('checksheets', function (Blueprint $table) {
                $table->string('status_mobil')->default('Sedang test drive')->after('tipe_mobil');
            });
        }

        // Step 2: Isi status_mobil dari booking.status untuk data yang sudah ada
        DB::statement("
            UPDATE checksheets cs
            JOIN test_drive_bookings tdb ON tdb.id = cs.booking_id
            SET cs.status_mobil = tdb.status
            WHERE tdb.status IN ('Sedang test drive', 'Selesai', 'Perawatan')
        ");

        // Step 3: Hapus kolom status dan notes
        Schema::table('checksheets', function (Blueprint $table) {
            if (Schema::hasColumn('checksheets', 'status')) {
                $table->dropIndex(['status']); // drop index dulu jika ada
            }
        });

        Schema::table('checksheets', function (Blueprint $table) {
            $columns = [];
            if (Schema::hasColumn('checksheets', 'status')) {
                $columns[] = 'status';
            }
            if (Schema::hasColumn('checksheets', 'notes')) {
                $columns[] = 'notes';
            }
            if (!empty($columns)) {
                $table->dropColumn($columns);
            }
        });
    }

    public function down(): void
    {
        // Kembalikan status dan notes
        Schema::table('checksheets', function (Blueprint $table) {
            if (!Schema::hasColumn('checksheets', 'status')) {
                $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            }
            if (!Schema::hasColumn('checksheets', 'notes')) {
                $table->text('notes')->nullable();
            }
        });

        // Hapus status_mobil
        Schema::table('checksheets', function (Blueprint $table) {
            if (Schema::hasColumn('checksheets', 'status_mobil')) {
                $table->dropColumn('status_mobil');
            }
        });
    }
};