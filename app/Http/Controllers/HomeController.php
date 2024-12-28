<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Return the 'home' view with the authenticated user and categories
        return view('home.index', compact('user'));
    }
}
