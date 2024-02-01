<?php

namespace Tests\Feature;

use App\Models\Device;
use App\Models\SimCard;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateDeviceTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_device_successfully(): void
    {
        $user = User::factory()->create();

        $device = Device::factory()->create([
            'serial_number' => '1234567890',
        ]);

        $response = $this->putJson('/api/v1/devices/'.$device->id, [
            'user_id' => $user->id,
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment(['user_id' => $user->id]);
        $response->assertJsonFragment(['serial_number' => '1234567890']);

        $sim_card = SimCard::factory()->create();

        $response = $this->putJson('/api/v1/devices/'.$device->id, [
            'sim_card_id' => $sim_card->id,
        ]);

        $response->assertStatus(200);

        $response->assertJsonFragment(['sim_card_id' => $sim_card->id]);
        $response->assertJsonFragment(['serial_number' => '1234567890']);
    }

    public function test_device_status_is_active_after_update(): void
    {
        $device = Device::factory()->create([
            'deactivated_at' => now(),
            'serial_number' => '1234567890',
        ]);
        $this->assertNotNull($device->deactivated_at);

        $response = $this->putJson('/api/v1/devices/'.$device->id, [
            'user_id' => User::factory()->create()->id,
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment(['serial_number' => '1234567890']);

        $device = Device::find($device->id);
        $this->assertNull($device->deactivated_at);
    }
}
