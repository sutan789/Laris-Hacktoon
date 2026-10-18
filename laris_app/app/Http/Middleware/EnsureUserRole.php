<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        $userRole = $user->role;

        // Strict role matching: only exact role or user/customer synonym
        $isAllowed = false;

        foreach ($roles as $role) {
            $allowedRoles = explode(',', $role);
            foreach ($allowedRoles as $ar) {
                $ar = trim($ar);
                if ($userRole === $ar) {
                    $isAllowed = true;
                    break 2;
                }
                if (($userRole === 'customer' || $userRole === 'user') && ($ar === 'user' || $ar === 'customer')) {
                    $isAllowed = true;
                    break 2;
                }
            }
        }

        if ($isAllowed) {
            return $next($request);
        }

        // Redirect user strictly to their own role's official dashboard
        $targetRoute = match ($user->role) {
            'super_admin' => route('admin.dashboard'),
            'staff_cashier' => route('cashier.dashboard'),
            'staff_inventory' => route('inventory_staff.dashboard'),
            'user', 'customer' => route('user.dashboard'),
            default => route('dashboard'),
        };

        $roleTitle = match ($user->role) {
            'super_admin' => 'Super Administrator',
            'staff_cashier' => 'Kasir Toko',
            'staff_inventory' => 'Staf Gudang',
            'user', 'customer' => 'Pembeli / Konsumen',
            default => 'Juragan UMKM (Owner)',
        };

        return redirect($targetRoute)->with('warning', "Akses Dibatasi: Halaman tersebut memerlukan hak akses berbeda. Sesi Anda aktif sebagai {$roleTitle}.");
    }
}
