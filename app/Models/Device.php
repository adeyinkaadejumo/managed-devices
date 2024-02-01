<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_factor',
        'serial_number',
        'imei',
        'device_manufacturer_id',
        'device_model_id',
        'operating_system',
        'user_id',
        'sim_card_id',
        'deactivated_at',
    ];

    protected $casts = [
        'deactivated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sim_card(): BelongsTo
    {
        return $this->belongsTo(SimCard::class);
    }

    public function device_manufacturer(): BelongsTo
    {
        return $this->belongsTo(DeviceManufacturer::class);
    }

    public function device_model(): BelongsTo
    {
        return $this->belongsTo(DeviceModel::class);
    }

    public function device_assignment(): HasMany
    {
        return $this->hasMany(DeviceAssignment::class);
    }

    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => isset($attributes['deactivated_at']) ? 'Inactive' : 'Active',
        );
    }
}
