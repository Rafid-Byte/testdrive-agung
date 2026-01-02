<?php

namespace App\Services;

use App\Models\User;

class RedirectService
{
    /**
     * Get redirect path based on user role
     */
    public static function getRedirectPath(User $user): string
    {
        return match ($user->role) {
            'admin' => route('dashboard'),      // Admin → Dashboard
            'spv' => route('dashboard'),        // SPV → Dashboard
            'security' => route('checksheet'),  // Security → Checksheet
            'user' => route('home'),            // User → Welcome page
            default => route('home'),
        };
    }

    /**
     * Redirect user based on their role
     */
    public static function redirect(User $user)
    {
        return redirect()->intended(self::getRedirectPath($user));
    }

    /**
     * Check if user can access specific page
     */
    public static function canAccess(User $user, string $page): bool
    {
        return match ($page) {
            'dashboard' => in_array($user->role, ['admin', 'spv']),
            'checksheet' => in_array($user->role, ['admin', 'security']),
            'home' => true, // Semua bisa akses welcome page
            default => false,
        };
    }

    /**
     * Get homepage based on user role
     */
    public static function getHomepage(User $user): string
    {
        return self::getRedirectPath($user);
    }
}