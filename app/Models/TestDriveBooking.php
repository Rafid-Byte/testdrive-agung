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
        'supervisor_user_id', 
        'security_user_id',   
        'sales_user_id',

        'sales_name',
        'sales_phone',
        'test_drive_time',
        'test_drive_location',
    ];

    protected $casts = [
        'tanggal_booking' => 'date',
    ];

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_user_id')->where('role', 'spv');
    }

    public function security()
    {
        return $this->belongsTo(User::class, 'security_user_id')->where('role', 'security');
    }

    public function checksheet()
    {
        return $this->hasOne(Checksheet::class, 'booking_id');
    }

    public function salesUser()
    {
        return $this->belongsTo(User::class, 'sales_user_id');
    }

    public function getFormattedDateAttribute()
    {
        return \Carbon\Carbon::parse($this->tanggal_booking)->locale('id')->translatedFormat('d F Y');
    }

    public function getSupervisorNameAttribute()
    {
        return $this->supervisor ? $this->supervisor->name : '-';
    }

    public function getSecurityNameAttribute()
    {
        return $this->security ? $this->security->name : '-';
    }

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
        if ($this->status === 'Dikonfirmasi') {
            return 'approved';
        }

        if ($this->status === 'Dibatalkan') {
            return 'not_approved';
        }

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

    public function scopeBySupervisor($query, $supervisorUserId)
    {
        return $query->where('supervisor_user_id', $supervisorUserId);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

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