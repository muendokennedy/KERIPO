<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Property extends Model
{
    //

    protected $fillable = [
        'propertyId',
        'category',
        'ownersName',
        'location',
        'propertyValuation',
        'acquisitionStatus',
    ];


    public function order(): HasOne
    {
        return $this->hasOne(Order::class);
    }
}
