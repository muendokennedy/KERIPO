<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PropertyResource;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;

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

        $propertyId = mt_rand();

        $property = Property::create([
            'propertyId' => $propertyId,
            'category' => $propertyData['category'],
            'ownersName' => $propertyData['ownersName'],
            'location' => $propertyData['location'],
            'propertyValuation' => $propertyData['propertyValuation'],
            'acquisitionStatus' => 'Not Acquired'
        ]);

        return redirect()->route('admin.properties');
    }

    public function showEditPropertyForm(Property $property)
    {
        return Inertia::render('Admin/AdminEditProperty', [
            'property' => new PropertyResource($property)
        ]);
    }

    public function updateProperty(UpdatePropertyRequest $request, Property $property)
    {
        $propertyData = $request->validated();

        $property->category = $propertyData['category'];
        $property->ownersName = $propertyData['ownersName'];
        $property->location = $propertyData['location'];
        $property->propertyValuation = $propertyData['propertyValuation'];

        $property->save();

        return redirect()->route('admin.properties');
    }

    public function deleteProperty(Property $property)
    {
        $property->delete();

        return redirect()->route('admin.properties');
    }
}
