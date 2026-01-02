<?php
// File: app/Models/Checksheet.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Checksheet extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'booking_id', 
        'nama_customer',
        'tanggal_test_drive',
        'jam_pinjam',
        'jam_kembali',
        'tipe_mobil',
        'no_polisi',
        
        // Kondisi kendaraan saat dipinjam
        'body_luar_pinjam_baik',
        'body_luar_pinjam_tidak_baik',
        'body_luar_pinjam_catatan',
        'ban_velg_pinjam_baik',
        'ban_velg_pinjam_tidak_baik',
        'ban_velg_pinjam_catatan',
        'kaca_spion_pinjam_baik',
        'kaca_spion_pinjam_tidak_baik',
        'kaca_spion_pinjam_catatan',
        'interior_pinjam_baik',
        'interior_pinjam_tidak_baik',
        'interior_pinjam_catatan',
        'kebersihan_interior_pinjam_baik',
        'kebersihan_interior_pinjam_tidak_baik',
        'kebersihan_interior_pinjam_catatan',
        'peralatan_pinjam_baik',
        'peralatan_pinjam_tidak_baik',
        'peralatan_pinjam_catatan',
        'ac_audio_pinjam_baik',
        'ac_audio_pinjam_tidak_baik',
        'ac_audio_pinjam_catatan',
        'lampu_pinjam_baik',
        'lampu_pinjam_tidak_baik',
        'lampu_pinjam_catatan',
        
        // Kondisi kendaraan saat dikembalikan
        'body_luar_kembali_baik',
        'body_luar_kembali_tidak_baik',
        'body_luar_kembali_catatan',
        'ban_velg_kembali_baik',
        'ban_velg_kembali_tidak_baik',
        'ban_velg_kembali_catatan',
        'kaca_spion_kembali_baik',
        'kaca_spion_kembali_tidak_baik',
        'kaca_spion_kembali_catatan',
        'interior_kembali_baik',
        'interior_kembali_tidak_baik',
        'interior_kembali_catatan',
        'kebersihan_interior_kembali_baik',
        'kebersihan_interior_kembali_tidak_baik',
        'kebersihan_interior_kembali_catatan',
        'peralatan_kembali_baik',
        'peralatan_kembali_tidak_baik',
        'peralatan_kembali_catatan',
        'ac_audio_kembali_baik',
        'ac_audio_kembali_tidak_baik',
        'ac_audio_kembali_catatan',
        'lampu_kembali_baik',
        'lampu_kembali_tidak_baik',
        'lampu_kembali_catatan',
        
        // Bahan bakar
        'bahan_bakar_pinjam_1',
        'bahan_bakar_pinjam_2',
        'bahan_bakar_pinjam_3',
        'bahan_bakar_pinjam_4',
        'bahan_bakar_pinjam_kembali_1',
        'bahan_bakar_pinjam_kembali_2',
        'bahan_bakar_pinjam_kembali_3',
        'bahan_bakar_pinjam_kembali_4',
        'bahan_bakar_kembali_1',
        'bahan_bakar_kembali_2',
        'bahan_bakar_kembali_3',
        'bahan_bakar_kembali_4',
        'bahan_bakar_kembali_kembali_1',
        'bahan_bakar_kembali_kembali_2',
        'bahan_bakar_kembali_kembali_3',
        'bahan_bakar_kembali_kembali_4',
        
        // Dokumen & kunci
        'stnk_pinjam_ada',
        'stnk_pinjam_tidak_ada',
        'kunci_utama_pinjam_ada',
        'kunci_utama_pinjam_tidak_ada',
        'remote_keyless_pinjam_ada',
        'remote_keyless_pinjam_tidak_ada',
        'stnk_kembali_ada',
        'stnk_kembali_tidak_ada',
        'kunci_utama_kembali_ada',
        'kunci_utama_kembali_tidak_ada',
        'remote_keyless_kembali_ada',
        'remote_keyless_kembali_tidak_ada',
        
        // Kelengkapan tambahan
        'air_mineral_pinjam_ada',
        'air_mineral_pinjam_tidak_ada',
        'air_mineral_kembali_ada',
        'air_mineral_kembali_tidak_ada',
        
        // Tambahan
        'tanggal_penggantian_pewangi',
        'status',
        'notes',
    ];

    protected $casts = [
        'tanggal_test_drive' => 'date',
        'tanggal_penggantian_pewangi' => 'date',
        
        // Boolean casts untuk semua checkbox
        'body_luar_pinjam_baik' => 'boolean',
        'body_luar_pinjam_tidak_baik' => 'boolean',
        'ban_velg_pinjam_baik' => 'boolean',
        'ban_velg_pinjam_tidak_baik' => 'boolean',
        'kaca_spion_pinjam_baik' => 'boolean',
        'kaca_spion_pinjam_tidak_baik' => 'boolean',
        'interior_pinjam_baik' => 'boolean',
        'interior_pinjam_tidak_baik' => 'boolean',
        'kebersihan_interior_pinjam_baik' => 'boolean',
        'kebersihan_interior_pinjam_tidak_baik' => 'boolean',
        'peralatan_pinjam_baik' => 'boolean',
        'peralatan_pinjam_tidak_baik' => 'boolean',
        'ac_audio_pinjam_baik' => 'boolean',
        'ac_audio_pinjam_tidak_baik' => 'boolean',
        'lampu_pinjam_baik' => 'boolean',
        'lampu_pinjam_tidak_baik' => 'boolean',
        
        'body_luar_kembali_baik' => 'boolean',
        'body_luar_kembali_tidak_baik' => 'boolean',
        'ban_velg_kembali_baik' => 'boolean',
        'ban_velg_kembali_tidak_baik' => 'boolean',
        'kaca_spion_kembali_baik' => 'boolean',
        'kaca_spion_kembali_tidak_baik' => 'boolean',
        'interior_kembali_baik' => 'boolean',
        'interior_kembali_tidak_baik' => 'boolean',
        'kebersihan_interior_kembali_baik' => 'boolean',
        'kebersihan_interior_kembali_tidak_baik' => 'boolean',
        'peralatan_kembali_baik' => 'boolean',
        'peralatan_kembali_tidak_baik' => 'boolean',
        'ac_audio_kembali_baik' => 'boolean',
        'ac_audio_kembali_tidak_baik' => 'boolean',
        'lampu_kembali_baik' => 'boolean',
        'lampu_kembali_tidak_baik' => 'boolean',
        
        'bahan_bakar_pinjam_1' => 'boolean',
        'bahan_bakar_pinjam_2' => 'boolean',
        'bahan_bakar_pinjam_3' => 'boolean',
        'bahan_bakar_pinjam_4' => 'boolean',
        'bahan_bakar_pinjam_kembali_1' => 'boolean',
        'bahan_bakar_pinjam_kembali_2' => 'boolean',
        'bahan_bakar_pinjam_kembali_3' => 'boolean',
        'bahan_bakar_pinjam_kembali_4' => 'boolean',
        'bahan_bakar_kembali_1' => 'boolean',
        'bahan_bakar_kembali_2' => 'boolean',
        'bahan_bakar_kembali_3' => 'boolean',
        'bahan_bakar_kembali_4' => 'boolean',
        'bahan_bakar_kembali_kembali_1' => 'boolean',
        'bahan_bakar_kembali_kembali_2' => 'boolean',
        'bahan_bakar_kembali_kembali_3' => 'boolean',
        'bahan_bakar_kembali_kembali_4' => 'boolean',
        
        'stnk_pinjam_ada' => 'boolean',
        'stnk_pinjam_tidak_ada' => 'boolean',
        'kunci_utama_pinjam_ada' => 'boolean',
        'kunci_utama_pinjam_tidak_ada' => 'boolean',
        'remote_keyless_pinjam_ada' => 'boolean',
        'remote_keyless_pinjam_tidak_ada' => 'boolean',
        'stnk_kembali_ada' => 'boolean',
        'stnk_kembali_tidak_ada' => 'boolean',
        'kunci_utama_kembali_ada' => 'boolean',
        'kunci_utama_kembali_tidak_ada' => 'boolean',
        'remote_keyless_kembali_ada' => 'boolean',
        'remote_keyless_kembali_tidak_ada' => 'boolean',
        
        'air_mineral_pinjam_ada' => 'boolean',
        'air_mineral_pinjam_tidak_ada' => 'boolean',
        'air_mineral_kembali_ada' => 'boolean',
        'air_mineral_kembali_tidak_ada' => 'boolean',
    ];

    /**
     * Relationship dengan User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship dengan Booking
    public function booking()
    {
        return $this->belongsTo(TestDriveBooking::class, 'booking_id');
    }

    /**
     * Scope untuk filter berdasarkan tanggal
     */
    public function scopeByDate($query, $date)
    {
        return $query->whereDate('tanggal_test_drive', $date);
    }

    /**
     * Scope untuk filter berdasarkan mobil
     */
    public function scopeByCar($query, $carType)
    {
        return $query->where('tipe_mobil', $carType);
    }

    /**
     * Scope untuk filter berdasarkan status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Accessor untuk mendapatkan level bahan bakar saat dipinjam
     */
    public function getFuelLevelPinjamAttribute()
    {
        if ($this->bahan_bakar_pinjam_1) return '1 Kotak';
        if ($this->bahan_bakar_pinjam_2) return '2 Kotak';
        if ($this->bahan_bakar_pinjam_3) return '3 Kotak';
        if ($this->bahan_bakar_pinjam_4) return 'Di Atas 4 Kotak';
        return 'Tidak Diisi';
    }

    /**
     * Accessor untuk mendapatkan level bahan bakar saat dikembalikan
     */
    public function getFuelLevelKembaliAttribute()
    {
        if ($this->bahan_bakar_kembali_1) return '1 Kotak';
        if ($this->bahan_bakar_kembali_2) return '2 Kotak';
        if ($this->bahan_bakar_kembali_3) return '3 Kotak';
        if ($this->bahan_bakar_kembali_4) return 'Di Atas 4 Kotak';
        return 'Tidak Diisi';
    }

    /**
     * Check jika ada kerusakan saat peminjaman
     */
    public function hasKerusakanPinjam()
    {
        return $this->body_luar_pinjam_tidak_baik ||
               $this->ban_velg_pinjam_tidak_baik ||
               $this->kaca_spion_pinjam_tidak_baik ||
               $this->interior_pinjam_tidak_baik ||
               $this->kebersihan_interior_pinjam_tidak_baik ||
               $this->peralatan_pinjam_tidak_baik ||
               $this->ac_audio_pinjam_tidak_baik ||
               $this->lampu_pinjam_tidak_baik;
    }

    /**
     * Check jika ada kerusakan saat pengembalian
     */
    public function hasKerusakanKembali()
    {
        return $this->body_luar_kembali_tidak_baik ||
               $this->ban_velg_kembali_tidak_baik ||
               $this->kaca_spion_kembali_tidak_baik ||
               $this->interior_kembali_tidak_baik ||
               $this->kebersihan_interior_kembali_tidak_baik ||
               $this->peralatan_kembali_tidak_baik ||
               $this->ac_audio_kembali_tidak_baik ||
               $this->lampu_kembali_tidak_baik;
    }

    /**
     * Get status badge color
     */
    public function getStatusBadgeColor()
    {
        return match($this->status) {
            'approved' => 'green',
            'rejected' => 'red',
            default => 'yellow',
        };
    }

    /**
     * Get status label
     */
    public function getStatusLabel()
    {
        return match($this->status) {
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            default => 'Menunggu',
        };
    }
}