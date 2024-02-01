<?php

namespace App\Http\Resources;

use TiMacDonald\JsonApi\JsonApiResource;

class SimCardResource extends JsonApiResource
{
    public $attributes = [
        'serial_number',
        'mobile_contract',
        'network_provider',
        'phone_number',
    ];
}
