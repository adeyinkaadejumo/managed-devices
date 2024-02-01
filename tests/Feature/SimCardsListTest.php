<?php

namespace Tests\Feature;

use App\Models\SimCard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SimCardsListTest extends TestCase
{
    use RefreshDatabase;

    public function test_sim_cards_list_returns_data_correctly(): void
    {
        SimCard::factory(10)->create();

        $response = $this->get('/api/v1/sim_cards');

        $response->assertStatus(200);
        $response->assertJsonCount(10, 'data');
    }
}
