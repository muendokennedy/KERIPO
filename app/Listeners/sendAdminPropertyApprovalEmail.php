<?php

namespace App\Listeners;
use App\Models\Admin;
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
        $admins = Admin::all();

        foreach($admins as $admin){
            Mail::to($admin->email)->send(new PropertyAcquistionApproval($event->user));
        }
    }
}
