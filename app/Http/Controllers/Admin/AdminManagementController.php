<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendNewAdminInvitationEmail;

class AdminManagementController extends Controller
{
    //

    public function inviteNewAdmin(Request $request)
    {
        $validatedEmail = $request->validate([
            'email' => 'required | email'
        ]);

        Mail::to($validatedEmail['email'])->send(new sendNewAdminInvitationEmail(auth('admin')->user()));

        return back();
    }
}
