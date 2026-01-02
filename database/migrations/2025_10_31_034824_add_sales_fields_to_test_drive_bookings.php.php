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
Schema::table('test_drive_bookings', function (Blueprint $table) {
// Sales Information
if (!Schema::hasColumn('test_drive_bookings', 'sales_name')) {
$table->string('sales_name', 100)->nullable()->after('security_id');
}
if (!Schema::hasColumn('test_drive_bookings', 'sales_phone')) {
$table->string('sales_phone', 15)->nullable()->after('sales_name');
}
        // Test Drive Details
        if (!Schema::hasColumn('test_drive_bookings', 'test_drive_time')) {
            $table->time('test_drive_time')->nullable()->after('sales_phone');
        }
        if (!Schema::hasColumn('test_drive_bookings', 'test_drive_location')) {
            $table->string('test_drive_location', 255)->nullable()->after('test_drive_time');
        }
    });
}

/**
 * Reverse the migrations.
 */
public function down(): void
{
    Schema::table('test_drive_bookings', function (Blueprint $table) {
        $table->dropColumn([
            'sales_name',
            'sales_phone', 
            'test_drive_time',
            'test_drive_location'
        ]);
    });
}
};