<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});
// homeページはログインしているユーザー専用です
// ログインしていないユーザーがアクセスした場合はログインページにリダイレクトします
// middlewareメソッドを使って、homeページにアクセスする前に認証を行います
Route::get('/home', [HomeController::class, 'home'])->name('home')->middleware('auth');

Route::get('/signup', [SignupController::class, 'showRegistrationForm'])->name('signup');
Route::post('/signup', [SignupController::class, 'signup']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');