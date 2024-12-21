<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

//Auth::logout()は、現在のユーザーをログアウトするためのメソッドです
//extends Controllerは、このクラスがControllerクラスを継承することを示しています
//継承とは、クラスが別のクラスのメソッドやプロパティを引き継ぐことです
//プロパティとは、クラスが持つ変数のことです
//メソッドとは、クラスが持つ関数のことです
class LogoutController extends Controller
{
    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
