<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;

// ログインしていないユーザーがアクセスできるルート (ログインページ)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::middleware(['auth'])->group(function () {
    // 登録処理
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    // お問い合わせ処理
    Route::post('/contacts/confirm', [ContactController::class, 'confirm'])->name('contacts.confirm');
    Route::post('/contacts', [ContactController::class, 'store']);

    // ホーム画面表示
    Route::get('/', [ContactController::class, 'index'])->name('home');

});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/details/{id}', [AdminController::class, 'details'])->name('admin.details');
    Route::post('/admin/delete/{id}', [AdminController::class, 'delete'])->name('admin.delete');
    Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');
});

Route::middleware(['guest'])->group(function () {
    // ゲストユーザーがアクセスするルート
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
});