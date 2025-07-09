<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PropertyOrderResource;

class AdminPropertyOrderController extends Controller
{
    //

    public function orderInfo(string $order)
    {

        $order = Order::with('user', 'property')->find($order);

            return Inertia::render('Admin/OrderInfo', [
            'order' => $order
        ]);
    }
}
