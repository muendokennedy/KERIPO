<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Admin;
use Inertia\Response;
use Illuminate\Http\Request;
use App\Events\NewAdminAdded;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function adminCreate(): Response
    {
        return Inertia::render('Admin/AdminAuth/AdminRegister');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        DB::transaction(function() use ($request) {

            $admin = Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            Auth::guard('admin')->login($admin);
    
            event(new NewAdminAdded($admin));
        });


        return redirect(route('admin.dashboard', absolute: false));
    }
}
