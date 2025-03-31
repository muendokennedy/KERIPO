<?php

namespace App\Http\Controllers\Client;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    //
    public function Home()
    {
        return Inertia::render('Client/Home');
    }

    public function UrbanPlots()
    {
        return Inertia::render('Client/Urban');
    }

    public function UpcountryPlots()
    {
        return Inertia::render('Client/Upcountry');
    }

    public function Apartments()
    {
        return Inertia::render('Client/Apartments');
    }

    public function Houses()
    {
        return Inertia::render('Client/Houses');
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
        if(!$request->input('agree')){
            return back()->with('success', 'You must accept the terms and conditions.');
        }

        return Inertia::render('Client/Information', [
            'name' => auth()->user()->name,
            'email'=> auth()->user()->email
        ]);
    }
}
