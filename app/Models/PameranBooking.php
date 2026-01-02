<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PameranBooking extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'booking_type',
        'sales_user_id',
        'nama_pic',
        'nomor_telepon',
        'email',
        'mobil',
        'target_prospect',
        'tanggal_booking',
        'tanggal_mulai',
        'tanggal_selesai',
        'tanggal_acara',
        'lokasi_acara',
        'supervisor_user_id', // ✅ UPDATED: Changed from supervisor_id
        'security_user_id',   // ✅ UPDATED: Changed from security_id
        'status'
    ];

    protected $casts = [
        'tanggal_booking' => 'date',
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'tanggal_acara' => 'date',
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
     * Get formatted event date
     */
    public function getFormattedEventDateAttribute()
    {
        return $this->tanggal_acara ? 
               \Carbon\Carbon::parse($this->tanggal_acara)->locale('id')->translatedFormat('d F Y') : 
               '-';
    }

    /**
     * Get formatted start date
     */
    public function getFormattedStartDateAttribute()
    {
        return $this->tanggal_mulai ? 
               \Carbon\Carbon::parse($this->tanggal_mulai)->locale('id')->translatedFormat('d F Y') : 
               '-';
    }

    /**
     * Get formatted end date
     */
    public function getFormattedEndDateAttribute()
    {
        return $this->tanggal_selesai ? 
               \Carbon\Carbon::parse($this->tanggal_selesai)->locale('id')->translatedFormat('d F Y') : 
               '-';
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
     * Check if booking is approved
     */
    public function isApproved(): bool
    {
        return in_array($this->status, [
            'Dikonfirmasi',
            'Diproses', 
            'Sedang Pameran',
            'Selesai'
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