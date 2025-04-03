<?php

namespace App\Listeners;
use Illuminate\Support\Facades\Mail;
use App\Mail\PropertyAcquistionApproval;
use App\Events\ClientInformationSubmitted;

class sendAdminPropertyApprovalEmail
{
    /**
     * Handle the event.
     */
    public function handle(ClientInformationSubmitted $event): void
    {
        //
        Mail::to($event->user->email)->send(new PropertyAcquistionApproval($event->user));
    }
}
