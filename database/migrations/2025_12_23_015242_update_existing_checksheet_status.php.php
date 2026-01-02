<?php
// database/migrations/2025_12_23_015242_update_existing_checksheet_status.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // ✅ Get all checksheets with their bookings
        $checksheets = DB::table('checksheets')
            ->leftJoin('test_drive_bookings', 'checksheets.booking_id', '=', 'test_drive_bookings.id')
            ->select('checksheets.id', 'checksheets.status as checksheet_status', 'test_drive_bookings.status as booking_status')
            ->get();
        
        foreach ($checksheets as $checksheet) {
            if ($checksheet->booking_status) {
                $statusMap = [
                    'Dikonfirmasi' => 'approved',
                    'Sedang test drive' => 'in_progress',
                    'Selesai' => 'completed',
                    'Perawatan' => 'maintenance',
                    'Dibatalkan' => 'cancelled'
                ];
                
                $newStatus = $statusMap[$checksheet->booking_status] ?? 'pending';
                
                DB::table('checksheets')
                    ->where('id', $checksheet->id)
                    ->update(['status' => $newStatus]);
                    
                echo "✅ Updated checksheet #{$checksheet->id}: {$checksheet->booking_status} -> {$newStatus}\n";
            }
        }
    }

    public function down()
    {
        // Reset all to pending
        DB::table('checksheets')->update(['status' => 'pending']);
    }
};