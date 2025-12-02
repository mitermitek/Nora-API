<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Token\CreateTokenController;
use App\Http\Controllers\Token\RevokeCurrentTokenController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('register', RegisterController::class);
});

Route::prefix('tokens')->group(function () {
    Route::post('', CreateTokenController::class);
    Route::delete('', RevokeCurrentTokenController::class)->middleware('auth:sanctum');
});
