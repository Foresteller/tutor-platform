<?php

use App\Http\Controllers\Booking\BookingController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth_sanctum')->group(function() {
    Route::post('/bookings', [BookingController::class, 'store']);
    Route::get('/bookings/available', [BookingController::class, 'available']);
});
