<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DeviceManufacturer extends Model
{
    use HasFactory;

    public function device_models(): HasMany
    {
        return $this->hasMany(DeviceModel::class);
    }
}
