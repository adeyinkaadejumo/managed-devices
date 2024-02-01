<?php

namespace Tests\Feature;

use App\Models\Device;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExportDevicesTest extends TestCase
{
    use RefreshDatabase;

    public function test_export_devices_information_to_csv(): void
    {
        $devices = Device::factory(10)->create();

        $response = $this->get('/api/v1/export-devices');
        $response->assertStatus(200);

        $response->assertHeader('Content-Disposition', 'attachment; filename=devices.csv');
    }
}
