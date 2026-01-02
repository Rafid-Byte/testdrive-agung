<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ✅ Create supervisors table (TANPA is_active)
        Schema::create('supervisors', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap', 100);
            $table->string('position', 100)->default('SPV');
            $table->string('nomor_hp', 15);
            $table->timestamps();
        });

        // ✅ Create securities table (TANPA is_active)
        Schema::create('securities', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap', 100);
            $table->string('position', 100)->default('Security');
            $table->string('nomor_hp', 15);
            $table->timestamps();
        });

        // Create test_drive_bookings table
        Schema::create('test_drive_bookings', function (Blueprint $table) {
            $table->id();
            $table->enum('booking_type', ['test_drive', 'pameran'])->default('test_drive');
            $table->string('nama_lengkap', 100);
            $table->string('nomor_telepon', 15);
            $table->string('email', 100);
            $table->string('no_ktp', 16);
            $table->text('alamat');
            $table->string('mobil_test_drive', 100);
            $table->date('tanggal_booking');
            $table->enum('status', [
                'Menunggu',
                'Dikonfirmasi',
                'Diproses',
                'Sedang test drive',
                'Selesai',
                'Perawatan',
                'Dibatalkan'
            ])->default('Menunggu');
            
            // Foreign keys
            $table->foreignId('supervisor_id')->nullable()->constrained('supervisors')->onDelete('set null');
            $table->foreignId('security_id')->nullable()->constrained('securities')->onDelete('set null');
            
            // Test Drive specific fields
            $table->string('sales_name', 100)->nullable();
            $table->string('sales_phone', 15)->nullable();
            $table->time('test_drive_time')->nullable();
            $table->string('test_drive_location', 255)->nullable();
            
            // Pameran/Movex specific fields
            $table->date('event_date')->nullable();
            $table->string('event_location', 255)->nullable();
            
            $table->softDeletes();
            $table->timestamps();
            
            // Indexes
            $table->index('email');
            $table->index('status');
            $table->index('booking_type');
            $table->index('tanggal_booking');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_drive_bookings');
        Schema::dropIfExists('securities');
        Schema::dropIfExists('supervisors');
    }
};