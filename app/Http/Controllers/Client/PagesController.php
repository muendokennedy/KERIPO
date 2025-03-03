<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

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
}
