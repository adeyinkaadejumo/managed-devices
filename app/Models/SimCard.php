<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SimCard extends Model
{
    use HasFactory;

    public function device(): HasOne
    {
        return $this->hasOne(PhoneNumber::class);
    }

    public function phone_number(): BelongsTo
    {
        return $this->belongsTo(PhoneNumber::class);
    }

    public function network_provider(): BelongsTo
    {
        return $this->belongsTo(NetworkProvider::class);
    }

    public function mobile_contract(): BelongsTo
    {
        return $this->belongsTo(MobileContract::class);
    }
}
