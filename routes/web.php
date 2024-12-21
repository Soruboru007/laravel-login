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

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('show-login');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/signup', [SignupController::class, 'showRegistrationForm'])->name('show-signup');
Route::post('/signup', [SignupController::class, 'signup'])->name('signup');
