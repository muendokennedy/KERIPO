<?php

namespace App\Listeners;

use App\Models\Admin;
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
            Mail::to($admin->email)->send(new NewAdminAddedEmail($event->admin));
        }
    }
}
