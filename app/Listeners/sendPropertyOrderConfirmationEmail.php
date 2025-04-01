<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\ClientInformationSubmitted;
use Illuminate\Support\Facades\Mail;
use App\Mail\PropertyOrderCreated;

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
