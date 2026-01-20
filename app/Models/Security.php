<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Security extends Model
{
    protected $fillable = [
        'nama_lengkap',
        'position',
        'nomor_hp',
    ];
    
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(TestDriveBooking::class);
    }

    public function getTotalBookingsAttribute(): int
    {
        return $this->bookings()->count();
    }

    public function getActiveBookingsAttribute(): int
    {
        return $this->bookings()
            ->whereNotIn('status', ['Selesai', 'Dibatalkan'])
            ->count();
    }
    
    public function getNameAttribute(): string
    {
        return $this->nama_lengkap;
    }
}