<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Fortify;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');


Route::middleware(['auth'])->group(function() {
    Route::get('/', [ContactController::class, 'index'])->name('home');
    Route::post('/contacts/confirm', [ContactController::class, 'confirm'])->name('contacts.confirm');
    Route::post('/contacts/store', [ContactController::class, 'store'])->name('contacts.store');
});
