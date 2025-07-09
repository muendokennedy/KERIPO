<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function approveOrder(string $order)
    {
        $order = Order::with('property')->find($order);

        $order->orderStatus = 'approved';

        DB::transaction(function () use ($order){
            $order->orderStatus = 'approved';
            $order->save();

            if($order->property){
                $order->property->acquisitionStatus = 'unavailable';
                $order->property->save();
            }
        });

        return back();
    }
    public function rejectOrder(Request $request, string $order)
    {
        dd($request);
        return back();
    }
    public function sendMessage(Request $request, string $order)
    {
        return back();
    }
}
