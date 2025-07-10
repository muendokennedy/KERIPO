<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Mail;
use App\Events\PropertyOrderApproved;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\ClientPropertyOrderApproved;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendOrderApprovedEmail
{
    /**
     * Handle the event.
     */
    public function handle(PropertyOrderApproved $event): void
    {
        //

        if($event->order->user && $event->order->user->email){
            Mail::to($event->order->user->email)->send(new ClientPropertyOrderApproved($event->order));
        }

    }
}
