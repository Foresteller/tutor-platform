<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/api/test-cookie', function (Request $request) {
    return response()->json([
        'cookies' => $request->cookies->all(),
        'headers' => $request->header('cookie')
    ]);
});
