<?php

namespace Database\Factories;

use App\Models\DeviceManufacturer;
use App\Models\DeviceModel;
use App\Models\SimCard;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Device>
 */
class DeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'form_factor' => fake()->randomElement(config('constants.form_factors')),
            'serial_number' => fake()->unique()->numerify('##########'),
            'imei' => fake()->unique()->numerify('###############'),
            'device_manufacturer_id' => DeviceManufacturer::factory(),
            'device_model_id' => DeviceModel::factory(),
            'operating_system' => fake()->randomElement(config('constants.operating_systems')),
            'user_id' => User::factory(),
            'sim_card_id' => SimCard::factory(),
        ];
    }
}
