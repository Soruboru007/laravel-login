<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        // Retrieve the authenticated user
        $user = Auth::user();
        //$categoriesは、Categoryモデルの全てのレコードを取得します
        //Categoryモデルとは、カテゴリのデータを操作するためのクラスです
        //カテコりとは、質問を分類するためのものです
        $categories = Category::all();
        //compact('user', 'categories')は、ビューにデータを渡すためのメソッドです
        //メソッド
        return view('home.index', compact('user', 'categories'));
    }
    public function index()
    {
    $user = Auth::user(); // ログインしていればUserモデルが返り、未ログインならnull
    return view('home', compact('user'));
    }

}
