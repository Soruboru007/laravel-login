<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // ホーム画面を表示する
    public function home()
    {
        // 現在認証されているユーザーを取得
        $user = Auth::user();

        // すべてのカテゴリを取得
        $categories = Category::all();

        // 認証ユーザー情報とカテゴリをビューに渡して 'home.index' を返す
        return view('home.index', compact('user', 'categories'));
    }
}
