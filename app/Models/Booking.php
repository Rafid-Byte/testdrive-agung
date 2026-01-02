<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'email',
        'phone',
        'ktp',
        'address',
        'car',
        'status',
        'spv',
        'security',
        'booking_date',
        'user_id'
    ];

    protected $casts = [
        'booking_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relationship with User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get formatted booking date
     */
    public function getFormattedDateAttribute()
    {
        if ($this->booking_date) {
            return Carbon::parse($this->booking_date)->locale('id')->translatedFormat('d F Y');
        }
        return Carbon::parse($this->created_at)->locale('id')->translatedFormat('d F Y');
    }

    /**
     * Scope untuk filter berdasarkan status
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk filter berdasarkan mobil
     */
    public function scopeCar($query, $car)
    {
        return $query->where('car', $car);
    }

    /**
     * Scope untuk filter berdasarkan tanggal
     */
    public function scopeDateRange($query, $from, $to)
    {
        if ($from && $to) {
            return $query->whereBetween('booking_date', [$from, $to]);
        } elseif ($from) {
            return $query->where('booking_date', '>=', $from);
        } elseif ($to) {
            return $query->where('booking_date', '<=', $to);
        }
        return $query;
    }

    /**
     * Get bookings grouped by customer
     */
    public static function getCustomerData()
    {
        $bookings = self::orderBy('created_at', 'desc')->get();
        $customerData = [];

        foreach ($bookings as $booking) {
            $name = $booking->customer_name;
            
            if (!isset($customerData[$name])) {
                $customerData[$name] = [
                    'name' => $name,
                    'phone' => $booking->phone,
                    'email' => $booking->email,
                    'ktp' => $booking->ktp,
                    'address' => $booking->address,
                    'assignedSPV' => $booking->spv ?? '-',
                    'assignedSecurity' => $booking->security ?? '-',
                    'totalBookings' => 0,
                    'lastCar' => null,
                    'bookingHistory' => []
                ];
            }

            $customerData[$name]['totalBookings']++;
            $customerData[$name]['lastCar'] = $booking->car;
            $customerData[$name]['bookingHistory'][] = [
                'date' => $booking->formatted_date,
                'car' => $booking->car,
                'status' => $booking->status
            ];
        }

        return $customerData;
    }
}