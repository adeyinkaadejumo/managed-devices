<?php

namespace Database\Seeders;

use App\Models\DeviceManufacturer;
use Illuminate\Database\Seeder;

class DeviceManufacturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DeviceManufacturer::factory(10)->create();
    }
}
