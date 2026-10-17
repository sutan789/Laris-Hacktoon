<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PredictController;
use App\Http\Controllers\TrendController;
use App\Http\Controllers\JuraganAiController;
use App\Http\Controllers\ReportController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleDashboardController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\HelpController;

// Public Landing Page & Welcome Page at Root URL (http://127.0.0.1:8000/)
Route::get('/', function () {
    if (auth()->check()) {
        $user = auth()->user();
        return match ($user->role) {
            'staff_cashier' => redirect()->route('cashier.dashboard'),
            'staff_inventory' => redirect()->route('inventory_staff.dashboard'),
            'customer' => redirect()->route('customer.dashboard'),
            default => redirect()->route('dashboard'),
        };
    }
    return view('welcome');
})->name('home');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// Public Auth Routes (Login, Register, Forgot Password)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.email');

// Public Sisi Pembeli & Konsumen (Customer-Facing Marketplace Portal)
Route::get('/pembeli', [\App\Http\Controllers\ConsumerController::class, 'index'])->name('consumer.index');
Route::get('/consumer', [\App\Http\Controllers\ConsumerController::class, 'index']);
Route::post('/pembeli/pre-order', [\App\Http\Controllers\ConsumerController::class, 'storePreOrder'])->name('consumer.pre_order');
Route::post('/pembeli/claim-flash-sale', [\App\Http\Controllers\ConsumerController::class, 'claimFlashSale'])->name('consumer.claim_flash_sale');

// Public Multi-Channel POS & Telemetry API Endpoints
Route::post('/api/pos/checkout', [\App\Http\Controllers\PosController::class, 'checkout'])->name('pos.checkout');
Route::get('/api/pos/recent-orders', [\App\Http\Controllers\PosController::class, 'recentOrders'])->name('pos.recent_orders');
Route::get('/api/telemetry/live', [DashboardController::class, 'telemetryApi'])->name('telemetry.live');
Route::post('/api/telemetry/simulate-webhook', [DashboardController::class, 'simulateWebhook'])->name('telemetry.simulate_webhook');

// Authenticated Routes (Strict Role-Separated Dashboards & Features)
Route::middleware(['auth'])->group(function () {

    // === ROLE: OWNER (JURAGAN) DASHBOARD & AI MANAGEMENT ===
    Route::middleware(['role:owner'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/business-dashboard', [DashboardController::class, 'index']);
        Route::get('/dashboard/download-summary', [DashboardController::class, 'downloadSummary'])->name('dashboard.download_summary');
        Route::post('/operational-alerts/{id}/resolve', [DashboardController::class, 'resolveAlert'])->name('alerts.resolve');

        // LARIS Predict ("What If I Sell This?")
        Route::get('/laris-predict', [PredictController::class, 'index'])->name('predict.index');
        Route::post('/laris-predict/simulate', [PredictController::class, 'simulate'])->name('predict.simulate');
        Route::post('/laris-predict/add-to-inventory', [PredictController::class, 'addToInventory'])->name('predict.add_to_inventory');

        // Trend Hunter
        Route::get('/trend-hunter', [TrendController::class, 'index'])->name('trends.index');

        // Juragan AI Copilot
        Route::get('/juragan-ai', [JuraganAiController::class, 'index'])->name('juragan.index');
        Route::post('/juragan-ai/chat', [JuraganAiController::class, 'chat'])->name('juragan.chat');

        // Business Report (Monthly Business Review)
        Route::get('/business-report', [ReportController::class, 'index'])->name('report.index');
        Route::get('/business-report/whatsapp-summary', [ReportController::class, 'exportWhatsapp'])->name('report.whatsapp');

        // Konfigurasi Sistem & Settings
        Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
        Route::post('/settings/store', [SettingsController::class, 'updateStore'])->name('settings.update_store');
        Route::post('/settings/ai', [SettingsController::class, 'updateAi'])->name('settings.update_ai');
        Route::post('/settings/toggle-channel/{channel}', [SettingsController::class, 'toggleChannel'])->name('settings.toggle_channel');
    });

    // === ROLE: SMART INVENTORY (OWNER & INVENTORY STAFF) ===
    Route::middleware(['role:owner,staff_inventory'])->group(function () {
        Route::get('/smart-inventory', [InventoryController::class, 'index'])->name('inventory.index');
        Route::post('/smart-inventory/reorder/{id}', [InventoryController::class, 'reorder'])->name('inventory.reorder');
        Route::post('/smart-inventory/auto-bundle', [InventoryController::class, 'createAutoBundlePO'])->name('inventory.auto_bundle');
        Route::post('/smart-inventory/kulakan-bareng/join', [InventoryController::class, 'joinCollectivePool'])->name('inventory.kulakan_join');
    });

    // === ROLE: CASHIER DASHBOARD (OWNER & CASHIER) ===
    Route::middleware(['role:owner,staff_cashier'])->group(function () {
        Route::get('/cashier/dashboard', [RoleDashboardController::class, 'cashierDashboard'])->name('cashier.dashboard');
    });

    // === ROLE: INVENTORY STAFF DASHBOARD (OWNER & INVENTORY STAFF) ===
    Route::middleware(['role:owner,staff_inventory'])->group(function () {
        Route::get('/inventory/dashboard', [RoleDashboardController::class, 'inventoryDashboard'])->name('inventory_staff.dashboard');
    });

    // === ROLE: CUSTOMER DASHBOARD (OWNER & CUSTOMER) ===
    Route::middleware(['role:owner,customer'])->group(function () {
        Route::get('/customer/dashboard', [RoleDashboardController::class, 'customerDashboard'])->name('customer.dashboard');
    });

    // Common Authenticated Routes
    Route::get('/help', [HelpController::class, 'index'])->name('help.index');
    Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');
});


