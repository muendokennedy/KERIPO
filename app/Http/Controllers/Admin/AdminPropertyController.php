<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Property;
use Illuminate\Support\Str;
use App\Models\PropertyImage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
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

    private function generateUniqueSlug($location)
    {
        $baseSlug = Str::slug($location);
        $slug = $baseSlug;

        $counter = 1;

        while(Property::where('slug', $slug)->exists()){
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    public function storeProperty(StorePropertyRequest $request)
    {

        
        $propertyData = $request->validated();
        
        DB::beginTransaction();
        
        $imagePaths = [];
        
        try{
            
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
                'slug' => $this->generateUniqueSlug($propertyData['location']),
                'acquisitionStatus' => 'Available',
                'created_by' => auth('admin')->id()
            ]);

            $imageRecords = [];



            foreach($propertyData['images'] as $index => $image){

                $path = $image->store('property-Images/'.$propertyId, 'public');

                if(!$path){
                    throw new \Exception('Failed to store image: '. $image->getClientOriginalName());
                }
                $imagePaths[] = $path;

                $imageRecord = PropertyImage::create([
                    'property_id' => $property->id,
                    'image_path' => $path,
                    'original_name' => $image->getClientOriginalName(),
                    'file_size' => $image->getSize(),
                    'mime_type' => $image->getMimeType()
                ]);

            // dd($propertyData);


                $imageRecords[] = $imageRecord;
            }

            $property->update([
                'primary_image_path' => $imagePaths['0']
            ]);

            DB::commit();

            return redirect()->route('admin.properties')->with('success', 'The property has been created successfully');

        } catch (ValidationException $e){

            DB::rollback();

            throw $e;

        } catch (\Exception $e){

            DB::rollback();

            foreach($imagePaths as $path){
                if(Storage::disk('public')->exists($path)){
                    Storage::disk('public')->delete($path);
                }
            }

            throw $e;
        }
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
