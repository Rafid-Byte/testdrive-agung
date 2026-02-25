<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // ✅ Matikan foreign key checks sementara agar bisa drop kolom bebas
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // ✅ Step 1: Tambah kolom supervisor_user_name jika belum ada
        if (!Schema::hasColumn('pameran_bookings', 'supervisor_user_name')) {
            Schema::table('pameran_bookings', function (Blueprint $table) {
                $table->string('supervisor_user_name')->nullable()->after('supervisor_user_id');
            });
        }

        // ✅ Step 2: Isi data supervisor_user_name dari tabel users
        DB::statement("
            UPDATE pameran_bookings pb
            JOIN users u ON pb.supervisor_user_id = u.id
            SET pb.supervisor_user_name = u.name
            WHERE pb.supervisor_user_name IS NULL
        ");

        // ✅ Step 3: Drop kolom security_user_id jika masih ada
        if (Schema::hasColumn('pameran_bookings', 'security_user_id')) {
            Schema::table('pameran_bookings', function (Blueprint $table) {
                $table->dropColumn('security_user_id');
            });
        }

        // ✅ Step 4: Drop kolom sales_user_id jika masih ada
        if (Schema::hasColumn('pameran_bookings', 'sales_user_id')) {
            Schema::table('pameran_bookings', function (Blueprint $table) {
                $table->dropColumn('sales_user_id');
            });
        }

        // ✅ Nyalakan kembali foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Schema::table('pameran_bookings', function (Blueprint $table) {
            if (Schema::hasColumn('pameran_bookings', 'supervisor_user_name')) {
                $table->dropColumn('supervisor_user_name');
            }
            if (!Schema::hasColumn('pameran_bookings', 'security_user_id')) {
                $table->unsignedBigInteger('security_user_id')->nullable();
            }
            if (!Schema::hasColumn('pameran_bookings', 'sales_user_id')) {
                $table->unsignedBigInteger('sales_user_id')->nullable();
            }
        });

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
};