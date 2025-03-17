<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
