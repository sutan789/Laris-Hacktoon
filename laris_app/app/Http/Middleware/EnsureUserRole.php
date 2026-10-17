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

        // If no specific roles defined or user's role is allowed
        if (empty($roles) || in_array($user->role, $roles, true)) {
            return $next($request);
        }

        // Redirect user strictly to their own role's dashboard
        $targetRoute = match ($user->role) {
            'staff_cashier' => route('cashier.dashboard'),
            'staff_inventory' => route('inventory_staff.dashboard'),
            'customer' => route('customer.dashboard'),
            default => route('dashboard'),
        };

        return redirect($targetRoute)->with('warning', 'Akses dialihkan ke dashboard resmi sesuai peran akun Anda (' . ucfirst(str_replace('_', ' ', $user->role)) . ').');
    }
}
