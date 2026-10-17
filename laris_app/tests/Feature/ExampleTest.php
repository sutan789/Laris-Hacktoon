<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $owner = User::firstOrCreate(
            ['email' => 'juragan@laris.id'],
            [
                'name' => 'Juragan Bambang',
                'password' => bcrypt('password123'),
                'role' => 'owner',
            ]
        );

        $response = $this->actingAs($owner)->get('/');

        $response->assertStatus(200);
    }
}
