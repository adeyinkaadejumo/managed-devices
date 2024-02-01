<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersListTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_list_returns_data_correctly(): void
    {
        User::factory(10)->create();

        $response = $this->get('/api/v1/users');

        $response->assertStatus(200);
        $response->assertJsonCount(10, 'data');
    }
}
