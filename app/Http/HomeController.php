<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Return the 'home' view with the authenticated user
        //compact('user')は、ビューにデータを渡すためのメソッドです
        //ビューとは、ウェブページの見た目を設定するためのファイルです
        return view('auth.home', compact('user'));
    }
}
