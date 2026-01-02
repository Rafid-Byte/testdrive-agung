<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestDriveBooking extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'booking_type',
        'nama_lengkap',
        'nomor_telepon',
        'email',
        'no_ktp',
        'alamat',
        'mobil_test_drive',
        'tanggal_booking',
        'status',
        'supervisor_id',
        'sales_user_id', // ✅ NEW: ID user sales yang booking

        // ✅ NEW: Sales & Test Drive Info
        'sales_name',
        'sales_phone',
        'test_drive_time',
        'test_drive_location',
    ];

    protected $casts = [
        'tanggal_booking' => 'date',
    ];

    // Relationships
    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class);
    }

    public function security()
    {
        return $this->belongsTo(Security::class);
    }

    public function checksheet()
    {
        return $this->hasOne(Checksheet::class, 'booking_id');
    }

    // ✅ NEW: Relationship ke User (SPV yang dipilih sales)
    public function salesUser()
    {
        return $this->belongsTo(User::class, 'sales_user_id');
    }

    // Accessors
    public function getFormattedDateAttribute()
    {
        return \Carbon\Carbon::parse($this->tanggal_booking)->format('d F Y');
    }

    // Status checks
    public function hasChecksheet(): bool
    {
        return $this->checksheet()->exists();
    }

    public function isApproved(): bool
    {
        return in_array($this->status, [
            'Dikonfirmasi',
            'Diproses',
            'Sedang test drive',
            'Selesai',
            'Perawatan'
        ]);
    }

    public function isPending(): bool
    {
        return $this->status === 'Menunggu';
    }

    public function isNotApproved(): bool
    {
        return $this->status === 'Dibatalkan';
    }

    public function getApprovalStatusAttribute()
    {
        // ✅ Dikonfirmasi = Disetujui (dapat akses checksheet)
        if ($this->status === 'Dikonfirmasi') {
            return 'approved';
        }

        // ❌ Dibatalkan = Tidak Disetujui (tidak dapat akses)
        if ($this->status === 'Dibatalkan') {
            return 'not_approved';
        }

        // ⏳ Selain itu = Menunggu (tidak dapat akses)
        return 'pending';
    }

    public function getApprovalLabelAttribute()
    {
        return match ($this->approval_status) {
            'approved' => 'Disetujui',
            'not_approved' => 'Dibatalkan',
            default => 'Menunggu',
        };
    }

    public function canAccessChecksheet(): bool
    {
        return in_array($this->status, [
            'Dikonfirmasi',
            'Sedang test drive',
            'Selesai',
            'Perawatan'
        ]);
    }
}
