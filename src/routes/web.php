<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Fortify;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

Route::middleware(['auth'])->group(function() {
    Route::get('/', [ContactController::class, 'index'])->name('home');
    Route::post('/confirm', [ContactController::class, 'confirm'])->name('contacts.confirm');
    Route::post('/store', [ContactController::class, 'store'])->name('contacts.store');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');
    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');
    Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search');
});
