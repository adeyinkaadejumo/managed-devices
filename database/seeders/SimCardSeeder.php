<?php

namespace Database\Seeders;

use App\Models\SimCard;
use Illuminate\Database\Seeder;

class SimCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SimCard::factory(10)->create();
    }
}
