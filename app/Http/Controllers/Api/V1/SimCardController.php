<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SimCardResource;
use App\Models\SimCard;

class SimCardController extends Controller
{
    /**
     * GET Sim Cards
     *
     * Returns list of all sim cards.
     *
     * @response { "data": [ { "id": "1", "type": "simCards", "attributes": { "serial_number": "366884779053177", "mobile_contract": { "id": 19, "name": "illo", "description": "Officia enim iste minus a aperiam ut.", "created_at": "2024-02-01T13:18:56.000000Z", "updated_at": "2024-02-01T13:18:56.000000Z" }, "network_provider": { "id": 37, "name": "Harum", "created_at": "2024-02-01T13:18:56.000000Z", "updated_at": "2024-02-01T13:18:56.000000Z" }, "phone_number": { "id": 19, "number": "5236057732", "network_provider_id": 38, "created_at": "2024-02-01T13:18:56.000000Z", "updated_at": "2024-02-01T13:18:56.000000Z" } } }, { "id": "20", "type": "simCards", "attributes": { "serial_number": "901658521857586", "mobile_contract": { "id": 20, "name": "quis", "description": "Quo voluptate rerum nesciunt sapiente quia.", "created_at": "2024-02-01T13:18:56.000000Z", "updated_at": "2024-02-01T13:18:56.000000Z" }, "network_provider": { "id": 39, "name": "Rem", "created_at": "2024-02-01T13:18:56.000000Z", "updated_at": "2024-02-01T13:18:56.000000Z" }, "phone_number": { "id": 20, "number": "9839311741", "network_provider_id": 40, "created_at": "2024-02-01T13:18:56.000000Z", "updated_at": "2024-02-01T13:18:56.000000Z" } } } ], "jsonapi": { "version": "1.0" } }
     */
    public function index()
    {
        $sim_cards = SimCard::all();

        return SimCardResource::collection($sim_cards);
    }
}
