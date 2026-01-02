<?php
// database/migrations/2025_12_23_020000_update_checksheets_status_column.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('checksheets', function (Blueprint $table) {
            // Change status column to support new values
            $table->enum('status', [
                'pending', 
                'approved', 
                'in_progress', 
                'completed', 
                'maintenance', 
                'cancelled'
            ])->default('pending')->change();
        });
    }

    public function down()
    {
        Schema::table('checksheets', function (Blueprint $table) {
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->change();
        });
    }
};