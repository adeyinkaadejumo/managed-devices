<?php

namespace Tests\Feature;

use App\Models\DeviceManufacturer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeviceManufacturersListTest extends TestCase
{
    use RefreshDatabase;

    public function test_device_manufacturers_list_returns_data_correctly(): void
    {
        DeviceManufacturer::factory(10)->create();

        $response = $this->get('/api/v1/device_manufacturers');

        $response->assertStatus(200);
        $response->assertJsonCount(10, 'data');
    }
}
