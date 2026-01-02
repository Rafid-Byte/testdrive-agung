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
        'supervisor_user_id', // ✅ UPDATED: Changed from supervisor_id
        'security_user_id',   // ✅ UPDATED: Changed from security_id
        'sales_user_id',

        // Sales & Test Drive Info
        'sales_name',
        'sales_phone',
        'test_drive_time',
        'test_drive_location',
    ];

    protected $casts = [
        'tanggal_booking' => 'date',
    ];

    // ===================================================================
    // RELATIONSHIPS
    // ===================================================================

    /**
     * ✅ UPDATED: Supervisor relationship now points to users table
     */
    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_user_id')->where('role', 'spv');
    }

    /**
     * ✅ UPDATED: Security relationship now points to users table
     */
    public function security()
    {
        return $this->belongsTo(User::class, 'security_user_id')->where('role', 'security');
    }

    /**
     * Relationship to checksheet
     */
    public function checksheet()
    {
        return $this->hasOne(Checksheet::class, 'booking_id');
    }

    /**
     * Relationship to the sales user who created the booking
     */
    public function salesUser()
    {
        return $this->belongsTo(User::class, 'sales_user_id');
    }

    // ===================================================================
    // ACCESSORS
    // ===================================================================

    /**
     * Get formatted booking date
     */
    public function getFormattedDateAttribute()
    {
        return \Carbon\Carbon::parse($this->tanggal_booking)->locale('id')->translatedFormat('d F Y');
    }

    /**
     * ✅ NEW: Get supervisor name
     */
    public function getSupervisorNameAttribute()
    {
        return $this->supervisor ? $this->supervisor->name : '-';
    }

    /**
     * ✅ NEW: Get security name
     */
    public function getSecurityNameAttribute()
    {
        return $this->security ? $this->security->name : '-';
    }

    // ===================================================================
    // STATUS CHECKS
    // ===================================================================

    /**
     * Check if booking has checksheet
     */
    public function hasChecksheet(): bool
    {
        return $this->checksheet()->exists();
    }

    /**
     * Check if booking is approved (confirmed)
     */
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

    /**
     * Check if booking is pending
     */
    public function isPending(): bool
    {
        return $this->status === 'Menunggu';
    }

    /**
     * Check if booking is not approved (canceled)
     */
    public function isNotApproved(): bool
    {
        return $this->status === 'Dibatalkan';
    }

    /**
     * Get approval status
     */
    public function getApprovalStatusAttribute()
    {
        if ($this->status === 'Dikonfirmasi') {
            return 'approved';
        }

        if ($this->status === 'Dibatalkan') {
            return 'not_approved';
        }

        return 'pending';
    }

    /**
     * Get approval label
     */
    public function getApprovalLabelAttribute()
    {
        return match ($this->approval_status) {
            'approved' => 'Disetujui',
            'not_approved' => 'Dibatalkan',
            default => 'Menunggu',
        };
    }

    /**
     * Check if user can access checksheet for this booking
     */
    public function canAccessChecksheet(): bool
    {
        return in_array($this->status, [
            'Dikonfirmasi',
            'Sedang test drive',
            'Selesai',
            'Perawatan'
        ]);
    }

    // ===================================================================
    // SCOPES
    // ===================================================================

    /**
     * Scope to filter by supervisor
     */
    public function scopeBySupervisor($query, $supervisorUserId)
    {
        return $query->where('supervisor_user_id', $supervisorUserId);
    }

    /**
     * Scope to filter by status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope to filter by date range
     */
    public function scopeDateRange($query, $from, $to)
    {
        if ($from && $to) {
            return $query->whereBetween('tanggal_booking', [$from, $to]);
        } elseif ($from) {
            return $query->where('tanggal_booking', '>=', $from);
        } elseif ($to) {
            return $query->where('tanggal_booking', '<=', $to);
        }
        return $query;
    }
}