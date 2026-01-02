<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            Log::warning('CheckRole: User not authenticated, redirecting to login');
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user();

        // ✅ CRITICAL FIX: Allow API routes for all authenticated users
        if ($request->is('api/*')) {
            Log::info('CheckRole: API route detected, allowing all authenticated users', [
                'user_role' => $user->role,
                'route' => $request->path(),
            ]);
            return $next($request);
        }

        // Logging informasi user yang sedang diakses
        Log::info('CheckRole: User authenticated', [
            'user_id' => $user->id,
            'user_role' => $user->role,
            'required_roles' => $roles,
            'route' => $request->path(),
        ]);

        // Jika role user tidak termasuk dalam yang diperbolehkan
        if (!in_array($user->role, $roles)) {
            Log::warning('CheckRole: Unauthorized access attempt', [
                'user_role' => $user->role,
                'required_roles' => $roles,
                'route' => $request->path(),
            ]);

            // Arahkan berdasarkan role
            return $this->redirectBasedOnRole($user, $request);
        }

        return $next($request);
    }

    /**
     * Redirect user berdasarkan role-nya jika mencoba mengakses halaman yang tidak diizinkan.
     */
    private function redirectBasedOnRole($user, $request): Response
    {
        $message = 'Anda tidak memiliki akses ke halaman tersebut.';
        $role = strtolower(trim($user->role));
        $currentPath = $request->path();

        switch ($role) {
            case 'admin':
                if ($currentPath !== 'dashboard' && !str_starts_with($currentPath, 'dashboard')) {
                    Log::info('CheckRole: Redirecting admin to dashboard');
                    return redirect()->route('dashboard')->with('error', $message);
                }
                abort(403, $message);

            case 'spv':
                if ($currentPath !== 'dashboard' && !str_starts_with($currentPath, 'dashboard')) {
                    Log::info('CheckRole: Redirecting SPV to dashboard');
                    return redirect()->route('dashboard')->with('error', $message);
                }
                abort(403, $message);

            case 'branch_manager':
                if ($currentPath !== 'dashboard' && !str_starts_with($currentPath, 'dashboard')) {
                    Log::info('CheckRole: Redirecting Branch Manager to dashboard');
                    return redirect()->route('dashboard')->with('error', $message);
                }
                abort(403, $message);

            case 'security':
                if ($currentPath !== 'checksheet' && !str_starts_with($currentPath, 'checksheet')) {
                    Log::info('CheckRole: Redirecting Security to checksheet');
                    return redirect()->route('checksheet')->with('error', $message);
                }
                abort(403, $message);

            case 'sales':
                Log::info('CheckRole: Redirecting Sales to home page');
                return redirect()->route('home')->with('info', 'Akses terbatas. Silakan gunakan halaman utama.');

            default:
                abort(403, $message);
        }
    }
}