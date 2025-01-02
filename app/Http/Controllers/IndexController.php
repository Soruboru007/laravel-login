<?php

namespace App\Http\Controllers;

// インデックスページを制御するコントローラー
class IndexController extends Controller
{
    // インデックスページを表示する
    public function index()
    {
        return view('index'); // 'index'ビューを返す
    }
}
