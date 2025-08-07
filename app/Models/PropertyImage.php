<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
    //

    protected $fillable = [
        'property_id',
        'image_path',
        'original_name',
        'file_size',
        'mime_type',
    ];
}
