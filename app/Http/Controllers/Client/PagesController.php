<?php

namespace App\Http\Controllers\Client;

use Inertia\Inertia;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PropertyResource;

class PagesController extends Controller
{
    //
    public function Home()
    {
        return Inertia::render('Client/Home');
    }

    public function UrbanPlots()
    {
        $urbanPlots = Property::where('category', 'Urban Plot')->latest()->get();

        return Inertia::render('Client/Urban', [
            'urbanPlots' => PropertyResource::collection($urbanPlots)
        ]);
    }

    public function UpcountryPlots()
    {

        $upcountryPlots = Property::where('category', 'Upcountry Plot')->latest()->get();

        return Inertia::render('Client/Upcountry', [
            'upcountryPlots' => PropertyResource::collection($upcountryPlots)
        ]);
    }

    public function Apartments()
    {
        $apartments = Property::where('category', 'Apartment')->latest()->get();

        return Inertia::render('Client/Apartments', [
            'apartments' => PropertyResource::collection($apartments)
        ]);
    }

    public function Houses()
    {
        $houses = Property::where('category', 'House')->latest()->get();

        return Inertia::render('Client/Houses', [
            'houses' => PropertyResource::collection($houses)
        ]);
    }

    public function Contact()
    {
        return Inertia::render('Client/Contact');
    }

    public function Conditions()
    {
        return Inertia::render('Client/Conditions');
    }

    public function conditionsCheck(Request $request)
    {
        if (! $request->input('agree')) {
            return back()->with('success', 'You must accept the terms and conditions.');
        }

        return Inertia::render('Client/Information', [
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
        ]);
    }

    public function propertyDetails(Property $property)
    {
        return Inertia::render('Client/Propertydetails', [
            'property' => new PropertyResource($property)
        ]);
    }
}
