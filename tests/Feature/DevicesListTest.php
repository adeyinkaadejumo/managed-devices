<?php

namespace Tests\Feature;

use App\Models\Device;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DevicesListTest extends TestCase
{
    use RefreshDatabase;

    public function test_devices_list_returns_data_correctly(): void
    {
        Device::factory(10)->create();

        $response = $this->get('/api/v1/devices');

        $response->assertStatus(200);
        $response->assertJsonCount(10, 'data');
    }

    public function test_devices_list_filters_by_operating_system_correctly(): void
    {
        $androidDevice = Device::factory()->create([
            'operating_system' => 'Android',
        ]);
        $iOSDevice = Device::factory()->create([
            'operating_system' => 'iOS',
        ]);

        $endpoint = '/api/v1/devices';

        $response = $this->get($endpoint);
        $response->assertJsonCount(2, 'data');
        $response->assertJsonFragment(['id' => $androidDevice->id]);
        $response->assertJsonFragment(['id' => $iOSDevice->id]);

        $response = $this->get($endpoint.'?operating_system=Android');
        $response->assertJsonCount(1, 'data');
        $response->assertJsonMissing(['id' => $iOSDevice->id]);
        $response->assertJsonFragment(['id' => $androidDevice->id]);

        $response = $this->get($endpoint.'?operating_system=iOS');
        $response->assertJsonCount(1, 'data');
        $response->assertJsonMissing(['id' => $androidDevice->id]);
        $response->assertJsonFragment(['id' => $iOSDevice->id]);

        $response = $this->get($endpoint.'?operating_system=');
        $response->assertJsonCount(2, 'data');
        $response->assertJsonFragment(['id' => $androidDevice->id]);
        $response->assertJsonFragment(['id' => $iOSDevice->id]);
    }

    public function test_devices_list_returns_validation_errors(): void
    {
        Device::factory()->create();

        $response = $this->getJson('/api/v1/devices?operating_system=xyz');
        $response->assertStatus(422);
    }
}
