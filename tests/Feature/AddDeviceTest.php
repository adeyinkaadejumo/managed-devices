<?php

namespace Tests\Feature;

use App\Models\DeviceManufacturer;
use App\Models\DeviceModel;
use App\Models\SimCard;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddDeviceTest extends TestCase
{
    use RefreshDatabase;

    public function test_add_device_successfully_with_valid_data(): void
    {
        $response = $this->postJson('/api/v1/devices', [
            'form_factor' => 'Phone',
            'serial_number' => '1234567890',
            'imei' => '123456789012345',
            'device_manufacturer_id' => DeviceManufacturer::factory()->create()->id,
            'device_model_id' => DeviceModel::factory()->create()->id,
            'operating_system' => 'Android',
            'deactivated_at' => null,
            'user_id' => User::factory()->create()->id,
            'sim_card_id' => SimCard::factory()->create()->id,
        ]);

        $response->assertStatus(201);

        $response = $this->get('/api/v1/devices');
        $response->assertJsonFragment(['serial_number' => '1234567890']);
    }

    public function test_add_device_returns_validation_errors(): void
    {
        $response = $this->postJson('/api/v1/devices', []);
        $response->assertStatus(422);
    }
}
