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
        'supervisor_user_id', 
        'security_user_id',   
        'status'
    ];

    protected $casts = [
        'tanggal_booking' => 'date',
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'tanggal_acara' => 'date',
    ];

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_user_id')->where('role', 'spv');
    }

    public function security()
    {
        return $this->belongsTo(User::class, 'security_user_id')->where('role', 'security');
    }

    public function salesUser()
    {
        return $this->belongsTo(User::class, 'sales_user_id');
    }

    public function getFormattedDateAttribute()
    {
        return \Carbon\Carbon::parse($this->tanggal_booking)->locale('id')->translatedFormat('d F Y');
    }

    public function getFormattedEventDateAttribute()
    {
        return $this->tanggal_acara ? 
               \Carbon\Carbon::parse($this->tanggal_acara)->locale('id')->translatedFormat('d F Y') : 
               '-';
    }

    public function getFormattedStartDateAttribute()
    {
        return $this->tanggal_mulai ? 
               \Carbon\Carbon::parse($this->tanggal_mulai)->locale('id')->translatedFormat('d F Y') : 
               '-';
    }

    public function getFormattedEndDateAttribute()
    {
        return $this->tanggal_selesai ? 
               \Carbon\Carbon::parse($this->tanggal_selesai)->locale('id')->translatedFormat('d F Y') : 
               '-';
    }

    public function getSupervisorNameAttribute()
    {
        return $this->supervisor ? $this->supervisor->name : '-';
    }

    public function getSecurityNameAttribute()
    {
        return $this->security ? $this->security->name : '-';
    }

    public function isApproved(): bool
    {
        return in_array($this->status, [
            'Dikonfirmasi',
            'Diproses', 
            'Sedang Pameran',
            'Selesai'
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