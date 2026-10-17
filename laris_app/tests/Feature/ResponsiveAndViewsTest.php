<?php

namespace Tests\Feature;

use Tests\TestCase;

class ResponsiveAndViewsTest extends TestCase
{
    public function test_all_pages_render_successfully(): void
    {
        $urls = [
            '/',
            '/dashboard',
            '/smart-inventory',
            '/trend-hunter',
            '/laris-predict',
            '/juragan-ai',
            '/business-report',
            '/settings',
            '/help',
            '/cashier/dashboard',
            '/inventory/dashboard',
            '/login',
            '/register',
            '/welcome',
            '/pembeli',
            '/consumer',
        ];

        foreach ($urls as $url) {
            $response = $this->get($url);
            $response->assertStatus(200);
            $this->assertTrue(strlen($response->getContent()) > 500, "Page {$url} rendered with insufficient content.");
        }
    }

    public function test_kulakan_bareng_join_endpoint(): void
    {
        $response = $this->post('/smart-inventory/kulakan-bareng/join', [
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

