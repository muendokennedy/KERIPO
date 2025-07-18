<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Admin;
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
        $users = User::all();

        return Inertia::render('Admin/AdminClientInfo', [
            'users' => $users
        ]);
    }

    public function adminSettings()
    {
        $admins = Admin::all();

        return Inertia::render('Admin/AdminSettings', [
            'admins' => $admins
        ]);
    }
}
