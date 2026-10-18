<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user());
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return $this->redirectBasedOnRole(Auth::user());
        }

        return back()->withErrors([
            'email' => 'Email atau kata sandi yang Anda masukkan tidak sesuai.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user());
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'store_name' => 'nullable|string|max:120',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string|in:owner,staff_cashier,staff_inventory,user,customer',
        ]);

        $storeId = null;
        if (in_array($request->role, ['owner', 'staff_cashier', 'staff_inventory']) && !empty($request->store_name)) {
            $store = Store::firstOrCreate(
                ['name' => $request->store_name],
                [
                    'owner_name' => $request->name,
                    'category' => 'Retail & Sembako',
                    'location' => 'Indonesia',
                    'daily_revenue_target' => 10000000,
                    'monthly_revenue_target' => 120000000,
                    'business_health_score' => 90,
                    'has_delivery' => true,
                    'delivery_fee' => 5000,
                ]
            );
            $storeId = $store->id;
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'store_id' => $storeId,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return $this->redirectBasedOnRole($user);
    }

    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        // Simulasi pengiriman token reset
        return back()->with('status', 'Tautan pemulihan kata sandi telah dikirimkan ke email Anda!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar dari sistem LARIS.');
    }

    /**
     * Redirect cerdas berdasarkan hak akses role
     */
    protected function redirectBasedOnRole($user)
    {
        return match ($user->role) {
            'super_admin' => redirect()->route('admin.dashboard'),
            'staff_cashier' => redirect()->route('cashier.dashboard'),
            'staff_inventory' => redirect()->route('inventory_staff.dashboard'),
            'user', 'customer' => redirect()->route('user.dashboard'),
            default => redirect()->route('dashboard'),
        };
    }
}
