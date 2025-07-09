<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use App\Http\Resources\PropertyResource;
use App\Models\Property;
use Inertia\Inertia;

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

        $propertyId = 'KRP-' . mt_rand(10000, 99999);


        while(Property::where('propertyId', $propertyId)->exists()){
            $propertyId = 'KRP-' . mt_rand(10000, 99999);
        }

        $property = Property::create([
            'propertyId' => $propertyId,
            'category' => $propertyData['category'],
            'ownersName' => $propertyData['ownersName'],
            'location' => $propertyData['location'],
            'propertyValuation' => $propertyData['propertyValuation'],
            'acquisitionStatus' => 'Available',
        ]);

        return redirect()->route('admin.properties')->with('success', 'The property has been created successfully');
    }

    public function showEditPropertyForm(Property $property)
    {
        return Inertia::render('Admin/AdminEditProperty', [
            'property' => new PropertyResource($property),
            'success' => session('success'),
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

        return redirect()->route('admin.properties')->with('success', 'The property has been updated successfully');
    }

    public function deleteProperty(Property $property)
    {
        $property->delete();

        return back()->with('success', 'The property has been removed successfully');
    }
}
