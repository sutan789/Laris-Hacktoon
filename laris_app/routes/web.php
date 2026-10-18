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
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UserMarketplaceController;
use App\Http\Controllers\ConsumerController;

// Public Landing Page & Welcome Page at Root URL (http://127.0.0.1:8000/)
Route::get('/', function () {
    if (auth()->check()) {
        $user = auth()->user();
        return match ($user->role) {
            'super_admin' => redirect()->route('admin.dashboard'),
            'staff_cashier' => redirect()->route('cashier.dashboard'),
            'staff_inventory' => redirect()->route('inventory_staff.dashboard'),
            'user', 'customer' => redirect()->route('user.dashboard'),
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

// Public Marketplace (Dapat diakses siapa saja tanpa login untuk melihat gerai & produk)
Route::get('/marketplace', [UserMarketplaceController::class, 'publicMarketplace'])->name('public.marketplace');
Route::get('/marketplace/store/{id}', [UserMarketplaceController::class, 'publicStoreDetail'])->name('public.store_detail');

// Akses /pembeli & /consumer WAJIB LOGIN dan dialihkan ke Marketplace Multi-Gerai
Route::get('/pembeli', function () {
    if (!auth()->check()) {
        return redirect()->route('login')->with('info', 'Silakan masuk terlebih dahulu untuk menjelajahi dan berbelanja di Marketplace Gerai UMKM!');
    }
    return redirect()->route('user.marketplace');
})->name('consumer.index');

Route::get('/consumer', function () {
    if (!auth()->check()) {
        return redirect()->route('login')->with('info', 'Silakan masuk terlebih dahulu untuk menjelajahi dan berbelanja di Marketplace Gerai UMKM!');
    }
    return redirect()->route('user.marketplace');
});

Route::post('/pembeli/pre-order', [ConsumerController::class, 'storePreOrder'])->name('consumer.preorder');
Route::post('/pembeli/claim-flash-sale', [ConsumerController::class, 'claimFlashSale'])->name('consumer.claim_flash_sale');

// Authenticated Routes (Strict Role-Separated Dashboards & Features)
Route::middleware(['auth'])->group(function () {

    // Live Business Intelligence Telemetry API (Hanya untuk pengguna terotentikasi)
    Route::get('/api/telemetry/live', [DashboardController::class, 'telemetryApi'])->name('telemetry.live');

    // === ROLE: OWNER (JURAGAN) DASHBOARD & AI MANAGEMENT ===
    Route::middleware(['role:owner'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/business-dashboard', [DashboardController::class, 'index']);
        Route::get('/dashboard/download-summary', [DashboardController::class, 'downloadSummary'])->name('dashboard.download_summary');
        Route::post('/operational-alerts/{id}/resolve', [DashboardController::class, 'resolveAlert'])->name('alerts.resolve');
        Route::post('/api/telemetry/simulate-webhook', [DashboardController::class, 'simulateWebhook'])->name('telemetry.simulate_webhook');

        // Trend Hunter
        Route::get('/trend-hunter', [TrendController::class, 'index'])->name('trends.index');

        // Juragan AI Copilot
        Route::get('/juragan-ai', [JuraganAiController::class, 'index'])->name('juragan.index');
        Route::post('/juragan-ai/chat', [JuraganAiController::class, 'chat'])->name('juragan.chat');
        Route::post('/juragan-ai/action/execute', [JuraganAiController::class, 'executeAction'])->name('juragan.action_execute');

        // Business Report (Monthly Business Review)
        Route::get('/business-report', [ReportController::class, 'index'])->name('report.index');
        Route::get('/business-report/export', [ReportController::class, 'export'])->name('report.export');
        Route::get('/business-report/whatsapp-summary', [ReportController::class, 'exportWhatsapp'])->name('report.whatsapp');

        // Konfigurasi Sistem & Settings
        Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
        Route::post('/settings/store', [SettingsController::class, 'updateStore'])->name('settings.update_store');
        Route::post('/settings/ai', [SettingsController::class, 'updateAi'])->name('settings.update_ai');
        Route::post('/settings/toggle-channel/{channel}', [SettingsController::class, 'toggleChannel'])->name('settings.toggle_channel');
    });

    // === ROLE: INVENTORY & PREDICTION (OWNER, STAFF INVENTORY / GUDANG & STAFF CASHIER) ===
    Route::middleware(['role:owner,staff_inventory,staff_cashier'])->group(function () {
        // Smart Inventory
        Route::get('/smart-inventory', [InventoryController::class, 'index'])->name('inventory.index');
        Route::post('/smart-inventory/products', [InventoryController::class, 'storeProduct'])->name('inventory.store_product');
        Route::post('/smart-inventory/products/{id}/update', [InventoryController::class, 'updateProduct'])->name('inventory.update_product');
        Route::post('/smart-inventory/products/{id}/delete', [InventoryController::class, 'deleteProduct'])->name('inventory.delete_product');
        Route::post('/smart-inventory/reorder/{id}', [InventoryController::class, 'reorder'])->name('inventory.reorder');
        Route::post('/smart-inventory/auto-bundle', [InventoryController::class, 'createAutoBundlePO'])->name('inventory.auto_bundle');
        Route::post('/smart-inventory/kulakan-bareng/join', [InventoryController::class, 'joinCollectivePool'])->name('inventory.kulakan_join');
        Route::post('/smart-inventory/pengadaan-grosir/join', [InventoryController::class, 'joinCollectivePool'])->name('inventory.grosir_join');

        // LARIS Predict ("What If I Sell This?" & Prediksi Restock AI) - Dapat diakses oleh Owner & Staf Gudang
        Route::get('/laris-predict', [PredictController::class, 'index'])->name('predict.index');
        Route::post('/laris-predict/simulate', [PredictController::class, 'simulate'])->name('predict.simulate');
        Route::post('/laris-predict/add-to-inventory', [PredictController::class, 'addToInventory'])->name('predict.add_to_inventory');
        Route::post('/laris-predict/analyze-image', [PredictController::class, 'analyzeImage'])->name('predict.analyze_image');
    });

    // === ROLE: CASHIER DASHBOARD & POS APIS (OWNER & STAFF CASHIER) ===
    Route::middleware(['role:owner,staff_cashier'])->group(function () {
        Route::get('/cashier/dashboard', [RoleDashboardController::class, 'cashierDashboard'])->name('cashier.dashboard');
        Route::get('/cashier/receipt/{id}/pdf', [\App\Http\Controllers\PosController::class, 'downloadReceiptPdf'])->name('cashier.receipt.pdf');
        Route::post('/api/pos/checkout', [\App\Http\Controllers\PosController::class, 'checkout'])->name('pos.checkout');
        Route::get('/api/pos/recent-orders', [\App\Http\Controllers\PosController::class, 'recentOrders'])->name('pos.recent_orders');
    });

    // === ROLE: INVENTORY STAFF DASHBOARD (OWNER & STAFF INVENTORY) ===
    Route::middleware(['role:owner,staff_inventory'])->group(function () {
        Route::get('/inventory/dashboard', [RoleDashboardController::class, 'inventoryDashboard'])->name('inventory_staff.dashboard');
    });

    // === ROLE: SUPER ADMIN PLATFORM (STRICT: SUPER ADMIN ONLY) ===
    Route::middleware(['role:super_admin'])->group(function () {
        Route::get('/admin/dashboard', [SuperAdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/admin/stores', [SuperAdminController::class, 'createStore'])->name('admin.stores.create');
        Route::post('/admin/stores/{id}/update', [SuperAdminController::class, 'updateStore'])->name('admin.stores.update');
        Route::post('/admin/stores/{id}/delete', [SuperAdminController::class, 'deleteStore'])->name('admin.stores.delete');
        Route::post('/admin/stores/{id}/toggle-verification', [SuperAdminController::class, 'toggleStoreVerification'])->name('admin.stores.toggle_verification');
        Route::post('/admin/stores/{id}/toggle-delivery', [SuperAdminController::class, 'toggleStoreDelivery'])->name('admin.stores.toggle_delivery');
        Route::post('/admin/users', [SuperAdminController::class, 'createUser'])->name('admin.users.create');
        Route::post('/admin/users/{id}/update', [SuperAdminController::class, 'updateUser'])->name('admin.users.update');
        Route::post('/admin/users/{id}/delete', [SuperAdminController::class, 'deleteUser'])->name('admin.users.delete');
        Route::post('/admin/users/{id}/role', [SuperAdminController::class, 'updateUserRole'])->name('admin.users.update_role');
    });

    // === ROLE: USER / PEMBELI (STRICT: USER & CUSTOMER ONLY) ===
    Route::middleware(['role:user,customer'])->group(function () {
        Route::get('/user/dashboard', [UserMarketplaceController::class, 'index'])->name('user.dashboard');
        Route::get('/user/marketplace', [UserMarketplaceController::class, 'index'])->name('user.marketplace');
        Route::get('/user/store/{id}', [UserMarketplaceController::class, 'storeDetail'])->name('user.store_detail');
        Route::post('/user/checkout', [UserMarketplaceController::class, 'checkout'])->name('user.checkout');
        Route::get('/user/orders', [UserMarketplaceController::class, 'myOrders'])->name('user.orders');
        Route::get('/user/orders/live-status', [UserMarketplaceController::class, 'liveOrderStatus'])->name('user.orders.live_status');
        Route::post('/user/orders/{id}/cancel', [UserMarketplaceController::class, 'cancelOrder'])->name('user.orders.cancel');
        Route::post('/user/orders/{id}/complete', [UserMarketplaceController::class, 'completeOrder'])->name('user.orders.complete');
        Route::post('/user/orders/{id}/review', [UserMarketplaceController::class, 'reviewOrder'])->name('user.orders.review');
        Route::post('/user/orders/{id}/delete', [UserMarketplaceController::class, 'deleteOrder'])->name('user.orders.delete');
        Route::post('/user/voucher/check', [UserMarketplaceController::class, 'checkVoucher'])->name('user.voucher_check');

        // Backward compatibility
        Route::get('/customer/dashboard', [UserMarketplaceController::class, 'index'])->name('customer.dashboard');
    });

    // Common Authenticated Routes
    Route::get('/help', [HelpController::class, 'index'])->name('help.index');
    Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

    // Realtime Notifications API
    Route::get('/api/notifications/unread', [DashboardController::class, 'getUnreadNotifications'])->name('notifications.unread');
    Route::post('/api/notifications/mark-read', [DashboardController::class, 'markAllNotificationsRead'])->name('notifications.mark_read');
});


