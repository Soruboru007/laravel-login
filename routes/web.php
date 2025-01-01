<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

// ホーム画面（カテゴリ一覧表示）
Route::get('/home', [CategoryController::class, 'index'])->name('home');

// カテゴリ作成フォーム表示
Route::get('/home/create/category', [CategoryController::class, 'create'])->name('category.create');

// カテゴリ作成処理（フォームPOST）
Route::post('/home/store/category', [CategoryController::class, 'store'])->name('category.store');

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/signup', [SignupController::class, 'showRegistrationForm'])->name('signup');
Route::post('/signup', [SignupController::class, 'signup']);

Route::get('/home', [HomeController::class, 'home'])->name('home')->middleware('auth');

Route::get('/home/create/category', [CategoryController::class, 'showCreateCategoryForm'])->name('create-category')->middleware('auth');
Route::post('/home/create/category', [CategoryController::class, 'createCategory'])->middleware('auth');

Route::get('/home/create/question', [QuestionController::class, 'showCreateQuestionForm'])->name('create-question')->middleware('auth');
Route::post('/home/create/question', [QuestionController::class, 'createQuestion'])->middleware('auth');
Route::get('/home/categories/{category_id}/questions', [QuestionController::class, 'getQuestions'])->name('get-questions')->middleware('auth');
