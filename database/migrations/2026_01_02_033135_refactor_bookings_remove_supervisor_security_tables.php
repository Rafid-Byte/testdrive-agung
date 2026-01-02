<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // ===================================================================
        // STEP 1: Add new columns to test_drive_bookings (if not exists)
        // ===================================================================
        if (!Schema::hasColumn('test_drive_bookings', 'supervisor_user_id')) {
            Schema::table('test_drive_bookings', function (Blueprint $table) {
                $table->unsignedBigInteger('supervisor_user_id')->nullable()->after('supervisor_id');
            });
        }

        if (!Schema::hasColumn('test_drive_bookings', 'security_user_id')) {
            Schema::table('test_drive_bookings', function (Blueprint $table) {
                $table->unsignedBigInteger('security_user_id')->nullable()->after('supervisor_user_id');
            });
        }

        // ===================================================================
        // STEP 2: Migrate existing data from supervisors table to users
        // ===================================================================
        // Match supervisor_id with user_id based on email or name
        DB::statement("
            UPDATE test_drive_bookings tdb
            INNER JOIN supervisors s ON tdb.supervisor_id = s.id
            INNER JOIN users u ON (
                LOWER(s.nama_lengkap) = LOWER(u.name) 
                OR LOWER(s.nomor_hp) = LOWER(u.email)
            )
            SET tdb.supervisor_user_id = u.id
            WHERE u.role = 'spv'
        ");

        // ===================================================================
        // STEP 3: Add new columns to pameran_bookings (if not exists)
        // ===================================================================
        if (!Schema::hasColumn('pameran_bookings', 'supervisor_user_id')) {
            Schema::table('pameran_bookings', function (Blueprint $table) {
                $table->unsignedBigInteger('supervisor_user_id')->nullable()->after('supervisor_id');
            });
        }

        if (!Schema::hasColumn('pameran_bookings', 'security_user_id')) {
            Schema::table('pameran_bookings', function (Blueprint $table) {
                $table->unsignedBigInteger('security_user_id')->nullable()->after('supervisor_user_id');
            });
        }

        // ===================================================================
        // STEP 4: Migrate pameran_bookings data
        // ===================================================================
        DB::statement("
            UPDATE pameran_bookings pb
            INNER JOIN supervisors s ON pb.supervisor_id = s.id
            INNER JOIN users u ON (
                LOWER(s.nama_lengkap) = LOWER(u.name) 
                OR LOWER(s.nomor_hp) = LOWER(u.email)
            )
            SET pb.supervisor_user_id = u.id
            WHERE u.role = 'spv'
        ");

        // ===================================================================
        // STEP 5: Update checksheets if needed
        // ===================================================================
        if (Schema::hasTable('checksheets')) {
            // Update status enum to remove 'completed' if it exists
            DB::statement("ALTER TABLE `checksheets` MODIFY `status` ENUM('pending', 'approved', 'rejected') DEFAULT 'pending'");
            
            // Migrate any 'completed' status to 'approved'
            DB::statement("UPDATE `checksheets` SET `status` = 'approved' WHERE `status` = 'completed'");
        }

        // ===================================================================
        // STEP 6: Drop old foreign keys and columns from test_drive_bookings
        // ===================================================================
        Schema::table('test_drive_bookings', function (Blueprint $table) {
            // Drop old foreign keys if they exist
            if (Schema::hasColumn('test_drive_bookings', 'supervisor_id')) {
                $foreignKeys = DB::select("
                    SELECT CONSTRAINT_NAME 
                    FROM information_schema.KEY_COLUMN_USAGE 
                    WHERE TABLE_NAME = 'test_drive_bookings' 
                    AND COLUMN_NAME = 'supervisor_id' 
                    AND CONSTRAINT_NAME != 'PRIMARY'
                    AND TABLE_SCHEMA = DATABASE()
                ");
                
                foreach ($foreignKeys as $fk) {
                    $table->dropForeign($fk->CONSTRAINT_NAME);
                }
                
                $table->dropColumn('supervisor_id');
            }

            if (Schema::hasColumn('test_drive_bookings', 'security_id')) {
                $foreignKeys = DB::select("
                    SELECT CONSTRAINT_NAME 
                    FROM information_schema.KEY_COLUMN_USAGE 
                    WHERE TABLE_NAME = 'test_drive_bookings' 
                    AND COLUMN_NAME = 'security_id' 
                    AND CONSTRAINT_NAME != 'PRIMARY'
                    AND TABLE_SCHEMA = DATABASE()
                ");
                
                foreach ($foreignKeys as $fk) {
                    $table->dropForeign($fk->CONSTRAINT_NAME);
                }
                
                $table->dropColumn('security_id');
            }

            // Add foreign keys for new columns
            $table->foreign('supervisor_user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');

            $table->foreign('security_user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
        });

        // ===================================================================
        // STEP 7: Drop old foreign keys and columns from pameran_bookings
        // ===================================================================
        Schema::table('pameran_bookings', function (Blueprint $table) {
            // Drop old foreign keys if they exist
            if (Schema::hasColumn('pameran_bookings', 'supervisor_id')) {
                $foreignKeys = DB::select("
                    SELECT CONSTRAINT_NAME 
                    FROM information_schema.KEY_COLUMN_USAGE 
                    WHERE TABLE_NAME = 'pameran_bookings' 
                    AND COLUMN_NAME = 'supervisor_id' 
                    AND CONSTRAINT_NAME != 'PRIMARY'
                    AND TABLE_SCHEMA = DATABASE()
                ");
                
                foreach ($foreignKeys as $fk) {
                    $table->dropForeign($fk->CONSTRAINT_NAME);
                }
                
                $table->dropColumn('supervisor_id');
            }

            if (Schema::hasColumn('pameran_bookings', 'security_id')) {
                $foreignKeys = DB::select("
                    SELECT CONSTRAINT_NAME 
                    FROM information_schema.KEY_COLUMN_USAGE 
                    WHERE TABLE_NAME = 'pameran_bookings' 
                    AND COLUMN_NAME = 'security_id' 
                    AND CONSTRAINT_NAME != 'PRIMARY'
                    AND TABLE_SCHEMA = DATABASE()
                ");
                
                foreach ($foreignKeys as $fk) {
                    $table->dropForeign($fk->CONSTRAINT_NAME);
                }
                
                $table->dropColumn('security_id');
            }

            // Add foreign keys for new columns
            $table->foreign('supervisor_user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');

            $table->foreign('security_user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
        });

        // ===================================================================
        // STEP 8: Drop redundant tables (supervisors and securities)
        // ===================================================================
        Schema::dropIfExists('supervisors');
        Schema::dropIfExists('securities');

        // ===================================================================
        // STEP 9: Update old bookings table if it exists
        // ===================================================================
        if (Schema::hasTable('bookings')) {
            // Add new columns if they don't exist
            if (!Schema::hasColumn('bookings', 'supervisor_user_id')) {
                Schema::table('bookings', function (Blueprint $table) {
                    $table->unsignedBigInteger('supervisor_user_id')->nullable()->after('user_id');
                });
            }

            if (!Schema::hasColumn('bookings', 'security_user_id')) {
                Schema::table('bookings', function (Blueprint $table) {
                    $table->unsignedBigInteger('security_user_id')->nullable()->after('supervisor_user_id');
                });
            }

            // Convert string spv/security to user_id
            DB::statement("
                UPDATE bookings b
                INNER JOIN users u ON LOWER(b.spv) = LOWER(u.name)
                SET b.supervisor_user_id = u.id
                WHERE u.role = 'spv' AND b.spv IS NOT NULL
            ");

            DB::statement("
                UPDATE bookings b
                INNER JOIN users u ON LOWER(b.security) = LOWER(u.name)
                SET b.security_user_id = u.id
                WHERE u.role = 'security' AND b.security IS NOT NULL
            ");

            // Drop old string columns
            Schema::table('bookings', function (Blueprint $table) {
                if (Schema::hasColumn('bookings', 'spv')) {
                    $table->dropColumn('spv');
                }
                if (Schema::hasColumn('bookings', 'security')) {
                    $table->dropColumn('security');
                }
            });

            // Add foreign keys
            Schema::table('bookings', function (Blueprint $table) {
                $table->foreign('supervisor_user_id')
                      ->references('id')
                      ->on('users')
                      ->onDelete('set null');

                $table->foreign('security_user_id')
                      ->references('id')
                      ->on('users')
                      ->onDelete('set null');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Recreate supervisors table
        Schema::create('supervisors', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('position')->default('SPV');
            $table->string('nomor_hp')->nullable();
            $table->timestamps();
        });

        // Recreate securities table
        Schema::create('securities', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('position')->default('Security');
            $table->string('nomor_hp')->nullable();
            $table->timestamps();
        });

        // Restore test_drive_bookings
        Schema::table('test_drive_bookings', function (Blueprint $table) {
            $table->dropForeign(['supervisor_user_id']);
            $table->dropForeign(['security_user_id']);
            $table->dropColumn(['supervisor_user_id', 'security_user_id']);
            
            $table->unsignedBigInteger('supervisor_id')->nullable();
            $table->unsignedBigInteger('security_id')->nullable();
            
            $table->foreign('supervisor_id')->references('id')->on('supervisors')->onDelete('set null');
            $table->foreign('security_id')->references('id')->on('securities')->onDelete('set null');
        });

        // Restore pameran_bookings
        Schema::table('pameran_bookings', function (Blueprint $table) {
            $table->dropForeign(['supervisor_user_id']);
            $table->dropForeign(['security_user_id']);
            $table->dropColumn(['supervisor_user_id', 'security_user_id']);
            
            $table->unsignedBigInteger('supervisor_id')->nullable();
            $table->unsignedBigInteger('security_id')->nullable();
            
            $table->foreign('supervisor_id')->references('id')->on('supervisors')->onDelete('set null');
            $table->foreign('security_id')->references('id')->on('securities')->onDelete('set null');
        });

        // Restore bookings if exists
        if (Schema::hasTable('bookings')) {
            Schema::table('bookings', function (Blueprint $table) {
                $table->dropForeign(['supervisor_user_id']);
                $table->dropForeign(['security_user_id']);
                $table->dropColumn(['supervisor_user_id', 'security_user_id']);
                
                $table->string('spv')->nullable();
                $table->string('security')->nullable();
            });
        }
    }
};