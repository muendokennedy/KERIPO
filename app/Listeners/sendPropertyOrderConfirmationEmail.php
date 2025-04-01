<?php

namespace App\Listeners;

use App\Events\ClientInformationSubmitted;
use App\Mail\PropertyOrderCreated;
use Illuminate\Support\Facades\Mail;

class sendPropertyOrderConfirmationEmail
{
    /**
     * Handle the event.
     */
    public function handle(ClientInformationSubmitted $event): void
    {
        //

        Mail::to($event->user->email)->send(new PropertyOrderCreated($event->user));
    }
}
