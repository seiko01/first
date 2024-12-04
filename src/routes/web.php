<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;

Route::middleware('auth')->group(function () {
Route::get('/', [AuthController::class, 'index']);
});
Route::get('/', [ContactController::class, 'index']);


