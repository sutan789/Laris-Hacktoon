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
        ];

        foreach ($urls as $url) {
            $response = $this->get($url);
            $response->assertStatus(200);
            $this->assertTrue(strlen($response->getContent()) > 500, "Page {$url} rendered with insufficient content.");
        }
    }
}
