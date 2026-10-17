<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Store;
use App\Models\User;

class SettingsTest extends TestCase
{
    public function test_store_profile_can_be_updated_successfully(): void
    {
        $owner = User::firstOrCreate(
            ['email' => 'juragan@laris.id'],
            [
                'name' => 'Juragan Bambang',
                'password' => bcrypt('password123'),
                'role' => 'owner',
            ]
        );

        $payload = [
            'store_name' => 'Toko Berkah',
            'operating_hours' => '08:00 - 22:00 WIB',
            'phone' => '081234567890',
            'address' => 'Jl. Braga No. 45, Bandung, Jawa Barat',
        ];

        $response = $this->actingAs($owner)->post('/settings/store', $payload);

        $response->assertSessionHas('success', 'Profil toko berhasil diperbarui!');
        $response->assertRedirect();

        $store = Store::first();
        $this->assertEquals('Toko Berkah', $store->name);
        $this->assertEquals('Jl. Braga No. 45, Bandung, Jawa Barat', $store->address);
        $this->assertEquals('081234567890', $store->phone);
        $this->assertEquals('08:00 - 22:00 WIB', $store->operating_hours);
    }
}
