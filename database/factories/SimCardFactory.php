<?php

namespace Database\Factories;

use App\Models\MobileContract;
use App\Models\NetworkProvider;
use App\Models\PhoneNumber;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SimCard>
 */
class SimCardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'serial_number' => fake()->unique()->numerify('###############'),
            'mobile_contract_id' => MobileContract::factory(),
            'network_provider_id' => NetworkProvider::factory(),
            'phone_number_id' => PhoneNumber::factory(),
        ];
    }
}
