<?php

namespace App\Models;

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

    public function checksheets()
    {
        return $this->hasMany(Checksheet::class);
    }

    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isSpv(): bool
    {
        return $this->role === 'spv';
    }

    public function isBranchManager(): bool
    {
        return $this->role === 'branch_manager';
    }

    public function isSecurity(): bool
    {
        return $this->role === 'security';
    }

    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    public function isSales(): bool
    {
        return $this->role === 'sales';
    }

    public function hasRole(string|array $roles): bool
    {
        if (is_array($roles)) {
            return in_array($this->role, $roles);
        }
        
        return $this->role === $roles;
    }

    public function canAccessDashboard(): bool
    {
        return in_array($this->role, ['admin', 'spv', 'branch_manager']);
    }

    public function canAccessChecksheet(): bool
    {
        return in_array($this->role, ['admin', 'security']);
    }

    public function getChecksheetsCountAttribute(): int
    {
        return $this->checksheets()->count();
    }

    public function pendingChecksheets()
    {
        return $this->checksheets()->where('status', 'pending');
    }

    public function approvedChecksheets()
    {
        return $this->checksheets()->where('status', 'approved');
    }
}