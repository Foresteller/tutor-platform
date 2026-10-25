<?php

use App\Http\Controllers\Auth\CurrentUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {
    Route::post('/register', [RegisterController::class, 'create'])
        ->name('register');
    Route::post('/login', [LoginController::class, 'store'])
        ->name('login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [LogoutController::class, 'destroy'])
            ->name('logout');
        Route::get('/me', CurrentUserController::class)
            ->name('me');
    });
});
