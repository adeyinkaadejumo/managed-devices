<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    /**
     * GET Users
     *
     * Returns list of all users.
     *
     * @response { "data": [ { "id": "1", "type": "users", "attributes": { "name": "Berneice Orn", "email": "dkovacek@example.org", "created_at": "2024-02-01T13:18:52.000000Z", "updated_at": "2024-02-01T13:18:52.000000Z" } }, { "id": "2", "type": "users", "attributes": { "name": "Arjun Schmidt I", "email": "weber.solon@example.net", "created_at": "2024-02-01T13:18:52.000000Z", "updated_at": "2024-02-01T13:18:52.000000Z" } }, { "id": "3", "type": "users", "attributes": { "name": "Prof. Myriam Douglas", "email": "trycia.weissnat@example.com", "created_at": "2024-02-01T13:18:52.000000Z", "updated_at": "2024-02-01T13:18:52.000000Z" } }, { "id": "4", "type": "users", "attributes": { "name": "Luciano Sporer", "email": "amya10@example.net", "created_at": "2024-02-01T13:18:52.000000Z", "updated_at": "2024-02-01T13:18:52.000000Z" } }, { "id": "5", "type": "users", "attributes": { "name": "Dr. Garret Rice", "email": "mollie80@example.net", "created_at": "2024-02-01T13:18:52.000000Z", "updated_at": "2024-02-01T13:18:52.000000Z" } }, { "id": "6", "type": "users", "attributes": { "name": "Carter Christiansen", "email": "lorenz.emmerich@example.com", "created_at": "2024-02-01T13:18:52.000000Z", "updated_at": "2024-02-01T13:18:52.000000Z" } }, { "id": "7", "type": "users", "attributes": { "name": "Prof. Ernestine O'Connell", "email": "streich.antonia@example.org", "created_at": "2024-02-01T13:18:52.000000Z", "updated_at": "2024-02-01T13:18:52.000000Z" } }, { "id": "8", "type": "users", "attributes": { "name": "Demond McLaughlin", "email": "ebeatty@example.com", "created_at": "2024-02-01T13:20:02.000000Z", "updated_at": "2024-02-01T13:20:02.000000Z" } }, { "id": "30", "type": "users", "attributes": { "name": "Shaylee Roberts Sr.", "email": "zmuller@example.com", "created_at": "2024-02-01T13:20:02.000000Z", "updated_at": "2024-02-01T13:20:02.000000Z" } } ], "jsonapi": { "version": "1.0" } }
     */
    public function index()
    {
        $users = User::all();

        return UserResource::collection($users);
    }
}
