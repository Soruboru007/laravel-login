<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

// LoginController: ユーザーのログイン処理を管理するコントローラー
class LoginController extends Controller
{
    /**
     * ログインフォームを表示する
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login'); // 'auth.login' ビューを返す
    }

    /**
     * ログインリクエストを処理する
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        // ログインデータを取得（username と password のみ）
        $credentials = $request->only('username', 'password');

        // ユーザー認証を試行する
        if (Auth::attempt($credentials)) {
            // 認証成功時、ログイン中のユーザー情報を取得
            $user = Auth::user(); // 認証されたユーザー情報を取得

            // ホームページへリダイレクトし、ユーザー情報をビューに渡す
            return redirect()->route('home')->with('user', $user); // セッション経由でデータを渡す
        }

        // 認証失敗時、エラーメッセージと共にリダイレクト
        throw ValidationException::withMessages([
            'username' => ['提供された認証情報が正しくありません。'], // エラーメッセージを表示
        ]);
    }
}
