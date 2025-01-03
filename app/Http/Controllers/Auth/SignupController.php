<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

// SignupController: ユーザー登録を管理するコントローラー
class SignupController extends Controller
{
    /**
     * 登録フォームを表示する
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.signup'); // 'auth.signup' ビューを返す
    }

    /**
     * ユーザー登録の処理を行う
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function signup(Request $request)
    {
        // 入力データを検証
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|unique:users,username|max:255', // ユーザー名の一意性と文字数制限をチェック
            'email' => 'required|string|email|max:255|unique:users,email', // メールアドレスの形式、一意性、文字数制限をチェック
            'password' => 'required|string|min:8|confirmed', // パスワードは8文字以上、確認フィールドも必要
        ]);

        // 検証に失敗した場合
        if ($validator->fails()) {
            return redirect()->back() // 元のページにリダイレクト
                ->withErrors($validator) // エラー内容をセッションに渡す
                ->withInput(); // 入力内容を保持
        }

        // 新しいユーザーを作成
        $user = User::create([
            'username' => $request->username, // フォームからのユーザー名
            'email' => $request->email,       // フォームからのメールアドレス
            'password' => Hash::make($request->password), // パスワードをハッシュ化して保存
        ]);

        // ユーザー登録後に自動的にログイン
        auth()->login($user);

        // ホームページへリダイレクトし、ユーザー情報をセッションに渡す
        return redirect()->route('home')->with('user', $user);
    }
}
