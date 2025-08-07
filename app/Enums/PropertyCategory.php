<?php

namespace App\Enums;

enum PropertyCategory: string
{
    //

    case URBAN_PLOT = 'Urban Plot';
    case UPCOUNTRY_PLOT = 'Upcountry Plot';
    case HOUSE = 'House';
    case APARTMENT = 'Apartment';

    public static function values(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
