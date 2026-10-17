<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class ResponsiveAndViewsTest extends TestCase
{
    protected function getOwnerUser(): User
    {
        return User::firstOrCreate(
            ['email' => 'juragan@laris.id'],
            [
                'name' => 'Juragan Bambang',
                'password' => bcrypt('password123'),
                'role' => 'owner',
            ]
        );
    }

    protected function getCashierUser(): User
    {
        return User::firstOrCreate(
            ['email' => 'kasir@laris.id'],
            [
                'name' => 'Rian Kasir',
                'password' => bcrypt('password123'),
                'role' => 'staff_cashier',
            ]
        );
    }

    protected function getInventoryUser(): User
    {
        return User::firstOrCreate(
            ['email' => 'gudang@laris.id'],
            [
                'name' => 'Doni Staf Gudang',
                'password' => bcrypt('password123'),
                'role' => 'staff_inventory',
            ]
        );
    }

    protected function getCustomerUser(): User
    {
        return User::firstOrCreate(
            ['email' => 'konsumen@laris.id'],
            [
                'name' => 'Siti Pelanggan (Warga)',
                'password' => bcrypt('password123'),
                'role' => 'customer',
            ]
        );
    }

    public function test_unauthenticated_user_is_redirected_to_login_for_protected_pages(): void
    {
        $protectedUrls = [
            '/dashboard',
            '/smart-inventory',
            '/trend-hunter',
            '/laris-predict',
            '/juragan-ai',
            '/business-report',
            '/settings',
            '/cashier/dashboard',
            '/inventory/dashboard',
            '/customer/dashboard',
        ];

        foreach ($protectedUrls as $url) {
            $response = $this->get($url);
            $response->assertStatus(302);
            $response->assertRedirect('/login');
        }
    }

    public function test_public_pages_render_without_auth(): void
    {
        $publicUrls = [
            '/',            // Root URL renders landing / welcome page
            '/welcome',     // Welcome route
            '/login',
            '/register',
            '/pembeli',
            '/consumer',
        ];

        foreach ($publicUrls as $url) {
            $response = $this->get($url);
            $response->assertStatus(200);
            $this->assertTrue(strlen($response->getContent()) > 200, "Page {$url} rendered with insufficient content.");
        }
    }

    public function test_owner_can_access_all_management_pages(): void
    {
        $owner = $this->getOwnerUser();

        // When logged-in owner visits '/', they get redirected to their dashboard
        $responseHome = $this->actingAs($owner)->get('/');
        $responseHome->assertStatus(302);
        $responseHome->assertRedirect(route('dashboard'));

        $ownerUrls = [
            '/dashboard',
            '/business-dashboard',
            '/smart-inventory',
            '/trend-hunter',
            '/laris-predict',
            '/juragan-ai',
            '/business-report',
            '/settings',
            '/help',
            '/cashier/dashboard',
            '/inventory/dashboard',
        ];

        foreach ($ownerUrls as $url) {
            $response = $this->actingAs($owner)->get($url);
            $response->assertStatus(200);
            $this->assertTrue(strlen($response->getContent()) > 500, "Page {$url} for Owner rendered with insufficient content.");
        }
    }

    public function test_cashier_redirection_and_access(): void
    {
        $cashier = $this->getCashierUser();

        // When cashier visits home '/', they should be smartly redirected to cashier dashboard
        $responseHome = $this->actingAs($cashier)->get('/');
        $responseHome->assertStatus(302);
        $responseHome->assertRedirect(route('cashier.dashboard'));

        // Direct access to cashier dashboard should succeed
        $responsePos = $this->actingAs($cashier)->get('/cashier/dashboard');
        $responsePos->assertStatus(200);
        $this->assertTrue(strlen($responsePos->getContent()) > 500);
    }

    public function test_inventory_staff_redirection_and_access(): void
    {
        $inventory = $this->getInventoryUser();

        // When warehouse staff visits home '/', they should be smartly redirected to warehouse dashboard
        $responseHome = $this->actingAs($inventory)->get('/');
        $responseHome->assertStatus(302);
        $responseHome->assertRedirect(route('inventory_staff.dashboard'));

        // Direct access to inventory dashboard should succeed
        $responseWh = $this->actingAs($inventory)->get('/inventory/dashboard');
        $responseWh->assertStatus(200);
        $this->assertTrue(strlen($responseWh->getContent()) > 500);
    }

    public function test_customer_redirection_and_access(): void
    {
        $customer = $this->getCustomerUser();

        // When customer visits home '/', they should be smartly redirected to customer dashboard
        $responseHome = $this->actingAs($customer)->get('/');
        $responseHome->assertStatus(302);
        $responseHome->assertRedirect(route('customer.dashboard'));

        // Direct access to customer dashboard should succeed
        $responseCust = $this->actingAs($customer)->get('/customer/dashboard');
        $responseCust->assertStatus(200);
        $this->assertTrue(strlen($responseCust->getContent()) > 500);
    }

    public function test_login_post_and_role_redirects(): void
    {
        // 1. Owner Login -> redirects to /dashboard
        $respOwner = $this->post('/login', [
            'email' => 'juragan@laris.id',
            'password' => 'password123',
        ]);
        $respOwner->assertStatus(302);
        $respOwner->assertRedirect(route('dashboard'));
        $this->assertAuthenticated();

        // 2. Cashier Login -> redirects to /cashier/dashboard
        $respCashier = $this->post('/login', [
            'email' => 'kasir@laris.id',
            'password' => 'password123',
        ]);
        $respCashier->assertStatus(302);
        $respCashier->assertRedirect(route('cashier.dashboard'));
        $this->assertAuthenticated();

        // 3. Inventory Staff Login -> redirects to /inventory/dashboard
        $respGudang = $this->post('/login', [
            'email' => 'gudang@laris.id',
            'password' => 'password123',
        ]);
        $respGudang->assertStatus(302);
        $respGudang->assertRedirect(route('inventory_staff.dashboard'));
        $this->assertAuthenticated();

        // 4. Customer Login -> redirects to /customer/dashboard
        $respCustomer = $this->post('/login', [
            'email' => 'konsumen@laris.id',
            'password' => 'password123',
        ]);
        $respCustomer->assertStatus(302);
        $respCustomer->assertRedirect(route('customer.dashboard'));
        $this->assertAuthenticated();
    }

    public function test_strict_role_sidebar_isolation(): void
    {
        $owner = $this->getOwnerUser();
        $cashier = $this->getCashierUser();
        $customer = $this->getCustomerUser();

        // Owner should see executive menu and not cashier/customer headings
        $ownerHtml = $this->actingAs($owner)->get('/dashboard')->getContent();
        $this->assertStringContainsString('Menu Eksekutif', $ownerHtml);
        $this->assertStringNotContainsString('Portal Konsumen Warga', $ownerHtml);

        // Cashier should see cashier operations and not owner executive menu
        $cashierHtml = $this->actingAs($cashier)->get('/cashier/dashboard')->getContent();
        $this->assertStringContainsString('Operasional Kasir', $cashierHtml);
        $this->assertStringNotContainsString('Menu Eksekutif', $cashierHtml);

        // Customer should see customer portal and not owner executive menu
        $customerHtml = $this->actingAs($customer)->get('/customer/dashboard')->getContent();
        $this->assertStringContainsString('Portal Konsumen Warga', $customerHtml);
        $this->assertStringNotContainsString('Menu Eksekutif', $customerHtml);
    }

    public function test_logout_flow_and_relogin_protection(): void
    {
        $owner = $this->getOwnerUser();

        // Act as logged-in user
        $this->actingAs($owner);
        $this->assertAuthenticated();

        // Perform logout
        $responseLogout = $this->post('/logout');
        $responseLogout->assertStatus(302);
        $responseLogout->assertRedirect(route('login'));
        $responseLogout->assertSessionHas('success');

        // Confirm session is cleared
        $this->assertGuest();

        // Confirm accessing '/' now serves the landing page (200)
        $responseLanding = $this->get('/');
        $responseLanding->assertStatus(200);

        // Confirm accessing protected '/dashboard' redirects to login
        $responseProtected = $this->get('/dashboard');
        $responseProtected->assertStatus(302);
        $responseProtected->assertRedirect(route('login'));
    }

    public function test_kulakan_bareng_join_endpoint(): void
    {
        $owner = $this->getOwnerUser();

        $response = $this->actingAs($owner)->post('/smart-inventory/kulakan-bareng/join', [
            'pool_name' => 'Minyak Goreng Sawit 2L',
            'pledge_qty' => 10,
            'estimated_savings' => 55000,
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('success');
    }

    public function test_consumer_preorder_endpoint(): void
    {
        $response = $this->post('/pembeli/pre-order', [
            'customer_name' => 'Bu Siti',
            'phone' => '081234567890',
            'item_name' => 'Beras Pandan Wangi 5kg',
            'quantity' => 2,
            'notes' => 'Tolong yang pulen',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('success_preorder');
    }

    public function test_consumer_claim_flash_sale(): void
    {
        $response = $this->post('/pembeli/claim-flash-sale', [
            'item_name' => 'Roti Tawar Gandum',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('success_coupon');
    }
}
