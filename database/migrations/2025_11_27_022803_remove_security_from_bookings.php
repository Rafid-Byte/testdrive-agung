<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('test_drive_bookings', function (Blueprint $table) {
            $table->dropForeign(['security_id']);
            $table->dropColumn('security_id');
        });

        Schema::table('pameran_bookings', function (Blueprint $table) {
            $table->dropForeign(['security_id']);
            $table->dropColumn('security_id');
        });
    }

    public function down(): void
    {
        Schema::table('test_drive_bookings', function (Blueprint $table) {
            $table->foreignId('security_id')->nullable()->constrained('securities');
        });

        Schema::table('pameran_bookings', function (Blueprint $table) {
            $table->foreignId('security_id')->nullable()->constrained('securities');
        });
    }
};