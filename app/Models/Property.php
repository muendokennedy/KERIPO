<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'primary_image_path',
        'slug',
        'created_by'
    ];


    public function order(): HasOne
    {
        return $this->hasOne(Order::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(PropertyImage::class);
    }
}
