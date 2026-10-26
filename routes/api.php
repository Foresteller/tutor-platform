<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\CurrentUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Booking\BookingController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->name('api.v1.')->group(function (): void {
    Route::post('/register', [RegisterController::class, 'create']);
    Route::post('/login', [LoginController::class, 'store']);

    Route::middleware('auth:sanctum')->group(function (): void {
        Route::get('/me', CurrentUserController::class);
        Route::post('/logout', [LogoutController::class, 'destroy']);

        Route::middleware('role:customer')->group(function (): void {
            Route::get('/bookings/available', [BookingController::class, 'available']);
            Route::post('/bookings', [BookingController::class, 'store']);
        });

        Route::middleware('role:manager,admin')->group(function (): void {
            Route::patch('/bookings/{booking}', [BookingController::class, 'update']);
            Route::delete('/bookings/{booking}', [BookingController::class, 'destroy']);
        });
    });
});
