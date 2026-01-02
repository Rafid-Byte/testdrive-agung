<?php
// File: app/Models/PameranBooking.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PameranBooking extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'booking_type', // ✅ NEW
        'sales_user_id', // ✅ NEW
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
        'supervisor_id',
        'status'
    ];

    protected $casts = [
        'tanggal_booking' => 'date',
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'tanggal_acara' => 'date',
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

    public function salesUser()
    {
        return $this->belongsTo(User::class, 'sales_user_id');
    }

    // Accessors
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

    // Status checks
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
}