<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Order;
use App\Mail\MessageClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\PropertyOrderRejected;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Events\PropertyOrderApproved;
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

        DB::transaction(function () use ($order){
            $order->orderStatus = 'approved';
            $order->save();

            if($order->property){
                $order->property->acquisitionStatus = 'Unavailable';
                $order->property->save();
            }
            PropertyOrderApproved::dispatch($order);
        });
        return back();
    }
    public function rejectOrder(Request $request, string $order)
    {
        $request->validate([
            'rejectReason' => 'required | string'
        ]);

        $orderData = Order::find($order);

        DB::transaction(function() use ($orderData, $request){
            Mail::to($orderData->user->email)->send(new PropertyOrderRejected($orderData, $request->rejectReason));

            $orderData->property->acquisitionStatus = 'Available';

            $orderData->property->save();

            $orderData->delete();
        });


        return back();
    }
    public function sendMessage(Request $request, string $order)
    {
        $request->validate([
            'clientMessage' => 'required | string'
        ]);

        $orderData = Order::find($order);

        Mail::to($orderData->user->email)->send(new MessageClient($orderData, $request->clientMessage));

        return back();
    }
}
