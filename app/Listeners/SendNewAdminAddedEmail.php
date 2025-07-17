<?php

namespace App\Listeners;

use App\Models\Admin;
use App\Mail\MadeAdminEmail;
use App\Events\NewAdminAdded;
use App\Mail\NewAdminAddedEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNewAdminAddedEmail
{
    /**
     * Handle the event.
     */
    public function handle(NewAdminAdded $event): void
    {
        //

        $admins = Admin::all();

        foreach($admins as $admin){
            if($admin->email === $event->admin->email){
                Mail::to($event->admin->email)->send(new MadeAdminEmail($event->admin));
            } else {
                Mail::to($admin->email)->send(new NewAdminAddedEmail($event->admin));
            }
        }

    }
}
