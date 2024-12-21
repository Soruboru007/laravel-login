<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    // Show the login form
    //
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle the login request
    //login(Request $request)は、ログインリクエストを処理するためのメソッドです
    //ログインリクエストとは、ユーザーがログインフォームに入力した情報を送信することです
    //ログインフォームとは、ユーザーがログインするために使用するフォームです
    //フォームとは、ユーザーがデータを入力するためのウェブページの部品です
    public function login(Request $request)
    {
        //Auth::とは、Laravelの認証機能を提供するファサードです
        //ファサードとは、クラスのインスタンスを生成せずにクラスのメソッドを呼び出すためのクラスです
        // インスタンスとは、クラスの実体のことです
        //クラスのメソッドとは、クラスが持つ関数のことです
        //ここでのクラスとは、オブジェクト指向プログラミングにおいて、オブジェクトを生成するための設計図のことです
        //オブジェクトとは、データとそのデータを操作するための関数をまとめたものです
        //オブジェクト指向プログラミングとは、オブジェクトを中心にプログラムを設計するプログラミングの手法です
        //credentialとは、ユーザーがログインするために使用する情報です
        //credentialはなぜ必要かというと、ユーザーがログインするためには、ユーザー名とパスワードが必要だからです
        $credentials = $request->only('username', 'password');

        // Attempt to authenticate the user
        //Auth::attempt($credentials)は、ユーザーが提供した認証情報を使用して、ユーザーを認証しようとします
        if (Auth::attempt($credentials)) {
            // もし認証に成功したら、ログインしたユーザーの情報を取得します
            $user = Auth::user(); // Get the authenticated user

            // Redirect to the home page and pass the user data to the view
            //redirect()->route('home')は、指定されたルートにリダイレクトするためのメソッドです
            //with('user', $user)は、ビューにデータを渡すためのメソッドです
            //リダイレクトとは、ウェブページを別のウェブページに自動的に転送することです
            return redirect()->route('home')->with('user', $user);  // You can pass it via session or directly to the view
        }

        // If authentication fails, redirect back with an error message
        //throw ValidationException::withMessages()は、指定されたエラーメッセージを使用して、バリデーション例外をスローします
        //バリデーション例外とは、ユーザーが提供したデータが正しくない場合にスローされる例外です
        //スローとは、例外を発生させることです
        //例外とは、プログラムの実行中に発生するエラーのことです
        throw ValidationException::withMessages([
            'username' => ['The provided credentials are incorrect.'],
        ]);
    }
}
