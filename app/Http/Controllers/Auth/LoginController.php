<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle the login request

    public function login(Request $request)
    {
        // Validate the login data
        $credentials = $request->only('username', 'password');

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            // If authentication is successful, fetch the authenticated user
            $user = Auth::user();  // Get the logged-in user's information

            // Redirect to the home page and pass the user data to the view
            return redirect()->route('home')->with('user', $user);  // You can pass it via session or directly to the view
        }

        // If authentication fails, redirect back with an error message
        throw ValidationException::withMessages([
            'username' => ['The provided credentials are incorrect.'],
        ]);
    }
}
