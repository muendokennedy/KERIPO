<?php

namespace App\Listeners;

use App\Models\Admin;
use Illuminate\Support\Facades\Mail;
use App\Events\PropertyOrderApproved;
use App\Mail\AdminApprovedPropertyOrder;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendAdminApprovedPropertyOrderEmail
{

    /**
     * Handle the event.
     */
    public function handle(PropertyOrderApproved $event): void
    {

        $admins = Admin::all();

        foreach($admins as $admin){
            Mail::to($admin->email)->send(new AdminApprovedPropertyOrder($event->order, $admin));
        }
    }
}
