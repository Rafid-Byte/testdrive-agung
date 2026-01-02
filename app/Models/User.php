<?php
// File: app/Models/User.php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relationship dengan Checksheet
     */
    public function checksheets()
    {
        return $this->hasMany(Checksheet::class);
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is SPV/Supervisor
     */
    public function isSpv(): bool
    {
        return $this->role === 'spv';
    }

    /**
     * ✅ NEW: Check if user is Branch Manager
     */
    public function isBranchManager(): bool
    {
        return $this->role === 'branch_manager';
    }

    /**
     * Check if user is Security
     */
    public function isSecurity(): bool
    {
        return $this->role === 'security';
    }

    /**
     * Check if user is regular user
     */
    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    /**
     * Check if user is Sales
     */
    public function isSales(): bool
    {
        return $this->role === 'sales';
    }

    /**
     * Check if user has specific role
     */
    public function hasRole(string|array $roles): bool
    {
        if (is_array($roles)) {
            return in_array($this->role, $roles);
        }
        
        return $this->role === $roles;
    }

    /**
     * Check if user can access dashboard
     */
    public function canAccessDashboard(): bool
    {
        return in_array($this->role, ['admin', 'spv', 'branch_manager']);
    }

    /**
     * Check if user can access checksheet
     */
    public function canAccessChecksheet(): bool
    {
        return in_array($this->role, ['admin', 'security']);
    }

    /**
     * Get checksheets count for this user
     */
    public function getChecksheetsCountAttribute(): int
    {
        return $this->checksheets()->count();
    }

    /**
     * Get pending checksheets for this user
     */
    public function pendingChecksheets()
    {
        return $this->checksheets()->where('status', 'pending');
    }

    /**
     * Get approved checksheets for this user
     */
    public function approvedChecksheets()
    {
        return $this->checksheets()->where('status', 'approved');
    }
}