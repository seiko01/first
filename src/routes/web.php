<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;

Route::middleware('auth')->group(function () {
Route::get('/', [AuthController::class, 'index']);
});
Route::get('/', [ContactController::class, 'index']);
Route::post('/contacts/confirm', [ContactController::class, 'confirm'])->name('contacts.confirm');
Route::post('/contacts/store', [ContactController::class, 'store'])->name('contacts.store');