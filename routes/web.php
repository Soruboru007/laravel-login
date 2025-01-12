<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResultController;

// ホーム画面（カテゴリ一覧表示）
Route::get('/home', [CategoryController::class, 'index'])->name('home');

// カテゴリ作成フォーム表示
Route::get('/home/create/category', [CategoryController::class, 'create'])->name('category.create');

// カテゴリ作成処理（フォームPOST）
Route::post('/home/store/category', [CategoryController::class, 'store'])->name('category.store');

// トップページの表示（ログインページにリダイレクトされる可能性あり）
Route::get('/', [IndexController::class, 'index'])->name('index');

// ログイン関連ルート
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login'); // ログインフォームの表示
Route::post('/login', [LoginController::class, 'login']); // ログイン処理

// ログアウト関連ルート
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout'); // ログアウト処理

// サインアップ（登録）関連ルート
Route::get('/signup', [SignupController::class, 'showRegistrationForm'])->name('signup'); // 登録フォームの表示
Route::post('/signup', [SignupController::class, 'signup']); // 登録処理

// ホーム画面（ログイン済みユーザー専用）
Route::get('/home', [HomeController::class, 'home'])->name('home')->middleware('auth'); // 認証済みユーザーのみアクセス可能

// カテゴリ作成関連ルート（認証済みユーザー専用）
Route::get('/home/create/category', [CategoryController::class, 'showCreateCategoryForm'])->name('create-category')->middleware('auth'); // カテゴリ作成フォームの表示
Route::post('/home/create/category', [CategoryController::class, 'createCategory'])->middleware('auth'); // カテゴリ作成処理

// 問題作成関連ルート（認証済みユーザー専用）
Route::get('/home/create/question', [QuestionController::class, 'showCreateQuestionForm'])->name('create-question')->middleware('auth'); // 問題作成フォームの表示
Route::post('/home/create/question', [QuestionController::class, 'createQuestion'])->middleware('auth'); // 問題作成処理

// カテゴリごとの問題表示ルート（認証済みユーザー専用）
Route::get('/home/categories/{category_id}/questions', [QuestionController::class, 'getQuestions'])->name('get-questions')->middleware('auth'); // カテゴリ内の問題一覧を表示

// 問題の回答保存ルート（認証済みユーザー専用）
Route::post('/home/categories/{category_id}/answers', [AnswerController::class, 'saveAnswers'])->name('save-answers')->middleware('auth'); // 問題の回答を保存

// 結果表示ルート（認証済みユーザー専用）
Route::get('/home/categories/{category_id}/results', [ResultController::class, 'getResults'])->name('get-results')->middleware('auth'); // カテゴリごとの結果を表示

Route::get('/test/{name}/age/{age}', function (string $name, string $age) {
    return view('test',  [
        "name123" => $name,
        "age" => $age,
    ]);
});
