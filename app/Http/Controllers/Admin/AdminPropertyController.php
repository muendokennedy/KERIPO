<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePropertyRequest;

class AdminPropertyController extends Controller
{
    //
    public function showNewPropertyForm()
    {
        return Inertia::render('Admin/AdminNewProperty');
    }

    public function storeProperty(StorePropertyRequest $request)
    {
        $propertyData = $request->validated();

        $propertyId = mt_rand(100000, 999999);

        $property = Property::create([
            'propertyId' => $propertyId,
            'category' => $propertyData['category'],
            'ownersName' => $propertyData['ownersName'],
            'location' => $propertyData['location'],
            'propertyValuation' => $propertyData['propertyValuation'],
            'acquisitionStatus' => 'Not Acquired'
        ]);
    }
}
