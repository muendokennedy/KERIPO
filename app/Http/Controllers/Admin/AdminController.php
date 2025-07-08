<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Order;
use App\Models\Property;
use App\Http\Controllers\Controller;
use App\Http\Resources\PropertyResource;
use App\Http\Resources\PropertyOrderResource;

class AdminController extends Controller
{
    //

    public function adminHome()
    {
        return Inertia::render('Admin/AdminHome');
    }

    public function adminAnalytics()
    {
        return Inertia::render('Admin/AdminAnalytics');
    }

    public function adminProperties()
    {
        $properties = Property::latest()->get();

        return Inertia::render('Admin/AdminProperties', [
            'success' => session('success'),
            'properties' => PropertyResource::collection($properties),
        ]);
    }

    public function adminOrders()
    {
        $orders = Order::with('user')->get();

        return Inertia::render('Admin/AdminOrders', [
            'orders' => PropertyOrderResource::collection($orders)
        ]);
    }

    public function adminClientinfo()
    {
        return Inertia::render('Admin/AdminClientInfo');
    }

    public function adminSettings()
    {
        return Inertia::render('Admin/AdminSettings');
    }
}
