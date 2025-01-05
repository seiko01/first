<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use Laravel\Fortify\Fortify;

// ログインしていないユーザーがアクセスできるルート
Route::middleware(['guest'])->group(function () {
    // ログインページ (Fortify によるカスタムビュー)
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    // 登録ページ (Fortify によるカスタムビュー)
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');
});

// ログインしているユーザーがアクセスできるルート
Route::middleware(['auth'])->group(function () {
    // ホーム画面
    Route::get('/', [ContactController::class, 'index'])->name('home');

    Route::post('/contacts/confirm', [ContactController::class, 'confirm'])->name('contacts.confirm');
    Route::post('/contacts/store', [ContactController::class, 'store'])->name('contacts.store');

    Route::get('/thanks', function () {
        return view('thanks');
    })->name('thanks');

    // 管理者ページ
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    // 詳細情報をモーダルに表示
    Route::get('/admin/details/{id}', [AdminController::class, 'details'])->name('admin.details');

    Route::post('/admin/delete/{id}', [AdminController::class, 'delete'])->name('admin.delete');
    Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');

    // モーダル用のルート（ページ内でモーダルを表示）
    Route::get('/modal', function () {
        return view('custom_modal_hash');
    })->name('modal');

    Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');

});