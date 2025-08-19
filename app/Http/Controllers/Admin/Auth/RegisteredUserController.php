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

        // $file = $request->file('avatar');

        // dd($file);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'avatar' => 'sometimes|image|mimes:jpg, png, jpeg, webp | max:5120'
        ]);

        DB::transaction(function() use ($request) {

            $avatarPath = null;

            if($request->hasFile('avatar') && $request->file('avatar')->isValid()){
                
                try{

                    $avatar = $request->file('avatar');

                    $avatarPath = $avatar->store('avatars/', 'public');

                } catch (\Exception $e){

                    throw $e;
                }
            }

            $admin = Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'avatar' => $avatarPath
            ]);

            Auth::guard('admin')->login($admin);
    
            event(new NewAdminAdded($admin));
        });


        return redirect(route('admin.dashboard', absolute: false))->with('success', 'The admin account has been created successfully');
    }
}
