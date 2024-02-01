<?php

namespace App\Http\Resources;

use TiMacDonald\JsonApi\JsonApiResource;

class DeviceResource extends JsonApiResource
{
    public $attributes = [
        'form_factor',
        'serial_number',
        'imei',
        'device_manufacturer_id',
        'device_manufacturer',
        'device_model_id',
        'device_model',
        'operating_system',
        'user_id',
        'user',
        'sim_card_id',
        'sim_card',
        'deactivated_at',
        'created_at',
        'updated_at',
    ];
}
