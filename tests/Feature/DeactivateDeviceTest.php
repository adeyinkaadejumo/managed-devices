<?php

namespace Tests\Feature;

use App\Models\Device;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeactivateDeviceTest extends TestCase
{
    use RefreshDatabase;

    public function test_deactivate_device_successfully(): void
    {
        $device = Device::factory()->create();
        $this->assertNull($device->deactivated_at);

        $response = $this->patchJson('/api/v1/devices/'.$device->id.'/deactivate');
        $response->assertStatus(200);

        $device = Device::find($device->id);
        $this->assertNotNull($device->deactivated_at);
    }
}
