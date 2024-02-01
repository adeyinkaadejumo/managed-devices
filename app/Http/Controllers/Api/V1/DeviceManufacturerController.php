<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\DeviceManufacturerResource;
use App\Models\DeviceManufacturer;

class DeviceManufacturerController extends Controller
{
    /**
     * GET Device Manufacturers
     *
     * Returns list of all device manufacturers.
     *
     * @response { "data": [ { "id": "1", "type": "deviceManufacturers", "attributes": { "name": "Autem", "device_models": [], "created_at": "2024-02-01T13:18:51.000000Z", "updated_at": "2024-02-01T13:18:51.000000Z" } }, { "id": "2", "type": "deviceManufacturers", "attributes": { "name": "Maiores", "device_models": [ { "id": 1, "name": "Omnis", "device_manufacturer_id": 2, "created_at": "2024-02-01T13:18:52.000000Z", "updated_at": "2024-02-01T13:18:52.000000Z" } ], "created_at": "2024-02-01T13:18:52.000000Z", "updated_at": "2024-02-01T13:18:52.000000Z" } }, { "id": "3", "type": "deviceManufacturers", "attributes": { "name": "Unde", "device_models": [], "created_at": "2024-02-01T13:18:52.000000Z", "updated_at": "2024-02-01T13:18:52.000000Z" } }, { "id": "4", "type": "deviceManufacturers", "attributes": { "name": "Sint", "device_models": [ { "id": 2, "name": "Ex", "device_manufacturer_id": 4, "created_at": "2024-02-01T13:18:52.000000Z", "updated_at": "2024-02-01T13:18:52.000000Z" } ], "created_at": "2024-02-01T13:18:52.000000Z", "updated_at": "2024-02-01T13:18:52.000000Z" } }, { "id": "5", "type": "deviceManufacturers", "attributes": { "name": "Iusto", "device_models": [], "created_at": "2024-02-01T13:18:52.000000Z", "updated_at": "2024-02-01T13:18:52.000000Z" } } ], "jsonapi": { "version": "1.0" } }
     */
    public function index()
    {
        $device_manufacturers = DeviceManufacturer::all();

        return DeviceManufacturerResource::collection($device_manufacturers);
    }
}
