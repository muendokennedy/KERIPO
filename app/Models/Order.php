<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    //

    protected $fillable = [
        'user_id',
        'property_id',
        'orderStatus',
        'orderId',
        'service_fee',
        'payment_mode'
    ];


    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
