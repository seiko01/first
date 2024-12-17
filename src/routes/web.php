<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RegisterController;


// ログインしていないユーザーがアクセスできるルート (ログインページ)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::middleware(['auth'])->group(function () {
    // 登録処理 (GET)
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    // 登録処理 (POST)
    Route::post('/register', [RegisterController::class, 'store']);
    // お問い合わせ処理
    Route::post('/contacts/confirm', [ContactController::class, 'confirm'])->name('contacts.confirm');
    Route::post('/contacts', [ContactController::class, 'store']);
    // ホーム画面表示 (登録後にリダイレクト)
    Route::get('/', [ContactController::class, 'index'])->name('home');
});

// ログインしていないユーザーがアクセスできないルート
Route::middleware(['guest'])->group(function () {
    // ゲストユーザーがアクセスするためのルート (ログインページ)
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
});