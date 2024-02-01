<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddDeviceRequest;
use App\Http\Requests\DevicesListRequest;
use App\Http\Requests\UpdateDeviceRequest;
use App\Http\Resources\DeviceResource;
use App\Models\Device;
use App\Notifications\DeviceDeactivated;
use Carbon\Carbon;

class DeviceController extends Controller
{
    /**
     * GET Devices
     *
     * Returns list of all devices.
     *
     * @bodyParam operating_system string. Example: "Android" or "iOS"
     *
     * @response { "data": [ { "id": "1", "type": "devices", "attributes": { "form_factor": "Tablet", "serial_number": "1011057232", "imei": "083875543108664", "device_manufacturer_id": 21, "device_manufacturer": { "id": 21, "name": "Error", "created_at": "2024-02-01T13:18:56.000000Z", "updated_at": "2024-02-01T13:18:56.000000Z" }, "device_model_id": 11, "device_model": { "id": 11, "name": "Quod", "device_manufacturer_id": 22, "created_at": "2024-02-01T13:18:56.000000Z", "updated_at": "2024-02-01T13:18:56.000000Z" }, "operating_system": "iOS", "user_id": 11, "user": { "id": 11, "name": "Abagail Kreiger", "email": "koepp.keegan@example.org", "email_verified_at": "2024-02-01T13:18:56.000000Z", "created_at": "2024-02-01T13:18:56.000000Z", "updated_at": "2024-02-01T13:18:56.000000Z" }, "sim_card_id": 11, "sim_card": { "id": 11, "serial_number": "085684662869207", "mobile_contract_id": 11, "network_provider_id": 21, "phone_number_id": 11, "created_at": "2024-02-01T13:18:56.000000Z", "updated_at": "2024-02-01T13:18:56.000000Z" }, "deactivated_at": null, "created_at": "2024-02-01T13:18:56.000000Z", "updated_at": "2024-02-01T13:18:56.000000Z" } }, { "id": "2", "type": "devices", "attributes": { "form_factor": "Phone", "serial_number": "3717753206", "imei": "310418260144117", "device_manufacturer_id": 23, "device_manufacturer": { "id": 23, "name": "Fugiat", "created_at": "2024-02-01T13:18:56.000000Z", "updated_at": "2024-02-01T13:18:56.000000Z" }, "device_model_id": 12, "device_model": { "id": 12, "name": "Rerum", "device_manufacturer_id": 24, "created_at": "2024-02-01T13:18:56.000000Z", "updated_at": "2024-02-01T13:18:56.000000Z" }, "operating_system": "iOS", "user_id": 12, "user": { "id": 12, "name": "Vesta Emmerich", "email": "gino.schulist@example.org", "email_verified_at": "2024-02-01T13:18:52.000000Z", "created_at": "2024-02-01T13:18:52.000000Z", "updated_at": "2024-02-01T13:18:52.000000Z" }, "sim_card_id": 1, "sim_card": { "id": 1, "serial_number": "366884779053177", "mobile_contract_id": 1, "network_provider_id": 1, "phone_number_id": 1, "created_at": "2024-02-01T13:18:52.000000Z", "updated_at": "2024-02-01T13:18:52.000000Z" }, "deactivated_at": null, "created_at": "2024-02-01T18:04:17.000000Z", "updated_at": "2024-02-01T18:04:17.000000Z" } } ], "jsonapi": { "version": "1.0" } }
     */
    public function index(DevicesListRequest $request)
    {
        $devices = Device::when($request->operating_system, function ($query) use ($request) {
            $query->where('operating_system', $request->operating_system);
        })
            ->get();

        return DeviceResource::collection($devices);
    }

    /**
     * POST Device
     *
     * Creates a new Device.
     *
     * @bodyParam form_factor string The form factor of the device. Example: "Phone" or "Tablet"
     * @bodyParam serial_number string The serial number of the device. Example: "132389NGGG"
     * @bodyParam imei string The imei of the device. Example: "123456789012345"
     * @bodyParam device_manufacturer_id int The id of the device manufacturer. Example: 1
     * @bodyParam device_model_id int The id of the device model. Example: 1
     * @bodyParam operating_system string The OS of the device. Example: "Android" or "iOS"
     * @bodyParam user_id int The id of the sim card. Example: 1
     * @bodyParam sim_card_id int The id of the sim card. Example: 1
     *
     * @response { "data": { "id": "11", "type": "devices", "attributes": { "form_factor": "et", "serial_number": "cupiditate", "imei": "et", "device_manufacturer_id": "1", "device_manufacturer": { "id": 1, "name": "Autem", "created_at": "2024-02-01T13:18:51.000000Z", "updated_at": "2024-02-01T13:18:51.000000Z" }, "device_model_id": "1", "device_model": { "id": 1, "name": "Omnis", "device_manufacturer_id": 2, "created_at": "2024-02-01T13:18:52.000000Z", "updated_at": "2024-02-01T13:18:52.000000Z" }, "operating_system": "voluptas", "user_id": "1", "user": { "id": 1, "name": "Berneice Orn", "email": "dkovacek@example.org", "email_verified_at": "2024-02-01T13:18:52.000000Z", "created_at": "2024-02-01T13:18:52.000000Z", "updated_at": "2024-02-01T13:18:52.000000Z" }, "sim_card_id": "1", "sim_card": { "id": 1, "serial_number": "366884779053177", "mobile_contract_id": 1, "network_provider_id": 1, "phone_number_id": 1, "created_at": "2024-02-01T13:18:52.000000Z", "updated_at": "2024-02-01T13:18:52.000000Z" }, "deactivated_at": null, "created_at": "2024-02-01T18:04:17.000000Z", "updated_at": "2024-02-01T18:04:17.000000Z" } }, "jsonapi": { "version": "1.0" } }
     * @response 422 { "message": "The form factor field is required. (and 7 more errors)", "errors": { "form_factor": [ "The form factor field is required." ], "serial_number": [ "The serial number field is required." ], "imei": [ "The imei field is required." ], "device_manufacturer_id": [ "The device manufacturer id field is required." ], "device_model_id": [ "The device model id field is required." ], "operating_system": [ "The operating system field is required." ], "user_id": [ "The user id field is required." ], "sim_card_id": [ "The sim card id field is required." ] } }
     */
    public function store(AddDeviceRequest $request)
    {
        $device = Device::create($request->validated());

        return new DeviceResource($device);
    }

