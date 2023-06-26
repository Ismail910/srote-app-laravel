<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use Laravel\Socialite\Facades\Socialite;



class DashboardController extends Controller
{
    public function index(){
        return view('/dashboard/dashboard');
    }



    public function handleGoogleCallback(Request $request)
    {
        $googleUser = Socialite::driver('google')->user();

        // Check if the user already exists in your database
        $existingUser = User::where('email', $googleUser->email)->first();

        if ($existingUser) {
            // User already exists, log them in
            Auth::login($existingUser);
        } else {
            // User doesn't exist, create a new user
            $newUser = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                // Set any other necessary user attributes
            ]);

            // Log in the newly created user
            Auth::login($newUser);
        }

        return redirect('/'); // Redirect to the dashboard or any other desired page
    }   
}
