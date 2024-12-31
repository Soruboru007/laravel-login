<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    // カテゴリ作成フォームを表示するメソッド
    public function showCreateCategoryForm()
    {
        // 現在認証されているユーザーを取得
        $user = Auth::user();

        // ユーザー情報をビューに渡してカテゴリ作成フォームを表示
        return view('home.create-category', compact('user'));
    }

    // カテゴリを作成するメソッド
    public function createCategory(Request $request)
    {
        // リクエスト内容をバリデーション
        $request->validate([
            'category_name' => 'required|string|max:255|unique:categories', // カテゴリ名がユニークであることを確認
        ]);

        // 新しいカテゴリを作成
        $category = Category::create(['category_name' => $request->input('category_name')]);
        $category->save();

        // 成功メッセージを添えてカテゴリ作成ページにリダイレクト
        return redirect()->route('create-category')->with('success', 'カテゴリを作成しました。');
    }

    // 特定のカテゴリに属する質問を取得するメソッド
    public function getQuestions(string $category_id)
    {
        // 現在認証されているユーザーを取得
        $user = Auth::user();

        // IDでカテゴリを取得
        $category = Category::find($category_id);

        // カテゴリが存在しない場合、404エラーを返す
        if (! $category) {
            abort(404, 'カテゴリが見つかりません');
        }

        // このカテゴリに属するすべての質問を取得
        $questions = $category->questions; // Categoryモデルに定義されたリレーションを使用

        // 質問とカテゴリ情報をビューに渡す
        return view('home.questions', compact('user', 'category', 'questions'));
    }
}
