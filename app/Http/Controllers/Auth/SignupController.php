<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SignupController extends Controller
{
    // Show the registration form
    public function showRegistrationForm()
    {
        return view('auth.signup');
    }

    // Handle the registration logic
    public function signup(Request $request)
    {
        // Validate the registration data
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|unique:users,username|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed', // password confirmation rule
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create the new user
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hashing the password
        ]);

        // Log the user in after successful registration
        auth()->login($user);

        // Redirect to the home page and pass the user data to the view
        return redirect()->route('home')->with('user', $user);
    }
}
