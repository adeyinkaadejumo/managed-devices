<?php

namespace App\Http\Resources;

use TiMacDonald\JsonApi\JsonApiResource;

class DeviceManufacturerResource extends JsonApiResource
{
    public $attributes = [
        'name',
        'device_models',
        'created_at',
        'updated_at',
    ];
}
