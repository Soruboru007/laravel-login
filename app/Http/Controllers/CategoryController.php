<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // カテゴリー一覧（ホーム）
    public function index()
    {
        // DBから全カテゴリーを取得
        $categories = Category::all();

        // home.blade.php に渡す
        return view('home', compact('categories'));
    }

    // カテゴリ作成フォーム
    public function create()
    {
        return view('category.create');
    }

    // カテゴリ保存処理
    public function store(Request $request)
    {
        // バリデーション（例：category_nameは必須・最大50文字程度）
        $request->validate([
            'category_name' => 'required|string|max:50',
        ]);

        // 新規作成
        Category::create([
            'category_name' => $request->input('category_name'),
        ]);

        // 作成後、一覧ページへリダイレクト（フラッシュメッセージなども付けられる）
        return redirect()->route('home')->with('status', 'カテゴリを作成しました！');
    }
}