    /**
     * PUT Device
     *
     * Updates a Device.
     *
     * @bodyParam user_id int The id of the user. Example: 1
     * @bodyParam sim_card_id int The id of the sim card. Example: 1
     *
     * @response { "data": { "id": "11", "type": "devices", "attributes": { "form_factor": "et", "serial_number": "cupiditate", "imei": "et", "device_manufacturer_id": "1", "device_manufacturer": { "id": 1, "name": "Autem", "created_at": "2024-02-01T13:18:51.000000Z", "updated_at": "2024-02-01T13:18:51.000000Z" }, "device_model_id": "1", "device_model": { "id": 1, "name": "Omnis", "device_manufacturer_id": 2, "created_at": "2024-02-01T13:18:52.000000Z", "updated_at": "2024-02-01T13:18:52.000000Z" }, "operating_system": "voluptas", "user_id": "1", "user": { "id": 1, "name": "Berneice Orn", "email": "dkovacek@example.org", "email_verified_at": "2024-02-01T13:18:52.000000Z", "created_at": "2024-02-01T13:18:52.000000Z", "updated_at": "2024-02-01T13:18:52.000000Z" }, "sim_card_id": "1", "sim_card": { "id": 1, "serial_number": "366884779053177", "mobile_contract_id": 1, "network_provider_id": 1, "phone_number_id": 1, "created_at": "2024-02-01T13:18:52.000000Z", "updated_at": "2024-02-01T13:18:52.000000Z" }, "deactivated_at": null, "created_at": "2024-02-01T18:04:17.000000Z", "updated_at": "2024-02-01T18:04:17.000000Z" } }, "jsonapi": { "version": "1.0" } }
     * @response 422 { { "sim_card_id": [ "The sim card id field is required." ] } }
     */
    public function update(UpdateDeviceRequest $request, Device $device)
    {
        $validated_data = $request->validated();
        $validated_data['deactivated_at'] = null;

        $device->update($validated_data);

        return new DeviceResource($device);
    }

    /**
     * PATCH Deactivate Device
     *
     * Deactivates a Device.
     *
     * @response { "data": { "id": "11", "type": "devices", "attributes": { "form_factor": "et", "serial_number": "cupiditate", "imei": "et", "device_manufacturer_id": "1", "device_manufacturer": { "id": 1, "name": "Autem", "created_at": "2024-02-01T13:18:51.000000Z", "updated_at": "2024-02-01T13:18:51.000000Z" }, "device_model_id": "1", "device_model": { "id": 1, "name": "Omnis", "device_manufacturer_id": 2, "created_at": "2024-02-01T13:18:52.000000Z", "updated_at": "2024-02-01T13:18:52.000000Z" }, "operating_system": "voluptas", "user_id": "1", "user": { "id": 1, "name": "Berneice Orn", "email": "dkovacek@example.org", "email_verified_at": "2024-02-01T13:18:52.000000Z", "created_at": "2024-02-01T13:18:52.000000Z", "updated_at": "2024-02-01T13:18:52.000000Z" }, "sim_card_id": "1", "sim_card": { "id": 1, "serial_number": "366884779053177", "mobile_contract_id": 1, "network_provider_id": 1, "phone_number_id": 1, "created_at": "2024-02-01T13:18:52.000000Z", "updated_at": "2024-02-01T13:18:52.000000Z" }, "deactivated_at": null, "created_at": "2024-02-01T18:04:17.000000Z", "updated_at": "2024-02-01T18:04:17.000000Z" } }, "jsonapi": { "version": "1.0" } }
     * @response 422 { { "sim_card_id": [ "The sim card id field is required." ] } }
     */
    public function deactivate(Device $device)
    {
        $device->update(['deactivated_at' => Carbon::now()]);

        $device->user->notify(new DeviceDeactivated($device));

        return new DeviceResource($device);
    }
}
