<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AdminBookController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;

Route::get('/', function () {
    return view('welcome');
});

// Registration
Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

// Login
Route::get('login', [SessionsController::class, 'create'])->name('login')->middleware('guest');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');

// Logout
Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

// Booklist
Route::middleware('auth')->group(function () {
    Route::resource('/books', BookController::class);
});

// Admin section
Route::middleware(['can:admin'])->group(function () {
    Route::resource('admin/books', AdminBookController::class);
});
